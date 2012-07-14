<?php

require_once '../comunes/class.upload/class.upload.php';
require_once "../controlador/controlador_abogados.php";
//$cn = mysql_connect("server","user","pwd");
//mysql_select_db("bd", $cn);


if ($_GET['action'] == 'listFotos') {

    //$query = mysql_query("SELECT * FROM fotos ORDER BY id_foto DESC", $cn);
    /* while($row = mysql_fetch_array($query))
      {
      echo  '<li>
      <img src="photos/'.$row['nombre_foto'].'" />
      <span>'.$row['nombre_foto'].'</span>
      </li>';
      } */
} else {
    $destino = "fotos/";
    if (isset($_FILES['image'])) {

        $handle = new Upload($_FILES['image']);
        if ($handle->uploaded) {
            $handle->image_resize = true;
            $handle->image_ratio_y = true;
            $handle->image_x = 300;
            $handle->jpeg_quality = 50;
            $handle->image_convert = 'jpg';

//
//            $id_fotografia = $_POST["id"];
//            $handle->file_new_name_body = $id_fotografia;
            
            $handle->Process($destino);

            if ($handle->processed) {
                echo $handle->file_dst_name;
                //echo '  <img width="100" height="120" src="' . $destino . '/' . $handle->file_dst_name . '" />';
            }else{
              
            }
            $handle->Clean();


        }
    }
}
?>