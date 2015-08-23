<?php



$today =date('YmdHis');//当前日期
$time=date('YmdHis');//超越日期
echo $time."超越日期<br/>";


if($time >= $today){
	echo "is true<br />";
}else{
	echo "is false<br />";
}


$day=date('Ym').date('d')+1;
$times = date('His');
$todays = $day.$times;

$i = 222232;
$j = 222232 + 100;

echo $j."<br />";

echo $today."当前日期<br/>";
echo $todays."超越日期.<br />";

$s= $today + 1000000;  //明天的值 
$k=$s - $today;
echo "k====".$k;
echo "s==".$s."<br />";
if($today >= $todays){
	echo "已经超出修改密码限制.<br />";
}else{
	echo "在规定修改密码限制内.<br />";	
}