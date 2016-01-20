<?php include_once 'SessionController.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/UserDao.php';?>

<?php
$userDao = new UserDao();
$sessionController = new SessionController();
$base_url = getBaseUrl();
$verify_code = $sessionController->getCode();
$phone_session = $sessionController->getCellphone();
$phone = $_POST['cellphone_number'];
$password = $_POST['password'];
$verify_user_code = $_POST['verify_code'];
// user with the same cellphone number.
// 已存在用户。
$user = $userDao->getByPhone($phone);
// 检查手机号码
if (empty($phone_session)) {
    // Not found in session
    header('Location:../../website/error.php?info=获取不到保存的手机号码！');
} else if ($phone != $phone_session) {
    header('Location:../../website/error.php?info=手机号码前后不一致！');
}
// Check verfiy code.
// 检查验证码
else if (empty($verify_user_code) || empty($verify_code) || $verify_code != $verify_user_code) {
    header('Location:../../website/error.php?info=验证码错误！');
}
// Check duplicated cellphone number.
// 检查是否重复
else if ($user) {
    header('Location:../../website/error.php?info=手机号已注册！');
} else {
    if($userDao->addPhoneUser($phone, $password)){
        header("Location:".$base_url."website/success.php?info=注册成功！3秒后自动跳转到登陆页面。&countdown=3"
               ."&redirect_url=".$base_url."website/index.php?auto_login=true");
    } else {
        header('Location:../../website/error.php?info=DB新建用户失败！');
    }
}
?>