<?php
    session_start();
    require_once "../controlador/tblagendaControlador.php";
    require_once ('../comunes/xajax/xajax_core/xajax.inc.php');

    $xajax= new xajax();
    $xajax->registerFunction('selectActividadMensual'); 
    $xajax->registerFunction('selectSemanaActual');     
    $xajax->registerFunction('IntroAgenda');     
    $xajax->registerFunction('selectAgendaMeses');       

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
        <link href="../comunes/css/style.css.php" rel="stylesheet" type="text/css"/>
<!--        <link href="../comunes/css/CalendarControl.css" rel="stylesheet" type="text/css"/>
        <link href="../comunes/css/TimeControl.css" rel="stylesheet" type="text/css"/>                -->
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
            function onload()
            {
                xajax_selectAgendaMeses(0);         
                xajax_IntroAgenda();
                xajax_selectSemanaActual();
            }             
            function fowar(step)
            {
                var anterior= document.frmAgenda.id_anterior.value;   
                var actual= document.frmAgenda.id_actual.value;                   
                var siguiente= document.frmAgenda.id_siguiente.value;                 
                if (step=='ANY')
                {
                    ante=(-1)*anterior;
                    ante=ante+12;
                    anterior=(-1)*ante;
                    document.frmAgenda.id_anterior.value=anterior;     
                    
                    sigu=(1)*siguiente;
                    siguiente=sigu-12;
                    document.frmAgenda.id_siguiente.value=siguiente;                    
                }
                if (step=='AN')
                {
                    ante=(-1)*anterior;
                    ante=ante+1;
                    anterior=(-1)*ante;
                    document.frmAgenda.id_anterior.value=anterior;     
                    
                    sigu=(1)*siguiente;
                    siguiente=sigu-1;
                    document.frmAgenda.id_siguiente.value=siguiente;                    
                }                
                else if (step=='SI')
                {
                    sigu=(1)*siguiente;
                    siguiente=sigu+1;
                    document.frmAgenda.id_siguiente.value=siguiente; 
                    
                    ante=(-1)*anterior;
                    ante=ante-1;
                    anterior=(-1)*ante;
                    document.frmAgenda.id_anterior.value=anterior;                       
                }
                else if (step=='SIY')
                {
                    sigu=(1)*siguiente;
                    siguiente=sigu+12;
                    document.frmAgenda.id_siguiente.value=siguiente; 
                    
                    ante=(-1)*anterior;
                    ante=ante-12;
                    anterior=(-1)*ante;
                    document.frmAgenda.id_anterior.value=anterior;                       
                }      
                else if (step=='AC')
                {
                    document.frmAgenda.id_siguiente.value=1; 
                    document.frmAgenda.id_anterior.value=-1;                       
                }                 
            }             
        </script>
    </head>
    <body onload="onload();">
        <form name="frmAgenda" id="frmAgenda" method="post" style="">
            <script src="../comunes/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>

                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px; padding-bottom:0px;">
                <tr>
                    <td>
                        <div id="formulario" style=" width:100%;" align="left">
                                <input type="hidden" class='inputbox82' id="id_agenda" name="id_agenda" size="30" />
                                <input type="hidden" class='inputbox82' id="id_anterior" value="-1" name="id_anterior" size="30" />
                                <input type="hidden" class='inputbox82' id="id_actual" value="0" name="id_actual" size="30" />
                                <input type="hidden" class='inputbox82' id="id_siguiente" value="1" name="id_siguiente" size="30" />
                                <table width="100%" border="0" class="tablaVer" >
                                   <tr>
                                        <td width="20%">
                                        </td>
                                        <td width="30%">
                                        
                                        </td>
                                        
                                        <td width="20%">
                                        </td>
                                        <td width="30%">

                                        </td>
                                    </tr>          
 
                                    <tr>
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                <strong>DOMINGO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LUNES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MARTES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MIERCOLES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JUEVES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VIERNES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SABADO</strong>
                                            </div>
                                        </td>
                                    </tr>                                     
                                    <tr>
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <div class="box" id="semana">
                                              <img src="../comunes/images/ajax-loader.gif">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <div align="center" style="background-image: url('../comunes/images/barra.png')">
                                                <strong>AGENDA PERSONAL</strong>
                                            </div>
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <div class="box" id="semana_actividad_texto">
                                              <img src="../comunes/images/ajax-loader.gif">
                                            </div>
                                        </td>                                        
                                    </tr>                                      
                                    <tr>
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <div align="center" >
                    <!--                        <img id="anteriorano" src="../comunes/images/b_firstpage.png"  border="0" onclick="fowar('ANY');xajax_selectAgendaMeses(document.frmAgenda.id_anterior.value);"/>
                                            &nbsp;&nbsp;&nbsp;                                            -->
                                            <img id="anterior" src="../comunes/images/b_prevpage.png"  border="0" onclick="xajax_selectAgendaMeses(document.frmAgenda.id_anterior.value);fowar('AN');"/>
                                            &nbsp;&nbsp;&nbsp;
                                            <img id="actual" src="../comunes/images/b_nextpage.png"  border="0" onclick="xajax_selectAgendaMeses(document.frmAgenda.id_actual.value);fowar('AC');"/>
                                            &nbsp;&nbsp;&nbsp;
                                            <img id="siguiente" src="../comunes/images/b_nextpage.png"  border="0" onclick="xajax_selectAgendaMeses(document.frmAgenda.id_siguiente.value);fowar('SI');"/>
                    <!--                        &nbsp;&nbsp;&nbsp;
                                            <img id="siguienteano" src="../comunes/images/b_lastpage.png"  border="0" onclick="fowar('SIY');xajax_selectAgendaMeses(document.frmAgenda.id_siguiente.value);"/>-->
                                            </div>                    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <div align="left" style="background-image: url('../comunes/images/barra.png')">
                                                <strong>LUNES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MARTES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MIERCOLES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JUEVES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VIERNES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SABADO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DOMINGO</strong>
                                            </div>
                                        </td>
                                    </tr>                                      
                                    <tr>
                                        <td colspan="6" style="border:#CCCCCC solid 1px;" bgcolor="#F8F8F8" >
                                            <div class="box" id="meses">
                                             <img src="../comunes/images/ajax-loader.gif">
                                            </div>
                                        </td>
                                    </tr>                                    
                                </table>            
         <table>                
        </form>
    </body>
</html>