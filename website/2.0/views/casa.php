<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="民宿,杭州,周末,去哪玩">
    <meta name="description" content="找到好民宿">
    <title>{民宿的名字}-民宿</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://api.map.baidu.com/api?v=2.0&ak=y8Vn362WKNbfoqOMF9fXLsWF" type="text/javascript"></script>
    <script src="js/map.js" type="text/javascript"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-default">
        <!-- logo -->
        <div class="nav-left">
            <a href="#">
                <img src="../assets/images/logo.png" alt="logo">
            </a>
        </div>
        <div class="nav-middle">
            <a href="">民宿大全</a>
            <a href="/casarover/website/2.0/#recom">民宿推荐</a>
            <a href="#theme">精选主题</a>
            <a href="#series">探庐系列</a>
        </div>
        <div class="nav-right">
            <a href=""></a>
            <a href="">登录</a>
            <a href="">注册</a>
        </div>
    </nav>
    <!-- 民宿大图  -->
    <div class="head-photo">
        <div class="cover-photo">
            <img src="../assets/images/head.png" width="100%" alt="">
        </div>
        <div class="show-mess">
            <!-- <div class="mark">浏览233</div> -->
            <h1>杭州青逸假日民宿</h1>
        </div>

    </div>
</header>
    <!-- 民宿介绍内容 -->
    <article>
        <div class="article-main">
            成都，是一座让人感到幸福的城市，也是莲安遇到Curt的城市。莲安，成都莲公馆的主人，在开民宿之前，做过金融做过贸易，也曾经在这个行业很有抱负。直到她遇到了Curt，生活轨迹便由此改变。Curt，标准的美国理工男，是一名化学工程师，常常在世界各地跑。两人一个热爱文学、音乐和摄影，一个是理性宅男，但他们共同的爱好就是一起旅行，寻找生活之美。
        </div>
    </article>
    <div class="casa-mess">
        <div class="tag-list">
            <a href="">简约</a>
            <a href="">古典</a>
        </div>
    </div>
    <div class="casa-map">
        <!-- 地图api显示位置 -->
        <div id="allmap"></div>
    </div>
<?php include 'footer.php' ?>
</body>
</html>