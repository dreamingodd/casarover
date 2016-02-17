<html>
<head>
<style type="text/css">
#container {
    margin: 0 auto;
    border: 1px solid grey;
    width: 500px;
    padding: 15px;
    margin-top: 100px;
}
h3 {
    text-align: center;
}
</style>
<script type="text/javascript">
window.onload = function(){
//    var pwd = document.getElementById("pwd");
//    if (pwd) {
//        var form = document.getElementById("form");
//        form.style.display = "none";
//    }
};
</script>
</head>
<body>
<div id="container">
<h3>Casarover Auto-deploy Tool</h3>
<?php 
$pwd = $_POST["pwd"];
if (empty($pwd)) {
?>
    <form method="post" id="form">
        Input Password:
        <input type="password" id="pwd" name="pwd" value="<?php echo $_POST['pwd'];?>">
        <input type="submit" value="Deploy">
    </form>
<?php 
} else if (md5(md5($pwd)) == "65ddcae2800cbd732369e8fe7d1461d2") {
    $command = "sudo /home/git/casarover/docs/linux/sh/deploy_by_git.sh $pwd";
    $logFileName = "/tmp/deploy_".date('Ymd_His').".log";
    $logFile = fopen($logFileName, 'w') or die('File: '.$logFileName.' open failed!');;
    exec($command, $outputArray, $returnVal);
    foreach ($outputArray as $line) {
        echo $line.'<br/>';
        fwrite($logFile, $line.'\n');
    }
    fclose($logFile);
    if ($returnVal) {
        echo '<br/><span style="color:red;">执行失败！<br/>Details refer to /etc/httpd/logs/error_log</span>';
    } else {
        echo '<br/><span style="color:green;">执行完毕！<br/>Logs save in '.$logFileName.'</span>';
    }
} else {
?>
<span style="color:red;">密码错误！</span>
<?php
}
?>
</div>
</body>
</html>