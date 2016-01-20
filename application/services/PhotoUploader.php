<?php 
abstract class PhotoUploader {
    public abstract function upload($files);
    public abstract function delete($filename);
}
?>