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
    $dataDestinatario= $destinatarios->selectAllDestinatariosExternoByIdCorresp($_REQUEST['id']);
    $dataValidacion= $validacion->selectValidacionById($_REQUEST['id']);
    $strPR= "";
    for($i= 0; $i < count($dataDestinatario); $i++){
        if($dataDestinatario[$i]['nombre_tipoenvio_maestro'] == 'PR'){
            $strPR.= $dataDestinatario[$i]['trato_destinatario']."\n".$dataDestinatario[$i]['nombre_destinatario']."\n";
            $strPR.= $dataDestinatario[$i]['cargo_destinatario']."\n".$dataDestinatario[$i]['institucion_destinatario'];
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
    $pdf->Cell(0, 4, "Caracas, ".$fechaEnvio, 0, 1, 'R');
    $pdf->Ln(4);

    $pdf->SetFont('Arial', 'BI', 10);
    $pdf->Cell(0, 4, $dataCorrespondencia[0]['strcorrelativo'], 0, 1, 'R');
    $pdf->Ln(4);

    $pdf->SetFont('Arial', 'BI', 10);
    $pdf->MultiCell(0, 4, utf8_decode($strPR), 0, 1, 'L');
    $pdf->Ln(4);
    $pdf->Cell(0, 4, "Presente.-", 0, 1, 'L');
    $pdf->Ln(6);

    $pdf->SetFont('Arial', '', 10);
    $pdf->WriteHTML($dataCorrespondencia[0]['strcuerpo']);
    $pdf->Ln(8);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 2, 'Atentamente', 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 2, '____________________________', 0, 1, 'C');
    $pdf->Ln(3);

    $pdf->SetFont('Arial', '', 10);
    $pdf->WriteHTML("".$dataGerente[0]['strfirma']."");
    $pdf->Ln(3);
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(0, 2, $dataCreador[0]['strmediafirma'], 0, 1, 'L');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', 'BI', 7);
    $pdf->Cell(0, 2,  utf8_decode("\"150 Años de la Revolución Federal y Campesina, Liderizada por el General del Pueblo Soberano Ezequiel Zamora\""), 0, 1, 'C');
    $pdf->Ln(3);

	$pdf->AliasNbPages();
	$pdf->Output('../comunes/temp/prueba.pdf');
    header('Location: ../comunes/temp/prueba.pdf');
    exit;

?>
