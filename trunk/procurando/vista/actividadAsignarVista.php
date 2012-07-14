<?php
    session_start();
    require_once '../controlador/actividadControlador.php';
    require_once '../controlador/contactoControlador.php';
    require_once '../comunes/xajax/xajax_core/xajax.inc.php';

    $accionVerTodasActividades= verAccion($_SESSION['id_profile'], 105, 149);
    $accionCrear= verAccion($_SESSION['id_profile'], 105, 150);
    $accionAsignar= verAccion($_SESSION['id_profile'], 105, 151);
    $accionAsignarAnalista= verAccion($_SESSION['id_profile'], 105, 152);

    $xajax= new xajax();
    $xajax->registerFunction('llenarSelectPrioridad');
    $xajax->registerFunction('insertActividad');
    $xajax->registerFunction('selectActividadByIdDestinatario');
    $xajax->registerFunction('llenarSelectActividad');
    $xajax->registerFunction('cargarGerencias');
    $xajax->registerFunction('cargarCoordinaciones');
    $xajax->registerFunction('cargarAnalista');
    $xajax->registerFunction('insertDepartamentoActividad');
    $xajax->registerFunction('llenarSelectAnalista');
    $xajax->registerFunction('selectContactosActividadByIdActividad');
    $xajax->registerFunction('insertContactoActividad');
    $xajax->registerFunction('deleteContactoActividad');
    $xajax->registerFunction('verDetallesActividad');
    $xajax->registerFunction('deleteActividad');
    $xajax->registerFunction('permisosActividades');
    $xajax->registerFunction('selectDepartamentosActividadByIdActividad');
    $xajax->registerFunction('deleteDepartamentoActividad');
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
            function carga(idDest){
                xajax_llenarSelectPrioridad('70%');
                xajax_selectActividadByIdDestinatario(idDest);
                xajax_cargarGerencias();
            }
            function limpiar(){
                document.frmactividad.memtitulo.value= "";
                document.frmactividad.id_prioridad_maestro.value= 0;
                document.frmactividad.strdescripcion.value= "";
                document.frmactividad.dtmasignacion.value= "";
            }
            function validar(acc){
                if (!campoRequerido(document.frmactividad.memtitulo,"Titulo")) return false;
                if (!validaSelect(document.frmactividad.id_prioridad_maestro,'Prioridad'))return false;
                if (!campoRequerido(document.frmactividad.strdescripcion,"Acciones")) return false;
                if (!campoRequerido(document.frmactividad.dtmresolucion,"Fecha de Resolución")) return false;
                /*if(document.frmactividad.fecha_actual.value < document.frmactividad.dtmresolucion.value){
                    alert('La fecha de asignación no puede ser menor que la fecha de inicio de la actividad');
                    return false;
                }*/
                xajax_insertActividad(xajax.getFormValues('frmactividad'));
            }
            function validarAsignar(){
                if (!validaSelect(document.frmasignar.id_actividad,'Actividad'))return false;
                xajax_insertDepartamentoActividad(xajax.getFormValues('frmasignar'));
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
            function ocultar(id, msj) {
                var log = $(id);
                log.innerHTML= msj;
                log.style.backgroundColor= '#fff36f';
                log.style.padding= '5px';
                new Effect.Fade(id, {from: 1, to: 0, duration: 2.0});
                new Effect.SlideUp(id, {queue: 'parallel', duration: 2.0});
            }
            function eliminarActividad(id){
                if (confirm('¿Seguro desea eliminar la actividad con el Id: '+id+'?')){
                    xajax_deleteActividad(id);
                }
            }
        </script>
    </head>
    <body onload="carga(<?= $_REQUEST['idDest'] ?>)">
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
                            <?php //if($accionVerTodasActividades){ ?>
                            <li>
                                <a id="link1" href="#" rel="country1" class="selected">Actividades</a>
                            </li>
                            <?php //} ?>
                            <?php //if($accionCrear){ ?>
                            <li>
                                <a id="link2" href="#" rel="country2">Crear Actividad</a>
                            </li>
                            <?php //} ?>
                            <?php //if($accionAsignar){ ?>
                            <li>
                                <a id="link3" href="#" rel="country3">Asignar</a>
                            </li>
                            <?php //} ?>
                            <?php //if($accionAsignarAnalista){ ?>
                            <li>
                                <a id="link4" href="#" rel="country4">Asignar Analista</a>
                            </li>
                            <?php //} ?>
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
                                            <b><?php echo "Actividades de: ".$_REQUEST['tipoD']." ".$_REQUEST['correlativo']; ?></b>
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
                            <?php //if($accionCrear){ ?>
                            <div id="country2" class="tabcontent" style="height:100%; overflow-y:auto">
                                <form name="frmactividad" id="frmactividad" method="post">
                                    <input type="hidden" id="id_destinatarios" name="id_destinatarios" value="<?= $_REQUEST['idDest'] ?>">
                                    <input type="hidden" id="id_contacto" name="id_contacto" value="<?= $_SESSION['id_contacto'] ?>">
                                    <input type="hidden" id="id_estatus_maestro" name="id_estatus_maestro" value="247">
                                    <input type="hidden" id="fecha_actual" name="fecha_actual" value="<?= date('d/m/Y') ?>">
                                    <input type="hidden" id="id_actividad" name="id_actividad" value="">
                                    <table border='0' class='tablaTitulo' width='100%'>
                                        <tr>
                                            <td colspan="3" width="100%">&nbsp;</td>
                                            <td><img src="../comunes/images/16_save.gif" onmouseover="Tip('Guardar Actividad')" onmouseout="UnTip()" border="0" onclick="validar('<?= $_REQUEST['acc'] ?>');"/></td>
                                        </tr>
                                        <tr>
                                            <td width="5%">&nbsp;</td>
                                            <td width="25%">
                                                <b>Documento:</b>
                                            </td>
                                            <td width="60%">
                                                <b><?php echo $_REQUEST['tipoD']." ".$_REQUEST['correlativo']; ?></b>
                                            </td>
                                            <td width="10%">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="5%">&nbsp;</td>
                                            <td width="25%">
                                                <b>Titulo:</b>
                                            </td>
                                            <td width="65%">
                                                <input type="text" id="memtitulo" name="memtitulo" value="" class="inputbox" style="width:70%">
                                            </td>
                                            <td width="5%">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="5%">&nbsp;</td>
                                            <td width="25%">
                                                <b>Prioridad:</b>
                                            </td>
                                            <td width="65%">
                                                <div id="capaPrioridad">
                                                    <select id="id_prioridad_maestro" name="id_prioridad_maestro" style="width:70%">
                                                        <option value="0">Seleccione</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td width="5%">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="5%">&nbsp;</td>
                                            <td width="80%" colspan="2">
                                                <b>Acciones:</b>
                                            </td>
                                            <td width="5%">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="5%">&nbsp;</td>
                                            <td width="80%" colspan="2">
                                                <textarea id="strdescripcion" name="strdescripcion" cols="50" rows="4" style="width:100%;" class="textareabox"></textarea>
                                            </td>
                                            <td width="5%">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="5%">&nbsp;</td>
                                            <td width="25%">
                                                <b>Fecha de Resoluci&oacute;n:</b>
                                            </td>
                                            <td width="65%">
                                                <input type="text" id="dtmresolucion" name="dtmresolucion" value="" class="inputbox" readonly>
                                                <img name="button"  id="lanzador1"  src="../comunes/images/calendar.png" align="middle"/>
                                                <script type="text/javascript">
                                                    Calendar.setup({
                                                        inputField     :    "dtmresolucion",      // id del campo de texto
                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                        button         :    "lanzador1"   // el id del botn que lanzar el calendario
                                                    });
                                                </script>
                                            </td>
                                            <td width="5%">&nbsp;</td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                            <?php //} ?>
                            <?php //if($accionAsignar){ ?>
                            <div id="country3" class="tabcontent" style="height:100%; overflow-y:auto">
                                <form id="frmasignar" name="frmasignar" method="post">
                                    <table border='0' class='tablaTitulo' width='100%'>
                                        <tr>
                                            <td colspan="3" width="100%" align="center">
                                                <b><?php echo "Actividades de: ".$_REQUEST['tipoD']." ".$_REQUEST['correlativo']; ?></b>
                                            </td>
                                            <td><img src="../comunes/images/16_save.gif" onmouseover="Tip('Asignar Departamento')" onmouseout="UnTip()" border="0" onclick="javascript:validarAsignar()"/></td>
                                        </tr>
                                        <tr>
                                             <td width="5%">&nbsp;</td>
                                            <td width="25%">
                                                <b>Actividad:</b>
                                            </td>
                                            <td width="65%">
                                                <div id="capaActividad">
                                                    <select id="id_actividad" name="id_actividad" style="width:100%">
                                                        <option value="0">Seleccione</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td width="5%">&nbsp;</td>
                                        </tr>
                                        <?php if($_SESSION['id_profile'] == 112 || $_SESSION['id_profile'] == 117){ ?>
                                            <tr>
                                                <td width="5%">&nbsp;</td>
                                                <td width="25%">
                                                    <b>Gerencias:</b>
                                                </td>
                                                <td width="65%">
                                                    <div id="capaGerencia" style="height:90px; width:100%; overflow-y:scroll; border:1px #CCCCCC solid">
                                                    </div>
                                                </td>
                                                <td width="5%">&nbsp;</td>
                                            </tr>
                                        <?php }else{ ?>
                                            <input type="hidden" name="idGerencias[]" id="idGerencias[]" value="<?= $_SESSION['id_dpto_maestro'] ?>">
                                            <script>
                                                xajax_cargarCoordinaciones(xajax.getFormValues('frmasignar'));
                                            </script>
                                        <?php } ?>
                                        <tr>
                                            <td width="5%">&nbsp;</td>
                                            <td width="25%">
                                                <b>Coordinaciones:</b>
                                            </td>
                                            <td width="65%">
                                                <div id="capaCoordinacion" style="height:90px; width:100%; overflow-y:scroll; border:1px #CCCCCC solid">
                                                </div>
                                            </td>
                                            <td width="5%">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="5%">&nbsp;</td>
                                            <td width="25%">
                                                <b>Dependencias Asignadas</b>
                                            </td>
                                            <td width="65%">
                                                <div id="capaDependenciaAsignadas" style="height:80px; width:100%; overflow-y:scroll; border:1px #CCCCCC solid">
                                                </div>
                                            </td>
                                            <td width="5%">&nbsp;</td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                            <?php //} ?>
                            <?php //if($accionAsignarAnalista){ ?>
                            <div id="country4" class="tabcontent" style="height:100%; overflow-y:auto">
                                <form id="frmanalista" name="frmanalista" method="post">
                                    <input type="hidden" id="id_estatus_maestro" name="id_estatus_maestro" value="249">
                                    <input type="hidden" id="id_contacto_asigna" name="id_contacto_asigna" value="<?= $_SESSION['id_contacto'] ?>">
                                    <table border='0' class='tablaTitulo' width='100%'>
                                        <tr>
                                            <td colspan="3" width="100%" align="center">
                                                <b><?php echo "Actividades de: ".$_REQUEST['tipoD']." ".$_REQUEST['correlativo']; ?></b>
                                            </td>
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
                            <?php //} ?>
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
