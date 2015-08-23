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
		$view_file = "contact.tpl";
	}
	if ($method === 'delete') {
		delete();
		$lang_method = $_LANG['ADD'];
	}
	if ($method === 'add') {
		add();
		$lang_method = $_LANG['ADD'];	
		$view_file = "contact.tpl";
	}
	if ($method === 'addForward') {
		$lang_method = $_LANG['ADD'];	
		$method='add';
		select();
		$view_file = "contact.tpl";
	}
	if ($method === 'updateForward')
	{
		$method = 'update';
		selectSingleContactPerson();
		select();
		$lang_method = $_LANG['UPDATE'];
		$view_file = "contact.tpl";
	}
	if ($method === 'select') {
		select();
		$lang_method = $_LANG['ADD'];	
		$view_file = "contact.tpl";
	}
	
	/**
	 * 获取表单修改信息
	 */
	function getField() {
		$contact = new contact();
		if (isset ($_POST['submit'])) {	
				$contact->contact_list = $_POST['contact_list_id'];
				$contact->contact_id=$_POST['contact_id'];
				$contact->contact_first_name=$_POST['contact_first_name'];
				$contact->contact_surname=$_POST['contact_surname'];
				$contact-> contact_email=$_POST['contact_email'];
				$contact->contact_mobile=$_POST['contact_mobile'];
				$contact->contact_phone=0;
				$contact->contact_title=$_POST['contact_title'];
				$contact->contact_create_time=date('Y-m-d H:i:m');
				$contact->contact_update_time=date('Y-m-d H:i:m');
				$contact-> contact_birth_date=$_POST['contact_birth_date'];
				$contact-> contact_country=0;
				$contact-> contact_state=0;
				$contact-> contact_city=0;
				$contact->contact_address=$_POST['contact_address'];
				$contact-> contact_remark=$_POST['contact_remark'];
				$contact->company_id=$_SESSION['user']['customer']->company_id;
				$contact->department_id=$_SESSION['user']['customer']->department_id;
				$contact->user_id=$_SESSION['user']['customer']->user_id;
				}else{
			$contact->contact_id=$_GET['contact_id'];
			$contact->company_id=$_SESSION['user']['customer']->company_id;
			$contact->department_id=$_SESSION['user']['customer']->department_id;
			$contact->user_id=$_SESSION['user']['customer']->user_id;
		}
		return $contact;
	}
	
	/**
	 * 添加公司信息
	 */
	function add() {
		$contact = getField();
		$number = count($_POST['contact_list_id']);
		if($number !=""){
		$contact->addContactPerson();
		}else{
			$contact->addNotGroup();
		}
		for($i=0;$i<$number;$i++){
			$id=$contact->contact_list[$i];
			$contact->updateContactListCount($id);
		}
		header("location:contact.php");
	}
	/*查询所有公司*/
	function select() {
		$contact = getField();
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
		$total =$contact->countContactPerson();
		$GLOBALS['page']->pageft($total,$GLOBALS['displaypg']);
		$item=$contact->queryContactPerson();
		$contact_list=$contact->selectCustomerContact();
		global $smarty;
		$smarty->assign("item", $item);
		$smarty->assign("contact_list", $contact_list);
		$smarty->assign("nextpage",$GLOBALS['page']->getPagenav());
	}
	/*删除一条记录*/
	function delete(){
		$contact = getField();
		$contact->deleteContactPerson();
		header("location:contact.php");
	}
	/*查询单个contact记录*/
	function selectSingleContactPerson(){
		$contact = getField();
		$contactObj=$contact->ADepartmentInquire();
		$contactList=explode('[]|[',$contactObj->contact_list);
		$contactLists=explode('|',$contactList[0]);
		for($i=0;$i<count($contactLists);$i++){
 			$contactListArr[]=substr($contactLists[$i],1,strlen($contactLists[$i])-2);
		}
		global $smarty;
		$smarty ->assign("contactObj",$contactObj);
		$smarty ->assign("contactList",$contactListArr);
	}
	/*
	 * 修改一条联系人列表记录
	 * */
	 function contactUpdate(){
	 	$contact = getField();
	 	$contact->updateContactPerson();
	 	header("location:contact.php");
	 }
	$smarty->assign("method", $method);
	$smarty->assign("lang_method", $lang_method);
	$smarty->display(admin_display($view_file));
?>