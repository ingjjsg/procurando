<?php

    require_once '../controlador/Conexion.php';
    require_once 'clConstantesModelo.php';

/**
 * Description of clAutorizadoModelo
 *
 * @author jhuidobro
 */
class clAutorizadoModelo {
    private $id_autorizados_est;
    private $id_estados;
    private $id_perfil_maestro;
    private $bolborrado;

    public function __construct() {

    }

    public function llenar($request) {
        if($request['id_autorizados_est'] != ""){
            $this->id_autorizados_est= $request['id_autorizados_est'];
        }
        if($request['id_estados'] != ""){
            $this->id_estados= $request['id_estados'];
        }
        if($request['id_perfil_maestro'] != ""){
            $this->id_perfil_maestro= $request['id_perfil_maestro'];
        }
        if($request['bolborrado'] != ""){
            $this->bolborrado= $request['bolborrado'];
        }
    }

    public function getId_autorizados_est(){
        return $this->id_autorizados_est;
    }
    public function setId_autorizados_est($id_autorizados_est){
        $this->id_autorizados_est= $id_autorizados_est;
    }
    public function getId_estados(){
        return $this->id_estados;
    }
    public function setId_estados($id_estados){
        $this->id_estados= $id_estados;
    }
    public function getId_perfil_maestro(){
        return $this->id_perfil_maestro;
    }
    public function setId_perfil_maestro($id_perfil_maestro){
        $this->id_perfil_maestro= $id_perfil_maestro;
    }
    public function getBolborrado(){
        return $this->bolborrado;
    }
    public function setBolborrado($bolborrado){
        $this->bolborrado= $bolborrado;
    }

    public function insertAutorizado(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::seguridad_table."tblautorizado_est (id_estados, id_perfil_maestro) VALUES ";
        $conn->sql.= "(".$this->getId_estados().", ".$this->getId_perfil_maestro().")";
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function updateAutorizado(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::seguridad_table."tblautorizado_est SET id_estados= ".$this->getId_estados().", id_perfil_maestro= ".$this->getId_perfil_maestro();
        $conn->sql.= " WHERE id_autorizados_est= ".$this->getId_autorizados_est();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function deleteAutorizado($modelo_estados){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "DELETE FROM ".clConstantesModelo::seguridad_table."tblautorizado_est WHERE id_perfil_maestro= ".$this->getId_perfil_maestro()." ";
        $conn->sql.= "AND id_estados IN (SELECT id_estados FROM ".clConstantesModelo::correspondencia_table."tblestados WHERE id_meestados_maestros= ".$modelo_estados.")";
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectAllAutorizadoById_perfil($id_perfil_maestro){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT	id_autorizados_est, id_estados, id_perfil_maestro, bolborrado FROM ".clConstantesModelo::seguridad_table."tblautorizado_est ";
        $conn->sql.= "WHERE id_perfil_maestro= ".$id_perfil_maestro." AND bolborrado= 0";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectAllAutorizadoByIdPerfilLngnumero($id_perfil_maestro, $lngnumero, $id_estinicial_maestro=""){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_estados, id_meestados_maestros, stritema, lngnumero as estructura, id_estinicial_maestro, id_estfinal_maestro, bolactivo ";
        $conn->sql.= "FROM tblestados, ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_estados IN (SELECT id_estados FROM ".clConstantesModelo::seguridad_table."tblautorizado_est WHERE id_perfil_maestro= ".$id_perfil_maestro." AND bolborrado= 0) ";
        $conn->sql.= "AND id_maestro= id_meestados_maestros AND	lngnumero= ".$lngnumero." AND tblestados.bolborrado= 0 ";
        if($id_estinicial_maestro != ""){
            $conn->sql.= "AND id_estinicial_maestro= ".$id_estinicial_maestro." AND id_estfinal_maestro != 197;";
        }
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        //echo $conn->sql;
        return $retorno;
    }
}
?>
