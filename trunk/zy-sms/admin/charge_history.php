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
$login=new login();
	$news=$login->checkLogined();
if (empty ($method)) {
	$lang_method = $_LANG['ADD'];
	$method = 'select';
}
if ($method === 'select') {
	select();
	$lang_method = $_LANG['ADD'];	
	$view_file = "charge.tpl";
}
function select() {
	$charge = new charge();
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
	$rs =$charge->queryPage();
	$totle =mysql_num_rows($rs);
	$GLOBALS['page']->pageft($totle,$GLOBALS['displaypg']);
	$item=$charge->queryCharge();
	global $smarty;
	$smarty->assign("item", $item);	
	$smarty->assign("nextpage",$GLOBALS['page']->getPagenav());
}
	$smarty->assign("method", $method);
	$smarty->assign("lang_method", $lang_method);
	$smarty->display(admin_display($view_file));
?>