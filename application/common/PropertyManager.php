<?php 
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
    public function getSystem() {
        return $this->properties->system;
    }
    public function getHost() {
        return $this->properties->host;
    }
    public function getPhotoFolder() {
        return $this->properties->photo_folder;
    }
    public function getDummyOpenid() {
        return $this->properties->dummy_openid;
    }
}
?>