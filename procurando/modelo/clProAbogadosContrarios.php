<?php

require_once "../controlador/Conexion.php";
 /**
 * Description of clProAbogadosContrarios
 * @author jmendoza
 */
 class clProAbogadosContrarios {

//=========================== VAR ===================




  private   $id_abogadoscon;

  private   $strdireccion;

  private   $strcodipostal;

  private   $strlocalidad;

  private   $id_estado;

  private   $id_municipio;

  private   $strmovil;

  private   $strtelefono;

  private   $strfax;

  private   $stremail;

  private   $strpin;

  private   $strobservaciones;

  private   $strnombre;

  private   $strapellido;

  private   $strnif_cif;

  private   $strcedula;

  private   $strnumcolegiado;

  private   $strrif;

//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     if($request['id_abogadoscon'] != ""){
        $this->set_id_abogadoscon($request['id_abogadoscon']);
     }


     if($request['strdireccion'] != ""){
        $this->set_strdireccion($request['strdireccion']);
     }


     if($request['strcodipostal'] != ""){
        $this->set_strcodipostal($request['strcodipostal']);
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


     if($request['strmovil'] != ""){
        $this->set_strmovil($request['strmovil']);
     }


     if($request['strtelefono'] != ""){
        $this->set_strtelefono($request['strtelefono']);
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


     if($request['strnombre'] != ""){
        $this->set_strnombre($request['strnombre']);
     }


     if($request['strapellido'] != ""){
        $this->set_strapellido($request['strapellido']);
     }


     if($request['strnif_cif'] != ""){
        $this->set_strnif_cif($request['strnif_cif']);
     }


     if($request['strcedula'] != ""){
        $this->set_strcedula($request['strcedula']);
     }


     if($request['strnumcolegiado'] != ""){
        $this->set_strnumcolegiado($request['strnumcolegiado']);
     }


     if($request['strrif'] != ""){
        $this->set_strrif($request['strrif']);
     }

}//=========================== GET ===================




    public function get_id_abogadoscon(){
        return $this->id_abogadoscon;
    }



    public function get_strdireccion(){
        return $this->strdireccion;
    }



    public function get_strcodipostal(){
        return $this->strcodipostal;
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



    public function get_strmovil(){
        return $this->strmovil;
    }



    public function get_strtelefono(){
        return $this->strtelefono;
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



    public function get_strnombre(){
        return $this->strnombre;
    }



    public function get_strapellido(){
        return $this->strapellido;
    }



    public function get_strnif_cif(){
        return $this->strnif_cif;
    }



    public function get_strcedula(){
        return $this->strcedula;
    }



    public function get_strnumcolegiado(){
        return $this->strnumcolegiado;
    }



    public function get_strrif(){
        return $this->strrif;
    }



//=========================== SET ===================




    public function set_id_abogadoscon($id_abogadoscon){
        return $this->id_abogadoscon=$id_abogadoscon;
    }



    public function set_strdireccion($strdireccion){
        return $this->strdireccion=$strdireccion;
    }



    public function set_strcodipostal($strcodipostal){
        return $this->strcodipostal=$strcodipostal;
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



    public function set_strmovil($strmovil){
        return $this->strmovil=$strmovil;
    }



    public function set_strtelefono($strtelefono){
        return $this->strtelefono=$strtelefono;
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



    public function set_strnombre($strnombre){
        return $this->strnombre=$strnombre;
    }



    public function set_strapellido($strapellido){
        return $this->strapellido=$strapellido;
    }



    public function set_strnif_cif($strnif_cif){
        return $this->strnif_cif=$strnif_cif;
    }



    public function set_strcedula($strcedula){
        return $this->strcedula=$strcedula;
    }



    public function set_strnumcolegiado($strnumcolegiado){
        return $this->strnumcolegiado=$strnumcolegiado;
    }



    public function set_strrif($strrif){
        return $this->strrif=$strrif;
    }



//================================FUNCION INSERTAR============================================


     public function insertar(){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="Insert into public.tbl_abogados_contrarios (
         strdireccion,
         strcodipostal,
         strlocalidad,
         id_estado,
         id_municipio,
         strmovil,
         strtelefono,
         strfax,
         stremail,
         strpin,
         strobservaciones,
         strnombre,
         strapellido,
         strnif_cif,
         strcedula,
         strnumcolegiado,
         strrif) VALUES (
         '"
         .$this->get_strdireccion()."','"
         .$this->get_strcodipostal()."','"
         .$this->get_strlocalidad()."',"
         .$this->get_id_estado().","
         .$this->get_id_municipio().",'"
         .$this->get_strmovil()."','"
         .$this->get_strtelefono()."','"
         .$this->get_strfax()."','"
         .$this->get_stremail()."','"
         .$this->get_strpin()."','"
         .$this->get_strobservaciones()."','"
         .$this->get_strnombre()."','"
         .$this->get_strapellido()."','"
         .$this->get_strnif_cif()."','"
         .$this->get_strcedula()."','"
         .$this->get_strnumcolegiado()."','"
         .$this->get_strrif()."')";
         
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


     public function SelectAll($id_abogadoscon=""){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT id_abogadoscon,
         strdireccion,
         strcodipostal,
         strlocalidad,
         id_estado,
         id_municipio,
         strmovil,
         strtelefono,
         strfax,
         stremail,
         strpin,
         strobservaciones,
         strnombre,
         strapellido,
         strnif_cif,
         strcedula,
         strnumcolegiado,
         strrif FROM public.tbl_abogados_contrarios WHERE bolborrado=0";
         
         if($id_abogadoscon !=""){
             $sql .=" AND id_abogadoscon=".$id_abogadoscon;
         }
         //exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }
//======================================FUNCION ACTUALIZAR===============================================


     public function Update(){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="UPDATE public.tbl_abogados_contrarios SET 
         strdireccion='".$this->get_strdireccion()."',
         strcodipostal='".$this->get_strcodipostal()."',
         strlocalidad='".$this->get_strlocalidad()."',
         id_estado=".$this->get_id_estado().",
         id_municipio=".$this->get_id_municipio().",
         strmovil='".$this->get_strmovil()."',
         strtelefono='".$this->get_strtelefono()."',
         strfax='".$this->get_strfax()."',
         stremail='".$this->get_stremail()."',
         strpin='".$this->get_strpin()."',
         strobservaciones='".$this->get_strobservaciones()."',
         strnombre='".$this->get_strnombre()."',
         strapellido='".$this->get_strapellido()."',
         strnif_cif='".$this->get_strnif_cif()."',
         strcedula='".$this->get_strcedula()."',
         strnumcolegiado='".$this->get_strnumcolegiado()."',
         strrif='".$this->get_strrif()."' WHERE id_abogadoscon=".$this->get_id_abogadoscon();
         
         //exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia();
         return $data;
    }
    
    public function SelectAllAbogadosContrariosFiltro($strnombre="",$strapellido="",$strcedula=""){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT id_abogadoscon,
         strdireccion,
         strcodipostal,
         strlocalidad,
         id_estado,
         id_municipio,
         strmovil,
         strtelefono,
         strfax,
         stremail,
         strpin,
         strobservaciones,
         strnombre,
         strapellido,
         strnif_cif,
         strcedula,
         strnumcolegiado,
         strrif FROM public.tbl_abogados_contrarios WHERE bolborrado=0";
         
        if($strnombre != ""){
             $sql .= " AND tbl_abogados_contrarios.strnombre LIKE '%$strnombre%'";
         }
         if($strapellido != ""){
             $sql .= " AND tbl_abogados_contrarios.strapellido LIKE '%$strapellido%'";
         }
         if($strcedula != ""){
             $sql .= " AND tbl_abogados_contrarios.strcedula LIKE '%$strcedula%'";
         }
         
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }
    
    function Delete($id_abogado){
        $conn= new Conexion();
         $conn->abrirConexion();
         $sql="UPDATE public.tbl_abogados_contrarios SET
         bolborrado=1
         WHERE id_abogadoscon=".$id_abogado;
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia();
         return $data;
    }
 }
?>
