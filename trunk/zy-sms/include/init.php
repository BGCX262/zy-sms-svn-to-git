<?php
/*
 * Created on 2011-8-28
 *======================================
 *Author: Allen
 *Project:health360
 *File: init.php  
 *Date: 2011-8-28
 *======================================
 */

 /*项目开发阶段使用*/
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
/*项目上线时不报告 NOTICE错误*/
//error_reporting(E_ALL);

if (__FILE__ == '')
{
    die('Fatal error code: 0');
}
session_start();


/* 取得当前project所在的根目录 */
define('ROOT_PATH', str_replace('include/init.php', '', str_replace('\\', '/', __FILE__)));
require(ROOT_PATH . 'config/config.php');

/* 载入MYSQL,初始化 */
require(ROOT_PATH . 'include/class/mysql_class.php');
$mysql=new MYSQL($db_host,$db_user, $db_pass, $db_name);
$GLOBALS['mysql']=$mysql;
/*分页参数*/
$displaypg =9;
$GLOBALS['displaypg']=$displaypg;
/* 主题选择 */
//此项目暂不实现该功能
if(empty($web_theme_name))
{
	$_SESSION['web_theme_name']=WEB_THEME_NAME;
}
if(empty($admin_theme_name))
{
	$_SESSION['admin_theme_name']=ADMIN_THEME_NAME;
}
if(empty($theme_path))
{
	$_SESSION['theme_path']=THEME_PATH;
}
require(ROOT_PATH . 'include/lib/common_lib.php');
/*后台主题路径*/
define('ADMIN_THEME',get_admin_theme());
/*后台CSS样式路径*/
define('ADMIN_STYLE',get_admin_theme()."/css");
/*后台image路径*/
define('ADMIN_IMAGE',get_admin_theme()."/image");
/*后台JS路径*/
define('ADMIN_JS',get_admin_theme()."/js");

/*前台台主题路径*/
define('WEB_THEME',get_web_theme());
/*前台CSS路径*/
define('WEB_CSS',get_web_theme()."/css");
/*前台image路径*/
define('WEB_IMAGE',get_web_theme()."/img");
/*前台JS路径 */
define('WEB_JS',get_web_theme()."/js");

/*语言包路径 */
define('LANGUAGE_PATH',ROOT_URL."/language/language.php");




/* 初始化设置 */
@ini_set('memory_limit',          '64M');
@ini_set('session.cache_expire',  180);
@ini_set('session.use_trans_sid', 0);
@ini_set('session.use_cookies',   1);
@ini_set('session.auto_start',    0);
@ini_set('display_errors',        1);

if (DIRECTORY_SEPARATOR == '\\')
{
    @ini_set('include_path', '.;' . ROOT_PATH);
}
else
{
    @ini_set('include_path', '.:' . ROOT_PATH);
}


if (defined('DEBUG_MODE') == false)
{
    define('DEBUG_MODE', 0);
}

if (PHP_VERSION >= '5.1' && !empty($timezone))
{
    date_default_timezone_set($timezone);
}
$php_self = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
if ('/' == substr($php_self, -1))
{
    $php_self .= 'index.php';
}
define('PHP_SELF', $php_self);

/*  限定语言项   */

$lang_array = array('english','chinese');
if(isset($_GET["language"])){
	$language=$_GET["language"];
	if (in_array($language,$lang_array))
	{
		$_SESSION['language']=$language;
	}
	else{
		$_SESSION['language'] = 'english';// 默认语言为英文
	}
}else if(!isset($_SESSION["language"])){
	$_SESSION['language'] = 'english';// 默认语言为英文
}

/* 载入语言文件 */
require(ROOT_PATH . 'language/' .$_SESSION['language'].'/'.ADMIN_PATH. '/common.php');


/* 载入Smarty木板引擎 */
require(ROOT_PATH . 'smarty/Smarty.class.php');
$smarty = new Smarty;

$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 120;

$smarty->assign("web_theme_name",$_SESSION['web_theme_name']);
$smarty->assign("admin_theme_name",$_SESSION['admin_theme_name']);
$smarty->assign("theme_path",$_SESSION['theme_path']);

//$smarty->assign("admin_theme",ADMIN_THEME);
$smarty->assign("admin_css",ADMIN_STYLE);
$smarty->assign("admin_image",ADMIN_IMAGE);
$smarty->assign("admin_js",ADMIN_JS);

//$smarty->assign("web_theme",WEB_THEME);
$smarty->assign("web_css",WEB_CSS);
$smarty->assign("web_image",WEB_IMAGE);
$smarty->assign("web_js",WEB_JS);

$smarty->assign("LANG",$_LANG);
$smarty->assign("CHARSET",CHARSET);
$smarty->assign("language",$_SESSION['language']);
$smarty->assign("LANGUAGE_PATH",LANGUAGE_PATH);
$smarty->assign("ROOT_URL",ROOT_URL);

$smarty->assign("admin_theme",$_SESSION['theme_path'].'/'.$_SESSION['admin_theme_name']);
$smarty->assign("web_theme",$_SESSION['theme_path'].'/'.$_SESSION['web_theme_name']);

/* 后台导航设置*/
/**
 * @param links_array( $title , $url , $submenu[0,1] , $menu_parent_id , $child_array )
 * @param child_array( $title , $url , $subment[0,1] , $menu_parent_id , $child_id )
 */
/* admin后台 */
$admin_link=array(
	//array($_LANG['MY_WORK '],"index.php",0,0,""),
	array($_LANG['SMS_MANAGEMENT'],"javascript:void(0);",1,2,array(
		array($_LANG['SEND_MESSAGE'],"message.php",0,2,1),
		array($_LANG['MANAGE_TEMPLATE'],"template.php",0,2,1),
		array($_LANG['SEND_HISTORY'],"send_history.php",0,2,1),
	
	)),
	array($_LANG['COMPANY_MANAGEMENT'],"javascript:void(0);",1,2,array(
		array($_LANG['MANAGE_COMPANY'],"company.php",0,2,1),	
	)),

	array($_LANG['CONTACT_MANAGEMENT'],"javascript:void(0);",1,2,array(
		array($_LANG['MANAGE_CONTACT'],"contact.php",0,2,1),
		array($_LANG['MANAGE_CONTACT_LIST'],"contact_list.php",0,2,2),
	)),
	array($_LANG['BILLING_MANAGEMENT'],"javascript:void(0);",1,1,array(
		
		array($_LANG['MANAGE_CREDIT'],"credit.php",0,1,2),
		array($_LANG['COMPANY_CHARGE'],"charge.php",0,1,2),
	)),
	array($_LANG['SYSTEM_MANAGEMENT'],"javascript:void(0);",1,3,array(		
		array($_LANG['MANAGE_ADMIN'],"admin.php",0,2,1),
		//array($_LANG['MANAGE_PAYMENTS'],"payment.php",0,2,1),
		array($_LANG['SET_UP_CHARGE'],"setUpCharge.php",0,2,1),
	)),
);
/* Customer后台 */
$customer_link=array(
	//array($_LANG['MY_WORK '],"index.php",0,0,""),
	array($_LANG['SMS_MANAGEMENT'],"javascript:void(0);",1,2,array(
		array($_LANG['SEND_MESSAGE'],"message.php",0,2,1),
		array($_LANG['MANAGE_TEMPLATE'],"template.php",0,2,1),
		array($_LANG['SEND_HISTORY'],"send_history.php",0,2,1),
		array($_LANG['MANAGER_API'],"userapi.php",0,2,1),
	)),
	array($_LANG['COMPANY_MANAGEMENT'],"javascript:void(0);",1,2,array(
		array($_LANG['MANAGE_COMPANY'],"company.php",0,2,1),
		//array($_LANG['MANAGE_PAYMENT'],"payment.php",0,2,1),
		
		
		array($_LANG['MANAGE_DEPARTMENT'],"department.php",0,2,1),
		array($_LANG['MANAGE_USER'],"user.php",0,2,1),
	
	)),

	array($_LANG['CONTACT_MANAGEMENT'],"javascript:void(0);",1,2,array(
		array($_LANG['MANAGE_CONTACT'],"contact.php",0,2,1),
		array($_LANG['MANAGE_CONTACT_LIST'],"contact_list.php",0,2,2),
		array($_LANG['MANAGE_CONTACT_IMPORT'],"contact_import.php",0,2,3),
	)),
	array($_LANG['BILLING_MANAGEMENT'],"javascript:void(0);",1,1,array(
		array($_LANG['BUY'],"buy.php",0,1,1),		
		array($_LANG['COMPANY_CHARGE'],"charge.php",0,1,2),
	)),

);
/* 载入相关类 */

/* 添加部门 */
require(ROOT_PATH . 'include/class/company_class.php');
/*添加部门*/
require(ROOT_PATH . 'include/class/department_class.php');
/*添加职员*/
require(ROOT_PATH . 'include/class/user_class.php');

/*分页类*/
require(ROOT_PATH . 'include/class/page_class.php');

/*消费记录*/
require(ROOT_PATH . 'include/class/charge_history_class.php');
/*管理员设置*/
require(ROOT_PATH . 'include/class/admin_class.php');
/*用户判断*/
require(ROOT_PATH . 'include/class/login_class.php');
/*添加钱包*/
require(ROOT_PATH . 'include/class/credit_class.php');
/*联系人列表*/
require(ROOT_PATH . 'include/class/contact_class.php');
/*短信发送*/
require(ROOT_PATH . 'include/class/message_class.php');
/*API*/
require(ROOT_PATH . 'include/class/api_class.php');
/* 设置收费标准 */
require(ROOT_PATH . 'include/class/setUpCharge_class.php');
if(!isset($_SESSION['token'])){
$token = mt_rand(0, 1000000);
$_SESSION['token'] = $token;
}


$currentPage=explode("/",curPageURL());

if($currentPage[count($currentPage)-1]!="login.php"&&$currentPage[count($currentPage)-2]!="api")
{
	$login=new login();
	$news=$login->checkLogined($currentPage[count($currentPage)-2]);
	
	if(!$news==true)
	{
		header("location:login.php");
	}else if($currentPage[count($currentPage)-2]=='customer'){
		//显示账户余额
		$company=new Company();
	$company->company_id=$_SESSION['user']['customer']->company_id;
	$balance=$company->getBalanceByCompanyId();
	$smarty->assign("balance",$balance);
	}
}
//根据用户角色显示导航
$smarty->assign("admin_menu",get_menu($admin_link));
$smarty->assign("customer_menu",get_menu($customer_link));
?>
