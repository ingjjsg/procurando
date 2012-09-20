<?php
require_once '../comunes/tcpdf/config/lang/spa.php';
require_once '../comunes/tcpdf/tcpdf.php';
require_once '../comunes/tcpdf/htmlcolors.php';

class Plantilla extends TCPDF{
    private $titulo;
    
    public function setTitulo($titulo){
        $this->titulo=$titulo;        
    }
    
    public function getTitulo(){
        return $this->titulo;
    }
    
    
    public function __construct($orientacion) {
        parent::__construct($orientacion, 'mm', 'letter', true, 'UTF-8', false);
        $this->SetTopMargin(60);
    }
    public function  Header() {
        $image_file = '../comunes/images/img2.gif';
        $ancho=0;
        if($this->CurOrientation=="L"){
            $ancho=270;
        }else{
            $ancho=200;
        }
        $this->Image($image_file, 5, 5, $ancho,25, 'GIF', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetY(30);
        $this->SetFont('helvetica', 'B', 16);
        $this->SetFont('helvetica', 'I', 10);
        $this->Cell(0, 10, 'REPÚBLICA BOLIVARIANA DE VENEZUELA', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Ln(3);
        $this->Cell(0, 10, 'GOBIERNO BOLIVARIANO DEL ESTADO YARACUY', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Ln(3);
        $this->Cell(0, 10, 'PROCURADURÍA GENERAL DEL ESTADO YARACUY', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Ln(3);
        $this->Cell(0, 10, $this->getTitulo(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Ln(10);
        $this->SetY(50);
    }

    public function  Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-25);
        $this->SetFillColor(230, 230, 230);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, '¡Independencia y Patria Socialista! ¡Viviremos y Venceremos!', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Ln(3);
        $this->Cell(0, 10, '6ª  Avenida entre Calle 21 y Paseo Guayabal, San Felipe –  Estado Yaracuy', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Ln(3);
        $this->Cell(0, 10, 'Teléfono  (0254) 2324687    E-Mail: proyar@cantv.net', 0, false, 'C', 0, '', 0, false, 'T', 'M');


        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Página ' .$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
?>
