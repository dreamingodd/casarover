<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php 

class PicCache {
    const TYPE_CITY = "city";
    const TYPE_AREA = "area";
    const TYPE_CASA = "casa";
    public $id;
    public $path;
    public $type;
    /**
     * Constructor.
     * Argument count:
     * 0:default;
     * 3:All member varibles: $id, $path, $type.
     * @throws Exception method missing
     */
    public function __construct() {
        $args = func_get_args();
        $count = count($args);
        if (method_exists($this, $method='__construct'.$count)) {
            call_user_func_array(array($this, $method), $args);
        } else {
            throw new Exception('No such method:'.__CLASS__.'-'.$method);
        }
    }
    private function __construct0() {
    }
    private function __construct3($id, $path, $type) {
        $this->id = $id;
        $this->path = $path;
        $this->type = $type;
    }

    public function fillToWholePath($path) {
        if (stristr($path, "http") < 0) {
            $filname = $path;
            $path = getBaseUrl()."photo/".$filname;
        }
        return $path;
    }
}
?>