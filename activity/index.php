<?php
$appid= 'wxeafd79d8fcbd74ee';
$redirect_uri = 'http://www.casarover.com/casarover/activity/oauth.php';
$gourl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.
         '&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
header("Location:".$gourl);