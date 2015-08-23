<?php
/**
 * @FileName:contact_import.php
 * @Describe:TODO
 * @Author:Arthur
 * @Email:arthurkingtoo@foxmail.com
 * @Time:2012-5-6
 * @Version:V9.0
 */
require ('../include/init.php');
$method = $_GET['method'];
global $view_file;

if (empty ($method)) {
	$lang_method = $_LANG['ADD'];
	$method = 'select';
}
if ($method === 'select') {
	$method = 'select';
	select();
	$lang_method = $_LANG['SELECT'];
	$view_file = "contact_import.tpl";
}

/**
	 * 查询该公司所有联系人列表
	 * */
	function select()
	{
		$contact =new Contact();
		$contact->company_id=$_SESSION['user']['customer']->company_id;
		$contact->department_id=$_SESSION['user']['customer']->department_id;
		$contact->user_id=$_SESSION['user']['customer']->user_id;
//		$contact_list=$contact->selectCustomerContact();
		$contact_list=$contact->CountCustomerContact();
		
		global $smarty;
	
		$smarty ->assign("contact_list",$contact_list);
	}
	$smarty->assign("method", $method);
	$smarty->assign("lang_method", $lang_method);
	$smarty->display(admin_display($view_file));
?>