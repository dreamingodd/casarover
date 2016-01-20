<?php header("Content-Type: text/html; charset=utf-8");?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/db_connection.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/BaseDao.php';?>
<?php 
class UserDao extends BaseDao {
    const TYPE_PHONE = "Phone";
    const TYPE_QQ = "QQ";
    const TYPE_WECHAT = "Wechat";
    const TYPE_ADMIN = "Admin";
    /**
     * Add a user who registers via phone.
     * @param String $phone
     * @param String $password
     * @return success/fail
     */
    public function addPhoneUser($phone, $password) {
        $phone = $this->check_input($phone);
        $password = $this->check_input($password);
        $sql = "insert into user (name, phone, pwd, type, update_time) "
                ."values($phone, $phone, md5($password), ".self::TYPE_PHONE.", now())";
        echo $sql;
        $result = mysql_query($sql);
        if (!$result) return $result;
        return mysql_insert_id();
    }
    // public function updateUser($name,$phone,$sex,$birthday){
    //     $sql = "update user (name,phone,sex,birthday,update_time)"
    //             ."values()"
    // }
    /**
     * Add a user who logs in via QQ.
     * @param String $openid
     * @param String $nickname
     * @param int $gender
     * @return success/fail
     */
    public function addQQUser($openid, $nickname, $gender) {
        $openid = $this->check_input($openid);
        $nickname = $this->check_input($nickname);
        $gender = $this->check_input($gender);
        $sql = "insert into user (name, qq_openid, type, gender, update_time) "
                ."values ($nickname, $openid, '".self::TYPE_QQ."', $gender, now())";
        $result = mysql_query($sql);
        if (!$result) return $result;
        return mysql_insert_id();
    }
    /**
     * Add a user who logs in via Wechat.
     * @param String $openid
     * @param String $nickname
     * @param int $gender
     * @return success/fail
     */
    public function addWechatUser($openid, $nickname, $gender) {
        $openid = $this->check_input($openid);
        $password = $this->check_input($password);
        $gender = $this->check_input($gender);
        $sql = "insert into user (name, wechat_openid, type, gender, update_time) "
                ."values ($nickname, $openid, ".self::TYPE_WECHAT.", now()";
        $result = mysql_query($sql);
        if (!$result) return $result;
        return mysql_insert_id();
    }
    /**
     * 加入图片
     * @param int $id
     * @param int $attachmentId
     * @return success(true)/fail(false)
     */
    public function addPhoto($id, $attachmentId) {
        $id = $this->check_input($id);
        $attachmentId = $this->check_input($attachmentId);
        $sql = "update user set attachment_id=$attachmentId where id=$id";
        return mysql_query ( $sql );
    }


    public function getById($id) {
        $id = $this->check_input($id);
        $sql = "select * from user where id=$id";
        return mysql_fetch_array(mysql_query($sql));
    }
    public function getByQQOpenid($openid) {
        $openid = $this->check_input($openid);
        $sql = "select * from user where qq_openid=$openid";
        return mysql_fetch_array(mysql_query($sql));
    }
    public function getByWechatOpenid($openid) {
        $openid = $this->check_input($openid);
        $sql = "select * from user where wechat_openid=$openid";
        return mysql_fetch_array(mysql_query($sql));
    }
    public function getByPhone($phone) {
        $phone = $this->check_input($phone);
        $sql = "select * from user where phone=$phone";
        return mysql_fetch_array(mysql_query($sql));
    }
    public function getUserId($username,$password) {
        $username = $this->check_input($username);
        $password = $this->check_input($password);
        $sql = "select user_id from user "
                ."where user_name=$username and user_pwd=md5($password)";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        return $row['user_id'];
    }
}
?>
