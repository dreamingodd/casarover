<?php

class WXapi{
    const appid = 'wxeafd79d8fcbd74ee';
    const secret = '5db9a898bdd7f430bbc563476021f4b2';
    const oauthurl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=';
    const getTokenUrl = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=';
    protected $redirect_uri;

    public function start($redirect_uri)
    {
        $this->redirect_uri = $redirect_uri;
        $mustdata = '&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
        $gourl = self::oauthurl.self::appid.'&redirect_uri='.$this->redirect_uri.$mustdata;
        
        $this->redirect($gourl);
    }
    public function getOpenid($code)
    {
//        $get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='
//            .$secret.'&code='.$code.'&grant_type=authorization_code';
        $get_token_url = self::getTokenUrl.self::appid.'&secret='.self::secret.'&code='.$code.'&grant_type=authorization_code';
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$get_token_url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $res = curl_exec($ch);
        curl_close($ch);
        $json_obj = json_decode($res,true);
//        $access_token = $json_obj['access_token'];
        $openid = $json_obj['openid'];

        return $openid;
    }

    public function redirect($newurl)
    {
        header("Location:".$newurl);
    }
}