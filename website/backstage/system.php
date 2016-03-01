<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="css/all.css" rel="stylesheet"/>
<script src="../js/integration/jquery.min.js"></script>
<script src="../js/integration/bootstrap.min.js"></script>
<script src="../js/integration/jquery.form.js"></script>
<script src="js/all.js"></script>
<title>探庐者后台-系统功能</title>
</head>
<body>
<?php include '../301.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/check_admin_login_action.php';?>
<div id="container">
    <!-- nav bar start -->
    <?php include 'navigator.php';?>
    <input type="hidden" id="page" value="system"/>
    <!-- nav bar end -->
    <div style="margin-left: 100px;">
        <a href="photo_clean.php">
            <button class="btn btn-info">清理冗余图片</button>
        </a>
    </div>
</div>
</body>
</html>