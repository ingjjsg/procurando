<?php
 session_start();
 require_once '../controlador/Conexion.php';
 require_once '../modelo/clConstantesModelo.php';
 require_once '../modelo/clFunciones.php'; 
 /**
 * Description of clTbldocumento
 * @author jsuarez
 */
 class clTblDocumento {

//=========================== VAR ===================




  private   $id_documento;

  private   $id_usuario;

  private   $id_tipo;

  private   $id_evento;

  private   $id_prioridad;

  private   $id_estado;

  private   $id_recordatorio;

  private   $id_unidad;

  private   $fecdocumento;

  private   $strdescripcion;

  private   $strtitulo;

  private   $id_expediente;

  private   $bolborrado;
  
  private   $id_tipo_organismo;

  private   $id_organismo;  

  private   $strpersona;

  private   $id_refiere;
  
  private   $id_contacto;  

  private   $date;
  
  private   $id_documento_accion;  

  private   $strnumero;    
  
  private   $strtelefono;      
  
  private   $strrespuesta;

  private   $strubicacion;  
  
  private   $strdirigido;

  private   $strrecibido;
  
  
  
//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     if($request['id_documento'] != ""){
        $this->id_documento= $request['id_documento'];
     }
   
     
     if($_SESSION['id_contacto'] != ""){
        $this->id_usuario=$_SESSION['id_contacto'];
     }
 

     if($request['id_tipo'] != ""){
        $this->id_tipo= $request['id_tipo'];
     }


     if($request['id_evento'] != ""){
        $this->id_evento= $request['id_evento'];
     }


     if($request['id_prioridad'] != ""){
        $this->id_prioridad= $request['id_prioridad'];
     }


     if($request['id_estado'] != ""){
        $this->id_estado= $request['id_estado'];
     }


     if($request['id_recordatorio'] != ""){
        $this->id_recordatorio= $request['id_recordatorio'];
     }


     if($request['id_unidad'] != ""){
        $this->id_unidad= $request['id_unidad'];
     }


     if($request['fecdocumento'] != ""){
        $this->fecdocumento= $request['fecdocumento'];
     }


     if($request['strdescripcion'] != ""){
        $this->strdescripcion= $request['strdescripcion'];
     }


     if($request['strtitulo'] != ""){
        $this->strtitulo= $request['strtitulo'];
     }


     if($request['id_proexpediente'] != ""){
        $this->id_expediente= $request['id_proexpediente'];
     }
     else $this->id_expediente=0;


     if($request['bolborrado'] != ""){
        $this->bolborrado= $request['bolborrado'];
     }


     if($request['id_tipo_organismo'] != ""){
        $this->id_tipo_organismo= $request['id_tipo_organismo'];
     }


     if($request['id_organismo'] != ""){
        $this->id_organismo= $request['id_organismo'];
     }     

     

     if($request['strpersona'] != ""){
        $this->strpersona= $request['strpersona'];
     }
     


     if($request['id_refiere'] != ""){
        $this->id_refiere= $request['id_refiere'];
     }
     
     
     if($request['id_contacto'] != ""){
        $this->id_contacto= $request['id_contacto'];
     }
     else {
        $this->id_contacto=0;    
     }
     


     if($request['date'] != ""){
        $this->date= $request['date'];
     }
 else {
        $this->date= date('d/m/Y, h:i:s a');         
     }

     if($request['id_documento_accion'] != ""){
        $this->id_documento_accion= $request['id_documento_accion'];
     }      
     
     if($request['strnumero'] != ""){
        $this->strnumero= $request['strnumero'];
     }      
     
     if($request['strtelefono'] != ""){
        $this->strtelefono= $request['strtelefono'];
     }           
     

     if($request['strrespuesta'] != ""){
        $this->strrespuesta= $request['strrespuesta'];
     }


     if($request['strubicacion'] != ""){
        $this->strubicacion= $request['strubicacion'];
     }     
     
     
     if($request['strdirigido'] != ""){
        $this->strdirigido= $request['strdirigido'];
     }


     if($request['strrecibido'] != ""){
        $this->strrecibido= $request['strrecibido'];
     }
     
     
}//=========================== GET ===================




    public function getId_documento(){
        return $this->id_documento;
    }



    public function getId_usuario(){
        return $this->id_usuario;
    }



    public function getId_tipo(){
        return $this->id_tipo;
    }



    public function getId_evento(){
        return $this->id_evento;
    }



    public function getId_prioridad(){
        return $this->id_prioridad;
    }



    public function getId_estado(){
        return $this->id_estado;
    }



    public function getId_recordatorio(){
        return $this->id_recordatorio;
    }



    public function getId_unidad(){
        return $this->id_unidad;
    }



    public function getFecdocumento(){
        return $this->fecdocumento;
    }



    public function getStrdescripcion(){
        return $this->strdescripcion;
    }



    public function getStrtitulo(){
        return $this->strtitulo;
    }



    public function getId_expediente(){
        return $this->id_expediente;
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
    

    public function getStrpersona(){
        return $this->strpersona;
    }    
    
    
    public function getId_refiere(){
        return $this->id_refiere;
    }
    


    public function getId_contacto(){
        return $this->id_contacto;
    }


    public function getDate(){
        return $this->date;
    }
    
    public function getId_documento_accion(){
        return $this->id_documento_accion;
    }    
    
    
    public function getStrnumero(){
        return $this->strnumero;
    }        
    
    
    public function getStrtelefono(){
        return $this->strtelefono;
    }            
    
    

    public function getStrrespuesta(){
        return $this->strrespuesta;
    }



    public function getStrubicacion(){
        return $this->strubicacion;
    }
    
    

    public function getStrdirigido(){
        return $this->strdirigido;
    }



    public function getStrrecibido(){
        return $this->strrecibido;
    }

    
    
//=========================== SET ===================




    public function setId_documento($id_documento){
        return $this->id_documento=$id_documento;
    }



    public function setId_usuario($id_usuario){
        return $this->id_usuario=$id_usuario;
    }



    public function setId_tipo($id_tipo){
        return $this->id_tipo=$id_tipo;
    }



    public function setId_evento($id_evento){
        return $this->id_evento=$id_evento;
    }



    public function setId_prioridad($id_prioridad){
        return $this->id_prioridad=$id_prioridad;
    }



    public function setId_estado($id_estado){
        return $this->id_estado=$id_estado;
    }



    public function setId_recordatorio($id_recordatorio){
        return $this->id_recordatorio=$id_recordatorio;
    }



    public function setId_unidad($id_unidad){
        return $this->id_unidad=$id_unidad;
    }



    public function setFecdocumento($fecdocumento){
        return $this->fecdocumento=$fecdocumento;
    }



    public function setStrdescripcion($strdescripcion){
        return $this->strdescripcion=$strdescripcion;
    }



    public function setStrtitulo($strtitulo){
        return $this->strtitulo=$strtitulo;
    }



    public function setId_expediente($id_expediente){
        return $this->id_expediente=$id_expediente;
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
    


    public function setStrpersona($strpersona){
        return $this->strpersona=$strpersona;
    }
    
    


    public function setId_refiere($id_refiere){
        return $this->id_refiere=$id_refiere;
    }
    
    

    public function setId_contacto($id_contacto){
        return $this->id_contacto=$id_contacto;
    }
    
    

    public function setDate($date){
        return $this->date=$date;
    }    
    
    public function setId_documento_accion($id_documento_accion){
        return $this->id_documento_accion=$id_documento_accion;
    }        
    
    public function setStrnumero($strnumero){
        return $this->strnumero=$strnumero;
    }       
    
    public function setStrtelefono($strtelefono){
        return $this->strtelefono=$strtelefono;
    }           
    
    
    public function setStrrespuesta($strrespuesta){
        return $this->strrespuesta=$strrespuesta;
    }



    public function setStrubicacion($strubicacion){
        return $this->strubicacion=$strubicacion;
    }
    


    public function setStrdirigido($strdirigido){
        return $this->strdirigido=$strdirigido;
    }


    public function setStrrecibido($strrecibido){
        return $this->strrecibido=$strrecibido;
    }    
    
    static public function getverIdDocumentoSiguiente(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT nextval('tbldocumento_id_documento_seq') as id_documento";
        $data= $conn->ejecutarSentencia(2);
        return $data[0][id_documento];        
    }        
    
    public function rutaDocumento($id){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT  *  from ".clConstantesModelo::correspondencia_table."vista_movimiento_documentos  where id_documento=".$id;
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }     
        
    
    
    static public function getupdateDocumentoIRespuesta($id,$valor){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "UPDATE ".clConstantesModelo::correspondencia_table."tbldocumento SET  strrespuesta='".$valor."' WHERE id_documento= ".$id;
        $conn->sql=$sql;        
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }          
    
    
    public function CountIntroNoLeidosDocumentos(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT count(id_documento) as total  FROM ".clConstantesModelo::correspondencia_table . "tbldocumento where id_usuario=".$_SESSION['id_contacto']." and visto='1'";
        $data= $conn->ejecutarSentencia(2);
        return $data[0][total];        
    }    
    
    public function CountIntroLeidosDocumentos(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT count(id_documento) as total  FROM ".clConstantesModelo::correspondencia_table . "tbldocumento where id_usuario=".$_SESSION['id_contacto']." and visto='0'";
        $data= $conn->ejecutarSentencia(2);
        return $data[0][total];        
    }       
 
    static public function getRespuestaDocumento($id) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $data='';
        $sql = "select strrespuesta from ".clConstantesModelo::correspondencia_table . "tbldocumento  where id_documento=".$id;        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if (is_array($data)) return $data[0][strrespuesta]; else return '';
    }      
    
    static public function getOrigenDocumento($id) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $data='';
        $sql = "select id_seguimiento from ".clConstantesModelo::correspondencia_table . "tbldocumento  where id_documento=".$id;        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if (is_array($data)) return $data[0][id_seguimiento]; else return '';
    }       
    
    static public function getNroDocumento($numero) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $data='';
        $sql = "select id_documento from ".clConstantesModelo::correspondencia_table . "tbldocumento  where strnumero like '%".$numero."%'";        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if (is_array($data)) return $data[0][id_documento]; else return '';
    }        
    
    static public function getMovimientoDocumentos($id) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql = "select * from ".clConstantesModelo::correspondencia_table . "vista_movimiento_documentos  where id_documento=".$id." order by id_documento_seguimiento asc";        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
            for ($i= 0; $i < count($data); $i++){
                $indice=$i+1;
                if ($i==0) $texto='Creado por ';
                else $texto='Reenviado por ';
                $html.= $indice.") ".$texto." : ".$data[$i][remite]." -> Para: ".$data[$i][remitente]." Dia Enviado: ".$data[$i][fecha]."</br>";
            }              
        return $html;
    }       
    
    static public function getMaestro($id) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql = "select stritema from ".clConstantesModelo::correspondencia_table . "tblmaestros  where id_maestro=".$id;        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data[0][stritema];
    }     

    static public function getupdateDocumentoItem($id,$valor,$campo){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "UPDATE ".clConstantesModelo::correspondencia_table."tbldocumento SET  ".$campo."=".$valor." WHERE id_documento= ".$id;
//      exit($sql);
        $conn->sql=$sql;        
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }      

	static public function getEstadoDocumentoSeguimiento($id) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql = "select visto from ".clConstantesModelo::correspondencia_table . "tbldocumento  where id_documento=".$id;        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data[0][visto];
    }      
    
    
	static public function getDiasRecordatorios($id) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql = "select lngnumero from ".clConstantesModelo::correspondencia_table . "tblmaestros  where id_maestro=".$id;        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data[0][lngnumero];
    }            
    
    
    public function selectUsuariosDepartamento($id_departamento){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT  *  from ".clConstantesModelo::correspondencia_table."tblcontacto  where id_coord_maestro=".$id_departamento;
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }     
    
    
    public function selectDocumento($id){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT  id_documento, id_usuario, id_tipo, id_evento, id_prioridad, id_estado,date, 
         id_recordatorio, id_unidad, to_char(fecdocumento,'DD/MM/YYYY') as fecdocumento, strdescripcion, strtitulo, strpersona, id_refiere, id_contacto, id_seguimiento, strnumero, strtelefono, strrespuesta, strubicacion, 
       strnumero, strtelefono, strdirigido, strrecibido, id_expediente, bolborrado, id_tipo_organismo, id_organismo  from ".clConstantesModelo::correspondencia_table."tbldocumento  where id_documento=".$id;
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }        
    
    public function selectAllDocumento(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_documento, id_usuario, id_tipo, id_evento, id_prioridad, id_estado, id_recordatorio, id_unidad, fecdocumento, strdescripcion, strtitulo, id_expediente, bolborrado, strpersona, id_refiere, visto, id_seguimiento, origen, strnumero, strtelefono, strrespuesta, strubicacion, date  ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo) AS id_tipo_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_evento) AS id_evento_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_prioridad) AS id_prioridad_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estado) AS id_estado_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_recordatorio) AS id_recordatorio_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad) AS id_unidad_documento ";        
        $sql.=" from ".clConstantesModelo::correspondencia_table."tbldocumento where  bolborrado=0 and origen<>'L' and id_usuario=".$_SESSION['id_contacto']." order by id_documento desc";
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }     
    

    
    public function selectFiltrarDocumento($fil_id_tipo, $fil_id_evento, $fil_id_unidad, $fil_id_prioridad){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_documento, id_usuario, id_tipo, id_evento, id_prioridad, id_estado, id_recordatorio, id_unidad, fecdocumento, strdescripcion, strtitulo, id_expediente, bolborrado, strpersona, id_refiere, visto, id_seguimiento, origen, strnumero, strtelefono, strrespuesta, strubicacion, date  ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo) AS id_tipo_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_evento) AS id_evento_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_prioridad) AS id_prioridad_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estado) AS id_estado_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_recordatorio) AS id_recordatorio_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad) AS id_unidad_documento ";        
        $sql.=" from ".clConstantesModelo::correspondencia_table."tbldocumento  Where id_documento>0  and bolborrado=0  and origen<>'L' and id_usuario=".$_SESSION['id_contacto'];
        if ($fil_id_tipo>0)
           $sql.=" and id_tipo=".$fil_id_tipo."";
        if ($fil_id_evento>0) 
           $sql.=" and id_evento=".$fil_id_evento."";
        if ($fil_id_unidad>0)
           $sql.=" and id_unidad=".$fil_id_unidad."";
        if ($fil_id_prioridad>0)
           $sql.=" and id_prioridad=".$fil_id_prioridad."";        
//        exit($sql);      
        $sql.=" order by id_documento desc";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }      
    
    
    public function verIdDocumento(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT CURRVAL('tbldocumento_id_documento_seq') as id_documento";
        $data= $conn->ejecutarSentencia(2);
//        exit(print_r($data));
        return $data;
    }    

    static public function  nextValDocumento() {
               $sql="SELECT last_value as maximo FROM " . clConstantesModelo::correspondencia_table . "tbldocumento_id_documento_seq";
//               exit($sql);
               $conn->sql = $sql;
               $data = $conn->ejecutarSentencia (2);
               if ($data)
               {
                    $maximo=$data[0]['maximo'];
               }
               return $maximo;
     }    
    


    public function updateDocumento($respuesta){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "UPDATE ".clConstantesModelo::correspondencia_table."tbldocumento SET ";
//        $sql.= "id_tipo= ".$this->getId_tipo().", ";
//        $sql.= "id_evento= ".$this->getId_evento().", ";        
//        $sql.= "id_prioridad= ".$this->getId_prioridad().", ";   
//        $sql.= "id_estado= ".$this->getId_estado().", ";           
//        $sql.= "id_recordatorio= ".$this->getId_recordatorio().", ";
//        $sql.= "id_unidad= ".$this->getId_unidad().", "; 
//        $sql.= "fecdocumento=TO_DATE('".$this->getFecdocumento()."','DD/MM/YYYY'),";                  
//        $sql.= "strdescripcion= '".functions::encrypt($this->getStrdescripcion())."', ";
//        $sql.= "strtitulo= '".$this->getStrtitulo()."', ";
//        $sql.= "id_expediente= ".$this->getId_expediente().", ";        
//        $sql.= "id_tipo_organismo= ".$this->getId_tipo_organismo().", ";   
//        $sql.= "id_organismo= ".$this->getId_organismo().", ";
//        $sql.= "strpersona= '".$this->getStrpersona()."', ";        
//        $sql.= "strtelefono= '".$this->getStrtelefono()."', ";           
        $sql.= "strrespuesta= '".$respuesta."', ";        
        $sql.= "strubicacion= '".$this->getStrubicacion()."' ";             
        $sql.= "WHERE id_documento= ".$this->getId_documento();
//      exit($sql);
        $conn->sql=$sql;        
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function deleteHonorario(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "DELETE FROM  ".clConstantesModelo::correspondencia_table."tblprohonorarios WHERE id_honorarios= ".$this->getId_honorarios();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }    

    public function updateDocumentoItem($id,$valor,$campo){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "UPDATE ".clConstantesModelo::correspondencia_table."tbldocumento SET  ".$campo."=".$valor." WHERE id_documento= ".$id;
//      exit($sql);
        $conn->sql=$sql;        
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }    

    public function selectAllDocumentoBorrados(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_documento, id_usuario, id_tipo, id_evento, id_prioridad, id_estado, id_recordatorio, id_unidad, fecdocumento, strdescripcion, strtitulo, id_expediente, bolborrado, strpersona, id_refiere, visto, id_seguimiento, origen, strnumero, strtelefono, date  ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo) AS id_tipo_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_evento) AS id_evento_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_prioridad) AS id_prioridad_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estado) AS id_estado_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_recordatorio) AS id_recordatorio_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad) AS id_unidad_documento ";        
        $sql.=" from ".clConstantesModelo::correspondencia_table."tbldocumento where  bolborrado=1 and id_usuario=".$_SESSION['id_contacto']." order by id_documento desc";
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }     
    

    
    public function selectFiltrarDocumentoBorrados($fil_id_tipo, $fil_id_evento, $fil_id_unidad, $fil_id_prioridad){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_documento, id_usuario, id_tipo, id_evento, id_prioridad, id_estado, id_recordatorio, id_unidad, fecdocumento, strdescripcion, strtitulo, id_expediente, bolborrado, strpersona, id_refiere, visto, id_seguimiento, origen, strnumero, strtelefono, date  ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo) AS id_tipo_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_evento) AS id_evento_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_prioridad) AS id_prioridad_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estado) AS id_estado_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_recordatorio) AS id_recordatorio_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad) AS id_unidad_documento ";        
        $sql.=" from ".clConstantesModelo::correspondencia_table."tbldocumento  Where id_documento>0  and bolborrado=1 and id_usuario=".$_SESSION['id_contacto'];
        if ($fil_id_tipo>0)
           $sql.=" and id_tipo=".$fil_id_tipo."";
        if ($fil_id_evento>0) 
           $sql.=" and id_evento=".$fil_id_evento."";
        if ($fil_id_unidad>0)
           $sql.=" and id_unidad=".$fil_id_unidad."";
        if ($fil_id_prioridad>0)
           $sql.=" and id_prioridad=".$fil_id_prioridad."";        
//        exit($sql);      
        $sql.=" order by id_documento desc";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }       


    public function selectAllDocumentoCreados(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_documento, id_usuario, id_tipo, id_evento, id_prioridad, id_estado, id_recordatorio, id_unidad, fecdocumento, strdescripcion, strtitulo, id_expediente, bolborrado, strpersona, id_refiere, visto, id_seguimiento, origen, strnumero, strtelefono, date  ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo) AS id_tipo_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_evento) AS id_evento_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_prioridad) AS id_prioridad_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estado) AS id_estado_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_recordatorio) AS id_recordatorio_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad) AS id_unidad_documento ";        
        $sql.=" from ".clConstantesModelo::correspondencia_table."tbldocumento where  bolborrado=0 and origen='E' and id_usuario=".$_SESSION['id_contacto']." order by id_documento desc";
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }     
    

    
    public function selectFiltrarDocumentoCreados($fil_id_tipo, $fil_id_evento, $fil_id_unidad, $fil_id_prioridad){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_documento, id_usuario, id_tipo, id_evento, id_prioridad, id_estado, id_recordatorio, id_unidad, fecdocumento, strdescripcion, strtitulo, id_expediente, bolborrado, strpersona, id_refiere, visto, id_seguimiento, origen, strnumero, strtelefono, date  ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo) AS id_tipo_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_evento) AS id_evento_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_prioridad) AS id_prioridad_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estado) AS id_estado_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_recordatorio) AS id_recordatorio_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad) AS id_unidad_documento ";        
        $sql.=" from ".clConstantesModelo::correspondencia_table."tbldocumento  Where id_documento>0  and bolborrado=0 and origen='E' and id_usuario=".$_SESSION['id_contacto'];
        if ($fil_id_tipo>0)
           $sql.=" and id_tipo=".$fil_id_tipo."";
        if ($fil_id_evento>0) 
           $sql.=" and id_evento=".$fil_id_evento."";
        if ($fil_id_unidad>0)
           $sql.=" and id_unidad=".$fil_id_unidad."";
        if ($fil_id_prioridad>0)
           $sql.=" and id_prioridad=".$fil_id_prioridad."";        
//        exit($sql);      
        $sql.=" order by id_documento desc";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }       
    
    
    public function selectAllDocumentoRecibidos(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_documento, id_usuario, id_tipo, id_evento, id_prioridad, id_estado, id_recordatorio, id_unidad, fecdocumento, strdescripcion, strtitulo, id_expediente, bolborrado, strpersona, id_refiere, visto, id_seguimiento, origen, strnumero, strtelefono, date  ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo) AS id_tipo_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_evento) AS id_evento_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_prioridad) AS id_prioridad_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estado) AS id_estado_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_recordatorio) AS id_recordatorio_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad) AS id_unidad_documento ";        
        $sql.=" from ".clConstantesModelo::correspondencia_table."tbldocumento where  bolborrado=0 and origen='R' and id_usuario=".$_SESSION['id_contacto']." order by id_documento desc";
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }     
    

    
    public function selectFiltrarDocumentoRecibidos($fil_id_tipo, $fil_id_evento, $fil_id_unidad, $fil_id_prioridad){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_documento, id_usuario, id_tipo, id_evento, id_prioridad, id_estado, id_recordatorio, id_unidad, fecdocumento, strdescripcion, strtitulo, id_expediente, bolborrado, strpersona, id_refiere, visto, id_seguimiento, origen, strnumero, strtelefono, date  ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo) AS id_tipo_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_evento) AS id_evento_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_prioridad) AS id_prioridad_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estado) AS id_estado_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_recordatorio) AS id_recordatorio_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad) AS id_unidad_documento ";        
        $sql.=" from ".clConstantesModelo::correspondencia_table."tbldocumento  Where id_documento>0  and bolborrado=0 and origen='R' and id_usuario=".$_SESSION['id_contacto'];
        if ($fil_id_tipo>0)
           $sql.=" and id_tipo=".$fil_id_tipo."";
        if ($fil_id_evento>0) 
           $sql.=" and id_evento=".$fil_id_evento."";
        if ($fil_id_unidad>0)
           $sql.=" and id_unidad=".$fil_id_unidad."";
        if ($fil_id_prioridad>0)
           $sql.=" and id_prioridad=".$fil_id_prioridad."";        
//        exit($sql);      
        $sql.=" order by id_documento desc";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }        
    
   
    public function selectDocumentoReporte($fil_id_tipo, $fil_id_evento, $fil_id_prioridad,$fil_id_estado,$fil_id_recordatorio,$fil_id_unidad,$fil_id_refiere,$fil_id_tipo_organismo,$fil_id_organismo){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_documento, id_usuario, id_tipo, id_evento, id_prioridad, id_estado, id_recordatorio, id_unidad, fecdocumento, strdescripcion, strtitulo, id_expediente, bolborrado, strpersona, id_refiere, visto, id_seguimiento, origen, strdirigido, strrecibido, strtelefono, strnumero, date  ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo) AS id_tipo_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_evento) AS id_evento_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_prioridad) AS id_prioridad_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estado) AS id_estado_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_recordatorio) AS id_recordatorio_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad) AS id_unidad_documento ";        
        $sql.=" from ".clConstantesModelo::correspondencia_table."tbldocumento  Where id_documento>0  and bolborrado=0  and id_usuario=".$_SESSION['id_contacto'];
        if ($fil_id_tipo>0)
           $sql.=" and id_tipo=".$fil_id_tipo."";
        if ($fil_id_evento>0) 
           $sql.=" and id_evento=".$fil_id_evento."";
        if ($fil_id_unidad>0)
           $sql.=" and id_unidad=".$fil_id_unidad."";
        if ($fil_id_prioridad>0)
           $sql.=" and id_prioridad=".$fil_id_prioridad.""; 
        if ($fil_id_estado>0)
           $sql.=" and id_estado=".$fil_id_estado."";  
        if ($fil_id_recordatorio>0)
           $sql.=" and id_recordatorio=".$fil_id_recordatorio."";
        if ($fil_id_refiere>0)
           $sql.=" and id_refiere=".$fil_id_refiere."";
        if ($fil_id_tipo_organismo>0)
           $sql.=" and id_tipo_organismo=".$fil_id_tipo_organismo."";
        if ($fil_id_organismo>0)
           $sql.=" and id_organismo=".$fil_id_organismo."";
//        exit($sql);      
        $sql.=" order by id_documento desc";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }
    
    public function selectDocumentoIndividualReporte($id_documento){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_documento, id_usuario, id_tipo, id_evento, id_prioridad, id_estado, id_recordatorio, id_unidad, fecdocumento, strdescripcion, strtitulo, id_expediente, bolborrado, strpersona, id_refiere, visto, id_seguimiento, origen  ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo) AS id_tipo_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_evento) AS id_evento_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_prioridad) AS id_prioridad_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estado) AS id_estado_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_recordatorio) AS id_recordatorio_documento ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad) AS id_unidad_documento ";        
        $sql.=" from ".clConstantesModelo::correspondencia_table."tbldocumento  Where id_documento=".$id_documento."  and bolborrado=0  and id_usuario=".$_SESSION['id_contacto'];

//        exit($sql);      
        $sql.=" order by id_documento desc";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }      
    
    
    public function reenviarDocumento(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $data_reenviado=  $this->selectDocumento($this->getId_documento());
        $conn->cerrarConexion();
//        exit(print_r($data_reenviado));

        //refiere todo el departamento            
        if ($this->getId_refiere()==clConstantesModelo::buscar_refiere)  
        {
            $conn->abrirConexion();
            $sql_contacto= "SELECT  *  from ".clConstantesModelo::correspondencia_table."tblcontacto  where id_coord_maestro=".$this->getId_unidad();
            $conn->sql= $sql_contacto;
            $datos= $conn->ejecutarSentencia(2);   
            for ($i= 0; $i < count($datos); $i++){
                $sql_dos= "INSERT INTO ".clConstantesModelo::correspondencia_table."tbldocumento (id_usuario, id_contacto, id_tipo, id_evento, id_prioridad, id_estado,id_recordatorio, id_unidad, fecdocumento, strdescripcion, strtitulo,id_expediente, id_tipo_organismo, id_organismo, strpersona, id_refiere, date, id_seguimiento, origen, strnumero, strtelefono, strubicacion, strdirigido, strrecibido) values ";
                $sql_dos.= "(".$datos[$i][id_contacto].",".$this->getId_usuario().",".$data_reenviado[0][id_tipo].",".$data_reenviado[0][id_evento].",".$data_reenviado[0][id_prioridad].",".$data_reenviado[0][id_estado].",".$data_reenviado[0][id_recordatorio].",".$_SESSION['id_coord_maestro'].",TO_DATE('".$data_reenviado[0][fecdocumento]."', 'DD/MM/YYYY'),'".$data_reenviado[0][strdescripcion]."','".$data_reenviado[0][strtitulo]."',".$data_reenviado[0][id_expediente].",".$data_reenviado[0][id_tipo_organismo].",".$data_reenviado[0][id_organismo].",'".$data_reenviado[0][strpersona]."',".$data_reenviado[0][id_refiere].",'".$data_reenviado[0][date]."',".$data_reenviado[0][id_documento].",'R','".$data_reenviado[0][strnumero]."','".$data_reenviado[0][strtelefono]."','".$data_reenviado[0][strubicacion]."','".$data_reenviado[0][strdirigido]."','".$data_reenviado[0][strrecibido]."')";
//                exit($sql_dos);
                $conn->sql=$sql_dos;
                $conn->ejecutarSentencia();   
                $sql_seguimiento= "INSERT INTO ".clConstantesModelo::correspondencia_table."tbldocumento_seguimiento (id_documento, id_remite, id_origen,id_remitente, fecdocumento_movimiento) values ";
                $sql_seguimiento.= "(".$data_reenviado[0][id_documento].",".$this->getId_usuario().",'E',".$datos[$i][id_contacto].",TO_DATE('".$this->getFecdocumento()."', 'DD/MM/YYYY'))";
                $conn->sql=$sql_seguimiento;
                $conn->ejecutarSentencia();             
            }            
            $conn->cerrarConexion();                            
        }
        //refiere solo personas
        if ($this->getId_refiere()==clConstantesModelo::buscar_persona)  
        {
            $conn->abrirConexion();
            $sql_tres='';
            $sql_tres= "INSERT INTO ".clConstantesModelo::correspondencia_table."tbldocumento (id_usuario, id_contacto,id_tipo, id_evento, id_prioridad, id_estado,id_recordatorio, id_unidad, fecdocumento, strdescripcion, strtitulo,id_expediente, id_tipo_organismo, id_organismo, strpersona, id_refiere, date, id_seguimiento, origen, strnumero, strtelefono, strubicacion, strdirigido, strrecibido) values ";
            $sql_tres.= "(".$this->getId_contacto().",".$this->getId_usuario().",".$data_reenviado[0][id_tipo].",".$data_reenviado[0][id_evento].",".$data_reenviado[0][id_prioridad].",".$data_reenviado[0][id_estado].",".$data_reenviado[0][id_recordatorio].",".$_SESSION['id_coord_maestro'].",TO_DATE('".$data_reenviado[0][fecdocumento]."', 'DD/MM/YYYY'),'".$data_reenviado[0][strdescripcion]."','".$data_reenviado[0][strtitulo]."',".$data_reenviado[0][id_expediente].",".$data_reenviado[0][id_tipo_organismo].",".$data_reenviado[0][id_organismo].",'".$data_reenviado[0][strpersona]."',".$data_reenviado[0][id_refiere].",'".$data_reenviado[0][date]."',".$data_reenviado[0][id_documento].",'R','".$data_reenviado[0][strnumero]."','".$data_reenviado[0][strtelefono]."','".$data_reenviado[0][strubicacion]."','".$data_reenviado[0][strdirigido]."','".$data_reenviado[0][strrecibido]."')";
//            exit($sql_tres);            
            $conn->sql=$sql_tres;     
            $conn->ejecutarSentencia();             
                $sql_seguimiento= "INSERT INTO ".clConstantesModelo::correspondencia_table."tbldocumento_seguimiento (id_documento, id_remite, id_origen,id_remitente, fecdocumento_movimiento) values ";
                $sql_seguimiento.= "(".$data_reenviado[0][id_documento].",".$this->getId_usuario().",'E',".$this->getId_contacto().",TO_DATE('".date('d/m/Y')."', 'DD/MM/YYYY'))";
//                exit($sql_seguimiento);
                $conn->sql=$sql_seguimiento;            
            $conn->ejecutarSentencia();   
            $conn->cerrarConexion();            
        }       
        $retorno= $this->getId_documento();
//        $conn->cerrarConexion();
        return $retorno;
    }
    
    
    public function insertDocumento($id_next=''){
        $conn= new Conexion();
        $conn->abrirConexion();
        $tipo=clConstantesModelo::buscar_expediente;
        if ($this->getStrnumero()=='') $this->setStrnumero('S/N-'.$id_next);
        $expediente=0;
        if (($this->getId_tipo()==$tipo) and ($this->getId_expediente()!=''))
            $expediente=$this->getId_expediente();
        //crea su propio item 

        if ($this->getId_documento_accion()=='N')
        {
            $sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tbldocumento (id_usuario, id_tipo, id_evento, id_prioridad, id_estado,id_recordatorio, id_unidad, fecdocumento, strdescripcion, strtitulo,id_expediente, id_tipo_organismo, id_organismo, strpersona, id_refiere, id_contacto, date, origen, strnumero, strtelefono, strrespuesta, strubicacion, strdirigido, strrecibido) values ";
            $sql.= "(".$this->getId_usuario().",".$this->getId_tipo().",".$this->getId_evento().",".$this->getId_prioridad().",".$this->getId_estado().",".$this->getId_recordatorio().",".$this->getId_unidad().",TO_DATE('".$this->getFecdocumento()."', 'DD/MM/YYYY'),'".functions::encrypt($this->getStrdescripcion())."','".functions::encrypt($this->getStrtitulo())."',".$expediente.",".$this->getId_tipo_organismo().",".$this->getId_organismo().",'".$this->getStrpersona()."',".$this->getId_refiere().",".$this->getId_contacto().",'".$this->getDate()."','E','".$this->getStrnumero()."','".$this->getStrtelefono()."','".$this->getStrrespuesta()."','".$this->getStrubicacion()."','".$this->getStrdirigido()."','".$this->getStrrecibido()."')";
//            exit($sql);
            $conn->sql=$sql;
            $conn->ejecutarSentencia();                
            $sql="SELECT last_value as maximo FROM " . clConstantesModelo::correspondencia_table . "tbldocumento_id_documento_seq";
            $conn->sql = $sql;
            $data = $conn->ejecutarSentencia (2);
            if ($data) $id_seguimiento=$data[0]['maximo'];            
        }
        //refiere todo el departamento            
        if ($this->getId_refiere()==clConstantesModelo::buscar_refiere)  
        {
            $sql_contacto= "SELECT  *  from ".clConstantesModelo::correspondencia_table."tblcontacto  where id_coord_maestro=".$this->getId_unidad();
            $conn->sql= $sql_contacto;
            $datos= $conn->ejecutarSentencia(2);   
            for ($i= 0; $i < count($datos); $i++){
                $sql_dos= "INSERT INTO ".clConstantesModelo::correspondencia_table."tbldocumento (id_usuario, id_tipo, id_evento, id_prioridad, id_estado,id_recordatorio, id_unidad, fecdocumento, strdescripcion, strtitulo,id_expediente, id_tipo_organismo, id_organismo, strpersona, id_refiere, date, id_seguimiento, origen, strnumero, strtelefono, strrespuesta, strubicacion, strdirigido, strrecibido) values ";
                $sql_dos.= "(".$datos[$i][id_contacto].",".$this->getId_tipo().",".$this->getId_evento().",".$this->getId_prioridad().",".$this->getId_estado().",".$this->getId_recordatorio().",".$_SESSION['id_coord_maestro'].",TO_DATE('".$this->getFecdocumento()."', 'DD/MM/YYYY'),'".functions::encrypt($this->getStrdescripcion())."','".functions::encrypt($this->getStrtitulo())."',".$expediente.",".$this->getId_tipo_organismo().",".$this->getId_organismo().",'".$this->getStrpersona()."',".$this->getId_refiere().",'".$this->getDate()."',".$id_seguimiento.",'R','".$this->getStrnumero()."','".$this->getStrtelefono()."','".$this->getStrrespuesta()."','".$this->getStrubicacion()."','".$this->getStrdirigido()."','".$this->getStrrecibido()."')";
                $conn->sql=$sql_dos;
                $conn->ejecutarSentencia();   
                $sql_seguimiento= "INSERT INTO ".clConstantesModelo::correspondencia_table."tbldocumento_seguimiento (id_documento, id_remite, id_origen,id_remitente, fecdocumento_movimiento) values ";
                $sql_seguimiento.= "(".$id_seguimiento.",".$this->getId_usuario().",'E',".$datos[$i][id_contacto].",TO_DATE('".$this->getFecdocumento()."', 'DD/MM/YYYY'))";
                $conn->sql=$sql_seguimiento;
                $conn->ejecutarSentencia();                    
            }            
        }
        //refiere solo personas
        if ($this->getId_refiere()==clConstantesModelo::buscar_persona)  
        {
            $sql='';
            $sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tbldocumento (id_usuario, id_tipo, id_evento, id_prioridad, id_estado,id_recordatorio, id_unidad, fecdocumento, strdescripcion, strtitulo,id_expediente, id_tipo_organismo, id_organismo, strpersona, id_refiere, id_contacto, date, id_seguimiento, origen, strnumero, strtelefono, strrespuesta, strubicacion, strdirigido, strrecibido) values ";
            $sql.= "(".$this->getId_contacto().",".$this->getId_tipo().",".$this->getId_evento().",".$this->getId_prioridad().",".$this->getId_estado().",".$this->getId_recordatorio().",".$_SESSION['id_coord_maestro'].",TO_DATE('".$this->getFecdocumento()."', 'DD/MM/YYYY'),'".functions::encrypt($this->getStrdescripcion())."','".functions::encrypt($this->getStrtitulo())."',".$expediente.",".$this->getId_tipo_organismo().",".$this->getId_organismo().",'".$this->getStrpersona()."',".$this->getId_refiere().",".$this->getId_usuario().",'".$this->getDate()."',".$id_seguimiento.",'R','".$this->getStrnumero()."','".$this->getStrtelefono()."','".$this->getStrrespuesta()."','".$this->getStrubicacion()."','".$this->getStrdirigido()."','".$this->getStrrecibido()."')";
//            exit($sql);
            $conn->sql=$sql;             
            $conn->ejecutarSentencia();        
                $sql="SELECT last_value as maximo FROM " . clConstantesModelo::correspondencia_table . "tbldocumento_id_documento_seq";
                $conn->sql = $sql;
                $data = $conn->ejecutarSentencia (2);          
                if ($data)
                {
                    $id_seguimiento_registrado=$data[0]['maximo'];        
                    $sql_update= "UPDATE ".clConstantesModelo::correspondencia_table."tbldocumento SET  id_seguimiento=".$id_seguimiento." WHERE id_documento= ".$id_seguimiento_registrado;
                    $conn->sql=$sql_update;            
                    $conn->ejecutarSentencia();                    
                }
                $sql_seguimiento= "INSERT INTO ".clConstantesModelo::correspondencia_table."tbldocumento_seguimiento (id_documento, id_remite, id_origen,id_remitente, fecdocumento_movimiento) values ";
                $sql_seguimiento.= "(".$id_seguimiento.",".$this->getId_usuario().",'E',".$this->getId_contacto().",TO_DATE('".date('d/m/Y')."', 'DD/MM/YYYY'))";
//                exit($sql_seguimiento);
                $conn->sql=$sql_seguimiento;
                $conn->ejecutarSentencia();                     
        }            
        $retorno= $this->verIdDocumento();
        $conn->cerrarConexion();
        return $retorno;
    }    
        
    
 } 
?>
