<?php
 session_start();
 require_once '../controlador/Conexion.php';
 require_once '../modelo/clConstantesModelo.php';
 /**
 * Description of clTblagenda
 * @author jsuarez
 */
 class cltblproactuaciones_litigio {

//=========================== VAR ===================




  private   $id_litigio_actuaciones;

  private   $id_proactuacion;

  private   $stronombreactuacion;

  private   $fecactuacion;

  private   $bolborrado;

  private   $strdescripcionactuacion;

  private   $strexpedientetribunal;

  private   $anexa_agenda;
  
  
//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     if($request['id_proexpediente_actuaciones'] != ""){
        $this->id_litigio_actuaciones= $request['id_proexpediente_actuaciones'];
     }


     if($request['id_proactuacion'] != ""){
        $this->id_proactuacion= $request['id_proactuacion'];
     }


     if($request['stronombreactuacion'] != ""){
        $this->stronombreactuacion= $request['stronombreactuacion'];
     }


     if($request['fecactuacion'] != ""){
        $this->fecactuacion= $request['fecactuacion'];
     }


     if($request['bolborrado'] != ""){
        $this->bolborrado= $request['bolborrado'];
     }


     if($request['strdescripcionactuacion'] != ""){
        $this->strdescripcionactuacion= $request['strdescripcionactuacion'];
     }


     if($request['strexpedientetribunal'] != ""){
        $this->strexpedientetribunal= $request['strexpedientetribunal'];
     }


     if($request['id_anexa_actuacion'] != ""){
        $this->anexa_agenda= $request['id_anexa_actuacion'];
     }
     
     
}//=========================== GET ===================


    public function getId_litigio_actuaciones(){
        return $this->id_litigio_actuaciones;
    }



    public function getId_proactuacion(){
        return $this->id_proactuacion;
    }



    public function getStronombreactuacion(){
        return $this->stronombreactuacion;
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



    public function getAnexa_agenda(){
        return $this->anexa_agenda;
    }

    
//=========================== SET ===================





    public function setId_litigio_actuaciones($id_litigio_actuaciones){
        return $this->id_litigio_actuaciones=$id_litigio_actuaciones;
    }



    public function setId_proactuacion($id_proactuacion){
        return $this->id_proactuacion=$id_proactuacion;
    }



    public function setStronombreactuacion($stronombreactuacion){
        return $this->stronombreactuacion=$stronombreactuacion;
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



    public function setAnexa_agenda($anexa_agenda){
        return $this->anexa_agenda=$anexa_agenda;
    }


public function insertar($id_proactuacion,$id_tipo_organismo_centralizado,$id_tipo_organismo)
{
    $conn= new Conexion();
    $conn->abrirConexion();
    $sql="Insert into public.tblproactuaciones_litigio 
    (
        id_proactuacion, 
        stronombreactuacion, 
        fecactuacion, 
        strdescripcionactuacion, 
        anexa_agenda
    ) 
    values 
    (
        ".$id_proactuacion.",
        '".$this->getStronombreactuacion()."',
        TO_DATE('".$this->getFecactuacion()."', 'DD/MM/YYYY'),
        '".$this->getStrdescripcionactuacion()."',
        ".$this->getAnexa_agenda().")";
//    exit($sql);
    $conn->sql = $sql;
    $conn->ejecutarSentencia();

    if ($this->getAnexa_agenda()==clConstantesModelo::anexa_actuacion_agenda)
    {
        $sql_agenda="INSERT INTO public.tblagenda (id_usuario, id_tipo, id_evento, id_prioridad, id_estado,id_recordatorio, id_unidad, fecagenda, strdescripcion, strtitulo,id_expediente, id_tipo_organismo, id_organismo, strpersona, id_refiere, id_contacto, date, origen,tipo_expediente) values (".$_SESSION['id_contacto'].",13221,13216,13205,13212,13208,12015,TO_DATE('".$this->getFecactuacion()."', 'DD/MM/YYYY'),'".$this->getStrdescripcionactuacion()."','".$this->getStronombreactuacion()."',".$this->getId_proactuacion().",".$id_tipo_organismo_centralizado.",".$id_tipo_organismo.",'".$_SESSION['strapellido'].", ".$_SESSION['strnombre']."',13225,0,'2013/01/03, 02:44:30 pm','E',1)";    
        $conn->sql = $sql_agenda;
        $conn->ejecutarSentencia();
        $sql="SELECT last_value as maximo FROM " . clConstantesModelo::correspondencia_table . "tblagenda_id_agenda_seq";
        $conn->sql = $sql;
        $data = $conn->ejecutarSentencia (2);
        if ($data) $id_seguimiento=$data[0]['maximo'];
        //refiere todo el departamento        
        $sql_contacto= "SELECT  *  from ".clConstantesModelo::correspondencia_table."tblcontacto  where id_coord_maestro=12015";
        $conn->sql= $sql_contacto;
        $datos= $conn->ejecutarSentencia(2);   
            for ($i= 0; $i < count($datos); $i++){
                $sql_dos= "INSERT INTO ".clConstantesModelo::correspondencia_table."tblagenda (id_usuario, id_tipo, id_evento, id_prioridad, id_estado,id_recordatorio, id_unidad, fecagenda, strdescripcion, strtitulo,id_expediente, id_tipo_organismo, id_organismo, strpersona, id_refiere, date, id_seguimiento, origen,tipo_expediente) values ";
                $sql_dos.= "(".$datos[$i][id_contacto].",13221,13216,13205,13212,13208,".$_SESSION['id_coord_maestro'].",TO_DATE('".$this->getFecactuacion()."', 'DD/MM/YYYY'),'".$this->getStrdescripcionactuacion()."','".$this->getStronombreactuacion()."',".$this->getId_proactuacion().",".$id_tipo_organismo_centralizado.",".$id_tipo_organismo.",'".$_SESSION['strapellido'].", ".$_SESSION['strnombre']."',13225,TO_DATE('".$this->getFecactuacion()."', 'DD/MM/YYYY'),".$id_seguimiento.",'R',".clConstantesModelo::$TIPO_EXPEDIENTE['litigio'].")";
    //exit($sql_dos);            
                $conn->sql=$sql_dos;
                $conn->ejecutarSentencia();                
            }  
    }
   
    $conn->cerrarConexion();    
    
    return true;
}


//=========================== Update ===================




public function update()
{
    $conn= new Conexion();
    $conn->abrirConexion();
    $sql="
       UPDATE 
          tblproactuaciones_litigio
       SET 
       stronombreactuacion='".$this->getStronombreactuacion()."', 
       fecactuacion=TO_DATE('".$this->getFecactuacion()."', 'DD/MM/YYYY'), 
       strdescripcionactuacion='".$this->getStrdescripcionactuacion()."',
       strexpedientetribunal='".$this->getStrexpedientetribunal()."',
       anexa_agenda=".$this->getAnexa_agenda()." 
       WHERE
       id_litigio_actuaciones=".$this->getId_litigio_actuaciones();
//    exit($sql);
    $conn->sql = $sql;
    $conn->ejecutarSentencia ();
    $conn->cerrarConexion ();
    return true;
}


//=========================== Delete ===================




    public function Delete($id_litigio_actuaciones)
    {
    $conn= new Conexion();
    $conn->abrirConexion();
    $sql="UPDATE public.tblproactuaciones_litigio SET
    bolborrado=1
       WHERE
       id_litigio_actuaciones=".$id_litigio_actuaciones;
//    exit($sql);
    $conn->sql=$sql;
    $data = $conn->ejecutarSentencia();
    return $data;
    }
    
     public function selectAllActuacionesExpedienteLitigio($id_expediente="") {
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql = "";
         $sql = "SELECT
                 b.id_litigio_actuaciones, 
                 b.id_proactuacion, 
                 b.stronombreactuacion, 
                 to_char(b.fecactuacion,'DD/MM/YYYY') as fecactuacion,
                 b.bolborrado, 
                 b.strdescripcionactuacion, 
                 b.strexpedientetribunal, 
                 b.anexa_agenda,
                (SELECT stritema FROM " . clConstantesModelo::scsd_table . "tblmaestros a1 WHERE a1.id_maestro=b.anexa_agenda) AS  anexa_agenda_text
            from
            " . clConstantesModelo::scsd_table . "tblproactuaciones_litigio b where bolborrado=0 and b.id_proactuacion=".$id_expediente;
//       exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;  
     }

     public function selectDetalleActuacionExpedienteLitigio($id_proactuaciones,$id_expediente_actuacion) {
               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql = "SELECT
                        b.id_litigio_actuaciones, 
                        b.id_proactuacion, 
                        b.stronombreactuacion, 
                        to_char(b.fecactuacion,'DD/MM/YYYY') as fecactuacion,
                        b.bolborrado, 
                        b.strdescripcionactuacion, 
                        b.strexpedientetribunal, 
                        b.anexa_agenda                   
                    from
                    " . clConstantesModelo::scsd_table . "tblproactuaciones_litigio b"; 
                   $sql.=" where bolborrado=0 and id_litigio_actuaciones=".$id_proactuaciones." and id_proactuacion=".$id_expediente_actuacion;
//                  exit($sql);
               $conn->sql = $sql;
               $data = $conn->ejecutarSentencia (2);
               $conn->cerrarConexion ();
               return $data;
     } 
    
    
 } 
?>
