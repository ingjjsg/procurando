<?php
require_once 'plantilla_reporte.php';
require_once '../modelo/clDictamenesModelo.php';
require_once '../modelo/clFunciones.php'; 
require_once '../herramientas/herramientas.class.php'; 

//$data=  unserialize(stripslashes($_GET['data']));
$pdf=new Plantilla("P");
$pdf->setTitulo("DICTAMEN");
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
    $dictamenes= new clTbldictamenes();
    $data= "";
    $data= $dictamenes->selectDictamen($_GET['id']);
    if($data){    
        $html.='<table>';
        $html.='<tr>';
            $html.='<th>TIPO DE MATERIA:</th>';
            $html.='<td>'.$data['0']['id_materia_text'].'</td>';
            $html.='<th >TEMA:</th>';
            $html.='<td >'.$data['0']['id_tipo_materia_text'].'</td>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th>TIPO DE ORGANISMO:</th>';
            $html.='<td>'.$data['0']['id_tipo_organismo_text'].'</td>';
            $html.='<th >ORGANISMO:</th>';
            $html.='<td >'.$data['0']['id_organismo_text'].'</td>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th>ESTATUS:</th>';
            $html.='<td>'.$data['0']['id_estado_text'].'</td>';
            $html.='<th >FECHA:</th>';
            $html.='<td >'.$data['0']['fecdictamen'].'</td>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th>PERSONAS:</th>';
            $html.='<td>'.$data['0']['strpersonas'].'</td>';
            $html.='<th >NUMERO:</th>';
            $html.='<td >'.$data['0']['stranrodictamen'].'</td>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th>TITULO:</th>';
            $html.='<td>'.$data['0']['strtitulo'].'</td>';
            $html.='<th ></th>';
            $html.='<td ></td>';
        $html.='</tr>';
        $html.='</table>';
        
        $html.='<br>';
        
        $html.='<table id="tabla-2">';
                
        $html.='<tr>';
            $html.='<th colspan="4">Descripción</th>';
        $html.='</tr>';
        
        $html.='<tr>';
            $html.='<td colspan="4"><p class="align">'.$data['0']['strasunto'].'</p></td>';
        $html.='</tr>';


        
        $html.='</table>';
    }
$pdf->SetY(50);
$pdf->writeHTML($html);
$pdf->Output("reporte_dictamen_individual".date("d-M-Y-H:i:s").".pdf", "I");

?>
