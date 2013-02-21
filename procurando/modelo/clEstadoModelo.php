<?php

    require_once '../controlador/Conexion.php';

/**
 * Description of clEstadoModelo
 *
 * @author jsuarez
 */
class clEstadoModelo {
    private $id_estados;
    private $id_meestados_maestros;
    private $id_estinicial_maestro;
    private $id_estfinal_maestro;
    private $bolactivo;
    private $bolborrado;

    public function __construct() {

    }

    public function llenar($request) {
        if($request['id_estados'] != ""){
            $this->id_estados= $request['id_estados'];
        }
        if($request['id_meestados_maestros'] != ""){
            $this->id_meestados_maestros= $request['id_meestados_maestros'];
        }
        if($request['id_estinicial_maestro'] != ""){
            $this->id_estinicial_maestro= $request['id_estinicial_maestro'];
        }
        if($request['id_estfinal_maestro'] != ""){
            $this->id_estfinal_maestro= $request['id_estfinal_maestro'];
        }
        if($request['bolactivo'] != ""){
            $this->bolactivo= $request['bolactivo'];
        }else{
            $this->bolactivo= 1;
        }
        if($request['bolborrado'] != ""){
            $this->bolborrado= $request['bolborrado'];
        }
    }

    public function getId_estados(){
        return $this->id_estados;
    }
    public function setId_estados($id_estados){
        $this->id_estados= $id_estados;
    }
    public function getId_meestados_maestros(){
        return $this->id_meestados_maestros;
    }
    public function setId_meestados_maestros($id_meestados_maestros){
        $this->id_meestados_maestros= $id_meestados_maestros;
    }
    public function getId_estinicial_maestro(){
        return $this->id_estinicial_maestro;
    }
    public function setId_estinicial_maestro($id_estinicial_maestro){
        $this->id_estinicial_maestro= $id_estinicial_maestro;
    }
    public function getId_estfinal_maestro(){
        return $this->id_estfinal_maestro;
    }
    public function setId_estfinal_maestro($id_estfinal_maestro){
        $this->id_estfinal_maestro= $id_estfinal_maestro;
    }
    public function getBolactivo(){
        return $this->bolactivo;
    }
    public function setBolactivo($bolactivo){
        $this->bolactivo= $bolactivo;
    }
    public function getBolborrado(){
        return $this->bolborrado;
    }
    public function setBolborrado($bolborrado){
        $this->bolborrado= $bolborrado;
    }

    public function insertEstados(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tblestados (id_meestados_maestros, id_estinicial_maestro, id_estfinal_maestro, bolactivo) VALUES ";
        $conn->sql.= "(".$this->getId_meestados_maestros().", ".$this->getId_estinicial_maestro().", ".$this->getId_estfinal_maestro().", ";
        $conn->sql.= $this->getBolactivo().")";
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function updateEstados(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tblestados SET id_meestados_maestros= ".$this->getId_meestados_maestros().", ";
        $conn->sql.="id_estinicial_maestro= ".$this->getId_estinicial_maestro().", id_estfinal_maestro= ".$this->getId_estfinal_maestro().", ";
        $conn->sql.="bolactivo= ".$this->getBolactivo()." WHERE id_estados= ".$this->getId_estados();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function deleteEstados($id_estados){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tblestados SET bolborrado= 1 WHERE id_estados= ".$id_estados;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectAllEstadosByMeestados($id_meestados_maestros){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_estados,	id_meestados_maestros, ";
        $conn->sql.= "(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_meestados_maestros) AS nombre_meestados_maestros, ";
        $conn->sql.= "id_estinicial_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estinicial_maestro) AS nombre_estinicial_maestro,";
        $conn->sql.= "id_estfinal_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estfinal_maestro) AS nombre_estfinal_maestro, ";
        $conn->sql.= "bolactivo FROM ".clConstantesModelo::correspondencia_table."tblestados WHERE id_meestados_maestros= ".$id_meestados_maestros." AND bolborrado= 0 ORDER BY id_estados";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectAllEstadosById($id_estados, $id_estinicial_maestro){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_estados,	id_meestados_maestros, ";
        $conn->sql.= "(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_meestados_maestros) AS nombre_meestados_maestros, ";
        $conn->sql.= "id_estinicial_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estinicial_maestro) AS nombre_estinicial_maestro,";
        $conn->sql.= "id_estfinal_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estfinal_maestro) AS nombre_estfinal_maestro, ";
        $conn->sql.= "bolactivo FROM ".clConstantesModelo::correspondencia_table."tblestados WHERE id_estados= ".$id_estados." AND id_estinicial_maestro= ".$id_estinicial_maestro." ";
        $conn->sql.= "AND bolborrado= 0 AND bolactivo= 0 ORDER BY id_estfinal_maestro";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectAllEstadosByIdEstados($id_estados){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_estados,	id_meestados_maestros, ";
        $conn->sql.= "(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_meestados_maestros) AS nombre_meestados_maestros, ";
        $conn->sql.= "id_estinicial_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estinicial_maestro) AS nombre_estinicial_maestro,";
        $conn->sql.= "id_estfinal_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estfinal_maestro) AS nombre_estfinal_maestro, ";
        $conn->sql.= "bolactivo FROM ".clConstantesModelo::correspondencia_table."tblestados WHERE id_estados= ".$id_estados." ";
        $conn->sql.= "AND bolborrado= 0 AND bolactivo= 0 ORDER BY id_estfinal_maestro";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
}
?>
