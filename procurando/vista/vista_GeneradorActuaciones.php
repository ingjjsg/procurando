<?php
    session_start();
    include("../comunes/fckeditor/fckeditor.php") ; 
    require_once "../controlador/actuacionesControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');

    if(isset($_GET['id'])){
        $id_proactuaciones = $_GET['id'];
    }
    $xajax= new xajax();
    $xajax->registerFunction('llenarSelectComboItemTipoActuacion');  
    $xajax->registerFunction('llenarSelectFormularioTipoActuacion');      
    $xajax->registerFunction('insertActuaciones'); 
    $xajax->registerFunction('DetalleActuacion'); 
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
        <script type="text/javascript" src="../comunes/js/ajaxupload.js"></script>
        <script src="../comunes/js/calendar.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_es.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_setup.js" type="text/javascript"></script>




        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        
        <script type="text/javascript">
            function cargar(){
                    xajax_llenarSelectFormularioTipoActuacion();
            }            
            function cargar(id_proactuaciones){
                if(id_proactuaciones != ""){
                    xajax_DetalleActuacion(id_proactuaciones);
                }
                else{
                    xajax_llenarSelectFormularioTipoActuacion();
                }
            }

            function guardar(){
               document.frmMaestroActuacion.strdescripcionactuacion.value= FCKeditorAPI.__Instances['descripcion'].GetHTML();
               xajax_insertActuaciones(xajax.getFormValues('frmMaestroActuacion'));

            }    
        </script>
    </head>
    <body onload="cargar('<?php echo $id_proactuaciones ?>')">
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frmMaestroActuacion" id="frmMaestroActuacion" method="post">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Edición de Actuaciones del Modulo Expedientes</td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <img src="../comunes/images/16_save.png" onmouseover="Tip('Guardar')" onmouseout="UnTip()" border="0" onclick="guardar();"/>
                            <img id="back" name="back" src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='vista_listaActuaciones.php'"/>
                    </td>
                </tr>
            </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                <tr>
                    <td>
                        <div id="formulario" style=" width:100%;" align="left">
                            <fieldset style="border:#339933 2px solid">
                                <input type="hidden" class='inputbox' id="id_proactuaciones" name="id_proactuaciones" size="30" />
                                <table width="100%" border="0" class="tablaVer" >
                                    <tr>
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                <strong>DATOS DE LAS ACTUACIONES DE PROCURANDO</strong>
                                            </div>
                                        </td>
                                    </tr>                                        
                                    <tr>
                                       <td width="20%">
                                            Tipo de Actuación:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipoActuacion">
                                                <select id="id_tipo_actuacion" name="id_tipo_actuacion" style='width:50%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                         <td width="20%">
                                             Item de la Actuación:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdItemActuacion">
                                                <select id="id_actuacion" name="id_actuacion" style='width:50%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>                                            
                                        </td>
                                    </tr>
                                        <tr>
                                            <td width="20%">
						Nombre de la Actuación
                                            </td>
                                            <td width="30%">
					<input type="text" class='inputbox82' id="strnombreactuacion"  name="strnombreactuacion" size="30" />   
                                            </td>
                                        <td width="20%">                                                Fecha de la Actuación:
                                        </td>
                                        <td width="30%">   
                                                                                             <input id="fecactuacion" name="fecactuacion" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                                <img name="button"  id="lanzador_fecactuacion"  src="../comunes/images/calendar.png" align="middle"/><script type="text/javascript">
                                                    Calendar.setup({
                                                        inputField     :    "fecactuacion",      // id del campo de texto
                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                        button         :    "lanzador_fecactuacion"   // el id del botn que lanzar el calendario
                                                    });
                                                </script></td>
                                        </tr>       
                                <tr>
                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                        <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                            <strong>Descripción del Caso</strong>
                                        </div>
                                    </td>
                                </tr>                                                
                                <tr>
                                    <input type="hidden" name="strdescripcionactuacion" id="strdescripcionactuacion" value="">
                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                        <?php
                                            $oFCKeditor = new FCKeditor('descripcion') ;
                                            $oFCKeditor->BasePath = '../comunes/fckeditor/' ;
                                            $oFCKeditor->Height = '300' ;
                                            $oFCKeditor->Width= '680';
                                            $oFCKeditor->ToolbarSet = 'firma';
                                           // $oFCKeditor->Value = stripslashes($_REQUEST['firmaCorreo']);
                                            $oFCKeditor->Create();
                                        ?>

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
