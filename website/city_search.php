<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>探庐者-城市</title>
<?php $rand = rand(1000, 9999); ?>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/main.css?rand=<?php echo $rand; ?>">
<link rel="stylesheet" href="css/city.css?rand=<?php echo $rand; ?>">
<link rel="stylesheet" href="css/flexslider.css?rand=<?php echo $rand; ?>">
<link rel="icon" href="image/favicon.ico">
<script src="js/integration/jquery.min.js"></script>
<script src="js/integration/bootstrap.min.js"></script>
<script src="js/integration/json2.js"></script>
<script src="js/integration/jquery.flexslider-min.js"></script>
<script src="js/main.js?rand=<?php echo $rand; ?>"></script>
<script src="js/city_search.js?rand=<?php echo $rand; ?>"></script>
</head>
<body>
<?php include '301.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AreaDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/AreaService.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/TagService.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/CasaService.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/AreaController.php';?>
<?php
$area_id = $_GET['area_id'];
$areaService = new AreaService();

$picdir = '../../photo/';

$city_ids = $areaService->getCityIdsIncludeDirect();
if (!empty($area_id) && in_array($area_id, $city_ids)) {
    $areaDao = new AreaDao();
    $area = new Area($areaDao->getById($area_id));
} else {
    header('Location:error.php?info=无效城市！');
}
$tagService = new TagService();
$officialTags = $tagService->getOfficialTags();
$subAreas = $areaService->getSubAreas($area_id);

$casaService = new CasaService();
$casas = array();
// because there may be casa that has no tag,
// if one casa has no tag, it will never appear in the result of getForCitySearch(),
// root cause is in sql query statement, look into CasaDao.getByMultiConfition().
if (empty($_GET['themes']) && empty($_GET['sceneries'])) {
    $casas = $casaService->getCasasByCityId($area_id);
} else {
    $casas = $casaService->getForCitySearch($area_id, $_GET['themes'], null, $_GET['sceneries']);
}

$area = new AreaController();
$message = $area->simpleMess();

?>
<input id="city_id" type="hidden" value="<?php echo $_GET['area_id']?>"/>
<input id="themes" type="hidden" value="<?php echo $_GET['themes']?>"/>
<input id="sceneries" type="hidden" value="<?php echo $_GET['sceneries']?>"/>
<input id="prices" type="hidden" value="<?php echo $_GET['prices']?>"/>
<?php include 'login.php';?>
<?php include 'header.php';?>
<div class="container">
    <?php include 'city_nav.php';?>
    <!-- 轮播图 Start -->
    <div class="city-slider">
        <div class="flexslider">
            <ul class="slides">
                <?php foreach ($message as $value): ?>
                    <?php if(!empty($value->title_img)):?>
                    <li>
                        <div class="pic" style="background-image:url(<?php echo $picdir.$value->title_img;?>)" onclick="goto_area(<?php echo $value->id?>)">
                        </div>
                        <div class="show-mess">
                            <div class="main">
                                <div style="font-size:24px; text-indent:center;"><?php echo $value->name;?>简介</div>
                                <?php echo $value->contents[0] ; ?>
                            </div>
                        </div>
                    </li>
                    <?php endif ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <!-- 轮播图 End -->
    <div id="multi-condition_search" class="place-sel-middle">
        <div class="sel-main">
            <div class="left">
                <div class="head-name">主题</div>
                <div id="theme_all" class="psm-all clickable">不限</div>
            </div>
            <div class="right">
                <ul class="condition">
                    <?php foreach ($officialTags as $tag): ?>
                        <li  id="theme_<?php echo $tag->id?>" value="0" class="theme">
                            <?php echo $tag->name; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div id="more-theme"><span>更多</span></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="sel-main">
            <div class="left">
                <div class="head-name">区域</div>
                <div id="scenery_all" class="psm-all clickable">不限</div>
            </div>
            <div class="right">
                <ul class="condition">
                    <?php foreach($subAreas as $area): ?>
                        <li class="scenery" id="scenery_<?php echo $area->id?>" value="0">
                            <?php echo $area->name ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <!-- 客栈列表 Start -->
    <div class="show-result">
    </div>
    <!-- 客栈列表 End -->
    <?php include 'footer.php';?>
</div>
</body>
</html>