<?php header("Content-Type: text/html; charset=utf-8");?>
<?php
class Area {
    public $id;
    public $parentid;
    public $name;
    public $islast;
    public $level;
    public $sub_areas;

    /**
     * Constructor.
     * Argument count:
     * 0: default;
     * 1: Accept A row of mysql_fetch_row();
     * @throws Exception method not found
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
    public function __construct0() {}
    public function __construct1($row) {
        $this->id = $row ['id'];
        $this->name = $row ['value'];
        $this->islast = $row ['islast'];
        $this->level = $row ['level'];
        $this->parentid = $row ['parentid'];
        $this->sub_areas = array ();
    }
}
?>
