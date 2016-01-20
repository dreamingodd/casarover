<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AttachmentDao.php';?>
<?php include_once 'WechatArticle.php';?>
<?php include_once 'WechatArticleDao.php';?>
<?php
$id = $_GET['id'];
$type = $_GET['type'];
$deleted = $_GET['deleted'];
$option = $_GET['option'];
$dao = new WechatArticleDao();
$success = true;
if ($option == "recycle") {
    $success = $dao->recycle($id);
} else if ($option == "recover") {
    $success = $dao->recover($id);
}
if ($success) {
    header("Location:wechat_article_list.php?type=$type&deleted=$deleted");
} else {
    header("Location:../backstage/error.php?info=".mysql_error());
}
?>