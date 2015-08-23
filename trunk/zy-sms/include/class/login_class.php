<?php
/*
 * --------------------
 * Created on 2011-10-20
 * @author arthur
 * email:15215557835@qq.com
 * --------------------
 */
 class login{
 	private $admin_login_name;
 	private $admin_login_password;
 	/*前台属性*/
 	private $company_id;
 	private $department_name;
 	private $user_login_name;
 	private $user_login_password;
 	private $user_id;
 	private $roleid;
 	private $user_real_name;
 	private $user_email;
 	private $user_phone;
 	private $user_mobile;
 	private $user_remark;
 	private $group;
 	private $login_by_params;
 	
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
		
		/*检查后台用户是否存在*/
		function check()
		{
			/* $_POST['group']==1 admin;  $_SESSION['user']['admin']
			 * group=2 customer   $_SESSION['user']['customer']
			 * 
			 * login_by_params='no' 当login_by_params等于'1'的时候无须验证帐号密码匹配,根据ID号直接登录
			 * 
			 
			$sql="select * from zy_user where admin_login_name='$this->admin_login_name' and admin_login_password='$this->admin_login_password'";
			
			$sql="select * from zy_user where user_id=".$this->company_id;
			*/
			 if($this->group == '1' ){
				$sql="select * from zy_admin where admin_login_name='$this->admin_login_name' and admin_login_password='$this->admin_login_password'";
				$arr=$GLOBALS['mysql']->selectId($sql);	
			}
			else if($this->group == '2' ){
				if($this->login_by_params==1){
					$sql="select * from zy_user where company_id=".$this->company_id;
				}else{
					$sql="select * from zy_user where user_login_name='$this->user_login_name' and user_login_password='$this->user_login_password'";
				}	
				$arr=$GLOBALS['mysql']->selectId($sql);	
			}
			if(empty($arr))
			{
				$message=array(1);
				return $message;
			}
			else
			{
				if($this->group == '1' ){
				$_SESSION['user']['admin']=$arr;
				}else if($this->group == '2' ){
				$_SESSION['user']['customer']=$arr;
				}
			
				header("location:index.php");
			}
			
		}
		//判断用户是否已经登陆
		function checkLogined($path){
			
			if(!isset($_SESSION['user'][$path])){
					//如果未登陆返回登录页
					
					header("location:login.php");
				}else{
					global $smarty;
					$smarty->assign("user",$_SESSION['user']);				
					return true;	 
				}				
			}
		/*
		 * 查询账户信息
		 * */
		 function queryAccount()
		 {
		 	if($_SESSION['user']->tid == 0)
		 	{
		 		$sql="SELECT * from zy_user where zy_user.user_id=".$_SESSION['user']->user_id;
		 	}else{
		 		$sql="select * from zy_user,zy_department,zy_company " .
		 				"where zy_user.tid=zy_department.tid  " .
		 				"and zy_department.company_id=zy_company.company_id " .
		 				"and zy_user.user_id=".$_SESSION['user']->user_id;
		 	}
		 	$account=$GLOBALS['mysql']->select($sql);
		 	return $account;
		 }
		 
		 
		//判断前台用户是否存在
		function web_check()
		{
			$sql="select * from zy_user where `user_login_name`='$this->user_login_name' and `user_login_password`='$this->user_login_password'";
			$arr=$GLOBALS['mysql']->selectId($sql);
			if(!empty($arr))
			{
				if($arr->tid==0){
					$tsql="select zy_company.* ,zy_user.* from zy_company,zy_user where zy_company.user_id=zy_user.user_id and zy_user.user_id=$arr->user_id";	
				}else{
					$tsql="select zy_company.*,zy_department.* ,zy_user.* from zy_company,zy_user,zy_department where zy_department.tid=zy_user.tid and zy_user.user_id=$arr->user_id";
				}
				$tarr=$GLOBALS['mysql']->selectId($tsql);
				$_SESSION['user']=$tarr;
//				header("location:myaccount.php");
			}
		}
		/*
		 * 判断前台用户是否已经登陆
		 * */
		 function checkLogin()
		 {
		 	if(!isset($_SESSION['user']))
		 	{
		 		//如果未登陆
				header("location:index.php");
		 	}else{
		 			global $smarty;
					$smarty->assign("user",$_SESSION['user']);
					return true;
		 	}
		 }
	/*
		 * 修改前台用户
		 * */
		 function updateUser()
		 {
		 	$sql="update zy_user set `user_login_password`='$this->user_login_password'," .
		 			"`user_real_name`='$this->user_real_name'," .
		 			"`user_email`='$this->user_email'," .
		 			"`user_phone`='$this->user_phone' where `user_id`='$this->user_id'";
		 	$GLOBALS['mysql']->upadte($sql);
		 }
 }
?>
