<?php
    session_start();
    session_destroy();
    require_once "../controlador/contactoControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');

    $xajax= new xajax();
    $xajax->registerFunction('verificarIngreso');
	$xajax->processRequest();
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
            $xajax->printJavascript('../comunes/xajax/');
        ?>
        <title>INDER | PROCURANDO</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" >
        <link rel="shortcut icon" href="../comunes/images/favicon.ico" type="image/x-icon" >
        <script src="../comunes/js/run2.js" type="text/javascript"></script>
        <link href="../comunes/css/general.css" rel="stylesheet" type="text/css" />
        <script src="../comunes/js/prototype.js" type="text/javascript"></script>
        <style type="text/css">
            <!--
            .Estilo1 {
                font-size: 21px;
                font-weight: bold;
                letter-spacing: -1px;
            }
            .Estilo2 {
                color: #CC0000;
                font-weight: bold;
            }
            .input {
                font-size: 12px;
                font-family: Arial, Helvetica, sans-serif;
                color: #333333;
                width: 150px;
                margin: 0px;
                padding: 0px;
                text-align: center;
            }
            .mensaje_error {
                background-color: #FFFF66;
                padding: 5px;
                height: auto;
                width: 200px;
                font-size: 11px;
                margin-top: 5px;
                margin-right: 0px;
                margin-bottom: 5px;
                margin-left: 0px;
                border: 1px dashed #999999;
            }
            -->
        </style>
    </head>
    <body>
        <center>
            <table width="700" border="0">
                <tr>
                    <td>
                        <div class="contenedor_general">
                            <?php
                                include('./cabecero.php');
                                include('../comunes/php/utilidades.php');
                            ?>
                            <div class="identificacion">
                                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                    <tr>
                                        <td align="left" width="33%">
                                            <strong>Bienvenido</strong>
                                        </td>
                                        <td align="center" width="33%">
                                            <strong>Venezuela,</strong>
                                            <?php
                                                echo fechaActualCompleta();
                                            ?>
                                        </td>
                                        <td align="right" width="33%">
                                            <a href="#" target="contenido">Ayuda</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="50%" align="center">
                        <div class="desarrollo_superior2">&nbsp;</div>
                            <div class="desarrollo_contenedor2">
                                <table border="0" width="850" align="center">
                                    
                                    <tr>
                                        <td valign="middle">
                                            <img src="../comunes/images/inicio_blanco.gif" width="100%" height="100%" align="middle"/>
                                            <br><br>
                                                <img src="../comunes/images/Untitled.jpg" width="20" height="20">&nbsp;&nbsp;&nbsp;
                                                <b>La sesi&oacute;n expirar&aacute; si se encuentra inactiva por un per&iacute;odo de 5 minutos</b>
                                            <br><br>
                                        </td>
                                        <td>
                                            <div class="formulario_inicio">
                                                <form name="form1" id="form1" method="post" onsubmit="xajax_verificarIngreso(xajax.getFormValues('form1'));return false;">
                                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td align="center" style="padding-top:25px">
                                                                <span class="Estilo1">Ingresar</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <?php if (isset($_REQUEST["key"])) $display = 'block'; else $display = 'none'; ?>
                                                            <td align="center">
                                                                <div id="noLog" align="center" style=" display:<?php echo $display;?>;-moz-border-radius:4px 4px 4px 4px; border:4px solid #c17878;width:75%; background:#c17878;color:#FFFFFF">
                                                                    <b>&iexcl;Debe hacer Login!</b>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="padding-bottom:5px">
                                                                <span class="Estilo2">Usuario</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="padding-bottom:10px">
                                                                <input type="text" name="strlogin" id="strlogin" style="font-size:10px;height:15px;margin:0px;padding:0px;width:112px;border:1px solid #BBBBBB;"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" class="Estilo2" style="padding-bottom:5px">
                                                                 <span class="Estilo2">Contrase&ntilde;a</span>
                                                             </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="padding-bottom:10px">
                                                                <input type="password" name="strpassword" id="strpassword" style="font-size:10px;height:15px;margin:0px;padding:0px;width:112px;border:1px solid #BBBBBB;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="padding-bottom:15px">
                                                                <input type="submit" name="boton" id="boton" value="Login" onclick="xajax_verificarIngreso(xajax.getFormValues('form1'));" style="background-color:#B9D5E3;border:1px outset #B9D5E3;color:#004E7D;cursor:pointer;margin:1px;padding:1px; width:168px; font-size:11px;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center">
                                                                <a href="#">&iquest;Olvido su contrase&ntilde;a?</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        <div class="desarrollo_inferior2">&nbsp;</div>
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>
 