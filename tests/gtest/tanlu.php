<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="民宿,杭州,周末,去哪玩">
    <meta name="description" content="找到好民宿">
    <title>探庐者-民宿</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="add.css">
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="../assets/js/integration/jquery.flexslider-min.js" type="text/javascript"></script>
    <script src="../assets/js/home.js" type="text/javascript"></script>
    <script src="../assets/js/vue.js" type="text/javascript"></script>
    <script src="add.js" type="text/javascript"></script>
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
<header>
    <?php include_once 'WechatSeriesDao.php';?>
    <nav class="navbar navbar-default">
        <!-- logo -->
        <div class="nav-left">
            <a href="#">
                <img src="../assets/images/logo.png" alt="logo">
            </a>
        </div>
        <ul class="nav-middle">
            <li><a href="">民宿大全</a></li>
            <li><a href="#recom">民宿推荐</a></li>
            <li><a href="#theme">精选主题</a></li>
            <li><a href="#series">探庐系列<span class="caret"></span></a>
                <dl>
                    <?php 
                    $seriesDao = new WechatSeriesDao();
                    $series_list = $seriesDao->getAll();
                    while ($row = mysql_fetch_array($series_list)) {
                        if ($row['type'] == 1) {
                    ?>
                            <dd><a href="tanlu.php?type=1&series=<?php echo $row['id']?>"><?php echo $row['name']?></a>
                            </dd>
                    <?php
                        }
                    }
                    ?>
                </dl>
            </li>
        </ul>
        <div class="nav-right">
            <a href=""></a>
            <a href="">登录</a>
            <a href="">注册</a>
        </div>
    </nav>
</header> 
<section class='tanlu'>
    <div class='tanlutop'>
        <h2>探庐·临安</h2>
        <p>临安介绍 xxxxxxxxxxxxxxxxxxxxxxxxx</p>
    </div>
    <?php 
    while ($row = mysql_fetch_array($article_rows)) {
        $wa = new WechatArticle($row);
        $a_row = $aDao->getById($wa->attachment_id);
        if (empty($series) || $series == $wa->series) {
            ?>
            <div id="list" class="article_list">
                <a href="<?php echo $wa->address; ?>">
                    <div class="article">
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
            </div>
            <?php 
        }
    }
    ?>
</section>
<?php include 'footer.php' ?>
</body>
</html>