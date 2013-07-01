<?php
    session_start();
    require_once "../controlador/asuntosControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    $xajax= new xajax();
    $xajax->registerFunction('selectAllAsuntos');
    $xajax->registerFunction('formMaestro');
    $xajax->registerFunction('insertAsunto');
    $xajax->registerFunction('updateAsunto');
    $xajax->registerFunction('deleteAsunto');
    $xajax->registerFunction('llenarSelectGerencias');
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
        <script type="text/javascript" src="../comunes/js/scriptaculous.js"></script>
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        <script language="javascript">
            function ocultar(id, msj) {
                var log = $(id);
                log.innerHTML= msj;
                log.style.backgroundColor= '#fff36f';
                log.style.padding= '5px';
                Effect.Fade(id, { duration: 2.0 });
                Effect.SlideUp(id, { duration: 2.0 });
            }
            function ocultar2(id) {
                Effect.Fade(id, { duration: 2.0 });
                Effect.SlideUp(id, { duration: 2.0 });
            }
            function eliminarAsunto(id_maestro){
                if (confirm('¿Seguro desea eliminar el Asunto Predeterminado?')){
                    xajax_deleteAsunto(id_maestro);
                }
            }
            function validar(acc){
                if(document.frmasunto.stritema.value == ""){
                    alert('Debe ingresar un valor en el campo Nombre');
                    var e = document.getElementById('stritema');
                    e.style.borderColor= 'Red';
                    e.focus();
                    return false;
                }else{
                    if(acc == 'INS'){
                        xajax_insertAsunto(xajax.getFormValues('frmasunto'));
                    }else if(acc == 'UPD'){
                        xajax_updateAsunto(xajax.getFormValues('frmasunto'));
                    }

                }
            }
        </script>
    </head>
    <?php
        $_SESSION["AD"]="ASC";
    ?>
    <body onload="xajax_selectAllAsuntos();">
        <form name="frmasunto" id="frmasunto" method="post" style="">
            <input type="hidden" name="iduser" value="">
            <input type='hidden' name='id_origen' id='id_origen' value='174'>
            <input type='hidden' name='id_maestro' id='id_maestro' value='0'>
            <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Asuntos Predeterminados</td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <img src="../comunes/images/comment_add.png" onmouseover="Tip('Nuevo Asunto Predeterminado')" onmouseout="UnTip()" border="0" onclick="xajax_formMaestro('INS');xajax_llenarSelectGerencias();"/>
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
