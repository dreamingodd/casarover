<?php

define("TOKEN", "ywd_casarover");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid();
logger("visit");

class wechatCallbackapiTest {
    public function valid() {
        $echoStr = $_GET["echostr"];
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }
    private function checkSignature() {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if( $tmpStr == $signature ) {
            return true;
        } else {
            return false;
        }
    }
}
function logger($content) {
    file_put_contents("log.html", date('Y-m-d H:i:s ').$content.'<br/>', FILE_APPEND);
}
?>