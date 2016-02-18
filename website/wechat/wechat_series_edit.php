<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>探庐者后台-微信管理-子标题编辑</title>
<?php $rand = rand(0, 999);?>
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="../backstage/css/all.css?rand=<?php echo $rand?>" rel="stylesheet" />
<script src="../js/integration/jquery.min.js"></script>
<script src="../js/integration/bootstrap.min.js"></script>
<script src="../js/integration/jquery.form.js"></script>
<script src="../backstage/js/all.js?rand=<?php echo $rand;?>"></script>
</head>
<body>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/check_admin_login_action.php';?>
<div id="container">
    <!-- nav bar start -->
    <?php include '../backstage/navigator.php';?>
    <input type="hidden" id="page" value="wechat"/>
    <!-- nav bar end -->

    <form id="wechat_series_form" method="post" action="wechat_series_add_action.php">
        <div class="col-lg-12">
            <h4>类别</h4>
            <div class="text vertical5 col-lg-2">
                <input disabled id="title" name="type" type="text" class="form-control" value="探庐系列" aria-describedby="sizing-addon3"/>
            </div>
        </div>
        <div class="col-lg-12">
            <h4>名称</h4>
            <div class="name vertical5 col-lg-2">
                <input id="title" name="name" type="text" class="form-control" value="" aria-describedby="sizing-addon3" />
            </div>
        </div>
        <div class="col-lg-12">
            <input type="submit" style="margin-left: 15px; margin-top: 30px;" class="btn btn-info" value="提交"/>
        </div>
    </form>
</div>
</body>
</html>