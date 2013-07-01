<?php
    session_start();
    require_once "../controlador/tblprojuzgadosControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    $xajax= new xajax();
    $xajax->registerFunction('selectAllJuzgados');
//    $xajax->registerFunction('selectFiltrosJuzgados');
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
            function edit(id){
                if (confirm('¿Seguro desea modificar el Juzgados?')){
        	    document.location.href='vista_Ingresotblprojuzgados.php?id='.id;
                }                
            }             
            function ocultar(id, msj) {
                var log = $(id);
                log.innerHTML= msj;
                log.style.backgroundColor= '#fff36f';
                log.style.padding= '5px';
                new Effect.Fade(id, {from: 1, to: 0, duration: 2.0});
                new Effect.SlideUp(id, {queue: 'parallel', duration: 2.0});
            }
            function ver(id){
//                cargar(1);
                div = $(id);
                div.toggle();
                if (div.innerHTML==''){
                    div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                }else{
                    d = div.descendants();
                }
            }
            function cargar(opcion){
                if(opcion == 1){
                    xajax_llenarEstatus('id_estatus', 'capaEstatus', "", false);
                    xajax_llenarSelectTipoCorres('frmleer', '', '100%');
                    xajax_llenarDestinatarios('id_dest', 'capaDest');
                }
            }
            function filtrar(){
               var fil_strnombre= document.frmJuzgados.fil_strnombre.value;
               xajax_selectAllJuzgados(fil_strnombre);                    
               ver('formulario');
            }
        </script>
    </head>
    <body onload="xajax_selectAllJuzgados();">
        <form name="frmJuzgados" id="frmJuzgados" method="post" style="">
            <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Edición de Juzgados<div id='capaMaestro'></div></td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <img src="../comunes/images/filter.png" onmouseover="Tip('Filtros')" onmouseout="UnTip()" border="0" onclick="ver('formulario');"/>&nbsp;&nbsp;
                        <img src="../comunes/images/page_add.png" onmouseover="Tip('Nuevo Juzgado')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='vista_Ingresotblprojuzgados.php'"/>                        
                    </td>
                </tr>

            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                <tr>
                    <td>
                        <div id="formulario" style="width:100%;display:none;" align="left">
                            <fieldset style="border:#339933 2px solid">
                                <table width="100%" border="0" class="tablaVer" >
                                    <tr>
                                        <td width="20%">
                                            Nombre:
                                        </td>
                                        <td width="80%" colspan="8">
                                            <input name="fil_strnombre" onblur="xajax_selectFiltrosJuzgados(document.frmJuzgados.fil_strnombre.value);" tabindex=1 type="text" class="inputbox" id="fil_strnombre" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" colspan="8">
                                            <input type="button" value="Filtrar" onclick="filtrar();">
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="contenedor" style="width:100%;" align="left">
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