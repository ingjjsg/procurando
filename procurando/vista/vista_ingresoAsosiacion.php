<?php
    session_start();
    require_once "../controlador/controlador_ingresoJuridica.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    require_once '../modelo/clPermisoModelo.php';
    require_once '../modelo/clConstantesModelo.php';
    if(isset($_GET['id'])){
        $lngcodigo_asociacion = $_GET['id'];
    }
    $formulario_accion=  clConstantesModelo::getFormulario_accion('asociaciones','asociaciones_litigio');
    $xajax= new xajax();
    $xajax->registerFunction('buscarAsistido');
    $xajax->registerFunction('buscar_rif');    
    $xajax->registerFunction('buscarAsistidoPopup');    
    $xajax->registerFunction('llenarSelectTipoRamo');
    $xajax->registerFunction('llenarId_municipioAsociacion');
    $xajax->registerFunction('llenarSelectParroquiaAsociacion');
    $xajax->registerFunction('guardar_asociacion');
    $xajax->registerFunction('DetalleAsociacion');    
    $xajax->registerFunction('selectCliente'); 
    $xajax->registerFunction('validar'); 
    $xajax->registerFunction('eliminarAsociacion');     
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
                $("#dtmfechafun").mask("99/99/9999");        
                $("#strtelefono_asociacion").mask("(9999)-999-99-99");               
            });            
            
            
            function vercatalogo(num)
            { 
              if (num==1)
              {
                $('contenedorRepresentante').toggle();
                xajax_buscarAsistidoPopup('','','');                  
              }   
            }       
            
            function cargar(lngcodigo_asociacion){
                if(lngcodigo_asociacion != ""){
                    xajax_DetalleAsociacion(lngcodigo_asociacion);
                }
                else{
                    xajax_llenarSelectTipoRamo('frmaAsociacion');
	            xajax_llenarId_municipioAsociacion('frmaAsociacion');
                }
            }            

        </script>
    </head>
    <body onload="cargar('<?php echo $lngcodigo_asociacion ?>')">
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frmaAsociacion" id="frmaAsociacion" method="post">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Edición Asociasiones</td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <?php 
                        if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($formulario_accion['formulario']),'guardar', $formulario_accion['accion'])) {?>
                        <img src="../comunes/images/16_save.png" onmouseover="Tip('Guardar')" onmouseout="UnTip()" border="0" onclick="xajax_validar(xajax.getFormValues('frmaAsociacion'));"/>
                        &nbsp;&nbsp;&nbsp;
                        <?php }?>
                        <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="location.href='vista_listaAsociaciones.php'"/>
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
                                                <strong>DATOS DE LA ASOCIACIÓN JURIDICA</strong>
                                            </div>
                                        </td>
                                    </tr>                                        
                                    <tr>
                                        <td width="20%">
                                            Razón Social:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="strnombre_asociacion" name="strnombre_asociacion" size="30" />
                                        </td>
                                        <td width="20%">
                                            Fecha de Fundación 
                                        </td>
                                        <td width="30%">
                                            <input id="dtmfechafun" name="dtmfechafun" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                            <img name="button"  id="lanzador_dtmfechafun"  src="../comunes/images/calendar.png" align="middle"/>
                                            <script type="text/javascript">
                                                Calendar.setup({
                                                    inputField     :    "dtmfechafun",      // id del campo de texto
                                                    ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                    button         :    "lanzador_dtmfechafun"   // el id del botn que lanzar el calendario
                                                });
                                            </script>
                                        </td>
                                    </tr>
                                    <tr>
                                       <td width="20%">
                                            RIF:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="strrif" onBlur="xajax_buscar_rif(document.frmaAsociacion.strrif.value,document.frmaAsociacion.lngcodigo_asociacion.value);" name="strrif" size="30" />
                                        </td>
                                    </tr>
                                    <tr>
                                       <td width="20%">
                                            Municipio:
                                        </td>
                                        <td width="30%">
                                            <div id="capaMunicipio">
                                                <select id="id_municipio_asociacion" name="id_municipio_asociacion" style='width:50%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                         <td width="20%">
                                            Parroquia:
                                        </td>
                                        <td width="30%">
                                            <div id="capaParroquia">
                                                <select id="id_parroquia_asociacion" name="id_parroquia_asociacion" style='width:50%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <td width="20%">
                                            Direccion:
                                        </td>
                                        <td width="30%">
                                            <textarea class="textarea" id="strdireccion_asociacion" rows="2" cols="25" name="strdireccion_asociacion"></textarea>
                                        </td>
                                        <td width="20%">
                                            Teléfono:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="strtelefono_asociacion" name="strtelefono_asociacion" size="30" />
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <td width="20%">
                                            Web:
                                        </td>
                                        <td width="30%">
                                           <input type="text" class='inputbox' id="strweb" name="strweb" size="30" />
                                        </td>
                                        
                                    </tr>
                                     <tr>
                                        <td width="20%">
                                            Ramo:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipoRamo">
                                                <select id="id_ramo" name="id_ramo" style='width:50%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>   
                                        <td width="20%">
                                            
                                        </td>
                                        <td width="30%">
                                            
                                        </td>
                                    </tr>
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>DATOS DEL REPRESENTANTE JURIDICO</strong>
                                                    </div>
                                                </td>
                                            </tr>                                               
                                            <tr>
                                                <td width="20%">
                                                    C.I. Representante:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="cedula_representante" name="cedula_representante" size="20" onKeyDown="xajax_buscarConyuguePopup('','',document.frminscribir.cedula_cliente.value);"/>                             
                                                    <img src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Conyugue')" onmouseout="UnTip()" border="0" onclick="vercatalogo(1);"/>                                                                                        
                                                </td>
                                                <td width="20%">
                                                    Nombre Representante:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strnombre_representante" name="strnombre_representante" size="30" onKeyDown="xajax_buscarConyuguePopup(document.frminscribir.strnombre_cliente.value,'','');"/>                             
                                                </td>
                                            </tr>       
                                            <tr>
                                                <td colspan="6">
                                                    <div id="contenedorRepresentante" style="width:100%;display: none;" align="left">
                                                        <div align="center"></div>
                                                    </div>
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
