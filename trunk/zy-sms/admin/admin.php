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

 	$view_file="admin.tpl";
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
		$view_file = "admin.tpl";
	}
	if ($method === 'update') {
		$method = 'update';
		update();
		$lang_method = $_LANG['UPDATE'];
		$view_file = "admin.tpl";
	}
	if ($method === 'delete') {
		delete();
		$lang_method = $_LANG['ADD'];
	}
	if ($method === 'add') {
		add();
		$lang_method = $_LANG['ADD'];
		$view_file = "admin.tpl";
	}
	if ($method === 'addForward') {
		$lang_method = $_LANG['ADD'];
		$method='add';
		select();
		$view_file = "admin.tpl";
	}
	if($method==='updateForward'){
		$method = 'update';
		selectID();
		select();
		$lang_method = $_LANG['UPDATE'];
		$view_file = "admin.tpl";
	}

 /*
  * 获取管理员信息
  * */
  function getAdminContent(){

	$admin = new admin();

  	if(isset($_POST['submit'])){
  	if(isset($_POST['admin_id'])){
  		$admin->admin_id=$_POST['admin_id'];
  	}
  	if(isset($_POST['admin_login_name'])){
  		$admin->admin_login_name=$_POST['admin_login_name'];
  	}
  	if(isset($_POST['admin_login_password']) == isset($_POST['admin_repeat_password']))
  	{
  		$admin->admin_login_password=$_POST['admin_login_password'];
  	}
  	if(isset($_POST['admin_real_name'])){
  		$admin->admin_real_name = $_POST['admin_real_name'];
  	}
  	if(isset($_POST['admin_remark'])){
  	   $admin->admin_remark=$_POST['admin_remark'];
  	}

  }else{
			$admin->admin_id=$_GET['admin_id'];
  	}
  	return $admin;
  }

	/*
	 * 查询用户信息
	 * */
	function select()
	{
		$admin = new admin();
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
////		$rs =$admin->queryPage();
		$total =$admin->countAdmin();
		$GLOBALS['page']->pageft($total,$GLOBALS['displaypg']);
		$item = $admin->queryAdmin();
		global $smarty;
		$smarty ->assign("item", $item);
		$smarty->assign("nextpage",$GLOBALS['page']->getPagenav());

	}

/*
 * 根据ID查询用户信息
	 * */
	 function selectID()
	 {
	 	$admin = getAdminContent();
		$adminObj = $admin->queryAdminId();
		global $smarty;
		$smarty ->assign("adminObj",$adminObj);
	 }
	 /*
 * 
 * 添加用户信息
 */
	 function add(){
		$admin = getAdminContent();
		$message=$admin->addAdmin();
		if($message[0]=="")
		{
			header("location:admin.php");
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

		$admin = getAdminContent();
        $admin->deleteAdmin();
        header("location:admin.php");
	}
	/*
	 * 修改用户类
	 * */
	function update()
	{
		$admin = getAdminContent();
		$message=$admin->updateAdmin();
		if($message[0]=="")
		{
			header("location:admin.php");
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