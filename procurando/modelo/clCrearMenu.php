<?php
    require_once '../controlador/Conexion.php';
    require_once '../modelo/clConstantesModelo.php';
/**
 * Description of maestroModelo
 *
 * @author jsuarez
 */
class clCrearMenu {

    public function obtenerMenuAsignadoUsuario($id){
            $conn= new Conexion();
            $conn->abrirConexion();
            $sql= "SELECT * FROM ".clConstantesModelo::seguridad_table."Tblaccesoforma a,   ".clConstantesModelo::correspondencia_table."tblmaestros b WHERE a.id_profile_maestro=b.id_maestro and a.id_profile_maestro='".$id."' and a.bolborrado= 0 and LENGTH(a.stracciones)>2 order by b.stritema";
            $conn->sql= $sql;
            $data= $conn->ejecutarSentencia(2);
            $conn->cerrarConexion();
            return $data;
    }

	public function Verificar_hijos($id_origen)
	{
            $conn= new Conexion();
            $conn->abrirConexion();
            $sql= "SELECT * FROM  ".clConstantesModelo::correspondencia_table."tblmaestros  WHERE id_origen='".$id_origen."' and bolborrado= 0  order by sngcant asc";
            $conn->sql= $sql;
            $data= $conn->ejecutarSentencia(2);
            $conn->cerrarConexion();
            return $data;
	}

	public function Descripcion_modulo($id)
	{
            $conn= new Conexion();
            $conn->abrirConexion();
            $sql= "SELECT * FROM  ".clConstantesModelo::correspondencia_table."tblmaestros  WHERE id_maestro='".$id."' and bolborrado= 0 ";
            $conn->sql= $sql;
            $data= $conn->ejecutarSentencia(2);
            $conn->cerrarConexion();
            return $data;
	}

}
?>
