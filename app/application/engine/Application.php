<?php

/**
 * Class Application
 * The heart of the application
 */
class Application {
    private $router;
    private $match;

    public function __construct() {
        $this->router = Routes::get_instance()->get_router();
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
                call_user_func_array(array($icontroller,$action), array($this->match['params']));
            }else{
                // no controller founded
                header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
            }
        } else {
            // no route was matched
            header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        }
    }
}
