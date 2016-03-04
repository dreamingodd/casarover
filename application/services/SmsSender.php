<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/PropertyManager.php';?>
<?php
    /**
    * alidayu api
    * @alidayu sdk
    * @2016-3-4
    */
class SmsSender
{
    /**
    * Send verify code to user's cellphone.
    *【注册验证】验证码.484933.，您正在注册成为探庐者用户，感谢您的支持！
    * @param String/int $phone 手机号
    * @param String/int $verify_code 后台生成的验证码
    * @return success/fail
    */
    public function sendVerifyCode($phone, $verify_code)
    {
        $c = new SmsServer;
        $c->appkey = '23320039';
        $c->secretKey = '3824e1fe3f224bb6a13ad39fe739976d';
        $req = new SendSms;
        $req->setExtend("1010");
        $req->setSmsType("normal");
        $req->setSmsFreeSignName("注册验证");
        $req->setSmsParam("{\"code\":\".$verify_code.\",\"product\":\"探庐者\"}");
        $req->setRecNum($phone);
        $req->setSmsTemplateCode("SMS_5400651");
        $resp = $c->execute($req);
        if ($resp->result->err_code == '0')
        {
            return true;
        }
        else
        {
            echo $resText;
            return false;
        }
    }
}


// 以下为sdk部分，注释了一部分，因为没有那么复杂的需求
class SendSms
{
    /** 
     * 公共回传参数，在“消息返回”中会透传回该参数；举例：用户可以传入自己下级的会员ID，在消息返回时，该会员ID会包含在内，用户可以根据该会员ID识别是哪位会员使用了你的应用
     **/
    private $extend;
    
    /** 
     * 短信接收号码。支持单个或多个手机号码，传入号码为11位手机号码，不能加0或+86。群发短信需传入多个号码，以英文逗号分隔，一次调用最多传入200个号码。示例：18600000000,13911111111,13322222222
     **/
    private $recNum;
    
    /** 
     * 短信签名，传入的短信签名必须是在阿里大鱼“管理中心-短信签名管理”中的可用签名。如“阿里大鱼”已在短信签名管理中通过审核，则可传入”阿里大鱼“（传参时去掉引号）作为短信签名。短信效果示例：【阿里大鱼】欢迎使用阿里大鱼服务。
     **/
    private $smsFreeSignName;
    
    /** 
     * 短信模板变量，传参规则{"key":"value"}，key的名字须和申请模板中的变量名一致，多个变量之间以逗号隔开。示例：针对模板“验证码${code}，您正在进行${product}身份验证，打死不要告诉别人哦！”，传参时需传入{"code":"1234","product":"alidayu"}
     **/
    private $smsParam;
    
    /** 
     * 短信模板ID，传入的模板必须是在阿里大鱼“管理中心-短信模板管理”中的可用模板。示例：SMS_585014
     **/
    private $smsTemplateCode;
    
    /** 
     * 短信类型，传入值请填写normal
     **/
    private $smsType;
    
    private $apiParas = array();
    
    public function setExtend($extend)
    {
        $this->extend = $extend;
        $this->apiParas["extend"] = $extend;
    }

    public function getExtend()
    {
        return $this->extend;
    }

    public function setRecNum($recNum)
    {
        $this->recNum = $recNum;
        $this->apiParas["rec_num"] = $recNum;
    }

    public function getRecNum()
    {
        return $this->recNum;
    }

    public function setSmsFreeSignName($smsFreeSignName)
    {
        $this->smsFreeSignName = $smsFreeSignName;
        $this->apiParas["sms_free_sign_name"] = $smsFreeSignName;
    }

    public function getSmsFreeSignName()
    {
        return $this->smsFreeSignName;
    }

    public function setSmsParam($smsParam)
    {
        $this->smsParam = $smsParam;
        $this->apiParas["sms_param"] = $smsParam;
    }

    public function getSmsParam()
    {
        return $this->smsParam;
    }

    public function setSmsTemplateCode($smsTemplateCode)
    {
        $this->smsTemplateCode = $smsTemplateCode;
        $this->apiParas["sms_template_code"] = $smsTemplateCode;
    }

    public function getSmsTemplateCode()
    {
        return $this->smsTemplateCode;
    }

    public function setSmsType($smsType)
    {
        $this->smsType = $smsType;
        $this->apiParas["sms_type"] = $smsType;
    }

    public function getSmsType()
    {
        return $this->smsType;
    }

    public function getApiMethodName()
    {
        return "alibaba.aliqin.fc.sms.num.send";
    }
    
    public function getApiParas()
    {
        return $this->apiParas;
    }
    
    public function check()
    {
        
        // RequestCheckUtil::checkNotNull($this->recNum,"recNum");
        // RequestCheckUtil::checkNotNull($this->smsFreeSignName,"smsFreeSignName");
        // RequestCheckUtil::checkNotNull($this->smsTemplateCode,"smsTemplateCode");
        // RequestCheckUtil::checkNotNull($this->smsType,"smsType");
    }
    
    public function putOtherTextParam($key, $value) {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}

class ResultSet
{
    
    /** 
     * 返回的错误码
     **/
    public $code;
    
    /** 
     * 返回的错误信息
     **/
    public $msg;
    
}

class SmsServer
{
    public $appkey;

    public $secretKey;

    public $gatewayUrl = "http://gw.api.taobao.com/router/rest";

    public $format = "json";

    public $connectTimeout;

    public $readTimeout;

    /** 是否打开入参check**/
    public $checkRequest = true;

    protected $signMethod = "md5";

    protected $apiVersion = "2.0";

    protected $sdkVersion = "top-sdk-php-20151012";

    public function __construct($appkey = "",$secretKey = ""){
        $this->appkey = $appkey;
        $this->secretKey = $secretKey ;
    }

    protected function generateSign($params)
    {
        ksort($params);

        $stringToBeSigned = $this->secretKey;
        foreach ($params as $k => $v)
        {
            if("@" != substr($v, 0, 1))
            {
                $stringToBeSigned .= "$k$v";
            }
        }
        unset($k, $v);
        $stringToBeSigned .= $this->secretKey;

        return strtoupper(md5($stringToBeSigned));
    }

    public function curl($url, $postFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($this->readTimeout) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->readTimeout);
        }
        if ($this->connectTimeout) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        }
        curl_setopt ( $ch, CURLOPT_USERAGENT, "top-sdk-php" );
        //https 请求
        if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        if (is_array($postFields) && 0 < count($postFields))
        {
            $postBodyString = "";
            $postMultipart = false;
            foreach ($postFields as $k => $v)
            {
                if("@" != substr($v, 0, 1))//判断是不是文件上传
                {
                    $postBodyString .= "$k=" . urlencode($v) . "&"; 
                }
                else//文件上传用multipart/form-data，否则用www-form-urlencoded
                {
                    $postMultipart = true;
                    if(class_exists('\CURLFile')){
                        $postFields[$k] = new CURLFile(substr($v, 1));
                    }
                }
            }
            unset($k, $v);
            curl_setopt($ch, CURLOPT_POST, true);
            if ($postMultipart)
            {
                if (class_exists('\CURLFile')) {
                    curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
                } else {
                    if (defined('CURLOPT_SAFE_UPLOAD')) {
                        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
                    }
                }
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            }
            else
            {
                $header = array("content-type: application/x-www-form-urlencoded; charset=UTF-8");
                curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
                curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
            }
        }
        $reponse = curl_exec($ch);
        
        if (curl_errno($ch))
        {
            throw new Exception(curl_error($ch),0);
        }
        else
        {
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode)
            {
                throw new Exception($reponse,$httpStatusCode);
            }
        }
        curl_close($ch);
        return $reponse;
    }

    protected function logCommunicationError($apiName, $requestUrl, $errorCode, $responseTxt)
    {
        // $localIp = isset($_SERVER["SERVER_ADDR"]) ? $_SERVER["SERVER_ADDR"] : "CLI";
        // $logger = new TopLogger;
        // $logger->conf["log_file"] = rtrim(TOP_SDK_WORK_DIR, '\\/') . '/' . "logs/top_comm_err_" . $this->appkey . "_" . date("Y-m-d") . ".log";
        // $logger->conf["separator"] = "^_^";
        // $logData = array(
        // date("Y-m-d H:i:s"),
        // $apiName,
        // $this->appkey,
        // $localIp,
        // PHP_OS,
        // $this->sdkVersion,
        // $requestUrl,
        // $errorCode,
        // str_replace("\n","",$responseTxt)
        // );
        // $logger->log($logData);
    }

    public function execute($request, $session = null,$bestUrl = null)
    {
        $result =  new ResultSet(); 
        if($this->checkRequest) {
            try {
                $request->check();
            } catch (Exception $e) {

                $result->code = $e->getCode();
                $result->msg = $e->getMessage();
                return $result;
            }
        }
        //组装系统参数
        $sysParams["app_key"] = $this->appkey;
        $sysParams["v"] = $this->apiVersion;
        $sysParams["format"] = $this->format;
        $sysParams["sign_method"] = $this->signMethod;
        $sysParams["method"] = $request->getApiMethodName();
        $sysParams["timestamp"] = date("Y-m-d H:i:s");
        if (null != $session)
        {
            $sysParams["session"] = $session;
        }

        //获取业务参数
        $apiParams = $request->getApiParas();


        //系统参数放入GET请求串
        if($bestUrl){
            $requestUrl = $bestUrl."?";
            $sysParams["partner_id"] = $this->getClusterTag();
        }else{
            $requestUrl = $this->gatewayUrl."?";
            $sysParams["partner_id"] = $this->sdkVersion;
        }
        //签名
        $sysParams["sign"] = $this->generateSign(array_merge($apiParams, $sysParams));

        foreach ($sysParams as $sysParamKey => $sysParamValue)
        {
            // if(strcmp($sysParamKey,"timestamp") != 0)
            $requestUrl .= "$sysParamKey=" . urlencode($sysParamValue) . "&";
        }
        // $requestUrl .= "timestamp=" . urlencode($sysParams["timestamp"]) . "&";
        $requestUrl = substr($requestUrl, 0, -1);

        //发起HTTP请求
        try
        {
            $resp = $this->curl($requestUrl, $apiParams);
        }
        catch (Exception $e)
        {
            $this->logCommunicationError($sysParams["method"],$requestUrl,"HTTP_ERROR_" . $e->getCode(),$e->getMessage());
            $result->code = $e->getCode();
            $result->msg = $e->getMessage();
            return $result;
        }

        //解析TOP返回结果
        $respWellFormed = false;
        if ("json" == $this->format)
        {
            $respObject = json_decode($resp);
            if (null !== $respObject)
            {
                $respWellFormed = true;
                foreach ($respObject as $propKey => $propValue)
                {
                    $respObject = $propValue;
                }
            }
        }
        else if("xml" == $this->format)
        {
            $respObject = @simplexml_load_string($resp);
            if (false !== $respObject)
            {
                $respWellFormed = true;
            }
        }

        //返回的HTTP文本不是标准JSON或者XML，记下错误日志
        if (false === $respWellFormed)
        {
            $this->logCommunicationError($sysParams["method"],$requestUrl,"HTTP_RESPONSE_NOT_WELL_FORMED",$resp);
            $result->code = 0;
            $result->msg = "HTTP_RESPONSE_NOT_WELL_FORMED";
            return $result;
        }

        //如果TOP返回了错误码，记录到业务错误日志中
        if (isset($respObject->code))
        {
            // $logger = new TopLogger;
            // $logger->conf["log_file"] = rtrim(TOP_SDK_WORK_DIR, '\\/') . '/' . "logs/top_biz_err_" . $this->appkey . "_" . date("Y-m-d") . ".log";
            // $logger->log(array(
            //     date("Y-m-d H:i:s"),
            //     $resp
            // ));
        }
        return $respObject;
    }

    public function exec($paramsArray)
    {
        if (!isset($paramsArray["method"]))
        {
            trigger_error("No api name passed");
        }
        $inflector = new LtInflector;
        $inflector->conf["separator"] = ".";
        $requestClassName = ucfirst($inflector->camelize(substr($paramsArray["method"], 7))) . "Request";
        if (!class_exists($requestClassName))
        {
            trigger_error("No such api: " . $paramsArray["method"]);
        }

        $session = isset($paramsArray["session"]) ? $paramsArray["session"] : null;

        $req = new $requestClassName;
        foreach($paramsArray as $paraKey => $paraValue)
        {
            $inflector->conf["separator"] = "_";
            $setterMethodName = $inflector->camelize($paraKey);
            $inflector->conf["separator"] = ".";
            $setterMethodName = "set" . $inflector->camelize($setterMethodName);
            if (method_exists($req, $setterMethodName))
            {
                $req->$setterMethodName($paraValue);
            }
        }
        return $this->execute($req, $session);
    }

    private function getClusterTag()
    {
        return substr($this->sdkVersion,0,11)."-cluster".substr($this->sdkVersion,11);
    }
}

// 因为不支持虚拟运营商的号段弃用
/**
 * 百度Api Store 凯信通 短信服务商.
 * @author Ye_WD
 * @2015-12-19
 */
// class SmsSender {
//     /**
//      * Send verify code to user's cellphone.
//      * e.g.【探庐者】感谢您使用我们的服务！您的验证码是000000。
//      * @param String/int $phone 手机号
//      * @param String/int $verify_code 后台生成的验证码
//      * @return success/fail
//      */
//     public function sendVerifyCode($phone, $verify_code) {
//         // curl 服务需要在php.ini中开启
//         $c = new SmsServer;
//         $c->appkey = '23320039';
//         $c->secretKey = '3824e1fe3f224bb6a13ad39fe739976d';
//         $req = new SendSms;
//         $req->setExtend("1010");
//         $req->setSmsType("normal");
//         $req->setSmsFreeSignName("注册验证");
//         $req->setSmsParam("{\"code\":\".$verify_code.\",\"product\":\"探庐者\"}");
//         $req->setRecNum($phone);
//         $req->setSmsTemplateCode("SMS_5400651");
//         $resp = $c->execute($req);
//         // $ch = curl_init();
//         // $url = 'http://apis.baidu.com/kingtto_media/106sms/106sms?mobile='
//         //         .$phone
//         //         .'&content='
//         //         .'%E3%80%90%E6%8E%A2%E5%BA%90%E8%80%85%E3%80%91%E6%84%9F%E8%B0%A2%E6%82%A8%E4%BD%BF%E7%94%A8%E6%88%91%E4%BB%AC%E7%9A%84%E6%9C%8D%E5%8A%A1%EF%BC%81%E6%82%A8%E7%9A%84%E9%AA%8C%E8%AF%81%E7%A0%81%E6%98%AF'
//         //         .$verify_code
//         //         .'%E3%80%82';
//         // $header = array(
//         //         'apikey:9738609b08c0bd3746f63b4edb16d193',
//         // );
//         // // 添加apikey到header
//         // curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
//         // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//         // // 执行HTTP请求
//         // curl_setopt($ch , CURLOPT_URL , $url);
//         // $resText = curl_exec($ch);
//         if ($resp->result->err_code == '0') {
//             return true;
//         } else {
//             echo $resText;
//             return false;
//         }
//     }
// }
// $sender = new SmsSender();
// $sender->sendVerifyCode('15869154101', '1234');

?>