<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/PropertyManager.php';

/***
 * 首页动态加载数据
 *
 ***/

$c = $_GET['c'];

$route = new Home();

$route->recom('1');

class Home{

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
//    民宿推荐

//传入城市的名称
    public function recom($city)
    {
        // $sql = "SELECT *  `activity_` (`openid`, `phone`) VALUES (?, ?);";
        // $pre = $this->db->prepare($sql);
        // $pre->bindParam(1,$city);
        // $result = $pre->execute();
        // return $result;
        //通过$city 对城市是数据进行查询
        $title = '花千谷';
        $shortMess = '这个是对民宿的一句话介绍';
        $shortMess2 = '这个是第二种的';
        $pic = 'assets/images/fang.jpg';
        //数据格式
        $kuan = compact('title','shortMess2','pic');
        $room = compact('title','shortMess','pic');
        $data = array($kuan,$room,$room,$room,$room,$room);

        echo json_encode($data);
    }
}