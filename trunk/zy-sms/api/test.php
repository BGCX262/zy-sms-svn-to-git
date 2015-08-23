<?php 
$a=array("success"=>"success","test"=>"test");
//echo json_encode($a);
$return = "my_callback_method(" . json_encode($a). ")";
while (@ob_end_clean());
header('Cache-Control: no-cache');
header('Content-type: application/json');
print_r($return);
?>