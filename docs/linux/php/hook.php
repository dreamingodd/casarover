<?php

/**
* draguo
* 2016.1.9
* 通过git hook 自动化部署
* 在网站目录 mkdir hook 
* 在hook中放置该文件用于接收hook请求
* 要在visudo 中添加
* www-data  ALL=(ALL) NOPASSWD: ALL
* ubuntu测试通过
* 修改/etc/selinux/config 文件
* 将SELINUX=enforcing改为SELINUX=disabled
* centos 测试通过php >5.3
*/

ini_set('max_execution_time', '0');
// 生产环境目录
$web_dir = __DIR__.'/../casarover';
// 准备部署的文件
$dir = '/var/www/casarover';
// hook password
$pwd = 'jjfjjmldhz';

// 接收hook

$data = $_POST["hook"];
$json = json_decode($data,true);

if (empty($json)) {
    header("Location: http://www.casarover.com");
}
if ($json['password'] !== $pwd) {
    echo "password is wrong";
    exit();
}

// 执行的脚本内容
$shs = array(
    "cd $dir && sudo git pull",
    "sudo rm -rf $web_dir/* ",
    "cd $dir/web && sudo rm -rf .settings/ docs/ tests/ .buildpath .project .zfproject.xml website/less/ ",
    "sudo cp -r $dir/web/* $web_dir/"
     );

foreach ($shs as $sh) {
    shell_exec($sh);
}

?>
