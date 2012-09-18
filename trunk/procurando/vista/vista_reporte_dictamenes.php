<?php
    session_start();
    require_once "../controlador/tbldictamenesControlador.php";
    require_once '../controlador/reporteDictamenControlador.php';
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    $xajax= new xajax();
    $xajax->registerFunction('selectAllDictamenes');
    $xajax->registerFunction('llenarSelectTipo');
    $xajax->registerFunction('llenarTipoMateria');    
    $xajax->registerFunction('llenarSelectTipoEstadoDictamen');
    $xajax->registerFunction('llenarSelectOrganismo');
    $xajax->registerFunction('llenarSelectTipoOrganismo');
    $xajax->registerFunction('selectDictamenReporte');
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
<!--        <script type="text/javascript" src="../comunes/js/scriptaculous.js"></script>-->
        <script type="text/javascript" src="../comunes/js/tabcontent.js"></script>
      
        <script src="../comunes/js/calendar.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_es.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_setup.js" type="text/javascript"></script>




        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        <script language="javascript">
            jQuery(function($){
                $("#strtelefono").mask("(9999) 999.99.99",{placeholder:" "});
                $("#strmovil").mask("(9999) 999.99.99",{placeholder:" "});
                $("#datefecnac").mask("99/99/9999",{placeholder:" "});
            });
            
            function cargar(){
		xajax_llenarSelectTipo();
		xajax_llenarSelectTipoEstadoDictamen();
		xajax_llenarSelectTipoOrganismo()
            }
            function validar()
            {
               document.frmDictamen.strdescripcion.value= FCKeditorAPI.__Instances['descripcion'].GetHTML();
               xajax_validar_Documento(xajax.getFormValues('frmDictamen'));
            }            
            
            function verForm(id){
                //xajax_selectAllDpto();
                div = $(id);
                div.toggle();
                if (div.innerHTML==''){
                    div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                }else{
                    d = div.descendants();
                }
            }
          
            
        </script>
    </head>
    <body onload="cargar()" >
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frmDictamen" id="frmDictamen" method="post">
            <fieldset style="border:#339933 2px solid">                
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Reporte de Dictamen</td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript: history.go(-1)"/>
                    </td>
                </tr>
            </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                <tr>
                    <td>
                        <div id="formulario" style=" width:100%;" align="left">
                                <input type="hidden" class='inputbox82' id="id_agenda" name="id_agenda" size="30" />
                                <table width="100%" border="0" class="tablaVer" >
                                    <tr>
                                       <td width="20%">
                                            Tipos Materia:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipo">
                                                <select id="id_materia" name="id_materia" style='width:90%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                         <td width="20%">
                                            Tipo Temas:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipoMateria">
                                                <select id="id_tipo_materia" name="id_tipo_materia" style='width:90%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                       <td width="20%">
                                            Tipo Organismo:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipoOrganismo">
                                                <select id="id_tipo_organismo" name="id_tipo_organismo" style='width:90%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                         <td width="20%">
                                            Organismo:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdOrganismo">
                                                <select id="id_organismo" name="id_organismo" style='width:60%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>                                      
                                    <tr>
                                       <td width="20%">
                                            Tipo de Estado:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipoEstado">
                                                <select id="id_estado" name="id_estado" style='width:90%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                         <td width="20%">
                                            Numero:
                                        </td>
                                        <td width="30%">
						<input type="text" class='inputbox82' id="stranrodictamen" name="stranrodictamen" size="20" />     
                                        </td>
                                    </tr>
                                    <tr>
                                       <td width="20%">
                                            Titulo:
                                        </td>
                                        <td width="30%">
						<input type="text" class='inputbox82' id="strtitulo" name="strtitulo" size="20" />   
                                        </td>
                                        
                                         <td width="20%">Persona:
                                        </td>
                                        <td width="30%">
						<input type="text" class='inputbox82' id="strpersonas" name="strpersonas" size="20" />   
                                        </td>
                                    </tr>
                                    <tr>
                    <td align="center" width="100%" colspan="5">
                        <table width="100%">
                            <tbody><tr>
                                <td width="15%">&nbsp;</td>
                                <td align="center" width="35%">
                                    <img onclick="xajax_selectDictamenReporte(xajax.getFormValues('frmDictamen'),'pdf');" onmouseout="UnTip()" onmouseover="Tip('Exportar a PDF')" src="../comunes/images/botonpdf.png">

                                </td>
                                <td align="center" width="35%">
                                    <img onclick="xajax_selectDictamenReporte(xajax.getFormValues('frmDictamen'),'ods');" onmouseout="UnTip()" onmouseover="Tip('Exportar a OpenOffice')" src="../comunes/images/botonoo.png">
                                </td>
                                <td width="15%">&nbsp;</td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
                                </table>
                        </div>
                    </td>
                </tr>

            </table>
            </form>
          </fieldset>            
        </center>
    </body>
</html><?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
