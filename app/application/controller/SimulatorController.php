<?php

class SimulatorController extends Controller
{
  /**
   * Construct this object by extending the basic Controller class
   */
  public function __construct(){
    parent::__construct();
  }

  public function index(){
    $this->View->render('simulator/index.html');
  }

  public function calculate(){
    $amount = Request::get('value') ? Request::get('value') : 1000000;
    $hitch = Request::get('hitch') ? Request::get('hitch') : 200000;

    if(Request::get('paytype') == 'fija'){
      if(Request::get('paytime') == 15){
        $afirme =   $this->fixed15($amount, 0.6999, 10.53, 0.098, 0.106, 0.8, 0.06931, 0.98, 98, 199, 70.17, 2.5, true, 0.003596, 0.01, 0.06, $hitch);
        $banamex =  $this->fixed15($amount, 0.6, 9.85, 0.085, 0.11, 0.5, 0.24, 0, 0, 0, 0, 2.5, false, 'banamex', 0.01, 0.06, $hitch);
        $banorte = $this->fixed15($amount, 0.7, 9.9, 0.0874, 0.116, 0.52, 0.31931, 0, 0, 499, 0, 2, false, 0.00348, 0.01, 0.06, $hitch);
        $hsbc = $this->fixed15($amount, 0.75, 9.45, 0.1005, 0.117, 0.255, 0.228, 0, 0, 348, 0, 2, true, 'hsbc', 0, 0.06, $hitch);
        $santander = $this->fixed15($amount, 0.9, 11.028, 0.0991, 0.118, 31.54, 0.3376, 0, 0, 406, 0, 2.5, true, 0.00275, 0.01, 0.06, $hitch, 0, true);
        $scotiabank = $this->fixed15($amount, 0.9, 11.15, 0.1, 0.116, 0.5, 0.3016, 0, 0, 0, 0, 2.6, false, 'scotiabank', 0, 0.06, $hitch);
      }else{
        $afirme =   $this->fixed20($amount, 0.8, 9.9858, 0.1055, 0.1225, 0.8, 0.06931, 0.98, 98, 199, 70.62, 2.5, true, 0.0035728, 0.0116, 0.06, $hitch);
        $banamex =  $this->fixed20($amount, 0.6, 8.68, 0.085, 0.145, 0.5, 0.24, 0, 0, 0, 0, 2.61, false, 'banamex', 0.01, 0.06, $hitch, 0);
        $banorte = $this->fixed20($amount, 0.7, 8.73722, 0.0848, 0.129, 0.52, 0.31931, 0, 0, 499, 0, 2, false, 0.00116, 0.01, 0.06, $hitch, 0);
        $hsbc = $this->fixed20($amount, 0.75, 9.45, 0.1005, 0.097, 0.255, 0.228, 0, 0, 348, 0, 2.5, false, 'hsbc', 0, 0.06, $hitch, 0);
        $santander = $this->fixed20($amount, 0.9, 10.330, 0.1026, 0.117, 31.54, 0.3376, 0, 0, 406, 0, 2.5, true, 0.00319, 0.01, 0.06, $hitch, 0, true);
        $scotiabank = $this->fixed20($amount, 0.9, 10.10, 0.10, 0.116, 0.5, 0.3016, 0, 0, 0, 0, 2.5703573901, false, 'scotiabank', 0, 0.06, $hitch, 0);
      }
    }else{
      if(Request::get('paytime') == 15){
        $afirme = $this->grow15($amount, 0.6999, 8.72199, 0.098, 0.1044, 0.8, 0.06931, 0.98, 98, 199, 68.18, 2.5, true, 0.0035728, 0.01, 0.06, $hitch, 0);
        $banamex = $this->grow15(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
        $banorte = $this->grow15($amount, 0.9, 8.9, 0.0899, 0.121, 0.52, 0.41054, 0, 0, 0, 0, 2, false, 0.00116, 0.01, 0.06, $hitch);
        $hsbc = $this->grow15($amount, 0.75, 9.61, 0.0975, 0.098, 0.255, 0.228, 0, 348, 0, 0, 3.03, false, 'hsbc', 0, 0.06, $hitch);
        $santander = $this->grow15($amount, 0.9, 9.6552, 0.091, 0.118, 31.54, 0.3376, 0, 0, 0, 0, 2.2941305511, false, 2.75, 0.01, 0.06, $hitch, 0, true);
        $scotiabank = $this->grow15($amount, 0.9, 9.06, 0.0875, 0.107, 0.5, 0.3016, 0, 0, 0, 0, 2.6, false, 'scotiabank', 0.0125, 0.06, $hitch);
      }else{
        $afirme = $this->grow20($amount, 0.8, 9.095, 0.1055, 0.1218, 0.8, 0.06931, 0.98, 98, 199, 69.51, 2.5, true, 0.003596, 0.01, 0.06, $hitch);
        $banamex = $this->grow20(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
        $banorte = $this->grow20($amount, 0.9, 7.6, 0.0899, 0.118, 0.52, 0.41054, 0, 0, 299, 0, 2, false, 0.00116, 0.01, 0.06, $hitch);
        $hsbc = $this->grow20($amount, 0.75, 8.40, 0.0975, 0.098, 0.255, 0.228, 0, 0, 348, 0, 3.0304, false, 'hsbc', 0, 0.06, $hitch);
        $santander = $this->grow20($amount, 0.9, 9.51, 0.1026, 0.117, 31.54, 0.3376, 0, 0, 0, 0, 2.5, true, 0.00275, 0.01, 0.06, $hitch, 0, true);
        $scotiabank = $this->grow20($amount, 0.90, 7.92, 0.0875, 0.107, 0.5, 0.3016, 0, 0, 0, 0, 2.7075492331, false, 'scotiabank', 0.0125, 0.06, $hitch);
      }
    }

    $banks = array(
      'afirme' => $afirme,
      'banamex' => $banamex,
      'banorte' => $banorte,
      'hsbc' => $hsbc,
      'santander' => $santander,
      'scotiabank' => $scotiabank
    );
    
    $prospect = array(
      'name' => Request::get('name'),
      'state' => State::getInstance()->byId(Request::get('state'))->name,
      'phone' => Request::get('phone'),
      'mail' => Request::get('mail'),
      'value' => Request::get('value'),
      'hitch' => Request::get('hitch'),
      'paytype' => Request::get('paytype'),
      'paytime' => Request::get('paytime')
    );

    Session::set('prospect', $prospect);
    
    $mail = new Mail;
    $body = $this->View->render_string('mailer/simulator.html', array('banks'=>$banks, 'paytype'=>Request::get('paytype'), 'paytime'=>Request::get('paytime')));
    $admin_body = $this->View->render_string('mailer/admin_simulator.html', array('prospect'=>$prospect));
    if(Request::get('micrositio')){
      $mail->sendMail(Config::get('EMAIL_FROM_SITES_SIMULATOR'), Config::get('EMAIL_CONTACT_FROM_EMAIL'), 'Simulador SOC', 'Resultado //del Simulador', $admin_body);
    }else{
      $mail->sendMail(Config::get('EMAIL_FROM_INDEX_SIMULATOR'), Config::get('EMAIL_CONTACT_FROM_EMAIL'), 'Simulador SOC', 'Resultado //del Simulador', $admin_body);
    }
    $mail_sent = $mail->sendMail(Request::get('mail'), Config::get('EMAIL_CONTACT_FROM_EMAIL'), 'SOC Asesores', 'Resultado del Simulador', $body);
    $this->View->render('simulator/calculator.html', array('banks'=>$banks, 'paytype'=>Request::get('paytype'), 'paytime'=>Request::get('paytime')));
  }
  
  private function grow15(
    $valor, $factor_aforo, $factor_pago, $interes, $cat, 
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
    if(!$valor) {
      return array(
        'comision' => 'N/A',
        'mensualidad' => 'N/A',
        'monto' => 'N/A', 
        'prima_unica' => 'N/A',
        'tasa_interes' => 'N/A', 
        'ingreso_requerido' => 'N/A',
        'cat' => 'N/A',
        'enganche' => 'N/A',
        'enganche_adicional' => 'N/A',
        'avaluo' => 'N/A',
        'comision_apertura' => 'N/A',
        'gastos_notario' => 'N/A',
        'total' => 'N/A'
      );
    }

    $factor_gastos_notario = $this->notarial(Request::get('state'));

    $monto_bruto = $valor - $enganche;

    $aforo = $valor * $factor_aforo;
    
    $monto = $aforo > $monto_bruto ? $monto_bruto : $aforo;
    
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
    
    //if($enganche <= 0) $enganche = $valor - $monto;
    $enganche = $enganche > ($valor - $monto) ? $enganche : ($valor - $monto);

    switch($factor_avaluo){
      case 'hsbc':
      $avaluo = $this->avaluo_hsbc($valor);
      break;
      case 'scotiabank':
      $avaluo = $this->avaluo_scotiabank($valor);
      break;
      case 'banamex':
      $avaluo = $this->avaluo_banamex($valor);
      break;
      default:
      $avaluo = $factor_avaluo * $valor;
    }
    if($prima_unica){
      $apertura = $prima_unica * $factor_apertura;
    }else{
      $apertura = $monto * $factor_apertura;  
    }
    $gastos_notario = $valor * $factor_gastos_notario;
    $total = $enganche + $avaluo + $apertura + $gastos_notario;
    return array(
      'comision' => $comision > 0 ? '$'.number_format($comision, 2) : 'N/A',
      'mensualidad' => '$'.number_format($mensualidad, 2),
      'monto' => '$'.number_format($monto, 2), 
      'prima_unica' => $prima_unica ? '$'.number_format($prima_unica, 2) : 'N/A',
      'tasa_interes' => number_format($interes * 100, 2).'%', 
      'ingreso_requerido' => '$'.number_format($ingreso, 2),
      'cat' => number_format($cat * 100, 2).'%',
      'enganche' => '$'.number_format($enganche, 2),
      'enganche_adicional' => '$'.number_format($enganche_adicional, 2),
      'avaluo' => '$'.number_format($avaluo, 2),
      'comision_apertura' => '$'.number_format($apertura, 2),
      'gastos_notario' => '$'.number_format($gastos_notario, 2),
      'total' => '$'.number_format($total, 2)
    );
  }

  private function grow20(
    $valor, $factor_aforo, $factor_pago, $interes, $cat, 
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
    if(!$valor) {
      return array(
        'comision' => 'N/A',
        'mensualidad' => 'N/A',
        'monto' => 'N/A', 
        'prima_unica' => 'N/A',
        'tasa_interes' => 'N/A', 
        'ingreso_requerido' => 'N/A',
        'cat' => 'N/A',
        'enganche' => 'N/A',
        'enganche_adicional' => 'N/A',
        'avaluo' => 'N/A',
        'comision_apertura' => 'N/A',
        'gastos_notario' => 'N/A',
        'total' => 'N/A'
      );
    }

    $factor_gastos_notario = $this->notarial(Request::get('state'));

    $monto_bruto = $valor - $enganche;

    $aforo = $valor * $factor_aforo;
    
    $monto = $aforo > $monto_bruto ? $monto_bruto : $aforo;
    
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
    
    //if($enganche <= 0) $enganche = $valor - $monto;
    $enganche = $enganche > ($valor - $monto) ? $enganche : ($valor - $monto);
    
    switch($factor_avaluo){
      case 'hsbc':
      $avaluo = $this->avaluo_hsbc($valor);
      break;
      case 'scotiabank':
      $avaluo = $this->avaluo_scotiabank($valor);
      break;
      case 'banamex':
      $avaluo = $this->avaluo_banamex($valor);
      break;
      default:
      $avaluo = $factor_avaluo * $valor;
    }
    
    $apertura = $monto * $factor_apertura;
    $gastos_notario = $valor * $factor_gastos_notario;
    $total = $enganche + $avaluo + $apertura + $gastos_notario;
    return array(
      'comision' => $comision > 0 ? '$'.number_format($comision, 2) : 'N/A',
      'mensualidad' => '$'.number_format($mensualidad, 2),
      'monto' => '$'.number_format($monto, 2), 
      'prima_unica' => $prima_unica ? '$'.number_format($prima_unica, 2) : 'N/A',
      'tasa_interes' => number_format($interes * 100, 2).'%', 
      'ingreso_requerido' => '$'.number_format($ingreso, 2),
      'cat' => number_format($cat * 100, 2).'%',
      'enganche' => '$'.number_format($enganche, 2),
      'enganche_adicional' => '$'.number_format($enganche_adicional, 2),
      'avaluo' => '$'.number_format($avaluo, 2),
      'comision_apertura' => '$'.number_format($apertura, 2),
      'gastos_notario' => '$'.number_format($gastos_notario, 2),
      'total' => '$'.number_format($total, 2)
    );
  }

  private function fixed15(
    $valor, $factor_aforo, $factor_pago, $interes, $cat, 
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

    $factor_gastos_notario = $this->notarial(Request::get('state'));

    $monto_bruto = $valor - $enganche;

    $aforo = $valor * $factor_aforo;
    
    $monto = $aforo > $monto_bruto ? $monto_bruto : $aforo;
    
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
    
    //if($enganche <= 0) $enganche = $valor - $monto;
    $enganche = $enganche > ($valor - $monto) ? $enganche : ($valor - $monto);
    
    switch($factor_avaluo){
      case 'hsbc':
      $avaluo = $this->avaluo_hsbc($valor);
      break;
      case 'scotiabank':
      $avaluo = $this->avaluo_scotiabank($valor);
      break;
      case 'banamex':
      $avaluo = $this->avaluo_banamex($valor);
      break;
      default:
      $avaluo = $factor_avaluo * $valor;
    }
    if($prima_unica){
      $apertura = $prima_unica * $factor_apertura;
    }else{
      $apertura = $monto * $factor_apertura;  
    }
    $gastos_notario = $valor * $factor_gastos_notario;
    $total = $enganche + $avaluo + $apertura + $gastos_notario;
    return array(
      'comision' => $comision > 0 ? '$'.number_format($comision, 2) : 'N/A',
      'mensualidad' => '$'.number_format($mensualidad, 2),
      'monto' => '$'.number_format($monto, 2), 
      'prima_unica' => $prima_unica ? '$'.number_format($prima_unica, 2) : 'N/A',
      'tasa_interes' => number_format($interes * 100, 2).'%', 
      'ingreso_requerido' => '$'.number_format($ingreso, 2),
      'cat' => number_format($cat * 100, 2).'%',
      'enganche' => '$'.number_format($enganche, 2),
      'enganche_adicional' => '$'.number_format($enganche_adicional, 2),
      'avaluo' => '$'.number_format($avaluo, 2),
      'comision_apertura' => '$'.number_format($apertura, 2),
      'gastos_notario' => '$'.number_format($gastos_notario, 2),
      'total' => '$'.number_format($total, 2)
    );
  }

  private function fixed20(
    $valor, $factor_aforo, $factor_pago, $interes, $cat, 
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

    $factor_gastos_notario = $this->notarial(Request::get('state'));
    
    $monto_bruto = $valor - $enganche;

    $aforo = $valor * $factor_aforo;
    
    $monto = $aforo > $monto_bruto ? $monto_bruto : $aforo;
    
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
    
    //if($enganche <= 0) $enganche = $valor - $monto;
    $enganche = $enganche > ($valor - $monto) ? $enganche : ($valor - $monto);
    
    switch($factor_avaluo){
      case 'hsbc':
      $avaluo = $this->avaluo_hsbc($valor);
      break;
      case 'scotiabank':
      $avaluo = $this->avaluo_scotiabank($valor);
      break;
      case 'banamex':
      $avaluo = $this->avaluo_banamex($valor);
      break;
      default:
      $avaluo = $factor_avaluo * $valor;
    }
    
    $apertura = $monto * $factor_apertura;
    $gastos_notario = $valor * $factor_gastos_notario;
    $total = $enganche + $avaluo + $apertura + $gastos_notario;
    return array(
      'comision' => $comision > 0 ? '$'.number_format($comision, 2) : 'N/A',
      'mensualidad' => '$'.number_format($mensualidad, 2),
      'monto' => '$'.number_format($monto, 2), 
      'prima_unica' => $prima_unica ? '$'.number_format($prima_unica, 2) : 'N/A',
      'tasa_interes' => number_format($interes * 100, 2).'%', 
      'ingreso_requerido' => '$'.number_format($ingreso, 2),
      'cat' => number_format($cat * 100, 2).'%',
      'enganche' => '$'.number_format($enganche, 2),
      'enganche_adicional' => '$'.number_format($enganche_adicional, 2),
      'avaluo' => '$'.number_format($avaluo, 2),
      'comision_apertura' => '$'.number_format($apertura, 2),
      'gastos_notario' => '$'.number_format($gastos_notario, 2),
      'total' => '$'.number_format($total, 2)
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

  private function avaluo_banamex($amount){
    if($amount > 15000000) return false;
    if($amount > 8000000) return 15000;
    if($amount > 5000000) return 10000;
    if($amount > 3000000) return 7000;
    if($amount > 1000000) return 5000;
    if($amount > 650000) return 3000;
    if($amount > 1) return 3000;
    if($amount <= 0) return 0;
  }

  private function notarial($state_id){
    $expenses = [
    0.04, 0.06, 0.05, 0.04, 0.05, 0.04, 0.04, 0.06, 0.1, 0.06, 
    0.03, 0.03, 0.1, 0.05, 0.09, 0.04, 0.04, 0.06, 0.04, 0.02, 
    0.06, 0.04, 0.04, 0.04, 0.07, 0.04, 0.06, 0.05, 0.08, 0.02,
    0.04, 0.03];
    return $expenses[$state_id - 1];
  }
}
