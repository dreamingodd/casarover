<?php header("Content-Type: text/html; charset=utf-8");?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AreaDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/vo/Area.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/cache/AreaCache.php';?>
<?php
class AreaService {

    private static $Direct_Cities = array('北京','上海','天津','重庆');
    private $areaDao;

    public function __construct() {
        $this->areaDao = new AreaDao();
    }

    /**
     * Get the hierarchy of area.
     * 取得地区的全部层级结构，暂时中国以下。
     * 
     * @return multitype:Area
     */
    public function getAreaHierarchy() {
        $province_rows = $this->areaDao->getByLevel ( 2 );
        $city_rows = $this->areaDao->getByLevel ( 3 );
        $district_rows = $this->areaDao->getByLevel ( 4 );
        $areas = array ();
        // 省
        while ( $row = mysql_fetch_array ( $province_rows ) ) {
            $area = new Area ( $row );
            $areas [$area->id] = $area;
        }
        // 把市放进省
        $citys = array ();
        while ( $row = mysql_fetch_array ( $city_rows ) ) {
            $area = new Area ( $row );
            $cities [$area->id] = $area;
            $areas [$area->parentid]->sub_areas [$area->id] = $area;
        }
        // 把区放进市
        while ( $row = mysql_fetch_array ( $district_rows ) ) {
            $area = new Area ( $row );
            $cities [$area->parentid]->sub_areas [$area->id] = $area;
        }
        // print_w($areas);
        return $areas;
    }
    /**
     * 取得所有city_search页面城市信息（包括直辖市）.
     * return an array of Area Objects.
     */
    public function getCitiesIncludeDirect() {
        $cities = array();
        foreach(self::$Direct_Cities as $city_name) {
            $area_row = $this->areaDao->getByNameAndLevel($city_name, 2);
            if (!empty($area_row['id'])) {
                $city = new Area($area_row);
                array_push($cities, $city);
            }
        }
        $unsettled_city_rows = $this->areaDao->getByLevel(3);
        while ($city_row = mysql_fetch_array($unsettled_city_rows)) {
            $parent_row = $this->areaDao->getById($city_row['parentid']);
            // 如果父级元素是直辖市，那么这个元素应该是地区，那么就不加入$cities中
            if (!in_array($parent_row['value'], self::$Direct_Cities)) {
                array_push($cities, new Area($city_row));
            }
        }
        return $cities;
    }
    /** get all cities(包括直辖市). */
    public function getCityIdsIncludeDirect(){
        $cities = $this->getCitiesIncludeDirect();
        $city_ids = array();
        foreach ($cities as $city) {
            array_push($city_ids, $city->id);
        }
        return $city_ids;
    }
    /** get all provinces（不包括直辖市）. */
    public function getProvincesWithoutDirect() {
        $provinces = array();
        $province_rows = $this->areaDao->getByLevel(2);
        while ($row = mysql_fetch_array($province_rows)) {
            $province = new Area($row);
            if (!in_array($province->name, self::$Direct_Cities)) {
                array_push($provinces, $province);
            }
        }
        return $provinces;
    }
    /** Fill out subareas. */
    public function fillSubareas(array $areas) {
        foreach ($areas as $area) {
            $this->fillSubarea($area);
        }
    }
    /** Fill out subarea. */
    public function fillSubarea(Area $area) {
        $area->sub_areas = $this->getSubAreas($area->id);
    }
    /**
     * With the input area_id, get the parent(parent of parent...).
     * Return the text of the full path of the area.
     * e.g. 浙江 杭州 白乐桥
     * 
     * @param int $id
     */
    public function getLeafFullName($id) {
        return $this->nameRecursion ( $id, '' );
    }
    protected function nameRecursion($id, $areaText) {
        $area_row = $this->areaDao->getById ( $id );
        $areaText = $area_row ['value'] . ' ' . $areaText;
        if (empty ( $area_row ['parentid'] ) || $area_row ['parentid'] == 1) {
            return $areaText;
        } else {
            return $this->nameRecursion ( $area_row ['parentid'], $areaText );
        }
    }
    public function getSubAreas($parentid) {
        $subAreas = array();
        $area_rows = $this->areaDao->getByParentid($parentid);
        while ($area_row = mysql_fetch_array($area_rows)) {
            $subArea = new Area($area_row);
            array_push($subAreas, $subArea);
        }
        return $subAreas;
    }

    public function getAllArea(){
        $message = $this->areaDao->getByLevel('4');
        $area = array();
        while ($area_row = mysql_fetch_array($message)){
            $area_mess = array();
            $area_mess['id'] = $area_row['id'];
            $area_mess['name'] = $area_row['value'];
            array_push($area,$area_mess);
        }
        return $area;
    }
}

?>