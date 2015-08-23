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
	
	if (empty ($method)) {
		$lang_method = $_LANG['ADD'];
		$method = 'select';
	}
	if ($method === 'update') {
		$method = 'update';
		contactUpdate();
		$lang_method = $_LANG['UPDATE'];
		$view_file = "contact_list.tpl";
	}
	if ($method === 'delete') {
		delete();
		$lang_method = $_LANG['ADD'];
	}
	if ($method === 'add') {
		add();
		$lang_method = $_LANG['ADD'];	
		$view_file = "contact_list.tpl";
	}
	if ($method === 'addForward') {
		$lang_method = $_LANG['ADD'];	
		$method='add';
		select();
		$view_file = "contact_list.tpl";
	}
	if ($method === 'updateForward')
	{
		$method = 'update';
		selectSingleContactList();
		select();
		$lang_method = $_LANG['UPDATE'];
		$view_file = "contact_list.tpl";
	}
	if ($method === 'select') {
		select();
		$lang_method = $_LANG['ADD'];	
		$view_file = "contact_list.tpl";
	}
	
	
	/**
	 * 获取表单修改信息
	 */
	function getField() {
		$contact = new contact();
		if (isset ($_POST['submit'])) {	
				$contact->contact_list_id=$_POST['contact_list_id'];
				$contact->contact_list_name=$_POST['contact_list_name'];
				$contact->contact_list_count=0;
				$contact->agent_id=0;
				if(empty($_SESSION['user']['admin']->company_id)){
					$contact->company_id=0;
					$contact->department_id=0;
					$contact->user_id=0;
				}
				$contact->contact_list_create_time=date('Y-m-d H:i:m');
				$contact->contact_list_update_time=date('Y-m-d H:i:m');
				$contact->contact_list_remark=$_POST['contact_list_remark'];
				}else{
			$contact->contact_list_id=$_GET['contact_list_id'];
		}
		return $contact;
	}
	
	/**
	 * 添加公司信息
	 */
	function add() {
		$contact = getField();
		$company_id=$contact->addContact();
		header("location:contact_list.php");
	}
	/*查询所有公司*/
	function select() {
		$contact = new contact();
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
		$total =$contact->countContact();
		$GLOBALS['page']->pageft($total,$GLOBALS['displaypg']);
		$item=$contact->queryAdminContact();
		global $smarty;
		$smarty->assign("item", $item);
		$smarty->assign("nextpage",$GLOBALS['page']->getPagenav());
	}
	/*删除一条记录*/
	function delete(){
		$contact = getField();
		$contact->deleteContact();
		header("location:contact_list.php");
	}
	/*查询单个contact list记录*/
	function selectSingleContactList(){
		$contact = getField();
		$contactObj=$contact->ADepartmentInquires();
		global $smarty;
		$smarty ->assign("contactObj",$contactObj);
	}
	/*
	 * 修改一条联系人列表记录
	 * */
	 function contactUpdate(){
	 	$contact = getField();
	 	$contact->updateContact();
	 	header("location:contact_list.php");
	 }

	$smarty->assign("method", $method);
	$smarty->assign("lang_method", $lang_method);
	$smarty->display(admin_display($view_file));
?>