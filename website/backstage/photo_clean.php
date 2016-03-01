<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="css/all.css" rel="stylesheet"/>
<script src="../js/integration/jquery.min.js"></script>
<script src="../js/integration/bootstrap.min.js"></script>
<script src="../js/integration/jquery.form.js"></script>
<script src="js/all.js"></script>
<script type="text/javascript">
function goBack() {
    history.go(-1);
}
</script>
<title>探庐者后台-系统功能</title>
</head>
<?php include '../301.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/check_admin_login_action.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AttachmentDao.php';?>
<body>
<div id="container">
    <!-- nav bar start -->
    <?php include 'navigator.php';?>
    <input type="hidden" id="page" value="system"/>
    <!-- nav bar end -->

    <div style="margin-left: 100px; margin-right: 100px;">
        <?php 
        $dao = new AttachmentDao();
        $photoFolder = $_SERVER['DOCUMENT_ROOT']."/photo";
        $delFolder = $_SERVER['DOCUMENT_ROOT']."/photo/deleted";
        if (!file_exists($delFolder)) {
            mkdir($delFolder);
        }
        $files = scandir($photoFolder);
        $delFiles = array();
        foreach ($files as $file) {
            if ($file != '.' && $file != '..' && $file != 'deleted') {
                $result = $dao->getByFile($file);
                if (mysql_num_rows($result) == 0) {
                    echo $file;
                    echo '<br/>';
                    $originFile = $photoFolder.'/'.$file;
                    $newFile = $delFolder.'/'.$file;
                    copy($originFile, $newFile);
                    unlink($originFile);
                    array_push($delFiles, $file);
                }
            }
        }
        echo '<hr/>';
        echo 'Origin:'.(count($files) - 2);
        echo '<br/>';
        echo 'Moved :'.count($delFiles);
        echo '<br/>';
        echo 'Left  :'.(count($files) - 2 - count($delFiles));
        echo '<br/>';
        echo 'Mopping up completed！';
        echo '<br/>';
        ?>
        <button class="btn" onclick="goBack()">返回</button>
    </div>
</div>
</body>
</html>