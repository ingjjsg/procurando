<?php
session_start();
require_once 'plantilla_reporte.php';
require_once '../modelo/ctblproexpedienteModelo.php';
require_once '../modelo/clMaestroModelo.php';
require_once '../modelo/clFunciones.php'; 
require_once '../herramientas/herramientas.class.php'; 
//exit(clMaestroModelo::getJefeCoordinacion());


//$data=  unserialize(stripslashes($_GET['data']));

          
$pdf=new Plantilla("P");
$pdf->setTitulo("");
$pdf->AddPage();

$html='
    <style>
        table, td, th {
            border: 1px solid #000; 
            line-height: normal;
            text-align:left;
        }
        
        tr>th {
            text-align:left;
        }
        
        .titulo {
            background-color:#d2cfcf;
            font-weight: bold;            
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
    $prodocumento= new clProExpediente();
    $data= "";
    $data= $prodocumento->SelectExpedienteReporte($_GET['id']);
//    exit(print_r($data));
    if($data){    
        $html.='<table>';
        $html.='<tr>';
            $html.='<th colspan="4">DIRECCIÓN DE ATENCIÓN, ASISTENCIA Y ASESORIA JURIDICA AL SOBERANO</th>';
        $html.='</tr>';             
        $html.='<tr>';
            $html.='<th class="titulo">FECHA</th>';
            $html.='<td>'.$data['0']['fecapertura'].'</td>';
            $html.='<th  class="titulo">N° EXP</th>';
            $html.='<td >'.$data['0']['strnroexpediente'].'</td>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th class="titulo">NOMBRES Y APELLIDOS DEL SOLICITANTE</th>';
            $html.='<td>'.$data['0']['id_solicitante'].'</td>';
            $html.='<th class="titulo" >CÉDULA DE IDENTIDAD</th>';
            $html.='<td >'.$data['0']['cedula_cliente'].'</td>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th  class="titulo" colspan="4">CASO</th>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th colspan="4">'.$data['0']['id_tipo_atencion'].':     '.$data['0']['id_tipo_tramite_text'].'</th>';
        $html.='</tr>'; 
        $html.='<tr>';
            $html.='<th  class="titulo" colspan="4">DIRECCIÓN DE HABITACIÓN</th>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th colspan="4">'.$data['0']['strdireccion'].'</th>';
        $html.='</tr>';   
        $html.='<tr>';
            $html.='<th  class="titulo" colspan="4">ESTADO</th>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th colspan="4">'.$data['0']['id_estado'].'</th>';
        $html.='</tr>'; 
        $html.='<tr>';
            $html.='<th  class="titulo" colspan="4">MUNICIPIO</th>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th colspan="4">'.$data['0']['id_municipio'].'</th>';
        $html.='</tr>';         
        $html.='<tr>';
            $html.='<th  class="titulo" colspan="4">ORGANISMO</th>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th colspan="4">'.$data['0']['id_tipo_organismo'].'   ->    '.$data['0']['id_organismo'].'</th>';
        $html.='</tr>';          
        $html.='<tr>';
            $html.='<th class="titulo" colspan="4">DATOS OFICINA DE ATENCIÓN AL SOBERANO</th>';
        $html.='</tr>';        
        $html.='<tr>';
            $html.='<th class="titulo">ABOGADO(A) RESPONSABLE</th>';
            $html.='<td>'.$data['0']['id_abogado_resp'].'</td>';
            $html.='<th class="titulo" >FIRMA</th>';
            $html.='<td ></td>';
        $html.='</tr>';  
        $html.='<tr>';
            $html.='<th class="titulo">ABOGADO(A) EJECUTOR</th>';
            $html.='<td>'.$data['0']['id_abogado_ejecutor'].'</td>';
            $html.='<th class="titulo" >JEFE DE LA UNIDAD</th>';
            $html.='<td >'.strtoupper(clMaestroModelo::getJefeCoordinacion()).'</td>';
        $html.='</tr>';  
        $html.='<tr>';
            $html.='<th class="titulo">FIRMA</th>';
            $html.='<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
            $html.='<th class="titulo" >FIRMA</th>';
            $html.='<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
        $html.='</tr>';           
        $html.='<tr>';
        $html.='<th colspan="4"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SELLO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>';
        $html.='</tr>';        
        $html.='</table>';
        
    }
$pdf->SetY(50);
$pdf->writeHTML($html);
$pdf->Output("portada_oas_individual".date("d-M-Y-H:i:s").".pdf", "I");

?>
