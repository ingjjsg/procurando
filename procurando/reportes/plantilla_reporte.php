<?php
require_once '../comunes/tcpdf/config/lang/spa.php';
require_once '../comunes/tcpdf/tcpdf.php';
require_once '../comunes/tcpdf/htmlcolors.php';
require_once('../comunes/jpgraph/src/jpgraph.php');
require_once('../comunes/jpgraph/src/jpgraph_pie.php');
require_once ('../comunes/jpgraph/src/jpgraph_pie3d.php');

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
        //$this->SetY(100);
    }

    public function  Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-20);
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
    
    public function gaficoPDF($datos = array(),$nombreGrafico = NULL,$ubicacionTamamo = array(),$titulo = NULL)
     { 
      //construccion de los arrays de los ejes x e y
      if(!is_array($datos) || !is_array($ubicacionTamamo)){
       echo "los datos del grafico y la ubicacion deben de ser arreglos";
      }
      elseif($nombreGrafico == NULL){
       echo "debe indicar el nombre del grafico a crear";
      }
      else{ 
       #obtenemos los datos del grafico  
       foreach ($datos as $key => $value){
        $data[] = $value[0];
        $nombres[] = $key; 
        $color[] = $value[1];
       } 
       $x = $ubicacionTamamo[0];
       $y = $ubicacionTamamo[1]; 
       $ancho = $ubicacionTamamo[2];  
       $altura = $ubicacionTamamo[3];  
       #Creamos un grafico vacio
       $graph = new PieGraph(600,400);
       #indicamos titulo del grafico si lo indicamos como parametro
       if(!empty($titulo)){
        $graph->title->Set($titulo);
       }   
       //Creamos el plot de tipo tarta
       $p1 = new PiePlot3D($data);
       $p1->SetSliceColors($color);
       #indicamos la leyenda para cada porcion de la tarta
       $p1->SetLegends($nombres);
       //Añadirmos el plot al grafico
       $graph->Add($p1);
       //mostramos el grafico en pantalla
       $graph->Stroke("$nombreGrafico.png"); 
       $this->Image("$nombreGrafico.png",$x,$y,$ancho,$altura);  
      } 
     }     
}
?>
