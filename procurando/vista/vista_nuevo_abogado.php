<?php
    session_start();
    require_once "../controlador/controlador_abogados.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    require_once '../modelo/clPermisoModelo.php';
    require_once '../modelo/clConstantesModelo.php';
    if(isset($_GET['id'])){
        $lngcodigo_abogado = $_GET['id'];
        $titulo_formulario = 'Editar Abogado';
        $funcion = 'xajax_editar_abogado';
    }else{
        $titulo_formulario = 'Nuevo Abogado';
        $funcion = 'xajax_validar_abogado';
    }
    
    $formulario_accion=  clConstantesModelo::getFormulario_accion('abogados','abodados_procuraduria_litigio');
    
    $xajax= new xajax();
   
    $xajax->registerFunction('buscarDatosAbogados');
    $xajax->registerFunction('selectAllAbogadosFiltro');
    $xajax->registerFunction('llenarSelectEstados');
    $xajax->registerFunction('llenarSelectMunicipio');
    $xajax->registerFunction('llenarSelectBanco');
    $xajax->registerFunction('llenarSelectEstadoCivil');
    $xajax->registerFunction('llenarSelectSexo');
    $xajax->registerFunction('guardar_abogado');
    $xajax->registerFunction('selectAbogado');
    $xajax->registerFunction('editar_abogado');
    $xajax->registerFunction('validar_abogado');
    
    
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
        <script type="text/javascript" src="../comunes/js/ajaxupload.js"></script>
        <script src="../comunes/js/calendar.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_es.js" type="text/javascript"></script>
        <script src="../comunes/js/calendar_setup.js" type="text/javascript"></script>




        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        
        <script type="text/javascript">
	jQuery(document).ready(function(){
		
		var button = jQuery('#upload'), interval;
		new AjaxUpload(button,{
			action: 'subirFoto.php', 
			name: 'image',
			onSubmit : function(file, ext){
				// cambiar el texto del boton cuando se selecicione la imagen		
				button.text('Subiendo');
				// desabilitar el boton
				this.disable();
				
				interval = window.setInterval(function(){
					var text = button.text();
					if (text.length < 11){
						button.text(text + '.');					
					} else {
						button.text('Subiendo');				
					}
				}, 200);
			},
			onComplete: function(file, response){
				button.text('Subir Foto');
							
				window.clearInterval(interval);
							
				// Habilitar boton otra vez
				this.enable();
				
				// Añadiendo las imagenes a mi lista
				
//				if($('#gallery li').length == 0){
//					$('#gallery').html(response).fadeIn("fast");
//					$('#gallery li').eq(0).hide().show("slow");
//				}else{
					jQuery('#foto').html("<img width='100' height='120' src='fotos/"+response+"' />");
                                        jQuery('#strfoto').val(response);
					//$('#gallery li').eq(0).hide().show("slow");
//				}
			}
		});
		
		// Listar  fotos que hay en mi tabla
		jQuery("#foto").load("subirFoto.php?action=listFotos");
	});

</script>
        <script language="javascript">
            jQuery(function($){
                $("#strtelefono").mask("(9999) 999.99.99",{placeholder:" "});
                $("#strmovil").mask("(9999) 999.99.99",{placeholder:" "});
                $("#datefecnac").mask("99/99/9999",{placeholder:" "});
            });
            
            function cargar(lngcodigo_abogado){
                if(lngcodigo_abogado != ""){
                    xajax_selectAbogado(lngcodigo_abogado);
                }else{
                    xajax_llenarSelectEstados('frmabogado_nuevo');
                    xajax_llenarSelectSexo('');
                    xajax_llenarSelectBanco('')
                }
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
//            
//            function filtrar(){
//                var nombre= document.frmclientes.strnombre.value;
//                var apellido= document.frmclientes.strapellido.value;
//                var cedula= document.frmclientes.strcedula.value;
//                
//                xajax_selectAllClientesFiltro(nombre, apellido,cedula);
//                verForm('formulario');
//            }
        </script>
    </head>
    <body onload="cargar('<?php echo $lngcodigo_abogado ?>')" >
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frmabogado_nuevo" id="frmabogado_nuevo" method="post">
               <fieldset style="border:#339933 2px solid">                
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo"><?php echo $titulo_formulario ?></td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <?php 
                        if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario($formulario_accion['formulario']),'guardar', $formulario_accion['accion'])) {?>
                            <img src="../comunes/images/16_save.png" onmouseover="Tip('Guardar')" onmouseout="UnTip()" border="0" onclick="<?php echo $funcion ?>(xajax.getFormValues('frmabogado_nuevo'));"/>
                        &nbsp;&nbsp;&nbsp;
                        <?php }?>
                        <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="location.href='vista_abogados.php'"/>
                    </td>
                </tr>
            </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                <tr>
                    <td>
                        <div id="formulario" style=" width:100%;" align="left">
                                <input type="hidden" class='inputbox' id="id_abogado" name="id_abogado" size="30" />
                                <table width="100%" border="0" class="tablaVer" >
                                    <tr>
                                        <td width="20%">
                                            Nombre:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="strnombre" name="strnombre" size="30" />
                                        </td>
                                        <td width="20%">
                                            Apellido:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="strapellido" name="strapellido" size="30" />
                                        </td>
                                    </tr>
                                    <tr>
                                       <td width="20%">
                                            Cedula:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="strcedula" name="strcedula" size="30" />
                                        </td>
                                    </tr>
                                    <tr>
                                       <td width="20%">
                                            Estado:
                                        </td>
                                        <td width="30%">
                                            <div id="capaEstado">
                                                <select id="id_estado" name="id_estado" style='width:50%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                         <td width="20%">
                                            Municipio:
                                        </td>
                                        <td width="30%">
                                            <div id="capaMunicipio">
                                                <select id="id_municipio" name="id_municipio" style='width:50%'>
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
                                            <textarea class="textarea" id="strdireccion" rows="2" cols="25" name="strdireccion"></textarea>
                                        </td>
                                        <td width="20%">
                                            Telefono:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="strtelefono" name="strtelefono" size="30" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td width="20%">
                                            Email:
                                        </td>
                                        <td width="30%">
                                           <input type="text" class='inputbox' id="stremail" name="stremail" size="30" />
                                        </td>
                                        
                                    </tr>
                                    
                                     <tr>
                                        <td width="20%">
                                            Sexo:
                                        </td>
                                        <td width="30%">
                                          <div id="capaSexo">
                                                <select id="id_sexo" name="id_sexo" style='width:90%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                         
                                         <td width="20%">
                                            Codigo Postal:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="strcodigopostal" name="strcodigopostal" size="30" />
                                        </td>
                                        
                                       
                                    </tr>
                                    
                                                                     
                                                                   
                                    <tr>
                                        <td width="20%">
                                            Rif:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="strrif" name="strrif" size="30" />
                                        </td>
                                        <td width="20%">
                                            Movil:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="strmovil" name="strmovil" size="30" />
                                        </td>
                                    </tr>
                                    
                                     <tr>
                                        <td width="20%">
                                            Localidad:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="strlocalidad" name="strlocalidad" size="30" />
                                        </td>
                                        <td width="20%">
                                            Fax:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="strfax" name="strfax" size="30" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td width="20%">
                                            Pin:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="strpin" name="strpin" size="30" />
                                        </td>
                                        <td width="20%">
                                            Nif-Cif:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="strnif_cif" name="strnif_cif" size="30" />
                                        </td>
                                    </tr>
                                    
                                     <tr>
                                        <td width="20%">
                                            Banco:
                                        </td>
                                        <td width="30%">
                                          <div id="capaBanco">
                                                <select id="intbanco" name="intbanco" style='width:90%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td width="20%">
                                            Numero Cuenta:
                                        </td>
                                        <td width="30%">
                                            <input type="text" class='inputbox' id="strcuentaban" name="strcuentaban" size="30" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td width="20%">
<!--                                            Foto:-->
                                            Numero Colegiado:
                                        </td>
                                         <td width="50%">
                                            <input type="text" class='inputbox' id="strnumcolegiado" name="strnumcolegiado" size="30" />                                             
<!--                                        <div id="foto" style=" text-align: center; width:100;height: 120; border: solid #000 1px;">
                                            FOTO
                                        </div>-->
<!--                                             <a href="javascript:;" id="upload">Subir Foto</a>-->
                                             </td>
                                        
<!--                                            <input type="hidden" class='inputbox' id="strfoto" name="strfoto" size="30" />-->
                                            
                                            <td width="20%">
<!--                                            Numero Colegiado:-->
                                        </td>
                                        <td width="30%">

                                        </td>
                                       
                                        
                                    </tr>
                                    
                                    <tr>
                                        
                                       <td width="20%">
                                            Curriculum:
                                        </td>
                                        <td width="30%">
                                           <textarea id="strcurriculum" rows="2" cols="25" name="strcurriculum"></textarea>
                                        </td>
                                    </tr>
                                    
                                       <tr>
                                        <td width="20%">
                                            Observacion:
                                        </td>
                                        <td width="30%">
                                            <textarea id="strobservaciones" rows="2" cols="25" name="strobservaciones"></textarea>
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
