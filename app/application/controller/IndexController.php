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
    $this->View->render('site/index.html');
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
    $this->View->render('site/contact.html');
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
  public function simulator(){
    $amount = 1000000;
    //$afirme =   $this->fixed20($amount, 0.8, 9.9858, 10.55, 12.25, 0.8, 0.06931, 0.98, 98, 199, 70.62, 2.5, true, 0.0035728, 0.0116, 0.06);
    //$banamex =  $this->fixed20($amount, 0.6, 8.68, 8.5, 14.50, 0.5, 0.24, 0, 0, 0, 0, 2.61, false, 0.0003, 0.01, 0.06, 200000, 200000);
    //$banorte = $this->fixed20($amount, 0.7, 8.73722, 8.48, 12.90, 0.52, 0.31931, 0, 0, 499, 0, 2, false, 0.0029, 0.01, 0.06, 360000, 180000);
    //$hsbc = $this->fixed20($amount, 0.75, 8.647, 8.45, 9.70, 0.255, 0.228, 0, 0, 0, 0, 2.5, false, 'hsbc', 0, 0.06, 266600, 66650);
    //$santander = $this->fixed20($amount, 0.9, 9.39, 9.6, 11.70, 31.54, 0.3376, 0, 0, 350, 56, 2.5, true, 0.00319, 0.01, 0.06, 0, 0, true);
    //$scotiabank = $this->fixed20($amount, 0.65, 8.64, 10, 11.60, 0.5, 0.3016, 0, 0, 0, 0, 2.5703573901, false, 'scotiabank', 0, 0.06, 300000, 225000);

    $afirme =   $this->fixed15($amount, 0.6999, 10.53, 9.8, 10.6, 0.8, 0.06931, 0.98, 98, 199, 70.17, 2.5, true, 0.003596, 0.01, 0.06);
    $banamex =  $this->fixed15($amount, 0.6, 9.85, 8.5, 11, 0.5, 0.24, 0, 0, 0, 0, 2.5, false, 0.0003, 0.01, 0.06, 200000, 200000);
    $banorte = $this->fixed15($amount, 0.7, 9.9, 8.74, 11.60, 0.52, 0.31931, 0, 0, 499, 0, 2, false, 0.0029, 0.01, 0.06, 360000, 540000);
    $hsbc = $this->fixed15($amount, 0.75, 8.647, 8.45, 9.70, 0.255, 0.228, 0, 0, 0, 0, 2.5, false, 'hsbc', 0, 0.06, 266600, 66650);
    $santander = $this->fixed15($amount, 0.9, 9.39, 9.6, 11.70, 31.54, 0.3376, 0, 0, 350, 56, 2.5, true, 0.00319, 0.01, 0.06, 0, 0, true);
    $scotiabank = $this->fixed15($amount, 0.65, 8.64, 10, 11.60, 0.5, 0.3016, 0, 0, 0, 0, 2.5703573901, false, 'scotiabank', 0, 0.06, 300000, 225000);
    $banks = array(
      'afirme' => $afirme,
      'banamex' => $banamex,
      'banorte' => $banorte,
      'hsbc' => $hsbc,
      'santander' => $santander,
      'scotiabank' => $scotiabank
    );
    $this->View->render('site/simulator.html', array('banks'=>$banks));
  }

  private function fixed15(
    $valor, $aforo, $factor_pago, $interes, $cat, 
    $factor_seguro_vida, 
    $factor_seguro_danos,
    $factor_seguro_desempleo,
    $fijo_seguro_desempleo,
    $comision,
    $iva,
    $factor_ingreso,
    $mensualidad_bruta,
    $factor_avaluo,
    $factor_apertura,
    $factor_gastos_notario,
    $enganche = 0,
    $enganche_adicional = 0,
    $show_prima_unica = false
    ){
    $monto = $valor * $aforo;
    
    $pago_seguro_vida = $monto * $factor_seguro_vida / 1000;
    
    $prima_unica = $show_prima_unica ? $monto + $pago_seguro_vida : null;
    
    $pago_seguro_danos = $valor * $factor_seguro_danos / 1000;
    
    if($prima_unica){
      $pago_mensual_bruto = $prima_unica * $factor_pago / 1000;
    }else{
      $pago_mensual_bruto = $monto * $factor_pago / 1000;
    }
    
    $pago_seguro_desempleo = $pago_mensual_bruto * $factor_seguro_desempleo / 100 + $fijo_seguro_desempleo;
    
    if($prima_unica){
      $mensualidad = $pago_mensual_bruto + $comision + $pago_seguro_danos + $pago_seguro_desempleo + $iva;
    }else{
      $mensualidad = $pago_mensual_bruto + $comision + $pago_seguro_danos + $pago_seguro_vida + $pago_seguro_desempleo + $iva;
    }
    
    if($mensualidad_bruta){
      $ingreso = $pago_mensual_bruto  * $factor_ingreso;
    }else{
      $ingreso = $mensualidad * $factor_ingreso;
    }
    
    if($enganche <= 0) $enganche = $valor - $monto;
    
    switch($factor_avaluo){
      case 'hsbc':
      $avaluo = $this->avaluo_hsbc($valor);
      break;
      case 'scotiabank':
      $avaluo = $this->avaluo_scotiabank($valor);
      break;
      default:
      $avaluo = $factor_avaluo * $valor;
    }
    
    $apertura = $monto * $factor_apertura;
    $gastos_notario = $valor * $factor_gastos_notario;
    $total = $enganche + $avaluo + $apertura + $gastos_notario;
    return array(
      'comision' => $comision,
      'mensualidad' => $mensualidad,
      'monto' => $monto, 
      'prima_unica' => $prima_unica,
      'tasa_interes' => $interes, 
      'ingreso_requerido' => $ingreso,
      'cat' => $cat,
      'enganche' => $enganche,
      'enganche_adicional' => $enganche_adicional,
      'avaluo' => $avaluo,
      'comision_apertura' => $apertura,
      'gastos_notario' => $gastos_notario,
      'total' => $total
    );
  }

  private function fixed20(
    $valor, $aforo, $factor_pago, $interes, $cat, 
    $factor_seguro_vida, 
    $factor_seguro_danos,
    $factor_seguro_desempleo,
    $fijo_seguro_desempleo,
    $comision,
    $iva,
    $factor_ingreso,
    $mensualidad_bruta,
    $factor_avaluo,
    $factor_apertura,
    $factor_gastos_notario,
    $enganche = 0,
    $enganche_adicional = 0,
    $show_prima_unica = false
    ){
    $monto = $valor * $aforo;
    
    $pago_seguro_vida = $monto * $factor_seguro_vida / 1000;
    
    $prima_unica = $show_prima_unica ? $monto + $pago_seguro_vida : null;
    
    $pago_seguro_danos = $valor * $factor_seguro_danos / 1000;
    
    if($prima_unica){
      $pago_mensual_bruto = $prima_unica * $factor_pago / 1000;
    }else{
      $pago_mensual_bruto = $monto * $factor_pago / 1000;
    }
    
    $pago_seguro_desempleo = $pago_mensual_bruto * $factor_seguro_desempleo / 100 + $fijo_seguro_desempleo;
    
    if($prima_unica){
      $mensualidad = $pago_mensual_bruto + $comision + $pago_seguro_danos + $pago_seguro_desempleo + $iva;
    }else{
      $mensualidad = $pago_mensual_bruto + $comision + $pago_seguro_danos + $pago_seguro_vida + $pago_seguro_desempleo + $iva;
    }
    
    if($mensualidad_bruta){
      $ingreso = $pago_mensual_bruto  * $factor_ingreso;
    }else{
      $ingreso = $mensualidad * $factor_ingreso;
    }
    
    if($enganche <= 0) $enganche = $valor - $monto;
    
    switch($factor_avaluo){
      case 'hsbc':
      $avaluo = $this->avaluo_hsbc($valor);
      break;
      case 'scotiabank':
      $avaluo = $this->avaluo_scotiabank($valor);
      break;
      default:
      $avaluo = $factor_avaluo * $valor;
    }
    
    $apertura = $monto * $factor_apertura;
    $gastos_notario = $valor * $factor_gastos_notario;
    $total = $enganche + $avaluo + $apertura + $gastos_notario;
    return array(
      'comision' => $comision,
      'mensualidad' => $mensualidad,
      'monto' => $monto, 
      'prima_unica' => $prima_unica,
      'tasa_interes' => $interes, 
      'ingreso_requerido' => $ingreso,
      'cat' => $cat,
      'enganche' => $enganche,
      'enganche_adicional' => $enganche_adicional,
      'avaluo' => $avaluo,
      'comision_apertura' => $apertura,
      'gastos_notario' => $gastos_notario,
      'total' => $total
    );
  }

  private function avaluo_hsbc($amount){
    if($amount > 6000000) return 17500;
    if($amount > 5750000) return 15500;
    if($amount > 5500000) return 15000;
    if($amount > 5250000) return 14000;
    if($amount > 5000000) return 13750;
    if($amount > 4750000) return 13100;
    if($amount > 4500000) return 12450;
    if($amount > 4250000) return 11800;
    if($amount > 4000000) return 11150;
    if($amount > 3750000) return 10500;
    if($amount > 3500000) return 9850;
    if($amount > 3250000) return 9200;
    if($amount > 3000000) return 8550;
    if($amount > 2750000) return 7900;
    if($amount > 2500000) return 7250;
    if($amount > 2250000) return 6000;
    if($amount > 2000000) return 5950;
    if($amount > 1750000) return 5300;
    if($amount > 1500000) return 4050;
    if($amount > 1250000) return 4000;
    if($amount > 1000000) return 3350;
    if($amount > 750000) return 2700;
    if($amount > 500000) return 2050;
    if($amount > 350000) return 1450;
    if($amount > 250000) return 1000;
    if($amount > 0) return 800;
    if($amount <= 0) return 0;
  }

  private function avaluo_scotiabank($amount){
    if($amount > 30000000) return false;
    if($amount > 25000000) return 30000;
    if($amount > 20000000) return 27500;
    if($amount > 15000000) return 26000;
    if($amount > 11000000) return 21000;
    if($amount > 8000000) return 19800;
    if($amount > 5000000) return 17200;
    if($amount > 4000000) return 12300;
    if($amount > 3000000) return 9600;
    if($amount > 2000000) return 6700;
    if($amount > 1000000) return 4000;
    if($amount > 500000) return 2500;
    if($amount > 1) return 1800;
    if($amount <= 0) return 0;
  }
}
