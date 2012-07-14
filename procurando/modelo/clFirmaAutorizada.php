<?php
    require_once '../controlador/Conexion.php';
    require_once 'clConstantesModelo.php';


/**
 * Description of clFirmaAutorizada
 *
 * @author jhuidobro
 */
class clFirmaAutorizada {
    private $id_firma;
    private $id_corresp;
    private $id_contacto;
    private $bolborrado;

    public function __construct() {

    }

    public function llenar($request) {
        if($request['id_firma'] != ""){
            $this->id_firma= $request['id_firma'];
        }
        if($request['id_corresp'] != ""){
            $this->id_corresp= $request['id_corresp'];
        }
        if($request['id_contacto'] != ""){
            $this->id_contacto= $request['id_contacto'];
        }
        if($request['bolborrado'] != ""){
            $this->bolborrado= $request['bolborrado'];
        }
    }

    public function getId_firma(){
        return $this->id_firma;
    }
    public function setId_firma($id_firma){
        $this->id_firma= $id_firma;
    }
    public function getId_corresp(){
        return $this->id_corresp;
    }
    public function setId_corresp($id_corresp){
        $this->id_corresp= $id_corresp;
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

    public function insertFirmaAutorizada(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tblfirmaautorizada (id_corresp, id_contacto) VALUES ";
        $conn->sql.= "(".$this->getId_corresp().", ".$this->getId_contacto().")";
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectFirmaAutorizaByIdCorresp($id_corresp){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "";
        $conn->sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."tblfirmaautorizada WHERE id_corresp= ".$id_corresp." AND bolborrado= 0";
        //exit("SQL: ".$conn->sql);
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }

}
?>
