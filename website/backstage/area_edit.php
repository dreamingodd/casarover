<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>探庐者后台-景点编辑</title>
<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/all.css" />
<link rel="stylesheet" href="css/edit.css" />
<script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//cdn.bootcss.com/jquery.form/3.51/jquery.form.min.js"></script>
<script src="js/jquery.wallform.js"></script>
<script src="js/area_edit.js"></script>
</head>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/check_admin_login_action.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AreaDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/CasaDao.php';?>
<?php
    require_once '../../application/controllers/AreaController.php';
    $area = new AreaController();
    $message = $area->index();
    $picdir = PIC_DIR;
    $area_id = $_GET['area_id'];
?>
<body>

<div id="container" class="container">
    <?php include_once 'navigator.php';?>
    <input type="hidden" id="page" value="area"/>
    <input type="hidden" name="title" value='<?php echo $area_id ?>'>
    <div class="head">
        <h3>后台管理-景点介绍</h3>
        <div class="photo">
            <h3>标题大图</h3>
            <span class="reminder">上传一张图(图片宽高比必须在2:1以上，不得超过2.2:1)</span>
            <div class="uppic">
                <form id="imageform-head" method="post" enctype="multipart/form-data" action="upload.php">
                    <div id="up_btn-head" class="btn">
                        <a href="#" class="btn btn-default">
                        <?php
                        if ($_GET['area_id']) {
                            echo "更换图片";
                        } else {
                            echo "选择图片";
                        }
                        ?>
                        <input id="photoimghead" type="file" name="photoimg" value="浏览" />
                        </a>
                    </div>
                </form>
                <div id="preview-head">
                    <?php if(!empty($message->title_img)): ?>
                    <img src="../../../photo/<?php echo $message->title_img;?>" alt="" name="<?php echo $message->title_img; ?>" class="preview"></div>
                    <?php endif?>
            </div>
            <h3>区域名</h3>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $message->name?>" />
        </div>
    </div>
    <h3>区域介绍图片</h3>
    <p>上传四张图片</p>
    <div class="uppic">
        <form id="imageform" method="post" enctype="multipart/form-data" action="upload.php">
            <div id="up_btn" class="btn">
                <a href="#" class="btn btn-default">
                    添加图片
                    <input id="photoimg" type="file" name="photoimg" value="浏览" />
                </a>
            </div>
            <div class="btn" id="del">删除图片</div>
        </form>
        <div id="preview">
            <?php if(!empty($message->content_img)):?>
                <?php foreach ($message->content_img as $value): ?>
                    <img src="../../../photo/<?php echo $value?>" name="<?php echo $value ?>" alt="" class="preview">
                <?php endforeach; ?>
            <?php endif?>
        </div>
    </div>
    <!-- start -->
    <form action="../../application/controllers/AreaController.php?c=create" method="post">
        <input type="hidden" value="<?php echo $area_id; ?>" name="area_id">
        <input type="hidden" value="" id="true-name" name="name">
        <input type="hidden" value="" id="true-headpic" name="headpic">
        <input type="hidden" value="" id="true-somepic" name="somepic">
        <div class="content">
            <div class="message">
                <h3>介绍内容</h3>
                <h4>第一段</h4>
                <textarea class="form-control" rows="3" name="text1"><?php echo $message->contents[0]; ?></textarea>
                <h4>第二段</h4>
                <textarea class="form-control" rows="3" name="text2"><?php echo $message->contents[1]; ?></textarea>
                <h4>第三段</h4>
                <textarea class="form-control" rows="3" name="text3"><?php echo $message->contents[2]; ?></textarea>
            </div>
        </div>

        <div class="raiders">
            <h3>攻略内容</h3>
            <textarea class="form-control" rows="3" name="radiers"><?php echo $message->radius; ?></textarea>
            <hr>
            <h2>景点基本信息</h2>
            <p>到下面的这个网站选取坐标和层级然后复制过来</p>
            <a href="http://api.map.baidu.com/lbsapi/getpoint/index.html" target="_blank">
                        百度地图坐标拾取器
            </a>
            <h3>坐标</h3>
            <input type="text" class="form-control" id="position" value="<?php echo $message->position; ?>" name="position" placeholder="从坐标拾取复制过来" />
            <h3>层级</h3>
            <input type="text" class="form-control" id="tier" name="tier" placeholder="显示层级" value="<?php echo $message->tier; ?>" />
        </div>
        <br/>
        <div id="casa_select" class="vertical5 col-lg-12">
            <div id="casa_select_left" class="col-lg-4">
                <select multiple class="form-control" style="height:250px">
                <?php 
                // all areas
                $casaDao = new CasaDao();
                $all_rows = $casaDao->getByAreaId($area_id);
                while ($row = mysql_fetch_array($all_rows)) {
                    echo '<option>'.$row['name'].'</option>';
                }
                ?>
                </select>
            </div>
            <div id="casa_select_middle" class="col-lg-1">
                <br/><br/>
                <span id="casa_move_right" class="glyphicon glyphicon-arrow-right"
                        style="font-size:68px; cursor:pointer;"></span>
                <span id="casa_move_left"  class="glyphicon glyphicon-arrow-left"
                        style="font-size:68px; cursor:pointer;"></span>
            </div>
            <div id="casa_select_right" class="col-lg-4">
                <select multiple name="" class="form-control" style="height:250px;">
                <?php 
                // selected areas
                $areaDao = new AreaDao();
                $selected_rows = $areaDao->getRecommendCasas($area_id);
                while ($row = mysql_fetch_array($selected_rows)) {
                    echo '<option>'.$row['name'].'</option>';
                }
                ?>
                </select>
            </div>
        </div>
        <div class="sub">
            <button id="submit_btn" class="btn btn-primary">更新</button>
        </div>
    </form>
</div>
</body>
</html>