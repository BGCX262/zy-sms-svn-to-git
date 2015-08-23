<?php
/**
 * @Title:setUpCharge_class.php
 * @Project:
 * @Description:
 * Copyright: Copyright (c) 2013
 * Company:马鞍山市志业软件科技有限公司
 * Email:kingarthurx@sina.cn
 * @author: Comsys-Arthur
 * @date:2013-10-22 09:16:59
 * @version V1.0
 */
class setUpCharge {
	//company属性
	private $charge_id;
	private $user_id;
	private $multiple;


	//__get()方法来获取私有属性
	public function __get($property_name) {
		if (isset ($this-> $property_name)) {
			return ($this-> $property_name);
		} else {
			return (NULL);
		}
	}
	//__set()方法用来设置私有属性
	public function __set($property_name, $value) {
		$this-> $property_name = $value;
	}
	
	/**
	 * 添加一条记录
	 * @return unknown
	 */
	public function addCharge(){
		$sql="INSERT INTO `zy_set_up_charge`(`user_id`,`multiple`) VALUES ('$this->user_id','$this->multiple')";
		$charge_id=$GLOBALS['mysql']->insert($sql, true);
		return $charge_id;
	}
	
	/**
	 * 查询记录
	 */
	public function queryCharge(){
		$sql="SELECT * FROM `zy_set_up_charge` where user_id=".$this->user_id." LIMIT 0, 1";
		$obj=$GLOBALS['mysql']->selectId($sql);
	   	return $obj;
	}
	
	/**
	 * 更新一条记录
	 */
	public function updateCharge(){
		$sql="UPDATE `zy_set_up_charge` SET  `multiple` = '$this->multiple' WHERE `user_id` = '$this->user_id'";
		$GLOBALS['mysql']->upadte($sql);
	}
	/**
	 * 查询一条记录
	 */
	public function selectCharge(){
		$sql="SELECT * FROM `zy_set_up_charge` LIMIT 0, 1";
		$obj=$GLOBALS['mysql']->selectId($sql);
		return $obj;
	}


}