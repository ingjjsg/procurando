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
        $dataGerenteDestinatario= "";
        $dataGerenteDestinatario= $contacto->verGerente($dataDestinatario[$i]['id_destino_maestro']);
        if($dataDestinatario[$i]['nombre_tipoenvio_maestro'] == 'PR'){
            $strPR.= $dataGerenteDestinatario[0]['strnombre']." ".$dataGerenteDestinatario[0]['strapellido']." (".$dataDestinatario[$i]['destinatario'].")";
            $firma= "________________________________\n".$dataGerenteDestinatario[0]['strnombre'];
            $firma.= " ".$dataGerenteDestinatario[0]['strapellido']."\n".$dataGerenteDestinatario[0]['nombre_cargo'];
        }else if($dataDestinatario[$i]['nombre_tipoenvio_maestro'] == 'CC'){
            $strCC.= $dataGerenteDestinatario[0]['strnombre']." ".$dataGerenteDestinatario[0]['strapellido']." (".$dataDestinatario[$i]['destinatario'].")";
        }else if($dataDestinatario[$i]['nombre_tipoenvio_maestro'] == 'CCO'){
            $strCCO.= $dataGerenteDestinatario[0]['strnombre']." ".$dataGerenteDestinatario[0]['strapellido']." (".$dataDestinatario[$i]['destinatario'].")";
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
    $pdf->Ln(3);

    $fecha= split("/", $dataCorrespondencia[0]['fecha_envio']);
  
    if($strCCO != ""){
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 5, "PRESENTADO:", 'LTR', 0, 'C');
        $pdf->Cell(5, 5, "A: ", 'LTB', 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(111, 5, utf8_decode($strPR), 'TRB', 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 5, utf8_decode("Nro. Pág.: {nb}"), 1, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 5, "", 'LR', 0, 'C');
        $pdf->Cell(7, 5, "CC: ", 'LTB', 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(109, 5, utf8_decode($strCC), 'TRB', 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 5, "Fecha: ", 1, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 5, "", 'LR', 0, 'C');
        $pdf->Cell(10, 5, "CCO: ", 'LTB', 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(106, 5, utf8_decode($strCCO), 'TRB', 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(14, 5, $fecha[0], 1, 0, 'C');
        $pdf->Cell(13, 5, $fecha[1], 1, 0, 'C');
        $pdf->Cell(13, 5, $fecha[2], 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 5, "", 'LBR', 0, 'C');
        $pdf->Cell(10, 5, "POR: ", 'LTB', 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(106, 5, utf8_decode($dataGerente[0]['strnombre']." ".$dataGerente[0]['strapellido']." (".$dataCreador[0]['nombre_dpto'].")"), 'TRB', 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 5, "PTO Nro. ".$dataCorrespondencia[0]['strcorrelativo'], 1, 1, 'L');
    }else if($strCC != ""){
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 8, "PRESENTADO:", 'LTR', 0, 'C');
        $pdf->Cell(5, 8, "A: ", 'LTB', 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(111, 8, utf8_decode($strPR), 'TRB', 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 8, utf8_decode("Nro. Pág.: {nb}"), 1, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 8, "", 'LR', 0, 'C');
        $pdf->Cell(7, 8, "CC: ", 'LTB', 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(109, 8, utf8_decode($strCC), 'TRB', 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 4, "Fecha: ", 1, 1, 'L');
        $pdf->Cell(40, 10, "", 0, 0, 'C');
        $pdf->Cell(116, 10, "", 0, 0, 'L');
        $pdf->Cell(14, 4, $fecha[0], 1, 0, 'C');
        $pdf->Cell(13, 4, $fecha[1], 1, 0, 'C');
        $pdf->Cell(13, 4, $fecha[2], 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 6, "", 'LBR', 0, 'C');
        $pdf->Cell(10, 6, "POR: ", 'LTB', 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(106, 6, utf8_decode($dataCreador[0]['nombre_dpto']), 'TRB', 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 6, "PTO Nro. ".$dataCorrespondencia[0]['strcorrelativo'], 1, 1, 'L');
    }else{
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 10, "PRESENTADO:", 'LTR', 0, 'C');
        $pdf->Cell(5, 10, "A: ", 'LTB', 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(111, 10, utf8_decode($strPR), 'TRB', 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 3, utf8_decode("Nro. Pág.: {nb}"), 1, 1, 'L');
        $pdf->Cell(40, 10, "", 0, 0, 'C');
        $pdf->Cell(116, 10, "", 0, 0, 'L');
        $pdf->Cell(40, 3, "Fecha: ", 1, 1, 'L');
        $pdf->Cell(40, 10, "", 0, 0, 'C');
        $pdf->Cell(116, 10, "", 0, 0, 'L');
        $pdf->Cell(14, 4, $fecha[0], 1, 0, 'C');
        $pdf->Cell(13, 4, $fecha[1], 1, 0, 'C');
        $pdf->Cell(13, 4, $fecha[2], 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 6, "", 'LBR', 0, 'C');
        $pdf->Cell(10, 6, "POR: ", 'LTB', 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(106, 6, utf8_decode($dataCreador[0]['nombre_dpto']), 'TRB', 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 6, "PTO Nro. ".$dataCorrespondencia[0]['strcorrelativo'], 1, 1, 'L');
    }
    $pdf->Cell(0, 1, "", 0, 1, 'L');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 4, "ASUNTO: ".utf8_decode($dataCorrespondencia[0]['strasunto']), 1, 1, 'L');

    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(5);
    $pdf->WriteHTML($dataCorrespondencia[0]['strcuerpo']);
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode($firma), 0, 'C');
    $pdf->Ln(10);
    
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetFillColor(180, 180, 180);
    $pdf->Cell(0, 5, "COMENTARIOS:", 1, 1, 'L', true);
    $pdf->MultiCell(0, 20, "", 1, 'L');

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(60, 3, "PREPARADO POR:", 'LTR', 0, 'C');
    $pdf->Cell(30, 3, "FECHA:", 'LTR', 0, 'C');
    $pdf->Cell(30, 3, "ANEXOS:", 'LTR', 0, 'C');
    $pdf->Cell(76, 3, "RECIBIDO POR:", 'LTR', 1, 'C');

    $pdf->Cell(60, 4, "", 'LR', 0, 'C');
    $pdf->Cell(30, 4, "", 'LTR', 0, 'C');
    $pdf->Cell(15, 4, "Si", 'LTR', 0, 'C');
    $pdf->Cell(15, 4, "No", 'LTR', 0, 'C');
    $pdf->Cell(76, 4, "", 'LR', 1, 'C');

    $pdf->Cell(60, 3, $dataGerente[0]['strnombre']." ".$dataGerente[0]['strapellido'], 'LR', 0, 'C');
    $pdf->Cell(30, 3, "", 'LR', 0, 'C');
    $pdf->Cell(15, 3, "", 'LR', 0, 'C');
    $pdf->Cell(15, 3, "", 'LR', 0, 'C');
    $pdf->Cell(76, 3, "", 'LR', 1, 'C');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(60, 3, $dataGerente[0]['nombre_cargo'], 'LR', 0, 'C');
    $pdf->Cell(30, 3, $dataCorrespondencia[0]['fecha_envio'], 'LR', 0, 'C');
    $pdf->Cell(15, 3, "", 'LR', 0, 'C');
    $pdf->Cell(15, 3, "", 'LR', 0, 'C');
    $pdf->Cell(76, 3, "", 'LR', 1, 'C');

    $pdf->Cell(60, 3, utf8_decode($dataGerente[0]['nombre_dpto']), 'LBR', 0, 'C');
    $pdf->Cell(30, 3, "", 'LBR', 0, 'C');
    $pdf->Cell(15, 3, "", 'LBR', 0, 'C');
    $pdf->Cell(15, 3, "", 'LBR', 0, 'C');
    $pdf->Cell(76, 3, "", 'LBR', 1, 'C');
    
	$pdf->AliasNbPages();
	$pdf->Output('../comunes/temp/prueba.pdf');
    header('Location: ../comunes/temp/prueba.pdf');
    exit;

?>
