<?php header("Content-Type: text/html; charset=utf-8");?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/db_connection.php';?>
<?php
/**
 * 中间表.
 * @author Ye_WD
 * @20151201
 */
class ContentAttachmentDao {
    function add($content_id, $attachment_id) {
        $sql = "insert into content_attachment (content_id,attachment_id) "
                . "values(" . $content_id . "," . $attachment_id . ")";
        return mysql_query ( $sql );
    }
    function delByContentId($content_id) {
        $sql = "delete from content_attachment where content_id=" . $content_id;
        return mysql_query ( $sql );
    }
    function getByContentId($content_id) {
        $sql = 'select * from content_attachment where content_id=' . $content_id;
        return mysql_query ( $sql );
    }
}
?>