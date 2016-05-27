<?php

class AdminController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $csrf_token = Csrf::makeToken();
        $this->View->render('admin/login.html', array('csrf'=>$csrf_token));
    }
    public function sites(){
        $this->View->render('admin/sites.html');
    }
    public function consultant(){
        $this->View->render('consultant/single.html');
    }
    public function users(){
        $this->View->render('admin/users.html');
    }
}
