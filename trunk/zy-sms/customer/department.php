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
	$view_file = "company.tpl";
}
if ($method === 'addForward') {
	$lang_method = $_LANG['ADD'];	
	$method='add';
	select();
	$view_file = "company.tpl";
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
/**
 * 获取表单修改信息
 */
function getField() {
	$department = new department();
	if (isset ($_POST['submit'])) {	
			$department->department_name=$_POST['department_name'];
			$department->department_parent_id=$_POST['department_parent_id'];
			$department->remark = $_POST['remark'];
	}else{
		$department->department_id=$_GET['department_id'];
	}
	return $department;
}

/**
 * 添加公司信息
 */
function add() {
	$department = getField();
	$department_id=$department->add_Department();
	$department->update_Department($department_id);
	header("location:department.php");
}
/*查询所有公司*/
/*
	 * 查询用户信息
	 * */
	function select()
	{
		$department = new department();
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
		$total =$department->countDpartmetn();
		$GLOBALS['page']->pageft($total,$GLOBALS['displaypg']);
		$item = $department->selectDepartment();
		global $smarty;
		$smarty ->assign("item", $item);
		$smarty->assign("nextpage",$GLOBALS['page']->getPagenav());
	}
/*
 * 删除一条部门信息
 * */
 	function delete(){
 		$department = getField();
 		$department->deteleDpartment();
 		header("location:department.php");
 	}
 	
 	/*
 	 * 查询一个部门信息
 	 * */
 	 function selectSingleDpartment(){
 	 	$department = getField();
 	 	$departmentObj=$department->ADepartmentInquires();
 	 	global $smarty;
		$smarty ->assign("departmentObj",$departmentObj);
 	 }
	/*
	 * 修改一条部门信息
	 * 
	 * */
	 
	 function departmen_update(){
	 	$department = getField();
	 	$department->updateDepartment();
	 	header("location:department.php");
	 }
	$smarty->assign("method", $method);
	$smarty->assign("lang_method", $lang_method);
	$smarty->display(admin_display($view_file));
?>