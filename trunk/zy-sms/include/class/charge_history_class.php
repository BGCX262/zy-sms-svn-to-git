<?php
	/*
	 * Created on 2011-9-21
	 * @author arthur
	 * 2011-9-21
	 */
 
	 class charge
	 {
	 	private $category_id;
	 	private $charge_price;
	 	private $company_id;
	 	private $charge_start_date;
	 	private $charge_end_date;
	 	private $charge_count;
	 	
	 	//获取私有变量
		public function __get($allVariables)
		{
			if(isset($this->$allVariables))
			{
				return ($this->$allVariables);
			}
			else
			{
				return (null);
			}
		}
	 	//设置私有变量
		public function __set($allVariables,$value)
		{
			$this->$allVariables = $value;
		}
		/*
		 * 查询视频分类信息
		 * */
	 	function queryCharge()
	 	{
			$sql="SELECT * FROM zy_charge,zy_category WHERE zy_charge.category_id = zy_category.category_id ORDER BY charge_id DESC  limit ".($GLOBALS['pages']-1)*$GLOBALS['displaypg'].",".$GLOBALS['displaypg'];
	 		$arr=$GLOBALS['mysql']->select($sql);
	 		return $arr;
	 	}
	 	/*
	 	 * 购买视频
	 	 * */
	 	 function purchase(){
	 	 	$sql="insert into zy_charge (`company_id`,`category_id`,`charge_start_date`,`charge_count`,`charge_end_date`,`charge_price`)
				 values ($this->company_id,$this->category_id,'$this->charge_start_date',$this->charge_count,'$this->charge_end_date',$this->charge_price)";
				$GLOBALS['mysql']->insert($sql,false);
	 	 }
	 	 /*
	 	  * 查询公司购买视频记录
	 	  * */
	 	  function queryCompanyID(){
	 	  	$sql="select * from  zy_charge where company_id=$this->company_id";
	 	  	$chargeArr=$GLOBALS['mysql']->select($sql);
	 		return $chargeArr;
	 	  }
	 	  /*
	 	   *更新购买记录数
	 	   * 
	 	   * */
	 	   function updateCount(){
	 	   	$sql="update zy_charge set charge_count=$this->charge_count";
	 	   	$GLOBALS['mysql']->upadte($sql);
	 	   }
	 	/*
	 	 * 分页查询公司信息
	    * */
	    function queryPage()
	    {
	    	$sql="select * from zy_category";
	    	$rs = mysql_query($sql);
	    	return $rs;
	    }
	 }
?>