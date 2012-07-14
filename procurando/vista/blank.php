<?php
    session_start();
    //require_once "../controlador/correspondenciaControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    $xajax= new xajax();
    //$xajax->registerFunction('correspondenciasPendientes');
    //$xajax->registerFunction('actividadesPendientes');
    $xajax->processRequest();
    $xajax->printJavascript('../comunes/xajax/');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
			$xajax->printJavascript('../comunes/xajax/');
		?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="pragma" content="no-cache">
        <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" >
        <link href="../comunes/css/general.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/enlaces.css" rel="stylesheet" type="text/css" />
        <script src="../comunes/js/funciones.js" type="text/javascript"></script>
        <script src="../comunes/js/prototype.js" type="text/javascript"></script>
        <script type="text/javascript" src="../comunes/js/effects.js"></script>
        <script type="text/javascript" src="../comunes/js/scriptaculous.js"></script>
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        <script language="javascript">
            function cargar(){
                ;
            }
        </script>
    </head>
    <body onload="cargar();">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="65%" align="right" class="menu_izq_titulo"><img src="imagenes/login/correspondencia.jpg" width="100%" /></td>
            </tr>
        </table>
    </body>
</html>