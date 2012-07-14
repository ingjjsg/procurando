<?php
    session_start();

    if($_REQUEST['cargar'] == ""){
        $_REQUEST['cargar'] == 2;
    }

    require_once "../controlador/correspondenciaControlador.php";
    require_once "../controlador/rutaCorrespondenciaControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    $xajax= new xajax();
    $xajax->registerFunction('selectAllCorrespondenciaEntrante');
    $xajax->registerFunction('verDeTallesCorrespondencia');
    $xajax->registerFunction('selectRutaCorrespondenciaByIdCorresp');
    $xajax->registerFunction('updateDestinatariosEstatus');
    $xajax->registerFunction('llenarEstatus');
    $xajax->registerFunction('llenarSelectTipoCorres');
    $xajax->registerFunction('llenarSelectTipoDoc');
    $xajax->registerFunction('llenarDestinatarios');
    $xajax->registerFunction('selectAllCorrespondenciaEntranteFiltros');
    $xajax->registerFunction('actualizarEstatus');
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
            function verDetalles(id, idDest, idEstatus){
                div = $('div_'+id);
                div.toggle();
                xajax_updateDestinatariosEstatus(idDest, idEstatus);
                xajax_actualizarEstatus(idDest);
                if (div.innerHTML==''){
                    div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                    xajax_verDeTallesCorrespondencia(id, idDest, 2);
                }else {
                    d = div.descendants();
                    if(d[0].id!='div_c'+id){
                        div.show();
                        div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                        xajax_verDeTallesCorrespondencia(id, idDest, 2);
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
            function cargar(opcion){
                if(opcion == 1){
                    xajax_llenarEstatus('id_estatus', 'capaEstatus', "", false);
                    xajax_llenarSelectTipoCorres('frmleer', '', '100%');
                    xajax_llenarDestinatarios('id_dest', 'capaDest');
                }else if(opcion == 200){
                    xajax_selectAllCorrespondenciaEntranteFiltros(1, '', '', 200, '', '', '', '');
                }else if(opcion == 201){
                    xajax_selectAllCorrespondenciaEntranteFiltros(1, '', '', 201, '', '', '', '');
                }else if(opcion == 202){
                    xajax_selectAllCorrespondenciaEntranteFiltros(1, '', '', 202, '', '', '', '');
                }else if(opcion == 203){
                    xajax_selectAllCorrespondenciaEntranteFiltros(1, '', '', 203, '', '', '', '');
                }else{
                    xajax_selectAllCorrespondenciaEntrante(1);
                }
            }
            function filtrar(){
                var fechaD= document.frmleer.fechaD.value;
                var fechaH= document.frmleer.fechaH.value;
                var estatus= document.frmleer.id_estatus.value;
                if(estatus == 0){
                    estatus= "";
                }
                var asunto= document.frmleer.asuntos.value;
                var tipoC= document.frmleer.id_tipo_maestro.value;
                if(tipoC == 0){
                    tipoC= "";
                }
                var tipoD= document.frmleer.id_tipocorresp_maestro.value;
                if(tipoD == 0){
                    tipoD= "";
                }
                var dest= document.frmleer.id_dest.value;
                if(dest == 0){
                    dest= "";
                }
                xajax_selectAllCorrespondenciaEntranteFiltros(1, fechaD, fechaH, estatus, asunto, tipoC, tipoD, dest);
                ver('formulario');
            }
            function cerrarCorrespondencia(idDest, idCorresp){
                if (confirm('¿Seguro desea cerrar la correspondencia?')){
                    xajax_updateDestinatariosEstatus(idDest, 216, idCorresp)
                }
            }
        </script>
    </head>
    <body onload="cargar(<?= $_REQUEST['cargar'] ?>)">
        <form name="frmleer" id="frmleer" method="post" style="">
            <input type="hidden" name="iduser" value="">
            <input type='hidden' name='id_origen' id='id_origen' value='0'>
            <input type='hidden' name='id_maestro' id='id_maestro' value='0'>
            <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Bandeja de Entrada<div id='capaMaestro'></div></td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <img src="../comunes/images/filter.png" onmouseover="Tip('Filtros')" onmouseout="UnTip()" border="0" onclick="ver('formulario');"/>
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
                                            Fecha Desde:
                                        </td>
                                        <td width="30%">
                                            <input id="fechaD" name="fechaD" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                            <img name="button"  id="lanzador1"  src="../comunes/images/calendar.png" align="middle"/>
                                            <script type="text/javascript">
                                                Calendar.setup({
                                                    inputField     :    "fechaD",      // id del campo de texto
                                                    ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                    button         :    "lanzador1"   // el id del botn que lanzar el calendario
                                                });
                                            </script>
                                        </td>
                                        <td width="20%">
                                            Fecha Hasta:
                                        </td>
                                        <td width="30%">
                                            <input id="fechaH" name="fechaH" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                            <img name="button"  id="lanzador2"  src="../comunes/images/calendar.png" align="middle"/>
                                            <script type="text/javascript">
                                                Calendar.setup({
                                                    inputField     :    "fechaH",      // id del campo de texto
                                                    ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                    button         :    "lanzador2"   // el id del botn que lanzar el calendario
                                                });
                                            </script>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%">
                                            Estatus:
                                        </td>
                                        <td width="30%">
                                            <div id="capaEstatus">
                                                <select id="id_estatus" name="id_estatus" style="width:90%">
                                                    <option value='0'>Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td width="20%">
                                            Asuntos:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="asuntos" name="asuntos" size="30">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%">
                                            Tipo de Correspondencia:
                                        </td>
                                        <td width="30%">
                                            <div id="capaTipo">
                                                <select id='id_tipo_maestro' name='id_tipo_maestro' style='width:100%'>
                                                    <option value='0'>Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td width="20%">
                                            Tipo de Documento:
                                        </td>
                                        <td width="30%">
                                            <div id="capaDoc">
                                                <select id='id_tipocorresp_maestro' name='id_tipocorresp_maestro' style='width:100%'>
                                                    <option value='0'>Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%">
                                            Remitente:
                                        </td>
                                        <td width="80%" colspan="8">
                                            <div id="capaDest">
                                                <select id='id_dest' name='id_dest' style='width:100%'>
                                                    <option value='0'>Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" colspan="8">
                                            <input type="button" value="filtrar" onclick="filtrar();">
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