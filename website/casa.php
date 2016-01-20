<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>探庐者-民宿详情</title>
<link href="//cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/casa.css">
<script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="js/integration/jquery.nav.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>
<script src="js/casa.js" type="text/javascript"></script>
<!--[if lt IE 9]>
<script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<?php include '301.php';?>
<?php
require_once '../application/services/CasaService.php';
$casa_id =  $_GET["casa_id"];
$casaService = new CasaService();
if(!$casa_id){
    $info = "casa_id未定义";
    header("Location:error.php?info=".$info);
    exit();
}
$casa = $casaService->getWholeCasa($casa_id);
if(!$casa){
    $info = "casa_id过大或非法";
    header("Location:error.php?info=".$info);
    exit();
}
$picdir = '../../photo/';
?>
<?php include 'header.php';?>
<div class="container">
    <?php include 'login.php';?>
    <?php include 'city_nav.php'?>
    <!-- 标题 -->
    <div class="col-md-8">
        <div class="casa-title">
            <h3><?php echo $casa->name?></h3>
        </div>
        <!-- 时间作者 -->
        <div class="author-message" >
            <span class="author">探庐者</span>
            <span class="time"><?php echo substr($casa->update_time,0,10)?></span>
        </div>
        <div class="main">
            <div class="message">
                <!-- head pic -->
                <div class="pic">
                    <img src="<?php echo $picdir.$casa->main_photo_name?>" width="100%" alt="">
                </div>
                <!-- 文章列表 -->
                <?php for ($i=0; $i < count($casa->contents); $i++): ?>
                <div class="contents">
                    <div class="contents-main" id="<?php echo 'm_'.$i ?>">
                        <div class="contents-title">
                            <h3 id="m_0"><?php  echo $casa->contents[$i]->name  ?></h3>
                        </div>
                        <div class="contents-img">
                            <?php foreach ($casa->contents[$i]->photos as $value):  ?>
                            <img src="<?php echo $picdir.$value ?>" width="100%"  alt="pic">
                            <?php  endforeach;  ?>
                        </div>
                        <div class="contents-text">
                            <p><?php  echo $casa->contents[$i]->text  ?></p>
                        </div>
                    </div>
                </div>
                <?php endfor;
                if (isset($casa->link)) :
                ?>
                <div style="margin:2px auto; width:90px;">
                    <a href="<?php echo $casa->link?>" target="_blank">
                        <button class="btn btn-info btn-lg">这里订</button>
                    </a>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
    <!-- 右侧导航 Start -->
    <div class="col-md-4 hidden-xs">
        <div class="nav_line nav" id="nav">
            <div class="" style="float:left">
                <?php for ($i=0; $i < count($casa->contents); $i++): ?>
                    <div class="page_nav" id="p_0">
                        <a href="#<?php echo 'm_'.$i;?>">
                        <?php    echo $casa->contents[$i]->name;    ?>
                        </a>
                    </div>
                <?php endfor; ?>
            </div>
            <div class="nav_circle" style="float:left">
                <?php    for ($i=0; $i < count($casa->contents)-1; $i++):    ?>
                <div class="circle" id="c_p_<?php echo $i;?>"></div>
                <div class="line"></div>
                <?php    if ($i == (count($casa->contents)-2)):    ?>
                    <div class="circle" id="c_p_<?php echo $i+1;?>"></div>
                <?php    endif;    ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    <!-- 右侧导航 END -->
</div><!-- end container -->
<?php  include 'footer.php';  ?>
</body>
</html>