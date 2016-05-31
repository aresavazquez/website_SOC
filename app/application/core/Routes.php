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
            'user_url' => $this->set_url('consultant'),
            'password_reset_url' => $this->set_url('consultant/requestPasswordReset'),
            'soc_url' => $this->set_url('index/soc'),
            'soc_url' => $this->set_url('index/products'),
            'soc_url' => $this->set_url('index/offices'),
            'soc_url' => $this->set_url('index/tips'),
            'soc_url' => $this->set_url('index/blog'),
            'soc_url' => $this->set_url('index/contact'),
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