<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"".$_GET['id'].".xls\"");
$data = file_get_contents($_GET['id'].".xls");
echo $data;