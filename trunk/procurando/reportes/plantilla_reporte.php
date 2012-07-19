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
        $this->SetTopMargin(40);
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
        $this->Cell(0, 10, $this->getTitulo(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    public function  Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Página ' .$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
?>
