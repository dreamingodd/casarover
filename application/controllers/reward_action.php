<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/RewardDao.php';?>
<?php 
$id = $_GET['id'];
$action = $_GET['action'];
$dao = new RewardDao();
if ($action == "receive") {
    $dao->updateReceived($id, 1);
} else if ($action == "unreceive") {
    $dao->updateReceived($id, 0);
} else if ($action == "delete") {
    $dao->del($id);
}
header("Location:".getBaseUrl()."website/backstage/reward_list.php");
?>