<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>探庐者</title>
    <link href="//cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                探庐者
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="">民宿大全</a></li>
                <li><a href="">民宿推荐</a></li>
                <li><a href="">精选主题</a></li>
                <li><a href="">探庐系列</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                    <!-- 未登录 -->
                    <li><a href="{{ url('/login') }}">登录</a></li>
                    <li><a href="{{ url('/register') }}">注册</a></li>
                    <!-- 已经登录 -->
                    <li class="dropdown">

                    </li>
            </ul>
        </div>
    </div>
</nav>

<!-- slider -->
<div class="flexslider">
<ul class="slides">
    <li style="background:url(<?php echo $head_pic1; ?>) ; background-size:100% 100%; " onclick="goto_area(8)"></li>
    <li style="background:url(<?php echo $head_pic2; ?>) ; background-size:100% 100%; " onclick="goto_area(9)"></li>
</ul>
</div>
<!-- endslider -->

    <div class="container">
        <!-- 民宿推荐 -->
        <section>
            <div class="card">
                
            </div>
        </section>
        <!-- 精选主题 -->
        <section>
            
        </section>
        <!-- 探庐系列 -->
        <section>
            
        </section>
    </div>
</body>
</html>