<?php
    session_start();
    require_once '../controlador/actividadControlador.php';
    require_once '../controlador/contactoControlador.php';
    require_once '../modelo/clConstantesModelo.php';
    require_once '../comunes/xajax/xajax_core/xajax.inc.php';
    $formulario=  clConstantesModelo::formularios();
    $acciones_actividades=  clConstantesModelo::acciones_actividades();

    $accionVerTodasActividades= verAccion($_SESSION['id_profile'], $formulario['actividades'], $acciones_actividades['ver_todas_actividades']);
    $accionAsignarAnalista= verAccion($_SESSION['id_profile'],  $formulario['actividades'], $acciones_actividades['asignar_analista']);
    $accionVerMisActividades= verAccion($_SESSION['id_profile'],  $formulario['actividades'], $acciones_actividades['ver_mis_actividades']);

    $xajax= new xajax();
    $xajax->registerFunction('selectActividadByDepartamento');
    $xajax->registerFunction('verDetallesActividad');
    $xajax->registerFunction('insertNota');
    $xajax->registerFunction('updateActividadEstatus');
    $xajax->registerFunction('selectActividadByContacto');
    $xajax->registerFunction('llenarSelectActividadByDepartamento');
    $xajax->registerFunction('selectCorrespondencia');
    $xajax->registerFunction('llenarSelectAnalistaByDepartamento');
    $xajax->registerFunction('selectContactosActividadByIdActividad');
    $xajax->registerFunction('deleteContactoActividad');
    $xajax->registerFunction('insertContactoActividad');
    $xajax->registerFunction('formActividad');
    $xajax->registerFunction('insertDetalleContactoActividad');
    $xajax->registerFunction('selectDetalleContactoActividadByIdContactoActividad');
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
        <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" >
        <link href="../comunes/css/general.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/enlaces.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/calendar-blue2.css" rel="stylesheet" type="text/css" media="all" title="win2k-cold-1" />
        <link href="../comunes/css/tabcontent.css" rel="stylesheet" type="text/css"  />
        <link rel='StyleSheet' href='../comunes/js/dtree.css' type='text/css' />
        <script type='text/javascript' src='../comunes/js/dtree.js'></script>
        <script type='text/javascript' src='../comunes/js/funciones.js'></script>
        <script type="text/javascript" src="../comunes/js/prototype.js"></script>
        <script type="text/javascript" src="../comunes/js/effects.js"></script>
        <script type="text/javascript" src="../comunes/js/scriptaculous.js"></script>
        <script type="text/javascript" src="../comunes/js/tabcontent.js"></script>
        <script src="../comunes/js/calendar.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_es.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_setup.js" type="text/javascript"></script>
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
            .botones{
                background-color:#B9D5E3;
                border:1px outset #B9D5E3;
                color:#004E7D;
                cursor:pointer;
                margin:5px;
                padding:1px;
                width:145px;
                font-size:10px;
                font-weight:bold;
            }
            .formato{
                font-size:11px;
                border:1px solid #666666;
                padding:2px;
                background-color:#FFFFFF;
            }
        </style>
        <script language="javascript">
            function cargar(){
                xajax_selectActividadByDepartamento();
                xajax_selectActividadByContacto();
                xajax_llenarSelectActividadByDepartamento();
                xajax_llenarSelectAnalistaByDepartamento();
            }
            function validarAnalista(){
                if (!validaSelect(document.frmanalista.id_actividad,'Actividad'))return false;
                if (!validaSelect(document.frmanalista.id_contacto,'Analista'))return false;
                xajax_insertContactoActividad(xajax.getFormValues('frmanalista'));
            }
            function cargarAnalista(valor){
                xajax_llenarSelectAnalista(valor);
                xajax_selectContactosActividadByIdActividad(valor);
            }
            function verDetalles(id){
                div = $('div_'+id);
                div.toggle();
                if (div.innerHTML==''){
                    div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                    xajax_verDetallesActividad(id);
                }else {
                    d = div.descendants();
                    if(d[0].id!='div_c'+id){
                        div.show();
                        div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                        xajax_verDetallesActividad(id);
                    }
                }
            }
            function verFormulario(idActividad, idContactoActividad){
                div = $('div_r'+idContactoActividad);
                div.toggle();
                if (div.innerHTML==''){
                    div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                    xajax_formActividad(idActividad, idContactoActividad);
                }else {
                    d = div.descendants();
                    if(d[0].id!='div_f'+idContactoActividad){
                        div.show();
                        div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                        xajax_formActividad(idActividad, idContactoActividad);
                    }
                }
            }
            function verHistorial(idContactoActividad){
                div = $('div_r'+idContactoActividad);
                div.toggle();
                if (div.innerHTML==''){
                    div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                    xajax_selectDetalleContactoActividadByIdContactoActividad(idContactoActividad);
                }else {
                    d = div.descendants();
                    if(d[0].id!='div_h'+idContactoActividad){
                        div.show();
                        div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                        xajax_selectDetalleContactoActividadByIdContactoActividad(idContactoActividad);
                    }
                }
            }
            function validarAnalista(){
                if (!validaSelect(document.frmanalista.id_actividad,'Actividad'))return false;
                if (!validaSelect(document.frmanalista.id_contacto,'Analista'))return false;
                xajax_insertContactoActividad(xajax.getFormValues('frmanalista'));
            }
            function devolver(){
                if (!campoRequerido(document.frmnota.memobsernota,"Nota")) return false;
                xajax_insertNota(xajax.getFormValues('frmnota'));
                tt_HideInit();
            }
            function guardarActividad(modo){
                xajax_insertDetalleContactoActividad(xajax.getFormValues('frmadjuntoactividad'), modo);
            }
            function cerrarActividad(id){
                if (confirm('¿Seguro desea cerrar la actividad con el Id: '+id+'?')){
                    xajax_updateActividadEstatus(id);
                }
            }
        </script>
    </head>
    <body onload="cargar()">
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="65%" class="menu_izq_titulo">Actividades</td>
                <td width="10%" align="center" class="menu_izq_titulo">
                    <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Cancelar')" onmouseout="UnTip()" border="0" onclick="location.href='bandejaVista.php'"/>
                </td>
            </tr>
        </table>
        <table width="100%"border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
            <tr>
                <td height="100%" width="100%">
                    <div align="center">
                        <ul id="countrytabs" class="shadetabs">
                            <?php if($accionVerTodasActividades){ ?>
                            <li>
                                <a id="link1" href="#" rel="country1" class="selected">Actividades</a>
                            </li>
                            <?php } ?>
                            <?php if($accionAsignarAnalista){ ?>
                            <li>
                                <a id="link2" href="#" rel="country2">Asignar Analista</a>
                            </li>
                            <?php } ?>
                            <?php if($accionVerMisActividades){ ?>
                            <li>
                                <a id="link3" href="#" rel="country3">Mis Actividades</a>
                            </li>
                            <?php } ?>
                        </ul>
                        <div style="background:#F8F8F8; border:solid 1px #cccccc; width:99%; height:375px" align="center">
                            <?php if($accionVerTodasActividades){ ?>
                            <div id="country1" class="tabcontent" style="height:100%; overflow-y:auto">
                                <table border='0' class='tablaTitulo' width='100%'>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <b>Actividades Asignadas</b>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                                    <tr>
                                        <td>
                                            <div id="contenedor" style="width:100%;" align="left">
                                                <div align="center"><img src="../comunes/images/ajax-loader.gif"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php } ?>
                            <?php if($accionAsignarAnalista){ ?>
                            <div id="country2" class="tabcontent" style="height:100%; overflow-y:auto">
                                <form id="frmanalista" name="frmanalista" method="post">
                                    <input type="hidden" id="id_estatus_maestro" name="id_estatus_maestro" value="249">
                                    <input type="hidden" id="id_contacto_asigna" name="id_contacto_asigna" value="<?= $_SESSION['id_contacto'] ?>">
                                    <table border='0' class='tablaTitulo' width='100%'>
                                        <tr>
                                            <td colspan="3" width="100%" align="center">&nbsp;</td>
                                            <td><img src="../comunes/images/16_save.gif" onmouseover="Tip('Asignar Analista')" onmouseout="UnTip()" border="0" onclick="javascript:validarAnalista()"/></td>
                                        </tr>
                                        <tr>
                                             <td width="5%">&nbsp;</td>
                                            <td width="25%">
                                                <b>Actividad:</b>
                                            </td>
                                            <td width="65%">
                                                <div id="capaActividadAnalista">
                                                    <select id="id_actividad" name="id_actividad" style="width:100%">
                                                        <option value="0">Seleccione</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td width="5%">&nbsp;</td>
                                        </tr>
                                        <tr>
                                             <td width="5%">&nbsp;</td>
                                            <td width="25%">
                                                <b>Correspondencia:</b>
                                            </td>
                                            <td width="65%">
                                                <div id="capaCorrespondencia">
                                                    No Hay Actividad Seleccionada
                                                </div>
                                            </td>
                                            <td width="5%">&nbsp;</td>
                                        </tr>
                                        <tr>
                                             <td width="5%">&nbsp;</td>
                                            <td width="25%">
                                                <b>Analista:</b>
                                            </td>
                                            <td width="65%">
                                                <div id="capaAnalista">
                                                    <select id="id_contacto" name="id_contacto" style="width:100%">
                                                        <option value="0">Seleccione</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td width="5%">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="5%">&nbsp;</td>
                                            <td width="25%">
                                                <b>Analistas Asignados:</b>
                                            </td>
                                            <td width="65%">
                                                <div id="capaAnalistasAsignados" style="height:100px; width:100%; overflow-y:scroll; border:1px #CCCCCC solid">
                                                </div>
                                            </td>
                                            <td width="5%">&nbsp;</td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                            <?php } ?>
                            <?php if($accionVerMisActividades){ ?>
                            <div id="country3" class="tabcontent" style="height:100%; overflow-y:auto">
                                <table border='0' class='tablaTitulo' width='100%'>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                                    <tr>
                                        <td>
                                            <div id="capaActividades" style="width:100%;" align="left">
                                                <div align="center"><img src="../comunes/images/ajax-loader.gif"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <script type="text/javascript">
            var countries=new ddtabcontent("countrytabs");
            countries.setpersist(false);
            countries.setselectedClassTarget("link");
            countries.init();
        </script>
    </body>
</html>
