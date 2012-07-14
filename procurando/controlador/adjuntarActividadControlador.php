<?php
    session_start();
    require_once '../modelo/clAdjuntarActividadModelo.php';
    require_once '../comunes/php/utilidades.php';

    verificarSession();

/**
 * Description of adjuntarControlador
 *
 * @author Juan
 */
class adjuntarActividadControlador {
    function insertAdjunto($id_actividad, $id_archivo, $stradjunto) {
        $adjuntoActividad= new clAdjuntarActividadModelo();
        $adjuntoActividad->insertAdjunto($id_actividad, $id_archivo, $stradjunto);
    }
    function selectAdjunto($id_archivo, $id_actividad){
        $adjuntoActividad= new clAdjuntarActividadModelo();
        $data = $adjuntoActividad->selectAdjunto($id_archivo);
		if($data){
            echo "<strong>Adjuntos:</strong><br>";
            foreach($data as $adjunto){
                echo "<strong>&radic;</strong>";
                echo "&nbsp;&nbsp;<a href='bajarAdjuntoVista.php?f=../comunes/uploads/".$adjunto["id_archivo"]."_".$adjunto["stradjunto"]."'>".$adjunto["stradjunto"]."</a>";
                echo "&nbsp;&nbsp;&nbsp;<a title='Eliminar' href='adjuntarActividadVista.php?adjunto=".$adjunto["id_archivo"]."&eliminar=".$adjunto["id_adjunto"]."&id_actividad=".$id_actividad."'><strong>[X]</strong></a><br>";
            }
		}else{
            echo "";
		}
	}
    function deleteAdjunto($id_ajunto){
        $adjuntoActividad= new clAdjuntarActividadModelo();
        $data= $adjuntoActividad->deleteAdjunto($id_ajunto);
        if($data){
            unlink("../comunes/uploads/".$data[0]["id_archivo"]."_".$data[0]["stradjunto"]);
        }else{
            echo "";
        }
    }
    function selectAdjuntoByIdActividad($id_actividad){
        $adjuntoActividad= new clAdjuntarActividadModelo();
        $data = $adjuntoActividad->selectAdjuntoByIdActividad($id_actividad);
		return $data[0]['id_archivo'];
	}
}
?>
