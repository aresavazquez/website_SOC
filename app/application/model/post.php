<?php
include_once("models/PDODB.php");
class Post extends PDODB{
	public function __construct(){
		parent::__construct();
		$this->table = 'blog';
	}
	public static function all() {
        $result = self::$PDO->_all("*");
        return $result->get();
    }

    public static function byId($id){
        $result = self::$PDO->_where("*", "post_id=$id");
        return $result->get();
    }

    public static function byUser($id_user){
        $result = self::$PDO->_where("*", "id_user=$id_user");
        return $result->get();
    }

}