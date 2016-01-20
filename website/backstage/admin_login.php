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
<title>探庐者-后台管理</title>
</head>
<body>
<?php include '301.php';?>
<div id="container" style="width:400px; color: #777777">
    <h1>Casarover Management</h1>
    <form action="../../application/controllers/login_admin_action.php" class="login_form" method="post">
        <input id="redirect_url" name="redirect_url" type="hidden" value="<?php echo $_GET['redirect_url']?>"/>
        <div class="form-group login-input-m">
            <input id="cellphone_number" name="cellphone_number" type="text" class="form-control" placeholder="Username"/>
        </div>
        <div class="form-group login-input-m">
            <input id="password" name="password" type="password" class="form-control" placeholder="Password"/>
        </div>
        <div id="error_msg" class="checkbox login-checkbox-m" style="color:red;">&nbsp;</div>
        <div class="logn_sub">
            <input id="login" type="submit" class="btn btn-default btn-block btn-bgc" value="Login"/>
        </div>
    </form>
</div>

</body>
</html>