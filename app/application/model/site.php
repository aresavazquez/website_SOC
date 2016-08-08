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

    public static function allFrom($id){
        $result = self::$PDO->_where("*", "user_id=$id");
        return $result->get('title,content,settlement');
    }

    public static function byState($id){
        $result = self::$PDO->_where("*", "state_id=$id");
        return $result->get();
    }

    public static function byUser($id){
        $result = self::$PDO->_where("*", "user_id=$id");
        return $result->first();
    }

    public static function byUrl($url) {
        $result = self::$PDO->_where("*", "url='$url'");
        return $result->first();
    }

    public static function setData($url, $data){
        $result = self::$PDO->_update($data, "url='$url'");
        return $result;
    }

    public static function save($user_id, $state_id, $url, $title, $content, $address, $contact, $latlon) {
        $user = User::getInstance()->byId($user_id);
        if($user){
            if(self::getInstance()->hasSite($user_id)) {
              Session::add('feedback_negative', Text::get('FEEDBACK_USER_HAS_SITE'));
              return false;
            }
            if (!self::getInstance()->writeNewSiteToDatabase($user_id, $state_id, $url, $title, $content, $address, $contact, $latlon)) {
                Session::add('feedback_negative', Text::get('FEEDBACK_SITE_CREATION_FAILED'));
                return false; // no reason not to return false here
            }
            return true;
        }else{
            Session::add('feedback_negative', Text::get('FEEDBACK_USER_DOES_NOT_EXIST'));
            return false;
        }
    }

    public static function hasSite($user_id){
      $result = self::$PDO->_where("id", "user_id=$user_id");
      return $result->count() > 0;
    }

    public static function writeNewSiteToDatabase($user_id, $state_id, $url, $title, $content, $address, $contact, $latlon) {
        $data = array('user_id'=>$user_id, 'state_id'=>$state_id, 'url'=>$url, 'title'=>$title, 'content'=>$content, 'address'=>$address, 'contact'=>$contact, 'latlon'=>$latlon);
        return self::$PDO->_insert($data);
    }
}
