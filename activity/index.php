<?php

require 'wxapi.php';

$wxapi = new WXapi();

//控制是否在者里面查看
$loc = $_GET["loc"];
//进入之后进入微信的授权页面获取code
//成功之后的跳转链接
$redirect_uri = 'http://www.casarover.com/casarover/activity/oauth.php?loc='.$loc;
$start_stup = $wxapi->start($redirect_uri);

