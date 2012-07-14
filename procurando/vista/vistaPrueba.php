<?php
//include('../comunes/pdf/class.ezpdf.php');
require ('../comunes/php/fpdf/fpdf.php');
	$pdf= new FPDF();
	$pdf->AddPage();
	//$pdf->SetFont('Arial','B',23);
	//$pdf->setXY(75,45);
	$pdf->Write(10,'Prueba de Generación de un archivo PDF desde FPDF');
	//$pdf->Image('imagen.jpg',102,145,80);
	$pdf->Output('../comunes/temp/prueba.pdf');
?>