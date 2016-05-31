<?php

class ApiController extends Controller{
    private $user;
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
        //$this->user = new User();
    }

    public function index(){
        $this->View->renderJSON(array('version'=>'2.0'));
    }

    public function login(){
        //if (!Csrf::isTokenValid()) {
        //    User::logout();
        //}
        // perform the login method, put result (true or false) into $login_successful
        Session::set('feedback_negative', array());
        $login_successful = Credentials::login(
            Request::post('user_email'), Request::post('user_password'), Request::post('set_remember_me_cookie')
        );
        // check login status: if true, then redirect user to user/index, if false, then to login form again
        if ($login_successful) {
            if (Request::post('redirect')) {
                $this->View->renderJSON($this->success_code(array('redirect_to'=>ltrim(urldecode(Request::post('redirect')), '/'))));
                //Redirect::to(ltrim(urldecode(Request::post('redirect')), '/'));
            } else {
                $this->View->renderJSON($this->success_code(Session::all()));
                //Redirect::to('user/index');
            }
        } else {
            $this->View->renderJSON($this->error_code(Session::get('feedback_negative'), array('redirect_to'=>$this->Routes['root_url'])));
            //Redirect::to('login/index');
        }
    }

    public function register(){
        Session::set('feedback_negative', array());
        $registration_successful = Credentials::registerNewUser();
        if($registration_successful){
            $this->View->renderJSON($this->success_code($registration_successful));
        }else{
            $this->View->renderJSON($this->error_code(Session::get('feedback_negative'), array('redirect_to'=>$this->Routes['root_url'])));
        }
    }

    public function sitesNew(){
        Session::set('feedback_negative', array());
        $registration_successful = Site::save();
        if($registration_successful){
            $this->View->renderJSON($this->success_code($registration_successful));
        }else{
            $this->View->renderJSON($this->error_code(Session::get('feedback_negative'), array('redirect_to'=>$this->Routes['root_url'])));
        }
    }

    public function users(){
        Session::set('feedback_negative', array());
        /*if(!Auth::checkAdminAuthentication()){
            $this->View->renderJSON($this->error_code(Text::get('FEEDBACK_UNKNOWN_ADMIN'), array('redirect_to'=>$this->Routes['root_url'])));
        }*/
        $users = (array) User::get_instance()->all();
        foreach ($users as $key => $user) {
            $users[$key] = (array) $user;
        }
        $this->View->renderJSON($this->success_code(array('users'=> $users)));
    }

    public function sites(){
        Session::set('feedback_negative', array());
        //if(!Auth::checkAdminAuthentication()){
        //    $this->View->renderJSON($this->error_code(Text::get('FEEDBACK_UNKNOWN_ADMIN'), array('redirect_to'=>$this->Routes['root_url'])));
        //}
        $sites = (array) Site::get_instance()->all();
        foreach ($sites as $key => $site) {
            $sites[$key] = (array) $site;
        }
        $this->View->renderJSON($this->success_code(array('sites'=> $sites)));
    }

    private function success_code($data){
        return array('status'=>200, 'data'=>$data);
    }

    private function error_code($errors, $data){
        return array('status'=>500, 'errors'=>$errors, 'data'=>$data);
    }
}
