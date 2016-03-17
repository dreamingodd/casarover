<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AttachmentDao.php';?>
<?php include_once 'WechatArticle.php';?>
<?php include_once 'WechatArticleDao.php';?>
<?php
$waDao = new WechatArticleDao(); 
$aDao = new AttachmentDao();
$a_id = $_POST['attachment_id'];
$wa_id = $_POST['id'];
$type = $_POST['type'];
$series = $_POST['series'];
if (empty($series)) $series = 0;
$filepath = $_GET['filepath'];
$wa = new WechatArticle($wa_id, $a_id, $_POST['title'], $_POST['brief'],
        $_POST['address'], $type, $series, $_POST['deleted']);
$update_attachemnt = false;
if ($a_id) {
    $attachment_row = $aDao->getById($a_id);
    if ($attachment_row['filepath'] != $filepath) {
        // 更新了图片
        $update_attachemnt = true;
    }
} else {
    // 无图片
    $update_attachemnt = true;
}
if ($update_attachemnt) {
    $a_id = $aDao->addSimple($filepath);
    if (!$a_id) {
        echo '数据库添加图片失败！'.'</br>'.mysql_error();
        exit;
    } else {
        $wa->attachment_id = $a_id;
    }
}
if ($waDao->addOrUpdate($wa)) {
    header('Location:../backstage/success.php?info='.'添加成功！'.'&type=wechat_article_'.$type);
} else {
    echo '添加/更新失败！'.'</br>'.mysql_error();
    exit;
}
?>