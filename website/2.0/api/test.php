<?php
$val = array("message" => "第一个","short"=>"这个是介绍","pic"=>"images/fang.jpg");
$val2 = array("message" => "第二个" , "short"=>"这个是第二个介绍","pic"=>"images/fang.jpg");
$data = array($val);

$json_data = json_encode($data);
echo $json_data;

?>