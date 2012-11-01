<?php
    session_start();
    require_once "../controlador/tblagendaControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');
    $xajax= new xajax();
    $xajax->registerFunction('IntroAgenda');    

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
        <link href="../comunes/css/intro.css" rel="stylesheet" type="text/css" />        
        <link href="../comunes/css/enlaces.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/pagination.css" rel="stylesheet" type="text/css" />
        <link href="../comunes/css/calendar-blue2.css" rel="stylesheet" type="text/css" media="all" title="win2k-cold-1" />
        <script src="../comunes/js/funciones.js" type="text/javascript"></script>
        <script src="../comunes/js/prototype.js" type="text/javascript"></script>
        <script src="../comunes/js/effects.js" type="text/javascript"></script>
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
            function actualizar()
            {
                    setTimeout("location.reload(true);",30000);
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
                var id_tipo= document.frmAgenda.id_tipo.value;
                var id_evento= document.frmAgenda.id_evento.value;
                var id_unidad= document.frmAgenda.id_unidad.value;
                var id_prioridad= document.frmAgenda.id_prioridad.value;                
                xajax_selectAllAgenda(id_tipo, id_evento, id_unidad, id_prioridad);                        
                ver('formulario');
            }
        </script>
    </head>
    <body onload="xajax_IntroAgenda();">
        <form name="frmAgenda" id="frmAgenda" method="post" style="">
            <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
            <tr>
                <div id="sample-container">
                    <div id="sample04">
                        <div id="banner">
                            <h1>Buzon de Correo</h1>
                        </div>
                        <div id="nav">
                            <p><img src="../comunes/images/intro/correo.jpg" onmouseover="Tip('Ir a Correo')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='bandejaVista.php'"/>                 </p>
                        </div>
                        <div id="content">
                            <h2>0 Leido</h2>
                            <h2>0 No Leidos</div></h2>
                        </div>
                     </div>
    	         </div>
                
                <div id="sample-container">
                    <div id="sample04">
                        <div id="banner">
                            <h1>Buzon de Agenda</h1>
                        </div>
                        <div id="nav">
                            <p><img src="../comunes/images/intro/agenda.jpg" onmouseover="Tip('Ir Agenda')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='vista_tblagenda.php'"/>                 </p>
                        </div>
                        <div id="content">
                            <h2><div id="numagendaleidos"></div></h2>
                            <h2><div id="numagendanoleidos"></div></h2>
                        </div>
                     </div>
    	         </div>

                <div id="sample-container">
                    <div id="sample04">
                        <div id="banner">
                            <h1>Buzon de Documentos</h1>
                        </div>
                        <div id="nav">
                            <p><img src="../comunes/images/intro/documentos.jpg" onmouseover="Tip('Ir a Documento')" onmouseout="UnTip()" border="0" onclick="javascript:location.href='vista_tblDocumento.php'"/>                 </p>
                        </div>
                        <div id="content">
                            <h2><div id="numdocumentosleidos"></div></h2>
                            <h2><div id="numdocumentosnoleidos"></div></h2>
                        </div>
                  </div>
    	         </div>
           </tr>
         <table>                
        </form>
    </body>
</html>