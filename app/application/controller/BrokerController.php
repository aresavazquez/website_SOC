<?php

class BrokerController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }

    public function show($params){
        $site = Site::getInstance()->byUrl($params['url']);
        if(!$site) Redirect::to('404');

        $lat_lon = explode(',', $site->latlon);
        $slider = $site->slider != "" ? explode('|', $site->slider) : null;


        $support_images = explode('|', $site->support_images);
        $support_quotes = explode('|', $site->support_quotes);
        $support = array('images'=>$support_images, 'quotes'=>$support_quotes);

        $states = State::getInstance()->all();

        Session::set('feedback_positive', array());
        $feedback = (Session::get('feedback_positive')) ? join(',', Session::get('feedback_positive')) : "";

        $this->View->render('broker/show.html', array('site'=>$site, 'states'=>$states, 'slider'=>$slider, 'support'=>$support, 'lat'=>$lat_lon[0], 'lon'=>$lat_lon[1], 'feedback'=>$feedback));
    }

    public function edit(){
        if(!Session::userIsLoggedIn()) Redirect::to('admin');
        $uid = Session::get('user_id');
        $user = User::getInstance()->byId($uid);
        $site = Site::getInstance()->byUser($uid);
        $branches = Site::getInstance()->allFrom($site->id);
        $states = State::getInstance()->all();
        $this->View->render('broker/edit.html', array('user'=>$user, 'site'=>$site, 'branches'=>$branches, 'states'=>$states, 'is_admin'=>false));
    }

    public function contact($params){
        $site = Site::getInstance()->byUrl($params['url']);
        $mails = explode(',', $site->emails);
        $message = Request::post('message');
        $name = Request::post('name');
        $mail = Request::post('mail');
        $phone = Request::post('phone');
        $body = "Mensaje de $name:\n\r$message\n\rTeléfono: $phone\n\rMail: $mail";
        $body_user = "Hemos recibido tu comentario, nos pondremos en contacto contigo a la brevedad.";
        $mail_obj = new Mail();
        $mail_obj->sendMailWithPHPMailer($mails[0], $mail, $name, 'Informes SOC', $body);
        $mail_obj->sendMailWithPHPMailer($mail, $mail, $name, 'Informes SOC', $body_user);
        Session::add('feedback_positive', Text::get('FEEDBACK_CONTACT_MAIL_SENDING_SUCCESSFUL'));
        Redirect::to( $params['url'] );
    }
}
