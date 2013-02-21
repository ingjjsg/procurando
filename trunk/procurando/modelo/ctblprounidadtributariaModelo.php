<?php
    require_once '../controlador/Conexion.php';
    require_once '../modelo/clConstantesModelo.php';
/**
 * Description of clRedactarModelo
 *
 * @author jsuarez
 */
class cltblunidadtributariModelo {
    private $id_unidad;
    private $intprecio;
    private $ano;

    public function __construct() {

    }

    public function llenar($request) {
        
        if($request['id_unidad'] != ""){
            $this->id_unidad= $request['id_unidad'];
        }else{
            $this->id_unidad= "";
        }
        if($request['intprecio'] != ""){
            $this->intprecio= $request['intprecio'];
        }else{
            $this->intprecio= "";
        }
        if($request['ano'] != ""){
            $this->ano= $request['ano'];
        }else{
            $this->ano= "";
        }
   }

    public function getId_unidad(){
        return $this->id_unidad;
    }
    public function setId_unidad($id_unidad){
        $this->id_unidad= $id_unidad;
    }    
    public function getIntprecio(){
        return $this->intprecio;
    }
    public function setIntprecio($intprecio){
        $this->intprecio= $intprecio;
    }
    public function getAno(){
        $this->ano= $ano;
    }
    public function setAno($ano){
        $this->ano= $ano;
    }    
    
    
    public static function getselectUnidad($id){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT intprecio";
        $sql.=" from ".clConstantesModelo::correspondencia_table."tblunidadtributaria where id_unidad=".$id;
//        exit($sql);             
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data[0][intprecio];        
    }        
        

    public function selectUnidad(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_unidad, intprecio, ano";
        $sql.=" from ".clConstantesModelo::correspondencia_table."tblunidadtributaria where id_unidad=".$this->getId_unidad();
//        exit($sql);             
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }        
    
    public function selectAllUnidad(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_unidad, intprecio, ano";
        $sql.=" from ".clConstantesModelo::correspondencia_table."tblunidadtributaria";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }    
    
    public function selectFiltrarHonorarios($fil_id_tipo, $fil_strnombre, $fil_intmonto){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_honorarios, strnombre, strdescripcion, intmonto";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo) AS id_tipo_honorario ";
        $sql.=" from ".clConstantesModelo::correspondencia_table."tblprohonorarios  Where id_honorarios>0 ";
        if ($fil_id_tipo>0)
           $sql.=" and id_tipo=".$fil_id_tipo."";
        if ($fil_strnombre!='') 
          $sql.=" and upper(strnombre) like '%".strtoupper($fil_strnombre)."%'";
        if ($fil_intmonto!='')
           $sql.=" and intmonto=".$fil_intmonto;
//        exit($sql);        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }        
    
    
    public function verIdHonorario(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT CURRVAL('tblprohonorarios_id_honorarios_seq') as id_honorarios";
        $data= $conn->ejecutarSentencia(2);
        //exit(print_r($data));
        return $data;
    }    
    
    public function insertHonorario(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tblprohonorarios (id_tipo, strnombre, strdescripcion, intmonto) values ";
        $sql.= "(".$this->getId_tipo().",'".$this->getStrnombre()."','".$this->getStrdescripcion()."',".$this->getIntmonto().")";
//        exit("SQL: ".$sql);
        $conn->sql=$sql;
        $conn->ejecutarSentencia();
        $retorno= $this->verIdHonorario();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function updateHonorarios(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "UPDATE ".clConstantesModelo::correspondencia_table."tblprohonorarios SET ";
        $sql.= "id_tipo= ".$this->getId_tipo().", ";
        $sql.= "strnombre= '".$this->getStrnombre()."', ";        
        $sql.= "strdescripcion= '".$this->getStrdescripcion()."', ";   
        $sql.= "intmonto= ".$this->getIntmonto()." ";           
        $sql.= "WHERE id_honorarios= ".$this->getId_honorarios();
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

}
?>
