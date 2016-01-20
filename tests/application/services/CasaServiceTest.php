<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/CasaService.php';?>
<?php 

getCasaWithAttachmentTest();

function getCasaWithAttachmentTest() {
    $id = 1;
    $service = new CasaService();
    $casa = $service->getCasaWithAttachment($id);
    echo $casa->attachment->filepath;
    echo '<br/>';
    var_dump($casa);
}
?>