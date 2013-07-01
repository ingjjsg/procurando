<?php
    session_start();
    require_once '../modelo/clAdjuntarDictamenModelo.php';
    require_once '../comunes/php/utilidades.php';

    verificarSession();

/**
 * Description of adjuntarControlador
 *
 * @author Jaime Suarez
 */

    
    function eliminar_documento($id_expediente="",$id_file=""){
        $respuesta = new xajaxResponse();
        $file = new clAdjuntarModeloDictamen();
            $data = $file->deleteAdjuntoById($id_file);
             if($data){
                $respuesta->alert("Ha sido Eliminado el Archivo del Dictamen con Exito");
                $respuesta->script("xajax_ListaDocumentosExpediente('".$id_expediente."')");
            }else{
                $respuesta->alert("El Archivo del Dictamen no se ha Eliminado");
            }
        return $respuesta;
    }     
    
    function ListaDocumentosExpediente($id_expediente){
        $respuesta= new xajaxResponse();
//        exit($id_expediente);
        
        $expediente= new clAdjuntarModeloDictamen();
        $data= "";
        $html= "";         
        $data=$expediente->selectAdjuntoByIdExpediente($id_expediente);
        if($data){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE DOCUMENTOS ANEXADOS AL DICTAMEN</strong>
                                    </div>                                
                                </td>
                            </tr>                             
                                <tr>
                                    <th width='95%'>
                                        <a href='#' onclick=\"xajax_orden('stradjunto')\">Documento</a>
                                    </th>                                
                                    <th width='5%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Acción</a>
                                    </th>                                         
                                </tr>";
                for ($i= 0; $i < count($data); $i++){
                    $file=  explode("_",$data[$i]['stradjunto']);
//                    exit(print_r($file));
                    $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                <td align='left'><a href='".$data[$i]['stradjunto']."' \">".$file[2]."</a></td>
                                <td align='center'>
                                        <a>
                                            <input type='images' value='Eliminar Archivo' id='boton' name='boton' style='background-color:#B9D5E3;border:1px outset #B9D5E3;color:#004E7D;cursor:pointer;margin:1px;padding:1px; width:100px; font-size:11px;' onclick=\"xajax_eliminar_documento('".$data[$i]['id_dictamen']."','".$data[$i]['id_adjunto']."','P')\">
                                       </a>                                   
                                </td>
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="";
            }
        $respuesta->assign("contenedorDocumentos","innerHTML",$html);
        return $respuesta;
    }        

    
    
class adjuntarDocumentoControlador {

    function insertAdjunto($id_archivo, $stradjunto) {
        $adjunto= new clAdjuntarModeloDictamen();
        $adjunto->insertAdjunto($id_archivo, $stradjunto);
    }
    function selectAdjunto($id_archivo){
        $adjunto= new clAdjuntarModeloDictamen();
        $data = $adjunto->selectAdjunto($id_archivo);
		if($data){
            echo "<strong>Adjuntos:</strong><br>";
            foreach($data as $adjunto){
                echo "<strong>&radic;</strong>";
                echo "&nbsp;&nbsp;<a href='bajarAdjuntoVista.php?f=../comunes/uploads/dictamenes/".$adjunto["id_archivo"]."_".$adjunto["stradjunto"]."'>".$adjunto["stradjunto"]."</a>";
                echo "&nbsp;&nbsp;&nbsp;<a title='Eliminar' href='adjuntarDictamenVista.php?adjunto=".$adjunto["id_archivo"]."&eliminar=".$adjunto["id_adjunto"]."'><strong>[X]</strong></a><br>";
            }
		}else{
            echo "";
		}
	}
    function deleteAdjunto($id_ajunto){
        $adjunto= new clAdjuntarModeloDictamen();
        $data= $adjunto->deleteAdjunto($id_ajunto);
        if($data){
            unlink("../comunes/uploads/dictamenes/".$data[0]["id_archivo"]."_".$data[0]["stradjunto"]);
        }else{
            echo "";
        }
    }
    function selectAdjuntoByIdCorresp($id_corresp){
        $adjunto= new clAdjuntarModeloDictamen();
        $data = $adjunto->selectAdjuntoByIdCorresp($id_corresp);
		return $data[0]['id_archivo'];
	}
}
?>
