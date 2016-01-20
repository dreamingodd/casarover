<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/db_connection.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/BaseDao.php';?>
<?php
/**
 * LotteryDao is used for the new year activity.
 * Accesses the data of users' lottery count.
 * @author Ye_WD
 * @2015-12-28
 */
class LotteryDao extends BaseDao {
    public function add($openid) {
        $openid = $this->check_input($openid);
        $sql = "insert into lottery (wechat_openid, count_today, count_total, update_time) "
                ."values ($openid, 1, 1, now()) ";
        $result = mysql_query($sql);
        if (!$result) return $result;
        return mysql_insert_id();
    }
    public function update($id, $count_today, $count_total) {
        $openid = $this->check_input($openid);
        $count_today = $this->check_input($count_today);
        $count_total = $this->check_input($count_total);
        $sql = "update lottery set count_today=$count_today, "
                ."count_total=$count_total, "
                ."update_time=now() "
                ."where id=$id ";
        return mysql_query($sql);
    }
    public function getByOpenid($openid) {
        $openid = $this->check_input($openid);
        $sql = "select * from lottery where wechat_openid=$openid";
        return mysql_fetch_array(mysql_query($sql));
    }
    public function getAll() {
        $sql = "select * from lottery";
        return mysql_query($sql);
    }
}
?>