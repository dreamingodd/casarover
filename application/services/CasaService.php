<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/CasaDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/TagDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/CasaTagDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AreaDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/ContentDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AttachmentDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/ContentAttachmentDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/vo/Casa.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/vo/Tag.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/vo/Area.php';?>
<?php
class CasaService {

    private $casaDao;
    private $tagDao;
    private $casaTagDao;
    private $areaDao;
    private $contentDao;
    private $attachmentDao;
    // caDao
    private $caDao;

    public function __construct() {
        $this->casaDao = new CasaDao();
        $this->tagDao = new TagDao();
        $this->casaTagDao = new CasaTagDao();
        $this->areaDao = new AreaDao();
        $this->contentDao = new ContentDao();
        $this->attachmentDao = new AttachmentDao();
        $this->caDao = new ContentAttachmentDao();
    }

    public function getCasaWithAttachment($casa_id) {
        $casa = new Casa($this->casaDao->getById($casa_id));
        $a_row = $this->attachmentDao->getById($casa->attachment->id);
        $casa->attachment->filepath = $a_row['filepath'];
        return $casa;
    }

    /**
     * Combines tags with casa.
     * @return false if the process failed.
     */
    public function combineCasaTags($casa_id, $tag_ids) {
        if (!$this->casaTagDao->delByCasaId ( $casa_id )) return false;
        foreach ( $tag_ids as $tag_id ) {
            if (!$this->casaTagDao->add($casa_id, $tag_id)) return false;
        }
        return true;
    }

    /**
     * Gets all the casa's infomation:
     * the casa itself;
     * the area;
     * the main attachment;
     * the tags;
     * the contents(with their attachments);
     */
    public function getWholeCasa($casa_id) {
        $casa_row = $this->casaDao->getById($casa_id);
        return $this->getWholeCasaByCasaRow($casa_row);
    }

    protected function getCasaWithoutContentByCasaRow($casa_row) {
        $casa = new Casa();
        $casa->id = $casa_row['id'];
        $casa->code = $casa_row['code'];
        $casa->name = $casa_row['name'];
        $casa->link = $casa_row['link'];
        $casa->area = new Area($this->areaDao->getById($casa_row['dictionary_id']));
        $casa->update_time = $casa_row['update_time'];
        if (!empty($casa_row['attachment_id'])) {
            $main_photo_row = $this->attachmentDao->getById($casa_row['attachment_id']);
            $casa->main_photo_name = $main_photo_row['filepath'];
        }
        // get tags
        $casa->tags = array();
        $casaTag_rows = $this->casaTagDao->getByCasaId($casa->id);
        while ($casaTag_row = mysql_fetch_array($casaTag_rows)) {
            $tag_row = $this->tagDao->getById($casaTag_row['tag_id']);
            $tag = new Tag($tag_row);
            array_push($casa->tags, $tag);
        }
        return $casa;
    }
    public function getWholeCasaByCasaRow($casa_row) {
        if (empty($casa_row['id'])) return null;
        // get casa without content.
        $casa = $this->getCasaWithoutContentByCasaRow($casa_row);
        // get contents
        $casa->contents = array();
        $content_rows = $this->contentDao->getByCasaId($casa->id);
        while ($content_row = mysql_fetch_array($content_rows)) {
            $content = new stdClass();
            $content->id = $content_row['id'];
            $content->name = $content_row['name'];
            $content->display_order = $content_row['display_order'];
            $content->text = $content_row['text'];
            // get photos/attachments of certain content
            $content->photos = array();
            $ca_rows = $this->caDao->getByContentId($content->id);
            while ($ca_row = mysql_fetch_array($ca_rows)) {
                $attachment_row = $this->attachmentDao->getById($ca_row['attachment_id']);
                $photo_name = $attachment_row['filepath'];
                array_push($content->photos, $photo_name);
            }
            array_push($casa->contents, $content);
        }
        return $casa;
    }

    /**
     * get casas 
     * @param int $city_id
     * @return array of Casa Object:
     */
    public function getCasasByCityId($city_id,$page=0) {
        $casas = array();
        $casa_rows = $this->casaDao->getByParentAreaId($city_id,$page);
        while ($casa_row = mysql_fetch_array($casa_rows)) {
            $casa = $this->getCasaWithoutContentByCasaRow($casa_row);
            array_push($casas, $casa);
        }
        return $casas;
    }
    public function getCasasByCityId_json($city_id) {
        return json_encode($this->getCasasByCityId($city_id));
    }

    /**
     * scenery(景点) is the tag whose type is scenery.
     * area/district(区域) is the area which level is 4.
     * @param int $city_id
     * @param int,int,int $tag_ids_str e.g. "1,3,4"
     * @param int,int,int $scenery_tag_ids_str e.g. "1,3,4"
     * @param int,int,int $area_ids_str e.g. "1,3,4"
     * @return array of Casa
     */
    public function getForCitySearch($city_id, $tag_ids_str, $scenery_tag_ids_str, $area_ids_str,$page=0) {
        $casa_rows = $this->casaDao->getByMultiConfition($city_id, $tag_ids_str, $scenery_tag_ids_str, $area_ids_str,$page);
        $casas = array();
        while ($casa_row = mysql_fetch_array($casa_rows)) {
            $casa = $this->getCasaWithoutContentByCasaRow($casa_row);
            array_push($casas, $casa);
        }
        return $casas;
    }

    public function delAttachment($casa_id, $a_id) {
        if (!$this->casaDao->delPhoto($casa_id)) return false;
        if (!$this->attachmentDao->del($a_id)) return false;
        return true;
    }

}
?>