<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/db_connection.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/BaseDao.php';?>
<?php include_once 'WechatArticle.php';?>
<?php 
class WechatArticleDao extends BaseDao{
    public function addOrUpdate(WechatArticle $wa) {
        $this->checkAttrs($wa);
        if (empty($wa->id)) {
            // Add
            $sql = "insert into wechat_article (attachment_id, title, brief, address, type, series, deleted) "
                    ."values ($wa->attachment_id, $wa->title, $wa->brief, $wa->address,"
                    ."$wa->type, $wa->series, $wa->deleted)";
            if (mysql_query($sql)) {
                return mysql_insert_id();
            } else {
                return 0;
            }
        } else {
            // Update
            $sql = "update wechat_article set "
                    ."attachment_id=$wa->attachment_id, "
                    ."title=$wa->title, "
                    ."brief=$wa->brief, "
                    ."address=$wa->address, "
                    ."type=$wa->type, "
                    ."series=$wa->series, "
                    ."deleted=$wa->deleted "
                    ."where id=$wa->id ";
            if (mysql_query($sql)) {
                return $wa->id;
            } else {
                return 0;
            }
        }
    }
    public function recycle($id) {
        $this->check_input($id);
        $sql = "update wechat_article set deleted=1 where id=$id";
        return mysql_query($sql);
    }
    public function recover($id) {
        $this->check_input($id);
        $sql = "update wechat_article set deleted=0 where id=$id";
        return mysql_query($sql);
    }
    public function del($id) {
        $this->check_input($id);
        $sql = "delete from wechat_article where id=$id";
        return mysql_query($sql);
    }
    public function getAll($deleted=0) {
        if (!isset($deleted)) $deleted = 0;
        $this->check_input($deleted);
        $sql = "select * from wechat_article where deleted=$deleted order by id desc";
        return mysql_query($sql);
    }
    public function getById($id) {
        $id = $this->check_input(intval($id));
        $sql = "select * from wechat_article where id=$id";
        return mysql_fetch_array(mysql_query($sql));
    }
    public function getByType($type) {
        $type = $this->check_input(intval($type));
        $sql = "select * from wechat_article where type=$type and deleted<>1 order by id desc";
        return mysql_query($sql);
    }
    /**
     * Check attributes of the instance of WechatArticle.
     * Used only in this method.
     * @param WechatArticle $wa 
     */
    private function checkAttrs(WechatArticle $wa) {
        if (empty($wa->address)) $wa->address = '';
        if (empty($wa->brief)) $wa->brief = '未填写';
        if (empty($wa->deleted)) $wa->deleted = 0;
        if (empty($wa->title)) $wa->title = '未填写';
        if (empty($wa->type)) $wa->type = 1;
        if (empty($wa->series)) $wa->series = 0;
        $wa->address = $this->check_input($wa->address);
        $wa->attachment_id = $this->check_input($wa->attachment_id);
        $wa->brief = $this->check_input($wa->brief);
        $wa->deleted = $this->check_input(intval($wa->deleted));
        $wa->id = $this->check_input(intval($wa->id));
        $wa->title = $this->check_input($wa->title);
        $wa->type = $this->check_input(intval($wa->type));
        $wa->series = $this->check_input($wa->series);
    }
}