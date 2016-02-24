<?php header("Content-Type: text/html; charset=utf-8");?>
<?php 
set_include_path($_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/'.get_include_path());
include_once 'db_connection.php';
include_once 'BaseDao.php';
include_once 'ContentAttachmentDao.php';


class AreaDao extends BaseDao{
    /**
    * 2016.1.7
    * 获取地区的所有内容
    * return object
    */
    public function getAreaMess($area_id){

        // 获取area_dictionary表中存在的信息
        $area = $this->getById($area_id);
        $name = $area['value'];
        $position = $area['position'];
        $tier = $area['tier'];

        // 获取area_content表中的关联数据
        $content_id_arr = $this->getContentId($area_id);

        $contents = array();
        foreach ($content_id_arr as $value) {
            $content = $this->getContentById($value);
            if ($content['type'] == 'null') {
                array_push($contents, $content['text']);
            }else{
                $raiders_content = $content['text'];
            }
        }
        $title_img_id_arr = $this->getPhotosId($content_id_arr[2]);

        $title_img = $this->getPhotoById($title_img_id_arr[0]);
        $img_array = $this->getPhotosId(end($content_id_arr));
        $content_message_img = array();
        if (!empty($img_array)) {
            foreach ($img_array as $value) {
                $img_p = $this->getPhotoById($value);
                array_push($content_message_img, $img_p);
            }
        }

        $result = new stdClass();
        $result->id=$area_id;
        $result->name = $name;
        $result->title_img = $title_img;
        $result->contents=$contents;
        $result->content_img = $content_message_img;
        $result->radius=$raiders_content;
        $result->position=$position;
        $result->tier=$tier;
        return $result;
    }

    /**
    * draguo
    * return area_id
    * $content_arr is array
    */
    public function create($name,$parentid,$titlepic,$some_pics,$content_arr,$raiders_content,$position,$tier){
        $contentAttachmentDao = new ContentAttachmentDao();

        $some_pic_arr = explode(';', $some_pics);
        if (count($some_pic_arr)<5) {
            return "更新失败，介绍内容图片不足";
            exit();
        }

        $area_id = $this->addArea($name,$parentid,$tier,$position);
        $titlepic_id = $this->addPhoto($titlepic);
        foreach ($content_arr as $value) {
            $content_id = $this->addContent($area_id,$value);
            $this -> addAreaContact($area_id,$content_id);
        }
        // title图片和介绍内容最后一个绑定
        $contentAttachmentDao->add($content_id, $titlepic_id);

        $content_id = $this -> addContent($area_id,$raiders_content,$type=1);
        $this -> addAreaContact($area_id,$content_id);
        // 其余的四张和攻略进行绑定
        // var_dump($some_pic_arr);
        // exit();
        foreach ($some_pic_arr as $value) {
            if (!empty($value)) {
                $pic_id = $this -> addPhoto($value);
                $contentAttachmentDao->add($content_id, $pic_id);
            }
            
        }
        echo "提交成功";
    }

    /**
    * draguo
    * return area_id
    * $content_arr is array
    */
    public function update($area_id,$name,$titlepic,$some_pics,$content_arr,$raiders_content,$position,$tier){

        $contentAttachmentDao = new ContentAttachmentDao();
        $some_pic_arr = explode(';', $some_pics);
        if (count($some_pic_arr)<5) {
            echo "更新失败，介绍内容图片不足";
            exit();
        }

        // 更新基础信息
        $this->UpdataArea($area_id,$name,$parentid,$tier,$position);

        $titlepic_id = $this->addPhoto($titlepic);
        /**
        * 对area_content表重新进行绑定，但是之前的数据并没有被删除
        * 下次进行更正
        */
        $this->delAreaContact($area_id);
        foreach ($content_arr as $value) {
            $content_id = $this->addContent($area_id,$value);
            $this -> addAreaContact($area_id,$content_id);
        }
        // title图片和介绍内容最后一个绑定
        $contentAttachmentDao->delByContentId($content_id);
        $contentAttachmentDao->add($content_id, $titlepic_id);

        $content_id = $this -> addContent($area_id,$raiders_content,$type=1);
        $this -> addAreaContact($area_id,$content_id);
        // 其余的四张和攻略进行绑定
        foreach ($some_pic_arr as $value) {
            if (!empty($value)) {
                $pic_id = $this -> addPhoto($value);
                $contentAttachmentDao->add($content_id, $pic_id);
            }
            
        }
        echo "更新成功";
    }

    // 添加基础区域信息
    public function addArea($name,$parentid,$tier,$position){
        $name = $this->check_input($name);
        $parentid = $this->check_input($parentid);
        $tier = $this->check_input($tier);
        $position = $this->check_input($position);

        $sql = 'INSERT area_dictionary (value, parentid, level, islast, update_time, tier, position)'
                    ."VALUES($name, $parentid, 4, 1, now(), $tier, $position)";

        mysql_query ($sql);
        if (mysql_affected_rows () == - 1) {
            echo '添加失败：' . mysql_error ();
            exit;
        }
        return  mysql_insert_id();
    }

    // 更新区域基础信息
    public function UpdataArea($area_id,$name,$parentid,$tier,$position){
        $area_id = $this->check_input($area_id);
        $name = $this->check_input($name);
        $tier = $this->check_input($tier);
        $position = $this->check_input($position);

        $sql = "update area_dictionary set tier=$tier, "
                ."value=$name,"
                ."position=$position, "
                ."update_time=now() "
                ."where id=$area_id";
        mysql_query ($sql);
        if (mysql_affected_rows () == - 1) {
            echo '添加失败：' . mysql_error ();
            exit;
        }
        return $area_id;
    }
    // 获取区域的缩略信息 未完善
    public function getSimpleMess($area_id){
        $rows = $this->getByParentid($area_id);
        $result = array();
        while ($area_row = mysql_fetch_array($rows)) {
            $area_id = $area_row['id'];
            $mess = $this->getAreaMess($area_id);
            array_push($result, $mess);
        }
        return $result;
    }

    public function getHomePageCities() {
        $sql = "select * from casarover.area_dictionary where status = 3";
        return mysql_query($sql);
    }
    public function getByLevel($level) {
        $sql = "select * from area_dictionary where level = " . $level;
        return mysql_query($sql);
    }
    public function getByLevelAndType($level, $type) {
        $sql = "select * from area_dictionary where level=$level and type=$type";
        return mysql_query($sql);
    }
    public function getById($id) {
        $sql = "select * from area_dictionary where id=" . $id;
        return mysql_fetch_array(mysql_query($sql));
    }
    public function getByNameAndLevel($name, $level) {
        $sql = "select * from area_dictionary where value='$name' and level=$level";
        return mysql_fetch_array(mysql_query($sql));
    }
    public function getByParentid($parentid) {
        $sql = "select * from area_dictionary where parentid=$parentid";
        return mysql_query($sql);
    }

    public function addPhoto($filepath)
    {
        $filepath = $this->check_input($filepath);
        $sql = "INSERT INTO attachment  (type,update_time,filepath)"." VALUES ('photo', now(), $filepath)";
        mysql_query ( $sql );
        $result = mysql_insert_id();
        return $result;
    }
    public function addContent($casa_id,$text,$type='null'){
        $casa_id = $this->check_input($casa_id);
        $text = $this->check_input($text);
        $type = $this->check_input($type);
        $sql = "INSERT INTO content (text,type,update_time)"." VALUES ($text,$type,now())";
        mysql_query($sql);
        return mysql_insert_id();
    }
    public function addAreaContact($area_id,$content_id){
        $area_id = $this->check_input($area_id);
        $content_id = $this->check_input($content_id);
        $sql = "INSERT INTO area_content (area_id,content_id)"." VALUES ($area_id,$content_id)";
        mysql_query($sql);
        return mysql_insert_id();
    }
    
    public function delAreaContact($area_id){
        $area_id = $this->check_input($area_id);
        $sql = 'delete from area_content where area_id='.$area_id;
        return mysql_query($sql);    
    }

    public function getPhotosId($content_id)
    {
        if (empty($content_id)) {
            return null;
        }
        $sql = "SELECT attachment_id FROM content_attachment where content_id=$content_id";
        $result_sql = mysql_query($sql);
        $result = array();
        while ($attachment_id = mysql_fetch_array($result_sql)) {
            array_push($result, $attachment_id['attachment_id']);
        }
        return $result;
    }
    
    public function getPhotoById($photo_id)
    {
        if (empty($photo_id)) {
            return null;
        }
        $sql = "SELECT filepath FROM attachment where id = $photo_id";
        $result_sql = mysql_query($sql);
        $result_array = mysql_fetch_array($result_sql);
        $result = $result_array['filepath'];
        return $result;
    }

    public function getContentById($content_id){
        $sql = "SELECT text,type FROM content where id = $content_id";
        $result_sql = mysql_query($sql);
        $result_array = mysql_fetch_array($result_sql);
        return $result_array;
    }

    public function getContentId($area_id){

        $sql = "SELECT content_id FROM area_content where area_id = $area_id ORDER BY content_id";
        $result_sql = mysql_query($sql);
        $result = array();
        while ($result_array = mysql_fetch_array($result_sql)) {
            array_push($result, $result_array['content_id']);
        }
        return $result;
        
    }

    /**
     * Get the simple casas' information according to area_id.
     * @param int $area_id
     * @return rows
     */
    public function getCasas($area_id) {
        $area_id = $this->check_input($area_id);
        $sql = "select c.id, c.name from casa c, area_casa ac "
                ."where ac.casa_id=c.id "
                ."  and ac.area_id=$area_id";
        return mysql_query($sql);
    }
    /**
     * Add rows in area_casa, used for 区域民宿推荐
     * @param Array $casa_ids
     */
    public function addAreaCasas($area_id, Array $casa_ids) {
        foreach ($casa_ids as $casa_id) {
            if ($this->addAreaCasa($area_id, $casa_id) == 0) {
                return false;
            }
        }
    }
    public function addAreaCasa($area_id, $casa_id) {
        $area_id = $this->check_input($area_id);
        $casa_id = $this->check_input($casa_id);
        $sql = "insert into area_casa values (null, $area_id, $casa_id)";
        if (mysql_query($sql)) {
            return mysql_insert_id();
        } else {
            return 0;
        }
    }
}

?>