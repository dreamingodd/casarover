<?php header("Content-Type: text/html; charset=utf-8");?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/db_connection.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/BaseDao.php';?>
<?php

class AttachmentDao extends BaseDao {
    public function addSimple($filepath) {
        $filepath = $this->check_input($filepath);
        $sql = "insert into attachment (filepath, type, update_time) values ($filepath, 'photo', now())";
        $result = mysql_query ( $sql );
        if (!$result) return $result;
        return mysql_insert_id ();
    }
    public function del($id) {
        $sql = 'delete from attachment where id='.$id;
        return mysql_query($sql);
    }
    public function getById($id) {
        $sql = "select * from attachment where id=" . $id;
        return mysql_fetch_array ( mysql_query ( $sql ) );
    }
    public function getByFile($file) {
        $file = $this->check_input($file);
        $sql = "select * from attachment where filepath=$file";
        return mysql_query($sql);
    }
}
?>