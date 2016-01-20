<?php
/**
* area 图片上传
* 应该放在controller中
* draguo
* 2016.1.8
*/
$path = "../../../photo/";

$extArr = array("jpg", "png", "gif","jpeg");

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	$name = $_FILES['photoimg']['name'];
	$size = $_FILES['photoimg']['size'];
	
	if(empty($name)){
		echo '请选择要上传的图片';
		exit;
	}
	$ext = extend($name);
	if(!in_array($ext,$extArr)){
		echo '图片格式错误！';
		exit;
	}
	if($size>(1024000)){
		echo '图片大小不能超过1MB';
		exit;
	}
	$image_name = date ( "YmdHis" ).time().rand(1000, 9999).".".$ext;
	$tmp = $_FILES['photoimg']['tmp_name'];
	if(move_uploaded_file($tmp, $path.$image_name)){
		echo '<img src="'.$path.$image_name.'"  name="'.$image_name.'" class="preview">';
	}else{
		echo '上传出错了！';
	}
	exit;
}
exit;


function extend($file_name){
	$extend = pathinfo($file_name);
	$extend = strtolower($extend["extension"]);
	return $extend;
}
?>