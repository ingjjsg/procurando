<?php
    require_once '../controlador/Conexion.php';
    require_once '../modelo/clConstantesModelo.php';

/**
 * Description of clRutaCorrespondenciaModelo
 *
 * @author Juan
 */
class clRutaCorrespondenciaModelo {

    public function insertRutaCorrespondencia($id_corresp, $id_estatus_maestro, $memrutacorresp, $id_contacto) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tblrutacorresp (id_corresp, dtmrutacorresp, id_estatus_maestro, memrutacorresp, id_contacto) VALUES ";
        $conn->sql.= "(".$id_corresp.", now(), ".$id_estatus_maestro.", '".$memrutacorresp."', ".$id_contacto.")";
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    
    public function selectRutaCorrespondenciaByIdCorresp($id_corresp){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT	id_rutacorresp, id_corresp, ";
        $conn->sql.= "(SELECT strcorrelativo FROM tblcorrespondencias WHERE id_corresp= rc.id_corresp) AS strcorrelativo, ";
        $conn->sql.= "TO_CHAR(dtmrutacorresp, 'DD/MM/YYYY') AS fecha_ruta, TO_CHAR(dtmrutacorresp, 'HH:MI:SS am') AS hora_ruta, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
        $conn->sql.= "memrutacorresp, id_contacto, ";
        $conn->sql.= "(SELECT strnombre||' '||strapellido||' ('||strlogin||')' FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= rc.id_contacto) AS nombre_contacto, ";
        $conn->sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tblrutacorresp rc WHERE rc.id_corresp= ".$id_corresp." AND bolborrado= 0 ORDER BY id_rutacorresp";
        //exit("SQL: ".$conn->sql);
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
}
?>
