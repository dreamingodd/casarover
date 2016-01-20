<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/SessionController.php';?>
<?php
$location = $_GET['location'];
$sessionController = new SessionController();
$sessionController->destroyUser();
if ($location == 'backstage') {
    header("Location:../../website/backstage/admin_login.php");
} else {
    header("Location:../../website");
}
?>
