<?php

//require 'jssdk/jssdk.php';
//$jssdk = new JSSDK("wxeafd79d8fcbd74ee", "5db9a898bdd7f430bbc563476021f4b2");
//$signPackage = $jssdk->GetSignPackage();

//
$openid = $_GET['openid'];

if(empty($openid)){
   header("Location:index.php");
};
?>
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
        function pay(){
            //获取输入框的值，对手机号进行验证
            var phone = document.getElementById('number').value;
            if(! phone){
                alert("请填写手机号");
                return;
            }
            if(phone.length != 11){
                alert("请检查手机号是否正确");
                return;
            }else{
                //调支付操作，但是如果不能使用微信支付那么跳转到人工页面
                sedjson(phone);
            };
        }
        function sedjson(phone) {

            var postData = {
                "id": "<?php echo $openid; ?>",
                "phone": phone
            };

            postData = (function(obj){
                var str = "";
                for(var prop in obj){
                    str += prop + "=" + obj[prop] + "&"
                }
                return str;
            })(postData);
            var xhr = new XMLHttpRequest();
             
            xhr.open("POST", "./model/respose.php", true);
            xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xhr.onreadystatechange = function(){
                var XMLHttpReq = xhr;
                if (XMLHttpReq.readyState == 4) {
                    if (XMLHttpReq.status == 200) {
                        var text = XMLHttpReq.responseText;
                        if(text == 'ok'){
                            window.location.href = 'person.php';
                        }else {
                            alert('>_<');
                        }
                    }
                }
            };
            xhr.send(postData);
        }
    </script>
</head>
<body>
<div class="container">

    <div class="head-img">
        <img src="http://7xp9p2.com1.z0.glb.clouddn.com/head3.jpg" width="100%" alt="">
    </div>

    
    <section>
        <h3>牛满汕无门槛50元代金券一张</h3>
        <h3>水晶城折叠伞一把</h3>
        <h3>有茶出沫全城通用奶茶券2张</h3>
        <h3>探庐者大礼包一份</h3>
        <h3>……</h3>
        <h3>不止于此</h3>
        <p>ps:两人组队，一人报名，报名费共计40元</p>

    </section>

    <div class="weui_cell">
    <div class="weui_cell_bd weui_cell_primary">
        <input class="weui_input" type="number" pattern="[0-9]*" placeholder="请输入手机号" id="number">
    </div>
    </div>

    <div class="weui_btn_area">
        <a class="weui_btn weui_btn_primary" href="javascript:" id="pay" onclick="pay()">去支付</a>
    </div>
</div>
<!--<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>-->
<script>
//  wx.config({
//    debug: true,
//    appId: '<?php //echo $signPackage["appId"];?>//',
//    timestamp: <?php //echo $signPackage["timestamp"];?>//,
//    nonceStr: '<?php //echo $signPackage["nonceStr"];?>//',
//    signature: '<?php //echo $signPackage["signature"];?>//',
//    jsApiList: [
//      // 所有要调用的 API 都要加到这个列表中
//      'checkJsApi'
//    ]
//  });
//  wx.ready(function () {
//    wx.checkJsApi({
//      jsApiList: [
//        'getNetworkType',
//        'previewImage'
//      ],
//      success: function (res) {
//        alert(JSON.stringify(res));
//      }
//    });
//  });
</script>
</body>
</html>
