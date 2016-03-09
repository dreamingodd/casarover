<?php

require 'AccessToken.php';

class  WeiXin{
    //应该写在配置文件中


    protected $accessToken;
    function __construct(AccessToken $accessToken)
    {
    //var_dump($accessToken);
        $this->setAccessToken($accessToken);
        $accessToken->getAppid();
    }

    public function setAccessToken(AccessToken $accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

}

$weixin = new WeiXin();
var_dump($ewixin);
