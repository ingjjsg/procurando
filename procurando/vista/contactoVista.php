<?php
    session_start();
    require_once "../controlador/contactoControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');

    $xajax= new xajax();
    $xajax->registerFunction('selectAllContacto');
    $xajax->registerFunction('deleteContacto');
    $xajax->registerFunction('verDeTallesContacto');
    $xajax->registerFunction('resetContactoPassword');
    $xajax->registerFunction('selectAllDpto');
    $xajax->registerFunction('selectAllContactofiltros');
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
                        window.open('./contactoVistaIngreso.php?acc=INS	&tipo=Interno&id_tipo_maestro=171', 'contenido', '');
                        break;
                }
            }
            function eliminarContacto(id_contacto){
                if (confirm('¿Seguro desea eliminar el Contacto?')){
                    xajax_deleteContacto(id_contacto);
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
            function verForm(id){
                xajax_selectAllDpto();
                div = $(id);
                div.toggle();
                if (div.innerHTML==''){
                    div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                }else{
                    d = div.descendants();
                }
            }
            function resetPassword(id){
                if (confirm('¿Seguro desea actualizar el password para el contacto con el id: '+id+'?')){
                    xajax_resetContactoPassword(id);
                }
            }
            function filtrar(){
                var nombre= document.frmcontacto.nombre.value;
                var apellido= document.frmcontacto.apellido.value;
                var login= document.frmcontacto.login.value;
                var cedula= document.frmcontacto.cedula.value;
                var dpto= document.frmcontacto.id_dpto.value;
                if(dpto == 0){
                    dpto= "";
                }
                xajax_selectAllContactofiltros(nombre, apellido, login, cedula, dpto);
                verForm('formulario');
            }
        </script>
    </head>
    <body onload="xajax_selectAllContacto();">
        <form name="frmcontacto" method="post">
            <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
            <input type="hidden" name="iduser" value="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Usuarios</td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <img src="../comunes/images/user_add.png" onmouseover="Tip('Nuevo Usuario')" onmouseout="UnTip()" onclick="javascript:abrirVentana(1);"/>
                        &nbsp;&nbsp;&nbsp;
                        <img src="../comunes/images/filter.png" onmouseover="Tip('Filtros')" onmouseout="UnTip()" border="0" onclick="verForm('formulario');"/>
                    </td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                <tr>
                    <td>
                        <div id="formulario" style="width:100%;display:none;" align="left">
                            <fieldset style="border:#339933 2px solid">
                                <table width="100%" border="0" class="tablaVer" >
                                    <tr>
                                        <td width="20%">
                                            Nombre:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="nombre" name="nombre" size="30">
                                        </td>
                                        <td width="20%">
                                            Apellido:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="apellido" name="apellido" size="30">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%">
                                            Login:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="login" name="login" size="30">
                                        </td>
                                        <td width="20%">
                                            Cedula:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="cedula" name="cedula" size="30">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%">
                                            Gerencia:
                                        </td>
                                        <td width="80%" colspan="8">
                                            <div id="capaGeren">
                                                <select id='id_dpto' name='id_dpto' style='width:100%'>
                                                    <option value='0'>Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" colspan="8">
                                            <input type="button" value="filtrar" onclick="filtrar();">
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
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
