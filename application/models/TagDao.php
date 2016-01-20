<?php header("Content-Type: text/html; charset=utf-8");?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/db_connection.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/BaseDao.php';?>
<?php
class TagDao extends BaseDao {
    /**
     * Add a tag.
     * While type is custom, it's considered to be a customized tag.
     * To be added, if type is scenery, it's a 景点标签，现在还没有
     * @param String $name
     * @param String $type
     * @return inserted ID if succeed / false if failed
     */
    public function add($name, $type) {
        $name = $this->check_input($name);
        $type = $this->check_input($type);
        $sql = "insert into tag (id,name,type,update_time) values(null, $name, $type ,now())";
        $result = mysql_query($sql);
        if (!$result) return $result;
        return mysql_insert_id();
    }
    /**
     * Will check if the tag name is already existing in the table, no matter what its type is.
     * @param Array $tags
     * @return Array of ID if succeed:
     */
    public function addCustomizedTags($tags) {
        $tagIds = array();
        // Iterate the customized tags which maybe
        // 1.Fresh new
        // 2.Exists as a custom tag.
        // 3.Exists as an offical tag. 
        foreach($tags as $tagName) {
            $tag_row = $this->getByName($tagName);
            if (empty($tag_row)) {
                // 1
                $result = $this->add($tagName, 'custom');
                if (!$result) return $result;
                $tagId = mysql_insert_id();
            } else {
                // 2/3
                $tagId = $tag_row['id'];
            }
            array_push($tagIds, $tagId);
        }
        return $tagIds;
    }
    /**
     * Get All method.
     * In common sense, the result shall be sorted by Chinese character.
     * @return resource
     */
    public function getAll(){
        // TODO order pending: 中文
        $sql = 'select * from tag';
        return mysql_query($sql);
    }
    public function getById($id) {
        $id = $this->check_input($id);
        $sql = "select * from tag where id=".$id;
        return mysql_fetch_array(mysql_query($sql));
    }
    public function getByName($name) {
        $name = $this->check_input($name);
        $sql = "select * from tag where name=$name";
        return mysql_fetch_array(mysql_query($sql));
    }
    public function getByType($type) {
        $name = $this->check_input($type);
        $sql = "select * from tag where id=$type";
        return mysql_query($sql);
    }
}
?>
