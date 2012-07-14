<?php
    session_start();
    require_once "../controlador/controlador_contrarios.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    require_once '../modelo/clPermisoModelo.php';
    require_once '../modelo/clConstantesModelo.php';
    if ($_SESSION['id_oficina']=='L') $nombre_modulo=' Demandantes';
    else  $nombre_modulo='Solicitantes';
    
    $formulario_accion=  clConstantesModelo::getFormulario_accion('contrarios','demandantes_litigio');

    
    $xajax= new xajax();
   
    $xajax->registerFunction('buscarDatosContrarios');
    $xajax->registerFunction('selectAllContrariosFiltro');
    $xajax->registerFunction('eliminar_contrario');
    
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
                var nombre= document.frmcontrarios.strnombre.value;
                var apellido= document.frmcontrarios.strapellido.value;
                var cedula= document.frmcontrarios.strcedula.value;
                
                xajax_selectAllContrariosFiltro(nombre, apellido,cedula);
                verForm('formulario');
            }
            
            function eliminar_contrario(id_contrario){
                if(confirm("Desea eliminar este contrario")){
                    xajax_eliminar_contrario(id_contrario);
                }
            }
        </script>
    </head>
    <body onload="xajax_buscarDatosContrarios()" >
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frmcontrarios" id="frmcontrarios" method="post">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo"><?php echo $nombre_modulo; ?></td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <?php 
                        if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($formulario_accion['formulario']),'nuevo', $formulario_accion['accion'])) {?>
                        <img src="../comunes/images/user_add.png" onmouseover="Tip('Nuevo Contrario')" onmouseout="UnTip()" onclick="location.href='vista_nuevo_contrario.php'"/>
                        &nbsp;&nbsp;&nbsp;
                        <?php }?>
                        <img src="../comunes/images/filter.png" onmouseover="Tip('Filtros')" onmouseout="UnTip()" border="0" onclick="verForm('formulario');"/>
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
                                            Nombre:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="strnombre" name="strnombre" size="30" />
                                        </td>
                                        <td width="20%">
                                            Apellido:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="strapellido" name="strapellido" size="30" />
                                        </td>
                                    </tr>
                                    <tr>
                                       <td width="20%">
                                            Cedula:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="strcedula" name="strcedula" size="30" />
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
