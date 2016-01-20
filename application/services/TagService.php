<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/TagDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/vo/Tag.php';?>
<?php
class TagService {
    private $tagDao;
    public function __construct() {
        $this->tagDao = new TagDao();
    }
    // 取得  an array of our pre-defined Tag objects.
    public function getOfficialTags() {
        $tags = array();
        $tag_rows = $this->tagDao->getAll();
        while ($tag_row = mysql_fetch_array($tag_rows)) {
            if ($tag_row['type'] != 'custom') {
                array_push($tags, new Tag($tag_row));
            }
        }
        return $tags;
    }
    // 取得  an array of our pre-defined Tag names.
    public function getOfficalTagNames() {
        $tag_names = array();
        $tags = $this->getOfficialTags();
        foreach($tags as $tag) {
            array_push($tag_names, $tag->name);
        }
        return $tag_names;
    }
    // 取得  an array of uses' user-defined tag objects.
    public function getCustomTags() {
        $tags = array();
        $tag_rows = $this->tagDao->getAll();
        while ($tag_row = mysql_fetch_array($tag_rows)) {
            if ($tag_row['type'] == 'custom') {
                array_push($tags, new Tag($tag_row));
            }
        }
        return $tags;
    }
    // 取得  an array of uses' user-defined tag names.
    public function getCustomTagNames() {
        $tag_names = array();
        $tags = $this->getCustomTags();
        foreach($tags as $tag) {
            array_push($tag_names, $tag->name);
        }
        return $tag_names;
    }

}
?>
