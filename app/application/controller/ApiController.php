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
        $this->View->renderJSON(array('version'=>'1.0'));
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

    public function users(){
        Session::set('feedback_negative', array());
        //if(!Auth::checkAdminAuthentication()){
        //    $this->View->renderJSON($this->error_code(Text::get('FEEDBACK_UNKNOWN_ADMIN'), array('redirect_to'=>$this->Routes['root_url'])));
        //}
        $users = (array) User::get_instance()->all();
        foreach ($users as $key => $user) {
            $users[$key] = (array) $user;
        }
        $this->View->renderJSON($this->success_code($users));
    }

    public function get_user($params){
        $user = User::get_instance()->by_id($params['id']);
        $this->View->renderJSON($this->success_code($user));
    }

    public function set_user($params){
        $data = array();
        if(Request::get('name')) $data['name'] = Request::get('name');
        if(Request::get('email')) $data['email'] = Request::get('email');

        $id = User::get_instance()->set_data($params['id'], $data);
        $this->View->renderJSON($this->success_code($id));
    }

    public function sites(){
        Session::set('feedback_negative', array());
        //if(!Auth::checkAdminAuthentication()){
        //    $this->View->renderJSON($this->error_code(Text::get('FEEDBACK_UNKNOWN_ADMIN'), array('redirect_to'=>$this->Routes['root_url'])));
        //}
        $sites = (array) Site::get_instance()->all();
        foreach ($sites as $key => $site) {
            $site->content = utf8_encode($site->content);
            $site->address = utf8_encode($site->address);
            $sites[$key] = (array) $site;
        }
        $this->View->renderJSON($this->success_code($sites));
    }

    public function new_site(){
        Session::set('feedback_negative', array());
        $registration_successful = Site::save();
        if($registration_successful){
            $this->View->renderJSON($this->success_code($registration_successful));
        }else{
            $this->View->renderJSON($this->error_code(Session::get('feedback_negative'), array('redirect_to'=>$this->Routes['root_url'])));
        }
    }

    public function get_site($params){
        $site = Site::get_instance()->by_url($params['url']);
        $site->content = utf8_encode($site->content);
        $site->address = utf8_encode($site->address);
        $this->View->renderJSON($this->success_code($site));
    }

    public function set_site($params){
        $data = array();
        if(Request::get('title')) $data['title'] = Request::get('title');
        if(Request::get('content')) $data['content'] = Request::get('content');
        if(Request::get('address')) $data['address'] = Request::get('address');
        if(Request::get('contact')) $data['contact'] = Request::get('contact');

        $id = Site::get_instance()->set_data($params['url'], $data);
        $this->View->renderJSON($this->success_code($id));
    }

    private function success_code($data){
        return array('status'=>200, 'data'=>$data);
    }

    private function error_code($errors, $data){
        return array('status'=>500, 'errors'=>$errors, 'data'=>$data);
    }
}
