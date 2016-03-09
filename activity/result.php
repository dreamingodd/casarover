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
        <img src="img/blq.png" width="100%" alt="">    
    </div>
    <!-- 第一次进入 -->
    <?php
        // 跳转到活动介绍的页面

    ?>
    <!-- 购买成功 -->
<!--     <div class="group-num">
        <h1>你们的组号</h1>
        <h1>01</h1>
    </div> -->
    
    <!-- 如果没有支付 -->
    <h3 style="text-align: center;">订单关闭（超时未付款）</h3>
    <div class="weui_btn_area">
        <a class="weui_btn weui_btn_primary" href="javascript:" id="showTooltips">去购买</a>
    </div>

    <div class="hd">
    <br>
        <h1 class="page_title">游园福利</h1>
    </div>

    <section>
        <h3>电影券<span>（近期热映随你选）</span></h3>
        <h3>餐厅券<span>（可携带一名死党去哟）</span></h3>
        <h3>咖啡券<span>（带TA一起去）</span></h3>
        <h3>超级礼物袋<span>（开袋有惊喜）</span></h3>
        <h3>活动日期：3月20号（本周日）</h3>
    </section>
</div>

</body>
</html>