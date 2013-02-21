<?php
session_start();
    require_once '../controlador/Conexion.php';
    require_once '../modelo/clConstantesModelo.php';
/**
 * Description of clTblproexpediente_abogados
 * @author jsuarez
 */
 class clTblproexpediente_abogados_demandantes {

//=========================== VAR ===================




  private   $id_proexpediente_abogados_demandantes;

  private   $id_abogados;

  private   $id_proexpediente;

  private   $bolborrado;

//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     if($request['id_proexpediente_abogados_demandantes'] != ""){
        $this->id_proexpediente_abogados_demandantes= $request['id_proexpediente_abogados_demandantes'];
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




    public function getId_proexpediente_abogados_demandantes(){
        return $this->id_proexpediente_abogados_demandantes;
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




    public function setId_proexpediente_abogados_demandantes($id_proexpediente_abogados_demandantes){
        return $this->id_proexpediente_abogados_demandantes=$id_proexpediente_abogados_demandantes;
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
        $sql="SELECT id_abogadoscon FROM ".clConstantesModelo::correspondencia_table."tbl_abogados_contrarios WHERE trim(strcedula)='".$cedula."'";        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][id_abogadoscon])
        return $data[0][id_abogadoscon];
        else return "";
    }  
    
    public static function getBuscarAbogadoExpediente($id_abogado,$id_expediente){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT id_abogados FROM ".clConstantesModelo::correspondencia_table."tblproexpediente_abogados_demandantes WHERE id_abogados=".$id_abogado." and id_proexpediente=".$id_expediente;        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][id_abogados])
        return $data[0][id_abogados];
        else return "";
    }      
    
    
    

     public function SelectListaAbogadosdemandantes($id_expediente){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT b.id_proexpediente_abogados_demandantes, b.id_proexpediente, a.strcedula,a.strnombre, a.strapellido FROM tbl_abogados_contrarios a,tblproexpediente_abogados_demandantes b where a.id_abogadoscon=b.id_abogados and id_proexpediente=".$id_expediente." order by a.strapellido asc";
//         exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }    
    

//
public function insertar($id_abogado,$id_expediente)
{
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="insert into ".clConstantesModelo::correspondencia_table."tblproexpediente_abogados_demandantes (id_abogados,id_proexpediente) values (".$id_abogado.",".$id_expediente.")";
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
        $conn->sql= "delete from  ".clConstantesModelo::correspondencia_table."tblproexpediente_abogados_demandantes WHERE id_proexpediente_abogados_demandantes= ".$id." and id_proexpediente=".$id_expediente;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }


}
?>
