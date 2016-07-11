<?php
class Site {
    private static $instance = false;
    private static $PDO;

    protected function __construct() {
        self::$PDO = new PDODB('sites');
    }
    /**
    * Singleton pattern
    */
    public static function getInstance() {
        if( !self::$instance ) self::$instance = new self();
        return self::$instance;
    }

    public static function all() {
        $result = self::$PDO->_all("*");
        return $result->get();
    }

    public static function byUrl($url) {
        $result = self::$PDO->_where("*", "url='$url'");
        return $result->first();
    }

    public static function setData($url, $data){
        $result = self::$PDO->_update($data, "url='$url'");
        return $result;
    }

    public static function save($user_id, $state_id, $url, $title, $content, $address, $contact) {
        $user = User::getInstance()->byId($user_id);
        if($user){
            if (!self::writeNewSiteToDatabase($user_id, $state_id, $url, $title, $content, $address, $contact)) {
                Session::add('feedback_negative', Text::get('FEEDBACK_SITE_CREATION_FAILED'));
                return false; // no reason not to return false here
            }
            return true;
        }else{
            Session::add('feedback_negative', Text::get('FEEDBACK_USER_DOES_NOT_EXIST'));
            return false;
        }
    }

    public static function writeNewSiteToDatabase($user_id, $state_id, $url, $title, $content, $address, $contact) {
        $data = array('user_id'=>$user_id, 'state_id'=>$state_id, 'url'=>$url, 'title'=>$title, 'content'=>$content, 'address'=>$address, 'contact'=>$contact);
        return $result = self::$PDO->_insert($data);
    }
}
