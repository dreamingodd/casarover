<?php include_once 'SessionController.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/UserDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/vo/UserInSession.php';?>
<?php 
$phone = $_POST['cellphone_number'];
$pwd = $_POST['password'];
$redirect_url = $_POST['redirect_url'];

$userDao = new UserDao();
$sessionController = new SessionController();

$user_row = $userDao->getByPhone($phone);
if ($user_row['type'] == UserDao::TYPE_ADMIN && $user_row['pwd'] == md5($pwd)) {
    $userInSession = new UserInSession($user_row['id'], $user_row['name'], UserDao::TYPE_ADMIN, null, null);
    $sessionController->addUserJson(json_encode($userInSession));
}
if (empty($redirect_url)) $redirect_url = "../../website/backstage/casa_list.php";
header('Location:'.$redirect_url, true);
?>