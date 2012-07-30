<?php
    session_start();
    require_once '../modelo/clProActuaciones.php';
    require_once '../modelo/clProAsociaciones.php';    
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clActuacionFases.php';    
    require_once '../modelo/clActuacionesModelo.php';
    require_once '../modelo/clActuacionSituaciones.php';
    require_once '../modelo/ctblprohonorariosModelo.php';
    require_once '../modelo/clProClientes.php';
    require_once '../modelo/clProContrarios.php';    
    require_once '../modelo/clProAbogados.php';
    require_once '../comunes/php/utilidades.php';
    require_once '../modelo/clConstantesModelo.php';
    require_once '../modelo/clFunciones.php';
    require_once '../herramientas/herramientas.class.php';  
    require_once '../modelo/clPermisoModelo.php';

    verificarSession();
    
    function llenarSelectFormularioTipoEstadoMinuta($select="") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['estados_minuta'], 2);
        $html= "<select id='id_estado_minuta' name='id_estado_minuta' style='width:50%' onchange=\"xajax_llenarSelectComboItemTipoActuacion(document.frminscribir.id_tipo_actuacion.value);\">";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdEstadoMinuta","innerHTML",$html);
        return $respuesta;
    }     
    
    function selectSituacionDetalle($id_expediente,$id_expediente_actuacion){
        if (($id_expediente!=='') and ($id_expediente_actuacion!=''))
        {
            $respuesta= new xajaxResponse();
            $clientes= new clTblproactuaciones();
            $data= "";
            $data= $clientes->selectDetalleActuacionExpediente($id_expediente,$id_expediente_actuacion);
            if($data){
            $respuesta->script('xajax_llenarSelectFormularioTipoActuacion("'.$data[0]['id_tipo_actuacion'].'")');
            $respuesta->script('xajax_llenarSelectFormularioTipoEstadoMinuta("'.$data[0]['activo'].'")');            
            $respuesta->script('xajax_llenarSelectComboItemTipoActuacion('.$data[0]['id_tipo_actuacion'].',' . $data[0]['id_actuacion'] . ')');
            $respuesta->script('xajax_llenarSelectNombreItemTipoActuacion('.$data[0]['id_tipo_actuacion'].',' . $data[0]['id_actuacion'] . ',' . $data[0]['id_escrito'] . ')');           
            $respuesta->assign("actu_strobservacion", "value", $data[0]['strobservacion']);
            $respuesta->assign("strexpedientetribunal", "value", $data[0]['strexpedientetribunal']);           
            $respuesta->assign("actu_fecha", "value", $data[0]['fecactuacion']);           
            $respuesta->assign("id_proexpediente_actuaciones", "value", $data[0]['id_proexpediente_actuaciones']);
            $respuesta->script("FCKeditorAPI.__Instances['descripcionact'].SetHTML('".$data[0]['strdescripcionactuacion']."')");           

            }
            return $respuesta;
        }
    }    
    
    
    function selectAllExpedientesFiltroAgenda($pagina,$cedula_cliente="",$cedula_abogado_responsable="",$cedula_abogado_ejecutor="",$strexpediente="") {
        $respuesta= new xajaxResponse();
        $clientes= new clActuaciones();
        $data= "";
        $html= ""; 
        $dataC= $clientes->SelectAllExpedientesFiltroAgenda($pagina,$cedula_cliente,$cedula_abogado_responsable,$cedula_abogado_ejecutor,$strexpediente);
        $data= $dataC[0];          
        if($data){
             $asistido=new clProClientes();
             $abogado=new clProAbogados();
             
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_maestro')\">Expediente</a>
                                </th>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Cédula Asistido</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre Asistido</a>
                                </th>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Cédula Abogado Responsable</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre Abogado Responsable</a>
                                </th>
                                
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Cédula Abogado Ejecutor</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre Abogado Ejecutor</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Agenda</a>
                                </th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $data_asistido=$asistido->buscarAsistido($data[$i]['id_solicitante']);
                if($data_asistido){
                    $nombre_asistido=$data_asistido[0]['strnombre']." ".$data_asistido[0]['strapellido'];
                }
                $data_abogado_responsable= $abogado->buscarAbogado($data[$i]['id_abogado_resp'],'responsable');
                if($data_abogado_responsable){
                    $nombre_abogado_responsable=$data_abogado_responsable[0]['strnombre']." ".$data_abogado_responsable[0]['strapellido'];
                }
             $data_abogado_ejecutor= $abogado->buscarAbogado($data[$i]['id_abogado_ejecutor'],'ejecutor');
             
             if($data_abogado_ejecutor){
                    $nombre_abogado_ejecutor=$data_abogado_ejecutor[0]['strnombre']." ".$data_abogado_ejecutor[0]['strapellido'];
                }
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td align='left'>".$data[$i]['strnroexpediente']."</td>
                            <td align='center' >".$data[$i]['cedula_cliente']."</td>
                            <td align='center' >".$nombre_asistido."</td>
                            <td align='center' >".$data[$i]['cedula_abogado_responsable']."</td>
                            <td align='center' >".$nombre_abogado_responsable."</td>
                            <td align='center' >".$data[$i]['cedula_abogado_ejecutor']."</td>
                            <td align='center' >".$nombre_abogado_ejecutor."</td>
                            <td align='right'>";

                $color=functions::diterenciaFechasSemaforo($data[$i]['fechacompara']);
                if ($color=='R')
                {
                    $html.="<a>
                                    <img src='../comunes/images/rojo.gif' height='17px' onmouseover=\"Tip('Agenda Pendiente Vencidas')\" onmouseout='UnTip()' onclick=\"location.href='vista_Ingresotblactuaciones.php?id=".$data[$i]['id_proexpediente']."'\">
                                </a>";
                }
                elseif ($color=='A')
                {        
                    $html.="<a>
                                    <img src='../comunes/images/amarillo.gif' height='17px'  onmouseover=\"Tip('Agenda Pendiente por Vencer')\" onmouseout='UnTip()' onclick=\"location.href='vista_Ingresotblactuaciones.php?id=".$data[$i]['id_proexpediente']."'\">
                                </a>";                
                }
                elseif ($color=='V')
                {
                    $html.="<a>
                                    <img src='../comunes/images/verde.gif' height='17px'  onmouseover=\"Tip('Agenda Pendiente')\" onmouseout='UnTip()' onclick=\"location.href='vista_Ingresotblactuaciones.php?id=".$data[$i]['id_proexpediente']."'\">
                                </a>";                   
                }
                
                $html.="        <a>
                                    <img src='../comunes/images/Open.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"location.href='vista_Ingresotblactuaciones.php?id=".$data[$i]['id_proexpediente']."'\">
                                </a>";
                                if ($data[$i][feccierre]!='')
                                   $html.= "
                                    <img src='../comunes/images/folder_locked.png' onmouseover='Tip(\"Caso Cerrado\")' onmouseout='UnTip()' \">";
                                   $html.= "
                            </td>
                        </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Expedientes Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        $respuesta->assign("pag","innerHTML",$dataC[1]);               
        return $respuesta;
    
    }    

    
    
    function buscarDatosExpedientesAgenda($pagina){
        $valor=0;
        $respuesta= new xajaxResponse();
        $clientes= new clActuaciones();
        $data= "";
        $html= ""; 
        $dataC= $clientes->SelectAllAgenda($pagina);
        $data= $dataC[0];        
        if($data){
            $asistido=new clProClientes();
            $abogado=new clProAbogados();
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_maestro')\">Expediente</a>
                                </th>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Cédula Asistido</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre Asistido</a>
                                </th>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Cédula Abogado Responsable</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre Abogado Responsable</a>
                                </th>
                                
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Cédula Abogado Ejecutor</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre Abogado Ejecutor</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Agenda</a>
                                </th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $data_asistido=$asistido->buscarAsistido($data[$i]['id_solicitante']);
                if($data_asistido){
                    $nombre_asistido=$data_asistido[0]['strnombre']." ".$data_asistido[0]['strapellido'];
                }
                $data_abogado_responsable= $abogado->buscarAbogado($data[$i]['id_abogado_resp'],'responsable');
                if($data_abogado_responsable){
                    $nombre_abogado_responsable=$data_abogado_responsable[0]['strnombre']." ".$data_abogado_responsable[0]['strapellido'];
                }
             $data_abogado_ejecutor= $abogado->buscarAbogado($data[$i]['id_abogado_ejecutor'],'ejecutor');
             
             if($data_abogado_ejecutor){
                    $nombre_abogado_ejecutor=$data_abogado_ejecutor[0]['strnombre']." ".$data_abogado_ejecutor[0]['strapellido'];
                }
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td align='left'>".$data[$i]['strnroexpediente']."</td>
                            <td align='center' >".$data[$i]['cedula_cliente']."</td>
                            <td align='center' >".$nombre_asistido."</td>
                            <td align='center' >".$data[$i]['cedula_abogado_responsable']."</td>
                            <td align='center' >".$nombre_abogado_responsable."</td>
                            <td align='center' >".$data[$i]['cedula_abogado_ejecutor']."</td>
                            <td align='center' >".$nombre_abogado_ejecutor."</td>
                            <td align='right'>";
                                $color=functions::diterenciaFechasSemaforo($data[$i]['fechacompara']);
                                if ($data[$i][id_estado_minuta]>0)
                                {
                                    if ($color=='R')
                                        $html.="<a><img src='../comunes/images/rojo.gif' height='17px' onmouseover=\"Tip('Agenda Pendiente Vencidas')\" onmouseout='UnTip()' onclick=\"location.href='vista_Ingresotblactuaciones.php?id=".$data[$i]['id_proexpediente']."'\"></a>";
                                    elseif ($color=='A')

                                        $html.="<a><img src='../comunes/images/amarillo.gif' height='17px'  onmouseover=\"Tip('Agenda Pendiente por Vencer')\" onmouseout='UnTip()' onclick=\"location.href='vista_Ingresotblactuaciones.php?id=".$data[$i]['id_proexpediente']."'\"></a>";                
                                    elseif ($color=='V')
                                        $html.="<a><img src='../comunes/images/verde.gif' height='17px'  onmouseover=\"Tip('Agenda Pendiente')\" onmouseout='UnTip()' onclick=\"location.href='vista_Ingresotblactuaciones.php?id=".$data[$i]['id_proexpediente']."'\"></a>";                   
                                }
                                $html.="
                                </td>
                            </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Expedientes Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        $respuesta->assign("pag","innerHTML",$dataC[1]);        
        return $respuesta;
    }    
    
    

    function AgendaExpediente($id_contacto){
        $respuesta= new xajaxResponse();
        $contrarios= new clProContrarios();
        $data= "";
        $html= "";         
        $data=$contrarios->selectAllContrariosFiltro($nombre,$apellido,$cedula);
        if($data){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE CONYUGUE</strong>
                                    </div>                                
                                </td>
                            </tr>                               
                                <tr>
                                    <th width='10%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Id</a>
                                    </th>                                
                                    <th width='21%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Cédula</a>
                                    </th>
                                    <th width='22%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Nombre</a>
                                    </th>
                                    <th width='22%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Apellido</a>
                                    </th>                                    
                                    <th width='5%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Acción</a>
                                    </th>                                         
                                </tr>";
                for ($i= 0; $i < count($data); $i++){

                    $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                <td align='center'>".$i."</td>
                                <td align='center'>".$data[$i]['strcedula']."</td>
                                <td align='center'>".$data[$i]['strnombre']."</td>
                                <td align='center'>".$data[$i]['strapellido']."</td>                                    
                                <td align='center'>
                                        <a>
                                            <img src='../comunes/images/s_success.png' onmouseover='Tip(\"Elegir Abogado\")' onmouseout='UnTip()' onclick=\"xajax_buscarConyugue('".$data[$i]['id_contrarios']."','ejecutor')\">
                                        </a>                                   
                                </td>
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="";
            }
//        $respuesta->script("$('contenedorConyugue').show();");            
        $respuesta->assign("contenedorConyugue","innerHTML",$html);
        return $respuesta;
    }    
    
    
    function llenarSelectFormularioGavetaArchivadorExp($select="") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['gaveta_archivador'], 2);
        $html= "<select id='id_tipo_archivador_gaveta' name='id_tipo_archivador_gaveta' style='width:50%'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdTipoArchivadorGaveta","innerHTML",$html);
        return $respuesta;
    }       

    function llenarSelectFormularioPisoArchivadorExp($select="") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['piso_archivador'], 2);
        $html= "<select id='id_tipo_piso_archivador' name='id_tipo_piso_archivador' style='width:50%'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdTipoPisoArchivador","innerHTML",$html);
        return $respuesta;
    }        
    
    function llenarSelectFormularioTipoArchivadorExp($select="") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_archivador'], 2);
        $html= "<select id='id_tipo_archivador' name='id_tipo_archivador' style='width:50%'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdTipoArchivador","innerHTML",$html);
        return $respuesta;
    }    
    
    function llenarSelectFormularioTipoEstadoFisicoExp($select="") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['estado_fisico_expediente'], 2);
        $html= "<select id='id_estado_fisico_expediente' name='id_estado_fisico_expediente' style='width:50%'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdTipoFisicoExpediente","innerHTML",$html);
        return $respuesta;
    }
    
    
    function llenarSelectFormularioTipoEspacio($select="") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['espacios'], 2);
        $html= "<select id='id_tipo_espacio' name='id_tipo_espacio' style='width:50%'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdTipoEspacio","innerHTML",$html);
        return $respuesta;
    }
    
    
function selectAllActuaciones($id_expediente){
    $respuesta= new xajaxResponse();
    $actuaciones= new clTblproactuaciones();
    $datos= "";
    $html= ""; 
    $datos= $actuaciones->selectAllActuacionesExpediente($id_expediente);
    if($datos){
    $html.= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE ACTUACIONES DEL EXPEDIENTE</strong>
                                    </div>                                
                                </td>
                            </tr>                            
                            <tr>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('strrif')\">Tipo Actuación</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('strnombre_asociacion')\">Item Actuación</a>
                                </th>
                                <th width='35%'>
                                    <a href='#' onclick=\"xajax_orden('strnombre_asociacion')\">Nombre</a>
                                </th>                                
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('strdireccion_asociacion')\">Fecha</a>
                                </th>
                                <th width='10%'>Acci&oacute;n</th>
                            </tr>";
            for ($i= 0; $i < count($datos); $i++)
            {
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                    <td align='center'>".$datos[$i][tipo]."</td>
                                    <td align='center' >".$datos[$i][actuacion]."</td>
                                    <td align='center'>".$datos[$i][strnombreactuacion]."</td>                                        
                                    <td align='center' >".$datos[$i][fecactuacion]."</td>
                                    <td align='center'>
                                        <a>
                                            <img src='../comunes/images/script_go.png' onmouseover=\"Tip('Ver Texto de la Actuación')\" onmouseout='UnTip()' onclick=\"location.href='./reporteAsociacionVista.php?id=".$datos[$i][id_proexpediente_actuaciones]."'\">
                                        </a>";
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('actuaciones'),'editar', clConstantesModelo::acciones_actuaciones())){
                                $html.="<a>
                                           <img src='../comunes/images/script_attach.png' onmouseover=\"Tip('Editar Actuación')\" onmouseout='UnTip()' onclick=\"xajax_selectSituacionDetalle('".$datos[$i][id_proexpediente_actuaciones]."','".$datos[$i][id_proexpediente]."');\">
                                        </a>";
                            }
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('actuaciones'),'eliminar', clConstantesModelo::acciones_actuaciones())){
                                $html.="<a>
                                            <img src='../comunes/images/script_delete.png' onmouseover='Tip(\"Eliminar Asociacion\")' onmouseout='UnTip()'  onclick=\"if(confirm('¿Desea Eliminar Esta Actuación?')){ xajax_eliminarActuacion('".$datos[$i][id_proexpediente_actuaciones]."','".$datos[$i][id_proexpediente]."');alert('Datos Eliminados Correctamente');location.href='./vista_listaAsociaciones.php'}\">
                                        </a>";
                            }
                             $html.="</td>
                                </tr>
                                <tr>
                                <td colspan=\"7\"><div id='div_".$datos['lngcodigo_asociacion']."' style='display:none;background:#dfdfdf'></div></td>
                                </tr>";
            }
        }else{
            $html="<div class='celda_etiqueta'>No Hay Actuaciones Registradas</div>";
        }        
    $html.= "</table>";
    // Imprimimos la barra de navegación
    $respuesta->script("$('contenedorActuaciones').show();");    
    $respuesta->assign("contenedorActuaciones","innerHTML",$html);
    return $respuesta;
}
    

    function validar_actuacion($request){
        $respuesta = new xajaxResponse();
        
        if( $request['id_proexpediente_actuaciones'] !=""){
            $respuesta->script("xajax_editar_fase(xajax.getFormValues('frminscribir'),'".$request['id_proexpediente_actuaciones']."')");
        }else{
            $campos_validar= array(
            'Tipo de Actuación'    => 'id_tipo_actuacion',
            'Actuación'    => 'id_actuacion_hijo',
            'Modelo Actuación'  => 'id_nombre_actuacion',
            'Observacion'  => 'actu_strobservacion',
            'Fecha de la Actuación'    => 'actu_fecha',
            'Descripción de la Actuación' => 'strdescripcionactuacion', 
            );
            $validacion=  functions::validarFormulario('frminscribir',$request,$campos_validar);
            if($validacion){
                $respuesta->alert($validacion['msg']);
                $respuesta->script($validacion['focus']);
            }else{
                $respuesta->script("xajax_guardar_actuacion(xajax.getFormValues('frminscribir'))");
            }
        }
        return $respuesta;
    }    

    function guardar_actuacion($request){
        $respuesta= new xajaxResponse();
	$actuaciones= new clTblproactuaciones();
        $actuaciones->llenar($request);
        if ($actuaciones->insertarActuacionExpediente($request['id_tipo_actuacion'],$request['id_actuacion_hijo'],$request['id_nombre_actuacion'],$request['actu_strobservacion'],$request['id_proexpediente'],$request['actu_fecha'],$request['strdescripcionactuacion'],$request['strexpedientetribunal']))
        {
            $respuesta->alert("La Actuación del Expediente se inserto exitosamente");
            $respuesta->assign("id_proexpediente_actuaciones", "value", "");
            $respuesta->script('xajax_llenarSelectFormularioTipoActuacion("frminscribir")');
            $respuesta->assign("id_actuacion", "value", "0");
            $respuesta->assign("id_nombre_actuacion", "value", "0");            
            $respuesta->assign("actu_strobservacion", "value", "");
            $respuesta->assign("strexpedientetribunal", "value", "");            
            $respuesta->assign("strdescripcionactuacion", "value", "");            
            $respuesta->script("FCKeditorAPI.__Instances['descripcionact'].SetHTML('')");        
            $respuesta->assign("actu_fecha", "value", "");              
            $respuesta->script("xajax_selectAllActuaciones('".$request['id_proexpediente']."')");            
        }else{
            $respuesta->alert("La Actuación en el Expediente no se ha guardado");
        }
        return $respuesta;
    }    


   function selectActuacionHijo($id_proactuaciones){
        $respuesta= new xajaxResponse();
	$actuaciones= new clTblproactuaciones();
        $data= "";
        $data= $actuaciones->selectDetalleActuacion($id_proactuaciones);
        if($data){
	   $respuesta->script("FCKeditorAPI.__Instances['descripcionact'].SetHTML('".$data[0]['strdescripcionactuacion']."')");
        }
        return $respuesta;
    }
    
    function llenarSelectNombreItemTipoActuacion($id_maestro,$id_detalle,$select=0) {
        $respuesta= new xajaxResponse();
        $data= "";
        $html= "";
	$actuaciones= new clTblproactuaciones();
        $data= $actuaciones->selectAllActuacionesHijos($id_maestro,$id_detalle);
        $html= "<select id='id_nombre_actuacion' name='id_nombre_actuacion' style='width:50%' onchange=\"xajax_selectActuacionHijo(document.frminscribir.id_nombre_actuacion.value);\">";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_proactuaciones']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_proactuaciones']."' ".$seleccionar.">".$data[$i]['strnombreactuacion']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdItemNombreActuacion","innerHTML",$html);
        return $respuesta;
    }      

    function llenarSelectComboItemTipoActuacion($id_maestro,$select=0) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos($id_maestro, 2);
        $html= "<select id='id_actuacion_hijo' name='id_actuacion_hijo' style='width:50%' onchange=\"xajax_llenarSelectNombreItemTipoActuacion(document.frminscribir.id_tipo_actuacion.value,document.frminscribir.id_actuacion_hijo.value);\">";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdItemActuacion","innerHTML",$html);
        return $respuesta;
    }      

    function llenarSelectFormularioTipoActuacion($select="") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['actuaciones'], 2);
        $html= "<select id='id_tipo_actuacion' name='id_tipo_actuacion' style='width:50%' onchange=\"xajax_llenarSelectComboItemTipoActuacion(document.frminscribir.id_tipo_actuacion.value);\">";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdTipoActuacion","innerHTML",$html);
        return $respuesta;
    } 



    function eliminar_fase($id_expediente="",$id_fase=""){
        $respuesta = new xajaxResponse();
        $fase = new clProActuacionFases();
            $data = $fase->Delete($id_fase);
             if($data){
                $respuesta->alert("La Fase del Expediente se ha Eliminado");
                $respuesta->script("xajax_buscarFases('".$id_expediente."')");
            }else{
                $respuesta->alert("La Fase del Expediente no se ha Eliminado");
            }
        return $respuesta;
    }    

   function selectFase($id_expediente,$id_expediente_fase){
        $respuesta= new xajaxResponse();
        $fase= new clProActuacionFases();
        $data= "";
        $data= $fase->SelectAll($id_expediente,$id_expediente_fase);
        if($data){
           $respuesta->script('xajax_llenarSelectTipoFase("frminscribir","'.$data[0]['id_tipo_fase'].'")');
           $respuesta->script('xajax_llenarSelectFaseHijo('.$data[0]['id_tipo_fase'].',' . $data[0]['id_fase'] . ')');
           $respuesta->assign("strobservacionfase", "value", $data[0]['strobservacion']);
           $respuesta->assign("id_proexpediente_fase", "value", $data[0]['id_proactuacion_fase']);
           $respuesta->assign("fecfase", "value", $data[0]['fecfase']);           
           
        }
        return $respuesta;
    }
    
    
    function editar_fase($request,$id_expediente_fase=""){
        $respuesta= new xajaxResponse();
        $fase= new clProActuacionFases();
        $fase->llenar($request);
        $data= $fase->Update($id_expediente_fase);
        if($data){
            $respuesta->alert("La Fase del Expediente se actualizo exitosamente");
            $respuesta->assign("id_proexpediente_fase", "value", "");
            $respuesta->script('xajax_llenarSelectTipoFase("frminscribir")');
            $respuesta->assign("id_fase", "value", "0");
            $respuesta->assign("strobservacionfase", "value", "");
            $respuesta->assign("fecfase", "value", "");   
            $respuesta->script("xajax_buscarFases('".$request['id_proexpediente']."')");            
        }else{
            $respuesta->alert("La Fase del Expediente no se ha actualizado");
        }
        return $respuesta;
    }
    
    
    function guardar_fase($request){
        $respuesta= new xajaxResponse();
        $fase= new clProActuacionFases();
        
        $fase->llenar($request);
        $data= $fase->insertar();
        if($data){
            $respuesta->alert("La Fase del Expediente se inserto exitosamente");
            $respuesta->assign("id_proexpediente_fase", "value", "");
            $respuesta->script('xajax_llenarSelectTipoFase("frminscribir")');
            $respuesta->assign("id_fase", "value", "0");
            $respuesta->assign("strobservacionfase", "value", "");
            $respuesta->assign("fecfase", "value", "");              
            $respuesta->script("xajax_buscarFases('".$request['id_proexpediente']."')");            
        }else{
            $respuesta->alert("La Fase no se ha guardado");
        }
        return $respuesta;
    }    
    
    function validar_fase($request){
        $respuesta = new xajaxResponse();
        
        if( $request['id_proexpediente_fase'] !=""){
            $respuesta->script("xajax_editar_fase(xajax.getFormValues('frminscribir'),'".$request['id_proexpediente_fase']."')");
        }else{
            $campos_validar= array(
            'Tipo de Fase'    => 'id_tipo_fase',
            'Fase'    => 'id_fase',
            'Observacion'  => 'strobservacionfase',
            'Fecha de la Fase'    => 'fecfase',
            );
            $validacion=  functions::validarFormulario('frminscribir',$request,$campos_validar);
            if($validacion){
                $respuesta->alert($validacion['msg']);
                $respuesta->script($validacion['focus']);
            }else{
                $respuesta->script("xajax_guardar_fase(xajax.getFormValues('frminscribir'))");
            }
        }
        return $respuesta;
    }    

    
    function buscarFases($id_expediente){
        $respuesta= new xajaxResponse();
        $expediente= new clActuaciones();
        $data= "";
        $html= "";         
        $data=$expediente->selectFases($id_expediente);
        $fecie=$expediente->getExpedFecie($id_expediente);        
        if($data){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE FASES DEL EXPEDIENTE</strong>
                                    </div>                                
                                </td>
                            </tr>                               
                                <tr>
                                    <th width='10%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Id</a>
                                    </th>                                
                                    <th width='21%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Tipo de Fase</a>
                                    </th>
                                    <th width='22%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Fase</a>
                                    </th>
                                    <th width='22%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Fecha</a>
                                    </th>                                    
                                    <th width='5%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Acción</a>
                                    </th>                                         
                                </tr>";
                for ($i= 0; $i < count($data); $i++){

                    $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                <td align='center'>".$i."</td>
                                <td align='center'>".$data[$i]['tipo_fase']."</td>
                                <td align='center'>".$data[$i]['fase']."</td>
                                <td align='center'>".$data[$i]['fecfase']."</td> 
                                <td>";
                                if ($fecie=='')
                                    if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('expedientes'),'editar', clConstantesModelo::acciones_expedientes())){
                                    $html.="
                                    <a>
                                        <img src='../comunes/images/table_edit.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"xajax_selectFase('".$data[$i]['id_proactuacion']."','".$data[$i]['id_proactuacion_fase']."')\">
                                    </a>";
                                    }
                                    if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('expedientes'),'eliminar', clConstantesModelo::acciones_expedientes())){
                                    $html.="<a>
                                        <img src='../comunes/images/table_delete.png' onmouseover='Tip(\"Eliminar\")' onmouseout='UnTip()' onclick=\"xajax_eliminar_fase('".$data[$i]['id_proactuacion']."','".$data[$i]['id_proactuacion_fase']."')\">
                                    </a>";
                                    }
                                $html.="
                                </td>                                    
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="";
            }
        $respuesta->script("$('contenedorFases').show();");                  
        $respuesta->assign("contenedorFases","innerHTML",$html);
        return $respuesta;
    }
        
            

    function llenarSelectTipoFase($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['fase'], 'stritema');
        $html= "<select id='id_tipo_fase' name='id_tipo_fase' style='width:".$ancho."' onchange=\"xajax_llenarSelectFaseHijo(document.".$formInput.".id_tipo_fase.value)\">";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdFase","innerHTML",$html);
        return $respuesta;
    }
    
    function llenarSelectFaseHijo($valor, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";;
        $data= $maestro->selectAllMaestroHijos($valor, 'stritema');
        $html= "<select id='id_fase' name='id_fase' style='width:".$ancho."' >";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdFaseSituacion","innerHTML",$html);
        return $respuesta;
    }
        
    
    
    function selectVista_abogados_casos_cargados_total() {
        $respuesta= new xajaxResponse();
        $expediente= new clActuaciones();
        $data= "";
        $html= ""; 
        $total=0;
        $data= $expediente->selectVista_abogados_casos_cargados_total();
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_maestro')\">Casos</a>
                                </th>
                                <th width='75%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Nombre Abogado</a>
                                </th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $total=$total+$data[$i]['contador'];
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td align='center'>".$data[$i]['contador']."</td>
                            <td align='center' >".$data[$i]['strnombre']."</td>
                        </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Expedientes Registrados</div>";
        }
        $respuesta->assign("contenedor_casos_total","innerHTML",$html);        
        $respuesta->assign("total", "value", $total);        
        return $respuesta;
    
    }
    
    function selectVista_abogados_casos_cargados() {
        $respuesta= new xajaxResponse();
        $expediente= new clActuaciones();
        $data= "";
        $html= ""; 
        $data= $expediente->selectVista_abogados_casos_cargados();
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_maestro')\">Casos</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Nombre Abogado</a>
                                </th>
                                <th width='45%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Tramite</a>
                                </th>                                
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td align='center'>".$data[$i]['contador']."</td>
                            <td align='center' >".$data[$i]['strnombre']."</td>
                            <td align='center' >".$data[$i]['tramite']."</td>                                
                        </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Expedientes Registrados</div>";
        }
        $respuesta->assign("contenedor_casos_detallados","innerHTML",$html);
        return $respuesta;
    
    }
  
        
    function llenarSelectTipoCita($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
//        exit('paso');
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['citacion'], 'stritema'); 
        $html= "<select id='id_citacion' name='id_citacion' style='width:".$ancho."'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdCitacion","innerHTML",$html);
        return $respuesta;
    }      
    
    function buscarConyugue($id){
        $respuesta=new xajaxResponse();
//        $respuesta->alert($cedula);
        $contrarios= new clProContrarios();        
        $data=$contrarios->buscarContrario($id);
        if(is_array($data)){
            $respuesta->assign("strnombre_conyugue", "value", $data[0][strnombre]. " " . $data[0][strapellido]);
            $respuesta->assign("cedula_conyugue", "value", $data[0][strcedula]);            
            $respuesta->assign("id_contrarios", "value", $data[0][id_contrarios]);                
            $respuesta->script("$('contenedorConyugue').hide();");                     
        }
        else  $respuesta->alert("El Conyugue no Existe");   
        return $respuesta;
    }
    
    function buscarConyuguePopup($nombre,$apellido,$cedula){
        $respuesta= new xajaxResponse();
        $contrarios= new clProContrarios();
        $data= "";
        $html= "";         
        $data=$contrarios->selectAllContrariosFiltro($nombre,$apellido,$cedula);
        if($data){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE CONYUGUE</strong>
                                    </div>                                
                                </td>
                            </tr>                               
                                <tr>
                                    <th width='10%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Id</a>
                                    </th>                                
                                    <th width='21%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Cédula</a>
                                    </th>
                                    <th width='22%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Nombre</a>
                                    </th>
                                    <th width='22%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Apellido</a>
                                    </th>                                    
                                    <th width='5%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Acción</a>
                                    </th>                                         
                                </tr>";
                for ($i= 0; $i < count($data); $i++){

                    $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                <td align='center'>".$i."</td>
                                <td align='center'>".$data[$i]['strcedula']."</td>
                                <td align='center'>".$data[$i]['strnombre']."</td>
                                <td align='center'>".$data[$i]['strapellido']."</td>                                    
                                <td align='center'>
                                        <a>
                                            <img src='../comunes/images/s_success.png' onmouseover='Tip(\"Elegir Abogado\")' onmouseout='UnTip()' onclick=\"xajax_buscarConyugue('".$data[$i]['id_contrarios']."','ejecutor')\">
                                        </a>                                   
                                </td>
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="";
            }
//        $respuesta->script("$('contenedorConyugue').show();");            
        $respuesta->assign("contenedorConyugue","innerHTML",$html);
        return $respuesta;
    }
        
        
    
    
    
    function verRegimenCerrado($id){
        $respuesta=new xajaxResponse(); 
        if ($id)
        {
            $cod=clConstantesModelo::regimen_cerrado;
            if($id==$cod){
                $respuesta->script("$('regimen_cabecera').show();");
                $respuesta->script("$('regimen_input').show();");
            }
            else {
                     $respuesta->script("$('regimen_cabecera').hide();");
                $respuesta->script("$('regimen_input').hide();");
     
 }
        }
        return $respuesta;
    }
        

        function llenarSelectTipoRegimen($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['regimen'], 'stritema'); 
        $html= "<select id='id_regimen' name='id_regimen' style='width:".$ancho."' onchange=\"xajax_verRegimenCerrado(document.".$formInput.".id_regimen.value)\">";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdRegimen","innerHTML",$html);
        return $respuesta;
    }    
    
    
    
    
    function llenarSelectTipoDivorcio($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['referencias_divorcio'], 'stritema');
        $html= "<select id='id_refer' name='id_refer' style='width:".$ancho."'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdReferencia","innerHTML",$html);
        return $respuesta;
    }    
    
    
    function buscarAsistidoPopup($nombre,$apellido,$cedula){
        $respuesta= new xajaxResponse();
        $clientes=new clProClientes();
        $data= "";
        $html= "";         
        $data=$clientes->SelectAllClientesFiltro($nombre,$apellido,$cedula);
        if($data){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE ASISTIDOS</strong>
                                    </div>                                
                                </td>
                            </tr>                               
                                <tr>
                                    <th width='10%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Id</a>
                                    </th>                                
                                    <th width='21%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Cédula</a>
                                    </th>
                                    <th width='22%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Nombre</a>
                                    </th>
                                    <th width='22%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Apellido</a>
                                    </th>                                    
                                    <th width='5%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Acción</a>
                                    </th>                                         
                                </tr>";
                for ($i= 0; $i < count($data); $i++){

                    $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                <td align='center'>".$i."</td>
                                <td align='center'>".$data[$i]['strcedula']."</td>
                                <td align='center'>".$data[$i]['strnombre']."</td>
                                <td align='center'>".$data[$i]['strapellido']."</td>                                    
                                <td align='center'>
                                        <a>
                                            <img src='../comunes/images/s_success.png' onmouseover='Tip(\"Elegir Abogado\")' onmouseout='UnTip()' onclick=\"xajax_buscarAsistido('".$data[$i]['id_cliente']."','ejecutor')\">
                                        </a>                                   
                                </td>
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="";
            }
//        $respuesta->script("$('contenedorAsistidos').show();");            
        $respuesta->assign("contenedorAsistidos","innerHTML",$html);
        return $respuesta;
    }
        
    
    function buscarAbogadosPopup($nombre,$apellido,$cedula){
        $respuesta= new xajaxResponse();
        $abogados=new clProAbogados();
        $data= "";
        $html= "";         
        $data=$abogados->SelectAllAbogadosFiltro($nombre,$apellido,$cedula);
        if($data){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE ABOGADOS</strong>
                                    </div>                                
                                </td>
                            </tr>                               
                                <tr>
                                    <th width='10%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Id</a>
                                    </th>                                
                                    <th width='21%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Cédula</a>
                                    </th>
                                    <th width='22%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Nombre</a>
                                    </th>
                                    <th width='22%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Apellido</a>
                                    </th>                                    
                                    <th width='5%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Acción</a>
                                    </th>                                         
                                </tr>";
                for ($i= 0; $i < count($data); $i++){

                    $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                <td align='center'>".$i."</td>
                                <td align='center'>".$data[$i]['strcedula']."</td>
                                <td align='center'>".$data[$i]['strnombre']."</td>
                                <td align='center'>".$data[$i]['strapellido']."</td>                                    
                                <td align='center'>
                                        <a>
                                            <img src='../comunes/images/s_success.png' onmouseover='Tip(\"Elegir Abogado\")' onmouseout='UnTip()' onclick=\"xajax_buscarAbogado('".$data[$i]['id_abogado']."','ejecutor')\">
                                        </a>                                   
                                </td>
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="";
            }
//        $respuesta->script("$('contenedorAbogados').show();");            
        $respuesta->assign("contenedorAbogados","innerHTML",$html);
        return $respuesta;
    }
    
    function verCountExpediente($id){
        $respuesta=new xajaxResponse();        
        if ($id)
        {
            $expediente= new clActuaciones();
            $data= "";        
            $data2= "";         
            $data=$expediente->selectCountExpedientesAbiertos($id);
            $data2=$expediente->selectCountExpedientesCerrados($id);        
            if(is_array($data)){
                $respuesta->assign("intcasosabiertos", "value", $data[0][count]);
            }
            if(is_array($data2)){
                $respuesta->assign("intcasoscerrados", "value", $data2[0][count]);
            }                
        }
        else $respuesta="";
        return $respuesta;
    }
            
    
    function verCosto($id){
        $respuesta=new xajaxResponse(); 
        $unidad= new cltblprohonorariosModelo();
        $functions= new functions();    
        if ($id)
        {
            $data=  explode('-', $id);
            $datos=  $unidad->selectHonorarioPrecio($data[0]);   
            $numuni=$datos[0][numunidad];
            $precio=$functions->toFloat($datos[0][intprecio]);
            $monto=($numuni*$precio);
            $respuesta->assign("id_precio_con","value",clFunciones::FormatoMonto($monto)." BSF");     
            $respuesta->assign("id_honorario","value",$data[0]);                 
        }
        else $respuesta->alert("Honorario No tiene Costo Contable");
           return $respuesta;
    }
        
    
    function buscarDatosExpedientes($pagina){
        $respuesta= new xajaxResponse();
        $clientes= new clActuaciones();
        $data= "";
        $html= ""; 
        $dataC= $clientes->SelectAll($pagina);
        $data= $dataC[0];        
        if($data){
            $asistido=new clProClientes();
            $abogado=new clProAbogados();
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_maestro')\">Expediente</a>
                                </th>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Cédula Asistido</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre Asistido</a>
                                </th>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Cédula Abogado Responsable</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre Abogado Responsable</a>
                                </th>
                                
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Cédula Abogado Ejecutor</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre Abogado Ejecutor</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Acción</a>
                                </th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $data_asistido=$asistido->buscarAsistido($data[$i]['id_solicitante']);
                if($data_asistido){
                    $nombre_asistido=$data_asistido[0]['strnombre']." ".$data_asistido[0]['strapellido'];
                }
                $data_abogado_responsable= $abogado->buscarAbogado($data[$i][id_abogado_resp],"responsabkle");
                if($data_abogado_responsable){
                    $nombre_abogado_responsable=$data_abogado_responsable[0]['strnombre']." ".$data_abogado_responsable[0]['strapellido'];
                }
             $data_abogado_ejecutor= $abogado->buscarAbogado($data[$i][id_abogado_ejecutor],"ejecutor");
             
             if($data_abogado_ejecutor){
                    $nombre_abogado_ejecutor=$data_abogado_ejecutor[0]['strnombre']." ".$data_abogado_ejecutor[0]['strapellido'];
                }
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td align='left'>".$data[$i]['strnroexpediente']."</td>
                            <td align='center' >".$data[$i]['cedula_cliente']."</td>
                            <td align='center' >".$nombre_asistido."</td>
                            <td align='center' >".$data[$i]['cedula_abogado_responsable']."</td>
                            <td align='center' >".$nombre_abogado_responsable."</td>
                            <td align='center' >".$data[$i]['cedula_abogado_ejecutor']."</td>
                            <td align='center' >".$nombre_abogado_ejecutor."</td>
                            <td align='right'>
                                <a>
                                    <img src='../comunes/images/b_pdfdoc.png' onmouseover=\"Tip('Detalles Expediente')\" onmouseout='UnTip()' onclick=\"location.href='reporte_expediente_1.php?id=".$data[$i]['id_proactuacion']."'\">
                                </a>";
                                if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('expedientes'),'editar', clConstantesModelo::acciones_expedientes())){
                                $html.="<a>
                                    <img src='../comunes/images/Open.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"location.href='vista_Ingresotblactuaciones.php?id=".$data[$i]['id_proactuacion']."'\">
                                </a>";
                                }
                                if ($data[$i][feccierre]!='')
                                   $html.= "
                                    <img src='../comunes/images/folder_locked.png' onmouseover='Tip(\"Caso Cerrado\")' onmouseout='UnTip()' \">";
                               else
                                   if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('expedientes'),'eliminar', clConstantesModelo::acciones_expedientes())){
                                   $html.= "
                                    <a>
                                        <img src='../comunes/images/bd_empty.png' onmouseover='Tip(\"Eliminar\")' onmouseout='UnTip()' onclick=\"eliminar_expediente('".$data[$i]['id_proactuacion']."')\">
                                    </a>";
                                   }
                            $html.="</td>
                        </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Expedientes Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        $respuesta->assign("pag","innerHTML",$dataC[1]);        
        return $respuesta;
    }
    
    function selectAllExpedientesFiltro($pagina,$cedula_cliente="",$cedula_abogado_responsable="",$cedula_abogado_ejecutor="",$strexpediente="") {
        $respuesta= new xajaxResponse();
        $clientes= new clActuaciones();
        $data= "";
        $html= ""; 
        $dataC= $clientes->SelectAllExpedientesFiltro($pagina,$cedula_cliente,$cedula_abogado_responsable,$cedula_abogado_ejecutor,$strexpediente);
        $data= $dataC[0];          
        if($data){
             $asistido=new clProClientes();
             
             
             $abogado=new clProAbogados();
             
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_maestro')\">Expediente</a>
                                </th>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Cédula Asistido</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre Asistido</a>
                                </th>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Cédula Abogado Responsable</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre Abogado Responsable</a>
                                </th>
                                
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Cédula Abogado Ejecutor</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre Abogado Ejecutor</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Acción</a>
                                </th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $data_asistido=$asistido->buscarAsistido($data[$i]['id_solicitante']);
                if($data_asistido){
                    $nombre_asistido=$data_asistido[0]['strnombre']." ".$data_asistido[0]['strapellido'];
                }
                $data_abogado_responsable= $abogado->buscarAbogado($data[$i][id_abogado_resp],"responsable");
                if($data_abogado_responsable){
                    $nombre_abogado_responsable=$data_abogado_responsable[0]['strnombre']." ".$data_abogado_responsable[0]['strapellido'];
                }
             $data_abogado_ejecutor= $abogado->buscarAbogado($data[$i][id_abogado_ejecutor],"ejecutor");
             
             if($data_abogado_ejecutor){
                    $nombre_abogado_ejecutor=$data_abogado_ejecutor[0]['strnombre']." ".$data_abogado_ejecutor[0]['strapellido'];
                }
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td align='left'>".$data[$i]['strnroexpediente']."</td>
                            <td align='center' >".$data[$i]['cedula_cliente']."</td>
                            <td align='center' >".$nombre_asistido."</td>
                            <td align='center' >".$data[$i]['cedula_abogado_responsable']."</td>
                            <td align='center' >".$nombre_abogado_responsable."</td>
                            <td align='center' >".$data[$i]['cedula_abogado_ejecutor']."</td>
                            <td align='center' >".$nombre_abogado_ejecutor."</td>
                            <td align='right'>
                                <a>
                                    <img src='../comunes/images/b_pdfdoc.png' onmouseover=\"Tip('Detalles Expediente')\" onmouseout='UnTip()' onclick=\"location.href='reporte_expediente.php?id=".$data[$i]['id_proexpediente']."'\">
                                </a>";
                                if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('expedientes'),'editar', clConstantesModelo::acciones_expedientes())){
                                $html.="<a>
                                    <img src='../comunes/images/Open.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"location.href='vista_Ingresotblactuaciones.php?id=".$data[$i]['id_proexpediente']."'\">
                                </a>";
                                }
                                if ($data[$i][feccierre]!='')
                                   $html.= "
                                    <img src='../comunes/images/folder_locked.png' onmouseover='Tip(\"Caso Cerrado\")' onmouseout='UnTip()' \">";
                               else
                                   if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('expedientes'),'eliminar', clConstantesModelo::acciones_expedientes())){
                                   $html.= "
                                    <a>
                                        <img src='../comunes/images/bd_empty.png' onmouseover='Tip(\"Eliminar\")' onmouseout='UnTip()' onclick=\"eliminar_expediente('".$data[$i]['id_proexpediente']."')\">
                                    </a>";
                                   }
                            $html.="</td>
                        </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Expedientes Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        $respuesta->assign("pag","innerHTML",$dataC[1]);               
        return $respuesta;
    
    }
    
   
    
   function llenarSelectTipoTramite($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $honorarios= new cltblprohonorariosModelo();
        $data= "";
        $html= "";
        $data= $honorarios->selectAllHonorariosCargados();
        $html= "<select id='id_tipo_tramite' name='id_tipo_tramite' style='width:".$ancho."' onchange=\"xajax_llenarSelectTipoAtencion('frminscribir','',document.".$formInput.".id_tipo_tramite.value,'');xajax_mostrarPestanaDivorcio(document.".$formInput.".id_tipo_tramite.value);xajax_verDocumentos(document.".$formInput.".id_tipo_tramite.value,0);\">";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_tipo']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_tipo']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
       
        $respuesta->assign("capaIdTipoTramite","innerHTML",$html);
        return $respuesta;
    } 
//            $respuesta->script('xajax_llenarSelectTipoAtencion("frminscribir",' . $data[0]['id_tipo_atencion'] . ')');
       function llenarSelectTipoAtencion($formInput, $select= "", $padre="", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $honorarios= new cltblprohonorariosModelo();
        $data= "";
        $html= "";
        $data= $honorarios->selectAllTramitesCargados($padre);
//        print_r($data);
        $html= "<select id='id_tipo_atencion' name='id_tipo_atencion' style='width:".$ancho."' onchange=\"xajax_verCosto(document.".$formInput.".id_tipo_atencion.value)\">";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_tramite']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_honorarios']."-".$data[$i]['id_unidad']."-".$data[$i]['id_tramite']."' ".$seleccionar.">".$data[$i]['stritema']." Año ".$data[$i]['ano']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdTipoAtencion","innerHTML",$html);
        return $respuesta;
    }
    
    function llenarSelectActuacion($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['actuacion'], 'stritema');
        $html= "<select id='id_actuacion_persona' name='id_actuacion_persona' style='width:".$ancho."'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdActuacion","innerHTML",$html);
        return $respuesta;
    }
    
     function llenarSelectTipoOrganismo($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_organismo'], 'stritema');
        $html= "<select id='id_tipo_organismo' name='id_tipo_organismo' style='width:".$ancho."' onchange=\"xajax_llenarSelectOrganismo(document.".$formInput.".id_tipo_organismo.value)\">";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdTipoOrganismo","innerHTML",$html);
        return $respuesta;
    }
    
     function llenarSelectOrganismo($valor, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";;
        $data= $maestro->selectAllMaestroHijos($valor, 'stritema');
        $html= "<select id='id_organismo' name='id_organismo' style='width:".$ancho."' >";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdOrganismo","innerHTML",$html);
        return $respuesta;
    }
    
    function llenarSelectTipoMinuta($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_minuta'], 'stritema');
        $html= "<select id='id_tipo_minuta' name='id_tipo_minuta' style='width:".$ancho."' onchange=\"xajax_llenarSelectMinuta(document.".$formInput.".id_tipo_minuta.value)\">";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdTipoMinuta","innerHTML",$html);
        return $respuesta;
    }
    
    function llenarSelectMinuta($valor, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";;
        $data= $maestro->selectAllMaestroHijos($valor, 'stritema');
        $html= "<select id='id_minuta' name='id_minuta' style='width:".$ancho."' >";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdMinuta","innerHTML",$html);
        return $respuesta;
    }
    
    function mostrarPestanaDivorcio($pestana){
         $respuesta= new xajaxResponse();
         $tipo_tramite=  clConstantesModelo::tipo_tramite();
         if($pestana == $tipo_tramite['divorcio']){
             $respuesta->assign("link7","style.display","inline");
         }else{
              $respuesta->assign("link7","style.display","none");
         }
         return $respuesta;
    }
        
    
 
   
    
    
    
    function guardar_expediente($request){
        //exit("Voy");
        $respuesta= new xajaxResponse();
        $expediente= new clActuaciones();
        $expediente->llenar($request);
        $nexval = (int) $expediente->nextValExpediente();
        $data= $expediente->insertar($nexval);
        if($data){
            $situacion= new clProActuacionSituaciones();
            $id=$nexval+1;
            $data= $situacion->abrirSituacion($id,$expediente->get_fecapertura(),1);            
            $respuesta->alert("El Expediente se guardo exitosamente");
            $respuesta->script('xajax_selectExpediente('.$id.')');              
            
        }else{
            $respuesta->alert("El Expediente no se ha guardado");
        }
        return $respuesta;
    }
    
    function llenarNroExpediente(){
        $respuesta= new xajaxResponse();
         $respuesta->assign('strnroexpediente', 'value', 'OAS-' . date('dmY') . '-##');
         return $respuesta;
    }
    
    function validar_expediente($request){
        $respuesta = new xajaxResponse();
        $campos_validar= array(
            'Tipo de Tramite'    => 'id_tipo_tramite',
            'Tipo de atencion'  => 'id_tipo_atencion',
            'Fecha de Expediente'    => 'fecexpediente',
            'Fecha Apertura' => 'fecapertura',
        );
        $validacion=  functions::validarFormulario('frminscribir',$request,$campos_validar);
        if($validacion){
            $respuesta->alert($validacion['msg']);
            $respuesta->script($validacion['focus']);
        }else{
            $respuesta->script("xajax_guardar_expediente(xajax.getFormValues('frminscribir'))");
        }
        
        return $respuesta;
    }
    
    function buscarAsistido($id){
        $respuesta=new xajaxResponse();
        $asistido=new clProClientes();
        $data=$asistido->buscarAsistido($id);
        if(is_array($data)){
            $respuesta->assign("strnombre_cliente", "value", $data[0]['strnombre']. " " . $data[0]['strapellido']);
            $respuesta->assign("id_solicitante", "value", $data[0]['id_cliente']);            
            $respuesta->assign("cedula_cliente", "value", $data[0]['strcedula']);                    
            $raz_social=clTblasociaciones::getNombreAsociacion_vista_cliente($data[0]['id_cliente']);
            if ($raz_social!='')   $respuesta->assign('raz_social', 'value', $raz_social);
            $respuesta->script("$('contenedorAsistidos').hide();");            
        }
        else  $respuesta->alert("El Asistido no Existe");   
        return $respuesta;
    }
    
    function buscarAbogado($id,$abogado){
        $respuesta=new xajaxResponse();
        $asistido=new clProAbogados();
        $data=$asistido->buscarAbogado($id);
        if(is_array($data)){
            if($abogado=="responsable"){
                $respuesta->assign("strnombre_abogado_responsable", "value", $data[0]['strnombre']. " " . $data[0]['strapellido']);
                $respuesta->assign("cedula_abogado_responsable", "value", $data[0]['strcedula']);
                $respuesta->assign("id_abogado_resp", "value", $data[0]['id_abogado']);                
                
            }else if ($abogado=="ejecutor"){
                $respuesta->assign("strnombre_abogado_ejecutor", "value", $data[0]['strnombre']. " " . $data[0]['strapellido']);
                $respuesta->assign("cedula_abogado_ejecutor", "value", $data[0]['strcedula']);         
                $respuesta->assign("id_abogado_ejecutor", "value", $data[0]['id_abogado']);                
            }
            $respuesta->script("$('contenedorAbogados').hide();");            
        }
        else
        {
            if($abogado=="responsable"){
                $respuesta->assign("strnombre_abogado_responsable", "value", "");
                $respuesta->alert("El Abogado responsable no Existe");                
            }else if ($abogado=="ejecutor"){
                $respuesta->assign("strnombre_abogado_ejecutor", "value", "");
                $respuesta->alert("El Abogado ejecutor no Existe");                       
            }
        }
        return $respuesta;
    }
    
    function selectExpediente($lngcodigo) {
    $respuesta = new xajaxResponse();
    $expediente = new clActuaciones();
    $honorarios = new cltblprohonorariosModelo();
    $functions= new functions();      
    $data = "";
    $data = $expediente->SelectExpediente($lngcodigo);
    if ($data) {
        $respuesta->assign('id_proexpediente', 'value', $data[0]['id_proactuacion']);
        $respuesta->assign('strnroexpediente', 'value', $data[0]['strnroexpediente']);
        $respuesta->assign('id_abogado_resp', 'value', $data[0]['id_abogado_resp']);
        $respuesta->assign('id_abogado_ejecutor', 'value', $data[0]['id_abogado_ejecutor']);        
        $respuesta->assign('id_cliente', 'value', $data[0]['id_cliente']);
        $respuesta->assign('id_contrarios', 'value', $data[0]['id_contrarios']);        
        
        if ($data[0][strnroexpediente]!='')
        {
            $campos_desactivar= array('id_tipo_tramite','strrefer','fecexpediente','fecapertura','strnroexpediente','feccierre','cedula_cliente','strnombre_cliente');
            $js=  functions::desactivarCampos('frminscribir',$campos_desactivar);
            if($js!=""){
                $respuesta->script($js);
            }
        }
        $respuesta->script('xajax_llenarSelectTipoRegimen("frminscribir",' . $data[0][id_regimen] . ')');
        $respuesta->script('xajax_llenarSelectTipoCita("frminscribir",' . $data[0][id_citacion] . ')');
        $respuesta->script('xajax_verRegimenCerrado(' . $data[0][id_proactuacion] . ')');
        $respuesta->script('xajax_llenarSelectFormularioTipoEspacio(' . $data[0][id_tipo_espacio] . ')'); 
        $respuesta->script('xajax_llenarSelectFormularioTipoEstadoFisicoExp(' . $data[0][id_estado_fisico_expediente] . ')');   
        $respuesta->script('xajax_llenarSelectFormularioTipoArchivadorExp(' . $data[0][id_tipo_archivador] . ')');     
        $respuesta->script('xajax_llenarSelectFormularioPisoArchivadorExp(' . $data[0][id_tipo_piso_archivador] . ')');         
        $respuesta->script('xajax_llenarSelectFormularioGavetaArchivadorExp(' . $data[0][id_tipo_archivador_gaveta] . ')');                 
        $respuesta->script('xajax_selectAllActuaciones(' . $data[0][id_proactuacion] . ')');
        $respuesta->script('xajax_buscarFases('. $data[0][id_proactuacion] .')');
        $respuesta->script('xajax_llenarSelectTipoDivorcio("frminscribir",' . $data[0][id_refer] . ')');        
        $respuesta->script('xajax_llenarSelectTipoTramite("frminscribir",' . $data[0][id_tipo_tramite] . ')');
        $respuesta->script('xajax_llenarSelectTipoAtencion("frminscribir",' . $data[0][id_tipo_atencion] . ',' . $data[0][id_tipo_tramite] . ')');
        $datos_honorarios=$honorarios->selectHonorarioPrecio($data[0][id_honorario]);
             $numuni=$datos_honorarios[0][numunidad];
             $precio=$functions->toFloat($datos_honorarios[0][intprecio]);
             $monto=($numuni*$precio);
        $respuesta->assign("id_precio_con","value",clFunciones::FormatoMonto($monto)." BSF");                    
        $respuesta->script('xajax_llenarSelectActuacion("frminscribir",' . $data[0][id_actuacion] . ')');
        $respuesta->script('xajax_llenarSelectTipoOrganismo("frminscribir",' . $data[0][id_tipo_organismo] . ')');
        $respuesta->script('xajax_llenarSelectOrganismo('.$data[0][id_tipo_organismo].',' . $data[0][id_organismo] . ')');
        $respuesta->script('xajax_llenarSelectTipoMinuta("frminscribir")');
        $respuesta->script('xajax_llenarSelectFormularioTipoEstadoMinuta()');        
        $respuesta->script('xajax_llenarSelectFormularioTipoActuacion()');
        $respuesta->script('xajax_llenarSelectTipoFase("frminscribir")');        
        $respuesta->script('xajax_buscarAbogado(' . $data[0][id_abogado_resp] . ',"responsable")');        
        $respuesta->script('xajax_verCountExpediente(' . $data[0][cedula_cliente] . ')');     
        $respuesta->script('xajax_buscarAsistido(' . $data[0][id_solicitante] . ')');
        $respuesta->script('xajax_buscarConyugue(' . $data[0][id_contrarios] . ')');    
        $respuesta->script('xajax_buscarAbogado(' . $data[0][id_abogado_ejecutor] . ',"ejecutor")');        
        $respuesta->script('xajax_buscarDatosSituaciones(' . $data[0][id_proactuacion] . ')');
        $respuesta->script("xajax_mostrarPestanaDivorcio(".$data[0][id_tipo_tramite].")");
        $respuesta->script("xajax_verDocumentos('".$data[0][id_tipo_tramite]."','".$data[0][strdocumentos]."')");
        $respuesta->assign('fecapertura', 'value', $data[0][fecapertura]);
        $respuesta->assign('feccierre', 'value', $data[0][feccierre]);
        $respuesta->assign('cedula_cliente', 'value', $data[0][cedula_cliente]);
        $respuesta->assign('strrefer', 'value', $data[0][strrefer]);
        $respuesta->assign('fecexpediente', 'value', $data[0][fecexpediente]);
        $respuesta->assign('strdescripcion', 'value', $data[0][strdescripcion]);
        $respuesta->assign('strletrado', 'value', $data[0][strletrado]);        
        $respuesta->assign('cedula_abogado_responsable', 'value', $data[0][cedula_abogado_responsable]);
        $respuesta->assign('cedula_abogado_ejecutor', 'value', $data[0][cedula_abogado_ejecutor]);
        $respuesta->assign('strdireccion_asistido', 'value', $data[0][strdireccion_asistido]);
        $respuesta->assign('strdireccion_conyugue', 'value', $data[0][strdireccion_conyugue]);
        $respuesta->assign('strdireccion_ultimo_domicilio', 'value', $data[0][strdireccion_ultimo_domicilio]);
        $respuesta->assign('fecseparacion', 'value', $data[0][fecseparacion]);
        $respuesta->assign('intmonto_manutencion', 'value', clFunciones::FormatoMonto($data[0][intmonto_manutencion]));
        $respuesta->assign('strdias', 'value', $data[0][strdias]);
        $respuesta->assign('strhoras', 'value', $data[0][strhoras]);        
        $respuesta->assign('strobservacion_cerrar', 'value', $data[0][strobservacion_cerrar]);      
        $respuesta->assign('strnroexpedienteauxiliar', 'value', $data[0][strnroexpedienteauxiliar]);     
        if($data[0][strrepresentante] == 1){
            $respuesta->assign('strrepresentante', 'checked',true);
        }        
//        if ($data[0][strobservacion_cerrar]!='') 
//        {
//            $respuesta->script("$('id_cerrar').show();");
//            $respuesta->script("$('id_observacion_cerrar').show();");
////            $respuesta->script("$('id_observacion_cerrar_button').show();");
//        }
        $respuesta->assign('intcuotames1', 'value', clFunciones::FormatoMonto($data[0][intcuotames1]));
        $respuesta->assign('intcuotames2', 'value', clFunciones::FormatoMonto($data[0][intcuotames2]));                
        $respuesta->script("FCKeditorAPI.__Instances['descripcion'].SetHTML('".$data[0][strdescripcion]."')");
//        $respuesta->script("FCKeditorAPI.__Instances['letrado'].SetHTML('".$data[0][strletrado]."')");        
        $respuesta->script("$('saveSituacion').show();");        
        $respuesta->script("$('saveFase').show();");                
        $respuesta->script("$('saveActuacion').show();");              
        $respuesta->script("$('cerrar').show();");        
        if(($data[0][feccierre] !="") or ($data[0][strobservacion_cerrar]!='')) {
            $respuesta->script("xajax_desactivarCampos()");
            $respuesta->script("$('msg').show();");
            $respuesta->script("$('save').hide();");
            $respuesta->script("$('saveSituacion').hide();"); 
            $respuesta->script("$('saveFase').hide();");          
            $respuesta->script("$('saveActuacion').hide();");            
            $respuesta->script("$('cerrar').hide();");            
            $respuesta->script("$('id_cerrar').show();");
            $respuesta->script("$('id_observacion_cerrar').show();");            
        }
    }
    $respuesta->script("$('load').hide();");            
    return $respuesta;
}

function editar_expediente($request){
//   exit(print_r($request));
        $respuesta= new xajaxResponse();
        $cliente= new clActuaciones();
        $cliente->llenar($request);
        if (($request[feccierre]!='') and  ($request[strobservacion_cerrar]==''))         
            $respuesta->alert("¡Si va cierra el Expediente llene todos los campos!");
        elseif (($request[feccierre]=='') and  ($request[strobservacion_cerrar]!=''))
            $respuesta->alert("¡Si va cierra el Expediente llene todos los campos!");    
        else
        {
            $data= $cliente->Update();
            if($data){
                $respuesta->script('xajax_selectExpediente(' . $request[id_proactuacion] . ')');
                $respuesta->alert("El Expediente se actualizo exitosamente");
            }else{
                $respuesta->alert("El Expediente no se ha actualizado");
            }
        }
        return $respuesta;
    }
    
    
    function verDocumentos($id_menu_maestro, $strdocumentos) {
        //exit($strdocumentos);
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
       // $expediente= new clProExpediente();
        $data= "";
        $html= "";
        if($id_menu_maestro != 0){
            $data= $maestro->selectAllMaestroHijos($id_menu_maestro, 'id_maestro');
            //$dataAcc= $expediente->selectDocumentos($id_expediente);
            $dataAcc= $strdocumentos;
            if($dataAcc){
//                $respuesta->script("document.frmAsignar.id_accesoforma.value= ".$dataAcc[0]['id_accesoforma']);
//                $respuesta->script("document.frmAsignar.accion.value= 'ACT'");
                $straccion= split(",", $dataAcc);
            }else{
//                $respuesta->script("document.frmAsignar.accion.value= 'INS'");
            }
            $html= "<table class='tablaTitulo' bgcolor='#f8f8f8' width='90%'>";
            $html.= "<tr><th width='85%'><label id='laccion'>Documentos</label></th>";
            $html.= "<th width='15%'>Consignado</th></tr>";
            if($data){
                for ($i= 0; $i < count($data); $i++){
                    $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\">";
                    $html.= "<td width='85%'>".$data[$i]['stritema']."</td>";
                    $checked= "";
                    for ($x= 0; $x < (count($straccion)-1); $x++){
                        if($straccion[$x] == $data[$i]['id_maestro']){
                            $checked= "checked";
                        }
                    }
                    $html.= "<td width='15%' align='center'><input type='checkbox' name='doc".$data[$i]['id_maestro']."' id='doc".$data[$i]['id_maestro']."' value='".$data[$i]['id_maestro']."' ".$checked."></td><tr>";
                }
                $html.= "</table>";
            }
        }
        $respuesta->assign("capaDocumentos","innerHTML",$html);
        return $respuesta;
    }
    
    function eliminar_expediente($id_expediente){
        $respuesta = new xajaxResponse();
        $expediente = new clActuaciones();
            $data = $expediente->Delete($id_expediente);
             if($data){
                $respuesta->alert("El expediente se ha Eliminado");
                $respuesta->script("xajax_buscarDatosExpedientes()");
            }else{
                $respuesta->alert("El expediente no se ha Eliminado");
            }
        
        
        return $respuesta;
    }
    
    function cerrarExpediente($id_expediente){
       $respuesta = new xajaxResponse();
       $expediente = new clActuaciones();
            $data = $expediente->cerrarExpediente($id_expediente);
             if($data){
                $situacion= new clProActuacionSituaciones();
                $situacion->abrirSituacion($id_expediente,$expediente->get_fecapertura(),2);                         
                $respuesta->script("xajax_selectExpediente(".$id_expediente.")");
                $respuesta->script("xajax_desactivarCampos()");
                $respuesta->script("$('id_cerrar').show();");
                $respuesta->script("$('id_observacion_cerrar').show();");
                $respuesta->script("$('id_observacion_cerrar_button').show();");                
                $respuesta->alert("El expediente se ha Cerrado");                
            }else{
                $respuesta->alert("El expediente no se ha Cerrado");
            }
       return $respuesta;
    }
    
    function desactivarCampos(){
        $respuesta = new xajaxResponse();
        $campos_desactivar= array(
            'id_tipo_tramite',
            'id_tipo_atencion',
            'strrefer',
            'fecexpediente',
            'fecapertura',
            'strnroexpediente',
            'feccierre',
            'cedula_cliente',
            'strnombre_cliente',
            'cedula_abogado_responsable',
            'strnombre_abogado_responsable',
            'cedula_abogado_ejecutor',
            'strnombre_abogado_ejecutor',
            'intcasosabiertos',
            'intcasospendientes',
            'intcasoscerrados',
            'strdireccion_asistido',
            'strdireccion_conyugue',
            'strdireccion_ultimo_domicilio',
            'fecseparacion',
            'intmonto_manutencion',
            'int_monto_familiar'
            

        );
        $js=  functions::desactivarCampos('frminscribir',$campos_desactivar);
        if($js!=""){
            $respuesta->script($js);
        }
        
        return $respuesta;
    }
    
    function buscarDatosSituaciones($id_expediente=""){
        $respuesta= new xajaxResponse();
        if ($id_expediente!='')
        {
            $clientes= new clProActuacionSituaciones();
            $expediente= new clActuaciones();
            $fecie=$expediente->getExpedFecie($id_expediente);
            $data= "";
            $html= ""; 
            $data= $clientes->SelectAll($id_expediente);
            if($data){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <td colspan=\"6\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE SITUACIONES DEL EXPEDIENTE</strong>
                                    </div>                                
                                </td>
                            </tr>                                  
                                <tr>
                                    <th width='10%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Tipo Minuta</a>
                                    </th>
                                    <th width='20%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Minuta</a>
                                    </th>
                                    <th width='35%'>
                                        <a href='#' onclick=\"xajax_orden('stritema')\">Observacion</a>
                                    </th>
                                    <th width='15%'>
                                        <a href='#' onclick=\"xajax_orden('stritema')\">Estado</a>
                                    </th>                                    
                                    <th width='10%'>
                                        <a href='#' onclick=\"xajax_orden('stritema')\">Fecha</a>
                                    </th>                                
                                    <th width='10%'>
                                        <a href='#' onclick=\"xajax_orden('stritemb')\">Accion</a>
                                    </th>
                                </tr>";
                for ($i= 0; $i < count($data); $i++){

                    $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                <td align='center'>".  clFunciones::mostrarStritema($data[$i]['id_tipo_minuta'])."</td>
                                <td align='center'>".  clFunciones::mostrarStritema($data[$i]['id_minuta'])."</td>
                                <td align='left' >".$data[$i]['strobservacion']."</td>
                                <td align='left' >".  clFunciones::mostrarStritema($data[$i]['id_estado_minuta'])."</td>                                    
                                <td align='center' >".$data[$i]['fecminuta']."</td>                                
                                <td>";
                                $color=functions::diterenciaFechasSemaforo($data[$i]['fecminutacompara']);
                                if ($data[$i][id_estado_minuta]>0)
                                {
                                    if ($color=='R')
                                        $html.="<a><img src='../comunes/images/rojo.gif' height='17px' onmouseover=\"Tip('Agenda Pendiente Vencidas')\" onmouseout='UnTip()' onclick=\"location.href='vista_Ingresotblactuaciones.php?id=".$data[$i]['id_proactuacion']."'\"></a>";
                                    elseif ($color=='A')

                                        $html.="<a><img src='../comunes/images/amarillo.gif' height='17px'  onmouseover=\"Tip('Agenda Pendiente por Vencer')\" onmouseout='UnTip()' onclick=\"location.href='vista_Ingresotblactuaciones.php?id=".$data[$i]['id_proactuacion']."'\"></a>";
                                    elseif ($color=='V')
                                        $html.="<a><img src='../comunes/images/verde.gif' height='17px'  onmouseover=\"Tip('Agenda Pendiente')\" onmouseout='UnTip()' onclick=\"location.href='vista_Ingresotblactuaciones.php?id=".$data[$i]['id_proactuacion']."'\"></a>";
                                    if ($fecie=='')
                                        $html.="
                                        <a><img src='../comunes/images/table_edit.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"xajax_selectSituacion('".$data[$i]['id_proactuacion']."','".$data[$i]['id_proactuacion_situacion']."')\"></a>
                                        <a><img src='../comunes/images/table_delete.png' onmouseover='Tip(\"Eliminar\")' onmouseout='UnTip()' onclick=\"eliminar_situacion('".$data[$i]['id_proactuacion']."','".$data[$i]['id_proactuacion_situacion']."')\"></a>";
                                }
                                $html.="
                                </td>
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="<div class='celda_etiqueta'>No Hay Situaciones Registradas</div>";
            }
        }
        else {
                $html="<div class='celda_etiqueta'>No Hay Situaciones Registradas</div>";     
        }
//        exit($html);
        $respuesta->assign("contenedorSituaciones","innerHTML",$html);
        return $respuesta;
    }
    
    function validar_situacion($request){
        $respuesta = new xajaxResponse();
        
        if( $request['id_proactuacion_situacion'] !=""){
            $respuesta->script("xajax_editar_situacion(xajax.getFormValues('frminscribir'),'".$request['id_proactuacion_situacion']."')");
        }else{
            $campos_validar= array(
            'Tipo Minuta'    => 'id_tipo_minuta',
            'Minuta'    => 'id_minuta',
            'Observacion'  => 'strobservacion',
            'Fecha de Expediente'    => 'fecexpediente',
            'Fecha Apertura' => 'fecapertura',
            'Fecha Minuta' => 'fecminuta',                
            );
            $validacion=  functions::validarFormulario('frminscribir',$request,$campos_validar);
            if($validacion){
                $respuesta->alert($validacion['msg']);
                $respuesta->script($validacion['focus']);
            }else{
                $respuesta->script("xajax_guardar_situacion(xajax.getFormValues('frminscribir'))");
            }
        }
        return $respuesta;
    }
    
    function guardar_situacion($request){
        $respuesta= new xajaxResponse();
        $expediente= new clProActuacionSituaciones();
        $expediente->llenar($request);
        $data= $expediente->insertar();
        if($data){
            $respuesta->script("xajax_buscarDatosSituaciones('".$request['id_proexpediente']."')");
        }else{
            $respuesta->alert("La Situación no se ha guardado");
        }
        return $respuesta;
    }
    
    function eliminar_situacion($id_expediente="",$id_situacion=""){
        $respuesta = new xajaxResponse();
        $expediente = new clProActuacionSituaciones();
            $data = $expediente->Delete($id_situacion);
             if($data){
                $respuesta->alert("La Situacion se ha Eliminado");
                $respuesta->script("xajax_buscarDatosSituaciones('".$id_expediente."')");
            }else{
                $respuesta->alert("El expediente no se ha Eliminado");
            }
        
        
        return $respuesta;
    }
    
    function editar_situacion($request,$id_expediente_situacion=""){
        $respuesta= new xajaxResponse();
        $cliente= new clProActuacionSituaciones();
        $cliente->llenar($request);
        $data= $cliente->Update($id_expediente_situacion);
        if($data){
            $respuesta->alert("El Expediente se actualizo exitosamente");
            $respuesta->script("xajax_buscarDatosSituaciones('".$request['id_proactuacion']."')");
            $respuesta->assign("id_proexpediente_situacion", "value", "");
            $respuesta->script('xajax_llenarSelectTipoMinuta("frminscribir")');
            $respuesta->assign("id_minuta", "value", "0");
            $respuesta->assign("strobservacion", "value", "");
        }else{
            $respuesta->alert("El Expediente no se ha actualizado");
        }
        return $respuesta;
    }
    
    function selectSituacion($id_expediente,$id_expediente_situacion){
         $respuesta= new xajaxResponse();
        $clientes= new clProActuacionSituaciones();
        $data= "";
        $data= $clientes->SelectAll($id_expediente,$id_expediente_situacion);
        if($data){
           $respuesta->script('xajax_llenarSelectTipoMinuta("frminscribir","'.$data[0][id_tipo_minuta].'")');
           $respuesta->script('xajax_llenarSelectFormularioTipoEstadoMinuta('.$data[0][id_estado_minuta].')');           
           $respuesta->script('xajax_llenarSelectMinuta('.$data[0][id_tipo_minuta].',' . $data[0][id_minuta] . ')');
           $respuesta->assign("strobservacion", "value", $data[0][strobservacion]);
           $respuesta->assign("fecminuta", "value", $data[0][fecminuta]);           
           $respuesta->assign("id_proexpediente_situacion", "value", $data[0][id_proactuacion_situacion]);
           
        }
        return $respuesta;
    }
    
?>
