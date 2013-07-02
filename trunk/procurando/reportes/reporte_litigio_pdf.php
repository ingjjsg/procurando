<?php
require_once 'plantilla_reporte.php';
require_once '../modelo/clActuacionesModelo.php';
require_once '../modelo/clFunciones.php';

$proexpediente= new clActuaciones();
//$data= "";
//$request= unserialize($_GET['data']);
$data= $proexpediente->selectAllExpedienteReporte($_GET['id_origen'], $_GET['id_motivo'], $_GET['id_fase'],$_GET['id_actuacion_persona'],$_GET['id_tipo_organismo_centralizado'],$_GET['id_tipo_organismo'],$_GET['strnroexpediente'],$_GET['strnroexpedienteauxiliar']);


$pdf=new Plantilla("L");
$pdf->setTitulo("Expedientes Litigio");
$pdf->AddPage();

$html='
    <style>
        table, td, th {
            border: 1px solid #000; 
            line-height: normal;
            text-align:center;
            font-size: 20px;            
        }
        
        tr>th {
            text-align:center;
            font-weight: bold;
            background-color:#DDD;
        }
        
        .nro{
            width:15px;
        }
        
        .departamento {
            width:140px;
        }
        
        .prioridad {
            width:120px;
        }
        .monto {
            width:65px;
        }        
        
        .align{
             text-align:right;
             text-indent: 8px;
        }        
    </style>

    <table>
        <tr>
            <th class="nro">N°</th>
            <th>Expediente</th>
            <th>Expediente Auxiliar</th>
            <th class="prioridad">Tipo Organismo</th>
            <th class="departamento">Organismo</th>
            <th class="monto">Monto (Cuantia)</th>
            <th class="monto">Sentenciado</th>
            <th class="monto">Tranzado</th>
            <th class="monto">Ahorrado</th>
    </tr>';
$count=0;
$monto_intcuantias=0;
$monto_intsentenciado=0;
$monto_inttranzado=0;
$monto_intahorrado=0;
if($data){
foreach ($data as $key => $value) {
    
        $html.='<tr>';
            $html.='<td class="nro">'.++$count.'</td>';
            $html.='<td>'.$data[$key]['strnroexpediente'].'</td>';
            $html.='<td>'.$data[$key]['strnroexpedienteauxiliar'].'</td>';
            $html.='<td>'.clFunciones::mostrarStritema($data[$key]['id_tipo_organismo_centralizado']).'</td>';
            $html.='<td>'.clFunciones::mostrarStritema($data[$key]['id_tipo_organismo']).'</td>';
            $html.='<td>'.clFunciones::FormatoMonto($data[$key]['intcuantias']).'</td>';
            $html.='<td>'.clFunciones::FormatoMonto($data[$key]['intsentenciado']).'</td>';
            $html.='<td>'.clFunciones::FormatoMonto($data[$key]['inttranzado']).'</td>';
            $html.='<td>'.clFunciones::FormatoMonto($data[$key]['intahorrado']).'</td>';
            $monto_intcuantias=$monto_intcuantias+$data[$key]['intcuantias'];
            $monto_intsentenciado=$monto_intsentenciado+$data[$key]['intsentenciado'];
            $monto_inttranzado=$monto_inttranzado+$data[$key]['inttranzado'];
            $monto_intahorrado=$monto_intahorrado+($data[$key]['intsentenciado']-$data[$key]['inttranzado']);
            
        $html.="</tr>";
//        $html.='<tr>';
//                $html.='<th colspan="9"></th>';
//        $html.='</tr>';        
    
}
        $html.='<tr>
            <th colspan="5"></th>
            <th class="monto">Total Monto</th>
            <th class="monto">Total Sentenciado</th>
            <th class="monto">Total Tranzado</th>
            <th class="monto">Total Ahorrado</th>
    </tr>';
        $html.='<tr>
            <th colspan="5"></th>
            <th class="monto">'.clFunciones::FormatoMonto($monto_intcuantias).'</th>
            <th class="monto">'.clFunciones::FormatoMonto($monto_intsentenciado).'</th>
            <th class="monto">'.clFunciones::FormatoMonto($monto_inttranzado).'</th>
            <th class="monto">'.clFunciones::FormatoMonto($monto_intahorrado).'</th>
    </tr>';        
}
        $html.='<tr>';
                $html.='<th class="align" colspan="9">TOTAL: '.clFunciones::FormatoMonto($monto).'</th>';
        $html.='</tr>';  
$html.='</table>';
//$pdf->SetY(50);
$pdf->writeHTML($html);
$pdf->Output("reporte_litigio.pdf", "I");

?>
