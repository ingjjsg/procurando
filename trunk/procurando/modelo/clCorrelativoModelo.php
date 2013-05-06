<?php

    require_once '../controlador/Conexion.php';

/**
 * Description of clCorrelativoModelo
 *
 * @author jhuidobro
 */
class clCorrelativoModelo {
    private $id_correlativo;
    private $id_gerencia_maestro;
    private $id_coord_maestro;
    private $lnganio;
    private $id_tipo_maestro;
    private $lnginicio;
    private $bolborrado;

    public function __construct() {

    }

    public function llenar($request) {
        if($request['id_correlativo'] != ""){
            $this->id_correlativo= $request['id_correlativo'];
        }
        if($request['id_gerencia_maestro'] != ""){
            $this->id_gerencia_maestro= $request['id_gerencia_maestro'];
        }
        if($request['id_coord_maestro'] != ""){
            $this->id_coord_maestro= $request['id_coord_maestro'];
        }else{
            $this->id_coord_maestro= 'null';
        }
        if($request['lnganio'] != ""){
            $this->lnganio= $request['lnganio'];
        }
        if($request['id_tipo_maestro'] != ""){
            $this->id_tipo_maestro= $request['id_tipo_maestro'];
        }
        if($request['lnginicio'] != ""){
            $this->lnginicio= $request['lnginicio'];
        }else{
            $this->lnginicio= 'null';
        }
        if($request['bolborrado'] != ""){
            $this->bolborrado= $request['bolborrado'];
        }
    }

    public function getId_correlativo(){
        return $this->id_correlativo;
    }
    public function setId_correlativo($id_correlativo){
        $this->id_correlativo= $id_correlativo;
    }
    public function getId_gerencia_maestro(){
        return $this->id_gerencia_maestro;
    }
    public function setId_gerencia_maestro($id_gerencia_maestro){
        $this->id_gerencia_maestro= $id_gerencia_maestro;
    }
    public function getId_coord_maestro(){
        return $this->id_coord_maestro;
    }
    public function setId_coord_maestro($id_coord_maestro){
        $this->id_coord_maestro= $id_coord_maestro;
    }
    public function getLnganio(){
        return $this->lnganio;
    }
    public function setLnganio($lnganio){
        $this->lnganio= $lnganio;
    }
    public function getId_tipo_maestro(){
        return $this->id_tipo_maestro;
    }
    public function setId_tipo_maestro($id_tipo_maestro){
        $this->id_tipo_maestro= $id_tipo_maestro;
    }
    public function getLnginicio(){
        return $this->lnginicio;
    }
    public function setLnginicio($lnginicio){
        $this->lnginicio= $lnginicio;
    }
    public function getBolborrado(){
        return $this->bolborrado;
    }
    public function setBolborrado($bolborrado){
        $this->bolborrado= $bolborrado;
    }

    public function insertCorrelativo(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO tblcorrelativo (id_gerencia_maestro, id_coord_maestro, lnganio, id_tipo_maestro, lnginicio) VALUES ";
        $conn->sql.= "(".$this->getId_gerencia_maestro().", ".$this->getId_coord_maestro().", ".$this->getLnganio().", ".$this->getId_tipo_maestro().", ";
        $conn->sql.= $this->getLnginicio().")";
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function updateCorrelativo(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tblcorrelativo SET id_gerencia_maestro= ".$this->getId_gerencia_maestro().", id_coord_maestro= ".$this->getId_coord_maestro().", ";
        $conn->sql.= "lnganio= ".$this->getLnganio().", id_tipo_maestro= ".$this->getId_tipo_maestro().", lnginicio= ".$this->getLnginicio()." ";
        $conn->sql.= "WHERE id_correlativo= ".$this->getId_correlativo();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function updateCorrelativoNumero($id_correlativo, $lnginicio){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tblcorrelativo SET lnginicio= ".$lnginicio." WHERE id_correlativo=".$id_correlativo;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function deleteCorrelativo($id_correlativo){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tblcorrelativo SET bolborrado= 1 WHERE id_correlativo=".$id_correlativo;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function selectAllCorrelativo($campo, $id_gerencia_maestro= null){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_correlativo,	";
        $conn->sql.= "id_gerencia_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_gerencia_maestro) AS nombre_gerencia_maestro,";
        $conn->sql.= "id_coord_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_coord_maestro) AS nombre_coord_maestro,";
        $conn->sql.= "lnganio, ";
        $conn->sql.= "id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo_maestro,";
        $conn->sql.= "lnginicio ";
        $conn->sql.= "FROM ".clConstantesModelo::correspondencia_table."tblcorrelativo WHERE bolborrado= 0 ";
        if($id_gerencia_maestro != null){
            $conn->sql.= "AND id_gerencia_maestro= ".$id_gerencia_maestro;
        }
        $conn->sql.= "ORDER BY ".$campo." ".$_SESSION["AD"];
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }
    public function selectCorrelativoById($id_correlativo){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."tblcorrelativo WHERE id_correlativo= ".$id_correlativo." AND bolborrado= 0";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }
    public function selectCorrelativoByGerencia($id_gerencia_maestro, $id_tipo_maestro,$idCoord){
        $conn= new Conexion();
        $conn->abrirConexion();
        $anoa = date('Y');
        $conn->sql= "SELECT id_correlativo, lnganio, lnginicio FROM ".clConstantesModelo::correspondencia_table."tblcorrelativo WHERE id_gerencia_maestro= ".$id_gerencia_maestro." AND id_coord_maestro= ".$idCoord." ";
        $conn->sql.= "AND id_tipo_maestro= ".$id_tipo_maestro." and lnganio =".$anoa." AND bolborrado= 0";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        //echo $conn->sql;
        //exit("SQL: ".$conn->sql);
        return $data;
    }
    public function selectCorrelativoByCoordinacion($id_gerencia_maestro, $id_coord_maestro, $id_tipo_maestro){
        $conn= new Conexion();
        $conn->abrirConexion();
        $anoa = date('Y');
        $conn->sql= "SELECT id_correlativo, lnganio, lnginicio FROM ".clConstantesModelo::correspondencia_table."tblcorrelativo WHERE id_gerencia_maestro= ".$id_gerencia_maestro." ";
        $conn->sql.= "AND id_coord_maestro= ".$id_coord_maestro." AND id_tipo_maestro= ".$id_tipo_maestro." and lnganio =".$anoa." AND bolborrado= 0";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }


    public function verificarIngreso($id_correlativo= ""){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT COUNT(*) FROM ".clConstantesModelo::correspondencia_table."tblcorrelativo WHERE id_gerencia_maestro= ".$this->getId_gerencia_maestro();
        $conn->sql.= " AND id_coord_maestro= ".$this->getId_coord_maestro()." AND id_tipo_maestro= ".$this->getId_tipo_maestro();
        $conn->sql.= " AND lnganio= ".$this->getLnganio()." AND bolborrado= 0";
        if($id_correlativo != ""){
            $conn->sql.= " AND id_correlativo != ".$id_correlativo;
        }
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }

    public function verificarCorrelativo($id_tipocorresp_maestro, $id_maestro, $numero, $anio){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT COUNT(*) FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias WHERE id_tipocorresp_maestro= ".$id_tipocorresp_maestro." ";
        $conn->sql.= "AND strcorrelativo LIKE (SELECT stritemb FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= ".$id_maestro.") || '/".$numero."/".$anio."';";
        //echo $conn->sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }
}
?>
