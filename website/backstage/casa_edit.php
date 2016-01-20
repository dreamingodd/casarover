<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="css/all.css" rel="stylesheet" />
<script src="../js/integration/jquery.min.js"></script>
<script src="../js/integration/bootstrap.min.js"></script>
<script src="../js/integration/jquery.form.js"></script>
<script src="../js/integration/json2.js"></script>
<script src="js/all.js"></script>
<script src="js/casa_edit.js"></script>
<title>探庐者后台-添加民宿</title>
</head>

<body>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/check_admin_login_action.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/CasaService.php';?>
<?php
    $casa_id = $_GET['casa_id'];
    $casaService = new CasaService();
    if (!empty($casa_id)) {
        $casa = $casaService->getWholeCasa($casa_id);
    }
?>
<input type="hidden" id="casa_id" value="<?php echo $casa_id?>"/>
<form id="casa_form" action="../../application/controllers/casa_edit_action.php" method="post">
    <input id="casa_JSON_str" type="hidden" name="casa_JSON_str" />
</form>
<div id="container">
    <!-- nav bar start -->
    <?php include 'navigator.php';?>
    <input type="hidden" id="page" value="casa"/>
    <!-- nav bar end -->
    <div class="name">
        <div class="input-group input-group-sm col-lg-3">
            <span class="input-group-addon" id="sizing-addon3">名称</span>
            <input id="name" type="text" class="form-control" aria-describedby="sizing-addon3"
                    value="<?php echo $casa->name?>"/>
        </div>
    </div>
    <br />
    <div class="code">
        <div class="input-group input-group-sm col-lg-3">
            <span class="input-group-addon" id="sizing-addon3">编码</span>
            <input id="code" type="text" class="form-control" aria-describedby="sizing-addon3"
                    value="<?php echo $casa->code?>"/>
        </div>
    </div>
    <br />
    <div class="link">
        <div class="input-group input-group-sm col-lg-10">
            <span class="input-group-addon" id="sizing-addon3">去哪定</span>
            <input id="link" type="text" class="form-control" aria-describedby="sizing-addon3"
                    value="<?php echo $casa->link?>"/>
        </div>
    </div>
    <div class="main-photo">
        <h4>上传民宿缩略图</h4>
        <div class="input-group input-group-sm col-lg-10 reminder">最佳分辨率比例1.6：1，比如320：200。</div>
        <?php
        if (isset($casa)) {
            echo '<input type="hidden" class="hidden_photo" value="'.$casa->main_photo_name.'"/>';
        }
        ?>
    </div>
    <div class="tags">
        <h4>标签 <small>自定义标签请使用逗号分隔</small>
        </h4>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/TagDao.php';?>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/TagService.php';?>
        <?php
        $tagService = new TagService();
        $official_tags = $tagService->getOfficialTags();
        $custom_tags = $tagService->getCustomTags();
        $selected_official_tag_names = array();
        $selected_custom_tag_names = array();
        if (isset($casa)) {
            // current casa's tags
            foreach($casa->tags as $tag) {
                if ($tag->type != 'custom')array_push($selected_official_tag_names, $tag->name);
                else array_push($selected_custom_tag_names, $tag->name);
            }
            // 将当前客栈的自定义标签转换成以逗号分隔的字符串.
            $selected_custom_str = implode($selected_custom_tag_names, ',');
            $tagDao = new TagDao();
            $tags = $tagDao->getAll();
        }
        foreach($official_tags as $tag) {
            if (in_array($tag->name, $selected_official_tag_names)) {
                echo '<span db_id="' . $tag->id . '" class="label label-info">'.$tag->name.'</span>';
            } else {
                echo '<span db_id="' . $tag->id . '" class="label label-default">'.$tag->name.'</span>';
            }
        }
        ?>
    </div>
    <div class="user_tags" style="margin-top: 15px;">
        <div class="input-group input-group-sm col-lg-5">
            <span class="input-group-addon" id="sizing-addon3">自定义标签</span> <input id="user_tags" type="text"
                    value="<?php echo $selected_custom_str ?>" class="form-control" aria-describedby="sizing-addon3" />
        </div>
    </div>
    <div id="area_div" class="area">
        <input id="area" type="hidden" value="<?php echo $casa->area->id ?>"/>
        <h4>地区</h4>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/AreaService.php';?>
        <?php
        $areaService = new AreaService();
        if (isset($casa)) {
            echo '<span id="area_fullname" style="margin-left:15px;">'.$areaService->getLeafFullName($casa->area->id).'</span>';
        }
        $areas = $areaService->getAreaHierarchy ();
        $areas_json = json_encode ( $areas );
        echo '<input type="hidden" id="areas_json" value=\'' . $areas_json . '\'/>';
        ?>
        <div class="dropdown col-lg-12 vertical5">
            <div id="provinces" style="float: left; margin-right: 5px;">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="area_text">省</span> <span class="caret"></span>
                </button>
                <ul id="province_ul" class="dropdown-menu" aria-labelledby="dropdownMenu1">
                </ul>
            </div>
            <div id="cities" style="float: left; margin-right: 5px;">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="area_text">市</span> <span class="caret"></span>
                </button>
                <ul id="city_ul" class="dropdown-menu" aria-labelledby="dropdownMenu1">
                </ul>
            </div>
            <div id="districts" style="float: left;">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="area_text">区</span> <span class="caret"></span>
                </button>
                <ul id="district_ul" class="dropdown-menu" aria-labelledby="dropdownMenu1">
                </ul>
            </div>
        </div>
    </div>
    <br />
    <h4>内容</h4>
    <?php
    if (isset($casa)) {
        foreach ($casa->contents as $content) {
    ?>
    <div class="content">
        <div class="name col-lg-2 vertical5">
            <input type="text" class="form-control" value="<?php echo $content->name ?>" aria-describedby="sizing-addon3" />
        </div>
        <div class="col-lg-10 vertical5">
            <button type="button" class="btn btn-info add-photo">添加图片</button>
            <button type="button" class="btn btn-info add_content">插入内容</button>
            <button type="button" class="btn btn-info del_content">删除内容</button>
        </div>
        <?php
        foreach ($content->photos as $photo_name) {
            echo '<input type="hidden" class="hidden_photo" value="'.$photo_name.'"/>';
        }
        ?>
        <div class="text col-lg-12 vertical5">
            <textarea rows="3" cols="150"><?php echo $content->text ?></textarea>
        </div>
    </div>
    <?php }} ?>
    <!-- Contents Template while adding casa -->
    <div id="casa_content_template">
        <div class="content">
            <div class="name col-lg-2 vertical5">
                <input type="text" class="form-control" value="探庐有感" aria-describedby="sizing-addon3" />
            </div>
            <div class="col-lg-10 vertical5">
                <button type="button" class="btn btn-info add-photo">添加图片</button>
                <button type="button" class="btn btn-info add_content">插入内容</button>
                <button type="button" class="btn btn-info del_content">删除内容</button>
            </div>
            <div class="text col-lg-12 vertical5">
                <textarea rows="3" cols="150"></textarea>
            </div>
        </div>
        <div class="content">
            <div class="name col-lg-2 vertical5">
                <input type="text" class="form-control" value="民宿主人" aria-describedby="sizing-addon3" />
            </div>
            <div class="col-lg-10 vertical5">
                <button type="button" class="btn btn-info add-photo">添加图片</button>
                <button type="button" class="btn btn-info add_content">插入内容</button>
                <button type="button" class="btn btn-info del_content">删除内容</button>
            </div>
            <div class="text col-lg-12 vertical5">
                <textarea rows="3" cols="150"></textarea>
            </div>
        </div>
        <div class="content">
            <div class="name col-lg-2 vertical5">
                <input type="text" class="form-control" value="民宿特写" aria-describedby="sizing-addon3" />
            </div>
            <div class="col-lg-10 vertical5">
                <button type="button" class="btn btn-info add-photo">添加图片</button>
                <button type="button" class="btn btn-info add_content">插入内容</button>
                <button type="button" class="btn btn-info del_content">删除内容</button>
            </div>
            <div class="text col-lg-12 vertical5">
                <textarea rows="3" cols="150"></textarea>
            </div>
        </div>
        <div class="content">
            <div class="name col-lg-2 vertical5">
                <input type="text" class="form-control" value="房间印象" aria-describedby="sizing-addon3" />
            </div>
            <div class="col-lg-10 vertical5">
                <button type="button" class="btn btn-info add-photo">添加图片</button>
                <button type="button" class="btn btn-info add_content">插入内容</button>
                <button type="button" class="btn btn-info del_content">删除内容</button>
            </div>
            <div class="text col-lg-12 vertical5">
                <textarea rows="3" cols="150"></textarea>
            </div>
        </div>
        <div class="content">
            <div class="name col-lg-2 vertical5">
                <input type="text" class="form-control" value="温馨提示" aria-describedby="sizing-addon3" />
            </div>
            <div class="col-lg-10 vertical5">
                <button type="button" class="btn btn-info add-photo">添加图片</button>
                <button type="button" class="btn btn-info add_content">插入内容</button>
                <button type="button" class="btn btn-info del_content">删除内容</button>
            </div>
            <div class="text col-lg-12 vertical5">
                <textarea rows="3" cols="150"></textarea>
            </div>
        </div>
        <div class="content">
            <div class="name col-lg-2 vertical5">
                <input type="text" class="form-control" value="联系方式" aria-describedby="sizing-addon3" />
            </div>
            <div class="col-lg-10 vertical5">
                <button type="button" class="btn btn-info add-photo">添加图片</button>
                <button type="button" class="btn btn-info add_content">插入内容</button>
                <button type="button" class="btn btn-info del_content">删除内容</button>
            </div>
            <div class="text col-lg-12 vertical5">
                <textarea rows="3" cols="150"></textarea>
            </div>
        </div>
    </div>
    <div class="submit-btns">
        <button id="submit_btn" class="btn btn-primary">提交</button>
    </div>
    <!-- a method of clearing float
    <textarea style="visibility:hidden;" rows="1" cols="150"></textarea>
     -->
</div>
</body>
</html>