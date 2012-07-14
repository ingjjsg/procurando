<?php
require_once 'plantilla_reporte.php';
require_once '../modelo/ctbldocumentoModelo.php';
require_once '../modelo/clFunciones.php'; 
require_once '../herramientas/herramientas.class.php'; 

//$data=  unserialize(stripslashes($_GET['data']));
$pdf=new Plantilla("L");
$pdf->setTitulo("Documentos");
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
            <th>Documento</th>
            <th class="departamento">Departamento</th>
            <th>Evento</th>
            <th>Titulo</th>
            <th class="prioridad">Prioridad</th>
            <th>Estado</th>
            <th>Días</th>
         </tr>';
$count=0;
    $prodocumento= new clTblDocumento();
    $data= "";
    $data= $prodocumento->selectDocumentoReporte($_GET['id_tipo'], $_GET['id_evento'], $_GET['id_prioridad'],$_GET['id_estado'],$_GET['id_recordatorio'],$_GET['id_unidad'],$_GET['id_refiere'],$_GET['id_tipo_organismo'],$_GET['id_organismo']);
    if($data){    
        foreach ($data as $key => $value) {

                $html.='<tr>';
                    $html.='<td class="nro">'.++$count.'</td>';
                    $html.='<td>'.$data[$key]['id_tipo_documento'].'</td>';
                    $html.='<td class="departamento">'.$data[$key]['id_unidad_documento'].'</td>';
                    $html.='<td>'.$data[$key]['id_evento_documento'].'</td>';
                    $html.='<td>'.functions::decrypt($data[$key]['strtitulo']).'</td>';
                    $html.='<td class="prioridad centrado">'.$data[$key]['id_prioridad_documento'].'</td>';
                    $html.='<td>'.$data[$key]['id_estado_documento'].'</td>';
                    $html.='<td>0</td>';
                $html.="</tr>";

        }
        $html.='</table>';
    }
$pdf->SetY(40);
$pdf->writeHTML($html);
$pdf->Output("reporte_documento".date("d-M-Y-H:i:s").".pdf", "I");

?>
