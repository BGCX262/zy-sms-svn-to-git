<?php 

$method=$_REQUEST["method"];
$username=$_REQUEST["username"];
$password=$_REQUEST["password"];
$mobile=$_REQUEST["mobile"];
$api_id=$_REQUEST["api_id"];
$text=$_REQUEST["text"];
/*
$method="sendMessages";
$username="abc";
$password="123456";
$mobile="8613855585327";
$api_id="8";
$text="12312312312321";
*/
$post_data = array(
    'method' => $method,
    'username' => $username,
    'password' =>$password,
	'mobile' => $mobile,
	'api_id' => $api_id,
	'text' =>$text
);
//$url="http://sms.webnova.com.au/api/sendMessage.php";
  $url="http://localhost:8080/zy-sms/api/sendMessage.php";
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url );  
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);     
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,0); 
// 我们在POST数据哦！
curl_setopt($ch, CURLOPT_POST, 1);
// 把post的变量加上
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
$output = curl_exec($ch);
//调试使用
if ($output === FALSE) {
    $output="cURL Error: " . curl_error($ch);
}

curl_close($ch);
if($output==null){
	echo json_encode("error");
}else{
	echo ($output);
}


?>