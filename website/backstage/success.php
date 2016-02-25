<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../../website/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="../../website/css/bootstrap-responsive.min.css" rel="stylesheet" />
<link href="css/all.css" rel="stylesheet" />
<link href="css/success.css" rel="stylesheet" />
<script src="../js/integration/jquery.min.js"></script>
<script src="../js/integration/bootstrap.min.js"></script>
<script src="js/success.js"></script>
<script src="js/all.js"></script>
<title>Success</title>
</head>
<body>
<br/>
<div class="alert alert-success" role="alert">
    <?php 
    echo '<input id="type" type="hidden" value="'.$_GET['type'].'"/>';
    echo 'Info: '.$_GET['info'];
    ?>
    <br/>
    <div id="wechat_article_1_btns" class="btns">
        <a href='../wechat/wechat_article_list.php?type=1'>
            <button type="button" class="btn btn-info">返回列表</button>
        </a>
    </div>
    <div id="wechat_article_2_btns" class="btns">
        <a href='../wechat/wechat_article_list.php?type=2'>
            <button type="button" class="btn btn-info">返回列表</button>
        </a>
    </div>
    <div id="wechat_article_3_btns" class="btns">
        <a href='../wechat/wechat_article_list.php?type=3'>
            <button type="button" class="btn btn-info">返回列表</button>
        </a>
    </div>
    <div id="casa_btns" class="btns">
        <a id="casa_list" href='casa_list.php'>
            <button type="button" class="btn btn-info">返回列表</button>
        </a>
        <a id="casa_effect" target="_blank" href='../casa.php?casa_id=<?php echo $_GET["id"]?>'>
            <button type="button" class="btn btn-info">查看效果</button>
        </a>
        <a id="casa_continue" href='casa_edit.php?casa_id=<?php echo $_GET["id"]?>'>
            <button type="button" class="btn btn-info">继续编辑</button>
        </a>
    </div>
    <div id="theme_btns" class="btns">
        <a id="casa_list" href='theme_list.php'>
            <button type="button" class="btn btn-info">返回列表</button>
        </a>
    </div>
    <div id="area_btns" class="btns">
        <a id="casa_list" href='area_list.php'>
            <button type="button" class="btn btn-info">返回列表</button>
        </a>
        <a id="casa_effect" target="_blank" href='../area_guide.php?area_id=<?php echo $_GET["id"]?>'>
            <button type="button" class="btn btn-info">查看效果</button>
        </a>
        <a id="casa_continue" href='area_edit.php?area_id=<?php echo $_GET["id"]?>'>
            <button type="button" class="btn btn-info">继续编辑</button>
        </a>
    </div>
</div>
</body>
</html>