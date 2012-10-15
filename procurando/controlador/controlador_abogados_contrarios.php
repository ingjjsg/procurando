<?php
session_start();
require_once '../modelo/clProAbogadosContrarios.php';
require_once '../comunes/php/utilidades.php';
require_once '../modelo/clConstantesModelo.php';
require_once '../modelo/clMaestroModelo.php';
require_once '../modelo/clPermisoModelo.php';

 
    
function formulario_accion(){
    $permiso= Array();
    if ($_SESSION['id_oficina']=='L') {
        $permiso['formulario']='abogados_demandantes';
        $permiso['accion']='acciones_abogados_demandantes';
    }
    else {
        $permiso['formulario']='abogados_contrarios';
        $permiso['accion']='acciones_abogados_contrarios';
    }
    
    return $permiso;
}

function buscarDatosAbogadosContrarios(){
        $respuesta= new xajaxResponse();
        $abogados= new clProAbogadosContrarios();
        $permiso=  formulario_accion();
        $data= "";
        $html= "";
        $data= $abogados->SelectAll();
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_abogadoscon')\">Id</a>
                                </th>
                                <th width='15%'>
                                    <a href='#' onclick=\"xajax_orden('strcedula')\">Cedula</a>
                                </th>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('strnombre')\">Nombre</a>
                                </th>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('strapellido')\">Apellido</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('strtelefono')\">Teléfono</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Accion</a>
                                </th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='5%' align='center'>".$data[$i]['id_abogadoscon']."</td>
                            <td width='15%' align='center' >".$data[$i]['strcedula']."</td>
                            <td width='25%'>".$data[$i]['strnombre']."</td>
                            <td width='25%'>".$data[$i]['strapellido']."</td>
                            <td width='20%'>".$data[$i]['strtelefono']."</td>                                
                            <td width='10%'>
                                <a>
                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Detalles Abogados')\" onmouseout='UnTip()' onclick=\"location.href='reporte_abogados_contrarios.php?id=".$data[$i]['id_abogadoscon']."'\">
                                </a>";
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($permiso['formulario']),'editar', clConstantesModelo::$permiso['accion']())){
                                $html.="<a>
                                    <img src='../comunes/images/table_edit.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"location.href='vista_nuevo_abogado_contrario.php?id=".$data[$i]['id_abogadoscon']."'\">
                                </a>";
                            }
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($permiso['formulario']),'eliminar', clConstantesModelo::$permiso['accion']())){
                                $html.="<a>
                                    <img src='../comunes/images/table_delete.png' onmouseover='Tip(\"Eliminar\")' onmouseout='UnTip()' onclick=\"eliminar_abogado('".$data[$i]['id_abogadoscon']."')\">
                                </a>";
                            }
                            $html.="</td>
                        </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Abogados Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        return $respuesta;
    }
    
    function SelectAllAbogadosContrariosFiltro($nombre="",$apellido="",$cedula="") {
        $respuesta= new xajaxResponse();
        $clientes= new clProAbogadosContrarios();
        $permiso=  formulario_accion();
        $data= "";
        $html= ""; 
        $data= $clientes->SelectAllAbogadosContrariosFiltro($nombre,$apellido,$cedula);
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_abogadoscon')\">Id</a>
                                </th>
                                <th width='15%'>
                                    <a href='#' onclick=\"xajax_orden('strcedula')\">Cedula</a>
                                </th>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('strnombre')\">Nombre</a>
                                </th>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('strapellido')\">Apellido</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('strtelefono')\">Teléfono</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Accion</a>
                                </th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='5%' align='center'>".$data[$i]['id_abogadoscon']."</td>
                            <td width='15%' align='center' >".$data[$i]['strcedula']."</td>
                            <td width='25%'>".$data[$i]['strnombre']."</td>
                            <td width='25%'>".$data[$i]['strapellido']."</td>
                            <td width='20%'>".$data[$i]['strtelefono']."</td>                                
                            <td width='10%'>
                                <a>
                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Detalles Abogados')\" onmouseout='UnTip()' onclick=\"location.href='reporte_abogados_contrarios.php?id=".$data[$i]['id_abogadoscon']."'\">
                                </a>";
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($permiso['formulario']),'editar', clConstantesModelo::$permiso['accion']())){
                                $html.="<a>
                                    <img src='../comunes/images/table_edit.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"location.href='vista_nuevo_abogado_contrario.php?id=".$data[$i]['id_abogadoscon']."'\">
                                </a>";
                            }
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($permiso['formulario']),'eliminar', clConstantesModelo::$permiso['accion']())){
                                $html.="<a>
                                    <img src='../comunes/images/table_delete.png' onmouseover='Tip(\"Eliminar\")' onmouseout='UnTip()' onclick=\"eliminar_abogado('".$data[$i]['id_abogadoscon']."')\">
                                </a>";
                            }
                            $html.="</td>
                        </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Clientes Registrados</div>";
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
    
    function llenarSelectBanco($select= "", $ancho= "50%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $combo= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($combo['banco'], 'stritema');
        $html= "<select id='intbanco' name='intbanco' style='width:".$ancho."' \">";
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
        $respuesta->assign("capaBanco","innerHTML",$html);
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
    
    function guardar_abogado($request){
        $respuesta= new xajaxResponse();
        $abogado= new clProAbogadosContrarios();
        $abogado->llenar($request);
        $data= $abogado->insertar();
        if($data){
            $respuesta->alert("El abogado se guardo exitosamente");
        }else{
            $respuesta->alert("El abogado no se ha guardado");
        }
        return $respuesta;
    }
    
    function selectAbogadoContrario($lngcodigo) {
    $respuesta = new xajaxResponse();
    $abogado = new clProAbogadosContrarios();
    $data = "";
    $html = "";
    $data = $abogado->SelectAll($lngcodigo);
    if ($data) {
        $respuesta->assign('id_abogadoscon', 'value', $data[0]['id_abogadoscon']);
        $respuesta->assign('strnombre', 'value', $data[0]['strnombre']);
        $respuesta->assign('strapellido', 'value', $data[0]['strapellido']);
        $respuesta->assign('strcedula', 'value', $data[0]['strcedula']);
        $respuesta->script('xajax_llenarSelectEstados("frmabogado_contrario_nuevo",' . $data[0]['id_estado'] . ')');
        $respuesta->script('xajax_llenarSelectMunicipio(' . $data[0]['id_estado'] . ',' . $data[0]['id_municipio'] . ')');
        $respuesta->assign('strdireccion', 'value', $data[0]['strdireccion']);
        $respuesta->assign('strtelefono', 'value', $data[0]['strtelefono']);
        $respuesta->assign('stremail', 'value', $data[0]['stremail']);
//        $respuesta->script('xajax_llenarSelectSexo(' . $data[0]['id_sexo'] . ')');
//        $respuesta->script('xajax_llenarSelectBanco(' . $data[0]['intbanco'] . ')');
        $respuesta->assign('strcodigopostal', 'value', $data[0]['strcodigopostal']);
        $respuesta->assign('strobservaciones', 'value', $data[0]['strobservaciones']);
        $respuesta->assign('strlocalidad', 'value', $data[0]['strlocalidad']);
        $respuesta->assign('strfax', 'value', $data[0]['strfax']);
        $respuesta->assign('strpin', 'value', $data[0]['strpin']);
        $respuesta->assign('strnif_cif', 'value', $data[0]['strnif_cif']);
//        $respuesta->assign('intbanco', 'value', $data[0]['intbanco']);
//        $respuesta->assign('strcuentaban', 'value', $data[0]['strcuentaban']);
//        $respuesta->assign('foto', 'innerHTML', "<img width='100' height='120' src='fotos/".$data[0]['strfoto']."' />");
//        $respuesta->assign('strfoto', 'value', $data[0]['strfoto']);
        $respuesta->assign('strcurriculum', 'value', $data[0]['strcurriculum']);
        $respuesta->assign('strnumcolegiado', 'value', $data[0]['strnumcolegiado']);
//        $respuesta->assign('strfoto', 'value', $data[0]['strfoto']);


        $respuesta->assign('strrif', 'value', $data[0]['strrif']);
        $respuesta->assign('strmovil', 'value', $data[0]['strmovil']);
    }
    return $respuesta;
}
    
    function editar_abogado($request){
        $respuesta= new xajaxResponse();
        $cliente= new clProAbogadosContrarios();
        $cliente->llenar($request);
        $data= $cliente->Update();
        if($data){
            $respuesta->alert("El Abogado se actualizo exitosamente");
        }else{
            $respuesta->alert("El Abogado no se ha actualizado");
        }
        return $respuesta;
    }
    
    function eliminar_abogado($id_abogado){
        $respuesta = new xajaxResponse();
        $cliente = new clProAbogadosContrarios();
            $data = $cliente->Delete($id_abogado);
             if($data){
                $respuesta->alert("El Abogado se ha Eliminado");
                $respuesta->script("xajax_buscarDatosAbogadosContrarios()");
            }else{
                $respuesta->alert("El Abogado no se ha Eliminado");
            }
        
        
        return $respuesta;
    }
    
    function validar_abogado($request){
        $respuesta = new xajaxResponse();
        if($request['strnombre'] == ""){
            $respuesta->alert("Ingrese un Nombre");
            $respuesta->script("document.frmabogado_nuevo.strnombre.focus()");
        }else if($request['strapellido'] == ""){
            $respuesta->alert("Ingrese un Apellido");
            $respuesta->script("document.frmabogado_nuevo.strapellido.focus()");
        }else if($request['strcedula'] == ""){
             $respuesta->alert("Ingrese una Cedula");
             $respuesta->script("document.frmabogado_nuevo.strcedula.focus()");
        }else if($request['strdireccion'] == ""){
             $respuesta->alert("Ingrese una Direccion");
             $respuesta->script("document.frmcliente_nuevo.strdireccion.focus()");
        }else if($request['id_estado'] == 0){
             $respuesta->alert("Seleccione un Estado");
             $respuesta->script("document.frmabogado_nuevo.id_estado.focus()");
        }else if($request['id_municipio'] == 0){
             $respuesta->alert("Seleccione un Municipio");
             $respuesta->script("document.frmabogado_nuevo.id_municipio.focus()");
        }else if($request['strtelefono'] == ""){
             $respuesta->alert("Ingrese un telefono");
             $respuesta->script("document.frmabogado_nuevo.strtelefono.focus()");
        }else if($request['stremail'] == ""){
             $respuesta->alert("Ingrese un Email");
             $respuesta->script("document.frmabogado_nuevo.stremail.focus()");
//        }elseif($request['id_sexo'] == 0){
//             $respuesta->alert("Seleccione un Sexo");
//             $respuesta->script("document.frmabogado_nuevo.id_sexo.focus()");
        }else{
           
            $respuesta->script("xajax_guardar_abogado(xajax.getFormValues('frmabogado_contrario_nuevo'))");
        }
        
        return $respuesta;
    }
?>