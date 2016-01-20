<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/db_connection.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/BaseDao.php';?>
<?php 
/**
 * LotteryDao is used for the new year activity.
 * Access the data of price winners' information.
 * @author Ye_WD
 * @2015-12-28
 */
class RewardDao extends BaseDao {
    public function add($wechat_openid, $cellphone, $reward_level) {
        $wechat_openid = $this->check_input($wechat_openid);
        $cellphone = $this->check_input($cellphone);
        $reward_level = $this->check_input($reward_level);
        $sql = "insert into reward (wechat_openid, cellphone, reward_level, update_time) values "
                ."($wechat_openid, $cellphone, $reward_level, now()) ";
        $result = mysql_query($sql);
        if (!$result) return $result;
        return mysql_insert_id();
    }
    public function updateCellphone($wechat_openid, $cellphone) {
        $wechat_openid = $this->check_input($wechat_openid);
        $cellphone = $this->check_input($cellphone);
        $sql = "update reward set cellphone=$cellphone where wechat_openid=$wechat_openid ";
        return mysql_query($sql);
    }
    public function updateReceived($id, $received) {
        $id = $this->check_input($id);
        $sql = "update reward set received=$received where id=$id ";
        return mysql_query($sql);
    }
    public function del($id) {
        $sql = "delete from reward where id=$id";
        return mysql_query($sql);
    }
    public function getByOpenid($wechat_openid) {
        $wechat_openid = $this->check_input($wechat_openid);
        $sql = "select * from reward where wechat_openid=$wechat_openid ";
        return mysql_fetch_array(mysql_query($sql));
    }
    public function getAll($received=null) {
        $sql = "select * from reward ";
        if (isset($received)) {
            $sql .= " where received=".$received;
        }
        return mysql_query($sql);
    }
}
?>