<?php
/*
 * Created on 2011-10-14
 *======================================
 *Author: Allen
 *Project:health360
 *File: language.php  
 *Date: 2011-10-14
 *======================================
 *TODO 
 *@param @type @var  @note
 */
$uplink = $_SERVER['HTTP_REFERER'];

if(strpos($uplink,"language=")>1){
	
	preg_match("/language\=(.*)/", $uplink, $regs);
	
//echo $_GET['language']."<br />";
//echo $regs[1]."<br />";
//echo $uplink."<br />";
$language_link=str_replace($regs[1],$_GET['language'],$uplink);

}else if(strpos($uplink,"?")>1){
	$language_link=$uplink.'&language='.$_GET['language'];
}else{
	$language_link=$uplink.'?language='.$_GET['language'];
}
//echo $language_link;
header("location:$language_link");
?>
