<?php

require_once '../controlador/Conexion.php';
 require_once '../modelo/clConstantesModelo.php';
 /**
 * Description of clTbldictamenes
 * @author jsuarez
 */
 class clTbldictamenes {

//=========================== VAR ===================




  private   $id_dictamen;

  private   $id_usuario;

  private   $id_materia;

  private   $id_tipo_materia;

  private   $id_estado;

  private   $fecdictamen;

  private   $strtitulo;

  private   $strasunto;

  private   $stranrodictamen;

  private   $strpersonas;

  private   $bolborrado;
  
  private   $id_tipo_organismo;

  private   $id_organismo;  

//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     if($request['id_dictamen'] != ""){
        $this->id_dictamen= $request['id_dictamen'];
     }


     if($_SESSION['id_contacto'] != ""){
        $this->id_usuario= $_SESSION['id_contacto'];
     }


     if($request['id_materia'] != ""){
        $this->id_materia= $request['id_materia'];
     }


     if($request['id_tipo_materia'] != ""){
        $this->id_tipo_materia= $request['id_tipo_materia'];
     }


     if($request['id_instituto'] != ""){
        $this->id_instituto= $request['id_instituto'];
     }


     if($request['id_estado'] != ""){
        $this->id_estado= $request['id_estado'];
     }


     if($request['fecdictamen'] != ""){
        $this->fecdictamen= $request['fecdictamen'];
     }


     if($request['strtitulo'] != ""){
        $this->strtitulo= $request['strtitulo'];
     }


     if($request['strasunto'] != ""){
        $this->strasunto= $request['strasunto'];
     }


     if($request['stranrodictamen'] != ""){
        $this->stranrodictamen= $request['stranrodictamen'];
     }


     if($request['strpersonas'] != ""){
        $this->strpersonas= $request['strpersonas'];
     }


     if($request['bolborrado'] != ""){
        $this->bolborrado= $request['bolborrado'];
     }
     
     if($request['id_tipo_organismo'] != ""){
        $this->id_tipo_organismo= $request['id_tipo_organismo'];
     }


     if($request['id_organismo'] != ""){
        $this->id_organismo= $request['id_organismo'];
     }
     

}//=========================== GET ===================




    public function getId_dictamen(){
        return $this->id_dictamen;
    }



    public function getId_usuario(){
        return $this->id_usuario;
    }



    public function getId_materia(){
        return $this->id_materia;
    }



    public function getId_tipo_materia(){
        return $this->id_tipo_materia;
    }



    public function getId_instituto(){
        return $this->id_instituto;
    }



    public function getId_estado(){
        return $this->id_estado;
    }



    public function getFecdictamen(){
        return $this->fecdictamen;
    }



    public function getStrtitulo(){
        return $this->strtitulo;
    }



    public function getStrasunto(){
        return $this->strasunto;
    }



    public function getStranrodictamen(){
        return $this->stranrodictamen;
    }



    public function getStrpersonas(){
        return $this->strpersonas;
    }



    public function getBolborrado(){
        return $this->bolborrado;
    }


    public function getId_tipo_organismo(){
        return $this->id_tipo_organismo;
    }



    public function getId_organismo(){
        return $this->id_organismo;
    }



//=========================== SET ===================




    public function setId_dictamen($id_dictamen){
        return $this->id_dictamen=$id_dictamen;
    }



    public function setId_usuario($id_usuario){
        return $this->id_usuario=$id_usuario;
    }



    public function setId_materia($id_materia){
        return $this->id_materia=$id_materia;
    }



    public function setId_tipo_materia($id_tipo_materia){
        return $this->id_tipo_materia=$id_tipo_materia;
    }



    public function setId_instituto($id_instituto){
        return $this->id_instituto=$id_instituto;
    }



    public function setId_estado($id_estado){
        return $this->id_estado=$id_estado;
    }



    public function setFecdictamen($fecdictamen){
        return $this->fecdictamen=$fecdictamen;
    }



    public function setStrtitulo($strtitulo){
        return $this->strtitulo=$strtitulo;
    }



    public function setStrasunto($strasunto){
        return $this->strasunto=$strasunto;
    }



    public function setStranrodictamen($stranrodictamen){
        return $this->stranrodictamen=$stranrodictamen;
    }



    public function setStrpersonas($strpersonas){
        return $this->strpersonas=$strpersonas;
    }



    public function setBolborrado($bolborrado){
        return $this->bolborrado=$bolborrado;
    }


    public function setId_tipo_organismo($id_tipo_organismo){
        return $this->id_tipo_organismo=$id_tipo_organismo;
    }



    public function setId_organismo($id_organismo){
        return $this->id_organismo=$id_organismo;
    }

    
    public function selectDictamen($id_dictamen){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "SELECT id_dictamen, id_usuario, id_materia, id_tipo_materia, id_estado, 
       to_char(fecdictamen,'DD/MM/YYYY') as fecdictamen, strtitulo, strasunto, stranrodictamen, strpersonas, 
       bolborrado, id_tipo_organismo, id_organismo, ".
        $sql.=" (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= 			a.id_materia) AS id_materia_text, ";        
        $sql.=" (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= 			a.id_tipo_materia) AS id_tipo_materia_text, ";                
        $sql.=" (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= 			a.id_estado) AS id_estado_text, ";        
        $sql.=" (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= 			a.id_tipo_organismo) AS id_tipo_organismo_text, "; 
        $sql.=" (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= 			a.id_organismo) AS id_organismo_text ";
       $sql.=" from ".clConstantesModelo::correspondencia_table."tbldictamenes a Where a.id_dictamen=".$id_dictamen;
        //exit($sql);        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }          
    
    public function selectAllDictamen(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT a.*, ";
        $sql.=" (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= a.id_materia) AS id_materia_text, ";        
        $sql.=" (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= a.id_tipo_materia) AS id_tipo_materia_text, ";                
        $sql.=" (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= a.id_estado) AS id_estado_text, ";        
        $sql.=" (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= a.id_tipo_organismo) AS id_tipo_organismo_text, "; 
        $sql.=" (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= a.id_organismo) AS id_organismo_text ";        
        $sql.=" from ".clConstantesModelo::correspondencia_table."tbldictamenes a";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }    
    
    public function selectFiltrarDictamen($id_materia, $id_tipo_materia, $id_tipo_organismo, $id_organismo, $id_estado, $strtitulo, $stranrodictamen, $strpersonas ){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT a.*, ";
        $sql.=" (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= a.id_materia) AS id_materia_text, ";        
        $sql.=" (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= a.id_tipo_materia) AS id_tipo_materia_text, ";                
        $sql.=" (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= a.id_estado) AS id_estado_text, ";        
        $sql.=" (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= a.id_tipo_organismo) AS id_tipo_organismo_text, "; 
        $sql.=" (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= a.id_organismo) AS id_organismo_text ";        
        $sql.=" from ".clConstantesModelo::correspondencia_table."tbldictamenes a Where a.id_dictamen>0 ";
        if ($id_materia>0) 
          $sql.=" and id_materia=".$id_materia;
        if ($id_tipo_materia>0) 
          $sql.=" and id_tipo_materia=".$id_tipo_materia;            
        if ($id_tipo_organismo>0) 
          $sql.=" and id_tipo_organismo=".$id_tipo_organismo;                
        if ($id_organismo>0) 
          $sql.=" and id_organismo=".$id_organismo;             
        if ($id_estado>0)             
          $sql.=" and id_estado=".$id_estado;                 
        if ($strtitulo!='') 
          $sql.=" and upper(strtitulo) like '%".strtoupper($strtitulo)."%'";            
        if ($stranrodictamen!='') 
          $sql.=" and upper(stranrodictamen) like '%".strtoupper($stranrodictamen)."%'";        
        if ($strpersonas!='') 
          $sql.=" and upper(strpersonas) like '%".strtoupper($strpersonas)."%'";        

        //exit($sql);        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }      

//=========================== Insert ===================

public function insertDictamen()
{
    $conn= new Conexion();
    $conn->abrirConexion();
    $sql="Insert into ".clConstantesModelo::correspondencia_table."tbldictamenes (id_usuario,id_materia,id_tipo_materia,id_tipo_organismo,id_organismo,id_estado,fecdictamen,strtitulo,strasunto,stranrodictamen,strpersonas) 
        values (".$this->getId_usuario().",".$this->getId_materia().",".$this->getId_tipo_materia().",".$this->getId_tipo_organismo().",".$this->getId_organismo().",".$this->getId_estado().",TO_DATE('".$this->getFecdictamen()."', 'DD/MM/YYYY'),'".$this->getStrtitulo()."','".$this->getStrasunto()."','".$this->getStranrodictamen()."','".$this->getStrpersonas()."')";
   // exit($sql);
    $conn->sql=$sql;
    $data = $conn->ejecutarSentencia();
    $conn->cerrarConexion();    
    return $data;
}


//=========================== Update ===================




public function updateDictamen()
{
$conn= new Conexion();
$conn->abrirConexion();
    $sql="UPDATE ".clConstantesModelo::correspondencia_table."tbldictamenes SET
    id_materia=".$this->getId_materia().",
    id_tipo_materia=".$this->getId_tipo_materia().",
    id_estado=".$this->getId_estado().",
    id_tipo_organismo=".$this->getId_tipo_organismo().",
    id_organismo=".$this->getId_organismo().",        
    fecdictamen=TO_DATE('".$this->getFecdictamen()."','DD/MM/YYYY'),
    strtitulo='".$this->getStrtitulo()."',
    strasunto='".$this->getStrasunto()."',
    stranrodictamen='".$this->getStranrodictamen()."',
    strpersonas='".$this->getStrpersonas()."'
    where id_dictamen=".$this->getId_dictamen();
$conn->sql=$sql;
$data = $conn->ejecutarSentencia();
return $data;
}


//=========================== Delete ===================




public function Delete()
{
$conn= new Conexion();
$conn->abrirConexion();
$sql="UPDATE public.tbldictamenes SET
bolborrado=1
where id_dictamen=getId_dictamen()";
//exit($sql);
$conn->sql=$sql;
$data = $conn->ejecutarSentencia();
return $data;
}

 }
?>
