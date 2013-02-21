<?php

    require_once '../controlador/Conexion.php';

/**
 * Description of clValidacionModelo
 *
 * @author jsuarez
 */
class clValidacionModelo {
    private $id_validacion;
    private $dtmfecha;
    private $codigo_validacion;
    private $id_contacto;
    private $id_corresp;
    private $bolborrado;

    public function __construct() {

    }

    public function llenar($request) {
        if($request['id_validacion'] != ""){
            $this->id_validacion= $request['id_validacion'];
        }
        if($request['dtmfecha'] != ""){
            $this->dtmfecha= $request['dtmfecha'];
        }
        if($request['codigo_validacion'] != ""){
            $this->codigo_validacion= $request['codigo_validacion'];
        }
        if($request['id_contacto'] != ""){
            $this->id_contacto= $request['id_contacto'];
        }
        if($request['id_corresp'] != ""){
            $this->id_corresp= $request['id_corresp'];
        }
        if($request['bolborrado'] != ""){
            $this->bolborrado= $request['bolborrado'];
        }
    }

    public function getId_validacion(){
        return $this->id_validacion;
    }
    public function setId_validacion($id_validacion){
        $this->id_validacion= $id_validacion;
    }
    public function getDtmfecha(){
        return $this->dtmfecha;
    }
    public function setDtmfecha($dtmfecha){
        $this->dtmfecha= $dtmfecha;
    }
    public function getCodigo_validacion(){
        return $this->codigo_validacion;
    }
    public function setCodigo_validacion($codigo_validacion){
        $this->codigo_validacion= $codigo_validacion;
    }
    public function getId_contacto(){
        return $this->id_contacto;
    }
    public function setId_contacto($id_contacto){
        $this->id_contacto= $id_contacto;
    }
    public function getId_corresp(){
        return $this->id_corresp;
    }
    public function setId_corresp($id_corresp){
        $this->id_corresp= $id_corresp;
    }
    public function getBolborrado(){
        return $this->bolborrado;
    }
    public function setBolborrado($bolborrado){
        $this->bolborrado= $bolborrado;
    }

    public function insertValidacion(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tblvalidacion (dtmfecha, codigo_validacion, id_contacto, id_corresp) VALUES ";
        $conn->sql.= "(now(), '".$this->getCodigo_validacion()."', ".$this->getId_contacto().", ".$this->getId_corresp().")";
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function updateValidacion(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tblvalidacion SET dtmfecha= now(), id_contacto= ".$this->getId_contacto()." WHERE id_corresp= ".$this->getId_corresp();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectValidacionById($id_corresp){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_validacion, TO_CHAR(dtmfecha, 'DD/MM/YYYY') AS fecha, TO_CHAR(dtmfecha, 'HH:MI:SS') AS hora, codigo_validacion, id_contacto, ";
        $conn->sql.= "(SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tblvalidacion.id_contacto) AS nombre_contacto, ";
        $conn->sql.= "id_corresp, bolborrado FROM ".clConstantesModelo::correspondencia_table."tblvalidacion WHERE id_corresp= ".$id_corresp;
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectValidacionCount($id_corresp){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT COUNT(*) FROM ".clConstantesModelo::correspondencia_table."tblvalidacion WHERE id_corresp= ".$id_corresp;
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
}
?>
