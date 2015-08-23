<?php
/*
 * Created on 2012-4-20
 *======================================
 *Author: Administrator
 *Project:zy-sms
 *File: payment.php  
 *Date: 2012-4-20
 *======================================
 *TODO 
 *@param @type @var  @note
 */
 require ('../include/init.php');
$method = $_GET['method'];
global $view_file;

if (empty ($method)) {
	$method = 'select';
}
if ($method === 'update') {
	$method = 'update';
	departmen_update();
	$lang_method = $_LANG['UPDATE'];
	$view_file = "department.tpl";
}
if ($method === 'delete') {
	delete();
	$lang_method = $_LANG['ADD'];
}
if ($method === 'add') {
	add();
	$lang_method = $_LANG['ADD'];	
	$view_file = "message.tpl";
}
if ($method === 'addForward') {
	$lang_method = $_LANG['ADD'];	
	$method='add';
	select();
	$view_file = "message.tpl";
}
if ($method === 'updateForward')
{
	$method = 'update';
	selectSingleDpartment();
	select();
	$lang_method = $_LANG['UPDATE'];
	$view_file = "department.tpl";
}
if ($method === 'select') {
	select();
	$lang_method = $_LANG['ADD'];	
	$view_file = "department.tpl";
}
function select(){
	
}
?>
