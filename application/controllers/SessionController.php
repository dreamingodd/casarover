<?php
class SessionController {
    public function __construct() {
        @session_start();
    }
    function addUserJson($user_json){
        $_SESSION['user_json'] = $user_json;
    }
    function getUserJson() {
        return $_SESSION['user_json'];
    }
    function destroyUser() {
        unset($_SESSION['user_json']);
    }
    function addCode($code){
        $_SESSION['code'] = $code;
    }
    function getCode(){
        return $_SESSION['code'];
    }
    function addVerifyTime($verify_time){
        $_SESSION['verify_time'] = $verify_time;
    }
    function getVerifyTime(){
        return $_SESSION['verify_time'];
    }
    function addCellphone($phone) {
        $_SESSION['cellphone'] = $phone;
    }
    function getCellphone() {
        return $_SESSION['cellphone'];
    }
    function destroy() {
        session_destroy();
    }
}
?>
