<?php
/*
 * --------------------
 * Created on 2011-11-4
 * @author arthur
 * email:15215557835@qq.com
 * --------------------
 */
 class user{
 		private $user_id;
 		private $company_id;
 		private $department_id;
 		private $user_login_name;
 		private $user_login_passowrd;
 		private $roleid;
 		private $user_real_name;
 		private $user_email;
 		private $user_phone;
 		private $user_mobile;
 		private $user_remark;
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
   * 增加公司部门职员
   * 
   * */
  function addDepartment(){
  		$sql="insert into zy_user (`department_id`,`user_login_name`,`user_login_password`,`roleid`,`user_real_name`,`user_email`,`user_phone`,`user_mobile`,`user_remark`)" .
  				" values ('$this->department_id','$this->user_login_name','$this->user_login_password','$this->roleid','$this->user_real_name','$this->user_email','$this->user_phone','$this->user_mobile','$this->user_remark')";
  		$user_id=$GLOBALS['mysql']->insert($sql,true);
  		return $user_id;
  }
  function update_User($user_id){
  		$sql="update zy_user set  company_id=".$_SESSION['user']['customer']->company_id." where user_id=".$user_id ;
  		$GLOBALS['mysql']->upadte($sql);
  }
  /*
   * 删除一条职员信息
   * */
   function deleteUser(){
   		$sql="delete from zy_user where user_id='$this->user_id' and company_id=".$_SESSION['user']['customer']->company_id;
   		$GLOBALS['mysql']->delete($sql);
   }
  /*
   * 查询职员信息总数
   * */
   function countUser(){
   		$sql="select count(user_id) as count from zy_user where company_id=".$_SESSION['user']['customer']->company_id;
   		$COUNT=$GLOBALS['mysql']->selectId($sql);
   		return $COUNT->count;
   }
   /*
    * 查询公司下的所有user,并分页
    * */
    function selectUser(){
    	$sql="SELECT * FROM zy_user where company_id=".$_SESSION['user']['customer']->company_id." ORDER BY user_id ASC  limit ".($GLOBALS['pages']-1)*$GLOBALS['displaypg'].",".$GLOBALS['displaypg'];
    	$arr=$GLOBALS['mysql']->select($sql);
	    return $arr;
    }
    /*
     * 查询该公司下所有部门
     * */
     function selectDepartment(){
     	$sql="select zy_department.* from zy_department where company_id=".$_SESSION['user']['customer']->company_id;
     	$department_arr=$GLOBALS['mysql']->select($sql);
	    return $department_arr;
     }
    /*
     * 查询一个职员信息
     * */
     function AUserInquires(){
     	$sql="select zy_user.* from zy_user where user_id='$this->user_id'";
     	$department_arr=$GLOBALS['mysql']->selectId($sql);
     	return $department_arr;
     }
     
     /*
      * 修改一条部门信息
      * */
      function updateUser(){
      	$sql="update zy_user set `department_id`='$this->department_id',`user_login_name`='$this->user_login_name',`user_login_password`='$this->user_login_password',`roleid`='$this->roleid',`user_real_name`='$this->user_real_name',`user_email`='$this->user_email',`user_phone`='$this->user_phone',`user_mobile`='$this->user_mobile',`user_remark`='$this->user_remark' where user_id='$this->user_id'";
  		$GLOBALS['mysql']->upadte($sql);
      }
 }
?>
