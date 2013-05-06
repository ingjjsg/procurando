<?php

    require_once '../controlador/Conexion.php';
    
/**
 * Description of clDestinatariosModelo
 *
 * @author jhuidobro
 */
class clDestinatariosModelo {
   private $id_destinatarios;
   private $id_destino_maestro;
   private $id_corresp;
   private $id_estatus_maestro;
   private $bolborrado;
   private $id_tipoenvio_maestro;
   
   public function __construct() {

    }

    public function llenar($request) {
        if($request['id_destinatarios'] != ""){
            $this->id_destinatarios= $request['id_destinatarios'];
        }
        if($request['id_destino_maestro'] != ""){
            $this->id_destino_maestro= $request['id_destino_maestro'];
        }
        if($request['id_corresp'] != ""){
            $this->id_corresp= $request['id_corresp'];
        }
        if($request['id_estatus_maestro'] != ""){
            $this->id_estatus_maestro= $request['id_estatus_maestro'];
        }
        if($request['bolborrado'] != ""){
            $this->bolborrado= $request['bolborrado'];
        }
        if($request['id_tipoenvio_maestro'] != ""){
            $this->id_tipoenvio_maestro= $request['id_tipoenvio_maestro'];
        }
    }

    public function getId_destinatarios(){
        return $this->id_destinatarios;
    }
    public function setId_destinatarios($id_destinatarios){
        $this->id_destinatarios= $id_destinatarios;
    }
    public function getId_destino_maestro(){
        return $this->id_destino_maestro;
    }
    public function setId_destino_maestro($id_destino_maestro){
        $this->id_destino_maestro= $id_destino_maestro;
    }
    public function getId_corresp(){
        return $this->id_corresp;
    }
    public function setId_corresp($id_corresp){
        $this->id_corresp= $id_corresp;
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
    public function getId_tipoenvio_maestro(){
        return $this->id_tipoenvio_maestro;
    }
    public function setId_tipoenvio_maestro($id_tipoenvio_maestro){
        $this->id_tipoenvio_maestro= $id_tipoenvio_maestro;
    }

    public function insertDestinatarios(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tbldestinatarios (id_destino_maestro, id_corresp, id_estatus_maestro, id_tipoenvio_maestro) ";
        $conn->sql.= "VALUES (".$this->getId_destino_maestro().", ".$this->getId_corresp().",  ".$this->getId_estatus_maestro().", ".$this->getId_tipoenvio_maestro().")";
        //exit($conn->sql);
        $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectAllDestinatariosById($id_destinatarios){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_destinatarios, id_destino_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_destino_maestro) AS destinatario, ";
        $conn->sql.= "id_corresp, id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS estatus, ";
        $conn->sql.= "id_tipoenvio_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipoenvio_maestro) AS nombre_tipoenvio_maestro ";
        $conn->sql.= "FROM ".clConstantesModelo::correspondencia_table."tbldestinatarios WHERE id_destinatarios= ".$id_destinatarios." ORDER BY id_tipoenvio_maestro";
        //exit("SQL: ".$conn->sql);
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }

    public function selectAllDestinatariosByIdCorresp($id_corresp, $id_estatus_maestro= "", $id_destino_maetro= ""){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_destinatarios, id_destino_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_destino_maestro) AS destinatario, ";
        $conn->sql.= "(SELECT stritemb FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_destino_maestro) AS abreviacion_destinatario,";
        $conn->sql.= "(SELECT id_origen FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_destino_maestro) AS id_origen_destinatario, ";
        $conn->sql.= "id_corresp, id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS estatus, ";
        $conn->sql.= "id_tipoenvio_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipoenvio_maestro) AS nombre_tipoenvio_maestro ";
        $conn->sql.= "FROM ".clConstantesModelo::correspondencia_table."tbldestinatarios WHERE id_corresp= ".$id_corresp." ";
        if($id_estatus_maestro != ""){
            $conn->sql.= "AND id_estatus_maestro= ".$id_estatus_maestro." ";
        }
        if($id_destino_maetro != ""){
            $conn->sql.= "AND id_destino_maestro= ".$id_destino_maetro." ";
        }
        $conn->sql.= "ORDER BY id_tipoenvio_maestro";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }


    public function selectAllDestinatariosExternoByIdCorresp($id_corresp){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_destinatarios, id_destino_maestro, ";
        $conn->sql.= "(SELECT strtrato FROM ".clConstantesModelo::seguridad_table."tblcontactoexterno WHERE id_contacto_externo= id_destino_maestro) AS trato_destinatario, ";
        $conn->sql.= "(SELECT strcontactoext FROM ".clConstantesModelo::seguridad_table."tblcontactoexterno WHERE id_contacto_externo= id_destino_maestro) AS nombre_destinatario, ";
        $conn->sql.= "(SELECT strinstitucion FROM ".clConstantesModelo::seguridad_table."tblcontactoexterno WHERE id_contacto_externo= id_destino_maestro) AS institucion_destinatario, ";
        $conn->sql.= "(SELECT strcargo FROM ".clConstantesModelo::seguridad_table."tblcontactoexterno WHERE id_contacto_externo= id_destino_maestro) AS cargo_destinatario,  ";
        $conn->sql.= "id_corresp, id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS estatus, ";
        $conn->sql.= "id_tipoenvio_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipoenvio_maestro) AS nombre_tipoenvio_maestro ";
        $conn->sql.= "FROM ".clConstantesModelo::correspondencia_table."tbldestinatarios WHERE id_corresp= ".$id_corresp." ORDER BY id_tipoenvio_maestro";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;
    }

    public function selectAllDestinatariosByIdDestino($id_destino_maestro, $pagina){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_destinatarios, id_destino_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_destino_maestro) AS destinatario, ";
        $conn->sql.= "id_corresp, id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS estatus, ";
        $conn->sql.= "id_tipoenvio_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipoenvio_maestro) AS nombre_tipoenvio_maestro ";
        $conn->sql.= "FROM ".clConstantesModelo::correspondencia_table."tbldestinatarios WHERE id_destino_maestro= ".$id_destino_maestro." AND id_estatus_maestro IS NOT NULL AND id_estatus_maestro != 216 ORDER BY id_corresp DESC";
           // se le quito a la consulta para probar ""
        //exit($conn->sql);
        /*$data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data;*/
        $_pagi_sql= $conn->sql;
        $_pagi_cuantos = 10;
        $_pagi_nav_num_enlaces = 5;
        $_pagi_actual = $pagina;
        include_once '../comunes/php/paginacion/paginator3.inc.php';
        $data = pg_fetch_all($_pagi_result);
        $data2[0]= $data;
        $data2[1]=  "<p>".$_pagi_navegacion."</p>";
        //echo $_pagi_navegacion;
        return $data2;
    }

    public function updateDestinatarios(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "DELETE FROM ".clConstantesModelo::correspondencia_table."tbldestinatarios WHERE id_corresp= ".$this->getId_corresp();
        $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function deleteDestinatarios($id_corresp){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tbldestinatarios SET bolborrado= 1 WHERE id_corresp= ".$id_corresp;
        $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function updateEstatusDestinatarios($id_corresp, $id_estatus_maestro){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tbldestinatarios SET id_estatus_maestro= ".$id_estatus_maestro." WHERE id_corresp= ".$id_corresp;
        $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function updateEstatusDestinatariosByIdDestinatarios($id_destinatarios, $id_estatus_maestro){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tbldestinatarios SET id_estatus_maestro= ".$id_estatus_maestro." WHERE id_destinatarios= ".$id_destinatarios;
        $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function insertDestinatarioReenvio($id_corresp) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tbldestinatarios (id_destino_maestro, id_corresp, id_estatus_maestro, id_tipoenvio_maestro) ";
        $conn->sql.= "SELECT id_destino_maestro, id_corresp, 200, id_tipoenvio_maestro FROM tbldestinatarios WHERE id_corresp= ".$id_corresp;
        $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectAllGestionReporte($departamentos= null, $id_tipocorresp_maestro= null) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
        $conn->sql.= "COUNT(*) AS cantidad FROM ".clConstantesModelo::correspondencia_table."tbldestinatarios WHERE id_estatus_maestro != 0 ";
        if($departamentos != null){
            $conn->sql.= "AND id_destino_maestro in (".$departamentos.") ";
        }
        $conn->sql.= "AND id_corresp IN (SELECT id_corresp FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias WHERE id_tipocorresp_maestro= ".$id_tipocorresp_maestro." ";
        $conn->sql.= "AND bolborrado= 0) GROUP BY id_estatus_maestro";
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        //echo $conn->sql;
        return $data;
    }
}
?>
