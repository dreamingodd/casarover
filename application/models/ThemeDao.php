<?php header("Content-Type: text/html; charset=utf-8");?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/db_connection.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/BaseDao.php';?>
<?php

class ThemeDao extends BaseDao {
    public function addOrUpdate($name, $description, $attachment_id, $update_by, $id=0) {
        $name = $this->check_input($name);
        $description = $this->check_input($description);
        $attachment_id = $this->check_input($attachment_id);
        $update_by = $this->check_input($update_by);
        $result = false;
        if (empty($id)) {
            $sql = 'insert into theme (name, description, attachment_id, update_by, update_time) '
                    ."values($name, $description, $attachment_id, $update_by, now())";
            $result = mysql_query ($sql);
            $id = mysql_insert_id();
        } else {
            // Update
            $this->check_input($id);
            $sql = "update theme set name=$name, "
                    ."description=$description, "
                    ."attachment_id=$attachment_id, "
                    ."update_by=$update_by, "
                    ."update_time=now() "
                    ."where id=$id";
            $result = mysql_query ($sql);
        }
        // SQL执行失败
        if (!$result) return $result;
        return $id;
    }
    public function recycle($id) {
        $id = $this->check_input($id);
        $sql = "update theme set deleted=1 where id=$id";
        return mysql_query($sql);
    }
    public function recover($id) {
        $id = $this->check_input($id);
        $sql = "update theme set deleted=0 where id=$id";
        return mysql_query($sql);
    }
    public function getAll($deleted=0) {
        $deleted = $this->check_input($deleted);
        $sql = "select * from theme where deleted=$deleted";
        return mysql_query ( $sql );
    }
    public function getById($id) {
        $id = $this->check_input($id);
        $sql = "select * from theme where id=$id";
        return mysql_fetch_array ( mysql_query ( $sql ) );
    }
    /** Below are theme_item related methods *****************************/
    public function addItem($theme_id, $name, $text, $casa_id, $link="") {
        $theme_id = $this->check_input($theme_id);
        $name = $this->check_input($name);
        $text = $this->check_input($text);
        $casa_id = $this->check_input($casa_id);
        $link = $this->check_input($link);
        $sql = "insert into theme_item (theme_id, name, text, casa_id, link) "
                ."values ($theme_id, $name, $text, $casa_id, $link)";
        if (mysql_query($sql)) {
            return mysql_insert_id();
        } else {
            return false;
        }
    }
    public function getItemByThemeId($theme_id) {
        $theme_id = $this->check_input($theme_id);
        $sql = "select * from theme_item where theme_id=$theme_id";
        return mysql_query($sql);
    }
    public function getItemById($item_id) {
        $id = $this->check_input($item_id);
        $sql = "select * from theme_item where id=$item_id";
        return mysql_fetch_array(mysql_query($sql));
    }
    public function delItemByThemeId($theme_id) {
        $theme_id = $this->check_input($theme_id);
        $sql = "delete from theme_item where theme_id=$theme_id";
        return mysql_query($sql);
    }
    public function delItemById($item_id) {
        $item_id = $this->check_input($item_id);
        $sql = "delete from theme_item where id=$item_id";
        return mysql_query($sql);
    }
    public function addItemAttachment($theme_item_id, $attachment_id) {
        $theme_item_id = $this->check_input($theme_item_id);
        $attachment_id = $this->check_input($attachment_id);
        $sql = "insert into theme_item_attachment (theme_item_id, attachment_id) "
                ."values ($theme_item_id, $attachment_id)";
        if (mysql_query($sql)) {
            return mysql_insert_id();
        } else {
            return false;
        }
    }
    public function getItemAttachmentByItemId($item_id) {
        $item_id = $this->check_input($item_id);
        $sql = "select * from theme_item_attachment where theme_item_id=$item_id";
        return mysql_query($sql);
    }
    public function delItemAttachmentByItemId($item_id) {
        $item_id = $this->check_input($item_id);
        $sql = "delete from theme_item_attachment where theme_item_id=$item_id";
        return mysql_query($sql);
    }
    /** Below are theme_area related methods *****************************/
    public function addThemeArea($theme_id, $area_id) {
        $theme_id = $this->check_input($theme_id);
        $area_id = $this->check_input($area_id);
        $sql = "insert into theme_area (theme_id, area_id) values ($theme_id, $area_id)";
        if (mysql_query($sql)) {
            return mysql_insert_id();
        } else {
            return false;
        }
    }
    public function getThemeAreaByThemeId($theme_id) {
        $theme_id = $this->check_input($theme_id);
        $sql = "select * from theme_area where theme_id=$theme_id";
        return mysql_query($sql);
    }
    public function delThemeAreaById($theme_id) {
        $theme_id = $this->check_input($theme_id);
        $sql = "delete from theme_area where theme_id=$theme_id";
        return mysql_query($sql);
    }
}
?>
