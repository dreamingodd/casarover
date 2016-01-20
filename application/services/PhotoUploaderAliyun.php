<?php include_once 'PhotoUploader.php';?>
<?php 
/**
 * Refactor the .../backstage/upload_photo.php.
 * Has the abilities to upload a photo and delete one on linux server.
 * @author Ye_WD
 * @2015-12-25
 */
class PhotoUploaderAliyun extends PhotoUploader {
    public function __construct() {
        // create folder.
        if(!is_dir($_SERVER['DOCUMENT_ROOT'].'/photo')) {
            mkdir($_SERVER['DOCUMENT_ROOT'].'/photo');
        }
    }
    /**
     * Check the photo file's size and type, then generate a filename(date and random) and save it on the linux server.
     * This method is not perfect:
     * At least, it doesn't have the ability to show the progress;
     * it's not a general method to upload files, etc.
     * All in all, 这是一个需要完善的方法。
     * @param $_FILES $files
     * @return json string of array of photo info.
     */
    public function upload($files, $max_size=1024) {
        $filename = $files ['photo'] ['name'];
        $size = $files ['photo'] ['size'];
        $photoFile = $files ['photo'] ['tmp_name'];
        if ($filename != "") {
            if ($size > $max_size * 1000) {
                echo '图片大小不能超过'.$max_size.'K';
                exit ();
            }
            $fileType = strstr ( $filename, '.' );
            // strchr: search from left, strrchr: search from right
            $fileType = substr ( strrchr ( $filename, '.' ), 1 );
            $fileTypes       = array ("jpg", "gif", "bmp", "jpeg", "png");
            $fileTypes_upper = array ("JPG", "GIF", "BMP", "JPEG", "PNG"); 
            if (!in_array($fileType, $fileTypes) && !in_array($fileType, $fileTypes_upper)) {
                $fileTypeStr = implode ( $fileTypes, ',' );
                echo '图片格式不对！接受：' . $fileTypeStr . '。';
                exit ();
            }
            $rand = rand ( 1000, 9999 );
            // filename on server
            $serverFilename = 'casa_' . date ( "YmdHis" ) . $rand . '.' . $fileType;
            // filepath on server
            $pic_path = "../../../photo/" . $serverFilename;
            move_uploaded_file ($photoFile, $pic_path);
        }
        $size = round ( $size / 1024, 2 );
        $arr = array (
                'filename' => $serverFilename,
                'size' => $size
        );
        return json_encode ( $arr );
    }
    /**
     * Delete the photo file on linux server.
     * @param String $filename
     * @return success/fail
     */
    public function delete($filename) {
        $folder = $_SERVER['DOCUMENT_ROOT'].'/photo/';
        $path = $folder.$filename;
        if (!file_exists($path)) {
            return false;
        }
        unlink($path);
        if (file_exists($path)) {
            return false;
        } else {
            return true;
        }
    }
}
?>