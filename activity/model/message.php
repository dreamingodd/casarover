<?php

$dsn = "mysql:host=localhost;dbname=casarover";
$db = new PDO($dsn, 'root', '24');
$count = $db->query("SELECT * FROM USER ");
$result = $count->fetchAll();
var_dump($result);
class Message
{
//    保存信息
    public function save()
    {

    }
//查询单人信息
    public function get()
    {

    }
//查询所有用户
    public function getAll()
    {

    }
}