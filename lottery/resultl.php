<!DOCTYPE html>
<html lang="en">
<head>
<?php $rand = rand(1000, 9999); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <title>结果</title>
    <link rel="stylesheet" href="css/result.css?rand=<?php echo $rand; ?>">
    <script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#input-phone").click(function() {
                var phone = $("#phone").val();
                // console.log(phone.length);
                if (phone.length < 11) {
                    alert("手机号长度错误");
                    return;
                };
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
                    if(k){
                        $(".full").css('display','block');
                        $(".bottom").css('display','none');
                        document.documentElement.scrollTop = document.body.scrollTop =0;
                    }else{
                        alert("出了点小问题");
                    }
                },
                dataType: 'json',
                error:function (data) {
                    console.log(data);
                    alert("something is wrong");
                }
                });
            });
        });
    </script>
</head>
<?php
$lott = $_GET["price"];
$data = json_decode(file_get_contents("data.json"));
$r = rand(0,7);
$casa = $data[$r];
$gua = rand(0,3);
// 分段
$yunshi = explode('，', $casa->gua[$gua]->yunshi);
?>
<body>
<header>
    <div class="head-pic">
        <img src="photo/logo.png" width="100%" alt="">
    </div>
    <div class="slogn">探寻远方的家</div>
    <div id="us"><a href="http://mp.weixin.qq.com/s?__biz=MzI3MDA4NjAxNQ==&mid=401119888&idx=1&sn=b53c5bbbf6cf9117a78f4308c00af325#rd&ADUIN=744007114&ADSESSION=1451353714&ADTAG=CLIENT.QQ.5455_.0&ADPUBNO=26550">关注</a></div>
</header>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/WechatLotteryService.php';?>
    <div class="show">
        <div class="left">
            <div class="pic">
                <img src="<?php echo $casa->photo; ?>" width="100%" alt="">
            </div>
        </div>
        <div class="full">
            关注我们的公众账号<br>然后向后台发送“领奖”
        </div>
        <div class="message">
            <div class="title">
                <?php echo $casa->gua[$gua]->name; ?>
            </div>
            <div class="section">
                <p>方位 ：<?php echo $casa->gua[$gua]->fangwei?></p>
                <p>新年运势 ：<?php echo $yunshi[0] ?></p>
                <p><?php echo $yunshi[1] ?></p>
                <p>新年气质 ：<?php echo $casa->gua[$gua]->qizhi?></p>
                <p>宜居民宿 ：<?php echo $casa->name?></p>
            </div>
        </div>
    </div>
    <div class="lott-mess">
        <?php if ($lott == 2):?>
            <div class="lottery">
                <p>恭喜你获得10元话费充值</p>
                <div class="get-phone">
                    <h3>请填写真实有效的手机号</h3>
                    <input type="text" id="phone">
                </div>
                <button id="input-phone">立刻领奖</button>
            </div>
        <?php endif;?>
        <?php if($lott ==3):?>
            <div class="lottery">
                <p>你人品怎么这么好呢？2元红包送给你，快快戳“领奖” </p>
                <div class="get-phone">
                    <h3>请填写真实有效的手机号</h3>
                    <input type="text" id="phone">
                </div>
                <button id="input-phone">立刻领奖</button>
            </div>
        <?php endif;?>
        <?php if($lott ==0):?>
            <div class="lottery">
                <p>别灰心，听说关注我们之后有助于提高中奖概率哟</p>
            </div>
        <?php endif;?>
        <?php if($lott == -1):?>
            <div class="lottery">
                <?php ?>
                <p>每天只能抽<?php echo WechatLotteryService::DAY_LIMIT;?>次哟，推荐你的朋友们来试试吧</p>
            </div>
        <?php endif;?>
    </div>
    <div class="joke">
        <p>新年一乐:</p>
        <?php echo $casa->gua[$gua]->joke ?>
    </div>
    <div class="bottom">
        <div style="font-size:22px"><?php echo $casa->name?></div>
        <section style="width: 40%; box-sizing: border-box;padding-top: 2px; padding-right: 2px; padding-left: 2px; border-top-width: 3px; border-top-style: solid;border-top-color: rgb(33, 33, 34); color: rgb(0, 0, 0); font-size: 14px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(33, 33, 34); display: inline-block;" data-width="40%"></section>
        <div style="font-size:12px;"><?php echo $casa->short; ?></div>
        <div class="ad">
            <p>
                <?php echo $casa->info; ?>
            </p>
        </div>
        <div class="phone" >联系电话：<?php echo $casa->phone ;?></div>
        <div class="address" >地址：<?php echo $casa->address ?></div>
    </div>
    <br>
    <br>
</body>
</html>