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

    $fechaEnvio= ($dataCorrespondencia[0]['fecha_envio'] != "") ? fechaCompleta($dataCorrespondencia[0]['fecha_envio'], "/") : "";
    
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 2, $fechaEnvio, 0, 1, 'R');
    $pdf->Ln(3);

    $pdf->SetFont('Arial', 'BI', 14);
    $pdf->Cell(0, 2, utf8_decode($dataCorrespondencia[0]['nombre_tipocorresp_maestro']), 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'BI', 12);
    $pdf->Cell(0, 2, $dataCorrespondencia[0]['strcorrelativo'], 0, 1, 'L');
    $pdf->Ln(2);

    $pdf->SetFont('Arial', '', 10);
    $pdf->WriteHTML('<hr>');
    $pdf->Ln(2);

    $pdf->WriteHTML($dataCorrespondencia[0]['strcuerpo']);
    $pdf->Ln(5);

    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(0, 2, "Destino: ".utf8_decode($strPR), 0, 1, 'L');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'BI', 8);
    $pdf->Cell(65, 5, "Autorizado por:", 'LTR', 0, 'L');
    $pdf->Cell(65, 5, "Salida Verificada por:", 'LTR', 0, 'L');
    $pdf->Cell(65, 5, "Entrega Verificada por:", 'LTR', 0, 'L');
    $pdf->Ln();
    $pdf->Cell(65, 5, "", 'LR', 0, 'L');
    $pdf->Cell(65, 5, "", 'LR', 0, 'L');
    $pdf->Cell(65, 5, "", 'LR', 0, 'L');
    $pdf->Ln();
    $pdf->Cell(65, 4, $dataGerente[0]['strnombre']." ".$dataGerente[0]['strapellido'], 'LR', 0, 'C');
    $pdf->Cell(65, 4, "", 'LR', 0, 'L');
    $pdf->Cell(65, 4, "", 'LR', 0, 'L');
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(65, 4, $dataGerente[0]['nombre_cargo'], 'LR', 0, 'C');
    $pdf->Cell(65, 4, "", 'LR', 0, 'L');
    $pdf->Cell(65, 4, "", 'LR', 0, 'L');
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 6);
    $pdf->Cell(65, 4, utf8_decode($dataGerente[0]['nombre_dpto']), 'LBR', 0, 'C');
    $pdf->Cell(65, 4, "", 'LBR', 0, 'L');
    $pdf->Cell(65, 4, "", 'LBR', 5, 'L');
    $pdf->Ln(3);

    $pdf->SetFont('Arial', 'BI', 7);
    $pdf->Cell(0, 2,  utf8_decode("\"150 Años de la Revolución Federal y Campesina, Liderizada por el General del Pueblo Soberano Ezequiel Zamora\""), 0, 1, 'C');
    $pdf->Ln(3);

	$pdf->AliasNbPages();
	$pdf->Output('../comunes/temp/prueba.pdf');
    header('Location: ../comunes/temp/prueba.pdf');
    exit;

?>
