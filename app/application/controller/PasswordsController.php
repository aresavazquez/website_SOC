<?php

class PasswordsController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $csrf_token = Csrf::makeToken();
        $this->View->render('password/index.html', array('csrf'=>$csrf_token));
    }
}
