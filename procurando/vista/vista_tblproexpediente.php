<?php
    session_start();
    require_once "../controlador/tblproexpedienteControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    require_once '../modelo/clPermisoModelo.php';
    require_once '../modelo/clConstantesModelo.php';

    $xajax= new xajax();
   
    $xajax->registerFunction('buscarDatosExpedientes');
    $xajax->registerFunction('selectAllExpedientesFiltro');
    $xajax->registerFunction('eliminar_expediente');
    
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
        <link href="../comunes/css/pagination.css" rel="stylesheet" type="text/css" />        
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
            });
            
            
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
            
            function filtrar(){
                var cedula_cliente= document.frmexpedientes.cedula_cliente.value;
                var cedula_abogado_responsable= document.frmexpedientes.cedula_abogado_responsable.value;
                var cedula_abogado_ejecutor= document.frmexpedientes.cedula_abogado_ejecutor.value;
                var strexpediente= document.frmexpedientes.strexpediente.value;
                
                xajax_selectAllExpedientesFiltro(1,cedula_cliente, cedula_abogado_responsable,cedula_abogado_ejecutor,strexpediente);
                verForm('formulario');
            }
            
            function eliminar_expediente(id_expediente){
                if(confirm("Desea eliminar este expediente")){
                    xajax_eliminar_expediente(id_expediente);
                }
            }
        </script>
    </head>
    <body onload="xajax_buscarDatosExpedientes(1)" >
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frmexpedientes" id="frmexpedientes" method="post">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Expedientes</td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <?php 
                        if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('expedientes'),'nuevo', clConstantesModelo::acciones_expedientes())) {?>
                        <img src="../comunes/images/note_add.png" onmouseover="Tip('Nuevo Expediente')" onmouseout="UnTip()" onclick="location.href='vista_Ingresotblexpediente.php'"/>
                        &nbsp;&nbsp;&nbsp;
                        <?php }?>
                        <img src="../comunes/images/filter.png" onmouseover="Tip('Filtros')" onmouseout="UnTip()" border="0" onclick="verForm('formulario');"/>
                        &nbsp;&nbsp;&nbsp;
                        <?php 
                        if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('expedientes'),'agenda', clConstantesModelo::acciones_expedientes())) {?>
                        <img src="../comunes/images/ico_16_4201.gif" onmouseover="Tip('Agenda')" onmouseout="UnTip()" border="0" onclick="location.href='vista_agenda_expediente.php'"/>
                        <?php }?>
                    </td>
                </tr>
            </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                <tr>
                    <td>
                        <div id="formulario" style="display:none; width:100%;" align="left">
                            <fieldset style="border:#339933 2px solid">
                                <table width="100%" border="0" class="tablaVer" >
                                    <tr>
                                        <td width="20%">
                                            Cédula Solicitante:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="cedula_cliente" name="cedula_cliente" size="30" />
                                        </td>
                                        <td width="20%">
                                            Cédula Abogado Responsable:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="cedula_abogado_responsable" name="cedula_abogado_responsable" size="30" />
                                        </td>
                                    </tr>
                                    <tr>
                                       <td width="20%">
                                            Cédula Abogado Ejecutor:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="cedula_abogado_ejecutor" name="cedula_abogado_ejecutor" size="30" />
                                        </td>
                                        <td width="20%">
                                            Expediente:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="strexpediente" name="strexpediente" size="30" />
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
                        <div id="pag" style="width:100%;" align="left" class="pagination">

                        </div>                        
                    </td>
                </tr>
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
