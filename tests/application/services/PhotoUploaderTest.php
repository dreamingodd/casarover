<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/PhotoUploader.php';?>
<?php 
$uploader = new PhotoUploader();
$uploader->delOnServer("casa_201511101144397502.jpg");
?>