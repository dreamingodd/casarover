
<!-- 301重定向 -->
<?php

$the_host = $_SERVER['HTTP_HOST'];//取得当前域名

$the_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';//判断地址后面部分

$the_url = strtolower($the_url);//将英文字母转成小写

if($the_url=="/index.php")//判断是不是首页

{

    $the_url="";//如果是首页,赋值为空

}
//如果域名不是带www的网址那么进行下面的301跳转
if($the_host !== 'www.casarover.com' && $the_host !== 'localhost'
        && !strstr($the_host, '172.16') && !strstr($the_host, '192.168')
        && !strstr($the_host, 'http://casarover-dreamingodd.myalauda.cn')) {
    header('HTTP/1.1 301 Moved Permanently');//发出301头部

    header('Location:http://www.casarover.com'.$the_url);//跳转到带www的网址

}

?>