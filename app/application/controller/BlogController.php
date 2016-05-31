<?php

class BlogController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }

    public function index($links, $params){
        $this->View->render('blog/index.html', array('links'=>$links));
    }
}
