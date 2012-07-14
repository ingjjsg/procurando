<?php
    session_start();
    
    require_once '../modelo/ctblprojuzgados.php';
    require_once '../comunes/php/utilidades.php';
    require_once '../modelo/clConstantesModelo.php';
    require_once '../herramientas/herramientas.class.php';
    require_once '../modelo/clMaestroModelo.php';    
    verificarSession();

    function llenarSelectEstados($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['estados'], 'stritema');
        $html= "<select id='idestado' name='idestado' style='width:".$ancho."' onchange=\"xajax_llenarSelectMunicipio(document.".$formInput.".idestado.value)\">";
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
        $respuesta->assign("capaIdestado","innerHTML",$html);
        return $respuesta;
    }    
    
    function llenarSelectMunicipio($valor, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";;
        $data= $maestro->selectAllMaestroHijos($valor, 'stritema');
        $html= "<select id='idmunicipio' name='idmunicipio' style='width:".$ancho."' onchange=\"xajax_llenarSelectMunicipio(document.".$formInput.".idestado.value)\">";
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
        $respuesta->assign("capaIdmunicipio","innerHTML",$html);
        return $respuesta;
    }    
    
    function selectAllJuzgados($fil_strnombre){
        $respuesta= new xajaxResponse();
        $proJuzgados= new cltblprojuzgadosModelo();
        $data= "";
        $html= "";
	if (empty($fil_strnombre))  {
//            exit("paso");
            $data= $proJuzgados->selectFiltrarJuzgados($fil_strnombre);            
        }
        else
            $data= $proJuzgados->selectAllJuzgados();        
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_juzgados')\">Id</a>
                                </th>                            
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('strnombre')\">Nombre</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('strdireccion')\">Dirección</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('strtelefono')\">Teléfono</a>
                                </th>                                
                                <th width='10%'>Acci&oacute;n</th>
                            </tr></table>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<table border='0' class='tablaTitulo' width='100%'><tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='10%' align='center'>".$data[$i]['id_juzgados']."</td>
                            <td width='30%' align='center'>".$data[$i]['strnombre']."</td>
                            <td width='30%'>".$data[$i]['strdireccion']."</td>
                            <td width='20%' align='center'>".$data[$i]['strtelefono']."</td>                                
                            <td width='10%' align='center'>
                                <a>
                                    <img src='../comunes/images/ico_18_127.gif' onmouseover='Tip(\"Editar Juzgado ".$data[$i]['strnombre']."\")' onmouseout='UnTip()' onclick=\"javascript:location.href='vista_Ingresotblprojuzgados.php?id=".$data[$i]['id_juzgados']."'\";\">
                                </a>
                            </td>
                        </tr></table>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Items Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        return $respuesta;
    }
    
 
    function insertJuzgados($formulario) {
        $respuesta= new xajaxResponse();
        $proJuzgados= new cltblprojuzgadosModelo();
        $function= new functions();
        $id=""; 
        $msg="";
        $proJuzgados->llenar($formulario);        
        $function->validar_input($proJuzgados->getStrnombre(),'Nombre',&$msg);
	if ($msg)
        {
            $respuesta->alert($msg);
            return $respuesta;          
        }
        $function->validar_input($proJuzgados->getStrdireccion(),'Dirección',&$msg);
	if ($msg)
        {
            $respuesta->alert($msg);
            return $respuesta;          
        }        
        $function->validar_input($proJuzgados->getStrlocalidad(),'Localidad',&$msg);
	if ($msg)
        {
            $respuesta->alert($msg);
            return $respuesta;          
        }   
        $function->validar_input($proJuzgados->getStrtelefono(),'Teléfono',&$msg);
	if ($msg)
        {
            $respuesta->alert($msg);
            return $respuesta;          
        }                
        if ($proJuzgados->getId_juzgados()==''){
            $id=$proJuzgados->insertJuzgado(); 
            $respuesta->assign("id_juzgados","value",$id[0][id_juzgados]);    
            $respuesta->alert("¡Registro guardado exitosamente!'");            
        }
        else{
            $proJuzgados->updateJuzgados();                      
            $respuesta->alert("¡Registro Actualizado exitosamente!");            
        }
	return $respuesta;
    }    
    
    function selectJuzgado($formulario) {
        $respuesta= new xajaxResponse();
        $proJuzgados= new cltblprojuzgadosModelo();
        $proJuzgados->llenar($formulario);           
        $data= "";
        if ($proJuzgados->getId_Juzgados()!='')
            $data= $proJuzgados->selectJuzgado();
        else {
             $respuesta->alert("¡Error Consulte con el Administrador de Sistema ó al correo ingjjsg@gmail.com!"); 
             $respuesta->script("location.href='vista_tblprojuzgados.php'");                     
             return $respuesta;
        }
        if (is_array($data))
        {
            $respuesta->assign("id_juzgados","value",$data[0][id_juzgados]);    
            $respuesta->assign("strnombre","value",$data[0][strnombre]);  
            $respuesta->assign("strdireccion","value",$data[0][strdireccion]);  
            $respuesta->assign("strlocalidad","value",$data[0][strlocalidad]);  
            $respuesta->assign("strtelefono","value",$data[0][strtelefono]);  
            $respuesta->assign("strfax","value",$data[0][strfax]);  
            $respuesta->assign("strobservaciones","value",$data[0][strobservaciones]);    
            $respuesta->script('xajax_llenarSelectEstados("frmJuzgados",'.$data[0][idestado].')');
            $respuesta->script('xajax_llenarSelectMunicipio('.$data[0][idestado].','.$data[0][idmunicipio].')');            
            $respuesta->assign("save","innerHTML",'');           
            $respuesta->script("$('save').hide();");                 
        }
        else 
        {
            $respuesta->alert("¡Registro no Encontrado!");                 
        }
        return $respuesta;
    }    
    function eliminarJuzgado($formulario) {
        $respuesta= new xajaxResponse();
        $proJuzgados= new cltblprojuzgadosModelo();
        $proJuzgados->llenar($formulario);           
        if ($proJuzgados->getId_juzgados()!='')
            /*validacion de uso en otras tablas*/
            $proJuzgados->deleteJuzgado();
        else {
             $respuesta->script("location.href='vista_tblprojuzgados.php'");             
             return $respuesta;
        }
        $respuesta->script("location.href='vista_tblprojuzgados.php'");        
        $respuesta->alert("¡Registro Eliminado Exitosamente!");  
        return $respuesta;
    }        
?>
