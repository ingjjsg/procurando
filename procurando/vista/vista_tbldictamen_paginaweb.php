<?php
    session_start();
    require_once "../controlador/tbldictamenesControlador_paginaweb.php";
//    require_once "../controlador/tblproexpedienteControlador.php";    
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    $xajax= new xajax();
    $xajax->registerFunction('selectAllDictamenes');
    $xajax->registerFunction('llenarSelectTipo');
    $xajax->registerFunction('llenarTipoMateria');    
    $xajax->registerFunction('llenarSelectTipoEstadoDictamen');
    $xajax->registerFunction('llenarSelectOrganismo');
    $xajax->registerFunction('llenarSelectTipoOrganismo');
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
        <link href="../comunes/css/pagination.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/calendar-blue2.css" rel="stylesheet" type="text/css" media="all" title="win2k-cold-1" />
        <script src="../comunes/js/funciones.js" type="text/javascript"></script>
        <script src="../comunes/js/prototype.js" type="text/javascript"></script>
        <script src="../comunes/js/effects.js" type="text/javascript"></script>
<!--        <script src="../comunes/js/scriptaculous.js" type="text/javascript"></script>-->
        <script src="../comunes/js/calendar.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_es.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_setup.js" type="text/javascript"></script>
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        <script language="javascript">   
            function edit(id){
                if (confirm('¿Seguro desea modificar el Honorario?')){
        	    document.location.href='vista_Ingresotblprohonorarios.php?id='.id;
                }                
            }             
            function ocultar(id, msj) {
                var log = $(id);
                log.innerHTML= msj;
                log.style.backgroundColor= '#fff36f';
                log.style.padding= '5px';
                new Effect.Fade(id, {from: 1, to: 0, duration: 2.0});
                new Effect.SlideUp(id, {queue: 'parallel', duration: 2.0});
            }
            function ver(id){
//                cargar(1);
                div = $(id);
                div.toggle();
                if (div.innerHTML==''){
                    div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                }else{
                    d = div.descendants();
                }
            }
            function filtrar(){
                var id_materia= document.frmDictamen.id_materia.value;
                var id_tipo_materia= document.frmDictamen.id_tipo_materia.value;
                var id_tipo_organismo= document.frmDictamen.id_tipo_organismo.value;
                var id_organismo= document.frmDictamen.id_organismo.value; 
                var id_estado= document.frmDictamen.id_estado.value; 
                var stranrodictamen= document.frmDictamen.stranrodictamen.value; 
                var strtitulo= document.frmDictamen.strtitulo.value; 
                var strpersonas= document.frmDictamen.strpersonas.value; 
                xajax_selectAllDictamenes(id_materia, id_tipo_materia, id_tipo_organismo, id_organismo, id_estado, strtitulo, stranrodictamen, strpersonas);             
                ver('formulario');
            }
        </script>
    </head>
    <body onload="xajax_selectAllDictamenes(); xajax_llenarSelectTipo();xajax_llenarSelectTipoEstadoDictamen();xajax_llenarSelectTipoOrganismo()">
        <form name="frmDictamen" id="frmDictamen" method="post" style="">
            <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Dictamenes<div id='capaMaestro'></div></td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <img src="../comunes/images/filter.png" onmouseover="Tip('Filtros')" onmouseout="UnTip()" border="0" onclick="ver('formulario');"/>&nbsp;&nbsp;
                    </td>
                </tr>

            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                <tr>
                    <td>
                        <div id="formulario"  align="left">
                            <fieldset style="border:#339933 2px solid">
                                <table width="100%" border="0" class="tablaVer" >
                                    <tr>
                                       <td width="30%">
                                            Tipos Materia:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipo">
                                                <select id="id_materia" name="id_materia" style='width:90%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                         <td width="10%">
                                            
                                        </td>
                                        <td width="30%">

                                        </td>
                                    </tr>
                                    <tr>
                                         <td width="30%">
                                            Tipo Temas:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipoMateria">
                                                <select id="id_tipo_materia" name="id_tipo_materia" style='width:90%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                         <td width="10%">

                                        </td>
                                        <td width="30%">

                                        </td>
                                    </tr>                                    
                                    <tr>
                                       <td width="30%">
                                            Tipo de Organismo:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipoOrganismo">
                                                <select id="id_tipo_organismo" name="id_tipo_organismo" style='width:90%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                         <td width="10%">
                                        </td>
                                        <td width="30%">

                                        </td>
                                    </tr>            
                                    <tr>
                                       <td width="30%">
                                            Organismo:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdOrganismo">
                                                <select id="id_organismo" name="id_organismo" style='width:60%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                         <td width="10%">

                                        </td>
                                        <td width="30%">

                                        </td>
                                    </tr>  
                                    <tr style="display:none;">
                                       <td width="30%">
                                            Tipo de Estado:
                                        </td>
                                        <td width="30%">
                                            <div id="capaIdTipoEstado">
                                                <select id="id_estado" name="id_estado" style='width:90%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                        <td width="10%">
                                        </td>
                                        <td width="30%">
                                        </td>
                                    </tr>                                    
                                    <tr>
                                       <td width="30%">Numero:
                                            
                                        </td>
                                        <td width="30%"><input type="text" class='inputbox82' id="stranrodictamen" name="stranrodictamen" size="20" />                  

                                        </td>
                                        
                                        <td width="10%">
                                        </td>
                                        <td width="30%">
                                                                     
                                        </td>
                                    </tr>
                                    <tr>
                                       <td width="30%">
                                            Titulo:
                                        </td>
                                        <td width="30%">
						<input type="text" class='inputbox82' id="strtitulo" name="strtitulo" size="20" />   
                                        </td>
                                        
                                         <td width="10%">
                                        </td>
                                        <td width="30%">
                                        </td>
                                    </tr>
                                    <tr>
                                       <td width="30%">
                                            Nombre de Persona:
                                        </td>
                                        <td width="30%">
						<input type="text" class='inputbox82' id="strpersonas" name="strpersonas" size="20" />   
                                        </td>
                                        
                                         <td width="10%">
                                        </td>
                                        <td width="30%">
                                        </td>
                                    </tr>                                    
                                 
                                    <tr>
                                        <td align="right" colspan="8">
                                            <input type="button" value="Filtrar" onclick="filtrar();">
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="contenedorDictamenes" style="width:100%;" align="left">
                            <div align="center"><img src="../comunes/images/ajax-loader.gif"></div>
                        </div>
                        <div id="pagAgenda" style="width:100%;" align="left" class="pagination">

                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
