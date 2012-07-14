<?php
    session_start();
    require_once "../controlador/maestroControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
   
    $xajax= new xajax();
    $xajax->registerFunction('llenarSelectComboMaestroProcurando');  
    $xajax->registerFunction('llenarSelectComboMaestroPadresIdProcurando');      
    $xajax->registerFunction('llenarSelectFormularioSistemasCombos');    
    $xajax->registerFunction('VerHijos'); 
    $xajax->registerFunction('VerDescripcion');
    $xajax->registerFunction('insertMaestroCombos');    
//    $xajax->registerFunction('selectCliente'); 
//    $xajax->registerFunction('validar'); 
//    $xajax->registerFunction('eliminarAsociacion');     
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
        <script type="text/javascript" src="../comunes/js/prototype.js"></script>
        <script type="text/javascript" src="../comunes/js/effects.js"></script>
        <script type="text/javascript" src="../comunes/js/scriptaculous.js"></script>
        <script type="text/javascript" src="../comunes/js/tabcontent.js"></script>
        <script type="text/javascript" src="../comunes/js/ajaxupload.js"></script>
        <script src="../comunes/js/calendar.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_es.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_setup.js" type="text/javascript"></script>




        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        
        <script type="text/javascript">
            function cargar(){
                    xajax_llenarSelectFormularioSistemasCombos();
            }            
            function ver_nuevo_item(valor){
                if (valor=='I')
                {
                    $('titulo_nuevo').show();
                    $('stritema_nuevo').show();  
                    $('accion').value='I';                        
                }
                if (valor=='M')
                {
                    $('titulo_nuevo').hide();
                    $('stritema_nuevo').hide();  
                    $('accion').value='M';  
                    xajax_insertMaestroCombos(xajax.getFormValues('frmMaestro'));
                }
                if (valor=='E')
                {
                    $('titulo_nuevo').hide();
                    $('stritema_nuevo').hide();  
                    $('accion').value='E';       
                    xajax_insertMaestroCombos(xajax.getFormValues('frmMaestro'));                    
                }

            }    
        </script>
    </head>
    <body onload="cargar()">
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frmMaestro" id="frmMaestro" method="post">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Edición de Combos del Modulo Expedientes</td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <img src="../comunes/images/16_save.png" onmouseover="Tip('Guardar')" onmouseout="UnTip()" border="0" onclick="xajax_insertMaestroCombos(xajax.getFormValues('frmMaestro'));"/>
                    </td>
                </tr>
            </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                <tr>
                    <td>
                        <div id="formulario" style=" width:100%;" align="left">
                            <fieldset style="border:#339933 2px solid">
                                <input type="hidden" class='inputbox' id="lngcodigo_asociacion" name="lngcodigo_asociacion" size="30" />
                                <input type="hidden" class='inputbox' id="id_cliente" name="id_cliente" size="30" />                                
                                <table width="100%" border="0" class="tablaVer" >
                                    <tr>
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                <strong>DATOS DE LOS COMBOS DE PROCURANDO</strong>
                                            </div>
                                        </td>
                                    </tr>                                        
                                    <tr>
                                       <td width="20%">
                                            Maestro de Sistema:
                                        </td>
                                        <td width="30%">
                                            <div id="capaFormulario2">
                                                <select id="id_sistema" name="id_sistema" style='width:50%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                         <td width="20%">
                                             Maestro de Combos:
                                        </td>
                                        <td width="30%">
                                            <div id="capaMaestroCombos">
                                                <select id="id_maestro" name="id_maestro" style='width:50%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>                                            
                                        </td>
                                    </tr>                                    
                                    <tr>
                                       <td width="20%">
                                           Hijos del Combo:
                                        </td>
                                        <td width="30%">
                                            <div id="capaHijosMaestroCombo">
                                                <select id="id_hijos" name="id_hijos" style='width:50%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                         <td width="20%">
                                             <div id="titulo" style="display:none;">Hijos del Combo:    </div>                                 
                                        </td>
                                        <td width="30%" >
                                            <div id="capaHijosMaestroCombo2" style="display:none;">
                                                <select id="id_hijos2" name="id_hijos2" style='width:50%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                       <td width="20%">
                                            Descripción Item:             
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="stritema" name="stritema" style='width:70%' size="15" style="display:none;"/>                                                                                        
                                            <input type="hidden" class='inputbox' id="id_maestro_origen" name="id_maestro_origen" size="30" style="display:none;"/>                                            
                                            <input type="hidden" class='inputbox' id="id_origen" name="id_origen" size="30"/>                                                                                        
                                            <input type="hidden" class='inputbox' id="id_sistema_origen" name="id_sistema_origen" size="30"/>                                                    
                                            <input type="hidden" class='inputbox' id="accion" name="accion" size="30"/>                                                                                                
                                            <img id="accion_id_hijo_nuevo" style="display:none;" src="../comunes/images/page_add.png" onmouseover="Tip('Agregar al Mismo Nivel')" onmouseout="UnTip()" border="0" onclick="ver_nuevo_item('I');"/>                                                                                                                    
                                            <img id="accion_id_hijo_modificar" style="display:none;" src="../comunes/images/page_edit.png" onmouseover="Tip('Modificar')" onmouseout="UnTip()" border="0" onclick="ver_nuevo_item('M');"/>                                                                                                                                                                
                                            <img id="accion_id_hijo_eliminar" style="display:none;" src="../comunes/images/page_delete.png" onmouseover="Tip('Eliminar')" onmouseout="UnTip()" border="0" onclick="ver_nuevo_item('E');"/>                                                                                                                                                                                                            
                                        </td>
                                        
                                         <td width="20%">
                                             <div id="titulo_nuevo" style="display:none;">Titulo del Combo:    </div>                                     
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="stritema_nuevo" name="stritema_nuevo" size="30" style="display:none;"/>       
                                        </td>
                                    </tr>                                    
                                </table>
                            </fieldset>
                        </div>
                    </td>
                </tr>
               
              <!-- <tr>
                    <td>
                        <div id="contenedor" style="width:100%;" align="left">
                            <div align="center"><img src="../comunes/images/ajax-loader.gif"></div>
                        </div>
                    </td>
                </tr>-->
            </table>
            </form>
        </center>
    </body>
</html><?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
