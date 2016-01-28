<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/ThemeDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/AttachmentDao.php';?>
<?php 
/**
 * The theme operation service on the homepage.
 * Including transaction.
 * @author Ye_WD
 * @2016-1-27
 */
class ThemeService {
    private $themeDao;
    private $aDao;
    public function __construct() {
        $this->themeDao = new ThemeDao();
        $this->aDao = new AttachmentDao();
    }
    /**
     */
    public function addOrUpdate($name, $description, $filepath, $update_by,
            $theme_items, $area_ids, $id=0) {
        mysql_query('START TRANSACTION') or die(mysql_error());
        // If the theme has been created, then I have lots of related information to delete
        if ($id) {
            // delete related theme_item and theme_area
            $theme_item_rows = $this->themeDao->getItemByThemeId($id);
            while ($item_row = mysql_fetch_array($theme_item_rows)) {
                $success = $this->delItem($item_row['id']);
                if (!$success) $this->rollback();
            }
            $success = $this->themeDao->delThemeAreaById($id);
            if (!$success) $this->rollback();
        }
        // Add a simple theme object
        $a_id = $this->aDao->addSimple($filepath);
        $id = $this->themeDao->addOrUpdate($name, $description, $a_id, $update_by);
        if (!$id) $this->rollback();
        // Add reference objects: theme_item, theme_area
        foreach ($theme_items as $theme_item) {
            $this->addItem($theme_item);
        }
        foreach ($area_ids as $area_id) {
            $success = $this->themeDao->addThemeArea($id, $area_id);
            if (!$success) $this->rollback();
        }
        // 执行成功，提交事务。
        mysql_query('COMMIT')or die(mysql_error());
        return $id;
    }
    private function addItem($theme_item) {
        $item_id = $this->themeDao->addItem($theme_item->theme_id, $theme_item->name, $theme_item->text,
                $theme_item->casa_id, $theme_item->link);
        if (!$item_id) $this->rollback();
        foreach ($theme_item->filepaths as $filepath) {
            $a_id = $this->aDao->addSimple($filepath);
            if (!$a_id) $this->rollback();
            $success = $this->themeDao->addItemAttachment($item_id, $a_id);
            if (!$success) $this->rollback();
        }
        return $item_id;
    }
    /**Delete theme_item, theme_item_attachment, attachment
     */
    private function delItem($item_id) {
        $theme_item_attachemnt_rows = $this->themeDao->getItemAttachmentByItemId($item_id);
        // 1.delete attachment(s)
        while ($tia_row = mysql_fetch_array($theme_item_attachemnt_rows)) {
            $success = $this->aDao->del($tia_row['attachment_id']);
            if (!$success) $this->rollback();
        }
        // 2.delete middle table
        $success = $this->themeDao->delItemAttachmentByItemId($item_id);
        if (!$success) $this->rollback();
        // 3.delete theme item itself
        $success = $this->themeDao->delItemById($item_id);
        if (!$success) $this->rollback();
    }
    public function recycleTheme($id) {
        $this->themeDao->recycle($id);
    }
    public function recoverTheme($id) {
        $this->themeDao->recover($id);
    }
    public function rollback() {
        mysql_query('ROLLBACK');
        echo mysql_error();
        exit;
    }
}
?>