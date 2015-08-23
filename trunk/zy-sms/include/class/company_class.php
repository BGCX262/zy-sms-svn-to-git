<?php
/*
 * Created on 2011-9-6
 *======================================
 *Author: Allen
 *Project:health360
 *File: company_class.php  
 *Date: 2011-9-6
 *======================================
 *@company_name 公司名称
 *@company_phone 公司电话
 *@company_address 公司地址
 *@user_id		公司管理员的用户号
 *@max_user		公司最大员工数
 *@remark		备注项,备用字段
 */

class company {
	//company属性
	private $company_id;
	private $company_name;
	private $company_phone;
	private $company_address;
	private $company_remark;
	
	//user 属性
	private $user_id;
	private $department_id;
	private $user_login_name;
	private $user_login_password;
	private $roleid;
	private $user_real_name;
	private $user_email;
	private $user_phone;
	private $user_mobile;
	private $user_remark;
	
	//userapi 属性
	private $usrapi_id;
	private $api_username;
	private $api_password;
	private $api_id;
	private $api_status;
	private $userapi_remark;
	private $sender_name;
	private $sender_status;
	private $sender_motivation;
	private	$api_type;
	
	//contact_list 属性
	private $contact_list_create_time;
	private $contact_list_update_time;
	private $contact_list_count;
	
	//info 属性;
	private $balance;
	private $type;
	private $number;
	private $name;
	private $expirydate;
	private $bsbnumber;
	private $accountnumber;
	private $accountname;
	private $defaultpay;
	
	
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
	 * 增加一个公司记录的同时,增加 user,department,更新company   开始
	 * 
	 * 新增一条用户信息
	 */
	function addUser($company_id) {
		$sql = "insert into `zy_user` (`company_id`,`department_id`,`user_login_name`,`user_login_password`,`roleid`,`user_real_name`,`user_email`,`user_phone`,`user_mobile`,`user_remark`)" .
			" VALUES ('$company_id','$this->department_id','$this->user_login_name','$this->user_login_password','$this->roleid','$this->user_real_name','$this->user_email','$this->user_phone','$this->user_mobile','$this->user_remark')";
		$userid=$GLOBALS['mysql']->insert($sql, true);
		return $userid;
	}
	/*
	 * 新增一条公司信息
	 * */
	function addCompany()
	{
		$sql = "INSERT INTO `zy_company`(`company_name`,`company_phone`,`company_address`,`company_remark`)" .
				"VALUES ('$this->company_name','$this->company_phone','$this->company_address','$this->company_remark')";
		$company_id=$GLOBALS['mysql']->insert($sql, true);
		return $company_id;
	}
	/**
	  * 添加默认list组
	  * */
	  function addContactList($user_id,$company_id,$department_id){
	  	$sql="insert into zy_contact_list (`contact_list_name`,`contact_list_count`,`company_id`,`department_id`,`user_id`,`agent_id`,`contact_list_create_time`,`contact_list_update_time`,`contact_list_remark`)" .
	 			" values ('Not Group','$this->contact_list_count','$company_id','$department_id','$user_id','$this->agent_id','$this->contact_list_create_time','$this->contact_list_update_time','Not Group')";
	 	
	 	$GLOBALS['mysql']->insert($sql,false);
	  }
	/**
	 * 添加info表.
	 */
	 function addPaymentInfo(){
	  	$sql="insert into zy_info (`company_id`) values ('$this->company_id')";
	 	$GLOBALS['mysql']->insert($sql,false);
	  }
	  /**
	   *根据companyid获取余额.
	   */
	   function getBalanceByCompanyId(){
	   		$SQL="select zy_info.balance from zy_info where company_id='$this->company_id'";
	   		$balance=$GLOBALS['mysql']->selectId($SQL);
	   		return $balance->balance;
	   }
	   function deductBalance($success_count){
	   	$sql="UPDATE `zy_info` SET `balance` =balance-$success_count WHERE `company_id` = '$this->company_id'";
		$GLOBALS['mysql']->upadte($sql);
	   }
	   
	   function updatePaymentInfo(){
	   	/*查询客户剩余短信数*/
	   	$SQL="select zy_info.balance from zy_info where company_id='$this->company_id'";
	   		$balance=$GLOBALS['mysql']->selectId($SQL);
	   	/*修改客户info*/
	   $sql="UPDATE `zy_info` SET `balance` =$this->balance+$balance->balance, `cc_type` = '$this->type', `cc_number` = '$this->number',
			`cc_name` = '$this->name', `cc_expirydate` = '$this->expirydate', `dd_bsbnumber` = '$this->bsbnumber', `dd_accountnumber` = '$this->accountnumber',
			`dd_accountname` = '$this->accountname', `defaultpay` = '$this->defaultpay' WHERE `company_id` = '$this->company_id'";
		$GLOBALS['mysql']->upadte($sql);
	   }
	/*
	 * 向department表中插入company_id
	 * insert department company_id
	 * */
 function addDepartmentCompanyId($company_id){
	 	$sql="insert into `zy_department` (`company_id`,`department_name`,`department_parent_id`,`remark`) values ('$company_id','manager','0','The highest authority')";
	 	$department_id=$GLOBALS['mysql']->insert($sql, true);
	 	return $department_id;
	 }
	
	/*
	 * 更新company表中 user_id
	 * */
		function updateCompanyCompanyId($userid,$company_id){
			$sql="update `zy_company` set user_id='$userid' where `company_id`='$company_id'";
			$GLOBALS['mysql']->upadte($sql);
		}
		/**
		 * 更新user表中 department_id
		 * */
		function updateUserDepartmentId($company_id,$department_id){
			$sql="update `zy_user` set `department_id`='$department_id' where `company_id`='$company_id'";
			$GLOBALS['mysql']->upadte($sql);
		}
	/*
	 * 增加一个公司记录的同时,增加 user,department,更新company   结束
	 * */
		
		
		
	/**
	 * 查询公司信息
	 */
	function queryCompany(){
//		$sql="SELECT * FROM zy_company ORDER BY company_id DESC LIMIT 0, 10";
		$sql="select a.*,b.* from zy_company a ,zy_info b where a.company_id=b.company_id ORDER BY a.company_id DESC limit ".($GLOBALS['pages']-1)*$GLOBALS['displaypg'].",".$GLOBALS['displaypg'];
		$arr=$GLOBALS['mysql']->select($sql);
		return $arr;
	}
	
	/**
	 *根据ID删除一条公司信息
	 */
//	 function deleteCompany(){
//	 	//mysql左连接删除方法如下
//	 	$sql="DELETE zy_user,zy_company FROM zy_company  LEFT JOIN zy_user ON zy_user.user_id=zy_company.user_id WHERE zy_company.company_id=$this->company_id";
//	 	$GLOBALS['mysql']->delete($sql);
//	 }
	 /**
	  * 修改公司信息及用户信息
	  */
	  function updateCompany(){
	  	//联合修改方法如下
		$sql="UPDATE zy_user,zy_company SET `company_name` = '$this->company_name',  `company_phone` = '$this->company_phone'," .
				" `company_address` = '$this->company_address'," .
				" zy_company.company_remark = '$this->company_remark'," .
				" zy_user.user_login_password='$this->user_login_password'," .
				" `user_real_name`='$this->user_real_name',`user_email`='$this->user_email'," .
				" `user_phone`='$this->user_phone',zy_user.user_mobile='$this->user_mobile',zy_user.user_remark = '$this->user_remark'".
				" where zy_user.user_id=zy_company.user_id AND zy_company.company_id=$this->company_id";
		$GLOBALS['mysql']->upadte($sql);
	  	}
	  /*
	   * 查询单个公司信息
	   * */
	   function queryCompanyID()
	   {
	   		//联合查询方法如下
	   		$sql="SELECT zy_company.*,zy_user.* FROM zy_company,zy_user WHERE zy_company.user_id=zy_user.user_id AND zy_company.company_id=$this->company_id";
	   		$obj=$GLOBALS['mysql']->selectId($sql);
	   		return $obj;
	   }
	   
	   
	   /*
	    * 查询用户所在公司
	    * */
	    function queryUserCompany(){
			$sql="select * from  zy_company,zy_user WHERE zy_company.user_id = zy_user.user_id and zy_user.`user_id`='$this->user_id'";
	   		$obj=$GLOBALS['mysql']->selectId($sql);
	   		return $obj;
	    }

	   /**
	    * 分页查询公司信息
	    * */
	    function countCompany()
	    {
	    	$sql="select count(company_id) count from zy_company";
	    	$obj=$GLOBALS['mysql']->selectId($sql);
	    	return $obj->count;
	    }
	 /**
	 * 查询公司对应的API信息,分页
	 */
	function queryUserApi(){
		$sql="select * from zy_userapi where api_status<>3 and company_id=".$this->company_id." ORDER BY api_type desc,userapi_id asc limit ".($GLOBALS['pages']-1)*$GLOBALS['displaypg'].",".$GLOBALS['displaypg'];
		$arr=$GLOBALS['mysql']->select($sql);
		return $arr;
	}
	 /**
	 * 查询公司对应的API信息,无分页
	 */ 
	function queryUserApiNoPager(){
		$sql="select * from zy_userapi where sender_status=2 and company_id=".$this->company_id." ORDER BY api_type asc,userapi_id asc ";
		$arr=$GLOBALS['mysql']->select($sql);
		return $arr;
	} 
	function countUserAPI(){
		$sql="select count(company_id) count from zy_userapi where api_status<>3";
		$obj=$GLOBALS['mysql']->selectId($sql);
	    	return $obj->count;
	} 
	 /**
	 * 查询单条API信息
	 */ 
	 	function queryUserApiById(){
		$sql="select * from zy_userapi where userapi_id=".$this->userapi_id;
		$obj=$GLOBALS['mysql']->selectId($sql);
		return $obj;
	}
	/**
	  * 修改userapi
	  */
	  function updateUserAPI(){
	  $sql="UPDATE `zy_userapi` SET `company_id` = '$this->company_id',`api_username` = '$this->api_username',`api_password` = '$this->api_password',`api_id` = '$this->api_id',`api_status` = '$this->api_status',`sender_name` = '$this->sender_name',`sender_status` = '$this->sender_status',`userapi_remark` = '$this->userapi_remark' WHERE `userapi_id` = $this->userapi_id";
		$GLOBALS['mysql']->upadte($sql);
	}
	/**
	  * 删除 userapi.将status改为3
	  */
	  function deleteUserAPI(){
	  $sql="UPDATE `zy_userapi` SET `api_status` =3 WHERE `userapi_id` = $this->userapi_id";
	  $GLOBALS['mysql']->upadte($sql);
	}	 
	 /**
	  * 添加 userapi
	  */
	  function addUserAPI(){
	  $sql="INSERT INTO `zy_userapi` (`company_id`,`api_username`,`api_password`,`api_id`,`api_status`,`sender_name`,`sender_motivation`,`api_type`,`sender_status`,`userapi_remark`) VALUES ($this->company_id,'$this->api_username','$this->api_password','$this->api_id',$this->api_status,'$this->sender_name','$this->sender_motivation','$this->api_type','$this->sender_status','$this->userapi_remark')";
	  $GLOBALS['mysql']->insert($sql,false);
	}
	/**
	 * 查询公司默认的userapi帐号密码
	 */	 
	 function queryDefaultUserApi(){
	 	$sql="select * from zy_userapi where company_id=$this->company_id  and api_type=0 limit 0,1";
	 
	 	$obj=$GLOBALS['mysql']->selectId($sql);
		return $obj;
	 } 	 	
}
?>