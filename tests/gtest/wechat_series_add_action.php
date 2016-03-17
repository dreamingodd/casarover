<?php include_once 'WechatSeriesDao.php';?>
<?php
$name = $_POST['name'];
$type = $_POST['type'];
if (empty($type)) {
    // 探庐系列
    $type = 1;
}
$dao = new WechatSeriesDao();
$success = true;
$success = $dao->addOrUpdate($type, $name);
if ($success) {
    header("Location:wechat_series_list.php");
} else {
    header("Location:../backstage/error.php?info=".mysql_error());
}
?>