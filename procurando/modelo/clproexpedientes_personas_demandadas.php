<?php
session_start();
    require_once '../controlador/Conexion.php';
    require_once '../modelo/clConstantesModelo.php';
/**
 * Description of clTblproexpediente_abogados
 * @author jsuarez
 */
 class clTblproexpediente_personas_demandadas {

//=========================== VAR ===================




  private   $id_proexpediente_personas_demandadas;

  private   $id_cliente;

  private   $id_proexpediente;

  private   $bolborrado;

//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     if($request['id_proexpediente_personas_demandadas'] != ""){
        $this->id_proexpediente_personas_demandadas= $request['id_proexpediente_personas_demandadas'];
     }


     if($request['id_contrario'] != ""){
        $this->id_contrario= $request['id_contrario'];
     }


     if($request['id_proexpediente'] != ""){
        $this->id_proexpediente= $request['id_proexpediente'];
     }


     if($request['bolborrado'] != ""){
        $this->bolborrado= $request['bolborrado'];
     }

}//=========================== GET ===================




    public function getId_proexpediente_personas_demandadas(){
        return $this->id_proexpediente_personas_demandadas;
    }



    public function getId_contrario(){
        return $this->id_contrario;
    }



    public function getId_proexpediente(){
        return $this->id_proexpediente;
    }



    public function getBolborrado(){
        return $this->bolborrado;
    }



//=========================== SET ===================




    public function setId_proexpediente_personas_demandadas($id_proexpediente_personas_demandadas){
        return $this->id_proexpediente_personas_demandadas=$id_proexpediente_personas_demandadas;
    }



    public function setId_contrario($id_contrario){
        return $this->id_contrario=$id_contrario;
    }



    public function setId_proexpediente($id_proexpediente){
        return $this->id_proexpediente=$id_proexpediente;
    }



    public function setBolborrado($bolborrado){
        return $this->bolborrado=$bolborrado;
    }



//=========================== Insert ===================

    public static function getBuscarNroPersonasDemandadas($id_expediente){

        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT count(id_contrarios) as total FROM ".clConstantesModelo::correspondencia_table."tblproexpediente_personas_demandadas WHERE id_proexpediente=".$id_expediente;        
//        exit($sql);        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][total])
        return $data[0][total];
        else return 0;
    }      
    
    public static function getBuscarPersonasDemandadas($cedula){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT id_contrarios FROM ".clConstantesModelo::correspondencia_table."tbl_contrarios WHERE trim(strcedula)='".$cedula."'";        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][id_contrarios])
        return $data[0][id_contrarios];
        else return "";
    }  
    
    public static function getBuscarPersonaDemandadasExpediente($id_contrario,$id_expediente){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT id_contrarios FROM ".clConstantesModelo::correspondencia_table."tblproexpediente_personas_demandadas WHERE id_contrarios=".$id_contrario." and id_proexpediente=".$id_expediente;        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][id_contrarios])
        return $data[0][id_contrarios];
        else return "";
    }      
    
    
    

     public function SelectListaPersonasDemandadas($id_expediente){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT a.id_contrarios, b.id_proexpediente_personas_demandadas, b.id_proexpediente, a.strcedula,a.strnombre, a.strapellido FROM tbl_contrarios a,tblproexpediente_personas_demandadas b where a.id_contrarios=b.id_contrarios and id_proexpediente=".$id_expediente." order by a.strapellido asc";
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }    
    

//
public function insertar($id_contrario,$id_expediente)
{
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="insert into ".clConstantesModelo::correspondencia_table."tblproexpediente_personas_demandadas (id_contrarios,id_proexpediente) values (".$id_contrario.",".$id_expediente.")";
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
//        exit("delete from  ".clConstantesModelo::correspondencia_table."tblproexpediente_personas_demandadas WHERE id_proexpediente_personas_demandadas= ".$id." and id_proexpediente=".$id_expediente);
        $conn->sql= "delete from  ".clConstantesModelo::correspondencia_table."tblproexpediente_personas_demandadas WHERE id_proexpediente_personas_demandadas= ".$id." and id_proexpediente=".$id_expediente;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }



}
?>
