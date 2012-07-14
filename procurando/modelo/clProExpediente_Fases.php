<?php
session_start();
 require_once '../controlador/Conexion.php';
 /**
 * Description of clTblproexpediente_fases
 * @author jsuarez
 */
 class clTblproexpediente_fases {

//=========================== VAR ===================




  private   $id_proexpediente_fase;

  private   $id_tipo_fase;

  private   $id_fase;

  private   $strobservacionfase;

  private   $id_proexpediente;

  private   $fecfase;

  private   $bolborrado;

//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     if($request['id_proexpediente_fase'] != ""){
        $this->id_proexpediente_fase= $request['id_proexpediente_fase'];
     }


     if($request['id_tipo_fase'] != ""){
        $this->id_tipo_fase= $request['id_tipo_fase'];
     }


     if($request['id_fase'] != ""){
        $this->id_fase= $request['id_fase'];
     }


     if($request['strobservacionfase'] != ""){
        $this->strobservacionfase= $request['strobservacionfase'];
     }


     if($request['id_proexpediente'] != ""){
        $this->id_proexpediente= $request['id_proexpediente'];
     }


     if($request['fecfase'] != ""){
        $this->fecfase= $request['fecfase'];
     }


     if($request['bolborrado'] != ""){
        $this->bolborrado= $request['bolborrado'];
     }

}
//=========================== GET ===================




    public function getId_proexpediente_fase(){
        return $this->id_proexpediente_fase;
    }



    public function getId_tipo_fase(){
        return $this->id_tipo_fase;
    }



    public function getId_fase(){
        return $this->id_fase;
    }



    public function getStrobservacionfase(){
        return $this->strobservacionfase;
    }



    public function getId_proexpediente(){
        return $this->id_proexpediente;
    }



    public function getFecfase(){
        return $this->fecfase;
    }



    public function getBolborrado(){
        return $this->bolborrado;
    }



//=========================== SET ===================




    public function setId_proexpediente_fase($id_proexpediente_fase){
        return $this->id_proexpediente_fase=$id_proexpediente_fase;
    }



    public function setId_tipo_fase($id_tipo_fase){
        return $this->id_tipo_fase=$id_tipo_fase;
    }



    public function setId_fase($id_fase){
        return $this->id_fase=$id_fase;
    }



    public function setStrobservacionfase($strobservacionfase){
        return $this->strobservacionfase=$strobservacionfase;
    }



    public function setId_proexpediente($id_proexpediente){
        return $this->id_proexpediente=$id_proexpediente;
    }



    public function setFecfase($fecfase){
        return $this->fecfase=$fecfase;
    }



    public function setBolborrado($bolborrado){
        return $this->bolborrado=$bolborrado;
    }




//================================FUNCION INSERTAR============================================


     public function insertar(){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="Insert into ".clConstantesModelo::correspondencia_table."tblproexpediente_fases (
         id_tipo_fase, id_fase, strobservacion, 
            id_proexpediente, fecfase) VALUES ("
         .$this->getId_tipo_fase().","
         .$this->getId_fase().",'"
         .$this->getStrobservacionfase()."',"
         .$this->getId_proexpediente().",TO_DATE('"
         .$this->getFecfase()."', 'DD/MM/YYYY'))";     
         $conn->sql=$sql;
         if($conn->ejecutarSentencia()){
             $retorno=true;
         }else{
             $retorno=false;
         }
         
         $conn->cerrarConexion();
         return $retorno;
    }

//======================================FUNCION ACTUALIZAR===============================================


     public function Update($id_expediente_fase){
         
         $conn= new Conexion();
         $conn->abrirConexion();
      
         $sql="UPDATE ".clConstantesModelo::correspondencia_table."tblproexpediente_fases SET
         id_tipo_fase=".$this->getId_tipo_fase().",
         id_fase=".$this->getId_fase().",
         strobservacion='".$this->getStrobservacionfase()."',
         fecfase=TO_DATE('".$this->getFecfase()."', 'DD/MM/YYYY')                   
         WHERE id_proexpediente_fase=".$id_expediente_fase;
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia();
         return $data;
    }
    
    function Delete($id_proexpediente){
        $conn= new Conexion();
         $conn->abrirConexion();
         $sql="UPDATE ".clConstantesModelo::correspondencia_table."tblproexpediente_fases SET
         bolborrado=1
         WHERE id_proexpediente_fase=".$id_proexpediente;
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia();
         return $data;
    }
    
     public function SelectAll($id_expediente="",$id_expediente_fase=""){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT 
         id_proexpediente_fase, id_tipo_fase, id_fase, strobservacion, 
         id_proexpediente,
         to_char(fecfase,'DD/MM/YYYY') as fecfase
         FROM ".clConstantesModelo::correspondencia_table."tblproexpediente_fases WHERE id_proexpediente=".$id_expediente ." AND bolborrado=0";
         if($id_expediente_fase !=""){
             $sql .=" AND id_proexpediente_fase=".$id_expediente_fase;
         }
//        exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }    

 } 
?>
