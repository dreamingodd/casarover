<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/cache/Cache.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/vo/PicCache.php';?>
<?php
/**
 * This class is used to get/create(default) huge pictures of index page.
 * Also contains methods of refreshing cache.
 * @author Ye_WD
 * @2015-12-24
 */
class HugePicsCache extends Cache {

    private static $filename = 'huge_pics.json';
    /** path + filename */
    private $filepath;
    private $huge_pics;

    public function __construct(){
        parent::__construct();
        $this->filepath = parent::$path.'/'.self::$filename;
        if (!file_exists($this->filepath)) {
            $this->huge_pics = $this->createDefaultCache($this->filepath);
        } else {
            $this->huge_pics = $this->readCacheFile();
        }
    }

    /**
     * For get huge picures outside this class.
     * @return array of huge pics
     */
    public function getHugePics() {
        return $this->huge_pics;
    }

    /**
     * Refresh the cache file.
     * Delete content of the file, and write in new json string.
     * @param Array $hugePicArray
     */
    public function refresh($hugePicArray) {
        $cacheFile = fopen($this->filepath, 'w') or die('File: '.$this->filepath.' open failed!');
        fwrite($cacheFile, json_encode($hugePicArray));
        fclose($cacheFile);
        $this->huge_pics = $this->readCacheFile();
    }

    /**
     * While cache file not exists, create cache and file.
     * @param String $file_path
     * @return array of huge pics
     */
    private function createDefaultCache($file_path) {
        $json_str = '[{"area_id":8,"path":"'.getBaseUrl().'casarover/website/image/lbt/01.jpg"},'
                .'{"area_id":9,"path":"'.getBaseUrl().'casarover/website/image/lbt/02.jpg"}]';
        $cacheFile = fopen($this->filepath, 'w') or die('File: '.$this->filepath.' open failed!');
        fwrite($cacheFile, $json_str);
        fclose($cacheFile);
        return json_decode($json_str);
    }

    /**
     * Read the cache file and return the cache array.
     * @param String $file_path
     * @return array of huge pics
     */
    private function readCacheFile() {
        $json_str = file_get_contents($this->filepath);
        return json_decode($json_str);
    }
}

?>