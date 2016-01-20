<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/UserDao.php';

$controller = $_GET['c'];
$k = new UserController();
$k->$controller();

/**
* draguo
* 2016.1.5
* 用户信息控制
*/
class UserController{

	public function index(){
		echo "this is index";
	}
	//更新用户信息
	public function update(){
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$sex = $_POST['sex'];
		$birthday = $_POST['birthday'];
		$phone = '18958142694';
		$UserDao = new UserDao();
		$update = $UserDao->updateUser($name,$phone,$sex,$birthday);

	}
	// 检查手机号时候已被注册
	public function checkphone(){
		$phone = $_POST['phone'];
		$UserDao = new UserDao();
		$user = $UserDao->getByPhone($phone);
		if ($user) {
			echo "{\"msg\":\"no\"}";
		}else{
			echo "{\"msg\":\"ok\"}";
		}
	}
}




?>