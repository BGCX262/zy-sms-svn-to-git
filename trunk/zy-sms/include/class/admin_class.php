<?php
/*
 * --------------------
 * Created on 2011-10-20
 * @author arthur
 * email:15215557835@qq.com
 * --------------------
 */

class admin{
 	private $admin_id;
 	private $admin_login_name;
 	private $admin_login_password;
 	private $admin_real_name;
 	private $admin_remark;

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
 	 *添加用户
 	 * */
 	function addAdmin(){
 		
 		$sql = "select count(admin_id) as a from zy_admin where admin_login_name='$this->admin_login_name'";
		$count=$GLOBALS['mysql']->selectId($sql,false);
 		if($count->a>0){ 			
 			$message=array(1);
 			return $message;
 		}
 		if($this->admin_login_password)
 		{
 		$sql = "insert into zy_admin(`admin_login_name`,`admin_login_password`,`admin_real_name`,`admin_remark`) " .
 				"values('$this->admin_login_name','$this->admin_login_password','$this->admin_real_name','$this->admin_remark')";
		$GLOBALS['mysql']->insert($sql,false);
 		}
 		else
 		{
 			$message=array(2);
 			return $message;
 		}
 	}
 	/*
 	 * 根据Id号删除用户
 	 * */
 	function deleteAdmin(){
 		$sql = "delete from zy_admin where admin_id='$this->admin_id'";
 		$GLOBALS['mysql']->delete($sql);
 	}
 	/*
 	 * 修改用户信息
 	 * */
 	function updateAdmin(){
 		if($this->admin_login_password)	
 		{
	    	$sql = "update zy_admin set admin_login_password='$this->admin_login_password',admin_real_name='$this->admin_real_name',admin_remark='$this->admin_remark' where admin_id='$this->admin_id'";
	    	$GLOBALS['mysql']->upadte($sql);
 		}else{
 			$message=array(2);
 			return $message;
 		}

 	}
 	/*
 	 * 查询所有用户信息
 	 * */
 	function queryAdmin(){
 		$sql = "SELECT * FROM zy_admin ORDER BY admin_id DESC  limit ".($GLOBALS['pages']-1)*$GLOBALS['displaypg'].",".$GLOBALS['displaypg'];
 		$arr=$GLOBALS['mysql']->select($sql);
	    return $arr;
	}
 	/*
 	 * 根据Id号查询单个用户信息
 	 * */

 	function queryAdminId(){
 		$sql = "select * from zy_admin where admin_id='$this->admin_id'";
 		$obj=$GLOBALS['mysql']->selectId($sql);
	 	return $obj;
 	}
 	  /*
	    * 分页查询公司信息
	    * */
	    function queryPage()
	    {
	    	$sql="select * from zy_admin";
	    	$rs = mysql_query($sql);
	    	return $rs;
	    }
	    function countAdmin(){
		$sql="SELECT COUNT(admin_id) as count FROM `zy_admin`";
		$arr=$GLOBALS['mysql']->selectId($sql);		
		return $arr->count;
	}
}
?>