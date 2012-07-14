<?php

    require_once '../controlador/Conexion.php';

/**
 * Description of clActividades
 *
 * @author jhuidobro
 */
class clActividadesModelo {
    private $id_actividad;
    private $id_destinatarios;
    private $strdescripcion;
    private $id_prioridad_maestro;
    private $id_estatus_maestro;
    private $memtitulo;
    private $dtmresolucion;
    private $dtmcierre;
    private $id_contacto;
    private $bolborrado;

    public function __construct() {

    }

    public function llenar($request) {
        if($request['id_actividad'] != ""){
            $this->id_actividad= $request['id_actividad'];
        }
        if($request['id_destinatarios'] != ""){
            $this->id_destinatarios= $request['id_destinatarios'];
        }
        if($request['strdescripcion'] != ""){
            $this->strdescripcion= $request['strdescripcion'];
        }
        if($request['id_prioridad_maestro'] != ""){
            $this->id_prioridad_maestro= $request['id_prioridad_maestro'];
        }
        if($request['id_estatus_maestro'] != ""){
            $this->id_estatus_maestro= $request['id_estatus_maestro'];
        }
        if($request['memtitulo'] != ""){
            $this->memtitulo= $request['memtitulo'];
        }
        if($request['dtmresolucion'] != ""){
            $this->dtmresolucion= $request['dtmresolucion'];
        }
        if($request['dtmcierre'] != ""){
            $this->dtmcierre= $request['dtmcierre'];
        }
        if($request['id_contacto'] != ""){
            $this->id_contacto= $request['id_contacto'];
        }
        if($request['bolborrado'] != ""){
            $this->bolborrado= $request['bolborrado'];
        }
    }

    public function getId_actividad(){
        return $this->id_actividad;
    }
    public function setId_actividad($id_actividad){
        $this->id_actividad= $id_actividad;
    }
    public function getId_destinatarios(){
        return $this->id_destinatarios;
    }
    public function setId_destinatarios($id_destinatarios){
        $this->id_destinatarios= $id_destinatarios;
    }
    public function getStrdescripcion(){
        return $this->strdescripcion;
    }
    public function setStrdescripcion($strdescripcion){
        $this->strdescripcion= $strdescripcion;
    }
    public function getId_prioridad_maestro(){
        return $this->id_prioridad_maestro;
    }
    public function setId_prioridad_maestro($id_prioridad_maestro){
        $this->id_prioridad_maestro= $id_prioridad_maestro;
    }
    public function getId_estatus_maestro(){
        return $this->id_estatus_maestro;
    }
    public function setId_estatus_maestro($id_estatus_maestro){
        $this->id_estatus_maestro= $id_estatus_maestro;
    }
    public function getMemtitulo(){
        return $this->memtitulo;
    }
    public function setMemtitulo($memtitulo){
        $this->memtitulo= $memtitulo;
    }
    public function getDtmresolucion(){
        return $this->dtmresolucion;
    }
    public function setDtmresolucion($dtmresolucion){
        $this->dtmresolucion= $dtmresolucion;
    }
    public function getDtmcierre(){
        return $this->dtmcierre;
    }
    public function setDtmcierre($dtmcierre){
        $this->dtmcierre= $dtmcierre;
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

    public function insertActividad() {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO tblactividades (id_destinatarios, strdescripcion, id_prioridad_maestro, id_estatus_maestro, ";
        $conn->sql.= "memtitulo, dtmresolucion, id_contacto) VALUES (".$this->getId_destinatarios().", ";
        $conn->sql.= "'".$this->getStrdescripcion()."', ".$this->getId_prioridad_maestro().", ".$this->getId_estatus_maestro().", ";
        $conn->sql.= "'".$this->getMemtitulo()."', TO_DATE('".$this->getDtmresolucion()."', 'DD/MM/YYYY'), ".$this->getId_contacto().")";
        $retorno= $conn->ejecutarSentencia();
        //echo $conn->sql;
        $retorno= $this->verIdActividad();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function updateActividad() {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE tblactividades SET memresultado= '".$this->getMemresultado()."', ";
        $conn->sql.= "memobservaciones= '".$this->getMemobservaciones()."' ";
        $conn->sql.= "WHERE id_actividad= ".$this->getId_actividad();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function deleteActividad($id_actividad) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE tblactividades SET bolborrado= 1 WHERE id_actividad= ".$id_actividad;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectAllActividad() {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT	id_actividad, id_destinatarios, strdescripcion, ";
        $conn->sql.= "id_prioridad_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_prioridad_maestro) AS nombre_prioridad_maestro, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
        $conn->sql.= "memresultado, memtitulo, memobservaciones, TO_CHAR(dtmasignacion, 'DD/MM/YYYY') as fecha_asignacion, ";
        $conn->sql.= "TO_CHAR(dtmasignacion, 'HH:MI:SS') as hora_asignacion, TO_CHAR(dtmcierre, 'DD/MM/YYYY') as fecha_cierre, ";
        $conn->sql.= "TO_CHAR(dtmcierre, 'HH:MI:SS') as hora_cierre, id_contacto, ";
        $conn->sql.= "(SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= id_contacto) AS nombre_contacto, ";
        $conn->sql.= "bolborrado FROM tblactividades WHERE bolborrado= 0";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectActividadById($id_actividad) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT	id_actividad, id_destinatarios, strdescripcion, ";
        $conn->sql.= "id_prioridad_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_prioridad_maestro) AS nombre_prioridad_maestro, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
        $conn->sql.= "memtitulo, TO_CHAR(dtmresolucion, 'DD/MM/YYYY') as fecha_resolucion, ";
        $conn->sql.= "TO_CHAR(dtmresolucion, 'HH:MI:SS') as hora_resolucion, TO_CHAR(dtmcierre, 'DD/MM/YYYY') as fecha_cierre, ";
        $conn->sql.= "TO_CHAR(dtmcierre, 'HH:MI:SS') as hora_cierre, id_contacto, ";
        $conn->sql.= "(SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tblactividades.id_contacto) AS nombre_contacto, ";
        $conn->sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tblactividades WHERE id_actividad= ".$id_actividad." AND bolborrado= 0";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectActividadByIdDestinatario($id_destinatarios) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT	id_actividad, id_destinatarios, strdescripcion, ";
        $conn->sql.= "id_prioridad_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_prioridad_maestro) AS nombre_prioridad_maestro, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
        $conn->sql.= " memtitulo, TO_CHAR(dtmresolucion, 'DD/MM/YYYY') as fecha_resolucion, ";
        $conn->sql.= "TO_CHAR(dtmresolucion, 'HH:MI:SS') as hora_resolucion, TO_CHAR(dtmcierre, 'DD/MM/YYYY') as fecha_cierre, ";
        $conn->sql.= "TO_CHAR(dtmcierre, 'HH:MI:SS') as hora_cierre, id_contacto, ";
        $conn->sql.= "(SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tblactividades.id_contacto) AS nombre_contacto, ";
        $conn->sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tblactividades WHERE id_destinatarios= ".$id_destinatarios." AND bolborrado= 0 ORDER BY id_actividad";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectActividadAsignada($id_departamento_maestro, $id_estatus_maestro= "") {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT	id_actividad, id_destinatarios, strdescripcion, ";
        $conn->sql.= "id_prioridad_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_prioridad_maestro) AS nombre_prioridad_maestro, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
        $conn->sql.= "memtitulo, TO_CHAR(dtmresolucion, 'DD/MM/YYYY') as fecha_resolucion, ";
        $conn->sql.= "TO_CHAR(dtmresolucion, 'HH:MI:SS') as hora_resolucion, TO_CHAR(dtmcierre, 'DD/MM/YYYY') as fecha_cierre, ";
        $conn->sql.= "TO_CHAR(dtmcierre, 'HH:MI:SS') as hora_cierre, id_contacto, ";
        $conn->sql.= "(SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tblactividades.id_contacto) AS nombre_contacto, ";
        $conn->sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tblactividades WHERE ";
        $conn->sql.= "id_actividad IN (SELECT id_actividad FROM tbldepartamentoactividad WHERE bolborrado= 0 ";
            $conn->sql.= "AND (id_departamento_maestro= ".$id_departamento_maestro." OR id_departamento_maestro IN ";
            $conn->sql.= "(SELECT id_maestro FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_origen= ".$id_departamento_maestro."))) AND bolborrado= 0 ";
        if($id_estatus_maestro != ""){
            $conn->sql.= "AND id_estatus_maestro != ".$id_estatus_maestro;
        }
        $conn->sql.= "ORDER BY dtmresolucion DESC";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function updateActividadEstatus() {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE tblactividades SET id_estatus_maestro= ".$this->getId_estatus_maestro()." WHERE id_actividad= ".$this->getId_actividad();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function updateActividadCerrar() {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE tblactividades SET id_estatus_maestro= ".$this->getId_estatus_maestro().", dtmcierre= now() ";
        $conn->sql.= "WHERE id_actividad= ".$this->getId_actividad();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function verIdActividad(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT CURRVAL('".clConstantesModelo::correspondencia_table."tblactividades_id_actividad_seq') as id_actividad";
        $data= $conn->ejecutarSentencia(2);
        return $data;
    }

    public function selectAllReporteActividad($id_departamento_maestro= null, $id_estatus_maestro= null, $fechaD= null, $fechaH= null, $asignadoCondicion= null, $asignado= null, $analistaCondicion= null, $analista= null, $tituloCondicion= null, $titulo= nulll){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT	a.id_actividad, ";
        $conn->sql.= "(SELECT c.strcorrelativo FROM tblcorrespondencias c WHERE c.id_corresp= ";
        $conn->sql.= "(SELECT d.id_corresp FROM tbldestinatarios d WHERE d.id_destinatarios= a.id_destinatarios)) AS correlativo, ";
        $conn->sql.= "(SELECT m.stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros m WHERE m.id_maestro= a.id_estatus_maestro) AS estatus, ";
        $conn->sql.= "a.memtitulo, TO_CHAR(a.dtmresolucion, 'DD/MM/YYYY') as fecha_resolucion, ";
        $conn->sql.= "(SELECT c.strnombre||' '||c.strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto c WHERE c.id_contacto= a.id_contacto) AS creador ";
        $conn->sql.= "FROM ".clConstantesModelo::correspondencia_table."tblactividades a WHERE a.bolborrado= 0 ";
        if($id_departamento_maestro != null){
            $conn->sql.= "AND a.id_actividad IN (SELECT da.id_actividad FROM tbldepartamentoactividad da ";
            $conn->sql.= "WHERE da.id_departamento_maestro IN(".$id_departamento_maestro.") AND da.bolborrado= 0) ";
        }
        if($id_estatus_maestro != null){
            if($id_estatus_maestro != 265){
                $conn->sql.= "AND a.id_estatus_maestro= ".$id_estatus_maestro." ";
            }
            if($id_estatus_maestro == 249 || $id_estatus_maestro == 251 || $id_estatus_maestro == 253 || $id_estatus_maestro ==265){
                $conn->sql.= "AND a.id_actividad IN (SELECT ca.id_actividad FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad ca ";
                $conn->sql.= "WHERE ca.id_estatus_maestro= ".$id_estatus_maestro." AND ca.bolborrado= 0) ";
            }
        }
        if($fechaD != null && $fechaH != null){
            $conn->sql.= "AND a.dtmresolucion BETWEEN TO_DATE('".$fechaD."', 'DD/MM/YYYY') AND TO_DATE('".$fechaH."', 'DD/MM/YYYY') ";
        }
        if($asignadoCondicion != null){
            $conn->sql.= "AND a.id_actividad";
            if($asignadoCondicion == 1){
                $conn->sql.= " IN (SELECT ca.id_actividad FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad ca WHERE id_contacto_asigna ";
                $conn->sql.= "IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE strnombre LIKE '".$asignado."%' or strapellido LIKE '".$asignado."%')) ";
            }else if($asignadoCondicion == 2){
                $conn->sql.= " IN (SELECT ca.id_actividad FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad ca WHERE id_contacto_asigna ";
                $conn->sql.= " IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE strnombre= '".$asignado."' or strapellido= '".$asignado."')) ";
            }else if($asignadoCondicion == 3){
                $conn->sql.= " IN (SELECT ca.id_actividad FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad ca WHERE id_contacto_asigna ";
                $conn->sql.= " NOT IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE strnombre LIKE '%".$asignado."%' or strapellido LIKE '%".$asignado."%')) ";
            }else if($asignadoCondicion == 4){
                $conn->sql.= " IN (SELECT ca.id_actividad FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad ca WHERE id_contacto_asigna ";
                $conn->sql.= " IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE strnombre LIKE '%".$asignado."%' or strapellido LIKE '%".$asignado."%')) ";
            }
        }
        if($analistaCondicion != null){
            $conn->sql.= "AND a.id_actividad";
            if($analistaCondicion == 1){
                $conn->sql.= " IN (SELECT ca.id_actividad FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad ca WHERE id_contacto ";
                $conn->sql.= "IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE strnombre LIKE '".$analista."%' or strapellido LIKE '".$analista."%')) ";
            }else if($analistaCondicion == 2){
                $conn->sql.= " IN (SELECT ca.id_actividad FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad ca WHERE id_contacto ";
                $conn->sql.= " IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE strnombre= '".$analista."' or strapellido= '".$analista."')) ";
            }else if($analistaCondicion == 3){
                $conn->sql.= " IN (SELECT ca.id_actividad FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad ca WHERE id_contacto ";
                $conn->sql.= " NOT IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE strnombre LIKE '%".$analista."%' or strapellido LIKE '%".$analista."%')) ";
            }else if($analistaCondicion == 4){
                $conn->sql.= " IN (SELECT ca.id_actividad FROM ".clConstantesModelo::seguridad_table."tblcontactoactividad ca WHERE id_contacto ";
                $conn->sql.= " IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE strnombre LIKE '%".$analista."%' or strapellido LIKE '%".$analista."%')) ";
            }
        }
        if($tituloCondicion != null){
            $conn->sql.= "AND a.memtitulo";
            if($tituloCondicion == 1){
                $conn->sql.= " LIKE '".$titulo."%' ";
            }else if($tituloCondicion == 2){
                $conn->sql.= " = '".$titulo."' ";
            }else if($tituloCondicion == 3){
                $conn->sql.= " != '".$titulo."' ";
            }else if($tituloCondicion == 4){
                $conn->sql.= " LIKE '%".$titulo."%' ";
            }
        }
        //echo $conn->sql;
        $data= $conn->ejecutarSentencia(2);
        return $data;
    }
}
?>
