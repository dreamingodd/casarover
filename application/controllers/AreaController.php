<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AreaDao.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';
?>
<?php

define('PIC_DIR', '../../photo/');

// 路由实现
$controller = $_GET['c'];
if ($controller) {
	$area = new AreaController;
	$area->$controller();
}

/**
* 区域相关
* draguo
*/
class AreaController{

	// 获取区域数据
	public function index(){
		$area_id = $_GET["area_id"];

		if (empty($area_id)) {
			$this->create();
			exit();
		}
		$areaDao = new AreaDao();
		$result = $areaDao->getAreaMess($area_id);
		return $result;
	}
	/**
	* 添加区域数据
	* 这个是应该是通过area_id是否存在来进行判断是插入还是更新
	*/
	public function create(){
		// 获取数据 create应该没有id才对
		$area_id = $_POST['area_id'];
		if (!empty($area_id)) {
			$this->update();
			exit();
		}

		$name = $_POST['name'];
		$parentid = $_POST['parentid'];
		$titlepic = $_POST['headpic'];
		$some_pics = $_POST['somepic'];
		$content_first = $_POST['text1'];
		$content_second = $_POST['text2'];
		$content_third = $_POST['text3'];
		$raiders_content = $_POST['radiers'];
		$position = $_POST['position'];
		$tier = $_POST['tier'];

		// test
		$parentid = 7;
		$content_arr = array($content_first , $content_second , $content_third );
		$areaDao = new AreaDao();
		$result = $areaDao->create($name,$parentid,$titlepic,$some_pics,$content_arr,$raiders_content,$position,$tier);
		return $result;
	}

	public function update(){
		// 获取数据
		$area_id = $_POST['area_id'];
		$name = $_POST['name'];
		$titlepic = $_POST['headpic'];
		$some_pics = $_POST['somepic'];
		$content_first = $_POST['text1'];
		$content_second = $_POST['text2'];
		$content_third = $_POST['text3'];
		$raiders_content = $_POST['radiers'];
		$position = $_POST['position'];
		$tier = $_POST['tier'];

		$content_arr = array($content_first , $content_second , $content_third );
		$areaDao = new AreaDao();
		$result = $areaDao->update($area_id,$name,$titlepic,$some_pics,$content_arr,$raiders_content,$position,$tier);
		return $result;

	}

	public function del(){
		
	}
	// 获取所有的区域缩略信息
	public function simpleMess(){
		$areaDao = new AreaDao();
		$area_id = $_GET['area_id'];
		$result = $areaDao -> getSimpleMess($area_id);
		return $result;
	}
}

?>