<?php
    session_start();
    
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/ctblprohonorariosModelo.php';
    require_once '../modelo/ctblprounidadtributariaModelo.php';    
    require_once '../comunes/php/utilidades.php';
    require_once '../modelo/clConstantesModelo.php';
    require_once '../modelo/clFunciones.php';    
    require_once '../herramientas/herramientas.class.php';
    require_once '../modelo/clPermisoModelo.php';

    verificarSession();
    
    function formulario_accion(){
    $permiso= Array();
    if ($_SESSION['id_oficina']=='L') {
        $permiso['formulario']='honorario_litigio';
        $permiso['accion']='acciones_honorario_litigio';
    }
    else {
        $permiso['formulario']='honorarios';
        $permiso['accion']='acciones_abogados_honorarios';
    }
    
    return $permiso;
}
    
    function multiplicar_unidad($id_unidad=0,$numuni=0){
        $respuesta= new xajaxResponse();
        $functions= new functions();       
        if($id_unidad>0)
        {
            if($numuni>0)
            {
                $precio=cltblunidadtributariModelo::getSelectUnidad($id_unidad);
                $monto=($numuni*$functions->toFloat($precio));
                $respuesta->assign("costo","value",clFunciones::FormatoMonto($monto)." BSF");             
            }          
            else
                $respuesta->alert("La unidad Tributaria Tiene que ser Mayor que cero");
        }else{
            $respuesta->alert("Año de la Unidad Tributaria esta Vacio");
        }
        return $respuesta;
    }        
    
   function llenarSelectTipoAno($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $unidad= new cltblunidadtributariModelo();
        $data= "";
        $html= "";
        $data= $unidad->selectAllUnidad();
        $html= "<select id='id_unidad' name='id_unidad' style='width:".$ancho."'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_unidad']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_unidad']."' ".$seleccionar.">".$data[$i]['ano']."</option>";
            }
            $html.= "</select>";
        }
       
        $respuesta->assign("capaAno","innerHTML",$html);
        return $respuesta;
    } 
    
   function llenarSelectTipoTramite($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_tramite'], 'stritema');
        $html= "<select id='id_tramite' name='id_tramite' style='width:".$ancho."'>";
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
       
        $respuesta->assign("capaIdTipoTramite","innerHTML",$html);
        return $respuesta;
    } 

   function llenarSelectTipoHonorario($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['honorarios'], 'stritema');
//        exit(print_r($data));        
        $html= "<select id='id_tipo' name='id_tipo' style='width:".$ancho."'>";
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
        $respuesta->assign("capaTipo","innerHTML",$html);
        return $respuesta;
    }    
            
    
    function selectAllHonorarios($fil_id_tipo='0', $fil_id_tramite='0', $fil_id_unidad='0'){
        $respuesta= new xajaxResponse();
        $prohonorarios= new cltblprohonorariosModelo();
        $permiso=  formulario_accion();
        $data= "";
        $html= "";
	if ((empty($fil_id_tipo)) or empty($fil_id_tramite) or empty($fil_id_unidad))  
            $data= $prohonorarios->selectFiltrarHonorarios($fil_id_tipo, $fil_id_tramite, $fil_id_unidad);
        else
            $data= $prohonorarios->selectAllHonorarios();
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_honorarios')\">Id</a>
                                </th>                            
                                <th width='40%'>
                                    <a href='#' onclick=\"xajax_orden('id_tipo')\">Tipo</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('Tramite')\">Tramite</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('Unidad')\">Costo C.</a>
                                </th>                                
                                <th width='10%'>Acci&oacute;n</th>
                            </tr></table>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<table border='0' class='tablaTitulo' width='100%'><tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='10%' align='center'>".$data[$i]['id_honorarios']."</td>
                            <td width='40%' align='left'>".$data[$i]['id_tipo_honorario']."</td>
                            <td width='30%'>".$data[$i]['id_tramite_honorario']."</td>
                            <td width='10%' align='center'>".clFunciones::FormatoMonto($data[$i]['id_unidad_honorario']*$data[$i]['numunidad'])." BSF</td>                                
                            <td width='20%' align='right'>";
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($permiso['formulario']),'editar', clConstantesModelo::$permiso['accion']())){
                                $html.="<a>
                                    <img src='../comunes/images/ico_18_127.gif' onmouseover='Tip(\"Editar Honorario ".$data[$i]['strnombre']."\")' onmouseout='UnTip()' onclick=\"javascript:location.href='vista_Ingresotblprohonorarios.php?id=".$data[$i]['id_honorarios']."'\";\">
                                </a>";
                            }
                                
                           $html.=" </td>
                        </tr></table>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Items Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        return $respuesta;
    }
    

    
 
    function insertHonorarios($formulario) {
        $respuesta= new xajaxResponse();
        $honorario= new cltblprohonorariosModelo();
        $function= new functions();        
        $id=""; 
        $msg="";        
        $honorario->llenar($formulario);     
        if ($honorario->getId_tipo()=='0')
        {
            $respuesta->alert('Campo Vacio en Tipo de Honorario');
            return $respuesta;          
        }   

        if ($honorario->getId_tramite()=='0')
        {
            $respuesta->alert('Campo Vacio en Tipo de Tramite');
            return $respuesta;          
        }   
        if ($honorario->getId_unidad()=='0')
        {
            $respuesta->alert('Campo Vacio en el Año');
            return $respuesta;          
        }   
        if (!$function->validar_input_numerico($honorario->getNumunidad(),'Unidad',&$msg))                
        {
            $respuesta->alert($msg);
            return $respuesta;          
        }            
        $data1="";
        $data2="";        
        if ($honorario->getId_honorarios()==''){
            $data1= $honorario->selectFiltrarHonorarios($honorario->getId_tipo(), $honorario->getId_tramite(), $honorario->getId_unidad());
            if (is_array($data1)) 
                    $respuesta->alert("¡El Registro Ya Existe!");   
            else
            {    
               $id=$honorario->insertHonorario();                       
               $respuesta->assign("id_honorarios","value",$id[0][id_honorarios]);    
               $respuesta->alert("¡El Registro se ha guardado exitosamente!'");                 
            }
        }
        else{
            $data2= $honorario->selectFiltrarHonorarios($honorario->getId_tipo(), $honorario->getId_tramite(), $honorario->getId_unidad());
            if (is_array($data2)){ 
                if (count($data2) > 0)
                {
                    if($honorario->getId_honorarios()==$data2[0][id_honorarios])
                    {
                        $honorario->updateHonorarios();   
                        $respuesta->alert("¡El Registro se ha Actualizado exitosamente!");                           
                    }
                    else        
                        $respuesta->alert("¡El Registro Ya Existe!");   
                }
            }
            else {
                        $honorario->updateHonorarios();   
                        $respuesta->alert("¡El Registro se ha Actualizado exitosamente!");   
            }
 
        }
	return $respuesta;
    }    
    
    function selectHonorario($formulario) {
        $respuesta= new xajaxResponse();
        $honorario= new cltblprohonorariosModelo();
        $honorario->llenar($formulario);           
        $data= "";
        if ($honorario->getId_honorarios()!='')
            $data= $honorario->selectHonorario();
        else {
             $respuesta->alert("¡Error Consulte con el Administrador de Sistema ó al correo ingjjsg@gmail.com!"); 
             $respuesta->script("location.href='vista_tblprojuzgados.php'");                
             return $respuesta;
        }
        if (is_array($data))
        {
            $monto=0;
            $respuesta->script('xajax_llenarSelectTipoHonorario("frminserthonorarios","'.$data[0][id_tipo].'")');   
            $respuesta->script('xajax_llenarSelectTipoTramite("frminserthonorarios",'.$data[0][id_tramite].')');   
            $respuesta->script('xajax_llenarSelectTipoAno("frminserthonorarios",'.$data[0][id_unidad].')');               
            $respuesta->assign("id_honorarios","value",$data[0][id_honorarios]);    
            $respuesta->assign("numunidad","value",$data[0][numunidad]);    
            $monto=($data[0][numunidad]*$data[0][intprecio])." BSF";
            $respuesta->assign("costo","value",clFunciones::FormatoMonto($monto));                
//            $respuesta->assign("save","innerHTML",'');           
//            $respuesta->script("$('save').hide();");                 
        }
        else 
        {
            $respuesta->alert("¡Registro no Encontrado!");                 
        }
        return $respuesta;
    }    
    function eliminarHonorario($formulario) {
        $respuesta= new xajaxResponse();
        $honorario= new cltblprohonorariosModelo();
        $honorario->llenar($formulario);           
        if ($honorario->getId_honorarios()!='')
            /*validacion de uso en otras tablas*/
            $honorario->deleteHonorario();
        else {
             $respuesta->script("location.href='vista_tblprojuzgados.php'");             
             return $respuesta;
        }
        $respuesta->script("location.href='vista_tblprohonorarios.php'");        
        $respuesta->alert("¡Registro Eliminado Exitosamente!");  
        return $respuesta;
    }
    
    
    function selectAllHonorariosLitigio($fil_id_tipo='0', $fil_id_tramite='0', $fil_id_unidad='0'){
        $respuesta= new xajaxResponse();
        $prohonorarios= new cltblprohonorariosModelo();
        $permiso=  formulario_accion();
        $data= "";
        $html= "";
	if ((empty($fil_id_tipo)) or empty($fil_id_tramite) or empty($fil_id_unidad))  
            $data= $prohonorarios->selectFiltrarHonorariosLitigio($fil_id_tipo, $fil_id_tramite, $fil_id_unidad);
        else
            $data= $prohonorarios->selectAllHonorariosLitigio();
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_honorarios')\">Id</a>
                                </th>                            
                                <th width='40%'>
                                    <a href='#' onclick=\"xajax_orden('id_tipo')\">Tipo</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('Tramite')\">Tramite</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('Unidad')\">Costo C.</a>
                                </th>                                
                                <th width='10%'>Acci&oacute;n</th>
                            </tr></table>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<table border='0' class='tablaTitulo' width='100%'><tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='10%' align='center'>".$data[$i]['id_honorarios']."</td>
                            <td width='40%' align='left'>".$data[$i]['id_tipo_honorario']."</td>
                            <td width='30%'>".$data[$i]['id_tramite_honorario']."</td>
                            <td width='10%' align='center'>".clFunciones::FormatoMonto($data[$i]['id_unidad_honorario']*$data[$i]['numunidad'])." BSF</td>                                
                            <td width='20%' align='right'>";
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($permiso['formulario']),'editar', clConstantesModelo::$permiso['accion']())){
                                $html.="<a>
                                    <img src='../comunes/images/ico_18_127.gif' onmouseover='Tip(\"Editar Honorario ".$data[$i]['strnombre']."\")' onmouseout='UnTip()' onclick=\"javascript:location.href='vista_Ingresotblprohonorarios.php?id=".$data[$i]['id_honorarios']."'\";\">
                                </a>";
                            }
                                
                           $html.=" </td>
                        </tr></table>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Items Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        return $respuesta;
    }
    

    
 
    function insertHonorariosLitigio($formulario) {
        $respuesta= new xajaxResponse();
        $honorario= new cltblprohonorariosModelo();
        $function= new functions();        
        $id=""; 
        $msg="";        
        $honorario->llenar($formulario);     
        if ($honorario->getId_tipo()=='0')
        {
            $respuesta->alert('Campo Vacio en Tipo de Honorario');
            return $respuesta;          
        }   

        if ($honorario->getId_tramite()=='0')
        {
            $respuesta->alert('Campo Vacio en Tipo de Tramite');
            return $respuesta;          
        }   
        if ($honorario->getId_unidad()=='0')
        {
            $respuesta->alert('Campo Vacio en el Año');
            return $respuesta;          
        }   
        if (!$function->validar_input_numerico($honorario->getNumunidad(),'Unidad',&$msg))                
        {
            $respuesta->alert($msg);
            return $respuesta;          
        }            
        $data1="";
        $data2="";        
        if ($honorario->getId_honorarios()==''){
            $data1= $honorario->selectFiltrarHonorariosLitigio($honorario->getId_tipo(), $honorario->getId_tramite(), $honorario->getId_unidad());
            if (is_array($data1)) 
                    $respuesta->alert("¡El Registro Ya Existe!");   
            else
            {    
               $id=$honorario->insertHonorarioLitigio();                       
               $respuesta->assign("id_honorarios","value",$id[0][id_honorarios]);    
               $respuesta->alert("¡El Registro se ha guardado exitosamente!'");                 
            }
        }
        else{
            $data2= $honorario->selectFiltrarHonorariosLitigio($honorario->getId_tipo(), $honorario->getId_tramite(), $honorario->getId_unidad());
            if (is_array($data2)){ 
                if (count($data2) > 0)
                {
                    if($honorario->getId_honorarios()==$data2[0][id_honorarios])
                    {
                        $honorario->updateHonorarios();   
                        $respuesta->alert("¡El Registro se ha Actualizado exitosamente!");                           
                    }
                    else        
                        $respuesta->alert("¡El Registro Ya Existe!");   
                }
            }
        }
	return $respuesta;
    }
    
    function llenarSelectTipoHonorarioLitigio($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_tramite_litigio'], 'stritema');
       //exit(print_r($data));        
        $html= "<select id='id_tipo' name='id_tipo' style='width:".$ancho."'>";
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
        $respuesta->assign("capaTipo","innerHTML",$html);
        return $respuesta;
    }
    
    
    function llenarSelectTipoTramiteLitigio($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_atencion_litigio'], 'stritema');
        $html= "<select id='id_tramite' name='id_tramite' style='width:".$ancho."'>";
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
       
        $respuesta->assign("capaIdTipoTramite","innerHTML",$html);
        return $respuesta;
    }
?>
