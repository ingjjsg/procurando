<?php
    session_start();
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    include("../comunes/fckeditor/fckeditor.php") ;
    require_once '../controlador/correspondenciaControlador.php';
    require_once '../controlador/contactoControlador.php';
    require_once '../controlador/adjuntarControlador.php';
    require_once '../modelo/clDestinatariosModelo.php';
    require_once '../modelo/clCorrespondenciaModelo.php';
    $xajax= new xajax();
    $xajax->registerFunction('llenarSelectTipoCorres');
    $xajax->registerFunction('llenarSelectTipoDoc');
    $xajax->registerFunction('verDestinatarios');
    $xajax->registerFunction('verAsuntosPredeterminados');
    $xajax->registerFunction('insertCorrespondencia');
    $xajax->registerFunction('updateCorrespondencia');
    $xajax->registerFunction('updateDestinatariosEstatus');
	$xajax->processRequest();
    $xajax->printJavascript('../comunes/xajax/');
    if($_REQUEST['acc'] == "ACT"){
        $destinatarios= new clDestinatariosModelo();
        $correspPrueba= new clCorrespondenciaModelo();
        $dataPrueba= $correspPrueba->selectAllCorrespondenciaById($_REQUEST['id']);
        if($dataPrueba[0]['id_tipo_maestro'] == 84){
            $dataDestinatarios= $destinatarios->selectAllDestinatariosByIdCorresp($_REQUEST['id']);
        
            $strPR= "";
            $strCC= "";
            $strCCO= "";
            $strIdPR= "";
            $strIdCC= "";
            $strIdCCO= "";
            for($i= 0; $i < count($dataDestinatarios); $i++){
                if($dataDestinatarios[$i]['nombre_tipoenvio_maestro'] == 'PR'){
                    $strPR.= $dataDestinatarios[$i]['destinatario'].";";
                    $strIdPR.= $dataDestinatarios[$i]['id_destino_maestro'].";";
                }else if($dataDestinatarios[$i]['nombre_tipoenvio_maestro'] == 'CC'){
                    $strCC.= $dataDestinatarios[$i]['destinatario'].";";
                     $strIdCC.= $dataDestinatarios[$i]['id_destino_maestro'].";";
                }else if($dataDestinatarios[$i]['nombre_tipoenvio_maestro'] == 'CCO'){
                    $strCCO.= $dataDestinatarios[$i]['destinatario'].";";
                    $strIdCCO.= $dataDestinatarios[$i]['id_destino_maestro'].";";
                }
            }
        }else{
            $dataDestinatarios= $destinatarios->selectAllDestinatariosExternoByIdCorresp($_REQUEST['id']);
            $strPR= "";
            $strCC= "";
            $strCCO= "";
            $strIdPR= "";
            $strIdCC= "";
            $strIdCCO= "";
            for($i= 0; $i < count($dataDestinatarios); $i++){
                if($dataDestinatarios[$i]['nombre_tipoenvio_maestro'] == 'PR'){
                    $strPR.= $dataDestinatarios[$i]['nombre_destinatario'].";";
                    $strIdPR.= $dataDestinatarios[$i]['id_destino_maestro'].";";
                }else if($dataDestinatarios[$i]['nombre_tipoenvio_maestro'] == 'CC'){
                    $strCC.= $dataDestinatarios[$i]['nombre_destinatario'].";";
                     $strIdCC.= $dataDestinatarios[$i]['id_destino_maestro'].";";
                }else if($dataDestinatarios[$i]['nombre_tipoenvio_maestro'] == 'CCO'){
                    $strCCO.= $dataDestinatarios[$i]['nombre_destinatario'].";";
                    $strIdCCO.= $dataDestinatarios[$i]['id_destino_maestro'].";";
                }
            }
        }
        $adjunto= new adjuntarControlador();
        $dataAdjunto= $adjunto->selectAdjuntoByIdCorresp($_REQUEST['id']);
    }else if($_REQUEST['plantilla'] != ""){
        $correspPrueba= new clCorrespondenciaModelo();
        $dataPrueba= $correspPrueba->selectAllCorrespondenciaById($_REQUEST['plantilla']);
    }
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
        <link rel='StyleSheet' href='../comunes/js/dtree.css' type='text/css' />
        <script type='text/javascript' src='../comunes/js/dtree.js'></script>
        <script type='text/javascript' src='../comunes/js/funciones.js'></script>
        <script type="text/javascript" src="../comunes/js/prototype.js"></script>
        <script type="text/javascript" src="../comunes/js/effects.js"></script>
        <script type="text/javascript" src="../comunes/js/scriptaculous.js"></script>
        <script type="text/javascript" src="../comunes/js/tabcontent.js"></script>
        <style>
            body {padding:0px;margin:0px;text-align:left;font:11px verdana, arial, helvetica, serif; background-color:#FFFFFF;}
        </style>
        <script language="javascript">
            function cargar(acc, tipoCorres, tipoDoc, estatus){
                if(acc){
                    xajax_llenarSelectTipoCorres('frmredactar', tipoCorres);
                    xajax_llenarSelectTipoDoc(tipoCorres, tipoDoc);
                    setSelectInput(document.frmredactar.id_estatus_maestro,estatus);
                }else{
                    xajax_llenarSelectTipoCorres('frmredactar');
                }
            }
            function verDestinatariosToolTip(formInput, tipo){
                var cadena= "";
                var valor= formInput.value;
                var dest= valor.split(';');
                cadena+= "<table class='tablaTitulo'>";
                if(tipo == 'para'){
                    cadena+= "<tr><td align='left'><font color='blue'><b>Para:</b></font></td></tr>";
                }else if(tipo == 'cc'){
                    cadena+= "<tr><td align='left'><font color='blue'><b>CC:</b></font></td></tr>";
                }else if(tipo == 'cco'){
                    cadena+= "<tr><td align='left'><font color='blue'><b>CCO:</b></font></td></tr>";
                }
                for(i= 0; i < dest.length-1; i++){
                    cadena+= "<tr><td><li>"+dest[i]+"</li></td></tr>";
                }
                cadena+= "</table>";
                return cadena;
            }
            function verDestinatarios(id, tipoCorrespondencia){
                div = $('capa'+id);
                if(id == "para"){
                    if($('capacc').style.display != 'none'){
                        $('capacc').innerHTML='';
                        $('capacc').toggle();
                    }
                    if($('capacco').style.display != 'none'){
                        $('capacco').innerHTML='';
                        $('capacco').toggle();
                    }
                }else if(id == "cc"){
                    if($('capapara').style.display != 'none'){
                        $('capapara').innerHTML='';
                        $('capapara').toggle();
                    }
                    if($('capacco').style.display != 'none'){
                        $('capacco').innerHTML='';
                        $('capacco').toggle();
                    }
                }else if(id == "cco"){
                    if($('capapara').style.display != 'none'){
                        $('capapara').innerHTML='';
                        $('capapara').toggle();
                    }
                    if($('capacc').style.display != 'none'){
                        $('capacc').innerHTML='';
                        $('capacc').toggle();
                    }
                }
                div.toggle();
                //if(div.innerHTML==''){
                    div.update('<div align="center"><img src="../comunes/images/ajax-loader.gif"></div>');
                    xajax_verDestinatarios(id, tipoCorrespondencia);
                //}
                
            }
            function cargarAsuntos(acc){
                if(acc != "RESP"){
                    var destinatarios = $('para').value;
                    if(destinatarios.empty()){
                        Tip('Debe Seleccionar al menos un destinatario',TITLE, 'Asuntos sugeridos', DELAY, 0, SHADOW, true, STICKY, true, CLOSEBTN, true, CLICKCLOSE, true);
                        return false;
                    }
                }
                if($F('id_tipocorresp_maestro') != '88'){
                    Tip('Solo para el documento \"Memorando\"',TITLE, 'Asuntos sugeridos', DELAY, 0, SHADOW, true, STICKY, true, CLOSEBTN, true, CLICKCLOSE, false);
                    return false;
                }
                Tip('<img src="../comunes/images/loader4.gif">',TITLE, 'Asuntos sugeridos', DELAY, 0, SHADOW, true, STICKY, true, CLOSEBTN, true, CLICKCLOSE, true);
                xajax_verAsuntosPredeterminados($('paraId').value);
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
                if(acc != "RESP"){
                    if (!validaSelect(document.frmredactar.id_tipo_maestro,'Tipo de Correspondencia'))return false;
                    if (!validaSelect(document.frmredactar.id_tipocorresp_maestro,'Tipo de Documento'))return false;
                    if (!campoRequerido(document.frmredactar.para,"Para")) return false;
                }
                if (!campoRequerido(document.frmredactar.strasunto,"Asunto")) return false;
                if (!campoAsunto(document.frmredactar.strasunto,"Asunto")) return false;
                if (!validaLongitud(document.frmredactar.strasunto, "Asunto", 150)) return false;
                if (!validarEditor('cuerpo', 'Cuerpo')) return false;
                document.frmredactar.strcuerpo.value= FCKeditorAPI.__Instances['cuerpo'].GetHTML();
                if(acc == "RESP"){
                    xajax_updateDestinatariosEstatus(document.frmredactar.idDestinatario.value, 217);
                }
                if(acc == "ACT"){
                    xajax_updateCorrespondencia(xajax.getFormValues('frmredactar'));
                }else{
                    xajax_insertCorrespondencia(xajax.getFormValues('frmredactar'));
                }
            }
            function guardar(acc){
                if(acc != "ACT"){
                    $('id_estatus_maestro').value= 194;
                }
                validar(acc);
            }
            function guardarEnviar(acc){
                $('id_estatus_maestro').value= 199;
                validar(acc);
            }
            function cargaPlantilla(idDoc){
                if(idDoc == 89){
                    var html= "<div style='text-align: center;'><b>Instrucciones</b></div> <hr /> <ul>     ";
                    html+= "<li>Para su informaci&oacute;n y fines consiguientes</li>     <li>Tramitar</li>     <li>Opinar</li>     <li>Archivar</li>     ";
                    html+= "<li>Investigar Y Analizar</li>     <li>Contestar</li>     <li>Revisar</li>     <li>Notificar</li>     <li>Coordinar con:</li>     ";
                    html+= "<li>Recomendaciones</li> </ul> <br /> <ul>     <li>Otros:</li> </ul> <br /> <hr /> <div style='text-align: center;'>";
                    html+= "<b>Preparar</b></div> <hr /> <ul>     <li>Informe</li>     <li>Cuenta Para:     <ul>         <li>Presidente</li>         ";
                    html+= "<li>Gerente General</li>         <li>Otro:</li> <br />     </ul></li> </ul> <hr /> <div style='text-align: left;'>&nbsp;";
                    html+= "<b>Indicaciones / Observaciones:</b></div> <hr /> <div style='text-align: left;'><br /> <br /> <br /> <br /> <br /> <br /> ";
                    html+= "&nbsp;</div>";
                }
                FCKeditorAPI.__Instances['cuerpo'].SetHTML(html);
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
    <body onload="javascript:cargar('<?= $_REQUEST['acc'] ?>', '<?= $_REQUEST['tipoC'] ?>', '<?= $_REQUEST['tipoD'] ?>', '<?= $_REQUEST['estatus'] ?>');">
        <form name="frmredactar" id="frmredactar" method="post">
            <input type="hidden" name="id_corresp" id="id_corresp" value="<?= $_REQUEST['id'] ?>">
            <input type="hidden" name="paraId" id="paraId" value="<?= $strIdPR ?>">
            <input type="hidden" name="ccId" id="ccId" value="<?= $strIdCC ?>">
            <input type="hidden" name="ccoId" id="ccoId" value="<?= $strIdCCO ?>">
            <input type="hidden" name="id_unidad_maestro" id="id_unidad_maestro" value="<?= ($_SESSION['id_coord_maestro'] != 0) ? $_SESSION['id_coord_maestro'] : $_SESSION['id_dpto_maestro'] ?>">
            <input type="hidden" name="id_contacto" id="id_contacto" value="<?= $_SESSION['id_contacto'] ?>">
            <input type="hidden" name="strcuerpo" id="strcuerpo" value="">
            <input type="hidden" name="id_estatus_maestro" id="id_estatus_maestro" value="<?= $_REQUEST['estatus'] ?>">
            <?php if($_REQUEST['acc'] == "RESP"){ ?>
                <input type="hidden" name="idDestinatario" id="idDestinatario" value="<?= $_REQUEST['respIdDest'] ?>">
            <?php } ?>
            <input type="hidden" id="adjunto" name="adjunto" value="<?php if (isset($dataAdjunto)) echo $dataAdjunto;?>">
            <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
            <div id="asuntos" style="display:none"></div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="65%" class="menu_izq_titulo">Redactar
                        <div id="capaResp">
                            <?php
                                if($_REQUEST['acc'] == "RESP"){
                                    echo "Respuesta a: ".$_REQUEST['respTipoD']." ".$_REQUEST['correlativo'];
                                }
                            ?>
                        </div>
                    </td>
                    <td width="20%" align="center" class="menu_izq_titulo">
                        <img src="../comunes/images/16_save.png" onmouseover="Tip('Guardar')" onmouseout="UnTip()" border="0" onclick="guardar('<?= $_REQUEST['acc'] ?>');"/>
                        &nbsp;&nbsp;&nbsp;
                        <img src="../comunes/images/save_go.png" onmouseover="Tip('Enviar')" onmouseout="UnTip()" border="0" onclick="guardarEnviar('<?= $_REQUEST['acc'] ?>');"/>
                        &nbsp;&nbsp;&nbsp;
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
                                    <td width="30%">Tipo de Correspondencia: </td>
                                    <td width="60%">
                                        <?php if($_REQUEST['acc'] != "RESP"){ ?>
                                            <div id="capaTipo">
                                                <select id="id_tipo_maestro" name="id_tipo_maestro" style='width:90%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        <?php }else{ ?>
                                            <input type="hidden" id="id_tipo_maestro" name="id_tipo_maestro" value="<?= $_REQUEST['respIdC'] ?>">
                                            <b><?= $_REQUEST['respTipoC'] ?></b>
                                        <?php } ?>
                                    </td>
                                    <td width="5%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="5%">&nbsp;</td>
                                    <td width="30%">Tipo de Documento: </td>
                                    <td width="60%">
                                        <?php if($_REQUEST['acc'] != "RESP"){ ?>
                                            <div id="capaDoc">
                                                <select id="id_tipocorresp_maestro" name="id_tipocorresp_maestro" style='width:90%'>
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        <?php }else{ ?>
                                            <input type="hidden" id="id_tipocorresp_maestro" name="id_tipocorresp_maestro" value="<?= $_REQUEST['respIdD'] ?>">
                                            <b><?= $_REQUEST['respTipoD'] ?></b>
                                        <?php } ?>
                                    </td>
                                    <td width="5%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="5%">&nbsp;</td>
                                    <td width="30%">Para: </td>
                                    <td width="60%">
                                        <?php if($_REQUEST['acc'] != "RESP"){ ?>
                                            <input type="text" id="para" name="para" size="40" value="<?= $strPR ?>" onmouseover="Tip(verDestinatariosToolTip(document.frmredactar.para, 'para'))" onmouseout='UnTip()' readonly>
                                            <img src='../comunes/images/ver.gif' onmouseover="Tip('Ver Destinatarios')" onmouseout='UnTip()' onclick="verDestinatarios('para', document.frmredactar.id_tipo_maestro.value);">
                                            <div id="capapara" style="border:inset 1px black; width:470px; margin-top:3px; overflow:auto; height:150px; display:none;"></div>
                                        <?php
                                              }else{
                                                 echo "<script>$('paraId').value='".$_REQUEST['respParaId'].";'</script>";
                                        ?>
                                            <b><?= $_REQUEST['respPara'] ?></b>
                                        <?php } ?>
                                    </td>
                                    <td width="5%">&nbsp;</td>
                                </tr>
                                <?php if($_REQUEST['acc'] != "RESP"){ ?>
                                <tr>
                                    <td width="5%">&nbsp;</td>
                                    <td width="30%">CC: </td>
                                    <td width="60%">
                                        <input type="text" id="cc"  name="cc" size="40" value="<?= $strCC ?>" onmouseover="Tip(verDestinatariosToolTip(document.frmredactar.cc, 'cc'))" onmouseout='UnTip()' readonly>
                                        <img src='../comunes/images/ver.gif' onmouseover="Tip('Ver Destinatarios')" onmouseout='UnTip()' onclick="verDestinatarios('cc', document.frmredactar.id_tipo_maestro.value);">
                                        <div id="capacc" style="border:inset 1px black; width:360px; margin-top:3px; overflow:auto; height:100px; display:none;"></div>
                                    </td>
                                    <td width="5%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="5%">&nbsp;</td>
                                    <td width="30%">CCO: </td>
                                    <td width="60%">
                                        <input type="text" id="cco" name="cco" size="40" value="<?= $strCCO ?>" onmouseover="Tip(verDestinatariosToolTip(document.frmredactar.cco, 'cco'))" onmouseout='UnTip()' readonly>
                                        <img src='../comunes/images/ver.gif' onmouseover="Tip('Ver Destinatarios')" onmouseout='UnTip()' onclick="verDestinatarios('cco', document.frmredactar.id_tipo_maestro.value);">
                                        <div id="capacco" style="border:inset 1px black; width:360px; margin-top:3px; overflow:auto; height:100px; display:none;"></div>
                                    </td>
                                    <td width="5%">&nbsp;</td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td width="5%">&nbsp;</td>
                                    <td width="30%">Asunto: </td>
                                    <td width="60%">
                                        <textarea id="strasunto" name="strasunto" cols="45" rows="2"><?= $dataPrueba[0]['strasunto'] ?></textarea>
                                        <img src='../comunes/images/comment_add.png'  onclick="cargarAsuntos('<?= $_REQUEST['acc'] ?>');">
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
                                            if($_REQUEST['acc'] == 'ACT'){
                                                $oFCKeditor->Value = stripslashes($dataPrueba[0]['strcuerpo']);
                                            }else if($_REQUEST['plantilla'] != ""){
                                                $oFCKeditor->Value = stripslashes($dataPrueba[0]['strcuerpo']);
                                            }
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
