<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/ContentDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/ContentAttachmentDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AttachmentDao.php';?>
<?php
class ContentService {
    private $contentDao;
    private $attachmentDao;
    /** ContentAttachmentDao */
    private $caDao;

    function __construct() {
        $this->contentDao = new ContentDao();
        $this->attachmentDao = new AttachmentDao;
        $this->caDao = new ContentAttachmentDao();
    }

    function delContentsRelated($casa_id) {
        $content_rows = $this->contentDao->getByCasaId($casa_id);
        while ($content_row = mysql_fetch_array($content_rows)) {
            $ca_rows = $this->caDao->getByContentId($content_row['id']);
            if (!$this->caDao->delByContentId($content_row['id'])) return false;
            while ($ca_row = mysql_fetch_array($ca_rows)) {
                if (!$this->attachmentDao->del($ca_row['attachment_id'])) return false;
            }
        }
        $this->contentDao->delByCasaId($casa_id);
        return true;
    }
}
?>
