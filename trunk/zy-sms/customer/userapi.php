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
$view_file="userapi.tpl";


if (empty ($method)) {
	selectUserApi();
	$lang_method = $_LANG['ADD'];	
}

if ($method === 'updateUserAPI') {
	$method = 'update';	
	userapi_update();
	$lang_method = $_LANG['UPDATE'];
}
if ($method === 'addUserAPI') {
	addUserAPI();
	selectUserApi();
	$lang_method = $_LANG['ADD'];	
}
if ($method === 'deleteApi') {

	deleteUserAPI();
	selectUserApi();
	$lang_method = $_LANG['ADD'];
}


/**
 * 获取表单修改信息
 */
function getField() {
	$company = new company();
	if (isset ($_POST['submit'])) {		
				//$company->company_id=0;
				//$company->user_id=0;
				//$company->department_id=0;
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
			}else{
		$company->company_id=$_GET['company_id'];
		$company->companyUser_id = $_GET['user_id'];
		$company->userapi_id=$_GET['userapi_id'];	
	}
	return $company;
}


/**
 * 根据公司ID查询所有Api
 * */
function selectUserApi(){
	$company = getField();
	$company->company_id=$_SESSION["user"]["customer"]->company_id;
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
	$company->company_id=$_SESSION['user']['customer']->company_id;
	$company->api_status=2;
	$company->sender_status=4;
	$company->api_type=1;
	$company->api_id='0';
	$company->api_username='0';
	$company->api_password='0';
	$company_id=$company->addUserAPI();
	
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
	
}

	$smarty->assign("method", $method);
	$smarty->assign("lang_method", $lang_method);
	$smarty->display(admin_display($view_file));
?>