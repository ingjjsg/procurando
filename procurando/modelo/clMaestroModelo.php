<?php
    require_once '../controlador/Conexion.php';
    require_once 'clConstantesModelo.php';
/**
 * Description of maestroModelo
 *
 * @author jsuarez
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
    private $id_origen_nuevo;
    private $id_sistema;    

    public function __construct() {

    }

    public function llenar($request) {
        if($request['id_maestro'] != ""){
            $this->id_maestro= $request['id_maestro'];
        }
        if($request['id_origen'] != ""){
            $this->id_origen= $request['id_origen'];
        }
        if($request['id_origen_nuevo'] != ""){
            $this->id_origen_nuevo= $request['id_origen_nuevo'];
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
        if($request['id_sistema'] > 0){
            $this->id_sistema= $request['id_sistema'];
        }
       else {
            $this->id_sistema= $request['id_sistema_buscado'];           
       }
    }

    public function getId_maestro(){
        return $this->id_maestro;
    }
    public function setId_maestro($id_maestro){
        $this->id_maestro= $id_maestro;
    }    
    public function getId_origen_nuevo(){
        return $this->id_origen_nuevo;
    }   
    public function setId_origen_nuevo($id_origen_nuevo){
        $this->id_origen_nuevo= $id_origen_nuevo;
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
    public function getId_sistema(){
        return $this->id_sistema;
    }    
    public function setId_sistema($id_sistema){
        $this->id_sistema= $id_sistema;
    }
    
    public static function getTieneHijos($id){
        $conn= new Conexion();
        $conn->abrirConexion();
        $origen='';
        $data='';
        $sql="SELECT id_origen FROM ".clConstantesModelo::correspondencia_table."tblmaestros_vista WHERE id_origen=".$id." limit 1";        
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        if (is_array($data)) $origen=$data[0][id_origen];
        $conn->cerrarConexion();
        return $origen;
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
        if ($this->getId_sistema()!='')
        {
            $conn= new Conexion();
            $conn->abrirConexion();            
            $sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tblmaestros (id_origen, stritema, stritemb, stritemc, lngnumero, sngcant, id_sistema) VALUES ";
            $sql.= "(".$this->getId_origen().", '".$this->getStritema()."', '".$this->getStritemb()."', '".$this->getStritemc()."', ".$this->getLngnumero().", ";
            $sql.= $this->getSngcant().", ".$this->getId_sistema().")";
    //        exit($sql);        
            $conn->sql=$sql;
            $retorno= $conn->ejecutarSentencia();
            $conn->cerrarConexion();
        }
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
        if ($id_sistemas!='') $sql_insert="AND a.id_sistema= ".$id_sistemas;
        $sql="SELECT a.*, b.stritema as sistema FROM ".clConstantesModelo::correspondencia_table."tblmaestros_vista a, ".clConstantesModelo::correspondencia_table."tblmaestros_sistemas b WHERE a.id_sistema=b.id_sistema and a.bolborrado= 0 ".$sql_insert." ORDER BY a.".$campo." ".$_SESSION["AD"];
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }
    public function selectAllMaestroHijosCombo($padre, $campo, $id_sistemas=""){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        if ($id_sistemas!='') $sql_insert="AND a.id_sistema= ".$id_sistemas;
        $sql="SELECT a.*, b.stritema as sistema FROM ".clConstantesModelo::correspondencia_table."tblmaestros_vista a, ".clConstantesModelo::correspondencia_table."tblmaestros_sistemas b WHERE a.id_sistema=b.id_sistema and a.id_maestro= ".$padre." ".$sql_insert." AND a.bolborrado= 0 ORDER BY a.".$campo." ".$_SESSION["AD"];
//        exit($sql);        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }    
    
    
    public function selectAllMaestroHijos($padre, $campo, $id_sistemas="", $lngnumero=0){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        $sql_insert='';
        $sql_insert_hijo='';
        if ($id_sistemas!='') $sql_insert=" AND a.id_sistema= ".$id_sistemas;
        if ($lngnumero>0) $sql_insert_hijo=" AND a.lngnumero= ".$lngnumero;        
        $sql="SELECT a.*, b.stritema as sistema FROM ".clConstantesModelo::correspondencia_table."tblmaestros_vista a, ".clConstantesModelo::correspondencia_table."tblmaestros_sistemas b WHERE a.id_sistema=b.id_sistema and a.id_origen= ".$padre." ".$sql_insert." ".$sql_insert_hijo." AND a.bolborrado= 0 ORDER BY a.".$campo." ".$_SESSION["AD"];
//        exit($sql);        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }
    public function selectMaestroPadreById($id_maestro){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."tblmaestros_vista WHERE id_maestro= ".$id_maestro." AND bolborrado= 0";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }
    public function selectMaestroPadreByIdNumero($id_origen, $lngnumero){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        $conn->sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."tblmaestros_vista WHERE id_origen= ".$id_origen." AND lngnumero= ".$lngnumero." AND bolborrado= 0 ORDER BY stritema";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }
    
    public function selectMaestroPadreByIdProcurandoLike($id_maestro,$id_sistema){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."tblmaestros_vista WHERE stritema like '%Combo%' and  id_sistema=".$id_sistema." and id_origen= ".$id_maestro." AND bolborrado= 0";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }    
    
    public function selectMaestroOrigenByIdProcurando($id_maestro,$id_sistema){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."tblmaestros_vista WHERE id_sistema=".$id_sistema." and id_origen= ".$id_maestro." AND bolborrado= 0";
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }    
    
    public function selectAllMaestroPadresLike($input, $campo, $id_sistemas=0){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
//        exit($campo);
        if ($id_sistemas!=0) $sql_insert="AND a.id_sistema= ".$id_sistemas;
        $sql="SELECT a.*, b.stritema as sistema FROM ".clConstantesModelo::correspondencia_table."tblmaestros_vista a,  ".clConstantesModelo::correspondencia_table."tblmaestros_sistemas b WHERE a.id_sistema=b.id_sistema and a.bolborrado= 0 and upper(a.stritema) like '%".strtoupper($input)."%' ".$sql_insert." ORDER BY a.".$campo." ".$_SESSION["AD"];
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }    
    
    public static function getJefeCoordinacion(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT strapellido, strnombre FROM ".clConstantesModelo::correspondencia_table."tblcontacto a WHERE a.id_cargo_maestro=".clConstantesModelo::jefeunidad." and a.id_coord_maestro= ".$_SESSION['id_coord_maestro'];
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][strapellido])
        return $data[0][strapellido].', '.$data[0][strnombre];
        else return "";
    }  
    
    public static function getSecretariaCoordinacion(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT strapellido, strnombre FROM ".clConstantesModelo::correspondencia_table."tblcontacto a WHERE a.id_cargo_maestro=".clConstantesModelo::secretaria." and a.id_coord_maestro= ".$_SESSION['id_coord_maestro'];
//        exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        if ($data[0][strapellido])
        return $data[0][strapellido].', '.$data[0][strnombre];
        else return "";
    }      
    
    

}
?>
