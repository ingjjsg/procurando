<?php
    session_start();
    require_once "../controlador/asignarControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    $xajax= new xajax();
    $xajax->registerFunction('llenarSelectFormulario');
    $xajax->registerFunction('verAcciones');
    $xajax->registerFunction('insertAsignar');
    $xajax->registerFunction('updateAsignar');
    $xajax->registerFunction('llenarSelectFormularioSistemas');
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
            function home(){
                xajax_llenarSelectFormularioSistemas();
            }
            function validar(){
                llenarCategoria();
                if(document.frmAsignar.accion.value == 'INS'){
                    xajax_insertAsignar(xajax.getFormValues('frmAsignar'));
                }else if(document.frmAsignar.accion.value == 'ACT'){
                    xajax_updateAsignar(xajax.getFormValues('frmAsignar'));
                }                
            }
            function llenarCategoria(){
				var cadena= "";
				for (i=0;i<document.frmAsignar.elements.length;i++){
					if(document.frmAsignar.elements[i].type == "checkbox"){
						if(document.frmAsignar.elements[i].checked){
							cadena += document.frmAsignar.elements[i].value+","
						}
					}
				}
				document.frmAsignar.stracciones.value= cadena;
			}
        </script>
    </head>
    <body onload="home()">
        <center>
            <form name="frmAsignar" id="frmAsignar" method="post">
                <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
                <input type="hidden" id="id_accesoforma" name="id_accesoforma" value="">
                <input type="hidden" id="id_profile_maestro" name="id_profile_maestro" value="<?= $_REQUEST['idPerfil'] ?>">
                <input type="hidden" id="stracciones" name="stracciones" value="">
                <input type="hidden" id="accion" name="accion" value="">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="65%" class="menu_izq_titulo">Asignar Permisos</td>
                        <td width="10%" align="center" class="menu_izq_titulo">
                            <img src="../comunes/images/16_save.gif" onmouseover="Tip('Guardar Permiso')" onmouseout="UnTip()" border="0" onclick="validar();"/>
                            <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='perfilesVista.php'"/>
                        </td>
                    </tr>
                    <tr>
                        <table width="100%" border="0" class="tablaTitulo">
                            <tr>
                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                    <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                        <strong>Acciones</strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="110" colspan="4">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="110">&nbsp;</td>
                                <td>
                                    <label id="lformulario2">
                                        Sistema:
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <div id='capaFormulario2'>
                                            <select id='id_sistemas' name='id_sistemas' style='width:90%'>
                                                <option value="0">Seleccione</option>
                                            </select>
                                        </div>
                                    </label>
                                </td>
                                <td width="110">&nbsp;</td>
                            </tr>                            
                            <tr>
                                <td width="110">&nbsp;</td>
                                <td>
                                    <label id="lformulario">
                                        Formulario:
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <div id='capaFormulario'>
                                            <select id='id_menu_maestro' name='id_menu_maestro' style='width:90%'>
                                                <option value="0">Seleccione</option>
                                            </select>
                                        </div>
                                    </label>
                                </td>
                                <td width="110">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="110">&nbsp;</td>
                                <td>
                                    <label id="lacciones">
                                        Permisos:
                                    </label>
                                </td>
                                <td>
                                    <div id="capaAcciones">

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