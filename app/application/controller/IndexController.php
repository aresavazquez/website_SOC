<?php

class IndexController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }

    public function home(){
        $this->View->render('site/index.html');
    }
    public function detalle(){
        $this->View->render('site/detalle.html');
    }
    public function soc(){
        $this->View->render('site/soc.html');   
    }
    public function products_mortgage(){
        $this->View->render('site/products_mortgage.html'); 
    }
    public function products_enterprise(){
        $this->View->render('site/products_enterprise.html'); 
    }
    public function offices(){
        $states = State::get_instance()->all();
        $this->View->render('site/offices.html', array('states'=>$states)); 
    }
    public function tips(){
        $this->View->render('site/tips.html'); 
    }
    public function contact(){
        $this->View->render('site/contact.html'); 
    }
    public function privacy(){

    }
    public function terms(){
    	
    }
}
