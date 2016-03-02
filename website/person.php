<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/SessionController.php';?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>个人页面</title>
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/person.css">
<link rel="icon" href="http://casarover.oss-cn-hangzhou.aliyuncs.com/image/favicon.ico">

<!--[if lt IE 9]>
  <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="js/integration/jquery.min.js"></script>
<script src="js/integration/bootstrap.min.js"></script>
<script src="js/main.js" type="text/javascript"></script>
<script src="js/person.js"></script>
<script src="js/integration/birthday.js"></script>
</head>
<body>
<?php include 'login.php';?>
<!-- body起始位置 -->
<?php include 'header.php';?>
<?php echo dirname(__FILE__); ?>
<div class="container">
    <div class="person-main">
        <div class="col-md-2"></div>
        <div class="col-md-8">
        <form action="" method="post">
            <div class="head-pic">
            <a href="">
                <input type="file">
                <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/image/weixin.jpg" alt="">
            </a>
            </div>
            <?php 
            $sessionController = new SessionController();
            $user_json = $sessionController->getUserJson();
            // var_dump($user_json);
            if (empty($user_json)) {
                header('Location:index.php');
                exit();
            } else {
                $user = json_decode($user_json);
            }
            ?>
            <div class="name">
                <span><?php echo $user->username ?></span>
                <input type="text" placeholder="10个字符以内" class="form-control">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true" id="change-name"></span>
            </div>
            <div class="person-message">
                <div class="message-main">
                <div class="list phone">
                    <span style="float:left">手机：</span>
                    <input type="text" id="true-phone" placeholder="真实手机号" class="form-control"> 
                    <span id="num">123****8911</span>
                    <button class="btn btn-default" id="change-phone" type="button">修改</button>
                    <button class="btn btn-default" id="get-code" type="button">获取验证码</button>
                </div>
                <div class="list">
                    <span>性别：</span>
                    <label class="sex-radio">
                     <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked="checked"/>男
                    </label> <label class="sex-radio"> <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 女</label>
                </div>
                <div class="list">
                    <span>生日：</span>
                    <select class="sel_year" rel="2000"></select>年 <select class="sel_month" rel="2"></select>月
                    <select class="sel_day" rel="14"></select>日
                </div>
                <button class="btn btn-default save">保存</button>
                </form>
                </div>
            </div>
            <div class="card-main">
                <h3>我的收藏</h3>
                <div class="card" style="background-image: url('http://casarover.oss-cn-hangzhou.aliyuncs.com/image/cs.png'); ">
                    <p>旅行者漫步主题民宿</p>
                </div>
                <div class="card" style="background-image: url('http://casarover.oss-cn-hangzhou.aliyuncs.com/image/cs.png'); ">
                    <p>旅行者漫步主题民宿</p>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php';?>
</div>
</body>
</html>