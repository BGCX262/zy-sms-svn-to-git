<?php
/*
 * Created on 2012-5-6
 *======================================
 *Author: Administrator
 *Project:zy-sms
 *File: send_history.php  
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
		$view_file = "send_history.tpl";
	}
	function select(){
		$message = new Message();
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
		$message->user_id=$_SESSION['user']['customer']->user_id;
		$message->company_id=$_SESSION['user']['customer']->company_id;
		$message->department_id=$_SESSION['user']['customer']->department_id;
		$total =$message->countMessageHistory();
		$GLOBALS['page']->pageft($total,$GLOBALS['displaypg']);
		$item=$message->queryMessageHistory();
		global $smarty;
		$smarty->assign("item", $item);
		$smarty->assign("nextpage",$GLOBALS['page']->getPagenav());
}

	$smarty->display(admin_display($view_file));
?>
