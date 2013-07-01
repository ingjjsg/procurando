<?php
    include_once ('../comunes/php/utilidades.php');
    include_once ('../comunes/php/utilidades.php');
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clCorrespondenciaModelo.php';
    require_once '../modelo/clDestinatariosModelo.php';

    verificarSession();

    header("Pragma: ");
	header('Cache-control: ');
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
	header("Content-disposition: attachment; filename=Reporte_Correspondencias.ods");

    $correspondencia= new clCorrespondenciaModelo();
    $destinatarios= new clDestinatariosModelo();
    $maestro= new clMaestroModelo();

    $maestro= new clMaestroModelo();
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
                            <td colspan='12' align='center' bgcolor='#D8D8D8'><b>Reporte de Actividades </b></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan='12' align='left' bgcolor='#D8D8D8'><b>".$dptoTitulo."</b></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    </table>";
                echo "<table border='1'>
                        <tr>
                            <th bgcolor='#D8D8D8'>Estatus</th>
                            <th bgcolor='#D8D8D8'>Borrador</th>
                            <th bgcolor='#D8D8D8'>Enviado a Coordinador</th>
                            <th bgcolor='#D8D8D8'>Enviado a Gerente</th>
                            <th bgcolor='#D8D8D8'>Devuelto a Analista</th>
                            <th bgcolor='#D8D8D8'>Enviada</th>
                            <th bgcolor='#D8D8D8'>Entrante No Le&iacute;da</th>
                            <th bgcolor='#D8D8D8'>Entrante Le&iacute;da</th>
                            <th bgcolor='#D8D8D8'>Asignada</th>
                            <th bgcolor='#D8D8D8'>Finalizada</th>
                            <th bgcolor='#D8D8D8'>Cerrada</th>
                            <th bgcolor='#D8D8D8'>Respondidas</th>
                        </tr>";

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


    $dataMaestroDocumentosI= $maestro->selectAllMaestroHijos(84, "stritema");
    $dataMaestroDocumentosE= $maestro->selectAllMaestroHijos(85, "stritema");

    if($dataMaestroDocumentosI){
        echo "<tr>
                <th bgcolor='#A4A4A4' align='left'>Correspondencias Internas</th>
                <th colspan='11'>&nbsp;</th>
            </tr>";
        for($i= 0; $i < count($dataMaestroDocumentosI); $i++){
            $dataCorrespondenciaInterna= $correspondencia->selectAllCorrespondenciaGestion($dpto, $dataMaestroDocumentosI[$i]['id_maestro']);
            $dataDestinatario= $destinatarios->selectAllGestionReporte($dpto, $dataMaestroDocumentosI[$i]['id_maestro']);
            $borrador= 0;
            $enviCoord= 0;
            $enviGeren= 0;
            $devuelto= 0;
            $enviada= 0;
            $entrantesNoLeidas= 0;
            $entrantesLeidas= 0;
            $asignadas= 0;
            $finalizadas= 0;
            $cerradas= 0;
            $respondidas= 0;
            if($dataCorrespondenciaInterna){
                $borrador= $dataCorrespondenciaInterna[0]['borrador'];
                $enviCoord= $dataCorrespondenciaInterna[0]['enviado_coord'];
                $enviGeren= $dataCorrespondenciaInterna[0]['enviado_gerente'];
                $devuelto= $dataCorrespondenciaInterna[0]['devuelto_analista'];
                $enviada= $dataCorrespondenciaInterna[0]['enviadas'];
            }
            for($j= 0; $j < count($dataDestinatario); $j++){
                if($dataDestinatario[$j]['id_estatus_maestro'] == 200){
                    $entrantesNoLeidas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 201){
                    $entrantesNoLeidas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 202){
                    $entrantesLeidas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 203){
                    $entrantesLeidas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 204){
                    $asignadas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 205){
                    $finalizadas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 216){
                    $cerradas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 217){
                    $respondidas+= $dataDestinatario[$j]['cantidad'];
                }
            }
            echo "<tr>
                    <th bgcolor='#D8D8D8' align='left'>".$dataMaestroDocumentosI[$i]['stritema']."</th>
                    <td align='center'>".$borrador."</td>
                    <td align='center'>".$enviCoord."</td>
                    <td align='center'>".$enviGeren."</td>
                    <td align='center'>".$devuelto."</td>
                    <td align='center'>".$enviada."</td>
                    <td align='center'>".$entrantesNoLeidas."</td>
                    <td align='center'>".$entrantesLeidas."</td>
                    <td align='center'>".$asignadas."</td>
                    <td align='center'>".$finalizadas."</td>
                    <td align='center'>".$cerradas."</td>
                    <td align='center'>".$respondidas."</td>
                </tr>";
        }
    }

    if($dataMaestroDocumentosE){
         echo "<tr>
                <th bgcolor='#A4A4A4' align='left'>Correspondencias Externas</th>
                <th colspan='11'>&nbsp;</th>
            </tr>";
        for($i= 0; $i < count($dataMaestroDocumentosE); $i++){
            $dataCorrespondenciaExterna= $correspondencia->selectAllCorrespondenciaGestion($dpto, $dataMaestroDocumentosE[$i]['id_maestro']);
            $dataDestinatario= $destinatarios->selectAllGestionReporte($dpto, $dataMaestroDocumentosE[$i]['id_maestro']);
            $borrador= 0;
            $enviCoord= 0;
            $enviGeren= 0;
            $devuelto= 0;
            $enviada= 0;
            $entrantesNoLeidas= 0;
            $entrantesLeidas= 0;
            $asignadas= 0;
            $finalizadas= 0;
            $cerradas= 0;
            $respondidas= 0;
            if($dataCorrespondenciaExterna){
                $borrador= $dataCorrespondenciaExterna[0]['borrador'];
                $enviCoord= $dataCorrespondenciaExterna[0]['enviado_coord'];
                $enviGeren= $dataCorrespondenciaExterna[0]['enviado_gerente'];
                $devuelto= $dataCorrespondenciaExterna[0]['devuelto_analista'];
                $enviada= $dataCorrespondenciaExterna[0]['enviadas'];
            }
            for($j= 0; $j < count($dataDestinatario); $j++){
                if($dataDestinatario[$j]['id_estatus_maestro'] == 200){
                    $entrantesNoLeidas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 201){
                    $entrantesNoLeidas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 202){
                    $entrantesLeidas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 203){
                    $entrantesLeidas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 204){
                    $asignadas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 205){
                    $finalizadas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 216){
                    $cerradas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 217){
                    $respondidas+= $dataDestinatario[$j]['cantidad'];
                }
            }
            echo "<tr>
                    <th bgcolor='#D8D8D8' align='left'>".$dataMaestroDocumentosE[$i]['stritema']."</th>
                    <td align='center'>".$borrador."</td>
                    <td align='center'>".$enviCoord."</td>
                    <td align='center'>".$enviGeren."</td>
                    <td align='center'>".$devuelto."</td>
                    <td align='center'>".$enviada."</td>
                    <td align='center'>".$entrantesNoLeidas."</td>
                    <td align='center'>".$entrantesLeidas."</td>
                    <td align='center'>".$asignadas."</td>
                    <td align='center'>".$finalizadas."</td>
                    <td align='center'>".$cerradas."</td>
                    <td align='center'>".$respondidas."</td>
                </tr>";
        }
    }
    echo "      </table>
            </body>
        </html>";
?>
