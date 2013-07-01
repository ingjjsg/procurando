<?php
    session_start();
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    include("../comunes/fckeditor/fckeditor.php") ;
    require_once '../controlador/correspondenciaControlador.php';
    require_once '../controlador/contactoControlador.php';
    require_once '../controlador/adjuntarControlador.php';
    require_once '../modelo/clDestinatariosModelo.php';
    $xajax= new xajax();
    $xajax->registerFunction('llenarSelectTipoCorres');
    $xajax->registerFunction('llenarSelectTipoDoc');
    $xajax->registerFunction('verDestinatarios');
    $xajax->registerFunction('insertCorrespondenciaExterna');
    $xajax->registerFunction('updateCorrespondencia');
    $xajax->registerFunction('updateDestinatariosEstatus');
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
        <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" >
        <link href="../comunes/css/general.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/enlaces.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/tabcontent.css" rel="stylesheet" type="text/css"  />
        <link href="../comunes/css/calendar-blue2.css" rel="stylesheet" type="text/css" media="all" title="win2k-cold-1" />
        <link rel='StyleSheet' href='../comunes/js/dtree.css' type='text/css' />
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
            function cargar(){
                xajax_llenarSelectTipoDoc(85);
            }
            function verDestinatariosToolTip(formInput, tipo){
                var cadena= "";
                var valor= formInput.value;
                var dest= valor.split(';');
                cadena+= "<table class='tablaTitulo'>";
                if(tipo == 'para'){
                    cadena+= "<tr><td align='left'><font color='blue'><b>De:</b></font></td></tr>";
                }
                for(i= 0; i < dest.length-1; i++){
                    cadena+= "<tr><td><li>"+dest[i]+"</li></td></tr>";
                }
                cadena+= "</table>";
                return cadena;
            }
            function verDestinatarios(id, tipoCorrespondencia){
                div = $('capa'+id);
                div.toggle();
                div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                xajax_verDestinatarios(id, tipoCorrespondencia);

            }

            function asignar(campo, campo2, dest, id){
                var formInput= campo;
                var formInput2= campo2;
                var cadena= formInput.value;
                var cadena2= formInput2.value;
                var myRegExp = eval('/'+dest+'/');
                var myRegExp2 = eval('/'+id+'/');
                var matchPos1 = cadena.search(myRegExp);
                var matchPos2 = cadena2.search(myRegExp2);
                if(matchPos1 == -1){
                    setInputText(formInput, cadena+dest+";");
                }else{
                    var destinatarios= cadena.split(';');
                    var cadenaNueva= '';
                    for(i= 0; i < destinatarios.length-1; i++){
                        if(destinatarios[i] != dest){
                            cadenaNueva+= destinatarios[i]+";";
                        }
                    }
                    setInputText(formInput, cadenaNueva);
                }
                if(matchPos2 == -1){
                    setHidden(formInput2, cadena2+id+";");
                }else{
                    var destinatariosId= cadena2.split(';');
                    var cadenaNueva2= '';
                    for(i= 0; i < destinatariosId.length-1; i++){
                        if(destinatariosId[i] != id){
                            cadenaNueva2+= destinatariosId[i]+";";
                        }
                    }
                    setHidden(formInput2, cadenaNueva2);
                }
            }
            function ver(id, hijo){
				div1 = $('ib'+id);
				div2 = $('il'+id);
                var myRegExp = /book_open.png/;
                var cadena= div1.src;
                var matchPos1 = cadena.search(myRegExp);
                var myRegExp2 = /minus.gif|plus.gif/;
                var cadena2= div2.src;
                var matchPos2 = cadena2.search(myRegExp2);
                if(matchPos1 == -1){
                    div1.src="../comunes/images/book_open.png";
                    if(matchPos2 == -1){
                        div2.src="../comunes/images/minusbottom.gif";
                    }else{
                        div2.src="../comunes/images/minus.gif";
                    }
                }else{
                    div1.src="../comunes/images/book.png";
                    if(matchPos2 == -1){
                        div2.src="../comunes/images/plusbottom.gif";
                    }else{
                        div2.src="../comunes/images/plus.gif";
                    }
                }
				div3= $(hijo);
				div3.toggle();
			}
            function validar(acc){
                if (!campoRequerido(document.frmredactar.strcorrelativo,"Número")) return false;
                if (!validaSelect(document.frmredactar.id_tipocorresp_maestro,'Tipo de Documento'))return false;
                if (!campoRequerido(document.frmredactar.dtmfecha,"Fecha de Recepción")) return false;
                if (!campoRequerido(document.frmredactar.para,"De")) return false;
                if (!campoRequerido(document.frmredactar.strasunto,"Asunto")) return false;
                if (!validaLongitud(document.frmredactar.strasunto, "Asunto", 150)) return false;
                if (!validarEditor('cuerpo', 'Cuerpo')) return false;
                document.frmredactar.strcuerpo.value= FCKeditorAPI.__Instances['cuerpo'].GetHTML();
                xajax_insertCorrespondenciaExterna(xajax.getFormValues('frmredactar'));
            }

        </script>
        <style>
        .botones{
            background-color:#B9D5E3;
            border:1px outset #B9D5E3;
            color:#004E7D;
            cursor:pointer;
            margin:5px;
            padding:1px;
            width:145px;
            font-size:10px;
            font-weight:bold;
        }
        </style>
    </head>
    <body onload="javascript:cargar();">
        <form name="frmredactar" id="frmredactar" method="post">
            <input type="hidden" id="id_estatus_maestro" name="id_estatus_maestro" value="199">
            <input type="hidden" id="id_tipo_maestro" name="id_tipo_maestro" value="85">
            <input type="hidden" name="paraId" id="paraId" value="">
            <input type="hidden" name="id_unidad_maestro" id="id_unidad_maestro" value="<?= ($_SESSION['id_coord_maestro'] != 0) ? $_SESSION['id_coord_maestro'] : $_SESSION['id_dpto_maestro'] ?>">
            <input type="hidden" name="id_contacto" id="id_contacto" value="<?= $_SESSION['id_contacto'] ?>">
            <input type="hidden" name="strcuerpo" id="strcuerpo" value="">
            <input type="hidden" id="adjunto" name="adjunto" value="<?php if (isset($dataAdjunto)) echo $dataAdjunto;?>">
            <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
            <div id="asuntos" style="display:none"></div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Redactar Externo</td>
                    <td width="10%" align="center" class="menu_izq_titulo">
                        <img src="../comunes/images/16_save.gif" onmouseover="Tip('Guardar')" onmouseout="UnTip()" border="0" onclick="validar('<?= $_REQUEST['acc'] ?>');"/>
                        <img src="../comunes/images/arrow_undo.png" onmouseover="Tip('Cancelar')" onmouseout="UnTip()" border="0" onclick="location.href='blank.php'"/>
                    </td>
                </tr>

            </table>
            <table width="100%"border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                <tr><td height="100%">
                <div align="center">
                    <ul id="countrytabs" class="shadetabs">
                        <li><a href="#" rel="country1" class="selected">Datos del Documento</a></li>
                        <li><a href="#" rel="country2">Cuerpo del Documento</a></li>
                        <li><a href="#" rel="country3">Adjuntar</a></li>
                    </ul>
                    <div style="background:#F8F8F8; border:solid 1px #cccccc; width:95%; height:330px" align="center">
                        <div id="country1" class="tabcontent" style="height:100%; overflow-y:auto">
                            <table width="100%" align="center" border="1" class="tablaTitulo">
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="5%">&nbsp;</td>
                                    <td width="30%">N&uacute;mero: </td>
                                    <td width="60%">
                                        <input type="text" id="strcorrelativo" name="strcorrelativo" value="">
                                    </td>
                                    <td width="5%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="5%">&nbsp;</td>
                                    <td width="30%">Tipo de Documento: </td>
                                    <td width="60%">
                                        <div id="capaDoc">
                                            <select id="id_tipocorresp_maestro" name="id_tipocorresp_maestro" style='width:90%'>
                                                <option value="0">Seleccione</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td width="5%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="5%">&nbsp;</td>
                                    <td width="30%">Fecha de Recepci&oacute;n: </td>
                                    <td width="60%">
                                        <input type="text" id="dtmfecha" name="dtmfecha" value="" readonly>
                                        <img name="button"  id="lanzador1"  src="../comunes/images/calendar.png" align="middle"/>
                                        <script type="text/javascript">
                                            Calendar.setup({
                                                inputField     :    "dtmfecha",      // id del campo de texto
                                                ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
                                                button         :    "lanzador1"   // el id del botn que lanzar el calendario
                                            });
                                        </script>
                                    </td>
                                    <td width="5%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="5%">&nbsp;</td>
                                    <td width="30%">De: </td>
                                    <td width="60%">
                                        <input type="text" id="para" name="para" size="40" value="<?= $strPR ?>" onmouseover="Tip(verDestinatariosToolTip(document.frmredactar.para, 'para'))" onmouseout='UnTip()'>
                                        <img src='../comunes/images/ver.gif' onmouseover="Tip('Ver Destinatarios')" onmouseout='UnTip()' onclick="verDestinatarios('para', document.frmredactar.id_tipo_maestro.value);">
                                        <div id="capapara" style="border:inset 1px black; width:470px; margin-top:3px; overflow:auto; height:150px; display:none;"></div>
                                    </td>
                                    <td width="5%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="5%">&nbsp;</td>
                                    <td width="30%">Asunto: </td>
                                    <td width="60%">
                                        <textarea id="strasunto" name="strasunto" cols="45" rows="2"><?= $_REQUEST['asunto'] ?></textarea>
                                    </td>
                                    <td width="5%">&nbsp;</td>
                                </tr>
                            </table>
                        </div>
                        <div id="country2" class="tabcontent" style="height:100%; overflow-y:auto">
                            <table width="100%" align="center" border="1" class="tablaTitulo">
                                <tr>
                                    <td align="center"><b>Cuerpo<b></td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <?php
                                            $oFCKeditor = new FCKeditor('cuerpo') ;
                                            $oFCKeditor->Width = '95%' ;
                                            $oFCKeditor->Height = '300' ;
                                            $oFCKeditor->BasePath = '../comunes/fckeditor/' ;
                                            $oFCKeditor->ToolbarSet = 'Default';
                                            $oFCKeditor->Value = "";
                                            $oFCKeditor->Create() ;
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="country3" class="tabcontent" style="height:100%; overflow-y:auto">
                            <iframe src="adjuntarVista.php<?php if (isset($dataAdjunto)) echo "?adjunto=".$dataAdjunto; ?>" name="iframe" id="iframe" width="100%" height="330px" scrolling="auto" style="border:none;background-color:#F8F8F8">
                            </iframe>
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
        </form>
    </body>
</html>
