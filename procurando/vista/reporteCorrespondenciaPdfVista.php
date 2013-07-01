<?php
    include_once ('../comunes/php/fpdf/html2fpdf.php');
    include_once ('../comunes/php/utilidades.php');
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clCorrespondenciaModelo.php';
    require_once '../modelo/clDestinatariosModelo.php';
    require_once '../modelo/clActividadesModelo.php';
    require_once '../modelo/clContactoActividadModelo.php';
    require_once '../modelo/clContactoExternoModelo.php';

    verificarSession();

    class PDF_MC_Table extends HTML2FPDF{
        var $widths;
        var $aligns;

        function Header($content=''){
            $this->Image('../comunes/images/cab_reportes.jpg',10,2,260, 15);
            $this->Ln(5);
            $this->SetFont('Arial', 'BI', 12);
            if($_REQUEST['tipoReporte'] == 1){
                $reporte= "Redactadas";
            }else if($_REQUEST['tipoReporte'] == 2){
                $reporte= "Recibidas";
            }
            $this->Cell(0, 5, utf8_decode("Reportes de Correspondencia ".$reporte), 0, 1, 'C');
            $this->Ln(5);

            if($_REQUEST['tipoReporte'] == 1){
                $this->SetWidths(array(10, 24, 25, 28, 24, 28, 40, 80));
                $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
            }else if($_REQUEST['tipoReporte'] == 2){
                $this->SetWidths(array(10, 24, 53, 24, 28, 40, 80));
                $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C'));
            }

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

            $this->SetFont('Arial', 'B', 8);
            $this->SetFillColor(230, 230, 230);

            if($_REQUEST['tipoReporte'] == 1){
                $this->Row(array('Id', 'Documento', 'Creador', utf8_decode('Fecha de Creación'), utf8_decode('Fecha de Envío'), 'Correlativo', 'Asunto', 'Estatus / Departamento / Analista'));
            }else if($_REQUEST['tipoReporte'] == 2){
                $this->Row(array('Id', 'Documento', 'Remitente', utf8_decode('Fecha de Envío'), 'Correlativo', 'Asunto', 'Estatus / Departamento / Analista'));
            }
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

    $maestro= new clMaestroModelo();
    $correspondencia= new clCorrespondenciaModelo();
    $destinatario= new clDestinatariosModelo();
    $actividad= new clActividadesModelo();
    $contactoActividad= new clContactoActividadModelo();
    $contactoExterno= new clContactoExternoModelo();

    $dataCorrespondencia= null;
    $dataMaestro= null;
    $dataDestinatario= null;
    $dataActividad= null;
    $dataContactoActividad= null;

    $estatusDptoAnalista= "";

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
    
    if($_REQUEST['tipoC'] == 0){
        $_REQUEST['tipoC']= null;
    }
    if($_REQUEST['tipoD'] == 0){
        $_REQUEST['tipoD']= null;
    }
    if($_REQUEST['creadorCondicion'] == 0){
        $_REQUEST['creadorCondicion']= null;
    }
    if($_REQUEST['asuntoCondicion'] == 0){
        $_REQUEST['asuntoCondicion']= null;
    }
    if($_REQUEST['correlativoCondicion'] == 0){
        $_REQUEST['correlativoCondicion']= null;
    }
    if($_REQUEST['correlativoCondicion'] == 0){
        $_REQUEST['correlativoCondicion']= null;
    }
    if($_REQUEST['estatus'] == 0){
        $_REQUEST['estatus']= null;
    }
    if($_REQUEST['fechaCondicion'] == 0){
        $_REQUEST['fechaCondicion']= null;
    }
    $dataCorrespondencia= $correspondencia->selectAllCorrespondenciaReporte($_REQUEST['tipoReporte'], $dpto, $_REQUEST['tipoC'], $_REQUEST['tipoD'], $_REQUEST['creadorCondicion'], $_REQUEST['creadorValor'], $_REQUEST['asuntoCondicion'],$_REQUEST['asuntoValor'], $_REQUEST['correlativoCondicion'], $_REQUEST['correlativoValor'], $_REQUEST['estatus'], $_REQUEST['fechaCondicion'], $_REQUEST['fechaD'], $_REQUEST['fechaH']);
    if($dataCorrespondencia){
        for($i= 0; $i < count($dataCorrespondencia); $i++){
            if($dataCorrespondencia[$i]['id_tipo_maestro'] == 84){
                $dataDestinatario= $destinatario->selectAllDestinatariosByIdCorresp($dataCorrespondencia[$i]['id_corresp']);
            }else if($dataCorrespondencia[$i]['id_tipo_maestro'] == 85){
                $dataDestinatario= $destinatario->selectAllDestinatariosExternoByIdCorresp($dataCorrespondencia[$i]['id_corresp']);
            }

            if($dataDestinatario){
                $estatusDptoAnalista= "";
                for($y= 0; $y < count($dataDestinatario); $y++){
                    if($dataCorrespondencia[$i]['id_tipo_maestro'] == 84){
                        $estatusDptoAnalista.= $dataDestinatario[$y]['estatus']." / ".$dataDestinatario[$y]['abreviacion_destinatario']." / ";
                    }else if($dataCorrespondencia[$i]['id_tipo_maestro'] == 85){
                        $estatusDptoAnalista.= $dataDestinatario[$y]['estatus']." / ".$dataDestinatario[$y]['institucion_destinatario']." / ";
                    }
                    $dataActividad= $actividad->selectActividadByIdDestinatario($dataDestinatario[$y]['id_destinatarios']);
                    if($dataActividad){
                        for($x= 0; $x < count($dataActividad); $x++){
                            $dataContactoActividad= $contactoActividad->selectContactosActividadByIdActividad($dataActividad[$x]['id_actividad']);
                            if($dataContactoActividad){
                                for($z= 0; $z < count($dataContactoActividad); $z++){
                                    $estatusDptoAnalista.= $dataContactoActividad[$z]['nombre_contacto'];
                                    if($z != (count($dataContactoActividad)-1)){
                                        $estatusDptoAnalista.= "-";
                                    }
                                }
                                $estatusDptoAnalista.= "\n";
                            }else{
                                $estatusDptoAnalista.= "No Hay Analistas Asignados\n";
                            }
                        }
                    }else{
                       $estatusDptoAnalista.= "No Hay Analistas Asignados\n";
                    }
                }
            }

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetFillColor(260, 260, 260);
            if($_REQUEST['tipoReporte'] == 1){
                $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'C', 'L', 'L'));
                $pdf->Row(array(utf8_decode($dataCorrespondencia[$i]['id_corresp']),
                    utf8_decode($dataCorrespondencia[$i]['nombre_tipocorresp_maestro']),
                    utf8_decode($dataCorrespondencia[$i]['nombre_contacto']),
                    utf8_decode($dataCorrespondencia[$i]['fecha']),
                    utf8_decode($dataCorrespondencia[$i]['fecha_envio']),
                    utf8_decode($dataCorrespondencia[$i]['strcorrelativo']),
                    utf8_decode($dataCorrespondencia[$i]['strasunto']),
                    utf8_decode($estatusDptoAnalista)));
            }else if($_REQUEST['tipoReporte'] == 2){
                $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'L', 'L'));
                if($dataCorrespondencia[$i]['id_tipo_maestro'] == 84){
                    if($data[$i]['id_origen_unidad_maestro'] != 3){
                        $remitente= $dataCorrespondencia[$i]['nombre_unidad_maestro'];
                    }else{
                        $remitente= $dataCorrespondencia[$i]['nombre_origen_unidad_maestro'];
                    }
                }else if($dataCorrespondencia[$i]['id_tipo_maestro'] == 85){
                    $dataContactoExterno= $contactoExterno->selectAllContactoExternoById($dataCorrespondencia[$i]['id_unidad_maestro']);
                    $remitente= $dataContactoExterno[0]['strinstitucion'];
                }
                $pdf->Row(array(utf8_decode($dataCorrespondencia[$i]['id_corresp']),
                    utf8_decode($dataCorrespondencia[$i]['nombre_tipocorresp_maestro']),
                    utf8_decode($remitente),
                    utf8_decode($dataCorrespondencia[$i]['fecha_envio']),
                    utf8_decode($dataCorrespondencia[$i]['strcorrelativo']),
                    utf8_decode($dataCorrespondencia[$i]['strasunto']),
                    utf8_decode($estatusDptoAnalista)));
            }
            
        }
    }

    $pdf->AliasNbPages();
	$pdf->Output('../comunes/temp/prueba.pdf');
    header('Location: ../comunes/temp/prueba.pdf');
    exit;
?>
