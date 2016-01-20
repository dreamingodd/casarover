<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/cache/Cache.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/AreaService.php';?>
<?php
class AreaCache extends Cache {
    private static $filename = 'area.json';
    /** path + filename */
    private $filepath;
    private $areaService;

    private $provinces;
    private $provincesWithSub;
    private $cities;

    private $provinces_json;
    private $provincesWithSub_json;
    private $cities_json;

    /**
     * Responsiblity of the constructor is crucial.
     * 1.Get the cache file path.
     * 2.Create the cache file if it doesn't exists.
     * 3.Get the area data if the file exists.
     */
    public function __construct(){
        parent::__construct();
        $this->areaService = new AreaService();
        $this->filepath = parent::$path.'/'.self::$filename;
        if (!file_exists($this->filepath)) {
            $this->provinces = $this->areaService->getProvincesWithoutDirect();
            $this->provincesWithSub = $this->areaService->getProvincesWithoutDirect();
            $this->areaService->fillSubareas($this->provincesWithSub);
            $this->cities = $this->areaService->getCitiesIncludeDirect();
            $this->provinces_json = json_encode($this->provinces);
            $this->provincesWithSub_json = json_encode($this->provincesWithSub);
            $this->cities_json = json_encode($this->cities);
            $this->writeIntoFile($this->provinces_json, $this->provincesWithSub_json, $this->cities_json);
        } else {
            $areaCacheFile = fopen($this->filepath, 'r') or die('File: '.$this->filepath.' open failed!');
            $this->provinces_json = fgets($areaCacheFile);
            $this->provincesWithSub_json = fgets($areaCacheFile);
            $this->cities_json = fgets($areaCacheFile);
            fclose($areaCacheFile);
            $this->provinces = json_decode($this->provinces_json);
            $this->provincesWithSub = json_decode($this->provincesWithSub_json);
            $this->cities = json_decode($this->cities_json);
        }
    }

    /**
     * Write the json string of cache into cache file.
     * @param array of Area $provinces
     * @param array of Area $provincesWithSub
     * @param array of Area $cities
     */
    private function writeIntoFile($provinces, $provincesWithSub, $cities) {
        $areaCacheFile = fopen($this->filepath, 'w') or die('File: '.$this->filepath.' open failed!');
        fwrite($areaCacheFile, $provinces."\n".$provincesWithSub."\n".$cities);
        fclose($areaCacheFile);
    }

    public function getProvincesWithSub_Json() {
        return $this->provincesWithSub_json;
    }
    public function getProvinces_Json() {
        return $this->provinces_json;
    }
    public function getCities_Json() {
        return $this->cities_json;
    }

    public function getProvincesWithSub() {
        return $this->provinces;
    }
    public function getProvinces() {
        return $this->provinces;
    }
    public function getCities() {
        return $this->cities;
    }

    public function destory() {
        unlink($this->filepath);
    }
}
?>