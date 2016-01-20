<?php include_once 'SessionController.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/UserDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/vo/UserInSession.php';?>
<?php
$phone = $_POST['cellphone_number'];
$pwd = $_POST['password'];

$base_url = getBaseUrl();

$userDao = new UserDao();
$sessionController = new SessionController();
$user_row = $userDao->getByPhone($phone);
if (empty($user_row)) {
    // phone number doesn't exist.
    error('此手机号没有注册过！');
} else if ($user_row['pwd'] != md5($pwd)) {
    // incorrect password
    error('用户名或密码错误！');
} else {
    // login successfully
    // tip: "double quetos" is a necessity for json format, json数据必须使用双引号
    $userInSession = new UserInSession($user_row['id'], $user_row['name'], UserDao::TYPE_PHONE, null, null);
    $sessionController->addUserJson(json_encode($userInSession));
    echo "{\"msg\":\"success\"}";
}


function error($info) {
    echo $info;
}
?>