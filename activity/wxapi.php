<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/PropertyManager.php';

class WXapi{

    protected $appid;
    protected $secret;
    const oauthurl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=';
    const getTokenUrl = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=';
    protected $redirect_uri;

    public function __construct()
    {
        $pro = new PropertyManager();
        $this->appid = $pro->getProperty('wx_appid');
        $this->secret = $pro->getProperty('wx_appsecret');
    }
    public function start($redirect_uri)
    {
        $this->redirect_uri = $redirect_uri;
        $mustdata = '&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
        $gourl = self::oauthurl.$this->appid.'&redirect_uri='.$this->redirect_uri.$mustdata;
        
        $this->redirect($gourl);
    }
    public function getOpenid($code)
    {
        $get_token_url = self::getTokenUrl.$this->appid.'&secret='.$this->secret.'&code='.$code.'&grant_type=authorization_code';
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$get_token_url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $res = curl_exec($ch);
        curl_close($ch);
        $json_obj = json_decode($res,true);
        $openid = $json_obj['openid'];
        return $openid;
    }

    public function redirect($newurl,$getdata=null)
    {
        header("Location:".$newurl.'?'.$getdata);
    }
}