<?php

require_once '../controlador/Conexion.php';
require_once 'clConstantesModelo.php';


/**
 * Description of ContactoModelo
 *
 * @author jhuidobro
 */
class clContactoModelo {
    private $id_contacto;
    private $strpassword;
    private $strlogin;
    private $id_tipo_maestro;
    private $strdocumento;
    private $strnombre;
    private $strapellido;
    private $strtlfhab;
    private $strext;
    private $stremail;
    private $memdireccion;
    private $id_cargo_maestro;
    private $id_estatus_maestro;
    private $strfirma;
    private $strmediafirma;
    private $bolborrado;
    private $id_dpto_maestro;
    private $id_coord_maestro;
    private $id_coordext_maestro;
    private $id_profile_maestro;

    public function __construct() {

    }
    public function llenar($request) {
        if($request['id_contacto'] != ""){
            $this->id_contacto= $request['id_contacto'];
        }
        if($request['strpassword'] != ""){
            $this->strpassword= $request['strpassword'];
        }
        if($request['strlogin'] != ""){
            $this->strlogin= $request['strlogin'];
        }
        if($request['id_tipo_maestro'] != ""){
            $this->id_tipo_maestro= $request['id_tipo_maestro'];
        }
        if($request['strdocumento'] != ""){
            $this->strdocumento= $request['strdocumento'];
        }
        if($request['strnombre'] != ""){
            $this->strnombre= $request['strnombre'];
        }
        if($request['strapellido'] != ""){
            $this->strapellido= $request['strapellido'];
        }
        if($request['strtlfhab'] != ""){
            $this->strtlfhab= $request['strtlfhab'];
        }
        if($request['strext'] != ""){
            $this->strext= $request['strext'];
        }
        if($request['stremail'] != ""){
            $this->stremail= $request['stremail'];
        }
        if($request['memdireccion'] != ""){
            $this->memdireccion= $request['memdireccion'];
        }
        if($request['id_cargo_maestro'] != ""){
            $this->id_cargo_maestro= $request['id_cargo_maestro'];
        }else{
            $this->id_cargo_maestro= 'null';
        }
        if($request['id_estatus_maestro'] != ""){
            $this->id_estatus_maestro= $request['id_estatus_maestro'];
        }else{
            $this->id_estatus_maestro= 'null';
        }
        if($request['strfirma'] != ""){
            $this->strfirma= $request['strfirma'];
        }
        if($request['strmediafirma'] != ""){
            $this->strmediafirma= $request['strmediafirma'];
        }
        if($request['bolborrado'] != ""){
            $this->bolborrado= $request['bolborrado'];
        }
        if($request['id_dpto_maestro'] != ""){
            $this->id_dpto_maestro= $request['id_dpto_maestro'];
        }else{
            $this->id_dpto_maestro= 'null';
        }
        if($request['id_coord_maestro'] != ""){
            $this->id_coord_maestro= $request['id_coord_maestro'];
        }else{
            $this->id_coord_maestro= 'null';
        }
        if($request['id_coordext_maestro'] != ""){
            $this->id_coordext_maestro= $request['id_coordext_maestro'];
        }else{
            $this->id_coordext_maestro= 'null';
        }
        if($request['id_profile_maestro'] != ""){
            $this->id_profile_maestro= $request['id_profile_maestro'];
        }else{
            $this->id_profile_maestro= 'null';
        }
    }

    public function getId_contacto(){
        return $this->id_contacto;
    }
    public function setId_contacto($id_contacto){
        $this->id_contacto= $id_contacto;
    }
    public function getStrpassword(){
        return $this->strpassword;
    }
    public function setStrpassword($strpassword){
        $this->strpassword= $strpassword;
    }
    public function getStrlogin(){
        return $this->strlogin;
    }
    public function setStrlogin($strlogin){
        $this->strlogin= $strlogin;
    }
    public function getId_tipo_maestro(){
        return $this->id_tipo_maestro;
    }
    public function setId_tipo_maestro($id_tipo_maestro){
        $this->id_tipo_maestro= $id_tipo_maestro;
    }
     public function getstrdocumento(){
        return $this->strdocumento;
    }
    public function setStrdocumento($strdocumento){
        $this->strdocumento= $strdocumento;
    }
     public function getStrnombre(){
        return $this->strnombre;
    }
    public function setStrnombre($strnombre){
        $this->strnombre= $strnombre;
    }
     public function getStrapellido(){
        return $this->strapellido;
    }
    public function setStrapellido($strapellido){
        $this->strlogin= $strapellido;
    }
     public function getStrtlfhab(){
        return $this->strtlfhab;
    }
    public function setStrtlfhab($strtlfhab){
        $this->strtlfhab= $strtlfhab;
    }
     public function getStrext(){
        return $this->strext;
    }
    public function setStrext($strext){
        $this->strext= $strext;
    }
     public function getStremail(){
        return $this->stremail;
    }
    public function setStremail($stremail){
        $this->stremail= $stremail;
    }
     public function getMemdireccion(){
        return $this->memdireccion;
    }
    public function setMemdireccion($memdireccion){
        $this->memdireccion= $memdireccion;
    }
     public function getId_cargo_maestro(){
        return $this->id_cargo_maestro;
    }
    public function setId_cargo_maestro($id_cargo_maestro){
        $this->id_cargo_maestro= $id_cargo_maestro;
    }
     public function getId_estatus_maestro(){
        return $this->id_estatus_maestro;
    }
    public function setId_estatus_maestro($id_estatus_maestro){
        $this->id_estatus_maestro= $id_estatus_maestro;
    }
     public function getStrfirma(){
        return $this->strfirma;
    }
    public function setStrfirma($strfirma){
        $this->strfirma= $strfirma;
    }
     public function getStrmediafirma(){
        return $this->strmediafirma;
    }
    public function setStrmediafirma($strmediafirma){
        $this->strmediafirma= $strmediafirma;
    }
    public function getBolborrado(){
        return $this->bolborrado;
    }
    public function setBolborrado($bolborrado){
        $this->bolborrado= $bolborrado;
    }
    public function getId_dpto_maestro(){
        return $this->id_dpto_maestro;
    }
    public function setId_dpto_maestro($id_dpto_maestro){
        $this->id_dpto_maestro= $id_dpto_maestro;
    }
    public function getId_coord_maestro(){
        return $this->id_coord_maestro;
    }
    public function setId_coord_maestro($id_coord_maestro){
        $this->id_coord_maestro= $id_coord_maestro;
    }
    public function getId_coordext_maestro(){
        return $this->id_coordext_maestro;
    }
    public function setId_coordext_maestro($id_coordext_maestro){
        $this->id_coordext_maestro= $id_coordext_maestro;
    }
    public function getId_profile_maestro(){
        return $this->id_profile_maestro;
    }
    public function setId_profile_maestro($id_profile_maestro){
        $this->id_profile_maestro= $id_profile_maestro;
    }

    public function insertContacto(){
        $contactoProfile= new clContactoProfileModelo();
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::seguridad_table."tblcontacto (strpassword, strlogin, id_tipo_maestro, strdocumento, strnombre, strapellido, ";
        $conn->sql.= "strtlfhab, strext, stremail, memdireccion, id_cargo_maestro, id_estatus_maestro, strfirma, strmediafirma, ";
        $conn->sql.= "id_dpto_maestro, id_coord_maestro, id_coordext_maestro) ";
        $conn->sql.= "VALUES (";
        $conn->sql.= "MD5('0000'), '".$this->getStrlogin()."', ".$this->getId_tipo_maestro().", ";
        $conn->sql.= "'".$this->getstrdocumento()."', '".$this->getStrnombre()."', '".$this->getStrapellido()."', ";
        $conn->sql.= "'".$this->getStrtlfhab()."', '".$this->getStrext()."', '".$this->getStremail()."', ";
        $conn->sql.= "'".$this->getMemdireccion()."', ".$this->getId_cargo_maestro().", ".$this->getId_estatus_maestro().", ";
        $conn->sql.= "'".$this->getStrfirma()."', '".$this->getStrmediafirma()."', ".$this->getId_dpto_maestro().", ";
        $conn->sql.= $this->getId_coord_maestro().", ".$this->getId_coordext_maestro();
        $conn->sql.= ")";
        $conn->ejecutarSentencia();
        $retorno= $this->verIdContacto();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function updateContacto(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::seguridad_table."tblcontacto SET ";
        $conn->sql.= "strlogin= '".$this->getStrlogin()."', ";
        $conn->sql.= "id_tipo_maestro= ".$this->getId_tipo_maestro().", strdocumento='".$this->getstrdocumento()."', ";
        $conn->sql.= "strnombre= '".$this->getStrnombre()."', strapellido='".$this->getStrapellido()."', ";
        $conn->sql.= "strtlfhab= '".$this->getStrtlfhab()."', strext='".$this->getStrext()."', stremail='".$this->getStremail()."', ";
        $conn->sql.= "memdireccion= '".$this->getMemdireccion()."', id_cargo_maestro=".$this->getId_cargo_maestro().", ";
        $conn->sql.= "id_estatus_maestro= ".$this->getId_estatus_maestro().", strfirma='".$this->getStrfirma()."', ";
        $conn->sql.= "strmediafirma= '".$this->getStrmediafirma()."', id_dpto_maestro=".$this->getId_dpto_maestro().", ";
        $conn->sql.= "id_coord_maestro=".$this->getId_coord_maestro().", id_coordext_maestro=".$this->getId_coordext_maestro()." ";
        $conn->sql.= "WHERE id_contacto=".$this->getId_contacto();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function updateContacto2(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::seguridad_table."".clConstantesModelo::seguridad_table."tblcontacto SET ";
        $conn->sql.= "strlogin= '".$this->getStrlogin()."', ";
        $conn->sql.= "strtlfhab= '".$this->getStrtlfhab()."', strext='".$this->getStrext()."', stremail='".$this->getStremail()."', ";
        $conn->sql.= "memdireccion= '".$this->getMemdireccion()."', ";
        $conn->sql.= " strfirma='".$this->getStrfirma()."', ";
        $conn->sql.= "strmediafirma= '".$this->getStrmediafirma()."' ";
        $conn->sql.= "WHERE id_contacto=".$this->getId_contacto();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function updateContacto3(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::seguridad_table."tblcontacto SET ";
        $conn->sql.= "strlogin= '".$this->getStrlogin()."', ";
        $conn->sql.= "strpassword= MD5('".$this->getStrpassword()."'), ";
        $conn->sql.= "strtlfhab= '".$this->getStrtlfhab()."', strext='".$this->getStrext()."', stremail='".$this->getStremail()."', ";
        $conn->sql.= "memdireccion= '".$this->getMemdireccion()."', ";
        $conn->sql.= " strfirma='".$this->getStrfirma()."', ";
        $conn->sql.= "strmediafirma= '".$this->getStrmediafirma()."' ";
        $conn->sql.= "WHERE id_contacto=".$this->getId_contacto();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function deleteContacto($id_contacto){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::seguridad_table."tblcontacto SET bolborrado= 1 WHERE id_contacto=".$id_contacto;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function selectAllContacto(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "SELECT id_contacto, strpassword, strlogin, ";
        $sql.= "id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo, ";
        $sql.= "strdocumento, strnombre, strapellido, strtlfhab, strext, stremail, memdireccion, ";
        $sql.= "id_cargo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_cargo_maestro) AS nombre_cargo, ";
        $sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus, ";
        $sql.= "strfirma, strmediafirma, bolborrado, id_dpto_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_dpto_maestro) AS nombre_dpto, ";
        $sql.= "id_coord_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_coord_maestro) AS nombre_coord, ";
        $sql.= "id_coordext_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_coordext_maestro) AS nombre_coordext ";      $sql.= "FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE bolborrado= 0 ORDER BY id_contacto";
        $conn->sql=$sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }
    public function selectContactoById($id_contacto){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_contacto, strpassword, strlogin, ";
        $conn->sql.= "id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo, ";
        $conn->sql.= "strdocumento, strnombre, strapellido, strtlfhab, strext, stremail, memdireccion, ";
        $conn->sql.= "id_cargo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_cargo_maestro) AS nombre_cargo, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus, ";
        $conn->sql.= "strfirma, strmediafirma, bolborrado, id_dpto_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_dpto_maestro) AS nombre_dpto, ";
        $conn->sql.= "id_coord_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_coord_maestro) AS nombre_coord, ";
        $conn->sql.= "id_coordext_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_coordext_maestro) AS nombre_coordext ";
        $conn->sql.= "FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= ".$id_contacto." AND bolborrado= 0";
        //exit("SQL: ".$conn->sql);
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }

    public function selectContactoByIdDepartamento($id_dpto){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_contacto, strpassword, strlogin, ";
        $conn->sql.= "id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo, ";
        $conn->sql.= "strdocumento, strnombre, strapellido, strtlfhab, strext, stremail, memdireccion, ";
        $conn->sql.= "id_cargo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_cargo_maestro) AS nombre_cargo, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus, ";
        $conn->sql.= "strfirma, strmediafirma, bolborrado, id_dpto_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_dpto_maestro) AS nombre_dpto, ";
        $conn->sql.= "id_coord_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_coord_maestro) AS nombre_coord, ";
        $conn->sql.= "id_coordext_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_coordext_maestro) AS nombre_coordext ";
        $conn->sql.= "FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_dpto_maestro IN (".$id_dpto.") OR id_coord_maestro IN (".$id_dpto.") ";
        $conn->sql.= "OR id_coordext_maestro IN (".$id_dpto.") AND bolborrado= 0";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }

    public function verificarLogin($strlogin){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT COUNT(*) FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE strlogin='".$strlogin."' AND bolborrado= 0";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }

    public function verificarDocumento($strdocumento){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT COUNT(*) as cantidad FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE strdocumento='".$strdocumento."' AND bolborrado= 0";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }

    public function verIdContacto(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT CURRVAL('".clConstantesModelo::seguridad_table."tblcontacto_id_contacto_seq') as id_contacto";
        $data= $conn->ejecutarSentencia(2);
        return $data;
    }
    public function verificarIngreso(){
        $conn= new Conexion();
        $conn->abrirConexion();
        //echo "SELECT * FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE strlogin='".$this->getStrlogin()."' AND strpassword= MD5('".$this->getStrpassword()."') AND id_estatus_maestro= 168 AND bolborrado= 0";
        $conn->sql= "SELECT * FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE strlogin='".$this->getStrlogin()."' AND strpassword= MD5('".$this->getStrpassword()."') AND id_estatus_maestro= 168 AND bolborrado= 0";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }
    public function verificarIngresoIntranet($login,$pass){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT * FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE strlogin='".$login."' AND strpassword= MD5('".$pass."') AND id_estatus_maestro= 12111 AND bolborrado= 0";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }
    public function verGerente($id_dpto_maestro){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_contacto, strpassword, strlogin, ";
        $conn->sql.= "id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo, ";
        $conn->sql.= "strdocumento, strnombre, strapellido, strtlfhab, strext, stremail, memdireccion, ";
        $conn->sql.= "id_cargo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_cargo_maestro) AS nombre_cargo, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus, ";
        $conn->sql.= "strfirma, strmediafirma, bolborrado, id_dpto_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_dpto_maestro) AS nombre_dpto, ";
        $conn->sql.= "id_coord_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_coord_maestro) AS nombre_coord, ";
        $conn->sql.= "id_coordext_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_coordext_maestro) AS nombre_coordext ";
        $conn->sql.= "FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_dpto_maestro= ".$id_dpto_maestro." AND id_cargo_maestro= 164 AND id_estatus_maestro= 168 ";
        $conn->sql.= "AND bolborrado= 0";
        //exit("SQL: ".$conn->sql);
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }

    public function verCoordinador($id_coord_maestro){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_contacto, strpassword, strlogin, ";
        $conn->sql.= "id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo, ";
        $conn->sql.= "strdocumento, strnombre, strapellido, strtlfhab, strext, stremail, memdireccion, ";
        $conn->sql.= "id_cargo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_cargo_maestro) AS nombre_cargo, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus, ";
        $conn->sql.= "strfirma, strmediafirma, bolborrado, id_dpto_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_dpto_maestro) AS nombre_dpto, ";
        $conn->sql.= "id_coord_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_coord_maestro) AS nombre_coord, ";
        $conn->sql.= "id_coordext_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_coordext_maestro) AS nombre_coordext ";
        $conn->sql.= "FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_coord_maestro= ".$id_coord_maestro." AND id_cargo_maestro= 165 AND id_estatus_maestro= 168 ";
        $conn->sql.= "AND bolborrado= 0";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }

    public function updateContactoPassword() {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::seguridad_table."tblcontacto SET strpassword= MD5('".$this->getStrpassword()."') WHERE id_contacto= ".$this->getId_contacto();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectAllContactoFiltros($strnombre= "", $strapellido= "", $strlogin= "", $strdocumento= "", $id_dpto_maestro= ""){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "SELECT id_contacto, strpassword, strlogin, ";
        $sql.= "id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo, ";
        $sql.= "strdocumento, strnombre, strapellido, strtlfhab, strext, stremail, memdireccion, ";
        $sql.= "id_cargo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_cargo_maestro) AS nombre_cargo, ";
        $sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus, ";
        $sql.= "strfirma, strmediafirma, bolborrado, id_dpto_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_dpto_maestro) AS nombre_dpto, ";
        $sql.= "id_coord_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_coord_maestro) AS nombre_coord, ";
        $sql.= "id_coordext_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_coordext_maestro) AS nombre_coordext ";
        $sql.= "FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE bolborrado= 0 ";
        if($strnombre != ""){
            $sql.= "AND strnombre LIKE '%".$strnombre."%' ";
        }
        if($strapellido != ""){
            $sql.= "AND strapellido LIKE '%".$strapellido."%' ";
        }
        if($strlogin != ""){
            $sql.= "AND strlogin LIKE '%".$strlogin."%' ";
        }
        if($strdocumento != ""){
            $sql.= "AND strdocumento LIKE '%".$strdocumento."%' ";
        }
        if($id_dpto_maestro != ""){
            $sql.= "AND id_dpto_maestro= ".$id_dpto_maestro." ";
        }
        $sql.= "ORDER BY id_contacto";
        $conn->sql=$sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }
    
    public function selectAllContactoFiltrosAgenda($id_coord_maestro= ""){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "SELECT id_contacto, strpassword, strlogin, ";
        $sql.= "id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo, ";
        $sql.= "strdocumento, strnombre, strapellido, strtlfhab, strext, stremail, memdireccion, ";
        $sql.= "id_cargo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_cargo_maestro) AS nombre_cargo, ";
        $sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus, ";
        $sql.= "strfirma, strmediafirma, bolborrado, id_dpto_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_dpto_maestro) AS nombre_dpto, ";
        $sql.= "id_coord_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_coord_maestro) AS nombre_coord, ";
        $sql.= "id_coordext_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_coordext_maestro) AS nombre_coordext ";
        $sql.= "FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE bolborrado= 0 ";
        if($id_coord_maestro != ""){
            $sql.= "AND id_coord_maestro= ".$id_coord_maestro." ";
        }
        $sql.= "ORDER BY id_contacto";
//        exit($sql);
        $conn->sql=$sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }

    public function selectAllContactoFiltrosDocumento($id_coord_maestro= ""){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "SELECT id_contacto, strpassword, strlogin, ";
        $sql.= "id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo, ";
        $sql.= "strdocumento, strnombre, strapellido, strtlfhab, strext, stremail, memdireccion, ";
        $sql.= "id_cargo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_cargo_maestro) AS nombre_cargo, ";
        $sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus, ";
        $sql.= "strfirma, strmediafirma, bolborrado, id_dpto_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_dpto_maestro) AS nombre_dpto, ";
        $sql.= "id_coord_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_coord_maestro) AS nombre_coord, ";
        $sql.= "id_coordext_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_coordext_maestro) AS nombre_coordext ";
        $sql.= "FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE bolborrado= 0 ";
        if($id_coord_maestro != ""){
            $sql.= "AND id_coord_maestro= ".$id_coord_maestro." ";
        }
        $sql.= "ORDER BY id_contacto";
//        exit($sql);
        $conn->sql=$sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }
    
}



?>
