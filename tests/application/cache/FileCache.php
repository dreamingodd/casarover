<?php

/**
* 对查询结果进行缓存
*/
// class Fcache extends {
	

// }


$f = '../../../cache/cache.php';
// $k = file_get_contents($f);
$url = "http://localhost/casarover/website/casa.php?casa_id=4";
$html_content = file_get_contents($url);
$fp = fopen($f, 'w');
echo strlen($html_content);
fwrite($fp, $html_content);
// var_dump($html_content);
fclose($fp);
// $write_time = time() + 5;
// if ($k->write_time < time()) {
// 	$fp = fopen($f, "w");
// 	$message = array('name' => 'van' , );
// 	$data = array('write_time' => $write_time,'message' => $message );
// 	fwrite($fp, json_encode($data));
// 	fclose($fp);
// } else {
	
// }




?>