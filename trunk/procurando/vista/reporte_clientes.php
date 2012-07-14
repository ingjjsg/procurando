<?php

    session_start();
    require_once ('../comunes/php/fpdf/html2fpdf.php');
    require_once '../modelo/clProClientes.php';
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
    }

    $cliente= new clProClientes();
    $data= $cliente->SelectAll($_REQUEST["id"]);
    $pdf= new PDF_MC_Table('P', 'mm', "letter", "", "", "");
    $pdf->SetMargins(10, 30, 10, 10);
    $pdf->SetAutoPageBreak(true, 30);
    $pdf->AddPage();
    $pdf->header('<table><tr><td></td></tr></table>');

    $pdf->SetFont('Arial', 'BI', 12);
    $pdf->Cell(0, 5, utf8_decode("Datos Del Cliente "), 0, 1, 'C');
    $pdf->Ln(5);

   
        $pdf->SetFont('Arial', '', 8);
        if(!empty($data)){
            $html= "<table  border='1' width='100%'>";
            
            $html.= "<tr>";
                $html.="<td width='18%' style='font-size:30px;'>Cedula:</td>";
                $html.="<td>".$data[0]['strcedula']."</td>";
                $html.="<td width='18%'>Nombre:</td>";
                $html.="<td>".$data[0]['strnombre']."</td>";
                $html.="<td width='18%'>Apellido:</td>";
                $html.="<td>".$data[0]['strapellido']."</td>";
            $html.="</tr>";
            
            $html.="<tr>";
                $html.="<td width='18%'>Estado:</td>";
                $html.="<td>". clFunciones::mostrarStritema($data[0]['id_estado'])."</td>";
                $html.="<td width='18%'>Municipio:</td>";
                $html.="<td colspan='3'>".  clFunciones::mostrarStritema($data[0]['id_municipio'])."</td>";
            $html.="</tr>";
            
            $html.="<tr>";
                $html.="<td width='18%'>Direccion:</td>";
                $html.="<td colspan='5'>".$data[0]['strdireccion']."</td>";
            $html.="</tr>";
            
            $html.="<tr>";
                $html.="<td width='18%'>Estado Civil:</td>";
                $html.="<td>". clFunciones::mostrarStritema($data[0]['id_estado_civil'])."</td>";
                $html.="<td width='18%'>Sexo:</td>";
                $html.="<td colspan='3'>".  clFunciones::mostrarStritema($data[0]['id_sexo'])."</td>";
            $html.="</tr>";
            
            $html.="<tr>";
                $html.="<td width='18%'>Fecha Nacimiento:</td>";
                $html.="<td>".$data[0]['datefecnac']."</td>";
                $html.="<td width='18%'>Telefono:</td>";
                $html.="<td>".$data[0]['strtelefono']."</td>";
                $html.="<td width='18%'>Email:</td>";
                $html.="<td>".$data[0]['stremail']."</td>";
            $html.="</tr>";
            $html.="</table>";
                     
        }

        $pdf->WriteHTML($html);
	$pdf->AliasNbPages();
	$pdf->Output('../comunes/temp/Reporte_Cliente.pdf');
        header('Location: ../comunes/temp/Reporte_Cliente.pdf');
?>
