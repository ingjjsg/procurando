<?php
    session_start();
    require_once "../controlador/tblprojuzgadosControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');

    $xajax= new xajax();
    $xajax->registerFunction('selectAllJuzgados');
    $xajax->registerFunction('selectFiltrosJuzgados');    
    $xajax->registerFunction('insertJuzgados');
    $xajax->registerFunction('selectJuzgado');    
    $xajax->registerFunction('eliminarJuzgado');     
    $xajax->registerFunction('llenarSelectEstados');     
    $xajax->registerFunction('llenarSelectMunicipio');         
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
                $("#strtelefono").mask("(9999) 999.99.99",{placeholder:" "});
                $("#strfax").mask("(9999) 999.99.99",{placeholder:" "});
            });
            
            function edit(id)
            {
              if (id!='')
                xajax_selectJuzgado(xajax.getFormValues('frmJuzgados'));                      
            }            
        </script>
        
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
    </head>
    <body onload="xajax_llenarSelectEstados('frmJuzgados');edit('<?= $_REQUEST['id'] ?>');">
        <center>
            <form name="frmJuzgados" id='frmJuzgados' method="post" action="#">
                <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
                <input type="hidden" id="id_juzgados" name="id_juzgados" value="<?= $_REQUEST['id'] ?>">
                <fieldset style="border:#339933 2px solid">                    
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="65%" class="menu_izq_titulo">Edición de Juzgados</td>
                        <td width="10%" align="center" class="menu_izq_titulo">
                            <img id="save" name="save" src="../comunes/images/disk.png" onmouseover="Tip('Guardar Juzgado')" onmouseout="UnTip()" border="0" onclick="xajax_insertJuzgados(xajax.getFormValues('frmJuzgados'));"/>
                            <img id="delete" name="delete" src="../comunes/images/page_delete.png" onmouseover="Tip('Eliminar Juzgado')" onmouseout="UnTip()" border="0" onclick="if (confirm('¿Seguro desea eliminar el registro?'))xajax_eliminarJuzgado(xajax.getFormValues('frmJuzgados'));"/>                            
                            <img id="back" name="back" src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='vista_tblprojuzgados.php'"/>
                        </td>
                    </tr>
                    <tr>
                        <table width="100%" border="0" class="tablaTitulo" >
                            <tr>
                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                    <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                        <strong>Datos del Honorario</strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    Nombre:
                                </td>
                                <td width="30%">
                                    <input type="text" class='inputbox82' id="strnombre" name="strnombre" size="30" />
                                </td>
                                <td width="20%">
                                    Dirección:
                                </td>
                                <td width="30%">
                                    <input type="text" class='inputbox82' id="strdireccion" name="strdireccion" size="30" />
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    Localidad:
                                </td>
                                <td width="30%">
                                    <input type="text" class='inputbox82' id="strlocalidad" name="strlocalidad" size="30" />
                                </td>
                                <td width="20%">&nbsp;</td>
                                <td width="30%">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    Estado:
                                </td>
                                <td width="30%">
                                    <div id="capaIdestado">
                                        <select id="idestado" name="idestado" style='width:50%'>
                                            <option value="0">Seleccione</option>
                                        </select>
                                    </div>
                                </td>
                                <td width="20%">
                                    Municipio:
                                </td>
                                <td width="30%">
                                    <div id="capaIdmunicipio">
                                        <select id="idmunicipio" name="idmunicipio" style='width:50%'>
                                            <option value="0">Seleccione</option>
                                        </select>
                                    </div>
                                </td>                                
                            </tr>
                            <tr>
                                <td width="20%">
                                    Teléfono:
                                </td>
                                <td width="30%">
                                    <input type="text" class='inputbox82' id="strtelefono" name="strtelefono" size="30" />
                                </td>
                                <td width="20%">
                                    Fax:
                                </td>
                                <td width="30%">
                                    <input type="text" class='inputbox82' id="strfax" name="strfax" size="30" />
                                </td>
                            </tr>                
                            <tr>
                                <td width="20%">
                                    Observaciones:
                                </td>
                                <td width="30%">
                                    <textarea id="strobservaciones" rows="2" cols="25" name="strobservaciones"></textarea>
                                </td>
                                <td width="20%">&nbsp;</td>
                                <td width="30%">&nbsp;</td>
                            </tr>                            
                        </table>
                      </fieldset>                        
                    </tr>
                </table>
             </form>
        </center>
    </body>
</html>