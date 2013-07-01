<?php
session_start();
 require_once '../controlador/Conexion.php';
 require_once '../modelo/clConstantesModelo.php';
 require_once '../modelo/clFunciones.php'; 
 
 /**
 * Description of clTbl_expediente_referidos
 * @author jsuarez
 */
 class clTbl_expediente_referidos {

//=========================== VAR ===================




  private   $lngcodigo;

  private   $tiempo_servicio;

  private   $fecingreso;

  private   $fecegreso;

  private   $motivo_culminacion_laboral;

  private   $cancelo_adelanto_prestaciones;

  private   $concepto;

  private   $monto;

  private   $id_expediente;

  private   $id_demandante;

  private   $monto_demanda;

  private   $bolborrado;

//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     $functions= new functions();       
    
     if($request['lngcodigo'] != ""){
        $this->lngcodigo= $request['lngcodigo'];
     }


     if($request['tiempo_servicio'] != ""){
        $this->tiempo_servicio= $request['tiempo_servicio'];
     }
     else $this->tiempo_servicio=0;

             


     if($request['fecingreso'] != ""){
        $this->fecingreso= $request['fecingreso'];
     }


     if($request['fecegreso'] != ""){
        $this->fecegreso= $request['fecegreso'];
     }


     if($request['motivo_culminacion_laboral'] != ""){
        $this->motivo_culminacion_laboral= $request['motivo_culminacion_laboral'];
     }


     if($request['cancelo_adelanto_prestaciones'] == 1){
        $this->cancelo_adelanto_prestaciones= 1;
     }
     else $this->cancelo_adelanto_prestaciones=0;


     if($request['concepto'] != ""){
        $this->concepto= $request['concepto'];
     }


     if($request['monto'] != ""){
        $this->monto= $functions->toFloat($request['monto']);
     }else{
          $this->monto=0.00;
     }     

//     exit('paso');


     if($request['id_expediente'] != ""){
        $this->id_expediente= $request['id_expediente'];
     }


     if($request['id_demandante'] != ""){
        $this->id_demandante= $request['id_demandante'];
     }


     if($request['monto_demanda'] != ""){
        $this->monto_demanda= $functions->toFloat($request['monto_demanda']);
     }else{
          $this->monto_demanda=0.00;
     }     
     

     if($request['bolborrado'] != ""){
        $this->bolborrado= $request['bolborrado'];
     }

}//=========================== GET ===================




    public function getLngcodigo(){
        return $this->lngcodigo;
    }


    public function getTiempo_servicio(){
        return $this->tiempo_servicio;
    }



    public function getFecingreso(){
        return $this->fecingreso;
    }



    public function getFecegreso(){
        return $this->fecegreso;
    }



    public function getMotivo_culminacion_laboral(){
        return $this->motivo_culminacion_laboral;
    }



    public function getCancelo_adelanto_prestaciones(){
        return $this->cancelo_adelanto_prestaciones;
    }



    public function getConcepto(){
        return $this->concepto;
    }



    public function getMonto(){
        return $this->monto;
    }



    public function getId_expediente(){
        return $this->id_expediente;
    }



    public function getId_demandante(){
        return $this->id_demandante;
    }



    public function getMonto_demanda(){
        return $this->monto_demanda;
    }



    public function getBolborrado(){
        return $this->bolborrado;
    }



//=========================== SET ===================




    public function setLngcodigo($lngcodigo){
        return $this->lngcodigo=$lngcodigo;
    }


    public function setTiempo_servicio($tiempo_servicio){
        return $this->tiempo_servicio=$tiempo_servicio;
    }



    public function setFecingreso($fecingreso){
        return $this->fecingreso=$fecingreso;
    }



    public function setFecegreso($fecegreso){
        return $this->fecegreso=$fecegreso;
    }



    public function setMotivo_culminacion_laboral($motivo_culminacion_laboral){
        return $this->motivo_culminacion_laboral=$motivo_culminacion_laboral;
    }



    public function setCancelo_adelanto_prestaciones($cancelo_adelanto_prestaciones){
        return $this->cancelo_adelanto_prestaciones=$cancelo_adelanto_prestaciones;
    }



    public function setConcepto($concepto){
        return $this->concepto=$concepto;
    }



    public function setMonto($monto){
        return $this->monto=$monto;
    }



    public function setId_expediente($id_expediente){
        return $this->id_expediente=$id_expediente;
    }



    public function setId_demandante($id_demandante){
        return $this->id_demandante=$id_demandante;
    }



    public function setMonto_demanda($monto_demanda){
        return $this->monto_demanda=$monto_demanda;
    }



    public function setBolborrado($bolborrado){
        return $this->bolborrado=$bolborrado;
    }



//=========================== Insert ===================

     public function Select($id_demandante,$id_expediente){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT 
            lngcodigo, 
            tiempo_servicio, 
            to_char(fecingreso,'DD/MM/YYYY') as fecingreso,            
            to_char(fecegreso,'DD/MM/YYYY') as fecegreso,        
            motivo_culminacion_laboral, 
            cancelo_adelanto_prestaciones, 
            concepto, 
            monto, 
            id_expediente, 
            id_demandante, 
            monto_demanda
         FROM public.tbl_expediente_referidos WHERE bolborrado=0 and id_demandante=".$id_demandante." and id_expediente=".$id_expediente;
//         echo $sql;
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }    
    
    public function insertar()
    {
    $conn= new Conexion();
    $conn->abrirConexion();
    $sql="Insert 
        into public.tbl_expediente_referidos 
        (
            tiempo_servicio,
            fecingreso,
            fecegreso,
            motivo_culminacion_laboral,
            cancelo_adelanto_prestaciones,
            concepto,
            monto,
            id_expediente,
            id_demandante,
            monto_demanda
        ) 
        values 
        (";
            $sql.=$this->getTiempo_servicio()."";
            $sql.=",TO_DATE('".$this->getFecingreso()."', 'DD/MM/YYYY')";
            $sql.=",TO_DATE('".$this->getFecegreso()."', 'DD/MM/YYYY'),";     
            $sql.="'".$this->getMotivo_culminacion_laboral()."',";        
            $sql.="'".$this->getCancelo_adelanto_prestaciones()."',";       
            $sql.="'".$this->getConcepto()."',"; 
            $sql.="".$this->getMonto().",";          
            $sql.="".$this->getId_expediente().",";          
            $sql.="".$this->getId_demandante().",";          
            $sql.="".$this->getMonto_demanda();          
        $sql.=")";
//    exit($sql);
    $conn->sql=$sql;
    $data = $conn->ejecutarSentencia();
    return $data;
    
    
    }


//=========================== Update ===================




    public function update()
    {
    $conn= new Conexion();
    $conn->abrirConexion();
    $sql="UPDATE public.tbl_expediente_referidos SET
        tiempo_servicio=".$this->getTiempo_servicio().",
        fecingreso=TO_DATE('".$this->getFecingreso()."', 'DD/MM/YYYY'),
        fecegreso=TO_DATE('".$this->getFecegreso()."', 'DD/MM/YYYY'),
        motivo_culminacion_laboral='".$this->getMotivo_culminacion_laboral()."',
        cancelo_adelanto_prestaciones='".$this->getCancelo_adelanto_prestaciones()."',
        concepto='".$this->getConcepto()."',
        monto=".$this->getMonto().",
        monto_demanda=".$this->getMonto_demanda()."
        where lngcodigo=".$this->getLngcodigo();
//    exit($sql);
    $conn->sql=$sql;
    $data = $conn->ejecutarSentencia();
    return $data;
    }


//=========================== Delete ===================




public function Delete()
{
$conn= new Conexion();
$conn->abrirConexion();
$sql="UPDATE public.tbl_expediente_referidos SET
bolborrado=1
where lngcodigo=getLngcodigo()";
//exit($sql);
$conn->sql=$sql;
$data = $conn->ejecutarSentencia();
return $data;
}



 } 
?>
