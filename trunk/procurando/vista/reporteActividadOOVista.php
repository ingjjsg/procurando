<?php
    include_once ('../comunes/php/utilidades.php');
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clActividadesModelo.php';
    require_once '../modelo/clDepartamentoActividadModelo.php';
    require_once '../modelo/clContactoActividadModelo.php';

    verificarSession();

	header("Pragma: ");
	header('Cache-control: ');
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
	header("Content-disposition: attachment; filename=Reporte_Correspondencias.ods");


    $actividad= new clActividadesModelo();
    $departamentoActividad= new clDepartamentoActividadModelo();
    $contactoActividad= new clContactoActividadModelo();

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
                            <td colspan='7' align='center' bgcolor='#D8D8D8'><b>Reporte de Actividades </b></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan='7' align='left' bgcolor='#D8D8D8'><b>".$dptoTitulo."</b></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    </table>";
                echo "<table border='1'>
                        <tr>
                            <th bgcolor='#D8D8D8'>Id</th>
                            <th bgcolor='#D8D8D8'>Correlativo</th>
                            <th bgcolor='#D8D8D8'>Titulo</th>
                            <th bgcolor='#D8D8D8'>Asignado Por / Departamento</th>
                            <th bgcolor='#D8D8D8'>Fecha de Asignaci&oacute;n</th>
                            <th bgcolor='#D8D8D8'>Estatus</th>
                            <th bgcolor='#D8D8D8'>Asignado Por / Analista Asignado / Estatus</th>
                        </tr>";

    $dataMaestro= $maestro->selectAllMaestroHijos($_SESSION['id_dpto_maestro'], 'stritema');

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

    if($_REQUEST['estatus'] == 0){
        $_REQUEST['estatus']= null;
    }
    if($_REQUEST['asignadoCondicion'] == 0){
        $_REQUEST['asignadoCondicion']= null;
    }
    if($_REQUEST['analistaCondicion'] == 0){
        $_REQUEST['analistaCondicion']= null;
    }
    if($_REQUEST['tituloCondicion'] == 0){
        $_REQUEST['tituloCondicion']= null;
    }

    $dataActividad= $actividad->selectAllReporteActividad($dpto, $_REQUEST['estatus'], $_REQUEST['fechaD'], $_REQUEST['fechaH'], $_REQUEST['asignadoCondicion'], $_REQUEST['asignadoValor'], $_REQUEST['analistaCondicion'], $_REQUEST['analistaValor'], $_REQUEST['tituloCondicion'], $_REQUEST['tituloValor']);
    if($dataActividad){
        for($i= 0; $i < count($dataActividad); $i++){

            $dataDepartamentoActividad= $departamentoActividad->selectDepartamentoActividadByIdActividad($dataActividad[$i]['id_actividad']);
            $strAsignadoDepartamento= "";
            if($dataDepartamentoActividad){
                for($j= 0; $j < count($dataDepartamentoActividad); $j++){
                    $dataSiglasMaestro= $maestro->selectMaestroPadreById($dataDepartamentoActividad[$j]['id_departamento_maestro']);
                    $strAsignadoDepartamento.= $dataDepartamentoActividad[$j]['nombre_contacto']." / ".$dataSiglasMaestro[0]['stritemb']."<br>";
                }
            }
            $strAsignadoAnalista= "";
            $dataContactoActividad= $contactoActividad->selectContactosActividadByIdActividad($dataActividad[$i]['id_actividad']);
            if($dataContactoActividad){
                for($x= 0; $x < count($dataContactoActividad); $x++){
                    $strAsignadoAnalista.= $dataContactoActividad[$x]['nombre_contacto_asigna']." / ".$dataContactoActividad[$x]['nombre_contacto']." / ".$dataContactoActividad[$x]['nombre_estatus_maestro']."<br>";
                }
            }
            echo "<tr>
                        <td align='center' valign='middle'>".$dataActividad[$i]['id_actividad']."</td>
                        <td align='left' valign='middle'>".$dataActividad[$i]['correlativo']."</td>
                        <td align='left' valign='middle'>".$dataActividad[$i]['memtitulo']."</td>
                        <td align='left' valign='middle'>".$strAsignadoDepartamento."</td>
                        <td align='center' valign='middle'>".$dataActividad[$i]['fecha_resolucion']."</td>
                        <td align='center' valign='middle'>".$dataActividad[$i]['estatus']."</td>
                        <td align='left' valign='middle'>".$strAsignadoAnalista."</td>
                     </tr>";
        }
    }
     echo "      </table>
            </body>
        </html>";

?>