<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/PropertyManager.php';


$openid = $_POST['id'];
$phone = $_POST['phone'];

if($openid && $phone){
    $message = new Message();
    $data = array('openid' => $openid , 'phone' => $phone);
    $message->save($data);
    echo "ok";
}else{
    echo "error";
}

//$openid = '123';
//$phone = '13212312';



//$message->get($openid);
//$result = $message->getAll();
//var_dump($result);
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
}