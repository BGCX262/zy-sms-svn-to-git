<?php
	class api_class{
	private $mobile;
	private $username;
	private $password;
	private $api_id;
	private $text;
	private $cost;
	
	 /*
 	 * 获取私有变量
 	 * */
 	 public function __get($allVariables){
 	 	if(isset($this->$allVariables)){
 	 		return $this->$allVariables;
 	 	}
 	 	else
 	 	{
 	 		return null;
 	 	}
 	 }
 	/*
 	 * 设置私有变量
 	 * */
 	 public function __set($allVariables,$value){
 	 	$this->$allVariables = $value;
 	 }
 	 function checkAPI(){
 	 	$sql="SELECT a.`company_id`,a.`department_id`,a.`user_id`,b.api_username,b.api_password,b.api_id,b.api_type,b.sender_name,c.balance  FROM zy_user a,zy_userapi b,zy_info c WHERE a.`user_login_name`='$this->username' AND a.`user_login_password`='$this->password' AND  b.`company_id`=a.`company_id` AND  b.`company_id`=c.`company_id` AND b.`userapi_id`='$this->api_id' AND b.`api_status`=2";
 	 	$arr=$GLOBALS['mysql']->selectId($sql);		
 	 	return $arr;
 	 }
}