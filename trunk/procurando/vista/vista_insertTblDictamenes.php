<?php
    session_start();
    include("../comunes/fckeditor/fckeditor.php") ;        
    require_once "../controlador/tbldictamenesControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');

    if($_GET['id']==''){
        $titulo_formulario = 'Nuevo Item de Dictamen';
    }else{
        $id_dictamen = $_GET['id'];        
        $titulo_formulario = 'Edición de Item de Dictamen';
    }
        
    
    $xajax= new xajax();
    $xajax->registerFunction('llenarSelectTipo');
    $xajax->registerFunction('llenarTipoMateria');    
    $xajax->registerFunction('llenarSelectTipoEstadoDictamen');
    $xajax->registerFunction('llenarSelectOrganismo');
    $xajax->registerFunction('llenarSelectTipoOrganismo');
    $xajax->registerFunction('validar_Dictamen');
    $xajax->registerFunction('guardarDictamen');
    $xajax->registerFunction('selectDictamen'); 
       
    
    
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
            
            function cargar(id_dictamen){
                if(id_dictamen!= "") {
                    xajax_selectDictamen(id_dictamen);
                }
                else{
                    xajax_llenarSelectTipo();
                    xajax_llenarSelectTipoEstadoDictamen();
                    xajax_llenarSelectTipoOrganismo();                    
                }
            }
            function validar()
            {
               document.frmDictamen.strasunto.value= FCKeditorAPI.__Instances['descripcion'].GetHTML();
               xajax_validar_Dictamen(xajax.getFormValues('frmDictamen'));
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
            
            
            function filtrar(){
                var nombre= document.frmclientes.strnombre.value;
                var apellido= document.frmclientes.strapellido.value;
                var cedula= document.frmclientes.strcedula.value;
                
                xajax_selectAllClientesFiltro(nombre, apellido,cedula);
                verForm('formulario');
            }
        </script>
    </head>
    <body onload="cargar('<?php echo $id_dictamen ?>')" >
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frmDictamen" id="frmDictamen" method="post">
            <fieldset style="border:#339933 2px solid">                
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo"><?php echo $titulo_formulario ?></td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <img src="../comunes/images/16_save.png" onmouseover="Tip('Guardar')" onmouseout="UnTip()" border="0" onclick="validar();"/>
                        &nbsp;&nbsp;&nbsp;
                        <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript: history.go(-1)"/>
                    </td>
                </tr>
            </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                <tr>
                    <td>
                        <div id="formulario" style=" width:100%;" align="left">
                                <input type="hidden" class='inputbox82' id="id_dictamen" name="id_dictamen" size="30" />
                                <table width="100%" border="0" class="tablaVer" >
                                    <tr>
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                <strong>Datos del Dictamen</strong>
                                            </div>
                                        </td>
                                    </tr>         
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
                                        
                                         <td width="20%">Numero:
                                            
                                        </td>
                                        <td width="30%">
                                           <input type="text" class='inputbox82' id="stranrodictamen" name="stranrodictamen" size="20" /> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                <strong>Datos de Intervinientes en el Dictamen</strong>
                                            </div>
                                        </td>
                                    </tr>                                     
                                   <tr>
                                        <td width="20%">
                                            Personas Intervinientes:
                                        </td>
                                        <td width="30%">
                                    <textarea id="strpersonas" name="strpersonas" cols="25" rows="4"></textarea>
                                        </td>
                                        
                                        <td width="20%">
                                        </td>
                                        <td width="30%">
                                          
                                        </td>
                                    </tr>         
                                    <tr>
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                <strong>Cuerpo del Item de la Dictamen</strong>
                                            </div>
                                        </td>
                                    </tr>    
                                   <tr>
                                        <td width="20%">
                                            Titulo:
                                        </td>
                                        <td width="30%">
                                           <input type="text" class='inputbox82' id="strtitulo" name="strtitulo" size="20" />
                                        </td>
                                        
                                        <td width="20%">
                                            Fecha del Dictamen:                                            
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="fecdictamen" name="fecdictamen" size="10" />
                                            <img name="button"  id="lanzador1"  src="../comunes/images/calendar.png" align="middle"/>
                                                <script type="text/javascript">
                                                    Calendar.setup({
                                                        inputField     :    "fecdictamen",      // id del campo de texto
                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                        button         :    "lanzador1"   // el id del botn que lanzar el calendario
                                                    });
                                                </script>
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                <strong>Descripción del Dictamen</strong>
                                            </div>
                                        </td>
                                    </tr>                                                
                                    <tr>
                                        <input type="hidden" name="strasunto" id="strasunto" value="">
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
          </fieldset>            
        </center>
    </body>
</html><?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
