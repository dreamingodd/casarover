<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/db_connection.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/BaseDao.php';?>
<?php
/**
 * Content data access object.
 * @author Dangdang_Laptop
 * @20151201
 */
class ContentDao extends BaseDao {
    public function delByCasaId($casa_id) {
        $casa_id = $this->check_input($casa_id);
        $sql = "delete from content where casa_id=".$casa_id;
        return mysql_query($sql);
    }
    public function add($casa_id, $name, $text, $display_order) {
        $casa_id = $this->check_input($casa_id);
        $name = $this->check_input($name);
        $text = $this->check_input($text);
        $display_order = $this->check_input($display_order);
        $sql = "insert into content (casa_id,name,text,display_order,update_time) "
                  ."values ($casa_id, $name, $text, $display_order, now())";
        $result = mysql_query($sql);
        if (!$result) return $result;
        return mysql_insert_id();
    }
    public function getByCasaId($casa_id) {
        $casa_id = $this->check_input($casa_id);
        $sql = 'select * from content where casa_id='.$casa_id
                    .' order by display_order, id';
        return mysql_query($sql);
    }
}

?>