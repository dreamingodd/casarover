<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>报名</title>
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
    </style>
    <script>
        
    </script>
</head>
<body>
<div class="container">

    <div class="head-img">
        <img src="img/blq.png" width="100%" alt="">    
    </div>

    <div class="hd">
        <h1 class="page_title">游园福利</h1>
    </div>
    
    <section>
        <h3>电影券<span>（近期热映随你选）</span></h3>
        <h3>餐厅券<span>（可携带一名死党去哟）</span></h3>
        <h3>咖啡券<span>（带TA一起去）</span></h3>
        <h3>超级礼物袋<span>（开袋有惊喜）</span></h3>
        <h3>一次报名，吃喝玩乐都有啦</h3>
        <p>ps:本次活动需要两人一组报名，每人20元</p>

    </section>

    <div class="weui_cell">
    <div class="weui_cell_bd weui_cell_primary">
        <input class="weui_input" type="number" pattern="[0-9]*" placeholder="请输入手机号">
    </div>
    </div>

    <div class="weui_btn_area">
        <a class="weui_btn weui_btn_primary" href="javascript:" id="showTooltips">微信支付</a>
    </div>
</div>

</body>
</html>
