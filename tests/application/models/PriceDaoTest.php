<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/PriceDao.php';?>
<?php 
$dao = new PriceDao();
$a = $dao->get();
var_dump($a);
echo '<br/>';
$a[0]--;
$a[1]--;
$a[2]--;
$dao->put($a);
var_dump($a);
?>
