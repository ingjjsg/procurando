<?php
    session_start();
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clProActuaciones.php';
    require_once '../comunes/php/utilidades.php';
    require_once '../modelo/clPermisoModelo.php';

    verificarSession();

function DetalleActuacion($id_proactuaciones) {
    $respuesta= new xajaxResponse();
    $actuaciones= new clTblproactuaciones();
    if ($id_proactuaciones!="")
    $data= $actuaciones->selectDetalleActuacion($id_proactuaciones);
    if ($data)
    {
        $respuesta->assign('id_proactuaciones', 'value', $data[0][id_proactuaciones]);
        $respuesta->script("FCKeditorAPI.__Instances['descripcion'].SetHTML('".$data[0][strdescripcionactuacion]."')");
        $respuesta->assign('fecactuacion', 'value', $data[0][fecactuacion]);
        $respuesta->assign('strnombreactuacion', 'value', $data[0][strnombreactuacion]);
        $respuesta->script("xajax_llenarSelectFormularioTipoActuacion('".$data[0][id_tipo_actuacion]."')");
        $respuesta->script("xajax_llenarSelectComboItemTipoActuacion('".$data[0][id_tipo_actuacion]."','".$data[0][id_actuacion]."')");
    }
    else
    {
        $respuesta->assign('id_proactuaciones', 'value', '');
        $respuesta->script("FCKeditorAPI.__Instances['descripcion'].SetHTML('')");
        $respuesta->assign('fecactuacion', 'value', '');
        $respuesta->assign('dtmfechafun', 'value', '');
        $respuesta->assign('strnombreactuacion', 'value', '');
        $respuesta->script("xajax_llenarId_municipioAsociacion()");
        $respuesta->script("xajax_llenarSelectParroquiaAsociacion('','')");
    }
    return $respuesta;
}

function selectAllActuaciones(){
    $respuesta= new xajaxResponse();
    $actuaciones= new clTblproactuaciones();
    $data= "";
    $html= ""; 
    $datos= $actuaciones->selectAllActuaciones();
    if($datos){
    $html.= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='35%'>
                                    <a href='#' onclick=\"xajax_orden('strnombre_asociacion')\">Nombre</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('strrif')\">Iipo Actuacion</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('strnombre_asociacion')\">Item Actuación</a>
                                </th>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('strdireccion_asociacion')\">Fecha</a>
                                </th>
                                <th width='10%'>Acci&oacute;n</th>
                            </tr>";
            for ($i= 0; $i < count($datos); $i++)
            {
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                    <td align='center'>".$datos[$i][strnombreactuacion]."</td>
                                    <td align='center'>".$datos[$i][tipo]."</td>
                                    <td align='center' >".$datos[$i][actuacion]."</td>
                                    <td align='center' >".$datos[$i][fecactuacion]."</td>
                                    <td align='center'>
                                        <a>
                                            <img src='../comunes/images/script_go.png' onmouseover=\"Tip('Ver Texto de la Actuación')\" onmouseout='UnTip()' onclick=\"location.href='./reporteAsociacionVista.php?id=".$datos[$i][id_proactuaciones]."'\">
                                        </a>";
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('actuaciones'),'editar', clConstantesModelo::acciones_actuaciones())){
                                $html.="<a>
                                           <img src='../comunes/images/script_attach.png' onmouseover=\"Tip('Editar Actuación')\" onmouseout='UnTip()' onclick=\"location.href='./vista_GeneradorActuaciones.php?id=".$datos[$i][id_proactuaciones]."&accion=no'\">
                                        </a>";
                            }
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('actuaciones'),'eliminar', clConstantesModelo::acciones_actuaciones())){
                                $html.="<a>
                                            <img src='../comunes/images/script_delete.png' onmouseover='Tip(\"Eliminar Asociacion\")' onmouseout='UnTip()'  onclick=\"if(confirm('¿Desea Eliminar Esta Actuación?')){ xajax_eliminarActuacion('".$datos[$i][id_proactuaciones]."','".$datos[$i][id_proactuaciones]."');alert('Datos Eliminados Correctamente');location.href='./vista_listaAsociaciones.php'}\">
                                        </a>";
                            }
                            $html.="</td>
                                </tr>
                                <tr>
                                <td colspan=\"7\"><div id='div_".$datos['lngcodigo_asociacion']."' style='display:none;background:#dfdfdf'></div></td>
                                </tr>";
            }
        }else{
            $html="<div class='celda_etiqueta'>No Hay Actuaciones Registradas</div>";
        }        
    $html.= "</table>";
    // Imprimimos la barra de navegación
    $respuesta->assign("contenedor","innerHTML",$html);
    return $respuesta;
}



    function insertActuaciones($request){
        $respuesta= new xajaxResponse();
        $actuaciones= new clTblproactuaciones();
        $actuaciones->llenar($request);
        if($request['id_proactuaciones'] == ""){
	   $guardo= $actuaciones->insertar();
	}
        else  $guardo= $actuaciones->Actualizar();
            if($guardo){
                $respuesta->alert("La Actuación se guardo exitosamente");
//                $respuesta->script("xajax_DetalleAsociacion('','".$rif."')");              
            }else{
                $respuesta->alert("La Actuación no se ha guardado");
            }
        return $respuesta;
    }


    function llenarSelectComboItemTipoActuacion($id_maestro,$select=0) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos($id_maestro, 2);
        $html= "<select id='id_actuacion' name='id_actuacion' style='width:50%'>";
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
        $respuesta->assign("capaIdItemActuacion","innerHTML",$html);
        return $respuesta;
    }      

    function llenarSelectFormularioTipoActuacion($select="") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['actuaciones'], 2);
        $html= "<select id='id_tipo_actuacion' name='id_tipo_actuacion' style='width:50%' onchange=\"xajax_llenarSelectComboItemTipoActuacion(document.frmMaestroActuacion.id_tipo_actuacion.value);\">";
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
        $respuesta->assign("capaIdTipoActuacion","innerHTML",$html);
        return $respuesta;
    } 

//-----------------------------------------------------------------------

?>
