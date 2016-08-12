<?php
class Post{
    private static $instance = false;
    private static $PDO;

	protected function __construct(){
		self::$PDO = new PDODB('blog');
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

    public static function pages() {
        return ceil(self::$PDO->_all("post_id")->count() / 10);
    }

    public static function byPage($page){
        $index = ($page - 1) * 10;
        $result = self::$PDO->_where("*","post_id LIMIT $index,10");
        return $result->get('post_title,post_content');
    }

    public static function byId($id){
        $result = self::$PDO->_where("*", "post_id=$id");
        return $result->get();
    }

    public static function byUser($id_user){
        $result = self::$PDO->_where("*", "id_user=$id_user");
        return $result->get();
    }
    public static function byTag($tag){
        $result = self::$PDO->_where("*", "url_tag='$tag'");
        return $result->first('post_title,post_content');
    }
}