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
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="../assets/js/integration/jquery.flexslider-min.js" type="text/javascript"></script>
    <script src="../assets/js/home.js" type="text/javascript"></script>
    <script src="../assets/js/vue.js" type="text/javascript"></script>
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
            <a href="#recom">民宿推荐</a>
            <a href="#theme">精选主题</a>
            <a href="#series">探庐系列</a>
        </div>
        <div class="nav-right">
            <a href=""></a>
            <a href="">登录</a>
            <a href="">注册</a>
        </div>
    </nav> 
<!-- slider -->
<div class="flexslider">
<ul class="slides">
    <li style="background:url(assets/images/head.png) ; background-size:100% 100%;">
        <div class="slide-mess">
            <?php echo $bri; ?>
        </div>
    </li>
    <li style="background:url(assets/images/head2.png) ; background-size:100% 100%;">
        <div class="slide-mess">
            什么山
        </div>
    </li>
</ul>
</div>
<!-- endslider -->
<!-- 搜索框 -->
<div class="search">
    <div class="search-form">
        <form action="">
            <div class="search-input">
                <input type="text" placeholder="找到好民宿">
            </div>
        </form>
        <div class="search-place" id="city">
            <ul v-for="item in citys">
                <li><a href="">{{ item }}</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- end 搜索框 -->
</header>

    <div class="container">
        <!-- 民宿推荐 -->
        <section id="recom">
            <h2>民宿推荐</h2>
            <div class="line"></div>
            <div class="city-list">
                <a href="">杭州</a>
                <a href="">临安</a>
                <a href="">莫干山</a>
            </div>
            <div class="item">
                <div class="item-a">
                    <a href="">
                        <img src="../assets/images/fang.jpg" height="100%">
                        <div class="card">
                            <h3>花千谷</h3>
                        </div>
                        <div class="info">
                            <div class="middle">
                            <h3>花千谷</h3>
                            <p>位于云南省西部，这里冬天依旧温暖<br>
                            这是多民族聚集区，可以吃到众多的云南小吃；丰富的热带水果；欣赏美丽的孔雀舞</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php
            for($i=0;$i<4;$i++):
                ?>
                <div class="item">
                    <div class="item-b">
                    <a href="">
                        <img src="../assets/images/fang.jpg" height="100%">
                        <div class="card">
                            <h3>花千谷</h3>
                        </div>
                        <div class="info">
                            <div class="middle">
                            <h3>花千谷</h3>
                            <p>位于云南省西部，这里冬天依旧温暖<br>
                            这是多民族聚集区，可以吃到众多的云南小吃；丰富的热带水果；欣赏美丽的孔雀舞</p>
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
            <?php endfor; ?>


        </section>
        <!-- 精选主题 -->
        <section id="theme" >
            <h2 v-on:click="turn(1)" >精选主题</h2>
            <div class="item" v-for="item in items">
                <div class="item-b">
                <a href="">
                    <img :src="item.pic" height="100%">
                    <div class="card">
                        <h3>{{ item.title }}</h3>
                    </div>
                    <div class="info">
                        <div class="middle">
                        <h3>{{ item.title }}</h3>
                        <p>{{ item.shortMess }}</p>
                        </div>
                    </div>
                </a>
                </div>
            </div>
        </section>
    </div>
<?php include 'footer.php' ?>
</body>
</html>