<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/cache/HugePicsCache.php';?>
<?php 
// 1.Test constructor
// createOrReadCache();
// 2.Test refresh
refreshCache();
function createOrReadCache() {
    $cache = new HugePicsCache();
    var_dump($cache->getHugePics());
}
function refreshCache() {
    $cache = new HugePicsCache();
    $pics = array();
    $pic1 = new PicCache(2, "http://localhost/photo/casa_201511300320364412.jpg", PicCache::TYPE_CITY);
    $pic2 = new PicCache(8, "http://localhost/photo/casa_201511300545557067.jpg", PicCache::TYPE_AREA);
    $pic3 = new PicCache(1, "http://localhost/photo/casa_201511231125319759.jpg", PicCache::TYPE_CASA);
    array_push($pics, $pic1);
    array_push($pics, $pic2);
    array_push($pics, $pic3);
    $cache->refresh($pics);
    var_dump($cache->getHugePics());
}
?>
