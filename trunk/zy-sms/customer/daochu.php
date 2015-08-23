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
 		require_once 'PHPExcel.php';
		require_once 'PHPExcel/Writer/Excel2007.php';
		require_once 'PHPExcel/Writer/Excel5.php';
		include_once 'PHPExcel/IOFactory.php';
		require('../config/config.php');//调用数据库配置文件
		require('../include/class/mysql_class.php');/* 载入MYSQL,初始化 */
		
		$objExcel = new PHPExcel();
		//设置属性 (这段代码无关紧要，其中的内容可以替换为你需要的
		$objExcel->getProperties()->setCreator("andy");
		$objExcel->getProperties()->setLastModifiedBy("andy");
		$objExcel->getProperties()->setTitle("Office 2003 XLS Test Document");
		$objExcel->getProperties()->setSubject("Office 2003 XLS Test Document");
		$objExcel->getProperties()->setDescription("Test document for Office 2003 XLS, generated using PHP classes.");
		$objExcel->getProperties()->setKeywords("office 2003 openxml php");
		$objExcel->getProperties()->setCategory("Test result file");
		$objExcel->setActiveSheetIndex(0);

		//表头
		$objExcel->getActiveSheet()->setCellValue('A1', "contact_first_name");
		$objExcel->getActiveSheet()->setCellValue('B1', "contact_surname");
		$objExcel->getActiveSheet()->setCellValue('C1', "contact_email");
		$objExcel->getActiveSheet()->setCellValue('D1', "contact_mobile");
		$objExcel->getActiveSheet()->setCellValue('E1', "contact_phone");
		$objExcel->getActiveSheet()->setCellValue('F1', "contact_title");
		$objExcel->getActiveSheet()->setCellValue('G1', "contact_birth_date");
		$objExcel->getActiveSheet()->setCellValue('H1', "contact_address");
		$objExcel->getActiveSheet()->setCellValue('I1', "contact_remark");
		
			/**获取值*/
			$group=$_POST['contact_list_id'];
		$mysql=new MYSQL($db_host,$db_user, $db_pass, $db_name);
		/**获取为分组ID*/
			$sql="select * from zy_contact_list  where  company_id=".$_SESSION['user']['customer']->company_id." ORDER BY contact_list_id ASC";
			$contact_list_id=$mysql->select($sql);
		
		/**连接数据库 用户名 密码*/
		$lnk =mysql_connect($db_host,$db_user,$db_pass)or die ('Not connected : ' . mysql_error());
		/**连接所需要的数据库*/
		mysql_select_db($db_name, $lnk) or die ('Can\'t use zy-sms : ' . mysql_error());
		
		$sql = 'select * from zy_contact where company_id='.$_SESSION['user']['customer']->company_id;
		$stmt =mysql_query($sql);
		
		//debug($links_list);
		$n=2; // 控制写入execl 行数
		while($row=mysql_fetch_array($stmt)){// array()   array()   array()  
			for($i=0; $i <count($row)-37;$i++){
				$objExcel->getActiveSheet()->setCellValue('A'.$n, $row["contact_first_name"]);
				$objExcel->getActiveSheet()->setCellValue('B'.$n, $row["contact_surname"]);
				$objExcel->getActiveSheet()->setCellValue('C'.$n, $row["contact_email"]);
				$objExcel->getActiveSheet()->setCellValue('D'.$n, $row["contact_mobile"]);
				$objExcel->getActiveSheet()->setCellValue('E'.$n, $row["contact_phone"]);
				$objExcel->getActiveSheet()->setCellValue('F'.$n, $row["contact_title"]);
				$objExcel->getActiveSheet()->setCellValue('G'.$n, $row["contact_birth_date"]);
				$objExcel->getActiveSheet()->setCellValue('H'.$n, $row["contact_address"]);
				$objExcel->getActiveSheet()->setCellValue('I'.$n, $row["contact_remark"]);
		    }
		    $n++;
}
// 高置列的宽度
		$objExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		$objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
		$objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$objExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$objExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		
		$objExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BPersonal cash register&RPrinted on &D');
		$objExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objExcel->getProperties()->getTitle() . '&RPage &P of &N');

		// 设置页方向和规模
		$objExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
		$objExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		$objExcel->setActiveSheetIndex(0);
		$timestamp = time();
		if($ex == '2007') { //导出excel2007文档
			header("Content-type: text/html; charset=utf-8");
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="contact'.$timestamp.'.xlsx"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		} else {  //导出excel2003文档
			header("Content-type: text/html; charset=utf-8");
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="contact'.$timestamp.'.xls"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
			$objWriter->save('php://output');
			exit;
		}