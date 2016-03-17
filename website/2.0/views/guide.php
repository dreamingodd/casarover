<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="民宿,杭州,周末,去哪玩">
    <meta name="description" content="找到好民宿">
    <title>{区域的名字}-民宿</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
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
        <div class="guide-mess">
            <h1>白乐桥</h1>
            <p>这个就是白乐桥</p>
        </div>

    </div>
</header>
<div class="container">
    <!-- 文字介绍 -->
    <section>
        <div class="article-main">
            <p>这个是文字介绍这个是文字介绍这个是文字介绍这个是文字介绍这个是文字介绍这个是文字介绍</p>
        </div>
    </section>
    <div class="line"></div>
    <!-- 附近景点 -->
    <section>
        <div class="article-nav">附近景点</div>
        <div class="place-list">
        <?php for($i=0;$i<4;$i++): ?>
            <div class="place-item">
                <div class="place-img">
                    <img src="../assets/images/fang.png" wdith="100%;" alt="">
                </div>
                <div class="place-mess">
                    <h2>灵隐寺</h2>
                    <p>这个是介绍的内容这个是介绍的内容这个是介绍的内容这个是介绍的内容</p>
                </div>
            </div>
        <?php endfor; ?>
        </div>
    </section>
    <div class="line"></div>
    <!-- 附近民宿 -->
    <section>
        <div class="article-nav">附近民宿</div>
        <div class="item">
            <div class="item-c">
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
        <div class="item">
            <div class="item-d">
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
        <div class="item">
            <div class="item-d">
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
        <div class="item">
            <div class="item-c">
            <a href="">
                <img src="../assets/wimages/fang.jpg" height="100%">
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
    </section>
</div>
<?php include 'footer.php' ?>
</body>
</html>