<?php

/**
 * Class Redirect
 *
 * Simple abstraction for redirecting the user to a certain page
 */
class Routes{
	private static $instance = false;
	private static $paths;

	private function __construct(){
		self::$paths = array(
            'root_url' => $this->set_url(''),
            'password_reset_url' => $this->set_url('consultant/requestPasswordReset'),
            'privacy_url' => $this->set_url('index/privacy'),
            'terms_url' => $this->set_url('index/terms')
        );
	}

	/**
	* Singleton pattern
	*/
	public static function get_instance(){
		if( !self::$instance ) self::$instance = new self();
		return self::$instance;
	}

	public static function all(){
		return self::$paths;
	}

	private function set_url($path){
		return Config::get('URL') . $path;
	}
}