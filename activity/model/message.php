<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/PropertyManager.php';




//$openid = '123';
//$phone = '13212312';



class Message
{
    private $db;
    protected $host = 'localhost';
    protected $dbname = 'casarover';
    private $db_pwd;
    public function __construct()
    {
        $dsn = "mysql:host=".$this->host.";dbname=".$this->dbname;
        $pro = new PropertyManager();
        $this->host = $pro->getProperty('db_host');
        $this->db_pwd = $pro->getProperty('db_pwd');
        $this->db = new PDO($dsn, 'root', $this->db_pwd);
    }
    //保存信息
    public function save($data)
    {
        //存在订单号是支付完成
        if($data["orderid"]){
          //更新
        }else{
            $openid = $data["openid"];
            $phone = $data["phone"];
            $sql = "INSERT INTO `activity_youyuan` (`openid`, `phone`) VALUES (?, ?);";
            $pre = $this->db->prepare($sql);
            $pre->bindParam(1,$openid);
            $pre->bindParam(2,$phone);
            $result = $pre->execute();
            return $result;
        }
    }
//查询单人信息
    public function get($openid)
    {
        $sql = "SELECT * FROM `activity_youyuan` WHERE openid=? ;" ;
        $pre = $this->db->prepare($sql);
        $pre->bindParam(1,$openid);
        $pre->execute();
        $result = $pre->fetchAll();
        return $result;
    }
//查询所有用户
    public function getAll()
    {
        $sql = "SELECT * FROM `activity_youyuan` ";
        $pre = $this->db->prepare($sql);
        $pre->execute();
        $result = $pre->fetchAll();
        return $result;
    }
    public function getByStatus($status) {
        $sql = "SELECT * FROM `activity_youyuan` where status=? ;";
        $pre = $this->db->prepare($sql);
        $pre->bindParam(1, $status);
        $pre->execute();
        $result = $pre->fetchAll();
        rsort($result);
        return $result;
    }
    /**
     * update activity_youyuan's status depends on whether user pays the money.
     * @param int $id
     * @param int $status
     */
    public function updateStatus($id, $status) {
        $payarr = $this->getByStatus(1);
        $person_number = count($payarr)+1;
        $sql = "update activity_youyuan set status = ? , groupid = ? where id = ?;";
        $pre = $this->db->prepare($sql);
        $pre->bindParam(1, $status);
        $pre->bindParam(2,$person_number);
        $pre->bindParam(3, $id);
        return $pre->execute();
    }

}