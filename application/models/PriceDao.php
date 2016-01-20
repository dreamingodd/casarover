<?php 
/**
 * This DAO accesses file data, not mysql database.
 * File location is /website/price.json
 * @author Ye_WD
 * @2015-12-28
 */
class PriceDao {
    private $path;
    public function __construct() {
        $this->path = $_SERVER['DOCUMENT_ROOT'].'/cache/price.json';
        if (!file_exists($this->path)) {
            echo 'Price file doesn\'t exist!';
            exit;
        }
    }
    public function get() {
        $price_count_array_str = file_get_contents($this->path);
        $price_count_array = json_decode($price_count_array_str);
        return $price_count_array;
    }
    public function put($price_count_array) {
        file_put_contents($this->path, json_encode($price_count_array));
    }
    public function getTotalCount() {
        $price_count_array = $this->get();
        return $price_count_array[0] + $price_count_array[1] + $price_count_array[2];
    }
}
?>