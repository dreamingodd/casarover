<?php header("Content-Type: text/html; charset=utf-8");?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/db_connection.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/BaseDao.php';?>
<?php

class CasaDao extends BaseDao {
    /** 每页包含条数 */
    const pageNum = 9;
    public function addOrUpdateSimple($name, $code, $link, $area_id, $casa_id) {
        $name = $this->check_input($name);
        $code = $this->check_input($code);
        $area_id = $this->check_input($area_id);
        $link = $this->check_input($link);
        $result = false;
        if (!empty($casa_id)) {
            $casa_id = $this->check_input($casa_id);
        }
        // add
        if (empty($casa_id)) {
            $sql = 'insert into casa (name, code, link, dictionary_id, update_time) '
                    ."values($name, $code, $link, $area_id, now())";
            $result = mysql_query ($sql);
            $casa_id = mysql_insert_id();
        }
        // Update
        else {
            $sql = "update casa set name=$name, "
                    ."code=$code, "
                    ."link=$link, "
                    ."dictionary_id=$area_id, "
                    ."update_time=now() "
                    ."where id=$casa_id";
            $result = mysql_query ($sql);
        }
        // SQL执行失败
        if (!$result) return $result;
        return $casa_id;
    }
    public function addPhoto($id, $attachmentId) {
        $id = $this->check_input($id);
        $attachmentId = $this->check_input($attachmentId);
        $sql = "update casa set attachment_id=$attachmentId where id=$id";
        return mysql_query ($sql);
    }
    public function delPhoto($id) {
        $id = $this->check_input($id);
        $sql = "update casa set attachment_id=null where id=".$id;
        return mysql_query($sql);
    }
    public function recycle($id) {
        $id = $this->check_input($id);
        $sql = "update casa set deleted=1 where id=$id";
        return mysql_query($sql);
    }
    public function recover($id) {
        $id = $this->check_input($id);
        $sql = "update casa set deleted=0 where id=$id";
        return mysql_query($sql);
    }
    public function getAll($deleted=0) {
        if (!isset($deleted)) $deleted = 0;
        $id = $this->check_input($deleted);
        $sql = "select * from casa where deleted=$deleted";
        return mysql_query ( $sql );
    }
    public function getById($id) {
        $id = $this->check_input($id);
        $sql = "select * from casa where id=$id";
        return mysql_fetch_array ( mysql_query ( $sql ) );
    }
    public function getByParentAreaId($city_id,$page) {
        $page_num = self::pageNum;
        $start_num = $page*$page_num;
        $city_id = $this->check_input($city_id);
        $sql = "select c.* from casa c "
                ."inner join area_dictionary a on c.dictionary_id = a.id "
                ."where a.parentid=$city_id "
                ."and deleted=0 "
                ."order by id limit $start_num,$page_num";
        return mysql_query($sql);

    }
    public function getByMultiConfition($city_id, $tag_ids_str, $scenery_tag_ids_str, $area_ids_str, $page) {
        $page_num = self::pageNum;
        $start_num = $page*$page_num;
        $city_id = mysql_escape_string($city_id);
        $tag_ids_str = mysql_escape_string($tag_ids_str);
        $scenery_tag_ids_str = mysql_escape_string($scenery_tag_ids_str);
        $area_ids_str = mysql_escape_string($area_ids_str);
        $city_condition_sql = empty($city_id) ? "" : "and area.parentid = $city_id ";
        $tag_condition_sql = empty($tag_ids_str) ? "" : "and tag.id in ($tag_ids_str) ";
        $scenery_table_sql = empty($scenery_tag_ids_str) ? "" :
                ",("
                ."select casa.id casa_id "
                ."  from casa, tag, casa_tag "
                ." where tag.id = casa_tag.tag_id "
                ."   and casa.id = casa_tag.casa_id "
                ."   and tag.id in ($scenery_tag_ids_str) "
                .") casa1 ";
        $scenery_condition_sql = empty($scenery_tag_ids_str) ? "" :
                "and casa.id = casa1.casa_id ";
        $area_condition_sql = empty($area_ids_str) ? "" :
                "and casa.dictionary_id in ($area_ids_str) ";

        $sql = "select casa.* "
                ."  from casa, tag, casa_tag, area_dictionary area "
                .$scenery_table_sql
                ."where tag.id = casa_tag.tag_id "
                ."  and casa.id = casa_tag.casa_id "
                ."  and casa.dictionary_id = area.id "
                ."  and deleted=0 "
                .$city_condition_sql
                .$tag_condition_sql
                .$scenery_condition_sql
                .$area_condition_sql
                // TODO seems there're redundant casas
                ."group by casa.id order by id limit $start_num,$page_num";
        return mysql_query($sql);
    }
}
?>
