<?php

class contact {
	//contact_list 属性
	private $contact_list_id;
	private $contact_list_name;
	private $contact_list_count;
	private $company_id;
	private $department_id;
	private $user_id;
	private $agent_id;
	private $contact_list_create_time;
	private $contact_list_update_time;
	private $contact_list_remark;
	private $contact_list;
	
	//contact属性
	private $contact_first_name;
	private $contact_surname;
	private $contact_email;
	private $contact_mobile;
	private $contact_phone;
	private $contact_title;
	private $contact_create_time;
	private $contact_update_time;
	private $contact_birth_date;
	private $contact_country;
	private $contact_state;
	private $contact_city;
	private $contact_address;
	private $contact_remark;
	private $NotGroupID;
	
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
/**************************contact list******************************************/
	/*
	 * 增加一个联系人列表
	 * */
	 function addContact(){
	 	$sql="insert into zy_contact_list (`contact_list_name`,`contact_list_count`,`company_id`,`department_id`,`user_id`,`agent_id`,`contact_list_create_time`,`contact_list_update_time`,`contact_list_remark`)" .
	 			"values('$this->contact_list_name','$this->contact_list_count','$this->company_id','$this->department_id','$this->user_id','$this->agent_id','$this->contact_list_create_time','$this->contact_list_update_time','$this->contact_list_remark')";
	 	$GLOBALS['mysql']->insert($sql,false);
	 }
	 /*
	  * 删除一条联系人列表记录
	  * */
	  function deleteContact(){
	  	$sql="delete from zy_contact_list where contact_list_id='$this->contact_list_id'";
	  	$GLOBALS['mysql']->delete($sql);
	  }
	  /*
	   * 查询一条联系人列表记录
	   * */
	   function ADepartmentInquires(){
	   		$sql="select zy_contact_list.* from zy_contact_list where contact_list_id='$this->contact_list_id'";
	   		$contact_arr=$GLOBALS['mysql']->selectId($sql);
	   		return $contact_arr;
	   }
	   /*
	    * 修改一条联系人列表记录
	    * */
	    function updateContact(){
	    	$sql="update zy_contact_list set  `contact_list_name`='$this->contact_list_name',`agent_id`='$this->agent_id',`contact_list_remark`='$this->contact_list_remark' where contact_list_id='$this->contact_list_id'";
	    	$GLOBALS['mysql']->upadte($sql);
	    }
	/*
	 * 查询联系人列表,分页
	 * */
	 function queryContact(){
//	 	$sql="select zy_contact_list.* from zy_contact_list where `company_id`='$this->company_id' ORDER BY contact_list_id DESC limit ".($GLOBALS['pages']-1)*$GLOBALS['displaypg'].",".$GLOBALS['displaypg'];
		$SQL="SELECT a.*,(SELECT COUNT(b.`contact_id`)  FROM zy_contact b WHERE b.`contact_list` LIKE  CONCAT('%[',a.`contact_list_id`,']%')) contact_list_count FROM zy_contact_list a WHERE a.`company_id`='$this->company_id' ORDER BY contact_list_id DESC limit ".($GLOBALS['pages']-1)*$GLOBALS['displaypg'].",".$GLOBALS['displaypg'];
	 	$contact_arr=$GLOBALS['mysql']->select($SQL);
	 	return $contact_arr;
	 }
	 	/*
	 * admin查询联系人列表,分页
	 * */
	 function queryAdminContact(){
	 	$sql="SELECT * FROM `zy_company`,zy_contact_list WHERE zy_company.`company_id` = zy_contact_list.`company_id` ORDER BY contact_list_id DESC limit ".($GLOBALS['pages']-1)*$GLOBALS['displaypg'].",".$GLOBALS['displaypg'];
	   //这条sql是根据公司ID查询出该公司下所有联系人列表.你上面那个我不太清楚你要公司表里的什么数据.SQL你自己组装下.
	   //$sql="SELECT a.`contact_list_id`,a.`contact_list_name`,(SELECT COUNT(b.`contact_id`)  FROM zy_contact b WHERE b.`contact_list` LIKE  CONCAT('%[',a.`contact_list_id`,']%')) contact_list_count FROM zy_contact_list a WHERE a.`company_id`='$this->company_id'"; 
	 	$contact_arr=$GLOBALS['mysql']->select($sql);
	 	return $contact_arr;
	 }
	 
	/*
	 * 查询联系人列表总数,分页
	 * */
	 function countContact(){
	 	$sql="select count(contact_list_id) as count from zy_contact_list";
	 	$count=$GLOBALS['mysql']->selectId($sql);
	 	return $count->count;
	 }
	 /**
	  * 查询customer联系人列表总数,分页
	 * */
	 function countContactCustomer(){
	 	$sql="select count(contact_list_id) as count from zy_contact_list WHERE `company_id`='$this->company_id'";
	 	$count=$GLOBALS['mysql']->selectId($sql);
	 	return $count->count;
	 }
	 
	 /*
	  * 查询所有联系人列表
	  * */
	  function selectContact(){
	 	$sql="select zy_contact_list.* from zy_contact_list ";
	 	$arr=$GLOBALS['mysql']->select($sql);
	 	return $arr;
	 }
/*********************customer contact**************************/
	private function getNotGroup(){
			/**获取未分组ID*/
			$sql="select * from zy_contact_list  where  company_id=".$_SESSION['user']['customer']->company_id." ORDER BY contact_list_id ASC";
			$this->NotGroupID=$GLOBALS['mysql']->select($sql);
			return $this->NotGroupID;
	}
	/**
	 * 如果不选择congtatLIstName,则进未分组
	 * 增加一条联系人记录
	 */
	function addNotGroup(){
		$NotGroupid=$this->getNotGroup();
		$NotGroupID=$NotGroupid[0]->contact_list_id;
		$sql="INSERT INTO `zy_contact` (`contact_first_name`,`contact_surname`,`contact_email`,`contact_mobile`,
             `contact_phone`,`contact_title`,`contact_create_time`,`contact_update_time`,`contact_birth_date`,`contact_country`,
             `contact_state`,`contact_city`,`contact_address`,`company_id`,`department_id`,`user_id`,`contact_list`,`contact_remark`)
				VALUES ('$this->contact_first_name','$this->contact_surname','$this->contact_email','$this->contact_mobile','$this->contact_phone',
				        '$this->contact_title','$this->contact_create_time','$this->contact_update_time','$this->contact_birth_date','$this->contact_country',
				        '$this->contact_state','$this->contact_city','$this->contact_address','$this->company_id','$this->department_id','$this->user_id','[$NotGroupID]','$this->contact_remark')";
		$contactId=$GLOBALS['mysql']->insert($sql,true);
	}	
	
	/**
	 * 增加一条联系人记录
	 */
	 function addContactPerson(){
		$set=implode(']|[',$this->contact_list);
	 	$sql="INSERT INTO `zy_contact` (`contact_first_name`,`contact_surname`,`contact_email`,`contact_mobile`,
             `contact_phone`,`contact_title`,`contact_create_time`,`contact_update_time`,`contact_birth_date`,`contact_country`,
             `contact_state`,`contact_city`,`contact_address`,`company_id`,`department_id`,`user_id`,`contact_list`,`contact_remark`)
				VALUES ('$this->contact_first_name','$this->contact_surname','$this->contact_email','$this->contact_mobile','$this->contact_phone',
				        '$this->contact_title','$this->contact_create_time','$this->contact_update_time','$this->contact_birth_date','$this->contact_country',
				        '$this->contact_state','$this->contact_city','$this->contact_address','$this->company_id','$this->department_id','$this->user_id','[$set]','$this->contact_remark')";
		$contactId=$GLOBALS['mysql']->insert($sql,true);
		return $contactId;
	 }
	 
	 /**
	  * 取出contact list 中 contact_id
	  * */
//	  function takeContactId(){
//	  	$sql="select zy_contact_list.contact_id as contactid from zy_contact_list where contact_list_id='$this->contact_list_id'";
//	  	$contactID=$GLOBALS['mysql']->selectId($sql);
//	  	return $contactID->contactid;
//	  }
	 /*
	  * 修改contact list 中 contact_list_count 数量
	  * */
	   function updateContactListCount($id){
	  	$sql="update zy_contact_list set contact_list_count=contact_list_count+1 where contact_list_id=$id";
	  	$GLOBALS['mysql']->upadte($sql);
	  }
	 /*
	  * 修改一条记录
	  * */
	  function updateContactPerson(){
	  	$set=implode(']|[',$this->contact_list);
	  	$sql="UPDATE `zy_contact`
			SET  `contact_first_name` = '$this->contact_first_name',
			  `contact_surname` = '$this->contact_surname',
			  `contact_email` = '$this->contact_email',
			  `contact_mobile` = '$this->contact_mobile',
			  `contact_phone` = '$this->contact_phone',
			  `contact_title` = '$this->contact_title',
			  `contact_create_time` = '$this->contact_create_time',
			  `contact_update_time` = '$this->contact_update_time',
			  `contact_birth_date` = '$this->contact_birth_date',
			  `contact_country` = '$this->contact_country',
			  `contact_state` = '$this->contact_state',
			  `contact_city` = '$this->contact_city',
			  `contact_address` = '$this->contact_address',
			  `contact_list` = '[$set]',
			  `contact_remark` = '$this->contact_remark'
			WHERE `contact_id` = '$this->contact_id'";
			$GLOBALS['mysql']->upadte($sql);
	  }
	/*
	 * 删除一条联系人记录
	 * */
	 function deleteContactPerson(){
	 	$sql="delete from zy_contact where contact_id='$this->contact_id'";
	  	$GLOBALS['mysql']->delete($sql);
	 }
	 /*
	  * 查询单个联系人记录
	  * */
	  function ADepartmentInquire(){
	  	$sql="select zy_contact.* from zy_contact where contact_id='$this->contact_id' and `company_id`='$this->company_id'";
	   		$contact_arr=$GLOBALS['mysql']->selectId($sql);
	   		return $contact_arr;
	  }
	/*
	 * 查询联系人
	 * 
	 * */
	 function queryContactPerson(){
	 	$sql="SELECT * FROM  zy_contact WHERE  zy_contact.`company_id`='$this->company_id' ORDER BY contact_id DESC limit ".($GLOBALS['pages']-1)*$GLOBALS['displaypg'].",".$GLOBALS['displaypg'];
	 	$contact_arr=$GLOBALS['mysql']->select($sql);
	 	return $contact_arr;
	 }
	 /*
	 	查询联系人总数
	 */
	 
	 function countContactPerson(){
	 	$sql="select count(zy_contact.contact_id) as count from zy_contact where zy_contact.`company_id`='$this->company_id'";
	 	$count=$GLOBALS['mysql']->selectId($sql);
	 	return $count->count;
	 }
	 	 /*
	  * 查询所有联系人列表
	  * */
	  function selectCustomerContact(){
	 	$sql="select zy_contact_list.* from zy_contact_list where `company_id`='$this->company_id'"; 
	 	$arr=$GLOBALS['mysql']->select($sql);
	 	return $arr;
	 }
	 
	 /**
	  * 根据company_id查询出所有联系人列表及列表下的人数.
	  */
	function CountCustomerContact(){
	 	$sql="SELECT a.`contact_list_id`,a.`contact_list_name`,(SELECT COUNT(b.`contact_id`)  FROM zy_contact b WHERE b.`contact_list` LIKE  CONCAT('%[',a.`contact_list_id`,']%')) contact_list_count FROM zy_contact_list a WHERE a.`company_id`='$this->company_id'"; 
	 	$arr=$GLOBALS['mysql']->select($sql);
	 	return $arr;
	 }
/*************************admin contact******************************/
 /* 增加一条联系人记录
	 * */
	 function addAdminContactPerson(){
	 	$set=implode(']|[',$this->contact_list);
	 	$sql="INSERT INTO `zy_contact` (`contact_first_name`,`contact_surname`,`contact_email`,`contact_mobile`,
             `contact_phone`,`contact_title`,`contact_create_time`,`contact_update_time`,`contact_birth_date`,`contact_country`,
             `contact_state`,`contact_city`,`contact_address`,`company_id`,`department_id`,`user_id`,`contact_list`,`contact_remark`)
				VALUES ('$this->contact_first_name','$this->contact_surname','$this->contact_email','$this->contact_mobile','$this->contact_phone',
				        '$this->contact_title','$this->contact_create_time','$this->contact_update_time','$this->contact_birth_date','$this->contact_country',
				        '$this->contact_state','$this->contact_city','$this->contact_address','$this->company_id','$this->department_id','$this->user_id','[$set]','$this->contact_remark')";
		$contactId=$GLOBALS['mysql']->insert($sql,true);
		return $contactId;
	 }
	 /*
	  * 修改一条记录
	  * */
	  function updateAdminContactPerson(){
	  	$set=implode(']|[',$this->contact_list);
	  	$sql="UPDATE `zy_contact`
			SET  `contact_first_name` = '$this->contact_first_name',
			  `contact_surname` = '$this->contact_surname',
			  `contact_email` = '$this->contact_email',
			  `contact_mobile` = '$this->contact_mobile',
			  `contact_phone` = '$this->contact_phone',
			  `contact_title` = '$this->contact_title',
			  `contact_create_time` = '$this->contact_create_time',
			  `contact_update_time` = '$this->contact_update_time',
			  `contact_birth_date` = '$this->contact_birth_date',
			  `contact_country` = '$this->contact_country',
			  `contact_state` = '$this->contact_state',
			  `contact_city` = '$this->contact_city',
			  `contact_address` = '$this->contact_address',
			  `contact_list` = '[$set]',
			  `contact_remark` = '$this->contact_remark'
			WHERE `contact_id` = '$this->contact_id'";
			$GLOBALS['mysql']->upadte($sql);
	  }
	/*
	 * 删除一条联系人记录
	 * */
	 function deleteAdminContactPerson(){
	 	$sql="delete from zy_contact where contact_id='$this->contact_id'";
	  	$GLOBALS['mysql']->delete($sql);
	 }
	 /**
	  * 查询单个联系人记录
	  * */
	  function ADepartmentInquireAdmin(){
	  	$sql="select zy_contact.* from zy_contact where contact_id='$this->contact_id'";
	   		$contact_arr=$GLOBALS['mysql']->selectId($sql);
	   		return $contact_arr;
	  }
	/**
	 * 查询联系人
	 * */
	 function queryAdminContactPerson(){
	 	$sql="SELECT * FROM zy_contact ORDER BY contact_id DESC limit ".($GLOBALS['pages']-1)*$GLOBALS['displaypg'].",".$GLOBALS['displaypg'];
	 	$contact_arr=$GLOBALS['mysql']->select($sql);
	 	return $contact_arr;
	 }
	 /**
	 	查询联系人总数
	 */	 
	 function countAdminContactPerson(){
	 	$sql="select count(zy_contact.contact_id) as count from zy_contact";
	 	$count=$GLOBALS['mysql']->selectId($sql);
	 	return $count->count;
	 }
	 /**
	  * 根据contact_list_id查询联系人
	  *
	  */
	  function queryContactByContactListId($where,$norepeat){
	  	if($norepeat){
	  		$sql="select * from zy_contact ".$where."  group by contact_mobile ORDER BY contact_id" ;
	  	}else{
	  		$sql="select * from zy_contact ".$where." ORDER BY contact_id";
	  	}
	  	$contact_arr=$GLOBALS['mysql']->select($sql);
	 	return $contact_arr;
	  }
}
