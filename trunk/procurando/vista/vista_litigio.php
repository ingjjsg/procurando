<?php
    session_start();
    require_once "../controlador/tblactuacionesControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    require_once '../modelo/clPermisoModelo.php';
    require_once '../modelo/clConstantesModelo.php';

    $xajax= new xajax();
   
    $xajax->registerFunction('buscarDatosExpedientes');
    $xajax->registerFunction('llenarSelectTipoOrigen');
    $xajax->registerFunction('llenarSelectTipoMotivo');    
    $xajax->registerFunction('llenarSelectFormularioAbogadosReporte');    
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
                var nro_tribunal= document.frminscribir.nro_tribunal.value;
                var cedula_abogado_ejecutor= document.frminscribir.cedula_abogado_ejecutor.value;
                var id_responsable= document.frminscribir.id_reasignacion_abogado.value;
                var strexpediente= document.frminscribir.strexpediente.value;
                var id_origen = document.frminscribir.id_origen.value;
                var id_motivo = document.frminscribir.id_motivo.value;
                
                xajax_selectAllExpedientesFiltro(1,nro_tribunal, cedula_abogado_ejecutor,strexpediente,id_responsable,id_origen,id_motivo);
                verForm('formulario');
            }
            
            function eliminar_expediente(id_expediente){
                if(confirm("Desea eliminar este expediente")){
                    xajax_eliminar_expediente(id_expediente);
                }
            }
        </script>
    </head>
    <body onload="xajax_buscarDatosExpedientes(1);xajax_llenarSelectFormularioAbogadosReporte();xajax_llenarSelectTipoOrigen('frminscribir');xajax_llenarSelectTipoMotivo();" >
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frminscribir" id="frmexpedientes" method="post">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Expedientes Litigio</td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <?php 
                        //if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('expedientes'),'nuevo', clConstantesModelo::acciones_expedientes())) {?>
                        <img src="../comunes/images/note_add.png" onmouseover="Tip('Nuevo Expediente')" onmouseout="UnTip()" onclick="location.href='vista_Ingresolitigio.php'"/>
                        &nbsp;&nbsp;&nbsp;
                        <?php //}?>
                        <img src="../comunes/images/filter.png" onmouseover="Tip('Filtros')" onmouseout="UnTip()" border="0" onclick="verForm('formulario');"/>
                        &nbsp;&nbsp;&nbsp;
                        <?php 
                        //if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('expedientes'),'agenda', clConstantesModelo::acciones_expedientes())) {?>
<!--                        <img src="../comunes/images/ico_16_4201.gif" onmouseover="Tip('Agenda')" onmouseout="UnTip()" border="0" onclick="location.href='vista_agenda_expediente.php'"/>-->
                        <?php //}?>
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
                                            Expediente:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="strexpediente" name="strexpediente" size="30" />
                                        </td>
                                       <td width="20%">
                                            N° Tribunal:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="nro_tribunal" name="nro_tribunal" size="30" />
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
                                            Abogado Responsable:                                            
                                        </td>
                                        <td width="30%">                                        
                                            <div id="capaIdAbogadoReasignado">
                                                <select id="id_reasignacion_abogado" name="id_reasignacion_abogado" style='width:50%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>  
                                        </td>                                            
                                    </tr>    
                                    <tr>
                                        <td width="20%">Origen de la Causa                                </td>
                                        <td width="30%">
                                            <div id="capaIdTipoOrigen">
                                                <select id="id_origen" name="id_origen" style='width:50%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>   
                                        <td width="20%">Motivo de la Causa</td>
                                        <td width="30%">
                                            <div id="capaIdTipoMotivo">
                                                <select id="id_motivo" name="id_motivo" style='width:50%'>
                                                    <option value="0">Seleccione</option>
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
