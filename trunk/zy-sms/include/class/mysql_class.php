<?php
session_start();
/*
 * Created on 2011-8-30
 *======================================
 *Author: Allen
 *Project:health360
 *File: mysql_lib.php
 *Date: 2011-8-30
 *======================================
 */
class MYSQL {
	private $row_count;
	private $row = array ();
	private $result;
	private $con;
	/*
	* FUNCTION :: MYSQL($p_host, $p_user, $p_passwd, $p_db="mysql")
	* DESCRIPTION  ::
	*      Initialize class with information to access server
	*      No connection will be made at this point.
	* INPUT ::
	*      p_host      : server hostname|IP address
	*      p_user      : user name to log into server
	*      p_passwd    : passwd for the user
	*      p_db        : database to be used
	* OUTPUT ::
	*      none
	*/
	function MYSQL($p_host, $p_user, $p_passwd, $p_db = "mysql") {
		$this->sql_host = $p_host;
		$this->sql_user = $p_user;
		$this->sql_passwd = $p_passwd;
		$this->sql_db = $p_db;
		$this->getConnection();
	}

	function getConnection() {
		// Connect to the Database
		$this->con = mysql_connect($this->sql_host, $this->sql_user, $this->sql_passwd);
		if (!$this->con)
			die('could not connect: ' . mysql_error());
		//Select the Database
		if (!mysql_select_db($this->sql_db, $this->con)) {
			die('could not select datebase: ' . mysql_error());
		}
		mysql_query("SET NAMES 'utf8'");
	}
	function closed() {
		mysql_close($this->con);
	}
	function insert($sql, $return_id) {
		mysql_query($sql) or die('could not insert: ' . mysql_error());
		if ($return_id) {
			return mysql_insert_id();
		}
	}
	function delete($sql) {
		mysql_query($sql) or die('could not delete: ' . mysql_error());
	}
	function upadte($sql) {
		mysql_query($sql) or die('could not update: ' . mysql_error());
	}
	/*
	 * 查询所有内容
	 * */
	function select($sql) {
		$this->result = mysql_query($sql) or die('could not select: ' . mysql_error());
		//$this->row_count = mysql_num_rows($this->result);
		$i = 0;
		$arr=array();
		while ($this->row = mysql_fetch_object($this->result)) {
			$arr[$i]=$this->row;
			$i++;
		}
		return $arr;
	}
	/*
	 * 查询单个内容
	 * */
	function selectId($sql) 
	{
		$this->result = mysql_query($sql) or die('could not select: ' . mysql_error());
		//$this->row_count = mysql_num_rows($this->result);
		$this->row = mysql_fetch_object($this->result);
		return $this->row;
	}
}
?>