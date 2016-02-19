<?php 
class WechatArticle {
    public $id;
    public $attachment_id;
    public $title;
    public $brief;
    public $address;
    /**1：民宿推荐，2：民宿杂谈*/
    public $type;
    public $series;
    public $deleted;
    /**
     * 只能处理参数数量不同的重载。
     * */
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
        $this->attachment_id = $row['attachment_id'];
        $this->title = $row['title'];
        $this->brief = $row['brief'];
        $this->address = $row['address'];
        $this->type = $row['type'];
        $this->series = $row['series'];
        $this->deleted = $row['deleted'];
    }
    public function __construct8($id, $attachment_id, $title, $brief, $address, $type, $series, $deleted) {
        $this->id = $id;
        $this->attachment_id = $attachment_id;
        $this->title = $title;
        $this->brief = $brief;
        $this->address = $address;
        $this->type = $type;
        $this->series = $series;
        $this->deleted = $deleted;
    }
}
?>