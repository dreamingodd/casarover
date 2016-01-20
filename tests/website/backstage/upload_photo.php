<?php
// create folder.
if(!is_dir($_SERVER['DOCUMENT_ROOT'].'/photo')) {
    mkdir($_SERVER['DOCUMENT_ROOT'].'/photo');
}
$filename = $_FILES ['photo'] ['name'];
$size = $_FILES ['photo'] ['size'];
if ($filename != "") {
    if ($size > 1024000) {
        echo '图片大小不能超过1M';
        exit ();
    }
    $fileType = strstr ( $filename, '.' );
    // strchr: search from left, strrchr: search from right
    $fileType = substr ( strrchr ( $filename, '.' ), 1 );
    $fileTypes = array (
            "jpg",
            "gif",
            "bmp",
            "jpeg",
            "png" 
    );
    if (! in_array ( $fileType, $fileTypes )) {
        $fileTypeStr = implode ( $fileTypes, ',' );
        echo '图片格式不对！接受：' . $fileTypeStr . '。';
        exit ();
    }
    $rand = rand ( 1000, 9999 );
    // filename on server
    $serverFilename = 'casa_' . date ( "YmdHis" ) . $rand . '.' . $fileType;
    // filepath on server
    $pic_path = "../../../photo/" . $serverFilename;
    move_uploaded_file ($_FILES ['photo'] ['tmp_name'], $pic_path);
}
$size = round ( $size / 1024, 2 );
$arr = array (
        'filename' => $serverFilename,
        'size' => $size 
);
echo json_encode ( $arr );
?>