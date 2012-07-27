<?php
    session_start();
    include("../comunes/fckeditor/fckeditor.php") ;    
    require_once "../controlador/tblproexpedienteControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    
    if(isset($_GET['id'])){
        $lngcodigo_expediente = $_GET['id'];
        $titulo_formulario = 'Editar Expediente';
        $funcion = 'editar';
    }else{
        $titulo_formulario = 'Nuevo Espediente';
        $funcion = 'validar';
    }

    $xajax= new xajax();
    $xajax->registerFunction('selectSituacionDetalle');    
    $xajax->registerFunction('llenarSelectFormularioTipoEstadoMinuta');      
    $xajax->registerFunction('llenarSelectTipoTramite');
    $xajax->registerFunction('llenarSelectTipoAtencion');
    $xajax->registerFunction('llenarSelectActuacion');
    $xajax->registerFunction('llenarSelectTipoOrganismo');
    $xajax->registerFunction('llenarSelectOrganismo');
    $xajax->registerFunction('llenarSelectTipoMinuta');
    $xajax->registerFunction('llenarSelectMinuta');
    $xajax->registerFunction('verDocumentos');
    $xajax->registerFunction('mostrarPestanaDivorcio');
    $xajax->registerFunction('selectAllHonorarios');
    $xajax->registerFunction('selectFiltrosHonorarios');    
    $xajax->registerFunction('insertHonorarios');
    $xajax->registerFunction('selectHonorario');    
    $xajax->registerFunction('eliminarHonorario');   
    $xajax->registerFunction('guardar_expediente');  
    $xajax->registerFunction('validar_expediente'); 
    $xajax->registerFunction('buscarAsistido'); 
    $xajax->registerFunction('buscarAbogado'); 
    $xajax->registerFunction('selectExpediente'); 
    $xajax->registerFunction('editar_expediente');
    $xajax->registerFunction('llenarNroExpediente'); 
    $xajax->registerFunction('cerrarExpediente'); 
    $xajax->registerFunction('desactivarCampos');
    $xajax->registerFunction('buscarDatosSituaciones'); 
    $xajax->registerFunction('guardar_situacion');  
    $xajax->registerFunction('validar_situacion'); 
    $xajax->registerFunction('eliminar_situacion'); 
    $xajax->registerFunction('editar_situacion');
    $xajax->registerFunction('selectSituacion'); 
    $xajax->registerFunction('verCosto');     
    $xajax->registerFunction('verCountExpediente');
    $xajax->registerFunction('buscarAbogadosPopup');  
    $xajax->registerFunction('buscarAsistidoPopup');
    $xajax->registerFunction('llenarSelectTipoDivorcio');    
    $xajax->registerFunction('llenarSelectTipoRegimen');        
    $xajax->registerFunction('verRegimenCerrado');     
    $xajax->registerFunction('buscarConyuguePopup');   
    $xajax->registerFunction('buscarConyugue');    
    $xajax->registerFunction('llenarSelectTipoCita');
    $xajax->registerFunction('llenarSelectTipoFase');  
    $xajax->registerFunction('llenarSelectFaseHijo');      
    $xajax->registerFunction('buscarFases');  
    $xajax->registerFunction('validar_fase');      
    $xajax->registerFunction('guardar_fase');
    $xajax->registerFunction('selectFase');   
    $xajax->registerFunction('editar_fase');     
    $xajax->registerFunction('eliminar_fase');     
    $xajax->registerFunction('llenarSelectComboItemTipoActuacion');     
    $xajax->registerFunction('llenarSelectFormularioTipoActuacion');
    $xajax->registerFunction('llenarSelectNombreItemTipoActuacion');
    $xajax->registerFunction('selectActuacionHijo');
    $xajax->registerFunction('validar_actuacion');
    $xajax->registerFunction('guardar_actuacion');
    $xajax->registerFunction('selectAllActuaciones');
    $xajax->registerFunction('llenarSelectFormularioTipoEspacio');
    $xajax->registerFunction('llenarSelectFormularioTipoEstadoFisicoExp');     
    $xajax->registerFunction('llenarSelectFormularioTipoArchivadorExp'); 
    $xajax->registerFunction('llenarSelectFormularioPisoArchivadorExp');
    $xajax->registerFunction('llenarSelectFormularioGavetaArchivadorExp');    
    
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
        <script src="../comunes/js/tool.js" type="text/javascript"></script>        
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
                $("#feccierre").mask("99/99/9999");        
                $("#fecexpediente").mask("99/99/9999");               
                $("#fecapertura").mask("99/99/9999");        
                $("#fecseparacion").mask("99/99/9999");   
            });            
            
            
            function vercatalogo(num)
            { 
              if (num==1)
              {
                $('contenedorAbogados').toggle();
                xajax_buscarAbogadosPopup('','','');                  
              }  
              if (num==2)
              {
                $('contenedorAsistidos').toggle();
                xajax_buscarAsistidoPopup('','','');                  
              }   
              if (num==3)
              {
                $('contenedorConyugue').toggle();
                xajax_buscarConyuguePopup('','','');                  
              }   
            }                
            function monto(caja,monto)
            { var name=caja;
              document.getElementById(name).value=FloattoFloatVE(monto);
            }    
                        
            function cargar(lngcodigo_expediente){
                if(lngcodigo_expediente != ""){
                    xajax_selectExpediente(lngcodigo_expediente);
                }
                else{
                    xajax_llenarNroExpediente();
                    xajax_llenarSelectFormularioTipoEstadoMinuta();
                    xajax_llenarSelectTipoRegimen('frminscribir');
                    xajax_llenarSelectTipoTramite('frminscribir');                    
                    xajax_llenarSelectTipoDivorcio('frminscribir');
                    xajax_llenarSelectActuacion('frminscribir');
                    xajax_llenarSelectTipoOrganismo('frminscribir');
                    xajax_llenarSelectTipoMinuta('frminscribir');
                    xajax_llenarSelectTipoCita('frminscribir');     
                    xajax_llenarSelectTipoFase('frminscribir');                         
                    xajax_llenarSelectFormularioTipoActuacion('');  
                    xajax_buscarDatosSituaciones('');
                    xajax_llenarSelectFormularioTipoEspacio('');
                    xajax_llenarSelectFormularioTipoEstadoFisicoExp('');                    
                    xajax_llenarSelectFormularioTipoArchivadorExp('');
                    xajax_llenarSelectFormularioPisoArchivadorExp(''); 
                    xajax_llenarSelectFormularioGavetaArchivadorExp('');                     
                    $('load').hide();
                }
            }
            function editar()
            {
              llenarCategoria();
              document.frminscribir.strdescripcion.value= FCKeditorAPI.__Instances['descripcion'].GetHTML();
              xajax_editar_expediente(xajax.getFormValues('frminscribir'));                     
            }    
            
            function validar()
            {
                
               llenarCategoria();
               document.frminscribir.strdescripcion.value= FCKeditorAPI.__Instances['descripcion'].GetHTML();
//               document.frminscribir.strletrado.value= FCKeditorAPI.__Instances['letrado'].GetHTML();
               xajax_validar_expediente(xajax.getFormValues('frminscribir'));
//              if (!validarEditor('descripcion', 'Descripcion')) return false;
//                
//              if (!validarEditor('letrado', 'Letrado')) return false;
//                document.frminscribir.strletrado.value= FCKeditorAPI.__Instances['letrado'].GetHTML();
                
            }   
        
             function llenarCategoria(){
				var cadena= "";
				for (i=0;i<document.frminscribir.elements.length;i++){
					if(document.frminscribir.elements[i].type == "checkbox"){
						if(document.frminscribir.elements[i].checked){
							cadena += document.frminscribir.elements[i].value+","
						}
					}
				}
				document.frminscribir.strdocumentos.value= cadena;
			}
                        
             function eliminar_situacion(id_expediente,id_situacion){
                if(confirm("Desea eliminar este expediente")){
                    xajax_eliminar_situacion(id_expediente,id_situacion);
                }
            }
        </script>
        
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
    </head>
    <body onload="cargar('<?php echo $lngcodigo_expediente ?>')">
        <center>
            <form name="frminscribir" id="frminscribir" method="post">
                <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
                <input type="hidden" id="id_proexpediente" name="id_proexpediente" value="<?php echo $lngcodigo_expediente ?>" />
                <input type="hidden" id="id_proexpediente_actuaciones" name="id_proexpediente_actuaciones" value="" />
		<input type="hidden" id="id_proexpediente_situacion" name="id_proexpediente_situacion" value="" />
                <input type="hidden" id="id_proexpediente_fase" name="id_proexpediente_fase" value="" />                
                <input type="hidden" id="id_abogado_resp" name="id_abogado_resp" value="<?php echo $_SESSION['id_contacto']; ?>" />
		<input type="hidden" id="id_abogado_ejecutor" name="id_abogado_ejecutor" value="" />
                <input type="hidden" id="id_solicitante" name="id_solicitante" value="" />                    
                <input type="hidden" id="id_contrarios" name="id_contrarios" value="" />                   
                <input type="hidden" id="strdocumentos" name="strdocumentos" value="" />
                <input type="hidden" id="id_honorario" name="id_honorario" value="" />                
                <fieldset style="border:#339933 2px solid">                                        
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="65%" class="menu_izq_titulo"><?php echo $titulo_formulario ?></td>
                        <td width="10%" align="center" class="menu_izq_titulo">
                            <img id="clock" name="back" src="../comunes/images/b_print.png" onmouseover="Tip('Imprimir')" onmouseout="UnTip()" border="0" onclick="javascript:alert('Por Definir Desarrollo del Modulo');"/>                            
                            <img id="save" name="save" src="../comunes/images/disk.png" onmouseover="Tip('Guardar Expediente')" onmouseout="UnTip()" border="0" onclick="<?php echo $funcion ?>('');"/>
                            <img id="cerrar" style="display:none;" name="cerrar" src="../comunes/images/Privileges.png" onmouseover="Tip('Cerrar Expediente')" onmouseout="UnTip()" border="0" onclick="javascript:$('id_cerrar').toggle();$('id_observacion_cerrar').toggle();$('id_observacion_cerrar_button').toggle();"/>                            
                            <img id="back" name="back" src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='vista_tblproexpediente.php'"/>
                        </td>
                    </tr>
                    <tr>
                        <table width="100%" border="0" class="tablaTitulo" >
                            <tr id="msg" style="display:none;">
                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                    <div align="center" style="background-color:#2999e7;color:white;">
                                        <strong>CASO CERRADO</strong>
                                    </div>
                                </td>
                            </tr>           
                            <tr id="load">
                                <td colspan="6" align="right" style="border:#CCCCCC solid 0px;" bgcolor="#ffb109" >
                                    Cargando espere un momento... <img src="../comunes/images/s_host.png" border="0"/><img src="../comunes/images/loader4.gif" border="0"/>
                                </td>
                            </tr>                                 
                            <tr id="id_cerrar"  style="display:none;">
                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                    <div align="center" style="background-color:#ffb109;color:white;">
                                        <strong>CERRAR EXPEDIENTE</strong>
                                    </div>
                                </td>
                            </tr>                               
                            <tr id="id_observacion_cerrar"  style="display:none;">
                                <td width="20%">
                                    Observacion:
                                </td>
                                <td width="30%">
                                    <textarea id="strobservacion_cerrar" name="strobservacion_cerrar" cols="25" rows="4"></textarea>
                                </td>
                                <td width="20%">
                                    Fecha Cierre:
                                </td>
                                <td width="30%">
                                    <input id="feccierre" name="feccierre" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                    <img name="button"  id="lanzador_feccierre"  src="../comunes/images/calendar.png" align="middle"/>
                                    <script type="text/javascript">
                                        Calendar.setup({
                                            inputField     :    "feccierre",      // id del campo de texto
                                            ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                            button         :    "lanzador_feccierre"   // el id del botn que lanzar el calendario
                                        });
                                    </script>
                                </td>
                            </tr>  
                        
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
                                    <div id="capaIdTipoTramite">
                                        <select id="id_tipo_tramite" name="id_tipo_tramite" style='width:50%'>
                                            <option value="0">Seleccione</option>
                                        </select>
                                    </div>
                                </td>   
                                <td width="20%">Tipo de Atención</td>
                                <td width="30%">
                                        <div id="capaIdTipoAtencion">
                                        <select id="id_tipo_atencion" name="id_tipo_atencion" style='width:50%'>
                                            <option value="0">Seleccione</option>
                                        </select>
                                    </div>                                 
                                </td>      
                            </tr>                              
                            <tr>
                                <td width="20%">
                                    Nro Expediente:
                                </td>
                                <td width="30%">
                                    <input type="text" readonly="readonly" class='inputbox82' id="strnroexpediente" name="strnroexpediente" size="20" />
                                </td>
                                <td width="20%">
                                    Nro Expediente Auxiliar:
                                </td>
                                <td width="30%">
                                    <input type="text" class='inputbox82' id="strnroexpedienteauxiliar" name="strnroexpedienteauxiliar" size="20" />                                                                    
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    Fecha del Expediente:
                                </td>
                                <td width="30%">
                                    <input id="fecexpediente" name="fecexpediente" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                    <img name="button"  id="lanzador_fecexpediente"  src="../comunes/images/calendar.png" align="middle"/>
                                    <script type="text/javascript">
                                        Calendar.setup({
                                            inputField     :    "fecexpediente",      // id del campo de texto
                                            ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                            button         :    "lanzador_fecexpediente"   // el id del botn que lanzar el calendario
                                        });
                                    </script>
                                </td>
                                <td width="20%">
                                    Costo Contable:
                                </td>
                                <td width="30%">
                                    <input type="text" readonly="readonly" class='inputbox82' id="id_precio_con" name="id_precio_con" size="30" />
                                </td>
                            </tr>
                          
                            <tr>
                                <td width="20%">
                                    Fecha Solicitud:
                                </td>
                                <td width="30%">
                                    <input id="fecapertura" name="fecapertura" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                    <img name="button"  id="lanzador_fecapertura"  src="../comunes/images/calendar.png" align="middle"/>
                                    <script type="text/javascript">
                                        Calendar.setup({
                                            inputField     :    "fecapertura",      // id del campo de texto
                                            ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                            button         :    "lanzador_fecapertura"   // el id del botn que lanzar el calendario
                                        });
                                    </script>
                                </td>
                                <td width="20%">
                                    
                                </td>
                                <td width="30%">

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
                                    <li><a id="link3" href="#" rel="country3">Situaciónes</a></li>
<!--                                    <li><a id="link4" href="#" rel="country4">Documentos</a></li>                        -->
                                    <li><a id="link5" href="#" rel="country5">Fase</a></li>    
<!--                                    <li><a id="link6" href="#" rel="country6">Actuaciones</a></li>                                                            -->
<!--                                    <li><a id="link7" href="#" rel="country7" style="display:none">Divorcio/Sep</a></li>                                        -->
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
                                                    Solicitante actua Como:
                                                </td>
                                                    <td width="30%">
                                                        <div id="capaIdActuacion">
                                                            <select id="id_actuacion_persona" name="id_actuacion_persona" style='width:50%'>
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
                                                        <strong>SOLICITANTE</strong>
                                                    </div>
                                                </td>
                                            </tr>          
                                            <tr>
                                                <td width="20%">
                                                    C.I. Asistido:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="cedula_cliente" name="cedula_cliente" size="20" onKeyDown="xajax_buscarAsistidoPopup('','',document.frminscribir.cedula_cliente.value);"/>                             
                                                    <img src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Asistido')" onmouseout="UnTip()" border="0" onclick="vercatalogo(2);"/>                                                                                        
                                                </td>
                                                <td width="20%">
                                                    Nombre:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strnombre_cliente" name="strnombre_cliente" size="30" onKeyDown="xajax_buscarAsistidoPopup(document.frminscribir.strnombre_cliente.value,'','');"/>                             
                                                </td>
                                            </tr>     
                                            <tr>
                                                <td colspan="6">
                                                    <div id="contenedorAsistidos" style="width:100%;display: none;" align="left">
                                                        <div align="center"></div>
                                                    </div>
                                                </td>
                                            </tr>     
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>REPRESENTANTE DE LA ASOCIACIÓN</strong>
                                                    </div>
                                                </td>
                                            </tr>          
                                            <tr>
                                                <td width="20%">
                                                    Representante:
                                                </td>
                                                <td width="30%">
                                                    <input type="checkbox" class="inputbox"  name="strrepresentante" id="strrepresentante" value="1"/>
                                                </td>
                                                <td width="20%">
                                                </td>
                                                <td width="30%">
                                                </td>
                                            </tr>                                            
                                            <tr>
                                                <td width="20%">
                                                    Razón Social:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="raz_social" name="raz_social" size="30" onKeyDown="xajax_buscarAsistidoPopup(document.frminscribir.strnombre_cliente.value,'','');"/>                                                         
                                                </td>
                                                <td width="20%">
                                                </td>
                                                <td width="30%">
                                                </td>
                                            </tr>                                              
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>ABOGADOS</strong>
                                                    </div>
                                                </td>
                                            </tr>                                                
                                            <tr>
                                                <td width="20%">
                                                    C.I. Abogado Responsable:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" readonly="readonly" class='inputbox82' id="cedula_abogado_responsable" name="cedula_abogado_responsable" size="20" value="<?php echo $_SESSION['strdocumento']; ?>"/>                                  
<!--                                                    <img src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Abogado Responsable')" onmouseout="UnTip()" border="0" onclick="xajax_buscarAbogado(document.frminscribir.cedula_abogado_responsable.value,'responsable');"/>                                    -->
                                                </td>
                                                <td width="20%">
                                                    Nombre:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" readonly="readonly" class='inputbox82' id="strnombre_abogado_responsable" name="strnombre_abogado_responsable" size="30" value="<?php echo $_SESSION['strapellido'].", ".$_SESSION['strnombre']; ?>" />
                                                </td>
                                            </tr>    
                                            <tr>
                                                <td width="20%">
                                                    C.I. Abogado Ejecutor:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="cedula_abogado_ejecutor" name="cedula_abogado_ejecutor" size="20" onKeyDown="xajax_buscarAbogadosPopup('','',document.frminscribir.cedula_abogado_ejecutor.value);"/>                                  
<!--                                                    <img src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Abogado Responsable')" onmouseout="UnTip()" border="0" onclick="xajax_buscarAbogado(document.frminscribir.cedula_abogado_responsable.value,'responsable');"/>                                    -->
                                                    <img src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Abogado Ejecutor')" onmouseout="UnTip()" border="0" onclick="vercatalogo(1);"/>                                                                                        
                                                </td>
                                                <td width="20%">
                                                    Nombre:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strnombre_abogado_ejecutor" name="strnombre_abogado_ejecutor" size="30" onKeyDown="xajax_buscarAbogadosPopup(document.frminscribir.strnombre_abogado_ejecutor.value,'','');"/>                                  
                                                </td>
                                            </tr>        
                                            <tr>
                                                <td colspan="6">
                                                    <div id="contenedorAbogados" style="width:100%;display: none;" align="left">
                                                        <div align="center"></div>
                                                    </div>
                                                </td>
                                            </tr>                                            
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>ORGANISMO DIRECCIONADO</strong>
                                                    </div>
                                                </td>
                                            </tr>                            
                                            <tr>
                                                <td width="20%">
                                                    Tipo de Organismo:
                                                </td>
                                                <td width="30%">
                                                    <div id="capaIdTipoOrganismo">
                                                        <select id="id_tipo_organismo" name="id_tipo_organismo" style='width:50%'>
                                                            <option value="0">Seleccione</option>
                                                        </select>
                                                    </div>
                                                </td> 
                                                <td width="20%">Organismo</td>
                                                <td width="30%">
                                                    <div id="capaIdOrganismo">
                                                        <select id="id_organismo" name="id_organismo" style='width:50%'>
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
                                                <td width="20%">
                                                    Casos Abiertos:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="intcasosabiertos" readonly="readonly" name="intcasosabiertos" size="10" value="0"/>
                                                </td> 
                                                <td width="20%">Casos Cerrados</td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="intcasoscerrados" readonly="readonly" name="intcasoscerrados" size="10" value="0"/>
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
                                    <div id="country3" class="tabcontent" style="height:90%; overflow-y:auto">
                                            <table width="100%" border="0" class="tablaTitulo" >
                                                <tr>
                                                    <td colspan="6" bgcolor="#F8F8F8" >
                                                        <div align="right">
                                                        <img id="saveSituacion" style="display:none;" name="saveSituacion" src="../comunes/images/disk.png" onmouseover="Tip('Guardar Situación')" onmouseout="UnTip()" border="0" onclick="xajax_validar_situacion(xajax.getFormValues('frminscribir'));"/>
<!--                                                        <img id="delete" name="delete" src="../comunes/images/page_delete.png" onmouseover="Tip('Eliminar Honorario')" onmouseout="UnTip()" border="0" onclick="if (confirm('¿Seguro desea eliminar el Honorario?'))xajax_eliminarHonorario(xajax.getFormValues('frminserthonorarios'));"/>                            
                                                        <img id="back" name="back" src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='vista_tblprohonorarios.php'"/>-->
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
                                                        <div id="capaIdTipoMinuta">
                                                            <select id="id_tipo_minuta" name="id_tipo_minuta" style='width:50%'>
                                                                <option value="0">Seleccione</option>
                                                            </select>
                                                        </div>
                                                    </td> 
                                                    <td width="20%">Minuta</td>
                                                    <td width="30%">
                                                        <div id="capaIdMinuta">
                                                            <select id="id_minuta" name="id_minuta" style='width:50%'>
                                                                <option value="0">Seleccione</option>
                                                            </select>
                                                        </div>
                                                    </td>    
                                                </tr>
                                                <tr>
                                                    <td width="20%">
                                                        Fecha del Minuta:
                                                    </td>
                                                    <td width="30%">
                                                        <input id="fecminuta" name="fecminuta" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                                        <img name="button"  id="lanzador_fecminuta"  src="../comunes/images/calendar.png" align="middle"/>
                                                        <script type="text/javascript">
                                                            Calendar.setup({
                                                                inputField     :    "fecminuta",      // id del campo de texto
                                                                ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                                button         :    "lanzador_fecminuta"   // el id del botn que lanzar el calendario
                                                            });
                                                        </script>
                                                    </td>
                                                <td width="20%">Estado Situación:
                                                </td>
                                                    <td width="30%">
                                                        <div id="capaIdEstadoMinuta">
                                                            <select id="id_estado_minuta" name="id_estado_minuta" style='width:50%'>
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
                                                <td width="20%">
                                                    Observación:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strobservacion"  name="strobservacion" size="30" />
                                                </td> 
                                                <td width="20%"></td>
                                                <td width="30%"></td>    
                                            </tr>                                                   
                                            <tr>
                                                <td colspan="6">
                                                    <div id="contenedorSituaciones" style="width:100%;" align="left">
                                                        <div align="center"><img src="../comunes/images/ajax-loader.gif"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </table>
                                    </div>
<!--                                    <div id="country4"  class="tabcontent" style="height:100%; overflow-y:auto">
                                            <table width="100%" border="0" class="tablaTitulo" >
                                                <tr>
                                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                        <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                            <strong>Documento Consignados del Expediente</strong>
                                                        </div>
                                                    </td>
                                                </tr>                                                
                                                <tr>
                                                    <td colspan="6" bgcolor="#F8F8F8" >
                                                        <div id="capaDocumentos" ></div>
                                                    </td>
                                                </tr>                                                 
                                                <tr>
                                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                        <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                            <strong>Estado Fisico del Expediente</strong>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="20%">
                                                        Estado Fisico:
                                                    </td>
                                                    <td width="30%">
                                                        <div id="capaIdTipoFisicoExpediente">
                                                            <select id="id_estado_fisico_Expediente" name="id_tipo_espacio" style='width:50%'>
                                                                <option value="0">Seleccione</option>
                                                            </select>
                                                        </div>
                                                    </td> 
                                                    <td width="20%"></td>
                                                    <td width="30%">
                                                    </td>    
                                                </tr>      
                                                <tr>
                                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                        <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                            <strong>Inventario Expediente</strong>
                                                        </div>
                                                    </td>
                                                </tr>                                                
                                                <tr>
                                                    <td width="20%">
                                                        Tipo de Espacio:
                                                    </td>
                                                    <td width="30%">
                                                        <div id="capaIdTipoEspacio">
                                                            <select id="id_tipo_espacio" name="id_tipo_espacio" style='width:50%'>
                                                                <option value="0">Seleccione</option>
                                                            </select>
                                                        </div>
                                                    </td> 
                                                    <td width="20%">Tipo de Archivador</td>
                                                    <td width="30%">
                                                        <div id="capaIdTipoArchivador">
                                                            <select id="id_tipo_archivador" name="id_tipo_archivador" style='width:50%'>
                                                                <option value="0">Seleccione</option>
                                                            </select>
                                                        </div>
                                                    </td>    
                                                </tr>   
                                                <tr>
                                                    <td width="20%">
                                                        Piso Archivador:
                                                    </td>
                                                    <td width="30%">
                                                        <div id="capaIdTipoPisoArchivador">
                                                            <select id="id_tipo_piso_archivador" name="id_tipo_piso_archivador" style='width:50%'>
                                                                <option value="0">Seleccione</option>
                                                            </select>
                                                        </div>
                                                    </td> 
                                                    <td width="20%">Gaveta</td>
                                                    <td width="30%">
                                                        <div id="capaIdTipoArchivadorGaveta">
                                                            <select id="id_tipo_archivador_gaveta" name="id_tipo_archivador_gaveta" style='width:50%'>
                                                                <option value="0">Seleccione</option>
                                                            </select>
                                                        </div>
                                                    </td>    
                                                </tr>                                                  
                                            </table>
                                    </div>-->
                                    <div id="country5"  class="tabcontent" style="height:100%; overflow-y:auto;">
                                        <table width="100%" border="0" class="tablaTitulo" >
                                            <tr>
                                                <td colspan="6" bgcolor="#F8F8F8" >
                                                    <div align="right">
                                                    <img id="saveFase" style="display:none;" name="saveFase" src="../comunes/images/disk.png" onmouseover="Tip('Guardar Fase')" onmouseout="UnTip()" border="0" onclick="xajax_validar_fase(xajax.getFormValues('frminscribir'));"/>
<!--                                                        <img id="delete" name="delete" src="../comunes/images/page_delete.png" onmouseover="Tip('Eliminar Honorario')" onmouseout="UnTip()" border="0" onclick="if (confirm('¿Seguro desea eliminar el Honorario?'))xajax_eliminarHonorario(xajax.getFormValues('frminserthonorarios'));"/>                            
                                                    <img id="back" name="back" src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='vista_tblprohonorarios.php'"/>-->
                                                    </div>
                                                </td>
                                            </tr>                                              
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>FASES DEL EXPEDIENTE</strong>
                                                    </div>
                                                </td>
                                            </tr>  
                                            <tr>
                                                <td width="20%">
                                                    Fase del Expediente:
                                                </td>
                                                <td width="30%">
                                                    <div id="capaIdFase">
                                                        <select id="id_tipo_fase" name="id_fase" style='width:50%'>
                                                            <option value="0">Seleccione</option>
                                                        </select>
                                                    </div>                                                
                                                </td>
                                                <td width="20%">Situación de la Fase:
                                                </td>
                                                <td width="30%">
                                                    <div id="capaIdFaseSituacion">
                                                        <select id="id_fase" name="id_fase_situacion" style='width:50%'>
                                                            <option value="0">Seleccione</option>
                                                        </select>
                                                    </div>                                                            
                                                 </td>
                                            </tr>     
                                            <tr>
                                                <td width="20%">
                                                    Observación:
                                                </td>
                                                <td width="30%">
                                                    <textarea id="strobservacionfase" name="strobservacionfase" cols="25" rows="4"></textarea>                                                </td>
                                                <td width="20%">
                                                    Fecha:
                                                </td>
                                                <td width="30%">
                                                        <input id="fecfase" name="fecfase" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                                        <img name="button"  id="lanzador_fecfase"  src="../comunes/images/calendar.png" align="middle"/>
                                                        <script type="text/javascript">
                                                            Calendar.setup({
                                                                inputField     :    "fecfase",      // id del campo de texto
                                                                ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                                button         :    "lanzador_fecfase"   // el id del botn que lanzar el calendario
                                                            });
                                                        </script>
                                                </td>                                                        
                                            </tr>       
                                            <tr>
                                                <td colspan="6">
                                                    <div id="contenedorFases" style="width:100%;display: none;" align="left">
                                                        <div align="center"></div>
                                                    </div>
                                                </td>
                                            </tr>                                                    
                                        </table>
                                    </div>
<!--                                    <div id="country6"  class="tabcontent" style="height:100%; overflow-y:auto;">
                                        <table width="100%" border="0" class="tablaTitulo" >
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>ACTUACIONES DEL EXPEDIENTE</strong>
                                                    </div>
                                                </td>
                                            </tr>  
                                            <tr>
                                                <td colspan="6" bgcolor="#F8F8F8" >
                                                    <div align="right">
                                                    <img id="saveActuacion" style="display:none;" name="saveActuacion" src="../comunes/images/disk.png" onmouseover="Tip('Guardar Actuación')" onmouseout="UnTip()" border="0" onclick="document.frminscribir.strdescripcionactuacion.value= FCKeditorAPI.__Instances['descripcionact'].GetHTML();xajax_validar_actuacion(xajax.getFormValues('frminscribir'));"/>
                                                        <img id="delete" name="delete" src="../comunes/images/page_delete.png" onmouseover="Tip('Eliminar Honorario')" onmouseout="UnTip()" border="0" onclick="if (confirm('¿Seguro desea eliminar el Honorario?'))xajax_eliminarHonorario(xajax.getFormValues('frminserthonorarios'));"/>                            
                                                    <img id="back" name="back" src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='vista_tblprohonorarios.php'"/>
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
                                                <td width="20%">Detalle de la Actuacion:
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
                                                    Nombre de Actuación:
                                                </td>
                                                <td width="30%">
                                                    <div id="capaIdItemNombreActuacion">
                                                        <select id="id_nombre_actuacion" name="id_nombre_actuacion" style='width:50%'>
                                                            <option value="0">Seleccione</option>
                                                        </select>
                                                    </div>                                                
                                                </td>
                                                <td width="20%">Expediente Tribunal:</td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strexpedientetribunal" name="strexpedientetribunal" size="30" />
                                                </td> 
                                                          
                                                 </td>
                                            </tr>   
                                            <tr>
                                                <td width="20%">
                                                    Observación:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="actu_strobservacion"  name="actu_strobservacion" size="30" />                                                    
                                                <td width="20%">
                                                    Fecha:
                                                </td>
                                                <td width="30%">
                                                        <input id="actu_fecha" name="actu_fecha" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                                        <img name="button"  id="lanzador_actu_fecha"  src="../comunes/images/calendar.png" align="middle"/>
                                                        <script type="text/javascript">
                                                            Calendar.setup({
                                                                inputField     :    "actu_fecha",      // id del campo de texto
                                                                ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                                button         :    "lanzador_actu_fecha"   // el id del botn que lanzar el calendario
                                                            });
                                                        </script>
                                                </td>                                                        
                                            </tr>  
                                            
                                            <tr>
                                                    <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                        <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                            <strong>Descripción de la Actuación</strong>
                                                        </div>
                                                    </td>
                                             </tr>        
                                            <tr>
                                                <input type="hidden" name="strdescripcionactuacion" id="strdescripcionactuacion" value="">
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <?php
                                                        $oFCKeditor = new FCKeditor('descripcionact') ;
                                                        $oFCKeditor->BasePath = '../comunes/fckeditor/' ;
                                                        $oFCKeditor->Height = '300' ;
                                                        $oFCKeditor->Width= '680';
                                                        $oFCKeditor->ToolbarSet = 'firma';
                                                       // $oFCKeditor->Value = stripslashes($_REQUEST['firmaCorreo']);
                                                        $oFCKeditor->Create();
                                                    ?>

                                                </td>
                                            </tr>                                             
                                            <tr>
                                                <td colspan="6">
                                                    <div id="contenedorActuaciones" style="width:100%;display: none;" align="left">
                                                        <div align="center"></div>
                                                    </div>
                                                </td>
                                            </tr>                                                    
                                        </table>                                    </div>-->
<!--                                    <div id="country7"  class="tabcontent" style="height:100%; overflow-y:auto;">
                                        <table width="100%" border="0" class="tablaTitulo" >
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>PORTADA</strong>
                                                    </div>
                                                </td>
                                            </tr>  
                                            <tr>
                                                <td width="20%">
                                                    Referencia ó Titulo:
                                                </td>
                                                <td width="30%">
                                                    <div id="capaIdReferencia">
                                                        <select id="id_refer" name="id_refer" style='width:50%'>
                                                            <option value="0">Seleccione</option>
                                                        </select>
                                                    </div>                                                
                                                </td>
                                                <td width="20%">Generar Citación:
                                                </td>
                                                <td width="30%">
                                                    <div id="capaIdCitacion">
                                                        <select id="id_citacion" name="id_citacion" style='width:50%'>
                                                            <option value="0">Seleccione</option>
                                                        </select>
                                                    </div>                                                            
                                                 </td>
                                            </tr>     
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>DATO DEL CONYUGE A SEPARARSE</strong>
                                                    </div>
                                                </td>
                                            </tr>                                               
                                            <tr>
                                                <td width="20%">
                                                    C.I. Conyuge:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="cedula_conyugue" name="cedula_conyugue" size="20" onKeyDown="xajax_buscarConyuguePopup('','',document.frminscribir.cedula_cliente.value);"/>                             
                                                    <img src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Conyugue')" onmouseout="UnTip()" border="0" onclick="vercatalogo(3);"/>                                                                                        
                                                </td>
                                                <td width="20%">
                                                    Nombre:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strnombre_conyugue" name="strnombre_conyugue" size="30" onKeyDown="xajax_buscarConyuguePopup(document.frminscribir.strnombre_cliente.value,'','');"/>                             
                                                </td>
                                            </tr>       
                                            <tr>
                                                <td colspan="6">
                                                    <div id="contenedorConyugue" style="width:100%;display: none;" align="left">
                                                        <div align="center"></div>
                                                    </div>
                                                </td>
                                            </tr>                                                    
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>DIRECCIÓN DE LOS CONYUGES</strong>
                                                    </div>
                                                </td>
                                            </tr>                                              
                                         
                                            <tr>
                                                <td width="20%">
                                                    Dirección Asistido:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strdireccion_asistido" name="strdireccion_asistido" size="30" />
                                                </td>
                                                <td width="20%">
                                                    Dirección Conyuge:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strdireccion_conyugue" name="strdireccion_conyugue" size="30" />
                                                </td>
                                            </tr>   
                                            <tr>
                                                <td width="20%">
                                                    Dirección Último Domicilio:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strdireccion_ultimo_domicilio" name="strdireccion_ultimo_domicilio" size="30" />
                                                </td>
                                                <td width="20%">
                                                    Fecha de Separación:
                                                </td>
                                                <td width="30%">
                                                    <input id="fecseparacion" name="fecseparacion" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                                    <img name="button"  id="lanzador_fecseparacion"  src="../comunes/images/calendar.png" align="middle"/>
                                                    <script type="text/javascript">
                                                        Calendar.setup({
                                                            inputField     :    "fecseparacion",      // id del campo de texto
                                                            ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                            button         :    "lanzador_fecseparacion"   // el id del botn que lanzar el calendario
                                                        });
                                                    </script>
                                                </td>
                                            </tr>                                            
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>MENORES DE EDAD</strong>
                                                    </div>
                                                </td>
                                            </tr>                            
                                            <tr>
                                                <td width="20%">
                                                    Monto Obligación Manutención:
                                                </td>
                                                <td width="30%">
                                                        <input type="text" class='inputbox82' id="intmonto_manutencion" name="intmonto_manutencion" onblur="monto('intmonto_manutencion',document.frminscribir.intmonto_manutencion.value);" size="10" />
                                                </td> 
                                                <td width="20%">Regimen C. Familiar
                                                </td>
                                                <td width="30%">
                                                    <div id="capaIdRegimen">
                                                        <select id="id_regimen" name="id_regimen" style='width:50%'>
                                                            <option value="0">Seleccione</option>
                                                        </select>
                                                    </div>                                                            
                                                 </td>                                                
                                            </tr>            
                                            <tr id="regimen_cabecera" style="display:none;">
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>REGIMEN DE PRESENTACIÓN</strong>
                                                    </div>
                                                </td>
                                            </tr>                            
                                            <tr  id="regimen_input" style="display:none;">
                                                <td width="20%">
                                                    Días:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strdias" name="strdias" size="30" />
                                                </td> 
                                                <td width="20%">Horas:</td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="strhoras" name="strhoras" size="30" />
                                                </td>    
                                            </tr>         
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>CUOTAS ESPECIALES</strong>
                                                    </div>
                                                </td>
                                            </tr>                            
                                            <tr>
                                                <td width="20%">
                                                    Agosto:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="intcuotames1" name="intcuotames1" onblur="monto('intcuotames1',document.frminscribir.intcuotames1.value);" size="30" />
                                                </td> 
                                                <td width="20%">Diciembre:</td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="intcuotames2" name="intcuotames2" onblur="monto('intcuotames2',document.frminscribir.intcuotames2.value);" size="30" />
                                                </td>    
                                            </tr>                                               
                                        </table>
                                    </div>                                    -->
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
