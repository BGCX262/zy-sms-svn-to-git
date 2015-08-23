<?php
/**
 * @author  
 * @since    2010-11-12
 * @desc   分页
 * 
 */
class Page{
	/**
	 * @desc（数据库）查询的起始页
	 * @var int
	 */
	private static $firstcount;
	/**
	 * @desc 页面导航条代码
	 * @var String
	 */
	private static $pagenav;
	/**
	 * @desc当前页码
	 * @var int
	 */
	private  $page;
	/**
     * @desc 读取本页URL
     * @var  String
     */
     
     private $begin_page;
     private $end_page;
	private static $server_url;
	/**
     * @desc 构造函数。给$page(当前页)和$server_url(URL)赋初值
     * @param int $page
     * @return null
     */
	public function __construct($page){
		isset($page)?$this->page=intval($page):$this->page=1;
		$this->server_url= $_SERVER["REQUEST_URI"];
	}
	/**
	 * @desc 分页计算，$pagenav（页面导航）获得结果
	 *
	 * @param Int $totle符合要求的数据库表中的总记录数
	 * @param Int $displaypg 每页显示的记录数 ，默认20条
	 * @param String $url  默认本页  $_SERVER["REQUEST_URI"]
	 * @return null默认不输出
	 */
	public function pageft($totle,$displaypg,$url=''){
		//如果$url使用默认，即空值，则赋值为本页URL：
		if(!$url){ $url=$this->server_url;}
		//URL分析：
		$parse_url=parse_url($url);	
		$url_query=$parse_url["query"];	
		//单独取出URL的查询字串
		if(isset($url_query)){
			$params=array();
			//因为URL中可能包含了页码信息，我们要把它去掉，以便加入新的页码信息。
			//这里用到了正则表达式
//			$url_query=preg_replace("(^|&)page=$this->page","",$url_query);
			//将处理后的URL的查询字串替换原来的URL的查询字串：
			parse_str($url_query,$params);
			unset($params['page']);
//			$url=str_replace($parse_url["query"],$url_query,$url);
			$url=$parse_url['path'].'?'.http_build_query($params);   // 解析后的url路径组合
			//在URL后加page查询信息，但待赋值：
			if(http_build_query($params)){
				$url.="&page";
			}
			 else{
			 	$url.="page";
			 } 
		}else {
			$url.="?page";
		}
		
		//页码计算：
		$lastpg=ceil($totle/$displaypg); //最后页，也是总页数
		$this->page=min($lastpg,$this->page);
		$prepg=$this->page-1; //上一页
		$nextpg=($this->page==$lastpg ? 0 : $this->page+1); //下一页
		$this->firstcount=($this->page-1)*$displaypg;
		//开始分页导航条代码：
//		$this->pagenav="显示第 <B>".($totle?($this->firstcount+1):0)."</B>-<B>".min($this->firstcount+$displaypg,$totle)."</B> 条记录，共 $totle 条记录<BR>";
                     
		//如果只有一页则跳出函数：
		if($this->page-4>=1){
			$this->begin_page=$this->page-4;
		}else{
			$this->begin_page=1;	
		}
		if($this->page+4<=$lastpg){
			$this->end_page=$this->page+4;
		}else{
			$this->end_page=$lastpg;	
		}
		//分页前导航
		if($lastpg<1)
		{
		 return false;
		}
		{
		$this->pagenav.="<a href='{$url}=1'>&lt;&lt;</a> ";
		}
		if($prepg)
		{ 
		$this->pagenav.="<a href='{$url}=$prepg'>&lt;</a> ";
		} 
		else
		{ 
			$this->pagenav.="<a href='javascript:void(0);'>&lt;</a> ";
		}
		//中间页码
			while($this->begin_page <= $this->end_page){
				if($this->begin_page == $this->page){
					$this->pagenav.=" <a href='{$url}=$this->begin_page' class='current number'>$this->begin_page</a> ";
				}else{
				$this->pagenav.=" <a href='{$url}=$this->begin_page' class='number'>$this->begin_page</a> ";	
				}
				
				$this->begin_page++;
			}
		//分页后导航
		if($nextpg)
		{
		 $this->pagenav.=" <a href='{$url}=$nextpg'>&gt;</a> ";
		}
		  else
		  { 
		  $this->pagenav.="<a href='javascript:void(0)'>&gt;</a>";
		  }
		$this->pagenav.=" <a href='{$url}=$lastpg'>&gt;&gt;</a> ";


//		//下拉跳转列表，循环列出所有页码：
//		$this->pagenav.="　到第 <select name='topage' size='1' onchange='window.location=\"$url=\"+this.value'>\n";
//		for($i=1;$i<=$lastpg;$i++){
//			if($i==$this->page)
//			{
//			 $this->pagenav.="<option value='$i' selected>$i</option>\n";
//			}
//			else
//			{ 
//			$this->pagenav.="<option value='$i'>$i</option>\n";
//			}
//		}
//		$this->pagenav.="</select> 页，共 $lastpg 页";
	}
	/**
	 * @desc 获得(数据库）查询的起始页
	 * @return $firstcount
	 */
	public function getFirstcount(){
		return $this->firstcount;
	}
	/**
	 * @desc 设置（数据库）查询的起始页
	 * @param Int $firstcount默认为0
	 */
	public function setFirstcount($firstcount=0){
		$this->firstcount=0;
	}
	/**
	 * @desc获取导航栏数据
	 * @return $pagenav
	 */
	public function getPagenav(){
		return  $this->pagenav;
	}
}
?>
