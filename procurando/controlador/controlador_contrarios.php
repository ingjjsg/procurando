<?php
require_once '../modelo/clProContrarios.php';
require_once '../comunes/php/utilidades.php';
require_once '../modelo/clConstantesModelo.php';
require_once '../modelo/clMaestroModelo.php';
require_once '../modelo/clPermisoModelo.php';


    function buscar_cedula_contrario($cedula,$id)
    {
	if ($id=='')
	{
		$respuesta= new xajaxResponse();
		$data= clProContrarios::getCedulaContrario($cedula);
		if($data) $respuesta->alert("Cedula ya Existe");
		return $respuesta;
	}
    }


function buscarDatosContrarios(){
        $respuesta= new xajaxResponse();
        $clientes= new clProContrarios();
        $formulario_accion=  clConstantesModelo::getFormulario_accion('contrarios','demandantes_litigio');
        $data= "";
        $html= ""; 
        $data= $clientes->SelectAll();
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_maestro')\">Id</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Cedula</a>
                                </th>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Apellido</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Accion</a>
                                </th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td align='center'>".$data[$i]['id_contrarios']."</td>
                            <td align='center' >".$data[$i]['strcedula']."</td>
                            <td>".$data[$i]['strnombre']."</td>
                            <td>".$data[$i]['strapellido']."</td>
                            <td>
                                <a>
                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Detalles Contrarios')\" onmouseout='UnTip()' onclick=\"location.href='reporte_contrarios.php?id=".$data[$i]['id_contrarios']."'\">
                                </a>";
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($formulario_accion['formulario']),'editar', $formulario_accion['accion'])){
                                $html.="<a>
                                    <img src='../comunes/images/table_edit.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"location.href='vista_nuevo_contrario.php?id=".$data[$i]['id_contrarios']."'\">
                                </a>";
                            }
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($formulario_accion['formulario']),'eliminar', $formulario_accion['accion'])){
                              $html.="<a>
                                    <img src='../comunes/images/table_delete.png' onmouseover='Tip(\"Eliminar\")' onmouseout='UnTip()' onclick=\"eliminar_contrario('".$data[$i]['id_contrarios']."')\">
                                </a>";
                            }
                            $html.="</td>
                        </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Contrarios Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        return $respuesta;
    }
    
    function selectAllContrariosFiltro($nombre="",$apellido="",$cedula="") {
        $respuesta= new xajaxResponse();
        $clientes= new clProContrarios();
        $formulario_accion=  clConstantesModelo::getFormulario_accion('contrarios','demandantes_litigio');
        $data= "";
        $html= ""; 
        $data= $clientes->selectAllContrariosFiltro($nombre,$apellido,$cedula);
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_maestro')\">Id</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Cedula</a>
                                </th>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Apellido</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Accion</a>
                                </th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td align='center'>".$data[$i]['id_contrarios']."</td>
                            <td align='center' >".$data[$i]['strcedula']."</td>
                            <td>".$data[$i]['strnombre']."</td>
                            <td>".$data[$i]['strapellido']."</td>
                            <td>
                                <a>
                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Detalles Contrarios')\" onmouseout='UnTip()' onclick=\"location.href='reporte_contrarios.php?id=".$data[$i]['id_contrarios']."'\">
                                </a>";
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($formulario_accion['formulario']),'editar', $formulario_accion['accion'])){
                                $html.="<a>
                                    <img src='../comunes/images/table_edit.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"location.href='vista_nuevo_contrario.php?id=".$data[$i]['id_contrarios']."'\">
                                </a>";
                            }
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($formulario_accion['formulario']),'eliminar', $formulario_accion['accion'])){
                              $html.="<a>
                                    <img src='../comunes/images/table_delete.png' onmouseover='Tip(\"Eliminar\")' onmouseout='UnTip()' onclick=\"eliminar_contrario('".$data[$i]['id_contrarios']."')\">
                                </a>";
                            }
                            $html.="</td>
                        </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Contrarios Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        return $respuesta;
    
    }
    
    
    
    function llenarSelectEstados($formInput, $select= "", $ancho= "50%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['estados'], 'stritema');
        $html= "<select id='id_estado' name='id_estado' style='width:".$ancho."' onchange=\"xajax_llenarSelectMunicipio(document.".$formInput.".id_estado.value)\">";
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
        $respuesta->assign("capaEstado","innerHTML",$html);
        return $respuesta;
    }
    
    function llenarSelectMunicipio($valor, $select= "", $ancho= "50%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";;
        $data= $maestro->selectAllMaestroHijos($valor, 'stritema');
        $html= "<select id='id_municipio' name='id_municipio' style='width:".$ancho."' onchange=\"xajax_llenarSelectMunicipio(document.".$formInput.".id_estado.value)\">";
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
        $respuesta->assign("capaMunicipio","innerHTML",$html);
        return $respuesta;
    }
    
    function llenarSelectEstadoCivil($select= "", $ancho= "50%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $combo= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($combo['estado_civil'], 'stritema');
        $html= "<select id='id_estado_civil' name='id_estado_civil' style='width:".$ancho."' \">";
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
        $respuesta->assign("capaEstadoCivil","innerHTML",$html);
        return $respuesta;
    }
    
    function llenarSelectSexo($select= "", $ancho= "50%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $combo= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($combo['sexo'], 'stritema');
        $html= "<select id='id_sexo' name='id_sexo' style='width:".$ancho."' \">";
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
        $respuesta->assign("capaSexo","innerHTML",$html);
        return $respuesta;
    }
    
    function guardar_contrario($request){
        $respuesta= new xajaxResponse();
        $cliente= new clProContrarios();
        $cliente->llenar($request);
        $data= $cliente->insertar();
        if($data){
            $respuesta->alert("El Contrario se guardo exitosamente");
        }else{
            $respuesta->alert("El Contrario no se ha guardado");
        }
        return $respuesta;
    }
    
    function selectContrario($lngcodigo){
        $respuesta= new xajaxResponse();
        $clientes= new clProContrarios();
        $data= "";
        $html= ""; 
        $data= $clientes->SelectAll($lngcodigo);
        if($data){
            $respuesta->assign('id_contrarios', 'value', $data[0]['id_contrarios']);
            $respuesta->assign('strnombre', 'value', $data[0]['strnombre']);
            $respuesta->assign('strapellido', 'value', $data[0]['strapellido']);
            $respuesta->assign('strcedula', 'value', $data[0]['strcedula']);
            $respuesta->script('xajax_llenarSelectEstados("frmcliente_nuevo",'.$data[0]['id_estado'].')');
            $respuesta->script('xajax_llenarSelectMunicipio('.$data[0]['id_estado'].','.$data[0]['id_municipio'].')');
            $respuesta->assign('strdireccion', 'value', $data[0]['strdireccion']);
            $respuesta->assign('strtelefono', 'value', $data[0]['strtelefono']);
            $respuesta->assign('stremail', 'value', $data[0]['stremail']);
            $respuesta->script('xajax_llenarSelectEstadoCivil('.$data[0]['id_estado_civil'].')');
            $respuesta->script('xajax_llenarSelectSexo('.$data[0]['id_sexo'].')');
            $respuesta->assign('inthijos', 'value', $data[0]['inthijos']);
            $respuesta->assign('strcodigopostal', 'value', $data[0]['strcodigopostal']);
            $respuesta->assign('datefecnac', 'value', $data[0]['datefecnac']);
            $respuesta->assign('strobservacion', 'value', $data[0]['strobservacion']);
/*            if($data[0]['id_representante'] == 1){
                $respuesta->assign('id_representante', 'checked',true);
            }
            
            $respuesta->assign('id_organizacion', 'value', $data[0]['id_organizacion']);
            $respuesta->assign('strdocumentoconst', 'value', $data[0]['strdocumentoconst']);
            $respuesta->assign('strrif', 'value', $data[0]['strrif']);
            $respuesta->assign('strmovil', 'value', $data[0]['strmovil']);*/
            
        }
        return $respuesta;
    }
    
    function editar_contrario($request){
        $respuesta= new xajaxResponse();
        $cliente= new clProContrarios();
        $cliente->llenar($request);
        $data= $cliente->Update();
        if($data){
            $respuesta->alert("El Contrario se actualizo exitosamente");
        }else{
            $respuesta->alert("El Contrario no se ha actualizado");
        }
        return $respuesta;
    }
    
    function eliminar_contrario($id_cliente){
        $respuesta = new xajaxResponse();
        $cliente = new clProContrarios();
            $data = $cliente->Delete($id_cliente);
             if($data){
                $respuesta->alert("El Contrario se ha Eliminado");
                $respuesta->script("xajax_buscarDatosContrarios()");
            }else{
                $respuesta->alert("El Contrarios no se ha Eliminado");
            }
        
        
        return $respuesta;
    }
    
    function validar_contrario($request){
        $respuesta = new xajaxResponse();
        if($request['strnombre'] == ""){
            $respuesta->alert("Ingrese un Nombre");
            $respuesta->script("document.frmcontrario_nuevo.strnombre.focus()");
        }else if($request['strapellido'] == ""){
            $respuesta->alert("Ingrese un Apellido");
            $respuesta->script("document.frmcontrario_nuevo.strapellido.focus()");
        }else if($request['strcedula'] == ""){
             $respuesta->alert("Ingrese una Cedula");
             $respuesta->script("document.frmcontrario_nuevo.strcedula.focus()");
        }else if($request['strdireccion'] == ""){
             $respuesta->alert("Ingrese una Direccion");
             $respuesta->script("document.frmcontrario_nuevo.strdireccion.focus()");
        }else if($request['id_estado'] == 0){
             $respuesta->alert("Seleccione un Estado");
             $respuesta->script("document.frmcontrario_nuevo.id_estado.focus()");
        }else if($request['id_municipio'] == 0){
             $respuesta->alert("Seleccione un Municipio");
             $respuesta->script("document.frmcontrario_nuevo.id_municipio.focus()");
        }else if($request['strtelefono'] == ""){
             $respuesta->alert("Ingrese un telefono");
             $respuesta->script("document.frmcontrario_nuevo.strtelefono.focus()");
        }else if($request['stremail'] == ""){
             $respuesta->alert("Ingrese un Email");
             $respuesta->script("document.frmcontrario_nuevo.stremail.focus()");
        }else if($request['id_estado_civil'] == 0){
             $respuesta->alert("Seleccione un Estado Civil");
             $respuesta->script("document.frmcontrario_nuevo.id_estado_civil.focus()");
        }elseif($request['id_sexo'] == 0){
             $respuesta->alert("Seleccione un Sexo");
             $respuesta->script("document.frmcontrario_nuevo.id_sexo.focus()");
        }elseif($request['datefecnac'] == ""){
             $respuesta->alert("Ingrese una Fecha de Nacimiento");
             $respuesta->script("document.frmcontrario_nuevo.datefecnac.focus()");
        }else{
           
            $respuesta->script("xajax_guardar_contrario(xajax.getFormValues('frmcontrario_nuevo'))");
        }
        
        return $respuesta;
    }
?>
