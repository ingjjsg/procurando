<?php
 require_once "../controlador/Conexion.php";
 /**
 * Description of clTblproexpediente
 * @author jmendoza
 */
 class clProActuacionSituaciones {

//=========================== VAR ===================


  const TABLA='tblactuacion_situaciones';
  
  const TABLA_ACTUACIONES='tblactuaciones';

  private   $id_proactuacion_situacion;

  private   $id_tipo_minuta;

  private   $id_minuta;

  private   $strobservacion;
  
  private   $id_proactuacion;

  private   $fecminuta;
  
  private   $id_estado_minuta;
 

//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     if($request['id_proexpediente_situacion'] != ""){
        $this->set_id_proactuacion_situacion($request['id_proexpediente_situacion']);
     }
     
     if($request['id_proexpediente'] != ""){
        $this->set_id_proactuacion($request['id_proexpediente']);
     }

     if($request['id_tipo_minuta'] != ""){
        $this->set_id_tipo_minuta($request['id_tipo_minuta']);
     }


     if($request['id_minuta'] != ""){
        $this->set_id_minuta($request['id_minuta']);
     }

     if($request['fecminuta'] != ""){
        $this->set_fecminuta($request['fecminuta']);
     }

     if($request['strobservacion'] != ""){
        $this->set_strobservacion($request['strobservacion']);
     }
     
     if($request['id_estado_minuta'] != ""){
        $this->set_id_estado_minuta($request['id_estado_minuta']);
     }     

}
//=========================== SET ===================


    public function set_id_proactuacion_situacion($id_proexpediente){
        return $this->id_proactuacion_situacion=$id_proexpediente;
    }

    public function set_id_proactuacion($id_proexpediente){
        return $this->id_proactuacion=$id_proexpediente;
    }

    
    public function set_id_tipo_minuta($id_tipo_minuta){
        return $this->id_tipo_minuta=$id_tipo_minuta;
    }



    public function set_id_minuta($id_minuta){
        return $this->id_minuta=$id_minuta;
    }


    public function set_strobservacion($strobservacion){
        return $this->strobservacion=$strobservacion;
    }


    public function set_fecminuta($fecminuta){
        return $this->fecminuta=$fecminuta;
    }
    
    public function set_id_estado_minuta($id_estado_minuta){
        return $this->id_estado_minuta=$id_estado_minuta;
    }    



//
//
////=========================== GET ===================



    public function get_id_proactuacion_situacion(){
        return $this->id_proactuacion_situacion;
    }
    
    public function get_id_proactuacion(){
        return $this->id_proactuacion;
    }


    public function get_id_tipo_minuta(){
        return $this->id_tipo_minuta;
    }



    public function get_id_minuta(){
        return $this->id_minuta;
    }



    public function get_strobservacion(){
        return $this->strobservacion;
    }


    public function get_fecminuta(){
        return $this->fecminuta;
    }
    
    public function get_id_estado_minuta(){
        return $this->id_estado_minuta;
    }    

   







//================================FUNCION INSERTAR============================================


     public function insertar(){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="Insert into public.".self::TABLA." (
         id_tipo_minuta,
         id_estado_minuta,         
         id_minuta,
         strobservacion,
         id_proactuacion,
         fecminuta
         ) VALUES ("
         .$this->get_id_tipo_minuta().","
         .$this->get_id_minuta().","
         .$this->get_id_estado_minuta().",'"                 
         .$this->get_strobservacion()."',"
         .$this->get_id_proactuacion().",TO_DATE('"
         .$this->get_fecminuta()."', 'DD/MM/YYYY'))";     
         //exit($sql);
         $conn->sql=$sql;
         if($conn->ejecutarSentencia()){
             $retorno=true;
         }else{
             $retorno=false;
         }
         
         $conn->cerrarConexion();
         return $retorno;
    }
//================================FUNCION CONSULTAR===============================================


     public function SelectAll($id_expediente="",$id_expediente_situacion=""){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT 
         id_proactuacion_situacion,
         id_tipo_minuta,
         id_minuta,
         strobservacion,
         id_proactuacion,
         fecminuta as fecminutacompara,
         to_char(fecminuta,'DD/MM/YYYY') as fecminuta,
         id_estado_minuta
         FROM public.".self::TABLA." WHERE id_proactuacion=".$id_expediente ." AND bolborrado=0";
         if($id_expediente_situacion !=""){
             $sql .=" AND id_proactuacion_situacion=".$id_expediente_situacion;
         }
//        exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }
//======================================FUNCION ACTUALIZAR===============================================


     public function Update($id_expediente_situacion){
         
         $conn= new Conexion();
         $conn->abrirConexion();
      
         $sql="UPDATE public.".self::TABLA." SET
         id_tipo_minuta=".$this->get_id_tipo_minuta().",
         id_minuta=".$this->get_id_minuta().",
         id_estado_minuta=".$this->get_id_estado_minuta().",             
         strobservacion='".$this->get_strobservacion()."',
         fecminuta=TO_DATE('".$this->get_fecminuta()."', 'DD/MM/YYYY')                   
         WHERE id_proactuacion_situacion=".$id_expediente_situacion;
//         exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia();
         return $data;
    }
    
    function Delete($id_proexpediente){
        $conn= new Conexion();
         $conn->abrirConexion();
         $sql="UPDATE public.".self::TABLA." SET
         bolborrado=1
         WHERE id_proactuacion_situacion=".$id_proexpediente;
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia();
         return $data;
    }
    
    public function nextValExpediente() {
               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql="SELECT last_value as maximo FROM " . clConstantesModelo::correspondencia_table . "tblactuaciones_id_proactuacion_seq";
               $conn->sql = $sql;
               $data = $conn->ejecutarSentencia (2);
               if ($data)
               {
                    $maximo=$data[0]['maximo'];
               }
               $conn->cerrarConexion ();
               return $maximo;
     }
     
     public function selectDocumentos($expediente){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT strdocumentos FROM ".clConstantesModelo::correspondencia_table.self::TABLA_ACTUACIONES." WHERE id_proactuacion= ".$expediente;
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
    
    public function SelectAllExpedientesFiltro($cedula_cliente="",$cedula_abogado_responsable="",$cedula_abogado_ejecutor="",$strexpediente=""){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT id_proactuacion,
         id_proclientecasos,
                  id_proabogadoscasos,
         id_documentoscasos,
         id_usuario,
         id_tramita,
         id_materia,
         id_estatus,
         strnroexpediente,
         strtitulo,
         strdescripcion,
         strrefer,
         to_char(fecapertura,'DD/MM/YYYY') as fecapertura,
         to_char(feccierre,'DD/MM/YYYY') as feccierre,
         cedula_abogado_responsable,
         cedula_abogado_ejecutor,
         cedula_cliente,
         strletrado,
         id_actuacion,
         id_tipo_tramite,
         id_tipo_atencion,
         id_tipo_organismo,
         id_organismo,
         id_tipo_minuta,
         id_minuta,
         strobservacion,
         to_char(fecexpediente,'DD/MM/YYYY') as fecexpediente,
         strdireccion_asistido,
         strdireccion_conyugue,
         strdireccion_ultimo_domicilio,
         to_char(fecseparacion,'DD/MM/YYYY') as fecseparacion,
         intmonto_manutencion,
         int_monto_familiar,
         strdocumentos FROM public.tblproexpediente WHERE bolborrado=0";
         if($cedula_cliente != ""){
             $sql .= " AND ".self::TABLA_ACTUACIONES.".cedula_cliente LIKE '%$cedula_cliente%'";
         }
         if($cedula_abogado_responsable != ""){
             $sql .= " AND ".self::TABLA_ACTUACIONES.".cedula_abogado_responsable LIKE '%$cedula_abogado_responsable%'";
         }
         if($cedula_abogado_ejecutor != ""){
             $sql .= " AND ".self::TABLA_ACTUACIONES.".cedula_abogado_ejecutor LIKE '%$cedula_abogado_ejecutor%'";
         }
         if($strexpediente != ""){
             $sql .= " AND ".self::TABLA_ACTUACIONES.".strnroexpediente LIKE '%$strexpediente%'";
         }
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }
    
    function cerrarExpediente($id_proexpediente){
        $conn= new Conexion();
         $conn->abrirConexion();
         $sql="UPDATE public.".self::TABLA_ACTUACIONES." SET
         feccierre=TO_DATE('".  date('d/m/Y')."','DD/MM/YYYY')
         WHERE id_proactuacion=".$id_proexpediente;
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia();
         return $data;
    }
    
    
     public function abrirSituacion($id_expediente,$fecha,$numero){
         $conn= new Conexion();
         $conn->abrirConexion();
         if($numero==1)
            $sql="Insert into public.".self::TABLA." (
            id_tipo_minuta,
            id_minuta,
            id_estado_minuta,
            strobservacion,
            id_proactuacion,
            fecminuta
            ) VALUES (0,0,0,'Caso Abierto',".$id_expediente.",TO_DATE('".$fecha."', 'DD/MM/YYYY'))";   
         else
            $sql="Insert into public.".self::TABLA." (
            id_tipo_minuta,
            id_minuta,
            id_estado_minuta,
            strobservacion,
            id_proactuacion,
            fecminuta
            ) VALUES (0,0,0,'Caso Cerrado',".$id_expediente.",TO_DATE('".date('d/m/Y')."','DD/MM/YYYY'))";              
//         exit($sql);
         $conn->sql=$sql;
         if($conn->ejecutarSentencia()){
             $retorno=true;
         }else{
             $retorno=false;
         }
         
         $conn->cerrarConexion();
         return $retorno;
    }    
    
    
    
 }
?>
