<?php
    
    require_once '../controlador/Conexion.php';
    require_once '../modelo/clConstantesModelo.php';

/**
 * Description of clAdjuntarModelo
 *
 * @author Juan
 */
class clAdjuntarModelo {
    
    public function insertAdjunto($id_archivo, $stradjunto){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tbladjunto (id_archivo, stradjunto) VALUES ";
        $conn->sql.= "('".$id_archivo."', '".$stradjunto."')";
        //exit("SQL: ".$conn->sql);
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function updateAdjunto($id_corresp, $id_archivo){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tbladjunto SET id_corresp= ".$id_corresp." WHERE id_archivo='".$id_archivo."'";
        $retorno2= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function deleteAdjunto($id_ajunto){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."tbladjunto WHERE id_adjunto= ".$id_ajunto;
		$retorno= $conn->ejecutarSentencia(2);
        $conn->sql= "DELETE FROM tbladjunto WHERE id_adjunto= ".$id_ajunto;
        $retorno2= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function deleteAdjuntoById($id_corresp){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."tbladjunto WHERE id_corresp= ".$id_corresp;
		$retorno= $conn->ejecutarSentencia(2);
        $conn->sql= "DELETE FROM ".clConstantesModelo::correspondencia_table."tbladjunto WHERE id_corresp= ".$id_corresp;
        if($retorno){
            for ($i= 0; $i < count($retorno); $i++){
                unlink("../comunes/uploads/".$retorno[$i]["id_archivo"]."_".$retorno[$i]["stradjunto"]);
            }
        }
        $retorno2= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function selectAdjunto($id_archivo){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."tbladjunto WHERE id_archivo= trim('".$id_archivo."')";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
    public function selectAdjuntoByIdCorresp($id_corresp){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."tbladjunto WHERE id_corresp= ".$id_corresp;
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
}
?>
