<?php
$val = array("message" => "第一个","short"=>"这个是介绍","pic"=>"images/fang.jpg");
$val2 = array("message" => "第二个" , "short"=>"这个是第二个介绍","pic"=>"images/fang.jpg");
$val3 = array("message" => "第二个" , "short"=>"这个是第二个介绍","pic"=>"images/fang.jpg");
$val4 = array("message" => "第二个" , "short"=>"这个是第二个介绍","pic"=>"images/fang.jpg");
$val5 = array("message" => "第二个" , "short"=>"这个是第二个介绍","pic"=>"images/fang.jpg");
$val6 = array("message" => "第二个" , "short"=>"这个是第二个介绍","pic"=>"images/fang.jpg");

$data = array($val,$val2,$val3,$val4,$val5,$val6);

$json_data = json_encode($data);
echo $json_data;

?>