<?php

require 'wxapi.php';

$code = $_GET['code'];
$wxapi = new WXapi();
$openid = $wxapi->getOpenid($code);
//echo $openid;
//通过openid在数据库查询如果已经购买过跳转到购买成功的页面

if($good)
{
   header("Location:result.php?openid=".$openid);
}
else
{
   header("Location:home.php?openid=".$openid);
}
