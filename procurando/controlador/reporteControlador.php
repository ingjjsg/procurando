<?php
    session_start();
    require_once '../comunes/php/utilidades.php';
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clCorrespondenciaModelo.php';
    require_once '../modelo/clDestinatariosModelo.php';
    require_once '../modelo/clActividadesModelo.php';
    require_once '../modelo/clContactoActividadModelo.php';

    verificarSession();

    function selectCorrespondencia() {
        $maestro= new clMaestroModelo();
        $html= "";
        $dataMaestro= $maestro->selectAllMaestroHijos(82, "stritema");
        for($i= 0; $i < count($dataMaestro); $i++){
            $html.= "<option value='".$dataMaestro[$i]['id_maestro']."'>".$dataMaestro[$i]['stritema']."</option>";
        }
        return $html;
    }

    function selectDocumento($id) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();

        $dataMaestro= $maestro->selectAllMaestroHijos($id, "stritema");
        $html= "<select id='tipoD' name='tipoD'>
                    <option value='0'>Todos Los Tipos de Documento</option>";
        for($i= 0; $i < count($dataMaestro); $i++){
            $html.= "<option value='".$dataMaestro[$i]['id_maestro']."'>".$dataMaestro[$i]['stritema']."</option>";
        }
        $html.= "</select>";
        $respuesta->assign("capaDoc","innerHTML",$html);
        return $respuesta;
    }    

    function llenarAllDestinatarios($id_departamento){
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos($id_departamento, 'stritema');
        $html.= "<option value='0'>Todos las dependencias</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
        }
        return $html;
    }

    function filtrosReporte($id_tipo_reporte) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();

        $dataMaestro= $data= $maestro->selectAllMaestroHijos(193, 'stritema');
        
        $html= "<table border='1' class='tablaTitulo' width='100%'>";
        if($_SESSION['id_profile'] == 112 || $_SESSION['id_profile'] == 117 || $_SESSION['id_profile'] == 113){
            $html.= "<tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='25%'>Dependencia: </td>
                        <td width='70%' colspan='2'>
                            <select id='dependencia' name='dependencia' style='width:40%'>";
            if($_SESSION['id_profile'] == 112 || $_SESSION['id_profile'] == 117){
                $html.= llenarAllDestinatarios(clConstantesModelo::departamentos);
            }else if($_SESSION['id_profile'] == 113){
                $html.= llenarAllDestinatarios($_SESSION['id_dpto_maestro']);
            }
            $html.= "       </select>
                        </td>
                    </tr>";
        }else{
            $html.= "<input type='hidden' name='dependencia' id='dependencia' value='".$_SESSION['id_coord_maestro']."'>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='25%'>Dependencia: </td>
                        <td width='70%' colspan='2'>";
            $dataDepartamento= $maestro->selectMaestroPadreById($_SESSION['id_coord_maestro']);
            $html.= "<b>".$dataDepartamento[0]['stritema']."</b>";
            $html.= "   </td>
                    </tr>";
        }

        if($id_tipo_reporte == 1 || $id_tipo_reporte == 2){
            $html.= "<tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='25%'>Tipo de Correspondencia: </td>
                        <td width='70%' colspan='2'>
                            <select id='tipoC' name='tipoC' style='width:40%' onchange='xajax_selectDocumento(this.value)'>
                                <option value='0'>Todos los Tipos</option>";
            $html.= selectCorrespondencia();
            $html.= "       </select>
                        </td>
                    </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='25%'>Tipo de Documento: </td>
                        <td width='70%' colspan='2'>
                            <div id='capaDoc'>
                                <select id='tipoD' name='tipoD' style='width:40%'>
                                    <option value='0'>Todos los Tipos</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='25%'>Asunto: </td>
                        <td width='30%'>
                            <select id='asuntoCondicion' name='asuntoCondicion' style='width:80%'>
                                <option value='0'>Seleccione</option>
                                <option value='1'>Inicia con</option>
                                <option value='2'>Igual a</option>
                                <option value='3'>Diferente a</option>
                                <option value='4'>Contiene</option>
                            </select>
                        </td>
                        <td width='30%'>
                            <input type='text' id='asuntoValor' name='asuntoValor' class='inputbox82' value=''>
                        </td>
                    </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='25%'>Correlativo: </td>
                        <td width='30%'>
                            <select id='correlativoCondicion' name='correlativoCondicion' style='width:80%'>
                                <option value='0'>Seleccione</option>
                                <option value='1'>Inicia con</option>
                                <option value='2'>Igual a</option>
                                <option value='3'>Diferente a</option>
                                <option value='4'>Contiene</option>
                            </select>
                        </td>
                        <td width='30%'>
                            <input type='text' id='correlativoValor' name='correlativoValor' class='inputbox82' value=''>
                        </td>
                    </tr>";
        }
        if($id_tipo_reporte == 1){
            $nombreTipo= "(Correspondencia Redactada)";
            $html.= "<input type='hidden' id='tipoReporte' name='tipoReporte' value='1'>";
            $html.= "<tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='25%'>Creador: </td>
                        <td width='30%'>
                            <select id='creadorCondicion' name='creadorCondicion' style='width:80%'>
                                <option value='0'>Seleccione</option>
                                <option value='1'>Inicia con</option>
                                <option value='2'>Igual a</option>
                                <option value='3'>Diferente a</option>
                                <option value='4'>Contiene</option>
                            </select>
                        </td>
                        <td width='30%'>
                            <input type='text' id='creadorValor' name='creadorValor' class='inputbox82' value=''>
                        </td>
                    </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='25%'>Estatus: </td>
                        <td width='70%' colspan='2'>
                            <select id='estatus' name='estatus' style='width:40%'>
                                <option value='0'>Todos los Estatus</option>";
            for ($i= 0; $i < count($dataMaestro); $i++){
                if($dataMaestro[$i]['id_maestro'] >= 194 && $dataMaestro[$i]['id_maestro'] <= 199){
                    $html.= "<option value='".$dataMaestro[$i]['id_maestro']."'>".$dataMaestro[$i]['stritema']."</option>";
                }
            }
            $html.="       </select>
                        </td>
                     </tr>
                     <tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='25%'>Fecha: </td>
                        <td width='30%'>
                            <select id='fechaCondicion' name='fechaCondicion' style='width:70%'>
                                <option value='0'>Seleccione</option>
                                <option value='1'>Creador</option>
                                <option value='2'>Envio</option>
                            </select>
                        </td>
                        <td width='30%'>
                            <table width='100%'>
                                <tr>
                                    <td>Desde:</td>
                                    <td>
                                        <input type='text' id='fechaD' name='fechaD' size='10' maxlength='20' class='inputbox82' value='' readonly>
                                        <img name='button' id='lanzador1' src='../comunes/images/calendar.png' align='middle'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hasta:</td>
                                    <td>
                                        <input type='text' id='fechaH' name='fechaH'size='10' maxlength='20' class='inputbox82' value='' readonly>
                                        <img name='button' id='lanzador2' src='../comunes/images/calendar.png' align='middle'>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>";
        }else if($id_tipo_reporte == 2){
            $nombreTipo= "(Correspondencia Recibidas)";
            $html.= "<input type='hidden' id='tipoReporte' name='tipoReporte' value='2'>";
            $html.= "<tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='25%'>Estatus: </td>
                        <td width='70%' colspan='2'>
                            <select id='estatus' name='estatus' style='width:40%'>
                                <option value='0'>Todos los Estatus</option>";
            for ($i= 0; $i < count($dataMaestro); $i++){
                if($dataMaestro[$i]['id_maestro'] >= 200 && $dataMaestro[$i]['id_maestro'] <= 217){
                    $html.= "<option value='".$dataMaestro[$i]['id_maestro']."'>".$dataMaestro[$i]['stritema']."</option>";
                }
            }
            $html.="       </select>
                        </td>
                     </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='25%'>Fecha: </td>
                        <td width='70%' colspan='2'>
                            <table>
                                <tr>
                                    <td>Desde:</td>
                                    <td>
                                        <input type='text' id='fechaD' name='fechaD' size='13' maxlength='20' class='inputbox82' value='' readonly>
                                        <img name='button' id='lanzador1' src='../comunes/images/calendar.png' align='middle'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hasta:</td>
                                    <td>
                                        <input type='text' id='fechaH' name='fechaH'size='13' maxlength='20' class='inputbox82' value='' readonly>
                                        <img name='button' id='lanzador2' src='../comunes/images/calendar.png' align='middle'>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>";
        }else if($id_tipo_reporte == 3){
            $nombreTipo= "(Actividades)";
            $html.= "<input type='hidden' id='tipoReporte' name='tipoReporte' value='3'>";
            $html.="<tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='25%'>Estatus: </td>
                        <td width='70%' colspan='2'>
                            <select id='estatus' name='estatus' style='width:40%'>
                                <option value='0'>Todos los Estatus</option>";
            $dataMaestro= $data= $maestro->selectAllMaestroHijos(246, 'id_maestro');
            for ($i= 0; $i < count($dataMaestro); $i++){
                $html.= "<option value='".$dataMaestro[$i]['id_maestro']."'>".$dataMaestro[$i]['stritema']."</option>";
            }
            $html.="       </select>
                        </td>
                     </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='25%'>Asignado Por: </td>
                        <td width='30%'>
                            <select id='asignadoCondicion' name='asignadoCondicion' style='width:80%'>
                                <option value='0'>Seleccione</option>
                                <option value='1'>Inicia con</option>
                                <option value='2'>Igual a</option>
                                <option value='3'>Diferente a</option>
                                <option value='4'>Contiene</option>
                            </select>
                        </td>
                        <td width='30%'>
                            <input type='text' id='asignadoValor' name='asignadoValor' class='inputbox82' value=''>
                        </td>
                    </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='25%'>Analista Asignado: </td>
                        <td width='30%'>
                            <select id='analistaCondicion' name='analistaCondicion' style='width:80%'>
                                <option value='0'>Seleccione</option>
                                <option value='1'>Inicia con</option>
                                <option value='2'>Igual a</option>
                                <option value='3'>Diferente a</option>
                                <option value='4'>Contiene</option>
                            </select>
                        </td>
                        <td width='30%'>
                            <input type='text' id='analistaValor' name='analistaValor' class='inputbox82' value=''>
                        </td>
                    </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='25%'>Titulo de la Actividad: </td>
                        <td width='30%'>
                            <select id='tituloCondicion' name='tituloCondicion' style='width:80%'>
                                <option value='0'>Seleccione</option>
                                <option value='1'>Inicia con</option>
                                <option value='2'>Igual a</option>
                                <option value='3'>Diferente a</option>
                                <option value='4'>Contiene</option>
                            </select>
                        </td>
                        <td width='30%'>
                            <input type='text' id='tituloValor' name='tituloValor' class='inputbox82' value=''>
                        </td>
                    </tr>
                    <tr>
                        <td width='5%'>&nbsp;</td>
                        <td width='25%'>Fecha: </td>
                        <td width='70%' colspan='2'>
                            <table>
                                <tr>
                                    <td>Desde:</td>
                                    <td>
                                        <input type='text' id='fechaD' name='fechaD' size='13' maxlength='20' class='inputbox82' value='' readonly>
                                        <img name='button' id='lanzador1' src='../comunes/images/calendar.png' align='middle'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hasta:</td>
                                    <td>
                                        <input type='text' id='fechaH' name='fechaH'size='13' maxlength='20' class='inputbox82' value='' readonly>
                                        <img name='button' id='lanzador2' src='../comunes/images/calendar.png' align='middle'>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>";
        }else if($id_tipo_reporte == 4){
            $nombreTipo= "(Gesti&oacute;n)";
            $html.= "<input type='hidden' id='tipoReporte' name='tipoReporte' value='4'>";
        }
        $html.= "<tr>
                    <td colspan='5'>&nbsp;</td>
                </tr>
                <tr>
                    <td width='100%' colspan='5' align='center'>
                        <table width='100%'>
                            <tr>
                                <td width='15%'>&nbsp;</td>
                                <td width='35%' align='center'>
                                    <img src='../comunes/images/botonpdf.png' onmouseover=\"Tip('Exportar a PDF')\" onmouseout='UnTip()' onclick=\"xajax_generarReporte2(xajax.getFormValues('frmreporte'));\">
                                </td>
                                <td width='35%' align='center'>
                                    <img src='../comunes/images/botonoo.png' onmouseover=\"Tip('Exportar a OpenOffice')\" onmouseout='UnTip()'onclick=\"xajax_generarReporte(xajax.getFormValues('frmreporte'));\" >
                                </td>
                                <td width='15%'>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>";
        $html.= "</table>";
        $respuesta->assign("capaTipoReporte","innerHTML",$nombreTipo);
        $respuesta->assign("filtros","innerHTML",$html);
        if($id_tipo_reporte != 4){
            $respuesta->script("Calendar.setup({inputField:'fechaD',ifFormat:'%d/%m/%Y',button:'lanzador1'});");
            $respuesta->script("Calendar.setup({inputField:'fechaH',ifFormat:'%d/%m/%Y',button:'lanzador2'});");
        }
        $respuesta->script("$('capaRegresar').style.display='block'");
        return $respuesta;
    }

    function consultaReporte($formulario) {
        $maestro= new clMaestroModelo();
        $correspondencia= new clCorrespondenciaModelo();
        $destinatario= new clDestinatariosModelo();
        $actividad= new clActividadesModelo();
        $contactoActividad= new clContactoActividadModelo();
        
        $dataCorrespondencia= null;
        $dataMaestro= null;
        $dataDestinatario= null;
        $dataActividad= null;
        $dataContactoActividad= null;

        $departamentos= "";
        $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                    <table border='0' class='tablaTitulo' width='100%'>
                        <tr width='100%'>
                            <th width='8%'>
                                <a href='#' onclick=\"\">Id</a>
                            </th>
                            <th width='10%'>
                                <a href='#' onclick=\"\">Documento</a>
                            </th>
                            <th width='15%'>
                                <a href='#' onclick=\"\">Creador</a>
                            </th>
                            <th width='10%'>
                                <a href='#' onclick=\"\">Fecha de Creaci&oacute;n</a>
                            </th>
                            <th width='10%'>
                                <a href='#' onclick=\"\">Fecha de Env&iacute;o</a>
                            </th>
                            <th width='10%'>
                                <a href='#' onclick=\"\">Correlativo</a>
                            </th>
                            <th width='20%'>
                                <a href='#' onclick=\"\">Asunto</a>
                            </th>
                            <th width='17%'>
                                <a href='#' onclick=\"\">Estatus / Departamento / Analista</a>
                            </th>
                        </tr>
                    </table>";
            $departamentos= "";
            $dataMaestro= $maestro->selectAllMaestroHijos($_SESSION['id_dpto_maestro'], 'stritema');
            for($i= 0; $i < count($dataMaestro); $i++){
                $departamentos.= $dataMaestro[$i]['id_maestro'];
                if($i != (count($dataMaestro)-1)){
                    $departamentos.= ",";
                }
            }
            if($formulario['tipoC'] == 0){
                $formulario['tipoC']= null;
            }
            if($formulario['tipoD'] == 0){
                $formulario['tipoD']= null;
            }
            if($formulario['creadorCondicion'] == 0){
                $formulario['creadorCondicion']= null;
            }
            if($formulario['asuntoCondicion'] == 0){
                $formulario['asuntoCondicion']= null;
            }
            if($formulario['correlativoCondicion'] == 0){
                $formulario['correlativoCondicion']= null;
            }
            if($formulario['correlativoCondicion'] == 0){
                $formulario['correlativoCondicion']= null;
            }
            if($formulario['estatus'] == 0){
                $formulario['estatus']= null;
            }
            if($formulario['fechaCondicion'] == 0){
                $formulario['fechaCondicion']= null;
            }
            $dataCorrespondencia= $correspondencia->selectAllCorrespondenciaReporte($departamentos, $formulario['tipoC'], $formulario['tipoD'], $formulario['creadorCondicion'], $formulario['creadorValor'], $formulario['asuntoCondicion'],$formulario['asuntoValor'], $formulario['correlativoCondicion'], $formulario['correlativoValor'], $formulario['estatus'], $formulario['fechaCondicion'], $formulario['fechaD'], $formulario['fechaH']);
            if($dataCorrespondencia){
                for($i= 0; $i < count($dataCorrespondencia); $i++){
                    if($dataCorrespondencia[$i]['id_tipo_maestro'] == 84){
                        $dataDestinatario= $destinatario->selectAllDestinatariosByIdCorresp($dataCorrespondencia[$i]['id_corresp']);
                    }else if($dataCorrespondencia[$i]['id_tipo_maestro'] == 85){
                        $dataDestinatario= $destinatario->selectAllDestinatariosExternoByIdCorresp($dataCorrespondencia[$i]['id_corresp']);
                    }
                    $html.= "<table border='0' class='tablaTitulo' width='100%'>
                            <tr width='100%' bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue';\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                <td width='8%' align='center'>".$dataCorrespondencia[$i]['id_corresp']."</td>
                                <td width='10%' align='center'>".$dataCorrespondencia[$i]['nombre_tipocorresp_maestro']."</td>
                                <td width='15%' align='center'>".$dataCorrespondencia[$i]['nombre_contacto']."</td>
                                <td width='10%' align='center'>".$dataCorrespondencia[$i]['fecha']."</td>
                                <td width='10%' align='center'>".$dataCorrespondencia[$i]['fecha_envio']."</td>
                                <td width='10%' align='center'>".$dataCorrespondencia[$i]['strcorrelativo']."</td>
                                <td width='20%' align='left'>".$dataCorrespondencia[$i]['strasunto']."</td>
                                <td width='17%' align='left'>";

                    if($dataDestinatario){
                        for($y= 0; $y < count($dataDestinatario); $y++){
                            if($dataCorrespondencia[$i]['id_tipo_maestro'] == 84){
                                $html.= $dataDestinatario[$y]['estatus']." / ".$dataDestinatario[$y]['abreviacion_destinatario']." / ";
                            }else if($dataCorrespondencia[$i]['id_tipo_maestro'] == 85){
                                $html.= $dataDestinatario[$y]['estatus']." / ".$dataDestinatario[$y]['institucion_destinatario']." / ";
                            }
                            $dataActividad= $actividad->selectActividadByIdDestinatario($dataDestinatario[$y]['id_destinatarios']);
                            if($dataActividad){
                                for($x= 0; $x < count($dataActividad); $x++){
                                    $dataContactoActividad= $contactoActividad->selectContactosActividadByIdActividad($dataActividad[$x]['id_actividad']);
                                    if($dataContactoActividad){
                                        for($z= 0; $z < count($dataContactoActividad); $z++){
                                            $html.= $dataContactoActividad[$z]['nombre_contacto'];
                                            if($z != (count($dataContactoActividad)-1)){
                                                $html.= "-";
                                            }
                                        }
                                        $html.= "<br>";
                                    }else{
                                        $html.= "No Hay Analistas Asignados<br>";
                                    }
                                }
                            }else{
                                $html.= "No Hay Analistas Asignados<br>";
                            }
                        }
                    }
                    $html.= "</td>
                            </tr>
                        </table>";
                }
            }
            $html.= "</div>";
        return $html;
    }

    function generarReporte($formulario) {
        $respuesta= new xajaxResponse();
        $strUrl= "";
        $strUrl.= "&tipoReporte=".$formulario['tipoReporte'];
        $strUrl.= "&tipoC=".$formulario['tipoC'];
        $strUrl.= "&tipoD=".$formulario['tipoD'];
        $strUrl.= "&creadorCondicion=".$formulario['creadorCondicion'];
        $strUrl.= "&creadorValor=".$formulario['creadorValor'];
        $strUrl.= "&asuntoCondicion=".$formulario['asuntoCondicion'];
        $strUrl.= "&asuntoValor=".$formulario['asuntoValor'];
        $strUrl.= "&correlativoCondicion=".$formulario['correlativoValor'];
        $strUrl.= "&estatus=".$formulario['estatus'];
        $strUrl.= "&fechaCondicion=".$formulario['fechaCondicion'];
        $strUrl.= "&fechaD=".$formulario['fechaD'];
        $strUrl.= "&fechaH=".$formulario['fechaH'];
        $strUrl.= "&dependencia=".$formulario['dependencia'];
        $strUrl.= "&asignadoCondicion=".$formulario['asignadoCondicion'];
        $strUrl.= "&asignadoValor=".$formulario['asignadoValor'];
        $strUrl.= "&analistaCondicion=".$formulario['analistaCondicion'];
        $strUrl.= "&analistaValor=".$formulario['analistaValor'];
        $strUrl.= "&tituloCondicion=".$formulario['tituloCondicion'];
        $strUrl.= "&tituloValor=".$formulario['tituloValor'];
        if($formulario['tipoReporte'] == 1 || $formulario['tipoReporte'] == 2){
            $respuesta->script("location.href='reporteCorrespondenciaOOVista.php?tipo=RO".$strUrl."';");
        }else if($formulario['tipoReporte'] == 3){
            $respuesta->script("location.href= 'reporteActividadOOVista.php?tipo=RO".$strUrl."';");
        }else if($formulario['tipoReporte'] == 4){
            $respuesta->script("location.href= 'reporteGestionOOVista.php?tipo=RO".$strUrl."';");
        }
        return $respuesta;
    }

    function generarReporte2($formulario) {
        $respuesta= new xajaxResponse();
        $strUrl= "";
        $strUrl.= "&tipoReporte=".$formulario['tipoReporte'];
        $strUrl.= "&tipoC=".$formulario['tipoC'];
        $strUrl.= "&tipoD=".$formulario['tipoD'];
        $strUrl.= "&creadorCondicion=".$formulario['creadorCondicion'];
        $strUrl.= "&creadorValor=".$formulario['creadorValor'];
        $strUrl.= "&asuntoCondicion=".$formulario['asuntoCondicion'];
        $strUrl.= "&asuntoValor=".$formulario['asuntoValor'];
        $strUrl.= "&correlativoCondicion=".$formulario['correlativoValor'];
        $strUrl.= "&estatus=".$formulario['estatus'];
        $strUrl.= "&fechaCondicion=".$formulario['fechaCondicion'];
        $strUrl.= "&fechaD=".$formulario['fechaD'];
        $strUrl.= "&fechaH=".$formulario['fechaH'];
        $strUrl.= "&dependencia=".$formulario['dependencia'];
        $strUrl.= "&asignadoCondicion=".$formulario['asignadoCondicion'];
        $strUrl.= "&asignadoValor=".$formulario['asignadoValor'];
        $strUrl.= "&analistaCondicion=".$formulario['analistaCondicion'];
        $strUrl.= "&analistaValor=".$formulario['analistaValor'];
        $strUrl.= "&tituloCondicion=".$formulario['tituloCondicion'];
        $strUrl.= "&tituloValor=".$formulario['tituloValor'];
        if($formulario['tipoReporte'] == 1 || $formulario['tipoReporte'] == 2){
            $respuesta->script("window.open('reporteCorrespondenciaPdfVista.php?tipo=RP".$strUrl."','_blank','')");
        }else if($formulario['tipoReporte'] == 3){
            $respuesta->script("window.open('reporteActividadPdfVista.php?tipo=RP".$strUrl."','_blank','')");
        }else if($formulario['tipoReporte'] == 4){
            $respuesta->script("window.open('reporteGestionPdfVista.php?tipo=RP".$strUrl."','_blank','')");
        }
        return $respuesta;
    }
?>
