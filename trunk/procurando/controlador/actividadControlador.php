<?php
    session_start();

    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clActividadesModelo.php';
    require_once '../comunes/php/utilidades.php';
    require_once '../modelo/clContactoModelo.php';
    require_once '../modelo/clDepartamentoActividadModelo.php';
    require_once '../modelo/clContactoActividadModelo.php';
    require_once '../modelo/clDestinatariosModelo.php';
    require_once '../modelo/clCorrespondenciaModelo.php';
    require_once '../modelo/clNotaModelo.php';
    require_once '../modelo/clAdjuntarActividadModelo.php';
    require_once '../modelo/clRutaCorrespondenciaModelo.php';
    require_once '../modelo/clDetalleContactoActividadModelo.php';
    require_once '../controlador/contactoControlador.php';
    require_once '../controlador/adjuntarActividadControlador.php';

    verificarSession();

    function selectActividadByIdDestinatario($id_destinatarios) {
        $respuesta= new xajaxResponse();
        $actividad= new clActividadesModelo();
        $contactoActividad= new clContactoActividadModelo();
        $data= "";
        $html= "";
        $data= $actividad->selectActividadByIdDestinatario($id_destinatarios);
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='7%'>
                                    <a href='#' onclick=\"\">Id</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"\">Fecha</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"\">Titulo</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"\">Prioridad</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"\">Asignados</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"\">Estatus</a>
                                </th>
                                <th width='10%'>Acci&oacute;n</th>
                            </tr></table>";
            for ($i= 0; $i < count($data); $i++){
                $cantidad= $contactoActividad->cantidadAsignadosByIdActividad($data[$i]['id_actividad']);
                $html.= "<div id='div_e".$data[$i]['id_actividad']."'><table border='0' class='tablaTitulo' width='100%'>
                         <tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='7%' align='center'>".$data[$i]['id_actividad']."</td>
                            <td width='10%' align='center'>".$data[$i]['fecha_resolucion']."</td>
                            <td width='30%'>".$data[$i]['memtitulo']."</td>
                            <td width='10%' align='center'>".$data[$i]['nombre_prioridad_maestro']."</td>
                            <td width='10%' align='center'>".$cantidad[0]['count']."</td>
                            <td width='20%'>".$data[$i]['nombre_estatus_maestro']."</td>
                            <td width='10%'>
                                <a>
                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Ver Detalles')\" onmouseout='UnTip()' onclick=\"verDetalles('".$data[$i]['id_actividad']."')\">
                                </a>";
                if($cantidad[0]['count'] == 0){
                    $html.= "       <a>
                                        <img src='../comunes/images/script_delete.png' onmouseover=\"Tip('Eliminar')\" onmouseout='UnTip()' onclick=\"eliminarActividad(".$data[$i]['id_actividad'].")\">
                                    </a>";
                }
                $html.= "
                            </td>
                        </tr></table><div id='div_".$data[$i]['id_actividad']."' style='display:none;background:#dfdfdf'></div></div>";
            }
            $html.= "</div>";
            $respuesta->script("$('pestana3').style.display='inline';");
            $respuesta->script("$('pestana3').style.visibility='visible';");
            $respuesta->script("xajax_llenarSelectActividad(".$id_destinatarios.", '100%', 'capaActividad', 'onchange=\"xajax_selectDepartamentosActividadByIdActividad(this.value)\"')");
            $respuesta->script("xajax_llenarSelectActividad(".$id_destinatarios.", '100%', 'capaActividadAnalista', 'onchange=\"cargarAnalista(this.value)\"')");
        }else{
            $html="<div class='celda_etiqueta'>No Hay Actividades Creadas</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        return $respuesta;
    }

    function llenarSelectPrioridad($ancho, $select= "") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos(242, 'id_maestro');
        $html= "<select id='id_prioridad_maestro' name='id_prioridad_maestro' style='width:".$ancho."'>";
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
        $respuesta->assign("capaPrioridad","innerHTML",$html);
        return $respuesta;
    }

    function llenarSelectActividad($id_destinatarios, $ancho, $divInput, $function= "", $select= "") {
        $respuesta= new xajaxResponse();
        $actividad= new clActividadesModelo();
        $data= "";
        $html= "";
        $data= $actividad->selectActividadByIdDestinatario($id_destinatarios);
        $html= "<select id='id_actividad' name='id_actividad' style='width:".$ancho."' ".$function.">";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_actividad']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_actividad']."' ".$seleccionar.">".$data[$i]['memtitulo']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign($divInput,"innerHTML",$html);
        return $respuesta;
    }

    function cargarGerencias() {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos(clConstantesModelo::departamentos, "stritema");
        if($data){
            $html= "<table class='tablaTitulo' width='100%'>";
            $html.="<tr>";
            $html.="<th width='90%'>Gerencia</th>";
            $html.="<th width='10%' align='center'>&nbsp;</th>";
            $html.="</tr>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<tr bgcolor='#E1E1E1'><td width='90%'>".$data[$i]['stritema']."</td>";
                $html.= "<td width='10%'><input type='checkbox' id='idGerencias[]' name='idGerencias[]' value='".$data[$i]['id_maestro']."' onclick=\"javascript:xajax_cargarCoordinaciones(xajax.getFormValues('frmasignar'));\"></td></tr>";
            }
            $html.= "</table>";
        }
        $respuesta->assign("capaGerencia", "innerHTML", $html);
        return $respuesta;
    }

    function cargarCoordinaciones($formulario) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $html= "<table class='tablaTitulo' width='100%'>";
        $html.="<tr>";
        $html.="<th width='90%'>Coordinaci&oacute;n</th>";
        $html.="<th width='10%' align='center'>&nbsp;</th>";
        $html.="</tr>";
        for ($i= 0; $i < count($formulario['idGerencias']); $i++){
            if($_SESSION['id_profile'] != 114){
                $data= $maestro->selectAllMaestroHijos($formulario['idGerencias'][$i], "stritema");
            }else{
                $data= $maestro->selectMaestroPadreById($_SESSION['id_coord_maestro']);
            }
            if($data){
                for ($x= 0; $x < count($data); $x++){
                    $html.= "<tr bgcolor='#E1E1E1'><td width='90%'>".$data[$x]['stritema']."</td>";
                    $html.= "<td width='10%'><input type='checkbox' id='idCoordinaciones[]' name='idCoordinaciones[]' value='".$data[$x]['id_maestro']."'></td></tr>";
                }
                
            }
        }
        $html.= "</table>";
        $respuesta->assign("capaCoordinacion", "innerHTML", $html);
        return $respuesta;
    }

    function llenarSelectAnalista($id_actividad) {
        $respuesta= new xajaxResponse();
        $contacto= new clContactoModelo();
        $maestro= new clMaestroModelo();
        $departamentoActividad= new clDepartamentoActividadModelo();
        $data= "";
        $html= "";
        $html= "<select id='id_contacto' name='id_contacto' style='width:100%'>";
        $html.= "<option value='0'>Seleccione</option>";
        $data= $departamentoActividad->selectDepartamentoActividadByIdActividad($id_actividad);
        $departamentos= "";
        if($data){
            for($i= 0; $i < count($data); $i++){
                $departamentos.= $data[$i]['id_departamento_maestro'];
                if(count($data) != ($i+1)){
                    $departamentos.= ",";
                }
            }
            $dataContacto= $contacto->selectContactoByIdDepartamento($departamentos);
            if($dataContacto){
                for($y= 0; $y < count($dataContacto); $y++){
                    if($dataContacto[$y]['id_coord_maestro'] == 0){
                        $dataMaestro= $maestro->selectMaestroPadreById($dataContacto[$y]['id_dpto_maestro']);
                    }else{
                        $dataMaestro= $maestro->selectMaestroPadreById($dataContacto[$y]['id_coord_maestro']);
                        if($dataContacto[$y]['id_coordext_maestro'] != 0){
                            $dataMaestro2= $maestro->selectMaestroPadreById($dataContacto[$y]['id_coordext_maestro']);
                        }
                    }
                    $html.= "<option value='".$dataContacto[$y]['id_contacto']."' ".$seleccionar.">".$dataContacto[$y]['strnombre'];
                    $html.= " ".$dataContacto[$y]['strapellido']."(".$dataMaestro[0]['stritemb'];
                    if($dataMaestro2){
                        $html.= " - ".$dataMaestro2[0]['stritemb'].")</option>";
                    }else{
                        $html.= ")</option>";
                    }
                }
            }
        }
        $html.= "</select>";
        $respuesta->assign("capaAnalista", "innerHTML", $html);
        return $respuesta;
    }

    function insertActividad($formulario) {
        $respuesta= new xajaxResponse();
        $actividad= new clActividadesModelo();
        $destinatario= new clDestinatariosModelo();
        $ruta= new clRutaCorrespondenciaModelo();
        $correspondencia= new clCorrespondenciaModelo();

        $dataDestinatario= $destinatario->selectAllDestinatariosById($formulario['id_destinatarios']);
        $dataCorrespondencia= $correspondencia->selectAllCorrespondenciaById($dataDestinatario[0]['id_corresp']);

        $actividad->llenar($formulario);
        $dataActividad= $actividad->insertActividad();
        
        $descripcion= "<b>".$formulario['memtitulo']."(Id: ".$dataActividad[0]['id_actividad'].")</b> del documento: ";
        $descripcion.= "<b>".$dataCorrespondencia[0]['strcorrelativo']." ";
        $descripcion.= "(".$dataCorrespondencia[0]['id_corresp'].")</b>";

        $ruta->insertRutaCorrespondencia($dataDestinatario[0]['id_corresp'], 256, $descripcion, $_SESSION['id_contacto']);
        
        $respuesta->script("alert('¡La actividad se ha guardado exitosamente!')");
        $respuesta->script("xajax_selectActividadByIdDestinatario(".$formulario['id_destinatarios'].")");
        $respuesta->script("xajax_llenarSelectActividad(".$formulario['id_destinatarios'].", '100%', 'capaActividad', 'onchange=\"xajax_selectDepartamentosActividadByIdActividad(this.value)\"')");
        $respuesta->script("xajax_llenarSelectActividad(".$id_destinatarios.", '100%', 'capaActividadAnalista', 'onchange=\"cargarAnalista(this.value)\"')");
        $respuesta->script("limpiar()");
        $respuesta->script("$('country2').style.display='none';");
        $respuesta->script("$('country3').style.display='block';");
        $respuesta->script("$('link2').className='';");
        $respuesta->script("$('link3').className='selected';");
        return $respuesta;
    }

    function deleteActividad($id_actividad) {
        $respuesta= new xajaxResponse();
        $actividad= new clActividadesModelo();
        $actividad->deleteActividad($id_actividad);
        $respuesta->script("ocultar('div_e".$id_actividad."', '¡La actividad se ha eliminado exitosamente!')");
        return $respuesta;
    }

    function insertDepartamentoActividad($formulario) {
        $respuesta= new xajaxResponse();
        $actividad= new clActividadesModelo();
        $destinatario= new clDestinatariosModelo();
        $ruta= new clRutaCorrespondenciaModelo();
        $correspondencia= new clCorrespondenciaModelo();
        $departamentoActividad= new clDepartamentoActividadModelo();
        $maestro= new clMaestroModelo();

        $departamentoActividad->setId_actividad($formulario['id_actividad']);
        $departamentoActividad->setId_contacto($_SESSION['id_contacto']);

        $dataActividad= $actividad->selectActividadById($formulario['id_actividad']);
        $dataDestinatario= $destinatario->selectAllDestinatariosById($dataActividad[0]['id_destinatarios']);
        $dataCorrespondencia= $correspondencia->selectAllCorrespondenciaById($dataDestinatario[0]['id_corresp']);

        $descripcion= "<b>".$dataActividad[0]['memtitulo']."(Id: ".$dataActividad[0]['id_actividad'].")</b> del documento: ";
        $descripcion.= "<b>".$dataCorrespondencia[0]['strcorrelativo']." ";
        $descripcion.= "(".$dataCorrespondencia[0]['id_corresp'].")</b>"; 

        if($formulario['idCoordinaciones']){
            $descripcion.= " a la Coordinaci&oacute;n: <br>";
            $actividad->setId_actividad($formulario['id_actividad']);
            $actividad->setId_estatus_maestro(248);
            $actividad->updateActividadEstatus();
            for ($i= 0; $i < count($formulario['idCoordinaciones']); $i++){
                $departamentoActividad->setId_departamento_maestro($formulario['idCoordinaciones'][$i]);
                $dataDepartamento= $departamentoActividad->selectDepartamentoActividadByIdActividadIdDepartamento();
                if($dataDepartamento[0]['count'] == 0){
                    $departamentoActividad->insertDepartamentoActividad();
                }
                $dataMaestro= $maestro->selectMaestroPadreById($formulario['idCoordinaciones'][$i]);
                $descripcion.= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$dataMaestro[0]['stritema']." (".$dataMaestro[0]['id_maestro'].")<br>";
            }
        }else{
            $descripcion.= " a la Gerencia: <br>";
            for ($i= 0; $i < count($formulario['idGerencias']); $i++){
                $departamentoActividad->setId_departamento_maestro($formulario['idGerencias'][$i]);
                $dataDepartamento= $departamentoActividad->selectDepartamentoActividadByIdActividadIdDepartamento();
                if($dataDepartamento[0]['count'] == 0){
                    $departamentoActividad->insertDepartamentoActividad();
                }
                $dataMaestro= $maestro->selectMaestroPadreById($formulario['idGerencias'][$i]);
                $descripcion.= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$dataMaestro[0]['stritema']." (".$dataMaestro[0]['id_maestro'].")<br>";
            }
        }
        $ruta->insertRutaCorrespondencia($dataDestinatario[0]['id_corresp'], 257, $descripcion, $_SESSION['id_contacto']);
        $respuesta->script("alert('¡La actividad se asigno a un departamento exitosamente!')");
        $respuesta->script("xajax_selectDepartamentosActividadByIdActividad(".$formulario['id_actividad'].")");
        $respuesta->script("xajax_selectActividadByIdDestinatario(".$dataActividad[0]['id_destinatarios'].")");
        return $respuesta;
    }

    function selectContactosActividadByIdActividad($id_actividad) {
        $respuesta= new xajaxResponse();
        $ContactoActividad= new clContactoActividadModelo();
        $data= "";
        $html= "";
        $data= $ContactoActividad->selectContactosActividadByIdActividad($id_actividad);
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='90%' align='left'>
                                    <a href='#' onclick=\"\">Nombre Analista</a>
                                </th>
                                <th width='10%'>Acci&oacute;n</th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='90%'>".$data[$i]['nombre_contacto']."</td>
                            <td width='10%' align='center'>
                                <a>
                                    <img src='../comunes/images/cross.png' onmouseover=\"Tip('Quitar')\" onmouseout='UnTip()' onclick=\"xajax_deleteContactoActividad(".$data[$i]['id_contactoactividad'].", ".$data[$i]['id_actividad'].")\">
                                </a>
                            </td>
                        </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Analistas Asignados</div>";
        }
        $respuesta->assign("capaAnalistasAsignados","innerHTML",$html);
        return $respuesta;
    }

    function selectDepartamentosActividadByIdActividad($id_actividad) {
        $respuesta= new xajaxResponse();
        $departamentoActividad= new clDepartamentoActividadModelo();
        $data= "";
        $html= "";
        $data= $departamentoActividad->selectDepartamentoActividadByIdActividad($id_actividad);
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='90%' align='left'>
                                    <a href='#' onclick=\"\">Dependencia</a>
                                </th>
                                <th width='10%'>Acci&oacute;n</th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='90%'>".$data[$i]['nombre_departamento_maestro']."</td>
                            <td width='10%' align='center'>
                                <a>
                                    <img src='../comunes/images/cross.png' onmouseover=\"Tip('Quitar')\" onmouseout='UnTip()' onclick=\"xajax_deleteDepartamentoActividad(".$data[$i]['id_departamentoactividad'].", ".$id_actividad.")\">
                                </a>
                            </td>
                        </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Dependencias Asignadas</div>";
        }
        $respuesta->assign("capaDependenciaAsignadas","innerHTML",$html);
        return $respuesta;
    }

    function insertContactoActividad($formulario) {
        $respuesta= new xajaxResponse();
        $actividad= new clActividadesModelo();
        $contactoActividad= new clContactoActividadModelo();
        $ruta= new clRutaCorrespondenciaModelo();
        $maestro= new clMaestroModelo();
        $contacto= new clContactoModelo();
        $destinatario= new clDestinatariosModelo();

        $dataActividad= $actividad->selectActividadById($formulario['id_actividad']);
        $dataDestinatario= $destinatario->selectAllDestinatariosById($dataActividad[0]['id_destinatarios']);
        $dataContacto= $contacto->selectContactoById($formulario['id_contacto']);
        $dataDptoMaestro= $maestro->selectMaestroPadreById($dataContacto[0]['id_dpto_maestro']);

        if($dataContacto[0]['id_coord_maestro'] != 0){
            $dataCoordMaestro= $maestro->selectMaestroPadreById($dataContacto[0]['id_coord_maestro']);
        }
        if($dataContacto[0]['id_coordext_maestro'] != 0){
            $dataCoordExtMaestro= $maestro->selectMaestroPadreById($dataContacto[0]['id_coordext_maestro']);
        }

        $descripcion= $descripcion= "<b>".$dataActividad[0]['memtitulo']."(Id: ".$dataActividad[0]['id_actividad'].")</b> a ";
        $descripcion.= $dataContacto[0]['strnombre']." ".$dataContacto[0]['strapellido'];
        $descripcion.= " (".$dataDptoMaestro[0]['stritema'];
        if($dataCoordMaestro){
            $descripcion.= "/".$dataCoordMaestro[0]['stritema'];
            if($dataCoordExtMaestro){
                $descripcion.= "/".$dataCoordExtMaestro[0]['stritema'].")";
            }else{
                $descripcion.= ")";
            }
        }else{
            $descripcion.= ")";
        }
        
        $contactoActividad->llenar($formulario);
        $contactoActividad->insertContactoActividad();
        $actividad->setId_actividad($formulario['id_actividad']);
        $actividad->setId_estatus_maestro(249);
        $actividad->updateActividadEstatus();
        $destinatario->updateEstatusDestinatariosByIdDestinatarios($dataActividad[0]['id_destinatarios'], 204);
        $ruta->insertRutaCorrespondencia($dataDestinatario[0]['id_corresp'], 257, $descripcion, $_SESSION['id_contacto']);
        $respuesta->script("alert('¡La actividad se asigno a un analista exitosamente!')");
        $respuesta->script("xajax_selectContactosActividadByIdActividad(".$formulario['id_actividad'].")");
        $respuesta->script("xajax_selectActividadByIdDestinatario(".$dataActividad[0]['id_destinatarios'].")");
        return $respuesta;
    }

    function deleteContactoActividad($id_contactoactividad, $id_actividad) {
        $respuesta= new xajaxResponse();
        $contactoActividad= new clContactoActividadModelo();
        $actividad= new clActividadesModelo();
        $destinatario= new clDestinatariosModelo();
        $ruta= new clRutaCorrespondenciaModelo();
        $maestro= new clMaestroModelo();
        $contacto= new clContactoModelo();        

        $dataActividad= $actividad->selectActividadById($id_actividad);
        $dataDestinatario= $destinatario->selectAllDestinatariosById($dataActividad[0]['id_destinatarios']);
        $dataContactoActividad= $contactoActividad->selectContactosActividadById($id_contactoactividad);
        $dataContacto= $contacto->selectContactoById($dataContactoActividad[0]['id_contacto']);
        $dataDptoMaestro= $maestro->selectMaestroPadreById($dataContacto[0]['id_dpto_maestro']);

        if($dataContacto[0]['id_coord_maestro'] != 0){
            $dataCoordMaestro= $maestro->selectMaestroPadreById($dataContacto[0]['id_coord_maestro']);
        }
        if($dataContacto[0]['id_coordext_maestro'] != 0){
            $dataCoordExtMaestro= $maestro->selectMaestroPadreById($dataContacto[0]['id_coordext_maestro']);
        }

        $descripcion= $descripcion= "<b>".$dataActividad[0]['memtitulo']."(Id: ".$dataActividad[0]['id_actividad'].")</b> a ";
        $descripcion.= $dataContacto[0]['strnombre']." ".$dataContacto[0]['strapellido'];
        $descripcion.= " (".$dataDptoMaestro[0]['stritema'];
        if($dataCoordMaestro){
            $descripcion.= "/".$dataCoordMaestro[0]['stritema'];
            if($dataCoordExtMaestro){
                $descripcion.= "/".$dataCoordExtMaestro[0]['stritema'].")";
            }else{
                $descripcion.= ")";
            }
        }else{
            $descripcion.= ")";
        }

        $contactoActividad->deleteContactoActividad($id_contactoactividad);
        $ruta->insertRutaCorrespondencia($dataDestinatario[0]['id_corresp'], 261, $descripcion, $_SESSION['id_contacto']);

        $respuesta->script("xajax_selectContactosActividadByIdActividad(".$id_actividad.")");
        return $respuesta;
    }

    function deleteDepartamentoActividad($id_departamentoactividad, $id_actividad) {
        $respuesta= new xajaxResponse();
        $departamentoActividad= new clDepartamentoActividadModelo();
        $contactoActividad= new clContactoActividadModelo();
        $actividad= new clActividadesModelo();
        $destinatario= new clDestinatariosModelo();
        $ruta= new clRutaCorrespondenciaModelo();
        $maestro= new clMaestroModelo();
        $contacto= new clContactoModelo();

        $dataDepartamentoActividad= $departamentoActividad->selectDepartamentoActividadById($id_departamentoactividad);
        $dataActividad= $actividad->selectActividadById($id_actividad);
        $dataDestinatario= $destinatario->selectAllDestinatariosById($dataActividad[0]['id_destinatarios']);
        $dataDptoMaestro= $maestro->selectMaestroPadreById($dataDepartamentoActividad[0]['id_departamento_maestro']);

        if($dataDptoMaestro[0]['id_origen'] != clConstantesModelo::departamentos){
            $dataContactoActividad= $contactoActividad->cantidadAsignadosByIdActividadIdDepartamento($id_actividad, $dataDepartamentoActividad[0]['id_departamento_maestro'], 1);
        }else{
            $dataContactoActividad= $contactoActividad->cantidadAsignadosByIdActividadIdDepartamento($id_actividad, $dataDepartamentoActividad[0]['id_departamento_maestro'], 2);
        }

        if($dataContactoActividad[0]['count'] > 0){
            $respuesta->script("alert('No se puede quitar la dependencia porque ya existen contactos asignados')");
        }else{
            $departamentoActividad->setId_departamentoactividad($id_departamentoactividad);
            $departamentoActividad->deleteDepartamentoActividad();

            $descripcion= $descripcion= "<b>".$dataActividad[0]['memtitulo']."(Id: ".$dataActividad[0]['id_actividad'].")</b> a la dependencia: <br>";
            $descripcion.= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$dataDptoMaestro[0]['stritema']." (".$dataDptoMaestro[0]['id_maestro'].")<br>";

            $ruta->insertRutaCorrespondencia($dataDestinatario[0]['id_corresp'], 261, $descripcion, $_SESSION['id_contacto']);

            $respuesta->script("xajax_selectDepartamentosActividadByIdActividad(".$id_actividad.")");

        }
        return $respuesta;
    }

    function verDetallesActividad($id_actividad) {
        $respuesta= new xajaxResponse();
        $actividad= new clActividadesModelo();
        $departamentoActividad= new clDepartamentoActividadModelo();
        $contactoActividad= new clContactoActividadModelo();
        $destinatario= new clDestinatariosModelo();
        $correspondencia= new clCorrespondenciaModelo();
        $adjuntos= new clAdjuntarActividadModelo();
        $ruta= new clRutaCorrespondenciaModelo();
        $detalleContactoActividad= new clDetalleContactoActividadModelo();

        $dataActividad= $actividad->selectActividadById($id_actividad);
        $dataDepartamento= $departamentoActividad->selectDepartamentoActividadByIdActividad($id_actividad);
        $dataContacto= $contactoActividad->selectContactosActividadByIdActividad($id_actividad);
        $dataDestinatario= $destinatario->selectAllDestinatariosById($dataActividad[0]['id_destinatarios']);
        $dataCorrespondencia= $correspondencia->selectAllCorrespondenciaById($dataDestinatario[0]['id_corresp']);
        $dataAdjuntos= $adjuntos->selectAdjuntoByIdActividad($id_actividad);

        $htmlAdjuntos= "";
        if($dataAdjuntos){
            $htmlAdjuntos= "<table border=\'0\' class=\'tablaTitulo\' width=\'100%\'>";
            for($j= 0; $j < count($dataAdjuntos); $j++){
                $htmlAdjuntos.= "<tr><td><a href=\'bajarAdjuntoVista.php?f=../comunes/uploads/".$dataAdjuntos[$j]["id_archivo"]."_".$dataAdjuntos[$j]["stradjunto"]."\'>".$dataAdjuntos[$j]["stradjunto"]."</a></td></tr>";
            }
            $htmlAdjuntos.= "</table>";
        }

        $html= "<div id='div_c".$id_actividad."'><table class='tablaVer' border='0' width='100%'>";
        if($dataActividad){
            $html.= "<tr>
                        <td width='5%'>&nbsp;</td>
                        <th width='30%'>Correspondencia:</th>
                        <td width='60%' onclick=\"javascript:window.open('imprimirVista.php?id=".$dataCorrespondencia[0]['id_corresp']."&tipo=".$dataCorrespondencia[0]['id_tipocorresp_maestro']."','_blank','')\"><u style='cursor:pointer'>".$dataCorrespondencia[0]['strcorrelativo']."</u></td>
                        <td width='5%'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <th width='30%'>Titulo:</th>
                        <td width='60%'>".$dataActividad[0]['memtitulo']."</td>
                        <td width='5%'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <th width='30%'>Prioridad:</th>
                        <td width='60%'>".$dataActividad[0]['nombre_prioridad_maestro']."</td>
                        <td width='5%'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <th width='30%'>Estatus:</th>
                        <td width='60%'>".$dataActividad[0]['nombre_estatus_maestro']."</td>
                        <td width='5%'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <th width='30%'>Descripci&oacute;n:</th>
                        <td width='60%'>".$dataActividad[0]['strdescripcion']."</td>
                        <td width='5%'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <th width='30%'>Resultado:</th>
                        <td width='60%'>";
            if($dataContacto){
                $html.= "<table class='tablaVer' border='0' width='100%'>";
                $html.= "<tr><td onclick=\"javascript:window.open('reporteResultadoVista.php?id=".$id_actividad."','_blank','')\"><u style='cursor:pointer'>Ver Resultados</u></td></tr>";
                $html.= "</table>";
            }else{
                $html.= "No hay Analistas Asignados";
            }
            $html.= "</td>
                        <td width='5%'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <th width='30%'>Observaciones:</th>
                        <td width='60%'>";
            if($dataContacto){
                $html.= "<table class='tablaVer' border='0' width='100%'>";
                $html.= "<tr><td onclick=\"javascript:window.open('reporteObservacionVista.php?id=".$id_actividad."','_blank','')\"><u style='cursor:pointer'>Ver Observaciones</u></td></tr>";
                $html.= "</table>";
            }else{
                $html.= "No hay Analistas Asignados";
            }
            $html.= "</td>
                        <td width='5%'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <th width='30%'>Asignada Por:</th>
                        <td width='60%'>".$dataActividad[0]['nombre_contacto']."</td>
                        <td width='5%'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <th width='30%'>Coordinaci&oacute;n:</th>
                        <td width='60%'>";
            if($dataDepartamento){
                $html.= "<table class='tablaVer' border='0' width='100%'>";
                for($i= 0; $i < count($dataDepartamento); $i++){
                    $html.= "<tr><td>".$dataDepartamento[$i]['nombre_departamento_maestro']."</td></tr>";
                }
                $html.= "</table>";
            }else{
                $html.= "No hay Departamento Asignado";
            }
            $html.= "</td>
                        <td width='5%'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <th width='30%'>Analistas Asignados:</th>
                        <td width='60%'>";
            if($dataContacto){
                $html.= "<table class='tablaVer' border='0' width='100%'>";
                for($y= 0; $y < count($dataContacto); $y++){
                    $html.= "<tr><td>".$dataContacto[$y]['nombre_contacto']."</td></tr>";
                }
                $html.= "</table>";
            }else{
                $html.= "No hay Analistas Asignados";
            }
            $html.= "</td>
                        <td width='5%'>&nbsp;</td>
                    </tr>";
            if($htmlAdjuntos != ""){
                $html.= "<tr>
                            <td width='5%'>&nbsp;</td>
                            <th width='30%'>Archivos Adjuntos de la Actividad:</th>
                            <td width='60%'>
                                <a>
                                    <img src='../comunes/images/script_attach.png' onmouseover=\"Tip('Ver Adjuntos')\" onmouseout='UnTip()' onclick=\"javascript:Tip('".$htmlAdjuntos."', TITLE, 'Ajuntos Actividades', CLOSEBTN, true, STICKY, true)\">
                                </a>
                            </td>
                            <td width='5%'>&nbsp;</td>
                        </tr>";
            }
        }
        $html.= "</table></div>";
        $descripcion= "<b>".$dataActividad[0]['memtitulo']."(Id: ".$dataActividad[0]['id_actividad'].")</b>";
        $ruta->insertRutaCorrespondencia($dataDestinatario[0]['id_corresp'], 258, $descripcion, $_SESSION['id_contacto']);
        $respuesta->assign("div_".$id_actividad,"style.border","#339933 2px solid");
        $respuesta->assign("div_".$id_actividad,"innerHTML",$html);
        return $respuesta;
    }

    function selectActividadByDepartamento() {
        $respuesta= new xajaxResponse();
        $actividad= new clActividadesModelo();
        $contactoActividad= new clContactoActividadModelo();
        $data= "";
        $html= "";
        if($_SESSION['id_coord_maestro'] == 0){
            $data= $actividad->selectActividadAsignada($_SESSION['id_dpto_maestro'], $_SESSION['id_profile']);
        }else{
            $data= $actividad->selectActividadAsignada($_SESSION['id_coord_maestro'], $_SESSION['id_profile']);
        }
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='10%'>
                                    <a href='#' onclick=\"\">Id</a>
                                </th>
                                <th width='45%'>
                                    <a href='#' onclick=\"\">Actividad</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"\">Estatus</a>
                                </th>
                                <th width='15%'>
                                    <a href='#' onclick=\"\">Fecha</a>
                                </th>
                                <th width='10%'>Acci&oacute;n</th>
                            </tr></table>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<div id='div_e".$data[$i]['id_actividad']."'><table border='0' class='tablaTitulo' width='100%'>
                         <tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='10%' align='center'>".$data[$i]['id_actividad']."</td>
                            <td width='45%'>".$data[$i]['memtitulo']."</td>
                            <td width='20%'>".$data[$i]['nombre_estatus_maestro']."</td>
                            <td width='15%' align='center'>".$data[$i]['fecha_resolucion']."</td>
                            <td width='10%'>
                                <a>
                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Ver Detalles')\" onmouseout='UnTip()' onclick=\"verDetalles('".$data[$i]['id_actividad']."')\">
                                </a>";
                if($data[$i]['id_estatus_maestro'] == 250 || $data[$i]['id_estatus_maestro'] == 251){
                    $html.= "       <a>
                                        <img src='../comunes/images/script_close.png' onmouseover=\"Tip('Cerrar')\" onmouseout='UnTip()' onclick=\"cerrarActividad('".$data[$i]['id_actividad']."')\">
                                    </a>";
                }
                if($data[$i]['id_estatus_maestro'] == 250 || $data[$i]['id_estatus_maestro'] == 251){
                    $formulario= "onmouseover=\"Tip('";
                    $formulario.= "<form name=frmnota id=frmnota method=post>";
                    if($data[$i]['id_estatus_maestro'] == 250){
                        $estatus= 252;
                    }else if($data[$i]['id_estatus_maestro'] == 251){
                        $estatus= 253;
                    }
                    $formulario.= "<input type=hidden name=id_tiponota_maestro id=id_tiponota_maestro value=240>";
                    $formulario.= "<input type=hidden name=id_actividad id=id_actividad value=".$data[$i]['id_actividad'].">";
                    $formulario.= "<input type=hidden name=id_estatus_maestro id=id_estatus_maestro value=".$estatus.">";
                    $formulario.= "<table><tr><td align=center><textarea name=memobsernota id=memobsernota cols=20 rows=2>";
                    $formulario.= "</textarea></tr></td><td align=center><input type=button value=devolver onclick=devolver();>";
                    $formulario.= "</td></tr></table></form>";
                    $formulario.= "', TITLE, 'Crear Nota', CLOSEBTN, true, STICKY, true)\" onmouseout='UnTip()'";
                    $html.= "       <a>
                                        <img src='../comunes/images/script_go2.png' ".$formulario." >
                                    </a>";
                }
                $html.= "  </td>
                        </tr></table><div id='div_".$data[$i]['id_actividad']."' style='display:none;background:#dfdfdf'></div></div>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Actividades Asignadas</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        return $respuesta;
    }

    function insertNota($formulario) {
        $respuesta= new xajaxResponse();
        $nota= new clNotaModelo();
        $actividad= new clActividadesModelo();
        $contactoActividad= new clContactoActividadModelo();

        $contactoActividad->updateContactoActividadEstatus(253, $formulario['id_actividad']);
        
        $nota->llenar($formulario);
        $nota->setId_corresp("null");
        $nota->setId_contacto($_SESSION['id_contacto']);
        $nota->insertNota();

        $actividad->setId_actividad($formulario['id_actividad']);
        $actividad->setId_estatus_maestro($formulario['id_estatus_maestro']);
        $actividad->updateActividadEstatus();
        $respuesta->script("xajax_selectActividadByDepartamento()");
        return $respuesta;

    }

    function updateActividadEstatus($id_actividad) {
        $respuesta= new xajaxResponse();
        $actividad= new clActividadesModelo();
        $destinatario= new clDestinatariosModelo();
        $ruta= new clRutaCorrespondenciaModelo();

        $dataActividad= $actividad->selectActividadById($id_actividad);
        $dataDestinatario= $destinatario->selectAllDestinatariosById($dataActividad[0]['id_destinatarios']);
        $destinatario->updateEstatusDestinatariosByIdDestinatarios($dataActividad[0]['id_destinatarios'], 205);
        
        $descripcion= "<b>".$dataActividad[0]['memtitulo']."(Id: ".$dataActividad[0]['id_actividad'].")</b>";
        $ruta->insertRutaCorrespondencia($dataDestinatario[0]['id_corresp'], 262, $descripcion, $_SESSION['id_contacto']);

        $actividad->setId_actividad($id_actividad);
        $actividad->setId_estatus_maestro(254);
        $actividad->updateActividadCerrar();
        $respuesta->script("xajax_selectActividadByDepartamento()");
        return $respuesta;
    }

    function selectActividadByContacto() {
        $respuesta= new xajaxResponse();
        $actividad= new clActividadesModelo();
        $contactoActividad= new clContactoActividadModelo();
        $data= "";
        $html= "";
        $data= $contactoActividad->selectContactosActividadByIdContacto($_SESSION['id_contacto']);
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='50%'>
                                    <a href='#' onclick=\"\">Actividad</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"\">Estatus</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"\">Fecha Resoluci&oacute;n</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"\">Acci&oacute;n</a>
                                </th>
                            </tr>
                        </table>";
            for ($i= 0; $i < count($data); $i++){
                $dataActividad= $actividad->selectActividadById($data[$i]['id_actividad']);
                $html.= "<div id='div_e".$data[$i]['id_contactoactividad']."'><table border='0' class='tablaTitulo' width='100%'>
                         <tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='50%'>".$data[$i]['titulo_actividad']."</td>
                            <td width='20%'>".$data[$i]['nombre_estatus_maestro']."</td>
                            <td width='20%' align='center'>".$dataActividad[0]['fecha_resolucion']."</td>
                            <td width='10%'>
                                <a>
                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Ver Progreso')\" onmouseout='UnTip()' onclick=\"verHistorial(".$data[$i]['id_contactoactividad'].")\">
                                </a>
                                <a>
                                    <img src='../comunes/images/script_edit.png' onmouseover=\"Tip('')\" onmouseout='UnTip()' onclick=\"verFormulario(".$data[$i]['id_actividad'].", ".$data[$i]['id_contactoactividad'].")\")\">
                                </a>
                            </td>
                        </tr></table><div id='div_r".$data[$i]['id_contactoactividad']."' style='display:none;background:#dfdfdf'></div></div>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Actividades Asignadas</div>";
        }
        $respuesta->assign("capaActividades","innerHTML",$html);
        return $respuesta;
    }

    function llenarSelectActividadByDepartamento() {
        $respuesta= new xajaxResponse();
        $actividad= new clActividadesModelo();
        $data= "";
        $html= "";
        if($_SESSION['id_coord_maestro'] == 0){
            $data= $actividad->selectActividadAsignada($_SESSION['id_dpto_maestro'], $_SESSION['id_profile'], 254);
        }else{
            $data= $actividad->selectActividadAsignada($_SESSION['id_coord_maestro'], $_SESSION['id_profile'], 254);
        }
        $html= "<select id='id_actividad' name='id_actividad' style='width:100%' onchange='xajax_selectCorrespondencia(this.value);xajax_selectContactosActividadByIdActividad(this.value)'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_actividad']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_actividad']."' ".$seleccionar.">".$data[$i]['memtitulo']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaActividadAnalista","innerHTML",$html);
        return $respuesta;
    }

    function selectCorrespondencia($id_actividad){
        $respuesta= new xajaxResponse();
        $actividad= new clActividadesModelo();
        $destinatario= new clDestinatariosModelo();
        $correspondencia= new clCorrespondenciaModelo();

        if($id_actividad != 0){
            $dataActividad= $actividad->selectActividadById($id_actividad);
            $dataDestinatario= $destinatario->selectAllDestinatariosById($dataActividad[0]['id_destinatarios']);
            $dataCorrespondencia= $correspondencia->selectAllCorrespondenciaById($dataDestinatario[0]['id_corresp']);

            $html= "<div onclick=\"javascript:window.open('imprimirVista.php?id=".$dataCorrespondencia[0]['id_corresp']."&tipo=".$dataCorrespondencia[0]['id_tipocorresp_maestro']."','_blank','')\"><u style='cursor:pointer'>".$dataCorrespondencia[0]['strcorrelativo']."</u></div>";
        }else{
            $html= "No Hay Actividad Seleccionada";
        }
        $respuesta->assign("capaCorrespondencia","innerHTML",$html);

        return $respuesta;
    }

    function llenarSelectAnalistaByDepartamento() {
        $respuesta= new xajaxResponse();
        $contacto= new clContactoModelo();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $html= "<select id='id_contacto' name='id_contacto' style='width:100%'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($_SESSION['id_coord_maestro'] == 0){
            $data= $contacto->selectContactoByIdDepartamento($_SESSION['id_dpto_maestro']);
        }else{
            $data= $contacto->selectContactoByIdDepartamento($_SESSION['id_coord_maestro']);
        }
        if($data){
            for($y= 0; $y < count($data); $y++){
                if($data[$y]['id_coord_maestro'] == 0){
                    $dataMaestro= $maestro->selectMaestroPadreById($data[$y]['id_dpto_maestro']);
                }else{
                    $dataMaestro= $maestro->selectMaestroPadreById($data[$y]['id_coord_maestro']);
                    if($data[$y]['id_coordext_maestro'] != 0){
                        $dataMaestro2= $maestro->selectMaestroPadreById($data[$y]['id_coordext_maestro']);
                    }
                }
                $html.= "<option value='".$data[$y]['id_contacto']."' ".$seleccionar.">".$data[$y]['strnombre'];
                $html.= " ".$data[$y]['strapellido']."(".$dataMaestro[0]['stritemb'];
                if($dataMaestro2){
                    $html.= " - ".$dataMaestro2[0]['stritemb'].")</option>";
                }else{
                    $html.= ")</option>";
                }
            }
        }
        $html.= "</select>";
        $respuesta->assign("capaAnalista", "innerHTML", $html);
        return $respuesta;
    }

    function formActividad($id_actividad, $id_contactoactividad) {
        $respuesta= new xajaxResponse();
        $actividad= new clActividadesModelo();
        $destinatario= new clDestinatariosModelo();
        $correspondencia= new clCorrespondenciaModelo();
        $adjuntosActividad= new adjuntarActividadControlador();
        $nota= new clNotaModelo();

        $dataActividad= $actividad->selectActividadById($id_actividad);
        $dataDestinatario= $destinatario->selectAllDestinatariosById($dataActividad[0]['id_destinatarios']);
        $dataCorrespondencia= $correspondencia->selectAllCorrespondenciaById($dataDestinatario[0]['id_corresp']);
        $dataAdjunto= $adjuntosActividad->selectAdjuntoByIdActividad($id_actividad);

        $html= "";
        $html= "<div id='div_f".$id_contactoactividad."'>";
        $html.= "<form id='frmadjuntoactividad' name='frmadjuntoactividad' method='post'>";
        $html.= "<table class='tablaVer' border='0' width='100%'>";
        $html.= "<input type='hidden' id='id_actividad' name='id_actividad' value='".$id_actividad."'>";
        $html.= "<input type='hidden' id='id_contactoactividad' name='id_contactoactividad' value='".$id_contactoactividad."'>";
        $html.= "<input type='hidden' id='titulo' name='titulo' value='".$dataActividad[0]['memtitulo']."'>";
        $html.= "<input type='hidden' id='idCorresp' name='idCorresp' value='".$dataDestinatario[0]['id_corresp']."'>";
        $html.= "<input type='hidden' id='adjunto' name='adjunto' value='";
        if (isset($dataAdjunto)) {
            $html.= $dataAdjunto;
        }
        $html.= "'>";
        $html.= "<tr>
                    <td width='5%'>&nbsp;</td>
                    <td width='30%'>&nbsp;</td>
                    <td width='60%' align='right'>
                        <img src='../comunes/images/16_save.gif' onmouseover=\"Tip('Guardar')\" onmouseout='UnTip()' border='0' onclick=\"guardarActividad(1)\"/>
                        <img src='../comunes/images/16_save_close.png' onmouseover=\"Tip('Guardar y Cerrar Actividad')\" onmouseout='UnTip()' border='0' onclick=\"guardarActividad(2)\"/>
                    </td>
                    <td width='5%'></td>
                </tr>";
        if($dataActividad[0]['id_estatus_maestro'] == 253){
            $dataNota= $nota->selectAllNotaByIdAC($id_actividad, 240);
            $html.= "<tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='90%' colspan='2'>
                            <div class='mensajes'>
                                <div class='mensajes_margen'>
                                    <span class='mensajes_titulo'>Notas:<br>";
            if($dataNota){
                for($i= 0; $i < count($dataNota); $i++){
                    $html.= "<ul><li>".$dataNota[$i]['fecha_nota']." | ".$dataNota[$i]['memobsernota']."</li></ul>";
                }
            }
            $html.= "               </span>
                                </div>
                            </div>
                        </td>
                        <td width='5%'>&nbsp;</td>
                    </tr>";
        }
        $html.="<tr>
                    <td width='5%'>&nbsp;</td>
                    <th width='30%'>Descripci&oacute;n de la Actividad:</th>
                    <td width='60%'>".$dataActividad[0]['strdescripcion']."</td>
                    <td width='5%'>&nbsp;</td>
                </tr>
                <tr>
                    <td width='5%'>&nbsp;</td>
                    <th width='30%'>Correspondencia:</th>
                    <td width='60%' onclick=\"javascript:window.open('imprimirVista.php?id=".$dataCorrespondencia[0]['id_corresp']."&tipo=".$dataCorrespondencia[0]['id_tipocorresp_maestro']."','_blank','')\"><u style='cursor:pointer'>".$dataCorrespondencia[0]['strcorrelativo']."</u></td>
                    <td width='5%'>&nbsp;</td>
                </tr>
                <tr>
                    <td width='5%'>&nbsp;</td>
                    <th width='90%' colspan='2'>Resultados:</th>
                    <td width='5%'>&nbsp;</td>
                </tr>
                <tr>
                    <td width='5%'>&nbsp;</td>
                    <td width='90%' colspan='2'>
                        <textarea id='menresultado' name='menresultado' rows='3' style='width:100%'></textarea>
                    </td>
                    <td width='5%'>&nbsp;</td>
                </tr>
                <tr>
                    <td width='5%'>&nbsp;</td>
                    <th width='90%' colspan='2'>Observaciones:</th>
                    <td width='5%'>&nbsp;</td>
                </tr>
                <tr>
                    <td width='5%'>&nbsp;</td>
                    <td width='90%' colspan='2'>
                        <textarea id='menobservaciones' name='menobservaciones' rows='3' style='width:100%'></textarea>
                    </td>
                    <td width='5%'>&nbsp;</td>
                </tr>
                <tr>
                    <td width='5%'>&nbsp;</td>
                    <th width='90%' colspan='2'>Archivos Adjuntos:</th>
                    <td width='5%'>&nbsp;</td>
                </tr>
                <tr>
                    <td width='5%'>&nbsp;</td>
                    <td width='90%' colspan='2'>
                        <iframe src='adjuntarActividadVista.php?id_actividad=".$id_actividad;
        if (isset($dataAdjunto)) {
            $html.= "&adjunto=".$dataAdjunto;
        }
        $html.= "' name='iframe' id='iframe' width='100%' height='150px' scrolling='auto' style='border:none;background-color:#F8F8F8'></iframe>
                    <td width='5%'>&nbsp;</td>
                </tr>
                </table></form></div>";
        $respuesta->assign("div_r".$id_contactoactividad,"style.border","#339933 2px solid");
        $respuesta->assign("div_r".$id_contactoactividad, "innerHTML", $html);
        return $respuesta;
    }

    function insertDetalleContactoActividad($formulario, $modo= 1) {
        $respuesta= new xajaxResponse();
        $actividad= new clActividadesModelo();
        $contactoActividad= new clContactoActividadModelo();
        $ruta= new clRutaCorrespondenciaModelo();
        $destinatario= new clDestinatariosModelo();
        $detalleContactoActividad= new clDetalleContactoActividadModelo();

        $dataDetalleContactoActividad= $detalleContactoActividad->cantidadDetalleContactoActividadByIdContactoActividad($formulario['id_contactoactividad']);
        if($dataDetalleContactoActividad[0]['count'] == 0){
            $contactoActividad->updateContactoActividadFecha(1, $formulario['id_contactoactividad']);
        }
        $detalleContactoActividad->llenar($formulario);
        $detalleContactoActividad->insertDetalleContactoActividad();
        
        $descripcion= "<b>".$formulario['titulo']."(Id: ".$formulario['id_actividad'].")</b>";

        if($modo == 1){
            $respuesta->script("verFormulario(".$formulario['id_actividad'].", ".$formulario['id_contactoactividad'].")");
            $respuesta->script("alert('¡La actividad se ha guardado exitosamente!')");
            $estatus= 265;
            $ruta->insertRutaCorrespondencia($formulario['idCorresp'], 259, $descripcion, $_SESSION['id_contacto']);
        }else if($modo == 2){
            $contactoActividad->updateContactoActividadFecha(2, $formulario['id_contactoactividad']);
            $estatus= 251;
            $respuesta->script("alert('¡La actividad se ha guardado y cerrado exitosamente!')");
            $ruta->insertRutaCorrespondencia($formulario['idCorresp'], 260, $descripcion, $_SESSION['id_contacto']);
        }
        $contactoActividad->updateContactoActividadEstatusById($estatus, $formulario['id_contactoactividad']);
                
        $dataContactoActividad= $contactoActividad->selectAsignadosFinalizados($formulario['id_actividad']);
        if (($dataContactoActividad[0]["analistas"] == $dataContactoActividad[0]["finalizados"])&& $dataContactoActividad[0]["finalizados"] != 0){
            $actividad->setId_actividad($formulario['id_actividad']);
            $actividad->setId_estatus_maestro(251);
            $actividad->updateActividadEstatus();
            
        }
        $respuesta->script("xajax_selectActividadByContacto();");
        $respuesta->script("xajax_selectActividadByDepartamento()");
        return $respuesta;
    }

    function selectDetalleContactoActividadByIdContactoActividad($id_contactoactividad) {
        $respuesta= new xajaxResponse();
        $detalleContactoActividad= new clDetalleContactoActividadModelo();
        $data= "";
        $html= "";
        $data= $detalleContactoActividad->selectDetalleContactoActividadByIdContactoActividad($id_contactoactividad);
        $html= "<div id='div_h".$id_contactoactividad."' style='border:solid 1px #CCCCCC;background:#f8f8f8'>";
        if($data){
            $html.= "  <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='20%'>
                                    <a href='#' onclick=\"\">Fecha y Hora</a>
                                </th>
                                <th width='40%'>
                                    <a href='#' onclick=\"\">Resultado</a>
                                </th>
                                <th width='40%'>
                                    <a href='#' onclick=\"\">Observaciones</a>
                                </th>
                            </tr>
                        </table>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<table border='0' class='tablaTitulo' width='100%'>
                            <tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                <td width='20%' align='center'>".$data[$i]['fecha_registro']." | ".$data[$i]['hora_registro']."</td>
                                <td width='40%'>".$data[$i]['menresultado']."</td>
                                <td width='40%'>".$data[$i]['menobservaciones']."</td>
                            </tr>
                        </table>";
            }
        }else{
            $html.= "<table border='0' class='tablaTitulo' width='100%'>
                        <tr>
                            <td><b>No Hay Detalle de esta Actividad</b></td>
                        </tr>
                    </table>";
        }
        $html.= "</div>";
        $respuesta->assign("div_r".$id_contactoactividad,"style.border","#339933 2px solid");
        $respuesta->assign("div_r".$id_contactoactividad, "innerHTML", $html);
        return $respuesta;
    }

?>
