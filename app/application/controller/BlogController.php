<?php

class BlogController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }

    public function index(){
    	$posts = Post::getInstance()->all();
        $this->View->render('blog/index.html', array('posts'=>$posts));
    }

    public function nota(){
        $this->View->render('blog/detalle.html');
    }
}
