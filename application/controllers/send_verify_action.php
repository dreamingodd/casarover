<?php include_once 'SessionController.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/SmsSender.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/UserDao.php';?>

<?php 
$userDao = new UserDao();
$sessionController = new SessionController();
// Check time interval 后台检查时间间隔
$phone = $_GET['cellphone_number'];
$user = $userDao->getByPhone($phone);
if ($user) {
    echo "手机号已被注册";
    return;
}
if ($phone) {
    // put cellphone number into session, in case user use an different number to register.
    $sessionController->addCellphone($phone);
}
$last_time = $sessionController->getVerifyTime();
if (!empty($last_time)) {
    $this_time = time();
    $interval = $this_time - $last_time;
    if ($interval < 120) {
        echo "时间间隔太短！";
        return;
    }
}

$user = $userDao->getByPhone($phone);
if ($user) {
    echo "手机号已被注册";
    return;
}
// Generate a 6-digits random number
$random = rand(100000, 999999);

// Send to user's cellphone
$sms = new SmsSender();
if ($sms->sendVerifyCode($phone, $random)) {
    echo "{\"msg\":\"success\"}";
    // put it in the session
    $sessionController->addCode($random);
    $sessionController->addVerifyTime(time());
} else {
    echo "\n短信服务失败！";
}


// temporary return to page
// echo $random;
?>