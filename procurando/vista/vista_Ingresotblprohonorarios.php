<?php
    session_start();
    require_once "../controlador/tblprohonorariosControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');

    $xajax= new xajax();
    $xajax->registerFunction('llenarSelectTipoHonorario');
    $xajax->registerFunction('selectAllHonorarios');
    $xajax->registerFunction('selectFiltrosHonorarios');    
    $xajax->registerFunction('insertHonorarios');
    $xajax->registerFunction('selectHonorario');    
    $xajax->registerFunction('eliminarHonorario');   
    $xajax->registerFunction('llenarSelectTipoTramite');    
    $xajax->registerFunction('llenarSelectTipoAno');
    $xajax->registerFunction('multiplicar_unidad');    
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
        <link href="../comunes/css/tabcontent.css" rel="stylesheet" type="text/css"  />      
        <link href="../comunes/css/calendar-blue2.css" rel="stylesheet" type="text/css" media="all" title="win2k-cold-1" />        
        <script src="../comunes/js/jquery.js" type="text/javascript"></script>
        <script src="../comunes/js/jquery.maskedinput.js" type="text/javascript"></script>             
        <script src="../comunes/js/funciones.js" type="text/javascript"></script>
        <script src="../comunes/js/prototype.js" type="text/javascript"></script>
        <script src="../comunes/js/tool.js" type="text/javascript"></script>        
        <script type="text/javascript" src="../comunes/js/effects.js"></script>
        <script type="text/javascript" src="../comunes/js/scriptaculous.js"></script>
        <script type="text/javascript" src="../comunes/js/tabcontent.js"></script>   
        <script src="../comunes/js/calendar.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_es.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_setup.js" type="text/javascript"></script>        
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        <script language="javascript"> 
            function edit(id)
            {
              if (id!='')
              {
                xajax_selectHonorario(xajax.getFormValues('frminserthonorarios'));    
//                xajax_llenarSelectTipoTramite('frminserthonorarios');
              }
              else
              {
                xajax_llenarSelectTipoHonorario('frminserthonorarios');             
                xajax_llenarSelectTipoTramite('frminserthonorarios');                   
                xajax_llenarSelectTipoAno('frminserthonorarios');                         
              }
            }           
            function monto(caja,monto)
            { var name=caja;
              document.getElementById(name).value=FloattoFloatVE(monto);
            }                
        </script>
        
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
    </head>
    <body onload="edit('<?= $_REQUEST['id'] ?>');">
        <center>
            <form name="frminserthonorarios" id='frminserthonorarios' method="post" action="#">
                <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
                <input type="hidden" id="id_honorarios" name="id_honorarios" value="<?= $_REQUEST['id'] ?>">
                <fieldset style="border:#339933 2px solid">                                        
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="65%" class="menu_izq_titulo">Edición de Honorarios</td>
                        <td width="10%" align="center" class="menu_izq_titulo">
                            <img id="save" name="save" src="../comunes/images/disk.png" onmouseover="Tip('Guardar Honorario')" onmouseout="UnTip()" border="0" onclick="xajax_insertHonorarios(xajax.getFormValues('frminserthonorarios'));"/>
                            <img id="delete" name="delete" src="../comunes/images/page_delete.png" onmouseover="Tip('Eliminar Honorario')" onmouseout="UnTip()" border="0" onclick="if (confirm('¿Seguro desea eliminar el Honorario?'))xajax_eliminarHonorario(xajax.getFormValues('frminserthonorarios'));"/>                            
                            <img id="back" name="back" src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='vista_tblprohonorarios.php'"/>
                        </td>
                    </tr>
                    <tr>
                        <table width="100%" border="0" class="tablaTitulo" >
                            <tr>
                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                    <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                        <strong>DATOS DEL HONORARIO</strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="50">&nbsp;</td>
                                <td width="95">
                                    <label id="lid_gerencia_tarmite">
                                       Tipo de Honorario:
                                    </label>
                                </td>
                                <td width="176">
                                    <label>  
                                        <div id='capaTipo'>
                                            <select id='id_tipo' name="id_tipo" style="width:30%">
                                                <option value="0">Seleccione</option>
                                            </select>
                                        </div>
                                    </label>
                                </td>
                             </tr>                            
                            <tr>
                                <td width="50">&nbsp;</td>
                                <td width="95">
                                    <label id="lid_gerencia_maestro">
                                       Tipo de Asistencia:
                                    </label>
                                </td>
                                <td width="176">
                                    <label>
                                        <div id="capaIdTipoTramite">
                                            <select id="id_tramite" name="id_tipo_tramite" style='width:50%'>
                                                <option value="0">Seleccione</option>
                                            </select>
                                        </div>
                                    </label>
                                </td>
                             </tr>
                            <tr>
                                <td width="50">&nbsp;</td>
                                <td width="95">
                                    <label id="lid_gerencia_maestro">
                                       Año Unidad:
                                    </label>
                                </td>
                                <td width="176">
                                    <label>
                                        <div id='capaAno'>
                                            <select id='id_unidad' name="id_unidad" style="width:30%">
                                                <option value="0">Seleccione</option>
                                            </select>
                                        </div>
                                    </label>
                                </td>
                             </tr>                            
                             <tr>
                                <td width="50">&nbsp;</td>
                                <td>
                                    <label>
                                        Unidades Tributarias:
                                    </label>
                                </td>
                                <td>
                                    <input name="numunidad" type="text" class="inputbox" id="numunidad" value="" maxlength="8" onKeyPress="return acceptNum(event);" onblur="xajax_multiplicar_unidad(document.frminserthonorarios.id_unidad.value,document.frminserthonorarios.numunidad.value);"/>
                                </td>
                            </tr>
                             <tr>
                                <td width="50">&nbsp;</td>
                                <td>
                                    <label>
                                        Costo Contable:
                                    </label>
                                </td>
                                <td>
                                    <input name="costo" readonly="readonly" type="text" class="inputbox" id="costo" value="" maxlength="8" onKeyPress='return acceptNum(event)'/>
                                </td>
                            </tr>                            
                        </table>
                    </tr>
                </table>
               </fieldset>
             </form>
        </center>
    </body>
</html>