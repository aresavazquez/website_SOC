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
    if(Request::get('paytype') == 'fija'){
      if(Request::get('paytime') == 15){
        $afirme =   $this->fixed15($amount, 0.6999, 10.53, 9.8, 10.6, 0.8, 0.06931, 0.98, 98, 199, 70.17, 2.5, true, 0.003596, 0.01, 0.06);
        $banamex =  $this->fixed15($amount, 0.6, 9.85, 8.5, 11, 0.5, 0.24, 0, 0, 0, 0, 2.5, false, 0.003, 0.01, 0.06, 200000, 200000);
        $banorte = $this->fixed15($amount, 0.7, 9.9, 8.74, 11.60, 0.52, 0.31931, 0, 0, 499, 0, 2, false, 0.00348, 0.01, 0.06, 360000, 540000);
        $hsbc = $this->fixed15($amount, 0.75, 9.818, 10.10, 11.70, 0.255, 0.228, 0, 0, 0, 0, 2, true, 'hsbc', 0, 0.06, 266600, 66650);
        $santander = $this->fixed15($amount, 0.9, 10.5, 9.6, 11.80, 31.54, 0.3376, 0, 0, 406, 0, 2.5, true, 0.00275, 0.01, 0.06, 0, 0, true);
        $scotiabank = $this->fixed15($amount, 0.65, 9.75, 8.2, 11.60, 0.5, 0.3016, 0, 0, 0, 0, 2.6, false, 'scotiabank', 0, 0.06, 350000);
      }else{
        $afirme =   $this->fixed20($amount, 0.8, 9.9858, 10.55, 12.25, 0.8, 0.06931, 0.98, 98, 199, 70.62, 2.5, true, 0.0035728, 0.0116, 0.06);
        $banamex =  $this->fixed20($amount, 0.6, 8.68, 8.5, 14.50, 0.5, 0.24, 0, 0, 0, 0, 2.61, false, 0.0003, 0.01, 0.06, 200000, 200000);
        $banorte = $this->fixed20($amount, 0.7, 8.73722, 8.48, 12.90, 0.52, 0.31931, 0, 0, 499, 0, 2, false, 0.0029, 0.01, 0.06, 360000, 180000);
        $hsbc = $this->fixed20($amount, 0.75, 8.647, 8.45, 9.70, 0.255, 0.228, 0, 0, 0, 0, 2.5, false, 'hsbc', 0, 0.06, 266600, 66650);
        $santander = $this->fixed20($amount, 0.9, 9.39, 9.6, 11.70, 31.54, 0.3376, 0, 0, 406, 0, 2.5, true, 0.00319, 0.01, 0.06, 0, 0, true);
        $scotiabank = $this->fixed20($amount, 0.65, 8.64, 10, 11.60, 0.5, 0.3016, 0, 0, 0, 0, 2.5703573901, false, 'scotiabank', 0, 0.06, 300000, 225000);
      }
    }else{
      if(Request::get('paytime') == 15){
        $afirme = $this->grow15($amount, 0.6999, 8.72199, 0.098, 0.1044, 0.8, 0.06931, 0.98, 98, 199, 68.18, 2.5, true, 0.0035728, 0.01, 0.06, 200000, 100000);
        $banamex = $this->grow15(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
        $banorte = $this->grow15($amount, 0.9, 8.9, 0.0899, 0.121, 0.52, 0.41054, 0, 0, 0, 0, 2, false, 0.0029, 0.01, 0.06, 100000);
        $hsbc = $this->grow15($amount, 0.75, 8.82, 0.101, 0.098, 0.255, 0.228, 0, 0, 0, 0, 3.03, false, 'hsbc', 0, 0.06, 250000);
        $santander = $this->grow15($amount, 0.9, 9, 0.096, 0.118, 31.54, 0.3376, 0, 0, 0, 0, 2.2941305511, false, 2.75, 0.01, 0.06, 100000);
        $scotiabank = $this->grow15($amount, 0.95, 9.06, 0.0875, 0.107, 0.5, 0.3016, 0, 0, 0, 0, 2.6, false, 'scotiabank', 0.0125, 0.06, 50000);
      }else{
        $afirme = $this->grow20($amount, 0.6999, 9.095, 0.1055, 0.1218, 0.8, 0.06931, 0.98, 98, 199, 69.51, 2.5, true, 0.003596, 0.01, 0.06, 300100);
        $banamex = $this->grow20(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
        $banorte = $this->grow20($amount, 0.9, 7.6, 0.0899, 0.118, 0.52, 0.41054, 0, 0, 299, 0, 2, false, 0.0029, 0.01, 0.06, 100000);
        $hsbc = $this->grow20($amount, 0.75, 7.55, 0.0845, 0.098, 0.255, 0.228, 0, 0, 0, 0, 3.0304, false, 'hsbc', 0, 0.06, 250000);
        $santander = $this->grow20($amount, 0.9, 8.2, 0.096, 0.117, 31.54, 0.3376, 0, 0, 0, 0, 2.5, true, 0.00275, 0.01, 0.06, 100000);
        $scotiabank = $this->grow20($amount, 0.95, 7.92, 0.0875, 0.107, 0.5, 0.3016, 0, 0, 0, 0, 2.7075492331, false, 'scotiabank', 0.0125, 0.06, 50000);
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
    
    $this->View->render('simulator/calculator.html', array('banks'=>$banks, 'paytype'=>Request::get('paytype'), 'paytime'=>Request::get('paytime')));
  }
  
  private function grow15(
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
      'tasa_interes' => number_format($interes, 2).'%', 
      'ingreso_requerido' => '$'.number_format($ingreso, 2),
      'cat' => number_format($cat, 2).'%',
      'enganche' => '$'.number_format($enganche, 2),
      'enganche_adicional' => '$'.number_format($enganche_adicional, 2),
      'avaluo' => '$'.number_format($avaluo, 2),
      'comision_apertura' => '$'.number_format($apertura, 2),
      'gastos_notario' => '$'.number_format($gastos_notario, 2),
      'total' => '$'.number_format($total, 2)
    );
  }

  private function grow20(
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
      'comision' => $comision > 0 ? '$'.number_format($comision, 2) : 'N/A',
      'mensualidad' => '$'.number_format($mensualidad, 2),
      'monto' => '$'.number_format($monto, 2), 
      'prima_unica' => $prima_unica ? '$'.number_format($prima_unica, 2) : 'N/A',
      'tasa_interes' => number_format($interes, 2).'%', 
      'ingreso_requerido' => '$'.number_format($ingreso, 2),
      'cat' => number_format($cat, 2).'%',
      'enganche' => '$'.number_format($enganche, 2),
      'enganche_adicional' => '$'.number_format($enganche_adicional, 2),
      'avaluo' => '$'.number_format($avaluo, 2),
      'comision_apertura' => '$'.number_format($apertura, 2),
      'gastos_notario' => '$'.number_format($gastos_notario, 2),
      'total' => '$'.number_format($total, 2)
    );
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
      'tasa_interes' => number_format($interes, 2).'%', 
      'ingreso_requerido' => '$'.number_format($ingreso, 2),
      'cat' => number_format($cat, 2).'%',
      'enganche' => '$'.number_format($enganche, 2),
      'enganche_adicional' => '$'.number_format($enganche_adicional, 2),
      'avaluo' => '$'.number_format($avaluo, 2),
      'comision_apertura' => '$'.number_format($apertura, 2),
      'gastos_notario' => '$'.number_format($gastos_notario, 2),
      'total' => '$'.number_format($total, 2)
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
      'comision' => $comision > 0 ? '$'.number_format($comision, 2) : 'N/A',
      'mensualidad' => '$'.number_format($mensualidad, 2),
      'monto' => '$'.number_format($monto, 2), 
      'prima_unica' => $prima_unica ? '$'.number_format($prima_unica, 2) : 'N/A',
      'tasa_interes' => number_format($interes, 2).'%', 
      'ingreso_requerido' => '$'.number_format($ingreso, 2),
      'cat' => number_format($cat, 2).'%',
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
}
