<?php

class ApiController extends Controller{
    private $user;
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->View->renderJSON(array('version'=>'1.0'));
    }

    public function login(){
        Session::set('feedback_negative', array());
        $login_successful = Credentials::login(
            Request::post('user_email'), Request::post('user_password'), Request::post('set_remember_me_cookie')
        );
        if ($login_successful) {
            if (Request::post('redirect')) {
                $this->View->renderJSON($this->success_code(array('redirect_to'=>ltrim(urldecode(Request::post('redirect')), '/'))));
            } else {
                $this->View->renderJSON($this->success_code(Session::all()));
            }
        } else {
            $this->View->renderJSON($this->error_code(Session::get('feedback_negative'), array('redirect_to'=>$this->Routes['root_url'])));
        }
    }

    public function register(){
      $user_name = strip_tags(Request::post('user_name'));
      $user_email = strip_tags(Request::post('user_email'));
      $user_password_new = strip_tags(Request::post('user_password'));

      Session::set('feedback_negative', array());
      $registration_successful = Credentials::registerNewUser($user_name, $user_email, $user_password_new);
      if($registration_successful){
        $this->View->renderJSON($this->success_code($registration_successful));
      }else{
        $this->View->renderJSON($this->error_code(Session::get('feedback_negative'), array('redirect_to'=>$this->Routes['root_url'])));
      }
    }

    public function password_reset(){
      Session::set('feedback_positive', array());
      Session::set('feedback_negative', array());
      $user_email = strip_tags(Request::post('email'));
      $password_reset = Credentials::passwordReset($user_email);
      if($password_reset){
        $this->View->renderJSON($this->success_code(Session::get('feedback_positive')));
      }else{
        $this->View->renderJSON($this->error_code(Session::get('feedback_negative'), array('redirect_to'=>$this->Routes['root_url'])));
      }
    }

    public function brokers(){
         Session::set('feedback_negative', array());
         $brokers = (array) Site::getInstance()->byState(Request::post('state'));
         if(count($brokers) > 0){
            foreach ($brokers as $key => $broker) {
                $broker->title = utf8_encode($broker->title);
                $broker->content = utf8_encode($broker->content);
                $broker->address = utf8_encode($broker->address);
            }
            $this->View->renderJSON($this->success_code($brokers));
        }else{
            Session::add('feedback_negative', Text::get('BROKERS_NOT_FOUND'));
            $this->View->renderJSON($this->error_code(Session::get('feedback_negative'), array()));
        }
         
    }

    public function users(){
        Session::set('feedback_negative', array());
        //if(!Auth::checkAdminAuthentication()){
        //    $this->View->renderJSON($this->error_code(Text::get('FEEDBACK_UNKNOWN_ADMIN'), array('redirect_to'=>$this->Routes['root_url'])));
        //}
        $users = (array) User::getInstance()->all();
        foreach ($users as $key => $user) {
            $user->name = utf8_encode($user->name);
        }
        $this->View->renderJSON($this->success_code($users));
    }

    public function get_user($params){
        $user = User::getInstance()->byId($params['id']);
        $this->View->renderJSON($this->success_code($user));
    }

    public function set_user($params){
        $data = array();
        if(Request::get('name')) $data['name'] = Request::get('name');
        if(Request::get('email')) $data['email'] = Request::get('email');

        $id = User::getInstance()->setData($params['id'], $data);
        $this->View->renderJSON($this->success_code($id));
    }

    public function sites(){
        Session::set('feedback_negative', array());
        //if(!Auth::checkAdminAuthentication()){
        //    $this->View->renderJSON($this->error_code(Text::get('FEEDBACK_UNKNOWN_ADMIN'), array('redirect_to'=>$this->Routes['root_url'])));
        //}
        $sites = (array) Site::getInstance()->all();
        foreach ($sites as $key => $site) {
            $site->title = utf8_encode($site->title);
            $site->content = utf8_encode($site->content);
            $site->address = utf8_encode($site->address);
            $sites[$key] = (array) $site;
        }
        $this->View->renderJSON($this->success_code($sites));
    }

    public function new_site(){
        Session::set('feedback_negative', array());
        $user_id = strip_tags(Request::post('user_id'));
        $state_id = strip_tags(Request::post('state_id'));
        $url = strip_tags(Request::post('url'));
        $title = strip_tags(Request::post('title'));
        $content = strip_tags(Request::post('content'));
        $address = strip_tags(Request::post('address'));
        $contact = strip_tags(Request::post('contact'));
        $latlon = strip_tags(Request::post('latlon'));
        $registration_successful = Site::save($user_id, $state_id, $url, $title, $content, $address, $contact, $latlon);
        if($registration_successful){
            $this->View->renderJSON($this->success_code($registration_successful));
        }else{
            $this->View->renderJSON($this->error_code(Session::get('feedback_negative'), array('redirect_to'=>$this->Routes['root_url'])));
        }
    }

    public function get_site($params){
        $site = Site::getInstance()->byUrl($params['url']);
        $site->title = utf8_encode($site->title);
        $site->content = utf8_encode($site->content);
        $site->address = utf8_encode($site->address);
        $this->View->renderJSON($this->success_code($site));
    }

    public function set_site($params){
        $data = array();
        if(Request::get('title')) $data['title'] = utf8_decode(Request::get('title'));
        if(Request::get('content')) $data['content'] = utf8_decode(Request::get('content'));
        if(Request::get('address')) $data['address'] = utf8_decode(Request::get('address'));
        if(Request::get('contact')) $data['contact'] = utf8_decode(Request::get('contact'));
        if(Request::get('latlon')) $data['latlon'] = utf8_decode(Request::get('latlon'));

        $id = Site::getInstance()->setData($params['url'], $data);
        $this->View->renderJSON($this->success_code($id));
    }

    public function get_post($params){
        $post = Post::getInstance()->byId($params['id']);
        $this->View->renderJSON($this->success_code($post));
    }

    public function get_posts(){
        $post = Post::getInstance()->all();
        $this->View->renderJSON($this->success_code($post));
    }

    public function set_post($params){
        $data = array();
        if(Request::get('title')) $data['post_title'] = Request::get('title');
        if(Request::get('content')) $data['post_content'] = Request::get('content');

        $id = Post::getInstance()->setData($params['id'], $data);
        $this->View->renderJSON($this->success_code($id));
    }

    private function success_code($data){
        return array('status'=>200, 'data'=>$data);
    }

    private function error_code($errors, $data){
        return array('status'=>500, 'errors'=>$errors, 'data'=>$data);
    }
}
