<?php
    require_once '../controlador/Conexion.php';
    require_once '../comunes/php/utilidades.php';
    require_once '../modelo/clConstantesModelo.php';
    require_once '../modelo/clMaestroModelo.php';
    require_once 'Connection.php';
    require_once '../exception/recordNoFoundException.php';

/**
 * Description of maestroModelo
 *
 * @author jsuarez
 */
class clFunciones {

    public static function FormatoMonto($value,$dec='2')
    {
        $value = floatval($value);
        $for='VE';
        if ($value==' ')
        $value=0;
        if ($for=='VE')
        $valor = number_format($value,$dec,',','.');
        elseif ($for=='IN')
            $valor = number_format($value,$dec,'.',',');
        else
            $valor = number_format($value,0);

        return $valor;
    }

    public static function FormatoNum($varmonto,$format='VE')
    {
        if($format=='VE')
        {
        $auxvar=str_replace(".","",$varmonto);
        $auxvar=str_replace(",",".",$auxvar);
        }else
        {
        $auxvar=str_replace(",","",$varmonto);
        $auxvar=str_replace(".",",",$auxvar);
        }

    return $auxvar;
    }

    
    
    static public function extraer_municipio($id_municipio)
    {
        $variable="";
        $id_municipio=(int)$id_municipio;
        $municipios_claves=clConstantesModelo::municipios();
//        if (array_key_exists($id_municipio, $municipios_claves))
//        {
            $variable= array_search($id_municipio, $municipios_claves);;
//        }
        return $variable;
    }

    static public function extraer_parroquia($id_municipio,$id_parroquia)
    {
        $variable="";
        $id_municipio=(int)$id_municipio;
        $id_parroquia=(int)$id_parroquia;
        $parroquia_claves=clConstantesModelo::parroquia();
        $buscar=trim($id_parroquia."_".$id_municipio);
//        if (array_key_exists((string)$buscar, $parroquia_claves))
//        {
            $variable= array_search($buscar, $parroquia_claves);
//        }
        return $variable;
    }

    public function extraer_nombre($str, $length, &$nombre, &$apellido)
    {
        $i = 0;
        foreach (explode(' ', $str) as $word)
        {
            $i++;
            if ($length > $i)
                $apellido.=$word." ";
            else
                $nombre.=$word." ";
        }
        return $nombre;
    }


    public function estados_autorizados($id_usuario)
    {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        $conn->sql= "select
         a.id_estados,
         (SELECT a1.stritema FROM ".clConstantesModelo::siembraweb_table."tblmaestros a1 WHERE a1.id_maestro = b.id_estinicial_maestro) AS estado_inicial,
         (SELECT a1.stritema FROM ".clConstantesModelo::siembraweb_table."tblmaestros a1 WHERE a1.id_maestro = b.id_estfinal_maestro) AS estado_final,
         operacion_anterior,
         operacion_siguiente,
         b.id_estinicial_maestro,
         b.id_estfinal_maestro
         from
         seguridad.tblautorizado_est a,
         public.tblestados b,
         seguridad.tblcontactoprofile c
         where
          c.id_contacto=".$id_usuario." and
          a.id_perfil_maestro=c.id_profile_maestro and a.id_estados=b.id_estados";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }



    public function auditoria_sql($tabla,$operacion,$sql,$strcampos,$id_usurio,$id)
    {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        $conn->sql= "INSERT INTO ".clConstantesModelo::seguridad_table."tblcontactoprofile (id_contacto, id_profile_maestro) VALUES ";
        $conn->sql.= "(".$id_contacto.", ".$id_profile_maestro.")";
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function ultimo_id($esquema,$tabla,$campo)
    {
        $id="";
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        $conn->sql= "select last_value from ".$esquema.$tabla."_".$campo."_seq";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if($data)
        {
            $id=$data[0]['last_value'];
        }
        return $id;
    }

    public function formulario_accion($formulario,$accion)
    {
        $variable=false;
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        $conn->sql= "SELECT * FROM ".clConstantesModelo::seguridad_table."tblaccesoforma WHERE id_profile_maestro='".$_SESSION['id_profile']."' and id_menu_maestro='".$formulario."'";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if($data)
        {
            $acciones_permitidas=array_diff(array_unique(explode(",",$data[0]['stracciones'])),array_values(array('')));
	    if (in_array(intval($accion), $acciones_permitidas))
                $variable=true;
        }
        return $variable;
    }


    public function obtener_hijo_campo($tabla,$campo)
    {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        $conn->sql= "SELECT * FROM ".clConstantesModelo::seguridad_table."tblconfigmaestro WHERE trim(lower(strtabla))=trim(lower('".$tabla."')) and lower(strcampo)=lower('".$campo."') order by id_configmaestro";
        //print $conn->sql;exit;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }

/*
 * Retorna un arreglo con los valores de las columnas id_maestro,stritema,stritemb,stritemc
 * en estricto orden
 */
    static function getHijosMaestros($tabla,$campo){
        $sql= "SELECT id_maestro,stritema,stritemb,stritemc,sngcant
				FROM siembraweb.tblmaestros
				WHERE bolborrado=0 AND
					id_origen = (SELECT id_maestro
						FROM seguridad.tblconfigmaestro
						WHERE
						strtabla= '$tabla'AND
						strcampo= '$campo'
						LIMIT 1)";
		$connection = Connection::getInstance();
        $connection->query($sql);
		$data = $connection->fetch_all();
		if (empty($data))
			throw new RecordNoFoundException("No se halla la llave $tabla, $campo en la tabla seguridad.tblconfigmaestro");
        return $data;
    }

    public function obtener_default($tabla,$campo)
    {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        $conn->sql= "select b.id_maestro, a.lngnumero from ".clConstantesModelo::seguridad_table."tblconfigmaestro b, ".clConstantesModelo::siembraweb_table."tblmaestros a where
					lower(b.strtabla)=lower('".$tabla."') and lower(b.strcampo)=lower('".$campo."')
					and b.id_maestro = a.id_maestro";
        //echo $conn->sql;exit;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }


    public function obtener_post($post)
    {
     $sql="";
     $i=0;
     if (is_array($post))
     {
        while($i < count($post))
        {
            if($post['activo_'.$i]=='A')
            {
               $sql.=' ';
               if ($i>0)
                 $sql.=" and ";
                  if ($post['condicionales_'.$i]=='<')
                      $sql.=$post['campos_'.$i].' < ª'.$post['input_'.$i].'ª';

                  elseif ($post['condicionales_'.$i]=='>')
                      $sql.=$post['campos_'.$i].' < ª'.$post['input_'.$i].'ª';

                  elseif ($post['condicionales_'.$i]=='<>')
                      $sql.=$post['campos_'.$i].' <> ª'.$post['input_'.$i].'ª';

                  elseif ($post['condicionales_'.$i]=='=')
                      $sql.=$post['campos_'.$i].' = ª'.$post['input_'.$i].'ª';

                  elseif ($post['condicionales_'.$i]=='like')
                  {
                      $variable = (string) $post['input_'.$i];
                      $sql.='lower('.$post['campos_'.$i].'::text) like ª%';
                      $sql.=strtolower($variable)."%ª";
                  }

                  elseif ($post['condicionales_'.$i]=='-like')
                      $sql.=$post['campos_'.$i].'::text like ª%'.$post['input_'.$i].'ª';

                  elseif ($post['condicionales_'.$i]=='likeª')
                      $sql.=$post['campos_'.$i].'::text like ª'.$post['input_'.$i].'%ª';

            }
            $i++;
        }
        //print "<pre>"; print_r($post); print "</pre>";
     }
     else $sql="";
        return $sql;
    }

      public function llenarCombo_ConfigMaestro($name="id_",$tabla="",$clase_ccs="selectbox",$request= "",$action_javascript="",$sql="",$tipo="")
      {
          /*
          $name=nombre del campo
          $tabla=tabla a la que pertenece el $name
          $clase_ccs= clase ccs
          $request=valor cuando viene por un get
          */
            $respuesta= new xajaxResponse();
            $funciones= new clFunciones();
            $arreglo_valores=array();
            $arreglo_valores=$funciones->obtener_hijo_campo($tabla,$name);
                if ($tabla!='')
                {
                    $data= "";
                    $html= "";
                    $data= $funciones->selectCodigoConfiguracion($arreglo_valores[0]['id_maestro'], 'stritema');
                    if ($tipo=='')
                    {
                         $html.="<select name='".$name."' id='".$name."' class='".$clase_ccs."' '".$action_javascript."'>";
                         $html.="<option value='0'>Seleccione</option>";
                    }
                    else $html.="<option value='0'>Seleccione</option>";
                    if($data){
                        for ($i= 0; $i < count($data); $i++){
                            if(trim($request) == trim($data[$i]['id_maestro']))  $seleccionar= "selected";
                            else $seleccionar= "";
                            $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".ucwords(strtolower($data[$i]['stritema']))."</option>";
                        }
                        if ($tipo=='') $html.= "</select>";
                    }
                $respuesta->assign($name,"innerHTML",$html);
                return $respuesta;
            }
            else return "";
       }


      public function llenarCombo_Sql($request="",$name="",$clase_ccs="selectbox",$action_javascript="",$tabla="",$campos="")
      {
          /*
          $name=nombre del campo
          $tabla=tabla a la que pertenece el $name
          $clase_ccs= clase ccs
          $request=valor cuando viene por un get
          $action_javascript= action script
          $campo=campos de la tabla
          */
            $respuesta= new xajaxResponse();
            $data= "";
            $html= "";
            $conn= new Conexion();
            $campos_sql=array();
            $conn->abrirConexion();
            $conn->sql= "";
            $campos_sql=explode(",",$campos);

            if ($request=='')
                $conn->sql= "select ".$campos." from ".$tabla;
            else
            {
                if (count($campos_sql)==3)
                    $conn->sql= "select ".$campos." from ".$tabla." where ".$campos_sql[0]."=".$request;
                else
                    $conn->sql= "select ".$campos." from ".$tabla;
            }
                //echo "select ".$campos." from ".$tabla." where ".$campos_sql[2]."=".$request;
            $data= $conn->ejecutarSentencia(2);
                //$html= "<select name='".$name."' id='".$name."' class='".$clase_ccs."' '".$action_javascript."'>";
                $html.="<option value='0'>Seleccione</option>";
                if($data){
                    for ($i= 0; $i < count($data); $i++){
                        $seleccionar= "";
                        if($request == $data[$i][$campos_sql[0]])  $seleccionar= "SELECTED";
                        $html.= "<option value='".$data[$i][$campos_sql[0]]."' ".$seleccionar.">".ucwords(strtolower($data[$i][$campos_sql[1]]))."</option>";
                    }
                    //$html.= "</select>";
                }
                $respuesta->assign($name,"innerHTML",$html);
                return $respuesta;
        }


    public function selectCodigoConfiguracion($padre, $campo)
    {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        $conn->sql= "SELECT * FROM ".clConstantesModelo::scsd_table."tblmaestros WHERE id_origen= ".$padre." AND bolborrado= 0 ";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }

      public function traer_configmaestro($tabla,$campo)
      {
            $funciones= new clFunciones();
            $arreglo_valores=array();
            $arreglo_valores=$funciones->obtener_hijo_campo($tabla,$campo);
            if ($arreglo_valores)
            {
                    for ($i= 0; $i < count($arreglo_valores); $i++)
                    {
                        $data.=$arreglo_valores[$i]["id_maestro"].",";
                    }
                return $data;
            }
            else return "";
      }

	public function encriptacion($value)
	{
	   $crypttext="1";
	   if ($value)
	   {
		   /*$key = clConstantesModelo::id;
		   $text = $value;
		   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		   $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv);*/
                   return base64_encode($value);
	   }
	   else return "";
	}

	public function desencriptacion($value)
	{
	   $crypttext="1";
	   if ($value)
	   {
		   /*$key = clConstantesModelo::id;
		   $crypttext = $value;
		   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		   $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv);*/
		   return base64_decode($value);
	   }
	   else return "";
	}

    public function obtener_correo($tabla,$campo) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        $conn->sql= "SELECT strpassword,stremail FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= trim(lower('".$_SESSION['id_profile']."'))";
        //print $conn->sql;exit;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }


    public function ActualizarAsociacion() {
              $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "update
							  " . clConstantesModelo::seguridad_table . "tblcontacto
                              set

                              stremail=
                              strnombre_asociacion='".$this->getStrnombre_asociacion()."',
                              strweb='".$this->getStrweb()."',
                              dtmfechafun=to_date('".$this->getDtmfechafun()."','dd/mm/yyyy') ,
                              strtelefono_asociacion='".$this->getStrtelefono_asociacion()."',
                              strdireccion_asociacion='".$this->getStrdireccion_asociacion()."',
                              strrif='".$this->getStrrif()."',
                              id_municipio_asociacion=".$this->getId_municipio_asociacion().",
                              id_parroquia_asociacion=".$this->getId_parroquia_asociacion().",
                              id_ramo=".$this->getId_ramo()." where lngcodigo_asociacion=".$this->getLngcodigo_asociacion();
               $conn->sql = $sql;
               $conn->ejecutarSentencia ();
               $conn->cerrarConexion ();
               return $this->getLngcodigo_asociacion();
      }

    public static function mostrarStritema($id_maestro)
    {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        $conn->sql= "select id_maestro, stritema FROM ".clConstantesModelo::public_table."tblmaestros  WHERE id_maestro=$id_maestro";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        $stritema="";
        if(!empty($data)){
            $stritema=$data[0]['stritema'];
        }
        return $stritema;
    }


}


?>
