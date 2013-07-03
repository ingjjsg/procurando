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
        $fecini = str_replace("-","/",$_GET['fecini']);
        $fecini = str_replace("-","/",$fecini);
        $fecini = str_replace("-","/",$fecini);
        $fecfin = str_replace("-","/",$_GET['fecfin']);
        $fecfin = str_replace("-","/",$fecfin);
        $fecfin = str_replace("-","/",$fecfin);
$data= $proexpediente->SelectAllExpedienteReporteEstadisticas($_GET['id_tipo_tramite'], $_GET['id_tipo_atencion'], $_GET['id_actuacion_persona'],$_GET['id_tipo_organismo'],$_GET['id_organismo'],$_GET['id_tipo_fase'],$_GET['id_fase'],$_GET['strnroexpediente'],$_GET['strnroexpedienteauxiliar'],$fecini,$fecfin);
//print_r($data);

$pdf=new Plantilla("L");
$pdf->SetFont('Helvetica','B',6);
$pdf->setTitulo("Expedientes");
$pdf->AddPage();

$html='
    <style>
        table, td, th {
            border: 1px solid #000; 
            line-height: normal;
            text-align:center;
            font-size:20px;              
        }
        
        tr>th {
            text-align:center;
            font-weight: bold;
            background-color:#DDD;
        }
        
        .nro{
            width:100px;
        }
        
        .nroexpediente{
            width:80px;
        }
        
        .departamento {
            width:300px;
        }
        
        .prioridad {
            width:100px;
        }
    </style>

    <table>
        <tr>
            <th class="nro">Cantidad</th>
            <th class="departamento">Tramite</th>
</tr>';
        $data_arreglo = array();
        if($data){
                    for ($i= 0; $i < count($data); $i++){
                    $html.='<tr>';
                        $html.='<td class="nro">'.$data[$i]['numero'].'</td>';
                        $html.='<td>'.strtoupper($data[$i]['tramite']).'</td>';
                    $html.="</tr>";  
                    $data_arreglo += array($data[$i]['numero']=> array($data[$i]['numero'],'red'));
                }    
        }
$data_arreglo2=array('aprobados'=>array(1,'red'),'reprobados'=>array(1,'blue'),'retirados'=>array(1,'black'),'aprobados2'=>array(1,'white'),'reprobados2'=>array(1,'yellow'),'retirados2'=>array(1,'black'),'aprobados3'=>array(1,'white'),'reprobados3'=>array(1,'yellow'),'retirados3'=>array(1,'black'));
//print_r($data_arreglo2);
//echo '</br>';
//exit(print_r($data_arreglo));
$html.='</table>';
$pdf->writeHTML($html);
//$pdf->Cell(0,5,"GRAFICO REALIZADO CON FPDF Y JGRAPH",0,0,'C');
$pdf->AddPage();
$pdf->gaficoPDF($data_arreglo,'Grafico',array(70,50,150,110),'GRAFICA DE TRAMITES');
//$pdf->gaficoPDF(array('aprobados'=>array(1,'red'),'reprobados'=>array(1,'blue'),'retirados'=>array(1,'black')),'Grafico',array(160,60,100,80),'grafico');


$pdf->Output("reporte_expediente.pdf", "I");

?>