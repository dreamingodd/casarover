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
$article_rows_1 = $waDao->getByType(1);
$article_rows_2 = $waDao->getByType(2);
?>
<div class="wechat_container">
    <div class="flexslider">
        <ul class="slides">
            <li onclick="goto_link1()"
                    style="background:url('http://7xp9p2.com1.z0.glb.clouddn.com/banner-01.jpg') ; background-size:100% 100%; "></li>
            <li onclick="goto_link2()"
                    style="background:url('http://7xp9p2.com1.z0.glb.clouddn.com/banner-02.jpg') ; background-size:100% 100%; "></li>
        </ul>
    </div>
    <div class="navbar">
        <div class="navbar-inner">
            <ul class="nav nav-justified">
                <li role="presentation" class="type2 active">
                    <a href="#">民宿风采</a>
                </li>
                <li role="presentation" class="type1">
                    <a href="#">探庐系列</a>
                </li>
                <li role="presentation">
                    <a href="../">探庐者网站</a> 
                </li>
            </ul>
        </div>
    </div>

    <div id="list1" class="article_list" style="display: none;">
    <?php 
    while ($row = mysql_fetch_array($article_rows_1)) {
        $wa = new WechatArticle($row);
        $a_row = $aDao->getById($wa->attachment_id);
    ?>
        <a href="<?php echo $wa->address; ?>">
            <div class="article clearfix">
                <div class="left">
                    <img src="../../../photo/<?php echo $a_row['filepath']; ?>"/>
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
    ?>
    </div>

    <div id="list2" class="article_list">
    <?php 
    while ($row = mysql_fetch_array($article_rows_2)) {
        $wa = new WechatArticle($row);
        $a_row = $aDao->getById($wa->attachment_id);
    ?>
        <a href="<?php echo $wa->address; ?>">
            <div class="article clearfix">
                <div class="left">
                    <img src="../../../photo/<?php echo $a_row['filepath']; ?>"/>
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
    ?>
    </div>
</div>
</body>
</html>