<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
<title>住民宿，享好运</title>
<script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jQueryRotate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#sel").click(zhuan);
    function zhuan() {
        var angle = 0;
        var angle2 =0;
        var zhuan=setInterval(function(){
                angle+=19;
                angle2+=3;
                $("#img").rotate(angle2);
                $("#tip").rotate(angle);
                if(angle >= 1395){
                    clearInterval(zhuan);
                    location.href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxeafd79d8fcbd74ee'
                            + '&redirect_uri=http://www.casarover.com/casarover/lottery/oauth2lottery.php'
                            + '&response_type=code&scope=snsapi_base&state=1#wechat_redirect';
                }               
            },20); 
    }
})
</script>
<style type="text/css">
*{
    margin:0;padding:0;
}
body{
    font-family: '微软雅黑';
}
img{
    border:0
}
#mian{
    width: 100%;
    height: 100%;
    overflow: hidden;
}
.title{
    width: 100%;
    height: 90px;
}
.title img{
    width: 90px;
}
.title h2{
    color: #6699FF;
    text-align: center;
}
.title h3{
    color: #ffffff;
}
.middle{
    width: 300px;
    height: 300px;
    margin:0 auto;
    overflow: hidden;
    text-align: center;
}
.message{
    width: 100%;
    height: 100%;
    overflow: hidden;
}
#sel{
    margin:0 auto;
    width: 150px;
    height: 50px;
    line-height: 50px;
    border: 1px solid #eee;
    border-radius: 5px;
    /*box-shadow: 5px 5px 5px #888888;*/
    background: #6699FF;
    color: #ffffff;
    text-align: center;
}
#img{
    position: absolute;
    z-index: 20;
    top: 70px;
    left:15%;
}
#tip{
    top: 70px;
    left:15%;
    position:absolute;
    cursor:pointer;
    z-index: 99;
}
.show{
    margin-top: 20px;
}
.show p{
    text-align: center;
    color: #6699FF;
    margin-bottom: 4px;
}
</style>
</head>
<body>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/WechatLotteryService.php';?>
<div style="position:absolute; width:100%; height:100%; z-index:-1">
    <img src="photo/bg.jpg" height="100%" width="100%"/>
</div>
<div id="mian">
    <div class="title">
        <img src="../website/image/logo.png" alt="">
        <h2>新年探庐大抽奖</h2>   
    </div>
    <div class="middle">
            <img id="img" src="photo/02.png" width="70%" >
            <img id="tip" src="photo/01.png" width="70%" >
    </div>
    
    <div class="message">
     <div class="show">
        <p >每天可以抽<?php echo WechatLotteryService::DAY_LIMIT;?>次哟</p>
    </div>
        <div id="sel">立刻抽取</div>
    </div>

</div>
</body>
</html>