<?php
 session_start();
 require_once '../controlador/Conexion.php';
 require_once '../modelo/clConstantesModelo.php';
 /**
 * Description of clTblagenda
 * @author jsuarez
 */
 class clTblproexpediente_actuaciones {

//=========================== VAR ===================




  private   $id_proexpediente_actuaciones;

  private   $id_tipo_actuacion;

  private   $id_actuacion;

  private   $id_escrito;

  private   $strobservacion;

  private   $id_proexpediente;

  private   $fecactuacion;

  private   $bolborrado;

  private   $strdescripcionactuacion;

  private   $strexpedientetribunal;
  
  
//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     if($request['id_proexpediente_actuaciones'] != ""){
        $this->id_proexpediente_actuaciones= $request['id_proexpediente_actuaciones'];
     }


     if($request['id_tipo_actuacion'] != ""){
        $this->id_tipo_actuacion= $request['id_tipo_actuacion'];
     }


     if($request['id_actuacion'] != ""){
        $this->id_actuacion= $request['id_actuacion'];
     }


     if($request['id_escrito'] != ""){
        $this->id_escrito= $request['id_escrito'];
     }


     if($request['actu_strobservacion'] != ""){
        $this->strobservacion= $request['actu_strobservacion'];
     }


     if($request['id_proexpediente'] != ""){
        $this->id_proexpediente= $request['id_proexpediente'];
     }


     if($request['fecactuacion'] != ""){
        $this->fecactuacion= $request['fecactuacion'];
     }
     else $this->fecactuacion=date('d/m/Y');


     if($request['bolborrado'] != ""){
        $this->bolborrado= $request['bolborrado'];
     }


     if($request['strdescripcionactuacion'] != ""){
        $this->strdescripcionactuacion= $request['strdescripcionactuacion'];
     }
     else $this->strdescripcionactuacion="";


     if($request['strexpedientetribunal'] != ""){
        $this->strexpedientetribunal= $request['strexpedientetribunal'];
     }
     else  $this->strexpedientetribunal="";
    
     
     
}//=========================== GET ===================



    public function getId_proexpediente_actuaciones(){
        return $this->id_proexpediente_actuaciones;
    }



    public function getId_tipo_actuacion(){
        return $this->id_tipo_actuacion;
    }



    public function getId_actuacion(){
        return $this->id_actuacion;
    }



    public function getId_escrito(){
        return $this->id_escrito;
    }



    public function getStrobservacion(){
        return $this->strobservacion;
    }



    public function getId_proexpediente(){
        return $this->id_proexpediente;
    }



    public function getFecactuacion(){
        return $this->fecactuacion;
    }



    public function getBolborrado(){
        return $this->bolborrado;
    }



    public function getStrdescripcionactuacion(){
        return $this->strdescripcionactuacion;
    }



    public function getStrexpedientetribunal(){
        return $this->strexpedientetribunal;
    }
    
//=========================== SET ===================




    public function setId_proexpediente_actuaciones($id_proexpediente_actuaciones){
        return $this->id_proexpediente_actuaciones=$id_proexpediente_actuaciones;
    }



    public function setId_tipo_actuacion($id_tipo_actuacion){
        return $this->id_tipo_actuacion=$id_tipo_actuacion;
    }



    public function setId_actuacion($id_actuacion){
        return $this->id_actuacion=$id_actuacion;
    }



    public function setId_escrito($id_escrito){
        return $this->id_escrito=$id_escrito;
    }



    public function setStrobservacion($strobservacion){
        return $this->strobservacion=$strobservacion;
    }



    public function setId_proexpediente($id_proexpediente){
        return $this->id_proexpediente=$id_proexpediente;
    }



    public function setFecactuacion($fecactuacion){
        return $this->fecactuacion=$fecactuacion;
    }



    public function setBolborrado($bolborrado){
        return $this->bolborrado=$bolborrado;
    }



    public function setStrdescripcionactuacion($strdescripcionactuacion){
        return $this->strdescripcionactuacion=$strdescripcionactuacion;
    }



    public function setStrexpedientetribunal($strexpedientetribunal){
        return $this->strexpedientetribunal=$strexpedientetribunal;
    }


public function insertar()
{
    $conn= new Conexion();
    $conn->abrirConexion();
    $sql="Insert into public.tblproexpediente_actuaciones 
    (
    id_tipo_actuacion,
    id_actuacion,
    id_escrito,
    strobservacion,
    id_proexpediente,
    fecactuacion,
    strdescripcionactuacion,
    strexpedientetribunal) 
    values (
    ".$this->getId_tipo_actuacion().",
    ".$this->getId_actuacion().",
    ".$this->getId_escrito().",
    '".$this->getStrobservacion()."',
    ".$this->getId_proexpediente().",
    TO_DATE('".$this->getFecactuacion()."', 'DD/MM/YYYY'),
    '".$this->getStrdescripcionactuacion()."',
    '".$this->getStrexpedientetribunal()."')";
    $conn->sql = $sql;
    $conn->ejecutarSentencia();
    $conn->cerrarConexion();
    return true;
}


//=========================== Update ===================




public function update()
{
    $conn= new Conexion();
    $conn->abrirConexion();
    $sql="UPDATE public.tblproexpediente_actuaciones SET
    id_tipo_actuacion=".$this->getId_tipo_actuacion().",
    id_actuacion=".$this->getId_actuacion().",
    id_escrito=".$this->getId_escrito().",
    strobservacion='".$this->getStrobservacion()."',
    id_proexpediente=".$this->getId_proexpediente().",
    fecactuacion=TO_DATE('".$this->getFecactuacion()."', 'DD/MM/YYYY'),
    strdescripcionactuacion='".$this->getStrdescripcionactuacion()."',
    strexpedientetribunal='".$this->getStrexpedientetribunal()."'
    where id_proexpediente_actuaciones=".$this->getId_proexpediente_actuaciones();
//    exit($sql);
    $conn->sql = $sql;
    $conn->ejecutarSentencia ();
    $conn->cerrarConexion ();
    return true;
}


//=========================== Delete ===================




    public function Delete()
    {
    $conn= new Conexion();
    $conn->abrirConexion();
    $sql="UPDATE public.tblproexpediente_actuaciones SET
    bolborrado=1
    where id_proexpediente_actuaciones=getId_proexpediente_actuaciones()";
    //exit($sql);
    $conn->sql=$sql;
    $data = $conn->ejecutarSentencia();
    return $data;
    }
    
    
 } 
?>
