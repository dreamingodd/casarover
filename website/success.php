<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" />
<link href="css/main.css" rel="stylesheet" />
<script src="js/integration/jquery.min.js"></script>
<script src="js/integration/bootstrap.min.js"></script>
<script src="js/success_error.js" type="text/javascript"></script>
<title>Success</title>
</head>
<body>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<input type="hidden" id="web_url" value="<?php echo getUrl()?>"/>
<!-- 
url input variables:
@countdown: seconds before auto redirecting.
@redirect_url: redirect url for button and auto redirecting.
@type: to determine which dom to show.
-->
<input type="hidden" id="countdown" name="countdown" value="<?php echo $_GET['countdown'] ?>"/>
<input type="hidden" id="redirect_url" name="redirect_url" value="<?php echo $_GET['redirect_url'] ?>"/>
<input type="hidden" id="type" name="type" value="<?php echo $_GET['type'] ?>"/>
<br/>
<div class="alert alert-success" role="alert">
    <?php echo 'Success: '.$_GET['info']?>
    <a href="<?php echo $_GET['redirect_url']?>"><button class="btn btn-default register">登陆</button></a>
    <button id="go_back" type="button" class="btn btn-default back">返回</button>
    <span id="countdown_current"></span>
</div>
</body>
</html>