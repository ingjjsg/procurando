<?php
require_once 'plantilla_reporte.php';
require_once '../modelo/clProActuaciones.php';
require_once '../modelo/clFunciones.php'; 
require_once '../herramientas/herramientas.class.php'; 

//$data=  unserialize(stripslashes($_GET['data']));
$pdf=new Plantilla("P");
$pdf->setTitulo("Actuación");
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
    $asociasion= new clTblproactuaciones();
    $data= "";
    $data= $asociasion->selectDetalleActuacionReporte($_GET['id']);
   // exit(print_r($data));
    if($data){    
        $html.='<table>';
        $html.='<tr>';
            $html.='<th>Nombre Actuación:</th>';
            $html.='<td>'.$data['0']['strnombreactuacion'].'</td>';
            $html.='<th >Fecha Actuación:</th>';
            $html.='<td >'.$data['0']['fecactuacion'].'</td>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th>Tipo Actuación:</th>';
            $html.='<td>'.$data['0']['tipo_actuacion'].'</td>';
            $html.='<th >Item Actuación:</th>';
            $html.='<td >'.$data['0']['actuacion'].'</td>';
        $html.='</tr>';
       
        $html.='</table>';
        
        $html.='<br>';
        
        $html.='<table id="tabla-2">';

        $html.='<tr>';
            $html.='<th colspan="4">Descripción</th>';
        $html.='</tr>';
        
        $html.='<tr>';
            $html.='<td colspan="4"><p class="align">'.$data['0']['strdescripcionactuacion'].'</p></td>';
        $html.='</tr>';
        
        


        
        $html.='</table>';
    }
$pdf->SetY(50);
$pdf->writeHTML($html);
$pdf->Output("reporte_actuacion_individual".date("d-M-Y-H:i:s").".pdf", "I");

?>
