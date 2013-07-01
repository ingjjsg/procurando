<?php

    require_once '../controlador/Conexion.php';

/**
 * Description of clNotaModelo
 *
 * @author jhuidobro
 */
class clNotaModelo {
    private $id_notas;
    private $id_tiponota_maestro;
    private $id_actividad;
    private $id_corresp;
    private $dtmnota;
    private $memobsernota;
    private $id_contacto;
    private $bolborrado;

    public function __construct() {

    }

    public function llenar($request) {
        if($request['id_notas'] != ""){
            $this->id_notas= $request['id_notas'];
        }
        if($request['id_tiponota_maestro'] != ""){
            $this->id_tiponota_maestro= $request['id_tiponota_maestro'];
        }
        if($request['id_actividad'] != ""){
            $this->id_actividad= $request['id_actividad'];
        }
        if($request['id_corresp'] != ""){
            $this->id_corresp= $request['id_corresp'];
        }
        if($request['dtmnota'] != ""){
            $this->dtmnota= $request['dtmnota'];
        }
        if($request['memobsernota'] != ""){
            $this->memobsernota= $request['memobsernota'];
        }
        if($request['id_contacto'] != ""){
            $this->id_contacto= $request['id_contacto'];
        }
        if($request['bolborrado'] != ""){
            $this->bolborrado= $request['bolborrado'];
        }
    }

    public function getId_notas(){
        return $this->id_notas;
    }
    public function setId_notas($id_notas){
        $this->id_notas= $id_notas;
    }
    public function getId_tiponota_maestro(){
        return $this->id_tiponota_maestro;
    }
    public function setId_tiponota_maestro($id_tiponota_maestro){
        $this->id_tiponota_maestro= $id_tiponota_maestro;
    }
    public function getId_actividad(){
        return $this->id_actividad;
    }
    public function setId_actividad($id_actividad){
        $this->id_actividad= $id_actividad;
    }
    public function getId_corresp(){
        return $this->id_corresp;
    }
    public function setId_corresp($id_corresp){
        $this->id_corresp= $id_corresp;
    }
    public function getDtmnota(){
        return $this->dtmnota;
    }
    public function setDtmnota($dtmnota){
        $this->dtmnota= $dtmnota;
    }
    public function getMemobsernota(){
        return $this->memobsernota;
    }
    public function setMemobsernota($memobsernota){
        $this->memobsernota= $memobsernota;
    }
    public function getId_contacto(){
        return $this->id_contacto;
    }
    public function setId_contacto($id_contacto){
        $this->id_contacto= $id_contacto;
    }
    public function getBolborrado(){
        return $this->bolborrado;
    }
    public function setBolborrado($bolborrado){
        $this->bolborrado= $bolborrado;
    }

    public function insertNota(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tblnotas (id_tiponota_maestro, id_actividad, id_corresp, dtmnota, memobsernota, id_contacto) VALUES ";
        $conn->sql.= "(".$this->getId_tiponota_maestro().", ".$this->getId_actividad().", ".$this->getId_corresp().", now(), ";
        $conn->sql.= "'".$this->getMemobsernota()."', ".$this->getId_contacto().")";
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectAllNotaByIdAC($id, $tipo){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_notas, id_tiponota_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tiponota_maestro) AS nombre_tiponota_maestro, ";
        $conn->sql.= "id_actividad, id_corresp, TO_CHAR(dtmnota, 'DD/MM/YYYY') AS fecha_nota, TO_CHAR(dtmnota, 'HH:MI:SS') AS hora_nota, memobsernota, ";
        $conn->sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tn.id_contacto), bolborrado FROM tblnotas tn ";
        $conn->sql.= "WHERE bolborrado= 0 ";
        if($tipo == 239){
            $conn->sql.= "AND id_corresp= ".$id;
        }else if($tipo == 240){
            $conn->sql.= "AND id_actividad= ".$id;
        }
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
}
?>
