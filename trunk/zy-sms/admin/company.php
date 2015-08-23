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

$view_file="company.tpl";
if (empty ($method)) {
	$lang_method = $_LANG['ADD'];
	$method = 'select';
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
if ($method === 'updateUserAPI') {
	$method = 'update';
	
	userapi_update();
	$lang_method = $_LANG['UPDATE'];
	$view_file = "userapi.tpl";
}
if ($method === 'addUserAPI') {
	addUserAPI();
	$lang_method = $_LANG['ADD'];	
	$view_file = "userapi.tpl";
}
if ($method === 'deleteApi') {

	deleteUserAPI();
	$lang_method = $_LANG['ADD'];
	$view_file = "userapi.tpl";
}
if($method === 'fill'){
	addInfo();
	$lang_method = $_LANG['ADD'];
	$view_file = "company.tpl";
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
				//$company->company_id=0;
				$company->user_id=0;
				$company->department_id=0;
				$company->roleid="0";
				
				$company->api_username=$_POST['api_username'];
				$company->api_password=$_POST['api_password'];
				$company->api_id=$_POST['api_id'];
				$company->api_status=$_POST['api_status'];
				$company->userapi_remark=$_POST['userapi_remark'];
				$company->companyUser_id = $_POST['user_id'];
				$company->userapi_id=$_POST['userapi_id'];
				$company->sender_name=$_POST['sender_name'];
				$company->sender_status=$_POST['sender_status'];
				$company->contact_list_create_time=date('Y-m-d');
				$company->contact_list_update_time=date('Y-m-d');
				$company->contact_list_count=0;
				$company->agent_id=0;
				$company->sender_motivation=$_POST['sender_motivation'];
				
				/**info属性*/
				$company->balance=$_POST['bulance'];
				$company->type=$_POST['cc_type'];
				$company->number=$_POST['cc_number'];
				$company->name=$_POST['cc_name'];
				$company->expirydate=$_POST['cc_expirydate'];
				$company->bsbnumber=$_POST['dd_bsbnumber'];
				$company->accountnumber=$_POST['dd_accountnumber'];
				$company->accountname=$_POST['dd_accountname'];
				$company->defaultpay=$_POST['defaultpay'];
				
			}else{
		$company->company_id=$_GET['company_id'];
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
	$company->addContactList($user_id,$company_id,$department_id);//添加未分组
	
	 /*********添加默认send id************/
	 $company->company_id=$company_id;
	$company->api_status=2;
	$company->sender_status=4;
	$company->api_type=0;
	$company->api_id='0';
	$company->api_username='0';
	$company->api_password='0';
	$company->addUserAPI();
	/*********添加余额************/
	$company->addPaymentInfo();
	
	header("location:company.php");
}
/**
 * 添加 info 信息
 */
 function addInfo(){
 $company = getField();
 /*********添加余额************/
	$company->updatePaymentInfo();
	header("location:company.php");
 }
 
/*查询所有公司*/
function select() {
	$company = new company();
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
	$total =$company->countCompany();
	$GLOBALS['page']->pageft($total,$GLOBALS['displaypg']);
	$item=$company->queryCompany();
	global $smarty;
	$smarty->assign("item", $item);
	$smarty->assign("nextpage",$GLOBALS['page']->getPagenav());
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
	$total =$company->countUserAPI();
	$GLOBALS['page']->pageft($total,$GLOBALS['displaypg']);
	$item=$company->queryUserApi();
	global $smarty;
	$smarty->assign("item", $item);
	$smarty->assign("nextpage",$GLOBALS['page']->getPagenav());
	$smarty ->assign("companyObj", $company);
}
/**
 * 添加USER API
 */
function addUserAPI() {
	$company = getField();
	
	$company->api_type=1;
	$company->addUserAPI();
	header("location:company.php?method=setApi&company_id=$company->company_id");
}
/**
 * 查询一条UESR API记录
 */
 function queryUserApiById(){
 	$company = getField();
	$companyObj =$company->queryUserApiById();
	//当sender处于审核状态且不是系统默认时,自动将默认sender的帐号密码赋上去
	if($companyObj->sender_status==4&&$companyObj->api_type!=0){
		$company->company_id=$companyObj->company_id;
		$companyDefault=$company->queryDefaultUserApi();	
		$companyObj->api_username=$companyDefault->api_username;
		$companyObj->api_password=$companyDefault->api_password;
	}
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
	header("location:company.php");
}
/**
 * 修改一条userpai记录
 * */
function userapi_update(){
	$company = getField();
	$company ->updateUserAPI();
	header("location:company.php?method=setApi&company_id=$company->company_id");
}	
/**
 * 删除一条userpai记录
 * */
function deleteUserAPI(){
	$company = getField();
	$company ->deleteUserAPI();
	header("location:company.php?method=setApi&company_id=$company->company_id");
}

	$smarty->assign("method", $method);
	$smarty->assign("lang_method", $lang_method);
	$smarty->display(admin_display($view_file));
?>