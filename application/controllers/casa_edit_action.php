<?php header("Content-Type: text/html; charset=utf-8");?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/TagDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/CasaTagDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/CasaDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/CasaTagDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AttachmentDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AreaDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/ContentDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/ContentAttachmentDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/CasaService.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/ContentService.php';?>
<?php 
$casa_JSON_str = remove_slash($_REQUEST['casa_JSON_str']);
$casa = json_decode($casa_JSON_str);

$casaDao = new CasaDao();
$areaDao = new AreaDao();
$attachmentDao = new AttachmentDao();
$tagDao = new TagDao();
$casaTagDao = new CasaTagDao();
$contentDao = new ContentDao();
$contentAttachmentDao = new ContentAttachmentDao();
$casaService = new CasaService();
$contentService = new ContentService();

mysql_query('START TRANSACTION') or die(mysql_error());
$mode = 'edit';
if (empty($casa->id)) {
    $mode = 'add';
}
/** 1.添加基础民宿 */
if (!empty($casa->name) && !empty($casa->code) && !empty($casa->area)) {
    $casa_id = $casaDao->addOrUpdateSimple($casa->name, $casa->code, $casa->link, $casa->area, $casa->id);
    if (!$casa_id) {
        mysql_query('ROLLBACK');
        header('Location:../../website/backstage/error.php?info=添加或更新民宿对象信息失败！'
                .mysql_error().'&type=casa');
        exit();
    }
} else {
    header('Location:../../website/backstage/error.php?info=添加失败，民宿信息不全！&type=casa');
    exit();
}
/** 2.添加民宿默认图 */
if (!empty($casa->main_photo)) {
    $casa_row = $casaDao->getById($casa_id);
    if (!empty($casa_row['attachment_id'])) {
        $attachment_row = $attachmentDao->getById($casa_row['attachment_id']);
        // 更新了图片
        if (!($attachment_row['filepath'] == $casa->main_photo)) {
            if (!$casaService->delAttachment($casa_id, $attachment_row['id'])) db_error("删除默认图片失败！");
            $mainAttachmentId = $attachmentDao->addSimple($casa->main_photo);
            if (!$mainAttachmentId) db_error("添加默认图片失败！");
            if (!$casaDao->addPhoto($casa_id, $mainAttachmentId)) db_error("关联民宿和默认图片失败！");
        } // else 跟之前的图片一样，不需要update
    } else {
        // 新的民宿无图片
        $mainAttachmentId = $attachmentDao->addSimple($casa->main_photo);
        if (!$mainAttachmentId) db_error("添加默认图片失败！");
        if (!$casaDao->addPhoto($casa_id, $mainAttachmentId)) db_error("关联民宿和默认图片失败！");
    }
}
/** 3.标签处理 */
if (!$casaTagDao->delByCasaId($casa_id)) db_error("更新标签关联第一步失败！");
$tag_ids = array();
// 必选标签
foreach ($casa->tags as $tagId) {
    $tagId = intval($tagId);
    array_push($tag_ids, $tagId);
}
// 自定义标签
$user_tags = $casa->user_tags;
if (!empty($user_tags)) {
    $customizedTagIds = $tagDao->addCustomizedTags($user_tags);
    if (!$customizedTagIds) db_error("更新自定义标签失败！");
    foreach ($customizedTagIds as $tagId) {
        array_push($tag_ids, $tagId);
    }
}
// 关联标签和民宿
if (!$casaService->combineCasaTags($casa_id, $tag_ids)) db_error("关联民宿和标签失败！");
/** 4.添加内容 */
if (!$contentService->delContentsRelated($casa_id)) db_error("删除原有内容失败！");
$contents = $casa->contents;
$i = 1;
foreach ($contents as $content) {
    $content_id = $contentDao->add($casa_id, $content->name, $content->text, i * 10);
    if (!$content_id) db_error("添加内容失败！");
    foreach ($content->photos as $filename) {
        $attachment_id = $attachmentDao->addSimple($filename);
        if (!$attachment_id) db_error("添加内容图片失败！");
        if (!$contentAttachmentDao->add($content_id, $attachment_id)) db_error("关联内容和图片失败！");
    }
    $i++;
}
$infoText = '';
if (mode == 'add') {
    $infoText = '添加民宿成功！';
} else {
    $infoText = '编辑民宿成功！';
}
// 执行成功，提交事务。
mysql_query('COMMIT')or die(mysql_error());
header('Location:../../website/backstage/success.php?info='.$infoText.'&type=casa&id='.$casa_id);

function db_error($info) {
    mysql_query('ROLLBACK') or exit(mysql_error());
    header('Location:../../website/backstage/error.php?info='.$info.'<br/>'.mysql_error().'&type=casa');
    exit();
}
?>
