<?php
session_start();
    require_once '../controlador/Conexion.php';
    require_once '../modelo/clConstantesModelo.php';
/**
 * Description of clTblproexpediente_abogados
 * @author jsuarez
 */
 class clTblproexpediente_abogados_ejecutores {

//=========================== VAR ===================




  private   $id_proexpediente_abogados_ejecutores;

  private   $id_abogados;

  private   $id_proexpediente;

  private   $bolborrado;

//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     if($request['id_proexpediente_abogados_ejecutores'] != ""){
        $this->id_proexpediente_abogados_ejecutores= $request['id_proexpediente_abogados_ejecutores'];
     }


     if($request['id_abogados'] != ""){
        $this->id_abogados= $request['id_abogados'];
     }


     if($request['id_proexpediente'] != ""){
        $this->id_proexpediente= $request['id_proexpediente'];
     }


     if($request['bolborrado'] != ""){
        $this->bolborrado= $request['bolborrado'];
     }

}//=========================== GET ===================




    public function getId_proexpediente_abogados_ejecutores(){
        return $this->id_proexpediente_abogados_ejecutores;
    }



    public function getId_abogados(){
        return $this->id_abogados;
    }



    public function getId_proexpediente(){
        return $this->id_proexpediente;
    }



    public function getBolborrado(){
        return $this->bolborrado;
    }



//=========================== SET ===================




    public function setId_proexpediente_abogados_ejecutores($id_proexpediente_abogados_ejecutores){
        return $this->id_proexpediente_abogados_ejecutores=$id_proexpediente_abogados_ejecutores;
    }



    public function setId_abogados($id_abogados){
        return $this->id_abogados=$id_abogados;
    }



    public function setId_proexpediente($id_proexpediente){
        return $this->id_proexpediente=$id_proexpediente;
    }



    public function setBolborrado($bolborrado){
        return $this->bolborrado=$bolborrado;
    }



//=========================== Insert ===================

    public static function getBuscarAbogado($cedula){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT id_abogado FROM ".clConstantesModelo::correspondencia_table."tbl_abogados WHERE trim(strcedula)='".$cedula."'";        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][id_abogado])
        return $data[0][id_abogado];
        else return "";
    }  
    
    public static function getBuscarAbogadoExpediente($id_abogado,$id_expediente){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT id_abogados FROM ".clConstantesModelo::correspondencia_table."tblproexpediente_abogados_ejecutores WHERE id_abogados=".$id_abogado." and  id_proexpediente=".$id_expediente;        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][id_abogados])
        return $data[0][id_abogados];
        else return "";
    }      
    
    
    

     public function SelectListaAbogadosEjecutores($id_expediente){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT b.id_proexpediente_abogados_ejecutores, b.id_proexpediente, a.strcedula,a.strnombre, a.strapellido FROM tbl_abogados a,tblproexpediente_abogados_ejecutores b where a.id_abogado=b.id_abogados and id_proexpediente=".$id_expediente." order by a.strapellido asc";
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }    
    

//
public function insertar($id_abogado,$id_expediente)
{
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="insert into ".clConstantesModelo::correspondencia_table."tblproexpediente_abogados_ejecutores (id_abogados,id_proexpediente) values (".$id_abogado.",".$id_expediente.")";
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
//
//
////=========================== Update ===================
//
//
//
//
//public function update()
//{
//$conn= new Conexion();
//$conn->abrirConexion();
//$sql="UPDATE public.tblproexpediente_abogados SET
//id_abogados=getId_abogados(),
//id_proexpediente=getId_proexpediente(),
//where id_proexpediente_abogados=getId_proexpediente_abogados()";
////exit($sql);
//$conn->sql=$sql;
//$data = $conn->ejecutarSentencia();
//return $data;
//}
//
//
////=========================== Delete ===================
//
//
//
//
    public function delete($id,$id_expediente){
        $conn= new Conexion();
        $conn->abrirConexion();
//        exit("delete from  ".clConstantesModelo::correspondencia_table."tblproexpediente_abogados_ejecutores WHERE id_proexpediente_abogados_ejecutores= ".$id." and id_proexpediente=".$id_expediente);
        $conn->sql= "delete from  ".clConstantesModelo::correspondencia_table."tblproexpediente_abogados_ejecutores WHERE id_proexpediente_abogados_ejecutores= ".$id." and id_proexpediente=".$id_expediente;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }



}
?>
