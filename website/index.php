<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>探庐者</title>
<?php $rand=rand(100,999);?>
<link href="//cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/flexslider.css">
<link rel="icon" href="image/favicon.ico">

<!--[if lt IE 9]>
<script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="js/integration/jquery.flexslider-min.js" type="text/javascript"></script>
<script src="js/main.js?rand=<?php echo $rand;?>" type="text/javascript"></script>
<script src="js/home.js?rand=<?php echo $rand;?>" type="text/javascript"></script>
</head>
<body>

<?php include '301.php';?>
<?php include 'login.php';?>
<input type="hidden" id="auto_login" value="<?php echo $_GET["auto_login"]?>"/>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/cache/AreaCache.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/AreaService.php';?>
<?php 

// 配置
$head_pic1 = 'http://7xp9p2.com1.z0.glb.clouddn.com/banner-01.jpg';
$head_pic2 = 'http://7xp9p2.com1.z0.glb.clouddn.com/banner-02.jpg';

$data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/cache/home.json'),true);
$hot_left = $data['left'];
$hot_right = $data['right'];
$themes = $data['themes'];
$picdir = '../../photo/';
?>

<!-- body起始位置 -->
<?php include 'header.php';?>
<div class="container">
    <!-- 轮播图Start -->
    <div id="testimonials-section" class="">
        <div class="flexslider">
        <ul class="slides">
            <li style="background:url(<?php echo $head_pic1; ?>) ; background-size:100% 100%; " onclick="goto_area(8)"></li>
            <li style="background:url(<?php echo $head_pic2; ?>) ; background-size:100% 100%; " onclick="goto_area(9)"></li>
        </ul>
        </div>
    </div>
    <!-- 轮播图End -->
    <?php include 'city_nav.php';?>
    <div class="map-img hidden-xs hidden-sm">
        <svg width="1280" height="372" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <image x="1.25" y="0" width="1280" height="372" xlink:href="image/nmap.png" transform="matrix(1,0,0,1,-1.25,0)" fill="#66FF33" xmlns:xlink="http://www.w3.org/1999/xlink" />
        <path id="31" d="M217 224L311 222L346 271L351 309L292 327L256 335L191 305L182 255C182 255 218 219 217 224Z" fill="#66FF33" stroke="none" stroke-opacity="0" fill-opacity="0"/>
        <path id="64" d="M350 94L394 134L397 164L364 175L314 185L270 164L252 112L300 82L350 94Z" fill="#000000" stroke="none" stroke-opacity="0" fill-opacity="0" />
        <path id="25" d="M609 50L599 111L537 124L492 101L461 70L467 30L524 15L600 21C600 21 607 48 609 50Z" fill="#66FF33" stroke="none" fill-opacity="0" stroke-opacity="0" xmlns="http://www.w3.org/2000/svg" />
        <path id="7" d="M596 259L661 232L659 191L635 175L604 166L565 152L530 167L510 206L521 269C521 269 597 257 596 259Z" fill="#66FF33" fill-opacity="0" stroke="none" stroke-opacity="0" xmlns="http://www.w3.org/2000/svg" />
        <path id="2" d="M799 75L819 121L814 172L747 189L705 165L700 101L712 71L767 61C767 61 802 73 799 75Z" fill="#000000" stroke="none" fill-opacity="0" stroke-opacity="0" xmlns="http://www.w3.org/2000/svg" />
        <path id="13" d="M884 226L922 292L854 304L772 304L762 255L779 226L847 201C847 201 886 226 884 226Z" fill="#000000" stroke="none" fill-opacity="0" stroke-opacity="0" xmlns="http://www.w3.org/2000/svg" />
        <path id="18" d="M1076 187L1139 245L1118 284L1068 297L1010 272L970 222L1000 180C1000 180 1077 184 1076 187Z" fill="#000000" fill-opacity="0" stroke="none" stroke-opacity="0" xmlns="http://www.w3.org/2000/svg" />
        <path id="39" d="M1100 45L1044 91L1048 140L1105 166L1188 174L1199 122L1188 81L1165 47L1142 39C1142 39 1099 45 1100 45Z" fill="#000000" fill-opacity="0" stroke="none" stroke-opacity="0" xmlns="http://www.w3.org/2000/svg" />
        </svg>
        <div class="showinfo" id="city-info">点击前往</div>
    </div>

    <div class="middle-tab hidden-xs">
        <div class="content_tabs">
            <div class="content_tabs_inner">
                <span class="content_tab_active" id="theme-one" style="cursor: pointer;">热门推荐</span>
                <span class="" id="theme-two" style="cursor: pointer ;">主题推荐</span>
            </div>
        </div>
    </div>
    <div class="theme-one visible-sm-12">
        <div class="nav-or hidden-md hidden-lg">热门推荐</div>
        <div class="col-md-8">
            <!-- 轮播图-热门推荐Start -->
            <div class="flexslider">
                <ul class="slides">
                    <?php foreach ($hot_left as $value): ?>
                        <li style="background: url(<?php echo $picdir.$value['pic']; ?>); background-size:100% 100%;" onclick="goto_casa(<?php echo $value['id']; ?>)"><span class="float_text">
                            <span class="float_text_title"></span>
                            <br>
                            <span class="float_text_content"></span>
                        </span></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- 轮播图-热门推荐End -->
        </div>

        <div class="col-md-4 hidden-xs">
            <div class="content_right_top" onclick="goto_casa(<?php echo $hot_right[0]['id'] ?>)">
                <img src="<?php echo $picdir.$hot_right[0]['pic'];?>" width="100%" alt="">
            </div>
            <div class="content_right_down">
                <div class="content_map">
                    <img src="image/hz_map.jpg" width="100%" alt="" onclick="goto_city(7)">
                </div>
                <div class="content_map_right" onclick="goto_casa(<?php echo $hot_right[0]['id'] ?>)">
                    <img src="<?php echo $picdir.$hot_right[1]['pic'];?>" width="100%" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="theme-two visible-xs-12" >
        <div class="nav-or hidden-md hidden-lg">热门主题</div>
        <?php foreach ($themes as $value): ?>
        <!-- 
           <div class="col-md-4 col-sm-6">
               <div class="house-message">
                   <div class="top" onclick="goto_casa(<?php echo $value['id'] ?>)">
                       <img src="<?php echo $picdir.$value['pic'] ; ?>" alt="">
                   </div>
                   <div class="bottom"><?php echo $value['theme']; ?></div>
                   <div class="bottom"><?php echo $value['short_mess']; ?></div>
               </div>
           </div>
         -->
        <?php endforeach; ?>
           <div class="col-md-3 col-sm-6">
               <div class="house-message">
                   <div class="top" onclick="goto_casa(246)">
                       <img src="image/theme_tmp/246_20-1.png" alt="">
                   </div>
                   <div class="bottom">萌宠</div>
                   <div class="bottom">喵，汪星人求陪睡，约么</div>
               </div>
           </div>
           <div class="col-md-3 col-sm-6">
               <div class="house-message">
                   <div class="top" onclick="goto_casa(246)">
                       <img src="image/theme_tmp/246_20-1.png" alt="">
                   </div>
                   <div class="bottom">情侣</div>
                   <div class="bottom">天南海北，伴你入眠</div>
               </div>
           </div>
           <div class="col-md-3 col-sm-6">
               <div class="house-message">
                   <div class="top" onclick="goto_casa(246)">
                       <img src="image/theme_tmp/246_20-1.png" alt="">
                   </div>
                   <div class="bottom">亲子</div>
                   <div class="bottom">带上孩子旅行去</div>
               </div>
           </div>
           <div class="col-md-3 col-sm-6">
               <div class="house-message">
                   <div class="top" onclick="goto_casa(246)">
                       <img src="image/theme_tmp/246_20-1.png" alt="">
                   </div>
                   <div class="bottom">星座</div>
                   <div class="bottom">12星座的专属民宿</div>
               </div>
           </div>
    </div>

    <div class="footer-logo hidden-xs">
        <img src="image/logo.png" alt="">
    </div>
<?php include 'footer.php';?>
</div>
</body>
</html>