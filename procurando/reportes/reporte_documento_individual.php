<?php
require_once 'plantilla_reporte.php';
require_once '../modelo/ctbldocumentoModelo.php';
require_once '../modelo/clFunciones.php'; 
require_once '../herramientas/herramientas.class.php'; 

//$data=  unserialize(stripslashes($_GET['data']));
$pdf=new Plantilla("P");
$pdf->setTitulo("Documento");
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

    ';
    $prodocumento= new clTblDocumento();
    $data= "";
    $data= $prodocumento->selectDocumentoIndividualReporte($_GET['id']);
    if($data){    
        $html.='<table>';
        $html.='<tr>';
            $html.='<th>Documento</th>';
            $html.='<td>'.$data['0']['id_tipo_documento'].'</td>';
            $html.='<th >Departamento</th>';
            $html.='<td >'.$data['0']['id_unidad_documento'].'</td>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th>Evento</th>';
            $html.='<td>'.$data['0']['id_evento_documento'].'</td>';
            $html.='<th >Titulo</th>';
            $html.='<td >'.functions::decrypt($data['0']['strtitulo']).'</td>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th colspan="4">Descripcion</th>';
        $html.='</tr>';
        
        $html.='<tr>';
            $html.='<td colspan="4">'.functions::decrypt($data['0']['strtitulo']).'</td>';
        $html.='</tr>';
        
          /*  $html.='<th>Evento</th>';
            $html.='<th>Titulo</th>';
            $html.='<th class="prioridad">Prioridad</th>';
            $html.='<th>Estado</th>';
            $html.='<th>Días</th>';*/
       /*  $html.='</tr>';
                $html.='<tr>';
                    $html.='<td class="nro">'.++$count.'</td>';
                    $html.='<td>'.$data[$key]['id_tipo_documento'].'</td>';
                    $html.='<td class="departamento">'.$data[$key]['id_unidad_documento'].'</td>';
                    $html.='<td>'.$data[$key]['id_evento_documento'].'</td>';
                    $html.='<td>'.functions::decrypt($data[$key]['strtitulo']).'</td>';
                    $html.='<td class="prioridad centrado">'.$data[$key]['id_prioridad_documento'].'</td>';
                    $html.='<td>'.$data[$key]['id_estado_documento'].'</td>';
                    $html.='<td>0</td>';
                $html.="</tr>";*/

        
        $html.='</table>';
    }
$pdf->SetY(40);
$pdf->writeHTML($html);
$pdf->Output("reporte_documento_individual".date("d-M-Y-H:i:s").".pdf", "I");

?>
