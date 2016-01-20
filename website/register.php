<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>注册</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/regist.css">
<script src="js/integration/jquery.min.js" type="text/javascript"></script>
<script src="js/integration/jquery.flexslider-min.js" type="text/javascript"></script>
<script src="js/integration/jquery.flexslidera-min.js" type="text/javascript"></script>
<script src="js/integration/bootstrap.min.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>
<script src="js/register.js" type="text/javascript"></script>
</head>
<body>
<?php include '301.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<input type="hidden" id="web_url" value="<?php echo getUrl()?>"/>
<div style="position:absolute; width:100%; height:100%; z-index:-1">
    <img src="image/bg3.jpg" height="100%" width="100%"/>
</div>
<div class="container">
    <div class="regist-main">
        <div class="slogan">
            <h1>探庐者</h1>
            <br />
            <h4>寻觅远方的家</h4>
        </div>
        <div class="regist">
            <div class="regist-input">
                <div class="regist-header"></div>
                <div class="regist-form">
                    <form id="register_form" class="" method="post">
                        <div class="form-group regist-message">
                            <input type="text" class="form-control" name="cellphone_number" id="cellphone_number" placeholder="手机号">
                        </div>
                        <div class="form-group regist-message">
                            <div class="login-input-code">
                                <input type="text" class="form-control form-code" id="verify_code" name="verify_code" placeholder="验证码">
                                <div id="get-code" class="get-code">获取验证码</div>
                                <div id="get-code-dummy" class="get-code" style="display:none;">获取验证码</div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="form-group regist-message">
                            <input type="password" class="form-control" id="password" name="password" placeholder="设置密码（必须包含字母和数字，不少于6位）">
                        </div>
                        <div class="logn_sub">
                            <input type="button" id="register" class="btn btn-default btn-block btn-bgc" value="注册">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>