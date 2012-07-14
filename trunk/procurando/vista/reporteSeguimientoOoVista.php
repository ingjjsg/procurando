<?php
    session_start();
    require_once '../modelo/clRutaCorrespondenciaModelo.php';
    require_once '../modelo/clCorrespondenciaModelo.php';
    require_once '../comunes/php/utilidades.php';

    verificarSession();
    
	header("Pragma: ");
	header('Cache-control: ');
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
	header("Content-disposition: attachment; filename=seguimientos.ods");

    
    $rutaCorrespondencia= new clRutaCorrespondenciaModelo();
    $correspondencia= new clCorrespondenciaModelo();
    $data= $rutaCorrespondencia->selectRutaCorrespondenciaByIdCorresp($_REQUEST["id"]);
    $dataCorresp= $correspondencia->selectAllCorrespondenciaById($_REQUEST["id"]);
    if($data){
        echo "<html>
                <head>
                    <title>Segumientos de la Correspondencia</title>
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
                <body>";
        echo "<table width='100%' border='0'>
                <tr>
                    <td colspan='2'>
                        <div><img src='../comunes/images/cab_reportes.jpg' width='100%' height='100%'></div>
                    </td>
                </tr>
                <tr>
                    <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
                </tr>
                <tr>
                    <th bgcolor='#D8D8D8' colspan='2'><span class='style9'>Seguimientos de la Correspondencia ".$dataCorresp[0]['strcorrelativo']." (Id: ".$_REQUEST["id"].")</span></th>
                </tr>
                <tr>
                    <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
                </tr>
            </table>
            <table width='100%' border='1'>
                <tr>
                    <th bgcolor='#D8D8D8' width='25%'>Fecha y Hora</th>
                    <th bgcolor='#D8D8D8' width='75%'>Acci&oacute;n</th>
                </tr>";
        for($i= 0; $i < count($data); $i++){
            echo "<tr>";
            echo "<td valign='top' bgcolor='#FFFFFF' width='25%'>";
            echo $data[$i]['fecha_ruta']." | ".$data[$i]['hora_ruta'];
            echo "</td>";
            echo "<td valign='top' bgcolor='#FFFFFF' width='75%'>";
            echo $data[$i]['nombre_contacto']." <b>".$data[$i]['nombre_estatus_maestro']."</b>";
            if($data[$i]['id_estatus_maestro'] == 234 || $data[$i]['id_estatus_maestro'] == 235 || $data[$i]['id_estatus_maestro'] == 236 || $data[$i]['id_estatus_maestro'] == 237 || $data[$i]['id_estatus_maestro'] == 255){
                echo " el documento: ";
            }else if($data[$i]['id_estatus_maestro'] == 256 || $data[$i]['id_estatus_maestro'] == 257 || $data[$i]['id_estatus_maestro'] == 258 || $data[$i]['id_estatus_maestro'] == 259 || $data[$i]['id_estatus_maestro'] == 260 || $data[$i]['id_estatus_maestro'] == 261 || $data[$i]['id_estatus_maestro'] == 262){
                echo " la actividad: ";
            }
            if($data[$i]['id_estatus_maestro'] == 234 || $data[$i]['id_estatus_maestro'] == 235 || $data[$i]['id_estatus_maestro'] == 236 || $data[$i]['id_estatus_maestro'] == 237 || $data[$i]['id_estatus_maestro'] == 255){
                if($data[$i]['strcorrelativo'] != ""){
                    echo $data[$i]['strcorrelativo'];
                }
                echo "(Id: ".$data[$i]['id_corresp'].") <br>";
            }
            echo $data[$i]['memrutacorresp'];
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    echo "</body>
        </html>";
    
?>