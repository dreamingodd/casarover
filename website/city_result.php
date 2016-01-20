<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/CasaService.php';?>
<?php
$area_id = $_GET['area_id'];
$casaService = new CasaService();
$casas = array();
$page = $_GET['page'];
if (empty($_GET['themes']) && empty($_GET['sceneries'])) {
    $casas = $casaService->getCasasByCityId($area_id,$page);
} else {
    $casas = $casaService->getForCitySearch($area_id, $_GET['themes'], null, $_GET['sceneries'],$page);
}
$data = array('status'=>'0','msg'=>'ok','result'=>$casas);
echo json_encode($data);
?>