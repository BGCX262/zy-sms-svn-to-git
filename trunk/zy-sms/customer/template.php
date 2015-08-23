<?php
/*
 * Created on 2012-5-6
 *======================================
 *Author: Administrator
 *Project:zy-sms
 *File: template.php  
 *Date: 2012-5-6
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
if ($method === 'select') {
	select();
	$view_file = "underline.tpl";
}
function select(){

}

	$smarty->display(admin_display($view_file));
?>
