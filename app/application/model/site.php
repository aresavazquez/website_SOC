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
        return $result->get('title,content,address,settlement,city');
    }

    public static function allFrom($id){
        $result = self::$PDO->_where("*", "site_id=$id");
        return array('items'=>$result->get('title,content,settlement,city'), 'total'=>$result->count());
    }

    public static function byState($id){
        $result = self::$PDO->_where("*", "state_id=$id");
        return $result->get('title,content,address,settlement,city');
    }

    public static function byUser($id){
        $result = self::$PDO->_where("*", "user_id=$id");
        return $result->first('title,content,address,settlement,city');
    }

    public static function byUrl($url) {
        $result = self::$PDO->_where("*", "url='$url'");
        return $result->first('title,content,address,settlement,city');
    }

    public static function byId($id) {
        $result = self::$PDO->_where("*", "id='$id'");
        return $result->first('title,content,address,settlement,city');
    }

    public static function setData($id, $data){
        $result = self::$PDO->_update($data, "id='$id'");
        return $result;
    }

    public static function save($user_id, $state_id, $site_id, $title, $content, $city, $settlement, $address, $latlon, $phones, $emails, $slider, $support_quotes, $support_images, $type) {
        $user = User::getInstance()->byId($user_id);
        if($user){
            //if(self::getInstance()->hasSite($user_id)) {
            //  Session::add('feedback_negative', Text::get('FEEDBACK_USER_HAS_SITE'));
            //  return false;
            //}
            $url = self::sluggify($title);
            if (!self::getInstance()->writeNewSiteToDatabase($user_id, $state_id, $site_id, $url, $title, $content, $city, $settlement, $latlon, $address, $phones, $emails, $slider, $support_quotes, $support_images, $type)) {
                Session::add('feedback_negative', Text::get('FEEDBACK_SITE_CREATION_FAILED'));
                return false; // no reason not to return false here
            }
            return true;
        }else{
            Session::add('feedback_negative', Text::get('FEEDBACK_USER_DOES_NOT_EXIST'));
            return false;
        }
    }

    public static function delete($site_id){
      return self::$PDO->_delete("id=$site_id");
    }

    public static function hasSite($user_id){
      $result = self::$PDO->_where("id", "user_id=$user_id");
      return $result->count() > 0;
    }

    public static function writeNewSiteToDatabase($user_id, $state_id, $site_id, $url, $title, $content, $city, $settlement, $latlon, $address, $phones, $emails, $slider, $support_quotes, $support_images, $type) {
        $data = array('user_id'=>$user_id, 'state_id'=>$state_id, 'site_id'=>$site_id, 'url'=>$url, 'title'=>$title, 'content'=>$content, 'city'=>$city, 'settlement'=>$settlement, 'latlon'=>$latlon, 'address'=>$address, 'phones'=>$phones, 'emails'=>$emails, 'slider'=>implode('|', $slider), 'support_quotes'=>implode('|', $support_quotes), 'support_images'=>implode('|', $support_images), 'site_type'=>$type);
        return self::$PDO->_insert($data);
    }

    private static function sluggify($url){
        # Prep string with some basic normalization
        $url = strtolower($url);
        $url = strip_tags($url);
        $url = stripslashes($url);
        $url = html_entity_decode($url);

        # Remove quotes (can't, etc.)
        $url = str_replace('\'', '', $url);

        # Replace non-alpha numeric with hyphens
        $match = '/[^a-z0-9]+/';
        $replace = '-';
        $url = preg_replace($match, $replace, $url);

        $url = trim($url, '-');

        return $url;
    }
}
