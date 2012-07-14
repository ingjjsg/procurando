<?php
    session_start();
    require_once ('../comunes/php/fpdf/html2fpdf.php');
    require_once '../modelo/clRutaCorrespondenciaModelo.php';
    require_once '../modelo/clCorrespondenciaModelo.php';
    require_once '../comunes/php/utilidades.php';

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

    $rutaCorrespondencia= new clRutaCorrespondenciaModelo();
    $correspondencia= new clCorrespondenciaModelo();
    $data= $rutaCorrespondencia->selectRutaCorrespondenciaByIdCorresp($_REQUEST["id"]);
 $dataCorresp= $correspondencia->selectAllCorrespondenciaById($_REQUEST["id"]);

    $pdf= new PDF_MC_Table('P', 'mm', "letter", "", "", "");
	$pdf->SetMargins(10, 30, 10, 10);
    $pdf->SetAutoPageBreak(true, 30);
    $pdf->AddPage();
    $pdf->header('<table><tr><td></td></tr></table>');

    $pdf->SetFont('Arial', 'BI', 12);
    $pdf->Cell(0, 5, utf8_decode("Seguimientos de la Correspondencia ".$dataCorresp[0]['strcorrelativo']." (Id: ".$_REQUEST["id"].")"), 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetWidths(array(35, 161));
    $pdf->SetAligns(array('C', 'C'));
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Row(array('Fecha y Hora', utf8_decode("Acción")));

    for($i= 0; $i < count($data); $i++){
        $accion= "";

        $accion= $data[$i]['nombre_contacto']." <b>".$data[$i]['nombre_estatus_maestro']."</b>";

        if($data[$i]['id_estatus_maestro'] == 234 || $data[$i]['id_estatus_maestro'] == 235 || $data[$i]['id_estatus_maestro'] == 236 || $data[$i]['id_estatus_maestro'] == 237 || $data[$i]['id_estatus_maestro'] == 255){
            $accion.= " el documento: ";
        }else if($data[$i]['id_estatus_maestro'] == 256 || $data[$i]['id_estatus_maestro'] == 257 || $data[$i]['id_estatus_maestro'] == 258 || $data[$i]['id_estatus_maestro'] == 259 || $data[$i]['id_estatus_maestro'] == 260 || $data[$i]['id_estatus_maestro'] == 261 || $data[$i]['id_estatus_maestro'] == 262){
            $accion.= " la actividad: ";
        }
        if($data[$i]['id_estatus_maestro'] == 234 || $data[$i]['id_estatus_maestro'] == 235 || $data[$i]['id_estatus_maestro'] == 236 || $data[$i]['id_estatus_maestro'] == 237 || $data[$i]['id_estatus_maestro'] == 255){
            if($data[$i]['strcorrelativo'] != ""){
                $accion.= $data[$i]['strcorrelativo'];
            }
            $accion.= "(Id: ".$data[$i]['id_corresp'].") <br>";
        }
        $accion.= $data[$i]['memrutacorresp'];

        $pdf->SetFont('Arial', '', 8);
        if(!$valor){
            $html= "<table border='1' width='100%'>";
            $html.= "<tr><td width='18%'>".$data[$i]['fecha_ruta']." | ".$data[$i]['hora_ruta']."</td>";
            $valor= true;
        }else{
            $html= "<tr><td width='18%'>".$data[$i]['fecha_ruta']." | ".$data[$i]['hora_ruta']."</td>";
        }


        $html.= "<td width='82%'>".utf8_decode($accion)."</td></tr>";
        $pdf->WriteHTML($html);
    }
    $pdf->WriteHTML("</table>");
	$pdf->AliasNbPages();
	$pdf->Output('../comunes/temp/Reporte_Seguimiento.pdf');
    header('Location: ../comunes/temp/Reporte_Seguimiento.pdf');
   //exit;

?>
