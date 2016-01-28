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
<script src="js/reward_list.js"></script>
<title>探庐者后台-中奖者列表</title>
</head>
<body>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/check_admin_login_action.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/RewardDao.php';?>
<?php 
$rewardDao = new RewardDao();
$rewards_unreceived = $rewardDao->getAll(0);
$rewards_received = $rewardDao->getAll(1);
?>
<div id="container">
    <?php include 'navigator.php';?>
    <input type="hidden" id="page" value="reward"/>
    <div class="navbar">
        <div class="navbar-inner">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="nav_tab unreceived active">
                    <a href="#">未领奖</a>
                </li>
                <li role="presentation" class="nav_tab received">
                    <a href="#">已领奖</a>
                </li>
            </ul>
        </div>
    </div>

    <table class="table table-hover unreceived">
        <tr>
            <th>手机号码</th>
            <th>奖项</th>
            <th>中奖时间</th>
            <th>操作</th>
        </tr>
        <?php
        while ($row = mysql_fetch_array($rewards_unreceived)) {
            $cellphone = "用户未填写";
            if (!empty($row['cellphone'])) $cellphone = $row['cellphone'];
        ?>
        <tr>
            <td><?php echo $cellphone;?></td>
            <td><?php echo $row['reward_level']?>等奖</td>
            <td><?php echo $row['update_time']?></td>
            <td>
                <a href='../../application/controllers/reward_action.php?id=<?php echo $row["id"]?>&action=receive'>
                    <button type="button" class="btn btn-info">领奖</button>
                </a>
                <!-- 
                <a href='#'>
                    <button type="button" class="btn btn-danger btn_del" data-id="<?php echo $row["id"]?>">删除</button>
                </a>
                 -->
            </td>
        </tr>
        <?php 
        };
        ?>
    </table>

    <table class="table table-hover received" style="display: none;">
        <tr>
            <th>手机号码</th>
            <th>奖项</th>
            <th>中奖时间</th>
            <th>操作</th>
        </tr>
        <?php
        while ($row = mysql_fetch_array($rewards_received)) {
            $cellphone = "用户未填写";
            if (!empty($row['cellphone'])) $cellphone = $row['cellphone'];
        ?>
        <tr>
            <td><?php echo $cellphone;?></td>
            <td><?php echo $row['reward_level']?>等奖</td>
            <td><?php echo $row['update_time']?></td>
            <td>
                <a href='../../application/controllers/reward_action.php?id=<?php echo $row["id"]?>&action=unreceive'>
                    <button type="button" class="btn btn-xs btn-info">恢复</button>
                </a>
                <!-- 
                <a href='#'>
                    <button type="button" class="btn btn-xs btn-danger btn_del" data-id="<?php echo $row["id"]?>">删除</button>
                </a>
                -->
            </td>
        </tr>
        <?php 
        };
        ?>
    </table>
</div>
</body>
</html>