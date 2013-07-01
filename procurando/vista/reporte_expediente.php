<?php

    session_start();
    require_once ('../comunes/php/fpdf/html2fpdf.php');
    require_once '../modelo/ctblproexpedienteModelo.php';
    require_once '../comunes/php/utilidades.php';
    require_once '../modelo/clFunciones.php';

    verificarSession();

    class PDF_MC_Table extends HTML2FPDF{
        var $widths;
        var $aligns;    

        function SetWidths($w){
            //Set the array of column widths
            $this->widths=$w;
        }

        function SetAligns($a){
            //Set the array of column alignments
            $this->aligns=$a;
        }

        function Row($data){
            //Calculate the height of the row
            $nb=0;
            for($i=0;$i<count($data);$i++){
                $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
            }
            $h=5*$nb;
            //Issue a page break first if needed
            $this->CheckPageBreak($h);
            //Draw the cells of the row
            for($i=0;$i<count($data);$i++){
                $w=$this->widths[$i];
                $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
                //Save the current position
                $x=$this->GetX();
                $y=$this->GetY();
                //Draw the border
                $this->Rect($x,$y,$w,$h,'DF');
                //Print the text
                $this->MultiCell($w,5,$data[$i],0,$a,0);
                //Put the position to the right of the cell
                $this->SetXY($x+$w,$y);
            }
            //Go to the next line
            $this->Ln($h);
        }

        function CheckPageBreak($h){
            //If the height h would cause an overflow, add a new page immediately
            if($this->GetY()+$h>$this->PageBreakTrigger){
                $this->AddPage($this->CurOrientation);
            }
        }

        function NbLines($w,$txt){
            //Computes the number of lines a MultiCell of width w will take
            $cw=&$this->CurrentFont['cw'];
            if($w==0){
                $w=$this->w-$this->rMargin-$this->x;
            }
            $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
            $s=str_replace("\r",'',$txt);
            $nb=strlen($s);
            if($nb>0 and $s[$nb-1]=="\n"){
                $nb--;
            }
            $sep=-1;
            $i=0;
            $j=0;
            $l=0;
            $nl=1;
            while($i<$nb){
                $c=$s[$i];
                if($c=="\n"){
                    $i++;
                    $sep=-1;
                    $j=$i;
                    $l=0;
                    $nl++;
                    continue;
                }
                if($c==' '){
                    $sep=$i;
                }
                $l+=$cw[$c];
                if($l>$wmax){
                    if($sep==-1){
                        if($i==$j){
                            $i++;
                        }
                    }else{
                        $i=$sep+1;
                    }
                    $sep=-1;
                    $j=$i;
                    $l=0;
                    $nl++;
                }else{
                    $i++;
                }
            }
            return $nl;
        }
        
        function verDocumentos($id_menu_maestro, $strdocumentos) {
        //exit($strdocumentos);
        $maestro= new clMaestroModelo();
       // $expediente= new clProExpediente();
        $data= "";
        $html= "";
        if($id_menu_maestro != 0){
            $data= $maestro->selectAllMaestroHijos($id_menu_maestro, 'id_maestro');
            //$dataAcc= $expediente->selectDocumentos($id_expediente);
            $dataAcc= $strdocumentos;
            if($dataAcc){
//                $respuesta->script("document.frmAsignar.id_accesoforma.value= ".$dataAcc[0]['id_accesoforma']);
//                $respuesta->script("document.frmAsignar.accion.value= 'ACT'");
                $straccion= split(",", $dataAcc);
            }else{
//                $respuesta->script("document.frmAsignar.accion.value= 'INS'");
            }
            $html= "<table class='tablaTitulo' bgcolor='#f8f8f8' width='90%'>";
            $html.= "<tr><th width='85%'>Documentos</th>";
            $html.= "<th width='15%'>Consignado</th></tr>";
            if($data){
                //exit($straccion[0]." = ". $data[0]['id_maestro']);
                for ($i= 0; $i < count($data); $i++){
                    $html.= "<tr>";
                    $html.= "<td width='85%'>".utf8_decode($data[$i]['stritema'])."</td>";
                    $check= "";
                    $html.="";
                    for ($x= 0; $x < (count($straccion)-1); $x++){
                        //exit($straccion[$x]."=".$data[$i]['id_maestro']);
                        
                        if($straccion[$x] == $data[$i]['id_maestro']){
                            $html.="<td width='15%' align='center'>Si</td>";
                        }
                        
                    }
                    $html.= "</tr>";
                    
                }
                $html.= "</table>";
            }
        }
       // exit($html);
        
        return $html;
    }
    }

    $cliente= new clProExpediente();
    $data= $cliente->SelectExpediente($_REQUEST["id"]);
 
    $pdf= new PDF_MC_Table('P', 'mm', "letter", "", "", "");
    $pdf->SetMargins(10, 30, 10, 10);
    $pdf->SetAutoPageBreak(true, 30);
    $pdf->AddPage();
       
    $pdf->header('<table><tr><td></td></tr></table>');

    $pdf->SetFont('Arial', 'BI', 12);
    $pdf->Cell(0, 5, utf8_decode("Datos Del Expediente "), 0, 1, 'C');
    $pdf->Ln(5);

   
        $pdf->SetFont('Arial', '', 8);
        if(!empty($data)){
            $html= "<table  border='1' width='100%'>";
            $html.= "<tr>";
                $html.="<td width='18%' style='font-size:30px;'>Expediente:</td>";
                $html.="<td>".$data[0]['strnroexpediente']."</td>";
                $html.="<td width='18%'>Referencia:</td>";
                $html.="<td>".utf8_decode($data[0]['strrefer'])."</td>";
                $html.="<td width='18%'>Fecha Expediente:</td>";
                $html.="<td>".$data[0]['fecexpediente']."</td>";
            $html.="</tr>";
            
            $html.="<tr>";
                $html.="<td width='18%'>Tipo Tramite:</td>";
                $html.="<td>". utf8_decode(clFunciones::mostrarStritema($data[0]['id_tipo_tramite']))."</td>";
                $html.="<td width='18%'>Actuacion:</td>";
                $html.="<td>".  utf8_decode(clFunciones::mostrarStritema($data[0]['id_actuacion']))."</td>";
                $html.="<td width='18%'>Fecha Apertura:</td>";
                $html.="<td>". $data[0]['fecapertura']."</td>";
            $html.="</tr>";
            
            $html.="<tr>";
                $html.="<td width='18%'>Tipo Organismo:</td>";
                $html.="<td>".  utf8_decode(clFunciones::mostrarStritema($data[0]['id_tipo_organismo']))."</td>";
                $html.="<td width='18%'>Organismo:</td>";
                $html.="<td colspan='3'>".  utf8_decode(clFunciones::mostrarStritema($data[0]['id_organismo']))."</td>";
            $html.="</tr>";
            
            
            $html.="</table>";
            
            $pdf->WriteHTML($html);
            
            $pdf->SetFont('Arial', 'BI', 12);
            $pdf->Cell(0, 5, utf8_decode("Situaciones "), 0, 1, 'C');
            $pdf->Ln(5);
            
            $pdf->SetFont('Arial', '', 8);
            $html2= "<table  border='1' width='100%'>";
            $html2.= "<tr>";
                $html2.="<td width='18%' style='font-size:30px;'>Tipo Minuta:</td>";
                $html2.="<td>".  utf8_decode(clFunciones::mostrarStritema($data[0]['id_tipo_minuta']))."</td>";
                $html2.="<td width='18%'>Minuta:</td>";
                $html2.="<td colspan='3'>".  utf8_decode(clFunciones::mostrarStritema($data[0]['id_minuta']))."</td>";
                
            $html2.="</tr>";
            
            $html2.= "<tr>";
                $html2.="<td width='18%' style='font-size:30px;'>Observaciones:</td>";
                $html2.="<td colspan='5'>". utf8_decode($data[0]['strobservacion'])."</td>";
           
            $html2.="</tr>";
            
            
            
            $html2.="</table>";
            
            $pdf->WriteHTML($html2);
            
            $pdf->SetFont('Arial', 'BI', 12);
            $pdf->Cell(0, 5, utf8_decode("Documentos "), 0, 1, 'C');
            $pdf->Ln(5);
            
            $pdf->SetFont('Arial', '', 8);
            //exit($data[0]['id_tipo_tramite']."=".$data[0]['strdocumentos']);
            $html3=$pdf->verDocumentos($data[0]['id_tipo_tramite'], $data[0]['strdocumentos']);
              
            $pdf->WriteHTML($html3);
        }

        
	$pdf->AliasNbPages();
	$pdf->Output('../comunes/temp/Reporte_Expediente.pdf');
        header('Location: ../comunes/temp/Reporte_Expediente.pdf');
?>
