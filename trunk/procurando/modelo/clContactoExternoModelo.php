<?php

    require_once '../controlador/Conexion.php';
    require_once 'clConstantesModelo.php';

/**
 * Description of clContactoExternoModelo
 *
 * @author jsuarez
 */
class clContactoExternoModelo {
    private $id_contacto_externo;
    private $strtrato;
    private $strcontactoext;
    private $strinstitucion;
    private $strcargo;
    private $strtelefono;
    private $stremail;
    private $strdireccion;
    private $bolborrado;

    public function __construct() {

    }

    public function llenar($request) {
        if($request['id_contacto_externo'] != ""){
            $this->id_contacto_externo= $request['id_contacto_externo'];
        }
        if($request['strtrato'] != ""){
            $this->strtrato= $request['strtrato'];
        }
        if($request['strcontactoext'] != ""){
            $this->strcontactoext= $request['strcontactoext'];
        }
        if($request['strinstitucion'] != ""){
            $this->strinstitucion= $request['strinstitucion'];
        }
        if($request['strcargo'] != ""){
            $this->strcargo= $request['strcargo'];
        }
        if($request['strtelefono'] != ""){
            $this->strtelefono= $request['strtelefono'];
        }
        if($request['stremail'] != ""){
            $this->stremail= $request['stremail'];
        }
        if($request['strdireccion'] != ""){
            $this->strdireccion= $request['strdireccion'];
        }
        if($request['bolborrado'] != ""){
            $this->bolborrado= $request['bolborrado'];
        }
    }

    public function getId_contacto_externo(){
        return $this->id_contacto_externo;
    }
    public function setId_contacto_externo($id_contacto_externo){
        $this->id_contacto_externo= $id_contacto_externo;
    }
    public function getStrtrato(){
        return $this->strtrato;
    }
    public function setStrtrato($strtrato){
        $this->strtrato= $strtrato;
    }
    public function getStrcontactoext(){
        return $this->strcontactoext;
    }
    public function setStrcontactoext($strcontactoext){
        $this->strcontactoext= $strcontactoext;
    }
    public function getStrinstitucion(){
        return $this->strinstitucion;
    }
    public function setStrinstitucion($strinstitucion){
        $this->strinstitucion= $strinstitucion;
    }
    public function getStrcargo(){
        return $this->strcargo;
    }
    public function setStrcargo($strcargo){
        $this->strcargo= $strcargo;
    }
    public function getStrtelefono(){
        return $this->strtelefono;
    }
    public function setStrtelefono($strtelefono){
        $this->strtelefono= $strtelefono;
    }
    public function getStremail(){
        return $this->stremail;
    }
    public function setStremail($stremail){
        $this->stremail= $stremail;
    }
    public function getStrdireccion(){
        return $this->strdireccion;
    }
    public function setStrdireccion($strdireccion){
        $this->strdireccion= $strdireccion;
    }
    public function getBolborrado(){
        return $this->bolborrado;
    }
    public function setBolborrado($bolborrado){
        $this->bolborrado= $bolborrado;
    }

    public function selectAllContactoExterno(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT * FROM ".clConstantesModelo::seguridad_table."tblcontactoexterno WHERE bolborrado= 0 ORDER BY strcontactoext";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }

    public function selectAllContactoExternoById($id_contacto_externo){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT * FROM ".clConstantesModelo::seguridad_table."tblcontactoexterno WHERE id_contacto_externo= ".$id_contacto_externo." AND bolborrado= 0 ORDER BY id_contacto_externo";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }

    public function insertContactoExterno(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::seguridad_table."tblcontactoexterno (strtrato, strcontactoext, strinstitucion, strcargo, strtelefono, stremail, strdireccion) ";
        $conn->sql.= "VALUES ('".$this->getStrtrato()."', '".$this->getStrcontactoext()."', '".$this->getStrinstitucion()."', ";
        $conn->sql.= "'".$this->getStrcargo()."', '".$this->getStrtelefono()."', '".$this->getStremail()."', '".$this->getStrdireccion()."')";
        $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function updateContactoExterno(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::seguridad_table."tblcontactoexterno SET strtrato= '".$this->getStrtrato()."', strcontactoext= '".$this->getStrcontactoext()."', ";
        $conn->sql.= "strinstitucion= '".$this->getStrinstitucion()."', strcargo= '".$this->getStrcargo()."', strtelefono= '".$this->getStrtelefono()."', ";
        $conn->sql.= "stremail= '".$this->getStremail()."', strdireccion= '".$this->getStrdireccion()."' WHERE ";
        $conn->sql.= "id_contacto_externo= ".$this->getId_contacto_externo();
        $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function deleteContactoExterno($id_contacto_externo){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::seguridad_table."tblcontactoexterno SET bolborrado= 1 WHERE id_contacto_externo= ".$id_contacto_externo;
        $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
}
?>
