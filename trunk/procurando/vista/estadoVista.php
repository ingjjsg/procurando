<?php
    session_start();

    require_once "../controlador/estadosControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    $xajax= new xajax();
    $xajax->registerFunction('formMaestro');
    $xajax->registerFunction('selectAllEstado');
    $xajax->registerFunction('llenarEstatus');
    $xajax->registerFunction('insertEstados');
    $xajax->registerFunction('updateEstados');
    $xajax->registerFunction('deleteEstados');
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
        <script src="../comunes/js/funciones.js" type="text/javascript"></script>
        <script src="../comunes/js/prototype.js" type="text/javascript"></script>
        <script type="text/javascript" src="../comunes/js/effects.js"></script>
        <script type="text/javascript" src="../comunes/js/scriptaculous.js"></script>
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        <script language="javascript">
            function ocultar(id, msj) {
                var log = $(id);
                log.innerHTML= msj;
                log.style.backgroundColor= '#fff36f';
                log.style.padding= '5px';
                new Effect.Fade(id, {from: 1, to: 0, duration: 2.0});
                new Effect.SlideUp(id, {queue: 'parallel', duration: 2.0});
            }
            function ocultar2(id) {
                Effect.Fade(id, { duration: 2.0 });
                Effect.SlideUp(id, { duration: 2.0 });
            }
            function eliminarEstados(id_maestro){
                if (confirm('¿Seguro desea eliminar el Estado?')){
                    xajax_deleteEstados(id_maestro,xajax.getFormValues('frmestado'));
                }
            }
            function validar(acc){
                if (!validaSelect(document.frmestado.id_estinicial_maestro,'Estado Inicial'))return false;
                if (!validaSelect(document.frmestado.id_estfinal_maestro,'Estado Final'))return false;
                if(acc == 'INS'){
                    xajax_insertEstados(xajax.getFormValues('frmestado'));
                }else{
                    xajax_updateEstados(xajax.getFormValues('frmestado'));
                }
            }
        </script>
    </head>
    <body onload="xajax_selectAllEstado(<?= $_REQUEST['id'] ?>);">
        <form name="frmestado" id="frmestado" method="post" >
            <input type="hidden" name="id_estados" id="id_estados" value="">
            <input type="hidden" name="id_meestados_maestros" id="id_meestados_maestros" value="<?= $_REQUEST['id'] ?>">
            <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Estados<div id='capaEstado'><?= $_REQUEST['nombre'] ?></div></td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <img src="../comunes/images/tab_add.png" onmouseover="Tip('Nuevo Maestro')" onmouseout="UnTip()" border="0" onclick="xajax_formMaestro('INS');xajax_llenarEstatus('id_estinicial_maestro', 'capaInicial');xajax_llenarEstatus('id_estfinal_maestro', 'capaFinal')"/>
                        <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver a Modelo de Estados')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='../vista/modeloVista.php'"/>
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
