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
require('../include/init.php');

 	$view_file="credit.tpl";
	 $method = $_GET['method'];
	$login=new login();
/*	$news=$login->checkLogined();
	if(!$news==true)
	{
		header("location:login.php");
	}
*/	
	if (empty ($method)) {
		$lang_method = $_LANG['ADD'];
		$method = 'select';
	}
	if ($method === 'select') {
		select();
		$lang_method = $_LANG['ADD'];
		$view_file = "credit.tpl";
	}
	if ($method === 'update') {
		$method = 'update';
		update();
		$lang_method = $_LANG['UPDATE'];
		$view_file = "credit.tpl";
	}
	if ($method === 'delete') {
		delete();
		$lang_method = $_LANG['ADD'];
	}
	if ($method === 'add') {
		add();
		$lang_method = $_LANG['ADD'];
		$view_file = "credit.tpl";
	}
	if ($method === 'addForward') {
		$lang_method = $_LANG['ADD'];
		$method='add';
		select();
		$view_file = "credit.tpl";
	}
	if($method==='updateForward'){
		$method = 'update';
		selectID();
		select();
		$lang_method = $_LANG['UPDATE'];
		$view_file = "credit.tpl";
	}

 /*
  * 获取管理员信息
  * */
  function getContent(){

	$credit = new credit();

  	if(isset($_POST['submit'])){
	  		$credit->credit_id=$_POST['credit_id'];
	  		$credit->credit_name=$_POST['credit_name'];
	  		$credit->credit_volume=$_POST['credit_volume'];
	  		$credit->credit_price = $_POST['credit_price'];
	  	    $credit->credit_currency=$_POST['credit_currency'];
			$credit->credit_sort=$_POST['credit_sort'];
			$credit->credit_status=$_POST['credit_status'];
			$credit->credit_remark=$_POST['credit_remark'];
	  }else{
				$credit->credit_id=$_GET['credit_id'];
	  	}
  	return $credit;
  }

	/*
	 * 查询钱包信息
	 * */
	function select()
	{
		$credit = new credit();
		if(isset($_GET['page']))
		{
		$pages = $_GET['page'];
		}
		else
		{
		$pages = 1;
		}
		$GLOBALS['pages'] = $pages;
		$page = new page($pages);
		$GLOBALS['page']=$page;
		//$rs =$credit->queryCredit();
		$total =$credit->countCredit();
		//$totle =mysql_num_rows($rs);
		$GLOBALS['page']->pageft($total,$GLOBALS['displaypg']);
		$item = $credit->queryCredit();
		global $smarty;
	
		$smarty ->assign("item", $item);		
		$smarty ->assign("obj", $credit);
		$smarty->assign("nextpage",$GLOBALS['page']->getPagenav());
	}

/*
 * 根据ID查询钱包信息
	 * */
	 function selectID()
	 {
	 	$credit = getContent();
		$creditObj = $credit->queryCreditId();
		global $smarty;
		$smarty ->assign("obj",$creditObj);
	 }
	 /*
 * 
 * 添加用户信息
 */
	 function add(){
		$credit = getContent();
		$message=$credit->addCredit();
		if($message[0]=="")
		{
			header("location:credit.php");
		}
		else
		{
			global $smarty;
			global $_LANG;
			if($message[0]==1){
			$smarty ->assign("login_name_error_message",$_LANG['ERROR_USER_MESSAGE']);
			}else if($message[0]==2){
				$smarty ->assign("password_error_message",$_LANG['ERROR_PASSWORD_MESSAGE']);
			}
		}
	}
	/*
	 * 删除用户信息
	 * */
	function delete()
	{

		$credit = getContent();
        $credit->deleteCredit();
        header("location:credit.php");
	}
	/*
	 * 修改用户类
	 * */
	function update()
	{
		$credit = getContent();
		$message=$credit->updateCredit();
		if($message[0]=="")
		{
			header("location:credit.php");
		}
		else
		{
			global $smarty;
			global $_LANG;
			if($message[0]==1){
			$smarty ->assign("login_name_error_message",$_LANG['ERROR_USER_MESSAGE']);
			}else if($message[0]==2){
				$smarty ->assign("password_error_message",$_LANG['ERROR_PASSWORD_MESSAGE']);
			}
		}
	}
	
	$smarty->assign("method",$method);
	$smarty->assign("lang_method", $lang_method);
	$smarty->display(admin_display($view_file));
?>