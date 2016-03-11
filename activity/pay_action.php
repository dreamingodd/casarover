<?php require_once 'model/message.php';?>
<?php 
$dao = new Message();
$status = $_GET['status'];
$id = $_GET['id'];
$dao->updateStatus($id, $status);
header('Location:participate_list.php?status='.$status)
?>