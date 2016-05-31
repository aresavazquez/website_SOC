<?php

/**
 * Class Application
 * The heart of the application
 */
class Application {
    private $router;
    private $match;

    public function __construct() {
        $this->router = new AltoRouter();
        $this->router->setBasePath('');
        
        $this->router->map( 'GET', '/', 'IndexController#home', 'p_home');
        $this->router->map( 'GET', '/soc', 'IndexController#soc', 'p_soc');
        $this->router->map( 'GET', '/productos/hipotecarios', 'IndexController#products_mortgage', 'p_products_mortgage');
        $this->router->map( 'GET', '/productos/empresas', 'IndexController#products_enterprise', 'p_products_enterprise');
        $this->router->map( 'GET', '/oficinas', 'IndexController#offices', 'p_offices');
        $this->router->map( 'GET', '/soc_tips', 'IndexController#tips', 'p_tips');
        $this->router->map( 'GET', '/contacto', 'IndexController#contact', 'p_contact');
        $this->router->map( 'GET', '/blog', 'BlogController#index', 'p_blog');

        $this->router->map( 'GET', '/world', function(){
            echo 'hello world';
        });

        $this->computeMatch();
    }

    private function computeMatch() {
        $this->match = $this->router->match();

        if( $this->match && is_callable( $this->match['target'] ) ) {
            call_user_func_array( $this->match['target'], $this->match['params'] );
        } else if($this->match) {
            list( $controller, $action ) = explode( '#', $this->match['target'] );
            $icontroller = new $controller();
            if( is_callable(array($icontroller, $action)) ){
                $links = $this->generateRoutes();
                call_user_func_array(array($icontroller,$action), array($links, $this->match['params']));
            }else{
                // no controller founded
                header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
            }
        } else {
            // no route was matched
            header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        }
    }

    private function generateRoutes() {
        $routes = $this->router->getRoutes();
        $links = array();
        foreach ($routes as $key => $value) {
            $index = $value[3];
            if($index){
                $links[$index] = $this->router->generate($index);    
            }
        }
        return $links;
    }
}
