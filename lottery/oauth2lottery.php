<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/PropertyManager.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/SessionController.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/RewardDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/WechatLotteryService.php';?>
<?php 
// Get wechat openid 获取微信openid
$code = $_GET['code'];
$appid = "";
$secret = "";
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

/** For your local testing: */
$pm = new PropertyManager();
$dummy_openid = $pm->getDummyOpenid();
if (empty($openid) && isset($dummy_openid)) {
    $openid = $dummy_openid;
}
/** localhost test context END.*/

// Lottery logic
if (isset($openid)) {
    $r = rand(0,7);
    $gua = rand(0,3);

    // Draw lottery. 抽奖放在这里
    $wls = new WechatLotteryService();
    // Today's drawing time. 第几次抽奖
    $today_time = $wls->save_onelot($openid);
    $rewardDao = new RewardDao();
    $reward_row = $rewardDao->getByOpenid($openid);
    if ($today_time == WechatLotteryService::OVER_LIMIT) {
        // Draw action over daily limit
        header("Location:result.php?price=-1&casa=".$r."&gua=".$gua);
    } else if ($reward_row) {
        // Already won, 中过奖了
        header("Location:result.php?price=0&casa=".$r."&gua=".$gua);
    } else {
        $win = $wls->draw();
        // 中奖了
        if ($win) {
            // 中了几等奖
            $price_level = $wls->draw_price();
            // save in session
            $sc = new SessionController();
            $sc->addCode($openid);
            // save in database
            $wls->save_winner($openid, $price_level);
            // redirect
            header("Location:result.php?price=".$price_level."&casa=".$r."&gua=".$gua);
        } else {
            header("Location:result.php?price=0&casa=".$r."&gua=".$gua);
        }
    }
} else {
    echo "微信信息获取失败！";
}
/*//根据openid和access_token查询用户信息
$get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token
        .'&openid='.$openid.'&lang=zh_CN';
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$get_user_info_url);
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
$res = curl_exec($ch);
curl_close($ch);
//解析json
$user_obj = json_decode($res,true);
$_SESSION['user'] = $user_obj;
print_r($user_obj);
*/
?>