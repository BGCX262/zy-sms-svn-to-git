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
	$lang_method = $_LANG['UPDATE'];
	$method = 'updateForward';
}
if ($method === 'update') {
	$method = 'update';
	company_update();
	$lang_method = $_LANG['UPDATE'];
	$view_file = "company.tpl";
}
if ($method === 'delete') {
	delete();
	$lang_method = $_LANG['ADD'];
}
if ($method === 'add') {
	add();
	$lang_method = $_LANG['ADD'];	
	$view_file = "company.tpl";
}
if ($method === 'addForward') {
	$lang_method = $_LANG['ADD'];	
	$method='add';
	select();
	$view_file = "company.tpl";
}
if ($method === 'updateForward')
{
	$method = 'update';
	selectID();
	select();
	$lang_method = $_LANG['UPDATE'];
	$view_file = "company.tpl";
}
if ($method === 'select') {
	select();
	$lang_method = $_LANG['ADD'];	
	$view_file = "company.tpl";
}
if ($method === 'setApi') {
	selectUserApi();
	$lang_method = $_LANG['ADD'];	
	$view_file = "userapi.tpl";
}
if ($method === 'updateAPIForward') {
	queryUserApiById();
	$lang_method = $_LANG['UPDATE'];
	$method = 'update';	
	$view_file = "userapi.tpl";
}
/**
 * 获取表单修改信息
 */
function getField() {
	$company = new company();
	if (isset ($_POST['submit'])) {	
			if (isset ($_POST['company_id']))
			{
				$company->company_id = $_POST['company_id'];
			}			
			if (isset ($_POST['company_name'])) {
				$company->company_name = $_POST['company_name'];
			}
			if (isset ($_POST['company_address'])) {
				$company->company_address = $_POST['company_address'];
			}
			if (isset ($_POST['company_phone'])) {
				$company->company_phone = $_POST['company_phone'];
			}
			if (isset ($_POST['company_remark'])) {
				$company->company_remark = $_POST['company_remark'];
			}
			if (isset ($_POST['user_login_name']))
			{
				$company->user_login_name = $_POST['user_login_name'];
 			}
			if (isset ($_POST['user_login_password']) == isset ($_POST['user_repeat_password']))
			{
					$company->user_login_password =$_POST['user_login_password'];
			}
			if (isset ($_POST['user_real_name']))
			{
				$company->user_real_name =$_POST['user_real_name']; 
			}
			if (isset ($_POST['user_email']))
			{
				$company->user_email = $_POST['user_email'];
			}
			if (isset ($_POST['user_phone']))
			{
				$company->user_phone = $_POST['user_phone'];
			}
			if (isset ($_POST['user_mobile']))
			{
				$company->user_mobile = $_POST['user_mobile'];
			}
			if (isset ($_POST['user_remark']))
			{
				$company->user_remark = $_POST['user_remark'];
			}
			$company->api_username=$_POST['api_username'];
			$company->api_password=$_POST['api_password'];
			$company->api_id=$_POST['api_id'];
			$company->api_status=$_POST['api_status'];
			$company->userapi_remark=$_POST['userapi_remark'];
			$company->department_id=0;
			$company->roleid="0";
			$company->companyUser_id = $_POST['user_id'];
			$company->userapi_id=$_POST['userapi_id'];	
			$company->company_id=$_SESSION['user']['customer']->company_id;
			//$company->company_id=0;
			$company->user_id=0;
			$company->department_id=0;
			$company->contact_list_create_time=date('Y-m-d');
			$company->contact_list_update_time=date('Y-m-d');
			$company->contact_list_count=0;
			$company->agent_id=0;
	}else{
		$company->company_id=$_SESSION['user']['customer']->company_id;
		$company->companyUser_id = $_GET['user_id'];
		$company->userapi_id=$_GET['userapi_id'];	
	}
	return $company;
}

/**
 * 添加公司信息
 */
function add() {
	$company = getField();
	$company_id=$company->addCompany();
	$user_id=$company->addUser($company_id);
	$department_id=$company->addDepartmentCompanyId($company_id);
	$company->updateCompanyCompanyId($user_id,$company_id);
	$company->updateUserDepartmentId($company_id,$department_id);
//	$GLOBALS['company_id']=$result;
	header("location:company.php");
}
/*查询所有公司*/
function select() {
//	$company = new company();
//	if(isset($_GET['page']))
//	{
//	$pages = $_GET['page'];
//	}
//	else
//	{
//	$pages = 1;
//	}
//	$GLOBALS['pages'] = $pages;
//	$page = new page($pages);
//	$GLOBALS['page']=$page;
//	$rs =$company->queryPage();
//	$totle =mysql_num_rows($rs);
//	$GLOBALS['page']->pageft($totle,$GLOBALS['displaypg']);
//	$item=$company->queryCompany();
//	global $smarty;
//	$smarty->assign("item", $item);
//	$smarty->assign("nextpage",$GLOBALS['page']->getPagenav());
}
;
/**
 * 根据公司ID查询所有Api
 * */
function selectUserApi(){
	$company = getField();
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
	$rs =$company->queryPage();
	$totle =mysql_num_rows($rs);
	$GLOBALS['page']->pageft($totle,$GLOBALS['displaypg']);
	$item=$company->queryUserApi();
	global $smarty;
	$smarty->assign("item", $item);
	$smarty->assign("nextpage",$GLOBALS['page']->getPagenav());
	$smarty ->assign("companyObj", $company);
}
/**
 * 查询一条UESR API记录
 */
 function queryUserApiById(){
 	$company = getField();
	$companyObj =$company->queryUserApiById();
	global $smarty;
	$smarty ->assign("companyObj", $companyObj);
 }
/*
 * 查询一条公司记录
 * 
 * */
function selectID()
{
	$company = getField();
	$companyObj =$company->queryCompanyID();
	global $smarty;
	$smarty ->assign("companyObj", $companyObj);
}
///*
// * 删除一条公司记录
// * */
//function delete(){
//	$company = getField();
//	$company->deleteCompany();
//	header("location:company.php");
//}

/*
 * 修改一条公司记录
 * */
function company_update(){
	$company = getField();
	$company ->updateCompany();
	//$company->addContactList();//添加未分组
	header("location:company.php");
}
	
	$smarty->assign("method", $method);
	$smarty->assign("lang_method", $lang_method);
	$smarty->display(admin_display($view_file));
?>