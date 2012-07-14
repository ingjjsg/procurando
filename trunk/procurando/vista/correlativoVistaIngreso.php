<?php
    session_start();
    require_once "../controlador/correlativoControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');

    $xajax= new xajax();
    $xajax->registerFunction('llenarSelectGerencias');
    $xajax->registerFunction('llenarSelectCoordinaciones');
    $xajax->registerFunction('llenarSelectTipoCorres');
    $xajax->registerFunction('llenarSelectTipoDoc');
    $xajax->registerFunction('insertCorrelativo');
    $xajax->registerFunction('updateCorrelativo');
    $xajax->registerFunction('selectCorrelativoById');
	$xajax->processRequest();
    $xajax->printJavascript('../comunes/xajax/');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="pragma" content="no-cache">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" >
        <link href="../comunes/css/general.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/enlaces.css" rel="stylesheet" type="text/css" />
        <script src="../comunes/js/funciones.js" type="text/javascript"></script>
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        <script language="javascript">
            function validar(acc){
                if (!validaSelect(document.frmcorrelativo.id_gerencia_maestro,'Gerencia'))return false;
                if (!validaSelect(document.frmcorrelativo.lnganio,'Año'))return false;
                if (!validaSelect(document.frmcorrelativo.tipo,'Tipo de Correspondencia'))return false;
                if (!validaSelect(document.frmcorrelativo.id_tipo_maestro,'Tipo de Documento'))return false;
                if (!campoRequerido(document.frmcorrelativo.lnginicio,"Número")) return false;
                if(acc == 'INS'){
                    xajax_insertCorrelativo(xajax.getFormValues('frmcorrelativo'));
                }else{
                    xajax_updateCorrelativo(xajax.getFormValues('frmcorrelativo'));
                }
            }
            function cargar(acc, id, gerencia, coordinacion, lnganio, tipoCor, tipoDoc, numero){
                if(acc == 'INS'){
                    xajax_llenarSelectGerencias();
                    xajax_llenarSelectTipoCorres();
                }else if(acc == 'ACT'){
                    setHidden(document.frmcorrelativo.id_correlativo, id)
                    xajax_llenarSelectGerencias(gerencia);
                    xajax_llenarSelectCoordinaciones(gerencia, coordinacion);
                    setSelectInput(document.frmcorrelativo.lnganio, lnganio)
                    xajax_llenarSelectTipoCorres(tipoCor);
                    xajax_llenarSelectTipoDoc(tipoCor, tipoDoc);
                    setInputText(document.frmcorrelativo.lnginicio, numero)
                }
            }
        </script>
    </head>
    <body onload="cargar('<?= $_REQUEST['acc'] ?>', '<?= $_REQUEST['id'] ?>', '<?= $_REQUEST['gerencia'] ?>', '<?= $_REQUEST['coordinacion'] ?>', '<?= $_REQUEST['lnganio'] ?>', '<?= $_REQUEST['tipoCor'] ?>', '<?= $_REQUEST['tipoDoc'] ?>', '<?= $_REQUEST['numero'] ?>');">
        <center>
            <form name="frmcorrelativo" id='frmcorrelativo' method="post" action="#">
                <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
                <input type="hidden" id="id_correlativo" name="id_correlativo" value="">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="65%" class="menu_izq_titulo">Correlativos</td>
                        <td width="10%" align="center" class="menu_izq_titulo">
                            <img src="../comunes/images/16_save.gif" onmouseover="Tip('Guardar Correlativo')" onmouseout="UnTip()" border="0" onclick="validar('<?php echo $_REQUEST['acc'] ?>');"/>
                            <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='correlativoVista.php'"/>
                        </td>
                    </tr>
                    <tr>
                        <table width="100%" border="0" class="tablaTitulo" >
                            <tr>
                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                    <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                        <strong>Datos</strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="50">&nbsp;</td>
                                <td width="95">
                                    <label id="lid_gerencia_maestro">
                                       <!-- Gerencia:-->
                                       Instituto:
                                    </label>
                                </td>
                                <td width="176">
                                    <label>
                                        <div id='capaGerencia'>
                                            <select id='id_gerencia_maestro' name="id_gerencia_maestro" style="width:90%">
                                                <option value="0">Seleccione</option>
                                            </select>
                                        </div>
                                    </label>
                                </td>
                             </tr>
                             <tr>
                                <td width="50">&nbsp;</td>
                                <td width="89">
                                    <label id="lid_coord_maestro">
                                        <!--Coordinaci&oacute;n:-->
                                        Departamento:
                                    </label>
                                </td>
                                <td width="199">
                                    <label>
                                        <div id='capaCoord'>
                                            <select id='id_coord_maestro' name="id_coord_maestro" style="width:90%">
                                                <option value="0">Seleccione</option>
                                            </select>
                                         </div>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td width="50">&nbsp;</td>
                                <td>
                                    <label id="llnganio">
                                        A&ntilde;o:
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <select name="lnganio" id="lnganio">
                                            <option value="0">Seleccione</option>
                                            <?php
                                                for($i=2008; $i <= 2050; $i++){
                                                    echo "<option value='".$i."'>".$i."</option>";
                                                }
                                            ?>
                                        </select>
                                    </label>
                                </td>
                             </tr>
                             <tr>
                                <td width="50">&nbsp;</td>
                                <td>
                                    <label id="ltipo">Tipo de Correspondencia:</label>
                                </td>
                                <td>
                                    <label>
                                        <div id='capaTipo'>
                                            <select id='tipo' name="tipo" style="width:70%">
                                                <option value="0">Seleccione</option>
                                            </select>
                                        </div>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td width="50">&nbsp;</td>
                                <td>
                                    <label id="lid_tipo_maestro">
                                        Tipo de Documento:
                                    </label>
                                </td>
                                <td>
                                    <label>
                                         <div id='capaDoc'>
                                            <select id='id_tipo_maestro' name="id_tipo_maestro" style="width:70%">
                                                <option value="0">Seleccione</option>
                                            </select>
                                         </div>
                                    </label>
                                </td>
                             </tr>
                             <tr>
                                <td width="50">&nbsp;</td>
                                <td>
                                    <label id="llnginicio">
                                        N&uacute;mero:
                                    </label>
                                </td>
                                <td>
                                    <input name="lnginicio" type="text" class="inputbox" id="lnginicio" value="" maxlength="8" onKeyPress='return acceptNum(event)'/>
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