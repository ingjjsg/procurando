<?php
    session_start();
    require_once "../controlador/contactoExternoControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');

    $xajax= new xajax();
    $xajax->registerFunction('selectAllContactoExterno');
    $xajax->registerFunction('deleteContactoExterno');
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
        <script src="../comunes/js/prototype.js" type="text/javascript"></script>
        <script type="text/javascript" src="../comunes/js/effects.js"></script>
        <script type="text/javascript" src="../comunes/js/scriptaculous.js"></script>
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        <script language="javascript">
            function abrirVentana(opcion){
                switch (opcion) {
                    case 1:
                        window.open('./contactoExternoVistaIngreso.php?acc=INS', 'contenido', '');
                        break;
                }
            }
            function eliminarContactoExterno(id_contacto_externo){
                if (confirm('¿Seguro desea eliminar el contacto externo?')){
                    xajax_deleteContactoExterno(id_contacto_externo);
                }
            }
            function ocultar(id, msj) {
                var log = $(id);
                log.innerHTML= msj;
                log.style.backgroundColor= '#fff36f';
                log.style.padding= '5px';
                Effect.Fade(id, { duration: 2.0 });
                Effect.SlideUp(id, { duration: 2.0 });
            }
            function ver(id){
                div = $('div_'+id);
                div.toggle();
                if (div.innerHTML==''){
                    div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                    xajax_verDeTallesContacto(id);
                }else {
                    d = div.descendants();
                    if(d[0].id!='div_c'+id){
                        div.show();
                        div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                        xajax_verDeTallesContacto(id);
                    }
                }
            }
        </script>
    </head>
    <body onload="xajax_selectAllContactoExterno();">
        <form name="frmcontactoexterno" id="frmcontactoexterno" method="post">
            <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
            <input type="hidden" name="iduser" value="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Contactos Externos</td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <img src="../comunes/images/user_suit_add.png" onmouseover="Tip('Nuevo Contacto Externo')" onmouseout="UnTip()" onclick="javascript:abrirVentana(1);"/>
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
