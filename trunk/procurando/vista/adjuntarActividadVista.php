<?php
    session_start();
	require_once '../controlador/adjuntarActividadControlador.php';
    $adjuntoActividad= new adjuntarActividadControlador();
	if(isset($_REQUEST["eliminar"])){
        $adjuntoActividad->deleteAdjunto($_REQUEST["eliminar"]);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Inder - Correspondencia</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../comunes/css/general.css" rel="stylesheet" type="text/css">
        <script src="../comunes/js/prototype.js" type="text/javascript"></script>
        <style>
            .remove{
                margin-left:65px;
            }
            .cont{
                display:inline;
                margin-top:40px;
            }
        </style>
        <script>
            function quitar(ele){
                ele.parentNode.remove();
            }
            function agregar(){
                ele = new Element('div');
                ele.addClassName('cont');
                $('fondo').insert({before:ele});
                ele.update('<input name=\"archivos[]\" type=\"file\" class=\"inputDestinatarios\" size=\"40\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"../comunes/images/textfield_delete.png\" onclick=\"quitar(this)\" onmouseover=\"Tip(\'Quitar Adjunto\', DURATION, 1000)\" onmouseout=\'UnTip()\'>');
            }
        </script>
    </head>
    <body style=" background-color:#F8F8F8;">
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <?php if (isset($_REQUEST["adjunto"]))
            $ruta = "adjuntoActividadVista.php?id_actividad=".$_REQUEST["id_actividad"]."&adjunto=".$_REQUEST["adjunto"];
            else $ruta = "adjuntoActividadVista.php?id_actividad=".$_REQUEST["id_actividad"];
        ?>
        <form action="<?php echo $ruta;?>" method="post" enctype="multipart/form-data">
            <table width="100%" border="0" align="center" class="tablaTitulo">
                <tr>
                    <td width="10%">
                        <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                    </td>
                    <td width="80%">&nbsp;</td>
                    <td width="10%">&nbsp;</td>
                </tr>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="80%" align="center">
                        <div align="center">
                            <input name="archivos[]" type="file" class="inputDestinatarios" size="40" />
                            &nbsp;&nbsp;&nbsp;
                            <img src="../comunes/images/textfield_add.png" onclick="agregar()" onmouseover="Tip('Agregar Adjunto')" onmouseout='UnTip()'>
                        </div>
                        <div id="fondo" align="center">

                        </div>
                    </td>
                    <td width="10%" valign="top">
                    </td>
                </tr>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="80%">&nbsp;</td>
                    <td width="10%">&nbsp;</td>
                </tr>
                <?php
                    if (isset($_REQUEST["adjunto"])){
                ?>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="80%">
                        <?php
                            $adjuntoActividad->selectAdjunto($_REQUEST["adjunto"], $_REQUEST["id_actividad"]);
                        ?>
                    </td>
                    <td width="10%">&nbsp;</td>
                </tr>
                <?php
                    }
                ?>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="80%">
                        <div align="center">
                            <input name="submit" type="submit" class="boton2" value="Adjuntar" />
                        </div>
                    </td>
                    <td width="10%">&nbsp;</td>
                </tr>
            </table>
        </form>
    </body>
</html>