<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/db_connection.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/BaseDao.php';?>
<?php
class WechatSeriesDao extends BaseDao {
    public function addOrUpdate($type, $name, $id=0) {
        $type = $this->check_input($type);
        $name = $this->check_input($name);
        if (empty($id)) {
            $sql = "insert into wechat_series values(null, $type, $name)";
            if (mysql_query($sql)) {
                return mysql_insert_id();
            } else {
                return 0;
            }
        } else {
            $sql = "update wechat_series set type=$type, name=$name where id=$id";
            if (mysql_query($sql)) {
                return $id;
            } else {
                return 0;
            }
        }
    }
    public function del($id) {
        $id = $this->check_input($id);
        $sql = "delete from wechat_series where id=$id";
        return mysql_query($sql);
    }
    public function getById($id) {
        $id = $this->check_input($id);
        $sql = "select * from wechat_series where id=$id";
        return mysql_fetch_array(mysql_query($sql));
    }
    public function getAll() {
        $sql = "select * from wechat_series";
        return mysql_query($sql);
    }
}
?>