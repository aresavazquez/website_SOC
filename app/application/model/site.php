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
    public static function get_instance() {
        if( !self::$instance ) self::$instance = new self();
        return self::$instance;
    }

    public static function all() {
        $result = self::$PDO->_all("*");
        return $result->get();
    }

    public static function by_url($url) {
        $result = self::$PDO->_where("*", "url='$url'");
        return $result->first();
    }

    public static function set_data($url, $data){
        $result = self::$PDO->_update($data, "url='$url'");
        return $result;
    }

    public static function save() {

        // clean the input
        $user_email = strip_tags(Request::post('user_email'));
        $state_id = strip_tags(Request::post('state_id'));
        $url = strip_tags(Request::post('url'));
        $title = Request::post('title');
        $content = Request::post('content');
        $address = Request::post('address');
        $contact = Request::post('contact');

        $user = User::get_instance()->getUserDataByEmail($user_email);
        if($user){
            $user_id = $user->id;
            if (!self::get_instance()->writeNewSiteToDatabase($user_id, $state_id, $url, $title, $content, $address, $contact)) {
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