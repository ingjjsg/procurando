<?php
    require_once '../controlador/Conexion.php';

/**
 * Description of clDetalleContactoActividadModelo
 *
 * @author jhuidobro
 */
class clDetalleContactoActividadModelo {
    private $id_detallecontactoactividad;
    private $id_contactoactividad;
    private $dtmregistro;
    private $menresultado;
    private $menobservaciones;
    private $bolborrado;

    public function __construct() {

    }

    public function llenar($request) {
        if($request['id_detallecontactoactividad'] != ""){
            $this->id_detallecontactoactividad= $request['id_detallecontactoactividad'];
        }
        if($request['id_contactoactividad'] != ""){
            $this->id_contactoactividad= $request['id_contactoactividad'];
        }
        if($request['dtmregistro'] != ""){
            $this->dtmregistro= $request['dtmregistro'];
        }
        if($request['menresultado'] != ""){
            $this->menresultado= $request['menresultado'];
        }
        if($request['menobservaciones'] != ""){
            $this->menobservaciones= $request['menobservaciones'];
        }
        if($request['bolborrado'] != ""){
            $this->bolborrado= $request['bolborrado'];
        }
    }

    public function getId_detallecontactoactividad(){
        return $this->id_detallecontactoactividad;
    }
    public function setId_detallecontactoactividad($id_detallecontactoactividad){
        $this->id_detallecontactoactividad= $id_detallecontactoactividad;
    }
    public function getId_contactoactividad(){
        return $this->id_contactoactividad;
    }
    public function setId_contactoactividad($id_contactoactividad){
        $this->id_contactoactividad= $id_contactoactividad;
    }
    public function getDtmregistro(){
        return $this->dtmregistro;
    }
    public function setDtmregistro($dtmregistro){
        $this->dtmregistro= $dtmregistro;
    }
    public function getMenresultado(){
        return $this->menresultado;
    }
    public function setMenresultado($menresultado){
        $this->menresultado= $menresultado;
    }
    public function getMenobservaciones(){
        return $this->menobservaciones;
    }
    public function setMenobservaciones($menobservaciones){
        $this->menobservaciones= $menobservaciones;
    }
    public function getBolborrado(){
        return $this->bolborrado;
    }
    public function setBolborrado($bolborrado){
        $this->bolborrado= $bolborrado;
    }

    public function insertDetalleContactoActividad() {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tbldetallecontactoactividad (id_contactoactividad, dtmregistro, menresultado, menobservaciones) VALUES ";
        $conn->sql.= "(".$this->getId_contactoactividad().", now(), '".$this->getMenresultado()."', '".$this->getMenobservaciones()."')";
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectDetalleContactoActividadById($id_detallecontactoactividad) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_detallecontactoactividad, id_contactoactividad, TO_CHAR(dtmregistro, 'DD/MM/YYYY') AS fecha_registro, ";
        $conn->sql.= "TO_CHAR(dtmregistro, 'HH:MI:SS') AS hora_registro, menresultado, menobservaciones, bolborrado FROM ".clConstantesModelo::correspondencia_table."tbldetallecontactoactividad ";
        $conn->sql.= "WHERE id_detallecontactoactividad= ".$id_detallecontactoactividad." AND bolborrado= 0";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectDetalleContactoActividadByIdContactoActividad($id_contactoactividad) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_detallecontactoactividad, id_contactoactividad, TO_CHAR(dtmregistro, 'DD/MM/YYYY') AS fecha_registro, ";
        $conn->sql.= "TO_CHAR(dtmregistro, 'HH:MI:SS am') AS hora_registro, menresultado, menobservaciones, bolborrado FROM ".clConstantesModelo::correspondencia_table."tbldetallecontactoactividad ";
        $conn->sql.= "WHERE id_contactoactividad= ".$id_contactoactividad." AND bolborrado= 0 ORDER BY dtmregistro DESC";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function cantidadDetalleContactoActividadByIdContactoActividad($id_contactoactividad) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT COUNT(*) FROM ".clConstantesModelo::correspondencia_table."tbldetallecontactoactividad WHERE id_contactoactividad= ".$id_contactoactividad." AND bolborrado= 0";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

}
?>
