<?php
    require_once '../controlador/Conexion.php';
    require_once 'clConstantesModelo.php';
/**
 * Description of maestroModelo
 *
 * @author jhuidobro
 */
class clMaestroModelo {
    private $id_maestro;
    private $id_origen;
    private $stritema;
    private $stritemb;
    private $stritemc;
    private $lngnumero;
    private $sngcant;
    private $bolborrado;

    public function __construct() {

    }

    public function llenar($request) {
        if($request['id_maestro'] != ""){
            $this->id_maestro= $request['id_maestro'];
        }
        if($request['id_origen'] != ""){
            $this->id_origen= $request['id_origen'];
        }
        if($request['stritema'] != ""){
            $this->stritema= $request['stritema'];
        }
        if($request['stritemb'] != ""){
            $this->stritemb= $request['stritemb'];
        }
        if($request['stritemc'] != ""){
            $this->stritemc= $request['stritemc'];
        }if($request['lngnumero'] != ""){
            $this->lngnumero= $request['lngnumero'];
        }else{
            $this->lngnumero= 'null';
        }
        if($request['sngcant'] != ""){
            $this->sngcant= $request['sngcant'];
        }else{
            $this->sngcant= 'null';
        }
        if($request['bolborrado'] != ""){
            $this->bolborrado= $request['bolborrado'];
        }
    }

    public function getId_maestro(){
        return $this->id_maestro;
    }
    public function setId_maestro($id_maestro){
        $this->id_maestro= $id_maestro;
    }
    public function getId_origen(){
        return $this->id_origen;
    }
    public function setId_origen($id_origen){
        $this->id_origen= $id_origen;
    }
    public function getStritema(){
        return $this->stritema;
    }
    public function setStritema($stritema){
        $this->stritema= $stritema;
    }
    public function getStritemb(){
        return $this->stritemb;
    }
    public function setStritemb($stritemb){
        $this->stritemb= $stritemb;
    }
    public function getStritemc(){
        return $this->stritemc;
    }
    public function setStritemc($stritemc){
        $this->stritemc= $stritemc;
    }
    public function getLngnumero(){
        return $this->lngnumero;
    }
    public function setLngnumero($lngnumero){
        $this->lngnumero= $lngnumero;
    }
    public function getSngcant(){
        return $this->sngcant;
    }
    public function setSngcant($sngcant){
        $this->sngcant= $sngcant;
    }
    public function getBolborrado(){
        return $this->bolborrado;
    }
    public function setBolborrado($bolborrado){
        $this->bolborrado= $bolborrado;
    }
    
    
    public function insertMaestroCombos($stritema,$id_origen,$id_sistema){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tblmaestros (id_origen, stritema, id_sistema) VALUES ";
        $sql.= "(".$id_origen.", '".$stritema."', ".$id_sistema.")";
        $conn->sql=$sql;        
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }    

    public function updateMaestroCombo($id_maestro,$stritema){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "UPDATE ".clConstantesModelo::correspondencia_table."tblmaestros SET stritema= '".$stritema."'";
        $sql.= " WHERE id_maestro= ".$id_maestro;
        $conn->sql=$sql;        
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }    
    
    public function selectAllSistemas($campo){
        $conn= new Conexion();
        $conn->abrirConexion();
//        echo "SELECT * FROM ".clConstantesModelo::correspondencia_table."tblmaestros_sistemas WHERE  bolborrado= 0 ORDER BY ".$campo." ".$_SESSION["AD"];
        $conn->sql= "";
        $conn->sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."tblmaestros_sistemas WHERE  bolborrado= 0 ORDER BY ".$campo." ".$_SESSION["AD"];
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }    
    
    public function insertMaestro(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tblmaestros (id_origen, stritema, stritemb, stritemc, lngnumero, sngcant) VALUES ";
        $conn->sql.= "(".$this->getId_origen().", '".$this->getStritema()."', '".$this->getStritemb()."', '".$this->getStritemc()."', ".$this->getLngnumero().", ";
        $conn->sql.= $this->getSngcant().")";
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function updateMaestro(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tblmaestros SET stritema= '".$this->getStritema()."', stritemb= '".$this->getStritemb()."', ";
        $conn->sql.= "stritemc= '".$this->getStritemc()."', lngnumero= ".$this->getLngnumero().", sngcant= ".$this->getSngcant()." ";
        $conn->sql.= "WHERE id_maestro= ".$this->getId_maestro();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function deleteMaestro($id_maestro){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "UPDATE ".clConstantesModelo::correspondencia_table."tblmaestros SET bolborrado= 1 WHERE id_maestro=".$id_maestro;
        $conn->sql=$sql;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function selectAllMaestroPadres($campo, $id_sistemas=""){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
//        exit($campo);
        if ($id_sistemas!='') $sql_insert="AND id_sistema= ".$id_sistemas;
        $sql="SELECT * FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE bolborrado= 0 ".$sql_insert." ORDER BY ".$campo." ".$_SESSION["AD"];
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }
    public function selectAllMaestroHijos($padre, $campo, $id_sistemas=""){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        if ($id_sistemas!='') $sql_insert="AND id_sistema= ".$id_sistemas;
        $sql="SELECT * FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_origen= ".$padre." ".$sql_insert." AND bolborrado= 0 ORDER BY ".$campo." ".$_SESSION["AD"];
//        exit($sql);        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }
    public function selectMaestroPadreById($id_maestro){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= ".$id_maestro." AND bolborrado= 0";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }
    public function selectMaestroPadreByIdNumero($id_origen, $lngnumero){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        $conn->sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_origen= ".$id_origen." AND lngnumero= ".$lngnumero." AND bolborrado= 0 ORDER BY stritema";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }
    
    public function selectMaestroPadreByIdProcurandoLike($id_maestro,$id_sistema){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE stritema like '%Combo%' and  id_sistema=".$id_sistema." and id_origen= ".$id_maestro." AND bolborrado= 0";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }    
    
    public function selectMaestroOrigenByIdProcurando($id_maestro,$id_sistema){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_sistema=".$id_sistema." and id_origen= ".$id_maestro." AND bolborrado= 0";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }    
}
?>
