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
    Session::set('feedback_positive', array());
    Session::set('feedback_negative', array());
    if(Request::get('prospect')) $prospect = Session::get('prospect');
    $positive = (Session::get('feedback_positive')) ? join(',', Session::get('feedback_positive')) : "";
    $negative = (Session::get('feedback_negative')) ? join(',', Session::get('feedback_negative')) : "";
    $feedback = $positive != "" ? $positive : $negative;
    $this->View->render('site/contact.html', array('feedback'=>$feedback, 'prospect'=>$prospect));
  }
  public function post_contact(){
    $name = strip_tags(Request::post('contact_name'));
    $email = strip_tags(Request::post('contact_email'));
    $phone = strip_tags(Request::post('contact_phone'));
    $message = strip_tags(Request::post('contact_message'));
    $body = "Nombre: " . $name . "\r\nCorreo: " . $email . "\r\nTeléfono: " . $phone . "\r\nComentario: " . $message;

    $mail = new Mail;
    $mail_sent = $mail->sendMail(Config::get('EMAIL_CONTACT_RECEIVER'), $email, utf8_encode($name), 'Comentario de /contacto', $body);

    if ($mail_sent) {
        Session::add('feedback_positive', Text::get('FEEDBACK_CONTACT_MAIL_SENDING_SUCCESSFUL'));
    } else {
        Session::add('feedback_negative', Text::get('FEEDBACK_CONTACT_MAIL_SENDING_FAILED') . $mail->getError() );
    }
    Redirect::to('contacto');
  }
  public function error404(){
    $this->View->render('error/404.html');
  }
}
