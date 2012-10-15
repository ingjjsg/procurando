<?php
    session_start();
    include("../comunes/fckeditor/fckeditor.php") ;    
    require_once "../controlador/tblproexpedienteControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');

    $xajax= new xajax();
    $xajax->registerFunction('llenarSelectTipoHonorario');
    $xajax->registerFunction('selectAllHonorarios');
    $xajax->registerFunction('selectFiltrosHonorarios');    
    $xajax->registerFunction('insertHonorarios');
    $xajax->registerFunction('selectHonorario');    
    $xajax->registerFunction('eliminarHonorario');        
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
        <meta http-equiv="pragma" content="no-cache">
        <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" >
        <link href="../comunes/css/general.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/enlaces.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/tabcontent.css" rel="stylesheet" type="text/css"  />      
        <link href="../comunes/css/calendar-blue2.css" rel="stylesheet" type="text/css" media="all" title="win2k-cold-1" />        
        <script src="../comunes/js/jquery.js" type="text/javascript"></script>
        <script src="../comunes/js/jquery.maskedinput.js" type="text/javascript"></script>             
        <script src="../comunes/js/funciones.js" type="text/javascript"></script>
        <script src="../comunes/js/prototype.js" type="text/javascript"></script>
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
            function edit(id)
            {
              xajax_llenarSelectTipoHonorario('frminserthonorarios');                
              if (id!='')
                xajax_selectHonorario(xajax.getFormValues('frminserthonorarios'));                      
            }            
        </script>
        
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
    </head>
    <body onload="edit('<?= $_REQUEST['id'] ?>');">
        <center>
            <form name="frminscribir" id="frminscribir" method="post">
                <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
                <input type="hidden" id="id_honorarios" name="id_honorarios" value="<?= $_REQUEST['id'] ?>">
                <fieldset style="border:#339933 2px solid">                                        
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="65%" class="menu_izq_titulo">Edición de Expedientes</td>
                        <td width="10%" align="center" class="menu_izq_titulo">
                            <img id="save" name="save" src="../comunes/images/disk.png" onmouseover="Tip('Guardar Honorario')" onmouseout="UnTip()" border="0" onclick="xajax_insertHonorarios(xajax.getFormValues('frminserthonorarios'));"/>
                            <img id="delete" name="delete" src="../comunes/images/page_delete.png" onmouseover="Tip('Eliminar Honorario')" onmouseout="UnTip()" border="0" onclick="if (confirm('¿Seguro desea eliminar el Honorario?'))xajax_eliminarHonorario(xajax.getFormValues('frminserthonorarios'));"/>                            
                            <img id="back" name="back" src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='vista_tblprohonorarios.php'"/>
                        </td>
                    </tr>
                    <tr>
                        <table width="100%" border="0" class="tablaTitulo" >
                            <tr>
                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                        <strong>EXPEDIENTE</strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Tipo de Tramite                                </td>
                                <td width="30%">
                                    <div id="capaIdmunicipio">
                                        <select id="idmunicipio" name="idmunicipio" style='width:50%'>
                                            <option value="0">Seleccione</option>
                                        </select>
                                    </div>
                                </td>   
                                <td width="20%">&nbsp;</td>
                                <td width="30%">&nbsp;
                                </td>      
                            </tr>                              
                            <tr>
                                <td width="20%">
                                    Nro Expediente:
                                </td>
                                <td width="30%">
                                    <input type="text" class='inputbox82' id="strtelefono" name="strtelefono" size="25" />
                                    <img id="save" name="save" src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Abogado')" onmouseout="UnTip()" border="0" onclick="xajax_insertHonorarios(xajax.getFormValues('frminserthonorarios'));"/>                                    
                                </td>
                                <td width="20%">
                                    Referencia ó Titulo:
                                </td>
                                <td width="30%">
                                    <input type="text" class='inputbox82' id="strdireccion" name="strdireccion" size="30" />
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    Fecha del Expediente:
                                </td>
                                <td width="30%">
                                    <input id="fechaD" name="fechaD" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                    <img name="button"  id="lanzador1"  src="../comunes/images/calendar.png" align="middle"/>
                                    <script type="text/javascript">
                                        Calendar.setup({
                                            inputField     :    "fechaD",      // id del campo de texto
                                            ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                            button         :    "lanzador1"   // el id del botn que lanzar el calendario
                                        });
                                    </script>
                                </td>
                                <td width="20%">&nbsp;</td>
                                <td width="30%">&nbsp;</td>    
                            </tr>
                          
                            <tr>
                                <td width="20%">
                                    Fecha Apertura:
                                </td>
                                <td width="30%">
                                    <input id="fechaD" name="fechaD" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                    <img name="button"  id="lanzador1"  src="../comunes/images/calendar.png" align="middle"/>
                                    <script type="text/javascript">
                                        Calendar.setup({
                                            inputField     :    "fechaD",      // id del campo de texto
                                            ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                            button         :    "lanzador1"   // el id del botn que lanzar el calendario
                                        });
                                    </script>
                                </td>
                                <td width="20%">
                                    Fecha Cierre:
                                </td>
                                <td width="30%">
                                    <input id="fechaH" name="fechaH" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                    <img name="button"  id="lanzador2"  src="../comunes/images/calendar.png" align="middle"/>
                                    <script type="text/javascript">
                                        Calendar.setup({
                                            inputField     :    "fechaH",      // id del campo de texto
                                            ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                            button         :    "lanzador2"   // el id del botn que lanzar el calendario
                                        });
                                    </script>
                                </td>
                            </tr>                            
                        </table>
                    </tr>
                    <tr> 
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                            <tr><td height="100%">
                            <div align="left">
                                <ul id="countrytabs" class="shadetabs">
                                    <li><a id="link1" href="#" rel="country1"  class="selected">Datos Generales</a></li> 
                                    <li><a id="link2" href="#" rel="country2">Descripción del Caso</a></li> 
                                    <li><a id="link3" href="#" rel="country3">Letrado</a></li>                        
                                    <li><a id="link4" href="#" rel="country4">Situaciónes</a></li>
                                    <li><a id="link5" href="#" rel="country5">Documentos</a></li>                        
                                    <li><a id="link6" href="#" rel="country6">Seguimiento Economico</a></li>                                         
                                </ul>
                                <div style="background:#F8F8F8; border:solid 1px #cccccc; width:100%; height:340px" align="left">
                                    <div id="country1"  class="tabcontent" style="height:100%; overflow-y:auto">
                                        <table width="100%" border="0" class="tablaTitulo" >
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>ACTUACIÓN</strong>
                                                    </div>
                                                </td>
                                            </tr>          
                                            <tr>
                                                <td width="20%">
                                                    Asistido actua Como:
                                                </td>
                                                    <td width="30%">
                                                        <div id="capaIdmunicipio">
                                                            <select id="idmunicipio" name="idmunicipio" style='width:50%'>
                                                                <option value="0">Seleccione</option>
                                                            </select>
                                                        </div>
                                                    </td>    
                                                <td width="20%">&nbsp;
                                                </td>
                                                <td width="30%">&nbsp;</td>
                                            </tr>                                              
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>JUZGADO</strong>
                                                    </div>
                                                </td>
                                            </tr>                                               
                                            <tr>
                                                <td width="20%">
                                                    Juzgado:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strtelefono" name="strtelefono" size="25" />
                                                    <img id="save" name="save" src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Cliente')" onmouseout="UnTip()" border="0" onclick="xajax_insertHonorarios(xajax.getFormValues('frminserthonorarios'));"/>                                    
                                                </td>
                                                <td width="20%">
                                                    Ubicación:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strfax" name="strfax" size="30" />
                                                </td>
                                            </tr>                              
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>ASISTIDO</strong>
                                                    </div>
                                                </td>
                                            </tr>          
                                            <tr>
                                                <td width="20%">
                                                    C.I. Asistido:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strtelefono" name="strtelefono" size="25" />
                                                    <img id="save" name="save" src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Cliente')" onmouseout="UnTip()" border="0" onclick="xajax_insertHonorarios(xajax.getFormValues('frminserthonorarios'));"/>                                    
                                                </td>
                                                <td width="20%">
                                                    Nombre:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strfax" name="strfax" size="30" />
                                                </td>
                                            </tr>                                 
                                            <tr>
                                                <td width="20%">
                                                    C.I. Abogado.:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strtelefono" name="strtelefono" size="25" />
                                                    <img id="save" name="save" src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Abogado')" onmouseout="UnTip()" border="0" onclick="xajax_insertHonorarios(xajax.getFormValues('frminserthonorarios'));"/>                                    
                                                </td>
                                                <td width="20%">
                                                    Nombre:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strfax" name="strfax" size="30" />
                                                </td>
                                            </tr>    
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>CONTRARIO</strong>
                                                    </div>
                                                </td>
                                            </tr>                            
                                            <tr>
                                                <td width="20%">
                                                    C.I. Contrario:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strtelefono" name="strtelefono" size="25" />
                                                    <img id="save" name="save" src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Contrario')" onmouseout="UnTip()" border="0" onclick="xajax_insertHonorarios(xajax.getFormValues('frminserthonorarios'));"/>                                                                        
                                                </td>
                                                <td width="20%">
                                                    Nombre:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strfax" name="strfax" size="30" />
                                                </td>
                                            </tr>       
                                            <tr>
                                                <td width="20%">
                                                    C.I. Abogado.:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strtelefono" name="strtelefono" size="25" />
                                                    <img id="save" name="save" src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Abogado')" onmouseout="UnTip()" border="0" onclick="xajax_insertHonorarios(xajax.getFormValues('frminserthonorarios'));"/>                                                                        
                                                </td>
                                                <td width="20%">
                                                    Nombre:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strfax" name="strfax" size="30" />
                                                </td>
                                            </tr>                                                   
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>ORGANISMO DEMANDADO</strong>
                                                    </div>
                                                </td>
                                            </tr>                            
                                            <tr>
                                                <td width="20%">
                                                    Tipo de Organismo:
                                                </td>
                                                <td width="30%">
                                                    <div id="capaIdmunicipio">
                                                        <select id="idmunicipio" name="idmunicipio" style='width:50%'>
                                                            <option value="0">Seleccione</option>
                                                        </select>
                                                    </div>
                                                </td> 
                                                <td width="20%">Organismo</td>
                                                <td width="30%">
                                                    <div id="capaIdmunicipio">
                                                        <select id="idmunicipio" name="idmunicipio" style='width:50%'>
                                                            <option value="0">Seleccione</option>
                                                        </select>
                                                    </div>
                                                </td>    
                                            </tr>                         
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>HISTORIAL DEL ASISTIDO</strong>
                                                    </div>
                                                </td>
                                            </tr>          
                                            <tr>
                                                <td width="25%">
                                                    Abiertos: <input type="text" class='inputbox82' id="strtelefono" name="strtelefono" size="10" />
                                                </td>
                                                <td width="25%">
                                                    Pendientes: <input type="text" class='inputbox82' id="strtelefono" name="strtelefono" size="10" />
                                                </td>
                                                <td width="25%">
                                                    Cerrados: <input type="text" class='inputbox82' id="strtelefono" name="strtelefono" size="10" />
                                                </td>
                                                <td width="25%">
                                                </td>
                                            </tr>                              
                                        </table>
                                    </div>                        
                                    <div id="country2"  class="tabcontent" style="height:100%; overflow-y:auto">
                                            <table width="100%" border="0" class="tablaTitulo" >
                                                <tr>
                                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                        <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                            <strong>Descripción del Caso</strong>
                                                        </div>
                                                    </td>
                                                </tr>                                                
                                                <tr>
                                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                        <?php
                                                            $oFCKeditor = new FCKeditor('firma') ;
                                                            $oFCKeditor->BasePath = '../comunes/fckeditor/' ;
                                                            $oFCKeditor->Height = '300' ;
                                                            $oFCKeditor->Width= '680';
                                                            $oFCKeditor->ToolbarSet = 'firma';
                                                            $oFCKeditor->Value = stripslashes($_REQUEST['firmaCorreo']);
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
                                                            <strong>Letrado del Caso</strong>
                                                        </div>
                                                    </td>
                                                </tr>                                                
                                                <tr>
                                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                        <?php
                                                            $oFCKeditor = new FCKeditor('firma') ;
                                                            $oFCKeditor->BasePath = '../comunes/fckeditor/' ;
                                                            $oFCKeditor->Height = '300' ;
                                                            $oFCKeditor->Width= '680';
                                                            $oFCKeditor->ToolbarSet = 'firma';
                                                            $oFCKeditor->Value = stripslashes($_REQUEST['firmaCorreo']);
                                                            $oFCKeditor->Create();
                                                        ?>

                                                    </td>
                                                </tr>                                                
                                           </table>
                                    </div>                        
                                    <div id="country4" class="tabcontent" style="height:90%; overflow-y:auto">
                                            <table width="100%" border="0" class="tablaTitulo" >
                                                <tr>
                                                    <td colspan="6" bgcolor="#F8F8F8" >
                                                        <div align="right">
                                                        <img id="save" name="save" src="../comunes/images/disk.png" onmouseover="Tip('Guardar Honorario')" onmouseout="UnTip()" border="0" onclick="xajax_insertHonorarios(xajax.getFormValues('frminserthonorarios'));"/>
                                                        <img id="delete" name="delete" src="../comunes/images/page_delete.png" onmouseover="Tip('Eliminar Honorario')" onmouseout="UnTip()" border="0" onclick="if (confirm('¿Seguro desea eliminar el Honorario?'))xajax_eliminarHonorario(xajax.getFormValues('frminserthonorarios'));"/>                            
                                                        <img id="back" name="back" src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='vista_tblprohonorarios.php'"/>
                                                        </div>
                                                    </td>
                                                </tr>                                                
                                                <tr>
                                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                        <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                            <strong>Datos de Concurrencia</strong>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="20%">
                                                        Tipo de Minuta:
                                                    </td>
                                                    <td width="30%">
                                                        <div id="capaIdmunicipio">
                                                            <select id="idmunicipio" name="idmunicipio" style='width:50%'>
                                                                <option value="0">Seleccione</option>
                                                            </select>
                                                        </div>
                                                    </td> 
                                                    <td width="20%">Minuta</td>
                                                    <td width="30%">
                                                        <div id="capaIdmunicipio">
                                                            <select id="idmunicipio" name="idmunicipio" style='width:50%'>
                                                                <option value="0">Seleccione</option>
                                                            </select>
                                                        </div>
                                                    </td>    
                                                </tr>
                                                <tr>
                                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                        <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                            <strong>Observaciones</strong>
                                                        </div>
                                                    </td>
                                                </tr>                            
                                                <tr>
                                                    <td colspan="6" bgcolor="#F8F8F8" >
                                                        <textarea id="otrosestu" name="otrosestu" cols="95" rows="4"><?= $dataPrueba[0]['strasunto'] ?></textarea>
                                                    </td>
                                                </tr>      
                                            </table>
                                    </div>
                                    <div id="country5"  class="tabcontent" style="height:100%; overflow-y:auto">
                                            <table width="100%" border="0" class="tablaTitulo" >
                                                <tr>
                                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                        <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                            <strong>Documentos Consignados</strong>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" bgcolor="#F8F8F8" >
                                                      <input type="checkbox" class="inputbox"  name="id_representante" id="id_representante"/>
                                                      <input type="checkbox" class="inputbox"  name="id_representante" id="id_representante"/>                                                      
                                                      <input type="checkbox" class="inputbox"  name="id_representante" id="id_representante"/>
                                                      <input type="checkbox" class="inputbox"  name="id_representante" id="id_representante"/>                                                      
                                                      <input type="checkbox" class="inputbox"  name="id_representante" id="id_representante"/>
                                                      <input type="checkbox" class="inputbox"  name="id_representante" id="id_representante"/>                                                      
                                                      <input type="checkbox" class="inputbox"  name="id_representante" id="id_representante"/>
                                                      <input type="checkbox" class="inputbox"  name="id_representante" id="id_representante"/>                                                      
                                                      
                                                    </td>
                                                </tr>      
                                            </table>
                                    </div>
                                    <div id="country6"  class="tabcontent" style="height:100%; overflow-y:auto">
                                            <table width="100%" border="0" class="tablaTitulo" >
                                                <tr>
                                                    <td colspan="6" bgcolor="#F8F8F8" >
                                                        <div align="right">
                                                        <img id="save" name="save" src="../comunes/images/disk.png" onmouseover="Tip('Guardar Honorario')" onmouseout="UnTip()" border="0" onclick="xajax_insertHonorarios(xajax.getFormValues('frminserthonorarios'));"/>
                                                        <img id="delete" name="delete" src="../comunes/images/page_delete.png" onmouseover="Tip('Eliminar Honorario')" onmouseout="UnTip()" border="0" onclick="if (confirm('¿Seguro desea eliminar el Honorario?'))xajax_eliminarHonorario(xajax.getFormValues('frminserthonorarios'));"/>                            
                                                        <img id="back" name="back" src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='vista_tblprohonorarios.php'"/>
                                                        </div>
                                                    </td>
                                                </tr>                                             
                                                <tr>
                                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                        <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                            <strong>Datos de Costos</strong>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="20%">
                                                        Tipo de Honorario:
                                                    </td>
                                                    <td width="30%">
                                                        <div id="capaIdmunicipio">
                                                            <select id="idmunicipio" name="idmunicipio" style='width:50%'>
                                                                <option value="0">Seleccione</option>
                                                            </select>
                                                        </div>
                                                    </td> 
                                                    <td width="20%">Honorario</td>
                                                    <td width="30%">
                                                        <div id="capaIdmunicipio">
                                                            <select id="idmunicipio" name="idmunicipio" style='width:50%'>
                                                                <option value="0">Seleccione</option>
                                                            </select>
                                                        </div>
                                                    </td>    
                                                </tr>                                                
                                                <tr>
                                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                        <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                            <strong>Observaciones</strong>
                                                        </div>
                                                    </td>
                                                </tr>                            
                                                <tr>
                                                    <td colspan="6" bgcolor="#F8F8F8" >
                                                        <textarea id="otrosestu" name="otrosestu" cols="95" rows="4"><?= $dataPrueba[0]['strasunto'] ?></textarea>
                                                    </td>
                                                </tr>      
                                            </table>

                                    </div>
                                    
                                </div>
                            </div>
                            </td></tr>
                        </table>
        <script type="text/javascript">
            var countries=new ddtabcontent("countrytabs");
            countries.setpersist(false);
            countries.setselectedClassTarget("link");
            countries.init();
        </script>
                    </tr>
                </table>
               </fieldset>
 

        </form>            
        </center>
    </body>
</html>