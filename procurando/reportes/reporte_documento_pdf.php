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

        .normal {
            width:70px;
        }

        .departamento {
            width:140px;
        }
        
        .prioridad {
            width:70px;
        }
    </style>';
if ($_GET['id_estado']==clConstantesModelo::documento_entrada)
$html.='<table>
        <tr>
            <th class="nro">N°</th>
            <th >Documento</th>
            <th class="departamento">Departamento</th>
            <th class="normal">Evento</th>
            <th class="normal">Titulo</th>
            <th class="departamento">Entregado por</th>
            <th  class="departamento">Teléfono</th>            
            <th  class="normal">Estado</th>
         </tr>';
else 
$html.='<table>
        <tr>
            <th class="nro">N°</th>
            <th>Documento</th>
            <th class="departamento">Departamento</th>          
            <th class="normal">Evento</th>
            <th class="normal">Titulo</th>
            <th class="departamento">Dirigido</th>            
            <th class="departamento">Recibido</th>
            <th class="normal">Estado</th>
         </tr>';    
$count=0;
    $prodocumento= new clTblDocumento();
    $data= "";
    $data= $prodocumento->selectDocumentoReporte($_GET['id_tipo'], $_GET['id_evento'], $_GET['id_prioridad'],$_GET['id_estado'],$_GET['id_recordatorio'],$_GET['id_unidad'],$_GET['id_refiere'],$_GET['id_tipo_organismo'],$_GET['id_organismo']);
    if($data){  
//        print_r($data);
        foreach ($data as $key => $value) {

                $html.='<tr>';
                    $html.='<td class="nro">'.++$count.'</td>';
                    $html.='<td>'.$data[$key]['id_tipo_documento'].', N°: '.$data[$key]['strnumero'].'</td>';
                    $html.='<td class="departamento">'.$data[$key]['id_unidad_documento'].'</td>';
                    $html.='<td>'.$data[$key]['id_evento_documento'].'</td>';
                    $html.='<td>'.functions::decrypt($data[$key]['strtitulo']).'</td>';
                    if ($_GET['id_estado']==clConstantesModelo::documento_entrada)
                    {
                        $html.='<td>'.$data[$key]['strpersona'].', Día: '.$data[$key]['date'].'</td>';
                        $html.='<td>'.$data[$key]['strtelefono'].'</td>';                         
                    }
                    else 
                    {
                        $html.='<td>'.$data[$key]['strdirigido'].', Día: '.$data[$key]['date'].'</td>';
                        $html.='<td>'.$data[$key]['strrecibido'].'</td>';  
                    }
                    $html.='<td>'.$data[$key]['id_estado_documento'].'</td>';
                $html.="</tr>";

        }
        $html.='</table>';
    }
$pdf->SetY(50);
$pdf->writeHTML($html);
$pdf->Output("reporte_documento".date("d-M-Y-H:i:s").".pdf", "I");

?>
