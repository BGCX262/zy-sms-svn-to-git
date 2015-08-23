<?php
/*
 * 公共类库,包含一些常用方法
 * 
 * Created on 2011-8-28
 *======================================
 *Author: Allen
 *Project:health360
 *File: common_lib.php  
 *Date: 2011-8-28
 *======================================
 *
 */
 /**
 * 验证输入的邮件地址是否合法
 *
 * @access  public
 * @param   string      $email      需要验证的邮件地址
 *
 * @return bool
 */
function is_email($user_email)
{
    $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
    if (strpos($user_email, '@') !== false && strpos($user_email, '.') !== false)
    {
        if (preg_match($chars, $user_email))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}

/**
 * 检查是否为一个合法的时间格式
 *
 * @access  public
 * @param   string  $time
 * @return  void
 */
function is_time($time)
{
    $pattern = '/[\d]{4}-[\d]{1,2}-[\d]{1,2}\s[\d]{1,2}:[\d]{1,2}:[\d]{1,2}/';

    return preg_match($pattern, $time);
}
/**
 * 生成前台主题路径
 * 
 */
function get_web_theme(){
	if(isset($_SESSION["web_theme_name"])&&isset($_SESSION["theme_path"])){
		$web_theme_url=ROOT_URL.'/'.$_SESSION['theme_path'].'/'.$_SESSION['web_theme_name'];
	}
	return $web_theme_url;
}
/**
 * 生成后台台主题路径
 * 
 */
function get_admin_theme(){
	if(isset($_SESSION["admin_theme_name"])&&isset($_SESSION["theme_path"])){
		$admin_theme_url=ROOT_URL.'/'.ADMIN_PATH.'/'.$_SESSION['theme_path'].'/'.$_SESSION['admin_theme_name'];
	}

	return $admin_theme_url;
}
/**
 * 显示后台模板文件
 */
 function admin_display($file){
 	
 	return $_SESSION['theme_path'].'/'.$_SESSION['admin_theme_name'].'/'.$file;
 }
 /**
 * 显示前台模板文件
 */
 function web_display($file){
 	
 	return $_SESSION['theme_path'].'/'.$_SESSION['admin_theme_name'].'/'.$file;
 }
 /**
  * 获取后台导航
  */
 function get_menu($links_array)
{
	$current_url=explode("/",curPageURL());
	$file=$current_url[sizeof($current_url)-1];	
	
	if(strpos($file,"?")>1){
		$url=explode("?",$file);
		$file=$url[0];
	}
	
	for($i=0;$i<sizeof($links_array);$i++)
	{
		$menu_class="";
		$str_start="<li>";
		$str_end="</li>";
		$title=$links_array[$i][0];
		$url=$links_array[$i][1];
		$submenu=$links_array[$i][2];
		$pid=$links_array[$i][3];
		$child_array=$links_array[$i][4];
	
		if($file==$url){
			$menu_class=" current ";
		}
	
		if($submenu){
			$menu_class.=" nav-top-item ";
			
			$sub_menu="";
			for($j=0;$j<sizeof($child_array);$j++)
			{
				
				$sub_title=$child_array[$j][0];
				$sub_link=$child_array[$j][1];
				if($file==$sub_link){
					$sub_menu_class=" current ";
					$menu_class.=" current ";
				}
				$sub_menu.="<li><a class=\"$sub_menu_class\" href=\"$sub_link\">".$sub_title."</a></li>";
				$sub_menu_class="";
			}
			
			$menu.=$str_start."<a href=\"".$url."\" class=\"".$menu_class."\">".$title."</a>"."<ul>".$sub_menu."</ul>".$str_end;
		
		}
		else{
			$menu_class.=" nav-top-item no-submenu ";
			$menu.=$str_start."<a href=\"".$url."\" class=\"$menu_class\">".$title."</a>".$str_end;
		}
	}
	return $menu;
}
/*获取当前URL*/
function curPageURL() 
{
    $pageURL = 'http';

    if ($_SERVER["HTTPS"] == "on") 
    {
        $pageURL .= "s";
    }
    $pageURL .= "://";

    if ($_SERVER["SERVER_PORT"] != "80") 
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } 
    else 
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}


?>
