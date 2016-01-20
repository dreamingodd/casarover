<?php


/**
 * User Object in Session
 * @author Ye_WD
 * @2015-12-17
 */
class UserInSession {
    public $id;
    public $username;
    public $type;
    public $openid;
    public $access_token;

    public function __construct($id, $username, $type, $openid, $access_token) {
        $this->id = $id;
        $this->username = $username;
        $this->type = $type;
        $this->openid = $openid;
        $this->access_token = $access_token;
    }
}

?>