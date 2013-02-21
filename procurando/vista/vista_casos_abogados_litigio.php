<?php
    session_start();
    require_once "../controlador/tblactuacionesControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');


    $xajax= new xajax();
   
    $xajax->registerFunction('selectVista_abogados_casos_litigio_cargados_total');
    $xajax->registerFunction('selectVista_abogados_casos_litigio_cargados');    
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
                
                xajax_selectAllExpedientesFiltro(cedula_cliente, cedula_abogado_responsable,cedula_abogado_ejecutor,strexpediente);
                verForm('formulario');
            }
            
            function eliminar_expediente(id_expediente){
                if(confirm("Desea eliminar este expediente")){
                    xajax_eliminar_expediente(id_expediente);
                }
            }
        </script>
    </head>
    <body onload="xajax_selectVista_abogados_casos_litigio_cargados(); xajax_selectVista_abogados_casos_litigio_cargados_total();" >
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frmexpedientes" id="frmexpedientes" method="post">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100%" class="menu_izq_titulo">Numero Detallado de Expedientes Abierto</td>
                    </td>
                </tr>
            </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
             
                <tr>
                    <td>
                        <div id="contenedor_casos_detallados" style="width:100%;" align="left">
                            <div align="center"><img src="../comunes/images/ajax-loader.gif"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        </br>
                    </td>
                </tr>    
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
                <tr>
                    <td>
                        </br>
                    </td>
                </tr>                          
                <tr>
                    <td class="menu_izq_titulo">
                       Numero Total General de Casos Abiertos <input type="text" class='inputbox82' id="total" name="total" size="25" readonly="readonly"/>
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
