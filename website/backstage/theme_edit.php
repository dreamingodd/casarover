<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="css/all.css" rel="stylesheet" />
<script src="../js/integration/jquery.min.js"></script>
<script src="../js/integration/bootstrap.min.js"></script>
<script src="../js/integration/jquery.form.js"></script>
<script src="../js/integration/json2.js"></script>
<script src="js/all.js"></script>
<script src="js/theme_edit.js"></script>
<title>探庐者后台-编辑主题</title>
</head>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/check_admin_login_action.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/ThemeDao.php';?>
<?php
$id = $_GET['id'];
$row = null;
if (!empty($id)) {
    $themeDao = new ThemeDao();
    $row = $themeDao->getById($id);
}
?>
<body>
<div id="container">
    <!-- nav bar start -->
    <?php include 'navigator.php';?>
    <input type="hidden" id="page" value="home"/>
    <!-- nav bar end -->

    <h3>主题编辑</h3>
    <form id="theme_form" method="post" action="../../application/controllers/theme_action.php?action=edit">
        <input type="hidden" id="id" name="id" value="<?php echo $id?>"/>
        <input type="hidden" id="attachment_id" name="attachment_id" value="<?php echo $wa->attachment_id;?>"/>
        <input type="hidden" id="deleted" name="deleted" value="<?php echo $wa->deleted;?>"/>
        <div class="col-lg-12 vertical5">
            <div class="input-group input-group-sm col-lg-2">
                <span class="input-group-addon" id="sizing-addon3">名称</span>
                <input id="name" type="text" class="form-control" aria-describedby="sizing-addon3"
                        name="name" value="<?php echo $row['name']; ?>"/>
            </div>
        </div>
        <div class="col-lg-12 vertical5">
            <div class="input-group input-group-sm col-lg-4">
                <span class="input-group-addon" id="sizing-addon3">简介</span>
                <input id="description" type="text" class="form-control" aria-describedby="sizing-addon3"
                        name="description" value="<?php echo $row['description']; ?>"/>
            </div>
        </div>
    </form>
    <div class="col-lg-12 vertical5">
        <div class="input-group input-group-sm col-lg-10">
            <span class="input-group-addon" id="sizing-addon3">微信链接（必须微信端复制链接，如已选择民宿，则不起作用）</span>
            <input id="link" type="text" class="form-control" aria-describedby="sizing-addon3"
                    name="link" value="<?php echo $row['link']; ?>"/>
        </div>
    </div>
    <div class="col-lg-12">
        <button style="margin-left: 15px; margin-top: 30px;" class="btn btn-info" id="submit">提交</button>
    </div>
</div>
</body>
</html>