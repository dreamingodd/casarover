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
<title>探庐者后台-民宿列表</title>
</head>
<body>
<?php include '301.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/check_admin_login_action.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/CasaDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/CasaService.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/AreaService.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/vo/Casa.php';?>
<div id="container">
    <!-- nav bar start -->
    <?php include 'navigator.php';?>
    <input type="hidden" id="page" value="casa"/>
    <!-- nav bar end -->
    <div class="options vertical5">
        <a href="casa_edit.php">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
        </a>
        <a href="casa_list.php">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>列表
        </a>
        <a href="casa_list.php?deleted=1">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>回收站
        </a>
    </div>
    <table class="table table-hover">
        <tr>
            <th>编码</th>
            <th>名称</th>
            <th>地区</th>
            <th>操作</th>
        </tr>
    <?php
    $casaDao = new CasaDao();
    $areaService = new AreaService();
    $query = $casaDao->getAll($_GET['deleted']);
    $casas = array();
    while ($row = mysql_fetch_array($query)) {
        array_push($casas, new Casa($row));
    }
    // The compareCasaByCode method is in common_tools.php
    // TODO 需要修改成通用的方法。
    usort($casas, 'compareCasaByCode');
    foreach ($casas as $casa) {
    ?>
        <tr>
            <td><?php echo $casa->code?></td>
            <td><?php echo $casa->name?></td>
            <td><?php echo $areaService->getLeafFullName($casa->area->id)?></td>
            <td>
                <?php 
                if ($_GET['deleted']) {
                ?>
                <a id="casa_recover" href='../../application/controllers/casa_recycle_action.php?id=<?php echo $casa->id?>&option=recover&deleted=1'>
                    <button type="button" class="btn btn-warning">还原</button>
                </a>
                <?php 
                } else {
                ?>
                <a id="casa_continue" href='casa_edit.php?casa_id=<?php echo $casa->id?>'>
                    <button type="button" class="btn btn-info">编辑</button>
                </a>
                <a id="casa_effect" target="_blank" href='../casa.php?casa_id=<?php echo $casa->id?>'>
                    <button type="button" class="btn btn-info">查看效果</button>
                </a>
                <a id="casa_recycle" href='../../application/controllers/casa_recycle_action.php?id=<?php echo $casa->id?>&option=recycle&deleted=0'>
                    <button type="button" class="btn btn-danger">删除</button>
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