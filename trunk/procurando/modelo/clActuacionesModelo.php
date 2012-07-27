<?php
 session_start();
 require_once "../controlador/Conexion.php";
// require_once '../herramientas/herramientas.class.php';     
 /**
 * Description of clTblproexpediente
 * @author jmendoza
 */
 class clActuaciones {

//=========================== VAR ===================



  const TABLA='tblactuaciones';
  
  private   $id_proactuacion;

  private   $id_proclientecasos;

  private   $id_proabogadoscasos;

  private   $id_documentoscasos;

  private   $id_usuario;

  private   $id_tramita;

  private   $id_materia;

  private   $id_estatus;

  private   $strnroexpediente;

  private   $strtitulo;

  private   $strdescripcion;

  private   $id_refer;

  private   $fecapertura;

  private   $feccierre;

  private   $bolborrado;

  private   $cedula_abogado_responsable;

  private   $cedula_abogado_ejecutor;

  private   $cedula_cliente;

  private   $strletrado;

  private   $id_actuacion_persona;
  
  private   $id_honorario;
  
  private   $id_tipo_tramite;

  private   $id_tipo_atencion;

  private   $id_tipo_organismo;

  private   $id_organismo;

  private   $id_tipo_minuta;

  private   $id_minuta;

  private   $strobservacion;

  private   $fecexpediente;

  private   $strdireccion_asistido;

  private   $strdireccion_conyugue;

  private   $strdireccion_ultimo_domicilio;

  private   $fecseparacion;

  private   $intmonto_manutencion;

  private   $id_regimen;
  
  private   $strdocumentos;
  
  private   $strdias;
  
  private   $strhoras;  
  
  private   $intcuotames1;
  
  private   $intcuotames2;    

  private   $cedula_conyugue;      
  
  private   $id_citacion;        

  private   $strobservacion_cerrar;   
  
  private   $strnroexpedienteauxiliar;
  
  private   $strrepresentante;  
  
  private   $id_estado_fisico_expediente;

  private   $id_tipo_espacio;

  private   $id_tipo_archivador;

  private   $id_tipo_piso_archivador;

  private   $id_tipo_archivador_gaveta;  
  
  private   $id_abogado_resp;

  private   $id_abogado_ejecutor;

  private   $id_solicitante;

  private   $id_contrarios;    

//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     $functions= new functions();   
     if($request['id_proexpediente'] != ""){
        $this->set_id_proactuacion($request['id_proexpediente']);
     }


     if($request['id_proclientecasos'] != ""){
        $this->set_id_proclientecasos($request['id_proclientecasos']);
     }


     if($request['id_proabogadoscasos'] != ""){
        $this->set_id_proabogadoscasos($request['id_proabogadoscasos']);
     }


     if($request['id_documentoscasos'] != ""){
        $this->set_id_documentoscasos($request['id_documentoscasos']);
     }


     if($_SESSION['id_contacto'] != ""){
        $this->set_id_usuario($_SESSION['id_contacto']);
     }


     if($request['id_tramita'] != ""){
        $this->set_id_tramita($request['id_tramita']);
     }


     if($request['id_materia'] != ""){
        $this->set_id_materia($request['id_materia']);
     }


     if($request['id_estatus'] != ""){
        $this->set_id_estatus($request['id_estatus']);
     }


     if($request['strnroexpediente'] != ""){
        $this->set_strnroexpediente($request['strnroexpediente']);
     }


     if($request['strtitulo'] != ""){
        $this->set_strtitulo($request['strtitulo']);
     }


     if($request['strdescripcion'] != ""){
        $this->set_strdescripcion($request['strdescripcion']);
     }


     if($request['id_refer'] != ""){
        $this->set_id_refer($request['id_refer']);
     }


     if($request['fecapertura'] != ""){
        $this->set_fecapertura($request['fecapertura']);
     }


     if($request['feccierre'] != ""){
        $this->set_feccierre($request['feccierre']);
     }


     if($request['bolborrado'] != ""){
        $this->set_bolborrado($request['bolborrado']);
     }


     if($request['cedula_abogado_responsable'] != ""){
        $this->set_cedula_abogado_responsable($request['cedula_abogado_responsable']);
     }


     if($request['cedula_abogado_ejecutor'] != ""){
        $this->set_cedula_abogado_ejecutor($request['cedula_abogado_ejecutor']);
     }


     if($request['cedula_cliente'] != ""){
        $this->set_cedula_cliente($request['cedula_cliente']);
     }


     if($request['strletrado'] != ""){
        $this->set_strletrado($request['strletrado']);
     }


     if($request['id_actuacion_persona'] != ""){
        $this->set_id_actuacion_persona($request['id_actuacion_persona']);
     }


     if($request['id_honorario'] != ""){
        $this->set_id_honorario($request['id_honorario']);
     }
     

     if($request['id_tipo_tramite'] != ""){
        $this->set_id_tipo_tramite($request['id_tipo_tramite']);
     }


     if($request['id_tipo_atencion'] != ""){
        $tipo=  explode('-', $request['id_tipo_atencion']);
        $this->set_id_tipo_atencion($tipo[2]);
     }


     if($request['id_tipo_organismo'] != ""){
        $this->set_id_tipo_organismo($request['id_tipo_organismo']);
     }


     if($request['id_organismo'] != ""){
        $this->set_id_organismo($request['id_organismo']);
     }


     if($request['id_tipo_minuta'] != ""){
        $this->set_id_tipo_minuta($request['id_tipo_minuta']);
     }


     if($request['id_minuta'] != ""){
        $this->set_id_minuta($request['id_minuta']);
     }


     if($request['strobservacion'] != ""){
        $this->set_strobservacion($request['strobservacion']);
     }


     if($request['fecexpediente'] != ""){
        $this->set_fecexpediente($request['fecexpediente']);
     }


     if($request['strdireccion_asistido'] != ""){
        $this->set_strdireccion_asistido($request['strdireccion_asistido']);
     }


     if($request['strdireccion_conyugue'] != ""){
        $this->set_strdireccion_conyugue($request['strdireccion_conyugue']);
     }


     if($request['strdireccion_ultimo_domicilio'] != ""){
        $this->set_strdireccion_ultimo_domicilio($request['strdireccion_ultimo_domicilio']);
     }


     if($request['fecseparacion'] != ""){
        $this->set_fecseparacion($request['fecseparacion']);
     }


     if($request['intmonto_manutencion'] != ""){
        $this->set_intmonto_manutencion($functions->toFloat($request['intmonto_manutencion']));
     }else{
          $this->set_intmonto_manutencion(0.00);
     }


     if($request['id_regimen'] != ""){
        $this->set_id_regimen($request['id_regimen']);
     }
     
     if($request['strdocumentos'] != ""){
        $this->set_strdocumentos($request['strdocumentos']);
     }
     
     if($request['strdias'] != ""){
        $this->set_strdias($request['strdias']);
     }
     
     if($request['strhoras'] != ""){
        $this->set_strhoras($request['strhoras']);
     }     
     
     if($request['intcuotames1'] != ""){
        $this->set_intcuotames1($functions->toFloat($request['intcuotames1']));
     }
     else{
          $this->set_intcuotames1(0.00);
     }     
     
     if($request['intcuotames2'] != ""){
        $this->set_intcuotames2($functions->toFloat($request['intcuotames2']));
     }
     else{
          $this->set_intcuotames2(0.00);
     }     
     
     if($request['cedula_conyugue'] != ""){
        $this->set_cedula_conyugue($request['cedula_conyugue']);
     }     
     
     
     if($request['id_citacion'] != ""){
        $this->set_id_citacion($request['id_citacion']);
     }   
     
     if($request['strobservacion_cerrar'] != ""){
        $this->set_strobservacion_cerrar($request['strobservacion_cerrar']);
     }   
     else $this->set_strobservacion_cerrar('');
         
     if($request['strnroexpedienteauxiliar'] != ""){
        $this->set_strnroexpedienteauxiliar($request['strnroexpedienteauxiliar']);
     }

     if($request['strrepresentante'] != ""){
        $this->set_strrepresentante($request['strrepresentante']);        
     }        
     
     if($request['id_estado_fisico_expediente'] != ""){
        $this->id_estado_fisico_expediente= $request['id_estado_fisico_expediente'];
     }


     if($request['id_tipo_espacio'] != ""){
        $this->id_tipo_espacio= $request['id_tipo_espacio'];
     }


     if($request['id_tipo_archivador'] != ""){
        $this->id_tipo_archivador= $request['id_tipo_archivador'];
     }


     if($request['id_tipo_piso_archivador'] != ""){
        $this->id_tipo_piso_archivador= $request['id_tipo_piso_archivador'];
     }


     if($request['id_tipo_archivador_gaveta'] != ""){
        $this->id_tipo_archivador_gaveta= $request['id_tipo_archivador_gaveta'];
     }  
     
 
     if($request['id_abogado_resp'] != ""){
        $this->id_abogado_resp= $request['id_abogado_resp'];
     }


     if($request['id_abogado_ejecutor'] != ""){
        $this->id_abogado_ejecutor= $request['id_abogado_ejecutor'];
     }


     if($request['id_solicitante'] != ""){
        $this->id_solicitante= $request['id_solicitante'];
     }


     if($request['id_contrarios'] != ""){
        $this->id_contrarios= $request['id_contrarios'];
     }    
     

}//=========================== GET ===================




    public function get_id_proactuacion(){
        return $this->id_proactuacion;
    }



    public function get_id_proclientecasos(){
        return $this->id_proclientecasos;
    }



    public function get_id_proabogadoscasos(){
        return $this->id_proabogadoscasos;
    }



    public function get_id_documentoscasos(){
        return $this->id_documentoscasos;
    }



    public function get_id_usuario(){
        return $this->id_usuario;
    }



    public function get_id_tramita(){
        return $this->id_tramita;
    }



    public function get_id_materia(){
        return $this->id_materia;
    }



    public function get_id_estatus(){
        return $this->id_estatus;
    }



    public function get_strnroexpediente(){
        return $this->strnroexpediente;
    }



    public function get_strtitulo(){
        return $this->strtitulo;
    }



    public function get_strdescripcion(){
        return $this->strdescripcion;
    }



    public function get_id_refer(){
        return $this->id_refer;
    }



    public function get_fecapertura(){
        return $this->fecapertura;
    }



    public function get_feccierre(){
        return $this->feccierre;
    }



    public function get_bolborrado(){
        return $this->bolborrado;
    }



    public function get_cedula_abogado_responsable(){
        return $this->cedula_abogado_responsable;
    }



    public function get_cedula_abogado_ejecutor(){
        return $this->cedula_abogado_ejecutor;
    }



    public function get_cedula_cliente(){
        return $this->cedula_cliente;
    }



    public function get_strletrado(){
        return $this->strletrado;
    }



    public function get_id_actuacion_persona(){
        return $this->id_actuacion_persona;
    }

    
    public function get_id_honorario(){
        return $this->id_honorario;
    }


    public function get_id_tipo_tramite(){
        return $this->id_tipo_tramite;
    }



    public function get_id_tipo_atencion(){
        return $this->id_tipo_atencion;
    }



    public function get_id_tipo_organismo(){
        return $this->id_tipo_organismo;
    }



    public function get_id_organismo(){
        return $this->id_organismo;
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



    public function get_fecexpediente(){
        return $this->fecexpediente;
    }



    public function get_strdireccion_asistido(){
        return $this->strdireccion_asistido;
    }



    public function get_strdireccion_conyugue(){
        return $this->strdireccion_conyugue;
    }



    public function get_strdireccion_ultimo_domicilio(){
        return $this->strdireccion_ultimo_domicilio;
    }



    public function get_fecseparacion(){
        return $this->fecseparacion;
    }



    public function get_intmonto_manutencion(){
        return $this->intmonto_manutencion;
    }



    public function get_id_regimen(){
        return $this->id_regimen;
    }
    
    public function get_strdocumentos(){
        return $this->strdocumentos;
    }
    
    public function get_strhoras(){
        return $this->strhoras;
    }
    
    public function get_strdias(){
        return $this->strdias;
    }    

    public function get_intcuotames1(){
        return $this->intcuotames1;
    }
    
    public function get_intcuotames2(){
        return $this->intcuotames2;
    }    

    public function get_cedula_conyugue(){
        return $this->cedula_conyugue;
    }    

    public function get_id_citacion(){
        return $this->id_citacion;
    }    


    public function get_strobservacion_cerrar(){
        return $this->strobservacion_cerrar;
    }        

    public function get_strnroexpedienteauxiliar(){
        return $this->strnroexpedienteauxiliar;
    }  
    
    public function get_strrepresentante(){
        return $this->strrepresentante;
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
    
    
  
    public function getId_abogado_resp(){
        return $this->id_abogado_resp;
    }



    public function getId_abogado_ejecutor(){
        return $this->id_abogado_ejecutor;
    }



    public function getId_solicitante(){
        return $this->id_solicitante;
    }



    public function getId_contrarios(){
        return $this->id_contrarios;
    }
      
  
  
//=========================== SET ===================




    public function set_id_proactuacion($id_proexpediente){
        return $this->id_proactuacion=$id_proexpediente;
    }



    public function set_id_proclientecasos($id_proclientecasos){
        return $this->id_proclientecasos=$id_proclientecasos;
    }



    public function set_id_proabogadoscasos($id_proabogadoscasos){
        return $this->id_proabogadoscasos=$id_proabogadoscasos;
    }



    public function set_id_documentoscasos($id_documentoscasos){
        return $this->id_documentoscasos=$id_documentoscasos;
    }



    public function set_id_usuario($id_usuario){
        return $this->id_usuario=$id_usuario;
    }



    public function set_id_tramita($id_tramita){
        return $this->id_tramita=$id_tramita;
    }



    public function set_id_materia($id_materia){
        return $this->id_materia=$id_materia;
    }



    public function set_id_estatus($id_estatus){
        return $this->id_estatus=$id_estatus;
    }



    public function set_strnroexpediente($strnroexpediente){
        return $this->strnroexpediente=$strnroexpediente;
    }



    public function set_strtitulo($strtitulo){
        return $this->strtitulo=$strtitulo;
    }



    public function set_strdescripcion($strdescripcion){
        return $this->strdescripcion=$strdescripcion;
    }



    public function set_id_refer($id_refer){
        return $this->id_refer=$id_refer;
    }



    public function set_fecapertura($fecapertura){
        return $this->fecapertura=$fecapertura;
    }



    public function set_feccierre($feccierre){
        return $this->feccierre=$feccierre;
    }



    public function set_bolborrado($bolborrado){
        return $this->bolborrado=$bolborrado;
    }



    public function set_cedula_abogado_responsable($cedula_abogado_responsable){
        return $this->cedula_abogado_responsable=$cedula_abogado_responsable;
    }



    public function set_cedula_abogado_ejecutor($cedula_abogado_ejecutor){
        return $this->cedula_abogado_ejecutor=$cedula_abogado_ejecutor;
    }



    public function set_cedula_cliente($cedula_cliente){
        return $this->cedula_cliente=$cedula_cliente;
    }



    public function set_strletrado($strletrado){
        return $this->strletrado=$strletrado;
    }



    public function set_id_actuacion_persona($id_actuacion_persona){
        return $this->id_actuacion_persona=$id_actuacion_persona;
    }


    public function set_id_honorario($id_honorario){
        return $this->id_honorario=$id_honorario;
    }    
    
    
    public function set_id_tipo_tramite($id_tipo_tramite){
        return $this->id_tipo_tramite=$id_tipo_tramite;
    }



    public function set_id_tipo_atencion($id_tipo_atencion){
        return $this->id_tipo_atencion=$id_tipo_atencion;
    }



    public function set_id_tipo_organismo($id_tipo_organismo){
        return $this->id_tipo_organismo=$id_tipo_organismo;
    }



    public function set_id_organismo($id_organismo){
        return $this->id_organismo=$id_organismo;
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



    public function set_fecexpediente($fecexpediente){
        return $this->fecexpediente=$fecexpediente;
    }



    public function set_strdireccion_asistido($strdireccion_asistido){
        return $this->strdireccion_asistido=$strdireccion_asistido;
    }



    public function set_strdireccion_conyugue($strdireccion_conyugue){
        return $this->strdireccion_conyugue=$strdireccion_conyugue;
    }



    public function set_strdireccion_ultimo_domicilio($strdireccion_ultimo_domicilio){
        return $this->strdireccion_ultimo_domicilio=$strdireccion_ultimo_domicilio;
    }



    public function set_fecseparacion($fecseparacion){
        return $this->fecseparacion=$fecseparacion;
    }



    public function set_intmonto_manutencion($intmonto_manutencion){
        return $this->intmonto_manutencion=$intmonto_manutencion;
    }



    public function set_id_regimen($id_regimen){
        return $this->id_regimen=$id_regimen;
    }
    
    public function set_strdocumentos($strdocumentos){
        return $this->strdocumentos=$strdocumentos;
    }


    public function set_strdias($strdias){
        return $this->strdias=$strdias;
    }
    
    public function set_strhoras($strhoras){
        return $this->strhoras=$strhoras;
    }
    
    public function set_intcuotames1($intcuotames1){
        return $this->intcuotames1=$intcuotames1;
    }
    
    public function set_intcuotames2($intcuotames2){
        return $this->intcuotames2=$intcuotames2;
    }
    
    public function set_cedula_conyugue($cedula_conyugue){
        return $this->cedula_conyugue=$cedula_conyugue;
    }
    
    public function set_id_citacion($id_citacion){
        return $this->id_citacion=$id_citacion;
    }    

    
    public function set_strobservacion_cerrar($strobservacion_cerrar){
        return $this->strobservacion_cerrar=$strobservacion_cerrar;
    }        
    
    public function set_strnroexpedienteauxiliar($strnroexpedienteauxiliar){
        return $this->strnroexpedienteauxiliar=$strnroexpedienteauxiliar;
    }            
        
    public function set_strrepresentante($strrepresentante){
        return $this->strrepresentante=$strrepresentante;
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
    
    
    public function setId_abogado_resp($id_abogado_resp){
        return $this->id_abogado_resp=$id_abogado_resp;
    }

    public function setId_abogado_ejecutor($id_abogado_ejecutor){
        return $this->id_abogado_ejecutor=$id_abogado_ejecutor;
    }

    public function setId_solicitante($id_solicitante){
        return $this->id_solicitante=$id_solicitante;
    }


    public function setId_contrarios($id_contrarios){
        return $this->id_contrarios=$id_contrarios;
    }     
    


//================================FUNCION INSERTAR============================================

    
    public static function getExpedienteClienteAgenda($id_cliente){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT id_proactuacion,strnroexpediente,strdescripcion FROM ".clConstantesModelo::correspondencia_table." ".self::TABLA." WHERE id_proexpediente=".$id_cliente;        
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
         FROM public.".self::TABLA." WHERE bolborrado=0 and id_usuario=".$_SESSION['id_contacto'];
         
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
         $sql="SELECT id_proactuacion,
         id_proclientecasos,
         id_proabogadoscasos,
         id_documentoscasos,
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
         FROM public.".self::TABLA." WHERE bolborrado=0 and id_usuario=".$_SESSION['id_contacto'];
         
         if($id_expediente !=""){
             $sql .=" AND id_proexpediente=".$id_expediente;
         }
         $sql.=" order by id_proexpediente asc";
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }    
    
    
     public function insertar($nexval){
         $expediente='OAS-' . date('dmY') . '-'.$nexval;
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="Insert into public.tblproexpediente (
         strnroexpediente,
         strtitulo,
         strdescripcion,
         id_refer,
         fecapertura,
         cedula_abogado_responsable,
         cedula_abogado_ejecutor,
         cedula_cliente,
         id_actuacion,
         id_usuario,
         id_honorario,
         id_tipo_tramite,
         id_tipo_atencion,
         id_tipo_organismo,
         id_organismo,
         id_tipo_minuta,
         id_minuta,
         strobservacion,
         fecexpediente,
         strdireccion_asistido,
         strobservacion_cerrar,
         strdireccion_conyugue,
         strdireccion_ultimo_domicilio,
         fecseparacion,
         intmonto_manutencion,
         id_regimen,
         id_citacion,
         strdias,
         strhoras,
         intcuotames1,
         intcuotames2,
         strdocumentos,
         strrepresentante,
         strnroexpedienteauxiliar,
         cedula_conyugue,
         id_abogado_resp, 
         id_abogado_ejecutor, 
         id_solicitante, 
         id_contrarios         
         ) VALUES (
         '";
//         exit($sql);
         $sql.=$expediente."','"
         .$this->get_strtitulo()."','"
         .$this->get_strdescripcion()."',"
         .$this->get_id_refer().",TO_DATE('"
         .$this->get_fecapertura()."', 'DD/MM/YYYY'),"
         .$this->get_cedula_abogado_responsable().","
         .$this->get_cedula_abogado_ejecutor().","
         .$this->get_cedula_cliente().","
         .$this->get_id_actuacion_persona().","
         .$this->get_id_usuario().","                 
         .$this->get_id_honorario().","                 
         .$this->get_id_tipo_tramite().","
         .$this->get_id_tipo_atencion().","
         .$this->get_id_tipo_organismo().","
         .$this->get_id_organismo().","
         .$this->get_id_tipo_minuta().","
         .$this->get_id_minuta().",'"
         .$this->get_strobservacion()."',TO_DATE('"
         .$this->get_fecexpediente()."', 'DD/MM/YYYY'),'"
         .$this->get_strdireccion_asistido()."','"
         .$this->get_strobservacion_cerrar()."','"                 
         .$this->get_strdireccion_conyugue()."','"
         .$this->get_strdireccion_ultimo_domicilio()."',TO_DATE('"
         .$this->get_fecseparacion()."', 'DD/MM/YYYY'),"
         .$this->get_intmonto_manutencion().","
         .$this->get_id_regimen().","
         .$this->get_id_citacion().",'"                 
         .$this->get_strdias()."','"                 
         .$this->get_strhoras()."',"             
         .$this->get_intcuotames1().","                 
         .$this->get_intcuotames2().",'"   
         .$this->get_strdocumentos()."','"  
         .$this->get_strrepresentante()."','"                  
         .$this->get_strnroexpedienteauxiliar()."','"                   
         .$this->get_cedula_conyugue()."',"
         .$this->getId_abogado_resp().","
         .$this->getId_abogado_ejecutor().","  
         .$this->getId_solicitante().","
         .$this->getId_contrarios ().")";    
//        exit($sql);         
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
         $sql="SELECT id_proexpediente,
         id_proclientecasos,
         id_proabogadoscasos,
         id_documentoscasos,
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
         FROM public.tblproexpediente WHERE bolborrado=0 and id_usuario=".$_SESSION['id_contacto'];
         
//         if($id_expediente !=""){
//             $sql .=" AND id_proexpediente=".$id_expediente;
//         }
//         exit($sql);
         $sql.=" order by id_proexpediente asc";
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
//======================================FUNCION ACTUALIZAR===============================================


     public function Update(){
         
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="UPDATE public.tblproexpediente SET
         strnroexpediente='".$this->get_strnroexpediente()."',
         strtitulo='".$this->get_strtitulo()."',
         strdescripcion='".$this->get_strdescripcion()."',
         id_refer=".$this->get_id_refer().",
         cedula_abogado_responsable='".$this->get_cedula_abogado_responsable()."',
         cedula_abogado_ejecutor='".$this->get_cedula_abogado_ejecutor()."',
         cedula_cliente='".$this->get_cedula_cliente()."',
         id_actuacion=".$this->get_id_actuacion_persona().",
         id_tipo_tramite=".$this->get_id_tipo_tramite().",
         id_tipo_atencion=".$this->get_id_tipo_atencion().",
         id_tipo_organismo=".$this->get_id_tipo_organismo().",
         id_organismo=".$this->get_id_organismo().",
         id_tipo_minuta=".$this->get_id_tipo_minuta().",
         id_minuta=".$this->get_id_minuta().",
         strobservacion='".$this->get_strobservacion()."',
         fecexpediente=TO_DATE('".$this->get_fecexpediente()."','DD/MM/YYYY'),
         strdireccion_asistido='".$this->get_strdireccion_asistido()."',
         strdireccion_conyugue='".$this->get_strdireccion_conyugue()."',
         strdireccion_ultimo_domicilio='".$this->get_strdireccion_ultimo_domicilio()."',
         fecseparacion=TO_DATE('".$this->get_fecseparacion()."','DD/MM/YYYY'),";
         if ($this->get_feccierre()!='')
            $sql.="feccierre=TO_DATE('".$this->get_feccierre()."','DD/MM/YYYY'),";             
         $sql.="intmonto_manutencion=".$this->get_intmonto_manutencion().",
         id_regimen=".$this->get_id_regimen().",
         id_citacion=".$this->get_id_citacion().",             
         strdias='".$this->get_strdias()."',";       
         if ($this->get_strobservacion_cerrar()!='')             
            $sql.="strobservacion_cerrar='".$this->get_strobservacion_cerrar()."',";                    
         $sql.="strhoras='".$this->get_strhoras()."',      
         intcuotames1=".$this->get_intcuotames1().",         
         intcuotames2=".$this->get_intcuotames2().",    
         cedula_conyugue='".$this->get_cedula_conyugue()."',    
         strnroexpedienteauxiliar='".$this->get_strnroexpedienteauxiliar()."',
         strrepresentante='".$this->get_strrepresentante()."', 
         id_estado_fisico_expediente=".$this->getId_estado_fisico_expediente().",         
         id_tipo_espacio=".$this->getId_tipo_espacio().",    
         id_tipo_archivador=".$this->getId_tipo_archivador().",    
         id_tipo_piso_archivador=".$this->getId_tipo_piso_archivador().",
         id_tipo_archivador_gaveta=".$this->getId_tipo_archivador_gaveta().",  
         id_abogado_resp=".$this->getId_abogado_resp().",    
         id_abogado_ejecutor=".$this->getId_abogado_ejecutor().",    
         id_solicitante=".$this->getId_solicitante().",
         id_contrarios=".$this->getId_contrarios().",  
         strdocumentos='".$this->get_strdocumentos()."' WHERE id_proexpediente=".$this->get_id_proexpediente();
//         exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia();
         return $data;
    }
    
    function Delete($id_proexpediente){
        $conn= new Conexion();
         $conn->abrirConexion();
         $sql="UPDATE public.tblproexpediente SET
         bolborrado=1
         WHERE id_proexpediente=".$id_proexpediente;
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
    
    public function SelectAllExpedientesFiltro($pagina,$cedula_cliente="",$cedula_abogado_responsable="",$cedula_abogado_ejecutor="",$strexpediente=""){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT id_proexpediente,
         id_proclientecasos,
         id_proabogadoscasos,
         id_documentoscasos,
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
         strdias,
         strhoras, 
         intcuotames1,
         intcuotames2,
         cedula_conyugue,
         id_citacion,
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
         strdocumentos FROM public.tblproexpediente WHERE bolborrado=0 and id_usuario=".$_SESSION['id_contacto'];
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
         $sql.=" order by id_proexpediente asc";         
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
    
    public function selectCountExpedientesAbiertos($id){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT cedula_cliente, count(id_proexpediente) AS count
                    FROM ".clConstantesModelo::correspondencia_table."tblproexpediente
                WHERE feccierre IS NULL and cedula_cliente='".$id."' GROUP BY tblproexpediente.cedula_cliente";        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }    
    
    public function selectCountExpedientesCerrados($id){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT cedula_cliente, count(id_proexpediente) AS count
                    FROM ".clConstantesModelo::correspondencia_table."tblproexpediente
                WHERE feccierre IS NOT NULL and cedula_cliente='".$id."' GROUP BY tblproexpediente.cedula_cliente";        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }    
    public static function getExpedienteCliente($id_cliente){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT id_proexpediente FROM ".clConstantesModelo::correspondencia_table."tblproexpediente WHERE id_cliente=".$id_cliente;        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data[0][feccierre];
    }        
    
    public static function getExpedFecie($id){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT feccierre FROM ".clConstantesModelo::correspondencia_table."tblproexpediente WHERE id_proexpediente=".$id;        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data[0][feccierre];
    }    
     
     public function selectVista_abogados_casos_cargados(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."vista_abogados_casos_cargados";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
    
     public function selectVista_abogados_casos_cargados_total(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."vista_abogados_casos_cargados_total";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }    

     public function selectFases($id_expediente){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "SELECT 
            id_proexpediente_fase,id_tipo_fase,id_fase,strobservacion,id_proexpediente,
            (SELECT STRITEMA FROM ".clConstantesModelo::correspondencia_table."TBLMAESTROS A WHERE A.ID_MAESTRO=id_tipo_fase LIMIT 1) AS tipo_fase,
            (SELECT STRITEMA FROM ".clConstantesModelo::correspondencia_table."TBLMAESTROS A WHERE A.ID_MAESTRO=id_fase LIMIT 1) AS fase,
            to_char(fecfase,'DD/MM/YYYY') as fecfase
            FROM ".clConstantesModelo::correspondencia_table."tblproexpediente_fases where bolborrado=0 and id_proexpediente=".$id_expediente;
        $conn->sql=$sql;
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }    
    
    public function SelectAllExpedientesFiltroAgenda($pagina,$cedula_cliente="",$cedula_abogado_responsable="",$cedula_abogado_ejecutor="",$strexpediente=""){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT 
         a.id_proexpediente,
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
         public.tblproexpediente a,
         public.tblproexpediente_situaciones b
         WHERE a.id_proexpediente=b.id_proexpediente and a.bolborrado=0 and b.bolborrado=0 and a.id_usuario=".$_SESSION['id_contacto'];
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
         $sql.=" order by a.id_proexpediente asc";      
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
         $sql="SELECT a.id_proexpediente,
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
         public.tblproexpediente a,
         public.tblproexpediente_situaciones b
         WHERE 
         a.bolborrado=0 and b.bolborrado=0 and a.id_proexpediente=b.id_proexpediente and
         a.bolborrado=0 and b.id_estado_minuta>0 and b.id_estado_minuta<>13193 and a.id_usuario=".$_SESSION['id_contacto'];
         
//         if($id_expediente !=""){
//             $sql .=" AND id_proexpediente=".$id_expediente;
//         }
//         exit($sql);
         $sql.=" order by a.id_proexpediente asc";
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
    
    
 }
?>
