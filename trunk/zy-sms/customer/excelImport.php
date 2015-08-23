<?php require('../include/init.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include ('PHPExcel/IOFactory.php');
$lnk = mysql_connect ( $db_host, $db_user, $db_pass ) or die ( 'Not connected : ' . mysql_error () );
// make foo the current db
mysql_select_db ( $db_name, $lnk ) or die ( 'Can\'t use zy-sms : ' . mysql_error () );
/**
 * 获取为分组ID
 */
$sql = "select * from zy_contact_list  where  company_id=" . $_SESSION ['user'] ['customer']->company_id . " ORDER BY contact_list_id ASC";
$contact_list_id = $GLOBALS ['mysql']->select ( $sql );
/**
 * 获取值
 */
$company_id = $_SESSION ['user'] ['customer']->company_id;
$department_id = $_SESSION ['user'] ['customer']->department_id;
$user_id = $_SESSION ['user'] ['customer']->user_id;
$contact_create_time = date ( 'Y-m-d H:i:m' );
$contact_update_time = date ( 'Y-m-d H:i:m' );
$group = $_POST ['contact_list_id'];
if (! empty ( $group )) {
	$set = implode ( ']|[', $group );
} else {
	$set = $contact_list_id [0]->contact_list_id;
}
function excelTime($days, $time = false) { // 如果需要导入年月日的时候采用，第一参数是PHPExcel取出来的，第二参数给false就行了
                                        // 把phpexcel读出的日期数据转换成xxxx-m-y
	if (is_numeric ( $days )) {
		$jd = GregorianToJD ( 1, 1, 1970 );
		$gregorian = JDToGregorian ( $jd + intval ( $days ) - 25569 );
		$myDate = explode ( '/', $gregorian );
		$myDateStr = str_pad ( $myDate [2], 4, '0', STR_PAD_LEFT ) . "-" . str_pad ( $myDate [0], 2, '0', STR_PAD_LEFT ) . "-" . str_pad ( $myDate [1], 2, '0', STR_PAD_LEFT ) . ($time ? " 00:00:00" : '');
		return $myDateStr;
	}
	return $days;
}

chdir ( dirname ( __FILE__ ) );
function upload_files($filespath) {
	$name = $filespath ["name"];
	$tmp_name = $filespath ["tmp_name"];
	$size = $filespath ["size"];
	$uploadfile = "excelFile/" . date ( "YmdHis" ) . "_" . $filespath ['name'];
	if ($name == "") 	// 文件名为空
	{
		echo "<script>alert('Please select a file to upload!'); 
						 window.history.back();</script>";
	}
	$file = explode ( "|", "xls|xlsx|csv" );
	$upload_file = strtolower ( end ( explode ( ".", $_FILES ['file'] ['name'] ) ) );
	if (! in_array ( $upload_file, $file )) {
		echo "<script type='text/javascript'>alert('Hello, can only import EXCEL file!');window.history.back();</script>";
		exit ();
	}
	if (move_uploaded_file ( $tmp_name, $uploadfile ))
		return $uploadfile;
	else if (copy ( $tmp_name, $uploadfile ))
		return $uploadfile;
	else
		return false;
}

$excFile = $_FILES ['file'];
$aa = upload_files ( $excFile );
$upload_file = strtolower ( end ( explode ( ".", $_FILES ['file'] ['name'] ) ) );
if ($upload_file == 'xls') {
	$reader = PHPExcel_IOFactory::createReader ( 'Excel5' ); // 2007以下用:Excel5 ， 2007用：Excel2007
}else{
	echo "<script type='text/javascript'>alert('Sorry,please upload xls file!');window.history.back();</script>";
	exit ();
}
/*
elseif ($upload_file == 'csv') {
	$reader = PHPExcel_IOFactory::createReader ( 'csv' );
} else {
	$reader = PHPExcel_IOFactory::createReader ( 'Excel2007' ); // 2007以下用:Excel5 ， 2007用：Excel2007
}*/

$PHPExcel = $reader->load ( $aa );
$sheet = $PHPExcel->getSheet ( 0 ); // 读取第一个工作表(编号从零开始。)

$highestRow = $sheet->getHighestRow (); // 取得总行数
$highestColumn = $sheet->getHighestColumn ();

$array = array (
		'A' => '1',
		'B' => '2',
		'C' => '3',
		'D' => '4',
		'E' => '5',
		'F' => '6',
		
		'G' => '7',
		'H' => '8',
		'I' => '9',
		'J' => '10',
		'K' => '11',
		'L' => '12',
		
		'M' => '13',
		'N' => '14',
		'O' => '15',
		'P' => '16',
		'Q' => '17',
		'R' => '18',
		
		'S' => '19' 
	); // 定义一个列数数组，默认从1开始
	$bColumn = - 1;
	$name = ""; // 初始化列表名
	$success=0;
	$rows="";
	$repetition_mobile = "";
	$flag=0;
	// 获取字段名称做匹配使用
	for($i = 0; $i<$array [$highestColumn]; $i ++){
		$field = $sheet->getCellByColumnAndRow ( $i, 1 )->getValue ();
		if ($field == "contact_birth_date") {
			$bColumn = $i;
		}
		$name .= "`$field`,";
	}
	for($row = 1; $row <= $highestRow; $row ++) { // 从第2行开始 1 2
		$sql = ''; // 初始化sql变量
		$str_flag = "-1";
		//判断contact_first_name,contact_surname 是否为空,为空则不导入
		$value1 = $sheet->getCellByColumnAndRow ( 0, $row )->getValue ();
		$value2 = $sheet->getCellByColumnAndRow ( 1, $row )->getValue ();
		//过滤取到第一行的值
		if($row == 1)
			$flag = $row+1;
		else 
			$flag=$row;
		$mobile = $sheet->getCellByColumnAndRow ( 3, $flag )->getValue ();
		//validate mobile data
		$sql_validate_mobile = "SELECT * FROM `zy_contact` WHERE contact_mobile='".$mobile."' AND contact_list LIKE '%".$set."%'";
		$rs = mysql_query($sql_validate_mobile);
		$mobile_count = mysql_num_rows($rs);
		if(!empty($mobile_count)){
			if(empty($repetition_mobile)){
				$repetition_mobile = $row;
			}else{
				$repetition_mobile = $repetition_mobile."、".$row;
			}
			continue;
		}
		//validate first name or last name can't empty
		if(trim( $value1 ) == '' && trim( $value2 ) == ''){
			if(empty($rows)){
				$rows = $row;
			}else{
				$rows = $rows."、".$row;
			}
			continue;
		}
		for($column = 0; $column < $array [$highestColumn]; $column ++) { // 列数
			
			$value = $sheet->getCellByColumnAndRow ( $column, $row )->getValue ();
			$value=str_replace("'", "\'", $value);
			$str_flag .= $value;
			
			if ($bColumn == $column) {
				$value = '1998-12-12';
			}
			$val = trim ( $value );
			$sql .= "'$val',";
			//echo $name."<br />";
			//echo $sql."<br />";
	}
	
	if ($row != 1) {
		if (trim ( $str_flag ) != "-1") {
			$sqls = "INSERT INTO zy_contact($name company_id,department_id,user_id,contact_create_time,contact_update_time,contact_list) VALUES($sql '$company_id','$department_id','$user_id','$contact_create_time','$contact_update_time','[$set]')";
			$res = $GLOBALS ['mysql']->insert ( $sqls, true );
			if($res > 0){
				$success++;
			}
			$updateContactListCountSql = "update zy_contact_list set contact_list_count=contact_list_count+1 where contact_list_id=" . $contact_list_id [0]->contact_list_id;
			$GLOBALS ['mysql']->upadte ( $updateContactListCountSql );
		}
	}
}
//die();
	if(empty($rows)){
		echo "<script>alert('Article the ".$success." data import success!');window.history.back();</script>";
	}elseif (!empty($rows) && !empty($success)){
		echo "<script>alert('Article the ".$success."data import success! \\n By first name or last name is empty, \\n line ".$rows." import failure');window.history.back();</script>";
	}elseif(!empty($repetition_mobile) && !empty($rows) && !empty($success)){
		echo "<script>alert('".$success."data import successfully.Line".$rows."import failed,due to the Firstname or Lastname is empty.
and Line".$repetition_mobile." import failed,due to the mobile number repeat.');window.history.back();</script>";
	}elseif(!empty($repetition_mobile)){
		echo "<script>alert('Line".$repetition_mobile." import failed,due to the mobile number repeat.');window.history.back();</script>";
	}elseif(empty($success)){
		echo "<script>alert('import failed');window.history.back();</script>";
	}else{
		echo "<script>alert('By first name or last name is empty, \\n line ".$rows." import failed');window.history.back();</script>";
	}
	
?>