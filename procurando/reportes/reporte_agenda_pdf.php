<?php
require_once 'plantilla_reporte.php';
require_once '../modelo/ctblagendaModelo.php';

$proagenda= new clTblagenda();
$data= "";
$request=  $_GET['data'];
$data= $proagenda->selectAgendaReporte($request['id_tipo'], $request['id_evento'], $request['id_prioridad'],$request['id_estado'],$request['id_recordatorio'],$request['id_unidad'],$request['id_refiere'],$request['id_tipo_organismo'],$request['id_organismo']);
        

$pdf=new Plantilla("L");
$pdf->setTitulo("Agendas");
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
    </style>

    <table>
        <tr>
            <th class="nro">N°</th>
            <th>Agenda</th>
            <th class="departamento">Departamento</th>
            <th>Evento</th>
            <th>Titulo</th>
            <th class="prioridad">Prioridad</th>
            <th>Estado</th>
            <th>Días</th>
         </tr>';
$count=0;

if($data){
foreach ($data as $key => $value) {
    
        $html.='<tr>';
            $html.='<td class="nro">'.++$count.'</td>';
            $html.='<td>'.$data[$key]['id_tipo_agenda'].'</td>';
            $html.='<td class="departamento">'.$data[$key]['id_unidad_agenda'].'</td>';
            $html.='<td>'.$data[$key]['id_evento_agenda'].'</td>';
            $html.='<td>'.$data[$key]['strtitulo'].'</td>';
            $html.='<td class="prioridad centrado">'.$data[$key]['id_prioridad_agenda'].'</td>';
            $html.='<td>'.$data[$key]['id_estado_agenda'].'</td>';
            $html.='<td>0</td>';
        $html.="</tr>";
    
}
}

$html.='</table>';
$pdf->SetY(40);
$pdf->writeHTML($html);
$pdf->Output("reporte_agenda.pdf", "I");

?>
