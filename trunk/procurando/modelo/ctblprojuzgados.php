<?php
    require_once '../controlador/Conexion.php';
    require_once '../modelo/clConstantesModelo.php';
/**
 * Description of clRedactarModelo
 *
 * @author jhuidobro
 */
class cltblprojuzgadosModelo {
    private $id_juzgados;
    private $strnombre;
    private $strdireccion;
    private $strlocalidad;
    private $idestado;
    private $idmunicipio;
    private $strtelefono;
    private $strfax;
    private $strobservaciones;
    public function __construct() {

    }

    public function llenar($request) {
        
        if($request['id_juzgados'] != ""){
            $this->id_juzgados= $request['id_juzgados'];
        }else{
            $this->id_juzgados= "";
        }
        if($request['strnombre'] != ""){
            $this->strnombre= $request['strnombre'];
        }else{
            $this->strnombre= "";
        }        
        if($request['strdireccion'] != ""){
            $this->strdireccion= $request['strdireccion'];
        }else{
            $this->strdireccion= "";
        }
        if($request['strlocalidad'] != ""){
            $this->strlocalidad= $request['strlocalidad'];
        }else{
            $this->strlocalidad= "";
        }
        if($request['idestado'] != ""){
            $this->idestado= $request['idestado'];
        }else{
            $this->idestado= "";
        }
        if($request['idmunicipio'] != ""){
            $this->idmunicipio= $request['idmunicipio'];
        }else{
            $this->idmunicipio= "";
        }
        if($request['strtelefono'] != ""){
            $this->strtelefono= $request['strtelefono'];
        }else{
            $this->strtelefono= "";
        }
        if($request['strfax'] != ""){
            $this->strfax= $request['strfax'];
        }else{
            $this->strfax= "";
        }
        if($request['strobservaciones'] != ""){
            $this->strobservaciones= $request['strobservaciones'];
        }else{
            $this->strobservaciones= "";
        }        
        
    }

    public function getId_juzgados(){
        return $this->id_juzgados;
    }
    public function setid_juzgados($id_juzgados){
        $this->id_juzgados= $id_juzgados;
    }
    public function getStrnombre(){
        return $this->strnombre;
    }
    public function setStrnombre($strnombre){
        $this->strnombre= $strnombre;
    }    
    public function getStrdireccion(){
        return $this->strdireccion;
    }
    public function setStrdireccion($strdireccion){
        $this->strdireccion= $strdireccion;
    }
    public function getStrlocalidad(){
        return $this->strlocalidad;
    }
    public function setStrlocalidad($strlocalidad){
        $this->strlocalidad= $strlocalidad;
    }
    public function getIdestado(){
        return $this->idestado;
    }
    public function setIdestado($idestado){
        $this->idestado= $idestado;
    }
    public function getIdmunicipio(){
        return $this->idmunicipio;
    }
    public function setIdmunicipio($idmunicipio){
        $this->idmunicipio= $idmunicipio;
    }
    public function getStrtelefono(){
        return $this->strtelefono;
    }
    public function setStrtelefono($strtelefono){
        $this->strtelefono= $strtelefono;
    }
    public function getStrfax(){
        return $this->strfax;
    }
    public function setStrfax($strfax){
        $this->strfax= $strfax;
    }
    public function getStrobservaciones(){
        return $this->strobservaciones;
    }
    public function setStrobservaciones($strobservaciones){
        $this->strobservaciones= $strobservaciones;
    }    
        
    
    
    public function selectJuzgado(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT a.* ";
        $sql.=" from ".clConstantesModelo::correspondencia_table."tblprojuzgados a where a.id_juzgados=".$this->getId_juzgados();
//        exit($sql);             
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }        
    
    public function selectAllJuzgados(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT a.*, ";
        $sql.=" (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= a.idestado) AS idestado, ";        
        $sql.=" (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= a.idmunicipio) AS idmunicipio ";                
        $sql.=" from ".clConstantesModelo::correspondencia_table."tblprojuzgados a";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }    
    
    public function selectFiltrarJuzgados($fil_strnombre){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql.= "SELECT a.* ";
        $sql.=" from ".clConstantesModelo::correspondencia_table."tblprojuzgados a Where a.id_juzgados>0 ";
        if ($fil_strnombre!='') 
          $sql.=" and upper(a.strnombre) like '%".strtoupper($fil_strnombre)."%'";
//        exit($sql);        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();        
        return $data;
    }        
    
    
    public function verIdJuzgado(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT CURRVAL('tblprojuzgados_id_juzgados_seq') as id_juzgados";
        $data= $conn->ejecutarSentencia(2);
        //exit(print_r($data));
        return $data;
    }    
    
    public function insertJuzgado(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tblprojuzgados (strnombre, strdireccion, strlocalidad, idestado,idmunicipio, strtelefono, strfax, strobservaciones) values ";
        $sql.= "('".$this->getStrnombre()."','".$this->getStrdireccion()."','".$this->getStrlocalidad()."',".$this->getIdestado().",".$this->getIdmunicipio().",'".$this->getStrtelefono()."','".$this->getStrfax()."','".$this->getStrobservaciones()."')";
//        exit("SQL: ".$sql);
        $conn->sql=$sql;
        $conn->ejecutarSentencia();
        $retorno= $this->verIdJuzgado();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function updateJuzgados(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "UPDATE ".clConstantesModelo::correspondencia_table."tblprojuzgados SET ";
        $sql.= "strnombre= '".$this->getStrnombre()."', ";        
        $sql.= "strdireccion= '".$this->getStrdireccion()."', ";
        $sql.= "strlocalidad= '".$this->getStrlocalidad()."', ";        
        $sql.= "idestado= ".$this->getIdestado().", ";   
        $sql.= "idmunicipio= ".$this->getIdmunicipio().", ";           
        $sql.= "strtelefono= '".$this->getStrtelefono()."', ";        
        $sql.= "strfax= '".$this->getStrfax()."', ";   
        $sql.= "strobservaciones= '".$this->getIdmunicipio()."' ";             
        $sql.= "WHERE id_juzgados= ".$this->getId_juzgados();
//        exit("SQL: ".$sql);        
        $conn->sql=$sql;        
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function deleteJuzgado(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "DELETE FROM  ".clConstantesModelo::correspondencia_table."tblprojuzgados WHERE id_juzgados= ".$this->getId_juzgados();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

}
?>
