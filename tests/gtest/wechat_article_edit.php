<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>探庐者后台-微信文章编辑</title>
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="../backstage/css/all.css?v=1.1" rel="stylesheet" />
<script src="../js/integration/require.min.js" data-main="js/OssPhotoUploader.js"></script>
<script src="../js/integration/jquery.min.js"></script>
<script src="../js/integration/json2.js"></script>
<script src="../backstage/js/all.js"></script>
<script src="js/wechat_article_edit.js?v=1.1"></script>
</head>
<body>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/check_admin_login_action.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/PropertyManager.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AttachmentDao.php';?>
<?php include_once 'WechatArticle.php';?>
<?php include_once 'WechatArticleDao.php';?>
<?php include_once 'WechatSeriesDao.php';?>
<?php 
$pm = new PropertyManager();
$wa = new WechatArticle();
$dao = new WechatArticleDao();
$aDao = new AttachmentDao();
$seriesDao = new WechatSeriesDao();
$filepath = "";
$id = $_GET['id'];
if ($id) {
    $wa = new WechatArticle($dao->getById($id));
    $a_row = $aDao->getById($wa->attachment_id);
    $filepath = $a_row['filepath'];
}
$series_rows = $seriesDao->getAll();
?>
<div id="container">
    <!-- nav bar start -->
    <?php include '../backstage/navigator.php';?>
    <input type="hidden" id="page" value="wechat"/>
    <!-- nav bar end -->

    <div class="col-lg-12">
        <div class="dropdown col-lg-12 vertical5">
            <div id="" style="float:left;">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="type_text">一级标题</span> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li class="type_li" db_id="1">探庐系列</li>
                    <li class="type_li" db_id="2">民宿推荐</li>
                    <li class="type_li" db_id="3">主题民宿</li>
                </ul>
            </div>
            <div id="" style="float:left; margin-left:5px">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="series_text">二级标题</span> <span class="caret"></span>
                </button>
                <ul id="series_ul" class="dropdown-menu" aria-labelledby="dropdownMenu2"
                        style="margin-left:115px;">
                </ul>
            </div>
        </div>
    </div>
    <!-- Here's the list of WechatSeries items. -->
    <div id="series_list" style="display: none;">
        <?php
        while ($row = mysql_fetch_array($series_rows)) {
        ?>
            <span db_id="<?php echo $row['id']?>" name="<?php echo $row['name']?>"
                    type="<?php echo $row['type']?>"></span>
        <?php
        }
        ?>
    </div>
    <!-- WechatSeries list ENDs. -->
    <div class="small-photo col-lg-12">
        <h4>上传文章缩略图</h4>
        <div class="input-group input-group-sm col-lg-10
                reminder">最佳分辨率比例1.6：1，比如96:60。考虑微信页加载速度，图片大小不超过36K！</div>

        <!-- OSS start -->
        <div class="oss_photo_tool col-lg-12 clearfix" target_folder="casa" file_prefix="wechat" limit_size="36"
                oss_address="<?php echo $pm->getProperty("oss_external")?>">
            <div class="oss_button">
                <button class="show_uploader btn btn-primary btn-sm">插入图片</button>
            </div>
            <div class="oss_hidden_input">
                <?php  if (!empty($filepath)){ ?>
                    <input type="hidden" class="hidden_photo" value="<?php echo $filepath;?>"/>
                <?php }?>
            </div>
            <div class="oss_photo"></div>
        </div>
        <!-- OSS end -->
    </div>
    <form id="wechat_article_form" method="post" action="wechat_article_update_action.php">
        <input type="hidden" id="id" name="id" value="<?php echo $wa->id?>"/>
        <input type="hidden" id="attachment_id" name="attachment_id" value="<?php echo $wa->attachment_id;?>"/>
        <input type="hidden" id="type" name="type" value="<?php echo $_GET['type'];?>"/>
        <input type="hidden" id="series" name="series" value="<?php echo $wa->series;?>"/>
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