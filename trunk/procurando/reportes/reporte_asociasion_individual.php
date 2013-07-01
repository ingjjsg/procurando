<?php
require_once 'plantilla_reporte.php';
require_once '../modelo/clProAsociaciones.php';
require_once '../modelo/clFunciones.php'; 
require_once '../herramientas/herramientas.class.php'; 

//$data=  unserialize(stripslashes($_GET['data']));
$pdf=new Plantilla("P");
$pdf->setTitulo("ASOCIASIÓN");
$pdf->AddPage();

$html='
    <style>
        table, td, th {
            border: 1px solid #000; 
            line-height: normal;
            text-align:center;
        }
        
        tr>th {
            text-align:center;
            font-weight: bold;
            background-color:#DDD;
        }
        
        .nro{
            width:30px;
        }
        
        .departamento {
            width:150px;
        }
        
        .prioridad {
            width:70px;
        }
        
        .align{
             text-align:justify;
             text-indent: 10px;
        }
    </style>

    ';
    $asociasion= new clTblasociaciones();
    $data= "";
    $data= $asociasion->selectDetalleAsociacionReporte($_GET['id']);
    if($data){    
        $html.='<table>';
        $html.='<tr>';
            $html.='<th>ASOCIACIÓN:</th>';
            $html.='<td>'.$data['0']['strnombre_asociacion'].'</td>';
            $html.='<th >FUNDACIÓN:</th>';
            $html.='<td >'.$data['0']['dtmfechafun'].'</td>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th>RIF:</th>';
            $html.='<td>'.$data['0']['strrif'].'</td>';
            $html.='<th >TELÉFONO:</th>';
            $html.='<td >'.$data['0']['strtelefono_asociacion'].'</td>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th>MUNICIPIO:</th>';
            $html.='<td>'.$data['0']['id_municipio_asociacion_text'].'</td>';
            $html.='<th >PARROQUIA:</th>';
            $html.='<td >'.$data['0']['id_parroquia_asociacion_text'].'</td>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th>RAMO:</th>';
            $html.='<td>'.$data['0']['id_ramo_text'].'</td>';
            $html.='<th >TELÉFONO:</th>';
            $html.='<td >'.$data['0']['strtelefono_asociacion'].'</td>';
        $html.='</tr>';
        $html.='</table>';
        
        $html.='<br>';
        
        $html.='<table id="tabla-2">';

        $html.='<tr>';
            $html.='<th colspan="4">SITIO WEB</th>';
        $html.='</tr>';
        
        $html.='<tr>';
            $html.='<td colspan="4"><p class="align">'.$data['0']['strweb'].'</p></td>';
        $html.='</tr>';
        
        $html.='<tr>';
            $html.='<th colspan="4">REPRESENTANTE DE LA ASOCIACIÓN</th>';
        $html.='</tr>';
        
        $html.='<tr>';
            $html.='<td colspan="4"><p class="align">'.$data['0']['cliente'].'</p></td>';
        $html.='</tr>';


        
        $html.='</table>';
    }
$pdf->SetY(50);
$pdf->writeHTML($html);
$pdf->Output("reporte_asociasion_individual".date("d-M-Y-H:i:s").".pdf", "I");

?>
