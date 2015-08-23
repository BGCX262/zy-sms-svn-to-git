<?php
/*
 * --------------------
 * Created on 2011-10-20
 * @author arthur
 * email:15215557835@qq.com
 * --------------------
 */

class credit{
 	private $credit_id;
 	private $credit_name;
 	private $credit_volume;
 	private $credit_price;
 	private $credit_currency='AUD'; 	
 	private $credit_sort=0;
 	private $credit_status;//钱包状态 1:停用,2:启用,3:删除
 	private $credit_remark;

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

 	/*
 	 *添加钱包
 	 * */
 	function addCredit(){ 	
 		$sql = "INSERT INTO `zy_credit`(`credit_name`,`credit_volume`,`credit_price`,`credit_currency`,`credit_status`,`credit_sort`,`credit_remark`)VALUES ('$this->credit_name','$this->credit_volume',$this->credit_price,'$this->credit_currency',$this->credit_status,$this->credit_sort,'$this->credit_remark')";
		$GLOBALS['mysql']->insert($sql,false);
 	}
 	/*
 	 * 根据Id号删除钱包.其实就是修改钱包状态
 	 * */
 	function deleteCredit(){
 		$sql = "update zy_credit set credit_status=3 where credit_id='$this->credit_id'";
 		$GLOBALS['mysql']->delete($sql);
 	}
 	/*
 	 * 修改钱包
 	 * */
 	function updateCredit(){
 		$sql = "update zy_credit set credit_name='$this->credit_name',credit_volume='$this->credit_volume',credit_price='$this->credit_price',credit_currency='$this->credit_currency',credit_status='$this->credit_status',credit_sort='$this->credit_sort',credit_remark='$this->credit_remark' where credit_id='$this->credit_id'";

	    $GLOBALS['mysql']->upadte($sql);
 	}
 	/**
 	 * 查询所有钱包
 	 * */
 	function queryCredit(){
 		$sql = "SELECT * FROM zy_credit where credit_status<>3 ORDER BY credit_id DESC limit ".($GLOBALS['pages']-1)*$GLOBALS['displaypg'].",".$GLOBALS['displaypg'];;
 		$arr=$GLOBALS['mysql']->select($sql);
	    return $arr;
	}
	 	/**
 	 * 根据Id号查询单个钱包信息
 	 * */

 	function queryCreditId(){
 		$sql = "select * from zy_credit where credit_id='$this->credit_id'";
 		$obj=$GLOBALS['mysql']->selectId($sql);
	 	return $obj;
 	}
	function countCredit(){
		$sql="select count(credit_id) count from zy_credit where credit_status<>3";
		$arr=$GLOBALS['mysql']->selectId($sql);		
		return $arr->count;
	}
}
?>