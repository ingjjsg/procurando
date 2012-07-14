<?php
    session_start();
    require_once '../modelo/clAdjuntarModelo.php';
    require_once '../comunes/php/utilidades.php';

    verificarSession();

/**
 * Description of adjuntarControlador
 *
 * @author Juan
 */
class adjuntarControlador {
    function insertAdjunto($id_archivo, $stradjunto) {
        $adjunto= new clAdjuntarModelo();
        $adjunto->insertAdjunto($id_archivo, $stradjunto);
    }
    function selectAdjunto($id_archivo){
        $adjunto= new clAdjuntarModelo();
        $data = $adjunto->selectAdjunto($id_archivo);
		if($data){
            echo "<strong>Adjuntos:</strong><br>";
            foreach($data as $adjunto){
                echo "<strong>&radic;</strong>";
                echo "&nbsp;&nbsp;<a href='bajarAdjuntoVista.php?f=../comunes/uploads/".$adjunto["id_archivo"]."_".$adjunto["stradjunto"]."'>".$adjunto["stradjunto"]."</a>";
                echo "&nbsp;&nbsp;&nbsp;<a title='Eliminar' href='adjuntarVista.php?adjunto=".$adjunto["id_archivo"]."&eliminar=".$adjunto["id_adjunto"]."'><strong>[X]</strong></a><br>";
            }
		}else{
            echo "";
		}
	}
    function deleteAdjunto($id_ajunto){
        $adjunto= new clAdjuntarModelo();
        $data= $adjunto->deleteAdjunto($id_ajunto);
        if($data){
            unlink("../comunes/uploads/".$data[0]["id_archivo"]."_".$data[0]["stradjunto"]);
        }else{
            echo "";
        }
    }
    function selectAdjuntoByIdCorresp($id_corresp){
        $adjunto= new clAdjuntarModelo();
        $data = $adjunto->selectAdjuntoByIdCorresp($id_corresp);
		return $data[0]['id_archivo'];
	}
}
?>
