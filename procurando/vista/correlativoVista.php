<?php
    session_start();
    require_once "../controlador/correlativoControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');

    $xajax= new xajax();
    $xajax->registerFunction('selectAllCorrelativo');
    $xajax->registerFunction('deleteCorrelativo');
	$xajax->processRequest();
    $xajax->printJavascript('../comunes/xajax/')
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
        <script src="../comunes/js/mootools.js" type="text/javascript"></script>
        <script src="../comunes/js/funciones.js" type="text/javascript"></script>
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        <script language="javascript">
            function abrirVentana(opcion){
                switch (opcion) {
                    case 1:
                        window.open('./correlativoVistaIngreso.php?acc=INS', 'contenido', '');
                        break;
                }
            }
            function ocultar(id, msj) {
                var log = $(id);
                txt2 = $(id);
                var fx = new Fx.Styles(log, {
                            duration: 5000,
                            wait: true,
                            transition: Fx.Transitions.Quad.easeOut
                        });

                txt2.addEvents({
                            'burn': function(text) {
                                log.setHTML(text);
                                fx.start({
                                    'background-color': ['#fff36f', '#eeeeee'],
                                    'opacity': [1, 0.1]
                                })
                        }
                        });
                log.setStyle('padding','5px');
                txt2.fireEvent('burn',msj);
                divall = id;
                setTimeout("tapar('"+divall+"')",2000);
            }
            function tapar(id){
                el = $(id);
                var mySlide = new Fx.Slide(el,{duration: 400});
                mySlide.slideOut();
            }
            function eliminarCorrelativo(id_correlativo){
                if (confirm('¿Seguro desea eliminar el Correlativo?')){
                    xajax_deleteCorrelativo(id_correlativo);
                }
            }
        </script>
    </head>
    <body onload="xajax_selectAllCorrelativo();">
        <form name="frmcorrelativo" id="frmcorrelativo" method="post" style="">
            <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Correlativos</td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <img src="../comunes/images/calculator_add.png" onmouseover="Tip('Nuevo Correlativo')" onmouseout="UnTip()" border="0" onclick="javascript:abrirVentana(1);"/>
                    </td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                <tr>
                    <td>
                        <div id="formulario" style="width:100%;" align="left">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="contenedor" style="width:100%;" align="left">
                            <div align="center"><img src="../comunes/images/ajax-loader.gif"></div>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>