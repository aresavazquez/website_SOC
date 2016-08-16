<?php

/**
 * Class View
 * The part that handles all the output
 */
class View
{
    /** @var mixed Instance of the view */
    private $twig;

    public function __construct(){
        $loader = new Twig_Loader_Filesystem(Config::get('PATH_VIEW'));
        $this->twig = new Twig_Environment($loader, array(
            'debug' => true
        ));
        $this->twig->addExtension(new Twig_Extension_Debug());
    }
    /**
     * simply includes (=shows) the view. this is done from the controller. In the controller, you usually say
     * $this->view->render('help/index'); to show (in this example) the view index.php in the folder help.
     * Usually the Class and the method are the same like the view, but sometimes you need to show different views.
     * @param string $filename Path of the to-be-rendered view, usually folder/file(.php)
     * @param array $data Data to be used in the view
     */
    public function render($filename, $scope_data = null){
        $links = $this->generateRoutes();
        if(!$scope_data) $scope_data = array();
        $data =array_merge(
            $scope_data,
            array(
                'links'=>$links,
                'base_path'=>Config::get('URL'),
                'logged_in'=>Session::userIsLoggedIn()
            )
        );
        echo $this->twig->render($filename, $data);
    }

    public function render_string($filename, $scope_data = null){
        $links = $this->generateRoutes();
        if(!$scope_data) $scope_data = array();
        $data =array_merge(
            $scope_data,
            array(
                'links'=>$links,
                'base_path'=>Config::get('URL'),
                'logged_in'=>Session::userIsLoggedIn()
            )
        );
        return $this->twig->render($filename, $data);
    }

    /**
     * Renders pure JSON to the browser, useful for API construction
     * @param $data
     */
    public function renderJSON($data){
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    private function generateRoutes() {
        $router = Routes::getInstance()->get_router();
        $routes = $router->getRoutes();
        $links = array();
        foreach ($routes as $key => $value) {
            $index = $value[3];
            if($index){
                $links[$index] = $router->generate($index);
            }
        }
        return $links;
    }
}
