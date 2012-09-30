<?php
    session_start();    
    require_once "../controlador/tblproexpedienteControlador.php";
    require_once '../controlador/reporteOasControlador.php';
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
        
    
    $xajax= new xajax();

     $xajax->registerFunction('llenarSelectTipoTramite');
    $xajax->registerFunction('llenarSelectTipoAtencion');
    $xajax->registerFunction('llenarSelectActuacion');
    $xajax->registerFunction('llenarSelectTipoFase');  
    $xajax->registerFunction('llenarSelectFaseHijo');
    //$xajax->registerFunction('selectAllDpto');
    $xajax->registerFunction('llenarSelectOrganismo');
    $xajax->registerFunction('llenarSelectTipoOrganismo');
    //$xajax->registerFunction('selectRefiereAgenda');     
    $xajax->registerFunction('selectOasReporte');         
    
    
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
                    xajax_llenarSelectTipoTramite('frmOas');
                    xajax_llenarSelectActuacion();
                    xajax_llenarSelectTipoOrganismo('frmOas');
                    xajax_llenarSelectTipoFase('frmOas');                   
                }
            

        </script>
    </head>
    <body onload="cargar()" >
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frmOas" id="frmOas" method="post">
            <fieldset style="border:#339933 2px solid">                
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Reporte de OAS</td>
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
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                <strong>Datos del Nuevo Evento</strong>
                                            </div>
                                        </td>
                                    </tr>         
                                                                            
                                    <tr>
                                       <td width="20%">Tipo de Tramite                                </td>
                                <td width="30%">
                                    <div id="capaIdTipoTramite">
                                        <select id="id_tipo_tramite" name="id_tipo_tramite" style='width:50%'>
                                            <option value="0">Seleccione</option>
                                        </select>
                                    </div>
                                </td>   
                                <td width="20%">Tipo de Atención</td>
                                <td width="30%">
                                        <div id="capaIdTipoAtencion">
                                        <select id="id_tipo_atencion" name="id_tipo_atencion" style='width:50%'>
                                            <option value="0">Seleccione</option>
                                        </select>
                                    </div>                                 
                                </td>  
                                    </tr>
                                    <tr>
                                       <td width="20%">
                                                    Solicitante actua Como:
                                                </td>
                                                    <td width="30%">
                                                        <div id="capaIdActuacion">
                                                            <select id="id_actuacion_persona" name="id_actuacion_persona" style='width:50%'>
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
                                                    Fase del Expediente:
                                                </td>
                                                <td width="30%">
                                                    <div id="capaIdFase">
                                                        <select id="id_tipo_fase" name="id_fase" style='width:50%'>
                                                            <option value="0">Seleccione</option>
                                                        </select>
                                                    </div>                                                
                                                </td>
                                                <td width="20%">Situación de la Fase:
                                                </td>
                                                <td width="30%">
                                                    <div id="capaIdFaseSituacion">
                                                        <select id="id_fase" name="id_fase_situacion" style='width:50%'>
                                                            <option value="0">Seleccione</option>
                                                        </select>
                                                    </div>                                                            
                                                 </td>
                                            </tr>                                         
                                                                           
                                    <tr id="CapaExpediente" >
                                        <td width="20%">
                                            Codigo Expediente:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="strnroexpediente" name="strnroexpediente" size="20" onKeyDown="xajax_buscarExpedientePopup(document.frmAgenda.id_expediente.value);" onKeyUp="xajax_buscarExpedientePopup(document.frmAgenda.id_expediente.value);"/>                             
                                            <!--<input type="hidden" class='inputbox82' id="id_proexpediente" name="id_proexpediente" size="30" />                                            -->
                                            <!--<img src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Expediente')" onmouseout="UnTip()" border="0" onclick="vercatalogo(1);"/>                                                                                        -->
                                        </td>
                                        <td width="20%">
                                            Expediente Auxiliar:
                                        </td>
                                        <td width="30%">
                                            <input type="text" size="20" name="strnroexpedienteauxiliar" id="strnroexpedienteauxiliar" class="inputbox82">
                                        </td>
                                    </tr>     
                                    <tr>
                                        <td colspan="6">
                                            <div id="contenedorExpediente" style="width:100%;display: none;" align="left">
                                                <div align="center"></div>
                                            </div>
                                        </td>
                                    </tr>                                      
                                                                      

                                    <tr>
                    <td align="center" width="100%" colspan="5">
                        <table width="100%">
                            <tbody><tr>
                                <td width="15%">&nbsp;</td>
                                <td align="center" width="35%">
                                    <img onclick="xajax_selectOasReporte(xajax.getFormValues('frmOas'),'pdf');" onmouseout="UnTip()" onmouseover="Tip('Exportar a PDF')" src="../comunes/images/botonpdf.png">
                                    <!--<img onclick="xajax_selectAgendaReporte(xajax.getFormValues('frmReporteAgenda'),'pdf');" onmouseout="UnTip()" onmouseover="Tip('Exportar a PDF')" src="../comunes/images/botonpdf.png">-->
                                </td>
                                <td align="center" width="35%">
                                    <img onclick="xajax_selectOasReporte(xajax.getFormValues('frmOas'),'ods');" onmouseout="UnTip()" onmouseover="Tip('Exportar a OpenOffice')" src="../comunes/images/botonoo.png">
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
