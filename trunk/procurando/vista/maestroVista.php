<?php
    session_start();

    require_once "../controlador/maestroControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    $xajax= new xajax();
    $xajax->registerFunction('selectAllMaestroPadresLike');
    $xajax->registerFunction('selectAllMaestroPadres');    
    $xajax->registerFunction('selectAllMaestroHijos');
    $xajax->registerFunction('formMaestro');
    $xajax->registerFunction('insertMaestro');
    $xajax->registerFunction('deleteMaestro');
    $xajax->registerFunction('updateMaestro');
    $xajax->registerFunction('llenarSelectFormularioSistemas');
    $xajax->registerFunction('orden');
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
<!--        <script type="text/javascript" src="../comunes/js/scriptaculous.js"></script>-->
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
            function eliminarMaestro(id_maestro){
                if (confirm('¿Seguro desea eliminar el Maestro?')){
                    xajax_deleteMaestro(id_maestro,xajax.getFormValues('frmcontacto'));
                }
            }
            function validar(acc){
                if(document.frmcontacto.stritema.value == ""){
                    alert('Debe ingresar un valor en el campo Nombre');
                    var e = document.getElementById('stritema');
                    e.style.borderColor= 'Red';
                    e.focus();
                    return false;
                }
                else{
                    if(acc == 'INS'){
                        xajax_insertMaestro(xajax.getFormValues('frmcontacto'));
                    }else if(acc == 'UPD'){
                        xajax_updateMaestro(xajax.getFormValues('frmcontacto'));
                    }
                    
                }
            }
        </script>
    </head>
    <?php
        $_SESSION["AD"]="ASC";
    ?>
    <body onload="xajax_selectAllMaestroPadres();xajax_llenarSelectFormularioSistemas();">
        <form name="frmcontacto" id="frmcontacto" method="post" style="">
            <input type="hidden" name="iduser" value="">
            <input type='hidden' name='id_origen' id='id_origen' value='0'>
            <input type='hidden' name='id_maestro' id='id_maestro' value='0'>
            <input type='hidden' name='id_sistema_buscado' id='id_sistema_buscado' value='0'>                
            <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Maestro<div id='capaMaestro'></div></td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <img src="../comunes/images/table_add.png" onmouseover="Tip('Nuevo Maestro')" onmouseout="UnTip()" border="0" onclick="xajax_formMaestro('INS');"/>
                        <div id='capaVolver' style="visibility:hidden;display:none">
                            <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver a Maestros Padres')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='../vista/maestroVista.php'"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="15%" class="menu_izq_titulo">Sistema</td>
                    <td width="85%" align="left" class="menu_izq_titulo">
                        <div id='capaFormulario2'>
                            <select id='id_sistema' name='id_sistema' style='width:90%'>
                                <option value="0">Seleccione</option>
                            </select>
                        </div>
                    </td>
                </tr>       
<!--                <tr>
                    <td width="15%" class="menu_izq_titulo">Origen</td>
                    <td width="85%" align="left" class="menu_izq_titulo">
                        <input type="text" class='inputbox82' id="id_origen" name="id_origen" size="30" />
                    </td>
                </tr>      -->
                <tr>
                    <td width="15%" class="menu_izq_titulo">Descripción</td>
                    <td width="85%" align="left" class="menu_izq_titulo">
                        <input type="text" class='inputbox82' id="stritema_busqueda" name="stritema_busqueda" size="30" onKeyDown="xajax_selectAllMaestroPadresLike(document.frmcontacto.stritema_busqueda.value,'id_maestro',document.frmcontacto.id_sistema.value);" onKeyUp="xajax_selectAllMaestroPadresLike(document.frmcontacto.stritema_busqueda.value,'id_maestro',document.frmcontacto.id_sistema.value);"/>
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
