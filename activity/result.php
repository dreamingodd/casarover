<?php

require 'model/message.php';

$openid = $_GET['openid'];
//$openid = '123';
$message = new Message();
$good = $message->get($openid);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>报名成功</title>
    <link rel="stylesheet" href="style/weui.css"/>
    <style>
        .container{
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .weui_cell{
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }
        h1{
            text-align: center;
        }
        h3{
            margin-top: 5px;
        }
        h3 span{
            font-size: 0.8em;
        }
        section{
            text-align: center;
            margin-bottom: 5px;
        }
        .group-num{
            border:1px solid #4E4E4E;
            width: 60%;
            margin:0 auto;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="head-img">
        <img src="http://7xp9p2.com1.z0.glb.clouddn.com/head3.jpg" width="100%" alt="">
    </div>
    <!-- 第一次进入 -->
    <?php
    if( $openid == null){
        header("Location:index.php");
        exit();
    }
    ?>
    <!-- 购买成功 -->
    <?php if($good[0]["status"] == 1): ?>
        <?php
        $loc = $_GET["loc"];
//        $loc = 1;
        if($loc == null){
            $page = 'http://mp.weixin.qq.com/s?__biz=MzI3MDA4NjAxNQ==&mid=401119888&idx=1&sn=b53c5bbbf6cf9117a78f4308c00af325#rd&ADUIN=744007114&ADSESSION=1451353714&ADTAG=CLIENT.QQ.5455_.0&ADPUBNO=26550';
            header("Location:".$page);
            exit();
        }
        ?>
         <div class="group-num">
            <h1>你们的组号</h1>
            <h1><?php echo $good[0]["groupid"]; ?></h1>
         </div>
    <?php endif; ?>
    
    <!-- 如果没有支付 -->
    <?php
        if($good[0]["status"] == 0){
            header("Location:person.php");
        }
    ?>
<!--    <h3 style="text-align: center;">订单关闭（超时未付款）</h3>-->
<!--    <div class="weui_btn_area">-->
<!--        <a class="weui_btn weui_btn_primary" href="javascript:" id="showTooltips">去购买</a>-->
<!--    </div>-->

    <div class="hd">
    <h3 style="text-align: center">
        活动时间：3月20号13:00—18:00
        <br/>
        活动地点：杭州市西湖区白乐桥306号
        <br/>
        小编等你参加闯关赢免费房哦~
    </h3>
    </div>

    <section>
        <p>来就送</p>
        <p>牛满汕无门槛50元代金券一张</p>
        <p>水晶城折叠伞一把</p>
        <p>有茶出沫全城通用奶茶券2张</p>
        <p>探庐者大礼包一份</p>
        <p>……</p>
        <p>不止于此</p>
    </section>
</div>

</body>
</html>
