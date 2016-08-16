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
        $this->View->render('admin/sites.html', array('states'=>$states, 'users'=>$users, 'is_admin'=>true));
    }
    public function users(){
        if(!Session::userIsLoggedIn()) Redirect::to('admin');
        if(Request::get('search')){
            $users = User::getInstance()->search(Request::get('search'));
        }else{
            $users = User::getInstance()->all();
        }
        $this->View->render('admin/users.html', array('users'=>$users, 'is_admin'=>true));
    }
    public function user_sites($params){
      if(!Session::userIsLoggedIn()) Redirect::to('admin');
      $user = User::getInstance()->byId($params['id_user']);
      $sites = Site::getInstance()->allFrom($params['id_user']);
      $states = State::getInstance()->all();
      $this->View->render('admin/user-sites.html', array('sites'=>$sites, 'states'=>$states, 'user'=>$user, 'is_admin'=>true));
    }
    public function logout(){
        Session::destroy();
        Redirect::to('admin');
    }
    public function blog(){
        $this->View->render('admin/post-list.html',array('is_admin'=>true));      
    }
}
