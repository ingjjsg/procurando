<?php
session_start();
include("../comunes/fckeditor/fckeditor.php");
require_once "../controlador/tblactuacionesControlador.php";
require_once ('../comunes/xajax/xajax_core/xajax.inc.php');

if (isset($_GET['id'])) {
    $lngcodigo_expediente = $_GET['id'];
    $titulo_formulario = 'Editar Expediente Litigio';
    $funcion = 'editar';
} else {
    $titulo_formulario = 'Nuevo Expediente Litigio';
    $funcion = 'validar';
}

$xajax = new xajax();
$xajax->registerFunction('SumarMontos'); 
$xajax->registerFunction('verOtrasFasesMotivos'); 
$xajax->registerFunction('llenarSelectFormularioAbogadosMotivoReasignar'); 
$xajax->registerFunction('llenarSelectFormularioAbogadosReasignar');     
$xajax->registerFunction('validar_reasignacion');     
$xajax->registerFunction('guardar_reasignacion');  
$xajax->registerFunction('BuscarUsuarioAbogadoResponsable');
$xajax->registerFunction('verOtrosMotivo');
$xajax->registerFunction('verOtrasFases');
$xajax->registerFunction('buscarExpedienteAuxiliar');
$xajax->registerFunction('llenarSelectAnexaAgenda');
$xajax->registerFunction('buscarRepresentante');
$xajax->registerFunction('buscarAbogadosRepresentantesOrganismosPopup');
$xajax->registerFunction('llenarSelectCenDes');
$xajax->registerFunction('buscarContrario');
$xajax->registerFunction('buscarPersonasDemandadasPopup');
$xajax->registerFunction('ListaPersonasDemandadas');
$xajax->registerFunction('IngresarPersonasDemandadasExpediente');
$xajax->registerFunction('buscarPersonasDemandadasPopup');
$xajax->registerFunction('Eliminar_Abogados_Expediente');
$xajax->registerFunction('IngresarAbogadoRepresentantesExpediente');
$xajax->registerFunction('ListaAbogadosRepresentantes');
$xajax->registerFunction('buscarAbogadosOrganismosPopup');
$xajax->registerFunction('ListaAbogadosDemandantes');
$xajax->registerFunction('IngresarAbogadoExpedienteDemandantes');
$xajax->registerFunction('ListaAbogadosEjecutores');
$xajax->registerFunction('IngresarAbogadoEjecutorExpediente');
$xajax->registerFunction('llenarSelectTipoPestanaActuacion');
$xajax->registerFunction('selectSituacionDetalle');
$xajax->registerFunction('llenarSelectTipoFaseLitigio');
$xajax->registerFunction('llenarSelectTipoOrigen');
$xajax->registerFunction('llenarSelectTipoMotivo');
$xajax->registerFunction('llenarSelectActuacion');
$xajax->registerFunction('llenarSelectTipoOrganismo');
$xajax->registerFunction('llenarSelectOrganismo');
$xajax->registerFunction('guardar_expediente');
$xajax->registerFunction('validar_expediente');
$xajax->registerFunction('buscarAsistido');
$xajax->registerFunction('buscarDemandante');
$xajax->registerFunction('buscarAbogadoResponsable');
$xajax->registerFunction('buscarAbogadoDemandante');
$xajax->registerFunction('buscarAbogadoDemandantePopup');
$xajax->registerFunction('buscarAbogado');
$xajax->registerFunction('selectExpediente');
$xajax->registerFunction('editar_expediente');
$xajax->registerFunction('llenarNroExpediente');
$xajax->registerFunction('cerrarExpediente');
$xajax->registerFunction('buscarAbogadosPopup');
$xajax->registerFunction('buscarAsistidoPopup');
$xajax->registerFunction('buscarDemandantePopup');
$xajax->registerFunction('llenarSelectComboItemTipoActuacion');
$xajax->registerFunction('llenarSelectFormularioTipoActuacion');
$xajax->registerFunction('llenarSelectNombreItemTipoActuacion');
$xajax->registerFunction('selectActuacionHijo');
$xajax->registerFunction('validar_actuacion');
$xajax->registerFunction('guardar_actuacion');
$xajax->registerFunction('editar_actuacion');
$xajax->registerFunction('eliminar_actuacion');
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
<!--                <script type="text/javascript" src="../comunes/js/scriptaculous.js"></script>-->
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
                        $("#fecadmdem").mask("99/99/9999");
                        $("#fecnotdem").mask("99/99/9999");
                        $("#fecultnotordtri").mask("99/99/9999");
                        $("#fecinsaudpre").mask("99/99/9999");
                        $("#fecculfaspre").mask("99/99/9999");
                        $("#feccondem").mask("99/99/9999");
                        $("#fecadmpru").mask("99/99/9999");
                        $("#fecpubsen").mask("99/99/9999");
                        $("#fecapelacion").mask("99/99/9999");
                        $("#fecjuiorapub").mask("99/99/9999");
                        $("#fecingreso_demandante").mask("99/99/9999");
                        $("#0_fecingreso_demandante").mask("99/99/9999");
                        $("#1_fecingreso_demandante").mask("99/99/9999");    
                        $("#fecactuacion").mask("99/99/9999");                            
                        

                        $("#cancelo_prestaciones_demandante").live("click",function(){
                            $("#campos_prestaciones_demandante").animate({opacity: 'toggle'},function(){
                                $("#concepto_prestaciones_demandante").val("");
                                $("#monto_prestaciones_demandante").val("");
                            });
                        });

                        $("#cancelo_prestaciones_demandante_refiere").live("click",function(){
                            $("#campos_prestaciones_demandante_refiere").animate({opacity: 'toggle'},function(){
                                $("#concepto_prestaciones_demandante_refiere").val("");
                                $("#monto_prestaciones_demandante_refiere").val("");
                            });
                        });
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
                            xajax_buscarDemandantePopup('','','');                  
                        }   
                        if (num==3)
                        {
                            $('contenedorConyugue').toggle();
                            xajax_buscarConyuguePopup('','','');                  
                        } 
                        if (num==4)
                        {
                              $('contenedorAbogadosDemandantes').toggle();
                            xajax_buscarAbogadoDemandantePopup('','','');  
                        }
                        if (num==5)
                        {
                            $('contenedorAsistidosRefiere').toggle();
                            xajax_buscarDemandantePopup('','','','contenedorAsistidosRefiere');                  
                        }
                        if (num==6)
                        {
                            $('contenedorAbogadosRepresentantesOrganismos').toggle();
                            xajax_buscarAbogadosRepresentantesOrganismosPopup('','','');                    
                        }    
                        if (num==7)
                        {
                            $('contenedorPersonasDemandadas').toggle();
                            xajax_buscarPersonasDemandadasPopup('','','');                    
                        }                         
                    }                
                    function monto(caja,monto)
                    { var name=caja;
                        if (monto!='')
                         document.getElementById(name).value=FloattoFloatVE(monto);
                        else
                         document.getElementById(name).value=FloattoFloatVE(0);                            
                    }    
                        
                    function cargar(lngcodigo_expediente){
                        if(lngcodigo_expediente != ""){
                            xajax_selectExpediente(lngcodigo_expediente);
                        }
                        else{
                            xajax_BuscarUsuarioAbogadoResponsable();
                            xajax_llenarSelectFormularioAbogadosReasignar('');
                            xajax_llenarSelectFormularioAbogadosMotivoReasignar('');                              
                            xajax_llenarNroExpediente();
                            xajax_llenarSelectCenDes('');                             
                            xajax_llenarSelectTipoFaseLitigio('frminscribir');
//                            xajax_llenarSelectComboItemTipoActuacion();
                            xajax_llenarSelectTipoOrigen('frminscribir');                    
                            xajax_llenarSelectActuacion('frminscribir');
                            xajax_llenarSelectTipoOrganismo('frminscribir');
//                            xajax_llenarSelectTipoMinuta('frminscribir');
//                            xajax_llenarSelectTipoFase('frminscribir');                         
                            xajax_llenarSelectFormularioTipoActuacion('');  
//                            xajax_buscarDatosSituaciones('');
//                            xajax_buscarDatosReferidos('');
                            xajax_llenarSelectFormularioTipoEspacio('');
                            xajax_llenarSelectFormularioTipoEstadoFisicoExp('');                    
                            xajax_llenarSelectFormularioTipoArchivadorExp('');
                            xajax_llenarSelectFormularioPisoArchivadorExp(''); 
                            xajax_llenarSelectFormularioGavetaArchivadorExp('');  
                            xajax_llenarSelectAnexaAgenda('');                              
                            $('load').hide();
                        }
                    }
                    function editar()
                    {
                        llenarCategoria();
                        document.frminscribir.strdescripcion.value= FCKeditorAPI.__Instances['descripcion'].GetHTML();
                        document.frminscribir.strdescripcionestrategia.value= FCKeditorAPI.__Instances['descripcionest'].GetHTML();
                        
                        xajax_editar_expediente(xajax.getFormValues('frminscribir'));                     
                    }    
            
                    function validar()
                    {
                
                        llenarCategoria();
                        document.frminscribir.strdescripcion.value= FCKeditorAPI.__Instances['descripcion'].GetHTML();
                        document.frminscribir.strdescripcionestrategia.value= FCKeditorAPI.__Instances['descripcionest'].GetHTML();
                        xajax_validar_expediente(xajax.getFormValues('frminscribir'));
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
                        if(confirm("Desea eliminar esta situacion")){
                            xajax_eliminar_situacion(id_expediente,id_situacion);
                        }
                    }
                    
                    function eliminar_referido(id_expediente){
                        if(confirm("Desea eliminar este referido")){
                            xajax_eliminar_referido(id_expediente);
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
<!--                            <input type="text" id="id_proactuacion" name="id_proactuacion" value="<?php echo $lngcodigo_expediente ?>" />-->
                            <input type="hidden" id="id_proexpediente_situacion" name="id_proexpediente_situacion" value="" />
                            <input type="hidden" id="id_proexpediente_actuaciones" name="id_proexpediente_actuaciones" value="" />
                            <input type="hidden" id="id_actuacion_pestana" name="id_actuacion_pestana" value="" />
                            <input type="hidden" id="id_proexpediente_fase" name="id_proexpediente_fase" value="" />                
                            <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $_SESSION['id_contacto']; ?>" />
                            <input type="hidden" id="id_abogado_resp" name="id_abogado_resp" value="" />
                            <input type="hidden" id="strdocumentos" name="strdocumentos" value="" />
                            <input type="hidden" id="id_solicitante" name="id_solicitante" value="" />                            
                            
                            <fieldset style="border:#339933 2px solid">                                        
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="60%" class="menu_izq_titulo"><?php echo $titulo_formulario ?></td>
                                        <td width="15%" align="center" class="menu_izq_titulo">
                                            <img id="portada" name="portada" src="../comunes/images/book.png" onmouseover="Tip('Imprimir Portada')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='../reportes/reporte_constancia_portada_litigio.php?id=<?php echo $lngcodigo_expediente; ?>'"/>                            
                                            <!--<img id="clock" name="back" src="../comunes/images/b_print.png" onmouseover="Tip('Imprimir Constancia')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='../reportes/reporte_constancia_individual_litigio.php?id=<?php //echo $lngcodigo_expediente; ?>'"/>                            -->
                                            <img id="save" name="save" src="../comunes/images/disk.png" onmouseover="Tip('Guardar Expediente')" onmouseout="UnTip()" border="0" onclick="<?php echo $funcion ?>('');"/>
                                            <img id="cerrar" style="display:none;" name="cerrar" src="../comunes/images/Privileges.png" onmouseover="Tip('Cerrar Expediente')" onmouseout="UnTip()" border="0" onclick="javascript:$('id_cerrar').toggle();$('id_observacion_cerrar').toggle();$('id_observacion_cerrar_button').toggle();"/>                            
                                            <img id="back" name="back" src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='vista_litigio.php'"/>
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
                                                <td width="20%">Origen de la Causa                                </td>
                                                <td width="30%">
                                                    <div id="capaIdTipoOrigen">
                                                        <select id="id_origen" name="id_origen" style='width:50%'>
                                                            <option value="0">Seleccione</option>
                                                        </select>
                                                    </div>
                                                </td>   
                                                <td width="20%">Motivo de la Causa</td>
                                                <td width="30%">
                                                    <div id="capaIdTipoMotivo">
                                                        <select id="id_motivo" name="id_motivo" style='width:50%'>
                                                            <option value="0">Seleccione</option>
                                                        </select>
                                                    </div>                                 
                                                </td>      
                                            </tr>       
                                            <tr  id="motivo_input" style="display:none;">
                                                <td width="20%">
                                                    Otros:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="otromotivo" name="otromotivo" size="30" />
                                                </td> 
                                                <td width="30%">
                                                </td>    
                                            </tr>                                               
                                            <tr>
                                                <td width="20%">Estatus del Expediente                                </td>
                                                <td width="30%">
                                                    <div id="capaIdFaseLitigio">
                                                        <select id="id_fase" name="id_fase" style='width:50%'>
                                                            <option value="0">Seleccione</option>
                                                        </select>
                                                    </div>
                                                </td>   
                                                <td width="20%"><!--N° Correlativo--></td>
                                                <td width="30%"><input type="hidden"  class='inputbox82' id="id_proactuacion" readonly="readonly" name="id_proactuacion" value="<?php echo $lngcodigo_expediente ?>" />
                                                </td>      
                                            </tr>          
                                            <tr  id="fase_input" style="display:none;">
                                                <td id="texto_fase" width="20%">
                                                    
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="otrafase" name="otrafase" size="30" />
                                                </td> 
                                                <td width="30%">
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
                                                    Nro Expediente Tribunal:
                                                </td>
                                                <td width="30%">
                                                    <?php if (isset($_GET['id'])) { ?>
                                                    <input type="text" class='inputbox82' id="strnroexpedienteauxiliar" onblur="xajax_buscarExpedienteAuxiliar(document.frminscribir.strnroexpedienteauxiliar.value,document.frminscribir.id_proactuacion.value);" name="strnroexpedienteauxiliar" size="20" value="UP11-"/>                                                                    
                                                    <?php }else{?>
                                                    <input type="text" class='inputbox82' id="strnroexpedienteauxiliar" onblur="xajax_buscarExpedienteAuxiliar(document.frminscribir.strnroexpedienteauxiliar.value,document.frminscribir.id_proactuacion.value);" name="strnroexpedienteauxiliar" size="20" value="UP11-"/>                                                                    
                                                    <?php }?>                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>MONTOS</strong>
                                                    </div>
                                                </td>
                                            </tr>                                             
                                            <tr>
                                                <td width="20%">
                                                    Cuantia (Costo Contable):
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="intcuantias" name="intcuantias" size="30" onblur="monto('intcuantias',document.frminscribir.intcuantias.value);" size="10" />
                                                </td>
                                            </tr>
                                            <tr id="tr_intsentenciado"  style="display:none;">
                                                <td width="20%">
                                                      Sentenciado:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="intsentenciado" name="intsentenciado" size="30" onblur="xajax_SumarMontos(document.frminscribir.intsentenciado.value,document.frminscribir.inttranzado.value);" size="10" />
                                                </td>
                                            </tr>    
                                            <tr  id="tr_inttranzado"  style="display:none;">
                                                <td width="20%">
                                                    Transado:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class='inputbox82' id="inttranzado" name="inttranzado" size="30" onblur="xajax_SumarMontos(document.frminscribir.intsentenciado.value,document.frminscribir.inttranzado.value);" size="10" />
                                                </td>
                                            </tr>
                                            <tr  id="tr_intahorrado"  style="display:none;">
                                                <td width="20%">
                                                      Ahorrado:
                                                </td>
                                                <td width="30%">
                                                    <input type="text" readonly="readonly" class='inputbox82' id="intahorrado" name="intahorrado" size="30" size="10" />
                                                </td>
                                            </tr>                                              
                                            <tr>
                                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                    <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                        <strong>LEGITIMACIÓN</strong>
                                                    </div>
                                                </td>
                                            </tr>          
                                            <tr>
                                                <td width="20%">
                                                    Actua Como:
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
                                                        <strong>DATOS GENERALES</strong>
                                                    </div>
                                                </td>
                                            </tr>                                              
                                        </table>
                                    </tr>
                                    <tr> 
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                                            <tr><td height="100%">
                                                    <div align="left">
                                                        <ul id="countrytabs" class="shadetabs">
                                                        <?php if (isset($_GET['id'])) { ?>
                                                            <li><a id="link1" href="#" rel="country1" class="selected"  style="display:none"   >Datos Generales</a></li> 
                                                            <li><a id="link2" href="#" rel="country2">Descripción</a></li>
                                                         <?php } else { ?>     
                                                            <li><a id="link1" href="#" rel="country1" style="display:none"   >Datos Generales</a></li> 
                                                            <li><a id="link2" href="#" rel="country2" class="selected" >Descripción</a></li>
                                                        <?php }?>                                                             
                                                            <li><a id="link3" href="#" rel="country8"  style="display:none" >Fechas</a></li>
                                                            <li><a id="link4" href="#" rel="country3"  style="display:none">Situaciónes</a></li>
                                                            <li><a id="link5" href="#" rel="country4"  style="display:none" >Agenda</a></li>
                                                            <li><a id="link6" href="#" rel="country5"  style="display:none" >Documentos</a></li>                        
                                                            <li><a id="link7" href="#" rel="country6"  style="display:none">Fase</a></li>    
                                                            <li><a id="link8" href="#" rel="country7"  style="display:none" >Actuaciones</a></li>                                                            
                                                            <li><a id="link9" href="#" rel="country9"  style="display:none" >Refiere</a></li>
                                                            <li><a id="link10" href="#" rel="country10"  style="display:none" >Reasignar</a></li>
                                                            <li><a id="link11" href="#" rel="country11"  style="display:none" >Estrategias del Expediente</a></li>
                                                            
                                                           
                                                            <!--                                    <li><a id="link7" href="#" rel="country7" style="display:none">Divorcio/Sep</a></li>                                        -->
                                                        </ul>
                                                        <div style="background:#F8F8F8; border:solid 1px #cccccc; width:100%; height:700px" align="left">
                                                            <div id="country1"  class="tabcontent" style="height:100%; overflow-y:auto">
                                                                <table width="100%" border="0" class="tablaTitulo" >
                                                                    <tr>
                                                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                            <div align="center" style="background-image: url('../comunes/images/barraazul.png')">
                                                                                <strong>INFORMACIÓN CONTRARIOS</strong>
                                                                            </div>
                                                                        </td>
                                                                    </tr>                                                                       
                                                                </table>
                                                          <table width="100%" border="0" class="tablaTitulo">                                                                    
                                                                    <tr>
                                                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                            <div id="div_personas_demandados_demandantes" align="left" style="background-image: url('../comunes/images/barra.png')">
                                                                                <strong>ABOGADOS DE LOS  </strong>
                                                                                <img src="../comunes/images/user_suit_add.png" onmouseover="Tip('Agregar')" onmouseout="UnTip()" border="0" onclick="javascript:$('contenedorPersonasDemandadas').hide();$('id_tr_personas_demandadas').toggle();$('contenedorPersonasDemandadasExpediente').toggle();"/>
                                                                            </div>
                                                                        </td>
                                                                    </tr>                                                              
                                                                    <tr id="id_tr_personas_demandadas" style="display:none;">
                                                                        <td width="20%">
                                                                            C.I. Persona Natural:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input type="text" class='inputbox82' id="cedula_persona_demandada" name="cedula_persona_demandada" size="20" onKeyDown="xajax_buscarPersonasDemandadasPopup('','',document.frminscribir.cedula_persona_demandada.value);" onBlur="xajax_buscarPersonasDemandadasPopup('','',document.frminscribir.cedula_persona_demandada.value);"/>                                  
                                                                            <img src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Abogado Ejecutor')" onmouseout="UnTip()" border="0" onclick="vercatalogo(7);"/>                                                                                       
                                                                        </td>
                                                                        <td width="20%">
                                                                            Nombre:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input type="text" class='inputbox82' id="strnombre_persona_demandada" name="strnombre_persona_demandada" size="30" onKeyDown="xajax_buscarPersonasDemandadasPopup(document.frminscribir.strnombre_persona_demandada.value,'','');"/>                                  
                                                                            <input type="images" onmouseover="Tip('Ingresar Personas a Demandar')" style="background-color:#B9D5E3;border:1px outset #B9D5E3;color:#004E7D;cursor:pointer;margin:1px;padding:1px; width:55px; font-size:11px;" onclick="xajax_IngresarPersonasDemandadasExpediente(document.frminscribir.cedula_persona_demandada.value,document.frminscribir.id_proactuacion.value,'Persona');" value="Guardar" id="boton" name="boton">
                                                                            <input type="images" onmouseover="Tip('Cancelar Personas a Demandar')" style="background-color:#B9D5E3;border:1px outset #B9D5E3;color:#004E7D;cursor:pointer;margin:1px;padding:1px; width:55px; font-size:11px;" onclick="javascript:$('contenedorPersonasDemandadas').hide();$('id_tr_personas_demandadas').hide();$('contenedorPersonasDemandadasExpediente').show();" value="Cancelar" id="boton" name="boton">
                                                                       </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="6">
                                                                            <div id="contenedorPersonasDemandadas" style="width:100%;display: none;" align="left">
                                                                                <div align="center"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>  
                                                                    <tr>                                                              
                                                                        <td colspan="6">
                                                                            <div id="contenedorPersonasDemandadasExpediente" style="display:none;" align="left">
                                                                                <div align="center"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>                                                                   
                                                          </table>     
                                                                <table width="100%" border="0" class="tablaTitulo" >
                                                                    <tr>
                                                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                            <div id="div_demandados_demandantes" align="left" style="background-image: url('../comunes/images/barra.png')">
                                                                                <strong>ABOGADOS DE LOS  </strong>
                                                                                <img src="../comunes/images/user_suit_add.png" onmouseover="Tip('Nuevo Abogado')" onmouseout="UnTip()" border="0" onclick="javascript:$('contenedorAbogadosDemandantes').hide();$('id_tr_abogados_demandantes').toggle();$('contenedorAbogadosDemandantesExpediente').toggle();"/>
                                                                            </div>
                                                                        </td>
                                                                    </tr>                                                                
                                                                    <tr id="id_tr_abogados_demandantes" style="display:none;">
                                                                        <td width="20%">                                                                        
                                                                            C.I. Abogados Demandantes:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input type="text" class='inputbox82' id="cedula_abogado_demandante" name="cedula_abogado_demandante" size="20" value="" onKeyDown="xajax_buscarAbogadoDemandantePopup('','',document.frminscribir.cedula_abogado_demandante.value);" onBlur="xajax_buscarAbogadoDemandantePopup('','',document.frminscribir.cedula_abogado_demandante.value);"/>                                  
                                                                            <img src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Abogado Demandantes')" onmouseout="UnTip()" border="0" onclick="vercatalogo(4);"/> 
                                                                        </td>
                                                                        <td width="20%">
                                                                            Nombre:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input type="text" class='inputbox82' id="strnombre_abogado_demandante" name="strnombre_abogado_demandante" size="30" value="" onKeyDown="xajax_buscarAbogadoDemandantePopup(document.frminscribir.strnombre_abogado_demandante.value,'','');"/>
                                                                            <input type="images" align="center" onmouseover="Tip('Ingresar Abogado Demandantes')" style="background-color:#B9D5E3;border:1px outset #B9D5E3;color:#004E7D;cursor:pointer;margin:1px;padding:1px; width:55px; font-size:11px;" onclick="xajax_IngresarAbogadoExpedienteDemandantes(document.frminscribir.cedula_abogado_demandante.value,document.frminscribir.id_proactuacion.value,'Demandantes');" value="Guardar" id="boton" name="boton">
                                                                            <input type="images" onmouseover="Tip('Cancelar Abogado Demandantes')" style="background-color:#B9D5E3;border:1px outset #B9D5E3;color:#004E7D;cursor:pointer;margin:1px;padding:1px; width:55px; font-size:11px;" onclick="javascript:$('contenedorAbogadosDemandantes').hide();$('id_tr_abogados_demandantes').hide();$('contenedorAbogadosDemandantesExpediente').show();" value="Cancelar" id="boton" name="boton">
                                                                        </td>
                                                                    </tr>  
                                                                    <tr>                                                              
                                                                        <td colspan="6">
                                                                            <div id="contenedorAbogadosDemandantesExpediente" style="display:none;" align="left">
                                                                                <div align="center"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>                                                               
                                                                    <tr>
                                                                        <td colspan="6">
                                                                            <div id="contenedorAbogadosDemandantes" style="width:100%;display: none;" align="left">
                                                                                <div align="center"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>  
                                                                    <tr>
                                                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                            <div align="center" style="background-image: url('../comunes/images/barraazul.png')">
                                                                                <strong>ABOGADOS DE LA PROCURADURIA</strong>
                                                                            </div>
                                                                        </td>
                                                                    </tr>                                                                       
                                                                    <tr>
                                                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                            <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                                                <strong>ABOGADOS RESPONSABLES</strong>
                                                                            </div>
                                                                        </td>
                                                                    </tr>                                                
                                                                    <tr id="id_tr_abogados_responsables">
                                                                        <td width="20%">
                                                                            C.I. Abogado Responsable:
                                                                        </td>
                                                                        <td width="30%">
                                                                         <?php if (!isset($_GET['id'])) $cedula_abo_responsable=$_SESSION['strdocumento']; else $cedula_abo_responsable=''; ?>
                                                                            <input type="text" readonly="readonly" class='inputbox82' id="cedula_abogado_responsable" name="cedula_abogado_responsable" size="20" value="<?php echo $cedula_abo_responsable; ?>"/>                                  
                                                                        </td>
                                                                        <td width="20%">
                                                                            Nombre:
                                                                        </td>
                                                                        <td width="30%">
                                                                         <?php if (!isset($_GET['id'])) $nombre_abo_responsable=$_SESSION['strapellido'] . ", " . $_SESSION['strnombre']; else $nombre_abo_responsable=''; ?>
                                                                            <input type="text" readonly="readonly" class='inputbox82' id="strnombre_abogado_responsable" name="strnombre_abogado_responsable" size="30" value="<?php echo $nombre_abo_responsable; ?>" />
                                                                        </td>
                                                                    </tr>     
                                                                    <tr>
                                                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                            <div id="titulo_organismo_vista" align="center" style="background-image: url('../comunes/images/barraazul.png')">
                                                                                <strong>ABOGADOS DEL ORGANISMO DEMANDADO</strong>
                                                                            </div>
                                                                        </td>
                                                                    </tr>                                                                      
                                                                    <tr>
                                                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                            <div id="sub_titulo_organismo_vista" align="left" style="background-image: url('../comunes/images/barra.png')">
                                                                                <strong>ORGANISMO DEMANDADO</strong>
                                                                            </div>
                                                                        </td>
                                                                    </tr>                            
                                                                    <tr>
                                                                        <td width="20%">
                                                                            Tipo de Organismo:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <div id="capaIdTipoOrganismoCentralizado">
                                                                                <select id="id_tipo_organismo_centralizado" name="id_tipo_organismo" style='width:50%'>
                                                                                    <option value="0">Seleccione</option>
                                                                                </select>
                                                                            </div>
                                                                        </td> 
                                                                        <td width="20%">Organismo</td>
                                                                        <td width="30%">
                                                                            <div id="capaIdTipoOrganismo">
                                                                                <select id="id_tipo_organismo" name="id_organismo" style='width:50%'>
                                                                                    <option value="0">Seleccione</option>
                                                                                </select>
                                                                            </div>
                                                                        </td>    
                                                                    </tr>                                                                      
                                                                    <tr>
                                                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                            <div  align="left" style="background-image: url('../comunes/images/barra.png')">
                                                                                <strong>ABOGADOS REPRESENTANTES DEL ORGANISMO</strong>
                                                                               <img src="../comunes/images/user_suit_add.png" onmouseover="Tip('Nuevo Abogado')" onmouseout="UnTip()" border="0" onclick="javascript:$('contenedorAbogadosRepresentantesOrganismos').hide();$('id_tr_abogados_organismo').toggle();$('contenedorAbogadosOrganismosExpediente').toggle();"/>
                                                                            </div>
                                                                        </td>
                                                                    </tr>                                                                
                                                                    <tr id="id_tr_abogados_organismo" style="display:none;">
                                                                        <td width="20%">                                                                        
                                                                            C.I. Abogados Organismo:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input type="text" class='inputbox82' id="cedula_abogado_organismo" name="cedula_abogado_organismo" size="20" value="" onKeyDown="xajax_buscarAbogadosRepresentantesOrganismosPopup('','',document.frminscribir.cedula_abogado_organismo.value);" onBlur="xajax_buscarAbogadosRepresentantesOrganismosPopup('','',document.frminscribir.cedula_abogado_organismo.value);"/>                                  
                                                                           <img src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Abogado del Organismo Demandado')" onmouseout="UnTip()" border="0" onclick="vercatalogo(6);"/>                                                    
                                                                        </td>
                                                                        <td width="20%">
                                                                            Nombre:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input type="text" class='inputbox82' id="strnombre_abogado_organismo" name="strnombre_abogado_organismo" size="30" value="" onKeyDown="xajax_buscarAbogadosRepresentantesOrganismosPopup(document.frminscribir.strnombre_abogado_organismo.value,'','');"/>
                                                                            <input type="images" align="center" onmouseover="Tip('Ingresar Abogado del Organismo Demandado')" style="background-color:#B9D5E3;border:1px outset #B9D5E3;color:#004E7D;cursor:pointer;margin:1px;padding:1px; width:55px; font-size:11px;" onclick="xajax_IngresarAbogadoRepresentantesExpediente(document.frminscribir.cedula_abogado_organismo.value,document.frminscribir.id_proactuacion.value,'Representantes');" value="Guardar" id="boton" name="boton">
                                                                            <input type="images" onmouseover="Tip('Cancelar Abogado Demandantes')" style="background-color:#B9D5E3;border:1px outset #B9D5E3;color:#004E7D;cursor:pointer;margin:1px;padding:1px; width:55px; font-size:11px;" onclick="javascript:$('contenedorAbogadosRepresentantesOrganismos').hide();$('id_tr_abogados_organismo').hide();$('contenedorAbogadosOrganismosExpediente').show();" value="Cancelar" id="boton" name="boton">
                                                                        </td>
                                                                    </tr>  
                                                                    <tr>                                                              
                                                                        <td colspan="6">
                                                                            <div id="contenedorAbogadosOrganismosExpediente" style="display:none;" align="left">
                                                                                <div align="center"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>                                                               
                                                                    <tr>
                                                                        <td colspan="6">
                                                                            <div id="contenedorAbogadosRepresentantesOrganismos" style="width:100%;display: none;" align="left">
                                                                                <div align="center"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>                                                                                                                                   
                                          

                                                          </table>                                                                
                                                          <table width="100%" border="0" class="tablaTitulo" >  
                                                                    <tr>
                                                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                            <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                                                <strong>HISTORIAL DEL DEMANDADO</strong>
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
                                                                                <strong>DESCRIPCIÓN DEL CASO</strong>
                                                                            </div>
                                                                        </td>
                                                                    </tr>                                                
                                                                    <tr>
                                                                        <input type="hidden" name="strdescripcion" id="strdescripcion" value="">
                                                                            <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                                <?php
                                                                                $oFCKeditor = new FCKeditor('descripcion');
                                                                                $oFCKeditor->BasePath = '../comunes/fckeditor/';
                                                                                $oFCKeditor->Height = '300';
                                                                                $oFCKeditor->Width = '750';
                                                                                $oFCKeditor->ToolbarSet = 'firma';
                                                                                $oFCKeditor->Value = 'Descripciòn del Caso';
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
                                                            <div id="country4" class="tabcontent" style="height:1500px; overflow-y:auto">
                                                                <table width="100%" border="0" class="tablaTitulo" >
                                                                    <tr>
                                                                        <td colspan="6">
                                                                            <div id="capaIdTipoAgendaExpediente">
                                                                           <?php
                                                                            if ($lngcodigo_expediente) {
                                                                                $scr = "../vista/vista_tblagenda_Litigio.php?id=" . $lngcodigo_expediente;
                                                                                ?>
                                                                                <iframe  width="100%" scrolling="auto" height="800" frameborder="0" src="<?php echo $scr; ?>" scrolling="auto" frameborder="0" width="100%" height="600"></iframe>
                                                                            <?php } ?>
                                                                            </div>                                                                                
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div id="country5"  class="tabcontent" style="height:100%; overflow-y:auto">
                                                                <table width="100%" border="0" class="tablaTitulo" >
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
                                                                    <tr>
                                                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                            <div id="capaIdTipoDocumentoExpediente">

                                                                         </div> 
                                                                        </td>
                                                                    </tr>                                                                           
                                                                </table>
                                                            </div>
                                                            <div id="country6"  class="tabcontent" style="height:100%; overflow-y:auto;">
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
                                                            <div id="country7"  class="tabcontent" style="height:100%; overflow-y:auto;">
                                                                <table width="100%" border="0" class="tablaTitulo" >
                                                                    <tr>
                                                                        <td colspan="6" bgcolor="#F8F8F8" >
                                                                            <div align="right">
                                                                                <img id="saveActuacion" style="display:none;" name="saveActuacion" src="../comunes/images/disk.png" onmouseover="Tip('Guardar Actuación')" onmouseout="UnTip()" border="0" onclick="document.frminscribir.strdescripcionactuacion.value= FCKeditorAPI.__Instances['descripcionact'].GetHTML();xajax_validar_actuacion(xajax.getFormValues('frminscribir'));"/>                                                    
                                                                            </div>
                                                                        </td>
                                                                    </tr>                                                
                                                                    <tr>
                                                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                            <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                                                <strong>ACTUACIONES ANEXADAS</strong>
                                                                            </div>
                                                                        </td>
                                                                    </tr>   
                                                                    <tr>
                                                                        <td colspan="6">
                                                                            <div id="contenedorActuaciones" style="width:100%;display: none;" align="left">
                                                                                <div align="center"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                        <!--                                            <table id="formularioActuacion" style="display:none;" border="0" class="tablaTitulo"><tr><td>-->
                                                                    <tr>
                                                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                            <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                                                <strong>NUEVA ACTUACIÓN</strong>
                                                                            </div>
                                                                        </td>
                                                                    </tr>                                               
                                                                    <tr>
                                                                        <td width="20%">
                                                                            Nombre de Actuación:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input type="text" class='inputbox82' id="stronombreactuacion" name="stronombreactuacion" size="30" />
                                                                        </td>
                                                                        <td width="20%"><!--Expediente Tribunal:--></td>
                                                                        <td width="30%">
                                                                            <!--<input type="text" class='inputbox82' id="strexpedientetribunal" name="strexpedientetribunal" size="15" />-->
                                                                        </td> 
                                                                    </tr>   
                                                                    <tr>
                                                                        <td width="20%">
                                                                            Fecha:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input id="fecactuacion" name="fecactuacion" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                                                                <img name="button"  id="lanzador_fecactuacion"  src="../comunes/images/calendar.png" align="middle"/>
                                                                                <script type="text/javascript">
                                                                                    Calendar.setup({
                                                                                        inputField     :    "fecactuacion",      // id del campo de texto
                                                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                                                        button         :    "lanzador_fecactuacion"   // el id del botn que lanzar el calendario
                                                                                    });
                                                                                </script>
                                                                        </td>   
                                                                        <td width="20%">
                                                                            ¿Anexa a Agenda?
                                                                        </td>
                                                                        <td width="30%">
                                                                            <div id="capaIdItemAnexaActuacion">
                                                                                <select id="id_anexa_actuacion" name="id_actuacion" style='width:50%'>
                                                                                    <option value="0">Seleccione</option>
                                                                                </select>
                                                                            </div>   
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
                                                                                $oFCKeditor = new FCKeditor('descripcionact');
                                                                                $oFCKeditor->BasePath = '../comunes/fckeditor/';
                                                                                $oFCKeditor->Height = '300';
                                                                                $oFCKeditor->Width = '730';
                                                                                $oFCKeditor->ToolbarSet = 'firma';
                                                                                // $oFCKeditor->Value = stripslashes($_REQUEST['firmaCorreo']);
                                                                                $oFCKeditor->Create();
                                                                                ?>

                                                                            </td>
                                                                    </tr>                                             
                                                                    <!--                                                    </td></tr></table>   -->
                                                                </table>                                    
                                                            </div>
                                                            <div id="country8" class="tabcontent" style="height:900px; overflow-y:auto">
                                                                <table width="100%" border="0" class="tablaTitulo" >
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
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="20%">
                                                                            Fecha Admisión de la Demanda:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input id="fecadmdem" name="fecadmdem" type="text"  class='inputbox82' maxlength='20' size='15' value="" />
                                                                                <img name="button"  id="lanzador_fecadmdem"  src="../comunes/images/calendar.png" align="middle"/>
                                                                                <script type="text/javascript">
                                                                                    Calendar.setup({
                                                                                        inputField     :    "fecadmdem",      // id del campo de texto
                                                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                                                        button         :    "lanzador_fecadmdem"   // el id del botn que lanzar el calendario
                                                                                    });
                                                                                </script>
                                                                        </td>

                                                                        <td width="20%">
                                                                            Fecha Notificacion de la Demanda:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input id="fecnotdem" name="fecnotdem" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                                                                <img name="button"  id="lanzador_fecnotdem"  src="../comunes/images/calendar.png" align="middle"/>
                                                                                <script type="text/javascript">
                                                                                    Calendar.setup({
                                                                                        inputField     :    "fecnotdem",      // id del campo de texto
                                                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                                                        button         :    "lanzador_fecnotdem"   // el id del botn que lanzar el calendario
                                                                                    });
                                                                                </script>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="20%">
                                                                            Fecha Ultima Notificacion Ordenada por El Tribunal:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input id="fecultnotordtri" name="fecultnotordtri" type="text"  class='inputbox82' maxlength='20' size='15' value="" />
                                                                                <img name="button"  id="lanzador_fecultnotordtri"  src="../comunes/images/calendar.png" align="middle"/>
                                                                                <script type="text/javascript">
                                                                                    Calendar.setup({
                                                                                        inputField     :    "fecultnotordtri",      // id del campo de texto
                                                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                                                        button         :    "lanzador_fecultnotordtri"   // el id del botn que lanzar el calendario
                                                                                    });
                                                                                </script>
                                                                        </td>

                                                                        <td width="20%">
                                                                            Fecha Instalación Auidiencia Preliminar:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input id="fecinsaudpre" name="fecinsaudpre" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                                                                <img name="button"  id="lanzador_fecinsaudpre"  src="../comunes/images/calendar.png" align="middle"/>
                                                                                <script type="text/javascript">
                                                                                    Calendar.setup({
                                                                                        inputField     :    "fecinsaudpre",      // id del campo de texto
                                                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                                                        button         :    "lanzador_fecinsaudpre"   // el id del botn que lanzar el calendario
                                                                                    });
                                                                                </script>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="20%">
                                                                            Fecha Culminación Fase Preliminar:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input id="fecculfaspre" name="fecculfaspre" type="text"  class='inputbox82' maxlength='20' size='15' value="" />
                                                                                <img name="button"  id="lanzador_fecculfaspre"  src="../comunes/images/calendar.png" align="middle"/>
                                                                                <script type="text/javascript">
                                                                                    Calendar.setup({
                                                                                        inputField     :    "fecculfaspre",      // id del campo de texto
                                                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                                                        button         :    "lanzador_fecculfaspre"   // el id del botn que lanzar el calendario
                                                                                    });
                                                                                </script>
                                                                        </td>

                                                                        <td width="20%">
                                                                            Fecha De Contestacino de la demanda:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input id="feccondem" name="feccondem" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                                                                <img name="button"  id="lanzador_feccondem"  src="../comunes/images/calendar.png" align="middle"/>
                                                                                <script type="text/javascript">
                                                                                    Calendar.setup({
                                                                                        inputField     :    "feccondem",      // id del campo de texto
                                                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                                                        button         :    "lanzador_feccondem"   // el id del botn que lanzar el calendario
                                                                                    });
                                                                                </script>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="20%">
                                                                            Fecha Admisión de las Pruebas:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input id="fecadmpru" name="fecadmpru" type="text"  class='inputbox82' maxlength='20' size='15' value="" />
                                                                                <img name="button"  id="lanzador_fecadmpru"  src="../comunes/images/calendar.png" align="middle"/>
                                                                                <script type="text/javascript">
                                                                                    Calendar.setup({
                                                                                        inputField     :    "fecadmpru",      // id del campo de texto
                                                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                                                        button         :    "lanzador_fecadmpru"   // el id del botn que lanzar el calendario
                                                                                    });
                                                                                </script>
                                                                        </td>

                                                                        <td width="20%">
                                                                            Fecha De Juicio Oral y Público:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input id="fecjuiorapub" name="fecjuiorapub" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                                                                <img name="button"  id="lanzador_fecjuiorapub"  src="../comunes/images/calendar.png" align="middle"/>
                                                                                <script type="text/javascript">
                                                                                    Calendar.setup({
                                                                                        inputField     :    "fecjuiorapub",      // id del campo de texto
                                                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                                                        button         :    "lanzador_fecjuiorapub"   // el id del botn que lanzar el calendario
                                                                                    });
                                                                                </script>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="20%">
                                                                            Fecha Publicación de la Sentencia:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input id="fecpubsen" name="fecpubsen" type="text"  class='inputbox82' maxlength='20' size='15' value="" />
                                                                                <img name="button"  id="lanzador_fecpubsen"  src="../comunes/images/calendar.png" align="middle"/>
                                                                                <script type="text/javascript">
                                                                                    Calendar.setup({
                                                                                        inputField     :    "fecpubsen",      // id del campo de texto
                                                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                                                        button         :    "lanzador_fecpubsen"   // el id del botn que lanzar el calendario
                                                                                    });
                                                                                </script>
                                                                        </td>

                                                                        <td width="20%">
                                                                            Fecha De Apelación:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input id="fecapelacion" name="fecapelacion" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                                                                <img name="button"  id="lanzador_fecapelacion"  src="../comunes/images/calendar.png" align="middle"/>
                                                                                <script type="text/javascript">
                                                                                    Calendar.setup({
                                                                                        inputField     :    "fecapelacion",      // id del campo de texto
                                                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                                                        button         :    "lanzador_fecapelacion"   // el id del botn que lanzar el calendario
                                                                                    });
                                                                                </script>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div id="country9"  class="tabcontent" style="height:100%; overflow-y:auto">
                                                                <table width="100%" border="0" class="tablaTitulo" >
                                                                    <tr>
                                                                        <td colspan="6" bgcolor="#F8F8F8" >
                                                                            <div align="right">
                                                                                <img id="saveRefiere"  name="saveRefiere" src="../comunes/images/disk.png" onmouseover="Tip('Guardar Referido')" onmouseout="UnTip()" border="0" onclick="xajax_validar_referido(xajax.getFormValues('frminscribir'));"/>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                             
                                                                    <tr>
                                                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                            <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                                                <strong>DEMANDANTE</strong>
                                                                            </div>
                                                                        </td>
                                                                    </tr>          
                                                                    <tr>
                                                                        <td width="20%">
                                                                            C.I. Demandante:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input type="text" class='inputbox82' id="cedula_cliente_refiere" name="cedula_cliente_refiere" size="20" onKeyDown="xajax_buscarAsistidoPopup('','',document.frminscribir.cedula_cliente.value);"/>                             
                                                                            <img src="../comunes/images/ico_18_127.gif" onmouseover="Tip('Buscar Asistido')" onmouseout="UnTip()" border="0" onclick="vercatalogo(5);"/>                                                                                        
                                                                        </td>
                                                                        <td width="20%">
                                                                            Nombre:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input type="text" class='inputbox82' id="strnombre_cliente_refiere" name="strnombre_cliente_refiere" size="30" onKeyDown="xajax_buscarAsistidoPopup(document.frminscribir.strnombre_cliente.value,'','');"/>                             
                                                                        </td>
                                                                    </tr>     
                                                                    <tr>
                                                                        <td colspan="6">
                                                                            <div id="contenedorAsistidosRefiere" style="width:100%;display: none;" align="left">
                                                                                <div align="center"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                            <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                                                <strong>Datos del Demandante</strong>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="20%">
                                                                            Tiempo de Servicio:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input type="text" class='inputbox82' id="tiempo_servicio_demandante_refiere" name="tiempo_servicio_demandante_refiere" size="20" />
                                                                        </td>
                                                                        <td width="20%">
                                                                            Fecha Ingreso:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input id="fecingreso_demandante_refiere" name="fecingreso_demandante_refiere" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                                                                <img name="button"  id="lanzador_fecingreso_demandante_refiere"  src="../comunes/images/calendar.png" align="middle"/>
                                                                                <script type="text/javascript">
                                                                                    Calendar.setup({
                                                                                        inputField     :    "fecingreso_demandante_refiere",      // id del campo de texto
                                                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                                                        button         :    "lanzador_fecingreso_demandante_refiere"   // el id del botn que lanzar el calendario
                                                                                    });
                                                                                </script>
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="20%">
                                                                            Fecha Egreso:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input id="fecegreso_demandante_refiere" name="fecegreso_demandante_refiere" type="text"  class='inputbox82' maxlength='20' size='15' value="">
                                                                                <img name="button"  id="lanzador_fecegreso_demandante_refiere"  src="../comunes/images/calendar.png" align="middle"/>
                                                                                <script type="text/javascript">
                                                                                    Calendar.setup({
                                                                                        inputField     :    "fecegreso_demandante_refiere",      // id del campo de texto
                                                                                        ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                                                        button         :    "lanzador_fecegreso_demandante_refiere"   // el id del botn que lanzar el calendario
                                                                                    });
                                                                                </script>
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
                                                                            <textarea id="motivo_culminacion_demandante_refiere" name="motivo_culminacion_demandante_refiere" rows="4" cols="25" style="resize:none"></textarea>
                                                                        </td>
                                                                        <td width="20%">
                                                                        </td>
                                                                        <td width="30%">
                                                                        </td>
                                                                        
                                                                    </tr>                                                                    
                                                                    <tr>
                                                                        <td width="20%">
                                                                            Se le canceló algún adelanto de prestaciones:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input type="checkbox" value="1" id="cancelo_prestaciones_demandante_refiere" name="cancelo_prestaciones_demandante_refiere">
                                                                        </td>
                                                                    </tr>
                                                                    
                                                                        <tr id="campos_prestaciones_demandante_refiere" style="display:none">
                                                                            <td width="20%">Concepto:</td>
                                                                            <td width="30%">
                                                                                <input type="text" class='inputbox82' id="concepto_prestaciones_demandante_refiere" name="concepto_prestaciones_demandante_refiere" />
                                                                            </td>
                                                                            <td width="20%">Monto:</td>
                                                                            <td width="30%">
                                                                                <input id="monto_prestaciones_demandante_refiere" class='inputbox82' name="monto_prestaciones_demandante_refiere" />
                                                                            </td>
                                                                        </tr>
                                                                    
                                                                    <tr>
                                                                        <td width="20%">
                                                                            Monto de la Demanda:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input type="text" value="" id="monto_demanda_demandante_refiere" name="monto_demanda_demandante_refiere" />
                                                                        </td>
                                                                    </tr>
                                                                    
                                                                    <tr>
                                                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                            <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                                                <strong>Referidos del Expediente</strong>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="6">
                                                                            <div id="contenedorReferidos" style="width:100%" align="left">
                                                                                <div align="center"></div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>     
                                                                </table>
                                                            </div>
                                                            <div id="country10"  class="tabcontent" style="height:100%; overflow-y:auto">
                                                                    <table width="100%" border="0" class="tablaTitulo" >
                                                                    <tr>
                                                                        <td colspan="6" bgcolor="#F8F8F8" >
                                                                            <div align="right">
                                                                            <img id="saveReasignar" style="display:none;" name="saveReasignar" src="../comunes/images/disk.png" onmouseover="Tip('Reasignar Expediente')" onmouseout="UnTip()" border="0" onclick="xajax_validar_reasignacion(xajax.getFormValues('frminscribir'));"/>                                                    
                                                                            </div>
                                                                        </td>
                                                                    </tr>                                                  
                                                                        <tr>
                                                                            <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                                <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                                                    <strong>Reasignar Expediente a Otro Usuario</strong>
                                                                                </div>
                                                                            </td>
                                                                        </tr>                                                
                                                                    <tr>
                                                                        <td width="20%">
                                                                            Motivo:
                                                                        </td>
                                                                        <td width="30%">
                                                                            <div id="capaIdMotivoReasignacion">
                                                                                <select id="id_motivo_reasignacion" name="id_motivo_reasignacion" style='width:50%'>
                                                                                    <option value="0">Seleccione</option>
                                                                                </select>
                                                                            </div>                                                            
                                                                        </td> 
                                                                        <td width="20%">Abogado
                                                                        </td>
                                                                        <td width="30%">
                                                                            <div id="capaIdAbogadoReasignado">
                                                                                <select id="id_reasignacion_abogado" name="id_reasignacion_abogado" style='width:50%'>
                                                                                    <option value="0">Seleccione</option>
                                                                                </select>
                                                                            </div>                                                            
                                                                        </td>                                                
                                                                    </tr>                                             
                                                                </table>
                                                            </div>
                                                            <div id="country11"  class="tabcontent" style="height:100%; overflow-y:auto;">
                                                                <table width="100%" border="0" class="tablaTitulo" >
                                                                    <tr>
                                                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                            <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                                                <strong>ESTRATEGIAS DEL CASO</strong>
                                                                            </div>
                                                                        </td>
                                                                    </tr>        
                                                                    <tr>
                                                                        <input type="hidden" name="strdescripcionestrategia" id="strdescripcionestrategia" value="">
                                                                            <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                                                                <?php
                                                                                $oFCKeditor = new FCKeditor('descripcionest');
                                                                                $oFCKeditor->BasePath = '../comunes/fckeditor/';
                                                                                $oFCKeditor->Height = '300';
                                                                                $oFCKeditor->Width = '730';
                                                                                $oFCKeditor->ToolbarSet = 'firma';
                                                                                // $oFCKeditor->Value = stripslashes($_REQUEST['firmaCorreo']);
                                                                                $oFCKeditor->Create();
                                                                                ?>

                                                                            </td>
                                                                    </tr>                                             
                                                                    <!--                                                    </td></tr></table>   -->
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
                                    </tr>
                                </table>
                            </fieldset>


                        </form>            
                    </center>
                </body>
                </html>
