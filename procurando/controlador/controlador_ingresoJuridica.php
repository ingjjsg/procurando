<?php
session_start();
require_once '../modelo/clProAsociaciones.php';
require_once '../modelo/clProClientes.php';
require_once '../comunes/php/utilidades.php';
require_once '../modelo/clConstantesModelo.php';
require_once '../modelo/clFunciones.php';
require_once '../modelo/clPermisoModelo.php';

verificarSession();

    function buscar_rif($rif,$id)
    {
	if ($id=='')
	{
		$respuesta= new xajaxResponse();
		$data= clTblasociaciones::getrifAsociasion($rif);
		if($data) $respuesta->alert("RIF ya Existe");
		return $respuesta;
	}
    }

    function validar($request){
        $respuesta = new xajaxResponse();
        if($request['strnombre_asociacion'] == ""){
            $respuesta->alert("Ingrese una Razón Social");
            $respuesta->script("document.frmcliente_nuevo.strnombre_asociacion.focus()");
        }else if($request['dtmfechafun'] == ""){
            $respuesta->alert("Ingrese Fecha de Fundación");
            $respuesta->script("document.frmcliente_nuevo.dtmfechafun.focus()");
        }else if($request['strtelefono_asociacion'] == ""){
             $respuesta->alert("Ingrese un Teléfono de Contacto");
             $respuesta->script("document.frmcliente_nuevo.strtelefono_asociacion.focus()");
        }else if($request['strdireccion_asociacion'] == ""){
             $respuesta->alert("Ingrese una Dirección");
             $respuesta->script("document.frmcliente_nuevo.strdireccion_asociacion.focus()");
        }else if($request['strrif'] == ""){
             $respuesta->alert("Ingrese el Rif");
             $respuesta->script("document.frmcliente_nuevo.strrif.focus()");
        }else if($request['id_municipio_asociacion'] == 0){
             $respuesta->alert("Seleccione un Municipio");
             $respuesta->script("document.frmcliente_nuevo.id_municipio_asociacion.focus()");
        }else if($request['id_parroquia_asociacion'] == 0){
             $respuesta->alert("Seleccione una Parroquia");
             $respuesta->script("document.frmcliente_nuevo.id_parroquia_asociacion.focus()");
        }else if($request['id_ramo'] == 0){
             $respuesta->alert("Seleccione un Ramo");
             $respuesta->script("document.frmcliente_nuevo.id_ramo.focus()");
        }else if($request['id_cliente'] == ""){
             $respuesta->alert("Seleccione un Representante");
             $respuesta->script("document.frmcliente_nuevo.id_cliente.focus()");
        }else{
           
            $respuesta->script("xajax_guardar_asociacion(xajax.getFormValues('frmaAsociacion'))");
        }
        
        return $respuesta;
    }

    function selectCliente($lngcodigo){
        $respuesta= new xajaxResponse();
        $clientes= new clProClientes();
        $data= "";
        $html= ""; 
        $data= $clientes->SelectAll($lngcodigo);
        if($data){
            $respuesta->assign("strnombre_representante", "value", $data[0][strnombre]. " " . $data[0][strapellido]);
            $respuesta->assign("cedula_representante", "value", $data[0][strcedula]);       
            $respuesta->assign("id_cliente", "value", $data[0][id_cliente]);                   
        }
        return $respuesta;
    }
    

    function guardar_asociacion($request){
        $respuesta= new xajaxResponse();
        $asociacion= new clTblasociaciones();
        $asociacion->llenar($request);
        if($request['lngcodigo_asociacion'] == "")   $rif= $asociacion->insertar();
        else  $rif= $asociacion->Actualizar();
            if($rif){
                $respuesta->alert("La Asociación se guardo exitosamente");
                $respuesta->script("xajax_DetalleAsociacion('','".$rif."')");              
            }else{
                $respuesta->alert("La Aociación no se ha guardado");
            }
        return $respuesta;
    }

    function llenarSelectTipoRamo($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_ramo_asociaciones'], 'stritema'); 
        $html= "<select id='id_ramo' name='id_ramo' style='width:".$ancho."'>";
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
        $respuesta->assign("capaIdTipoRamo","innerHTML",$html);
        return $respuesta;
    }    
    

    function buscarAsistido($id){
        $respuesta=new xajaxResponse();
        $asistido=new clProClientes();
        $data=$asistido->buscarAsistido($id);
        if(is_array($data)){
            $respuesta->assign("strnombre_representante", "value", $data[0]['strnombre']. " " . $data[0]['strapellido']);
            $respuesta->assign("cedula_representante", "value", $data[0]['strcedula']);       
            $respuesta->assign("id_cliente", "value", $data[0]['id_cliente']);                   
            $respuesta->script("$('contenedorRepresentante').hide();");                     
        }
        else  $respuesta->alert("El Representante no Existe");   
        return $respuesta;
    }

    function buscarAsistidoPopup($nombre,$apellido,$cedula){
        $respuesta= new xajaxResponse();
        $clientes=new clProClientes();
        $data= "";
        $html= "";         
        $data=$clientes->SelectAllClientesFiltro($nombre,$apellido,$cedula);
        if($data){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE ASISTIDOS</strong>
                                    </div>                                
                                </td>
                            </tr>                               
                                <tr>
                                    <th width='10%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Id</a>
                                    </th>                                
                                    <th width='21%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Cédula</a>
                                    </th>
                                    <th width='22%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Nombre</a>
                                    </th>
                                    <th width='22%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Apellido</a>
                                    </th>                                    
                                    <th width='5%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Acción</a>
                                    </th>                                         
                                </tr>";
                for ($i= 0; $i < count($data); $i++){

                    $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                <td align='center'>".$i."</td>
                                <td align='center'>".$data[$i]['strcedula']."</td>
                                <td align='center'>".$data[$i]['strnombre']."</td>
                                <td align='center'>".$data[$i]['strapellido']."</td>                                    
                                <td align='center'>
                                        <a>
                                            <img src='../comunes/images/s_success.png' onmouseover='Tip(\"Elegir Abogado\")' onmouseout='UnTip()' onclick=\"xajax_buscarAsistido('".$data[$i][id_cliente]."')\">
                                        </a>                                   
                                </td>
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="";
            }
//        $respuesta->script("$('contenedorAsistidos').show();");            
        $respuesta->assign("contenedorRepresentante","innerHTML",$html);
        return $respuesta;
    }
        
function DetalleAsociacion($lngcodigo_asociacion,$rif) {
    $respuesta= new xajaxResponse();
    $asociacion= new clTblasociaciones();
    if ($lngcodigo_asociacion!="")
    $data= $asociacion->selectDetalleAsociacion($lngcodigo_asociacion,'');
    if ($rif!="")
    $data= $asociacion->selectDetalleAsociacion('',$rif);    
    if ($data)
    {
//        exit($data[0]['id_ramo']);
        $respuesta->assign('lngcodigo_asociacion', 'value', $data[0]['lngcodigo_asociacion']);
        $respuesta->assign('strnombre_asociacion', 'value', $data[0]['strnombre_asociacion']);
        $respuesta->assign('strweb', 'value', $data[0]['strweb']);
        $respuesta->assign('dtmfechafun', 'value', $data[0]['dtmfechafun']);
        $respuesta->assign('strtelefono_asociacion', 'value', $data[0]['strtelefono_asociacion']);
        $respuesta->assign('strdireccion_asociacion', 'value', $data[0]['strdireccion_asociacion']);
        $respuesta->assign('strrif', 'value', $data[0]['strrif']);
        $respuesta->script("xajax_llenarId_municipioAsociacion('frmaAsociacion','".$data[0]['id_municipio_asociacion']."')");
        $respuesta->script("xajax_llenarSelectParroquiaAsociacion('".$data[0]['id_municipio_asociacion']."','".$data[0]['id_parroquia_asociacion']."')");
        $respuesta->script("xajax_llenarSelectTipoRamo('frmaAsociacion','".$data[0]['id_ramo']."')");
        $respuesta->script("xajax_selectCliente('".$data[0]['id_cliente']."')");        
    }
    else
    {
        $respuesta->assign('lngcodigo_asociacion', 'value', '');
        $respuesta->assign('strnombre_asociacion', 'value', '');
        $respuesta->assign('strweb', 'value', '');
        $respuesta->assign('dtmfechafun', 'value', '');
        $respuesta->assign('strtelefono_asociacion', 'value', '');
        $respuesta->assign('strdireccion_asociacion', 'value', '');
        $respuesta->assign('strrif', 'value', '');
        $respuesta->script("xajax_llenarId_municipioAsociacion()");
        $respuesta->script("xajax_llenarSelectParroquiaAsociacion()");
        $respuesta->script("xajax_llenarId_ramo()");
        $respuesta->script("xajax_selectCliente()");     
    }
    return $respuesta;
}

function llenarId_ramo($select= "")
{
    $html="";
    $controlador= new clFunciones();
    $html= $controlador->llenarCombo_ConfigMaestro("id_ramo","tblasociaciones","selectbox",$select,"","","");
    return $html;
}


    function llenarId_municipioAsociacion($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['municipio'], 'stritema', 2);
        $html= "<select id='id_municipio_asociacion' name='id_municipio_asociacion' style='width:".$ancho."' onchange=\"xajax_llenarSelectParroquiaAsociacion(document.frmaAsociacion.id_municipio_asociacion.value)\">";
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
    
    function llenarSelectParroquiaAsociacion($valor, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";;
        $data= $maestro->selectAllMaestroHijosCombo($valor, 'stritema', 2);
//exit(print_r($data));
        $html= "<select id='id_parroquia_asociacion' name='id_parroquia_asociacion' style='width:".$ancho."' >";
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
        $respuesta->assign("capaParroquia","innerHTML",$html);
        return $respuesta;
    }



function selectAllJuridicas($id_municipio_asociacion=0, $id_parroquia_asociacion=0, $id_ramo=0, $strrif=''){
    $respuesta= new xajaxResponse();
    $asociacion= new clTblasociaciones();
    $data= "";
    $html= "";
    $formulario_accion=  clConstantesModelo::getFormulario_accion('asociaciones','asociaciones_litigio');
    //echo(print_r($formulario_accion));
    //exit($formulario_accion['accion']);
    $datos= $asociacion->selectAllAsociacion($id_municipio_asociacion, $id_parroquia_asociacion, $id_ramo, $strrif);
    if($datos){
    $html.= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('strrif')\">Rif</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('strnombre_asociacion')\">R. Social</a>
                                </th>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('strdireccion_asociacion')\">Dirección</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('strtelefono_asociacion')\">Teléfono</a>
                                </th>
                                <th width='10%'>Acci&oacute;n</th>
                            </tr>";
            for ($i= 0; $i < count($datos); $i++)
            {
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                    <td align='center'>".$datos[$i][strrif]."</td>
                                    <td align='center' >".$datos[$i][strnombre_asociacion]."</td>
                                    <td align='center' >".$datos[$i][strdireccion_asociacion]."</td>
                                    <td align='center' >".$datos[$i][strtelefono_asociacion]."</td>
                                    <td align='center'>
                                        <a>
                                            <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Ver Ayudas de la Asociación')\" onmouseout='UnTip()' onclick=\"location.href='../reportes/reporte_asociasion_individual.php?id=".$datos[$i][lngcodigo_asociacion]."'\">
                                        </a>";
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($formulario_accion['formulario']),'editar', $formulario_accion['accion'])){
                                $html.="<a>
                                           <img src='../comunes/images/table_edit.png' onmouseover=\"Tip('Editar Asociacion')\" onmouseout='UnTip()' onclick=\"location.href='./vista_ingresoAsosiacion.php?id=".$datos[$i][lngcodigo_asociacion]."&accion=no'\">
                                        </a>";
                            }
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($formulario_accion['formulario']),'eliminar', $formulario_accion['accion'])){
                                        $html.="<a>
                                            <img src='../comunes/images/table_delete.png' onmouseover='Tip(\"Eliminar Asociacion\")' onmouseout='UnTip()'  onclick=\"if(confirm('¿Desea Eliminar Esta Asociación?')){ xajax_eliminarAsociacion('".$datos[$i][lngcodigo_asociacion]."','".$datos[$i][id_cliente]."');alert('Datos Eliminados Correctamente');location.href='./vista_listaAsociaciones.php'}\">
                                        </a>";
                            }
                            $html.="</td>
                                </tr>
                                <tr>
                                <td colspan=\"7\"><div id='div_".$datos['lngcodigo_asociacion']."' style='display:none;background:#dfdfdf'></div></td>
                                </tr>";
            }
        }else{
            $html="<div class='celda_etiqueta'>No Hay Asociasiones Registradas</div>";
        }        
    $html.= "</table>";
    // Imprimimos la barra de navegación
    $respuesta->assign("contenedor","innerHTML",$html);
    return $respuesta;
}

function eliminarAsociacion($lngcodigo_asociacion,$id_cliente){
    $asociacion= new clTblasociaciones();
    if (clProExpediente::getExpedienteCliente($id_cliente)=='')
        $asociacion->eliminarAsociacion($lngcodigo_asociacion);
    else {
        $respuesta= new xajaxResponse();
        $respuesta->alert("La Asociación Tiene Expedientes Relacionados, No se puede Borrar");                   
        return $respuesta;        
    }
}

function eliminarPersonaAsociacion($lngcodigo_asociacion,$lngcodigo){
    $asociacion= new clTblasociaciones();
    $asociacion->eliminarPersonaAsociacion($lngcodigo_asociacion,$lngcodigo);
}
?>
