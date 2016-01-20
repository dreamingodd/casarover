<?php
/**
 * This class is the abstract super class for all cache classes.
 * Has the functionality of create cache folder in www(windows)/html(linux) folder.
 * @author Ye_WD
 * @2015-12-15
 */
abstract class Cache {
    protected static $path;
    protected function __construct() {
        self::$path = $_SERVER['DOCUMENT_ROOT'].'/cache';
        if (!is_dir(self::$path)) {
            mkdir(self::$path);
        }
    }

    public function destory() {
        unlink($this->filepath);
    }
}
?>