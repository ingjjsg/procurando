<?php

require_once "../controlador/Conexion.php";
 /**
 * Description of clTbl_abogados
 * @author jmendoza
 */
 class clProAbogados {

//=========================== VAR ===================




  private   $id_abogado;

  private   $strdireccion;

  private   $strcodigopostal;

  private   $strlocalidad;

  private   $id_estado;

  private   $id_municipio;

  private   $strtelefono;

  private   $strmovil;

  private   $strfax;

  private   $stremail;

  private   $strpin;

  private   $strobservaciones;

  private   $intbanco;

  private   $strcuentaban;

  private   $strfoto;

  private   $strcurriculum;

  private   $strnombre;

  private   $strapellido;

  private   $strnif_cif;

  private   $strnumcolegiado;

  private   $strrif;

  private   $id_sexo;

  private   $strcedula;

//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     if($request['id_abogado'] != ""){
        $this->set_id_abogado($request['id_abogado']);
     }


     if($request['strdireccion'] != ""){
        $this->set_strdireccion($request['strdireccion']);
     }


     if($request['strcodigopostal'] != ""){
        $this->set_strcodigopostal($request['strcodigopostal']);
     }


     if($request['strlocalidad'] != ""){
        $this->set_strlocalidad($request['strlocalidad']);
     }


     if($request['id_estado'] != ""){
        $this->set_id_estado($request['id_estado']);
     }


     if($request['id_municipio'] != ""){
        $this->set_id_municipio($request['id_municipio']);
     }


     if($request['strtelefono'] != ""){
        $this->set_strtelefono($request['strtelefono']);
     }


     if($request['strmovil'] != ""){
        $this->set_strmovil($request['strmovil']);
     }


     if($request['strfax'] != ""){
        $this->set_strfax($request['strfax']);
     }


     if($request['stremail'] != ""){
        $this->set_stremail($request['stremail']);
     }


     if($request['strpin'] != ""){
        $this->set_strpin($request['strpin']);
     }


     if($request['strobservaciones'] != ""){
        $this->set_strobservaciones($request['strobservaciones']);
     }


     if($request['intbanco'] != ""){
        $this->set_intbanco($request['intbanco']);
     }
     else  $this->set_intbanco(0);


     if($request['strcuentaban'] != ""){
        $this->set_strcuentaban($request['strcuentaban']);
     }


     if($request['strfoto'] != ""){
        $this->set_strfoto($request['strfoto']);
     }


     if($request['strcurriculum'] != ""){
        $this->set_strcurriculum($request['strcurriculum']);
     }


     if($request['strnombre'] != ""){
        $this->set_strnombre($request['strnombre']);
     }


     if($request['strapellido'] != ""){
        $this->set_strapellido($request['strapellido']);
     }


     if($request['strnif_cif'] != ""){
        $this->set_strnif_cif($request['strnif_cif']);
     }


     if($request['strnumcolegiado'] != ""){
        $this->set_strnumcolegiado($request['strnumcolegiado']);
     }


     if($request['strrif'] != ""){
        $this->set_strrif($request['strrif']);
     }


     if($request['id_sexo'] != ""){
        $this->set_id_sexo($request['id_sexo']);
     }


     if($request['strcedula'] != ""){
        $this->set_strcedula($request['strcedula']);
     }

}//=========================== GET ===================




    public function get_id_abogado(){
        return $this->id_abogado;
    }



    public function get_strdireccion(){
        return $this->strdireccion;
    }



    public function get_strcodigopostal(){
        return $this->strcodigopostal;
    }



    public function get_strlocalidad(){
        return $this->strlocalidad;
    }



    public function get_id_estado(){
        return $this->id_estado;
    }



    public function get_id_municipio(){
        return $this->id_municipio;
    }



    public function get_strtelefono(){
        return $this->strtelefono;
    }



    public function get_strmovil(){
        return $this->strmovil;
    }



    public function get_strfax(){
        return $this->strfax;
    }



    public function get_stremail(){
        return $this->stremail;
    }



    public function get_strpin(){
        return $this->strpin;
    }



    public function get_strobservaciones(){
        return $this->strobservaciones;
    }



    public function get_intbanco(){
        return $this->intbanco;
    }



    public function get_strcuentaban(){
        return $this->strcuentaban;
    }



    public function get_strfoto(){
        return $this->strfoto;
    }



    public function get_strcurriculum(){
        return $this->strcurriculum;
    }



    public function get_strnombre(){
        return $this->strnombre;
    }



    public function get_strapellido(){
        return $this->strapellido;
    }



    public function get_strnif_cif(){
        return $this->strnif_cif;
    }



    public function get_strnumcolegiado(){
        return $this->strnumcolegiado;
    }



    public function get_strrif(){
        return $this->strrif;
    }



    public function get_id_sexo(){
        return $this->id_sexo;
    }



    public function get_strcedula(){
        return $this->strcedula;
    }



//=========================== SET ===================




    public function set_id_abogado($id_abogado){
        return $this->id_abogado=$id_abogado;
    }



    public function set_strdireccion($strdireccion){
        return $this->strdireccion=$strdireccion;
    }



    public function set_strcodigopostal($strcodigopostal){
        return $this->strcodigopostal=$strcodigopostal;
    }



    public function set_strlocalidad($strlocalidad){
        return $this->strlocalidad=$strlocalidad;
    }



    public function set_id_estado($id_estado){
        return $this->id_estado=$id_estado;
    }



    public function set_id_municipio($id_municipio){
        return $this->id_municipio=$id_municipio;
    }



    public function set_strtelefono($strtelefono){
        return $this->strtelefono=$strtelefono;
    }



    public function set_strmovil($strmovil){
        return $this->strmovil=$strmovil;
    }



    public function set_strfax($strfax){
        return $this->strfax=$strfax;
    }



    public function set_stremail($stremail){
        return $this->stremail=$stremail;
    }



    public function set_strpin($strpin){
        return $this->strpin=$strpin;
    }



    public function set_strobservaciones($strobservaciones){
        return $this->strobservaciones=$strobservaciones;
    }



    public function set_intbanco($intbanco){
        return $this->intbanco=$intbanco;
    }



    public function set_strcuentaban($strcuentaban){
        return $this->strcuentaban=$strcuentaban;
    }



    public function set_strfoto($strfoto){
        return $this->strfoto=$strfoto;
    }



    public function set_strcurriculum($strcurriculum){
        return $this->strcurriculum=$strcurriculum;
    }



    public function set_strnombre($strnombre){
        return $this->strnombre=$strnombre;
    }



    public function set_strapellido($strapellido){
        return $this->strapellido=$strapellido;
    }



    public function set_strnif_cif($strnif_cif){
        return $this->strnif_cif=$strnif_cif;
    }



    public function set_strnumcolegiado($strnumcolegiado){
        return $this->strnumcolegiado=$strnumcolegiado;
    }



    public function set_strrif($strrif){
        return $this->strrif=$strrif;
    }



    public function set_id_sexo($id_sexo){
        return $this->id_sexo=$id_sexo;
    }



    public function set_strcedula($strcedula){
        return $this->strcedula=$strcedula;
    }



    public static function getBuscarAbogadoRifRepetido($rif){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT strrif FROM ".clConstantesModelo::correspondencia_table."tbl_abogados WHERE trim(strrif)='".$rif."'";        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][strrif])
        return $data[0][strrif];
        else return "";
    }         
    
    public static function getBuscarAbogadoCedulaRepetido($cedula){
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
    

//================================FUNCION INSERTAR============================================


     public function insertar(){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="Insert into public.tbl_abogados (
         strdireccion,
         strcodigopostal,
         strlocalidad,
         id_estado,
         id_municipio,
         strtelefono,
         strmovil,
         strfax,
         stremail,
         strpin,
         strobservaciones,
         intbanco,
         strcuentaban,
         strfoto,
         strcurriculum,
         strnombre,
         strapellido,
         strnif_cif,
         strnumcolegiado,
         strrif,
         id_sexo,
         strcedula) VALUES ('"
         .$this->get_strdireccion()."','"
         .$this->get_strcodigopostal()."','"
         .$this->get_strlocalidad()."',"
         .$this->get_id_estado().","
         .$this->get_id_municipio().",'"
         .$this->get_strtelefono()."','"
         .$this->get_strmovil()."','"
         .$this->get_strfax()."','"
         .$this->get_stremail()."','"
         .$this->get_strpin()."','"
         .$this->get_strobservaciones()."',"
         .$this->get_intbanco().",'"
         .$this->get_strcuentaban()."','"
         .$this->get_strfoto()."','"
         .$this->get_strcurriculum()."','"
         .$this->get_strnombre()."','"
         .$this->get_strapellido()."','"
         .$this->get_strnif_cif()."','"
         .$this->get_strnumcolegiado()."','"
         .$this->get_strrif()."','"
         .$this->get_id_sexo()."','"
         .$this->get_strcedula()."')";
         
         
         $conn->sql=$sql;
         if($conn->ejecutarSentencia()){
             $retorno=true;
         }else{
             $retorno=false;
         }
         $conn->cerrarConexion();
         return $retorno;
    }
    
    public function nextValAbogado() {
               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql="SELECT last_value as maximo FROM " . clConstantesModelo::correspondencia_table . "tbl_abogados_id_abogado_seq";
               $conn->sql = $sql;
               $data = $conn->ejecutarSentencia (2);
               if ($data)
               {
                    $maximo=$data[0]['maximo'];
               }
               $conn->cerrarConexion ();
               return $maximo;
     }      
//================================FUNCION CONSULTAR===============================================


     public function SelectAll($lngcodigo=""){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT id_abogado,
         strdireccion,
         strcodigopostal,
         strlocalidad,
         id_estado,
         id_municipio,
         strtelefono,
         strmovil,
         strfax,
         stremail,
         strpin,
         strobservaciones,
         intbanco,
         strcuentaban,
         strfoto,
         strcurriculum,
         strnombre,
         strapellido,
         strnif_cif,
         strnumcolegiado,
         strrif,
         id_sexo,
         strcedula FROM public.tbl_abogados WHERE bolborrado=0";
         if($lngcodigo != ""){
             $sql.=" AND id_abogado=$lngcodigo";
         }
         
         //exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }
    
    
    public function SelectAllAbogadosFiltro($strnombre="",$strapellido="",$strcedula=""){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT id_abogado,
         strdireccion,
         strcodigopostal,
         strlocalidad,
         id_estado,
         id_municipio,
         strtelefono,
         strmovil,
         strfax,
         stremail,
         strpin,
         strobservaciones,
         intbanco,
         strcuentaban,
         strfoto,
         strcurriculum,
         upper(strnombre) as strnombre, 
         upper(strapellido) as strapellido,      
         strnif_cif,
         strnumcolegiado,
         strrif,
         id_sexo,
         strcedula FROM public.tbl_abogados WHERE bolborrado=0";
         if($strnombre != ""){
             $sql .= " AND UPPER(tbl_abogados.strnombre) LIKE '%".strtoupper($strnombre)."%'";
         }
         if($strapellido != ""){
             $sql .= " AND UPPER(tbl_abogados.strapellido) LIKE '%".strtoupper($strapellido)."%'";
         }
         if($strcedula != ""){
             $sql .= " AND tbl_abogados.strcedula LIKE '%".strtoupper($strcedula)."%'";
         }
         $sql .= " limit ".clConstantesModelo::maximo_registro_popup;         
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }
//======================================FUNCION ACTUALIZAR===============================================


     public function Update(){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="UPDATE public.tbl_abogados SET
         strdireccion='".$this->get_strdireccion()."',
         strcodigopostal='".$this->get_strcodigopostal()."',
         strlocalidad='".$this->get_strlocalidad()."',
         id_estado=".$this->get_id_estado().",
         id_municipio=".$this->get_id_municipio().",
         strtelefono='".$this->get_strtelefono()."',
         strmovil='".$this->get_strmovil()."',
         strfax='".$this->get_strfax()."',
         stremail='".$this->get_stremail()."',
         strpin='".$this->get_strpin()."',
         strobservaciones='".$this->get_strobservaciones()."',
         intbanco=".$this->get_intbanco().",
         strcuentaban='".$this->get_strcuentaban()."',
         strfoto='".$this->get_strfoto()."',
         strcurriculum='".$this->get_strcurriculum()."',
         strnombre='".$this->get_strnombre()."',
         strapellido='".$this->get_strapellido()."',
         strnif_cif='".$this->get_strnif_cif()."',
         strnumcolegiado='".$this->get_strnumcolegiado()."',
         strrif='".$this->get_strrif()."',
         id_sexo=".$this->get_id_sexo().",
         strcedula='".$this->get_strcedula()."' WHERE id_abogado=".$this->get_id_abogado();
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia();
         return $data;
    }
    
    function Delete($id_abogado){
        $conn= new Conexion();
         $conn->abrirConexion();
         $sql="UPDATE public.tbl_abogados SET
         bolborrado=1
         WHERE id_abogado=".$id_abogado;
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia();
         return $data;
    }
    
    public function buscarAbogResponsable($id=""){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT id_contacto,
         strnombre,
         strapellido,
         strdocumento as strcedula FROM public.tblcontacto WHERE bolborrado=0  AND id_contacto=$id";

         
//         exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }
    
       public function buscarAbogado($id=""){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT id_abogado,
         strnombre,
         strapellido,
         strcedula FROM public.tbl_abogados WHERE bolborrado=0 AND id_abogado='$id'";

         
//         exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }
       public function buscarAbogadoResponsable($id=""){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT id_abogado,
         strnombre,
         strapellido,
         strcedula  FROM public.tbl_abogados WHERE bolborrado=0  AND id_abogado=".$id;         
//         exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }    
 }

?>
