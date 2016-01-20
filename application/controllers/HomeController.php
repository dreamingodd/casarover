<?php
/**
* 首页数据
* draguo
* 2016.1.13
*/
include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/HomeDao.php';


// 路由实现
$controller = $_GET['c'];
if ($controller) {
	$area = new HomeController;
	$area->$controller();
}


/**
* 首页数据控制
*/
class HomeController
{
	
	public function index(){
		// 推荐数据
	}
	// 保存创建数据
	public function create(){
		$recomms = $_GET['recomms'];
		$homeDao = new HomeDao();
		$homeDao->create($recomms);

	}
}


?>