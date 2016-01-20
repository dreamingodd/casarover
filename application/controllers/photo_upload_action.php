<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/PhotoUploaderAliyun.php';?>
<?php 
$action = $_GET['action'];
$uploader = new PhotoUploaderAliyun();
$max_size = $_GET['max_size'];
if ($action == "delete") {
    if ($uploader->delete($_GET['filename'])) {
        echo "{\"msg\":\"success\"}";
    }
} else {
    if (empty($max_size)) {
        echo $uploader->upload($_FILES);
    } else {
        echo $uploader->upload($_FILES, $max_size);
    }
}
?>