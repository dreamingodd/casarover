<?php include_once 'SessionController.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/UserDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AttachmentDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/vo/UserInSession.php';?>
<?php
/**
 * This file is for the user's information management after he/she is logged in via QQ.
 * Generally, the process will check whether exists in the database or not,
 * not exists: will create a new user and store in database;
 * exists: will get the existing user.
 * Finally, put the user infomation into session/cookie.
 * @author Ye_WD
 * @2015-12-16
 */
$openid = $_POST["openid"];
$nickname = $_POST["nickname"];
$gender = $_POST["gender"];
$filepath = $_POST["filepath"];
$access_token = $_POST["access_token"];

$userDao = new UserDao();
$attachmentDao = new AttachmentDao();
$sessionController = new SessionController();
$user_row = $userDao->getByQQOpenid($openid);
// 用户第一次登陆
if (empty($user_row)) {
    $userId = $userDao->addQQUser($openid, $nickname, $gender);
    if (!$userId) db_error("储存QQ用户信息失败！");
    $attachmentId = $attachmentDao->addSimple($filepath);
    if (!$attachmentId) db_error("存储图片附件失败！");
    if (!$userDao->addPhoto($userId, $attachmentId)) {
        db_error("存储用户头像失败！");
    }
    $userInSession = new UserInSession($userId, $nickname, UserDao::TYPE_QQ, $openid, $access_token);
    $sessionController->addUserJson(json_encode($userInSession));
    output("New user, add user success.");
}
// 用户已经登陆过了
else {
    $userInSession = new UserInSession($user_row['id'], $user_row['name'], $user_row['type'],
            $user_row['qq_openid'], $access_token);
    $sessionController->addUserJson(json_encode($userInSession));
    output("Old user, login success.");
}

function output($msg) {
    $data = new stdClass();
    $data->msg = $msg;
    echo json_encode($data);
}
function db_error($info) {
    echo $info;
    exit();
}
?>