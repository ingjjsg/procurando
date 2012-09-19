<?php
    require_once '../modelo/clConstantesModelo.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



class functions
{
    
public static function decrypt($string) {
   $key='prueba';//clConstantesModelo::id();
   $result = '';
   $string = base64_decode($string);
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
   }
   return $result;
}
    
    
public static function encrypt($string) {
   $key='prueba';//clConstantesModelo::id();    
   $result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   return base64_encode($result);
}    
    
  public static function VerificarFechaActual($dateTime) {
    if ($dateTime > date("d-m-Y"))
        return true;
    else
        return false;
  }
        
    
  public static function diterenciaFechasSemaforoDocumento($dateTime,$numerodias) {
    $dias=0;
    if ($dateTime < date("Y-m-d"))
    {
//        exit('menor');
        return "R";
    }
    else {
        $datetime1 = date_create($dateTime);
        $datetime2 = date_create(date("Y-m-d"));
        $intervalo = date_diff($datetime1, $datetime2);
        $dias = $intervalo->format('%d'); 
//        exit($dias."<=".$numerodias);
        if ($dias<=$numerodias)
        {
            if (($dias>=0)&&($dias<=1))
            {        
                return "A";
            }
            elseif ($dias>=2)
            {
                return "V";
            }   
        }
    }

      
  }     
    
  
  public static function diterenciaFechasDiasDocumento($dateTime) {
    $dias=0;
    if ($dateTime < date("Y-m-d"))
    {
        return 0;
    }
    else {
        $datetime1 = date_create($dateTime);
        $datetime2 = date_create(date("Y-m-d"));
        $intervalo = date_diff($datetime1, $datetime2);
        $dias = $intervalo->format('%d'); 
        return $dias;
    }

      
  }
    
  public static function diterenciaFechasDiasAgenda($dateTime) {
    $dias=0;
    if ($dateTime < date("Y-m-d"))
    {
        return 0;
    }
    else {
        $datetime1 = date_create($dateTime);
        $datetime2 = date_create(date("Y-m-d"));
        $intervalo = date_diff($datetime1, $datetime2);
        $dias = $intervalo->format('%d'); 
        return $dias;
    }

      
  }         
    
  public static function diterenciaFechasSemaforoAgenda($dateTime,$numerodias) {
    $dias=0;
    if ($dateTime < date("Y-m-d"))
    {
//        exit('menor');
        return "R";
    }
    else {
        $datetime1 = date_create($dateTime);
        $datetime2 = date_create(date("Y-m-d"));
        $intervalo = date_diff($datetime1, $datetime2);
        $dias = $intervalo->format('%d'); 
//        exit($dias."<=".$numerodias);
        if ($dias<=$numerodias)
        {
            if (($dias>=0)&&($dias<=1))
            {        
                return "A";
            }
            elseif ($dias>=2)
            {
                return "V";
            }   
        }
    }

      
  }     
    
  public static function diterenciaFechasSemaforo($dateTime) {
    $dias=0;
    if ($dateTime < date("Y-m-d"))
        return "R";
    else {
        $datetime1 = date_create($dateTime);
        $datetime2 = date_create(date("Y-m-d"));
        $intervalo = date_diff($datetime1, $datetime2);
        $dias = $intervalo->format('%d'); 
        if (($dias>=0)&&($dias<=1))
        {        
            return "A";
        }
        elseif ($dias>=2)
        {
            return "V";
        }                         
    }

      
  }    
    
    
    
  public static function diterenciaFechas($interval,$dateTimeBegin,$dateTimeEnd) {
    //Parse about any English textual datetime
    //$dateTimeBegin, $dateTimeEnd

    $dateTimeBegin=strtotime($dateTimeBegin);
    if($dateTimeBegin === -1) {
      return("..begin date Invalid");
    }

    $dateTimeEnd=strtotime($dateTimeEnd);
    if($dateTimeEnd === -1) {
      return("..end date Invalid");
    }

    $dif=$dateTimeEnd - $dateTimeBegin;

    switch($interval) {
      case "s"://seconds
        return($dif);

      case "n"://minutes
        return(floor($dif/60)); //60s=1m

      case "h"://hours
        return(floor($dif/3600)); //3600s=1h

      case "d"://days
        return(floor($dif/86400)); //86400s=1d

      case "ww"://Week
        return(floor($dif/604800)); //604800s=1week=1semana

      case "m": //similar result "m" dateDiff Microsoft
        $monthBegin=(date("Y",$dateTimeBegin)*12)+
        date("n",$dateTimeBegin);
        $monthEnd=(date("Y",$dateTimeEnd)*12)+
        date("n",$dateTimeEnd);
        $monthDiff=$monthEnd-$monthBegin;
        return($monthDiff);

      case "yyyy": //similar result "yyyy" dateDiff Microsoft
        return(date("Y",$dateTimeEnd) - date("Y",$dateTimeBegin));

      default:
        return(floor($dif/86400)); //86400s=1d
    }

  }    
    
    
    public static function restaFechas($dFecIni, $dFecFin)
    {
        $dFecIni = str_replace("-","",$dFecIni);
        $dFecIni = str_replace("/","",$dFecIni);
        $dFecFin = str_replace("-","",$dFecFin);
        $dFecFin = str_replace("/","",$dFecFin);

        ereg( "([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})", $dFecIni, $aFecIni);
        ereg( "([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})", $dFecFin, $aFecFin);

        $date1 = mktime(0,0,0,$aFecIni[2], $aFecIni[1], $aFecIni[3]);
        $date2 = mktime(0,0,0,$aFecFin[2], $aFecFin[1], $aFecFin[3]);

        return round(($date2 - $date1) / (60 * 60 * 24));
    }   
    
    
    public function  open_and_prepare($ftoopen, $ancien_mode=FALSE) //fonction pour lire le fichier, créer un tableau vide s'il n'existe pas et ôter les lignes de commentaire
	{
		if(is_file($ftoopen)) 
		{
			$arr=$this->wipe_control(file("$ftoopen"));
		}else{
			$arr=array();
		}
		foreach($arr as $key=>$elem)
		{
			$arr[$key] = trim($elem); //pour ôter les fins de ligne
			//echo "<br>$key a pour valeur $elem";
		}
		return $arr;
	}
        
    static function  validar_input($valor,$nombre_campo,&$respuesta="") //fonction pour lire le fichier, créer un tableau vide s'il n'existe pas et ôter les lignes de commentaire
    {
	if ((is_numeric($valor)) or empty($valor))  
        {
            $respuesta="¡Error en el Campo ".strtoupper ($nombre_campo)."!'";
            return false;          
        }   
        else{
            return true;
        }
    }        
    static function  validar_input_numerico($valor,$nombre_campo,&$respuesta="") //fonction pour lire le fichier, créer un tableau vide s'il n'existe pas et ôter les lignes de commentaire
    {
	if (is_numeric($valor))
        {
           return true;          
        }   
        else{
            $respuesta="¡Error en el Campo ".strtoupper ($nombre_campo)."!'";            
            return false;
        }
    }
    
    static function validarFormulario($formulario,$request,$campos){
        foreach ($campos as $nombre_campo => $campo) {
            if($nombre_campo == 'combo'){
                foreach ($campos['combo'] as $nombre_combo => $combo) {
                    if($request[$combo] == 0){
                        return array(
                            'msg' => '¡Error en el campo '.strtoupper ($nombre_combo).'!',
                            'focus' => 'document.'.$formulario.'.'.$combo.'.focus()');
                    }
                }
                
            }else{
                if(empty($request[$campo])){
                    return array(
                        'msg' => '¡Error en el campo '.strtoupper ($nombre_campo).'!',
                        'focus' => 'document.'.$formulario.'.'.$campo.'.focus()');
                }
            }
        }
    }
    
    static function desactivarCampos($formulario,$campos){
        $js="";
        foreach ($campos as $campo) {
            $js.="document.".$formulario.".".$campo.".readOnly='true';";
        }
        return $js;
    }

  public static function FloatVEtoFloat($value){
    try{
      $sinpuntos = str_replace('.','',$value);
      $valor_en_float = (float)str_replace(',','.',$sinpuntos);
      if(is_nan($valor_en_float))
          return 0.00;
      else return $valor_en_float;
    }catch(Exception $e){return 0.00;}
  }

  public static function toFloat($value,$decimales=2)
  {
    $valorfloat = 0.0;
    if ( ($value==" ") || ($value=="") || ($value=="NaN"))
    {
      $valorfloat=0.00;
    }else{
      if(self::isFloat($value) || is_float($value)){
       $value = str_replace(',','',$value);
        $valorfloat = (float)$value;
      }else{
        if(self::isFloatVE($value))
          $valorfloat = self::FloatVEtoFloat($value);
        else
          $valorfloat = 0.00;
      }
    }
    return round($valorfloat,$decimales);
  }
  
  public static function isFloat($value)
  {
    $expresionfloat =  "/^(-?)(\d{1,3}\,)(\d{3,3}\,){1,10}(\.\d+)$/";
    $expresionfloat_1 =  "/^(-?)(\d{1,10})(\.\d+)$/";
    $expresionfloat_2 =  "/^(-?)(\d{1,3}\,){1,10}(\d{3,3})(\.\d+)$/";
    $expresionfloat_3 =  "/^(-?)(\d{1,20})$/";
    $expresionfloat_4 =  "/^(-?)(\d{1,20})(\.\d+)$/";

    if(preg_match($expresionfloat,$value) || preg_match($expresionfloat_1,$value) || preg_match($expresionfloat_2,$value) || preg_match($expresionfloat_3,$value) || preg_match($expresionfloat_4,$value) ) return true;
    else return false;
  }  
    
  public static function isFloatVE($value)
  {
    $expresionfloatVE =  "/^(\d{1,3}\.)(\d{3,3}\.){1,10}(\,\d+)$/";
    $expresionfloatVE_1 =  "/^(\d{1,10})(\.\d+)$/";
    $expresionfloatVE_2 =  "/^(\d{1,3}\.){1,10}(\d{3,3})(\,\d+)$/";
    $expresionfloatVE_3 =  "/^(\d{1,20})$/";
    $expresionfloatVE_4 =  "/^(\d{1,20})(\,\d+)$/";

    if(preg_match($expresionfloatVE,$value) || preg_match($expresionfloatVE_1,$value) || preg_match($expresionfloatVE_2,$value) || preg_match($expresionfloatVE_3,$value) || preg_match($expresionfloatVE_4,$value) ) return true;
    else return false;

  }  
}
?>
