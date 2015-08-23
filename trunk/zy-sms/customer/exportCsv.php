<?php
/**
 * @FileName:daochu.php
 * @Describe:TODO
 * @Author:Arthur
 * @Email:arthurkingtoo@foxmail.com
 * @Time:2012-5-4
 * @Version:V9.0
		 */
		session_start();
		// 输出Excel文件头，可把user.csv换成你要的文件名
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="contact.csv"');
		header('Cache-Control: max-age=0');
		require('../config/config.php');//调用数据库配置文件
		require('../include/class/mysql_class.php');/* 载入MYSQL,初始化 */
	
		$mysql=new MYSQL($db_host,$db_user, $db_pass, $db_name);
		/**获取为分组ID*/
			$sqls="select * from zy_contact_list  where  company_id=".$_SESSION['user']['customer']->company_id." ORDER BY contact_list_id ASC";
			$contact_list_id=$mysql->select($sqls);
		/**获取值*/
			$group=$_POST['contact_list_id'];
			
		/**连接数据库 用户名 密码*/
		$lnk =mysql_connect($db_host,$db_user,$db_pass)or die ('Not connected : ' . mysql_error());
		
		/**连接所需要的数据库*/
		mysql_select_db($db_name, $lnk) or die ('Can\'t use zy-sms : ' . mysql_error());
		
		if(!empty($group)){
				for($i=0;$i<count($group);$i++){
					$link=$group[$i];
					$links.="or contact_list like '%[$link]%' ";
				}
			}
			else{
			 	$link=$contact_list_id[0]->contact_list_id;
			}
		$sql = 'select contact_id,contact_first_name, contact_surname, contact_email, contact_mobile,contact_phone,contact_title,' .
				'contact_birth_date,contact_address,contact_remark from zy_contact where contact_list like '."'%[$link]%'".' '.$links.' and company_id='.$_SESSION['user']['customer']->company_id;
		$stmt =mysql_query($sql);
				
		// 打开PHP文件句柄，php://output 表示直接输出到浏览器
		$fp = fopen('php://output', 'a');
		 
		// 输出Excel列名信息
		$head = array('contact_id', 'contact_first_name', 'contact_surname', 'contact_email', 'contact_mobile','contact_phone','contact_title','contact_birth_date','contact_address','contact_remark');
		foreach ($head as $i => $v) {
		    // CSV的Excel支持GBK编码，一定要转换，否则乱码
		    $head[$i] = iconv('utf-8', 'gbk', $v);
		}
		 
		// 将数据通过fputcsv写到文件句柄
		fputcsv($fp, $head);
		 
		// 计数器
		$cnt = 0;
		// 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
		$limit = 100000;
		 
		 //逐行取出数据，不浪费内存
		while ($row =mysql_fetch_row($stmt)) {
		    $cnt ++;
		    if ($limit == $cnt) { //刷新一下输出buffer，防止由于数据过多造成问题
		        ob_flush();
		        flush();
		        $cnt = 0;
		    }
		    foreach ($row as $i => $v) {
		        $row[$i] = iconv('utf-8', 'gbk', $v);
		    }
		    fputcsv($fp, $row);
		}