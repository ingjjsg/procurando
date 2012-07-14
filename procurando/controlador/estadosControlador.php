<?php
    session_start();
    require_once '../modelo/clEstadoModelo.php';
    require_once '../modelo/clMaestroModelo.php';
    require_once '../comunes/php/utilidades.php';

    verificarSession();

    function selectAllEstado($id_meestados_maestros) {
        $respuesta= new xajaxResponse();
        $estado= new clEstadoModelo();
        $data= "";
        $html= "";
        $data= $estado->selectAllEstadosByMeestados($id_meestados_maestros);
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"\">Id</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"\">Nombre Modelo</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"\">Estado Inicial</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"\">Estado Final</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"\">Estatus</a>
                                </th>
                                <th width='10%'>Acci&oacute;n</th>
                            </tr></table>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<table border='0' class='tablaTitulo' width='100%'><tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='5%' align='center'>".$data[$i]['id_estados']."</td>
                            <td width='30%' align='center'>".$data[$i]['nombre_meestados_maestros']."</td>
                            <td width='20%'>".$data[$i]['nombre_estinicial_maestro']."</td>
                            <td width='20%'>".$data[$i]['nombre_estfinal_maestro']."</td>";
                if($data[$i]['bolactivo'] == 0){
                    $html.= "<td width='10%' align='center'>Activo</td>";
                }else{
                    $html.= "<td width='10%' align='center'>Inactivo</td>";
                }
                $html.= "    <td width='10%' align='center'>
                                <a>
                                    <img src='../comunes/images/tab_edit.png' onmouseover='Tip(\"Editar Estado\")' onmouseout='UnTip()' onclick=\"xajax_formMaestro('UPD','".$data[$i]['id_estados']."-".$data[$i]['bolactivo']."');xajax_llenarEstatus('id_estinicial_maestro', 'capaInicial', '".$data[$i]['id_estinicial_maestro']."');xajax_llenarEstatus('id_estfinal_maestro', 'capaFinal', '".$data[$i]['id_estfinal_maestro']."');\">
                                </a>
                                <a>
                                    <img src='../comunes/images/tab_delete.png' onmouseover='Tip(\"Eliminar estado\")' onmouseout='UnTip()' onclick=\"eliminarEstados('".$data[$i]['id_estados']."')\">
                                </a>
                            </td>
                        </tr></table><div id='div_".$data[$i]['id_estados']."' style='display:none;background:#dfdfdf'></div>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Estado Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        $respuesta->script("document.frmestado.id_estados.value='".$data[0]."'");
        return $respuesta;
    }
    function formMaestro($acc, $data=""){
        $respuesta= new xajaxResponse();
        $numero= uniqid();
        $data= split("-", $data);
		$html = "<div id='div_".$numero."'>
                    <input type='hidden' name='capa' id='capa' value='div_".$numero."'>
                    <table class='tablaTitulo' bgcolor='#f8f8f8' width='100%'>
                        <tr>
                            <th width='20%'><label id='lid_estinicial_maestro'>Estado Inicial</label></th>
                            <th width='20%'><label id='lid_estfinal_maestro'>Estado Final</label></th>
                            <th width='20%'><label id='lbolactivo'>Activo</label></th>
                            <th width='10%'></th>
                        </tr>
                        <tr>
                            <td width='30%' align='center'>
                                <div id='capaInicial'>
                                    <select id='id_estinicial_maestro' name='id_estinicial_maestro' style='width:90%'>
                                        <option value='0'>Seleccione</option>
                                    </select>
                                </div>
                            </td>
                            <td width='30%' align='center'>
                                <div id='capaFinal'>
                                    <select id='id_estfinal_maestro' name='id_estfinal_maestro' style='width:90%'>
                                        <option value='0'>Seleccione</option>
                                    </select>
                                </div>
                            </td>
                            <td width='20%' align='center'>
                                <input type='checkbox' name='bolactivo' id='bolactivo' value='0' checked>
                            </td>
                            <td width='10%' align='center'>
                                <a>
                                    <img src='../comunes/images/16_save.gif' onmouseover='Tip(\"Guardar\")' onmouseout='UnTip()' onclick=\"validar('".$acc."');\" >
                                </a>
                                <a>
                                    <img src='../comunes/images/arrow_undo.png' onmouseover='Tip(\"Ocultar\")' onmouseout='UnTip()' onclick=\"ocultar2('div_".$numero."')\" >
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>";

        $respuesta->assign("formulario","innerHTML",$html);
        $respuesta->script("document.frmestado.id_estados.value='".$data[0]."'");
        if($data[1] == 0){
            $respuesta->script("document.frmestado.bolactivo.checked= true");
        }else{
            $respuesta->script("document.frmestado.bolactivo.checked= false");
        }
        return $respuesta;
	}
    function insertEstados($formulario) {
        $respuesta= new xajaxResponse();
        $estado= new clEstadoModelo();
        $estado->llenar($formulario);
        $estado->insertEstados();
        $respuesta->script("ocultar('".$formulario['capa']."', '¡El estado se ha guardado exitosamente!')");
        $respuesta->script("xajax_selectAllEstado(".$formulario['id_meestados_maestros'].")");
		return $respuesta;
    }
    function updateEstados($formulario) {
        $respuesta= new xajaxResponse();
        $estado= new clEstadoModelo();
        $estado->llenar($formulario);
        $estado->updateEstados();
        $respuesta->script("ocultar('".$formulario['capa']."', '¡El estado se ha actualizado exitosamente!')");
        $respuesta->script("xajax_selectAllEstado(".$formulario['id_meestados_maestros'].")");
		return $respuesta;
    }
    function deleteEstados($id_estados, $formulario) {
        $respuesta= new xajaxResponse();
        $estado= new clEstadoModelo();
        $estado->deleteEstados($id_estados);
        $respuesta->script("ocultar('".$formulario['capa']."', '¡El estado se ha eliminado exitosamente!')");
        $respuesta->script("xajax_selectAllEstado(".$formulario['id_meestados_maestros'].")");
		return $respuesta;
    }
    function llenarEstatus($formInput, $capa, $select= ""){
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos(193, 'stritema');
        $html= "<select id='".$formInput."' name='".$formInput."' style='width:90%'>";
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
        $respuesta->assign($capa,"innerHTML",$html);
        return $respuesta;
    }
?>
