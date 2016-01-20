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
<div id="container">
    <?php include 'navigator.php';?>
    <input type="hidden" id="page" value="area"/>
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>操作</th>
        </tr>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/AreaService.php';?>
    <?php
    $casaDao = new AreaService();
    $result = $casaDao->getAllArea();
    ?>
    <?php
    foreach ($result as $value) {
    ?>
	<tr>
        <td><?php echo $value['id']?></td>
        <td><?php echo $value['name']?></td>
        <td>
            <a id="casa_continue" href='area_edit.php?area_id=<?php echo $value["id"]?>'>
                <button type="button" class="btn btn-info">编辑</button>
            </a>
        </td>
    </tr>
    <?php
    }
    ?>
    </table>
</div>
</body>
</html>