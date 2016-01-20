<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/UserDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/SessionController.php';?>
<?php 
/**
 * 检查后台登陆情况，未登录则转到登陆页面。
 */
$url = getCurrentUrl();
$sc = new SessionController();
$uis = json_decode($sc->getUserJson());
if (!$uis || $uis->type != UserDao::TYPE_ADMIN) {
    header('Location:'.getBaseUrl().'website/backstage/admin_login.php?redirect_url='.$url);
}
?>