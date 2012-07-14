<?php
    include_once ('../comunes/php/fpdf/html2fpdf.php');
    include_once ('../comunes/php/utilidades.php');
    require_once '../modelo/clCorrespondenciaModelo.php';
    require_once '../modelo/clDestinatariosModelo.php';
    require_once '../modelo/clActividadesModelo.php';
    require_once '../modelo/clContactoActividadModelo.php';
    require_once '../modelo/clDetalleContactoActividadModelo.php';

    $correspondencia= new clCorrespondenciaModelo();
    $destinatarios= new clDestinatariosModelo();
    $actividad= new clActividadesModelo();
    $contactoActividad= new clContactoActividadModelo();
    $detalleContactoActividad= new clDetalleContactoActividadModelo();

    $dataActividad= $actividad->selectActividadById($_REQUEST['id']);
    $dataDestinatario= $destinatarios->selectAllDestinatariosById($dataActividad[0]['id_destinatarios']);
    $dataCorrespondencia= $correspondencia->selectAllCorrespondenciaById($dataDestinatario[0]['id_corresp']);
    $dataContactoActividad= $contactoActividad->selectContactosActividadByIdActividad($_REQUEST['id'], $_SESSION['id_dpto_maestro']);

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

    $pdf= new PDF_MC_Table('P', 'mm', "letter", "", "", "");
	$pdf->SetMargins(10, 10, 10, 10);
    $pdf->SetAutoPageBreak(true, 30);
    $pdf->AddPage();
    $pdf->Header('<table><tr><td></td></tr></table>');

    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'BI', 12);
    $pdf->Cell(0, 4, utf8_decode("Resultados de la Actividad ".$dataActividad[0]['memtitulo']." (Id: ".$dataActividad[0]['id_actividad'].")"), 0, 1, 'C');
    $pdf->Ln();
    $pdf->SetFont('Arial', 'BI', 12);
    $pdf->Cell(0, 4, utf8_decode("Correspondencia ".$dataCorrespondencia[0]['strcorrelativo']), 0, 1, 'C');
    $pdf->Ln(8);

    if($dataContactoActividad[0]['id_contactoactividad'] != ""){
        for($i= 0; $i < count($dataContactoActividad); $i++){
            
            $pdf->SetFillColor(220, 220, 220);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(80, 4, utf8_decode("Analista: ".$dataContactoActividad[$i]['nombre_contacto']), 1, 1, 'L', true);

            $dataDetalleContactoActividad= $detalleContactoActividad->selectDetalleContactoActividadByIdContactoActividad($dataContactoActividad[$i]['id_contactoactividad']);
            if($dataDetalleContactoActividad[0]['id_detallecontactoactividad'] != ""){

                $pdf->SetWidths(array(45, 151));
                $pdf->SetAligns(array('C', 'C'));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->SetFillColor(230, 230, 230);
                $pdf->Row(array('Fecha y Hora', utf8_decode("Resultados")));

                for($y= 0; $y < count($dataDetalleContactoActividad); $y++){
                    $pdf->SetWidths(array(45, 151));
                    $pdf->SetAligns(array('L', 'L'));
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->SetFillColor(260, 260, 260);
                    $pdf->Row(array(utf8_decode($dataDetalleContactoActividad[$y]['fecha_registro']." | ".$dataDetalleContactoActividad[$y]['hora_registro']), utf8_decode($dataDetalleContactoActividad[$y]['menresultado'])));
                }
            }else{
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(0, 4, utf8_decode("No Hay Resultados"), 1, 1, 'L');
            }
            $pdf->Ln(5);
        }
    }


	$pdf->AliasNbPages();
	$pdf->Output('../comunes/temp/prueba.pdf');
    header('Location: ../comunes/temp/prueba.pdf');
    exit;

?>
