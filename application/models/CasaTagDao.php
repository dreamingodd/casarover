<?php header("Content-Type: text/html; charset=utf-8");?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/db_connection.php';?>
<?php
class CasaTagDao {
    function add($casa_id, $tag_id) {
        $sql = "insert into casa_tag (casa_id, tag_id) "
                ."values(".$casa_id.",".$tag_id.")";
        return mysql_query($sql);
    }
    function delByCasaId($casa_id) {
        $sql = "delete from casa_tag where casa_id=".$casa_id;
        return mysql_query($sql);
    }
    function getByCasaId($casa_id) {
        $sql = 'select * from casa_tag where casa_id='.$casa_id;
        return mysql_query($sql);
    }
}
?>
