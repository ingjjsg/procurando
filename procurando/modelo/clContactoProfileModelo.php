<?php
    require_once '../controlador/Conexion.php';
    require_once 'clConstantesModelo.php';

/**
 * Description of clContactoProfile
 *
 * @author jhuidobro
 */
class clContactoProfileModelo {
   

    public function insertContactoProfile($id_contacto, $id_profile_maestro){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        $conn->sql= "INSERT INTO ".clConstantesModelo::seguridad_table."tblcontactoprofile (id_contacto, id_profile_maestro) VALUES ";
        $conn->sql.= "(".$id_contacto.", ".$id_profile_maestro.")";
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function updateContactoProfile($id_contacto, $id_profile_maestro){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        $conn->sql= "UPDATE ".clConstantesModelo::seguridad_table."tblcontactoprofile SET id_profile_maestro= ".$id_profile_maestro;
        $conn->sql.= " WHERE id_contacto=".$id_contacto;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function deleteContactoProfile($id_contacto){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        $conn->sql= "UPDATE ".clConstantesModelo::seguridad_table."tblcontactoprofile SET bolborrado= 1 WHERE id_contacto=".$id_contacto;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function selectContactoProfileByIdContacto($id_contacto){
        $sql= "";
        $sql.= "SELECT id_contactoprofile, id_contacto, ";
        $sql.= "id_profile_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_profile_maestro) AS nombre_perfil, ";
        $sql.= "bolborrado FROM ".clConstantesModelo::seguridad_table."tblcontactoprofile WHERE id_contacto= ".$id_contacto." AND bolborrado= 0";
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql=$sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }
}
?>
