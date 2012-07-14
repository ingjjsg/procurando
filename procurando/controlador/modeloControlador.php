<?php
    session_start();
    require_once '../modelo/clMaestroModelo.php';
    require_once '../comunes/php/utilidades.php';

    verificarSession();

    function selectAllModelo($campo= 'id_maestro') {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos(207, $campo);
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Descripci&oacute;n</a>
                                </th>
                                <th width='10%'>Acci&oacute;n</th>
                            </tr></table>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<table border='0' class='tablaTitulo' width='100%'><tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='25%'>".$data[$i]['stritema']."</td>
                            <td width='30%'>".$data[$i]['stritemb']."</td>
                            <td width='10%' align='center'>
                                <a>
                                    <img src='../comunes/images/application_form_edit.png' onmouseover='Tip(\"Editar Modelo\")' onmouseout='UnTip()' onclick=\"xajax_formMaestro('UPD','".$data[$i]['id_maestro']."-".$data[$i]['stritema']."-".$data[$i]['stritemb']."-".$data[$i]['lngnumero']."');\">
                                </a>
                                <a>
                                    <img src='../comunes/images/application_form_delete.png' onmouseover='Tip(\"Eliminar Modelo\")' onmouseout='UnTip()' onclick=\"eliminarModelo('".$data[$i]['id_maestro']."')\">
                                </a>
                                <a>
                                    <img src='../comunes/images/application_form_go.png' onmouseover='Tip(\"Asignar Estado\")' onmouseout='UnTip()' onclick=\"location.href='estadoVista.php?id=".$data[$i]['id_maestro']."&nombre=".$data[$i]['stritema']."'\">
                                </a>
                            </td>
                        </tr></table><div id='div_".$data[$i]['id_maestro']."' style='display:none;background:#dfdfdf'></div>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Modelo de Estado Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
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
                            <th width='15%'><label id='lnombre'>Nombre</label></th>
                            <th width='20%'><label id='ldescA'>Descripci&oacute;n A</label></th>
                            <th width='20%'><label id='ldescB'>Tipo de Modelo</label></th>
                            <th width='10%'></th>
                        </tr>
                        <tr>
                            <td width='15%' align='center'>
                                <input type='text' value='' name='stritema' id='stritema' size='19' class='inputbox82' maxlength='100'>
                            </td>
                            <td width='20%' align='center'>
                                <input type='text' value='' name='stritemb' id='stritemb' class='inputbox82' maxlength='50'>
                            </td>
                            <td width='20%' align='center'>
                                <input type='radio' value='0' name='lngnumero' id='lngnumero' class='inputbox82' checked>Horizontal
                                <input type='radio' value='1' name='lngnumero' id='lngnumero' class='inputbox82'>Vertical
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
        $respuesta->script("document.frmmodelo.id_maestro.value='".$data[0]."'");
        $respuesta->script("document.frmmodelo.stritema.value='".$data[1]."'");
        $respuesta->script("document.frmmodelo.stritemb.value='".$data[2]."'");
        $respuesta->script("setRadioInput(document.frmmodelo.lngnumero, '".$data[3]."')");
        return $respuesta;
	}
    function insertModelo($formulario) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $maestro->llenar($formulario);
        $maestro->insertMaestro();
        $respuesta->script("ocultar('".$formulario['capa']."', '¡El modelo de estado se ha guardado exitosamente!')");
        $respuesta->script("xajax_selectAllModelo()");
		return $respuesta;
    }
    function updateModelo($formulario) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $maestro->llenar($formulario);
        $maestro->updateMaestro();
        $respuesta->script("ocultar('".$formulario['capa']."', '¡El modelo de estado se ha actualizado exitosamente!')");
        $respuesta->script("xajax_selectAllModelo()");
		return $respuesta;
    }
    function deleteModelo($id_maestro) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $maestro->deleteMaestro($id_maestro);
        $respuesta->script("ocultar('".$formulario['capa']."', '¡El modelo de estado se ha eliminado exitosamente!')");
        $respuesta->script("xajax_selectAllModelo()");
		return $respuesta;
    }
?>
