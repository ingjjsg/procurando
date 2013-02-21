<?php
    session_start();
    require_once "../controlador/actuacionesControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    require_once '../modelo/clPermisoModelo.php';
    require_once '../modelo/clConstantesModelo.php';

    $xajax= new xajax();
    $xajax->registerFunction('selectAllActuaciones');
    $xajax->registerFunction('eliminar_actuacion');
    /*$xajax->registerFunction('formfiltro');*/
	$xajax->processRequest();
    $xajax->printJavascript('../comunes/xajax/');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
			$xajax->printJavascript('../comunes/xajax/')
		?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="pragma" content="no-cache">
        <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" >
        <link href="../comunes/css/general.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/enlaces.css" rel="stylesheet" type="text/css" />

        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
    </head>
    <body onload="xajax_selectAllActuaciones();">
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <script src="../comunes/js/prototype.js" type="text/javascript"></script>
        <script src="../comunes/js/negocio/js_ingresoJuridica.js" type="text/javascript"></script>
        <script type="text/javascript" src="../comunes/js/effects.js"></script>
<!--        <script type="text/javascript" src="../comunes/js/scriptaculous.js"></script>-->
        <form name="frmcontacto" method="post">
            <input type="hidden" name="iduser" value="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Actuaciones Juridicas</td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                       <?php 
                        if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('actuaciones'),'nuevo', clConstantesModelo::acciones_actuaciones())) {
                        echo "<img src=\"../comunes/images/script_edit.png\" onmouseover=\"Tip('Nueva Actuación')\" onmouseout=\"UnTip()\" onclick=\"javascript:location.href='vista_GeneradorActuaciones.php'\"/>";
                        }?>
                        <img src="../comunes/images/filter.png" onmouseover="Tip('Filtros')" onmouseout="UnTip()" border="0" onclick="verfiltro();"/>
                    </td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                <tr>
                    <td>
                        <div id="filtro" style="width:100%;" align="left">

                        </div>
                        <div id="contenedor" style="width:100%;" align="left">
                            <div align="center"><img src="../comunes/images/ajax-loader.gif"></div>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
