<?php
    session_start();
    require_once "../controlador/controlador_ingresoJuridica.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    require_once '../modelo/clPermisoModelo.php';
    require_once '../modelo/clConstantesModelo.php';
    if ($_SESSION['id_oficina']=='L') {
        $formulario='asociaciones_litigio';
        $accion='acciones_asociaciones_litigio';
    }
    else {
        $formulario='asociaciones';
        $accion='acciones_asociaciones';
    }
    $xajax= new xajax();
    $xajax->registerFunction('selectAllJuridicas');
    $xajax->registerFunction('eliminarAsociacion');
    $xajax->registerFunction('llenarSelectTipoRamo');
    $xajax->registerFunction('llenarId_municipioAsociacion');
    $xajax->registerFunction('llenarSelectParroquiaAsociacion');    
    $xajax->registerFunction('formfiltro');
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
                var id_municipio_asociacion= document.frmaAsociacion.id_municipio_asociacion.value;
                var id_parroquia_asociacion= document.frmaAsociacion.id_parroquia_asociacion.value;
                var id_ramo= document.frmaAsociacion.id_ramo.value;
                var strrif= document.frmaAsociacion.strrif.value;                
                xajax_selectAllJuridicas(id_municipio_asociacion, id_parroquia_asociacion, id_ramo, strrif);                        
                ver('formulario');
            }
        </script>        
    </head>
    <body onload="xajax_selectAllJuridicas();xajax_llenarSelectTipoRamo('frmaAsociacion');xajax_llenarId_municipioAsociacion('frmaAsociacion');">
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <script src="../comunes/js/prototype.js" type="text/javascript"></script>
        <script src="../comunes/js/negocio/js_ingresoJuridica.js" type="text/javascript"></script>
        <script type="text/javascript" src="../comunes/js/effects.js"></script>
        <!--<script type="text/javascript" src="../comunes/js/scriptaculous.js"></script>-->
        <form name="frmaAsociacion" method="post">
            <input type="hidden" name="iduser" value="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Asociaciones Juridica</td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                       <?php 
                        if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($formulario),'nuevo', clConstantesModelo::$accion())) {
                        echo "<img src=\"../comunes/images/group.png\" onmouseover=\"Tip('Nueva Asociación')\" onmouseout=\"UnTip()\" onclick=\"javascript:location.href='vista_ingresoAsosiacion.php'\"/>";
                        }?>
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
                                            Municipio:
                                        </td>
                                        <td width="30%">
                                            <div id="capaMunicipio">
                                                <select id="id_municipio_asociacion" name="id_municipio_asociacion" style='width:50%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                         <td width="20%">
                                            Parroquia:
                                        </td>
                                        <td width="30%">
                                            <div id="capaParroquia">
                                                <select id="id_parroquia_asociacion" name="id_parroquia_asociacion" style='width:50%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>                                    
                                     <tr>
                                        <td width="20%">
                                            Ramo:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipoRamo">
                                                <select id="id_ramo" name="id_ramo" style='width:50%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>   
                                        <td width="20%">
                                            RIF:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="strrif" name="strrif" size="30" />                                            
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
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
