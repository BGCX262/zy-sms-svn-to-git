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
	$method = $_GET['method'];
	$login=new login();
	$news=$login->checkLogined();
	if (empty ($method)) {
		$lang_method = $_LANG['ADD'];
		$method = 'select';
	}
	if ($method === 'select') {
		select();
		$lang_method = $_LANG['ADD'];
		$view_file = "category.tpl";
	}
	if ($method === 'update') {
		$method = 'update';
		update();
		$lang_method = $_LANG['UPDATE'];
		$view_file = "category.tpl";
	}
	if ($method === 'delete') {
		delete();
		$lang_method = $_LANG['ADD'];
	}
	if ($method === 'add') {
		add();
		$lang_method = $_LANG['ADD'];
		$view_file = "category.tpl";
	}
	if ($method === 'addForward') {
		$lang_method = $_LANG['ADD'];
		$method='add';
		select();
		$view_file = "category.tpl";
	}
	if($method==='updateForward'){
		$method = 'update';
		selectID();
		select();
		$lang_method = $_LANG['UPDATE'];
		$view_file = "category.tpl";
	}

	/*
	 * 获取表单信息
	 * 
	 * */
	 function getFormContent()
	 {
	 	$category = new category();
	 		if(isset($_POST['submit']))
	 		{
	 			if (isset($_POST['category_id']))
	 			{
	 				$category ->category_id = $_POST['category_id'];
	 			}
	 			if (isset($_POST['category_name']))
	 			{
	 				$category->category_name = $_POST['category_name'];
	 			}
	 			if (isset($_POST['category_remark']))
	 			{
	 				$category->category_remark = $_POST['category_remark'];
	 			}
	 			$category->category_parent_id = 0;
	 			$category->category_sort = 10;
	 		}
	 		else
	 		{
	 			$category->category_id=$_GET['category_id'];
	 		}
	 		return $category;
	 }
	/**
	 * 添加视频分类信息
	 */
	function add() {
		$category = getFormContent();
		$category->addCategory();
		header("location:category.php");
	}
	/*
	 * 查询视频分类信息
	 * */
	function select()
	{
		$category = new category();
		$item = $category->queryCategory();
		global $smarty;
		$smarty ->assign("item", $item);
	}
	/*
	 * 根据ID查询视频分类信息
	 * */
	 function selectID()
	 {
	 	$category = getFormContent();
		$categoryObj = $category->queryCategoryID();
		global $smarty;
		$smarty ->assign("categoryObj", $categoryObj);
	 }
	/*
	 * 删除视频分类信息
	 * */
	function delete()
	{
		$category = getFormContent();
		$category ->deleteCategory();
		header("location:category.php");
	}
	/*
	 * 修改视频分类
	 * */
	function update()
	{
		$category = getFormContent();
		$category ->updateCategory();
		header("location:category.php");
	}
	$smarty->assign("method", $method);
	$smarty->assign("lang_method", $lang_method);
	//分页
//	$smarty->assign("nextpage",$GLOBALS['page']->getPagenav());
	$smarty->display(admin_display($view_file));

?>
