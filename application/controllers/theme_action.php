<?php include_once 'SessionController.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/ThemeService.php';?>
<?php 
/**
 * 
 * @author Ye_WD
 * @2016-1-27
 */
$action = $_GET['action'];
$service = new ThemeService();
$id = $_GET['id'];
if (!$id) $id = $_POST['id'];
if ($action == 'edit') {
    $sc = new SessionController();
    $theme_items = array();
    $area_ids = array();
    $service->addOrUpdate($_POST['name'], $_POST['description'], $_POST['filepath'], $sc->getUsername(),
            $theme_items, $area_ids, $id);
    header("Location:../../website/backstage/success.php?info=添加或更新主题成功！&type=theme");
} else if ($action == 'recycle') {
    $service->recycleTheme($id);
    header("Location:../../website/backstage/theme_list.php");
} else if ($action == 'recover') {
    $service->recoverTheme($id);
    header("Location:../../website/backstage/theme_list.php?deleted=1");
}
?>