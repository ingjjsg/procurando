<?php
    session_start();
    if (($_SESSION['login']!='') and ($_SESSION['password']!=''))
    {
        $body='<body bgcolor="#ffffff" onload="verificar_usuario_intranet(\''.$_SESSION['login'].'\',\''.$_SESSION['password'].'\')" >';
        $espere='<img src="imagenes/nada_webco.gif" border="0"/>';

    }
    else
    {
        $body='<body bgcolor="#ffffff"' ;
        $espere="";
    }
    require_once "../controlador/contactoControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');

    $xajax= new xajax();
    $xajax->registerFunction('verificarIngreso');
    $xajax->registerFunction('verificarIngresoIntranet');
	$xajax->processRequest();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
            $xajax->printJavascript('../comunes/xajax/');
        ?>
        <title>PROCURADURÍA | PROCURANDO</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="../comunes/js/prototype.js" type="text/javascript"></script>
        <script src="../comunes/js/index.js" type="text/javascript"></script>
        <style type="text/css">
            td img {
                display: block;
            }
            .Estilo1 {
                font-size: 21px;
                font-weight: bold;
                letter-spacing: -1px;
            }
            .Estilo2 {
                color: #000;
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
        </style>
        <link href="../comunes/css/general.css" rel="stylesheet" type="text/css" />
    </head>
<?php  echo $body ?>
        <center>
          <?php if ($espere!='')  echo $espere;
          else
          { ?>
            <table border="0" cellpadding="0" aling="center" cellspacing="0" width="899">
                <tr>
                    <td>
                        <img src="images/spacer.gif" width="627" height="1" border="0" alt="" />
                    </td>
                    <td>
                        <img src="images/spacer.gif" width="272" height="1" border="0" alt="" />
                    </td>
                    <td>
                        <img src="images/spacer.gif" width="1" height="1" border="0" alt="" />
                    </td>
                </tr>
                <!--<tr>
                    <td colspan="2">
                        <img name="img1" src="../comunes/images/cintillo_gobierno.png" width="899" height="63" border="0" id="img1" alt="" />
                    </td>
                    <td>
                        <img src="images/spacer.gif" width="1" height="63" border="0" alt="" />
                    </td>
                </tr>
                -->
                <tr>
                    <td colspan="2">
                        <img name="img2" src="../comunes/images/img2.gif" width="899" height="109" border="0" id="img2" alt="" />
                    </td>
                    <td>
                        <img src="images/spacer.gif" width="1" height="109" border="0" alt="" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <img name="img3" src="../comunes/images/img3.gif" width="627" height="357" border="0" id="img3" alt="" />
                    </td>
                    <td style="background-image:url(../comunes/images/img4-1.gif)">
                        <form name="form1" id="form1" method="post" onsubmit="xajax_verificarIngreso(xajax.getFormValues('form1'));return false;">
                            <table width="100%" align="center">
                                <tr>
                                    <?php if (isset($_REQUEST["key"])) $display = 'block'; else $display = 'none'; ?>
                                    <td align="center" colspan="2">
                                        <div id="noLog" align="center" style=" display:<?php echo $display;?>;-moz-border-radius:4px 4px 4px 4px; border:4px solid #c17878;width:75%; background:#c17878;color:#FFFFFF">
                                            <b>&iexcl;Debe hacer Login!</b>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding-bottom:5px">
                                        <span class="Estilo2">Usuario</span>
                                    </td>
                                    <td align="left" style="padding-bottom:10px">
                                        <input type="text" name="strlogin" id="strlogin" style="font-size:10px;height:15px;margin:0px;padding:0px;width:112px;border:1px solid #BBBBBB;"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" class="Estilo2" style="padding-bottom:5px">
                                         <span class="Estilo2">Contrase&ntilde;a</span>
                                     </td>
                                    <td align="left" style="padding-bottom:10px">
                                        <input type="password" name="strpassword" id="strpassword" style="font-size:10px;height:15px;margin:0px;padding:0px;width:112px;border:1px solid #BBBBBB;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-bottom:15px" colspan="2">
                                        <input type="submit" name="boton" id="boton" value="Login" onclick="xajax_verificarIngreso(xajax.getFormValues('form1'));" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="2">
                                        <a href="#">&iquest;Olvido su contrase&ntilde;a?</a>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </td>
                    <td>
                        <img src="images/spacer.gif" width="1" height="357" border="0" alt="" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <img name="img5" src="../comunes/images/img5-modificado.gif" width="899" height="65" border="0" id="img5" alt="" />
                    </td>
                    <td>
                        <img src="images/spacer.gif" width="1" height="65" border="0" alt="" />
                    </td>
                </tr>
            </table>
            <?php } ?>
        </center>
    </body>
</html>
