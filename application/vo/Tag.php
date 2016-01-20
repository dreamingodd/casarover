<?php

class Tag {
    public $id;
    public $name;
    public $type;
    public $update_time;
    /**
     * Constructor.
     * Argument count:
     * 0:default;
     * 1:A row of mysql_fetch_row();
     * 4:All member varibles: $id, $name, $type, $update_time
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
        $this->type = $row['type'];
        $this->update_time = $row['update_time'];
    }
    public function __construct4($id, $name, $type, $update_time) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->update_time = $update_time;
    }
}

?>