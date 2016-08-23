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
      $user_company = strip_tags(Request::post('user_company'));
      $user_password_new = strip_tags(Request::post('user_password'));

      Session::set('feedback_negative', array());
      $registration_successful = Credentials::registerNewUser($user_name, $user_email, $user_company, $user_password_new);
      if($registration_successful){
        $user = User::getInstance()->getDataByEmail($user_email);
        $site = Site::getInstance()->save($user->id, -1, NULL, $user_company, '', '', '', '', '', '', '', array(), array(), array(), 1);
        $mail_obj = new Mail();
        $mail_obj->sendMailWithPHPMailer($user_email, 'socialmedia@socasesores.com', 'SOC Asesores', 'Nuevo Micrositio', "Felicidades, te hemos creado un nuevo micrositio para " . $user_company . ". Para comenzar a utilizarlo puedes entrar a socasesores.com con las siguientes credenciales: \r\nEmail: " . $user_email . "\r\nPassword: " . $user_password_new);
        $mail_obj->sendMailWithPHPMailer('socialmedia@socasesores.com', 'socialmedia@socasesores.com', 'Micrositio :: ' . $user_email, 'Nuevo Micrositio', 'Se ha creado el micrositio matriz ' . $user_email . '.');
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

        if(Request::put('name')) $data['name'] = Request::put('name');
        if(Request::put('company')) $data['company'] = Request::put('company');
        if(Request::put('email')) $data['email'] = Request::put('email');   
        if( Request::put('password') && 
            Request::put('password') != '' 
            && Request::put('password') == Request::put('password_confirm')
        ) $data['password'] = password_hash(Request::put('password'), PASSWORD_DEFAULT);
        $id = User::getInstance()->setData($params['id'], $data);
        $this->View->renderJSON($this->success_code($id));
    }

    public function delete_user($params){
        $id = User::getInstance()->delete($params['id']);
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
        
        $user_name = strip_tags(Request::post('admin_name'));
        $user_email = strip_tags(Request::post('admin_email'));
        $user_company = strip_tags(Request::post('title'));
        $user_password = strip_tags(Request::post('admin_password'));

        $registration_successful = Credentials::registerNewUser($user_name, $user_email, $user_company, $user_password, 3);
        if(!$registration_successful){
            $this->View->renderJSON($this->error_code(Session::get('feedback_negative')));   
        }

        $user = User::getInstance()->getDataByEmail($user_email);
        $user_id = $user->id;
        $state_id = strip_tags(Request::post('state_id'));
        $site_id = strip_tags(Request::post('site_id'));
        $title = strip_tags(Request::post('title'));
        $content = strip_tags(Request::post('content'));
        $city =strip_tags(Request::post('city'));
        $settlement = strip_tags(Request::post('settlement'));
        $address = strip_tags(Request::post('address'));
        $latlon = strip_tags(Request::post('latlon'));
        $phones = strip_tags(Request::post('phones'));
        $emails = strip_tags(Request::post('emails'));
        $slider = array();
        $support_quotes = Request::post('support_quote');
        $support_images = Request::post('support_image');
        $registration_successful = Site::save($user_id, $state_id, $site_id, $title, $content, $city, $settlement, $address, $latlon, $phones, $emails, $slider, $support_quotes, $support_images, 2);
        if($registration_successful){
            $mail_obj = new Mail();
            $mail_obj->sendMailWithPHPMailer($user_email, 'socialmedia@socasesores.com', 'SOC Asesores', 'Nuevo Micrositio', "Felicidades, te hemos creado un nuevo micrositio para " . $title . ". Para comenzar a utilizarlo puedes entrar a socasesores.com con las siguientes credenciales: \r\nEmail: " . $user_email . "\r\nPassword: " . $user_password);
            $mail_obj->sendMailWithPHPMailer('socialmedia@socasesores.com', 'socialmedia@socasesores.com', 'Micrositio :: ' . $title, 'Nueva Sucursal', 'Se ha creado la nueva sucursal ' . $title . '.');
            $this->View->renderJSON($this->success_code($registration_successful));
        }else{
            $this->View->renderJSON($this->error_code(Session::get('feedback_negative'), array('redirect_to'=>$this->Routes['root_url'])));
        }
    }

    public function get_site($params){
        $site = Site::getInstance()->byId($params['id']);
        $this->View->renderJSON($this->success_code($site));
    }

    public function set_site($params){
        $data = array();
        $site = Site::getInstance()->byId($params['id']);
        $prev_support_quotes = explode('|', $site->support_quotes);
        $prev_support_images = explode('|', $site->support_images);
        if(Request::put('title')) $data['title'] = utf8_decode(Request::put('title'));
        if(Request::put('content')) $data['content'] = utf8_decode(Request::put('content'));
        if(Request::put('address')) $data['address'] = utf8_decode(Request::put('address'));
        if(Request::put('state_id')) $data['state_id'] = utf8_decode(Request::put('state_id'));
        if(Request::put('city')) $data['city'] = utf8_decode(Request::put('city'));
        if(Request::put('settlement')) $data['settlement'] = utf8_decode(Request::put('settlement'));
        if(Request::put('address')) $data['address'] = utf8_decode(Request::put('address'));
        if(Request::put('latlon')) $data['latlon'] = utf8_decode(Request::put('latlon'));
        if(Request::put('phones')) $data['phones'] = utf8_decode(Request::put('phones'));
        if(Request::put('emails')) $data['emails'] = utf8_decode(Request::put('emails'));
        if(Request::put('support_quote')){
            $support_quotes = Request::put('support_quote');
            $support_quotes[0] = $support_quotes[0] != null ? $support_quotes[0] : $prev_support_quotes[0];
            $support_quotes[1] = $support_quotes[1] != null ? $support_quotes[1] : $prev_support_quotes[1];
            $support_quotes[2] = $support_quotes[2] != null ? $support_quotes[2] : $prev_support_quotes[2];
            $data['support_quotes'] = implode('|', $support_quotes);
        }
        if(Request::put('support_image')) {
            $support_images = Request::put('support_image');
            $support_images[0] = $support_images[0] != null ? $support_images[0] : $prev_support_images[0];
            $support_images[1] = $support_images[1] != null ? $support_images[1] : $prev_support_images[1];
            $support_images[2] = $support_images[2] != null ? $support_images[2] : $prev_support_images[2];
            $data['support_images'] = implode('|', $support_images);
        }
        if(Request::put('origin') == "user"){
            $mail_obj = new Mail();
            $mail_obj->sendMailWithPHPMailer('socialmedia@socasesores.com', 'socialmedia@socasesores.com', 'Micrositio :: ' . $data['title'], 'Cambio en el micrositio', 'Se ha reportado un cambio en el micrositio ' . $data['title'] . '.');
        }
        $id = Site::getInstance()->setData($params['id'], $data);
        $this->View->renderJSON($this->success_code($id));
    }

    public function delete_site($params){
        $id = Site::getInstance()->delete($params['id']);
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
