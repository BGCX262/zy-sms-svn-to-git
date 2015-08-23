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

if (empty ($method)) {
	$lang_method = $_LANG['ADD'];
	$method = 'select';
}
if ($method === 'select') {

	$view_file = "underline.tpl";
}

	$smarty->display(admin_display($view_file));
?>