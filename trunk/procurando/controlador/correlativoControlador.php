<?php
    session_start();
    require_once '../modelo/clCorrelativoModelo.php';
    require_once '../modelo/clConstantesModelo.php';
    require_once '../modelo/clMaestroModelo.php';
    require_once '../comunes/php/utilidades.php';

    verificarSession();

    function selectAllCorrelativo($campo= 'id_correlativo'){
        $respuesta= new xajaxResponse();
        $correlativos= new clCorrelativoModelo();
        $data= "";
        $html= "";
        if($_SESSION['id_profile']== 112 || $_SESSION['id_profile']== 117){
            $data= $correlativos->selectAllCorrelativo($campo);
        }else{
            $data= $correlativos->selectAllCorrelativo($campo, $_SESSION['id_dpto_maestro']);
        }
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_correlativo')\">Id</a>
                                </th>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('id_gerencia_maestro')\">Instituto</a>
                                </th>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('id_coord_maestro')\">Departamento</a>
                                </th>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('lnganio')\">A&ntilde;o</a>
                                </th>

                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('id_tipo_maestro')\">Tipo de Documento</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('lnginicio')\">N&uacute;mero</a>
                                </th>
                                <th width='10%'>Acci&oacute;n</th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $maestro= new clMaestroModelo();
                $dataMaestro= $maestro->selectMaestroPadreById($data[$i]['id_tipo_maestro']);
                $strUrl= "acc=ACT&id=".$data[$i]['id_correlativo'];
                $strUrl.= "&gerencia=".$data[$i]['id_gerencia_maestro'];
                $strUrl.= "&coordinacion=".$data[$i]['id_coord_maestro'];
                $strUrl.= "&lnganio=".$data[$i]['lnganio'];
                $strUrl.= "&tipoCor=".$dataMaestro[0]['id_origen'];
                $strUrl.= "&tipoDoc=".$data[$i]['id_tipo_maestro'];
                $strUrl.= "&numero=".$data[$i]['lnginicio'];
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td align='center'>".$data[$i]['id_correlativo']."</td>
                            <td align='left' >".$data[$i]['nombre_gerencia_maestro']."</td>
                            <td align='left'>".$data[$i]['nombre_coord_maestro']."</td>
                            <td align='center'>".$data[$i]['lnganio']."</td>
                            <td align='center'>".$data[$i]['nombre_tipo_maestro']."</td>
                            <td align='right'>".$data[$i]['lnginicio']."</td>
                            <td align='center'>
                                <a>
                                    <img src='../comunes/images/calculator_edit.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"location.href='./correlativoVistaIngreso.php?".$strUrl."'\">
                                </a>
                                <a>
                                    <img src='../comunes/images/calculator_delete.png' onmouseover='Tip(\"Eliminar\")' onmouseout='UnTip()' onclick=\"eliminarCorrelativo('".$data[$i]['id_correlativo']."')\">
                                </a>
                            </td>
                        </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Correlativos Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        return $respuesta;
    }

    function llenarSelectGerencias($select= "") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        if($_SESSION['id_profile'] == 112 || $_SESSION['id_profile'] == 117){
            //$data= $maestro->selectAllMaestroHijos($_SESSION['id_dpto_maestro'], 'stritema');
            $data= $maestro->selectAllMaestroHijos(clConstantesModelo::departamentos, 'stritema');
            $html= "<select id='id_gerencia_maestro' name='id_gerencia_maestro' style='width:90%' onchange=\"xajax_llenarSelectCoordinaciones(document.frmcorrelativo.id_gerencia_maestro.value)\">";
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
        }else{
            $data= $maestro->selectMaestroPadreById($_SESSION['id_dpto_maestro']);
            $html.= "<b>".$data[0]['stritema']."</b>";
            $html.= "<input type='hidden' name='id_gerencia_maestro' id='id_gerencia_maestro' value='".$_SESSION['id_dpto_maestro']."'>";
            $respuesta->script("xajax_llenarSelectCoordinaciones('".$_SESSION['id_dpto_maestro']."')");
        }
        $respuesta->assign("capaGerencia","innerHTML",$html);
        return $respuesta;
    }

    function llenarSelectCoordinaciones($valor, $select= "") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos($valor, 'stritema');
        $html= "<select id='id_coord_maestro' name='id_coord_maestro' style='width:90%'>";
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
        $respuesta->assign("capaCoord","innerHTML",$html);
        return $respuesta;
    }

    function llenarSelectTipoCorres($select= "") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos(82, 'stritema');
        $html= "<select id='tipo' name='tipo' style='width:70%' onchange=\"xajax_llenarSelectTipoDoc(document.frmcorrelativo.tipo.value)\">";
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

    function llenarSelectTipoDoc($valor, $select= "") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos($valor, 'stritema');
        $html= "<select id='id_tipo_maestro' name='id_tipo_maestro' style='width:70%'>";
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
        $respuesta->assign("capaDoc","innerHTML",$html);
        return $respuesta;
    }

    function insertCorrelativo($formulario) {
        $respuesta= new xajaxResponse();
        $correlativo= new clCorrelativoModelo();
        $correlativo->llenar($formulario);
        $data= $correlativo->verificarIngreso();
        if($data[0]['count'] > 0){
            $respuesta->script("alert('Ya existe un correlativo para esta gerencia o coordinación');");
        }else{
            $correlativo->insertCorrelativo();
            $respuesta->script("alert('El correlativo fue guardado con exito');");
            $respuesta->script("location.href='correlativoVista.php'");
        }
		return $respuesta;
    }

    function updateCorrelativo($formulario) {
        $respuesta= new xajaxResponse();
        $correlativo= new clCorrelativoModelo();
        $correlativo->llenar($formulario);
        $data= $correlativo->verificarIngreso($formulario['id_correlativo']);
        if($formulario['id_coord_maestro'] == 0){
            $id_maestro= $formulario['id_gerencia_maestro'];
        }else{
            $id_maestro= $formulario['id_coord_maestro'];
        }
        $dataCorrelativo= $correlativo->verificarCorrelativo($formulario['id_tipo_maestro'], $id_maestro, $formulario['lnginicio'], $formulario['lnganio']);
        if($data[0]['count'] > 0){
            $respuesta->script("alert('Ya existe un correlativo para esta gerencia o coordinación');");
        }else{
            if($dataCorrelativo[0]['count'] > 0){
                $respuesta->script("alert('El correlativo ya se encuantra asignado a un documento');");
            }else{
                $correlativo->updateCorrelativo();
                $respuesta->script("alert('El correlativo fue actualizado con exito');");
                $respuesta->script("location.href='correlativoVista.php'");
            }
        }
		return $respuesta;
    }

    function deleteCorrelativo($id_correlativo) {
        $respuesta= new xajaxResponse();
        $correlativo= new clCorrelativoModelo();
        $numero= uniqid();
        $html= "<div id='div_".$numero."'></div><input type='hidden' name='capa' id='capa' value='div_".$numero."'>";
        $respuesta->assign("formulario","innerHTML",$html);
        $correlativo->deleteCorrelativo($id_correlativo);
        $respuesta->script("ocultar('div_".$numero."', '¡El correlativo se ha eliminado exitosamente!')");
        $respuesta->script("xajax_selectAllCorrelativo()");
		return $respuesta;
    }

    function selectCorrelativoById($id_correlativo){
        $correlativo= new clCorrelativoModelo();
        $data= $correlativo->selectCorrelativoById($id_correlativo);
        return $data;
    }
?>
