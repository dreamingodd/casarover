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
<?php include_once 'WechatSeriesDao.php';?>
<div id="container">
    <!-- nav bar start -->
    <?php include '../backstage/navigator.php';?>
    <input type="hidden" id="page" value="wechat"/>
    <!-- nav bar end -->

    
    <div class="options vertical5">
        <a href="wechat_series_edit.php">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
        </a>
    </div>
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>名称</th>
            <th>父标题</th>
            <th>操作</th>
        </tr>
    <?php
    $dao = new WechatSeriesDao();
    $series_rows = $dao->getAll();
    $number = 1;
    while ($row = mysql_fetch_array($series_rows)) {
    ?>
        <tr>
            <td><?php echo $number++?></td>
            <td><?php echo $row['name']?></td>
            <td>
                <?php echo ($row['type']==1 ? "探庐系列":"")?>
                <?php echo ($row['type']==2 ? "民宿风采":"")?>
                <?php echo ($row['type']==3 ? "主题民宿":"")?>
            </td>
            <td>
                <a href='wechat_series_del_action.php?id=<?php echo $row["id"]?>'>
                    <button disabled type="button" class="btn btn-xs btn-danger">删除</button>
                </a>
            </td>
        </tr>
    <?php 
    };
    ?>
    </table>
</div>
</body>
</html>