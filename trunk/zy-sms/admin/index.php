<?php
/*
 * Created on 2011-8-28
 *======================================
 *Author: Allen
 *Project:health360
 *File: index.php  
 *Date: 2011-8-28
 *======================================
 */

require('../include/init.php');
	
	if (empty ($method)) {
		$lang_method = $_LANG['ADD'];
		$method = 'select';
	}
	if ($method === 'select') {
		//history();
		$lang_method = $_LANG['ADD'];
		$view_file = "index.tpl";
	}
	/*
	 * 浏览记录
	 * 
	 * */
	 function history(){
	 	$history=new history();
	 	$history=$history->historyAll();
	 	global $smarty;
	 	$smarty->assign("history",$history);
	 }
$view_file = "index.tpl";
$smarty->display(admin_display($view_file));