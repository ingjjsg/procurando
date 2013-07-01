<?php
    session_start();
    require_once '../modelo/clMaestroModelo.php';
    require_once '../comunes/php/utilidades.php';

    verificarSession();

    function selectAllAsuntos($campo= 'id_maestro') {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos(174, $campo);
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('lngnumero')\">Departamento</a>
                                </th>
                                <th width='10%'>Acci&oacute;n</th>
                            </tr></table>";
            for ($i= 0; $i < count($data); $i++){
                $dataDepartamento=  $maestro->selectMaestroPadreById($data[$i]['lngnumero']);
                $html.= "<table border='0' class='tablaTitulo' width='100%'><tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='25%'>".$data[$i]['stritema']."</td>
                            <td width='30%'>".$dataDepartamento[0]['stritema']."</td>
                            <td width='10%' align='center'>
                                <a>
                                    <img src='../comunes/images/comment_edit.png' onmouseover='Tip(\"Editar Asunto\")' onmouseout='UnTip()' onclick=\"xajax_formMaestro('UPD','".$data[$i]['id_maestro']."-".$data[$i]['stritema']."-".$data[$i]['stritemb']."-".$data[$i]['lngnumero']."');xajax_llenarSelectGerencias('".$data[$i]['lngnumero']."');\">
                                </a>
                                <a>
                                    <img src='../comunes/images/comment_delete.png' onmouseover='Tip(\"Eliminar Asunto\")' onmouseout='UnTip()' onclick=\"eliminarAsunto('".$data[$i]['id_maestro']."')\">
                                </a>
                            </td>
                        </tr></table><div id='div_".$data[$i]['id_maestro']."' style='display:none;background:#dfdfdf'></div>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Asuntos Predeterminados Registrados</div>";
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
                            <th width='20%'><label id='ldescA'>Descripci&oacute;n</label></th>
                            <th width='20%'><label id='ldescB'>Departamento</label></th>
                            <th width='10%'></th>
                        </tr>
                        <tr>
                            <td width='15%' align='center'>
                                <input type='text' value='' name='stritema' id='stritema' size='19' class='inputbox82' maxlength='100'>
                            </td>
                            <td width='20%' align='center'>
                                <input type='text' value='' name='stritemb' id='stritemb' class='inputbox82' maxlength='100'>
                            </td>
                            <div id='capaGerencia'>
                                
                            </div>
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
        $respuesta->script("document.frmasunto.id_maestro.value='".$data[0]."'");
        $respuesta->script("document.frmasunto.stritema.value='".$data[1]."'");
        $respuesta->script("document.frmasunto.stritemb.value='".$data[2]."'");
        return $respuesta;
	}
    function insertAsunto($formulario) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $maestro->llenar($formulario);
        $maestro->insertMaestro();
        $respuesta->script("ocultar('".$formulario['capa']."', '¡El asunto predeterminado se ha guardado exitosamente!')");
        $respuesta->script("xajax_selectAllAsuntos()");
		return $respuesta;
    }
    function updateAsunto($formulario) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $maestro->llenar($formulario);
        $maestro->updateMaestro();
        $respuesta->script("ocultar('".$formulario['capa']."', '¡El asunto predeterminado se ha actualizado exitosamente!')");
        $respuesta->script("xajax_selectAllAsuntos()");
		return $respuesta;
    }
    function deleteAsunto($id_maestro) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $maestro->deleteMaestro($id_maestro);
        $respuesta->script("ocultar('".$formulario['capa']."', '¡El asunto predeterminado se ha eliminado exitosamente!')");
        $respuesta->script("xajax_selectAllAsuntos()");
		return $respuesta;
    }
    function llenarSelectGerencias($select= "") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos(3, 'stritema');
        $html= "<select id='lngnumero' name='lngnumero' style='width:90%'>";
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
        $respuesta->assign("capaGerencia","innerHTML",$html);
        return $respuesta;
    }
?>
