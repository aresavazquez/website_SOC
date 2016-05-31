<?php

/**
 * Class Redirect
 *
 * Simple abstraction for redirecting the user to a certain page
 */
class Routes{
	private static $instance = false;
	private static $router;

	private function __construct(){
		self::$router = new AltoRouter();
		self::$router->setBasePath('');
        
    self::$router->map( 'GET', '/', 'IndexController#home', 'p_home');
    self::$router->map( 'GET', '/soc', 'IndexController#soc', 'p_soc');
    self::$router->map( 'GET', '/productos/hipotecarios', 'IndexController#products_mortgage', 'p_products_mortgage');
    self::$router->map( 'GET', '/productos/empresas', 'IndexController#products_enterprise', 'p_products_enterprise');
    self::$router->map( 'GET', '/oficinas', 'IndexController#offices', 'p_offices');
    self::$router->map( 'GET', '/soc_tips', 'IndexController#tips', 'p_tips');
    self::$router->map( 'GET', '/contacto', 'IndexController#contact', 'p_contact');
    self::$router->map( 'GET', '/blog', 'BlogController#index', 'p_blog');
    self::$router->map( 'GET', '/admin', 'AdminController#index', 'p_admin');
    self::$router->map( 'GET', '/admin/users', 'AdminController#users', 'admin_users');
    self::$router->map( 'GET', '/admin/sites', 'AdminController#sites', 'admin_sites');
    
    //- API
    self::$router->map( 'POST', '/api/v1/login', 'ApiController#login');
    self::$router->map( 'POST', '/api/v1/register', 'ApiController#register');
    self::$router->map( 'GET|POST', '/api/v1/users', 'ApiController#users');
    self::$router->map( 'GET|POST', '/api/v1/users/[i:id]', 'ApiController#get_user');
    self::$router->map( 'PUT', '/api/v1/users/[i:id]', 'ApiController#set_user');
    self::$router->map( 'GET', '/api/v1/sites', 'ApiController#sites');
    self::$router->map( 'POST', '/api/v1/sites', 'ApiController#new_site');
    self::$router->map( 'GET|POST', '/api/v1/sites/[*:url]', 'ApiController#get_site');
    self::$router->map( 'PUT', '/api/v1/sites/[*:url]', 'ApiController#set_site');

    self::$router->map( 'GET', '/world', function(){
    	echo 'hello world';
    });
	}

	/**
	* Singleton pattern
	*/
	public static function get_instance(){
		if( !self::$instance ) self::$instance = new self();
		return self::$instance;
	}

	public static function get_router(){
		return self::$router;
	}
}