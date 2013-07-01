<?php
    include_once ('../comunes/php/fpdf/html2fpdf.php');
    include_once ('../comunes/php/utilidades.php');
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clCorrespondenciaModelo.php';
    require_once '../modelo/clDestinatariosModelo.php';

    verificarSession();

    $correspondencia= new clCorrespondenciaModelo();
    $destinatarios= new clDestinatariosModelo();
    $maestro= new clMaestroModelo();

    class PDF_MC_Table extends HTML2FPDF{
        var $widths;
        var $aligns;

        function Header($content=''){
            $this->Image('../comunes/images/cab_reportes.jpg',10,2,260, 15);
            $this->Ln(5);
            $this->SetFont('Arial', 'BI', 12);
            $this->Cell(0, 5, utf8_decode("Reportes de Gestión de la Correspondencia"), 0, 1, 'C');
            $this->Ln(5);

            $maestro= new clMaestroModelo();
            if($_SESSION['id_profile'] == 112 || $_SESSION['id_profile'] == 117){
                if($_REQUEST['dependencia'] == 0){
                    $dptoTitulo= "";
                }else{
                    $dataDptoTitulo= $maestro->selectMaestroPadreById($_REQUEST['dependencia'], 'stritema');
                    $dptoTitulo= $dataDptoTitulo[0]['stritema'];
                }
            }else if($_SESSION['id_profile'] == 113){
                if($_REQUEST['dependencia'] == 0){
                    $dataDptoTitulo= $maestro->selectMaestroPadreById($_SESSION['id_dpto_maestro'], 'stritema');
                    $dptoTitulo= $dataDptoTitulo[0]['stritema'];
                }else{
                    $dataDptoTitulo= $maestro->selectMaestroPadreById($_REQUEST['dependencia'], 'stritema');
                    $dptoTitulo= $dataDptoTitulo[0]['stritema'];
                }
            }else{
                 $dataDptoTitulo= $maestro->selectMaestroPadreById($_REQUEST['dependencia'], 'stritema');
                    $dptoTitulo= $dataDptoTitulo[0]['stritema'];
            }

            $this->Cell(0, 5, utf8_decode($dptoTitulo), 0, 1, 'L');
            $this->Ln(5);
        }

        function Footer(){
            $this->SetY(-27);
            $this->SetFont('Arial', 'BI', 6);
            $this->Text(19, 198, utf8_decode("Generado a través del Sistema de Correspondencia en fecha ".date("d/m/Y")." por el usuario ".$_SESSION['strnombre']." ".$_SESSION['strapellido']." | Fuente OTI/ADIS/".date("Y")." | Licencia: GPL/GNU."));
            $this->Image('../comunes/images/foot_reportes.jpg',10,195, 260, 15);
        }

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
            $h=10*$nb;
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
                $this->MultiCell($w,10,$data[$i],0,$a,0);
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

    $correspondencia= new clCorrespondenciaModelo();
    $destinatarios= new clDestinatariosModelo();
    $maestro= new clMaestroModelo();

    $dataCorrespondencia= null;
    $dataDestinatario= null;

    $pdf= new PDF_MC_Table('l', 'mm', "letter", "", "", "");
	$pdf->SetMargins(10, 10);
    $pdf->SetAutoPageBreak(true, 20);
    $pdf->AddPage();
    $pdf->Header('<table><tr><td></td></tr></table>');


    if($_SESSION['id_profile'] == 112 || $_SESSION['id_profile'] == 117){
        if($_REQUEST['dependencia'] == 0){
            $dpto= null;
        }else{
            $dpto= $_REQUEST['dependencia'];
            $dataMaestro= $maestro->selectAllMaestroHijos($_REQUEST['dependencia'], 'stritema');
            if($dataMaestro){
                $dpto.= ",";
            }
            if($dataMaestro){
                for($i= 0; $i < count($dataMaestro); $i++){
                    $dpto.= $dataMaestro[$i]['id_maestro'];
                    if($i != (count($dataMaestro)-1)){
                        $dpto.= ",";
                    }
                }
            }
        }
    }else if($_SESSION['id_profile'] == 113){
        if($_REQUEST['dependencia'] == 0){
            $dataMaestro= $maestro->selectAllMaestroHijos($_SESSION['id_dpto_maestro'], 'stritema');
            $dpto= $_SESSION['id_dpto_maestro'];
            if($dataMaestro){
                $dpto.= ",";
            }
            if($dataMaestro){
                for($i= 0; $i < count($dataMaestro); $i++){
                    $dpto.= $dataMaestro[$i]['id_maestro'];
                    if($i != (count($dataMaestro)-1)){
                        $dpto.= ",";
                    }
                }
            }
        }else{
            $dpto= $_REQUEST['dependencia'];
        }
    }
    $pdf->SetWidths(array(40, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20));
    $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Row(array('Estatus', 'Borrador', 'Enviado a Coordinador', 'Enviado a Gerente', 'Devuelto a Analista', 'Enviada',
                    utf8_decode('Entrante No Leída'), utf8_decode('Entrante Leída'), "Asignada", "Finalizada", "Cerrada", "Respondidas"));

    $dataMaestroDocumentosI= $maestro->selectAllMaestroHijos(84, "stritema");
    $dataMaestroDocumentosE= $maestro->selectAllMaestroHijos(85, "stritema");

    if($dataMaestroDocumentosI){
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetWidths(array(40));
        $pdf->SetAligns(array('L'));
        $pdf->Row(array('Correspondencias Internas'));

        $pdf->SetWidths(array(40, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20));
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetFillColor(260, 260, 260);
        for($i= 0; $i < count($dataMaestroDocumentosI); $i++){
            $dataCorrespondenciaInterna= $correspondencia->selectAllCorrespondenciaGestion($dpto, $dataMaestroDocumentosI[$i]['id_maestro']);
            $dataDestinatario= $destinatarios->selectAllGestionReporte($dpto, $dataMaestroDocumentosI[$i]['id_maestro']);
            $borrador= 0;
            $enviCoord= 0;
            $enviGeren= 0;
            $devuelto= 0;
            $enviada= 0;
            $entrantesNoLeidas= 0;
            $entrantesLeidas= 0;
            $asignadas= 0;
            $finalizadas= 0;
            $cerradas= 0;
            $respondidas= 0;
            if($dataCorrespondenciaInterna){
                $borrador= $dataCorrespondenciaInterna[0]['borrador'];
                $enviCoord= $dataCorrespondenciaInterna[0]['enviado_coord'];
                $enviGeren= $dataCorrespondenciaInterna[0]['enviado_gerente'];
                $devuelto= $dataCorrespondenciaInterna[0]['devuelto_analista'];
                $enviada= $dataCorrespondenciaInterna[0]['enviadas'];
            }
            for($j= 0; $j < count($dataDestinatario); $j++){
                if($dataDestinatario[$j]['id_estatus_maestro'] == 200){
                    $entrantesNoLeidas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 201){
                    $entrantesNoLeidas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 202){
                    $entrantesLeidas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 203){
                    $entrantesLeidas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 204){
                    $asignadas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 205){
                    $finalizadas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 216){
                    $cerradas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 217){
                    $respondidas+= $dataDestinatario[$j]['cantidad'];
                }
            }
            $pdf->Row(array(utf8_decode($dataMaestroDocumentosI[$i]['stritema']),
                            $borrador,
                            $enviCoord,
                            $enviGeren,
                            $devuelto,
                            $enviada,
                            $entrantesNoLeidas,
                            $entrantesLeidas,
                            $asignadas,
                            $finalizadas,
                            $cerradas,
                            $respondidas));
        }
    }

    if($dataMaestroDocumentosE){
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetWidths(array(40));
        $pdf->SetAligns(array('L'));
        $pdf->Row(array('Correspondencias Externas'));

        $pdf->SetWidths(array(40, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20));
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetFillColor(260, 260, 260);
        for($i= 0; $i < count($dataMaestroDocumentosE); $i++){
            $dataCorrespondenciaExterna= $correspondencia->selectAllCorrespondenciaGestion($dpto, $dataMaestroDocumentosE[$i]['id_maestro']);
            $dataDestinatario= $destinatarios->selectAllGestionReporte($dpto, $dataMaestroDocumentosE[$i]['id_maestro']);
            $borrador= 0;
            $enviCoord= 0;
            $enviGeren= 0;
            $devuelto= 0;
            $enviada= 0;
            $entrantesNoLeidas= 0;
            $entrantesLeidas= 0;
            $asignadas= 0;
            $finalizadas= 0;
            $cerradas= 0;
            $respondidas= 0;
            if($dataCorrespondenciaExterna){
                $borrador= $dataCorrespondenciaExterna[0]['borrador'];
                $enviCoord= $dataCorrespondenciaExterna[0]['enviado_coord'];
                $enviGeren= $dataCorrespondenciaExterna[0]['enviado_gerente'];
                $devuelto= $dataCorrespondenciaExterna[0]['devuelto_analista'];
                $enviada= $dataCorrespondenciaExterna[0]['enviadas'];
            }
            for($j= 0; $j < count($dataDestinatario); $j++){
                if($dataDestinatario[$j]['id_estatus_maestro'] == 200){
                    $entrantesNoLeidas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 201){
                    $entrantesNoLeidas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 202){
                    $entrantesLeidas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 203){
                    $entrantesLeidas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 204){
                    $asignadas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 205){
                    $finalizadas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 216){
                    $cerradas+= $dataDestinatario[$j]['cantidad'];
                }else if($dataDestinatario[$j]['id_estatus_maestro'] == 217){
                    $respondidas+= $dataDestinatario[$j]['cantidad'];
                }
            }
            $pdf->Row(array(utf8_decode($dataMaestroDocumentosE[$i]['stritema']),
                            $borrador,
                            $enviCoord,
                            $enviGeren,
                            $devuelto,
                            $enviada,
                            $entrantesNoLeidas,
                            $entrantesLeidas,
                            $asignadas,
                            $finalizadas,
                            $cerradas,
                            $respondidas));
        }
    }

    $pdf->AliasNbPages();
	$pdf->Output('../comunes/temp/prueba.pdf');
    header('Location: ../comunes/temp/prueba.pdf');
    exit;
?>
