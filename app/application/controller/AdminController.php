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
        if($logged_in && Session::get('user_role') >= 2) Redirect::to('admin/microsite');
        if($logged_in && Session::get('user_role') == 1) Redirect::to('admin/users');
        $this->View->render('admin/login.html', array('csrf'=>$csrf_token));
    }
    public function sites(){
        if(!Session::userIsLoggedIn()) Redirect::to('admin');
        $states = State::getInstance()->all();
        $users = User::getInstance()->all();
        foreach ($states as $key => $state) {
          $state->name = utf8_encode($state->name);
        }
        foreach ($users as $key => $user) {
          $user->name = utf8_encode($user->name);
        }
        $this->View->render('admin/sites.html', array('states'=>$states, 'users'=>$users, 'is_admin'=>true));
    }
    public function users(){
        if(!Session::userIsLoggedIn()) Redirect::to('admin');
        $this->View->render('admin/users.html', array('is_admin'=>true));
    }
    public function logout(){
        Session::destroy();
        Redirect::to('admin');
    }
}
