<?php
 session_start();
 require_once "../controlador/Conexion.php";
 require_once '../modelo/clFunciones.php'; 
// require_once '../herramientas/herramientas.class.php';     
 /**
 * Description of clTblproexpediente
 * @author jmendoza
 */
  class clTblexpediente_historial_usuario {

//=========================== VAR ===================




  private   $id_historial;

  private   $id_motivo;

  private   $id_expediente;

  private   $id_usuario_anterior;

  private   $id_usuario_nuevo;

  private   $fecapertura;

  private   $id_departamento;

//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     if($request['id_historial'] != ""){
        $this->id_historial= $request['id_historial'];
     }


     if($request['id_motivo_reasignacion'] != ""){
        $this->id_motivo= $request['id_motivo_reasignacion'];
     }


     if($request['id_proexpediente'] != ""){
        $this->id_expediente= $request['id_proexpediente'];
     }

     if($request['id_proactuacion'] != ""){
        $this->id_expediente= $request['id_proactuacion'];
     }     

     if($_SESSION['id_contacto'] != ""){
        $this->id_usuario_anterior= $_SESSION['id_contacto'];
     }


     if($request['id_reasignacion_abogado'] != ""){
        $this->id_usuario_nuevo= $request['id_reasignacion_abogado'];
     }


//     if($request['fecapertura'] != ""){
        $this->fecapertura= date('d/m/Y');
//     }


     if($_SESSION['id_coord_maestro'] != ""){
        $this->id_departamento= $_SESSION['id_coord_maestro'];
     }

}//=========================== GET ===================




    public function getId_historial(){
        return $this->id_historial;
    }



    public function getId_motivo(){
        return $this->id_motivo;
    }



    public function getId_expediente(){
        return $this->id_expediente;
    }



    public function getId_usuario_anterior(){
        return $this->id_usuario_anterior;
    }



    public function getId_usuario_nuevo(){
        return $this->id_usuario_nuevo;
    }



    public function getFecapertura(){
        return $this->fecapertura;
    }



    public function getId_departamento(){
        return $this->id_departamento;
    }



//=========================== SET ===================




    public function setId_historial($id_historial){
        return $this->id_historial=$id_historial;
    }



    public function setId_motivo($id_motivo){
        return $this->id_motivo=$id_motivo;
    }



    public function setId_expediente($id_expediente){
        return $this->id_expediente=$id_expediente;
    }



    public function setId_usuario_anterior($id_usuario_anterior){
        return $this->id_usuario_anterior=$id_usuario_anterior;
    }



    public function setId_usuario_nuevo($id_usuario_nuevo){
        return $this->id_usuario_nuevo=$id_usuario_nuevo;
    }



    public function setFecapertura($fecapertura){
        return $this->fecapertura=$fecapertura;
    }



    public function setId_departamento($id_departamento){
        return $this->id_departamento=$id_departamento;
    }



//=========================== Insert ===================

    public static function getBuscarIdAbogadoResponsable($strdocumento){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT id_abogado FROM ".clConstantesModelo::correspondencia_table."tbl_abogados WHERE strcedula::integer=".$strdocumento;        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][id_abogado])
        return $data[0][id_abogado];
        else return "";
    }     
    
    
    public static function getNroCedula($id){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT strdocumento FROM ".clConstantesModelo::correspondencia_table."tblcontacto WHERE id_contacto=".$id;        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][strdocumento])
        return $data[0][strdocumento];
        else return "";
    }     


public function update($cedula,$id_nuevo_abogado)
{
    $conn= new Conexion();
    $conn->abrirConexion();
        $sql="UPDATE public.tblproexpediente SET cedula_abogado_responsable='".$cedula."', 
         id_usuario=".$this->getId_usuario_nuevo().", id_abogado_resp=".$id_nuevo_abogado." WHERE id_usuario=".$this->getId_usuario_anterior()." and id_proexpediente=".$this->getId_expediente();
//        exit($sql);
         $conn->sql=$sql;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
}

    
public function updateLitigio($id_nuevo_abogado)
{
    $conn= new Conexion();
    $conn->abrirConexion();
        $sql="UPDATE public.tblactuaciones SET 
         id_usuario=".$this->getId_usuario_nuevo().", id_abogado_resp=".$id_nuevo_abogado." WHERE id_usuario=".$this->getId_usuario_anterior()." and id_proactuacion=".$this->getId_expediente();
//        exit($sql);        
         $conn->sql=$sql;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
}
    
public function insertar()
{
    $conn= new Conexion();
    $conn->abrirConexion();
    $sql="Insert into public.tblexpediente_historial_usuario (
        id_motivo,
        id_expediente,
        id_usuario_anterior,
        id_usuario_nuevo,
        fecapertura,
        id_departamento
        ) values (
        ".$this->getId_motivo().",
        ".$this->getId_expediente().",
        ".$this->getId_usuario_anterior().",
        ".$this->getId_usuario_nuevo()."
        ,TO_DATE('".$this->getFecapertura()."', 'DD/MM/YYYY'),
        ".$_SESSION['id_coord_maestro'].")";
//    exit($sql);
         $conn->sql=$sql;    
         $retorno= $conn->ejecutarSentencia();
         $conn->cerrarConexion();
        return $retorno;
         
//    return $data2;
}



     public function selectAbogadosDepartamento() {
               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql = "SELECT *                   
                    from
                    " . clConstantesModelo::scsd_table . "tblcontacto "; 
                   $sql.=" where bolborrado=0 and id_coord_maestro=".$_SESSION['id_coord_maestro'];
//                  exit($sql);                                 
               $conn->sql = $sql;
               $data = $conn->ejecutarSentencia (2);
               $conn->cerrarConexion ();
               return $data;
     } 

//=========================== Update ===================

//
//
//
//public function update()
//{
//    $conn= new Conexion();
//    $conn->abrirConexion();
//    $sql="UPDATE public.tblexpediente_historial_usuario SET
//    id_motivo=getId_motivo(),
//    id_expediente=getId_expediente(),
//    id_usuario_anterior=getId_usuario_anterior(),
//    id_usuario_nuevo=getId_usuario_nuevo(),
//    fecapertura=TO_DATE('getFecapertura()', 'DD/MM/YYYY'),
//    id_departamento=getId_departamento()
//    where id_historial=getId_historial()";
//    //exit($sql);
//    $conn->sql=$sql;
//    $data = $conn->ejecutarSentencia();
//    return $data;
//}
//
//
////=========================== Delete ===================
//
//
//
//
//public function Delete()
//{
//    $conn= new Conexion();
//    $conn->abrirConexion();
//    $sql="UPDATE public.tblexpediente_historial_usuario SET
//    where id_historial=getId_historial()";
//    //exit($sql);
//    $conn->sql=$sql;
//    $data = $conn->ejecutarSentencia();
//    return $data;
//}

}
?>
