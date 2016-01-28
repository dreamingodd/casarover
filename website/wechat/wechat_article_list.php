<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $rand = rand(100,999);?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="../backstage/css/all.css" rel="stylesheet" />
<link href="css/wechat_backstage.css?rand=<?php echo $rand;?>" rel="stylesheet" />
<script src="../js/integration/jquery.min.js"></script>
<script src="../js/integration/bootstrap.min.js"></script>
<script src="../js/integration/jquery.form.js"></script>
<script src="../js/integration/json2.js"></script>
<script src="../backstage/js/all.js?rand=<?php echo $rand;?>"></script>
<title>探庐者后台-微信管理</title>
</head>
<body>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/check_admin_login_action.php';?>
<?php include_once 'WechatArticle.php';?>
<?php include_once 'WechatArticleDao.php';?>
<div id="container">
    <!-- nav bar start -->
    <?php include '../backstage/navigator.php';?>
    <input type="hidden" id="page" value="wechat"/>
    <!-- nav bar end -->

    
    <div class="options vertical5">
        <a href="wechat_article_edit.php?type=<?php echo $_GET['type']?>">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加微信文章
        </a>
        <a href="wechat_article_list.php?type=2">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>民宿风采
        </a>
        <a href="wechat_article_list.php?type=1">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>探庐系列
        </a>
        <a href="wechat_article_list.php?deleted=1">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>回收站
        </a>
    </div>
    <table class="table table-hover">
        <tr>
            <th>标题</th>
            <th>简介</th>
            <th>操作</th>
        </tr>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/CasaDao.php';?>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/AreaService.php';?>
    <?php
    $dao = new WechatArticleDao();
    $article_rows = $dao->getByType($_GET['type']);
    if ($_GET['deleted']) {
        $article_rows = $dao->getAll($_GET['deleted']);
    }
    while ($row = mysql_fetch_array($article_rows)) {
    ?>
        <tr>
            <td><?php echo $row['title']?></td>
            <td class="brief"><?php echo $row['brief']?></td>
            <td>
                <?php 
                if ($_GET['deleted']) {
                ?>
                <a href='wechat_article_recycle_action.php?option=recover&type=<?php echo $_GET['type'];?>&id=<?php echo $row["id"]?>&deleted=<?php echo $_GET['deleted']?>'>
                    <button type="button" class="btn btn-xs btn-warning">还原</button>
                </a>
                <?php 
                } else {
                ?>
                <a href='wechat_article_edit.php?type=<?php echo $_GET['type'];?>&id=<?php echo $row["id"]?>'>
                    <button type="button" class="btn btn-xs btn-info">编辑</button>
                </a>
                <a href='wechat_article_recycle_action.php?option=recycle&type=<?php echo $_GET['type'];?>&id=<?php echo $row["id"]?>'>
                    <button type="button" class="btn btn-xs btn-danger">删除</button>
                </a>
                <?php }?>
            </td>
        </tr>
    <?php 
    };
    ?>
    </table>
</div>
</body>
</html>