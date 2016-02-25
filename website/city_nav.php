<link rel="stylesheet" type="text/css" href="css/hzw-city-picker.css">
<script type="text/javascript" src="js/integration/hzw-city-picker.min.js"></script>
<script src="js/city_nav.js" type="text/javascript"></script>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/cache/AreaCache.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AreaDao.php';?>
<?php
// var_dump($_SERVER['HTTP_USER_AGENT']);
$areaCache = new AreaCache();
$baseurl = getBaseUrl();
$provincesWithSub_json = $areaCache->getProvincesWithSub_json();
$cities_json = $areaCache->getCities_json();
$citydata = $areaCache->getCities();
$area = new stdClass();
if (isset($_GET['area_id'])) {
    $areaDao = new AreaDao();
    $area = $areaDao->getAreaMess($_GET['area_id']);
}
?>
<input id="provincesWithSub_json" type="hidden" value='<?php echo $provincesWithSub_json?>'/>
<input id="cities_json" type="hidden" value='<?php echo $cities_json?>'/>
<div class="search-place hidden-sm hidden-xs">
    <div class="input-group search-place-left">
        <input type="text" class="search-frame" id="cityChoice"
                value="<?php echo $area->name?>" placeholder="选择目的地，了解当地民宿">
        <!-- <div class="city-s" style="cursor: pointer;" id="city-s">坐标</div> -->
    </div>
    <div class="clear"></div>
</div>

