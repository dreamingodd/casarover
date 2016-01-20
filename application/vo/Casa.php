<?php header("Content-Type: text/html; charset=utf-8");?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php

class Casa {
    public $id;
    public $name;
    public $code;
    public $link;
    public $area;
    public $attachment;
    public $main_photo_name;
    public $update_time;
    /** Tag: id, type, name */
    public $tags;
    /** Content: id, name, text, display_order(useless since 20151121), photos[string, string] */
    public $contents;/**
     * Constructor.
     * Argument count:
     * 0:default;
     * 1:A row of mysql_fetch_row();
     * @throws Exception method missing
     */
    public function __construct() {
        $args = func_get_args();
        $count = count($args);
        if (method_exists($this, $method='__construct'.$count)) {
            call_user_func_array(array($this, $method), $args);
        } else {
            throw new Exception('No such method:'.__CLASS__.'-'.$method);
        }
    }
    public function __construct0() {
    }
    public function __construct1($row) {
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->code = $row['code'];
        $this->link = $row['link'];
        $this->area = new stdClass();
        $this->attachment = new stdClass();
        $this->attachment->id = $row['attachment_id'];
        $this->area->id = $row['dictionary_id'];
        $this->update_time = $row['update_time'];
    }
}
?>