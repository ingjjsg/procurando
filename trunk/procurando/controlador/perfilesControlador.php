<?php
    session_start();
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clAsignarModelo.php';
    require_once '../comunes/php/utilidades.php';

    verificarSession();
    verificarSessionModuloSeguridad();    
    

    function selectAllPerfiles($campo= 'id_maestro') {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos(111, $campo);
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
                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Ver Detalles')\" onmouseout='UnTip()' onclick=\"ver(".$data[$i]['id_maestro'].")\">
                                </a>
                                <a>
                                    <img src='../comunes/images/group_edit.png' onmouseover='Tip(\"Editar Perfil\")' onmouseout='UnTip()' onclick=\"xajax_formMaestro('UPD','".$data[$i]['id_maestro']."-".$data[$i]['stritema']."-".$data[$i]['stritemb']."-".$data[$i]['stritemc']."')\">
                                </a>
                                <a>
                                    <img src='../comunes/images/group_delete.png' onmouseover='Tip(\"Eliminar\")' onmouseout='UnTip()' onclick=\"eliminarPerfil('".$data[$i]['id_maestro']."')\">
                                </a>
                                <a>
                                    <img src='../comunes/images/group_go.png' onmouseover='Tip(\"Asignar Permisos\")' onmouseout='UnTip()' onclick=\"location.href='./asignarVista.php?idPerfil=".$data[$i]['id_maestro']."'\">
                                </a>
                                <a>
                                    <img src='../comunes/images/group_gear.png' onmouseover='Tip(\"Asignar Estados\")' onmouseout='UnTip()' onclick=\"location.href='./autorizadoVista.php?idPerfil=".$data[$i]['id_maestro']."&nombrePerfil=".$data[$i]['stritema']."'\">
                                </a>
                            </td>
                        </tr></table><div id='div_".$data[$i]['id_maestro']."' style='display:none;background:#dfdfdf'></div>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Perfiles Registrados</div>";
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
                            <th width='20%'><label id='ldescB'>Descripci&oacute;n B</label></th>
                            <th width='10%'></th>
                        </tr>
                        <tr>
                            <td width='15%' align='center'>
                                <input type='text' value='' name='stritema' id='stritema' size='19' class='inputbox82' maxlength='100'>
                            </td>
                            <td width='20%' align='center'>
                                <input type='text' value='' name='stritemb' id='stritemb' class='inputbox82' maxlength='100'>
                            </td>
                            <td width='20%' align='center'>
                                <input type='text' value='' name='stritemc' id='stritemc' class='inputbox82' maxlength='50'>
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
        $respuesta->script("document.frmperfiles.id_maestro.value='".$data[0]."'");
        $respuesta->script("document.frmperfiles.stritema.value='".$data[1]."'");
        $respuesta->script("document.frmperfiles.stritemb.value='".$data[2]."'");
        $respuesta->script("document.frmperfiles.stritemc.value='".$data[3]."'");
        return $respuesta;
	}
    function insertPerfil($formulario) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $maestro->llenar($formulario);
        $maestro->insertMaestro();
        $respuesta->script("ocultar('".$formulario['capa']."', '¡El perfil se ha guardado exitosamente!')");
        $respuesta->script("xajax_selectAllPerfiles()");
		return $respuesta;
    }
    function updatePerfil($formulario) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $maestro->llenar($formulario);
        $maestro->updateMaestro();
        $respuesta->script("ocultar('".$formulario['capa']."', '¡El perfil se ha actualizado exitosamente!')");
        $respuesta->script("xajax_selectAllPerfiles()");
		return $respuesta;
    }
    function deletePerfil($id_maestro) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $maestro->deleteMaestro($id_maestro);
        $respuesta->script("ocultar('".$formulario['capa']."', '¡El perfil se ha eliminado exitosamente!')");
        $respuesta->script("xajax_selectAllPerfiles()");
		return $respuesta;
    }
    function verDeTallesPerfil($id){
        $respuesta= new xajaxResponse();
        $maestro=  new clMaestroModelo();
        $asignar=  new clAsignarModelo();
        $dataPerfil= $maestro->selectMaestroPadreById($id);
        $dataAsignar= $asignar->selectAsignarByProfile($id);
        $html= "<div id='div_c".$id."'><table class='tablaVer' border='0' width='100%'>";
        if($dataPerfil){
            $html.= "<tr><th width='20%'>Nombre del Perfil: </th><td width='20%'>".$dataPerfil[0]['stritema']."</td><td width='20%'>&nbsp;</td></tr>";
            $html.= "<tr><th width='20%'>Descripci&oacute;n del Perfil: </th><td width='20%'>".$dataPerfil[0]['stritemb']."</td><td width='20%'>&nbsp;</td></tr>";
            $html.= "<tr><td colspan='5'><hr></td></tr>";
            if($dataAsignar){
                $html.= "<tr><th><u>Permisos Asignados</u></th></tr>";
                 for ($i= 0; $i < count($dataAsignar); $i++){
                    $html.= "<tr><td width='10%'>&nbsp;</td><th width='30%'>".$dataAsignar[$i]['nombre_form']."</th><td width='10%'>&nbsp;</td><td width='10%'>&nbsp;</td></tr>";
                    $acciones= split(",", $dataAsignar[$i]['stracciones']);
                    for ($x= 0; $x < (count($acciones)-1); $x++){
                        $dataAccion= $maestro->selectMaestroPadreById($acciones[$x]);
                        $html.= "<tr><td width='10%'>&nbsp;</td><td width='30%'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$dataAccion[0]['stritema']."</td><td width='10%'>&nbsp;</td><td width='10%'>&nbsp;</td></tr>";
                    }
                 }
            }
        }
        $html.= "";
        $html.= "</table></div>";
        $respuesta->assign("div_".$id,"style.border","#339933 2px solid");
        $respuesta->assign("div_".$id,"innerHTML",$html);
        return $respuesta;
	}
?>
