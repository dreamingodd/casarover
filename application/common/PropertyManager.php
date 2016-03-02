<?php 
/**
 * The properties of system level.
 * @author Ye_WD
 * @2016-3-1
 */
class PropertyManager {
    // No variables in const
//     const FILE_PATH = $_SERVER['DOCUMENT_ROOT']."/casarover/application/configs/property.json";
    private $File_Path;
    private $properties;
    public function __construct() {
        $File_Path = $_SERVER['DOCUMENT_ROOT']."/cache/property.json";
        if (file_exists($File_Path)) {
            $content = file_get_contents($File_Path);
            if (empty($content)) {
                throw new Exception("Property file is empty! - ".$File_Path);
            } else {
                $this->properties= json_decode($content);
            }
        } else {
            throw new Exception("Property file doesn't exist! - ".$File_Path);
        }
    }
    public function getProperty($propName) {
        return $this->properties->$propName;
    }
}
?>