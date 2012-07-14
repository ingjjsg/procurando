<?php
    include_once ('../comunes/php/fpdf/html2fpdf.php');
    include_once ('../comunes/php/utilidades.php');
    require_once '../modelo/clCorrespondenciaModelo.php';
    require_once '../modelo/clContactoModelo.php';
    require_once '../modelo/clDestinatariosModelo.php';
    require_once '../modelo/clValidacionModelo.php';
    require_once '../modelo/clFirmaAutorizada.php';

    $correspondencia= new clCorrespondenciaModelo();
    $contacto= new clContactoModelo();
    $destinatarios= new clDestinatariosModelo();
    $validacion= new clValidacionModelo();
    $firma= new clFirmaAutorizada();
    $dataCorrespondencia= $correspondencia->selectAllCorrespondenciaById($_REQUEST['id']);
    $dataCreador= $contacto->selectContactoById($dataCorrespondencia[0]['id_contacto']);
    $dataFirma= $firma->selectFirmaAutorizaByIdCorresp($_REQUEST['id']);
    if($dataFirma){
        $dataGerente= $contacto->selectContactoById($dataFirma[0]['id_contacto']);
    }
    $dataDestinatario= $destinatarios->selectAllDestinatariosByIdCorresp($_REQUEST['id']);
    $dataValidacion= $validacion->selectValidacionById($_REQUEST['id']);
    $strPR= "";
    $strCC= "";
    $strCCO= "";
    for($i= 0; $i < count($dataDestinatario); $i++){
        if($dataDestinatario[$i]['nombre_tipoenvio_maestro'] == 'PR'){
            $strPR.= $dataDestinatario[$i]['destinatario'].";\n";
        }else if($dataDestinatario[$i]['nombre_tipoenvio_maestro'] == 'CC'){
            $strCC.= $dataDestinatario[$i]['destinatario'].";\n";
        }else if($dataDestinatario[$i]['nombre_tipoenvio_maestro'] == 'CCO'){
            $strCCO.= $dataDestinatario[$i]['destinatario'].";\n";
        }
    }

    $pdf= new HTML2FPDF('P', 'mm', "letter", $dataValidacion[0]['codigo_validacion']." ".$dataCorrespondencia[0]['strcorrelativo'], $dataValidacion[0]['nombre_contacto'], $dataValidacion[0]['fecha']);
	$pdf->SetMargins(10, 10, 10, 10);
    $pdf->SetAutoPageBreak(true, 30);
    $pdf->AddPage();
    $pdf->Header('<table><tr><td></td></tr></table>');

    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'BI', 14);
    $pdf->Cell(0, 2, utf8_decode($dataCorrespondencia[0]['nombre_tipocorresp_maestro']), 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(15, 4, 'Nro. ', 1, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 4, $dataCorrespondencia[0]['strcorrelativo'], 1, 0, 'L');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 4, utf8_decode('Fecha Elaboración: '), 1, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(30, 4, $dataCorrespondencia[0]['fecha'], 1, 0, 'C');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 4, utf8_decode('Fecha de Envío: '), 1, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(31, 4, $dataCorrespondencia[0]['fecha_envio'], 1, 0, 'L');
    $pdf->Ln(4);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(15, 4, 'De:', 'BLT', 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 4, utf8_decode($dataGerente[0]['nombre_dpto']), 'BRT', 'L');

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(15, 4, 'Para:', 'BLT', 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 4, utf8_decode($strPR), 'BRT', 'L');

    if($strCC != ""){
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(15, 4, 'CC:', 'BLT', 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(0, 4, utf8_decode($strCC), 'BRT', 'L');
    }

    if($strCCO != ""){
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(15, 4, 'CCO:', 'BLT', 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(0, 4, utf8_decode($strCCO), 'BRT', 'L');
    }

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(15, 4, 'Asunto:', 'BLT', 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 4, utf8_decode($dataCorrespondencia[0]['strasunto']), 'BRT', 'L');


    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 12);
    $pdf->WriteHTML($dataCorrespondencia[0]['strcuerpo']);
    $pdf->Ln(2);

    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'BI', 7);
    $pdf->Cell(0, 2,  utf8_decode("\"150 Años de la Revolución Federal y Campesina, Liderizada por el General del Pueblo Soberano Ezequiel Zamora\""), 0, 1, 'C');
    $pdf->Ln(3);

	$pdf->AliasNbPages();
	$pdf->Output('../comunes/temp/prueba.pdf');
    header('Location: ../comunes/temp/prueba.pdf');
    exit;

?>
