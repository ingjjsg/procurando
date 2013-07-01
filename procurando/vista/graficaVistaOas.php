<?php
    session_start();
    require_once "../controlador/tblproexpedienteControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    require_once '../modelo/clPermisoModelo.php';
    require_once '../modelo/clConstantesModelo.php';

    $xajax= new xajax();
   
    $xajax->registerFunction('GraficosTotales');
    $xajax->registerFunction('selectLeyendaGrafico_abogados_casos_cargados_total');     

    
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
    <body onload="xajax_GraficosTotales();xajax_selectLeyendaGrafico_abogados_casos_cargados_total();" >
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frminscribir" id="frminscribir" method="post">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Graficas OAS</td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                    </td>
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
                                        <strong>Datos del Reporte</strong>
                                    </div>
                                </td>
                            </tr>         
                            <tr id="CapaExpediente" >
                                <td width="20%">
                                    Fecha Inicio:
                                </td>
                                <td width="30%">
                                        <input id="fecini" name="fecini" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                        <img name="button"  id="lanzador_fecini"  src="../comunes/images/calendar.png" align="middle"/>
                                        <script type="text/javascript">
                                            Calendar.setup({
                                                inputField     :    "fecini",      // id del campo de texto
                                                ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                button         :    "lanzador_fecini"   // el id del botn que lanzar el calendario
                                            });
                                        </script>
                                </td>     
                                <td width="20%">
                                    Fecha Fin:
                                </td>
                                        <td width="30%">
                                                <input id="fecfin" name="fecfin" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                                <img name="button"  id="lanzador_fecfin"  src="../comunes/images/calendar.png" align="middle"/>
                                                <script type="text/javascript">
                                                    Calendar.setup({
                                                        inputField     :    "fecfin",      // id del campo de texto
                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                        button         :    "lanzador_fecfin"   // el id del botn que lanzar el calendario
                                                    });
                                                </script>
                                        </td>     
                            </tr>        
                            <tr id="CapaExpediente" >
                                <td width="20%">
                                </td>
                                <td width="30%">

                                </td>     
                                <td width="20%">
                                     <img src="../comunes/images/base.gif" onmouseover="Tip('Generar Grafico')" onmouseout="UnTip()" onclick="xajax_GraficosTotales(document.frminscribir.fecini.value,document.frminscribir.fecfin.value);xajax_selectLeyendaGrafico_abogados_casos_cargados_total(document.frminscribir.fecini.value,document.frminscribir.fecfin.value)"/>
                                </td>
                                        <td width="30%">

                                        </td>     
                            </tr>                                
                            <tr>
                                <td colspan="6">
                                    <div id="contenedorExpediente" style="width:100%;display: none;" align="left">
                                        <div align="center"></div>
                                    </div>
                                </td>
                            </tr>                                      

                        </table>                
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                        <tr>
                            <td>
                                <div id="contenedor" style="width: 660px;  margin: 20px auto; margin-left:80px; font-family:sans-serif;">
                                    <div align="center"><img src="../comunes/images/ajax-loader.gif"></div>
                                </div>
                                <div id="pag" style="width:100%;" align="left" class="pagination">

                                </div>                        
                            </td>
                        <tr>
                            <td class="menu_izq_titulo">
                               Numero Total  de Expedientes  de Casos Abiertos 
                            </td>
                        </tr>                       
                        <tr>
                            <td>
                                <div id="contenedor_casos_total" style="width:100%;" align="left">
                                    <div align="center"><img src="../comunes/images/ajax-loader.gif"></div>
                                </div>
                            </td>
                        </tr>                       
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