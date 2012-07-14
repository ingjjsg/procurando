<?php
    session_start();
    include("../comunes/fckeditor/fckeditor.php") ;
    require_once "../controlador/controlador_cambioclave.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    

    $xajax= new xajax();
   
    $xajax->registerFunction('DetalleBuscaCorreo');

    $xajax->registerFunction('DetalleBuscaDatos');
    $xajax->registerFunction('GuardarSeguridad');

 

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
        <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
        <link href="../comunes/css/general.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/enlaces.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/calendar-blue2.css" rel="stylesheet" type="text/css" media="all" title="win2k-cold-1" />
        <link href="../comunes/css/tabcontent.css" rel="stylesheet" type="text/css"  />
        <link rel='StyleSheet' href='../comunes/js/dtree.css' type='text/css' />
        <script src="../comunes/js/jquery.js" type="text/javascript"></script>
        <script src="../comunes/js/jquery.maskedinput.js" type="text/javascript"></script>
        <script type='text/javascript' src='../comunes/js/dtree.js'></script>
        <script type='text/javascript' src='../comunes/js/funciones.js'></script>
        <script type='text/javascript' src='../comunes/js/index.js'></script>
        <script type="text/javascript" src="../comunes/js/prototype.js"></script>
        <script type="text/javascript" src="../comunes/js/effects.js"></script>
        <script type="text/javascript" src="../comunes/js/scriptaculous.js"></script>
        <script type="text/javascript" src="../comunes/js/tabcontent.js"></script>
        <script src="../comunes/js/utilidades.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_es.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_setup.js" type="text/javascript"></script>




        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        <script language="javascript">
            jQuery(function($){
                $("#strtelefono").mask("(9999) 999.99.99",{placeholder:" "});
            });
        </script>
    </head>
    <body onload="buscar_datos()" >
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frmpersona" id="frmpersona" method="post">

                <div id="principal">

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>

                            <td width="65%" class="menu_izq_titulo">Datos Personales</td>
                            <td width="20%" align="center" class="menu_izq_titulo">
                                <?php echo '<img src="../comunes/images/16_save.gif" onmouseover="Tip(\'Guardar datos de cuenta\')" onmouseout="UnTip()" border="0" onclick="xajax_GuardarSeguridad(xajax.getFormValues(\'frmpersona\'))"/>'; ?>
                               
                                <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript: window.history. back()"/>
                            </td>
                        </tr>
                    </table>



                    <table table width="100%" border="0"  class="tablaTitulo" >
                        <tr>
                            <td colspan="6" style="border:#CCCCCC solid 1px;">
                                <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                    <strong>&nbsp;</strong>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="89">
                                Nombre:
                            </td>
                            <td width="176">
                                <input name="strnombre" tabindex=1 type="text" class="inputbox" id="strnombre" />
                            </td>
                            <td width="1">&nbsp;</td>
                            <td width="30">
                                Teléfono de Contacto:
                            </td>
                            <td width="100">
                                <input onKeyPress="javascript:return validaTelefono(event)" name="strtelefono"  tabindex=3 type="text" style="background-color:#FFFFFF;border:1px solid #666666;font-size:11px;padding:2px;width:500px;" class="inputbox" id="strtelefono"/>
                            </td>
                        </tr>
                        <tr>
                        <td width="89">
                            Apellidos:
                        </td>
                        <td width="176">
                            <input name="strapellido"  type="text" class="inputbox" id="strapellido" />
                        </td>
                            <td width="1">&nbsp;</td>
                            <td width="30">
                                Correo:
                            </td>
                            <td width="100">
                               <input name="stremail" onblur="buscar_Correo(document.frmpersona.stremail.value)" type="text" style="background-color:#FFFFFF;border:1px solid #666666;font-size:11px;padding:2px;width:500px;" class="inputbox" id="stremail"/>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>

                            <td width="100%" class="menu_izq_titulo">Seguridad</td>
                        </tr>
                    </table>
                   <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <table width="100%" border="0"  class="tablaTitulo" >
                                <tr>
                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                        <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                            <strong>&nbsp;</strong>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="89">
                                        Clave Anterior:
                                    </td>
                                    <td width="176">
                                        <input name="strclaveanterior"  type="password" class="inputbox" id="strclaveanterior" value="" />
                                    </td>
                                    <td width="1">&nbsp;</td>
                                    <td width="30">&nbsp;</td>
                                    <td width="100">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="89">
                                        Clave:
                                    </td>
                                    <td width="176">
                                        <input name="strclave"  type="password" class="inputbox" id="strclave"value="" />
                                    </td>
                                    <td width="1">&nbsp;</td>
                                    <td width="30">&nbsp;</td>
                                    <td width="100">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="89">
                                        Clave:
                                    </td>
                                    <td width="176">
                                        <input name="strreclave"  type="password" class="inputbox" id="strreclave" value="" />
                                    </td>
                                    <td width="1">&nbsp;</td>
                                    <td width="30">&nbsp;</td>
                                    <td width="100">&nbsp;</td>
                                </tr>
                            </table>
                        </tr>
                    </table>
                </div>
            </form>
        </center>
    </body>
</html>