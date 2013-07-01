<?php
 require_once "../controlador/Conexion.php";
 /**
 * Description of clTblproexpediente
 * @author jmendoza
 */
 class clProExpedienteSituaciones {

//=========================== VAR ===================




  private   $id_proexpediente_situacion;

  private   $id_tipo_minuta;

  private   $id_minuta;

  private   $strobservacion;
  
  private   $id_proexpediente;

  private   $fecminuta;
  
  private   $id_estado_minuta;
 

//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     if($request['id_proexpediente_situacion'] != ""){
        $this->set_id_proexpediente($request['id_proexpediente_situacion']);
     }
     
     if($request['id_proexpediente'] != ""){
        $this->set_id_proexpediente($request['id_proexpediente']);
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


    public function set_id_proexpediente_situacion($id_proexpediente){
        return $this->id_proexpediente_situacion=$id_proexpediente;
    }

    public function set_id_proexpediente($id_proexpediente){
        return $this->id_proexpediente=$id_proexpediente;
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



    public function get_id_proexpediente_situacion(){
        return $this->id_proexpediente_situacion;
    }
    
    public function get_id_proexpediente(){
        return $this->id_proexpediente;
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
         $sql="Insert into public.tblproexpediente_situaciones (
         id_tipo_minuta,
         id_estado_minuta,         
         id_minuta,
         strobservacion,
         id_proexpediente,
         fecminuta
         ) VALUES ("
         .$this->get_id_tipo_minuta().","
         .$this->get_id_estado_minuta().","
         .$this->get_id_minuta().",'"                 
         .$this->get_strobservacion()."',"
         .$this->get_id_proexpediente().",TO_DATE('"
         .$this->get_fecminuta()."', 'DD/MM/YYYY'))";     
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
//================================FUNCION CONSULTAR===============================================


     public function SelectAll($id_expediente="",$id_expediente_situacion=""){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT 
         id_proexpediente_situacion,
         id_tipo_minuta,
         id_minuta,
         strobservacion,
         id_proexpediente,
         fecminuta as fecminutacompara,
         to_char(fecminuta,'DD/MM/YYYY') as fecminuta,
         id_estado_minuta
         FROM public.tblproexpediente_situaciones WHERE id_proexpediente=".$id_expediente ." AND bolborrado=0";
         if($id_expediente_situacion !=""){
             $sql .=" AND id_proexpediente_situacion=".$id_expediente_situacion;
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
      
         $sql="UPDATE public.tblproexpediente_situaciones SET
         id_tipo_minuta=".$this->get_id_tipo_minuta().",
         id_minuta=".$this->get_id_minuta().",
         id_estado_minuta=".$this->get_id_estado_minuta().",             
         strobservacion='".$this->get_strobservacion()."',
         fecminuta=TO_DATE('".$this->get_fecminuta()."', 'DD/MM/YYYY')                   
         WHERE id_proexpediente_situacion=".$id_expediente_situacion;
//         exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia();
         return $data;
    }
    
    function Delete($id_proexpediente){
        $conn= new Conexion();
         $conn->abrirConexion();
         $sql="UPDATE public.tblproexpediente_situaciones SET
         bolborrado=1
         WHERE id_proexpediente_situacion=".$id_proexpediente;
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia();
         return $data;
    }
    
    public function nextValExpediente() {
               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql="SELECT last_value as maximo FROM " . clConstantesModelo::correspondencia_table . "tblproexpediente_id_proexpediente_seq";
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
        $conn->sql= "SELECT strdocumentos FROM ".clConstantesModelo::correspondencia_table."tblproexpediente WHERE id_proexpediente= ".$expediente;
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
    
    public function SelectAllExpedientesFiltro($cedula_cliente="",$cedula_abogado_responsable="",$cedula_abogado_ejecutor="",$strexpediente=""){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT id_proexpediente,
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
             $sql .= " AND tblproexpediente.cedula_cliente LIKE '%$cedula_cliente%'";
         }
         if($cedula_abogado_responsable != ""){
             $sql .= " AND tblproexpediente.cedula_abogado_responsable LIKE '%$cedula_abogado_responsable%'";
         }
         if($cedula_abogado_ejecutor != ""){
             $sql .= " AND tblproexpediente.cedula_abogado_ejecutor LIKE '%$cedula_abogado_ejecutor%'";
         }
         if($strexpediente != ""){
             $sql .= " AND tblproexpediente.strnroexpediente LIKE '%$strexpediente%'";
         }
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }
    
    function cerrarExpediente($id_proexpediente){
        $conn= new Conexion();
         $conn->abrirConexion();
         $sql="UPDATE public.tblproexpediente SET
         feccierre=TO_DATE('".  date('d/m/Y')."','DD/MM/YYYY')
         WHERE id_proexpediente=".$id_proexpediente;
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia();
         return $data;
    }
    
    
     public function abrirSituacion($id_expediente,$fecha,$numero){
         $conn= new Conexion();
         $conn->abrirConexion();
         if($numero==1)
            $sql="Insert into public.tblproexpediente_situaciones (
            id_tipo_minuta,
            id_minuta,
            id_estado_minuta,
            strobservacion,
            id_proexpediente,
            fecminuta
            ) VALUES (0,0,0,'Caso Abierto',".$id_expediente.",TO_DATE('".$fecha."', 'DD/MM/YYYY'))";   
         else
            $sql="Insert into public.tblproexpediente_situaciones (
            id_tipo_minuta,
            id_minuta,
            id_estado_minuta,
            strobservacion,
            id_proexpediente,
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
