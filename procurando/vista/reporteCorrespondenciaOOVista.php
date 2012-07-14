<?php
    session_start();
    include_once ('../comunes/php/utilidades.php');
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clCorrespondenciaModelo.php';
    require_once '../modelo/clDestinatariosModelo.php';
    require_once '../modelo/clActividadesModelo.php';
    require_once '../modelo/clContactoActividadModelo.php';
    require_once '../modelo/clContactoExternoModelo.php';

    verificarSession();

	header("Pragma: ");
	header('Cache-control: ');
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
	header("Content-disposition: attachment; filename=Reporte_Correspondencias.ods");


    $maestro= new clMaestroModelo();
    $correspondencia= new clCorrespondenciaModelo();
    $destinatario= new clDestinatariosModelo();
    $actividad= new clActividadesModelo();
    $contactoActividad= new clContactoActividadModelo();
    $contactoExterno= new clContactoExternoModelo();

    $dataCorrespondencia= null;
    $dataMaestro= null;
    $dataDestinatario= null;
    $dataActividad= null;
    $dataContactoActividad= null;

    $estatusDptoAnalista= "";

    if($_REQUEST['tipoReporte'] == 1){
        $reporte= "Redactadas";
        $columnas= 8;
    }else if($_REQUEST['tipoReporte'] == 2){
        $reporte= "Recibidas";
        $columnas= 7;
    }
    
    if($_SESSION['id_profile'] == 112 || $_SESSION['id_profile'] == 117){
        if($_REQUEST['dependencia'] == 0){
            $dptoTitulo= "";
        }else{
            $dataDptoTitulo= $maestro->selectMaestroPadreById($_REQUEST['dependencia'], 'stritema');
            $dptoTitulo= $dataDptoTitulo[0]['stritema'];
        }
    }else if($_SESSION['id_profile'] == 113){
        if($_REQUEST['dependencia'] == 0){
            $dataDptoTitulo= $maestro->selectMaestroPadreById($_SESSION['id_dpto_maestro'], 'stritema');
            $dptoTitulo= $dataDptoTitulo[0]['stritema'];
        }else{
            $dataDptoTitulo= $maestro->selectMaestroPadreById($_REQUEST['dependencia'], 'stritema');
            $dptoTitulo= $dataDptoTitulo[0]['stritema'];
        }
    }else{
        $dataDptoTitulo= $maestro->selectMaestroPadreById($_REQUEST['dependencia'], 'stritema');
        $dptoTitulo= $dataDptoTitulo[0]['stritema'];
    }

    echo "<html>
                <head>
                    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                    <style type='text/css'>
                        .style1 {
                            font-family:Arial, Helvetica, sans-serif;
                            font-size:16px;
                            text-align:center;
                            background-color:#A4A4A4;
                            font-weight:bold;
                        }
                        .style2 {
                            font-family:Arial, Helvetica, sans-serif;
                            font-size:12px;
                            text-align:left;
                        }
                        .style9 {font-size: 10px; font-weight: bold; color: #FFFFFF; }
                    </style>
                </head>
                <body>
                    <table>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan='".$columnas."' align='center' bgcolor='#D8D8D8'><b>Reporte de Correspondencia ".$reporte."</b></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan='".$columnas."' align='left' bgcolor='#D8D8D8'><b>".$dptoTitulo."</b></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    </table>";

    if($_REQUEST['tipoReporte'] == 1){
            echo "<table border='1'>
                    <tr>
                        <th bgcolor='#D8D8D8'>Id</th>
                        <th bgcolor='#D8D8D8'>Documento</th>
                        <th bgcolor='#D8D8D8'>Creador</th>
                        <th bgcolor='#D8D8D8'>Fecha de Creaci&oacute;n</th>
                        <th bgcolor='#D8D8D8'>Fecha de Env&iacute;o</th>
                        <th bgcolor='#D8D8D8'>Correlativo</th>
                        <th bgcolor='#D8D8D8'>Asunto</th>
                        <th bgcolor='#D8D8D8'>Estatus / Departamento / Analista</th>
                    </tr>";
    }else if($_REQUEST['tipoReporte'] == 2){
             echo "<table border='1'>
                    <tr>
                        <th bgcolor='#D8D8D8'>Id</th>
                        <th bgcolor='#D8D8D8'>Documento</th>
                        <th bgcolor='#D8D8D8'>Remitente</th>
                        <th bgcolor='#D8D8D8'>Fecha de Env&iacute;o</th>
                        <th bgcolor='#D8D8D8'>Correlativo</th>
                        <th bgcolor='#D8D8D8'>Asunto</th>
                        <th bgcolor='#D8D8D8'>Estatus / Departamento / Analista</th>
                    </tr>";
    }

    if($_SESSION['id_profile'] == 112 || $_SESSION['id_profile'] == 117){
        if($_REQUEST['dependencia'] == 0){
            $dpto= null;
        }else{
            $dpto= $_REQUEST['dependencia'];
            $dataMaestro= $maestro->selectAllMaestroHijos($_REQUEST['dependencia'], 'stritema');
            if($dataMaestro){
                $dpto.= ",";
            }
            if($dataMaestro){
                for($i= 0; $i < count($dataMaestro); $i++){
                    $dpto.= $dataMaestro[$i]['id_maestro'];
                    if($i != (count($dataMaestro)-1)){
                        $dpto.= ",";
                    }
                }
            }
        }
    }else if($_SESSION['id_profile'] == 113){
        if($_REQUEST['dependencia'] == 0){
            $dataMaestro= $maestro->selectAllMaestroHijos($_SESSION['id_dpto_maestro'], 'stritema');
            $dpto= $_SESSION['id_dpto_maestro'];
            if($dataMaestro){
                $dpto.= ",";
            }
            if($dataMaestro){
                for($i= 0; $i < count($dataMaestro); $i++){
                    $dpto.= $dataMaestro[$i]['id_maestro'];
                    if($i != (count($dataMaestro)-1)){
                        $dpto.= ",";
                    }
                }
            }
        }else{
            $dpto= $_REQUEST['dependencia'];
        }
    }

    if($_REQUEST['tipoC'] == 0){
        $_REQUEST['tipoC']= null;
    }
    if($_REQUEST['tipoD'] == 0){
        $_REQUEST['tipoD']= null;
    }
    if($_REQUEST['creadorCondicion'] == 0){
        $_REQUEST['creadorCondicion']= null;
    }
    if($_REQUEST['asuntoCondicion'] == 0){
        $_REQUEST['asuntoCondicion']= null;
    }
    if($_REQUEST['correlativoCondicion'] == 0){
        $_REQUEST['correlativoCondicion']= null;
    }
    if($_REQUEST['correlativoCondicion'] == 0){
        $_REQUEST['correlativoCondicion']= null;
    }
    if($_REQUEST['estatus'] == 0){
        $_REQUEST['estatus']= null;
    }
    if($_REQUEST['fechaCondicion'] == 0){
        $_REQUEST['fechaCondicion']= null;
    }
    $dataCorrespondencia= $correspondencia->selectAllCorrespondenciaReporte($_REQUEST['tipoReporte'], $dpto, $_REQUEST['tipoC'], $_REQUEST['tipoD'], $_REQUEST['creadorCondicion'], $_REQUEST['creadorValor'], $_REQUEST['asuntoCondicion'],$_REQUEST['asuntoValor'], $_REQUEST['correlativoCondicion'], $_REQUEST['correlativoValor'], $_REQUEST['estatus'], $_REQUEST['fechaCondicion'], $_REQUEST['fechaD'], $_REQUEST['fechaH']);
    if($dataCorrespondencia){
        for($i= 0; $i < count($dataCorrespondencia); $i++){
            if($dataCorrespondencia[$i]['id_tipo_maestro'] == 84){
                $dataDestinatario= $destinatario->selectAllDestinatariosByIdCorresp($dataCorrespondencia[$i]['id_corresp']);
            }else if($dataCorrespondencia[$i]['id_tipo_maestro'] == 85){
                $dataDestinatario= $destinatario->selectAllDestinatariosExternoByIdCorresp($dataCorrespondencia[$i]['id_corresp']);
            }

            if($dataDestinatario){
                $estatusDptoAnalista= "";
                for($y= 0; $y < count($dataDestinatario); $y++){
                    if($dataCorrespondencia[$i]['id_tipo_maestro'] == 84){
                        $estatusDptoAnalista.= $dataDestinatario[$y]['estatus']." / ".$dataDestinatario[$y]['abreviacion_destinatario']." / ";
                    }else if($dataCorrespondencia[$i]['id_tipo_maestro'] == 85){
                        $estatusDptoAnalista.= $dataDestinatario[$y]['estatus']." / ".$dataDestinatario[$y]['institucion_destinatario']." / ";
                    }
                    $dataActividad= $actividad->selectActividadByIdDestinatario($dataDestinatario[$y]['id_destinatarios']);
                    if($dataActividad){
                        for($x= 0; $x < count($dataActividad); $x++){
                            $dataContactoActividad= $contactoActividad->selectContactosActividadByIdActividad($dataActividad[$x]['id_actividad']);
                            if($dataContactoActividad){
                                for($z= 0; $z < count($dataContactoActividad); $z++){
                                    $estatusDptoAnalista.= $dataContactoActividad[$z]['nombre_contacto'];
                                    if($z != (count($dataContactoActividad)-1)){
                                        $estatusDptoAnalista.= "-";
                                    }
                                }
                                $estatusDptoAnalista.= "\n";
                            }else{
                                $estatusDptoAnalista.= "No Hay Analistas Asignados\n";
                            }
                        }
                    }else{
                       $estatusDptoAnalista.= "No Hay Analistas Asignados\n";
                    }
                }
            }

            if($_REQUEST['tipoReporte'] == 1){
                echo "<tr>
                        <td align='center'>".$dataCorrespondencia[$i]['id_corresp']."</td>
                        <td align='left'>".$dataCorrespondencia[$i]['nombre_tipocorresp_maestro']."</td>
                        <td align='left'>".$dataCorrespondencia[$i]['nombre_contacto']."</td>
                        <td align='center'>".$dataCorrespondencia[$i]['fecha']."</td>
                        <td align='center'>".$dataCorrespondencia[$i]['fecha_envio']."</td>
                        <td align='center'>".$dataCorrespondencia[$i]['strcorrelativo']."</td>
                        <td align='left'>".$dataCorrespondencia[$i]['strasunto']."</td>
                        <td align='left'>".$estatusDptoAnalista."</td>
                     </tr>";
            }else if($_REQUEST['tipoReporte'] == 2){
                if($dataCorrespondencia[$i]['id_tipo_maestro'] == 84){
                    if($data[$i]['id_origen_unidad_maestro'] != 3){
                        $remitente= $dataCorrespondencia[$i]['nombre_unidad_maestro'];
                    }else{
                        $remitente= $dataCorrespondencia[$i]['nombre_origen_unidad_maestro'];
                    }
                }else if($dataCorrespondencia[$i]['id_tipo_maestro'] == 85){
                    $dataContactoExterno= $contactoExterno->selectAllContactoExternoById($dataCorrespondencia[$i]['id_unidad_maestro']);
                    $remitente= $dataContactoExterno[0]['strinstitucion'];
                }
                echo "<tr>
                        <td align='center'>".$dataCorrespondencia[$i]['id_corresp']."</td>
                        <td align='left'>".$dataCorrespondencia[$i]['nombre_tipocorresp_maestro']."</td>
                        <td align='left'>".$remitente."</td>
                        <td align='center'>".$dataCorrespondencia[$i]['fecha_envio']."</td>
                        <td align='center'>".$dataCorrespondencia[$i]['strcorrelativo']."</td>
                        <td align='left'>".$dataCorrespondencia[$i]['strasunto']."</td>
                        <td align='left'>".$estatusDptoAnalista."</td>
                     </tr>";
            }

        }
    }
    echo "      </table>
            </body>
        </html>";
?>