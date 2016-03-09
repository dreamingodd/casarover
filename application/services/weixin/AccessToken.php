<?php

/**
* 获取全局accessToken
*/
class AccessToken
{
    protected $appid;

    protected $appsecret;

    protected $accesstoken='123';
    const API_TOKEN_GET = 'https://api.weixin.qq.com/cgi-bin/token';
    function __construct($appid,$appsecret)
    {
        $this->appid=$appid;
        $this->appsecret=$appsecret;
    }

    public function getToken()
    {
//        判断缓存

    }

    public function getFromServer()
    {
        
    }
    public function getAppid()
    {
        return $this->appid;
    }

    public function getAppsecret()
    {
        return $this->appsecret;
    }

    public function getAccesstoken()
    {
        return $this->accesstoken;
    }
}