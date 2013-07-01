<?php
    session_start();
    include("../comunes/fckeditor/fckeditor.php") ;        
    require_once "../controlador/tbldocumentoControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');

    if($_GET['id']==''){
        $titulo_formulario = 'Nuevo Item de Remisión de Documentos';
    }else{
        $id_documento = $_GET['id'];        
        $titulo_formulario = 'Edición de Item de Remisión de Documentos';
    }
    if($_GET['clon']!=''){
        $clon=$_GET['clon'];
    }
    if($_GET['ree']!=''){
        $ree=$_GET['ree'];
    }
    if($_GET['nue']!=''){
        $nue=$_GET['nue'];
    }    
        
    
    $xajax= new xajax();
    $xajax->registerFunction('selectReenviarDocumento');
    $xajax->registerFunction('verEstatus');    
    $xajax->registerFunction('reenviarDocumento');    
    $xajax->registerFunction('rutaDocumento');    
    $xajax->registerFunction('verExpediente');
    $xajax->registerFunction('buscarPersona');    
    $xajax->registerFunction('buscarPersonaPopup');    
    $xajax->registerFunction('verPersona');    
    $xajax->registerFunction('buscarExpedientePopup');
    $xajax->registerFunction('buscarExpediente');   
    $xajax->registerFunction('llenarSelectTipoDocumento');
    $xajax->registerFunction('llenarSelectTipoEvento');
    $xajax->registerFunction('llenarSelectTipoPrioridad');
    $xajax->registerFunction('llenarSelectTipoEstadoDocumento');
    $xajax->registerFunction('llenarSelectTipoRecordatorio');
    $xajax->registerFunction('selectAllDpto');
    $xajax->registerFunction('llenarSelectOrganismo');
    $xajax->registerFunction('llenarSelectTipoOrganismo');
    $xajax->registerFunction('validar_Documento');
    $xajax->registerFunction('guardarDocumento');
    $xajax->registerFunction('selectDocumento'); 
    $xajax->registerFunction('selectRefiereDocumento');     
    $xajax->registerFunction('selectClonarDocumento');         
    
    
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
//                $("#strnroexpediente").mask("aaa-99999999-*********",{placeholder:" "});                
                $("#strtelefonorecibido").mask("(9999) 999.99.99",{placeholder:" "});                
                $("#fecdocumento").mask("99/99/9999",{placeholder:" "});
            });
            
            function cargar(id_documento,clon,ree,nue){
                if((id_documento!= "") && (clon=="") && (nue=="") && (ree=="")) {
                    xajax_selectDocumento(id_documento);
                }
                else if((id_documento!= "") && (clon!="") && (nue=="") && (ree=="")) {
                    xajax_selectClonarDocumento(id_documento);                    
                }
                else if((id_documento!= "")  && (clon=="") && (nue=="") && (ree!="")) {
                    xajax_selectReenviarDocumento(id_documento);                    
                }                
                else if((id_documento== "")  && (clon=="") && (ree=="") && (nue!="")) {
                    document.frmDocumento.id_documento_accion.value='N';
                    $('guardar').show();
                    xajax_llenarSelectTipoDocumento();
                    xajax_llenarSelectTipoEvento();
                    xajax_llenarSelectTipoEstadoDocumento();
                    xajax_llenarSelectTipoPrioridad();
                    xajax_llenarSelectTipoRecordatorio();
                    xajax_selectRefiereDocumento();                    
                    xajax_selectAllDpto();
//                    xajax_llenarSelectOrganismo();
                    xajax_llenarSelectTipoOrganismo();                    
                }
            }
            function validar()
            {
               document.frmDocumento.strdescripcion.value= FCKeditorAPI.__Instances['descripcion'].GetHTML();
               document.frmDocumento.strrespuesta.value= FCKeditorAPI.__Instances['descripcionrespuesta'].GetHTML();
               document.frmDocumento.strubicacion.value= FCKeditorAPI.__Instances['descripcionubicacion'].GetHTML();
               xajax_validar_Documento(xajax.getFormValues('frmDocumento'));
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
            
            function vercatalogo(num)
            { 
              if (num==1)
              {
                alert(1);
                $('contenedorExpediente').toggle();
                xajax_buscarExpedientePopup(document.frmDocumento.strnroexpediente.value);                  
              }
              else if (num==2)
              {
                $('contenedorTrabajador').toggle();
                xajax_buscarPersonaPopup(document.frmDocumento.id_unidad.value);                  
              }
            }               
            
        </script>
    </head>
    <body onload="cargar('<?php echo $id_documento ?>','<?php echo $clon ?>','<?php echo $ree ?>','<?php echo $nue ?>')" >
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frmDocumento" id="frmDocumento" method="post">
            <fieldset style="border:#339933 2px solid">                
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo"><?php echo $titulo_formulario ?></td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <img id="guardar" style="display:none;" src="../comunes/images/16_save.png" onmouseover="Tip('Guardar')" onmouseout="UnTip()" border="0" onclick="validar();"/>
                        &nbsp;&nbsp;&nbsp;
                        <img id="reenviar" style="display:none;" src="../comunes/images/save_go.png" onmouseover="Tip('Reenviar')" onmouseout="UnTip()" border="0" onclick="xajax_reenviarDocumento(xajax.getFormValues('frmDocumento'));"/>
                        &nbsp;&nbsp;&nbsp;                        
                        <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript: history.go(-1)"/>
                    </td>
                </tr>
            </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                <tr>
                    <td>
                        <div id="formulario" style=" width:100%;" align="left">
                                <input type="hidden" class='inputbox82' id="id_documento" name="id_documento" size="30" />
                                <input type="hidden" class='inputbox82' id="oficina" name="oficina" size="30" />                                
                                
<!--                                <input type="hidden" class='inputbox82' id="id_documento_reenviar" name="id_documento_reenviar" size="30" />                                -->
                                <input type="hidden" class='inputbox82' id="id_documento_accion" name="id_documento_accion" size="30" />                                                                
                                <table width="100%" border="0" class="tablaVer" >
                                    <tr>
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                <strong>Datos del Nuevo Evento</strong>
                                            </div>
                                        </td>
                                    </tr>         
                                    <tr id="fecha">
                                        <td width="20%">
                                           Fecha de Creación:
                                        </td>
                                        <td width="30%">
                                            <input type="text" style="background:#CCCCCC !important;" class='inputbox82' id="fechacreacion" readonly="true" name="fechacreacion" size="20" />                             
                                        </td>
                                        <td width="20%">
                                            Nro del Documento
                                        </td>
                                        <td width="30%">
                                            <input type="text" style="background:#CCCCCC !important;" class='inputbox82' id="strnumero"  name="strnumero" size="20" />                                                                         
                                        </td>
                                    </tr>                                         
                                    <tr>
                                       <td width="20%">
                                            Tipo Documento:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipo">
                                                <select id="id_tipo" name="id_tipo" style='width:90%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                         <td width="20%">
                                            Tipo Evento:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipoEvento">
                                                <select id="id_evento" name="id_evento" style='width:90%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                       <td width="20%">
                                            Tipo de Prioridad:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipoPrioridad">
                                                <select id="id_prioridad" name="id_prioridad" style='width:90%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                         <td width="20%">
                                            Origen del Documento:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipoEstado">
                                                <select id="id_estado" name="id_estado" style='width:90%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                       <td width="20%">
                                            Tipo de Recordatorio:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipoRecordatorio">
                                                <select id="id_recordatorio" name="id_recordatorio" style='width:90%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                         <td width="20%">
                                            Departamento:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipoUnidad">
                                                <select id="id_unidad" name="id_unidad" style='width:60%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>  
                                   <tr>
                                        <td width="20%">
                                            Refire Documento:
                                        </td>
                                        <td width="30%">
                                           <div id="capaIdRefiere">
                                                <select id="id_refiere" name="id_refiere" style='width:60%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td width="20%">
                                        </td>
                                        <td width="30%">
                                        </td>
                                    </tr>                                        
                                    <tr id="CapaTrabajador" style="display: none;">
                                        <td width="20%">
                                           Nombre del Trabajador:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="strnombre" name="strnombre" size="20" onKeyDown="xajax_buscarPersonaPopup(document.frmDocumento.id_unidad.value);" onKeyUp="xajax_buscarPersonaPopup(document.frmDocumento.id_unidad.value);"/>                             
                                            <input type="hidden" class='inputbox82' id="id_contacto" name="id_contacto" size="30" />                                            
                                            <img src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Persona')" onmouseout="UnTip()" border="0" onclick="vercatalogo(2);"/>                                                                                        
                                        </td>
                                        <td width="20%">
                                        </td>
                                        <td width="30%">
                                        </td>
                                    </tr>     
                                    <tr>
                                        <td colspan="6">
                                            <div id="contenedorTrabajador" style="width:100%;display: none;" align="left">
                                                <div align="center"></div>
                                            </div>
                                        </td>
                                    </tr>                                        
                                    <tr id="CapaExpediente" style="display: none;">
                                        <td width="20%">
                                            Codigo Expediente:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="strnroexpediente" name="strnroexpediente" size="20" onKeyDown="xajax_buscarExpedientePopup(document.frmDocumento.strnroexpediente.value);" onKeyUp="xajax_buscarExpedientePopup(document.frmDocumento.strnroexpediente.value);"/>                             
                                            <input type="hidden" class='inputbox82' id="id_proexpediente" name="id_proexpediente" size="30" />                                            
                                            <img src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Expediente')" onmouseout="UnTip()" border="0" onclick="xajax_buscarExpedientePopup(document.frmDocumento.strnroexpediente.value);"/>                                                                                        
                                        </td>
                                        <td width="20%">
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
                                   <tr id="entrada" style="display:none;">
                                        <td width="20%">
                                            Entregado Por:
                                        </td>
                                        <td width="30%">
                                           <input type="text" class='inputbox82' id="strpersona" name="strpersona" size="20" />
                                        </td>
                                        <td width="20%">
                                            Teléfono Contacto
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="strtelefono"  name="strtelefono" size="20" />                                                                         
                                        </td>                                        
                                    </tr> 
                                   <tr id="dirigido"  style="display:none;">
                                        <td width="20%">
                                            Dirigido A:
                                        </td>
                                        <td width="30%">
                                           <input type="text" class='inputbox82' id="strdirigido" name="strdirigido" size="20" />
                                        </td>
                                        <td width="20%">Recibido Por
                                        </td>
                                        <td width="30%">
                                           <input type="text" class='inputbox82' id="strrecibido" name="strrecibido" size="20" />                                            
                                        </td>                                        
                                    </tr>                                    
                                    <tr>
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                <strong>Cuerpo del Item del Documento</strong>
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
                                            Fecha de Recibo:                                            
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox82' id="fecdocumento" name="fecdocumento" size="10" />
                                            <img name="button"  id="lanzador1"  src="../comunes/images/calendar.png" align="middle"/>
                                                <script type="text/javascript">
                                                    Calendar.setup({
                                                        inputField     :    "fecdocumento",      // id del campo de texto
                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                        button         :    "lanzador1"   // el id del botn que lanzar el calendario
                                                    });
                                                </script>
                                        </td>
                                    </tr>                                    

 
                                </table>
                        </div>
                    </td>
                </tr>
                       <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                          <tr>
                           <td height="100%">
                            <div align="left">
                                <ul id="countrytabs" class="shadetabs">
                                    <li><a id="link1" href="#" rel="country1"  class="selected">Documento</a></li> 
                                    <li><a id="link2" href="#" rel="country2">Respuesta del Documento</a></li> 
                                    <li><a id="link3" href="#" rel="country3">Ubicación del Documento</a></li>                                     
                                    <li><a id="link4" href="#" rel="country4">Ruta del Documento</a></li>                                       
                                </ul>
                                <div style="background:#F8F8F8; border:solid 1px #cccccc; width:100%; height:340px" align="left">
                                    <div id="country1"  class="tabcontent" style="height:100%; overflow-y:auto">
                                        <table width="100%" border="0" class="tablaTitulo" >
                                    <tr>
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                <strong>Descripción del Documento</strong>
                                            </div>
                                        </td>
                                    </tr>                                                
                                    <tr>
                                        <input type="hidden" name="strdescripcion" id="strdescripcion" value="">
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
                                    <div id="country2"  class="tabcontent" style="height:100%; overflow-y:auto">
                                            <table width="100%" border="0" class="tablaTitulo" >
                                                <tr>
                                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                        <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                            <strong>Descripción de la Respuesta del Documento</strong>
                                                        </div>
                                                    </td>
                                                </tr>                                                
                                    <tr>
                                        <input type="hidden" name="strrespuesta" id="strrespuesta" value="">
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <?php
                                                $oFCKeditor = new FCKeditor('descripcionrespuesta') ;
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
                                    <div id="country3"  class="tabcontent" style="height:100%; overflow-y:auto">
                                            <table width="100%" border="0" class="tablaTitulo" >
                                                <tr>
                                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                        <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                            <strong>Ubicación del Documento</strong>
                                                        </div>
                                                    </td>
                                                </tr>                                                
                                    <tr>
                                        <input type="hidden" name="strubicacion" id="strubicacion" value="">
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <?php
                                                $oFCKeditor = new FCKeditor('descripcionubicacion') ;
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
                                    <div id="country4"  class="tabcontent" style="height:100%; overflow-y:auto">
                                            <table width="100%" border="0" class="tablaTitulo" >
                                                <tr>
                                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                        <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                            <strong>Ruta del Documento</strong>
                                                        </div>
                                                    </td>
                                                </tr>                                                
                                            <tr>
                                                <td>
                                                    <div id="contenedorRutaDocumento" style="width:100%;" align="left">
                                                        <div align="center"><img src="../comunes/images/ajax-loader.gif"></div>
                                                    </div>
                                                </td>
                                            </tr>                                             
                                           </table>
                                    </div>                                       
                                </div>
                          </div>
                      </td>
                          </tr>
                           </table>
        <script type="text/javascript">
            var countries=new ddtabcontent("countrytabs");
            countries.setpersist(false);
            countries.setselectedClassTarget("link");
            countries.init();
        </script>                    
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
