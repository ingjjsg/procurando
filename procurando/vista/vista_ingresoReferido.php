<?php
    session_start();
    require_once "../controlador/tblReferidosControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    require_once '../modelo/clPermisoModelo.php';
    require_once '../modelo/clConstantesModelo.php';
    if(isset($_GET['id'])){
        $id_contrario = $_GET['id'];
    }
    if(isset($_GET['id_expediente'])){
        $id_expediente = $_GET['id_expediente'];
    }    
    $formulario_accion=  clConstantesModelo::getFormulario_accion('asociaciones','asociaciones_litigio');
    $xajax= new xajax();
    $xajax->registerFunction('diferenciaFechas');    
    $xajax->registerFunction('validar');
    $xajax->registerFunction('eliminar');    
    $xajax->registerFunction('select');    
    $xajax->registerFunction('insert');    
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
        <script src="../comunes/js/tool.js" type="text/javascript"></script>        
        
        <!--<script type="text/javascript" src="../comunes/js/scriptaculous.js"></script>-->
        <script type="text/javascript" src="../comunes/js/tabcontent.js"></script>
        <script type="text/javascript" src="../comunes/js/ajaxupload.js"></script>
        <script src="../comunes/js/calendar.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_es.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_setup.js" type="text/javascript"></script>




        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        
        <script type="text/javascript">
            jQuery(function($){
                $("#fecegreso").mask("99/99/9999");        
                $("#fecingreso").mask("99/99/9999");                  
            });            
  
            
            function cargar(id_contrario,id_expediente){
                if(id_contrario != ""){
                    xajax_select(id_contrario,id_expediente);
                }
            }           
            
            function montosformafo(caja,monto)
            { var name=caja;
                document.getElementById(name).value=FloattoFloatVE(monto);
            }    
                                    

        </script>
    </head>
    <body onload="cargar('<?php echo $id_contrario ?>','<?php echo $id_expediente ?>')">
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frmReferidos" id="frmReferidos" method="post">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Información Adicional</td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <?php 
                        if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($formulario_accion['formulario']),'guardar', $formulario_accion['accion'])) {?>
                        <img src="../comunes/images/16_save.png" onmouseover="Tip('Guardar')" onmouseout="UnTip()" border="0" onclick="xajax_validar(xajax.getFormValues('frmReferidos'));"/>
                        &nbsp;&nbsp;&nbsp;
                        <?php }?>
                    </td>
                </tr>
            </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                <tr>
                    <td>
                        <div id="formulario" style=" width:100%;" align="left">
                            <fieldset style="border:#339933 2px solid">
                                <input type="hidden" class='inputbox' id="lngcodigo" name="lngcodigo" size="30" />
                                <input type="hidden" class='inputbox' id="id_demandante" name="id_demandante" size="30" value="<?php echo $id_contrario; ?>"/>                                
                                <input type="hidden" class='inputbox' id="id_expediente" name="id_expediente" size="30" value="<?php echo $id_expediente; ?>"/>                                                     
                                <table width="100%" border="0" class="tablaVer" >
                                    <tr>
                                        <td width="20%">
                                            Fecha Ingreso:
                                        </td>
                                        <td width="30%">
                                            <input id="fecingreso" name="fecingreso" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                                <img name="button"  id="lanzador_fecingreso"  src="../comunes/images/calendar.png" align="middle"/>
                                                <script type="text/javascript">
                                                    Calendar.setup({
                                                        inputField     :    "fecingreso",      // id del campo de texto
                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                        button         :    "lanzador_fecingreso"   // el id del botn que lanzar el calendario
                                                    });
                                                </script>
                                        </td>
                                        <td width="20%">
                                            Fecha Egreso:
                                        </td>
                                        <td width="30%">
                                            <input id="fecegreso" name="fecegreso" type="text"  class='inputbox82' maxlength='20' size='15' value="" onblur="xajax_diferenciaFechas(document.frmReferidos.fecingreso.value,document.frmReferidos.fecegreso.value);">
                                                <img name="button"  id="lanzador_fecegreso"  src="../comunes/images/calendar.png" align="middle"/>
                                                <script type="text/javascript">
                                                    Calendar.setup({
                                                        inputField     :    "fecegreso",      // id del campo de texto
                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                        button         :    "lanzador_fecegreso"   // el id del botn que lanzar el calendario
                                                    });
                                                </script>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td width="20%">
                                            Tiempo Laboral:

                                        </td>
                                        <td width="30%">
                                                <input type="text" class='inputbox82' id="tiempo_servicio" name="tiempo_servicio" />
                                        </td>
                                        <td width="20%">
                                        </td>
                                        <td width="30%">
                                        </td>

                                    </tr>                                      
                                    <tr>
                                        <td width="20%">
                                            Motivo de la Culminacion de la Relacion Laboral:

                                        </td>
                                        <td width="30%">
                                            <textarea id="motivo_culminacion_laboral" name="motivo_culminacion_laboral" rows="3" cols="20" style="resize:none"></textarea>
                                        </td>
                                        <td width="20%">¿Se Cancelo Prestaciones?
                                        </td>
                                        <td width="30%"><input type="checkbox" value="1" id="cancelo_adelanto_prestaciones" name="cancelo_adelanto_prestaciones" onchange="$('campos_prestaciones_demandante').toggle();">
                                        </td>

                                    </tr>                                                                    
                                    <tr id="campos_prestaciones_demandante" style="display:none">
                                            <td width="20%">Concepto:</td>
                                            <td width="30%">
                                                <input type="text" class='inputbox82' id="concepto" name="concepto" />
                                            </td>
                                            <td width="20%">Monto:</td>
                                            <td width="30%">
                                                <input id="monto" class='inputbox82' name="monto"  onblur="montosformafo('monto',document.frmReferidos.monto.value);"/>
                                            </td>
                                        </tr>       
                                        <tr>
                                            <td width="20%">Monto de la Demanda:</td>
                                            <td width="30%">
                                                <input type="text" class='inputbox82' id="monto_demanda" name="monto_demanda"  onblur="montosformafo('monto_demanda',document.frmReferidos.monto_demanda.value);"/>
                                            </td>
                                            <td width="20%"></td>
                                            <td width="30%"></td>
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
