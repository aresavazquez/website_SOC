<?php

class IndexController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }

    public function index(){
    	$this->View->render('site/index.html', $this->Routes);
    }
    public function privacy(){

    }
    public function terms(){
    	
    }
}
