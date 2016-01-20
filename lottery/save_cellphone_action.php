<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/WechatLotteryService.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/SessionController.php';?>
<?php 
$cellphone = $_GET['cellphone'];
$wls = new WechatLotteryService();
$sc = new SessionController();
$openid = $sc->getCode();
if (isset($openid)) {
    $wls->save_winner_cellphone($openid, $cellphone);
    echo "{\"msg\":\"success\"}";
} else {
    echo "{\"error\":\"获取中奖信息失败！请点击上方抽奖按钮！\"}";
}
?>