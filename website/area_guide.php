<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />   
    <title>景点介绍</title>
    <!-- Bootstrap -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/area.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="http://casarover.oss-cn-hangzhou.aliyuncs.com/image/favicon.ico">
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="//cdn.bootcss.com/jquery/2.1.2/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=y8Vn362WKNbfoqOMF9fXLsWF"></script>
</head>
<?php include_once '../application/models/AreaDao.php';?>
<?php include_once '../application/services/CasaService.php';?>
<body>
<?php include '301.php';?>
<?php

require_once '../application/controllers/AreaController.php';
$area = new AreaController();
$area_id = $_GET['area_id'];
$message = $area->index();
$picdir = "http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/";

$data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/cache/home.json'),true);
$themes = $data['themes'];

?>
<?php include 'login.php';?>
<?php include 'header.php';?>

<!-- body起始位置 -->
<div class="container">
  <?php include 'city_nav.php';?>
  <div class="head">
    <div class="pic">
      <img src="<?php echo $picdir.$message->title_img ?>" width="100%" alt="">
      </div>
  </div>
  <div class="section">
    <div class="col-md-8">
      <div class="top">
        <div class="col-md-4 hidden-sm hidden-xs">
          <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/image/tuijian.png" width="100%" alt="">
        </div>
        <div class="col-md-8 pic">
          <img src="<?php  echo $picdir.$message->content_img[0]  ?>" width="100%" alt="">
        </div>
        <div class="clear"></div>
      </div>

      <div class="middle">
        <div class="col-md-8">
          <img src="<?php echo $picdir.$message->content_img[1]?>" width="100%"alt="">
        </div>
        <div class="clear"></div>
      </div>
      <div class="bottom">
        <div class="col-md-6">
          <div class="content four">
            <p ><?php  echo $message->contents[0];  ?></p>
          </div>
        </div>
        <div class="col-md-6">
        <div class="pic">
          <img src="<?php echo $picdir.$message->content_img[2]?>" width="100%"alt="">
        </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="content four">
        <p><?php echo $message->contents[1]; ?></p>
      </div>
      <div class="pic">
        <img src="<?php echo $picdir.$message->content_img[3]  ?>" width="100%" alt="">
      </div>
      <div class="content four">
        <p><?php echo $message->contents[2];?></p>
      </div>
    </div>
  </div>
  <div class="clear"></div>
  <!-- 攻略部分 -->
  <div class="section">
    <div class="col-md-3 hidden-sm hidden-xs">
      <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/image/tj_gl_img.png" width="100%" alt="">
    </div>
    <div class="m-radius-title visible-sm visible-xs">
      <h4>行程攻略</h4>
    </div>
    <div class="col-md-9">
      <div class="map">
        <div id="allmap"></div>
      </div>
      <div class="radius">
        <p>
        <?php echo $message->radius  ?>
        </p>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="col-md-3 hidden-sm hidden-xs">
      <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/image/tj_mx.png" width="100%" alt="">
    </div>
    <div class="m-radius-title visible-sm visible-xs">
      <h4>推荐民宿</h4>
    </div>
    <div class="col-md-9 recom-main">
    <?php 
    $casaService = new CasaService();
    $areaDao = new AreaDao();
    $casas = array();
    $casaSimpleRows = $areaDao->getRecommendCasas($area_id);
    while ($row = mysql_fetch_array($casaSimpleRows)) {
        array_push($casas, $casaService->getCasaWithAttachment($row['id']));
    }
    if (count($casas) == 0) {
    ?>
        <?php foreach ($themes as $value):?>
         <div class="col-md-6" onclick="goto_casa(4)">
           <div class="recom-content" >
             <div class="top-pic">
               <img src="<?php echo $picdir.$value['pic']?>" width="100%" alt="">
             </div>
             <div class="content">
               <h3><?php echo $value['short_mess']?></h3>
               <p>
                 <span>杭州</span>
               </p>
             </div>
           </div>
         </div>
        <?php endforeach ?>
    <?php 
    } else {
        foreach ($casas as $casa):
        ?>
         <div class="col-md-6" onclick="goto_casa(4)">
           <div class="recom-content" >
             <div class="top-pic">
               <img src="<?php echo 'http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/'.$casa->attachment->filepath?>" width="100%" alt="">
             </div>
             <div class="content">
               <h3><?php echo $casa->name?></h3>
               <p>
                 <span>杭州</span>
               </p>
             </div>
           </div>
         </div>
    <?php
        endforeach;
        }
    ?>

    </div>
  </div>

<?php include 'footer.php';?>
</div>

<script type="text/javascript">
  // 地图初始化，放到其他的位置可能会失败
  var map = new BMap.Map("allmap");    // 创建Map实例
  map.centerAndZoom(new BMap.Point(<?php echo $message->position ?>), <?php echo $message->tier ?>);  // 初始化地图,设置中心点坐标和地图级别
  map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
  map.disableDragging();
  map.setCurrentCity("杭州");          // 设置地图显示的城市 此项是必须设置的
</script>
</body>
</html>