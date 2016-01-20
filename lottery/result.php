<!DOCTYPE html>
<html lang="en">
<head>
<?php $rand = rand(1000, 9999); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <title>我的抽奖结果</title>
    <link rel="stylesheet" href="css/result.css?rand=<?php echo $rand; ?>">
    <script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#input-phone").click(function() {
                var phone = $("#phone").val();
                var phone_confirm = $("#phone_confirm").val();
                // console.log(phone.length);
                if (!phone || !phone_confirm) {
                    alert("两个手机号均不能为空！");
                    return;
                } else if (phone.length != 11 || phone_confirm.length != 11) {
                    alert("手机号长度错误");
                    return;
                } else if (phone != phone_confirm) {
                    alert("两次输入的手机号不一致");
                    return;
                }
                var getUrl = 'save_cellphone_action.php';
                $.ajax({
                type:'get',
                url: getUrl,
                data: {
                    cellphone:phone,
                },
                success: function(data) {
                    console.log(data);
                    var k = data.msg;
                    console.log(data);
                    if(k){
                        $(".full").css('display','block');
                        $(".bottom").css('display','none');
                        document.documentElement.scrollTop = document.body.scrollTop =0;
                    }else{
                        alert(data.error);
                    }
                },
                dataType: 'json',
                error:function (data) {
                    console.log(data);
                    alert("something is wrong");
                }
                });
            })
        })
    </script>
</head>
<?php
$lott = $_GET["price"];
$r = $_GET["casa"];
$gua = $_GET["gua"];
$data = json_decode(file_get_contents("data.json"));
$casa = $data[$r];
?>
<body>
<header>
    <div class="head-pic">
        <img src="photo/logo.png" width="100%" alt="">
    </div>
    <div class="slogn">探寻远方的家</div>
    <div class="us"><a href=""></a><a href="http://mp.weixin.qq.com/s?__biz=MzI3MDA4NjAxNQ==&mid=401119888&idx=1&sn=b53c5bbbf6cf9117a78f4308c00af325#rd&ADUIN=744007114&ADSESSION=1451353714&ADTAG=CLIENT.QQ.5455_.0&ADPUBNO=26550">关注</a></div>
    <div class="us"><a href=""></a><a href="http://mp.weixin.qq.com/s?__biz=MzI3MDA4NjAxNQ==&mid=401153709&idx=1&sn=a749d37250e521b27a2374c61a4378db#rd">抽奖</a></div>
</header>
<div class="main">
<div class="full">
    关注我们的公众账号<br>然后向后台发送“领奖”
</div>
    <div class="luck">
            <img src="photo/t.png" width="100%" alt="">
        <div class="luck-mess">
            <p>我的新年第一卦 ：<?php echo $casa->gua[$gua]->name?></p>
            <p>我的幸运方位 ：<?php echo $casa->gua[$gua]->fangwei?></p>
            <p>我的新年运势 ：<?php echo $casa->gua[$gua]->yunshi ?></p>
            <p>我的新年气质 ：<?php echo $casa->gua[$gua]->qizhi?></p>
            <p>我的新年宜居民宿 ：<?php echo $casa->name?></p>
        </div>
        <p>
            <img src="photo/b.png" width="100%" alt="">
        </p>
    </div>

    <div class="joke">
        <p>新年一乐:</p>
        <?php echo $casa->gua[$gua]->joke ?>
    </div>
    <div class="place">
        <h3><?php echo $casa->name?></h3>
        <section></section>
        <div class="pic">
            <img src="<?php echo $casa->photo;?>" width="100%" alt="">
        </div>
        <section></section>
        <div style="font-size:12px;"><?php echo $casa->short; ?></div>
        <br/>
        <div class="ad">
            <p>
                <?php echo $casa->info; ?>
            </p>
        </div>
        <br/>
        <div class="phone" >联系电话：<?php echo $casa->phone ;?></div>
        <div class="address" >地址：<?php echo $casa->address ?></div>
    </div>
    <div class="reward">
            <img src="photo/re.png">
        <div class="reward-mess">
        <?php if($lott ==-1):?>
            <p>明天再来试试吧</p>
        <?php endif?>
        <?php if($lott == 0 ):?>
            <p>没抽中啊，别灰心，听说关注我们之后能大幅提升中奖几率呢</p>
        <?php endif?>
        <?php if($lott ==2 ):?>
            <p>恭喜你获得10元话费</p>
            <div class="get-phone">
                <h3>请填写真实有效的手机号</h3>
                <input type="text" id="phone"><br/><br/>
                <input type="text" id="phone_confirm"><br/><br/>
                <button id="input-phone">立刻领奖</button>
            </div>
        <?php endif?>
        <?php if($lott ==3):?>
            <p>你人品怎么这么好呢？2元红包送给你，快快戳领奖 </p>
            <div class="get-phone">
                <h3>请填写真实有效的手机号</h3>
                <input type="text" id="phone"><br/><br/>
                <input type="text" id="phone_confirm"><br/><br/>
                <button id="input-phone">立刻领奖</button>
            </div>
        <?php endif?>
        </div>
    </div>
</div>
<br>
</body>
</html>