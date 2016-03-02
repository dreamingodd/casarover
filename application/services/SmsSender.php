<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/PropertyManager.php';?>
<?php
/**
 * 百度Api Store 凯信通 短信服务商.
 * @author Ye_WD
 * @2015-12-19
 */
class SmsSender {
    private $pm;
    public function __construct() {
        $this->pm = new PropertyManager();
    }
    /**
     * Send verify code to user's cellphone.
     * e.g.【探庐者】感谢您使用我们的服务！您的验证码是000000。
     * @param String/int $phone 手机号
     * @param String/int $verify_code 后台生成的验证码
     * @return success/fail
     */
    public function sendVerifyCode($phone, $verify_code) {
        // curl 服务需要在php.ini中开启
        $ch = curl_init();
        $url = 'http://apis.baidu.com/kingtto_media/106sms/106sms?mobile='
                .$phone
                .'&content='
                .'%E3%80%90%E6%8E%A2%E5%BA%90%E8%80%85%E3%80%91%E6%84%9F%E8%B0%A2%E6%82%A8%E4%BD%BF%E7%94%A8%E6%88%91%E4%BB%AC%E7%9A%84%E6%9C%8D%E5%8A%A1%EF%BC%81%E6%82%A8%E7%9A%84%E9%AA%8C%E8%AF%81%E7%A0%81%E6%98%AF'
                .$verify_code
                .'%E3%80%82';
        $header = array(
                'apikey:'.$this->pm->getProperty("sms_key"),
        );
        // 添加apikey到header
        curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行HTTP请求
        curl_setopt($ch , CURLOPT_URL , $url);
        $resText = curl_exec($ch);
        if (strstr($resText, 'Success')) {
            return true;
        } else {
            echo $resText;
            return false;
        }
    }
}
// $sender = new SmsSender();
// $sender->sendVerifyCode('15869154101', '1234');
?>