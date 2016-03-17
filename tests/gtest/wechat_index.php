<!doctype html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title>探庐者</title>
<?php $rand=rand(100,999);?>
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/flexslider.css" rel="stylesheet">
<link href="css/wechat_index.css?rand=<?php echo $rand?>" rel="stylesheet">
<script src="../js/integration/jquery.min.js"></script>
<script src="../js/integration/bootstrap.min.js"></script>
<script src="../js/integration/jquery.flexslider-min.js"></script>
<script src="../js/main.js?rand=<?php echo $rand?>"></script>
<script src="js/wechat_index.js?rand=<?php echo $rand?>"></script>
</head>
<body>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AttachmentDao.php';?>
<?php include_once 'WechatArticle.php';?>
<?php include_once 'WechatArticleDao.php';?>
<?php 
$waDao = new WechatArticleDao();
$aDao = new AttachmentDao();
$type = $_GET['type'];
$series = $_GET['series'];
if (empty($type)) {
    // Default display list is 民宿风采
    $type = 2;
}
if (empty($series)) {
    // Now just "探庐系列 " has submenu.
    if ($type == 1) {
        $series = 1;
    } else {
        $series = 0;
    }
}
$article_rows = $waDao->getByType($type, $series);
?>
<div class="wechat_container">

    <!-- Navigator Starts. -->
    <?php include_once 'navigator.php';?>
    <input type="hidden" id="type" value="<?php echo $type?>"/>
    <!-- Navigator Ends. -->

    <div id="list" class="article_list">
    <?php 
    while ($row = mysql_fetch_array($article_rows)) {
        $wa = new WechatArticle($row);
        $a_row = $aDao->getById($wa->attachment_id);
        if (empty($series) || $series == $wa->series) {
    ?>
            <a href="<?php echo $wa->address; ?>">
                <div class="article clearfix">
                    <div class="left">
                        <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/<?php echo $a_row['filepath']; ?>"/>
                    </div>
                    <div class="right">
                        <span class="title"><?php echo $wa->title?></span>
                        <br/>
                        <span class="content"><?php echo $wa->brief?></span>
                    </div>
                </div>
            </a>
            <hr/>
    <?php 
        }
    }
    ?>
    </div>
</div>
</body>
</html>