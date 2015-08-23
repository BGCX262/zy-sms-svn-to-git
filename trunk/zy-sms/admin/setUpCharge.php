<?php
/**
 * @Title:setUpCharge.php
 * @Project:
 * @Description:
 * Copyright: Copyright (c) 2013
 * Company:马鞍山市志业软件科技有限公司
 * Email:kingarthurx@sina.cn
 * @author: Comsys-Arthur
 * @date:2013-10-21 17:44:38
 * @version V1.0
 */
require ('../include/init.php');
$method = $_GET['method'];

$view_file="setUpCharge.tpl";
if (empty ($method)) {
		$lang_method = $_LANG['ADD'];
		$method = 'select';
	}
	if ($method === 'select') {
		select();
		$lang_method = $_LANG['ADD'];
		$view_file = "setUpCharge.tpl";
	}
	if ($method === 'update') {
		$method = 'update';
		update();
		$lang_method = $_LANG['UPDATE'];
		$view_file = "setUpCharge.tpl";
	}
	if ($method === 'add') {
		add();
		$lang_method = $_LANG['ADD'];
		$view_file = "setUpCharge.tpl";
	}
	if ($method === 'addForward') {
		$lang_method = $_LANG['ADD'];
		$method='add';
		select();
		$view_file = "setUpCharge.tpl";
	}
	if($method==='updateForward'){
		$method = 'update';
		select();
		$lang_method = $_LANG['UPDATE'];
		$view_file = "setUpCharge.tpl";
	}

/**
 * 获取表单修改信息
 */
function getField() {
	$setUpCharge = new setUpCharge();
	if (isset ($_POST['submit'])) {
		if (isset ($_POST['charge_id']))
		{
			$setUpCharge->charge_id = $_POST['charge_id'];

		}
		if (isset ($_POST['multiple'])) {
			$setUpCharge->multiple = $_POST['multiple'];
		}
		$setUpCharge->user_id=$_SESSION['user']['admin']->admin_id;
	}else{
		$setUpCharge->user_id=$_SESSION['user']['admin']->admin_id;
	}
	return $setUpCharge;
}

/**
 * 添加公司信息
 */
function add() {
	$setUpCharge = getField();
	$setUpChargeObj =$setUpCharge->queryCharge();
	if (!empty($setUpChargeObj->multiple)) {
		$setUpCharge=$setUpCharge->updateCharge();
	}else{
		$setUpCharge=$setUpCharge->addCharge();
	}

	header("location:setUpCharge.php");
}

/*
 * 查询一条公司记录
*
* */
function select()
{
	$setUpCharge = getField();
	$setUpChargeObj =$setUpCharge->queryCharge();
	global $smarty;
	$smarty ->assign("setUpChargeObj", $setUpChargeObj);
}

/*
 * 修改一条公司记录
* */
function company_update(){
	$setUpCharge = getField();
	$setUpCharge ->updateCharge();
	header("location:company.php");
}

$smarty->assign("method", $method);
$smarty->assign("lang_method", $lang_method);
$smarty->display(admin_display($view_file));
?>