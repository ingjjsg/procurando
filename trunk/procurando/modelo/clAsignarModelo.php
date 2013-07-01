<?php
    require_once '../controlador/Conexion.php';
    require_once 'clConstantesModelo.php';

/**
 * Description of clAsignarModelo
 *
 * @author jhuidobro
 */
class clAsignarModelo {
    private $id_accesoforma;
    private $id_profile_maestro;
    private $id_menu_maestro;
    private $stracciones;
    private $bolborrado;

    public function __construct() {

    }

    public function llenar($request) {
        if($request['id_accesoforma'] != ""){
            $this->id_accesoforma= $request['id_accesoforma'];
        }
        if($request['id_profile_maestro'] != ""){
            $this->id_profile_maestro= $request['id_profile_maestro'];
        }else{
            $this->id_profile_maestro= 'null';
        }
        if($request['id_menu_maestro'] != ""){
            $this->id_menu_maestro= $request['id_menu_maestro'];
        }else{
            $this->id_menu_maestro= 'null';
        }
        if($request['stracciones'] != ""){
            $this->stracciones= $request['stracciones'];
        }
        if($request['bolborrado'] != ""){
            $this->bolborrado= $request['bolborrado'];
        }
    }

    public function getId_accesoforma(){
        return $this->id_accesoforma;
    }
    public function setId_accesoforma($id_accesoforma){
        $this->id_accesoforma= $id_accesoforma;
    }
    public function getId_profile_maestro(){
        return $this->id_profile_maestro;
    }
    public function setId_profile_maestro($id_profile_maestro){
        $this->id_profile_maestro= $id_profile_maestro;
    }
    public function getId_menu_maestro(){
        return $this->id_menu_maestro;
    }
    public function setId_menu_maestro($id_menu_maestro){
        $this->id_menu_maestro= $id_menu_maestro;
    }
    public function getStracciones(){
        return $this->stracciones;
    }
    public function setStracciones($stracciones){
        $this->stracciones= $stracciones;
    }
    public function getBolborrado(){
        return $this->bolborrado;
    }
    public function setBolborrado($bolborrado){
        $this->bolborrado= $bolborrado;
    }

    public function insertAsignar(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::seguridad_table."tblaccesoforma (id_profile_maestro, id_menu_maestro, stracciones, bolborrado) VALUES ";
        $conn->sql.= "(".$this->getId_profile_maestro().", ".$this->getId_menu_maestro().", '".$this->getStracciones()."',0)";
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
     public function updateAsignar(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::seguridad_table."tblaccesoforma SET stracciones= '".$this->getStracciones()."' ";
        $conn->sql.= "WHERE id_accesoforma= ".$this->getId_accesoforma()." AND id_profile_maestro= ".$this->getId_profile_maestro();
        $conn->sql.= " AND id_menu_maestro= ".$this->getId_menu_maestro();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function deleteAsignar($id_accesoforma){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::seguridad_table."tblaccesoforma SET bolborrado= 1 WHERE id_accesoforma=".$id_accesoforma;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function selectAsignar($id_profile_maestro, $id_menu_maestro){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT * FROM ".clConstantesModelo::seguridad_table."tblaccesoforma WHERE id_profile_maestro= ".$id_profile_maestro." AND id_menu_maestro= ".$id_menu_maestro;
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
    public function selectAsignarByProfile($id_profile_maestro, $id_menu_maestro="", $stracciones= ""){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_accesoforma, id_profile_maestro,	";
        $conn->sql.= "(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_profile_maestro) AS nombre_perfil, ";
        $conn->sql.= "id_menu_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_menu_maestro)AS nombre_form, stracciones ";
        $conn->sql.= "FROM ".clConstantesModelo::seguridad_table."tblaccesoforma WHERE id_profile_maestro= ".$id_profile_maestro." AND bolborrado= 0 ";
        if($id_menu_maestro != ""){
            $conn->sql.= "AND id_menu_maestro= ".$id_menu_maestro." ";
        }
        if($stracciones != ""){
            $conn->sql.= "AND stracciones LIKE '%".$stracciones."%' ";
        }
        $conn->sql.= "ORDER BY id_menu_maestro";
        //exit("SQL: ".$conn->sql);
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
}
?>
