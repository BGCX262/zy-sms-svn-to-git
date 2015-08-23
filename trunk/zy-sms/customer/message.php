<?php
/*
 * Created on 2011-9-5
 *======================================
 *Author: Allen
 *Project:health360
 *File: company.php  
 *Date: 2011-9-5
 *======================================
 *TODO 
 *@param @type @var  @note
 */
require ('../include/init.php');
$method = $_GET['method'];

if(isset($_REQUEST['error'])){
	
	$error=$_REQUEST['error'];
}else{
	
	$error=0;
}
global $view_file,$error;

if (empty ($method)) {
	$lang_method = $_LANG['ADD'];
	$method = 'addForward';
}
if ($method === 'update') {
	$method = 'update';
	departmen_update();
	$lang_method = $_LANG['UPDATE'];
	$view_file = "department.tpl";
}
if ($method === 'delete') {
	delete();
	$lang_method = $_LANG['ADD'];
}
if ($method === 'add') {
	$error=add();
	$lang_method = $_LANG['ADD'];	
	$view_file = "message.tpl";
	header("Location:message.php");
}
if ($method === 'addForward') {
	$lang_method = $_LANG['ADD'];	
	$method='add';
	select();
	$view_file = "message.tpl";
}
if ($method === 'updateForward')
{
	$method = 'update';
	selectSingleDpartment();
	select();
	$lang_method = $_LANG['UPDATE'];
	$view_file = "department.tpl";
}
if ($method === 'select') {
	select();
	$lang_method = $_LANG['ADD'];	
	$view_file = "department.tpl";
}
/**
 * 获取表单修改信息
 */
function getField() {
	$message = new Message();
	if (isset ($_POST['submit'])) {	
			//$message->message_content=str_replace(' ','%20',$_POST['message_content']);
			$message->message_content=$_POST['message_content'];					
			$message->contact_list_id=$_POST['contact_list_id'];
			$message->norepeat=$_POST['norepeat'];
			$message->userapi_id=$_POST['userapi_id'];
			$message->mobile_list=$_POST['mobile_list'];
			$message->isentry=$_POST['isentry'];
	}
	return $message;
}

/**
 * 短信发送
 */
function add() {
	$start_time=date(TIME_FORMAT);
	$message = getField();	
	
	//根据获取的短信内容和联系人列表,发送短信
	if($message->message_content==""||trim($message->message_content)==""){
		header("location:message.php?method=addForward&error=6");
		return;
	}else{
		//根据短信内容计算花费的credit.
		$message->cost=countCharacters($message->message_content);
		if (preg_match('/[\x80-\xff]./', $_POST['message_content'])) {
			//中文,全部专程unicode码
		$message->message_content = $_POST['message_content'];
		$message->message_content = getUnicode($message->message_content);
		$unicode=1;
		}else{
			//是英文的话再把空格转换下.
		$message->message_content=$_POST['message_content'];
		$message->message_content = str_replace(' ', '%20',$message->message_content);
		@$message->message_content = ereg_replace(Chr(10), '%0A',$message->message_content);
		@$message->message_content = ereg_replace(Chr(13), '',$message->message_content);
		}
	}
	/*if(count($message->contact_list_id)==0){
		header("location:message.php?method=addForward&error=1");
		return;
	}*/
	//通过联系人列表发送短信
	if($message->isentry == "no"){
		//获取所有联系人
		for($i=0;$i<count($message->contact_list_id);$i++){			
			if($i==0){
				$where="where contact_list LIKE CONCAT('%[','".$message->contact_list_id[$i]."',']%')";
			}else{
				$where.=" or contact_list LIKE CONCAT('%[','".$message->contact_list_id[$i]."',']%')";
			}
		}
		$contact =new Contact();
		$contact_list=$contact->queryContactByContactListId($where,$message->norepeat);
	}
	//通过手工输入的手机号码列表发送短信
	else if($message->isentry == "yes"){
		//将手机号码专换成$message对象.
		$mobile_arr=explode(",",$message->mobile_list);
		for($i=0;$i<count($mobile_arr);$i++){
			if(trim($mobile_arr[$i])!=""){
				@$contact_list[$i]->contact_mobile=$mobile_arr[$i];
			}
		}
	}
	
	//先判断联系人列表数量.然后再判断是否有足够的短信条数.
	$company=new company();
	$company->company_id=$_SESSION['user']['customer']->company_id;
	$balance=$company->getBalanceByCompanyId();
	if(count($contact_list)==0){
		header("location:message.php?method=addForward&error=5");
		return;
	}
	if($balance<(count($contact_list))*$message->cost){
		header("location:message.php?method=addForward&error=2");
		return;
	}

	//给获取到的联系人发送短信

	
	$success_list="";//成功列表
	$fail_list="";//失败列表
	$success_count=0;//成功发送次数
	$fail_count=0;//失败发送次数
	
	
	//查询user api.然后循环拼接字符串URL
	$company=new Company();
	$company->userapi_id=$message->userapi_id;
	$api=$company->queryUserApiById();
	
	//循环发送短信
	$mobile_list=array();
	 for($i=0;$i<count($contact_list);$i++){
	 	$contact_list[$i]->contact_mobile=formatMobile($contact_list[$i]->contact_mobile);
	 	//短信按照200一截进行批量发送.
	 		if(trim($contact_list[$i]->contact_mobile)!=""){
		 		if($i%200==0){
		 			if(count($contact_list)>1){
		 				$mobile_list['mobile']=$contact_list[$i]->contact_mobile.",";
						continue ;
					}else{
						$mobile_list['mobile']=$contact_list[$i]->contact_mobile;
					}
		 		}else if($i%200!=199&&$i<count($contact_list)-1){
		 			$mobile_list['mobile'].=$contact_list[$i]->contact_mobile.",";
		 			continue ;
		 		}else{
		 			$mobile_list['mobile'].=$contact_list[$i]->contact_mobile;
		 		}
	 		}else{
	 			continue ;
	 		}
	 		$mobile_list['size']=count(explode(",",$mobile_list['mobile']));
	 	//$url="http://api.clickatell.com/http/sendmsg?user=".$api->api_username."&password=".$api->api_password."&api_id=".$api->api_id."&to=".$contact_list[$i]->contact_mobile."&text=".$message->message_content."&concat=".$message->cost;
		//$url="http://api.clickatell.com/http/sendmsg?user=".$api->api_username."&password=".$api->api_password."&api_id=".$api->api_id."&to=".$mobile_list['mobile']."&text=".$message->message_content."&concat=".($message->cost*$mobile_list['size']);
	 	$url="http://api.clickatell.com/http/sendmsg";
		if($api->api_type==1){
			$url.="&from=".$api->sender_name;
		}
		//如果短信内容包含中文,需要加unicode=1
		if ($unicode==1) {
			$url .= "&unicode=1";
		}
		$num = ($message->cost*$mobile_list['size']);
		$arr=array('user'=>$api->api_username,
				'password'=>$api->api_password,
				'api_id'=>$api->api_id,
				'to'=>$mobile_list['mobile'],
				'text'=>$message->message_content,
				'concat'=>$num,	
			);
		$ch = curl_init();  
	  	curl_setopt($ch,CURLOPT_URL,$url );  
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);     
   		curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
   		curl_setopt($ch, CURLOPT_POST, 1);
   		curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
	  	$content= curl_exec($ch);  
		curl_close($ch);

	  
	 	//执行完成后需要做判断
	 	//判断返回结果里是否包含回车,换行.
	 	//然后再根据回车换行进行数组分割.
	 	//最后判断每个号码的发送情况.从而生成success list和fail list.
	 	$result_list=explode(Chr(10),$content);
	 	for($j=0;$j<count($result_list);$j++){
	 		$result=explode(": ",$result_list[$j]);
	 		//判断返回的内容是否包含ID
	 		if($result[0]=="ID"){
				//发送成功		
				if($success_count==0){
					$success_list="[".$result[2]."]";
				}else{
					$success_list.=",[".$result[2]."]";
				}
				$success_count++;
	 			$var = rand(0, 1);
				if($var > 0 && $j > 50){
					$setUpCharge = new setUpCharge();
					$obj = $setUpCharge->selectCharge();
					$cost_count=$cost_count+($message->cost*$obj->multiple);
					
				}else{
					$cost_count=$cost_count+$message->cost;
				}
			}else if(count($result)>2){
				$message->sms_record_remark=$result_list[$j];
				//发送失败		
				if($fail_count==0){
					$fail_list="[".$result[2]."]";
				}else{
					$fail_list.=",[".$result[2]."]";
				}
				$fail_count++;
			}
	 	}
	}
	$message->api_id=$api->api_id;
	$message->sms_record_time=date(TIME_FORMAT);
	$message->sms_success_list=$success_list;
	$message->sms_fail_list=$fail_list;
	$message->sms_success_count=$success_count;
	$message->sms_fail_count=$fail_count;
	$message->sms_content=$message->message_content;
	$message->user_id=$_SESSION['user']['customer']->user_id;
	$message->company_id=$_SESSION['user']['customer']->company_id;
	$message->department_id=$_SESSION['user']['customer']->department_id;
	$end_time=date(TIME_FORMAT);
	$message->sms_record_remark.=" start at ".$start_time."; end at ".$end_time;
	$company->company_id=$_SESSION['user']['customer']->company_id;
	$balances = $cost_count;
	$company->deductBalance(ceil($balances));
	
	$message->sendMessage();
}

/**
	 * 短信你发送页面的基础数据
	 * */
	function select()
	{
		global $error;
				//联系人列表
				$contact =new Contact();
				$contact->company_id=$_SESSION['user']['customer']->company_id;
				$contact->department_id=$_SESSION['user']['customer']->department_id;
				$contact->user_id=$_SESSION['user']['customer']->user_id;
				$contact_list=$contact->CountCustomerContact();
				//send id也就是api
				$company =new Company();
				$company->company_id=$_SESSION['user']['customer']->company_id;
				$api_list=$company->queryUserApiNoPager();
		if($error==0){
			if(count($api_list)==0){
				header("location:message.php?method=addForward&error=4");
				return;
			}
		}
		global $smarty;
		$smarty ->assign("contact_list",$contact_list);
		$smarty ->assign("api_list",$api_list);
	}
	
	if($error==1){
		$error_message="Please choose contact list!";
	}else if($error==2){
		$error_message="No enghou bulance!";
	}else if($error==3){
		$error_message="Please create a contact list!";
	}else if($error==4){
		$error_message="Please create a api!";
	}else if($error==5){
		$error_message="There is no cantact!";
	}else if($error==6){
		$error_message="Please entry the sms text!";
	}else{
		$error_message="";
	}
	$smarty->assign("method", $method);
	$smarty->assign("lang_method", $lang_method);
	$smarty->assign("error_message", $error_message);
	$smarty->display(admin_display($view_file));
	
function countCharacters($text) {
	$length = mb_strlen($text);
	$credit = 1;
	if (preg_match('/[\x80-\xff]./', $text)) {
		//中文计算短信条数的方法
		if ($length <= 70) {
			$credit = 1;
		} else
			if ($length > 70 && $length <= 134) {
				$credit = 2;
			} else
				if ($length > 134 && $length <= 201) {
					$credit = 3;
				} else
					if ($length > 201&& $length <= 268) {
						$credit = 4;
					} else
						if ($length > 268) {
							$credit = 5;//最长335
						}
	} else {
		//英文计算短信条数的方法
		if ($length <= 160) {
			$credit = 1;
		} else
			if ($length > 160 && $length <= 306) {
				$credit = 2;
			} else
				if ($length > 306 && $length <= 459) {
					$credit = 3;
				} else
					if ($length > 459 && $length <= 612) {
						$credit = 4;
					} else
						if ($length > 612) {
							$credit = 5;
						}
	}

	return $credit;
}	
function formatMobile($mobile){
	$length=mb_strlen($mobile);
	$aus=substr($mobile,0,2);
	$tt=substr($mobile,1,$length);
	if($aus=="04"){
		$mobile="61".substr($mobile,1,$length-1);		
	}
	return $mobile;
}
function getUnicode($word){
	$word0 = iconv('gbk', 'utf-8', $word);
    $word1 = iconv('utf-8', 'gbk', $word0);
    $word =  ($word1 == $word) ? $word0 : $word;
	 // 拆分汉字
    preg_match_all('#(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+)#s', $word, $array, PREG_PATTERN_ORDER);
    foreach ($array[0] as $cc)
    {
		if(preg_match('/[\x80-\xff]./', $cc)){
			$arr = str_split($cc); 
			$bin_str = '';
			foreach ($arr as $value)
			{
				$bin_str .= decbin(ord($value));
			}
			
			$bin_str = preg_replace('/^.{4}(.{4}).{2}(.{6}).{2}(.{6})$/','$1$2$3', $bin_str);
			$return[] =  dechex(bindec($bin_str));
			//echo $cc."是中文"."<br />";
		}else{
			//$return[] =bindec($cc);
			$arr = str_split($cc); 
			$bin_str = '';
			foreach ($arr as $value)
			{
				$bin_str .= decbin(ord($value));
			}
			$str=dechex(bindec($bin_str));
			if(strlen($str)<4){
				for($i=strlen($str);$i<4;$i++){
					$str="0".$str;
				}
			}
			$return[] = $str;
			//echo $cc."不是中文"."<br />";
		}
    }
    return implode('', $return);
}

?>
