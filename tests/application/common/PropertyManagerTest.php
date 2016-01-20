<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/PropertyManager.php';?>
<?php
$pm = new PropertyManager();
echo $pm->getSystem().'<br/>';
echo $pm->getHost().'<br/>';
echo $pm->getPhotoFolder().'<br/>';
?>