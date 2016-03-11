<?php

require 'wxapi.php';
require 'model/message.php';

$code = $_GET['code'];
$loc = $_GET['loc'];
$wxapi = new WXapi();
$openid = $wxapi->getOpenid($code);
//echo $openid;
//通过openid在数据库查询如果已经购买过跳转到购买成功的页面
$message = new Message();
$good = $message->get($openid);
if($good)
{
   header("Location:result.php?openid=".$openid.'&loc='.$loc);
}
else
{
   header("Location:home.php?openid=".$openid);
}
