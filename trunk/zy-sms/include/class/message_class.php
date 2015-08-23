<?php
/*
 * Created on 2012-4-20
 *======================================
 *Author: Administrator
 *Project:zy-sms
 *File: message_class.php  
 *Date: 2012-4-20
 *======================================
 *TODO 
 *@param @type @var  @note
 *
 */
 class Message{
 	private $message_content;
 	private $contact_list_id;
 	private $norepeat;
 	private $userapi_id;
 	private $api_id;
 	private $sms_record_time;
 	private $sms_success_list;
 	private $sms_fail_list;
 	private $sms_success_count;
 	private $sms_fail_count;
 	private $sms_content;
 	private $user_id;
 	private $department_id;
 	private $company_id;
 	private $sms_record_remark;
 	private $isentry;
 	private $mobile_list;
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
 	 /**
 	  * 发送短信
 	  */
 	 function sendMessage(){ 	
 		$sql = "INSERT INTO `zy_sms_record`(`api_id`,`sms_record_time`,`sms_success_list`,`sms_fail_list`,`sms_success_count`,`sms_fail_count`,`sms_content`,`user_id`,`department_id`,`company_id`,`sms_record_remark`) VALUES ('$this->api_id','$this->sms_record_time','$this->sms_success_list','$this->sms_fail_list',$this->sms_success_count,$this->sms_fail_count,'$this->sms_content',$this->user_id,$this->department_id,$this->company_id,'$this->sms_record_remark')";
		$GLOBALS['mysql']->insert($sql,false);
 	}
 	 /**
 	 * 查询短信发送记录
 	 * */
 	function queryMessageHistory(){
 		$sql = "SELECT * FROM zy_sms_record where company_id=$this->company_id ORDER BY sms_record_id DESC  limit ".($GLOBALS['pages']-1)*$GLOBALS['displaypg'].",".$GLOBALS['displaypg'];
 		$arr=$GLOBALS['mysql']->select($sql);
	    return $arr;
	}
	/**
 	 * 查询短信发送记录
 	 * */
 	function countMessageHistory(){
 		$sql = "SELECT count(sms_record_id) count FROM zy_sms_record where company_id=$this->company_id";
 		$count=$GLOBALS['mysql']->selectId($sql);
	 	return $count->count;
	}
	
 }
?>
