<?php
session_start();
require_once 'plantilla_reporte.php';
require_once '../modelo/clActuacionesModelo.php';
require_once '../modelo/clMaestroModelo.php';
require_once '../modelo/clFunciones.php'; 
require_once '../herramientas/herramientas.class.php';
require_once '../modelo/clConstantesModelo.php';

//exit(clMaestroModelo::getJefeCoordinacion());


//$data=  unserialize(stripslashes($_GET['data']));

          
$pdf=new Plantilla("L");
$pdf->setTitulo("");
$pdf->AddPage();

$html='
    <style>
        table, td, th {
            border: 1px solid #000; 
            line-height: normal;
            text-align:left;
        }
        
        tr>th {
            text-align:left;
        }
        
        .titulo {
            background-color:#d2cfcf;
            font-weight: bold;            
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
        
        .align{
             text-align:justify;
             text-indent: 10px;
        }
    </style>

    ';
    $prodocumento= new clActuaciones();
    $data= "";
    $data= $prodocumento->SelectExpedienteReporte($_GET['id']);
    $data_demanda= $prodocumento->SelectExpedienteDemandaReporte($_GET['id']);
    $data_demanda_abogados= $prodocumento->SelectExpedienteDemandaAbogadosReporte($_GET['id']);    
    
//    exit(print_r($data));
    if($data){    
        $html.='<table>';
        $html.='<tr>';
            $html.='<th align="center" colspan="4">DIRECCIÓN DE LITIGIO</th>';
        $html.='</tr>';             
//        $html.='<tr>';
//            $html.='<th class="titulo">FECHA APERTURA</th>';
//            $html.='<td>'.$data['0']['fecapertura'].'</td>';
//            $html.='<th  class="titulo"></th>';
//            $html.='<td ></td>';
//        $html.='</tr>';
        $html.='<tr>';
            $html.='<th class="titulo">ORIGEN DE LA CAUSA</th>';
            $html.='<td>'.$data['0']['origen'].'</td>';
            $html.='<th class="titulo" >MOTIVO DE LA CAUSA</th>';
            $html.='<td >'.$data['0']['motivo'].'</td>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th class="titulo">FASE DEL ORIGEN</th>';
            $html.='<td>'.$data['0']['fase'].'</td>';
            $html.='<th class="titulo" >ACTUA COMO</th>';
            $html.='<td >'.$data['0']['actuacion'].'</td>';
        $html.='</tr>';        
        $html.='<tr>';
            $html.='<th class="titulo">N° EXPEDIENTE</th>';
            $html.='<td>'.$data['0']['strnroexpediente'].'</td>';
            $html.='<th class="titulo" >EXPEDIENTE TRIBUNAL</th>';
            $html.='<td >'.$data['0']['strnroexpedienteauxiliar'].'</td>';
        $html.='</tr>';  
        if ($data['0']['id_actuacion']==clConstantesModelo::demandantes) $text='DEMANDANDADOS'; else $text='DEMANDANTES';
        $html.='<tr>';
            $html.='<th  class="titulo" colspan="4">'.$text.'</th>';
        $html.='</tr>'; 
        $i=0;
        $html.='</table>
                <table>
                    <tr>
                        <th width="10%" align="center" bgcolor="#D8D8D8" class="nro">N°</th>
                        <th width="20%" align="center" bgcolor="#D8D8D8" >CÉDULAS</th>                        
                        <th width="70%" align="center" bgcolor="#D8D8D8" class="nro">NOMBRES</th>
                     </tr>';        
                    if($data_demanda){
                     foreach ($data_demanda as $key => $value) {

                            $html.='<tr>';
                            $i++;
                                $html.='<td width="10%" align="center" >'.$i.'</td>';
                                $html.='<td width="20%" align="left">'.$data_demanda[$key]['cedula'].'</td>';
                                $html.='<td width="70%" align="left" >'.$data_demanda[$key]['nombre_contrario'].'</td>';
                            $html.="</tr>";

            }   
        }       
        $html.='</table>
                <table>';        
        if ($data['0']['id_actuacion']==clConstantesModelo::demandantes) $text='DEMANDANDADOS'; else $text='DEMANDANTES';
        $html.='<tr>';
            $html.='<th  class="titulo" colspan="4">ABOGADOS DE LOS '.$text.'</th>';
        $html.='</tr>'; 
        $i=0;
        $html.='</table>
                <table>
                    <tr>
                        <th width="10%" align="center" bgcolor="#D8D8D8" class="nro">N°</th>
                        <th width="20%" align="center" bgcolor="#D8D8D8" >CÉDULAS</th>
                        <th width="70%" align="center" bgcolor="#D8D8D8" class="nro">NOMBRES</th>
                        
                     </tr>';        
                    if($data_demanda_abogados){
                     foreach ($data_demanda_abogados as $key2 => $value) {

                            $html.='<tr>';
                            $i++;
                                $html.='<td width="10%" align="center" >'.$i.'</td>';
                                $html.='<td width="20%" align="left">'.$data_demanda_abogados[$key2]['cedula'].'</td>';
                                $html.='<td width="70%" align="left" >'.$data_demanda_abogados[$key2]['nombre_contrario'].'</td>';
                            $html.="</tr>";

            }   
        }       
        $html.='</table>
                <table>';           
        $html.='<tr>';
            $html.='<th  class="titulo" colspan="4"></th>';
        $html.='</tr>';     
        if ($data['0']['id_actuacion']==clConstantesModelo::demandantes) $text_dos='DEMANDANTE'; else $text_dos='DEMANDANDADO';
        
        $html.='<tr>';
            $html.='<th  class="titulo" colspan="4">ORGANISMO '.$text_dos.'</th>';
        $html.='</tr>';        
        $html.='<tr>';
            $html.='<th class="titulo">TIPO DE ORGANISMO</th>';
            $html.='<td>'.$data['0']['tipo_organismo_centralizado'].'</td>';
            $html.='<th class="titulo" >ORGANISMO</th>';
            $html.='<td >'.$data['0']['tipo_organismo'].'</td>';
        $html.='</tr>';          
        $html.='<tr>';
            $html.='<th  class="titulo" colspan="4">CUANTIA</th>';
        $html.='</tr>';
        $html.='<tr>';
            $html.='<th colspan="4">'.clFunciones::FormatoMonto($data['0']['intcuantias']).'   BSF</th>';
        $html.='</tr>'; 
//        $html.='<tr>';
//            $html.='<th  class="titulo" colspan="4">DIRECCIÓN DE HABITACIÓN</th>';
//        $html.='</tr>';
//        $html.='<tr>';
//            $html.='<th colspan="4">'.$data['0']['strdireccion'].'</th>';
//        $html.='</tr>';   
//        $html.='<tr>';
//            $html.='<th  class="titulo" colspan="4">ESTADO</th>';
//        $html.='</tr>';
//        $html.='<tr>';
//            $html.='<th colspan="4">'.$data['0']['id_estado'].'</th>';
//        $html.='</tr>'; 
//        $html.='<tr>';
//            $html.='<th  class="titulo" colspan="4">MUNICIPIO</th>';
//        $html.='</tr>';
//        $html.='<tr>';
//            $html.='<th colspan="4">'.$data['0']['id_municipio'].'</th>';
//        $html.='</tr>';         
//        $html.='<tr>';
//            $html.='<th  class="titulo" colspan="4">ORGANISMO</th>';
//        $html.='</tr>';
//        $html.='<tr>';
//            $html.='<th colspan="4">'.$data['0']['id_tipo_organismo'].'->'.$data['0']['id_organismo'].'</th>';
//        $html.='</tr>';          
//        $html.='<tr>';
//            $html.='<th class="titulo" colspan="4">DATOS OFICINA DE ATENCIÓN AL SOBERANO</th>';
//        $html.='</tr>';        
//        $html.='<tr>';
//            $html.='<th class="titulo">USUARIO</th>';
//            $html.='<td>'.$data['0']['id_abogado_resp'].'</td>';
//            $html.='<th class="titulo" >ATENDIDO POR</th>';
//            $html.='<td >'.strtoupper(clMaestroModelo::getSecretariaCoordinacion()).'</td>';
//        $html.='</tr>';         
//        $html.='<tr>';
//            $html.='<th class="titulo">FIRMA</th>';
//            $html.='<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
//            $html.='<th class="titulo" >FIRMA</th>';
//            $html.='<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
//        $html.='</tr>';          
//        $html.='<tr>';
//            $html.='<th class="titulo">ABOGADO EJECUTOR</th>';
//            $html.='<td>'.$data['0']['id_abogado_ejecutor'].'</td>';
//            $html.='<th class="titulo" >JEFE DE LA UNIDAD</th>';
//            $html.='<td >'.strtoupper(clMaestroModelo::getJefeCoordinacion()).'</td>';
//        $html.='</tr>';  
//        $html.='<tr>';
//            $html.='<th class="titulo">FIRMA</th>';
//            $html.='<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
//            $html.='<th class="titulo" >FIRMA</th>';
//            $html.='<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
//        $html.='</tr>';           
//        $html.='<tr>';
//        $html.='<th colspan="4"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
//                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
//                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SELLO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>';
//        $html.='</tr>';        
        $html.='</table>';
        
    }
$pdf->SetY(50);
$pdf->writeHTML($html);
$pdf->Output("portada_litigio_individual".date("d-M-Y-H:i:s").".pdf", "I");

?>
