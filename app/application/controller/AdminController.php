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
        $logged_in = Session::userIsLoggedIn();
        $this->View->render('admin/login.html', array('csrf'=>$csrf_token, 'logged_in'=>$logged_in));
    }
    public function sites(){
        $states = State::getInstance()->all();
        $users = User::getInstance()->all();
        foreach ($states as $key => $state) {
          $state->name = utf8_encode($state->name);
        }
        foreach ($users as $key => $user) {
          $user->name = utf8_encode($user->name);
        }
        $this->View->render('admin/sites.html', array('states'=>$states, 'users'=>$users));
    }
    public function consultant(){
        $this->View->render('consultant/single.html');
    }
    public function users(){
        $this->View->render('admin/users.html');
    }
}
