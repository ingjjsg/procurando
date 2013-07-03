<?php //
    session_start();
    require_once '../modelo/clContactoModelo.php';
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clContactoProfileModelo.php';
    require_once '../modelo/clAsignarModelo.php';
    require_once '../modelo/clAutorizadoModelo.php';
    require_once '../modelo/clEstadoModelo.php';
    require_once '../modelo/clPermisoModelo.php';//nuevo

    include('../comunes/php/utilidades.php');
//    verificarSessionModuloSeguridad();
    
    function tiempo() {
        $respuesta = new xajaxResponse();
        $respuesta->call('setTimeout','xajax_buzon();','500');
        return $respuesta;
    } 
    
    
    function buzon() {
        $html='';
        $respuesta = new xajaxResponse();
        $html.='buzon de entrada dissss';
        $respuesta->assign("mensaje","innerHTML",$html);
        return $respuesta;
    }     
    
    
    function selectAllContacto(){
        $respuesta= new xajaxResponse();
        $contacto= new clContactoModelo();
        $contactoProfile=  new clContactoProfileModelo();
        $data= "";
        $html= "";
        $data= $contacto->selectAllContacto();
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=''>Id</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=''>Login</a>
                                </th>
                                <th width='12%'>
                                    <a href='#' onclick=''>Nombre</a>
                                </th>
                                <th width='13%'>
                                    <a href='#' onclick=''>Apellidos</a>
                                </th>
                                <th width='8%'>
                                    <a href='#' onclick=''>Cedula</a>
                                </th>
                                <th width='21%'>
                                    <a href='#' onclick=''>E-mail</a>
                                </th>
                                <th width='18%'>
                                    <a href='#' onclick=''>Departamento</a>
                                </th>
                                <th width='13%'>Acci&oacute;n</th>
                            </tr></table>";
            for ($i= 0; $i < count($data); $i++){
                $dataProfile= $contactoProfile->selectContactoProfileByIdContacto($data[$i]['id_contacto']);
                $strUrl= "acc=ACT&id=".$data[$i]['id_contacto'];
                $strUrl.= "&password=".$data[$i]['strpassword'];
                $strUrl.= "&login=".$data[$i]['strlogin'];
                $strUrl.= "&id_tipo_maestro=".$data[$i]['id_tipo_maestro'];
                if($data[$i]['id_tipo_maestro'] == 171){
                    $strUrl.= "&tipo=Interno";
                }else{
                    $strUrl.= "&tipo=Externo";
                }
                $strUrl.= "&documento=".$data[$i]['strdocumento'];
                $strUrl.= "&nombre=".$data[$i]['strnombre'];
                $strUrl.= "&apellido=".$data[$i]['strapellido'];
                $strUrl.= "&tlfn=".$data[$i]['strtlfhab'];
                $strUrl.= "&ext=".$data[$i]['strext'];
                $strUrl.= "&email=".$data[$i]['stremail'];
                $strUrl.= "&direccion=".urlencode($data[$i]['memdireccion']);
                $strUrl.= "&cargo=".$data[$i]['id_cargo_maestro'];
                $strUrl.= "&estatus=".$data[$i]['id_estatus_maestro'];
                $strUrl.= "&perfil=".$dataProfile[0]['id_profile_maestro'];
                $strUrl.= "&firmaCorreo=".urlencode($data[$i]['strfirma']);
                $strUrl.= "&mediaFirma=".$data[$i]['strmediafirma'];
                $strUrl.= "&dpto=".$data[$i]['id_dpto_maestro'];
                $strUrl.= "&coord=".$data[$i]['id_coord_maestro'];
                $strUrl.= "&coordExt=".$data[$i]['id_coordext_maestro'];
                $html.= "<table border='0' class='tablaTitulo' width='100%'>
                            <tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\">
                                <td align='center'  width='5%'>".$data[$i]['id_contacto']."</td>
                                <td width='10%'>".$data[$i]['strlogin']."</td>
                                <td width='12%'>".$data[$i]['strnombre']."</td>
                                <td width='13%'>".$data[$i]['strapellido']."</td>
                                <td width='8%'>".$data[$i]['strdocumento']."</td>
                                <td width='21%'>".$data[$i]['stremail']."</td>
                                <td width='18%'>".$data[$i]['nombre_coord']."</td>
                                <td align='center' width='13%'>
                                    <a>
                                        <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Ver Detalles')\" onmouseout='UnTip()' onclick=\"ver('".$data[$i]['id_contacto']."')\">
                                    </a>
                                    <a>
                                        <img src='../comunes/images/user_edit.png' onmouseover=\"Tip('Editar Usuario')\" onmouseout='UnTip()' onclick=\"location.href='./contactoVistaIngreso.php?".$strUrl."'\">
                                    </a>
                                    <a>
                                        <img src='../comunes/images/user_delete.png' onmouseover=\"Tip('Eliminar Usuario')\" onmouseout='UnTip()' onclick=\"eliminarContacto('".$data[$i]['id_contacto']."')\">
                                    </a>
                                    <a>
                                        <img src='../comunes/images/key_go.png' onmouseover=\"Tip('Reset Password')\" onmouseout='UnTip()' onclick=\"resetPassword('".$data[$i]['id_contacto']."')\">
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <div id='div_".$data[$i]['id_contacto']."' style='display:none;background:#dfdfdf'></div>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Usuarios Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        return $respuesta;
    }

    function llenarSelectCargo($select= "") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos(163, 'stritema');
        $html= "<select name='id_cargo_maestro' id='id_cargo_maestro' class='selectbox'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
                $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaCargo","innerHTML",$html);
        return $respuesta;
    }

    function llenarSelectEstatus($select= "") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos(167, 'stritema');
        $html= "<select name='id_estatus_maestro' id='id_estatus_maestro' class='selectbox'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
                $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaEstatus","innerHTML",$html);
        return $respuesta;
    }

    function llenarSelectPerfil($select= "") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos(111, 'stritema');
        $html= "<select name='id_profile_maestro' id='id_profile_maestro' class='selectbox'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
                $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaProfile","innerHTML",$html);
        return $respuesta;
    }

    function llenarSelectDpto($select= "") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos(clConstantesModelo::departamentos, 'stritema');
        $html= "<select name='id_dpto_maestro' id='id_dpto_maestro' class='selectbox' onchange='xajax_llenarSelectCoord(document.frmcontacto.id_dpto_maestro.value);'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
                $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."'about: ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaDpto","innerHTML",$html);
        return $respuesta;
    }

    function llenarSelectCoord($id_origen, $select= "") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos($id_origen, 'stritema');
        $html= "<select name='id_coord_maestro' id='id_coord_maestro' class='selectbox' onchange='xajax_llenarSelectCoordext(document.frmcontacto.id_coord_maestro.value);'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
                $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaCoord","innerHTML",$html);
        return $respuesta;
    }

    function llenarSelectCoordext($id_origen, $select= "") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos($id_origen, 'stritema');
        $html= "<select name='id_coordext_maestro' id='id_coordext_maestro' class='selectbox'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
                $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaCoordext","innerHTML",$html);
        return $respuesta;
    }

    function verificarLogin($strlogin) {
        $respuesta= new xajaxResponse();
        $contactos= new clContactoModelo();
        $data= "";
        $html= "";
        $data= $contactos->verificarLogin($strlogin);
        if($data[0]['count'] > 0){
            $respuesta->script('document.frmcontacto.valLogin.value= 2');
            $html.= "<font color='red'>Este login no esta disponible</font>";
        }else{
            $respuesta->script('document.frmcontacto.valLogin.value= 1');
            $html.= "<font color='blue'>Usted puede usar este login</font>";
        }
        $respuesta->assign("capaLogin","innerHTML",$html);
        return $respuesta;
    }

    function insertContacto($formulario) {
        $respuesta= new xajaxResponse();
        $contacto= new clContactoModelo();
        $contactoProfile= new clContactoProfileModelo();
        $contacto->llenar($formulario);
        $data= $contacto->insertContacto();
        if($formulario['id_tipo_maestro'] == 171){
            $contactoProfile->insertContactoProfile($data[0]['id_contacto'], $formulario['id_profile_maestro']);
        }
        $respuesta->script("alert('El usuario fue guardado con exito');");
        $respuesta->script("location.href='contactoVista.php'");
		return $respuesta;
    }

    function updateContacto($formulario) {
        $respuesta= new xajaxResponse();
        $contacto= new clContactoModelo();
        $contactoProfile= new clContactoProfileModelo();
        $contacto->llenar($formulario);
        $data= $contacto->updateContacto();
        $contactoProfile->updateContactoProfile($formulario['id_contacto'], $formulario['id_profile_maestro']);
        $respuesta->script("alert('El usuario fue actualizado con exito');");
        $respuesta->script("location.href='contactoVista.php'");
		return $respuesta;
    }

     function updateContacto2($formulario) {
        $respuesta= new xajaxResponse();
        $contacto= new clContactoModelo();
        $contactoProfile= new clContactoProfileModelo();
        $contacto->llenar($formulario);
        $data=$contacto->updateContacto2();
        $respuesta->script("alert('El usuario fue actualizado con exito');");
        $respuesta->script("parent.location.href='login.php'");
        return $respuesta;
    }

      function updateContacto3($formulario,$pass) {
      	$respuesta= new xajaxResponse();
      	if(strlen($pass)>7){
			if(!(is_numeric($pass))){
				if(!(IsAlpha($pass))) {
					//echo('ESTA BIEN LA CONTRASEÑA');

        			$contacto= new clContactoModelo();
        			$contactoProfile= new clContactoProfileModelo();
        			$contacto->llenar($formulario);
        			$data=$contacto->updateContacto3();
        			$respuesta->script("alert('El usuario fue actualizado con exito');");
        			$respuesta->script("parent.location.href='login.php'");
        			//return $respuesta;

        		}else {$respuesta->script("alert('La contraseña debe tener al menos un número')");}
			}else {$respuesta->script("alert('La contraseña debe tener al menos una letra')");}
      	}else {$respuesta->script("alert('La contraseña debe tener al menos ocho (8) dígitos')");}

	return $respuesta;
    }

    function deleteContacto($id_contacto) {
        $respuesta= new xajaxResponse();
        $contacto= new clContactoModelo();
        $contactoProfile= new clContactoProfileModelo();
        $numero= uniqid();
        $html= "<div id='div_".$numero."'></div><input type='hidden' name='capa' id='capa' value='div_".$numero."'>";
        $respuesta->assign("formulario","innerHTML",$html);
        $contacto->deleteContacto($id_contacto);
        $contactoProfile->deleteContactoProfile($id_contacto);
        $respuesta->script("ocultar('div_".$numero."', '¡El usuario se ha eliminado exitosamente!')");
        $respuesta->script("xajax_selectAllContacto()");
		return $respuesta;
    }

    function verDeTallesContacto($id_contacto){
        $respuesta= new xajaxResponse();
        $contacto=  new clContactoModelo();
        $contactoProfile=  new clContactoProfileModelo();
        $data= $contacto->selectContactoById($id_contacto);
        $dataProfile= $contactoProfile->selectContactoProfileByIdContacto($id_contacto);
        $html= "<div id='div_c".$id_contacto."'><table class='tablaVer' border='0' width='100%'>";
        if($data){
            $html.= "<tr>
                        <th width='20%'>Nombres: </th>
                        <td width='20%'>".$data[0]['strnombre']."</td>
                        <th width='20%'>Apellidos: </th>
                        <td width='20%'>".$data[0]['strapellido']."</td>
                    </tr>
                    <tr>
                        <th width='20%'>Cedula: </th>
                        <td width='20%'>".$data[0]['strdocumento']."</td>
                        <th width='20%'>Email: </th>
                        <td width='20%'>".$data[0]['stremail']."</td>
                    </tr>
                    <tr>
                        <th width='20%'>Telefono: </th>
                        <td width='20%'>".$data[0]['strtlfhab']."</td>
                        <th width='20%'>Extensi&oacute;n: </th>
                        <td width='20%'>".$data[0]['strext']."</td>
                    </tr>
                    <tr>
                        <th width='20%'>Media Firma: </th>
                        <td width='20%'>".$data[0]['strmediafirma']."</td>
                        <th width='20%'>Tipo de Contacto: </th>
                        <td width='20%'>".$data[0]['nombre_tipo']."</td>
                    </tr>
                    <tr>
                        <th width='20%'>Direcci&oacute;n: </th>
                        <td width='20%'>".$data[0]['memdireccion']."</td>
                        <th width='20%'>Login: </th>
                        <td width='20%'>".$data[0]['strlogin']."</td>
                    </tr>
                    <tr>
                        <th width='20%'>Cargo: </th>
                        <td width='20%'>".$data[0]['nombre_cargo']."</td>
                        <th width='20%'>Estatus: </th>
                        <td width='20%'>".$data[0]['nombre_estatus']."</td>
                    </tr>
                    <tr>
                        <th width='20%'>Perfil: </th>
                    ";
            if($dataProfile){
                $html.= "<td width='20%'>".$dataProfile[0]['nombre_perfil']."</td>";
            }else{
                $html.= "<td width='20%'></td>";
            }
            $html.= "   <th width='20%'>Departamento: </th>
                        <td width='20%'>".$data[0]['nombre_dpto']."</td>
                    </tr>
                    <tr>
                        <th width='20%'>Coordinaci&oacute;n: </th>
                        <td width='20%'>".$data[0]['nombre_coord']."</td>
                        <th width='20%'>Coordinaci&oacute;n Extra: </th>
                        <td width='20%'>".$data[0]['nombre_coordext']."</td>
                    </tr>
                    ";
        }
        $html.= "";
        $html.= "</table></div>";
        $respuesta->assign("div_".$id_contacto,"style.border","#339933 2px solid");
        $respuesta->assign("div_".$id_contacto,"innerHTML",$html);
        return $respuesta;
	}

    function verificarIngresoIntranet($login,$pass){
        $respuesta= new xajaxResponse();
        $contacto= new clContactoModelo();
        $maestro= new clMaestroModelo();

        $contactoProfile= new clContactoProfileModelo();
        $contacto->llenar($formulario);
        $data= $contacto->verificarIngresoIntranet($login,$pass);
        if($data){
            $dataProfile= $contactoProfile->selectContactoProfileByIdContacto($data[0]['id_contacto']);
            $dataMaestro= $maestro->selectMaestroPadreById($data[0]['id_dpto_maestro']);
            $_SESSION['id_contacto']= $data[0]['id_contacto'];
            $_SESSION['strnombre']= $data[0]['strnombre'];
            $_SESSION['strapellido']= $data[0]['strapellido'];
            $_SESSION['id_cargo_maestro']= $data[0]['id_cargo_maestro'];
            $_SESSION['strdocumento']= $data[0]['strdocumento'];            
            $_SESSION['id_dpto_maestro']= $data[0]['id_dpto_maestro'];
            $_SESSION['id_coord_maestro']= $data[0]['id_coord_maestro'];
            $_SESSION['id_coordext_maestro']= $data[0]['id_coordext_maestro'];
            $_SESSION['id_profile']= $dataProfile[0]['id_profile_maestro'];
            if($dataMaestro[0]['lngnumero'] == 0){
                $_SESSION['estructura']= "H";
            }else{
                $_SESSION['estructura']= "V";
            }
            if($formulario['strpassword'] == "0000"){
                $_SESSION['passwd']= 1;
            }
            $respuesta->script("location.href='correspondencia.php'");
        }else{
            $respuesta->script("$('noLog').show(); setTimeout(\"$('noLog').hide();\",5000);");
            $respuesta->script("$('noLog').setStyle({color:'#ffffff',background:'#c17878',border:'#c17878 4px solid'})");
            $respuesta->assign("noLog","innerHTML","<b>Usuario &oacute; Contrase&ntilde;a Invalidos</b>");
            $respuesta->assign("strlogin","value",$formulario["strlogin"]);
            $respuesta->script("$('strlogin').select();$('strlogin').focus()");
        }
		return $respuesta;
    }



    function verificarIngreso($formulario){
        $respuesta= new xajaxResponse();
        $contacto= new clContactoModelo();
        $maestro= new clMaestroModelo();

        $contactoProfile= new clContactoProfileModelo();
        $contacto->llenar($formulario);
        $data= $contacto->verificarIngreso();
        if($data){

            $dataProfile= $contactoProfile->selectContactoProfileByIdContacto($data[0]['id_contacto']);
            $dataMaestro= $maestro->selectMaestroPadreById($data[0]['id_dpto_maestro']);
            //exit("ID_DEPARTAMENTO: ".$data[0]['id_coord_maestro']);
            $_SESSION['id_contacto']= $data[0]['id_contacto'];
            $_SESSION['strnombre']= $data[0]['strnombre'];
            $_SESSION['strapellido']= $data[0]['strapellido'];
            $_SESSION['id_cargo_maestro']= $data[0]['id_cargo_maestro'];
            $_SESSION['id_dpto_maestro']= $data[0]['id_dpto_maestro'];
            $_SESSION['strdocumento']= $data[0]['strdocumento'];               
            $_SESSION['id_coord_maestro']= $data[0]['id_coord_maestro'];
            
            $_SESSION['id_coordext_maestro']= $data[0]['id_coordext_maestro'];
            $_SESSION['id_profile']= $dataProfile[0]['id_profile_maestro'];
            $_SESSION['permisos_asignados']=clPermisoModelo::getFormulario_Accion();
            $contacto->insertarBitacora(0, $_SESSION['id_contacto'], 'ING', 'PRO', date('d/m/Y'));            
            //exit($_SESSION['id_profile']);
            if($dataMaestro[0]['lngnumero'] == 0){
                $_SESSION['estructura']= "H";
            }else{
                $_SESSION['estructura']= "V";
            }
            if($formulario['strpassword'] == "0000"){
                $_SESSION['passwd']= 1;
            }
            $respuesta->script("location.href='intro.php'");
        }else{
            $respuesta->script("$('noLog').show(); setTimeout(\"$('noLog').hide();\",5000);");
            $respuesta->script("$('noLog').setStyle({color:'#ffffff',background:'#c17878',border:'#c17878 4px solid'})");
            $respuesta->assign("noLog","innerHTML","<b>Usuario &oacute; Contrase&ntilde;a Invalidos</b>");
            $respuesta->assign("strlogin","value",$formulario["strlogin"]);
            $respuesta->script("$('strlogin').select();$('strlogin').focus()");
        }
		return $respuesta;
    }

    function verAccesoMenu($id_profile_maestro, $id_menu_maestro){
        $asignar= new clAsignarModelo();
        $maestro= new clMaestroModelo();
        $html= "";
        $data= "";
        $data= $asignar->selectAsignar($id_profile_maestro, $id_menu_maestro);
        $dataMaestro= $maestro->selectMaestroPadreById($id_menu_maestro);
        if($data){
           if($id_menu_maestro == 103 && $data[0]['stracciones'] != ""){
               $html= "<a href='../vista/leerVista.php' target='contenido'>".$dataMaestro[0]['stritema']."</a><br />";
           }else if($id_menu_maestro == 221 && $data[0]['stracciones'] != ""){
               $html= "<a href='../vista/bandejaVista.php' target='contenido'>".$dataMaestro[0]['stritema']."</a><br />";
           }else if($id_menu_maestro == 104 && $data[0]['stracciones'] != ""){
               $html= "<a href='../vista/redactarVista.php' target='contenido'>".$dataMaestro[0]['stritema']."</a><br />";
           }else if($id_menu_maestro == 105 && $data[0]['stracciones'] != ""){
               $html= "<a href='../vista/actividadVista.php' target='contenido'>".$dataMaestro[0]['stritema']."</a><br />";
           }else if($id_menu_maestro == 106 && $data[0]['stracciones'] != ""){
               $html= "<a href='../vista/maestroVista.php' target='contenido'>".$dataMaestro[0]['stritema']."</a><br />";
           }else if($id_menu_maestro == 107 && $data[0]['stracciones'] != ""){
               $html= "<a href='../vista/contactoVista.php' target='contenido'>".$dataMaestro[0]['stritema']."</a><br />";
           }else if($id_menu_maestro == 108 && $data[0]['stracciones'] != ""){
               $html= "<a href='../vista/perfilesVista.php' target='contenido'>".$dataMaestro[0]['stritema']."</a><br />";
           }else if($id_menu_maestro == 109 && $data[0]['stracciones'] != ""){
               $html= "<a href='../vista/asuntoVista.php' target='contenido'>".$dataMaestro[0]['stritema']."</a><br />";
           }else if($id_menu_maestro == 110 && $data[0]['stracciones'] != ""){
               $html= "<a href='../vista/correlativoVista.php' target='contenido'>".$dataMaestro[0]['stritema']."</a><br />";
           }else if($id_menu_maestro == 210 && $data[0]['stracciones'] != ""){
               $html= "<a href='../vista/contactoExternoVista.php' target='contenido'>".$dataMaestro[0]['stritema']."</a><br />";
           }else if($id_menu_maestro == 211 && $data[0]['stracciones'] != ""){
               $html= "<a href='../vista/modeloVista.php' target='contenido'>".$dataMaestro[0]['stritema']."</a><br />";
           }else if($id_menu_maestro == 263 && $data[0]['stracciones'] != ""){
               $html= "<a href='../vista/redactarExternoVista.php' target='contenido'>".$dataMaestro[0]['stritema']."</a><br />";
           }else if($id_menu_maestro == 266 && $data[0]['stracciones'] != ""){
               $html= "<a href='../vista/borradoresVista.php' target='contenido'>".$dataMaestro[0]['stritema']."</a><br />";
           }
        }
        return $html;
    }

    function verEstadosAutorizados($id_perfil_maestro, $id_estinicial_maestro){
        $autorizado= new clAutorizadoModelo();
        $estados= new clEstadoModelo();
        $data= "";
        $html= "";
        $x= 0;
        $data= $autorizado->selectAllAutorizadoById_perfil($id_perfil_maestro);
        if($data){
            for($i= 0; $i < count($data); $i++){
                $dataEstado= $estados->selectAllEstadosById($data[$i]['id_estados'], $id_estinicial_maestro);
                if($dataEstado){
                    $html[$x]= array('id_estfinal_maestro' => $dataEstado[0]['id_estfinal_maestro'], 'nombre_estfinal_maestro' =>$dataEstado[0]['nombre_estfinal_maestro']);
                    $x++;
                }
            }
        }
        return $html;
    }

    function verAccion($id_profile_maestro, $id_menu_maestro, $stracciones){
        $asignar= new clAsignarModelo();
        $data= $asignar->selectAsignarByProfile($id_profile_maestro, $id_menu_maestro, $stracciones);
        if($data){
            return true;
        }else{
            return false;
        }

    }

    function verificarDocumento($strdocumento){
        $respuesta= new xajaxResponse();
        $contacto= new clContactoModelo();
        $data= $contacto->verificarDocumento($strdocumento);
        if($data[0]['cantidad'] > 0){
            $respuesta->script("alert('La Cedula ingresada ya esta registrada en el sistema')");
            $respuesta->script("document.frmcontacto.strdocumento.focus()");
        }
        return $respuesta;
    }

    function updateContactoPassword($formulario) {
        $respuesta= new xajaxResponse();
        $contacto= new clContactoModelo();
        $contacto->llenar($formulario);
        $contacto->updateContactoPassword();
        session_unregister('passwd');
        $respuesta->script("alert('El password se cambio con Exito')");
        $respuesta->script("parent.cerrarVentana()");
        return $respuesta;
    }

    function resetContactoPassword($id_contacto) {
        $respuesta= new xajaxResponse();
        $contacto= new clContactoModelo();
        $contacto->setStrpassword("0000");
        $contacto->setId_contacto($id_contacto);
        $contacto->updateContactoPassword();
        $respuesta->script("alert('¡El password se actualizo con Exito!')");
        return $respuesta;
    }

    function resetPasswordEmail($strlogin, $stremail, $id_dpto_maestro) {
        $respuesta= new xajaxResponse();

        return $respuesta;
    }

    function selectAllDpto() {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();

        $data= $maestro->selectAllMaestroHijos(clConstantesModelo::departamentos, "stritema");
        $html= "";
        $html= "<select id='id_dpto' name='id_dpto' style='width:100%'>";
        $html.= "   <option value='0'>Seleccione</option>";
        for($i= 0; $i < count($data); $i++){
            $html.= "<option value='".$data[$i]['id_maestro']."'>".$data[$i]['stritema']."</option>";
        }
        $html.= "</select>";
        $respuesta->assign("capaGeren","innerHTML",$html);
        return $respuesta;
    }

    function selectAllContactofiltros($strnombre= "", $strapellido= "", $strlogin= "", $strdocumento= "", $id_dpto_maestro= ""){
        $respuesta= new xajaxResponse();
        $contacto= new clContactoModelo();
        $contactoProfile=  new clContactoProfileModelo();
        $data= "";
        $html= "";
        $data= $contacto->selectAllContactoFiltros($strnombre, $strapellido, $strlogin, $strdocumento, $id_dpto_maestro);
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=''>Id</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=''>Login</a>
                                </th>
                                <th width='12%'>
                                    <a href='#' onclick=''>Nombre</a>
                                </th>
                                <th width='13%'>
                                    <a href='#' onclick=''>Apellidos</a>
                                </th>
                                <th width='8%'>
                                    <a href='#' onclick=''>Cedula</a>
                                </th>
                                <th width='21%'>
                                    <a href='#' onclick=''>E-mail</a>
                                </th>
                                <th width='18%'>
                                    <a href='#' onclick=''>Departamento</a>
                                </th>
                                <th width='13%'>Acci&oacute;n</th>
                            </tr></table>";
            for ($i= 0; $i < count($data); $i++){
                $dataProfile= $contactoProfile->selectContactoProfileByIdContacto($data[$i]['id_contacto']);
                $strUrl= "acc=ACT&id=".$data[$i]['id_contacto'];
                $strUrl.= "&password=".$data[$i]['strpassword'];
                $strUrl.= "&login=".$data[$i]['strlogin'];
                $strUrl.= "&id_tipo_maestro=".$data[$i]['id_tipo_maestro'];
                if($data[$i]['id_tipo_maestro'] == 171){
                    $strUrl.= "&tipo=Interno";
                }else{
                    $strUrl.= "&tipo=Externo";
                }
                $strUrl.= "&documento=".$data[$i]['strdocumento'];
                $strUrl.= "&nombre=".$data[$i]['strnombre'];
                $strUrl.= "&apellido=".$data[$i]['strapellido'];
                $strUrl.= "&tlfn=".$data[$i]['strtlfhab'];
                $strUrl.= "&ext=".$data[$i]['strext'];
                $strUrl.= "&email=".$data[$i]['stremail'];
                $strUrl.= "&direccion=".urlencode($data[$i]['memdireccion']);
                $strUrl.= "&cargo=".$data[$i]['id_cargo_maestro'];
                $strUrl.= "&estatus=".$data[$i]['id_estatus_maestro'];
                $strUrl.= "&perfil=".$dataProfile[0]['id_profile_maestro'];
                $strUrl.= "&firmaCorreo=".urlencode($data[$i]['strfirma']);
                $strUrl.= "&mediaFirma=".$data[$i]['strmediafirma'];
                $strUrl.= "&dpto=".$data[$i]['id_dpto_maestro'];
                $strUrl.= "&coord=".$data[$i]['id_coord_maestro'];
                $strUrl.= "&coordExt=".$data[$i]['id_coordext_maestro'];
                $html.= "<table border='0' class='tablaTitulo' width='100%'>
                            <tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\">
                                <td align='center'  width='5%'>".$data[$i]['id_contacto']."</td>
                                <td width='10%'>".$data[$i]['strlogin']."</td>
                                <td width='12%'>".$data[$i]['strnombre']."</td>
                                <td width='13%'>".$data[$i]['strapellido']."</td>
                                <td width='8%'>".$data[$i]['strdocumento']."</td>
                                <td width='21%'>".$data[$i]['stremail']."</td>
                                <td width='18%'>".$data[$i]['nombre_dpto']."</td>
                                <td align='center' width='13%'>
                                    <a>
                                        <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Ver Detalles')\" onmouseout='UnTip()' onclick=\"ver('".$data[$i]['id_contacto']."')\">
                                    </a>
                                    <a>
                                        <img src='../comunes/images/user_edit.png' onmouseover=\"Tip('Editar Usuario')\" onmouseout='UnTip()' onclick=\"location.href='./contactoVistaIngreso.php?".$strUrl."'\">
                                    </a>
                                    <a>
                                        <img src='../comunes/images/user_delete.png' onmouseover=\"Tip('Eliminar Usuario')\" onmouseout='UnTip()' onclick=\"eliminarContacto('".$data[$i]['id_contacto']."')\">
                                    </a>
                                    <a>
                                        <img src='../comunes/images/key_go.png' onmouseover=\"Tip('Reset Password')\" onmouseout='UnTip()' onclick=\"resetPassword('".$data[$i]['id_contacto']."')\">
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <div id='div_".$data[$i]['id_contacto']."' style='display:none;background:#dfdfdf'></div>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Usuarios Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        return $respuesta;
    }

    function tomarDatosPerfil() {
        $contacto= new clContactoModelo();
        $dataContacto= $contacto->selectContactoById($_SESSION['id_contacto']);
        //$respuesta= new xajaxResponse();

        return $dataContacto;
    }

//	function validarContrasena($pass,$formulario){
//		$respuesta= new xajaxResponse();
//		$respuesta="";
//		if(strlen($pass)>7){
//			if(!(is_numeric($pass))){
//				if(!(IsAlpha($pass))) {
//					echo('ESTA BIEN LA CONTRASEÑA');
//
//
//
//
//
//				}else {$respuesta="nu";}
//			}else {$respuesta="le";}
//		}else {$respuesta="oc";}
//	echo $respuesta;
//	return $respuesta;
//	}


//	function validarContraseña($pass){
//		$respuesta= new xajaxResponse();
//		//$respuesta="";
//		if(strlen($pass)>7){
//			if(!(is_numeric($pass))){
//				if(!(IsAlpha($pass))) {
//					echo('ESTA BIEN LA CONTRASEÑA');
//					$respuesta="ok";
//				}else {$respuesta="nu";} //La contraseña debe tener al menos un número
//			}else {$respuesta="le";} //La contraseña debe tener al menos una letra
//		}else {$respuesta="oc";} //La contraseña debe tener al menos 8 dígitos
//	//echo $respuesta;
//	return $respuesta;
//
//	}
?>
