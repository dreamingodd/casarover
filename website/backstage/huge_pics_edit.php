<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="css/all.css" rel="stylesheet"/>
<script src="../js/integration/jquery.min.js"></script>
<script src="../js/integration/bootstrap.min.js"></script>
<script src="../js/integration/jquery.form.js"></script>
<script src="js/all.js"></script>
<script src="js/huge_pics_edit.js"></script>
<title>探庐者后台-首页管理-轮播图</title>
</head>
<body>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/check_admin_login_action.php';?>
<div id="container" style="min-height:200px;">
    <?php include 'navigator.php';?>
    <input type="hidden" id="page" value="home"/>

    <button type="button" class="btn btn-info add_huge_pic">添加</button>

    <div class="huge_pics_div">
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/cache/HugePicsCache.php';?>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/vo/PicCache.php';?>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AreaDao.php';?>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/CasaDao.php';?>
        <?php 
        $hugePicsCache = new HugePicsCache();
        $picCacheArray = $hugePicsCache->getHugePics();
        for ($i = 0; $i < count($picCacheArray); $i++) {
            $picCache = $picCacheArray[$i];
            $type = $picCache->type;
            $id = $picCache->id;
            $path = $picCache->path;
            $link_info = new stdClass();
            if ($type == PicCache::TYPE_CITY) {
                $areaDao = new AreaDao();
                $area_row = $areaDao->getById($id);
                $link_info->type = "城市";
                $link_info->name = $area_row['value'];
            } else if ($type == PicCache::TYPE_AREA) {
                $areaDao = new AreaDao();
                $area_row = $areaDao->getById($id);
                $link_info->type = "区域";
                $link_info->name = $area_row['value'];
            } else if ($type == PicCache::TYPE_CASA) {
                $casaDao = new casaDao();
                $casa_row = $casaDao->getById($id);
                $link_info->type = "民宿";
                $link_info->name = $casa_row['name'];
            }

        ?>
            <div class="col-lg-12 vertical5">
                <hr/>
                <div class="col-lg-12 vertical5">
                    <button type="button" class="btn btn-danger del_huge_pic">删除</button>
                    <button type="button" class="btn btn-info edit_link">编辑链接</button>
                    <span class="link_type label label-info"><?php echo $link_info->type?></span>
                    <span class="link_name"><?php echo $link_info->name?></span>
                </div>
                <input type="hidden" class="type_input" value="<?php echo $id?>"/>
                <input type="hidden" class="id_input" value="<?php echo $type?>"/>
                <input type="hidden" class="path_input" value="<?php echo $path?>"/>
            </div>
        <?php 
        }
        ?>
    </div>

    <div id="template" class="col-lg-12 vertical5" style="display:none;">
        <hr/>
        <div class="col-lg-12 vertical5">
            <button type="button" class="btn btn-danger del_huge_pic">删除</button>
            <button type="button" class="btn btn-info edit_link">编辑链接</button>
            <span class="link_type label label-info"></span>
            <span class="link_name"></span>
        </div>
        <input type="hidden" class="type_input" value=""/>
        <input type="hidden" class="id_input" value=""/>
        <input type="hidden" class="path_input" value=""/>
        <form class="photo-form" action="upload_photo.php" method="post" enctype="multipart/form-data">
            <div class="col-lg-12 vertical5">上传图片：
                <input type="file" id="mainupload" name="photo">
            </div>
        </form>
    </div>
    <form id="template_form" class="photo-form" action="upload_photo.php"
            method="post" enctype="multipart/form-data" style="display:none;">
        <div class="col-lg-12 vertical5">
            <input type="file" id="fileupload" name="photo">
        </div>
    </form>
    <div id="template_img" class="photo-wrapper" style="position:relative;float:left;display:none;">
        <img class="photo img-rounded">
        <span class="img-remove glyphicon glyphicon-remove" style="position:absolute;z-index:2;opacity:0.7;top:0;font-size:40px;"></span>
    </div>
</div>
</body>
</html>