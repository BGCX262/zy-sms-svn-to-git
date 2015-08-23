<?php
/*
 * --------------------
 * Created on 2011-11-4
 * @author arthur
 * email:15215557835@qq.com
 * --------------------
 */
 class department{
 		private $department_id;
 		private $company_id;
 		private $department_name;
 		private $department_parent_id;
 		private $remark;
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
   * 增加公司部门
   * 
   * */
  function add_Department(){
  		//$sql="update zy_department set department_name='$this->department_name',department_parent_id=$this->department_parent_id,remark='$this->remark' where company_id=".$_SESSION['user']['customer']->company_id;
  		$sql="insert into zy_department (`department_name`,`department_parent_id`,`remark`) values ('$this->department_name','$this->department_parent_id','$this->remark')";
  		$department_id=$GLOBALS['mysql']->insert($sql,true);
  		return $department_id;
  }
  function update_Department($department_id){
  		$sql="update zy_department set  company_id=".$_SESSION['user']['customer']->company_id." where department_id=".$department_id ;
  		echo $sql;
  		$GLOBALS['mysql']->upadte($sql);
  }
  /*
   * 删除一条部门信息
   * */
   function deteleDpartment(){
   		$sql="delete from zy_department where department_id='$this->department_id' and company_id=".$_SESSION['user']['customer']->company_id;
   		$GLOBALS['mysql']->delete($sql);
   }
  /*
   * 查询部门信息总数
   * */
   function countDpartmetn(){
   		$sql="select count(department_id) as count from zy_department where company_id=".$_SESSION['user']['customer']->company_id;
   		$COUNT=$GLOBALS['mysql']->selectId($sql);
   		return $COUNT->count;
   }
   /*
    * 查询公司下的所有部门,并分页
    * */
    function selectDepartment(){
    	$sql="SELECT * FROM zy_department where company_id=".$_SESSION['user']['customer']->company_id." ORDER BY department_id ASC  limit ".($GLOBALS['pages']-1)*$GLOBALS['displaypg'].",".$GLOBALS['displaypg'];
    	$arr=$GLOBALS['mysql']->select($sql);
	    return $arr;
    }
    /*
     * 查询一个部门信息
     * */
     function ADepartmentInquires(){
     	$sql="select zy_department.* from zy_department where department_id='$this->department_id'";
     	$department_arr=$GLOBALS['mysql']->selectId($sql);
     	return $department_arr;
     }
     
     /*
      * 修改一条部门信息
      * */
      function updateDepartment(){
      	$sql="update zy_department set department_name='$this->department_name',department_parent_id=$this->department_parent_id,remark='$this->remark' where company_id=".$_SESSION['user']['customer']->company_id;
  		$GLOBALS['mysql']->upadte($sql);
      }
 }
?>
