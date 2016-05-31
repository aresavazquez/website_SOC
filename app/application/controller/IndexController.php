<?php

class IndexController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }

    public function home($links, $params){
        $this->View->render('site/index.html', array('links'=>$links));
    }
    public function soc($links, $params){
        $this->View->render('site/soc.html', array('links'=>$links));   
    }
    public function products_mortgage($links, $params){
        $this->View->render('site/products_mortgage.html', array('links'=>$links)); 
    }
    public function products_enterprise($links, $params){
        $this->View->render('site/products_enterprise.html', array('links'=>$links)); 
    }
    public function offices($links, $params){
        $states = State::get_instance()->all();
        $this->View->render('site/offices.html', array('links'=>$links, 'states'=>$states)); 
    }
    public function tips($links, $params){
        $this->View->render('site/tips.html', array('links'=>$links)); 
    }
    public function contact($links, $params){
        $this->View->render('site/contact.html', array('links'=>$links)); 
    }
    public function privacy(){

    }
    public function terms(){
    	
    }
}
