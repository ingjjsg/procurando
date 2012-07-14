<?php
    session_start();
    require_once "../controlador/contactoControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');

    $xajax= new xajax();
    $xajax->registerFunction('updateContactoPassword');
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
        <script src="../comunes/js/validacionPassword.js" type="text/javascript"></script>
        <script src="../comunes/js/prototype.js" type="text/javascript"></script>
         <script src="../comunes/js/jquery.js" type="text/javascript"></script>
        <script src="../comunes/js/jquery.maskedinput.js" type="text/javascript"></script>
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        <script language="javascript">
        </script>
    </head>
    <body>
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frmcontacto" id="frmcontacto" method="post">
                <input type="hidden" id="id_contacto" name="id_contacto" value="<?= $_SESSION['id_contacto'] ?>">
                <table width="100%" border="0"  class="tablaTitulo" >
                    <tr>
                        <td width="100%" colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="100%" colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="20%">&nbsp;</td>
                        <td width="30%">
                            <label id="lstrlogin">
                                Login:
                            </label>
                        </td>
                        <td width="30%">
                            <input name="strlogin" type="password" class="inputbox" id="strlogin" value="" />
                        </td>
                        <td width="20%">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="20%">&nbsp;</td>
                        <td width="30%">
                            <label id="lstremail">
                                Email:
                            </label>
                        </td>
                        <td width="30%">
                            <input name="stremail" type="text" class="inputbox" id="stremail" value="" />
                        </td>
                        <td width="20%">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="20%">&nbsp;</td>
                        <td width="30%">
                            <label id="lid_dpto_maestro">
                                Departamento:
                            </label>
                        </td>
                        <td width="30%">
                            <select id='id_dpto_maestro' name='id_dpto_maestro'>
                                <option value='0'>Seleccione</option>
                            </select>
                        </td>
                        <td width="20%">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="100%" colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="20%">&nbsp;</td>
                        <td width="60%" colspan="2" align="center">
                            <input type="button" name="button" id="button" value="Enviar" onclick="" style="background-color:#B9D5E3;border:1px outset #B9D5E3;color:#004E7D;cursor:pointer;margin:1px;padding:1px; width:168px; font-size:11px;"/>
                        </td>
                        <td width="20%">&nbsp;</td>
                    </tr>
                </table>
             </form>
        </center>
    </body>
</html>