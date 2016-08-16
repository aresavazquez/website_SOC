<?php

class IndexController extends Controller
{
  /**
  * Construct this object by extending the basic Controller class
  */
  public function __construct(){
    parent::__construct();
  }

  public function home(){
    $states = State::getInstance()->all();
    $this->View->render('site/index.html', array('states'=>$states));
  }
  public function soc(){
    $this->View->render('site/soc.html');
  }
  public function real_state(){
    $this->View->render('site/real_state.html');
  }
  public function franchise(){
    $this->View->render('site/franchise.html');
  }
  public function news(){
    $this->View->render('site/news.html');
  }
  public function products_mortgage(){
    $this->View->render('site/products_mortgage.html');
  }
  public function products_enterprise(){
    $this->View->render('site/products_enterprise.html');
  }
  public function offices(){
    $states = State::getInstance()->all();
    $this->View->render('site/offices.html', array('states'=>$states));
  }
  public function tips(){
    $this->View->render('site/tips.html');
  }
  public function contact(){
    $prospect = null;
    if(Request::get('prospect')){
      $prospect = Session::get('prospect');
      $paytime = $prospect['paytime'];
      $paytype = $prospect['paytype'];
    }
    $message = ($prospect) ? "Deseo recibir asesoría con respecto al esquema de mensualidad $paytype a $paytime años. \r\n\r\nGracias por su atención." : "";
    $this->View->render('site/contact.html', array('prospect'=>$prospect, 'message'=>$message));
  }
  public function post_contact(){
    $name = strip_tags(Request::post('contact_name'));
    $email = strip_tags(Request::post('contact_email'));
    $phone = strip_tags(Request::post('contact_phone'));
    $message = strip_tags(Request::post('contact_message'));
    $body = "Nombre: " . $name . "\r\nCorreo: " . $email . "\r\nTeléfono: " . $phone . "\r\nComentario: " . $message;

    $mail = new Mail;
    $mail_sent = $mail->sendMail(Config::get('EMAIL_CONTACT_RECEIVER'), $email, $name, 'Comentario de /contacto', $body);

    if ($mail_sent) {
        Session::add('feedback_positive', Text::get('FEEDBACK_VERIFICATION_MAIL_SENDING_SUCCESSFUL'));
    } else {
        Session::add('feedback_negative', Text::get('FEEDBACK_VERIFICATION_MAIL_SENDING_ERROR') . $mail->getError() );
    }
    Redirect::to('contacto');
  }
}
