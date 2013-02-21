<?php
require_once 'plantilla_reporte.php';
require_once '../modelo/ctblproexpedienteModelo.php';
require_once '../modelo/clFunciones.php';
//
//exit($_GET['id_tipo_tramite']);
$proexpediente= new clProExpediente();
$data= "";
//$request= unserialize($_GET['data']);
//exit(print_r($_GET));
$data= $proexpediente->selectAllExpedienteReporte($_GET['id_tipo_tramite'], $_GET['id_tipo_atencion'], $_GET['id_actuacion_persona'],$_GET['id_tipo_organismo'],$_GET['id_organismo'],$_GET['id_tipo_fase'],$_GET['id_fase'],$_GET['strnroexpediente'],$_GET['strnroexpedienteauxiliar']);
//print_r($data);

$pdf=new Plantilla("L");
$pdf->setTitulo("Expedientes");
$pdf->AddPage();

$html='
    <style>
        table, td, th {
            border: 1px solid #000; 
            line-height: normal;
            text-align:center;
            font-size:25px;              
        }
        
        tr>th {
            text-align:center;
            font-weight: bold;
            background-color:#DDD;
        }
        
        .nro{
            width:30px;
        }
        
        .nroexpediente{
            width:100px;
        }
        
        .departamento {
            width:250px;
        }
        
        .prioridad {
            width:100px;
        }
    </style>

    <table>
        <tr>
            <th class="nro">N°</th>
            <th class="nroexpediente">Expediente</th>
            <th class="departamento">Tramite</th>
            <th class="prioridad">Tipo Organismo</th>
            <th class="departamento">Organismo</th>
         </tr>';
$count=0;
$indice=0;
if($data){
    foreach ($data as $key => $value) {
            $html.='<tr>';
                $html.='<td class="nro">'.++$count.'</td>';
                $html.='<td>'.strtoupper($data[$key]['strnroexpediente']).'</td>';
                if ($data[$key]['id_tipo_tramite_text']) 
                    $html.='<td>'.strtoupper($data[$key]['id_tipo_tramite_text']).'</td>';
                else            
                    $html.='<td> No Registrado</td>';
                if ($data[$key]['id_tipo_organismo']) 
                    $html.='<td>'.strtoupper($data[$key]['id_tipo_organismo_text']).'</td>';
                else            
                    $html.='<td> No Registrado</td>';          
                if ($data[$key]['id_organismo']) 
                    $html.='<td>'.strtoupper($data[$key]['id_organismo_text']).'</td>';
                else            
                    $html.='<td> No Registrado</td>';
            $html.="</tr>";
//        if ($indice>10)
//        {
//            $html.='<br /><br /><br />';      
//            $indice=0;        
//        }
//           $indice++;

    }
}

$html.='</table>';
//$pdf->SetY(50);
$pdf->writeHTML($html);
$pdf->Output("reporte_expediente.pdf", "I");

?>

