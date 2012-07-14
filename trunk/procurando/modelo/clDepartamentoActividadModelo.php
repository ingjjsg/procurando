<?php
    require_once '../controlador/Conexion.php';

/**
 * Description of clDepartamentoActividadModelo
 *
 * @author Juan
 */
class clDepartamentoActividadModelo {
    private $id_departamentoactividad;
    private $id_actividad;
    private $id_departamento_maestro;
    private $id_contacto;
    private $bolborrado;

    public function __construct() {

    }

    public function llenar($request) {
        if($request['id_departamentoactividad'] != ""){
            $this->id_departamentoactividad= $request['id_departamentoactividad'];
        }
        if($request['id_actividad'] != ""){
            $this->id_actividad= $request['id_actividad'];
        }
        if($request['id_departamento_maestro'] != ""){
            $this->id_departamento_maestro= $request['id_departamento_maestro'];
        }
        if($request['id_contacto'] != ""){
            $this->id_contacto= $request['id_contacto'];
        }
        if($request['bolborrado'] != ""){
            $this->bolborrado= $request['bolborrado'];
        }
    }

    public function getId_departamentoactividad(){
        return $this->id_departamentoactividad;
    }
    public function setId_departamentoactividad($id_departamentoactividad){
        $this->id_departamentoactividad= $id_departamentoactividad;
    }
    public function getId_actividad(){
        return $this->id_actividad;
    }
    public function setId_actividad($id_actividad){
        $this->id_actividad= $id_actividad;
    }
    public function getId_departamento_maestro(){
        return $this->id_departamento_maestro;
    }
    public function setId_departamento_maestro($id_departamento_maestro){
        $this->id_departamento_maestro= $id_departamento_maestro;
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

    public function insertDepartamentoActividad() {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tbldepartamentoactividad (id_actividad, id_departamento_maestro, id_contacto) VALUES (";
        $conn->sql.= $this->getId_actividad().", ".$this->getId_departamento_maestro().", ".$this->getId_contacto().")";
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function updateDepartamentoActividad() {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tbldepartamentoactividad SET id_actividad+ ".$this->getId_actividad().", ";
        $conn->sql.= "id_departamento_maestro= ".$this->getId_departamento_maestro().", id_contacto= ".$this->getId_contacto()." ";
        $conn->sql.= "WHERE id_departamentoactividad= ".$this->getId_departamentoactividad();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function deleteDepartamentoActividad() {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tbldepartamentoactividad SET bolborrado= 1 WHERE id_departamentoactividad= ".$this->getId_departamentoactividad();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectAllDepartamentoActividad() {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT	id_departamentoactividad, id_actividad, ";
        $conn->sql.= "(SELECT memtitulo FROM ".clConstantesModelo::correspondencia_table."tblactividades WHERE id_actividad= tbldepartamentoactividad.id_actividad) AS titulo_actividad, ";
        $conn->sql.= "id_departamento_maestro, ";
        $conn->sql.= "(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_departamento_maestro) AS nombre_id_departamento_maestro, ";
        $conn->sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= id_contacto) AS nombre_contacto, ";
        $conn->sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tbldepartamentoactividad WHERE bolborrado=0";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectDepartamentoActividadById($id_departamentoactividad) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT	id_departamentoactividad, id_actividad, ";
        $conn->sql.= "(SELECT memtitulo FROM ".clConstantesModelo::correspondencia_table."tblactividades WHERE id_actividad= tbldepartamentoactividad.id_actividad) AS titulo_actividad, ";
        $conn->sql.= "id_departamento_maestro, ";
        $conn->sql.= "(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_departamento_maestro) AS nombre_id_departamento_maestro, ";
        $conn->sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tbldepartamentoactividad.id_contacto) AS nombre_contacto, ";
        $conn->sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tbldepartamentoactividad WHERE id_departamentoactividad= ".$id_departamentoactividad;
        $conn->sql.= "AND bolborrado=0";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectDepartamentoActividadByIdDepartamento($id_departamento_maestro) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT	id_departamentoactividad, id_actividad, ";
        $conn->sql.= "(SELECT memtitulo FROM ".clConstantesModelo::correspondencia_table."tblactividades WHERE id_actividad= tbldepartamentoactividad.id_actividad) AS titulo_actividad, ";
        $conn->sql.= "id_departamento_maestro, ";
        $conn->sql.= "(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_departamento_maestro) AS nombre_id_departamento_maestro, ";
        $conn->sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tbldepartamentoactividad.id_contacto) AS nombre_contacto, ";
        $conn->sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tbldepartamentoactividad WHERE id_departamento_maestro= ".$id_departamento_maestro;
        $conn->sql.= "AND bolborrado=0";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
    
    public function selectDepartamentoActividadByIdActividad($id_actividad) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT	id_departamentoactividad, id_actividad, ";
        $conn->sql.= "(SELECT memtitulo FROM ".clConstantesModelo::correspondencia_table."tblactividades WHERE id_actividad= tbldepartamentoactividad.id_actividad) AS titulo_actividad, ";
        $conn->sql.= "id_departamento_maestro, ";
        $conn->sql.= "(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_departamento_maestro) AS nombre_departamento_maestro, ";
        $conn->sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tbldepartamentoactividad.id_contacto) AS nombre_contacto, ";
        $conn->sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tbldepartamentoactividad WHERE id_actividad= ".$id_actividad;
        $conn->sql.= "AND bolborrado=0";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectDepartamentoActividadByIdActividadIdDepartamento() {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT	COUNT(*) FROM ".clConstantesModelo::correspondencia_table."tbldepartamentoactividad WHERE id_actividad= ".$this->getId_actividad()." ";
        $conn->sql.= "AND id_departamento_maestro= ".$this->getId_departamento_maestro()." AND bolborrado= 0";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
}
?>
