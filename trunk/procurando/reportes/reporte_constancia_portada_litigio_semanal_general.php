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
$pdf->SetFont('Helvetica','B',8);
$pdf->setTitulo("");
$pdf->AddPage();

            
            
    $prodocumento= new clActuaciones();
    $data= "";
    $data= $prodocumento->SelectExpedienteCompletoReporte($_GET['id_origen'],$_GET['id_motivo'],$_GET['id_fase'], $_GET['id_actuacion_persona'],$_GET['id_tipo_organismo_centralizado'],$_GET['id_tipo_organismo'],$_GET['strnroexpediente'],$_GET['strnroexpedienteauxiliar']);

    
//    exit(print_r($data));
    $c=0;
    if($data){
      for ($i= 0; $i < count($data); $i++){
            $html.='
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
                         text-indent: 8px;
                    }
                </style>';          
                $html.='<table>';
                $html.='<tr>';
                    $html.='<th align="center" colspan="4">'.strtoupper($data[$i]['strdescripcion']).'</th>';
                $html.='</tr>';             
                $html.='<tr>';
                    $html.='<th class="titulo">FECHA APERTURA</th>';
                    $html.='<td>'.$data[$i]['fecapertura'].'</td>';
                    $html.='<th  class="titulo"></th>';
                    $html.='<td ></td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html.='<th align="left" colspan="1" class="titulo">ORIGEN DE LA CAUSA</th>';
                    $html.='<td colspan="3" >'.$data[$i]['origen'].'</td>';
                $html.='</tr>';  
                $html.='<tr>';
                    $html.='<th align="left" colspan="1" class="titulo">MOTIVO DE LA CAUSA</th>';
                    $html.='<td colspan="3" >'.$data[$i]['motivo'].'</td>';
                $html.='</tr>';     
                $html.='<tr>';
                    $html.='<th class="titulo">FASE DEL ORIGEN</th>';
                    $html.='<td>'.$data[$i]['fase'].'</td>';
                    $html.='<th class="titulo" >ACTUA COMO</th>';
                    $html.='<td >'.$data[$i]['actuacion'].'</td>';
                $html.='</tr>';        
                $html.='<tr>';
                    $html.='<th class="titulo">N° EXPEDIENTE</th>';
                    $html.='<td>'.$data[$i]['strnroexpediente'].'</td>';
                    $html.='<th class="titulo" >EXPEDIENTE TRIBUNAL</th>';
                    $html.='<td >'.$data[$i]['strnroexpedienteauxiliar'].'</td>';
                $html.='</tr>';  
                if ($data['0']['id_actuacion']==clConstantesModelo::demandantes) $text='DEMANDANDADOS'; else $text='DEMANDANTES';
                $html.='<tr>';
                    $html.='<th  class="titulo" colspan="4">'.$text.'</th>';
                $html.='</tr>'; 
                $data_demanda= $prodocumento->SelectExpedienteDemandaReporte($data[$i]['id_proactuacion']);
                if($data_demanda){
                    $html.='<tr>';
                    $html.='<th width="10%" align="center" bgcolor="#D8D8D8" class="nro">N°</th>
                           <th width="20%" align="center" bgcolor="#D8D8D8" >CÉDULAS</th>                        
                           <th width="70%" align="center" bgcolor="#D8D8D8" class="nro">NOMBRES</th>';
                    $html.='</tr>';        
                           $a=1;                    
                           foreach ($data_demanda as $key => $value) {
                              $html.='<tr>';
                              $html.='<td width="10%" align="center" >'.$a.'</td>';
                              $html.='<td width="20%" align="left">'.$data_demanda[$key]['cedula'].'</td>';
                              $html.='<td width="70%" align="left" >'.$data_demanda[$key]['nombre_contrario'].'</td>';
                              $html.="</tr>";
                              $a++;
                    }   
                }       
                if ($data[$i]['id_actuacion']==clConstantesModelo::demandantes) $text='DEMANDANDADOS'; else $text='DEMANDANTES';
                $html.='<tr>';
                    $html.='<th  class="titulo" colspan="3">ABOGADOS DE LOS '.$text.'</th>';
                $html.='</tr>'; 
              
                $data_demanda_abogados= $prodocumento->SelectExpedienteDemandaAbogadosReporte($data[$i]['id_proactuacion']);    
                if($data_demanda_abogados){
                   $html.='<tr>
                           <th width="10%" align="center" bgcolor="#D8D8D8" class="nro">N°</th>
                           <th width="20%" align="center" bgcolor="#D8D8D8" >CÉDULAS</th>
                           <th width="70%" align="center" bgcolor="#D8D8D8" class="nro">NOMBRES</th>
                           </tr>'; 
                           $b=1;
                             foreach ($data_demanda_abogados as $key2 => $value) 
                             {
                               $html.='<tr>';
                               $html.='<td width="10%" align="center" >'.$b.'</td>';
                               $html.='<td width="20%" align="left">'.$data_demanda_abogados[$key2]['cedula'].'</td>';
                               $html.='<td width="70%" align="left" >'.$data_demanda_abogados[$key2]['nombre_contrario'].'</td>';
                               $html.="</tr>";
                               $b++;                               
                             }   
                }       
           
                if ($data[$i]['id_actuacion']==clConstantesModelo::demandantes) $text_dos='DEMANDANTE'; else $text_dos='DEMANDANDADO';

                $html.='<tr>';
                    $html.='<th  class="titulo" colspan="3">ORGANISMO '.$text_dos.'</th>';
                $html.='</tr>';        
                $html.='<tr>';
                    $html.='<th align="left" colspan="1" class="titulo">TIPO DE ORGANISMO</th>';
                    $html.='<td colspan="2" >'.$data[$i]['tipo_organismo_centralizado'].'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html.='<th align="left" colspan="1" class="titulo">ORGANISMO</th>';
                    $html.='<td colspan="2" >'.$data[$i]['tipo_organismo'].'</td>';
                $html.='</tr>'; 
                $html.='<tr>
                       <th width="10%" align="center" bgcolor="#D8D8D8" class="nro">CUANTIA</th>
                       <th width="20%" align="center" bgcolor="#D8D8D8" class="nro">SENTENCIADO</th>                       
                       <th width="20%" align="center" bgcolor="#D8D8D8" >TRANSADO</th>
                       <th width="50%" align="center" bgcolor="#D8D8D8" class="nro">AHORRADO</th>
                       </tr>'; 
                $html.='<tr>';
                $html.='<td width="10%" align="center" >'.clFunciones::FormatoMonto($data[$i]['intcuantias']).'</td>';
                $html.='<td width="20%" align="left">'.clFunciones::FormatoMonto($data[$i]['intsentenciado']).'</td>';
                $html.='<td width="20%" align="left" >'.clFunciones::FormatoMonto($data[$i]['inttranzado']).'</td>';
                $html.='<td width="50%" align="left" >'.clFunciones::FormatoMonto($data[$i]['intahorrado']).'</td>';
                $html.="</tr>";
        $html.='</table>';
        $pdf->writeHTML($html);        
        $html='';        
               $c++; 
               if ($c>1) 
               {
                   $c=0;
                   $pdf->AddPage();
               }
            } 
    }
$pdf->SetY(50);
//$pdf->writeHTML($html);
$pdf->Output("portada_litigio_individual".date("d-M-Y-H:i:s").".pdf", "I");

?>
