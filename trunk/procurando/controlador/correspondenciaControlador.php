<?php
    session_start();
    
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clCorrespondenciaModelo.php';
    require_once '../modelo/clDestinatariosModelo.php';
    require_once '../controlador/contactoControlador.php';
    require_once '../modelo/clContactoExternoModelo.php';
    require_once '../modelo/clAdjuntarModelo.php';
    require_once '../modelo/clCorrelativoModelo.php';
    require_once '../modelo/clRutaCorrespondenciaModelo.php';
    require_once '../modelo/clNotaModelo.php';
    require_once '../modelo/clValidacionModelo.php';
    require_once '../modelo/clContactoActividadModelo.php';
    require_once '../modelo/clAutorizadoModelo.php';
    require_once '../modelo/clFirmaAutorizada.php';
    require_once '../comunes/php/utilidades.php';
    require_once '../modelo/clConstantesModelo.php';

    verificarSession();

    function llenarSelectTipoCorres($formInput, $select= "", $ancho= "90%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos(82, 'stritema');
        $html= "<select id='id_tipo_maestro' name='id_tipo_maestro' style='width:".$ancho."' onchange=\"xajax_llenarSelectTipoDoc(document.".$formInput.".id_tipo_maestro.value)\">";
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
    
    
    function llenarSelectTipoDoc($valor, $select= "", $ancho= "90%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos($valor, 'stritema');
        $html= "<select id='id_tipocorresp_maestro' name='id_tipocorresp_maestro' style='width:".$ancho."' onchange='javascript:cargaPlantilla(document.frmredactar.id_tipocorresp_maestro.value)'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
                $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                if($_SESSION['id_dpto_maestro'] == $data[$i]['lngnumero']){
                    $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
                }else if($data[$i]['lngnumero'] == 0){
                    $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
                }
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaDoc","innerHTML",$html);
        return $respuesta;
    }

    function llenarSelectModelo($estatus, $idCorresp, $tipoCorresp= "") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $html= "<select name='modeloEstado".$idCorresp."' id='modeloEstado".$idCorresp."' style='width:100%' onchange='devolverCorrespondencia(".$idCorresp.", this.value, ".$tipoCorresp.", ".$estatus.")'>";
        $html.= "<option value='0'>Seleccione</option>";
        $data= verEstadosAutorizados($_SESSION['id_profile'], $estatus);
        if($data){
            for($i= 0; $i < count($data); $i++){
                $html.= "<option value='".$data[$i]['id_estfinal_maestro']."'>".$data[$i]['nombre_estfinal_maestro']."</option>";
            }
        }
        $html.= "</select>";
        $respuesta->assign("capaModelo".$idCorresp,"innerHTML",$html);
        return $respuesta;
    }

    function verDestinatarios($formInput, $tipoCorrespondencia) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $contactoExterno= new clContactoExternoModelo();
        $_SESSION["AD"]= "ASC";
        $data= "";
        $html= "";
        $html.= "<div class='dtree'>
                        <div class='dTreeNode'>
                            <img id='id0' src='../comunes/images/building.png' alt=''>
                            Destinatarios
                        </div>";
        $ultimo1= false;
        $ultimo2= false;
        if($tipoCorrespondencia == 84){
            $data= $maestro->selectAllMaestroHijos(clConstantesModelo::departamentos, 'stritema');
            if($data){
                for ($i= 0; $i < count($data); $i++){
                    $dataCoordinacion= $maestro->selectAllMaestroHijos($data[$i]['id_maestro'], 'stritema');
                    if($dataCoordinacion){
                        $ultimo1= ($i == count($data)-1)? true : false;
                        $html.= generarTree($data[$i]['id_maestro'], 'padre', $data[$i]['stritema'], "javascript:asignar(document.frmredactar.".$formInput.", document.frmredactar.".$formInput."Id,'".$data[$i]['stritema']."', ".$data[$i]['id_maestro'].")", $ultimo1);
                        for ($x= 0; $x < count($dataCoordinacion); $x++){
                            $ultimo2= ($x == count($dataCoordinacion)-1)? true : false;
                            $html.= generarTree($dataCoordinacion[$x]['id_maestro'], 'hijo', $dataCoordinacion[$x]['stritema'], "javascript:asignar(document.frmredactar.".$formInput.", document.frmredactar.".$formInput."Id, '".$dataCoordinacion[$x]['stritema']."', ".$dataCoordinacion[$x]['id_maestro'].")", $ultimo2, $ultimo1);
                        }
                    }else{
                        $html.= generarTree($data[$i]['id_maestro'], 'solo', $data[$i]['stritema'], "javascript:asignar(document.frmredactar.".$formInput.", document.frmredactar.".$formInput."Id, '".$data[$i]['stritema']."', ".$data[$i]['id_maestro'].")", false);
                    }
                }
            }
        }else if($tipoCorrespondencia == 85){
            $data= $contactoExterno->selectAllContactoExterno();
            if($data){
                for ($i= 0; $i < count($data); $i++){
                    $ultimo1= ($i == count($data)-1)? true : false;
                    $titulo= $data[$i]['strcontactoext']." (".$data[$i]['strinstitucion'].")";
                    $html.= generarTree($data[$i]['id_contacto_externo'], 'solo', $titulo, "javascript:asignar(document.frmredactar.".$formInput.", document.frmredactar.".$formInput."Id, '".$data[$i]['strcontactoext']."', ".$data[$i]['id_contacto_externo'].")", $ultimo1);
                }
            }
        }else{
            $html= "<div><font color='red'>Debe seleccionar un tipo de correspondencia!</font>";
        }
        $html.= "</div>";
        $respuesta->assign("capa".$formInput,"innerHTML",$html);
        return $respuesta;
    }

    function verAsuntosPredeterminados($dest) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $destinatarios= split(";", $dest);
        $data= "";
        $html= "<table class=\'tablaTitulo\'>";
        $html2= "";
        for($i= 0; $i < count($destinatarios)-1; $i++){
            $data= $maestro->selectMaestroPadreByIdNumero(174, $destinatarios[$i]);
            if($data){
                for ($x= 0; $x < count($data); $x++){
                    $html2.= "<tr><td><li><a href=\'#\' onclick=\"$(\'strasunto\').value=\'".$data[$x]['stritema']."\';\">".$data[$x]['stritema']."</a></li></td></tr>";
                }
            }
        }
        if($html2 == ""){
            $html2="<tr><td>No hay asuntos prederterminados para estos departamentos</td></tr>";
        }
        $html.= $html2;
        $html.= "</table>";
        $respuesta->script("Tip('".$html."',TITLE, 'Asuntos sugeridos', DELAY, 0, SHADOW, true, STICKY, true, CLOSEBTN, true, CLICKCLOSE, true);");
        return $respuesta;
    }

    function insertCorrespondencia($formulario) {
        $respuesta= new xajaxResponse();
        $correspondencia= new clCorrespondenciaModelo();
        $adjuntos= new clAdjuntarModelo();
        $destinatarios= new clDestinatariosModelo();
        $rutaCorrespondencia= new clRutaCorrespondenciaModelo();
        $correspondencia->llenar($formulario);
        $data= $correspondencia->insertCorrespondencia();
        $destinatarios->setId_corresp($data[0]['id_corresp']);
        $destPara= split(";", $formulario['paraId']);
        $destCC= split(";", $formulario['ccId']);
        $destCCO= split(";", $formulario['ccoId']);
        $id_estatus_maestro=$formulario['id_estatus_maestro'];
        for($i= 0; $i < count($destPara)-1; $i++){
            $destinatarios->setId_destino_maestro($destPara[$i]);
            $destinatarios->setId_tipoenvio_maestro(190);
            $destinatarios->setId_estatus_maestro($id_estatus_maestro);
            $destinatarios->insertDestinatarios();
        }
        for($i= 0; $i < count($destCC)-1; $i++){
            $destinatarios->setId_destino_maestro($destCC[$i]);
            $destinatarios->setId_tipoenvio_maestro(191);
            $destinatarios->setId_estatus_maestro($id_estatus_maestro);
            $destinatarios->insertDestinatarios();
        }
        for($i= 0; $i < count($destCCO)-1; $i++){
            $destinatarios->setId_destino_maestro($destCCO[$i]);
            $destinatarios->setId_tipoenvio_maestro(192);
            $destinatarios->setId_estatus_maestro($id_estatus_maestro);
            $destinatarios->insertDestinatarios();
        }
        if($formulario['adjunto'] != ""){
            $adjuntos->updateAdjunto($data[0]['id_corresp'], $formulario['adjunto']);
        }
        $para= split(";", $formulario['para']);
        $cc= split(";", $formulario['cc']);
        $cco= split(";", $formulario['cco']);
        for($i= 0; $i < count($para)-1; $i++){
            $nombrePara.= $para[$i]."<br>";
        }
        for($i= 0; $i < count($cc)-1; $i++){
            $nombreCC.= $para[$i]."<br>";
        }
        for($i= 0; $i < count($cco)-1; $i++){
            $nombreCCO.= $para[$i]."<br>";
        }
        $descripcion= "<b><u>Destinatarios</u></b><br>".$nombrePara;
        $descripcion.= "<b><u>CC</u></b><br>";
        $descripcion.= ($nombreCC == "") ? "Sin CC<br>" : $nombreCC;
        $descripcion.= "<b><u>CCO</u></b><br>";
        $descripcion.= ($nombreCCO == "") ? "Sin CCO<br>" : $nombreCCO;
        $rutaCorrespondencia->insertRutaCorrespondencia($data[0]['id_corresp'], 234, $descripcion, $_SESSION['id_contacto']);
        if($formulario['id_estatus_maestro'] == 199){
            enviarCorrespondencia($data[0]['id_corresp'], $formulario['id_tipocorresp_maestro'], 194, "1");
        }
        $respuesta->script("alert('¡La correspondencia se guardo satisfactoriamente!')");
        $respuesta->script("location.href='leerVista.php'");
		return $respuesta;
    }

    function insertCorrespondenciaExterna($formulario) {
        $respuesta= new xajaxResponse();
        $correspondencia= new clCorrespondenciaModelo();
        $adjuntos= new clAdjuntarModelo();
        $destinatarios= new clDestinatariosModelo();
        $rutaCorrespondencia= new clRutaCorrespondenciaModelo();
        $maestro= new clMaestroModelo();

        $correspondencia->llenar($formulario);
        $unidad= split(";", $formulario['paraId']);
        $correspondencia->setId_unidad_maestro($unidad[0]);

        $data= $correspondencia->insertCorrespondenciaExterna();   

        $destinatarios->setId_corresp($data[0]['id_corresp']);
        $destinatarios->setId_destino_maestro($_SESSION['id_coord_maestro']);
        $destinatarios->setId_tipoenvio_maestro(190);
        $destinatarios->setId_estatus_maestro($formulario['id_estatus_maestro']);
        $destinatarios->insertDestinatarios();
        $destinatarios->updateEstatusDestinatarios($data[0]['id_corresp'], 201);
        
        if($formulario['adjunto'] != ""){
            $adjuntos->updateAdjunto($data[0]['id_corresp'], $formulario['adjunto']);
        }

        $dataMaestro= $maestro->selectMaestroPadreById($_SESSION['id_coord_maestro']);

        $descripcion= "<b><u>Destinatarios</u></b><br>".$dataMaestro[0]['stritema'];
        $rutaCorrespondencia->insertRutaCorrespondencia($data[0]['id_corresp'], 234, $descripcion, $_SESSION['id_contacto']);
        $respuesta->script("alert('¡La correspondencia se guardo satisfactoriamente!')");
        $respuesta->script("location.href='leerVista.php'");
		return $respuesta;
    }
    
    function llenarEstatus($formInput, $capa, $select= "", $mode= true){
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos(193, 'stritema');
        $html= "<select id='".$formInput."' name='".$formInput."' style='width:100%'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
                if($mode){
                    if($data[$i]['id_maestro'] >= 194 && $data[$i]['id_maestro'] <= 199){
                        $seleccionar= "";
                        if($select == $data[$i]['id_maestro']){
                            $seleccionar= "SELECTED";
                        }
                        $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
                    }
                }else{
                    if($data[$i]['id_maestro'] >= 200 && $data[$i]['id_maestro'] <= 217){
                        $seleccionar= "";
                        if($select == $data[$i]['id_maestro']){
                            $seleccionar= "SELECTED";
                        }
                        $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
                    }
                }
            }
            $html.= "</select>";
        }
        $respuesta->assign($capa,"innerHTML",$html);
        return $respuesta;
    }

    function llenarDestinatarios($formInput, $capa){
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos(clConstantesModelo::departamentos, 'stritema');
        $html= "<select id='".$formInput."' name='".$formInput."' style='width:100%'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
                $dataCoordinacion= $maestro->selectAllMaestroHijos($data[$i]['id_maestro'], 'stritema');
                if($dataCoordinacion){
                    for ($x= 0; $x < count($dataCoordinacion); $x++){
                        $html.= "<option value='".$dataCoordinacion[$x]['id_maestro']."' ".$seleccionar.">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$dataCoordinacion[$x]['stritema']."</option>";
                    }
                }
            }
            $html.= "</select>";
        }
        $respuesta->assign($capa,"innerHTML",$html);
        return $respuesta;
    }

    function selectAllCorrespondencia($id_estatus_maestro, $id_contacto, $pagina, $id_unidad_maestro= "", $pant= 'C'){
        $respuesta= new xajaxResponse();
        $correspondencia= new clCorrespondenciaModelo();
        $destinatarios= new clDestinatariosModelo();
        $data= "";
        $html= "";
        $formulario=clConstantesModelo::formularios();
        $accion_borradores=clConstantesModelo::acciones_borradores();
        $accion_bandeja_revision=clConstantesModelo::acciones_bandeja_revision();
        if($pant == 'B'){
            $accionVer= verAccion($_SESSION['id_profile'], $formulario['borradores'], $accion_borradores['ver']);
            $accionSeguimiento= verAccion($_SESSION['id_profile'], $formulario['borradores'], $accion_borradores['seguimiento']);
            $accionEditar= verAccion($_SESSION['id_profile'], $formulario['borradores'], $accion_borradores['editar']);
            $accionImprimir= verAccion($_SESSION['id_profile'], $formulario['borradores'], $accion_borradores['imprimir']);
            $accionEnviar= verAccion($_SESSION['id_profile'], $formulario['borradores'], $accion_borradores['enviar']);
            $accionReenviar= verAccion($_SESSION['id_profile'], $formulario['borradores'], $accion_borradores['reenviar']);
            $accionEliminar= verAccion($_SESSION['id_profile'], $formulario['borradores'], $accion_borradores['eliminar']);
        }else{
            $accionVer= verAccion($_SESSION['id_profile'], $formulario['bandeja_revision'], $accion_bandeja_revision['ver']);
            $accionSeguimiento= verAccion($_SESSION['id_profile'], $formulario['bandeja_revision'], $accion_bandeja_revision['seguimiento']);
            $accionEditar= verAccion($_SESSION['id_profile'], $formulario['bandeja_revision'], $accion_bandeja_revision['editar']);
            $accionImprimir= verAccion($_SESSION['id_profile'], $formulario['bandeja_revision'], $accion_bandeja_revision['imprimir']);
            $accionEnviar= verAccion($_SESSION['id_profile'], $formulario['bandeja_revision'], $accion_bandeja_revision['enviar']);
            $accionReenviar= verAccion($_SESSION['id_profile'], $formulario['bandeja_revision'], $accion_bandeja_revision['reenviar']);
            $accionEliminar= verAccion($_SESSION['id_profile'], $formulario['bandeja_revision'], $accion_bandeja_revision['eliminar']);
        }
        
        //$dataC= $correspondencia->selectAllCorrespondencia($id_estatus_maestro, $id_contacto, $pagina);

        if(($_SESSION['id_profile'] == 113 || $_SESSION['id_profile'] == 117) && ($id_estatus_maestro == 196 || $id_estatus_maestro == 198 || $id_estatus_maestro == 199)){
            //$dataRevision= $correspondencia->selectCorrespondenciaRevision($id_estatus_maestro, $_SESSION['id_dpto_maestro']);
            $dataC= $correspondencia->selectAllCorrespondencia($id_estatus_maestro, $id_contacto, $pagina, $_SESSION['id_coord_maestro']);
        }else if($_SESSION['id_profile'] == 114 && $id_estatus_maestro == 195){
            //$dataRevision= $correspondencia->selectCorrespondenciaRevision($id_estatus_maestro, $_SESSION['id_coord_maestro']);
            $dataC= $correspondencia->selectAllCorrespondencia($id_estatus_maestro, $id_contacto, $pagina, $_SESSION['id_coord_maestro']);
        }else{
            $dpto= ($_SESSION['id_coord_maestro'] == 0) ? $_SESSION['id_dpto_maestro']:$_SESSION['id_coord_maestro'];
            //echo $dpto;
            $dataC= $correspondencia->selectAllCorrespondencia($id_estatus_maestro, $id_contacto, $pagina, $dpto);
        }
        /*if($data && $dataRevision){
            $dataC[0]= $dataRevision;
        }else if($dataRevision){
            $dataC[0]= $dataRevision;
        }*/
        $data= $dataC[0];
        if($data){   
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='8%'>
                                    <a href='#' onclick=\"\">Id</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"\">Fecha</a>
                                </th>
                                <th width='13%'>
                                    <a href='#' onclick=\"\">Correspondencia</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"\">Documento</a>
                                </th>
                                <th width='17%'>
                                    <a href='#' onclick=\"\">Estatus</a>
                                </th>
                                <th width='13%'>
                                    <a href='#' onclick=\"\">Destinatarios</a>
                                </th>
                                <th width='19%'>Acci&oacute;n</th>
                            </tr>
                        </table>";
            for ($i= 0; $i < count($data); $i++){
                if($data[$i]['id_tipo_maestro'] == 84){
                    $dataDestinatarios= $destinatarios->selectAllDestinatariosByIdCorresp($data[$i]['id_corresp']);
                    if($dataDestinatarios){
                        $htmlDestinatarios= "<table class=\'tablaTitulo\'>";
                        $tipo= "";
                        for($x= 0; $x < count($dataDestinatarios); $x++){
                            if($tipo != $dataDestinatarios[$x]['nombre_tipoenvio_maestro']){
                                if($dataDestinatarios[$x]['nombre_tipoenvio_maestro'] == 'PR'){
                                    $htmlDestinatarios.= "<tr><td align=\'left\'><font color=\'blue\'><b>Para:</b></font></td></tr>";
                                }else if($dataDestinatarios[$x]['nombre_tipoenvio_maestro'] == 'CC'){
                                    $htmlDestinatarios.= "<tr><td align=\'left\'><font color=\'blue\'><b>CC:</b></font></td></tr>";
                                }else if($dataDestinatarios[$x]['nombre_tipoenvio_maestro'] == 'CCO'){
                                    $htmlDestinatarios.= "<tr><td align=\'left\'><font color=\'blue\'><b>CCO:</b></font></td></tr>";
                                }
                            }
                            $htmlDestinatarios.= "<tr><td><li>".$dataDestinatarios[$x]['destinatario']."</li></td></tr>";
                            $tipo= $dataDestinatarios[$x]['nombre_tipoenvio_maestro'];
                        }
                        $htmlDestinatarios.= "</table>";
                    }
                }else{
                    $dataDestinatarios= $destinatarios->selectAllDestinatariosExternoByIdCorresp($data[$i]['id_corresp']);
                    if($dataDestinatarios){
                        $htmlDestinatarios= "<table class=\'tablaTitulo\'>";
                        $tipo= "";
                        for($x= 0; $x < count($dataDestinatarios); $x++){
                            if($tipo != $dataDestinatarios[$x]['nombre_tipoenvio_maestro']){
                                if($dataDestinatarios[$x]['nombre_tipoenvio_maestro'] == 'PR'){
                                    $htmlDestinatarios.= "<tr><td align=\'left\'><font color=\'blue\'><b>Para:</b></font></td></tr>";
                                }else if($dataDestinatarios[$x]['nombre_tipoenvio_maestro'] == 'CC'){
                                    $htmlDestinatarios.= "<tr><td align=\'left\'><font color=\'blue\'><b>CC:</b></font></td></tr>";
                                }else if($dataDestinatarios[$x]['nombre_tipoenvio_maestro'] == 'CCO'){
                                    $htmlDestinatarios.= "<tr><td align=\'left\'><font color=\'blue\'><b>CCO:</b></font></td></tr>";
                                }
                            }
                            $htmlDestinatarios.= "<tr><td><li>".$dataDestinatarios[$x]['trato_destinatario']." ".htmlentities($dataDestinatarios[$x]['nombre_destinatario'])."</li></td></tr>";
                            $tipo= $dataDestinatarios[$x]['nombre_tipoenvio_maestro'];
                        }
                        $htmlDestinatarios.= "</table>";
                    }
                }
                $strUrl= "acc=ACT";
                $strUrl.= "&id=".$data[$i]['id_corresp'];
                $strUrl.= "&tipoC=".$data[$i]['id_tipo_maestro'];
                $strUrl.= "&tipoD=".$data[$i]['id_tipocorresp_maestro'];
                //$strUrl.= "&asunto=".$data[$i]['strasunto'];
                $strUrl.= "&estatus=".$data[$i]['id_estatus_maestro'];
                //$strUrl.= "&cuerpo=".urlencode($data[$i]['strcuerpo']);
                $html.= "<div id='div_e".$data[$i]['id_corresp']."'><table border='0' class='tablaTitulo' width='100%'>
                            <tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue';\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='8%' align='center' onmouseover=\"Tip('".$data[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i]['id_corresp']."</td>
                            <td width='10%' align='center' onmouseover=\"Tip('".$data[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i]['fecha']."</td>
                            <td width='13%' align='center' onmouseover=\"Tip('".$data[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i]['nombre_tipo_maestro']."</td>
                            <td width='20%' align='center' onmouseover=\"Tip('".$data[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i]['nombre_tipocorresp_maestro']."</td>
                            <td width='17%' align='center' onmouseover=\"Tip('".$data[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i]['nombre_estatus_maestro']."</td>
                            <td width='13%' align='center'><a href=\"javascript:Tip('".$htmlDestinatarios."', TITLE, 'Destinatarios', CLOSEBTN, true, STICKY, true)\">Ver Destinatarios</a></td>
                            <td width='19%' align='left'>";
                if($accionVer){
                    $html.="    <a>
                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Ver Detalles')\" onmouseout='UnTip()' onclick=\"verDetalles('".$data[$i]['id_corresp']."')\">
                                </a>";
                }
                if($accionSeguimiento){
                    $html.="    <a>
                                    <img src='../comunes/images/seguimiento.png' onmouseover=\"Tip('Ver Seguimiento')\" onmouseout='UnTip()' onclick=\"verSeguimiento('".$data[$i]['id_corresp']."')\">
                                </a>";
                }
                if($accionEditar){
                    if(accionesCorrespondencia($data[$i]['id_estatus_maestro'], $data[$i]['id_contacto'], "editar")){
                        $html.="    <a>
                                        <img src='../comunes/images/email_edit.png' onmouseover=\"Tip('Editar')\" onmouseout='UnTip()' onclick=\"location.href='redactarVista.php?".$strUrl."'\">
                                    </a>";
                    }
                }
                if((($data[$i]['id_estatus_maestro'] == 195 || $data[$i]['id_estatus_maestro'] == 196) && ($_SESSION['id_profile'] == 112 || $_SESSION['id_profile'] == 113 || $_SESSION['id_profile'] == 114 || $_SESSION['id_profile'] == 117))){
                    $devolver= "Tip('<form name=frmnota id=frmnota method=post>";
                    $devolver.= "<input type=hidden name=id_tiponota_maestro id=id_tiponota_maestro value=239>";
                    $devolver.= "<input type=hidden name=tipo id=tipo value=".$data[$i]['id_tipocorresp_maestro'].">";
                    $devolver.= "<input type=hidden name=id_corresp id=id_corresp value=".$data[$i]['id_corresp'].">";
                    $devolver.= "<input type=hidden name=estatus id=estatus value=197>";
                    $devolver.= "<table><tr><td align=center><textarea name=memobsernota id=memobsernota cols=20 rows=2></textarea></tr></td>";
                    $devolver.= "<td align=center><input type=button value=devolver onclick=devolver();></td></tr></table></form>',";
                    $devolver.= "TITLE, 'Crear Nota', CLOSEBTN, true, STICKY, true)";
                    $html.= "   <a>
                                    <img src='../comunes/images/email_back_1.png' onmouseover=\"Tip('Devolver a Analista')\" onmouseout='UnTip()' onclick=\"$devolver\">
                                </a>";
                }
                if(($data[$i]['id_estatus_maestro'] == 194 || $data[$i]['id_estatus_maestro'] == 195 || $data[$i]['id_estatus_maestro'] == 196 || $data[$i]['id_estatus_maestro'] == 197) && $accionEnviar){
                    $html.= "   <a>
                                    <img src='../comunes/images/email_go.png' onmouseover=\"Tip('Enviar')\" onmouseout='UnTip()' onclick=\"enviarCorrespondencia('".$data[$i]['id_corresp']."', '".$data[$i]['id_tipocorresp_maestro']."', '".$data[$i]['id_estatus_maestro']."');\">
                                </a>";
                }
                if($data[$i]['id_tipo_maestro'] == 84 && $data[$i]['id_estatus_maestro'] == 199 && $accionReenviar){
                    $html.= "   <a>
                                    <img src='../comunes/images/email_go.png' onmouseover=\"Tip('Reenviar')\" onmouseout='UnTip()' onclick=\"xajax_reenviarCorrespondencia('".$data[$i]['id_corresp']."')\">
                                </a>";
                }
                if($accionEliminar){
                    if(accionesCorrespondencia($data[$i]['id_estatus_maestro'], $data[$i]['id_contacto'], "eliminar")){
                        $html.= "   <a>
                                        <img src='../comunes/images/email_delete.png' onmouseover=\"Tip('Eliminar')\" onmouseout='UnTip()' onclick=\"eliminarCorrespondencia('".$data[$i]['id_corresp']."', '".$data[$i]['id_estatus_maestro']."')\">
                                    </a>";
                    }
                }
                $html.= "
                            </td>
                        </tr></table><div id='div_".$data[$i]['id_corresp']."' style='display:none;background:#dfdfdf'></div></div>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Correspondencias Registradas</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        $respuesta->assign("pag","innerHTML",$dataC[1]);
        return $respuesta;
    }

    function selectAllFiltrosRedactados($id_contacto, $pagina, $dtmfechaD= "", $dtmfechaH= "", $id_estatus_maestro= "", $strasunto= "", $id_tipo_maestro= "", $id_tipocorresp_maestro= "", $id_destino_maestro= ""){
        $respuesta= new xajaxResponse();
        $correspondencia= new clCorrespondenciaModelo();
        $destinatarios= new clDestinatariosModelo();
        $data= "";
        $html= "";
        $formulario=  clConstantesModelo::formularios();
        $accion_bandeja_revision= clConstantesModelo::acciones_bandeja_revision();

        $accionVer= verAccion($_SESSION['id_profile'], $formulario['bandeja_revision'], $accion_bandeja_revision['ver']);
        $accionSeguimiento= verAccion($_SESSION['id_profile'], $formulario['bandeja_revision'], $accion_bandeja_revision['seguimiento']);
        $accionEditar= verAccion($_SESSION['id_profile'], $formulario['bandeja_revision'], $accion_bandeja_revision['editar']);
        $accionImprimir= verAccion($_SESSION['id_profile'], $formulario['bandeja_revision'], $accion_bandeja_revision['imprimir']);
        $accionEnviar= verAccion($_SESSION['id_profile'], $formulario['bandeja_revision'], $accion_bandeja_revision['enviar']);
        $accionReenviar= verAccion($_SESSION['id_profile'], $formulario['bandeja_revision'], $accion_bandeja_revision['reenviar']);
        $accionEliminar= verAccion($_SESSION['id_profile'], $formulario['bandeja_revision'], $accion_bandeja_revision['eliminar']);

        /*$dataC= $correspondencia->selectAllFiltrosRedactados($id_contacto, $pagina, $dtmfechaD, $dtmfechaH, $id_estatus_maestro, $strasunto, $id_tipo_maestro, $id_tipocorresp_maestro, $id_destino_maestro);
        if(($_SESSION['id_profile'] == 113 || $_SESSION['id_profile'] == 117) && ($id_estatus_maestro == 196 || $id_estatus_maestro == 198 || $id_estatus_maestro == 199)){
            $dataRevision= $correspondencia->selectCorrespondenciaRevision($id_estatus_maestro, $_SESSION['id_dpto_maestro']);
        }else if($_SESSION['id_profile'] == 114 && $id_estatus_maestro == 195){
            $dataRevision= $correspondencia->selectCorrespondenciaRevision($id_estatus_maestro, $_SESSION['id_coord_maestro']);
        }
        if($data && $dataRevision){
            $dataC[0]= $dataRevision;
        }else if($dataRevision){
            $dataC[0]= $dataRevision;
        }*/

        //$dataC= $correspondencia->selectAllCorrespondencia($id_estatus_maestro, $id_contacto, $pagina);

        if(($_SESSION['id_profile'] == 113 || $_SESSION['id_profile'] == 117) && ($id_estatus_maestro == 196 || $id_estatus_maestro == 198 || $id_estatus_maestro == 199)){
            //$dataRevision= $correspondencia->selectCorrespondenciaRevision($id_estatus_maestro, $_SESSION['id_dpto_maestro']);
            $dataC= $correspondencia->selectAllFiltrosRedactados($id_contacto, $pagina, $_SESSION['id_dpto_maestro'], $dtmfechaD, $dtmfechaH, $id_estatus_maestro, $strasunto, $id_tipo_maestro, $id_tipocorresp_maestro, $id_destino_maestro);
        }else if($_SESSION['id_profile'] == 114 && $id_estatus_maestro == 195){
            //$dataRevision= $correspondencia->selectCorrespondenciaRevision($id_estatus_maestro, $_SESSION['id_coord_maestro']);
            $dataC= $correspondencia->selectAllFiltrosRedactados($id_contacto, $pagina, $_SESSION['id_coord_maestro'], $dtmfechaD, $dtmfechaH, $id_estatus_maestro, $strasunto, $id_tipo_maestro, $id_tipocorresp_maestro, $id_destino_maestro);
        }else{
            $dataC= $correspondencia->selectAllFiltrosRedactados($id_contacto, $pagina, $_SESSION['id_coord_maestro'], $dtmfechaD, $dtmfechaH, $id_estatus_maestro, $strasunto, $id_tipo_maestro, $id_tipocorresp_maestro, $id_destino_maestro);
        }
        /*if($data && $dataRevision){
            $dataC[0]= $dataRevision;
        }else if($dataRevision){
            $dataC[0]= $dataRevision;
        }*/

        $data= $dataC[0];
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8;'>
                        <table border='0' class='tablaTitulo' width='100%' >
                            <tr>
                                <th width='8%'>
                                    <a href='#' onclick=\"\">Id</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"\">Fecha</a>
                                </th>
                                <th width='13%'>
                                    <a href='#' onclick=\"\">Correspondencia</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"\">Documento</a>
                                </th>
                                <th width='17%'>
                                    <a href='#' onclick=\"\">Estatus</a>
                                </th>
                                <th width='13%'>
                                    <a href='#' onclick=\"\">Destinatarios</a>
                                </th>
                                <th width='19%'>Acci&oacute;n</th>
                            </tr>
                        </table>";
            for ($i= 0; $i < count($data); $i++){
                if($data[$i]['id_tipo_maestro'] == 84){
                    $dataDestinatarios= $destinatarios->selectAllDestinatariosByIdCorresp($data[$i]['id_corresp']);
                    if($dataDestinatarios){
                        $htmlDestinatarios= "<table class=\'tablaTitulo\'>";
                        $tipo= "";
                        for($x= 0; $x < count($dataDestinatarios); $x++){
                            if($tipo != $dataDestinatarios[$x]['nombre_tipoenvio_maestro']){
                                if($dataDestinatarios[$x]['nombre_tipoenvio_maestro'] == 'PR'){
                                    $htmlDestinatarios.= "<tr><td align=\'left\'><font color=\'blue\'><b>Para:</b></font></td></tr>";
                                }else if($dataDestinatarios[$x]['nombre_tipoenvio_maestro'] == 'CC'){
                                    $htmlDestinatarios.= "<tr><td align=\'left\'><font color=\'blue\'><b>CC:</b></font></td></tr>";
                                }else if($dataDestinatarios[$x]['nombre_tipoenvio_maestro'] == 'CCO'){
                                    $htmlDestinatarios.= "<tr><td align=\'left\'><font color=\'blue\'><b>CCO:</b></font></td></tr>";
                                }
                            }
                            $htmlDestinatarios.= "<tr><td><li>".$dataDestinatarios[$x]['destinatario']."</li></td></tr>";
                            $tipo= $dataDestinatarios[$x]['nombre_tipoenvio_maestro'];
                        }
                        $htmlDestinatarios.= "</table>";
                    }
                }else{
                    $dataDestinatarios= $destinatarios->selectAllDestinatariosExternoByIdCorresp($data[$i]['id_corresp']);
                    if($dataDestinatarios){
                        $htmlDestinatarios= "<table class=\'tablaTitulo\'>";
                        $tipo= "";
                        for($x= 0; $x < count($dataDestinatarios); $x++){
                            if($tipo != $dataDestinatarios[$x]['nombre_tipoenvio_maestro']){
                                if($dataDestinatarios[$x]['nombre_tipoenvio_maestro'] == 'PR'){
                                    $htmlDestinatarios.= "<tr><td align=\'left\'><font color=\'blue\'><b>Para:</b></font></td></tr>";
                                }else if($dataDestinatarios[$x]['nombre_tipoenvio_maestro'] == 'CC'){
                                    $htmlDestinatarios.= "<tr><td align=\'left\'><font color=\'blue\'><b>CC:</b></font></td></tr>";
                                }else if($dataDestinatarios[$x]['nombre_tipoenvio_maestro'] == 'CCO'){
                                    $htmlDestinatarios.= "<tr><td align=\'left\'><font color=\'blue\'><b>CCO:</b></font></td></tr>";
                                }
                            }
                            $htmlDestinatarios.= "<tr><td><li>".$dataDestinatarios[$x]['trato_destinatario']." ".htmlentities($dataDestinatarios[$x]['nombre_destinatario'])."</li></td></tr>";
                            $tipo= $dataDestinatarios[$x]['nombre_tipoenvio_maestro'];
                        }
                        $htmlDestinatarios.= "</table>";
                    }
                }
                $strUrl= "acc=ACT";
                $strUrl.= "&id=".$data[$i]['id_corresp'];
                $strUrl.= "&tipoC=".$data[$i]['id_tipo_maestro'];
                $strUrl.= "&tipoD=".$data[$i]['id_tipocorresp_maestro'];
                //$strUrl.= "&asunto=".$data[$i]['strasunto'];
                $strUrl.= "&estatus=".$data[$i]['id_estatus_maestro'];
                //$strUrl.= "&cuerpo=".urlencode($data[$i]['strcuerpo']);
                $html.= "<div id='div_e".$data[$i]['id_corresp']."'><table border='0' class='tablaTitulo' width='100%'>
                            <tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue';\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='8%' align='center' onmouseover=\"Tip('".$data[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i]['id_corresp']."</td>
                            <td width='10%' align='center' onmouseover=\"Tip('".$data[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i]['fecha']."</td>
                            <td width='13%' align='center' onmouseover=\"Tip('".$data[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i]['nombre_tipo_maestro']."</td>
                            <td width='20%' align='center' onmouseover=\"Tip('".$data[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i]['nombre_tipocorresp_maestro']."</td>
                            <td width='17%' align='center' onmouseover=\"Tip('".$data[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i]['nombre_estatus_maestro']."</td>
                            <td width='13%' align='center'><a href=\"javascript:Tip('".$htmlDestinatarios."', TITLE, 'Destinatarios', CLOSEBTN, true, STICKY, true)\">Ver Destinatarios</a></td>
                            <td width='19%' align='left'>";
                if($accionVer){
                    $html.="    <a>
                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Ver Detalles')\" onmouseout='UnTip()' onclick=\"verDetalles('".$data[$i]['id_corresp']."')\">
                                </a>";
                }
                if($accionSeguimiento){
                    $html.="    <a>
                                    <img src='../comunes/images/seguimiento.png' onmouseover=\"Tip('Ver Seguimiento')\" onmouseout='UnTip()' onclick=\"verSeguimiento('".$data[$i]['id_corresp']."')\">
                                </a>";
                }
                if($accionEditar){
                    if(accionesCorrespondencia($data[$i]['id_estatus_maestro'], $data[$i]['id_contacto'], "editar")){
                        $html.="    <a>
                                        <img src='../comunes/images/email_edit.png' onmouseover=\"Tip('Editar')\" onmouseout='UnTip()' onclick=\"location.href='redactarVista.php?".$strUrl."'\">
                                    </a>";
                    }
                }
                if((($data[$i]['id_estatus_maestro'] == 195 || $data[$i]['id_estatus_maestro'] == 196) && ($_SESSION['id_profile'] == 112 || $_SESSION['id_profile'] == 113 || $_SESSION['id_profile'] == 114 || $_SESSION['id_profile'] == 117))){
                    $devolver= "Tip('<form name=frmnota id=frmnota method=post>";
                    $devolver.= "<input type=hidden name=id_tiponota_maestro id=id_tiponota_maestro value=239>";
                    $devolver.= "<input type=hidden name=tipo id=tipo value=".$data[$i]['id_tipocorresp_maestro'].">";
                    $devolver.= "<input type=hidden name=id_corresp id=id_corresp value=".$data[$i]['id_corresp'].">";
                    $devolver.= "<input type=hidden name=estatus id=estatus value=197>";
                    $devolver.= "<table><tr><td align=center><textarea name=memobsernota id=memobsernota cols=20 rows=2></textarea></tr></td>";
                    $devolver.= "<td align=center><input type=button value=devolver onclick=devolver();></td></tr></table></form>',";
                    $devolver.= "TITLE, 'Crear Nota', CLOSEBTN, true, STICKY, true)";
                    $html.= "   <a>
                                    <img src='../comunes/images/email_back_1.png' onmouseover=\"Tip('Devolver a Analista')\" onmouseout='UnTip()' onclick=\"$devolver\">
                                </a>";
                }
                if(($data[$i]['id_estatus_maestro'] == 194 || $data[$i]['id_estatus_maestro'] == 195 || $data[$i]['id_estatus_maestro'] == 196 || $data[$i]['id_estatus_maestro'] == 197) && $accionEnviar){
                    $html.= "   <a>
                                    <img src='../comunes/images/email_go.png' onmouseover=\"Tip('Enviar')\" onmouseout='UnTip()' onclick=\"enviarCorrespondencia('".$data[$i]['id_corresp']."', '".$data[$i]['id_tipocorresp_maestro']."', '".$data[$i]['id_estatus_maestro']."');\">
                                </a>";
                }
                if($data[$i]['id_tipo_maestro'] == 84 && $data[$i]['id_estatus_maestro'] == 199 && $accionReenviar){
                    $html.= "   <a>
                                    <img src='../comunes/images/email_go.png' onmouseover=\"Tip('Reenviar')\" onmouseout='UnTip()' onclick=\"xajax_reenviarCorrespondencia('".$data[$i]['id_corresp']."')\">
                                </a>";
                }
                if($accionEliminar){
                    if(accionesCorrespondencia($data[$i]['id_estatus_maestro'], $data[$i]['id_contacto'], "eliminar")){
                        $html.= "   <a>
                                        <img src='../comunes/images/email_delete.png' onmouseover=\"Tip('Eliminar')\" onmouseout='UnTip()' onclick=\"eliminarCorrespondencia('".$data[$i]['id_corresp']."', '".$data[$i]['id_estatus_maestro']."')\">
                                    </a>";
                    }
                }
                $html.= "
                            </td>
                        </tr></table><div id='div_".$data[$i]['id_corresp']."' style='display:none;background:#dfdfdf'></div></div>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Correspondencias Registradas</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        $respuesta->assign("pag","innerHTML",$dataC[1]);
        return $respuesta;
    }
    
    function verDeTallesCorrespondencia($id_corresp,$id_destinatarios= "", $tipo= 1){
        $respuesta= new xajaxResponse();
        $correspondencia= new clCorrespondenciaModelo();
        $adjuntos= new clAdjuntarModelo();
        $rutaCorrespondencia= new clRutaCorrespondenciaModelo();
        $destinatarios= new clDestinatariosModelo();
        $nota= new clNotaModelo();
        //exit("ID_TIPO= ".$tipo);
        $data= $correspondencia->selectAllCorrespondenciaById($id_corresp);
        $dataAdjuntos= $adjuntos->selectAdjuntoByIdCorresp($id_corresp);
        if($id_destinatarios != ""){
            $dataDestinatarios= $destinatarios->selectAllDestinatariosById($id_destinatarios);
        }
        $formulario=  clConstantesModelo::formularios();
        $accion_bandeja_entrada=  clConstantesModelo::acciones_bandeja_entrada();
        $accion_bandeja_revision= clConstantesModelo::acciones_bandeja_revision();
        //exit("sesion: ".$_SESSION['id_profile']);
        $accionAdjuntoLeer= verAccion($_SESSION['id_profile'], $formulario['bandeja_revision'], $accion_bandeja_revision['adjunto']);
        $accionPlantillaLeer= verAccion($_SESSION['id_profile'], $formulario['bandeja_revision'], $accion_bandeja_revision['plantilla']);
        $accionImprimirLeer= verAccion($_SESSION['id_profile'], $formulario['bandeja_revision'], $accion_bandeja_revision['imprimir']);


            $accionAdjuntoEntrada = verAccion($_SESSION['id_profile'], $formulario['bandeja_entrada'], $accion_bandeja_entrada['adjunto']);
            $accionPlantillaEntrada = verAccion($_SESSION['id_profile'], $formulario['bandeja_entrada'], $accion_bandeja_entrada['plantilla']);
            $accionImprimirEntrada = verAccion($_SESSION['id_profile'], $formulario['bandeja_entrada'], $accion_bandeja_entrada['imprimir']);
            $accionResponderEntrada = verAccion($_SESSION['id_profile'], $formulario['bandeja_entrada'], $accion_bandeja_entrada['responder']);
            $accionCerrarEntrada = verAccion($_SESSION['id_profile'], $formulario['bandeja_entrada'], $accion_bandeja_entrada['cerrar']);
            $accionAsignarEntrada = verAccion($_SESSION['id_profile'], $formulario['bandeja_entrada'], $accion_bandeja_entrada['asignar']);

        $htmlAdjuntos= "";
        if($dataAdjuntos){
            $htmlAdjuntos= "<table border=\'0\' class=\'tablaTitulo\' width=\'100%\'>";
            for($j= 0; $j < count($dataAdjuntos); $j++){
                $htmlAdjuntos.= "<tr><td><a href=\'bajarAdjuntoVista.php?f=../comunes/uploads/".$dataAdjuntos[$j]["id_archivo"]."_".$dataAdjuntos[$j]["stradjunto"]."\'>".$dataAdjuntos[$j]["stradjunto"]."</a></td></tr>";
            }
            $htmlAdjuntos.= "</table>";
        }
        $html= "<div id='div_c".$id_corresp."'><table class='tablaVer' border='0' width='100%'>";
        if($data){
            $html.= "<tr><td width='10%'>&nbsp;</td><td width='80%'>&nbsp;</td><td width='10%'>&nbsp;</td></tr>";
            $html.= "<tr><td width='10%'>&nbsp;</td><th width='80%'>".$data[0]['strasunto']."</th><td width='10%'>&nbsp;</td></tr>";
            $html.= "<tr><td width='10%'>&nbsp;</td><td width='80%'><hr></td><td width='10%'>&nbsp;</td></tr>";
            $html.= "<tr><td width='10%'>&nbsp;</td><td width='80%'>".$data[0]['strcuerpo']."</td><td width='10%'>&nbsp;</td></tr>";
            $html.= "<tr><td width='10%'>&nbsp;</td><td width='80%'>&nbsp;</td><td width='10%'>&nbsp;</td></tr>";
            if($data[0]['id_estatus_maestro'] == 197){
                $dataNota= $nota->selectAllNotaByIdAC($id_corresp, 239);
                $html.= "<tr><td width='10%'>&nbsp;</td><td width='80%'>";
                $html.= "<div class='mensajes'><div class='mensajes_margen'><span class='mensajes_titulo'>Notas:<br>";
                if($dataNota){
                    for($i= 0; $i < count($dataNota); $i++){
                        $html.= "<ul><li>".$dataNota[$i]['fecha_nota']." | ".$dataNota[$i]['memobsernota']."</li></ul>";
                    }
                }
                $html.= "</span></div></div></td><td width='10%'>&nbsp;</td></tr>";
                $html.= "<tr><td width='10%'>&nbsp;</td><td width='80%'>&nbsp;</td><td width='10%'>&nbsp;</td></tr>";
            }
            $html.= "<tr><td width='10%'>&nbsp;</td><td width='80%' align='center'>";
            if($tipo == 1){
                if($accionPlantillaLeer){
                    $html.= "<a>
                                <img src='../comunes/images/plantilla.png' onmouseover=\"Tip('Usar como plantilla')\" onmouseout='UnTip()' onclick=\"location.href='redactarVista.php?plantilla=".$data[0]['id_corresp']."'\">
                            </a>";
                }
                if($accionImprimirLeer){
                    $html.="    <a>
                                    <img src='../comunes/images/printer.png' onmouseover=\"Tip('Imprimir')\" onmouseout='UnTip()' onclick=\"window.open('imprimirVista.php?id=".$data[0]['id_corresp']."&tipo=".$data[0]['id_tipocorresp_maestro']."','_blank','')\">
                                </a>";
                }
                if($htmlAdjuntos != "" && $accionAdjuntoLeer){
                    $html.= "<a>
                                <img src='../comunes/images/email_attach.png' onmouseover=\"Tip('Ver Adjuntos')\" onmouseout='UnTip()' onclick=\"javascript:Tip('".$htmlAdjuntos."', TITLE, 'Ajuntos', CLOSEBTN, true, STICKY, true)\">
                             </a>";
                }
            }else if($tipo == 2){
                if($accionPlantillaEntrada){
                    $html.= "<a>
                                <img src='../comunes/images/plantilla.png' onmouseover=\"Tip('Usar como plantilla')\" onmouseout='UnTip()' onclick=\"location.href='redactarVista.php?plantilla=".$data[0]['id_corresp']."'\">
                            </a>";
                }
                if($htmlAdjuntos != "" && $accionAdjuntoEntrada){
                    $html.= "<a>
                                <img src='../comunes/images/email_attach.png' onmouseover=\"Tip('Ver Adjuntos')\" onmouseout='UnTip()' onclick=\"javascript:Tip('".$htmlAdjuntos."', TITLE, 'Ajuntos', CLOSEBTN, true, STICKY, true)\">
                             </a>";
                }
                if($accionImprimirEntrada && $data[0]['id_tipo_maestro'] != 85){
                    $html.="    <a>
                                    <img src='../comunes/images/printer.png' onmouseover=\"Tip('Imprimir')\" onmouseout='UnTip()' onclick=\"window.open('imprimirVista.php?id=".$data[0]['id_corresp']."&tipo=".$data[0]['id_tipocorresp_maestro']."','_blank','')\">
                                </a>";
                }
                if($accionResponderEntrada){
                    if(accionesCorrespondencia($dataDestinatarios[0]['id_estatus_maestro'], "", "responder")){
                        $strUrl= "acc=RESP";
                        $strUrl.= "&respIdC=".$data[0]['id_tipo_maestro'];
                        $strUrl.= "&respTipoC=".$data[0]['nombre_tipo_maestro'];
                        $strUrl.= "&respIdD=".$data[0]['id_tipocorresp_maestro'];
                        $strUrl.= "&respTipoD=".$data[0]['nombre_tipocorresp_maestro'];
                        $strUrl.= "&respIdDest=".$id_destinatarios;
                        $strUrl.= "&correlativo=".urlencode($data[0]['strcorrelativo']);
                        if($data[0]['id_origen_unidad_maestro'] == 3){
                            $strUrl.= "&respParaId=".$data[0]['id_unidad_maestro'];
                            $strUrl.= "&respPara=".$data[0]['nombre_unidad_maestro'];
                        }else{
                            $strUrl.= "&respParaId=".$data[0]['id_unidad_maestro'];
                            $strUrl.= "&respPara=".$data[0]['nombre_origen_unidad_maestro']." (".$data[0]['nombre_unidad_maestro'].")";
                        }
                        $html.="    <a>
                                    <img src='../comunes/images/email_go_1.png' onmouseover=\"Tip('Responder')\" onmouseout='UnTip()' onclick=\"location.href='redactarVista.php?".$strUrl."'\">
                                </a>";
                    }
                }
                if($accionCerrarEntrada){
                    if(accionesCorrespondencia($dataDestinatarios[0]['id_estatus_maestro'], "", "cerrar")){
                        $html.="    <a>
                                        <img src='../comunes/images/email_close.png' onmouseover=\"Tip('Cerrar')\" onmouseout='UnTip()' onclick=\"javascript:cerrarCorrespondencia(".$id_destinatarios.", ".$id_corresp.")\">
                                    </a>";
                    }
                }
                if($accionAsignarEntrada){
                    if(accionesCorrespondencia($dataDestinatarios[0]['id_estatus_maestro'], "", "asignar")){
                        $strUrl= "tipoD=".$data[0]['nombre_tipocorresp_maestro'];
                        $strUrl.= "&correlativo=".urlencode($data[0]['strcorrelativo']);
                        $strUrl.= "&idDest=".$id_destinatarios;
                        $html.="    <a>
                                        <img src='../comunes/images/script_go.png' onmouseover=\"Tip('Asignar')\" onmouseout='UnTip()' onclick=\"location.href='actividadAsignarVista.php?".$strUrl."'\">
                                    </a>";
                    }
                }
            }
            $html.= "</td><td width='10%'>&nbsp;</td></tr>";
        }
        $html.= "";
        $html.= "</table></div>";
        if($data[0]['id_estatus_maestro'] >= 199){
            $rutaCorrespondencia->insertRutaCorrespondencia($data[0]['id_corresp'], 237, "", $_SESSION['id_contacto']);
        }
        $respuesta->assign("div_".$id_corresp,"style.border","#339933 2px solid");
        $respuesta->assign("div_".$id_corresp,"innerHTML",$html);
        return $respuesta;
	}

    function updateCorrespondencia($formulario) {
        $respuesta= new xajaxResponse();
        $correspondencia= new clCorrespondenciaModelo();
        $adjuntos= new clAdjuntarModelo();
        $destinatarios= new clDestinatariosModelo();
        $correspondencia->llenar($formulario);
        $data= $correspondencia->updateCorrespondencia();
        $rutaCorrespondencia= new clRutaCorrespondenciaModelo();

        $destinatarios->setId_corresp($formulario['id_corresp']);
        $destinatarios->updateDestinatarios();
        $destPara= split(";", $formulario['paraId']);
        $destCC= split(";", $formulario['ccId']);
        $destCCO= split(";", $formulario['ccoId']);
        for($i= 0; $i < count($destPara)-1; $i++){
            $destinatarios->setId_destino_maestro($destPara[$i]);
            $destinatarios->setId_tipoenvio_maestro(190);
            $destinatarios->insertDestinatarios();
        }
        for($i= 0; $i < count($destCC)-1; $i++){
            $destinatarios->setId_destino_maestro($destCC[$i]);
            $destinatarios->setId_tipoenvio_maestro(191);
            $destinatarios->insertDestinatarios();
        }
        for($i= 0; $i < count($destCCO)-1; $i++){
            $destinatarios->setId_destino_maestro($destCCO[$i]);
            $destinatarios->setId_tipoenvio_maestro(192);
            $destinatarios->insertDestinatarios();
        }
        if($formulario['adjunto'] != ""){
            $adjuntos->updateAdjunto($formulario['id_corresp'], $formulario['adjunto']);
        }
        $para= split(";", $formulario['para']);
        $cc= split(";", $formulario['cc']);
        $cco= split(";", $formulario['cco']);
        for($i= 0; $i < count($para)-1; $i++){
            $nombrePara.= $para[$i]."<br>";
        }
        for($i= 0; $i < count($cc)-1; $i++){
            $nombreCC.= $para[$i]."<br>";
        }
        for($i= 0; $i < count($cco)-1; $i++){
            $nombreCCO.= $para[$i]."<br>";
        }
        $descripcion= "<b><u>Destinatarios</u></b><br>".$nombrePara;
        $descripcion.= "<b><u>CC</u></<b><br>";
        $descripcion.= ($nombreCC == "") ? "Sin CC<br>" : $nombreCC;
        $descripcion.= "<b><u>CCO</u></<b><br>";
        $descripcion.= ($nombreCCO == "") ? "Sin CCO<br>" : $nombreCCO;
        $rutaCorrespondencia->insertRutaCorrespondencia($formulario['id_corresp'], 235, $descripcion, $_SESSION['id_contacto']);
        if($formulario['id_estatus_maestro'] == 199){
            enviarCorrespondencia($formulario['id_corresp'], $formulario['id_tipocorresp_maestro'], 194, "1");
        }
        $respuesta->script("alert('¡La correspondencia se actualizado satisfactoriamente!')");
        $respuesta->script("location.href='leerVista.php'");
		return $respuesta;
    }

    function deleteCorrespondencia($id_corresp, $estatus) {
        $respuesta= new xajaxResponse();
        $correspondencia= new clCorrespondenciaModelo();
        $adjuntos= new clAdjuntarModelo();
        $destinatarios= new clDestinatariosModelo();

        $correspondencia->deleteCorrespondencia($id_corresp);
        $destinatarios->deleteDestinatarios($id_corresp);
        $adjuntos->deleteAdjuntoById($id_corresp);

        $respuesta->script("alert('¡La correspondencia se ha eliminado satisfactoriamente!')");
        $respuesta->script("location.href='leerVista.php'");
        $respuesta->script("xajax_selectAllCorrespondencia(".$estatus.", ".$_SESSION['id_contacto'].")");
		return $respuesta;
    }

    function enviarCorrespondencia($id_corresp, $id_tipo_maestro, $id_estatus_maestro, $tipo= ""){
//        exit("ID_TIPO_MAESTRO: ".$id_tipo_maestro);
        $respuesta= new xajaxResponse();
        $correspondencia= new clCorrespondenciaModelo();
        $destinatarios= new clDestinatariosModelo();
        $correlativo= new clCorrelativoModelo();
        $maestros= new clMaestroModelo();
        $rutaCorrespondencia= new clRutaCorrespondenciaModelo();
        $validacion= new clValidacionModelo();
        $autorizado= new clAutorizadoModelo();
        $firma= new clFirmaAutorizada();
        $contacto= new clContactoModelo();

        $existe= false;
        $mensaje= "";
        $strcorrelativo= "";
        $estatusEnvio= "";
        $firmaAutorizada="";

        if($_SESSION['estructura'] == "H"){
            $lngnumero= 0;
        }else if($_SESSION['estructura'] == "V"){
            $lngnumero= 1;
        }
        
        $dataAutorizado= $autorizado->selectAllAutorizadoByIdPerfilLngnumero($_SESSION['id_profile'], $lngnumero, $id_estatus_maestro);
        
//        exit(print_r($dataAutorizado));
        if($dataAutorizado[0]['id_estfinal_maestro'] == 199){
            $dataCorrespondencia= $correspondencia->selectAllCorrespondenciaById($id_corresp);
            if($dataCorrespondencia[0]['strcorrelativo'] == ""){
                $dataDestinatarios= $destinatarios->selectAllDestinatariosByIdCorresp($id_corresp);
                $cantDestinatarios= count($dataDestinatarios);
                $cantTotal= 0;
                for($i= 0; $i < $cantDestinatarios; $i++){
                    if($dataDestinatarios[$i]['id_origen_destinatario'] == $dataCorrespondencia[0]['id_origen_unidad_maestro'] && $dataDestinatarios[$i]['id_origen_destinatario'] != 3){
                        $cantTotal+= 1;
                    }
                }
                if($cantTotal == $cantDestinatarios && $_SESSION['estructura'] == "V"){
                    $dataCorrelativo= $correlativo->selectCorrelativoByCoordinacion($_SESSION['id_coord_maestro'], $dataCorrespondencia[0]['id_unidad_maestro'], $id_tipo_maestro);
                    
                    $dataMaestro= $maestros->selectMaestroPadreById($dataCorrespondencia[0]['id_unidad_maestro']);
                    $estatusEnvio= 199;
                    $firmaAutorizada= "C";
                }else if($_SESSION['id_profile'] == 114 && $_SESSION['estructura'] == "V"){
                    $mensaje= "La correspondencia ha sido enviada al gerente con exito!";
                    $estatusEnvio= 196;
                }else{
                    //$dataCorrelativo= $correlativo->selectCorrelativoByGerencia($_SESSION['id_coord_maestro'], $id_tipo_maestro);
                    //$dataCorrelativo= $correlativo->selectCorrelativoByGerencia(clConstantesModelo::departamentos, $id_tipo_maestro);
                    $dataCorrelativo= $correlativo->selectCorrelativoByGerencia($_SESSION['id_dpto_maestro'], $id_tipo_maestro,$_SESSION['id_coord_maestro']);
                    $dataMaestro= $maestros->selectMaestroPadreById($_SESSION['id_coord_maestro']);
                    $estatusEnvio= 199;
                    $firmaAutorizada= "G";
                }
                if($dataCorrelativo){
                    $strcorrelativo= $dataMaestro[0]['stritemb']."/".$dataCorrelativo[0]['lnginicio']."/".$dataCorrelativo[0]['lnganio'];
                    
                    $correlativo->updateCorrelativoNumero($dataCorrelativo[0]['id_correlativo'], $dataCorrelativo[0]['lnginicio']+1);
                    $id_estatus_maestro_dest= 200;
                    $mensaje= "La correspondencia ha sido enviada con exito!";
                }else if($estatusEnvio == 199){
                    $respuesta->script("alert('¡No existe correlativo para este tipo de documento!')");
                    return $respuesta;
                }
            }else{
                $existe= true;
                $estatusEnvio= 199;
                $id_estatus_maestro_dest= 200;
                $firmaAutorizada= "G";
                $strcorrelativo= $dataCorrespondencia[0]['strcorrelativo'];
                $mensaje= "La correspondencia ha sido enviada con exito!";
            }
        }else if($dataAutorizado[0]['id_estfinal_maestro'] == 195){
            $mensaje= "¡La correspondencia ha sido enviada al coordinador con exito!";
            $estatusEnvio= 195;
        }else if($dataAutorizado[0]['id_estfinal_maestro'] == 196){
            $mensaje= "¡La correspondencia ha sido enviada al gerente con exito!";
            $estatusEnvio= 196;
        }else if($id_estatus_maestro == 197){
            $mensaje= "¡La correspondencia fue devuelta con exito!";
            $estatusEnvio= 197;
        }
       
        $correspondencia->enviarCorrespondencia($id_corresp, $estatusEnvio, $strcorrelativo);
         //exit ("ID_ESTATUS: ".$estatusEnvio);
        if($estatusEnvio == 199){
            $rutaCorrespondencia->insertRutaCorrespondencia($id_corresp, 236, "", $_SESSION['id_contacto']);
            $destinatarios->updateEstatusDestinatarios($id_corresp, $id_estatus_maestro_dest);
            $validacion->setCodigo_validacion(uniqid());
            $validacion->setId_contacto($_SESSION['id_contacto']);
            $validacion->setId_corresp($id_corresp);
            $validacion->insertValidacion();
            //$dataCreador= $contacto->selectContactoById($dataCorrespondencia[0]['id_contacto']);
            //exit("Firma_Autorizada: ".$firmaAutorizada);
            if($firmaAutorizada == "C"){
                $dataContacto= $contacto->verCoordinador($_SESSION['id_coord_maestro']);
            }else if($firmaAutorizada == "G"){
                $dataContacto= $contacto->verGerente($_SESSION['id_dpto_maestro']);
            }
            $firma->setId_corresp($id_corresp);
            $firma->setId_contacto($dataContacto[0]['id_contacto']);
            $firma->insertFirmaAutorizada();
            if($existe){
                $correspondencia->updateFechaEnvio($id_corresp);
            }
        }
        if($tipo == ""){
            $respuesta->script("ocultar('div_e".$id_corresp."', '".$mensaje."')");
        }
        return $respuesta;
    }

    function selectAllCorrespondenciaEntrante($pagina){
        $respuesta= new xajaxResponse();
        $correspondencia= new clCorrespondenciaModelo();
        $destinatarios= new clDestinatariosModelo();
        $contactoExterno= new clContactoExternoModelo();

        $data= "";
        $html= "";
        if($_SESSION['id_coord_maestro'] == 0){
            $id_destino_maestro= $_SESSION['id_dpto_maestro'];
        }else{
            $id_destino_maestro= $_SESSION['id_coord_maestro'];
        }

        $formulario=  clConstantesModelo::formularios();
        $accion_bandeja_entrada=  clConstantesModelo::acciones_bandeja_entrada();
        $accionVer= verAccion($_SESSION['id_profile'], $formulario['bandeja_entrada'], $accion_bandeja_entrada['ver']);
        $accionSeguimeinto= verAccion($_SESSION['id_profile'], $formulario['bandeja_entrada'], $accion_bandeja_entrada['seguimiento']);

        $dataC= $destinatarios->selectAllDestinatariosByIdDestino($id_destino_maestro, $pagina);
        $data= $dataC[0];
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='6%'>
                                    <a href='#' onclick=\"\">Id</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"\">Fecha</a>
                                </th>
                                <th width='22%'>
                                    <a href='#' onclick=\"\">Documento</a>
                                </th>
                                <th width='28%'>
                                    <a href='#' onclick=\"\">Remitente</a>
                                </th>
                                <th width='12%'>
                                    <a href='#' onclick=\"\">Correlativo</a>
                                </th>
                                <th width='15%'>
                                    <a href='#' onclick=\"\">Estatus</a>
                                </th>
                                <th width='7%'>Acci&oacute;n</th>
                            </tr>
                        </table>";
            for ($i= 0; $i < count($data); $i++){
                $dataCorrespondencia= $correspondencia->selectAllCorrespondenciaById($data[$i]['id_corresp']);
                $html.= "<div id='div_e".$dataCorrespondencia[0]['id_corresp']."'><table border='0' class='tablaTitulo' width='100%'>
                            <tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue';\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='6%' align='center' onmouseover=\"Tip('".$dataCorrespondencia[0]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i]['id_corresp']."</td>
                            <td width='10%' align='center' onmouseover=\"Tip('".$dataCorrespondencia[0]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$dataCorrespondencia[0]['fecha_envio']."</td>
                            <td width='22%' align='center' onmouseover=\"Tip('".$dataCorrespondencia[0]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$dataCorrespondencia[0]['nombre_tipocorresp_maestro']."</td>";
                if($dataCorrespondencia[0]['id_tipo_maestro'] == 84){
                    if($dataCorrespondencia[0]['id_origen_unidad_maestro'] == clConstantesModelo::departamentos){
                        $html.= "<td width='28%' align='center' onmouseover=\"Tip('".$dataCorrespondencia[0]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$dataCorrespondencia[0]['nombre_unidad_maestro']."</td>";
                    }else{
                        $html.= "<td width='28%' align='center' onmouseover=\"Tip('".$dataCorrespondencia[0]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$dataCorrespondencia[0]['nombre_origen_unidad_maestro']."<br>(".$dataCorrespondencia[0]['nombre_unidad_maestro'].")</td>";
                    }
                }else if($dataCorrespondencia[0]['id_tipo_maestro'] == 85){
                    $dataContactoExterno= $contactoExterno->selectAllContactoExternoById($dataCorrespondencia[0]['id_unidad_maestro']);
                    $html.= "<td width='28%' align='center' onmouseover=\"Tip('".$dataCorrespondencia[0]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$dataContactoExterno[0]['strinstitucion']."</td>";
                }
                $html.= "   <td width='12%' align='center' onmouseover=\"Tip('".$dataCorrespondencia[0]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$dataCorrespondencia[0]['strcorrelativo']."</a></td>
                            <td width='15%' align='center' onmouseover=\"Tip('".$dataCorrespondencia[0]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'><div id='capaEstatusEntrantes_".$data[$i]['id_destinatarios']."'>".$data[$i]['estatus']."</div></a></td>
                            <td width='7%' align='left'>";
                if($accionVer){
                    $html.="    <a>
                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Ver Detalles')\" onmouseout='UnTip()' onclick=\"verDetalles('".$data[$i]['id_corresp']."', ".$data[$i]['id_destinatarios'].", ".$data[$i]['id_estatus_maestro'].")\">
                                </a>";
                }
                if($accionSeguimeinto){
                    $html.="    <a>
                                    <img src='../comunes/images/seguimiento.png' onmouseover=\"Tip('Ver Seguimiento')\" onmouseout='UnTip()' onclick=\"verSeguimiento('".$data[$i]['id_corresp']."')\">
                                </a>";
                }
                $html.= "
                            </td>
                        </tr></table><div id='div_".$data[$i]['id_corresp']."' style='display:none;background:#dfdfdf'></div></div>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Correspondencias Registradas</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        $respuesta->assign("pag","innerHTML",$dataC[1]);
        return $respuesta;
    }

    function selectAllCorrespondenciaEntranteFiltros($pagina, $fechaHasta= "", $fechaDesde= "", $id_estatus_maestro= "", $strasunto= "", $id_tipo_maestro= "", $id_tipocorresp_maestro= "", $id_unidad_maestro= ""){
        $respuesta= new xajaxResponse();
        $correspondencia= new clCorrespondenciaModelo();
        $destinatarios= new clDestinatariosModelo();
        $contactoExterno= new clContactoExternoModelo();
        $data= "";
        $html= "";
        if($_SESSION['id_coord_maestro'] == 0){
            $id_destino_maestro= $_SESSION['id_dpto_maestro'];
        }else{
            $id_destino_maestro= $_SESSION['id_coord_maestro'];
        }

       $formulario=  clConstantesModelo::formularios();
        $accion_bandeja_entrada=  clConstantesModelo::acciones_bandeja_entrada();
        $accionVer= verAccion($_SESSION['id_profile'], $formulario['bandeja_entrada'], $accion_bandeja_entrada['ver']);
        $accionSeguimeinto= verAccion($_SESSION['id_profile'], $formulario['bandeja_entrada'], $accion_bandeja_entrada['seguimiento']);

        $dataC= $correspondencia->selectAllCorrespondenciasEntrantesFiltros($id_destino_maestro, $pagina, $fechaHasta, $fechaDesde, $id_estatus_maestro, $strasunto, $id_tipo_maestro, $id_tipocorresp_maestro, $id_unidad_maestro);
        $data= $dataC[0];
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8;'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='6%'>
                                    <a href='#' onclick=\"\">Id</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"\">Fecha</a>
                                </th>
                                <th width='22%'>
                                    <a href='#' onclick=\"\">Documento</a>
                                </th>
                                <th width='28%'>
                                    <a href='#' onclick=\"\">Remitente</a>
                                </th>
                                <th width='12%'>
                                    <a href='#' onclick=\"\">Correlativo</a>
                                </th>
                                <th width='15%'>
                                    <a href='#' onclick=\"\">Estatus</a>
                                </th>
                                <th width='7%'>Acci&oacute;n</th>
                            </tr>
                        </table>";
            for ($i= 0; $i < count($data); $i++){

                $dataDestinatarios= $destinatarios->selectAllDestinatariosByIdCorresp($data[$i]['id_corresp'], $id_estatus_maestro, $id_destino_maestro);
                //for ($y= 0; $y < count($dataDestinatarios); $y++){
                    $html.= "<div id='div_e".$data[$i]['id_corresp']."'><table border='0' class='tablaTitulo' width='100%'>
                                <tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue';\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                <td width='6%' align='center' onmouseover=\"Tip('".$data[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i]['id_corresp']."</td>
                                <td width='10%' align='center' onmouseover=\"Tip('".$data[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i]['fecha_envio']."</td>
                                <td width='22%' align='center' onmouseover=\"Tip('".$data[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i]['nombre_tipocorresp_maestro']."</td>";
                    if($data[$i]['id_tipo_maestro'] == 84){
                        if($data[$i]['id_origen_unidad_maestro'] == clConstantesModelo::departamentos){
                            $html.= "<td width='28%' align='center' onmouseover=\"Tip('".$data[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i]['nombre_unidad_maestro']."</td>";
                        }else{
                            $html.= "<td width='28%' align='center' onmouseover=\"Tip('".$data[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i]['nombre_origen_unidad_maestro']."<br>(".$data[$i]['nombre_unidad_maestro'].")</td>";
                        }
                    }else if($data[$i]['id_tipo_maestro'] == 85){
                        $dataContactoExterno= $contactoExterno->selectAllContactoExternoById($data[$i]['id_unidad_maestro']);
                        $html.= "<td width='28%' align='center' onmouseover=\"Tip('".$dataCorrespondencia[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$dataContactoExterno[0]['strinstitucion']."</td>";
                    }
                    $html.= "   <td width='12%' align='center' onmouseover=\"Tip('".$data[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i]['strcorrelativo']."</a></td>
                                <td width='15%' align='center' onmouseover=\"Tip('".$data[$i]['strasunto']."', TITLE, 'Asunto')\" onmouseout='UnTip()'><div id='capaEstatusEntrantes_".$dataDestinatarios[0]['id_destinatarios']."'>".$dataDestinatarios[0]['estatus']."</div></a></td>
                                <td width='7%' align='left'>";
                    if($accionVer){
                        $html.="    <a>
                                        <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Ver Detalles')\" onmouseout='UnTip()' onclick=\"verDetalles('".$data[$i]['id_corresp']."', ".$dataDestinatarios[0]['id_destinatarios'].", ".$dataDestinatarios[0]['id_estatus_maestro'].")\">
                                    </a>";
                    }
                    if($accionSeguimeinto){
                        $html.="    <a>
                                        <img src='../comunes/images/seguimiento.png' onmouseover=\"Tip('Ver Seguimiento')\" onmouseout='UnTip()' onclick=\"verSeguimiento('".$data[$i]['id_corresp']."')\">
                                    </a>";
                    }
                    $html.= "
                                </td>
                            </tr></table><div id='div_".$data[$i]['id_corresp']."' style='display:none;background:#dfdfdf'></div></div>";
                //}
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Correspondencias Registradas</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        $respuesta->assign("pag","innerHTML",$dataC[1]);
        return $respuesta;
    }

    function accionesCorrespondencia($id_estatus_maestro, $id_contacto, $accion){
        if($accion == "editar"){
            if($id_estatus_maestro == 194 && $id_contacto == $_SESSION['id_contacto']){
                return true;
            }else if($id_estatus_maestro == 195 && $_SESSION['id_profile'] == 114){
                return true;
            }else if($id_estatus_maestro == 196 && $_SESSION['id_profile'] == 113){
                return true;
            }else if($id_estatus_maestro == 197 && $id_contacto == $_SESSION['id_contacto']){
                return true;
            }else if($id_estatus_maestro == 198 && $_SESSION['id_profile'] == 113){
                return true;
            }else if($id_estatus_maestro == 199){
                return false;
            }
        }else if($accion == "eliminar"){
            if($id_estatus_maestro == 194 && $id_contacto == $_SESSION['id_contacto']){
                return true;
            }else if($id_estatus_maestro == 195 && $_SESSION['id_profile'] == 114){
                return true;
            }else if($id_estatus_maestro == 196 && $_SESSION['id_profile'] == 113){
                return true;
            }else if($id_estatus_maestro == 197 && $id_contacto == $_SESSION['id_contacto']){
                return false;
            }else if($id_estatus_maestro == 198 && $_SESSION['id_profile'] == 113){
                return true;
            }else if($id_estatus_maestro == 199){
                return false;
            }
        }else if($accion == "responder"){
            if($id_estatus_maestro == 200){
                return true;
            }else if($id_estatus_maestro == 201){
                return true;
            }else if($id_estatus_maestro == 202){
                return true;
            }else if($id_estatus_maestro == 203){
                return true;
            }else if($id_estatus_maestro == 204){
                return true;
            }else if($id_estatus_maestro == 205){
                return true;
            }else if($id_estatus_maestro == 216){
                return false;
            }else if($id_estatus_maestro == 217){
                return false;
            }
        }else if($accion == "cerrar"){
            if($id_estatus_maestro == 200){
                return true;
            }else if($id_estatus_maestro == 201){
                return true;
            }else if($id_estatus_maestro == 202){
                return true;
            }else if($id_estatus_maestro == 203){
                return true;
            }else if($id_estatus_maestro == 204){
                return false;
            }else if($id_estatus_maestro == 205){
                return true;
            }else if($id_estatus_maestro == 216){
                return false;
            }else if($id_estatus_maestro == 217){
                return true;
            }
        }else if($accion == "asignar"){
            if($id_estatus_maestro == 200){
                return true;
            }else if($id_estatus_maestro == 201){
                return true;
            }else if($id_estatus_maestro == 202){
                return true;
            }else if($id_estatus_maestro == 203){
                return true;
            }else if($id_estatus_maestro == 204){
                return true;
            }else if($id_estatus_maestro == 205){
                return true;
            }else if($id_estatus_maestro == 216){
                return false;
            }else if($id_estatus_maestro == 217){
                return true;
            }
        }
    }

    function updateDestinatariosEstatus($id_destinatarios, $id_estatus_maestro, $id_corresp= "") {
        $destinatarios= new clDestinatariosModelo();
        $respuesta= new xajaxResponse();
        if($id_estatus_maestro == 200){
            $destinatarios->updateEstatusDestinatariosByIdDestinatarios($id_destinatarios, 202);
        }else if($id_estatus_maestro == 201){
            $destinatarios->updateEstatusDestinatariosByIdDestinatarios($id_destinatarios, 203);
        }else if($id_estatus_maestro == 216){
            $destinatarios->updateEstatusDestinatariosByIdDestinatarios($id_destinatarios, 216);
            $respuesta->script("ocultar('div_e".$id_corresp."', '¡La correspondencia se ha cerrado satisfactoriamente!')");
            return $respuesta;
        }else if($id_estatus_maestro == 217){
            $destinatarios->updateEstatusDestinatariosByIdDestinatarios($id_destinatarios, 217);
        }
    }

    function insertNota($formulario) {
        $respuesta= new xajaxResponse();
        $nota= new clNotaModelo();
        $nota->llenar($formulario);
        $nota->setId_actividad("null");
        $nota->setId_contacto($_SESSION['id_contacto']);
        $nota->insertNota();
        $respuesta->script("enviarCorrespondencia(".$formulario['id_corresp'].", ".$formulario['tipo'].", ".$formulario['estatus'].")");
        return $respuesta;
        
    }

    function reenviarCorrespondencia($id_corresp) {//OJO FALTA RUTA
        $respuesta= new xajaxResponse();
        $destinatarios= new clDestinatariosModelo();
        $destinatarios->insertDestinatarioReenvio($id_corresp);
        $respuesta->script("alert('¡La correspondencia se ha reenviado satisfactoriamente!');");
        return $respuesta;
    }

    function correspondenciasPendientes() {
        $respuesta= new xajaxResponse();
        $correspondencia= new clCorrespondenciaModelo();
        $contactoActividad= new clContactoActividadModelo();
        
        $html= "";
        if($_SESSION['id_coord_maestro'] == 0){
            $id_destino_maestro= $_SESSION['id_dpto_maestro'];
        }else{
            $id_destino_maestro= $_SESSION['id_coord_maestro'];
        }
        $dataInternaNoleida= $correspondencia->selectAllCorrespondenciasEntrantesFiltros($id_destino_maestro, 0, "", "", 200, "", "", "", "");
        $dataInternaleida= $correspondencia->selectAllCorrespondenciasEntrantesFiltros($id_destino_maestro, 0, "", "", 202, "", "", "", "");
        $dataExternaNoleida= $correspondencia->selectAllCorrespondenciasEntrantesFiltros($id_destino_maestro, 0, "", "", 201, "", "", "", "");
        $dataExternaleida= $correspondencia->selectAllCorrespondenciasEntrantesFiltros($id_destino_maestro, 0, "", "", 203, "", "", "", "");

        $dataActividadAsignadaAnalista= $contactoActividad->cantidadContactosActividadByIdContactoIdEstatus($_SESSION['id_contacto'], 249);
        $dataActividadDevuelta= $contactoActividad->cantidadContactosActividadByIdContactoIdEstatus($_SESSION['id_contacto'], 253);
        $dataActividadEnProceso= $contactoActividad->cantidadContactosActividadByIdContactoIdEstatus($_SESSION['id_contacto'], 265);

        $html.= "<table border='0' class='tablaTitulo' width='100%'>";
        $html.= "<tr>
                    <td width='5%'>&nbsp;</td>
                    <td width='90%' colspan='2' class='menu_izq_titulo'><u>Correspondencia</u></td>
                    <td width='5%'>&nbsp;</td>
                </tr>";
        if($dataInternaNoleida[0]){
            $html.= "<tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='5%'>&nbsp;</td>
                        <td width='85%'><a href='../vista/bandejaVista.php?cargar=200'>Interna Recibida No Leida (".count($dataInternaNoleida).")</a></td>
                        <td width='5%'>&nbsp;</td>
                    </tr>";
        }else{
            $html.= "<tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='5%'>&nbsp;</td>
                        <td width='85%'><a href='../vista/bandejaVista.php?cargar=200'>Interna Recibida No Leida (0)</a></td>
                        <td width='5%'>&nbsp;</td>
                    </tr>";
        }

        if($dataInternaleida[0]){
            $html.= "<tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='5%'>&nbsp;</td>
                        <td width='85%'><a href='../vista/bandejaVista.php?cargar=202'>Interna Recibida Leida (".count($dataInternaleida).")</a></td>
                        <td width='5%'>&nbsp;</td>
                    </tr>";
        }else{
            $html.= "<tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='5%'>&nbsp;</td>
                        <td width='85%'><a href='../vista/bandejaVista.php?cargar=202'>Interna Recibida Leida (0)</a></td>
                        <td width='5%'>&nbsp;</td>
                    </tr>";
        }

        if($dataExternaNoleida[0]){
            $html.= "<tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='5%'>&nbsp;</td>
                        <td width='85%'><a href='../vista/bandejaVista.php?cargar=201'>Externa Recibida No Leida (".count($dataExternaNoleida).")</a></td>
                        <td width='5%'>&nbsp;</td>
                    </tr>";
        }else{
            $html.= "<tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='5%'>&nbsp;</td>
                        <td width='85%'><a href='../vista/bandejaVista.php?cargar=201'>Externa Recibida No Leida (0)</a></td>
                        <td width='5%'>&nbsp;</td>
                    </tr>";
        }

        if($dataExternaleida[0]){
            $html.= "<tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='5%'>&nbsp;</td>
                        <td width='85%'><a href='../vista/bandejaVista.php?cargar=203'>Externa Recibida Leida (".count($dataExternaleida).")</a></td>
                        <td width='5%'>&nbsp;</td>
                    </tr>";
        }else{
            $html.= "<tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='5%'>&nbsp;</td>
                        <td width='85%'><a href='../vista/bandejaVista.php?cargar=203'>Externa Recibida Leida (0)</a></td>
                        <td width='5%'>&nbsp;</td>
                    </tr>";
        }
        $html.= "<tr>
                    <td width='5%'>&nbsp;</td>
                    <td width='90%' colspan='2' class='menu_izq_titulo'></td>
                    <td width='5%'>&nbsp;</td>
                </tr>
                <tr>
                    <td width='5%'>&nbsp;</td>
                    <td width='90%' colspan='2' class='menu_izq_titulo'><u>Actividades</u></td>
                    <td width='5%'>&nbsp;</td>
                </tr>
                <tr>
                    <td width='5%'>&nbsp;</td>
                    <td width='5%'>&nbsp;</td>
                    <td width='85%'><a href='../vista/actividadVista.php'>Actividades Asignadas (".$dataActividadAsignadaAnalista[0]['count'].")</a></td>
                    <td width='5%'>&nbsp;</td>
                </tr>
                <tr>
                    <td width='5%'>&nbsp;</td>
                    <td width='5%'>&nbsp;</td>
                    <td width='85%'><a href='../vista/actividadVista.php'>Actividades Devueltas (".$dataActividadDevuelta[0]['count'].")</a></td>
                    <td width='5%'>&nbsp;</td>
                </tr>
                <tr>
                    <td width='5%'>&nbsp;</td>
                    <td width='5%'>&nbsp;</td>
                    <td width='85%'><a href='../vista/actividadVista.php'>Actividades Asignadas en Proceso (".$dataActividadEnProceso[0]['count'].")</a></td>
                    <td width='5%'>&nbsp;</td>
                </tr>
            </table>";
        $respuesta->assign("capaCorrespondencia","innerHTML",$html);
        return $respuesta;
    }

    function actualizarEstatus($id_destinatarios) {
        $respuesta= new xajaxResponse();
        $destinatarios= new clDestinatariosModelo();
        $data= $destinatarios->selectAllDestinatariosById($id_destinatarios);
        $respuesta->assign("capaEstatusEntrantes_".$id_destinatarios,"innerHTML",$data[0]['estatus']);
        return $respuesta;
    }
?>
