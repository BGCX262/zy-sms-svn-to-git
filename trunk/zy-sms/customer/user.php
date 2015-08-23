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
global $view_file;

if (empty ($method)) {
	$lang_method = $_LANG['ADD'];
	$method = 'select';
}
if ($method === 'update') {
	$method = 'update';
	user_update();
	$lang_method = $_LANG['UPDATE'];
	$view_file = "user.tpl";
}
if ($method === 'delete') {
	delete();
	$lang_method = $_LANG['ADD'];
}
if ($method === 'add') {
	add();
	$lang_method = $_LANG['ADD'];	
	$view_file = "user.tpl";
}
if ($method === 'addForward') {
	$lang_method = $_LANG['ADD'];	
	$method='add';
	select();
	$view_file = "user.tpl";
}
if ($method === 'updateForward')
{
	$method = 'update';
	selectSingleUser();
	select();
	$lang_method = $_LANG['UPDATE'];
	$view_file = "user.tpl";
}
if ($method === 'select') {
	select();
	$lang_method = $_LANG['ADD'];	
	$view_file = "user.tpl";
}
/**
 * 获取表单修改信息
 */
function getField() {
	$user = new user();
	if (isset ($_POST['submit'])) {	
			if(isset($_POST['department_id'])){
				$user->department_id = $_POST['department_id'];
			}
			if (isset ($_POST['user_id']))
			{
				$user->user_id = $_POST['user_id'];
			}			
			if (isset ($_POST['user_login_name']))
			{
				$user->user_login_name = $_POST['user_login_name'];
 			}
			if (isset ($_POST['user_login_password']) == isset ($_POST['user_repeat_password']))
			{
					$user->user_login_password =$_POST['user_login_password'];
			}
			if (isset ($_POST['user_real_name']))
			{
				$user->user_real_name =$_POST['user_real_name']; 
			}
			if (isset ($_POST['user_email']))
			{
				$user->user_email = $_POST['user_email'];
			}
			if (isset ($_POST['user_phone']))
			{
				$user->user_phone = $_POST['user_phone'];
			}
			if (isset ($_POST['user_mobile']))
			{
				$user->user_mobile = $_POST['user_mobile'];
			}
			if (isset ($_POST['user_remark']))
			{
				$user->user_remark = $_POST['user_remark'];
			}
			$user->roleid=0;
	}else{
			$user->user_id = $_GET['user_id'];
	}
	return $user;
}

/**
 * 增加公司部门职员
 */
function add() {
	$user = getField();
	$user_id=$user->addDepartment();
	$user->update_User($user_id);
	header("location:user.php");
}
/*查询所有公司*/
/*
	 * 查询用户信息
	 * */
	function select()
	{
		$user = new user();
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
		$total =$user->countUser();
		$GLOBALS['page']->pageft($total,$GLOBALS['displaypg']);
		$item = $user->selectUser();
		//查询该公司下所有部门
		$department_arr=$user->selectDepartment();
		global $smarty;
		$smarty ->assign("item", $item);
		$smarty ->assign("department", $department_arr);
		$smarty->assign("nextpage",$GLOBALS['page']->getPagenav());
	}
	
	/*
	 * 删除一条职员信息
	 * */
	 function delete(){
	 	$user = getField();
	 	$user->deleteUser();
	 	header("location:user.php");
	 }
	 /*
	  * 查询一条职员信息
	  * */
	  function selectSingleUser(){
	  	$user = getField();
	  	$userObj=$user->AUserInquires();
	  		global $smarty;
		$smarty ->assign("userObj",$userObj);	 
		 }
	 /*
	  *修改一条职员信息 
	  * */
	 function user_update(){
	 	$user = getField();
	 	$user->updateUser();
	 	header("location:user.php");
	 }
	$smarty->assign("method", $method);
	$smarty->assign("lang_method", $lang_method);
	$smarty->display(admin_display($view_file));
?>