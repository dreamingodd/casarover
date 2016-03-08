<?php

/**
* 获取全局accessToken
*/
class AccessToken
{
    protected $appid;

    protected $appsecret;

    const API_TOKEN_GET = 'https://api.weixin.qq.com/cgi-bin/token';
    function __construct($appid,$appsecret,$cache)
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
}