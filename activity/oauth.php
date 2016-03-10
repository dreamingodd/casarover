<?php
// Get wechat openid 获取微信openid
$code = $_GET['code'];
$appid = "wxeafd79d8fcbd74ee";
$secret = "5db9a898bdd7f430bbc563476021f4b2";
$get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='
    .$secret.'&code='.$code.'&grant_type=authorization_code';
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$get_token_url);
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
$res = curl_exec($ch);
curl_close($ch);
$json_obj = json_decode($res,true);
$access_token = $json_obj['access_token'];
$openid = $json_obj['openid'];

// echo $openid;

//通过openid在数据库查询如果已经购买过跳转到购买成功的页面

if($good)
{
   header("Location:result.php");
}
else
{
   header("Location:home.php");
}
