<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/check_admin_login_action.php';?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>探庐者后台-推荐编辑</title>
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/edit.css">
    <script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="js/recommend.js"></script>
    </head>
    <?php
    ?>
<body>

<div id="container" class="container">
    <div class="recom">
        <span>使用方式，找到要推荐的民宿，查看url最后的数字，填入下面</span>
        <br>
        <span>例如：http://www.casarover.com/casarover/website/casa.php?casa_id=1</span>
        <p>只需要将后面的1写入下面的框中</p>
        <h3>热门推荐</h3>
        <input type="text" class="form-control" >
        <input type="text" class="form-control" >
        <input type="text" class="form-control">
        <input type="text" class="form-control">
        <h3>主题推荐</h3>
        <input type="text" class="form-control">
        <input type="text" class="form-control">
        <input type="text" class="form-control">
        <input type="submit" class="btn btn-default" id="save" value="保存">
    </div>
</div>
</body>
</html>