
<?php 
class Logger {
    public function log($content) {
        file_put_contents("log.html", 'LOG: '.date('Y-m-d H:i:s ').$content.'<br/>', FILE_APPEND);
    }
    public function error($content) {
        file_put_contents("log.html", 'ERROR: '.date('Y-m-d H:i:s ').$content.'<br/>', FILE_APPEND);
    }
}
?>