<?php

require 'message.php';


$openid = $_POST['id'];
$phone = $_POST['phone'];

if($openid && $phone){
    $message = new Message();
    $data = array('openid' => $openid , 'phone' => $phone);
    $message->save($data);
    echo "ok";
}else{
    echo "error";
}