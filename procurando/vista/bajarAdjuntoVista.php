<?php
    session_start();
    $extensiones = array("mp3","jpg", "jpeg","png", "gif","txt","xls","doc","html","zip","tif","JPG","JPEG","bmp","tar","pdf", "rar", "odt", "ods", "odp", "odg");
    $f = str_replace(" ","_",$_GET["f"]);
    $ftmp = explode(".",$f);
    $fExt = strtolower($ftmp[count($ftmp)-1]);
    if(!in_array($fExt,$extensiones)){
        die("<b>ERROR!</b> no es posible descargar archivos con la extension $fExt <a href='#' onclick='history.go(-1)'>Volver</a>");
    }
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"$f\"\n");
    $fp=fopen($f, "r");
    fpassthru($fp);
?> 