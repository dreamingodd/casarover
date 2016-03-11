<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../website/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="../website/backstage/css/all.css" rel="stylesheet" />
<script src="../website/js/integration/jquery.min.js"></script>
<script src="../website/js/integration/bootstrap.min.js"></script>
<script src="../website/backstage/js/all.js"></script>
<title>探庐者后台-微信管理-活动管理</title>
</head>
<body>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/check_admin_login_action.php';?>
<?php require_once 'model/message.php';?>
<div id="container">
    <!-- nav bar start -->
    <?php include_once '../website/backstage/navigator.php';?>
    <input type="hidden" id="page" value="wechat"/>
    <!-- nav bar end -->
    <div class="options vertical5">
        <a href="participate_list.php?status=0">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>待付款列表
        </a>
        <a href="participate_list.php?status=1">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>已付款列表
        </a>
    </div>
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>手机号</th>
            <th>操作</th>
        </tr>
    <?php
    $dao = new Message();
    $list = $dao->getByStatus($_GET['status']);
    $number = 1;
    foreach ($list as $item) {
    ?>
        <tr>
            <td><?php echo $number++?></td>
            <td><?php echo $item['phone']?></td>
            <td>
                <?php 
                if ($_GET['status']) {
                ?>
                <a href='pay_action.php?id=<?php echo $item["id"]?>&status=0'>
                    <button type="button" class="btn btn-xs btn-warning">取消付款</button>
                </a>
                <?php 
                } else {
                ?>
                <a href='pay_action.php?id=<?php echo $item["id"]?>&status=1'>
                    <button type="button" class="btn btn-xs btn-info">确认付款</button>
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