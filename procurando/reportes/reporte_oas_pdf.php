<?php
require_once 'plantilla_reporte.php';
require_once '../modelo/ctblproexpedienteModelo.php';
require_once '../modelo/clFunciones.php';

$proexpediente= new clProExpediente();
$data= "";
$request= unserialize($_GET['data']);
$data= $proexpediente->selectAllExpedienteReporte($request['id_tipo_tramite'], $request['id_tipo_atencion'], $request['id_actuacion_persona'],$request['id_tipo_organismo'],$request['id_organismo'],$request['id_tipo_fase'],$request['id_fase'],$request['strnroexpediente'],$request['strnroexpedienteauxiliar']);


$pdf=new Plantilla("L");
$pdf->setTitulo("Expedientes");
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
            <th>Expediente</th>
            <th>Expediente Auxiliar</th>
            <th>Tipo Organismo</th>
            <th>Organismo</th>
            <th>Titulo</th>
         </tr>';
$count=0;

if($data){
foreach ($data as $key => $value) {
    
        $html.='<tr>';
            $html.='<td class="nro">'.++$count.'</td>';
            $html.='<td>'.$data[$key]['strnroexpediente'].'</td>';
            $html.='<td>'.$data[$key]['strnroexpedienteauxiliar'].'</td>';
            $html.='<td>'.$data[$key]['id_tipo_organismo'].'</td>';
            $html.='<td>'.$data[$key]['id_organismo'].'</td>';
            $html.='<td>'.$data[$key]['strtitulo'].'</td>';
        $html.="</tr>";
    
}
}

$html.='</table>';
//$pdf->SetY(50);
$pdf->writeHTML($html);
$pdf->Output("reporte_expediente.pdf", "I");

?>
