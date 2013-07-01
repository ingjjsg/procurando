<?php
    
    require_once '../controlador/Conexion.php';
    require_once '../modelo/clConstantesModelo.php';

/**
 * Description of clAdjuntarModelo
 *
 * @author Juan
 */
class clAdjuntarModeloExpediente {
    
    public function insertAdjunto($id_archivo, $stradjunto){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tbladjunto_documento (id_proexpediente, stradjunto) VALUES ";
        $conn->sql.= "('".$id_archivo."', '".$stradjunto."')";
//        exit("SQL: ".$conn->sql);
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function updateAdjunto($id_corresp, $id_archivo){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tbladjunto_documento SET id_corresp= ".$id_corresp." WHERE id_archivo='".$id_archivo."'";
        $retorno2= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function deleteAdjuntoById($id){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT stradjunto FROM ".clConstantesModelo::correspondencia_table."tbladjunto_documento WHERE id_adjunto= ".$id;
	$retorno= $conn->ejecutarSentencia(2);
        $conn->sql= "DELETE FROM ".clConstantesModelo::correspondencia_table."tbladjunto_documento WHERE id_adjunto= ".$id;
        if($retorno){
            for ($i= 0; $i < count($retorno); $i++){
                echo unlink("../comunes/uploads/".$retorno[$i]["stradjunto"]);
            }
        }
        $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }
    public function selectAdjunto($id_archivo){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT * FROM ".clConstantesModelo::correspondencia_table."tbladjunto_documento WHERE id_archivo= trim('".$id_archivo."')";
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
    public function selectAdjuntoByIdExpediente($id){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT * FROM ".clConstantesModelo::correspondencia_table."tbladjunto_documento WHERE id_proexpediente= ".$id;
//exit($sql);        
        $conn->sql= $sql;
        $retorno= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $retorno;
    }
}
?>
