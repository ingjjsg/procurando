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
            $firma= "________________________________<br>".$dataGerenteDestinatario[0]['strnombre'];
            $firma.= " ".$dataGerenteDestinatario[0]['strapellido']."<br>".$dataGerenteDestinatario[0]['nombre_cargo'];
        }else if($dataDestinatario[$i]['nombre_tipoenvio_maestro'] == 'CC'){
            $strCC.= $dataGerenteDestinatario[0]['strnombre']." ".$dataGerenteDestinatario[0]['strapellido']." (".$dataDestinatario[$i]['destinatario'].")";
        }else if($dataDestinatario[$i]['nombre_tipoenvio_maestro'] == 'CCO'){
            $strCCO.= $dataGerenteDestinatario[0]['strnombre']." ".$dataGerenteDestinatario[0]['strapellido']." (".$dataDestinatario[$i]['destinatario'].")";
        }
    }

    $fecha= split("/", $dataCorrespondencia[0]['fecha_envio']);
    if($strCC != ""){
        $rowspan= 4;
    }else{
        $rowspan= 3;
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>GOBERNACION | CORRESPONDENCIA</title>
        <style>
            @media print
            {
                tfoot{
                    position:fixed;
                    bottom:0;
                    left:10px;
                }
            }
            body{
                font-family:arial;
                font-style:italic;
            }
            
            table table table {
                border:1px solid black;
                border-collapse:collapse;
            }

            .texto{
                font-family:arial;
                font-style:italic;
                font-size:7pt;
                text-align:center;
                font-weight: bold;
            }
            .fondoImagen{
                background-image:url(../Publico/Imagenes/hojatrans2.png);
                background-position:center;
                background-repeat:no-repeat
            }
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body class="fondoImagen">
        <table border="0" width="720px" >
            <thead>
                <tr>
                    <th></th>
                    <th>
                        <img src='../comunes/images/cab_reportes.jpg' width='700' />
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td></td>
                    <td>
                        <img  src='../comunes/images/foot_reportes.jpg' width='700'>
                    </td>
                    <td></td>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td></td>
                    <td>
                        <table width="100%" border="0" style="font-size:14px;font-family:arial" >
                            <span></span>
                            <tbody>
                                <tr>
                                    <td colspan="3" style="padding-top:5px;"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" bgcolor="#f8f8f8" align="center">
                                        <strong>
                                            <em><?= $dataCorrespondencia[0]['nombre_tipocorresp_maestro']; ?></em>
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="left" style="font-size:12px;">
                                        <table width="100%" border="1" >
                                            <tr valign="top">
                                                <td width="15%" align="center" rowspan="<?= $rowspan; ?>">
                                                    <strong>Presentado:</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="65%" >
                                                    <strong>A:</strong> <?= $strPR; ?>
                                                </td>
                                                <td width="20%">
                                                    <strong>Fecha:</strong>&nbsp;&nbsp;&nbsp;<?= $dataCorrespondencia[0]['fecha_envio']; ?>
                                                </td>
                                            </tr>
                                            <?php if($strCC != ""){ ?>
                                                <tr>
                                                    <td width="65%">
                                                        <strong>CC:</strong> <?= $strCC; ?>
                                                    </td>
                                                    <td width="20%">&nbsp;</td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td width="65%">
                                                    <strong>Por:</strong> <?= $dataCreador[0]['nombre_dpto']; ?>
                                                </td>
                                                <td width="20%">
                                                    <strong>Pto.Nro. </strong>&nbsp;&nbsp;&nbsp;<?= $dataCorrespondencia[0]['strcorrelativo']; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <table width="100%" align="left" border="1">
                                            <tr>
                                                <td>
                                                    <strong>Asunto: </strong>
                                                    <?= $dataCorrespondencia[0]['strasunto']; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" colspan="3" style="padding:10px 10px 60px 10px;" >
                                        <?= $dataCorrespondencia[0]['strcuerpo']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" colspan="3">
                                        <div style="padding: 10px auto 10px auto; widows:0;orphans:0;text-align:center">
                                            <br /><br />
                                            <strong><?= $firma; ?></strong>
                                            <br /><br />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <table width="100%" align="left" border="1">
                                            <tr>
                                                <td colspan="4">
                                                    <strong>Comentarios:</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <br/><br/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" valign="top" width="40%">
                                                    <strong>Preparado por:</strong>
                                                    <br/><br/>
                                                    <strong><?= $dataGerente[0]['strnombre']." ".$dataGerente[0]['strapellido']; ?></strong>
                                                    <br/>
                                                    <?= $dataGerente[0]['nombre_cargo']; ?>
                                                    <br/>
                                                    <?= $dataGerente[0]['nombre_dpto']; ?>
                                                </td>
                                                <td align="center" valign="top" width="15%">
                                                    <strong>Fecha:</strong>
                                                    <br/><br/>
                                                    <?= $dataCorrespondencia[0]['fecha_envio']; ?>
                                                </td>
                                                <td align="center" valign="top" width="15%">
                                                    <strong>Anexos:</strong>
                                                    <br/><br/>
                                                </td>
                                                <td align="center" valign="top" width="30%">
                                                    <strong>Recibido Por:</strong>
                                                    <br/><br/>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" colspan="3">
                                        <div class="texto">
                                            <p>
                                                La presente correspondencia ha sido enviada por
                                                <strong><?= $dataValidacion[0]['nombre_contacto'] ?></strong>
                                                a trav&eacute;s del sistema de correspondencia en fecha
                                                <b><?= $dataValidacion[0]['fecha'] ?></b>
                                                bajo el n&uacute;mero
                                                <b><?= $dataValidacion[0]['codigo_validacion'] ?></b>
                                                , para confirmar la emisi&oacute;n de este documento comun&iacute;quese a la Oficina de
                                                Tecnolog&iacute;as de la Informaci&oacute;n a los telf: (0212)576.11.50/(0212)578.27.34
                                                ext. 1017, 1018, 1011, 1035.
                                            </p>
                                        </div>
                                        <br>
                                        <div class="texto">
                                            <br>
                                            "150 A&ntilde;os de la Revoluci&oacute;n Federal y Campesina, Liderizada por el General del
                                            Pueblo Soberano Ezequiel Zamora"
                                            <br>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
<?
    /*$pdf= new HTML2FPDF('P', 'mm', "letter", $dataValidacion[0]['codigo_validacion']." ".$dataCorrespondencia[0]['strcorrelativo'], $dataValidacion[0]['nombre_contacto'], $dataValidacion[0]['fecha']);
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
*/
?>
