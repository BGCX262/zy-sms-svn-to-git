<?php
/*
 * Created on 2011-10-12
 *======================================
 *Author: Allen
 *Project:health360
 *File: login.php  
 *Date: 2011-10-12
 *======================================
 *TODO 
 *@param @type @var  @note
 */
 	require('../include/init.php');
 	//是否登陆
 	if(isset($_SESSION['user']['customer'])){
		header("location:index.php");
	}
 	$view_file="admin_login.tpl";
 	 $method = $_GET['method'];
 	 
 		if ($method === 'check') {
				checkLogin();
				$lang_method = $_LANG['ADD'];
				$view_file = "admin_login.tpl";
		}
		if($method === 'out')
		{
			out();
		}
/*
  * 获取管理员信息
  * */
  
  function getAdminContent(){
	$login = new login();
  	if(isset($_POST['submit'])){
	  		if(isset($_POST['user_login_name'])){
	  		 $login->user_login_name=$_POST['user_login_name'];
		  	}
		  	if(isset($_POST['user_login_password'])){
		  		$login->user_login_password=$_POST['user_login_password'];
		  	}
		  	
		  	$login->group=$_POST['group'];
		  	$login->login_by_params=$_POST['login_by_params'];
  }else{
		$login->user_id=$_GET['user_id'];
		$login->group=$_GET['group'];
		$login->login_by_params=$_GET['login_by_params'];
		$login->company_id=$_GET['company_id'];
		
  	}
  	return $login;
  }
  
  function checkLogin()
  {
  	$login = getAdminContent();
  	$message=$login->check();
  	global $smarty;
	global $_LANG;
  		if($message[0]=="")
		{
			echo "!!!";die();
			$smarty ->assign("user",$_SESSION['user']);
			header("location:index.php");
		}
		else
		{
			echo "???";die();
			if($message[0]==1){
			$smarty ->assign("login_name_error_message",$_LANG['ERROR_USER_PASSWORD_MESSAGE']);
			}else if($message[0]==2){
				$smarty ->assign("password_error_message",$_LANG['ERROR_PASSWORD_MESSAGE']);
			}
		}
  }
  /*退出后台*/
  function out()
  {
  	unset($_SESSION['user']['customer']);
  	header("location:login.php");
  }
	$smarty->display(admin_display($view_file));
?>
