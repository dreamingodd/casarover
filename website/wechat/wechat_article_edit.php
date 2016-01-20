<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>探庐者后台-微信文章编辑</title>
<?php $rand = rand(0, 999);?>
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="../backstage/css/all.css?rand=<?php echo $rand?>" rel="stylesheet" />
<script src="../js/integration/jquery.min.js"></script>
<script src="../js/integration/bootstrap.min.js"></script>
<script src="../js/integration/jquery.form.js"></script>
<script src="../js/integration/json2.js"></script>
<script src="../backstage/js/all.js?rand=<?php echo $rand;?>"></script>
<script src="js/wechat_article_edit.js?rand=<?php echo $rand?>"></script>
</head>
<body>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/check_admin_login_action.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AttachmentDao.php';?>
<?php include_once 'WechatArticle.php';?>
<?php include_once 'WechatArticleDao.php';?>
<?php 
$wa = new WechatArticle();
$dao = new WechatArticleDao();
$aDao = new AttachmentDao();
$filepath = "";
if ($_GET['id']) {
    $wa = new WechatArticle($dao->getById($id));
    $a_row = $aDao->getById($wa->attachment_id);
    $filepath = $a_row['filepath'];
}
?>
<div id="container">
    <!-- nav bar start -->
    <?php include '../backstage/navigator.php';?>
    <input type="hidden" id="page" value="wechat"/>
    <!-- nav bar end -->

    <div class="col-lg-12">
        <div class="dropdown col-lg-12 vertical5">
            <div id="provinces">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="type_text">分类</span> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li class="type_li" db_id="1">民宿推荐</li>
                    <li class="type_li" db_id="2">民宿杂谈</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="small-photo col-lg-12">
        <h4>上传文章缩略图</h4>
        <div class="input-group input-group-sm col-lg-10
                reminder">最佳分辨率比例1.6：1，比如96:60。考虑微信页加载速度，图片大小不超过36K！</div>
        <input type="hidden" class="hidden_photo" value="<?php echo $filepath;?>"/>
    </div>
    <form id="wechat_article_form" method="post" action="wechat_article_update_action.php">
        <input type="hidden" id="id" name="id" value="<?php echo $wa->id?>"/>
        <input type="hidden" id="attachment_id" name="attachment_id" value="<?php echo $wa->attachment_id;?>"/>
        <input type="hidden" id="type" name="type" value="<?php echo $_GET['type'];?>"/>
        <input type="hidden" id="deleted" name="deleted" value="<?php echo $wa->deleted;?>"/>
        <div class="col-lg-12" style="margin-top: 30px;">
            <div class="input-group input-group-sm col-lg-10">
                <span class="input-group-addon" id="sizing-addon3">微信链接（必须微信端复制链接）</span>
                <input id="address" type="text" class="form-control" aria-describedby="sizing-addon3"
                        name="address" value="<?php echo $wa->address; ?>"/>
            </div>
        </div>
        <div class="col-lg-12">
            <h4>标题</h4>
            <div class="name vertical5 col-lg-3">
                <input id="title" name="title" type="text" class="form-control" value="<?php echo $wa->title;?>" aria-describedby="sizing-addon3" />
            </div>
        </div>
        <div class="col-lg-12">
            <h4>简介</h4>
            <div class="text col-lg-12 vertical5">
                <textarea id="brief" name="brief" rows="3" cols="150"><?php echo $wa->brief;?></textarea>
            </div>
        </div>
    </form>
    <div class="col-lg-12">
        <button style="margin-left: 15px; margin-top: 30px;" class="btn btn-info" id="submit">提交</button>
    </div>
</div>
</body>
</html>