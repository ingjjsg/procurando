<?php

require_once '../controlador/Conexion.php';
//require_once 'clConstantesModelo.php';
 /**
 * Description of clTblproexpediente_hijos
 * @author jsuarez
 */
 class clTblproexpediente_hijos {

//=========================== VAR ===================




  private   $id_hijos;

  private   $id_proexpediente;

  private   $id_sexo;

  private   $nombrehijo;

  private   $cedulahijo;

  private   $fecnachijo;

  private   $bolborrado;

//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     if($request['id_hijos'] != ""){
        $this->id_hijos= $request['id_hijos'];
     }


     if($request['id_proexpediente'] != ""){
        $this->id_proexpediente= $request['id_proexpediente'];
     }


     if($request['id_sexo'] != ""){
        $this->id_sexo= $request['id_sexo'];
     }


     if($request['nombrehijo'] != ""){
        $this->nombrehijo= $request['nombrehijo'];
     }


     if($request['cedulahijo'] != ""){
        $this->cedulahijo= $request['cedulahijo'];
     }


     if($request['fecnachijo'] != ""){
        $this->fecnachijo= $request['fecnachijo'];
     }


     if($request['bolborrado'] != ""){
        $this->bolborrado= $request['bolborrado'];
     }

}//=========================== GET ===================




    public function getId_hijos(){
        return $this->id_hijos;
    }



    public function getId_proexpediente(){
        return $this->id_proexpediente;
    }



    public function getId_sexo(){
        return $this->id_sexo;
    }



    public function getNombrehijo(){
        return $this->nombrehijo;
    }



    public function getCedulahijo(){
        return $this->cedulahijo;
    }



    public function getFecnachijo(){
        return $this->fecnachijo;
    }



    public function getBolborrado(){
        return $this->bolborrado;
    }



//=========================== SET ===================




    public function setId_hijos($id_hijos){
        return $this->id_hijos=$id_hijos;
    }



    public function setId_proexpediente($id_proexpediente){
        return $this->id_proexpediente=$id_proexpediente;
    }



    public function setId_sexo($id_sexo){
        return $this->id_sexo=$id_sexo;
    }



    public function setNombrehijo($nombrehijo){
        return $this->nombrehijo=$nombrehijo;
    }



    public function setCedulahijo($cedulahijo){
        return $this->cedulahijo=$cedulahijo;
    }



    public function setFecnachijo($fecnachijo){
        return $this->fecnachijo=$fecnachijo;
    }



    public function setBolborrado($bolborrado){
        return $this->bolborrado=$bolborrado;
    }



//=========================== Insert ===================

    public static function getCedula($cedula){
        $conn= new Conexion();
        
        $conn->abrirConexion();
        $sql="SELECT cedulahijo FROM public.tblproexpediente_hijos WHERE cedulahijo='".$cedula."'";        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][cedulahijo])
        return $data[0][cedulahijo];
        else return "";
    } 


public function insertar()
{
    $conn= new Conexion();
    $conn->abrirConexion();
    $sql="Insert into public.tblproexpediente_hijos 
        (
            id_proexpediente,
            id_sexo,
            nombrehijo,
            cedulahijo,
            fecnachijo
        ) values 
        (".$this->getId_proexpediente().",".$this->getId_sexo().",'".$this->getNombrehijo()."','".$this->getCedulahijo()."',TO_DATE('"
         .$this->getFecnachijo()."', 'DD/MM/YYYY'))";
         $conn->sql=$sql;    
        if($conn->ejecutarSentencia()){
             $retorno=true;
         }else{
             $retorno=false;
         }
    $conn->cerrarConexion();
    return $retorno;
}



     public function selectAllHijos($id_expediente){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="SELECT id_hijos, id_proexpediente, (SELECT STRITEMA FROM ".clConstantesModelo::correspondencia_table."TBLMAESTROS A WHERE A.ID_MAESTRO=id_sexo LIMIT 1) AS id_sexo, nombrehijo, cedulahijo, 
         to_char(fecnachijo,'DD/MM/YYYY') as fecnachijo, bolborrado
         FROM public.tblproexpediente_hijos where id_proexpediente=".$id_expediente;
//         exit($sql);        
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;
    }    

     public function BorrarHijo($id){
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql="DELETE FROM public.tblproexpediente_hijos  where id_hijos=".$id;
         $conn->sql=$sql;
         $retorno= $conn->ejecutarSentencia();
         $conn->cerrarConexion();
        return $retorno;
    }        
    
//=========================== Update ===================



//
//public function update()
//{
//$conn= new Conexion();
//$conn->abrirConexion();
//$sql="UPDATE public.tblproexpediente_hijos SET
//id_proexpediente=getId_proexpediente(),
//id_sexo=getId_sexo(),
//nombrehijo=getNombrehijo(),
//cedulahijo=getCedulahijo(),
//fecnachijo=TO_DATE('getFecnachijo()', 'DD/MM/YYYY'),
//where id_hijos=getId_hijos()";
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
//public function Delete()
//{
//$conn= new Conexion();
//$conn->abrirConexion();
//$sql="UPDATE public.tblproexpediente_hijos SET
//bolborrado=1
//where id_hijos=getId_hijos()";
////exit($sql);
//$conn->sql=$sql;
//$data = $conn->ejecutarSentencia();
//return $data;
//}

 }
?>
