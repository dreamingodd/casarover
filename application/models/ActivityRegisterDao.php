<?php header("Content-Type: text/html; charset=utf-8");?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/db_connection.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/BaseDao.php';?>
<?php
class ActivityRegisterDao extends BaseDao {
    public function add($username,$activityname) {
        $username = $this->check_input($username);
        $activityname = $this->check_input($activityname);
        $sql = "insert into activity_register values(null,$username,$activityname)";
        $result = mysql_query($sql);
        if (!$result) return $result;
        return mysql_insert_id();
    }
    public function getAll(){
        $sql = 'select * from activity_register';
        return mysql_query($sql);
    }
    public function getId($username,$activityname) {
        $username = $this->check_input($username);
        $activityname = $this->check_input($activityname);
        $sql = "select * from activity_register where username=$username and activity_name=$activityname";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        return $row['activity_register_id'];
    }
}
?>