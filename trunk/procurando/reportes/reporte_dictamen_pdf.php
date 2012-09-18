<?php
require_once 'plantilla_reporte.php';
require_once '../modelo/clDictamenesModelo.php';
require_once '../modelo/clFunciones.php'; 
require_once '../herramientas/herramientas.class.php'; 

//$data=  unserialize(stripslashes($_GET['data']));
$pdf=new Plantilla("L");
$pdf->setTitulo("REPORTE DE DICTAMENES");
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
            background=#D8D8D8;
        }

        .departamento {
            width:140px;
            background=#D8D8D8;
        }
        
        .prioridad {
            width:70px;
        }
    </style>';
$html='<table>
        <tr>
            <th class="normal">N°</th>
            <th class="departamento">TIPO MATERIA</th>          
            <th class="departamento">TEMA</th>
            <th class="departamento">TIPO DE ORGANISMO</th>
            <th class="departamento">ORGANISMO</th>            
            <th class="normal">TITULO</th>
            <th class="normal">NUMERO</th>
         </tr>';    
$count=0;
    $prodictamen= new clTbldictamenes();
    $data= "";
    $data= $prodictamen->selectFiltrarDictamen($_GET['id_materia'], $_GET['id_tipo_materia'], $_GET['id_tipo_organismo'],$_GET['id_organismo'],$_GET['id_estado'],$_GET['strtitulo'],$_GET['stranrodictamen'],$_GET['strpersonas']);
    if($data){  
        foreach ($data as $key => $value) {

                $html.='<tr>';
                    $html.='<td>'.++$count.'</td>';
                    $html.='<td class="departamento">'.$data[$key][id_materia_text].'</td>';
                    $html.='<td class="departamento">'.$data[$key][id_tipo_materia_text].'</td>';
                    $html.='<td class="departamento">'.$data[$key][id_tipo_organismo_text].'</td>';
                    $html.='<td class="departamento">'.$data[$key][id_organismo_text].'</td>';
                    $html.='<td>'.$data[$key][strtitulo].'</td>';
                    $html.='<td>'.$data[$key][stranrodictamen].'</td>';
                $html.="</tr>";

        }
        $html.='</table>';
    }
$pdf->SetY(40);
$pdf->writeHTML($html);
$pdf->Output("reporte_dictamen".date("d-M-Y-H:i:s").".pdf", "I");

?>
