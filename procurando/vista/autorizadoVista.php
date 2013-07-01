<?php
    session_start();
    require_once '../controlador/autorizadoControlador.php';
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    $xajax= new xajax();
    $xajax->registerFunction('llenarSelectModelos');
    $xajax->registerFunction('verEstados');
    $xajax->registerFunction('insertAutorizado');
    $xajax->registerFunction('updateAutorizado');
	$xajax->processRequest();
    $xajax->printJavascript('../comunes/xajax/');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="pragma" content="no-cache">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" >
        <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" >
        <link href="../comunes/css/general.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/enlaces.css" rel="stylesheet" type="text/css" />
        <script src="../comunes/js/mootools.js" type="text/javascript"></script>
        <script src="../comunes/js/funciones.js" type="text/javascript"></script>
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        <script language="javascript">
            function validar(){
                llenarEstados();
                if(document.frmautorizar.accion.value == 'INS'){
                    xajax_insertAutorizado(xajax.getFormValues('frmautorizar'));
                }
            }
            function llenarEstados(){
				var cadena= "";
				for (i=0;i<document.frmautorizar.elements.length;i++){
					if(document.frmautorizar.elements[i].type == "checkbox"){
						if(document.frmautorizar.elements[i].checked){
							cadena += document.frmautorizar.elements[i].value+","
						}
					}
				}
				document.frmautorizar.strestados.value= cadena;
			}
        </script>
    </head>
    <body onload="xajax_llenarSelectModelos();">
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frmautorizar" id="frmautorizar" method="post">
                <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
                <input type="hidden" id="id_perfil_maestro" name="id_perfil_maestro" value="<?= $_REQUEST['idPerfil'] ?>">
                <input type="hidden" id="id_autorizados_est" name="id_autorizados_est" value="">
                <input type="hidden" id="strestados" name="strestados" value="">
                <input type="hidden" id="accion" name="accion" value="">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="65%" class="menu_izq_titulo">Asignar Estados</td>
                        <td width="10%" align="center" class="menu_izq_titulo">
                            <img src="../comunes/images/16_save.gif" onmouseover="Tip('Guardar Estados')" onmouseout="UnTip()" border="0" onclick="validar();"/>
                            <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='perfilesVista.php'"/>
                        </td>
                    </tr>
                    <tr>
                        <table width="100%" border="0" class="tablaTitulo">
                            <tr>
                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                    <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                        <strong>Estados</strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="110" colspan="4">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="110">&nbsp;</td>
                                <td>
                                    <label id="lid_meestados_maestros">
                                        Modelos de Estados:
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <div id='capaMeestados'>
                                            <select id='id_meestados_maestros' name='id_meestados_maestros' style='width:90%'>
                                                <option value="0">Seleccione</option>
                                            </select>
                                        </div>
                                    </label>
                                </td>
                                <td width="110">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="110">&nbsp;</td>
                                <td height="30">
                                    <label id="lnombre_perfil_maestro">
                                        Perfil:
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <?= $_REQUEST['nombrePerfil'] ?>
                                    </label>
                                </td>
                                <td width="110">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="110">&nbsp;</td>
                                <td colspan="2">
                                    <div id="capaestados">

                                    </div>
                                </td>
                                <td width="110">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="110" colspan="4">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="6" style="border:#CCCCCC solid 1px;">
                                    <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                        <br>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </tr>
                </table>
             </form>
        </center>
    </body>
</html>