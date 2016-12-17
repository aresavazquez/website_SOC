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
        $result = self::$PDO->_where("*", "post_id ORDER BY created_at DESC");
        return $result->get('post_title,post_content');
    }

    public static function last() {
        $result = self::$PDO->_where("*","post_id ORDER BY created_at DESC LIMIT 5");
        return $result->get('post_title,post_content');
    }

    public static function pages() {
        return ceil(self::$PDO->_all("post_id")->count() / 10);
    }

    public static function byPage($page){
        $index = ($page - 1) * 10;
        $result = self::$PDO->_where("*","post_id ORDER BY created_at DESC LIMIT $index,10");
        return $result->get('post_title,post_content');
    }

    public static function byId($id){
        $result = self::$PDO->_where("*", "post_id=$id");
        return $result->first('post_title,post_content');
    }

    public static function byUser($id_user){
        $result = self::$PDO->_where("*", "id_user=$id_user");
        return $result->get();
    }
    public static function byTag($tag){
        $result = self::$PDO->_where("*", "url_tag='$tag'");
        return $result->first('post_title,post_content');
    }

    public static function byKeyword($keyword){
        $result = self::$PDO->_where("*", "post_title LIKE '%$keyword%'");
        return $result->get('post_title,post_content');
    }

    public static function save($title, $image, $content){
        $url = self::sluggify($title);
        $data = array('id_user'=>1, 'post_title'=>utf8_decode($title), 'url_tag'=>$url, 'post_image'=>$image, 'post_content'=>utf8_decode($content), 'post_status'=>'publish');
        return self::$PDO->_insert($data);
    }

    public static function delete($id){
        return self::$PDO->_delete("post_id=$id");
    }

    public static function set_data($id, $title, $image, $content){
        $post = self::$PDO->_where("*", "post_id=$id")->first();
        if(!$title) $title = $post->post_title;
        if(!$image) $image = $post->post_image;
        if(!$content) $content = $post->post_content;
        $url = self::sluggify($title);
        $data = array('id_user'=>1, 'post_title'=>utf8_decode($title), 'url_tag'=>$url, 'post_image'=>$image, 'post_content'=>utf8_decode($content), 'post_status'=>'publish');
        return self::$PDO->_update($data, "post_id=$id");
    }

    public static function update_image($id, $path){
        $data = array('post_image'=>$path);
        return self::$PDO->_update($data, "post_id=$id");
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