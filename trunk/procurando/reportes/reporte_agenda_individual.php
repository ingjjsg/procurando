<?php
require_once 'plantilla_reporte.php';
require_once '../modelo/ctblagendaModelo.php';
require_once '../modelo/clFunciones.php'; 
require_once '../herramientas/herramientas.class.php'; 

//$data=  unserialize(stripslashes($_GET['data']));
$pdf=new Plantilla("P");
$pdf->setTitulo("Agenda");
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
    $prodocumento= new clTblagenda();
    $data= "";
    $data= $prodocumento->selectAgendaIndividualReporte($_GET['id']);
    if($data){    
        $html.='<table>';
        $html.='<tr>';
            $html.='<th>Agenda</th>';
            $html.='<td>'.$data['0']['id_tipo_agenda'].'</td>';
            $html.='<th >Departamento</th>';
            $html.='<td >'.$data['0']['id_unidad_agenda'].'</td>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th>Evento</th>';
            $html.='<td>'.$data['0']['id_evento_agenda'].'</td>';
            $html.='<th >Titulo</th>';
            $html.='<td >'.$data['0']['strtitulo'].'</td>';
        $html.='</tr>';
        $html.='</table>';
        
        $html.='<br>';
        
        $html.='<table id="tabla-2">';
                
        $html.='<tr>';
            $html.='<th colspan="4">Descripción</th>';
        $html.='</tr>';
        
        $html.='<tr>'.$data['0']['strdescripcion'].'</p></td>';
        $html.='</tr>';


        
        $html.='</table>';
    }
$pdf->SetY(50);
$pdf->writeHTML($html);
$pdf->Output("reporte_agenda_individual".date("d-M-Y-H:i:s").".pdf", "I");

?>
