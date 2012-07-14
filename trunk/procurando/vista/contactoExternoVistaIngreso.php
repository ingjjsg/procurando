<?php
    session_start();
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    require_once '../controlador/contactoExternoControlador.php';

    $xajax= new xajax();
    $xajax->registerFunction('insertContactoExterno');
    $xajax->registerFunction('updateContactoExterno');
	$xajax->processRequest();
    $xajax->printJavascript('../comunes/xajax/');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
			$xajax->printJavascript('../comunes/xajax/')
		?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="pragma" content="no-cache">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" >
        <link href="../comunes/css/general.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/enlaces.css" rel="stylesheet" type="text/css" />
        <script src="../comunes/js/funciones.js" type="text/javascript"></script>
        <script src="../comunes/js/prototype.js" type="text/javascript"></script>
         <script src="../comunes/js/jquery.js" type="text/javascript"></script>
        <script src="../comunes/js/jquery.maskedinput.js" type="text/javascript"></script>
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        <script language="javascript">
            jQuery(function($){
                $("#strtelefono").mask("(0999) 999.99.99",{placeholder:" "});
            });
            function validar(acc){
                if(acc == 'INS'){
                    xajax_insertContactoExterno(xajax.getFormValues('frmcontactoexterno'));
                }else if(acc == 'ACT'){
                    xajax_updateContactoExterno(xajax.getFormValues('frmcontactoexterno'));
                }
            }
        </script>
    </head>
    <body onload="">
        <center>
            <form name="frmcontactoexterno" id="frmcontactoexterno" method="post">
                <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
                <input type="hidden" name="id_contacto_externo" id="id_contacto_externo" value="<?= $_REQUEST['id'] ?>">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="65%" class="menu_izq_titulo">Contacto Externo</td>
                        <td width="10%" align="center" class="menu_izq_titulo">
                            <img src="../comunes/images/16_save.gif" onmouseover="Tip('Guardar Contacto Externo')" onmouseout="UnTip()" border="0" onclick="validar('<?php echo $_REQUEST['acc'] ?>');"/>
                            <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='contactoExternoVista.php'"/>
                        </td>
                    </tr>
                    <tr>
                        <table width="100%" border="0"  class="tablaTitulo" >
                            <tr>
                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                    <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                        <strong>Datos</strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="1">&nbsp;</td>
                                <td width="95">
                                    <label id="lstrtrato">
                                        Trato:
                                    </label>
                                </td>
                                <td width="176">
                                    <label>
                                        <input name="strtrato" type="text" class="inputbox" id="strtrato" value="<?= $_REQUEST['trato'] ?>" maxlength="20">
                                    </label>
                                </td>
                                <td width="89">
                                    <label id="lstrcontactoext">
                                        Nombres Completo:
                                    </label>
                                </td>
                                <td width="199">
                                    <input name="strcontactoext" type="text" class="inputbox" id="strcontactoext" value="<?= $_REQUEST['nombres'] ?>" maxlength="100">
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <label id="lstrinstitucion">
                                        Instituci&oacute;n:
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input name="strinstitucion" type="text" class="inputbox" id="strinstitucion" maxlength="200" value="<?= $_REQUEST['institucion'] ?>">
                                    </label>
                                </td>
                                <td>
                                    <label id="lstrcargo">Cargo:</label>
                                </td>
                                <td>
                                    <input name="strcargo" type="text" class="inputbox" id="strcargo" value="<?= $_REQUEST['cargo'] ?>" maxlength="150">
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <label id="lstrtelefono">
                                        Telefono:
                                    </label>
                                </td>
                                <td>
                                    <input name="strtelefono" type="text" class="inputbox" maxlength="50" id="strtelefono" value="<?= $_REQUEST['tlfn'] ?>">
                                </td>
                                <td>
                                    <label id="lstrext">
                                        Email:
                                    </label>
                                </td>
                                <td>
                                    <input name="stremail" type="text" class="inputbox" id="stremail" value="<?= $_REQUEST['email'] ?>" maxlength="100"/>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <label id="lstrdireccion">
                                        Direcci&oacute;n:
                                    </label>
                                </td>
                                <td colspan="4">
                                    <label>
                                        <textarea name="strdireccion" id="strdireccion" class="textareabox" cols="15"><?= $_REQUEST['direccion'] ?></textarea>
                                    </label>
                                </td>
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