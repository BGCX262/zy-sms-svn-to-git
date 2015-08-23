<?php

$con = mysql_connect("localhost","root","123456");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }else{
  	echo "数据库连接成功！";
  }
  
  $conn= mysql_select_db("pacific-media",$con);
  
  if(!$conn){
  	die('Could not connect: ' . mysql_error());
  }else{
  	echo "pacific-media连接成功！";
  }
  
  $property=mysql_query("SELECT wp_options.`option_name` FROM wp_options");
  
  $temp_property=mysql_num_rows($property);
  
  echo $temp_property;