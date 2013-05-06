<?php
 session_start();
 require_once "../controlador/Conexion.php";
 require_once '../modelo/clFunciones.php'; 
// require_once '../herramientas/herramientas.class.php';     
 /**
 * Description of clTblproexpediente
 * @author jmendoza
 */
 class clActuaciones {

//=========================== VAR ===================



  const TABLA='tblactuaciones';
  
  private   $id_proactuacion;

  private   $id_usuario;

  private   $id_ano;

  private   $id_origen;

  private   $id_motivo;

  private   $id_fase;

  private   $id_actuacion;

  private   $id_tipo_organismo;

  private   $id_organismo;

  private   $id_refer;

  private   $id_estado_fisico_expediente;

  private   $id_tipo_espacio;

  private   $id_tipo_archivador;

  private   $id_tipo_piso_archivador;

  private   $id_tipo_archivador_gaveta;

  private   $strnroexpediente;

  private   $strdescripcion;

  private   $fecapertura;

  private   $feccierre;

  private   $fecexpediente;

  private   $intcuantias;

  private   $intsentenciado;

  private   $inttranzado;

  private   $intahorrado;

  private   $cedula_cliente;

  private   $strdocumentos;

  private   $strobservacion_cerrar;

  private   $strnroexpedienteauxiliar;

  private   $strrepresentante;

  private   $fecadmdem;

  private   $fecnotdem;

  private   $fecultnotordtri;

  private   $fecinsaudpre;

  private   $fecculfaspre;

  private   $feccondem;

  private   $fecadmpru;

  private   $fecjuiorapub;

  private   $fecpubsen;

  private   $fecapelacion;

  private   $bolborrado;
  
  private   $id_contrario;     
  
  private   $id_tipo_organismo_centralizado;

  
  private   $otrafase;
  
  private   $otromotivo;
  
  private   $id_abogado_resp;  
  
//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     $functions= new functions();       
     if($request['id_proactuacion'] != ""){
        $this->id_proactuacion= $request['id_proactuacion'];
     }


     if($_SESSION['id_contacto'] != ""){
        $this->id_usuario= $_SESSION['id_contacto'];
     }


     if($request['id_ano'] != ""){
        $this->id_ano= $request['id_ano'];
     }


     if($request['id_origen'] != ""){
        $this->id_origen= $request['id_origen'];
     }
     

     if($request['id_abogado_resp'] != ""){
        $this->id_abogado_resp= $request['id_abogado_resp'];
     }     


     if($request['id_motivo'] != ""){
        $this->id_motivo= $request['id_motivo'];
     }


     if($request['id_fase'] != ""){
        $this->id_fase= $request['id_fase'];
     }


     if($request['id_actuacion_persona'] != ""){
        $this->id_actuacion= $request['id_actuacion_persona'];
     }


     if($request['id_tipo_organismo'] != ""){
        $this->id_tipo_organismo= $request['id_tipo_organismo'];
     }
 else {
        $this->id_tipo_organismo= 0;         
     }


     if($request['id_organismo'] != ""){
        $this->id_organismo= $request['id_organismo'];
     }
 else {
        $this->id_organismo= 0;         
     }


     if($request['id_refer'] != ""){
        $this->id_refer= $request['id_refer'];
     }
     else $this->id_refer= 0;


     if($request['id_estado_fisico_expediente'] != ""){
        $this->id_estado_fisico_expediente= $request['id_estado_fisico_expediente'];
     }
     else $this->id_estado_fisico_expediente=0;


     if($request['id_tipo_espacio'] != ""){
        $this->id_tipo_espacio= $request['id_tipo_espacio'];
     }
     else $this->id_tipo_espacio=0;


     if($request['id_tipo_archivador'] != ""){
        $this->id_tipo_archivador= $request['id_tipo_archivador'];
     }
     else $this->id_tipo_archivador=0;


     if($request['id_tipo_piso_archivador'] != ""){
        $this->id_tipo_piso_archivador= $request['id_tipo_piso_archivador'];
     }
     else $this->id_tipo_piso_archivador= 0;


     if($request['id_tipo_archivador_gaveta'] != ""){
        $this->id_tipo_archivador_gaveta= $request['id_tipo_archivador_gaveta'];
     }
     else $this->id_tipo_archivador_gaveta= 0;


     if($request['strnroexpediente'] != ""){
        $this->strnroexpediente= $request['strnroexpediente'];
     }


     if($request['strdescripcion'] != ""){
        $this->strdescripcion= $request['strdescripcion'];
     }


     if($request['fecapertura'] != ""){
        $this->fecapertura= $request['fecapertura'];
     }


     if($request['feccierre'] != ""){
        $this->feccierre= $request['feccierre'];
     }


     if($request['fecexpediente'] != ""){
        $this->fecexpediente= $request['fecexpediente'];
     }


     if($request['intcuantias'] != ""){
        $this->intcuantias= $functions->toFloat($request['intcuantias']);
     }else{
          $this->intcuantias(0.00);
     }
     
//     if($request['intcuantias'] != ""){
////        $this->intcuantias($functions->toFloat($request['intcuantias']));
//        $this->intcuantias($request['intcuantias']);        
//     }else{
//          $this->intcuantias(0.00);
//     }     
//exit('pasi');     


     if($request['cedula_cliente'] != ""){
        $this->cedula_cliente= $request['cedula_cliente'];
     }


     if($request['strdocumentos'] != ""){
        $this->strdocumentos= $request['strdocumentos'];
     }


     if($request['strobservacion_cerrar'] != ""){
        $this->strobservacion_cerrar= $request['strobservacion_cerrar'];
     }


     if($request['strnroexpedienteauxiliar'] != ""){
        $this->strnroexpedienteauxiliar= $request['strnroexpedienteauxiliar'];
     }


     if($request['strrepresentante'] != ""){
        $this->strrepresentante= $request['strrepresentante'];
     }


     if($request['fecadmdem'] != ""){
        $this->fecadmdem= $request['fecadmdem'];
     }


     if($request['fecnotdem'] != ""){
        $this->fecnotdem= $request['fecnotdem'];
     }


     if($request['fecultnotordtri'] != ""){
        $this->fecultnotordtri= $request['fecultnotordtri'];
     }


     if($request['fecinsaudpre'] != ""){
        $this->fecinsaudpre= $request['fecinsaudpre'];
     }


     if($request['fecculfaspre'] != ""){
        $this->fecculfaspre= $request['fecculfaspre'];
     }


     if($request['feccondem'] != ""){
        $this->feccondem= $request['feccondem'];
     }


     if($request['fecadmpru'] != ""){
        $this->fecadmpru= $request['fecadmpru'];
     }


     if($request['fecjuiorapub'] != ""){
        $this->fecjuiorapub= $request['fecjuiorapub'];
     }


     if($request['fecpubsen'] != ""){
        $this->fecpubsen= $request['fecpubsen'];
     }


     if($request['fecapelacion'] != ""){
        $this->fecapelacion= $request['fecapelacion'];
     }


     if($request['bolborrado'] != ""){
        $this->bolborrado= $request['bolborrado'];
     }
     
     
     if($request['id_solicitante'] != ""){
        $this->id_contrario= $request['id_solicitante'];
     }
     else {
     $this->id_contrario=0;    
     }
     
     
     if($request['id_tipo_organismo_centralizado'] != ""){
        $this->id_tipo_organismo_centralizado= $request['id_tipo_organismo_centralizado'];
     }     
          

     if($request['otrafase'] != ""){
        $this->otrafase= $request['otrafase'];
     }
     
     if($request['otromotivo'] != ""){
        $this->otromotivo= $request['otromotivo'];
     }     
     
     if($request['intsentenciado'] != ""){
        $this->intsentenciado= $functions->toFloat($request['intsentenciado']);
     }else{
          $this->intsentenciado=0.00;
     }
     if($request['inttranzado'] != ""){
        $this->inttranzado= $functions->toFloat($request['inttranzado']);
     }else{
          $this->inttranzado=0.00;
     }
     if($request['intahorrado'] != ""){
        $this->intahorrado= $functions->toFloat($request['intahorrado']);
     }else{
          $this->intahorrado=0.00;
     }     
}//=========================== GET ===================




    public function getId_proactuacion(){
        return $this->id_proactuacion;
    }



    public function getId_usuario(){
        return $this->id_usuario;
    }



    public function getId_ano(){
        return $this->id_ano;
    }



    public function getId_origen(){
        return $this->id_origen;
    }
    


    public function getId_abogado_resp(){
        return $this->id_abogado_resp;
    }    



    public function getId_motivo(){
        return $this->id_motivo;
    }



    public function getId_fase(){
        return $this->id_fase;
    }



    public function getId_actuacion(){
        return $this->id_actuacion;
    }



    public function getId_tipo_organismo(){
        return $this->id_tipo_organismo;
    }



    public function getId_organismo(){
        return $this->id_organismo;
    }



    public function getId_refer(){
        return $this->id_refer;
    }



    public function getId_estado_fisico_expediente(){
        return $this->id_estado_fisico_expediente;
    }



    public function getId_tipo_espacio(){
        return $this->id_tipo_espacio;
    }



    public function getId_tipo_archivador(){
        return $this->id_tipo_archivador;
    }



    public function getId_tipo_piso_archivador(){
        return $this->id_tipo_piso_archivador;
    }



    public function getId_tipo_archivador_gaveta(){
        return $this->id_tipo_archivador_gaveta;
    }



    public function getStrnroexpediente(){
        return $this->strnroexpediente;
    }



    public function getStrdescripcion(){
        return $this->strdescripcion;
    }



    public function getFecapertura(){
        return $this->fecapertura;
    }



    public function getFeccierre(){
        return $this->feccierre;
    }



    public function getFecexpediente(){
        return $this->fecexpediente;
    }



    public function getIntcuantias(){
        return $this->intcuantias;
    }



    public function getCedula_cliente(){
        return $this->cedula_cliente;
    }



    public function getStrdocumentos(){
        return $this->strdocumentos;
    }



    public function getStrobservacion_cerrar(){
        return $this->strobservacion_cerrar;
    }



    public function getStrnroexpedienteauxiliar(){
        return $this->strnroexpedienteauxiliar;
    }



    public function getStrrepresentante(){
        return $this->strrepresentante;
    }



    public function getFecadmdem(){
        return $this->fecadmdem;
    }



    public function getFecnotdem(){
        return $this->fecnotdem;
    }



    public function getFecultnotordtri(){
        return $this->fecultnotordtri;
    }



    public function getFecinsaudpre(){
        return $this->fecinsaudpre;
    }



    public function getFecculfaspre(){
        return $this->fecculfaspre;
    }



    public function getFeccondem(){
        return $this->feccondem;
    }



    public function getFecadmpru(){
        return $this->fecadmpru;
    }



    public function getFecjuiorapub(){
        return $this->fecjuiorapub;
    }



    public function getFecpubsen(){
        return $this->fecpubsen;
    }



    public function getFecapelacion(){
        return $this->fecapelacion;
    }



    public function getBolborrado(){
        return $this->bolborrado;
    }
    
    
    public function getId_contrario(){
        return $this->id_contrario;
    }    
    
    
    public function getId_tipo_organismo_centralizado(){
        return $this->id_tipo_organismo_centralizado;
    }        


    public function getOtrafase(){
        return $this->otrafase;
    }         
    

    public function getOtromotivo(){
        return $this->otromotivo;
    }        
    
    
    public function getIntahorrado(){
        return $this->intahorrado;
    }

    
    public function getInttranzado(){
        return $this->inttranzado;
    }

    
    public function getIntsentenciado(){
        return $this->intsentenciado;
    }
    

//=========================== SET ===================




    public function setId_proactuacion($id_proactuacion){
        return $this->id_proactuacion=$id_proactuacion;
    }



    public function setId_usuario($id_usuario){
        return $this->id_usuario=$id_usuario;
    }



    public function setId_ano($id_ano){
        return $this->id_ano=$id_ano;
    }



    public function setId_origen($id_origen){
        return $this->id_origen=$id_origen;
    }
    

    public function setId_abogado_resp($id_abogado_resp){
        return $this->id_abogado_resp=$id_abogado_resp;
    }    



    public function setId_motivo($id_motivo){
        return $this->id_motivo=$id_motivo;
    }



    public function setId_fase($id_fase){
        return $this->id_fase=$id_fase;
    }



    public function setId_actuacion($id_actuacion){
        return $this->id_actuacion=$id_actuacion;
    }



    public function setId_tipo_organismo($id_tipo_organismo){
        return $this->id_tipo_organismo=$id_tipo_organismo;
    }



    public function setId_organismo($id_organismo){
        return $this->id_organismo=$id_organismo;
    }



    public function setId_refer($id_refer){
        return $this->id_refer=$id_refer;
    }



    public function setId_estado_fisico_expediente($id_estado_fisico_expediente){
        return $this->id_estado_fisico_expediente=$id_estado_fisico_expediente;
    }



    public function setId_tipo_espacio($id_tipo_espacio){
        return $this->id_tipo_espacio=$id_tipo_espacio;
    }



    public function setId_tipo_archivador($id_tipo_archivador){
        return $this->id_tipo_archivador=$id_tipo_archivador;
    }



    public function setId_tipo_piso_archivador($id_tipo_piso_archivador){
        return $this->id_tipo_piso_archivador=$id_tipo_piso_archivador;
    }



    public function setId_tipo_archivador_gaveta($id_tipo_archivador_gaveta){
        return $this->id_tipo_archivador_gaveta=$id_tipo_archivador_gaveta;
    }



    public function setStrnroexpediente($strnroexpediente){
        return $this->strnroexpediente=$strnroexpediente;
    }



    public function setStrdescripcion($strdescripcion){
        return $this->strdescripcion=$strdescripcion;
    }



    public function setFecapertura($fecapertura){
        return $this->fecapertura=$fecapertura;
    }



    public function setFeccierre($feccierre){
        return $this->feccierre=$feccierre;
    }



    public function setFecexpediente($fecexpediente){
        return $this->fecexpediente=$fecexpediente;
    }



    public function setIntcuantias($intcuantias){
        return $this->intcuantias=$intcuantias;
    }



    public function setCedula_cliente($cedula_cliente){
        return $this->cedula_cliente=$cedula_cliente;
    }



    public function setStrdocumentos($strdocumentos){
        return $this->strdocumentos=$strdocumentos;
    }



    public function setStrobservacion_cerrar($strobservacion_cerrar){
        return $this->strobservacion_cerrar=$strobservacion_cerrar;
    }



    public function setStrnroexpedienteauxiliar($strnroexpedienteauxiliar){
        return $this->strnroexpedienteauxiliar=$strnroexpedienteauxiliar;
    }



    public function setStrrepresentante($strrepresentante){
        return $this->strrepresentante=$strrepresentante;
    }



    public function setFecadmdem($fecadmdem){
        return $this->fecadmdem=$fecadmdem;
    }



    public function setFecnotdem($fecnotdem){
        return $this->fecnotdem=$fecnotdem;
    }



    public function setFecultnotordtri($fecultnotordtri){
        return $this->fecultnotordtri=$fecultnotordtri;
    }



    public function setFecinsaudpre($fecinsaudpre){
        return $this->fecinsaudpre=$fecinsaudpre;
    }



    public function setFecculfaspre($fecculfaspre){
        return $this->fecculfaspre=$fecculfaspre;
    }



    public function setFeccondem($feccondem){
        return $this->feccondem=$feccondem;
    }



    public function setFecadmpru($fecadmpru){
        return $this->fecadmpru=$fecadmpru;
    }



    public function setFecjuiorapub($fecjuiorapub){
        return $this->fecjuiorapub=$fecjuiorapub;
    }



    public function setFecpubsen($fecpubsen){
        return $this->fecpubsen=$fecpubsen;
    }



    public function setFecapelacion($fecapelacion){
        return $this->fecapelacion=$fecapelacion;
    }



    public function setBolborrado($bolborrado){
        return $this->bolborrado=$bolborrado;
    }

    
    public function setId_contrario($id_contrario){
        return $this->id_contrario=$id_contrario;
    }    
    
    
    public function setId_tipo_organismo_centralizado($id_tipo_organismo_centralizado){
        return $this->id_tipo_organismo_centralizado=$id_tipo_organismo_centralizado;
    }     
    
    public function setOtrafase($otrafase){
        return $this->otrafase=$otrafase;
    }   
    
    public function setOtromotivo($otromotivo){
        return $this->otromotivo=$otromotivo;
    }       
    

    public function setIntsentenciado($intsentenciado){
        return $this->intsentenciado=$intsentenciado;
    }


    public function setInttranzado($inttranzado){
        return $this->inttranzado=$inttranzado;
    }


    public function setIntahorrado($intahorrado){
        return $this->intahorrado=$intahorrado;
    }



//================================FUNCION INSERTAR============================================

    public static function getBuscarIdAbogadoResponsable($strcedula){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT id_abogado FROM ".clConstantesModelo::correspondencia_table."tbl_abogados WHERE strcedula::integer=".$strcedula;        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][id_abogado])
        return $data[0][id_abogado];
        else return "";
    }     
    
    
    public static function getBuscarIdAbogadoResponsableExpediente($id_expediente){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT id_usuario FROM ".clConstantesModelo::correspondencia_table."tblactuaciones WHERE id_proactuacion=".$id_expediente;        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][id_usuario])
        return $data[0][id_usuario];
        else return "";
    }     
    
    
    public static function getBuscarCedulaAbogadoResponsable($id){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT id_abogado,strcedula FROM ".clConstantesModelo::correspondencia_table."tbl_abogados WHERE id_abogado=".$id;        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][id_abogado])
        return $data[0][strcedula];
        else return "";
    } 
        
    
    
    public static function getBuscarNombreAbogadoResponsable($id){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT id_abogado,strapellido,strnombre FROM ".clConstantesModelo::correspondencia_table."tbl_abogados WHERE id_abogado=".$id;        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][id_abogado])
        return $data[0][strapellido].', '.$data[0][strnombre];
        else return "";
    } 
    
    
    public static function getBuscarAbogadoResponsable($strcedula){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT id_abogado,strapellido,strnombre FROM ".clConstantesModelo::correspondencia_table."tbl_abogados WHERE strcedula::integer=".$strcedula;        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][id_abogado])
        return $data[0][strapellido].', '.$data[0][strnombre];
        else return "";
    }          
    
    
    public static function getBuscarAbogado($cedula){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT strcedula FROM ".clConstantesModelo::correspondencia_table."tbl_abogados WHERE trim(strcedula)='".$cedula."'";        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][strcedula])
        return $data[0][strcedula];
        else return "";
    }      
    
    
    static public function getExpedienteAuxiliar2($str) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql = "select id_proactuacion from ".clConstantesModelo::correspondencia_table . "tblactuaciones  where upper(strnroexpedienteauxiliar)='".strtoupper($str)."'";        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][id_proactuacion]!='')
           return $data[0][id_proactuacion];
        else return '';
    }       
    
    static public function getExpedienteAuxiliar($str) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql = "select strnroexpedienteauxiliar from ".clConstantesModelo::correspondencia_table . "tblactuaciones  where upper(strnroexpedienteauxiliar)='".strtoupper($str)."'";        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][strnroexpedienteauxiliar]!='')
           return true;
        else return false;
    }        
    
    
    static public function getCedulaRefiere($cedula,$id_expediente) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql = "select cedula from ".clConstantesModelo::correspondencia_table . "tbl_expediente_referidos  where cedula='".$cedula."' and id_expediente=".$id_expediente;        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][cedula]!='')
           return true;
        else return false;
    }     
    
    
    
    
    public static function getExpedienteClienteAgenda($id_cliente){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT id_proactuacion,strnroexpediente,strdescripcion FROM ".clConstantesModelo::correspondencia_table.self::TABLA." WHERE id_proactuacion=".$id_cliente;        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }      
    
    
    

     public function SelectExpedienteAgendaLike($str_expediente){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT id_proactuacion,
         id_proclientecasos,
         id_proabogadoscasos,
         id_documentoscasos,
         id_abogado_resp,
         id_usuario,
         id_ano,
         id_materia,
         id_estatus,
         strnroexpediente,
         strtitulo,
         strdescripcion,
         id_refer,
         to_char(fecapertura,'DD/MM/YYYY') as fecapertura,
         to_char(feccierre,'DD/MM/YYYY') as feccierre,
         cedula_abogado_responsable,
         cedula_abogado_ejecutor,
         cedula_cliente,
         id_actuacion,
         id_honorario,
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
         id_regimen,
         id_citacion,
         strdias,
         strhoras,
         intcuotames1,
         intcuotames2,
         strdocumentos,
         cedula_conyugue,
         strobservacion_cerrar,
         strnroexpedienteauxiliar,
         strrepresentante,
         id_estado_fisico_expediente, 
         id_tipo_espacio, 
         id_tipo_archivador, 
         id_tipo_piso_archivador, 
         id_tipo_archivador_gaveta,
         id_abogado_resp, 
         id_abogado_ejecutor, 
         id_solicitante, 
         id_contrarios
         FROM ".clConstantesModelo::correspondencia_table.self::TABLA." WHERE bolborrado=0 and id_usuario=".$_SESSION['id_contacto'];
         
         if($str_expediente !=""){
             $sql .=" AND upper(strnroexpediente) like '%".strtoupper($str_expediente)."%'";
         }
         $sql.=" order by id_proexpediente asc";
//        exit($sql);        
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }    
    
    
    
    

     public function SelectExpediente($id_expediente){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="select id_proactuacion, 
             id_usuario, 
             id_ano, 
             id_origen, 
             id_abogado_resp,
             id_motivo, 
             id_fase, 
             id_actuacion, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=id_actuacion LIMIT 1) AS actuacion,
             id_tipo_organismo, 
             id_tipo_organismo_centralizado,
             id_organismo, 
             id_refer, 
             id_estado_fisico_expediente, 
             id_tipo_espacio, 
             id_tipo_archivador, 
             id_tipo_piso_archivador, 
             id_tipo_archivador_gaveta, 
             id_contrario,
              (SELECT strcedula FROM ".clConstantesModelo::correspondencia_table."tbl_contrarios A WHERE A.id_contrarios=id_contrario LIMIT 1) AS cedula_contrario,
              (SELECT (upper(strapellido) || ', '::text) || upper(strnombre) FROM ".clConstantesModelo::correspondencia_table."tbl_contrarios A WHERE A.id_contrarios=id_contrario LIMIT 1) AS nombre_contrario,
             strnroexpediente, 
             strdescripcion, 
             otromotivo,
             otrafase,
             to_char(fecapertura,'DD/MM/YYYY') as fecapertura,             
             to_char(feccierre,'DD/MM/YYYY') as feccierre,
             to_char(fecexpediente,'DD/MM/YYYY') as fecexpediente,             
             intcuantias, 
             intsentenciado, 
             inttranzado, 
             intahorrado,              
             strdocumentos, 
             strobservacion_cerrar, 
             strnroexpedienteauxiliar, 
             strrepresentante, 
             to_char(fecadmdem,'DD/MM/YYYY') as fecadmdem,                
             to_char(fecnotdem,'DD/MM/YYYY') as fecnotdem,                
             to_char(fecultnotordtri,'DD/MM/YYYY') as fecultnotordtri,                
             to_char(fecinsaudpre,'DD/MM/YYYY') as fecinsaudpre,                
             to_char(fecculfaspre,'DD/MM/YYYY') as fecculfaspre,                
             to_char(feccondem,'DD/MM/YYYY') as feccondem,                
             to_char(fecadmpru,'DD/MM/YYYY') as fecadmpru,                
             to_char(fecjuiorapub,'DD/MM/YYYY') as fecjuiorapub,                
             to_char(fecpubsen,'DD/MM/YYYY') as fecpubsen,                
             to_char(fecapelacion,'DD/MM/YYYY') as fecapelacion                
         FROM ".clConstantesModelo::correspondencia_table.self::TABLA." WHERE bolborrado=0";
         
         if (($_SESSION['id_profile']!=  clConstantesModelo::administrador_sistema) && ($_SESSION['id_profile']!=clConstantesModelo::coordinador_sistema))
              $sql.=" AND id_usuario=".$_SESSION['id_contacto'];
         
         if($id_expediente !=""){
             $sql .=" AND id_proactuacion=".$id_expediente;
         }
         $sql.=" order by id_proactuacion asc";
//         exit($sql.'----------'.$_SESSION['id_profile'].'=='.clConstantesModelo::administrador_sistema);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }    
    
    
     public function insertar($nexval){
//         exit('hola');
         $expediente='LTG-' . date('dmY') . '-'.($nexval+1);
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="Insert into ".clConstantesModelo::correspondencia_table.self::TABLA."(
         id_usuario, 
         id_origen, 
         id_motivo, 
         id_abogado_resp,
         id_fase, 
         id_actuacion, 
         strnroexpediente, 
         strdescripcion, 
         otrafase,
         otromotivo,
         fecapertura, 
         fecexpediente, 
         intcuantias, 
         strnroexpedienteauxiliar
         ) VALUES (";
         $sql.=$_SESSION['id_contacto'].",";
         $sql.=$this->getId_origen().",";    
         $sql.=$this->getId_motivo().",";           
         $sql.=$this->getId_abogado_resp().",";           
         $sql.=$this->getId_fase().",";          
         $sql.=$this->getId_actuacion().",'";        
         $sql.=$expediente."','";  
         $sql.=$this->getStrdescripcion()."','";        
         $sql.=$this->getOtrafase()."','";             
         $sql.=$this->getOtromotivo()."',";             
         $sql.="TO_DATE('".date('d/m/Y')."', 'DD/MM/YYYY'),";         
         $sql.="TO_DATE('".date('d/m/Y')."', 'DD/MM/YYYY'),";       
         $sql.=$this->getIntcuantias().",'";   
         $sql.=$this->getStrnroexpedienteauxiliar()."')";           
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


     public function SelectAll($pagina){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT id_proactuacion,
             id_usuario, 
              (SELECT (A.strapellido || ', ' || A.strnombre)  FROM ".clConstantesModelo::correspondencia_table."tblcontacto A WHERE A.id_contacto=id_usuario LIMIT 1) AS nombre,             
             id_ano, 
             id_origen, 
             id_abogado_resp,
              (SELECT A.stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=id_origen LIMIT 1) AS origen,
             id_motivo, 
              (SELECT B.stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros B WHERE B.id_maestro=id_motivo LIMIT 1) AS motivo,
             id_fase, 
              (SELECT C.stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros C WHERE C.id_maestro=id_fase LIMIT 1) AS fase,
             id_actuacion, 
              (SELECT stritema FROM tblmaestros A WHERE A.id_maestro=id_actuacion) AS actuacion,             
             id_tipo_organismo, 
             id_organismo, 
             id_refer, 
             id_estado_fisico_expediente, 
             id_tipo_espacio, 
             id_tipo_archivador, 
             id_tipo_piso_archivador, 
             id_tipo_archivador_gaveta, 
             id_contrario,
              (SELECT strcedula FROM ".clConstantesModelo::correspondencia_table."tbl_contrarios A WHERE A.id_contrarios=id_contrario LIMIT 1) AS cedula_contrario,
              (SELECT (upper(strapellido) || ', '::text) || upper(strnombre) FROM ".clConstantesModelo::correspondencia_table."tbl_contrarios A WHERE A.id_contrarios=id_contrario LIMIT 1) AS nombre_contrario,
             strnroexpediente, 
             strdescripcion, 
             to_char(fecapertura,'DD/MM/YYYY') as fecapertura,             
             to_char(feccierre,'DD/MM/YYYY') as feccierre,
             to_char(fecexpediente,'DD/MM/YYYY') as fecexpediente,             
             intcuantias, 
             strdocumentos, 
             strobservacion_cerrar, 
             strnroexpedienteauxiliar, 
             strrepresentante, 
             to_char(fecadmdem,'DD/MM/YYYY') as fecadmdem,                
             to_char(fecnotdem,'DD/MM/YYYY') as fecnotdem,                
             to_char(fecultnotordtri,'DD/MM/YYYY') as fecultnotordtri,                
             to_char(fecinsaudpre,'DD/MM/YYYY') as fecinsaudpre,                
             to_char(fecculfaspre,'DD/MM/YYYY') as fecculfaspre,                
             to_char(feccondem,'DD/MM/YYYY') as feccondem,                
             to_char(fecadmpru,'DD/MM/YYYY') as fecadmpru,                
             to_char(fecjuiorapub,'DD/MM/YYYY') as fecjuiorapub,                
             to_char(fecpubsen,'DD/MM/YYYY') as fecpubsen,                
             to_char(fecapelacion,'DD/MM/YYYY') as fecapelacion";
         
            if (($_SESSION['id_profile']==  clConstantesModelo::administrador_sistema) || ($_SESSION['id_profile']==clConstantesModelo::coordinador_sistema))
                $sql.=" FROM ".clConstantesModelo::correspondencia_table.self::TABLA." WHERE bolborrado=0";
            else        
                $sql.=" FROM ".clConstantesModelo::correspondencia_table.self::TABLA." WHERE bolborrado=0 and id_usuario=".$_SESSION['id_contacto'];
         
//         if($id_expediente !=""){
//             $sql .=" AND id_proexpediente=".$id_expediente;
//         }
//         exit($sql.'coor:'.$_SESSION['id_profile']);
         $sql.=" order by id_proactuacion asc";
         $conn->sql=$sql;
         $_pagi_sql= $conn->sql;
         $_pagi_cuantos = 20;
         $_pagi_nav_num_enlaces = 5;
         $_pagi_actual = $pagina;
         include_once '../comunes/php/paginacion/paginator6.inc.php';
         $data = pg_fetch_all($_pagi_result);
         $data2[0]= $data;
         $data2[1]=  "<p>".$_pagi_navegacion."</p>";
         //echo $_pagi_navegacion;
         return $data2;
        
        
//         $data = $conn->ejecutarSentencia(2);
//         return $data;
    }
//======================================FUNCION ACTUALIZAR===============================================


     public function Update(){
//         $this->actualizarDemandante($this->get_id_demandante());
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="UPDATE ".clConstantesModelo::correspondencia_table.self::TABLA." SET
            id_origen=".$this->getId_origen().",
            id_motivo=".$this->getId_motivo().",
            id_abogado_resp=".$this->getId_abogado_resp().",                
            id_fase=".$this->getId_fase().",
            id_contrario=".$this->getId_contrario().",                
            id_tipo_organismo_centralizado=".$this->getId_tipo_organismo_centralizado().",                 
            id_tipo_organismo=".$this->getId_tipo_organismo().", 
            id_organismo=".$this->getId_organismo().",
            --id_refer=".$this->getId_refer().",
            id_estado_fisico_expediente=".$this->getId_estado_fisico_expediente().", 
            id_tipo_espacio=".$this->getId_tipo_espacio().", 
            id_tipo_archivador=".$this->getId_tipo_archivador().", 
            id_tipo_piso_archivador=".$this->getId_tipo_piso_archivador().", 
            id_tipo_archivador_gaveta=".$this->getId_tipo_archivador_gaveta().",
            strnroexpediente='".$this->getStrnroexpediente()."',
            strdescripcion='".$this->getStrdescripcion()."',
            otrafase='".$this->getOtrafase()."',
            otromotivo='".$this->getOtromotivo()."',
            intcuantias=".$this->getIntcuantias().", 
            intsentenciado=".$this->getIntsentenciado().", 
            inttranzado=".$this->getInttranzado().", 
            intahorrado=".$this->getIntahorrado().", 
            strdocumentos='".$this->getStrdocumentos()."',
            strnroexpedienteauxiliar='".$this->getStrnroexpedienteauxiliar()."',
            strrepresentante='".$this->getStrrepresentante()."'"; 
         if($this->getFecadmdem() !=""){
            $sql.="fecadmdem=TO_DATE('".$this->getFecadmdem()."', 'DD/MM/YYYY')";
         }
         if($this->getFecnotdem() !=""){
            $sql.="fecnotdem=TO_DATE('".$this->getFecnotdem()."', 'DD/MM/YYYY')";
         }
         if($this->getFecultnotordtri() !=""){
            $sql.="fecultnotordtri=TO_DATE('".$this->getFecultnotordtri()."', 'DD/MM/YYYY')";
         }
         if($this->getFecinsaudpre() !=""){
            $sql.="fecinsaudpre=TO_DATE('".$this->getFecinsaudpre()."', 'DD/MM/YYYY')";
         }
         if($this->getFecculfaspre() !=""){
            $sql.="fecculfaspre=TO_DATE('".$this->getFecculfaspre()."', 'DD/MM/YYYY')";
         }
         if($this->getFeccondem() !=""){
            $sql.="feccondem=TO_DATE('".$this->getFeccondem()."', 'DD/MM/YYYY')";
         }
         if($this->getFecadmpru() !=""){
            $sql.="fecadmpru=TO_DATE('".$this->getFecadmpru()."', 'DD/MM/YYYY')";
         }
         if($this->getFecjuiorapub() !=""){
            $sql.="fecjuiorapub=TO_DATE('".$this->getFecjuiorapub()."', 'DD/MM/YYYY')";
         }
         if($this->getFecpubsen() !=""){
            $sql.="fecpubsen=TO_DATE('".$this->getFecpubsen()."', 'DD/MM/YYYY')";
         }
         if($this->getFecapelacion() !=""){
            $sql.="fecapelacion=TO_DATE('".$this->getFecapelacion()."', 'DD/MM/YYYY')";
         }
         $sql.=" WHERE id_proactuacion=".$this->getId_proactuacion();
//         exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia();
         return $data;         
  



//
//         strnroexpediente='".$this->get_strnroexpediente()."',
//         strtitulo='".$this->get_strtitulo()."',
//         strdescripcion='".$this->get_strdescripcion()."',";
//        /* id_refer=".$this->get_id_refer().",*/
//         $sql.="cedula_abogado_responsable='".$this->get_cedula_abogado_responsable()."',
//         cedula_abogado_ejecutor='".$this->get_cedula_abogado_ejecutor()."',
//         cedula_cliente='".$this->get_cedula_cliente()."',
//         id_actuacion=".$this->get_id_actuacion_persona().",
//         id_tipo_tramite=".$this->get_id_tipo_tramite().",
//         id_tipo_atencion=".$this->get_id_tipo_atencion().",
//         id_tipo_organismo=".$this->get_id_tipo_organismo().",
//         id_organismo=".$this->get_id_organismo().",
//         id_tipo_minuta=".$this->get_id_tipo_minuta().",
//         id_minuta=".$this->get_id_minuta().",
//         strobservacion='".$this->get_strobservacion()."',
//         fecexpediente=TO_DATE('".$this->get_fecexpediente()."','DD/MM/YYYY'),
//         strdireccion_asistido='".$this->get_strdireccion_asistido()."',
//         strdireccion_conyugue='".$this->get_strdireccion_conyugue()."',
//         strdireccion_ultimo_domicilio='".$this->get_strdireccion_ultimo_domicilio()."',";
//         /*fecseparacion=TO_DATE('".$this->get_fecseparacion()."','DD/MM/YYYY'),";*/
//         if ($this->get_feccierre()!='')
//            $sql.="feccierre=TO_DATE('".$this->get_feccierre()."','DD/MM/YYYY'),";             
//         $sql.="intmonto_manutencion=".$this->get_intmonto_manutencion().",";
//         /*id_regimen=".$this->get_id_regimen().",
//         id_citacion=".$this->get_id_citacion().",             */
//         $sql.="strdias='".$this->get_strdias()."',";
//         if ($this->get_strobservacion_cerrar()!='')             
//            $sql.="strobservacion_cerrar='".$this->get_strobservacion_cerrar()."',";                    
//         $sql.="strhoras='".$this->get_strhoras()."',      
//         intcuotames1=".$this->get_intcuotames1().",         
//         intcuotames2=".$this->get_intcuotames2().",    
//         cedula_conyugue='".$this->get_cedula_conyugue()."',    
//         strnroexpedienteauxiliar='".$this->get_strnroexpedienteauxiliar()."',
//         strrepresentante='".$this->get_strrepresentante()."',
//         id_estado_fisico_expediente=".$this->getId_estado_fisico_expediente().",
//         id_tipo_espacio=".$this->getId_tipo_espacio().",    
//         id_tipo_archivador=".$this->getId_tipo_archivador().",    
//         id_tipo_piso_archivador=".$this->getId_tipo_piso_archivador().",
//         id_tipo_archivador_gaveta=".$this->getId_tipo_archivador_gaveta().",";
//         $sql.="id_abogado_resp=".$this->getId_abogado_resp().",
//         id_abogado_ejecutor=".$this->getId_abogado_ejecutor().",    
//         id_solicitante=".$this->getId_solicitante().",";
//         /*id_contrarios=".$this->getId_contrarios().",  */
//         $sql.="strdocumentos='".$this->get_strdocumentos()."' WHERE id_proactuacion=".$this->get_id_proactuacion();
//
//         if($this->getFecadmdem() !=""){
//            $sql.="fecadmdem=TO_DATE('".$this->getFecadmdem()."', 'DD/MM/YYYY')";
//         }
//         if($this->getFecnotdem() !=""){
//            $sql.="fecnotdem=TO_DATE('".$this->getFecnotdem()."', 'DD/MM/YYYY')";
//         }
//         if($this->getFecultnotordtri() !=""){
//            $sql.="fecultnotordtri=TO_DATE('".$this->getFecultnotordtri()."', 'DD/MM/YYYY')";
//         }
//         if($this->getFecinsaudpre() !=""){
//            $sql.="fecinsaudpre=TO_DATE('".$this->getFecinsaudpre()."', 'DD/MM/YYYY')";
//         }
//         if($this->getFecculfaspre() !=""){
//            $sql.="fecculfaspre=TO_DATE('".$this->getFecculfaspre()."', 'DD/MM/YYYY')";
//         }
//         if($this->getFeccondem() !=""){
//            $sql.="feccondem=TO_DATE('".$this->getFeccondem()."', 'DD/MM/YYYY')";
//         }
//         if($this->getFecadmpru() !=""){
//            $sql.="fecadmpru=TO_DATE('".$this->getFecadmpru()."', 'DD/MM/YYYY')";
//         }
//         if($this->getFecjuiorapub() !=""){
//            $sql.="fecjuiorapub=TO_DATE('".$this->getFecjuiorapub()."', 'DD/MM/YYYY')";
//         }
//         if($this->getFecpubsen() !=""){
//            $sql.="fecpubsen=TO_DATE('".$this->getFecpubsen()."', 'DD/MM/YYYY')";
//         }
//         if($this->getFecapelacion() !=""){
//            $sql.="fecapelacion=TO_DATE('".$this->getFecapelacion()."', 'DD/MM/YYYY')";
//         }
a;
    }
    
    function Delete($id_proexpediente){
        $conn= new Conexion();
         $conn->abrirConexion();
         $sql="UPDATE ".clConstantesModelo::correspondencia_table.self::TABLA." SET
         bolborrado=1
         WHERE id_proactuacion=".$id_proexpediente;
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia();
         return $data;
    }
    
    public function nextValExpediente() {
               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql="SELECT last_value as maximo FROM " . clConstantesModelo::correspondencia_table . "tblactuaciones_id_proactuacion_seq";
//               exit($sql);
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
        $conn->sql= "SELECT strdocumentos FROM ".clConstantesModelo::correspondencia_table.self::TABLA." WHERE id_proactuacion= ".$expediente;
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
    
    public function SelectAllExpedientesFiltro($pagina){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT a.id_proactuacion,
             a.id_usuario, 
              (SELECT (A.strapellido || ', ' || A.strnombre)  FROM ".clConstantesModelo::correspondencia_table."tblcontacto A WHERE A.id_contacto=id_usuario LIMIT 1) AS nombre,             
             a.id_ano, 
             a.id_origen, 
              (SELECT m.stritema FROM public.tblmaestros m WHERE m.id_maestro=a.id_origen LIMIT 1) AS origen,
             a.id_motivo, 
              (SELECT B.stritema FROM public.tblmaestros B WHERE B.id_maestro=a.id_motivo LIMIT 1) AS motivo,
             a.id_fase, 
              (SELECT C.stritema FROM public.tblmaestros C WHERE C.id_maestro=a.id_fase LIMIT 1) AS fase,
             a.id_actuacion, 
             (SELECT m.stritema FROM tblmaestros m WHERE m.id_maestro=a.id_actuacion) AS actuacion,             
             a.id_tipo_organismo, 
             a.id_organismo, 
             a.id_refer, 
             a.id_estado_fisico_expediente, 
             a.id_tipo_espacio, 
             a.id_tipo_archivador, 
             a.id_tipo_piso_archivador, 
             a.id_tipo_archivador_gaveta, 
             a.id_contrario,
             (SELECT strcedula FROM public.tbl_contrarios m WHERE m.id_contrarios=a.id_contrario LIMIT 1) AS cedula_contrario,
             (SELECT (upper(strapellido) || ', '::text) || upper(strnombre) FROM public.tbl_contrarios m WHERE m.id_contrarios=a.id_contrario LIMIT 1) AS nombre_contrario,
             a.strnroexpediente, 
             a.strdescripcion, 
             to_char(a.fecapertura,'DD/MM/YYYY') as fecapertura,             
             to_char(a.feccierre,'DD/MM/YYYY') as feccierre,
             to_char(a.fecexpediente,'DD/MM/YYYY') as fecexpediente,             
             a.intcuantias, 
             a.strdocumentos, 
             a.strobservacion_cerrar, 
             a.strnroexpedienteauxiliar, 
             a.strrepresentante, 
             to_char(a.fecadmdem,'DD/MM/YYYY') as fecadmdem,                
             to_char(a.fecnotdem,'DD/MM/YYYY') as fecnotdem,                
             to_char(a.fecultnotordtri,'DD/MM/YYYY') as fecultnotordtri,                
             to_char(a.fecinsaudpre,'DD/MM/YYYY') as fecinsaudpre,                
             to_char(a.fecculfaspre,'DD/MM/YYYY') as fecculfaspre,                
             to_char(a.feccondem,'DD/MM/YYYY') as feccondem,                
             to_char(a.fecadmpru,'DD/MM/YYYY') as fecadmpru,                
             to_char(a.fecjuiorapub,'DD/MM/YYYY') as fecjuiorapub,                
             to_char(a.fecpubsen,'DD/MM/YYYY') as fecpubsen,                
             to_char(a.fecapelacion,'DD/MM/YYYY') as fecapelacion";

         if (($_SESSION['id_profile']==  clConstantesModelo::administrador_sistema) || ($_SESSION['id_profile']==clConstantesModelo::coordinador_sistema))
              $sql.=" FROM ".clConstantesModelo::correspondencia_table."tblactuaciones a WHERE a.bolborrado=0 ";
         else 
              $sql.=" FROM ".clConstantesModelo::correspondencia_table."tblactuaciones a WHERE a.bolborrado=0 and a.id_usuario=".$_SESSION['id_contacto'];

 
         
         if($_SESSION['nro_tribunal_reporte'] != ""){
             $sql .= " AND a.strnroexpedienteauxiliar LIKE '%".$_SESSION['nro_tribunal_reporte']."%'";
         }
         if($_SESSION['cedula_abogado_ejecutor_reporte'] != ""){
             $sql .= " AND d.strcedula LIKE '%".$_SESSION['cedula_abogado_ejecutor_reporte']."%'";
         }
         if($_SESSION['id_origen_reporte'] > 0 ){
             $sql .= " AND a.id_origen=".$_SESSION['id_origen_reporte'];
         }
         if($_SESSION['id_motivo_reporte'] > 0 ){
             $sql .= " AND a.id_motivo=".$_SESSION['id_motivo_reporte'];
         }         
         if($_SESSION['id_responsable_reporte'] > 0 ){
             $sql .= " AND a.id_usuario=".$_SESSION['id_responsable_reporte'];
         }         
         if($_SESSION['strexpediente_reporte'] != ""){
             $sql .= " AND a.strnroexpediente LIKE '%".$_SESSION['strexpediente_reporte']."%'";
         }
         $sql.=" order by a.id_proactuacion asc";
//         exit($sql);
         $conn->sql=$sql;
         $_pagi_sql= $conn->sql;
         $_pagi_cuantos = 20;
         $_pagi_nav_num_enlaces = 5;
         $_pagi_actual = $pagina;
         include_once '../comunes/php/paginacion/paginator8.inc.php';
         $data = pg_fetch_all($_pagi_result);
         $data2[0]= $data;
         $data2[1]=  "<p>".$_pagi_navegacion."</p>";
         //echo $_pagi_navegacion;
         return $data2;         
//         $data = $conn->ejecutarSentencia(2);
//         return $data;
    }
    
    function cerrarExpediente($id_proexpediente){
        $conn= new Conexion();
         $conn->abrirConexion();
         $sql="UPDATE ".clConstantesModelo::correspondencia_table.self::TABLA." SET
         feccierre=TO_DATE('".  date('d/m/Y')."','DD/MM/YYYY')
         WHERE id_proactuacion=".$id_proexpediente;
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia();
         return $data;
    }
    
    public function selectCountExpedientesAbiertos($id){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT cedula_cliente, count(id_proactuacion) AS count
                    FROM ".clConstantesModelo::correspondencia_table.self::TABLA."
                    WHERE feccierre IS NULL and cedula_cliente='".$id."' GROUP BY ".self::TABLA.".cedula_cliente";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }    
    
    public function selectCountExpedientesCerrados($id){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT cedula_cliente, count(id_proactuacion) AS count
                    FROM ".clConstantesModelo::correspondencia_table.self::TABLA."
                WHERE feccierre IS NOT NULL and cedula_cliente='".$id."' GROUP BY ".self::TABLA.".cedula_cliente";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }    
    public static function getExpedienteCliente($id_cliente){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT id_proactuacion FROM ".clConstantesModelo::correspondencia_table.self::TABLA." WHERE id_cliente=".$id_cliente;
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data[0][feccierre];
    }        
    
    public static function getExpedFecie($id){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT feccierre FROM ".clConstantesModelo::correspondencia_table.self::TABLA." WHERE id_proactuacion=".$id;
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data[0][feccierre];
    }    
     
     public function selectVista_abogados_casos_cargados(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."vista_abogados_casos_litigio_cargados";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
    
     public function selectVista_abogados_casos_cargados_total(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."vista_abogados_casos_litigios_cargados_total";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }    

     public function selectFases($id_expediente){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "SELECT 
            id_proactuacion_fase,id_tipo_fase,id_fase,strobservacion,id_proactuacion,
            (SELECT STRITEMA FROM ".clConstantesModelo::correspondencia_table."TBLMAESTROS A WHERE A.ID_MAESTRO=id_tipo_fase LIMIT 1) AS tipo_fase,
            (SELECT STRITEMA FROM ".clConstantesModelo::correspondencia_table."TBLMAESTROS A WHERE A.ID_MAESTRO=id_fase LIMIT 1) AS fase,
            to_char(fecfase,'DD/MM/YYYY') as fecfase
            FROM ".clConstantesModelo::correspondencia_table."tblactuacion_fases where bolborrado=0 and id_proactuacion=".$id_expediente;
        //exit ($sql);
        $conn->sql=$sql;
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }    
    
    public function SelectAllExpedientesFiltroAgenda($pagina,$cedula_cliente="",$cedula_abogado_responsable="",$cedula_abogado_ejecutor="",$strexpediente=""){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT 
         a.id_proactuacion,
         a.id_proclientecasos,
         a.id_proabogadoscasos,
         a.id_documentoscasos,
         a.id_usuario,
         a.id_ano,
         a.id_materia,
         a.id_estatus,
         a.strnroexpediente,
         a.strtitulo,
         a.strdescripcion,
         a.id_refer,
         to_char(a.fecapertura,'DD/MM/YYYY') as fecapertura,
         to_char(a.feccierre,'DD/MM/YYYY') as feccierre,
         a.cedula_abogado_responsable,
         a.cedula_abogado_ejecutor,
         a.cedula_cliente,
         a.id_actuacion,
         a.id_honorario,
         a.id_tipo_tramite,
         a.id_tipo_atencion,
         a.id_tipo_organismo,
         a.id_organismo,
         a.id_tipo_minuta,
         a.id_minuta,
         a.strobservacion,
         to_char(a.fecexpediente,'DD/MM/YYYY') as fecexpediente,
         a.strdireccion_asistido,
         a.strdireccion_conyugue,
         a.strdireccion_ultimo_domicilio,
         to_char(a.fecseparacion,'DD/MM/YYYY') as fecseparacion,
         a.intmonto_manutencion,
         a.id_regimen,
         a.id_citacion,
         a.strdias,
         a.strhoras,
         a.intcuotames1,
         a.intcuotames2,
         a.strdocumentos,
         a.cedula_conyugue,
         a.strobservacion_cerrar,
         a.strnroexpedienteauxiliar,
         a.strrepresentante,
         a.id_estado_fisico_expediente, 
         a.id_tipo_espacio, 
         a.id_tipo_archivador, 
         a.id_tipo_piso_archivador, 
         a.id_tipo_archivador_gaveta,
         b.fecminuta as fechacompara, 
         to_char(b.fecminuta,'DD/MM/YYYY') as fecminuta       
         FROM 
         public.".self::TABLA." a,
         public.tblproactuacion_situaciones b
         WHERE a.id_proactuacion=b.id_proactuacion and 
         a.bolborrado=0 and 
         b.bolborrado=0 and 
         a.id_usuario=".$_SESSION['id_contacto'];
         if($cedula_cliente != ""){
             $sql .= " AND a.cedula_cliente LIKE '%$cedula_cliente%'";
         }
         if($cedula_abogado_responsable != ""){
             $sql .= " AND a.cedula_abogado_responsable LIKE '%$cedula_abogado_responsable%'";
         }
         if($cedula_abogado_ejecutor != ""){
             $sql .= " AND a.cedula_abogado_ejecutor LIKE '%$cedula_abogado_ejecutor%'";
         }
         if($strexpediente != ""){
             $sql .= " AND a.strnroexpediente LIKE '%$strexpediente%'";
         }
         $sql.=" order by a.id_proactuacion asc";
         $conn->sql=$sql;
         $_pagi_sql= $conn->sql;
         $_pagi_cuantos = 10;
         $_pagi_nav_num_enlaces = 5;
         $_pagi_actual = $pagina;
         include_once '../comunes/php/paginacion/paginator6.inc.php';
         $data = pg_fetch_all($_pagi_result);
         $data2[0]= $data;
         $data2[1]=  "<p>".$_pagi_navegacion."</p>";
         //echo $_pagi_navegacion;
         return $data2;         
//         $data = $conn->ejecutarSentencia(2);
//         return $data;
    }    
    

     public function SelectAllAgenda($pagina){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT a.id_proactuacion,
         a.id_proclientecasos,
         a.id_proabogadoscasos,
         a.id_documentoscasos,
         a.id_usuario,
         a.id_ano,
         a.id_materia,
         a.id_estatus,
         a.strnroexpediente,
         a.strtitulo,
         a.strdescripcion,
         a.id_refer,
         to_char(a.fecapertura,'DD/MM/YYYY') as fecapertura,
         to_char(a.feccierre,'DD/MM/YYYY') as feccierre,
         a.cedula_abogado_responsable,
         a.cedula_abogado_ejecutor,
         a.cedula_cliente,
         a.id_actuacion,
         a.id_honorario,
         a.id_tipo_tramite,
         a.id_tipo_atencion,
         a.id_tipo_organismo,
         a.id_organismo,
         a.id_tipo_minuta,
         a.id_minuta,
         a.strobservacion,
         to_char(a.fecexpediente,'DD/MM/YYYY') as fecexpediente,
         a.strdireccion_asistido,
         a.strdireccion_conyugue,
         a.strdireccion_ultimo_domicilio,
         to_char(a.fecseparacion,'DD/MM/YYYY') as fecseparacion,
         a.intmonto_manutencion,
         a.id_regimen,
         a.id_citacion,
         a.strdias,
         a.strhoras,
         a.intcuotames1,
         a.intcuotames2,
         a.strdocumentos,
         a.cedula_conyugue,
         a.strobservacion_cerrar,
         a.strnroexpedienteauxiliar,
         a.strrepresentante,
         a.id_estado_fisico_expediente, 
         a.id_tipo_espacio, 
         a.id_tipo_archivador, 
         a.id_tipo_piso_archivador, 
         a.id_tipo_archivador_gaveta,
         b.fecminuta as fechacompara, 
         b.id_estado_minuta,
         to_char(b.fecminuta,'DD/MM/YYYY') as fecminuta       
         FROM 
         public.".self::TABLA." a,
         public.tblproactuacion_situaciones b
         WHERE 
         a.bolborrado=0 and b.bolborrado=0 and a.id_proactuacion=b.id_proactuacion and
         a.bolborrado=0 and b.id_estado_minuta>0 and b.id_estado_minuta<>13193 and a.id_usuario=".$_SESSION['id_contacto'];
         
//         if($id_expediente !=""){
//             $sql .=" AND id_proexpediente=".$id_expediente;
//         }
//         exit($sql);
         $sql.=" order by a.id_proactuacion asc";
         $conn->sql=$sql;
         $_pagi_sql= $conn->sql;
         $_pagi_cuantos = 10;
         $_pagi_nav_num_enlaces = 5;
         $_pagi_actual = $pagina;
         include_once '../comunes/php/paginacion/paginator6.inc.php';
         $data = pg_fetch_all($_pagi_result);
         $data2[0]= $data;
         $data2[1]=  "<p>".$_pagi_navegacion."</p>";
         //echo $_pagi_navegacion;
         return $data2;
        
        
//         $data = $conn->ejecutarSentencia(2);
//         return $data;
    }

    public function insertarDemandante(){
        $conn = new Conexion();
        $conn->abrirConexion();
        $sql="INSERT INTO ".clConstantesModelo::correspondencia_table."tbl_demandantes(
         tiempo_servicio, 
         fecingreso, 
         fecegreso, 
         motivo_culminacion_laboral, 
         cancelo_adelanto_prestaciones, 
         concepto, 
         monto)
    VALUES (
       
        '".$this->get_tiempo_servicio_demandante()."',
        TO_DATE('".$this->get_fecingreso_demandante()."','DD/MM/YYYY'), 
        TO_DATE('".$this->get_fecegreso_demandante()."','DD/MM/YYYY'),
        '".$this->get_motivo_culminacion_demandante()."','".$this->get_cancelo_prestaciones_demandante()."',
        '".$this->get_concepto_prestaciones_demandante()."', 
        ".$this->get_monto_prestaciones_demandante().");";
        $conn->sql=$sql;
        if($conn->ejecutarSentencia()){

             $conn->sql="SELECT CURRVAL(pg_get_serial_sequence('tbl_demandantes','lngcodigo')) as ultimo";
             $data=$conn->ejecutarSentencia(2);
             if($data){
                $retorno=$data[0]['ultimo'];
             }else{
                $retorno=0;
             }
         }
         $conn->cerrarConexion();
         return $retorno;

    }

    public function actualizarDemandante(){
        $conn = new Conexion();
        $conn->abrirConexion();
        $sql="update ".clConstantesModelo::correspondencia_table."tbl_demandantes
         set
         cedula='".$this->get_cedula_demandante()."', 
         nombres='".$this->get_strnombre_demandante()."', 
         telefono='".$this->get_telefono_demandante()."', 
         direccion='".$this->get_direccion_demandante()."', 
         tiempo_servicio='".$this->get_tiempo_servicio_demandante()."', 
         fecingreso=TO_DATE('".$this->get_fecingreso_demandante()."','DD/MM/YYYY'), 
         fecegreso=TO_DATE('".$this->get_fecegreso_demandante()."','DD/MM/YYYY'), 
         motivo_culminacion_laboral='".$this->get_motivo_culminacion_demandante()."', 
         cancelo_adelanto_prestaciones='".$this->get_cancelo_prestaciones_demandante()."', 
         concepto='".$this->get_concepto_prestaciones_demandante()."', 
         monto=".$this->get_monto_prestaciones_demandante()."
         WHERE lngcodigo=".$this->get_id_demandante();
        $conn->sql=$sql;
        if($conn->ejecutarSentencia()){
             $retorno=true;
         }else{
             $retorno=false;
         }
         
         $conn->cerrarConexion();
         return $retorno;
    }

    public function selectDemandante($id_demandante){
        $conn = new Conexion();
        $conn->abrirConexion();
        $sql="select
              lngcodigo, 
              cedula,
              nombres,
              telefono,
              direccion,
              tiempo_servicio, 
              to_char(fecingreso,'DD/MM/YYYY') AS fecingreso,
              to_char(fecegreso,'DD/MM/YYYY') AS fecegreso,
              motivo_culminacion_laboral,
              cancelo_adelanto_prestaciones, 
              concepto, 
              monto 
              from ".clConstantesModelo::correspondencia_table."tbl_demandantes";
        if($id_demandante > 0){
            $sql.=" where lngcodigo=".$id_demandante;
        }

        $conn->sql=$sql;
        $data=$conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
        
    }


    public function insertarDemandanteReferido(){
        $conn = new Conexion();
        $conn->abrirConexion();
        $sql="INSERT INTO ".clConstantesModelo::correspondencia_table."tbl_expediente_referidos(
         cedula,
         nombres,   
         tiempo_servicio, 
         fecingreso, 
         fecegreso, 
         motivo_culminacion_laboral, 
         cancelo_adelanto_prestaciones, 
         concepto, 
         monto,
         id_expediente,
         id_demandante,
         monto_demanda)
    VALUES (
        '".$this->get_cedula_demandante_referido()."',
        '".$this->get_strnombre_demandante_referido()."',
        '".$this->get_tiempo_servicio_demandante_referido()."',
        TO_DATE('".$this->get_fecingreso_demandante_referido()."','DD/MM/YYYY'), 
        TO_DATE('".$this->get_fecegreso_demandante_referido()."','DD/MM/YYYY'),
        '".$this->get_motivo_culminacion_demandante_referido()."','".$this->get_cancelo_prestaciones_demandante_referido()."',
        '".$this->get_concepto_prestaciones_demandante_referido()."', 
        ".$this->get_monto_prestaciones_demandante_referido().",
        ".$this->get_id_proactuacion().",
        ".$this->get_id_demandante_referido().",
        ".$this->get_monto_demanda_demandante_referido().");";
       // exit($sql);
        $conn->sql=$sql;
        if($conn->ejecutarSentencia()){
            $retorno=TRUE;
        }else{
            $retorno=FALSE;
        }
         
         $conn->cerrarConexion();
         return $retorno;

    }

    public function actualizarDemandanteReferido($id_demandante){
        $conn = new Conexion();
        $conn->abrirConexion();
        $sql="update ".clConstantesModelo::correspondencia_table."tbl_expediente_referidos
         set
         cedula='".$this->get_cedula_demandante_referido()."', 
         nombres='".$this->get_strnombre_demandante_referido()."',
         tiempo_servicio='".$this->get_tiempo_servicio_demandante_referido()."', 
         fecingreso=TO_DATE('".$this->get_fecingreso_demandante_referido()."','DD/MM/YYYY'), 
         fecegreso=TO_DATE('".$this->get_fecegreso_demandante_referido()."','DD/MM/YYYY'), 
         motivo_culminacion_laboral='".$this->get_motivo_culminacion_demandante_referido()."', 
         cancelo_adelanto_prestaciones='".$this->get_cancelo_prestaciones_demandante_referido()."', 
         concepto='".$this->get_concepto_prestaciones_demandante_referido()."', 
         monto=".$this->get_monto_prestaciones_demandante_referido().",
         monto_demanda=".$this->get_monto_demanda_demandante_referido()."
         WHERE lngcodigo=".$id_demandante;
        $conn->sql=$sql;
        if($conn->ejecutarSentencia()){
             $retorno=true;
         }else{
             $retorno=false;
         }
         
         $conn->cerrarConexion();
         return $retorno;
    }

    public function selectDemandanteReferido($id_expediente=0,$id_demandante=0){
        $conn = new Conexion();
        $conn->abrirConexion();
        $sql="select
              lngcodigo, 
              cedula,
              nombres,
              tiempo_servicio, 
              to_char(fecingreso,'DD/MM/YYYY') AS fecingreso,
              to_char(fecegreso,'DD/MM/YYYY') AS fecegreso,
              motivo_culminacion_laboral,
              cancelo_adelanto_prestaciones, 
              concepto, 
              monto,
              id_demandante,
              id_expediente,
              monto_demanda
              from ".clConstantesModelo::correspondencia_table."tbl_expediente_referidos where bolborrado=0";
        if($id_demandante > 0){
            $sql.=" and lngcodigo=".$id_demandante;
        }

        if($id_expediente > 0){
            $sql.=" and id_expediente=".$id_expediente;
        }
//exit($sql);
        $conn->sql=$sql;
        $data=$conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
        
    }
    
    public function eliminarDemandanteReferido($lngcodigo){
        $conn = new Conexion();
        $conn->abrirConexion();
        $sql="update ".clConstantesModelo::correspondencia_table."tbl_expediente_referidos
         set
         bolborrado=1
         WHERE lngcodigo=".$lngcodigo;
        $conn->sql=$sql;
        if($conn->ejecutarSentencia()){
             $retorno=true;
         }else{
             $retorno=false;
         }
         
         $conn->cerrarConexion();
         return $retorno;
    }
    
    
     public function SelectAllExpedienteReporte($id_origen, $id_motivo, $id_fase,$id_actuacion_persona,$id_tipo_organismo_centralizado,$id_tipo_organismo,$strnroexpediente,$strnroexpedienteauxiliar){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT 
           id_proactuacion, 
           id_usuario, 
           id_ano, 
           id_origen, 
           id_motivo, 
           id_fase, 
           id_actuacion, 
           id_tipo_organismo, 
           id_organismo, 
           id_refer, 
           id_estado_fisico_expediente, 
           id_tipo_espacio, 
           id_tipo_archivador, 
           id_tipo_piso_archivador, 
           id_tipo_archivador_gaveta, 
           strnroexpediente, 
           strdescripcion, 
           to_char(fecapertura,'DD/MM/YYYY') as fecapertura,
           to_char(feccierre,'DD/MM/YYYY') as feccierre,
           to_char(fecexpediente,'DD/MM/YYYY') as fecexpediente,
           intcuantias, 
           intsentenciado,
           inttranzado,
           intahorrado,
           strdocumentos, 
           strobservacion_cerrar, 
           strnroexpedienteauxiliar, 
           strrepresentante, 
           fecadmdem, 
           fecnotdem, 
           fecultnotordtri, 
           fecinsaudpre, 
           fecculfaspre, 
           feccondem, 
           fecadmpru, 
           fecjuiorapub, 
           fecpubsen, 
           fecapelacion, 
           bolborrado, 
           id_contrario, 
           id_tipo_organismo_centralizado, 
           otrafase, 
           otromotivo, 
           id_abogado_resp          
           FROM public.tblactuaciones  WHERE bolborrado=0";

//         if (($_SESSION['id_profile']!=  clConstantesModelo::administrador_sistema) || ($_SESSION['id_profile']!=clConstantesModelo::coordinador_sistema))
//             $sql.=" and id_usuario=".$_SESSION['id_contacto'];
//       
         
         if($id_origen > 0){
             $sql .=" AND id_origen=".$id_origen;
         }
         if($id_motivo > 0){
             $sql .=" AND id_motivo=".$id_motivo;
         }
         if($id_fase > 0){
             $sql .=" AND id_fase=".$id_fase;
         }
         if($id_actuacion_persona > 0){
             $sql .=" AND id_actuacion=".$id_actuacion_persona;
         }
         if($id_tipo_organismo_centralizado > 0){
             $sql .=" AND id_tipo_organismo_centralizado=".$id_tipo_organismo_centralizado;
         }
         if($id_tipo_organismo > 0){
             $sql .=" AND id_tipo_organismo=".$id_tipo_organismo;
         }
         if($strnroexpediente !=""){
             $sql .=" AND strnroexpediente=".$strnroexpediente;
         }
         if($strnroexpedienteauxiliar !=""){
             $sql .=" AND strnroexpedienteauxiliar=".$strnroexpedienteauxiliar;
         }
         $sql.=" order by id_proactuacion asc";
//         exit($sql);
         $conn->sql=$sql;   
         $data = $conn->ejecutarSentencia(2);
         return $data;
    
    
    
 }
 
     public function SelectExpedienteReporte($id_expediente){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="select c.id_proactuacion, 
             c.id_usuario, 
             c.id_ano, 
             c.id_origen, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_origen LIMIT 1) AS origen,
             c.id_motivo, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_motivo LIMIT 1) AS motivo,
             c.id_fase, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_fase LIMIT 1) AS fase,
             c.id_actuacion, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_actuacion LIMIT 1) AS actuacion,
             c.id_tipo_organismo, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_tipo_organismo LIMIT 1) AS tipo_organismo,             
             c.id_tipo_organismo_centralizado,
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_tipo_organismo_centralizado LIMIT 1) AS tipo_organismo_centralizado,                          
             c.id_organismo, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_organismo LIMIT 1) AS organismo,                          
             c.id_refer, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_refer LIMIT 1) AS refer,                          
             c.id_estado_fisico_expediente, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_estado_fisico_expediente LIMIT 1) AS estado_fisico_expediente,                          
             c.id_tipo_espacio, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_tipo_espacio LIMIT 1) AS tipo_espacio,                          
             c.id_tipo_archivador, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_tipo_archivador LIMIT 1) AS tipo_archivador,                          
             c.id_tipo_piso_archivador, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_tipo_piso_archivador LIMIT 1) AS tipo_piso_archivador,                          
             c.id_tipo_archivador_gaveta, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_tipo_archivador_gaveta LIMIT 1) AS tipo_archivador_gaveta,                          
             c.id_contrario,
              (SELECT (upper(strapellido) || ', '::text) || upper(strnombre) FROM ".clConstantesModelo::correspondencia_table."tbl_contrarios A WHERE A.id_contrarios=c.id_contrario LIMIT 1) AS nombre_contrario,
             c.strnroexpediente, 
             c.strdescripcion, 
             c.otromotivo,
             c.otrafase,
             to_char(c.fecapertura,'DD/MM/YYYY') as fecapertura,             
             to_char(c.feccierre,'DD/MM/YYYY') as feccierre,
             to_char(c.fecexpediente,'DD/MM/YYYY') as fecexpediente,             
             c.intcuantias, 
             c.strdocumentos, 
             c.strobservacion_cerrar, 
             c.strnroexpedienteauxiliar, 
             c.strrepresentante, 
             to_char(c.fecadmdem,'DD/MM/YYYY') as fecadmdem,                
             to_char(c.fecnotdem,'DD/MM/YYYY') as fecnotdem,                
             to_char(c.fecultnotordtri,'DD/MM/YYYY') as fecultnotordtri,                
             to_char(c.fecinsaudpre,'DD/MM/YYYY') as fecinsaudpre,                
             to_char(c.fecculfaspre,'DD/MM/YYYY') as fecculfaspre,                
             to_char(c.feccondem,'DD/MM/YYYY') as feccondem,                
             to_char(c.fecadmpru,'DD/MM/YYYY') as fecadmpru,                
             to_char(c.fecjuiorapub,'DD/MM/YYYY') as fecjuiorapub,                
             to_char(c.fecpubsen,'DD/MM/YYYY') as fecpubsen,                
             to_char(c.fecapelacion,'DD/MM/YYYY') as fecapelacion                
         FROM ".clConstantesModelo::correspondencia_table.self::TABLA." c WHERE c.bolborrado=0 and c.id_usuario=".$_SESSION['id_contacto'];
         
         if($id_expediente !=""){
             $sql .=" AND c.id_proactuacion=".$id_expediente;
         }
         $sql.=" order by c.id_proactuacion asc";
//         exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }     
    
    
 
     public function SelectExpedienteDemandaReporte($id_expediente){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="select 
                c.id_proexpediente_personas_demandadas, 
                c.id_contrarios, 
                (SELECT (upper(strapellido) || ', '::text) || upper(strnombre) FROM ".clConstantesModelo::correspondencia_table."tbl_contrarios A WHERE A.id_contrarios=c.id_contrarios LIMIT 1) AS nombre_contrario,
                (SELECT strcedula FROM ".clConstantesModelo::correspondencia_table."tbl_contrarios A WHERE A.id_contrarios=c.id_contrarios LIMIT 1) AS cedula,
                c.id_proexpediente                
         FROM public.tblproexpediente_personas_demandadas c WHERE c.bolborrado=0 and c.id_proexpediente=".$id_expediente;
//         exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }        
    
    public function SelectExpedienteDemandaAbogadosReporte($id_expediente){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="select 
             c.id_proexpediente_abogados_demandantes, 
             c.id_abogados, 
             c.id_proexpediente, 
             (SELECT (upper(strapellido) || ', '::text) || upper(strnombre) FROM ".clConstantesModelo::correspondencia_table."tbl_abogados_contrarios A WHERE A.id_abogadoscon=c.id_abogados LIMIT 1) AS nombre_contrario,
             (SELECT strcedula FROM ".clConstantesModelo::correspondencia_table."tbl_abogados_contrarios A WHERE A.id_abogadoscon=c.id_abogados LIMIT 1) AS cedula
         FROM public.tblproexpediente_abogados_demandantes c WHERE c.bolborrado=0 and c.id_proexpediente=".$id_expediente;
//         exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }       
    
    
     public function SelectExpedienteCompletoReporte($id_origen=0,$id_motivo=0,$id_fase=0,$id_actuacion_persona=0,$id_tipo_organismo_centralizado=0,$id_tipo_organismo=0,$strnroexpediente="",$strnroexpedienteauxiliar=""){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="select c.id_proactuacion, 
             c.id_usuario, 
             c.id_ano, 
             c.id_origen, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_origen LIMIT 1) AS origen,
             c.id_motivo, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_motivo LIMIT 1) AS motivo,
             c.id_fase, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_fase LIMIT 1) AS fase,
             c.id_actuacion, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_actuacion LIMIT 1) AS actuacion,
             c.id_tipo_organismo, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_tipo_organismo LIMIT 1) AS tipo_organismo,             
             c.id_tipo_organismo_centralizado,
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_tipo_organismo_centralizado LIMIT 1) AS tipo_organismo_centralizado,                          
             c.id_organismo, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_organismo LIMIT 1) AS organismo,                          
             c.id_refer, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_refer LIMIT 1) AS refer,                          
             c.id_estado_fisico_expediente, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_estado_fisico_expediente LIMIT 1) AS estado_fisico_expediente,                          
             c.id_tipo_espacio, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_tipo_espacio LIMIT 1) AS tipo_espacio,                          
             c.id_tipo_archivador, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_tipo_archivador LIMIT 1) AS tipo_archivador,                          
             c.id_tipo_piso_archivador, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_tipo_piso_archivador LIMIT 1) AS tipo_piso_archivador,                          
             c.id_tipo_archivador_gaveta, 
              (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros A WHERE A.id_maestro=c.id_tipo_archivador_gaveta LIMIT 1) AS tipo_archivador_gaveta,                          
             c.id_contrario,
              (SELECT (upper(strapellido) || ', '::text) || upper(strnombre) FROM ".clConstantesModelo::correspondencia_table."tbl_contrarios A WHERE A.id_contrarios=c.id_contrario LIMIT 1) AS nombre_contrario,
             c.strnroexpediente, 
             c.strdescripcion, 
             c.otromotivo,
             c.otrafase,
             to_char(c.fecapertura,'DD/MM/YYYY') as fecapertura,             
             to_char(c.feccierre,'DD/MM/YYYY') as feccierre,
             to_char(c.fecexpediente,'DD/MM/YYYY') as fecexpediente,             
             c.intcuantias, 
             c.strdocumentos, 
             c.strobservacion_cerrar, 
             c.strnroexpedienteauxiliar, 
             c.strrepresentante, 
             c.intsentenciado, 
             c.inttranzado, 
             c.intahorrado,
             to_char(c.fecadmdem,'DD/MM/YYYY') as fecadmdem,                
             to_char(c.fecnotdem,'DD/MM/YYYY') as fecnotdem,                
             to_char(c.fecultnotordtri,'DD/MM/YYYY') as fecultnotordtri,                
             to_char(c.fecinsaudpre,'DD/MM/YYYY') as fecinsaudpre,                
             to_char(c.fecculfaspre,'DD/MM/YYYY') as fecculfaspre,                
             to_char(c.feccondem,'DD/MM/YYYY') as feccondem,                
             to_char(c.fecadmpru,'DD/MM/YYYY') as fecadmpru,                
             to_char(c.fecjuiorapub,'DD/MM/YYYY') as fecjuiorapub,                
             to_char(c.fecpubsen,'DD/MM/YYYY') as fecpubsen,                
             to_char(c.fecapelacion,'DD/MM/YYYY') as fecapelacion                
         FROM ".clConstantesModelo::correspondencia_table.self::TABLA." c WHERE c.bolborrado=0 ";
         
         
         if($id_origen > 0){
             $sql .=" AND c.id_origen=".$id_origen;
         }
         if($id_motivo > 0){
             $sql .=" AND c.id_motivo=".$id_motivo;
         }
         if($id_fase > 0){
             $sql .=" AND c.id_fase=".$id_fase;
         }
         if($id_actuacion_persona > 0){
             $sql .=" AND c.id_actuacion=".$id_actuacion_persona;
         }
         if($id_tipo_organismo_centralizado > 0){
             $sql .=" AND c.id_tipo_organismo_centralizado=".$id_tipo_organismo_centralizado;
         }
         if($id_tipo_organismo > 0){
             $sql .=" AND c.id_tipo_organismo=".$id_tipo_organismo;
         }
         if($strnroexpediente !=""){
             $sql .=" AND c.strnroexpediente='".$strnroexpediente."'";
         }
         if($strnroexpedienteauxiliar !=""){
             $sql .=" AND c.strnroexpedienteauxiliar='".$strnroexpedienteauxiliar."'";
         }
         $sql.=" order by c.id_proactuacion asc";
//         exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }     
      

 
 }
?>
