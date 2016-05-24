<?php

class ConsultantController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        //var_dump(Credentials::isUserLoggedIn());
        /*if(Credentials::isUserLoggedIn()){
            Redirect::to('consultant/byId');
        } else {
            Redirect::to('admin');
        }*/
    }

    public function requestPasswordReset(){

    }

    public function byId(){
        $this->View->render('consultant/single.html');
    }
}
