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
        $site->title = utf8_encode($site->title);
        $site->address = utf8_encode($site->address);
        $site->content = ltrim(utf8_encode($site->content));
        $lat_lon = explode(',', $site->latlon);
        $this->View->render('broker/show.html', array('site' => $site, 'lat' => $lat_lon[0], 'lon' => $lat_lon[1]));
    }

    public function edit(){
        if(!Session::userIsLoggedIn()) Redirect::to('admin');
        $uid = Session::get('user_id');
        $user = User::getInstance()->byId($uid);
        $site = Site::getInstance()->byUser($uid);
        $states = State::getInstance()->all();
        foreach ($states as $key => $state) {
            $state->name = utf8_encode($state->name);
        }
        $site->title = utf8_encode($site->title);
        $site->address = utf8_encode($site->address);
        $site->content = ltrim(utf8_encode($site->content));
        $this->View->render('broker/edit.html', array('user' => $user, 'site' => $site, 'states' => $states, 'is_admin' => false));
    }

    public function contact($params){
        $site = Site::getInstance()->byUrl($params['url']);
        $mails = explode(',',$site->emails);
        $message = Request::post('message');
        $name = Request::post('name');
        $mail = Request::post('mail');
        $phone = Request::post('phone');
        $body = "Mensaje de $name:\n\r$message\n\rTeléfono: $phone\n\rMail: $mail";
        $mail_obj = new Mail();
        $mail_obj->sendMailWithPHPMailer($mails[0], $mail, $name, 'Informes SOC', $body);
        Redirect::to( $params['url'] );
    }
}
