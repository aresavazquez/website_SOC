<?php

class ApiController extends Controller{
    private $user;
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
        $this->user = new User();
    }

    public function login(){
        if (!Csrf::isTokenValid()) {
            User::logout();
            Redirect::home();
            exit();
        }
        // perform the login method, put result (true or false) into $login_successful
        $login_successful = Login::login(
            Request::post('user_name'), Request::post('user_password'), Request::post('set_remember_me_cookie')
        );
        // check login status: if true, then redirect user to user/index, if false, then to login form again
        if ($login_successful) {
            if (Request::post('redirect')) {
                Redirect::to(ltrim(urldecode(Request::post('redirect')), '/'));
            } else {
                Redirect::to('user/index');
            }
        } else {
            Redirect::to('login/index');
        }
    }
}
