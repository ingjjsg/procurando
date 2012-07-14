<?php
    include_once ('../comunes/php/fpdf/html2fpdf.php');
    include_once ('../comunes/php/utilidades.php');
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clActividadesModelo.php';
    require_once '../modelo/clDepartamentoActividadModelo.php';
    require_once '../modelo/clContactoActividadModelo.php';

    verificarSession();

    class PDF_MC_Table extends HTML2FPDF{
        var $widths;
        var $aligns;

        function Header($content=''){
            $this->Image('../comunes/images/cab_reportes.jpg',10,2,260, 15);
            $this->Ln(5);
            $this->SetFont('Arial', 'BI', 12);
            $this->Cell(0, 5, utf8_decode("Reportes de Actividades"), 0, 1, 'C');
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

            $this->SetWidths(array(10, 25, 35, 50, 32, 30, 78));
            $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C'));
            $this->SetFont('Arial', 'B', 8);
            $this->SetFillColor(230, 230, 230);
            $this->Row(array('Id', 'Correlativo', 'Titulo', 'Asignado Por / Departamento', utf8_decode('Fecha de Asignación'), 'Estatus', 'Asignado Por / Analista Asignado / Estatus'));
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


    $pdf= new PDF_MC_Table('l', 'mm', "letter", "", "", "");
	$pdf->SetMargins(10, 10);
    $pdf->SetAutoPageBreak(true, 20);
    $pdf->AddPage();
    $pdf->Header('<table><tr><td></td></tr></table>');

    $actividad= new clActividadesModelo();
    $departamentoActividad= new clDepartamentoActividadModelo();
    $contactoActividad= new clContactoActividadModelo();

    $maestro= new clMaestroModelo();

    $dataMaestro= $maestro->selectAllMaestroHijos($_SESSION['id_dpto_maestro'], 'stritema');

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

    if($_REQUEST['estatus'] == 0){
        $_REQUEST['estatus']= null;
    }
    if($_REQUEST['asignadoCondicion'] == 0){
        $_REQUEST['asignadoCondicion']= null;
    }
    if($_REQUEST['analistaCondicion'] == 0){
        $_REQUEST['analistaCondicion']= null;
    }
    if($_REQUEST['tituloCondicion'] == 0){
        $_REQUEST['tituloCondicion']= null;
    }

    $dataActividad= $actividad->selectAllReporteActividad($dpto, $_REQUEST['estatus'], $_REQUEST['fechaD'], $_REQUEST['fechaH'], $_REQUEST['asignadoCondicion'], $_REQUEST['asignadoValor'], $_REQUEST['analistaCondicion'], $_REQUEST['analistaValor'], $_REQUEST['tituloCondicion'], $_REQUEST['tituloValor']);
    if($dataActividad){
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetFillColor(260, 260, 260);
        $pdf->SetAligns(array('C', 'L', 'L', 'L', 'C', 'C', 'L'));
        for($i= 0; $i < count($dataActividad); $i++){

            $dataDepartamentoActividad= $departamentoActividad->selectDepartamentoActividadByIdActividad($dataActividad[$i]['id_actividad']);
            $strAsignadoDepartamento= "";
            if($dataDepartamentoActividad){
                for($j= 0; $j < count($dataDepartamentoActividad); $j++){
                    $dataSiglasMaestro= $maestro->selectMaestroPadreById($dataDepartamentoActividad[$j]['id_departamento_maestro']);
                    $strAsignadoDepartamento.= $dataDepartamentoActividad[$j]['nombre_contacto']." / ".$dataSiglasMaestro[0]['stritemb']."\n";
                }
            }
            $strAsignadoAnalista= "";
            $dataContactoActividad= $contactoActividad->selectContactosActividadByIdActividad($dataActividad[$i]['id_actividad']);
            if($dataContactoActividad){
                for($x= 0; $x < count($dataContactoActividad); $x++){
                    $strAsignadoAnalista.= $dataContactoActividad[$x]['nombre_contacto_asigna']." / ".$dataContactoActividad[$x]['nombre_contacto']." / ".$dataContactoActividad[$x]['nombre_estatus_maestro']."\n";
                }
            }

            $pdf->Row(array(utf8_decode($dataActividad[$i]['id_actividad']),
                            utf8_decode($dataActividad[$i]['correlativo']),
                            utf8_decode($dataActividad[$i]['memtitulo']),
                            utf8_decode($strAsignadoDepartamento),
                            utf8_decode($dataActividad[$i]['fecha_resolucion']),
                            utf8_decode($dataActividad[$i]['estatus']),
                            utf8_decode($strAsignadoAnalista)));
        }
    }


    $pdf->AliasNbPages();
	$pdf->Output('../comunes/temp/prueba.pdf');
    header('Location: ../comunes/temp/prueba.pdf');
    exit;
?>
