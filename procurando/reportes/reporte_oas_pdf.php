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
$data= $proexpediente->selectAllExpedienteReporte($_GET['id_tipo_tramite'], $_GET['id_tipo_atencion'], $_GET['id_actuacion_persona'],$_GET['id_tipo_organismo'],$_GET['id_organismo'],$_GET['id_tipo_fase'],$_GET['id_fase'],$_GET['strnroexpediente'],$_GET['strnroexpedienteauxiliar'],$fecini,$fecfin);
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
            width:27px;
        }
        
        .nroexpediente{
            width:80px;
        }
        
        .departamento {
            width:200px;
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
            <th class="prioridad">Responsable</th>

</tr>';
        if($data){
                    for ($i= 0; $i < count($data); $i++){
                    $html.='<tr>';
                        $html.='<td class="nro">'.$i.'</td>';
                        $html.='<td>'.strtoupper($data[$i]['strnroexpediente']).'</td>';
                        if ($data[$i]['id_tipo_tramite_text']) 
                            $html.='<td>'.strtoupper($data[$i]['id_tipo_tramite_text']).'</td>';
                        else            
                            $html.='<td> No Registrado</td>';
                        if ($data[$i]['id_tipo_organismo']) 
                            $html.='<td>'.strtoupper($data[$i]['id_tipo_organismo_text']).'</td>';
                        else            
                            $html.='<td> No Registrado</td>';          
                        if ($data[$i]['id_organismo']) 
                            $html.='<td>'.strtoupper($data[$i]['id_organismo_text']).'</td>';
                        else            
                            $html.='<td> No Registrado</td>';
                        if ($data[$i]['id_abogado_resp']) 
                            $html.='<td>'.strtoupper($data[$i]['nombreresponsable']).'</td>';
                        else            
                            $html.='<td> No Registrado</td>';                        
                    $html.="</tr>";                
                }    
        }

$html.='</table>';
//exit($html);
//$pdf->SetY(50);
$pdf->writeHTML($html);
$pdf->Output("reporte_expediente.pdf", "I");

?>

