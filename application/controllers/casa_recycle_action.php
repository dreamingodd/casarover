<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/CasaDao.php';?>
<?php 
$id = $_GET['id'];
$deleted = $_GET['deleted'];
$option = $_GET['option'];
$casaDao = new CasaDao();
$success = true;
if ($option == "recycle") {
    $success = $casaDao->recycle($id);
} else if ($option == "recover") {
    $success = $casaDao->recover($id);
}

if ($success) {
    header("Location:../../website/backstage/casa_list.php?deleted=$deleted");
} else {
    header('Location:../../website/backstage/error.php?info=操作失败！');
}
?>