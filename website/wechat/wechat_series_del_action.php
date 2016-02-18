<?php include_once 'WechatSeriesDao.php';?>
<?php
$id = $_GET['id'];
$dao = new WechatSeriesDao();
$success = true;
$success = $dao->del($id);
if ($success) {
    header("Location:wechat_series_list.php");
} else {
    header("Location:../backstage/error.php?info=".mysql_error());
}
?>