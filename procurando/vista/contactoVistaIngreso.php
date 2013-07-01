<?php
    session_start();
	include("../comunes/fckeditor/fckeditor.php") ;
    require_once "../controlador/contactoControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');

    $xajax= new xajax();
    $xajax->registerFunction('llenarSelectCargo');
    $xajax->registerFunction('llenarSelectEstatus');
    $xajax->registerFunction('llenarSelectPerfil');
    $xajax->registerFunction('llenarSelectDpto');
    $xajax->registerFunction('llenarSelectCoord');
    $xajax->registerFunction('llenarSelectCoordext');
    $xajax->registerFunction('verificarLogin');
    $xajax->registerFunction('insertContacto');
    $xajax->registerFunction('updateContacto');
    $xajax->registerFunction('updateContacto2');
    $xajax->registerFunction('updateContacto3');
    $xajax->registerFunction('verificarDocumento');
    $xajax->registerFunction('validarContrasena');
   	$xajax->processRequest();
    $xajax->printJavascript('../comunes/xajax/');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
			$xajax->printJavascript('../comunes/xajax/')
		?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="pragma" content="no-cache">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" >
        <link href="../comunes/css/general.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/enlaces.css" rel="stylesheet" type="text/css" />
        <script src="../comunes/js/funciones.js" type="text/javascript"></script>
        <script src="../comunes/js/prototype.js" type="text/javascript"></script>
         <script src="../comunes/js/jquery.js" type="text/javascript"></script>
        <script src="../comunes/js/jquery.maskedinput.js" type="text/javascript"></script>
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        <script language="javascript">
            jQuery(function($){
                $("#strtlfhab").mask("(0999) 999.99.99",{placeholder:" "});

            });

            function ValCam(objX,tipoX){
	var obj = document.getElementById(objX);
	var filter=/^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
	var filter2=/^[A-Z]*-[0-9]/;
	var filter3=/^([0-9\s\+\-])+$/;

	switch (tipoX) {
		case 'combo':
			obj.style.border = "1px solid #7f9db9";
		break;

		case 'combotipo':
			if (obl.value==""){
				alert("Seleccione un Tipo de Usuario");
				obj.style.border = "1px solid #FF0000";
			}else{
				obj.style.border = "1px solid #7f9db9";
			}
		break;

		case 'varchar':
			obj.style.border = "1px solid #7f9db9";
		break;

		case 'email':
			if (filter.test(obj.value)){
				obj.style.border = "1px solid #7f9db9";
				return true;
			}else{
				alert("Ingrese una dirección de correo válida");
				obj.style.border = "1px solid #FF0000";
				return false;
			}
		break;


		case 'cedrif':
			if (filter2.test(obj.value)){
				obj.style.border = "1px solid #7f9db9";
				return true;
			}else{
				alert("Ingrese una cédula o RIF válido");
				obj.style.border = "1px solid #FF0000";
				return false;
			}
		break;


		case 'telefono':
			if (filter3.test(obj.value)){
				obj.style.border = "1px solid #7f9db9";
				return true;
			}else{
				alert("Ingrese un número de teléfono válido");
				obj.style.border = "1px solid #FF0000";
				return false;
			}
		break;


		case 'int4':
			if (isNaN(parseInt(obj.value))){
				alert('Ingrese solo números enteros');
				obj.style.border = "1px solid #FF0000";return;
			}else{
				obj.style.border = "1px solid #7f9db9";
			}
		break;

		case 'date':
			if (!isDate(obj.value)){
				obj.style.border = "1px solid #FF0000";return;
			}else{
				obj.style.border = "1px solid #7f9db9";return;
			}
		break;

		case 'time':
		break;

		case 'float8':
			if (isNaN(parseFloat(obj.value))){
				alert('Ingrese solo números');
				obj.style.border = "1px solid #FF0000";return;
			}else{
				obj.style.border = "1px solid #7f9db9";return;
			}
		break;

		case 'bool':
			if ((obj.value!='Si') && (obj.value!='No')){
				alert('Ingrese solo Si o No');
				obj.style.border = "1px solid #FF0000";return;
			}else{
				obj.style.border = "1px solid #7f9db9";return;
			}
		break;

		default:
		break;
	}
}

function ValCon(objX){
	var obj = document.getElementById('8');
	var obj2 = document.getElementById('9');
	if (objX==9){
		if (obj.value!=obj2.value){
			alert('Las contraseñas no son iguales');
			obj.style.border = "1px solid #FF0000";
			obj2.style.border = "1px solid #FF0000";
			return;
		}else{
			obj.style.border = "1px solid #7f9db9";
			obj2.style.border = "1px solid #7f9db9";
			return;
		}
	}
}

            function cargar(acc,cargo, estatus, perfil, dpto, coord, coordExt){
                if(acc == 'INS'){
                    xajax_llenarSelectCargo();
                    xajax_llenarSelectEstatus();
                    xajax_llenarSelectPerfil();
                    xajax_llenarSelectDpto();
                }else{
                    xajax_llenarSelectCargo(cargo);
                    xajax_llenarSelectEstatus(estatus);
                    xajax_llenarSelectPerfil(perfil);
                    xajax_llenarSelectDpto(dpto);
                    xajax_llenarSelectCoord(dpto, coord);
                    xajax_llenarSelectCoordext(dpto, coordExt);
                }
            }
            function validar(acc, tipo, login){
                if (!campoRequerido(document.frmcontacto.strnombre,"Nombre")) return false;
                if (!campoRequerido(document.frmcontacto.strapellido,"Apellido")) return false;
                if (!campoRequerido(document.frmcontacto.strdocumento,"Cedula")) return false;
                if (!campoRequerido(document.frmcontacto.stremail,"Email")) return false;
                if (!campoRequerido(document.frmcontacto.strtlfhab,"Telefono")) return false;
                if(tipo == 'Interno'){
                    if (!campoRequerido(document.frmcontacto.strmediafirma,"Media Firma")) return false;
                }
                if (!campoRequerido(document.frmcontacto.memdireccion,"Dirección")) return false;
                if(tipo == 'Interno'){
                    if (!validarEditor('firma', 'Firma')) return false;
                    if (!campoRequerido(document.frmcontacto.strlogin,"Login")) return false;
                    if (!validaSelect(document.frmcontacto.id_cargo_maestro,'Cargo'))return false;
                    if (!validaSelect(document.frmcontacto.id_estatus_maestro,'Estatus'))return false;
                    if (!validaSelect(document.frmcontacto.id_profile_maestro,'Perfil'))return false;
                    if (!validaSelect(document.frmcontacto.id_dpto_maestro,'Departamento'))return false;
                    xajax_verificarLogin(document.frmcontacto.strlogin.value);
                    if(login != document.frmcontacto.strlogin.value){
                        if (!validaLogin(document.frmcontacto.valLogin, document.frmcontacto.strlogin)) return false;
                    }
                }
                if(acc == 'INS'){
                    if(tipo == 'Interno'){
                        document.frmcontacto.strfirma.value= FCKeditorAPI.__Instances['firma'].GetHTML();
                    }
                    xajax_insertContacto(xajax.getFormValues('frmcontacto'));

                }else{
                    if(tipo == 'Interno'){
                        document.frmcontacto.strfirma.value= FCKeditorAPI.__Instances['firma'].GetHTML();
                    }
                    xajax_updateContacto(xajax.getFormValues('frmcontacto'));

                }

            }
            function validar2(acc, tipo, login){
				var claveValida="";
                if (!campoRequerido(document.frmcontacto.strnombre,"Nombre")) return false;
                if (!campoRequerido(document.frmcontacto.strapellido,"Apellido")) return false;
                if (!campoRequerido(document.frmcontacto.strdocumento,"Cedula")) return false;
                if (!campoRequerido(document.frmcontacto.stremail,"Email")) return false;
                if (!campoRequerido(document.frmcontacto.strtlfhab,"Telefono")) return false;
                if(tipo == 'Interno'){
                    if (!campoRequerido(document.frmcontacto.strmediafirma,"Media Firma")) return false;
                }
                if (!campoRequerido(document.frmcontacto.memdireccion,"Dirección")) return false;
                if(tipo == 'Interno'){
                    if (!validarEditor('firma', 'Firma')) return false;
                    if (!campoRequerido(document.frmcontacto.strlogin,"Login")) return false;


                }
                if(acc == 'INS'){
                    if(tipo == 'Interno'){
                        document.frmcontacto.strfirma.value= FCKeditorAPI.__Instances['firma'].GetHTML();
                    }
                    xajax_insertContacto(xajax.getFormValues('frmcontacto'));
                }else{
                    if(tipo == 'Interno'){
                        document.frmcontacto.strfirma.value= FCKeditorAPI.__Instances['firma'].GetHTML();
                    }
                    if ((document.frmcontacto.strpassword.value) !="") {
                    	if((document.frmcontacto.strpassword2.value) !=""){
							if(document.frmcontacto.strpassword.value == document.frmcontacto.strpassword2.value){
								xajax_updateContacto3(xajax.getFormValues('frmcontacto'),document.frmcontacto.strpassword.value);



							} else {
								alert('Las contraseñas deben ser iguales');
									}
                   	}else {alert('Debe confirmar la contraseña');}

                    }else{
                    	xajax_updateContacto2(xajax.getFormValues('frmcontacto'));
                    }
                }

            }


        </script>
    </head>
    <body onload="javascript:cargar('<?= $_REQUEST['acc'] ?>', '<?= $_REQUEST['cargo'] ?>', '<?= $_REQUEST['estatus'] ?>', '<?= $_REQUEST['perfil'] ?>', '<?= $_REQUEST['dpto'] ?>', '<?= $_REQUEST['coord'] ?>', '<?= $_REQUEST['coordExt'] ?>');">
        <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
        <center>
            <form name="frmcontacto" id="frmcontacto" method="post">
                <input type="hidden" id="id_contacto" name="id_contacto" value="<?= $_REQUEST['id'] ?>">
                <input type="hidden" name="strfirma" id="strfirma" value="">
                <input type="hidden" name="id_tipo_maestro" id="id_tipo_maestro" value="<?= $_REQUEST['id_tipo_maestro'] ?>">
                <input type="hidden" id="valLogin" name="valLogin" value="">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="65%" class="menu_izq_titulo">Usuarios</td>
                        <td width="10%" align="center" class="menu_izq_titulo">

                            <?php if($_REQUEST['volver'] == "pendiente"){ ?>
                                 <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='blank.php'"/>
                                 <img src="../comunes/images/16_save.gif" onmouseover="Tip('Guardar Contacto Interno')" onmouseout="UnTip()" border="0" onclick="validar2('<?php echo $_REQUEST['acc'] ?>', '<?php echo $_REQUEST['tipo'] ?>', '<?= $_REQUEST['login'] ?>');"/>
                            <?php } else { ?>
                            	 <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Volver')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='contactoVista.php'"/>
                            	 <img src="../comunes/images/16_save.gif" onmouseover="Tip('Guardar Contacto Interno')" onmouseout="UnTip()" border="0" onclick="validar('<?php echo $_REQUEST['acc'] ?>', '<?php echo $_REQUEST['tipo'] ?>', '<?= $_REQUEST['login'] ?>');"/>
                           	<?php }  ?>
                        </td>
                    </tr>
                    <tr>
                        <table width="100%" border="0"  class="tablaTitulo" >
                            <tr>
                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                    <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                        <strong>Datos Personales</strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="1">&nbsp;</td>
                                <td width="95">
                                    <label id="lstrnombre">
                                        Nombres:
                                    </label>
                                </td>
                                <td width="176">
                                    <label>
                                    <?php if($_REQUEST['volver'] == "pendiente"){ ?>
                                        <input name="strnombre" type="text" class="inputbox" id="strnombre" readOnly="true" value="<?= $_REQUEST['nombre'] ?>">
                                    <?php } else { ?>
                                    	<input name="strnombre" type="text" class="inputbox" id="strnombre" value="<?= $_REQUEST['nombre'] ?>">
                                    <?php }  ?>
                                    </label>
                                </td>
                                <td width="89">
                                    <label id="lstrapellido">
                                        Apellidos:
                                    </label>
                                </td>
                                <td width="199">
                                <?php if($_REQUEST['volver'] == "pendiente"){ ?>
                                    <input name="strapellido" type="text" class="inputbox" id="strapellido" readOnly="true" value="<?= $_REQUEST['apellido'] ?>">
                                 <?php } else { ?>
                                 	 <input name="strapellido" type="text" class="inputbox" id="strapellido" value="<?= $_REQUEST['apellido'] ?>">
                                 <?php }  ?>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <label id="lstrdocumento">
                                        C&eacute;dula:
                                    </label>
                                </td>
                                <td>
                                    <label>
                                    <?php if($_REQUEST['volver'] == "pendiente"){ ?>
                                        <input name="strdocumento" type="text" class="inputbox" id="strdocumento" maxlength="9" readOnly="true" value="<?= $_REQUEST['documento'] ?>">
                                    <?php } else { ?>
                                    	<input name="strdocumento" type="text" class="inputbox" id="strdocumento" maxlength="9" value="<?= $_REQUEST['documento'] ?>" onblur="xajax_verificarDocumento(this.value);">
                                    <?php }  ?>
                                    </label>
                                </td>
                                <td>
                                    <label id="lstremail">Correo:</label>
                                </td>
                                <td>
                                    <input name="stremail" type="text" class="inputbox" id="stremail" onBlur="ValCam('stremail','email');" value="<?= $_REQUEST['email'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <label id="lstrtlfhab">
                                        Tel&eacute;fono:
                                    </label>
                                </td>
                                <td>
                                    <input name="strtlfhab" type="text" class="inputbox" maxlength="12" id="strtlfhab" value="<?= $_REQUEST['tlfn'] ?>">
                                </td>
                                <td>
                                    <label id="lstrext">
                                        Extensi&oacute;n:
                                    </label>
                                </td>
                                <td>
                                    <input name="strext" type="text" class="inputbox" id="text" value="<?= $_REQUEST['ext'] ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <label id="lstrmediafirma">
                                        Media Firma:
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input name="strmediafirma" type="text" class="inputbox" id="strmediafirma" value="<?= $_REQUEST['mediaFirma'] ?>">
                                    </label>
                                </td>
                                <td>
                                    <label id="lid_tipo_maestros">
                                        Tipo:
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <font size="3"> <?= $_REQUEST['tipo'] ?></font>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <label id="lmemdireccion">
                                        Direcci&oacute;n:
                                    </label>
                                </td>
                                <td colspan="4">
                                    <label>
                                        <textarea name="memdireccion" id="memdireccion" class="textareabox" cols="10"><?= $_REQUEST['direccion'] ?></textarea>
                                    </label>
                                </td>

                            </tr>
                            <?php if($_REQUEST['tipo'] == "Interno"){ ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td valign="top"><label id="lfirma">Firma:</label></td>
                                <td colspan="3" rowspan="2">
                                    <?php
                                        $oFCKeditor = new FCKeditor('firma') ;
                                        $oFCKeditor->BasePath = '../comunes/fckeditor/' ;
                                        $oFCKeditor->Height = '200' ;
                                        $oFCKeditor->Width= '470';
                                        $oFCKeditor->ToolbarSet = 'firma';
                                      //  if($_REQUEST['acc'] == 'ACT'){
                                            $oFCKeditor->Value = stripslashes($_REQUEST['firmaCorreo']);
                                       // }else{
                                        //    $oFCKeditor->Value = stripslashes($_REQUEST['firmaCorreo']);
                                        //}
                                        $oFCKeditor->Create() ;
                            }?>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                            </tr>
                            <tr>
                                <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                    <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                        <strong>Datos del Sistema</strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <label id="lstrlogin">
                                        Login:
                                    </label>
                                </td>
                                <td>

                                    <input name="strlogin" type="text" class="inputbox" id="strlogin"  value="<?= $_REQUEST['login'] ?>">



                                </td>
                                <?php if($_REQUEST['volver'] != "pendiente"){ ?>
                                	<td>
                                    	<input type="button" value="Verificar" onclick="xajax_verificarLogin(document.frmcontacto.strlogin.value);">
                                	</td>
                                	<td><div id="capaLogin">&nbsp;</div></td>
                                <?php } ?>
                            </tr>
                            <!--<tr>
                                <td>&nbsp;</td>
                                <td>
                                    <label id="lstrpassword">
                                        Password:
                                    </label>
                                </td>
                                <td>
                                    <input name="strpassword" type="password" class="inputbox" id="strpassword" value="$_REQUEST['password']" />
                                </td>
                                <td>
                                    <label id="lstrpassword2">
                                        Confirme Password:
                                    </label>
                                </td>
                                <td><input name="strpassword2" type="password" class="inputbox" id="strpassword2" value="$_REQUEST['password']" /></td>
                            </tr>-->
                           <?php if($_REQUEST['volver'] != "pendiente"){ ?>
    	                        <tr>
 	                               <td>&nbsp;</td>
                                	<td>
                            	        <label id="lid_cargo_maestro">
                        	                Cargo:
                    	                </label>
                	                </td>
            	                    <td>
        	                            <label>
    	                                    <div id='capaCargo'>
	                                            <select name="id_cargo_maestro" id="id_cargo_maestro" class="selectbox">
                                            	    <option value="0">Seleccione</option>
                                        	    </select>
                                    	    </div>
                                	    </label>
                            	    </td>
                        	        <td>
                    	                <label id="lid_estatus_maestro">
                	                        Estatus:
            	                        </label>
        	                        </td>
    	                            <td>
 	                                   <label>
                                        	<div id='capaEstatus'>
                                    	        <select name="id_estatus_maestro" id="id_estatus_maestro" class="selectbox">
                                	                <option value="0">Seleccione</option>
                            	                </select>
                        	                </div>
                    	                </label>
                	                </td>
            	                </tr>
        	                    <tr>
    	                            <td>&nbsp;</td>
	                                <td>
                            	        <label id="lid_profile_maestro">
                        	                Perfil:
                    	                </label>
                	                </td>
            	                    <td>
        	                            <label>
    	                                    <div id='capaProfile'>
 	                                           <select name="id_profile_maestro" id="id_profile_maestro" class="selectbox">
                                                	<option value="0">Seleccione</option>
                                            	</select>
                                        	</div>
                                    	</label>
                                	</td>
                                	<td>
                            	        <label id="lid_dpto_maestro">
                        	                <!--Departamento:-->
                                                Instituto:
                    	                </label>
                	                </td>
            	                    <td>
        	                            <label>
    	                                    <div id='capaDpto'>
  	                                          <select name="id_dpto_maestro" id="id_dpto_maestro" class="selectbox">
                                            	    <option value="0">Seleccione</option>
                                        	    </select>
                                    	    </div>
                                	    </label>
                            	    </td>
                        	    </tr>
                    	        <tr>
                	                <td>&nbsp;</td>
            	                    <td>
         	                           <label id="lid_coord_maestro">
                                    	    <!--Coordinaci&oacute;n:-->
                                            Departamento:
                                	    </label>
                            	    </td>
                        	        <td>
                    	                <label>
                                        	<div id='capaCoord'>
                                    	        <select name="id_coord_maestro" id="id_coord_maestro" class="selectbox">
                                	                <option value="0">Seleccione</option>
                            	                </select>
                        	                </div>
                    	                </label>
                	                </td>
            	                    <td>
        	                            <label id="lid_coordext_maestro">
    	                                    <!--Coordinaci&oacute;n Extra:-->
                                            Coordinacion:
	                                    </label>
                                	</td>
                                	<td>
                                    	<label>
                                        	<div id='capaCoordext'>
                                            	<select name="id_coordext_maestro" id="id_coordext_maestro" class="selectbox">
                                                	<option value="0">Seleccione</option>
                                            	</select>
                                        	</div>
                                    	</label>
                                	</td>
                            	</tr>


                            <?php } else {?>
                            	<tr>
                                	<td>&nbsp;</td>
                                	<td>
                                    	<label id="lstrpassword">
                                        	Nueva Clave:
                                   		 </label>
                               		</td>
                                	<td>
                                    	<input name="strpassword" type="password" class="inputbox" id="strpassword" value="<?=$_REQUEST['password']?>" />
                                	</td>
                               		<td>
                                    	<label id="lstrpassword2">
                                        	Confirme Clave:
                                    	</label>
                                	</td>
                                	<td><input name="strpassword2" type="password" class="inputbox" id="strpassword2" value="<?=$_REQUEST['password']?>" /></td>
                            	</tr>
                            <?php } ?>


                                <td colspan="6" style="border:#CCCCCC solid 1px;">
                                    <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                        <br>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </tr>
                </table>
             </form>
        </center>
    </body>
</html>