<?php
	/*
	 * Created on 2011-9-21
	 * @author arthur
	 * 2011-9-21
	 */
 
	 class category
	 {
	 	private $category_id;
	 	private $category_name;
	 	private $category_parent_id;
	 	private $category_sort;
	 	private $category_remark;
	 	
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
		 * 增加视频分类
		 * */
		function addCategory()
		{
			$sql="INSERT INTO `zy_category` (`category_name`,`category_parent_id`,`category_sort`,`remark`) VALUES ('$this->category_name','$this->category_parent_id','$this->category_sort','$this->category_remark')";
			$GLOBALS['mysql']->insert($sql,false);
		} 
		/*
		 * 查询视频分类信息
		 * */
	 	function queryCategory()
	 	{
	 		$sql = "SELECT * FROM zy_category ORDER BY category_id DESC LIMIT 0, 10";
//			$sql="select * from zy_category limit ".($GLOBALS['pages']-1)*$GLOBALS['displaypg'].",".$GLOBALS['displaypg'];
	 		$arr=$GLOBALS['mysql']->select($sql);
	 		return $arr;
	 	}
	 	/*
	 	 * 根据ID删除视频分类
	 	 * 
	 	 * */
	 	function deleteCategory()
	 	{
	 		$sql = "delete from zy_category where category_id=$this->category_id";
	 		$GLOBALS['mysql']->delete($sql);
	 	}
	 	
	 	/*
	 	 * 
	 	 * 修改视频分类
	 	 * 
	 	 * */
	 	function updateCategory()
	 	{
	 		$sql ="UPDATE `zy_category` SET  `category_name` ='$this->category_name',  `category_parent_id` ='$this->category_parent_id',  `category_sort` ='$this->category_sort',  `remark` ='$this->category_remark' WHERE `category_id`=$this->category_id";
	 		$GLOBALS['mysql']->upadte($sql);
	 	}
	 	/*
	 	 * 根据ID查询单个视频分类信息
	 	 * */
	 	 function queryCategoryID()
	 	 {
	 	 	$sql = "SELECT * FROM `zy_category` where `category_id`='$this->category_id'";
	 	 	$obj=$GLOBALS['mysql']->selectId($sql);
	 	 	return $obj;
	 	 }
	 	 /*
//	    * 分页查询公司信息
//	    * */
//	    function queryPage()
//	    {
//	    	$sql="select * from zy_category";
//	    	$rs = mysql_query($sql);
//	    	return $rs;
//	    }
	 }
?>