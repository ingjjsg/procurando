<?php
    session_start();
    require_once '../controlador/adjuntarActividadControlador.php';
    $adjuntoActividad= new adjuntarActividadControlador();

    if (!isset($_FILES["archivos"])) {
        echo "No se pudieron subir los archivos, trate de nuevo <a href='#' onclick='history.go(-1)'>Volver</a>";
        exit;
    }
    if (isset($_REQUEST["adjunto"])){
        $uni = $_REQUEST["adjunto"];
    }else{
        $uni = uniqid('');
    }
    while(list($key,$archivo) = each($_FILES['archivos']['name'])){
        if(!empty($archivo)){
            if(is_uploaded_file($_FILES['archivos']['tmp_name'][$key])){
                $archivo= strtolower(str_replace(array("á","é","í","ó","ú","ñ"," "), array("a","e","i","o","u","n","_"),$archivo));
                $filename = $uni."_".$archivo;
                $filename = str_replace(" ","_",$filename);
                $add = "../comunes/uploads/".$filename;
                if(move_uploaded_file($_FILES['archivos']['tmp_name'][$key], $add)){
                    $adjuntoActividad->insertAdjunto($_REQUEST["id_actividad"], $uni, $archivo);

                }else{
                    echo "No se pudo adjuntar (Mover) <a href='#' onclick='history.go(-1)'>Volver</a>";
                    exit;
                }
            }else{
                echo "No se pudo adjuntar (subir) <a href='#' onclick='history.go(-1)'>Volver</a>";
                exit;
            }
        }else{
            echo "No se pudo adjuntar <a href='#' onclick='history.go(-1)'>Volver</a>";
            exit;
        }
    }
?>
<script>
    window.parent.document.frmadjuntoactividad.adjunto.value='<?php echo $uni;?>';
    document.location.href = "adjuntarActividadVista.php?adjunto=<?php echo $uni."&id_actividad=".$_REQUEST["id_actividad"];?>";
</script>