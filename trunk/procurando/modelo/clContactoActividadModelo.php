<?php
    require_once '../controlador/Conexion.php';

/**
 * Description of clContactoActividadModelo
 *
 * @author jhuidobro
 */
class clContactoActividadModelo {
    private $id_contactoactividad;
    private $id_actividad;
    private $id_contacto;
    private $dtminicio;
    private $dtmresolucion;
    private $id_estatus_maestro;
    private $bolborrado;
    private $id_contacto_asigna;

    public function __construct() {

    }
    public function llenar($request) {
        if($request['id_contactoactividad'] != ""){
            $this->id_contactoactividad= $request['id_contactoactividad'];
        }
        if($request['id_actividad'] != ""){
            $this->id_actividad= $request['id_actividad'];
        }
        if($request['id_contacto'] != ""){
            $this->id_contacto= $request['id_contacto'];
        }
        if($request['dtminicio'] != ""){
            $this->dtminicio= $request['dtminicio'];
        }
        if($request['dtmresolucion'] != ""){
            $this->dtmresolucion= $request['dtmresolucion'];
        }
        if($request['id_estatus_maestro'] != ""){
            $this->id_estatus_maestro= $request['id_estatus_maestro'];
        }
        if($request['bolborrado'] != ""){
            $this->bolborrado= $request['bolborrado'];
        }
        if($request['id_contacto_asigna'] != ""){
            $this->id_contacto_asigna= $request['id_contacto_asigna'];
        }
    }

    public function getId_contactoactividad(){
        return $this->id_contactoactividad;
    }
    public function setId_contactoactividad($id_contactoactividad){
        $this->id_contactoactividad= $id_contactoactividad;
    }
    public function getId_actividad(){
        return $this->id_actividad;
    }
    public function setId_actividad($id_actividad){
        $this->id_actividad= $id_actividad;
    }
    public function getId_contacto(){
        return $this->id_contacto;
    }
    public function setId_contacto($id_contacto){
        $this->id_contacto= $id_contacto;
    }
    public function getDtminicio(){
        return $this->dtminicio;
    }
    public function setDtminicio($dtminicio){
        $this->dtminicio= $dtminicio;
    }
    public function getDtmresolucion(){
        return $this->dtmresolucion;
    }
    public function setDtmresolucion($dtmresolucion){
        $this->dtmresolucion= $dtmresolucion;
    }
    public function getId_estatus_maestro(){
        return $this->id_estatus_maestro;
    }
    public function setId_estatus_maestro($id_estatus_maestro){
        $this->id_estatus_maestro= $id_estatus_maestro;
    }
    public function getBolborrado(){
        return $this->bolborrado;
    }
    public function setBolborrado($bolborrado){
        $this->bolborrado= $bolborrado;
    }
    public function getId_contacto_asigna(){
        return $this->id_contacto_asigna;
    }
    public function setId_contacto_asigna($id_contacto_asigna){
        $this->id_contacto_asigna= $id_contacto_asigna;
    }

    public function insertContactoActividad() {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::seguridad_table."tblcontactoactividad (id_actividad, id_contacto, id_estatus_maestro, id_contacto_asigna) VALUES (";
        $conn->sql.= $this->getId_actividad().", ".$this->getId_contacto().", ".$this->getId_estatus_maestro().", ".$this->getId_contacto_asigna().")";
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function updateContactoActividadEstatus($id_estatus_maestro, $id_actividad) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::seguridad_table."tblcontactoactividad SET id_estatus_maestro= ".$id_estatus_maestro." ";
        $conn->sql.= "WHERE id_actividad= ".$id_actividad;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function updateContactoActividadFecha($modo, $id_contactoactividad) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::seguridad_table."tblcontactoactividad SET ";
        if($modo == 1){
            $conn->sql.= "dtminicio= now() ";
        }else if($modo == 2){
            $conn->sql.= "dtmresolucion= now() ";
        }
        $conn->sql.= "WHERE id_contactoactividad= ".$id_contactoactividad;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function updateContactoActividadEstatusById($id_estatus_maestro, $id_contactoactividad) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::seguridad_table."tblcontactoactividad SET id_estatus_maestro= ".$id_estatus_maestro." ";
        $conn->sql.= "WHERE id_contactoactividad= ".$id_contactoactividad;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function deleteContactoActividad($id_contactoactividad) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::seguridad_table."tblcontactoactividad SET bolborrado= 1 WHERE id_contactoactividad= ".$id_contactoactividad;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectContactosActividadByIdActividad($id_actividad, $id_dpto_maestro= null) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_contactoactividad, id_actividad, ";
        $conn->sql.= "(SELECT memtitulo FROM tblactividades WHERE id_actividad=  ".clConstantesModelo::seguridad_table."tblcontactoactividad.id_actividad) AS titulo_actividad, ";
        $conn->sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= ".clConstantesModelo::seguridad_table."tblcontactoactividad.id_contacto) AS nombre_contacto, ";
        $conn->sql.= "TO_CHAR(dtminicio, 'DD/MM/YYYY') as fecha_inicio, TO_CHAR(dtminicio, 'HH:MI:SS') as hora_inicio, ";
        $conn->sql.= "TO_CHAR(dtmresolucion, 'DD/MM/YYYY') as fecha_resolucion, TO_CHAR(dtmresolucion, 'HH:MI:SS') as hora_resolucion, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
        $conn->sql.= "id_contacto_asigna, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= ".clConstantesModelo::seguridad_table."tblcontactoactividad.id_contacto_asigna) AS nombre_contacto_asigna, ";
        $conn->sql.= "bolborrado FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad WHERE id_actividad= ".$id_actividad." AND bolborrado= 0 ";
        if($id_dpto_maestro != null){
           $conn->sql.= "AND id_contacto IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_dpto_maestro= ".$id_dpto_maestro.")";
        }
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        //echo $conn->sql;
        return $retorno;
    }

    public function selectContactosActividadById($id_contactoactividad) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_contactoactividad, id_actividad, ";
        $conn->sql.= "(SELECT memtitulo FROM tblactividades WHERE id_actividad=  ".clConstantesModelo::seguridad_table."tblcontactoactividad.id_actividad) AS titulo_actividad, ";
        $conn->sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= ".clConstantesModelo::seguridad_table."tblcontactoactividad.id_contacto) AS nombre_contacto, ";
        $conn->sql.= "TO_CHAR(dtminicio, 'DD/MM/YYYY') as fecha_inicio, TO_CHAR(dtminicio, 'HH:MI:SS') as hora_inicio, ";
        $conn->sql.= "TO_CHAR(dtmresolucion, 'DD/MM/YYYY') as fecha_resolucion, TO_CHAR(dtmresolucion, 'HH:MI:SS') as hora_resolucion, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
        $conn->sql.= "bolborrado FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad WHERE id_contactoactividad= ".$id_contactoactividad." AND bolborrado= 0";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectContactosActividadByIdContacto($id_contacto) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_contactoactividad, id_actividad, ";
        $conn->sql.= "(SELECT memtitulo FROM tblactividades WHERE id_actividad=  ".clConstantesModelo::seguridad_table."tblcontactoactividad.id_actividad) AS titulo_actividad, ";
        $conn->sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= ".clConstantesModelo::seguridad_table."tblcontactoactividad.id_contacto) AS nombre_contacto, ";
        $conn->sql.= "TO_CHAR(dtminicio, 'DD/MM/YYYY') as fecha_inicio, TO_CHAR(dtminicio, 'HH:MI:SS') as hora_inicio, ";
        $conn->sql.= "TO_CHAR(dtmresolucion, 'DD/MM/YYYY') as fecha_resolucion, TO_CHAR(dtmresolucion, 'HH:MI:SS') as hora_resolucion, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
        $conn->sql.= "bolborrado FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad WHERE id_contacto= ".$id_contacto." AND id_estatus_maestro IN (249,253,265) ";
        $conn->sql.= "AND bolborrado= 0";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function cantidadAsignadosByIdActividad($id_actividad) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT COUNT(*) FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad WHERE id_actividad= ".$id_actividad." AND bolborrado= 0";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function cantidadAsignadosByIdActividadIdDepartamento($id_actividad, $id_dpto_maestro, $tipo) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT COUNT(*) FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad WHERE id_actividad= ".$id_actividad." ";
        if($tipo == 1){
            $conn->sql.= "AND id_contacto IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_coord_maestro= ".$id_dpto_maestro." ";
            $conn->sql.= "OR id_coordext_maestro= ".$id_dpto_maestro.") ";
        }else if($tipo == 2){
            $conn->sql.= "AND id_contacto IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_dpto_maestro= ".$id_dpto_maestro.") ";
        }
        $conn->sql.= "AND bolborrado= 0";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectAsignadosFinalizados($id_actividad) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT (SELECT count(*) FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad WHERE id_actividad = ".$id_actividad." AND bolborrado= 0) as analistas, ";
        $conn->sql.= "(SELECT count(*) FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad WHERE id_actividad = ".$id_actividad." AND bolborrado= 0 AND id_estatus_maestro = 251) as finalizados ";
        $conn->sql.= "FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad GROUP BY analistas, finalizados";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function cantidadContactosActividadByIdContactoIdEstatus($id_contacto, $id_estatus_maestro) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT COUNT(*) FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad WHERE id_contacto= ".$id_contacto." AND id_estatus_maestro= ".$id_estatus_maestro;
        $conn->sql.= "AND bolborrado= 0";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
}
?>
