<?php
    session_start();
    require_once "../controlador/tblprohonorariosControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    require_once '../modelo/clPermisoModelo.php';
    require_once '../modelo/clConstantesModelo.php';
    $xajax= new xajax();
    $xajax->registerFunction('selectAllHonorarios');
    $xajax->registerFunction('llenarSelectTipoHonorario');
    $xajax->registerFunction('llenarSelectTipoTramite');    
    $xajax->registerFunction('llenarSelectTipoAno');
    
//    $xajax->registerFunction('selectFiltrosHonorarios');
//    $xajax->registerFunction('llenarDestinatarios');
    $xajax->processRequest();
    $xajax->printJavascript('../comunes/xajax/');
    
    if ($_SESSION['id_oficina']=='L') {
        $formulario='honorario_litigio';
        $accion='acciones_honorario_litigio';
    }
    else {
        $formulario='honorarios';
        $accion='acciones_abogados_honorarios';
    }
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
                if (confirm('¿Seguro desea modificar el Honorario?')){
        	    document.location.href='vista_Ingresotblprohonorarios.php?id='.id;
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
            function filtrar(){
                var id_tipo= document.frmhonorarios.id_tipo.value;
                var id_tramite= document.frmhonorarios.id_tramite.value;
                var id_unidad= document.frmhonorarios.id_unidad.value;
                xajax_selectAllHonorarios(id_tipo, id_tramite, id_unidad);                        
                ver('formulario');
            }
        </script>
    </head>
    <body onload="xajax_selectAllHonorarios();xajax_llenarSelectTipoHonorario();xajax_llenarSelectTipoTramite();xajax_llenarSelectTipoAno();">
        <form name="frmhonorarios" id="frmhonorarios" method="post" style="">
            <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Conceptos Contables ú Honorarios<div id='capaMaestro'></div></td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <img src="../comunes/images/filter.png" onmouseover="Tip('Filtros')" onmouseout="UnTip()" border="0" onclick="ver('formulario');"/>&nbsp;&nbsp;
                        <?php 
                        if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($formulario),'nuevo', clConstantesModelo::$accion())) {?>
                        <img src="../comunes/images/page_add.png" onmouseover="Tip('Nuevo Honorario')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='vista_Ingresotblprohonorarios.php'"/>                        
                        <?php }?>
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
                                            Tipo de Honorario:
                                        </td>
                                        <td width="30%">
                                            <div id="capaTipo">
                                                <select id='id_tipo' name='id_tipo' style='width:100%'>
                                                    <option value='0'>Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td width="20%">
                                            Tipo de Tramite:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipoTramite">
                                                <select id='id_tramite' name='id_tramite' style='width:100%'>
                                                    <option value='0'>Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                   <tr>
                                        <td width="20%">
                                            Tipo de Honorario:
                                        </td>
                                        <td width="30%">
                                            <div id="capaAno">
                                                <select id='id_unidad' name='id_unidad' style='width:100%'>
                                                    <option value='0'>Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td width="20%">
                                           
                                        </td>
                                        <td width="30%">
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