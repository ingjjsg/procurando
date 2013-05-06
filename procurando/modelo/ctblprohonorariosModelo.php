<?php
 session_start();
    require_once '../controlador/Conexion.php';
    require_once '../modelo/clConstantesModelo.php';
/**
 * Description of clRedactarModelo
 *
 * @author jsuarez
 */
class cltblprohonorariosModelo {
    private $id_honorarios;
    private $id_tipo;
    private $id_tramite;
    private $id_unidad;
    private $numunidad;

    public function __construct() {

    }

    public function llenar($request) {
        
        if($request['id_honorarios'] != ""){
            $this->id_honorarios= $request['id_honorarios'];
        }else{
            $this->id_honorarios= "";
        }

        if($request['id_tipo'] != ""){
            $this->id_tipo= $request['id_tipo'];
        }else{
            $this->id_tipo= "";
        }
    
        if($request['id_tramite'] != ""){
            $this->id_tramite= $request['id_tramite'];
        }else{
            $this->id_tramite= "";
        }
        if($request['id_unidad'] != ""){
            $this->id_unidad= $request['id_unidad'];
        }else{
            $this->id_unidad= "";
        }        
        
        if($request['numunidad'] != ""){
            $this->numunidad= $request['numunidad'];
        }else{
            $this->numunidad= "";
        }          
    }

    public function getId_honorarios(){
        return $this->id_honorarios;
    }
    public function setId_honorarios($id_honorarios){
        $this->id_honorarios= $id_honorarios;
    }
    public function getId_tipo(){
        return $this->id_tipo;
    }
    public function setId_tipo($id_tipo){
        $this->id_tipo= $id_tipo;
    }
    public function getId_tramite(){
        return $this->id_tramite;
    }
    public function setId_tramite($id_tramite){
        $this->id_tramite= $id_tramite;
    }
    public function getId_unidad(){
        return $this->id_unidad;
    }
    public function setId_unidad($id_unidad){
        $this->id_unidad= $id_unidad;
    }
    public function getNumunidad(){
        return $this->numunidad;
    }
    public function setNumunidad($numunidad){
        $this->numunidad= $numunidad;
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
   
    
    public static function getSelectHonorario($id){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT numunidad ";
        $sql.=" from ".clConstantesModelo::correspondencia_table."tblprohonorarios where id_honorarios=".$id;
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data[0][numunidad];        
    }     
    
    public function selectAllTramitesCargados($tipo){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_honorarios, id_tramite, stritema, ano, id_unidad ";
        $sql.=" FROM ".clConstantesModelo::correspondencia_table."vista_honorarios_tramites_cargados where id_tipo=".$tipo;
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }          
    
    public function selectAllHonorariosCargados(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT * FROM ".clConstantesModelo::correspondencia_table."vista_honorarios_cargados where modulo='OAS' ";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }      

    public function selectHonorarioPrecio($tipo,$tramite){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT * ";
        $sql.=" from ".clConstantesModelo::correspondencia_table."tblprohonorarios a, tblunidadtributaria b where a.id_tipo=".$tipo." and a.id_tramite=".$tramite." and a.id_unidad=b.id_unidad";
//        exit($sql);             
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }        

    public function selectHonorario(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT * ";
        $sql.=" from ".clConstantesModelo::correspondencia_table."tblprohonorarios a, tblunidadtributaria b where id_honorarios=".$this->getId_honorarios()." and a.id_unidad=b.id_unidad";
//        exit($sql);             
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }        
    
    public function selectAllHonorarios(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_honorarios, id_tipo, id_tramite, id_unidad, numunidad ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo) AS id_tipo_honorario ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tramite) AS id_tramite_honorario ";
        $sql.=" ,(SELECT intprecio FROM ".clConstantesModelo::correspondencia_table."tblunidadtributaria WHERE id_unidad= id_unidad) AS id_unidad_honorario ";
        $sql.=" from ".clConstantesModelo::correspondencia_table."tblprohonorarios where modulo='OAS' order by id_honorarios asc";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }     
    

    
    public function selectFiltrarHonorarios($fil_id_tipo, $fil_id_tramite, $fil_id_unidad){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_honorarios, id_tipo, id_tramite, id_unidad, numunidad ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo) AS id_tipo_honorario ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tramite) AS id_tramite_honorario ";
        $sql.=" ,(SELECT intprecio FROM ".clConstantesModelo::correspondencia_table."tblunidadtributaria WHERE id_unidad= id_unidad limit 1) AS id_unidad_honorario ";
        $sql.=" from ".clConstantesModelo::correspondencia_table."tblprohonorarios  Where id_honorarios>0 and modulo='OAS'";
        if ($fil_id_tipo!='0')
           $sql.=" and id_tipo=".$fil_id_tipo."";
        if ($fil_id_tramite!='0') 
           $sql.=" and id_tramite=".$fil_id_tramite."";
        if ($fil_id_unidad!='0')
           $sql.=" and id_unidad=".$fil_id_unidad."";
//        exit($sql);      
        $sql.=" order by id_honorarios asc";
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
        $sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tblprohonorarios (id_tipo, id_tramite, id_unidad, numunidad) values ";
        $sql.= "(".$this->getId_tipo().",".$this->getId_tramite().",".$this->getId_unidad().",".$this->getNumunidad().")";
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
        $sql.= "id_tramite= '".$this->getId_tramite()."', ";        
        $sql.= "id_unidad= '".$this->getId_unidad()."', ";   
        $sql.= "numunidad= ".$this->getNumunidad()." ";           
        $sql.= "WHERE id_honorarios= ".$this->getId_honorarios();
//        echo $sql;
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
    
    
     public function insertHonorarioLitigio(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tblprohonorarios (id_tipo, id_tramite, id_unidad, numunidad,modulo) values ";
        $sql.= "(".$this->getId_tipo().",".$this->getId_tramite().",".$this->getId_unidad().",".$this->getNumunidad().",'LTG')";
        $conn->sql=$sql;
        $conn->ejecutarSentencia();
        $retorno= $this->verIdHonorario();
        $conn->cerrarConexion();
        return $retorno;
    }
    
    public function selectAllHonorariosLitigio(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_honorarios, id_tipo, id_tramite, id_unidad, numunidad ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo) AS id_tipo_honorario ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tramite) AS id_tramite_honorario ";
        $sql.=" ,(SELECT intprecio FROM ".clConstantesModelo::correspondencia_table."tblunidadtributaria WHERE id_unidad= id_unidad) AS id_unidad_honorario ";
        $sql.=" from ".clConstantesModelo::correspondencia_table."tblprohonorarios where modulo='LTG' order by id_honorarios asc";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }     
    

    
    public function selectFiltrarHonorariosLitigio($fil_id_tipo, $fil_id_tramite, $fil_id_unidad){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT id_honorarios, id_tipo, id_tramite, id_unidad, numunidad ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo) AS id_tipo_honorario ";
        $sql.=" ,(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tramite) AS id_tramite_honorario ";
        $sql.=" ,(SELECT intprecio FROM ".clConstantesModelo::correspondencia_table."tblunidadtributaria WHERE id_unidad= id_unidad limit 1) AS id_unidad_honorario ";
        $sql.=" from ".clConstantesModelo::correspondencia_table."tblprohonorarios  Where id_honorarios>0 and modulo='LTG'";
        if ($fil_id_tipo!='0')
           $sql.=" and id_tipo=".$fil_id_tipo."";
        if ($fil_id_tramite!='0') 
           $sql.=" and id_tramite=".$fil_id_tramite."";
        if ($fil_id_unidad!='0')
           $sql.=" and id_unidad=".$fil_id_unidad."";
//        exit($sql);      
        $sql.=" order by id_honorarios asc";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }
    
    public function selectAllHonorariosCargadosLitigio(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT * FROM ".clConstantesModelo::correspondencia_table."vista_honorarios_cargados where modulo='LTG'";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    } 
    
    

}
?>
