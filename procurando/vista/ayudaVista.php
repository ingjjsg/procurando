<?php
    session_start();

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="pragma" content="no-cache">
        <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" >
        <link href="../comunes/css/general.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/enlaces.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/calendar-blue2.css" rel="stylesheet" type="text/css" media="all" title="win2k-cold-1" />
        <script src="../comunes/js/funciones.js" type="text/javascript"></script>
        <script src="../comunes/js/prototype.js" type="text/javascript"></script>
        <script type="text/javascript" src="../comunes/js/effects.js"></script>
        <script type="text/javascript" src="../comunes/js/scriptaculous.js"></script>
        <script src="../comunes/js/calendar.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_es.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_setup.js" type="text/javascript"></script>
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        <script language="javascript">
            function abrirVentana(){

            }
        </script>
    </head>
    <body onload="">
        <form name="frmayuda" id="frmayuda" method="post" style="">
            <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="90%" class="menu_izq_titulo">Ayuda del Sistema <div id="capaAyuda"></div></td>
                    <td width="10%" align="center" class="menu_izq_titulo">&nbsp;
                        <div id="capaRegresar" style="display:none">
                            <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Regresar')" onmouseout="UnTip()" border="0" onclick="location.href='reporteVista.php'"/>
                        </div>
                    </td>
                </tr>
            </table>
            <table width="100%" border="1" cellspacing="0" cellpadding="0" class='tablaTitulo'>
                <tr>
                    <td width="100%" colspan="4">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" width="100%">
                        <div id="filtros">
                            <table>
                                <tr>
                                    <td width="10%">&nbsp;</td>
                                    <td width="85%" colspan="2">
                                        <a href="../descargas/Manual Correspondencia.pdf" ><b><li>Manual del Sistema</li></b></a>
                                    </td>
                                    <td width="5%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="100%" colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="10%">&nbsp;</td>
                                    <td width="85%" colspan="2">
                                        <a href="../descargas/Directorio_INDER_Agosto.pdf" ><b><li>Directorio Telef&oacute;nico Institucional</li></b></a>
                                    </td>
                                    <td width="5%">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td width="100%" colspan="4">&nbsp;</td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>

            </table>
        </form>
    </body>
</html>
