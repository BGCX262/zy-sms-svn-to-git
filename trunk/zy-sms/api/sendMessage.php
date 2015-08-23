<?php


/*
 * Created on 2011-9-5
 *======================================
 *Author: Allen
 *Project:health360
 *File: company.php  
 *Date: 2011-9-5
 *======================================
 *TODO 
 *@param @type @var  @note
 */

require ('../include/init.php');

$result = array (
	"status" => "fail",
	"message" => ""
);

$method = $_REQUEST['method'];
if (empty ($method)) {
	$result["status"] = "fail";
	$result["message"] = "no method";
}
if ($method == "sendMessages") {
	$result = sendMessages($result);
	
}

function sendMessages($result) {
	$start_time = date(TIME_FORMAT);
	$api_class = new api_class();
	$api_class->mobile = $_REQUEST['mobile'];
	$api_class->username = $_REQUEST['username'];
	$api_class->password = $_REQUEST['password'];
	$api_class->api_id = $_REQUEST['api_id'];
	$api_class->text = $_REQUEST['text'];
	
	//先根据短信内容计算credit.	
	if ($api_class->text != "") {
		//根据短信内容计算花费的credit.
		$api_class->cost = countCharacters($api_class->text);
		if (preg_match('/[\x80-\xff]./', $api_class->text)) {
			//中文,全部专程unicode码
		$api_class->text=getUnicode($api_class->text);
		$unicode=1;
		}else{
			//是英文的话再把空格转换下.
		$api_class->text = str_replace(' ', '%20', $_REQUEST['text']);
		$message->message_content = ereg_replace(Chr(10), '%0A',$message->message_content);
		$message->message_content = ereg_replace(Chr(13), '',$message->message_content);
		}
		
	}

	$api = $api_class->checkAPI();

	if (!$api) {
		$result["status"] = "fail";
		$result["message"] = "params error";
	} else {
		
		$mobile_arr = explode(",", $api_class->mobile);
		//print_r($mobile_arr);
		if ($api->balance < count($mobile_arr) * $api_class->cost) {
			$result["status"] = "fail";
			$result["message"] = "no enough bulance";
		} else {
			$success_list = ""; //成功列表
			$fail_list = ""; //失败列表
			$success_count = 0; //成功发送次数
			$fail_count = 0; //失败发送次数
			//循环发送短信
			for ($i = 0; $i < count($mobile_arr); $i++) {
				if ($mobile_arr[$i] == "") {
					continue;
				}
				
				$mobile_arr[$i] = formatMobile($mobile_arr[$i]);
				$url = "http://api.clickatell.com/http/sendmsg?user=" . $api->api_username . "&password=" . $api->api_password . "&api_id=" . $api->api_id . "&to=" . $mobile_arr[$i] . "&text=" . $api_class->text . "&concat=" . $api_class->cost;
				if ($api->api_type == 1) {
					$url .= "&from=" . $api->sender_name;
				}
				//如果短信内容包含中文,需要加unicode=1
				if ($unicode==1) {
					$url .= "&unicode=1";
				}
				//echo $url . "<br />";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				 $content= curl_exec($ch);  	  

				curl_close($ch);

				//判断返回的内容是否包含ID
				if (strpos($content, "ID:") !== false) {
					//发送成功		
					if ($success_count == 0) {
						$success_list = "[" . $mobile_arr[$i] . "]";
					} else {
						$success_list .= ",[" . $mobile_arr[$i] . "]";
					}
					$success_count++;
				} else {
					//发送失败		
					$message->sms_record_remark = $content;
					if ($fail_count == 0) {
						$fail_list = "[" . $mobile_arr[$i] . "]";
					} else {
						$fail_list .= ",[" . $mobile_arr[$i] . "]";
					}
					$fail_count++;
				}

			}
			$message = new message();
			$message->api_id = $api->api_id;
			$message->sms_record_time = date(TIME_FORMAT);
			$message->sms_success_list = $success_list;
			$message->sms_fail_list = $fail_list;
			$message->sms_success_count = $success_count;
			$message->sms_fail_count = $fail_count;
			$message->sms_content = $api_class->text;
			$message->user_id = $api->user_id;
			$message->company_id = $api->company_id;
			$message->department_id = $api->department_id;
			$end_time = date(TIME_FORMAT);
			$message->sms_record_remark .= "start at " . $start_time . "; end at " . $end_time;

			$company = new company();
			$company->company_id = $api->company_id;
			$company->deductBalance($message->sms_success_count * $api_class->cost);

			$message->sendMessage();

			$result["status"] = "success";
			$result["message"] = "success:" . $success_count . ",fail:" . $fail_count;
		}
	}
	return $result;
}
$callBack = $_REQUEST['callbackFunction'];

if ($callBack != "") {
	$return = $callBack . "(" . json_encode($result) . ")";
} else {
	$return = json_encode($result);
}
/*
function formatMobile($mobile){
	echo $mobile;
	$paten=^\d{11}$;
	die();
}*/

//	$return = json_encode($result);
//while (@ob_end_clean());
//	header('Cache-Control: no-cache');
//header('Content-type: application/json');
print_r($return);
function countCharacters($text) {
	$length = mb_strlen($text);
	$credit = 1;
	if (preg_match('/[\x80-\xff]./', $text)) {
		//中文计算短信条数的方法
		if ($length <= 70) {
			$credit = 1;
		} else
			if ($length > 70 && $length <= 134) {
				$credit = 2;
			} else
				if ($length > 134 && $length <= 201) {
					$credit = 3;
				} else
					if ($length > 201&& $length <= 268) {
						$credit = 4;
					} else
						if ($length > 268) {
							$credit = 5;//最长335
						}
	} else {
		//英文计算短信条数的方法
		if ($length <= 160) {
			$credit = 1;
		} else
			if ($length > 160 && $length <= 306) {
				$credit = 2;
			} else
				if ($length > 306 && $length <= 459) {
					$credit = 3;
				} else
					if ($length > 459 && $length <= 612) {
						$credit = 4;
					} else
						if ($length > 612) {
							$credit = 5;
						}
	}

	return $credit;
}
function formatMobile($mobile) {

	$length = mb_strlen($mobile);
	$aus = substr($mobile, 0, 2);
	$tt = substr($mobile, 1, $length);

	if ($aus == "04") {
		$mobile = "61" . substr($mobile, 1, $length -1);
	}
	return $mobile;
}
function getUnicode($word){
	$word0 = iconv('gbk', 'utf-8', $word);
    $word1 = iconv('utf-8', 'gbk', $word0);
    $word =  ($word1 == $word) ? $word0 : $word;
	 // 拆分汉字
   preg_match_all('#(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+)#s', $word, $array, PREG_PATTERN_ORDER);
    foreach ($array[0] as $cc)
    {
		if(preg_match('/[\x80-\xff]./', $cc)){
			$arr = str_split($cc); 
			$bin_str = '';
			foreach ($arr as $value)
			{
				$bin_str .= decbin(ord($value));
			}
			$bin_str = preg_replace('/^.{4}(.{4}).{2}(.{6}).{2}(.{6})$/','$1$2$3', $bin_str);
			$return[] =  dechex(bindec($bin_str));
			//echo $cc."是中文"."<br />";
		}else{
			//$return[] =bindec($cc);
			$arr = str_split($cc); 
			$bin_str = '';
			foreach ($arr as $value)
			{
				$bin_str .= decbin(ord($value));
				
			}
			$str=dechex(bindec($bin_str));
			
			if(strlen($str)<4){
				for($i=strlen($str);$i<4;$i++){
					$str="0".$str;
				}
			}
			$return[] = $str;
			
			//echo $cc."不是中文"."<br />";
	
		}
    }
    return implode('', $return);
}
?>