<?php
    session_start();

    require_once "../controlador/correspondenciaControlador.php";
    require_once "../controlador/rutaCorrespondenciaControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    $xajax= new xajax();
    $xajax->registerFunction('selectAllCorrespondencia');
    $xajax->registerFunction('llenarEstatus');
    $xajax->registerFunction('verDeTallesCorrespondencia');
    $xajax->registerFunction('deleteCorrespondencia');
    $xajax->registerFunction('enviarCorrespondencia');
    $xajax->registerFunction('llenarSelectModelo');
    $xajax->registerFunction('selectRutaCorrespondenciaByIdCorresp');
    $xajax->registerFunction('reenviarCorrespondencia');
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
        <link href="../comunes/css/pagination.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/calendar-blue2.css" rel="stylesheet" type="text/css" media="all" title="win2k-cold-1" />
        <script src="../comunes/js/funciones.js" type="text/javascript"></script>
        <script src="../comunes/js/prototype.js" type="text/javascript"></script>
        <script src="../comunes/js/effects.js" type="text/javascript"></script>
        <script src="../comunes/js/scriptaculous.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_es.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_setup.js" type="text/javascript"></script>
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
            function ver(id){
                cargar(1);
                div = $(id);
                div.toggle();
                if (div.innerHTML==''){
                    div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                }else{
                    d = div.descendants();
                }
            }
            function verDetalles(id){
                div = $('div_'+id);
                div.toggle();
                if (div.innerHTML==''){
                    div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                    xajax_verDeTallesCorrespondencia(id);
                }else {
                    d = div.descendants();
                    if(d[0].id!='div_c'+id){
                        div.show();
                        div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                        xajax_verDeTallesCorrespondencia(id);
                    }
                }
            }
            function verSeguimiento(id){
                div = $('div_'+id);
                div.toggle();
                if (div.innerHTML==''){
                    div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                    xajax_selectRutaCorrespondenciaByIdCorresp(id);
                }else {
                    d = div.descendants();
                    if(d[0].id!='div_s'+id){
                        div.show();
                        div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                        xajax_selectRutaCorrespondenciaByIdCorresp(id);
                    }
                }
            }
            function cargar(){
                xajax_selectAllCorrespondencia(194, <?= $_SESSION['id_contacto'] ?>, 1, "", 'B');
            }
            function eliminarCorrespondencia(id, estatus){
                if (confirm('¿Seguro desea eliminar la correspondencia con el Id: '+id+'?')){
                    xajax_deleteCorrespondencia(id, estatus);
                }
            }
            function enviarCorrespondencia(id, tipoDoc, estatus){
                if (confirm('¿Seguro desea enviar la correspondencia con el Id: '+id+'?')){
                    xajax_enviarCorrespondencia(id, tipoDoc, estatus);
                }
            }
        </script>
    </head>
    <body onload="cargar()">
        <form name="frmleer" id="frmleer" method="post" style="">
            <input type="hidden" name="iduser" value="">
            <input type='hidden' name='id_origen' id='id_origen' value='0'>
            <input type='hidden' name='id_maestro' id='id_maestro' value='0'>
            <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Borradores<div id='capaMaestro'></div></td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Cancelar')" onmouseout="UnTip()" border="0" onclick="location.href='blank.php'"/>
                    </td>
                </tr>

            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                <tr>
                    <td>
                        <div id="contenedor" style="width:100%;" align="left" >
                            <div align="center"><img src="../comunes/images/ajax-loader.gif"></div>
                        </div>
                    
                        <div id="pag" style="width:100%;" align="left" class="pagination">
                            
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
