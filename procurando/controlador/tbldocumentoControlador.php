<?php
    session_start();
    
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clContactoModelo.php';    
    require_once '../modelo/ctbldocumentoModelo.php';
    require_once '../modelo/ctblproexpedienteModelo.php';    
    require_once '../comunes/php/utilidades.php';
    require_once '../modelo/clConstantesModelo.php';
    require_once '../modelo/clFunciones.php';    
    require_once '../herramientas/herramientas.class.php';    

    verificarSession();
    
    function selectReenviarDocumento($id) {
    $respuesta = new xajaxResponse();
    $documento= new clTblDocumento();
    $data = "";
    $documento->updateDocumentoItem($id,0);    
    $data = $documento->selectDocumento($id);
    if ($data) {
//        $respuesta->script("$('fecha').hide();");           
        $respuesta->script('xajax_llenarSelectTipoDocumento(' . $data[0][id_tipo] . ')');
        if ($data[0][id_expediente]>0)
        {
             $respuesta->script('xajax_buscarExpediente(' . $data[0][id_expediente] . ')');
             $respuesta->script("$('CapaExpediente').show();");             
        }
//        if ($data[0][id_contacto]>0)
//        {
//             $respuesta->script('xajax_buscarPersona(' . $data[0][id_contacto] . ')');
//             $respuesta->script("$('CapaTrabajador').show();");             
//        }            
        $respuesta->script('xajax_selectRefiereDocumento()');        
        $respuesta->script('xajax_llenarSelectTipoEvento(' . $data[0][id_evento] . ')');
        $respuesta->script('xajax_llenarSelectTipoPrioridad(' . $data[0][id_prioridad] . ')'); 
        $respuesta->script('xajax_llenarSelectTipoEstadoDocumento(' . $data[0][id_estado] . ')');   
        $respuesta->script('xajax_llenarSelectTipoRecordatorio(' . $data[0][id_recordatorio] . ')');     
        $respuesta->script('xajax_selectAllDpto()');         
        $respuesta->script('xajax_llenarSelectTipoOrganismo(' . $data[0][id_tipo_organismo] . ')');
        $respuesta->script('xajax_llenarSelectOrganismo(' . $data[0][id_tipo_organismo] . ',' . $data[0][id_organismo] . ')');        
        $respuesta->assign('strpersona', 'value', $data[0][strpersona]);        
        $respuesta->assign('fecdocumento', 'value', $data[0][fecdocumento]);
        $respuesta->assign('strtitulo', 'value', functions::decrypt($data[0][strtitulo]));
        $respuesta->assign('id_documento', 'value', '');   
        $respuesta->assign('id_documento_reenviar', 'value', $data[0][id_seguimiento]);
        $respuesta->script("FCKeditorAPI.__Instances['descripcion'].SetHTML('".functions::decrypt($data[0][strdescripcion])."')");
    }
    return $respuesta;
}

    function ActualizarItemDocumentoEnviados($id,$valor,$campo){
        $respuesta=new xajaxResponse(); 
        if ($id)
        {
            $documento= new clTblDocumento();            
            $documento->updateDocumentoItem($id,$valor,$campo); 
            $respuesta->alert("Requerimiento Procesado con Exito");      
            $respuesta->script('xajax_selectAllDocumentoCreados();');
        }
        return $respuesta;
    } 
    
    function ActualizarItemDocumentoRecibidos($id,$valor,$campo){
        $respuesta=new xajaxResponse(); 
        if ($id)
        {
            $documento= new clTblDocumento();            
            $documento->updateDocumentoItem($id,$valor,$campo); 
            $respuesta->alert("Requerimiento Procesado con Exito");      
            $respuesta->script('xajax_selectAllDocumentoRecibidos();');
        }
        return $respuesta;
    }     
    
    function selectAllDocumentoRecibidos($fil_id_tipo=0, $fil_id_evento=0, $fil_id_unidad=0, $fil_id_prioridad=0){
        $respuesta= new xajaxResponse();
        $proDocumento= new clTblDocumento();
        $data= "";
        $html= "";
	if (($fil_id_tipo>0) or ($fil_id_evento>0) or ($fil_id_unidad>0) or ($fil_id_prioridad>0))  {
            $data= $proDocumento->selectFiltrarDocumentoRecibidos($fil_id_tipo, $fil_id_evento, $fil_id_unidad, $fil_id_prioridad);
        }
        else
        {
            $data= $proDocumento->selectAllDocumentoRecibidos();
        }
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_honorarios')\"></a>
                                </th>                               
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_honorarios')\">Documento</a>
                                </th>                            
                                <th width='15%'>
                                    <a href='#' onclick=\"xajax_orden('id_tipo')\">Departamentto</a>
                                </th>                                
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_tipo')\">Evento</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_tipo')\">Titulo</a>
                                </th>                                
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('Tramite')\">Prioridad</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('Unidad')\">Estado</a>
                                </th>                    
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('Unidad')\">Días</a>
                                </th>                                   
                                <th width='35%'>Acci&oacute;n</th>
                            </tr></table>";
            for ($i= 0; $i < count($data); $i++){
                if ($data[$i][visto]==1)
                    $html.= "<table border='0' class='tablaTitulo' width='100%'><tr bgcolor='#fbffd7'onmouseover=\"this.style.background='#ffc05c';this.style.color='blue'\" onmouseout=\"this.style.background='#fbffd7';this.style.color='black'\" >";
                else
                    $html.= "<table border='0' class='tablaTitulo' width='100%'><tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >";                    
                $html.= "<td width='5%' align='center'><img src='../comunes/images/".$data[$i][origen].".png' height='20px' onmouseover=\"Tip('Prioridad Alta')\" onmouseout='UnTip()'\"></td>
                            <td width='10%' align='center'>".$data[$i][id_tipo_documento]."</td>
                            <td width='15%' align='center'>".clTblDocumento::getMaestro($data[$i][id_unidad])."</td>                    
                            <td width='10%' align='center'>".$data[$i][id_evento_documento]."</td>
                            <td width='10%' align='left'>".functions::decrypt($data[$i][strtitulo])."</td>                                
                            <td width='10%' align='center'>".$data[$i][id_prioridad_documento]."</td>
                            <td width='10%' align='center'>".$data[$i][id_estado_documento]."</td>                               
                            <td width='5%' align='center'>".functions::diterenciaFechasDiasDocumento($data[$i][fecdocumento])."</td>
                            <td width='35%' align='center'>";
                $color=functions::diterenciaFechasSemaforoDocumento($data[$i]['fecdocumento'],clTblDocumento::getDiasRecordatorios($data[$i]['id_recordatorio']));
                if ($data[$i][id_prioridad]==clConstantesModelo::prioridad_alta)
                {
                    $html.="<a>
                                    <img src='../comunes/images/flag_red.png' height='17px' onmouseover=\"Tip('Prioridad Alta')\" onmouseout='UnTip()'\">
                                </a>";
                }elseif ($data[$i][id_prioridad]==clConstantesModelo::prioridad_media) {
                    $html.="<a>
                                    <img src='../comunes/images/flag_green.png' height='17px' onmouseover=\"Tip('Prioridad Media')\" onmouseout='UnTip()'\">
                                </a>";                
                }else{
                    $html.="<a>
                                    <img src='../comunes/images/flag_yellow.png' height='17px' onmouseover=\"Tip('Prioridad Baja')\" onmouseout='UnTip()'\">
                                </a>";                
                }                      
                if ($data[$i][id_refiere]==clConstantesModelo::buscar_refiere)
                {
                    $html.="<a>
                                    <img src='../comunes/images/UserGroup.png' height='17px' onmouseover=\"Tip('Refiere Departamento')\" onmouseout='UnTip()'\">
                                </a>";
                }                      
                if ($data[$i][id_refiere]==clConstantesModelo::buscar_persona)
                {
                    if ($data[$i][id_seguimiento]!='')
                    {
                        if (clTblDocumento::getEstadoDocumentoSeguimiento($data[$i][id_seguimiento])==1)
                        {
                            $image='group_error.png';
                            $msg='Mensaje no Leido';
                        }
                        else
                        { 
                            $image='group.png';         
                            $msg='Mensaje Leido';                            
                        }
                    }
                    else
                        $image='group.png';                     
                          
                    $html.="<a>
                                    <img src='../comunes/images/".$image."' height='17px' onmouseover=\"Tip('".$msg."')\" onmouseout='UnTip()'\">
                                </a>";
                }                      
                if ($color=='R')
                {
                    $html.="<a>
                                    <img src='../comunes/images/rojo.gif' height='17px' onmouseover=\"Tip('Documento Pendiente Vencidas')\" onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."'\";\">
                                </a>";
                }
                elseif ($color=='A')
                {        
                    $html.="<a>
                                    <img src='../comunes/images/amarillo.gif' height='17px'  onmouseover=\"Tip('Documento Pendiente por Vencer')\" onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."'\";\">
                                </a>";                
                }
                elseif ($color=='V')
                {
                    $html.="<a>
                                    <img src='../comunes/images/verde.gif' height='17px'  onmouseover=\"Tip('Documento Pendiente')\" onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."'\";\">
                                </a>";                   
                }                            
                $html.="        <a>
                                    <img src='../comunes/images/page_edit.png' onmouseover='Tip(\"Editar Item Documento ".$data[$i]['id_documento']."\")' onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."'\";\">
                                </a>";   
                if ($data[$i][visto]!=1)
                 $html.="       <a>
                                    <img src='../comunes/images/Undo.png' onmouseover='Tip(\"Marcar como no Leido Item Documento ".$data[$i]['id_documento']."\")' onmouseout='UnTip()' onclick=\"xajax_ActualizarItemDocumento('".$data[$i]['id_documento']."','1','visto');\">
                                </a>
                                <a>
                                    <img src='../comunes/images/table_multiple.png' onmouseover='Tip(\"Clonar Item Documento ".$data[$i]['id_documento']."\")' onmouseout='UnTip()' onclick=\"location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."&clon=1'\">
                                </a>
                                <a>
                                    <img src='../comunes/images/vcard_delete.png' onmouseover='Tip(\"Eliminar Item Documento ".$data[$i]['id_documento']."\")' onmouseout='UnTip()' onclick=\"if(confirm('¿Desea Eliminar el Item de Documento?')){xajax_ActualizarItemDocumentoRecibidos('".$data[$i]['id_documento']."','1','bolborrado')};\">
                                </a>";                                 
                 $html.="</td></tr></table>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Items Registrados</div>";
        }
        $respuesta->assign("contenedorDocumento","innerHTML",$html);
        return $respuesta;
    }    
    
    
    function ActualizarItemDocumentoBorrados($id,$valor,$campo){
        $respuesta=new xajaxResponse(); 
        if ($id)
        {
            $documento= new clTblDocumento();            
            $documento->updateDocumentoItem($id,$valor,$campo); 
            $respuesta->alert("Requerimiento Procesado con Exito");      
            $respuesta->script('xajax_selectAllDocumentoBorrados();');
        }
        return $respuesta;
    } 
    
    function selectAllDocumentoBorrados($fil_id_tipo=0, $fil_id_evento=0, $fil_id_unidad=0, $fil_id_prioridad=0){
        $respuesta= new xajaxResponse();
        $documento= new clTblDocumento();              
        $data= "";
        $html= "";
	if (($fil_id_tipo>0) or ($fil_id_evento>0) or ($fil_id_unidad>0) or ($fil_id_prioridad>0))  {
            $data= $documento->selectFiltrarDocumentoBorrados($fil_id_tipo, $fil_id_evento, $fil_id_unidad, $fil_id_prioridad);
        }
        else
        {
            $data= $documento->selectAllDocumentoBorrados();
        }
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_honorarios')\"></a>
                                </th>                            
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_honorarios')\">Documento</a>
                                </th>                                     
                                <th width='15%'>
                                    <a href='#' onclick=\"xajax_orden('id_tipo')\">Departamentto</a>
                                </th>                                
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_tipo')\">Evento</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_tipo')\">Titulo</a>
                                </th>                                
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('Tramite')\">Prioridad</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('Unidad')\">Estado</a>
                                </th>                    
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('Unidad')\">Días</a>
                                </th>                                   
                                <th width='35%'>Acci&oacute;n</th>
                            </tr></table>";
            for ($i= 0; $i < count($data); $i++){
                if ($data[$i][visto]==1)
                    $html.= "<table border='0' class='tablaTitulo' width='100%'><tr bgcolor='#fbffd7'onmouseover=\"this.style.background='#ffc05c';this.style.color='blue'\" onmouseout=\"this.style.background='#fbffd7';this.style.color='black'\" >";
                else
                    $html.= "<table border='0' class='tablaTitulo' width='100%'><tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >";                    
                if ($data[$i][id_seguimiento]==0) $movimiento=$data[$i][id_documento];
                else $movimiento=$data[$i][id_seguimiento];                
                $html.= "<td width='5%' align='center'><img src='../comunes/images/".$data[$i][origen].".png' height='20px' onmouseover=\"Tip('".clTblDocumento::getMovimientoDocumentos($movimiento)."', TITLE, 'Ruta del Documento ".$data[$i][date]."')\" onmouseout='UnTip()'\"></td>
                            <td width='10%' align='center'>".$data[$i][id_tipo_documento]."</td>
                            <td width='15%' align='center'>".clTblDocumento::getMaestro($data[$i][id_unidad])."</td>                    
                            <td width='10%' align='center'>".$data[$i][id_evento_documento]."</td>
                            <td width='10%' align='left'>".functions::decrypt($data[$i][strtitulo])."</td>                                
                            <td width='10%' align='center'>".$data[$i][id_prioridad_documento]."</td>
                            <td width='10%' align='center'>".$data[$i][id_estado_documento]."</td>                               
                            <td width='5%' align='center'>".functions::diterenciaFechasDiasDocumento($data[$i][fecdocumento])."</td>
                            <td width='35%' align='center'>";
                $color=functions::diterenciaFechasSemaforoDocumento($data[$i]['fecdocumento'],clTblDocumento::getDiasRecordatorios($data[$i]['id_recordatorio']));
                if ($data[$i][id_prioridad]==clConstantesModelo::prioridad_alta)
                {
                    $html.="<a>
                                    <img src='../comunes/images/flag_red.png' height='17px' onmouseover=\"Tip('Prioridad Alta')\" onmouseout='UnTip()'\">
                                </a>";
                }elseif ($data[$i][id_prioridad]==clConstantesModelo::prioridad_media) {
                    $html.="<a>
                                    <img src='../comunes/images/flag_green.png' height='17px' onmouseover=\"Tip('Prioridad Media')\" onmouseout='UnTip()'\">
                                </a>";                
                }else{
                    $html.="<a>
                                    <img src='../comunes/images/flag_yellow.png' height='17px' onmouseover=\"Tip('Prioridad Baja')\" onmouseout='UnTip()'\">
                                </a>";                
                }                      
                if ($data[$i][id_refiere]==clConstantesModelo::buscar_refiere)
                {
                    $html.="<a>
                                    <img src='../comunes/images/UserGroup.png' height='17px' onmouseover=\"Tip('Refiere Departamento')\" onmouseout='UnTip()'\">
                                </a>";
                }                      
                if ($data[$i][id_refiere]==clConstantesModelo::buscar_persona)
                {
                    if ($data[$i][id_seguimiento]!='')
                    {
                        if (clTblDocumento::getEstadoDocumentoSeguimiento($data[$i][id_seguimiento])==1)
                        {
                            $image='group_error.png';
                            $msg='Mensaje no Leido';
                        }
                        else
                        { 
                            $image='group.png';         
                            $msg='Mensaje Leido';                            
                        }
                    }
                    else
                        $image='group.png';                     
                          
                    $html.="<a>
                                    <img src='../comunes/images/".$image."' height='17px' onmouseover=\"Tip('".$msg."')\" onmouseout='UnTip()'\">
                                </a>";
                }                      
                if ($color=='R')
                {
                    $html.="<a>
                                    <img src='../comunes/images/rojo.gif' height='17px' onmouseover=\"Tip('Documento Pendiente Vencidas')\" onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."'\";\">
                                </a>";
                }
                elseif ($color=='A')
                {        
                    $html.="<a>
                                    <img src='../comunes/images/amarillo.gif' height='17px'  onmouseover=\"Tip('Documento Pendiente por Vencer')\" onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."'\";\">
                                </a>";                
                }
                elseif ($color=='V')
                {
                    $html.="<a>
                                    <img src='../comunes/images/verde.gif' height='17px'  onmouseover=\"Tip('Documento Pendiente')\" onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."'\";\">
                                </a>";                   
                }                            
                $html.="        <a>
                                    <img src='../comunes/images/page_edit.png' onmouseover='Tip(\"Editar Item Documento ".$data[$i]['id_documento']."\")' onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."'\";\">
                                </a>";   
                if ($data[$i][visto]!=1)
                 $html.="       <a>
                                    <img src='../comunes/images/Undo.png' onmouseover='Tip(\"Marcar como no Leido Item Documento ".$data[$i]['id_documento']."\")' onmouseout='UnTip()' onclick=\"xajax_ActualizarItemDocumentoBorrados('".$data[$i]['id_documento']."','1','visto');xajax_ActualizarItemDocumentoBorrados('".$data[$i]['id_documento']."','0','bolborrado');\">
                                </a>
                                <a>
                                    <img src='../comunes/images/table_multiple.png' onmouseover='Tip(\"Clonar Item Documento ".$data[$i]['id_documento']."\")' onmouseout='UnTip()' onclick=\"location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."&clon=1'\">
                                </a>
                                <a>
                                    <img src='../comunes/images/vcard_add.png' onmouseover='Tip(\"Colocar como no Borrado el Item de Documento ".$data[$i]['id_documento']."\")' onmouseout='UnTip()' onclick=\"if(confirm('¿Desea Colocar como no Borrado el Item de Documento?')){xajax_ActualizarItemDocumentoBorrados('".$data[$i]['id_documento']."','0','bolborrado')};\">
                                </a>";                                 
                 $html.="</td></tr></table>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Items Registrados</div>";
        }
        $respuesta->assign("contenedorDocumento","innerHTML",$html);
        return $respuesta;
    }    
    
    
    function buscarPersonaPopup($id_coord_maestro){
        $respuesta= new xajaxResponse();
        $contacto = new clContactoModelo();        
//        exit($id_coord_maestro."---"); 
        $data= "";
        $html= "";   
        if ($id_coord_maestro!='')
        {    
            $data=$contacto->selectAllContactoFiltrosDocumento($id_coord_maestro);
        }
        if(is_array($data)){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE TRABAJADORES</strong>
                                    </div>                                
                                </td>
                            </tr>                               
                                <tr>
                                    <th width='10%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Id</a>
                                    </th>                                
                                    <th width='21%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Nombre</a>
                                    </th>
                                    <th width='22%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Apellido</a>
                                    </th>
                                    <th width='22%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Departamento</a>
                                    </th>                                    
                                    <th width='5%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Acción</a>
                                    </th>                                         
                                </tr>";
                for ($i= 0; $i < count($data); $i++){
                    if ($data[$i]['id_contacto']!=$_SESSION['id_contacto']){
                    $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                <td align='center'>".$i."</td>
                                <td align='center'>".$data[$i]['strnombre']."</td>
                                <td align='center'>".$data[$i]['strapellido']."</td>
                                <td align='center'>".  clFunciones::mostrarStritema($data[$i]['id_coord_maestro'])."</td>                       
                                <td align='center'>
                                        <a>
                                            <img src='../comunes/images/s_success.png' onmouseover='Tip(\"Elegir Persona\")' onmouseout='UnTip()' onclick=\"xajax_buscarPersona('".$data[$i][id_contacto]."')\">
                                        </a>                                   
                                </td>
                            </tr>";
                    }
                    $respuesta->assign("strnombre", "value", '');
                    $respuesta->assign("id_contacto", "value", '');                      
                    //$respuesta->script("$('contenedorTrabajador').show();");                      
                }
                $html.= "</table></div>";
            }else
            {
                $html="";
                $respuesta->alert("No hay Registros en el Departamento");                   
            }
        $respuesta->assign("contenedorTrabajador","innerHTML",$html);
        return $respuesta;
    }    
    
    function buscarPersona($id){
//        exit($id);
        $respuesta=new xajaxResponse();
        $contacto = new clContactoModelo();        
        $data=$contacto->selectContactoById($id);
        if(is_array($data)){
            $respuesta->assign("strnombre", "value", $data[0][strnombre].", ".$data[0][strapellido]);
            $respuesta->assign("id_contacto", "value", $data[0][id_contacto]);  
            $respuesta->script("$('contenedorTrabajador').hide();");                     
        }
        else  $respuesta->alert("El Trabajador no Existe");   
        return $respuesta;
    }    
    
    function verPersona($id){
        $respuesta=new xajaxResponse(); 
        if ($id)
        {
            $cod=clConstantesModelo::buscar_persona;
            if($id==$cod){
                $respuesta->script("$('CapaTrabajador').show();");
            }
            else {
                $respuesta->script("$('CapaTrabajador').hide();");
                    $respuesta->assign("strnombre", "value", '');
                    $respuesta->assign("id_contacto", "value", '');  
           }
        }
        return $respuesta;
    }    

    function selectClonarDocumento($id) {
    $respuesta = new xajaxResponse();
    $documento= new clTblDocumento();
    $data = "";
    $documento->updateDocumentoItem($id,0);    
    $data = $documento->selectDocumento($id);
    if ($data) {
//        $respuesta->script("$('fecha').hide();");           
        $respuesta->script('xajax_llenarSelectTipoDocumento(' . $data[0][id_tipo] . ')');
        if ($data[0][id_expediente]>0)
        {
             $respuesta->script('xajax_buscarExpediente(' . $data[0][id_expediente] . ')');
             $respuesta->script("$('CapaExpediente').show();");             
        }
        if ($data[0][id_contacto]>0)
        {
             $respuesta->script('xajax_buscarPersona(' . $data[0][id_contacto] . ')');
             $respuesta->script("$('CapaTrabajador').show();");             
        }            
        $respuesta->script('xajax_selectRefiereDocumento(' . $data[0][id_refiere] . ')');        
        $respuesta->script('xajax_llenarSelectTipoEvento(' . $data[0][id_evento] . ')');
        $respuesta->script('xajax_llenarSelectTipoPrioridad(' . $data[0][id_prioridad] . ')'); 
        $respuesta->script('xajax_llenarSelectTipoEstadoDocumento(' . $data[0][id_estado] . ')');   
        $respuesta->script('xajax_llenarSelectTipoRecordatorio(' . $data[0][id_recordatorio] . ')');     
        $respuesta->script('xajax_selectAllDpto(' . $data[0][id_unidad] . ')');         
        $respuesta->script('xajax_llenarSelectTipoOrganismo(' . $data[0][id_tipo_organismo] . ')');
        $respuesta->script('xajax_llenarSelectOrganismo(' . $data[0][id_tipo_organismo] . ',' . $data[0][id_organismo] . ')');        
        $respuesta->assign('strtitulo', 'value', functions::decrypt($data[0][strtitulo]));        
        $respuesta->assign('strpersona', 'value', $data[0][strpersona]);        
        $respuesta->assign('fecdocumento', 'value', $data[0][fecdocumento]);
        $respuesta->assign('id_documento', 'value', '');   
        $respuesta->script("FCKeditorAPI.__Instances['descripcion'].SetHTML('".functions::decrypt($data[0][strdescripcion])."')");
    }
    return $respuesta;
}
    

    
    function ActualizarItemDocumento($id,$valor,$campo){
        $respuesta=new xajaxResponse(); 
        if ($id)
        {
            $documento= new clTblDocumento();            
            $documento->updateDocumentoItem($id,$valor,$campo); 
            $respuesta->alert("Requerimiento Procesado con Exito");      
            $respuesta->script('xajax_selectAllDocumento();');
        }
        return $respuesta;
    }         
    
  function selectRefiereDocumento($select= "", $ancho= "60%", $ajax=0) 
  {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";        
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_refiere_documento'], "stritema");
        if ($ajax>0)
            $html= "<select id='id_refiere' name='id_refiere' style='width:".$ancho."'>";
        else
            $html= "<select id='id_refiere' name='id_refiere' style='width:".$ancho."' onchange=\"xajax_verPersona(document.frmDocumento.id_refiere.value)\">";            
        $html.= "<option value='0'>Seleccione</option>";        
        for($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }            
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
        }
        $html.= "</select>";
        $respuesta->assign("capaIdRefiere","innerHTML",$html);
        return $respuesta;
    }    
    
    function selectDocumento($id) {
    $respuesta = new xajaxResponse();
    $documento= new clTblDocumento();
    $data = "";
    $documento->updateDocumentoItem($id,0,'visto');    
    $data = $documento->selectDocumento($id);
    if ($data) {
        $respuesta->script('xajax_llenarSelectTipoDocumento(' . $data[0][id_tipo] . ')');
        if ($data[0][id_expediente]>0)
        {
             $respuesta->script('xajax_buscarExpediente(' . $data[0][id_expediente] . ')');
             $respuesta->script("$('CapaExpediente').show();");             
        }
        if ($data[0][id_contacto]>0)
        {
             $respuesta->script('xajax_buscarPersona(' . $data[0][id_contacto] . ')');
             $respuesta->script("$('CapaTrabajador').show();");             
        }        
        $respuesta->script('xajax_selectRefiereDocumento(' . $data[0][id_refiere] . ')');        
        $respuesta->script('xajax_llenarSelectTipoEvento(' . $data[0][id_evento] . ')');
        $respuesta->script('xajax_llenarSelectTipoPrioridad(' . $data[0][id_prioridad] . ')'); 
        $respuesta->script('xajax_llenarSelectTipoEstadoDocumento(' . $data[0][id_estado] . ')');   
        $respuesta->script('xajax_llenarSelectTipoRecordatorio(' . $data[0][id_recordatorio] . ')');     
        $respuesta->script('xajax_selectAllDpto(' . $data[0][id_unidad] . ')');         
        $respuesta->script('xajax_llenarSelectTipoOrganismo(' . $data[0][id_tipo_organismo] . ')');
        $respuesta->script('xajax_llenarSelectOrganismo(' . $data[0][id_tipo_organismo] . ',' . $data[0][id_organismo] . ')');        
        $respuesta->assign('strtitulo', 'value', $data[0][strtitulo]);
        $respuesta->assign('strpersona', 'value', $data[0][strpersona]);        
        $respuesta->assign('fecdocumento', 'value', $data[0][fecdocumento]);
        $respuesta->assign('fechacreacion', 'value', $data[0][date]);        
        $respuesta->assign('strtitulo', 'value', functions::decrypt($data[0][strtitulo]));
        $respuesta->assign('id_documento', 'value', $data[0][id_documento]);        
        $respuesta->assign('strnumero', 'value', $data[0][strnumero]);         
        $respuesta->assign('strtelefono', 'value', $data[0][strtelefono]);           
        $respuesta->script("FCKeditorAPI.__Instances['descripcion'].SetHTML('".functions::decrypt($data[0][strdescripcion])."')");
    }
    return $respuesta;
}
    
    
    function guardarDocumento($request){
        $respuesta= new xajaxResponse();
        $documento= new clTblDocumento();
        $documento->llenar($request);
//        if (functions::diterenciaFechasDiasDocumento($request['fecdocumento'])>0)
//        {
            if($request['id_documento'] =="") 
            {
                if (clTblDocumento::getNroDocumento($request['strnumero'])=='')
                {
                    $data= $documento->insertDocumento();
                    $respuesta->script("if(confirm('La Documento se Creo exitosamente, ¿Desea Crear otro Item de Documento?')){ location.href='vista_insertTblDocumento.php';}else{location.href='vista_tblDocumento.php';}");            
                }
                else
                    $respuesta->alert("El Numero del Documento ya Fue Registrado");                
            }
            else 
            {
                $data= $documento->updateDocumento();
                $respuesta->script("if(confirm('La Documento se Actualizo exitosamente, ¿Desea Crear otro Item de Documento?')){ location.href='vista_insertTblDocumento.php';}else{location.href='vista_tblDocumento.php';}");                        
            }
            if(!$data){
                $respuesta->alert("El Documento no se ha guardado");
            }            
//        }
//        else $respuesta->alert("La fecha del Documento no puede vencer el mismo día");        
        return $respuesta;
    }    
    
    function validar_Documento($request){
        $respuesta = new xajaxResponse();
            $campos_validar= array(
            'Tipo de Documento'    => 'id_tipo',
            'Tipo de Prioridad'    => 'id_prioridad',
            'Tipo de Evento'    => 'id_evento',                
            'Tipo de Estado'    => 'id_estado',
            'Tipo de Recordatorio'    => 'id_recordatorio',                
            'Titulo del Evento'  => 'strtitulo',
            'Fecha de la Documento'    => 'fecdocumento',
            'Descripcion de la Documento' => 'strdescripcion',
            'Nro del Documento' => 'strnumero',                
            );
            $validacion=  functions::validarFormulario('frmDocumento',$request,$campos_validar);
            if($validacion){
                $respuesta->alert($validacion['msg']);
                $respuesta->script($validacion['focus']);
            }else{
                $respuesta->script("xajax_guardarDocumento(xajax.getFormValues('frmDocumento'))");
            }
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
    
     function llenarSelectTipoOrganismo($select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_organismo'], 'stritema');
        $html= "<select id='id_tipo_organismo' name='id_tipo_organismo' style='width:".$ancho."' onchange=\"xajax_llenarSelectOrganismo(document.frmDocumento.id_tipo_organismo.value)\">";
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

  function selectAllDpto($select= "", $ancho= "60%") 
  {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";        
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_departamento_documento'], "stritema");
        $html= "";
        $html= "<select id='id_unidad' name='id_unidad' style='width:".$ancho."' onchange=\"xajax_buscarPersonaPopup(document.frmDocumento.id_unidad.value)\">";            
        $html.= "<option value='0'>Seleccione</option>";        
        for($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }            
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
        }
        $html.= "</select>";
        $respuesta->assign("capaIdTipoUnidad","innerHTML",$html);
        return $respuesta;
    }
    
    
   function llenarSelectTipoRecordatorio($select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_recordatorio_documento'], 'stritema');
//        exit(print_r($data));        
        $html= "<select id='id_recordatorio' name='id_recordatorio' style='width:".$ancho."'>";
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
        $respuesta->assign("capaIdTipoRecordatorio","innerHTML",$html);
        return $respuesta;
    }       
    
   function llenarSelectTipoEstadoDocumento($select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_estado_documento'], 'stritema');
//        exit(print_r($data));        
        $html= "<select id='id_estado' name='id_estado' style='width:".$ancho."'>";
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
        $respuesta->assign("capaIdTipoEstado","innerHTML",$html);
        return $respuesta;
    }     
    
   function llenarSelectTipoEvento($select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_evento_documento'], 'stritema');
//        exit(print_r($data));        
        $html= "<select id='id_evento' name='id_evento' style='width:".$ancho."'>";
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
        $respuesta->assign("capaIdTipoEvento","innerHTML",$html);
        return $respuesta;
    }         

   function llenarSelectTipoPrioridad($select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_prioridad_documento'], 'stritema');
//        exit(print_r($data));        
        $html= "<select id='id_prioridad' name='id_prioridad' style='width:".$ancho."'>";
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
        $respuesta->assign("capaIdTipoPrioridad","innerHTML",$html);
        return $respuesta;
    }     

    function buscarExpediente($id){
        $respuesta=new xajaxResponse();
        $expediente = new clProExpediente();         
        $data=$expediente->getExpedienteClienteDocumento($id);
        if(is_array($data)){
            $respuesta->assign("strnroexpediente", "value", $data[0][strnroexpediente]);
            $respuesta->assign("id_proexpediente", "value", $data[0][id_proexpediente]);  
            $respuesta->script("FCKeditorAPI.__Instances['descripcion'].SetHTML('Refiere a Expediente Nro:".$data[0][strnroexpediente]."<br /><br />".$data[0][strdescripcion]."<br type=\"_moz\" />')");            
            $respuesta->script("$('contenedorExpediente').hide();");                     
        }
        else  $respuesta->alert("El Expediente no Existe");   
        return $respuesta;
    }
    
    
    
    function buscarExpedientePopup($str){
//        exit($str."PASO");
        $respuesta= new xajaxResponse();
        $expediente = new clProExpediente();        
        $data= "";
        $html= "";      
//        exit($str."PASO");            
        $data=$expediente->SelectExpedienteDocumentoLike($str);
//        exit($str."PASO");        
        if($data){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE EXPEDIENTE</strong>
                                    </div>                                
                                </td>
                            </tr>                               
                                <tr>
                                    <th width='10%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Id</a>
                                    </th>                                
                                    <th width='21%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Expediente</a>
                                    </th>
                                    <th width='22%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">C.I Abogado</a>
                                    </th>
                                    <th width='22%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Tramite</a>
                                    </th>                                    
                                    <th width='5%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Acción</a>
                                    </th>                                         
                                </tr>";
                for ($i= 0; $i < count($data); $i++){

                    $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                <td align='center'>".$i."</td>
                                <td align='center'>".$data[$i]['strnroexpediente']."</td>
                                <td align='center'>".$data[$i]['cedula_abogado_responsable']."</td>
                                <td align='center'>".  clFunciones::mostrarStritema($data[$i]['id_tipo_tramite'])."</td>                       
                                <td align='center'>
                                        <a>
                                            <img src='../comunes/images/s_success.png' onmouseover='Tip(\"Elegir Expediente\")' onmouseout='UnTip()' onclick=\"xajax_buscarExpediente('".$data[$i][id_proexpediente]."')\">
                                        </a>                                   
                                </td>
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="";
            }
//        $respuesta->script("$('contenedorExpediente').show();");            
        $respuesta->assign("contenedorExpediente","innerHTML",$html);
        return $respuesta;
    }
        
        
    
    
    function verExpediente($id){
        $respuesta=new xajaxResponse(); 
        if ($id)
        {
            $cod=clConstantesModelo::buscar_expediente;
            if($id==$cod){
                $respuesta->script("$('CapaExpediente').show();");
            }
            else {
                $respuesta->script("$('CapaExpediente').hide();");
                    $respuesta->assign("strnroexpediente", "value", '');
                    $respuesta->assign("id_proexpediente", "value", '');  
                    $respuesta->script("FCKeditorAPI.__Instances['descripcion'].SetHTML('')");            
           }
        }
        return $respuesta;
    }
            
    
   function llenarSelectTipoDocumento($select= "", $ancho= "60%", $ajax=0) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipos_documento'], 'stritema');
        if ($ajax>0)
            $html= "<select id='id_tipo' name='id_tipo' style='width:".$ancho."'>";
        else
            $html= "<select id='id_tipo' name='id_tipo' style='width:".$ancho."' onchange=\"xajax_verExpediente(document.frmDocumento.id_tipo.value)\">";            
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
        $respuesta->assign("capaIdTipo","innerHTML",$html);
        return $respuesta;
    }     

    function selectAllDocumento($fil_id_tipo=0, $fil_id_evento=0, $fil_id_unidad=0, $fil_id_prioridad=0){
        $respuesta= new xajaxResponse();
        $documento= new clTblDocumento();
        $data= "";
        $html= "";
	if (($fil_id_tipo>0) or ($fil_id_evento>0) or ($fil_id_unidad>0) or ($fil_id_prioridad>0))  {
            $data= $documento->selectFiltrarDocumento($fil_id_tipo, $fil_id_evento, $fil_id_unidad, $fil_id_prioridad);
        }
        else
        {
            $data= $documento->selectAllDocumento();
        }
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_honorarios')\"></a>
                                </th>                               
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_honorarios')\">Documento</a>
                                </th>  
                                <th width='15%'>
                                    <a href='#' onclick=\"xajax_orden('id_tipo')\">Departamentto</a>
                                </th>                                
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_tipo')\">Evento</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_tipo')\">Titulo</a>
                                </th>                                
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('Tramite')\">Prioridad</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('Unidad')\">Estado</a>
                                </th>                    
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('Unidad')\">Días</a>
                                </th>                                   
                                <th width='35%'>Acci&oacute;n</th>
                            </tr></table>";
            for ($i= 0; $i < count($data); $i++){
                if ($data[$i][visto]==1)
                    $html.= "<table border='0' class='tablaTitulo' width='100%'><tr bgcolor='#fbffd7'onmouseover=\"this.style.background='#ffc05c';this.style.color='blue'\" onmouseout=\"this.style.background='#fbffd7';this.style.color='black'\" >";
                else
                    $html.= "<table border='0' class='tablaTitulo' width='100%'><tr align='left' bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >";                    
                if ($data[$i][id_seguimiento]==0) $movimiento=$data[$i][id_documento];
                else $movimiento=$data[$i][id_seguimiento];
                $html.= "<td width='5%' align='center'><img src='../comunes/images/".$data[$i][origen].".png' height='20px' onmouseover=\"Tip('".clTblDocumento::getMovimientoDocumentos($movimiento)."', TITLE, 'Ruta del Documento ".$data[$i][date]."')\" onmouseout='UnTip()'\"></td>
                            <td width='10%' align='center'>".$data[$i][id_tipo_documento]."</td>
                            <td width='15%' align='center'>".clTblDocumento::getMaestro($data[$i][id_unidad])."</td>                    
                            <td width='10%' align='center'>".$data[$i][id_evento_documento]."</td>
                            <td width='10%' align='left'>".functions::decrypt($data[$i][strtitulo])."</td>                                
                            <td width='10%' align='center'>".$data[$i][id_prioridad_documento]."</td>
                            <td width='10%' align='center'>".$data[$i][id_estado_documento]."</td>                               
                            <td width='5%' align='center'>".functions::diterenciaFechasDiasDocumento($data[$i][fecdocumento])."</td>
                            <td width='35%' align='center'>";
      
                $color=functions::diterenciaFechasSemaforoDocumento($data[$i]['fecdocumento'],clTblDocumento::getDiasRecordatorios($data[$i]['id_recordatorio']));
                if ($data[$i][id_prioridad]==clConstantesModelo::prioridad_alta)
                {
                    $html.="<a>
                                    <img src='../comunes/images/flag_red.png' height='17px' onmouseover=\"Tip('Prioridad Alta')\" onmouseout='UnTip()'\">
                                </a>";
                }elseif ($data[$i][id_prioridad]==clConstantesModelo::prioridad_media) {
                    $html.="<a>
                                    <img src='../comunes/images/flag_green.png' height='17px' onmouseover=\"Tip('Prioridad Media')\" onmouseout='UnTip()'\">
                                </a>";                
                }else{
                    $html.="<a>
                                    <img src='../comunes/images/flag_yellow.png' height='17px' onmouseover=\"Tip('Prioridad Baja')\" onmouseout='UnTip()'\">
                                </a>";                
                }      
                if ($data[$i][id_refiere]==clConstantesModelo::buscar_refiere)
                {
                    $html.="<a>
                                    <img src='../comunes/images/UserGroup.png' height='17px' onmouseover=\"Tip('Refiere Departamento')\" onmouseout='UnTip()'\">
                                </a>";
                }                      
                if ($data[$i][id_refiere]==clConstantesModelo::buscar_persona)
                {
                    if ($data[$i][id_seguimiento]!='')
                    {
                        if (clTblDocumento::getEstadoDocumentoSeguimiento($data[$i][id_seguimiento])==1)
                        {
                            $image='group_error.png';
                            $msg='Mensaje no Leido';
                        }
                        else
                        { 
                            $image='group.png';         
                            $msg='Mensaje Leido';                            
                        }
                    }
                    else
                        $image='group.png';                     
                          
                    $html.="<a>
                                    <img src='../comunes/images/".$image."' height='17px' onmouseover=\"Tip('".$msg."')\" onmouseout='UnTip()'\">
                                </a>";
                }                      
                if ($color=='R')
                {
                    $html.="<a>
                                    <img src='../comunes/images/rojo.gif' height='17px' onmouseover=\"Tip('Documento Pendiente Vencidas')\" onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."'\";\">
                                </a>";
                }
                elseif ($color=='A')
                {        
                    $html.="<a>
                                    <img src='../comunes/images/amarillo.gif' height='17px'  onmouseover=\"Tip('Documento Pendiente por Vencer')\" onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."'\";\">
                                </a>";                
                }
                elseif ($color=='V')
                {
                    $html.="<a>
                                    <img src='../comunes/images/verde.gif' height='17px'  onmouseover=\"Tip('Documento Pendiente')\" onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."'\";\">
                                </a>";                   
                }                            
                $html.="        <a>
                                    <img src='../comunes/images/page_edit.png' onmouseover='Tip(\"Editar Item Documento ".$data[$i]['id_documento']."\")' onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."'\";\">
                                </a>";   
                if ($data[$i][visto]!=1)
                 $html.="       <a>
                                    <img src='../comunes/images/Undo.png' onmouseover='Tip(\"Marcar como no Leido Item Documento ".$data[$i]['id_documento']."\")' onmouseout='UnTip()' onclick=\"xajax_ActualizarItemDocumento('".$data[$i]['id_documento']."','1','visto');\">
                                </a>
                                <a>
                                    <img src='../comunes/images/OfferedSubscription.png' onmouseover='Tip(\"Reenviar Item Documento ".$data[$i]['id_documento']."\")' onmouseout='UnTip()' onclick=\"location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."&ree=1'\">
                                </a>                                
                                <a>
                                    <img src='../comunes/images/table_multiple.png' onmouseover='Tip(\"Clonar Item Documento ".$data[$i]['id_documento']."\")' onmouseout='UnTip()' onclick=\"location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."&clon=1'\">
                                </a>
                                <a>
                                    <img src='../comunes/images/vcard_delete.png' onmouseover='Tip(\"Eliminar Item Documento ".$data[$i]['id_documento']."\")' onmouseout='UnTip()' onclick=\"if(confirm('¿Desea Eliminar el Item de Documento?')){xajax_ActualizarItemDocumento('".$data[$i]['id_documento']."','1','bolborrado')};\">
                                </a>";                                 
                 $html.="</td></tr></table>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Items Registrados</div>";
        }
        $respuesta->assign("contenedorDocumento","innerHTML",$html);
        return $respuesta;
    }    
    
    function selectAllDocumentoCreados($fil_id_tipo=0, $fil_id_evento=0, $fil_id_unidad=0, $fil_id_prioridad=0){
        $respuesta= new xajaxResponse();
        $proDocumento= new clTblDocumento();
        $data= "";
        $html= "";
	if (($fil_id_tipo>0) or ($fil_id_evento>0) or ($fil_id_unidad>0) or ($fil_id_prioridad>0))  {
            $data= $proDocumento->selectFiltrarDocumentoCreados($fil_id_tipo, $fil_id_evento, $fil_id_unidad, $fil_id_prioridad);
        }
        else
        {
            $data= $proDocumento->selectAllDocumentoCreados();
        }
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_honorarios')\"></a>
                                </th>                               
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_honorarios')\">Documento</a>
                                </th>                            
                                <th width='15%'>
                                    <a href='#' onclick=\"xajax_orden('id_tipo')\">Departamentto</a>
                                </th>                                
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_tipo')\">Evento</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_tipo')\">Titulo</a>
                                </th>                                
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('Tramite')\">Prioridad</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('Unidad')\">Estado</a>
                                </th>                    
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('Unidad')\">Días</a>
                                </th>                                   
                                <th width='35%'>Acci&oacute;n</th>
                            </tr></table>";
            for ($i= 0; $i < count($data); $i++){
                if ($data[$i][visto]==1)
                    $html.= "<table border='0' class='tablaTitulo' width='100%'><tr bgcolor='#fbffd7'onmouseover=\"this.style.background='#ffc05c';this.style.color='blue'\" onmouseout=\"this.style.background='#fbffd7';this.style.color='black'\" >";
                else
                    $html.= "<table border='0' class='tablaTitulo' width='100%'><tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >";                    
                if ($data[$i][id_seguimiento]==0) $movimiento=$data[$i][id_documento];
                else $movimiento=$data[$i][id_seguimiento];                
                $html.= "<td width='5%' align='center'><img src='../comunes/images/".$data[$i][origen].".png' height='20px' onmouseover=\"Tip('".clTblDocumento::getMovimientoDocumentos($movimiento)."', TITLE, 'Ruta del Documento ".$data[$i][date]."')\" onmouseout='UnTip()'\"></td>
                            <td width='10%' align='center'>".$data[$i][id_tipo_documento]."</td>
                            <td width='15%' align='center'>".clTblDocumento::getMaestro($data[$i][id_unidad])."</td>                    
                            <td width='10%' align='center'>".$data[$i][id_evento_documento]."</td>
                            <td width='10%' align='left'>".functions::decrypt($data[$i][strtitulo])."</td>                                
                            <td width='10%' align='center'>".$data[$i][id_prioridad_documento]."</td>
                            <td width='10%' align='center'>".$data[$i][id_estado_documento]."</td>                               
                            <td width='5%' align='center'>".functions::diterenciaFechasDiasDocumento($data[$i][fecdocumento])."</td>
                            <td width='35%' align='center'>";
                $color=functions::diterenciaFechasSemaforoDocumento($data[$i]['fecdocumento'],clTblDocumento::getDiasRecordatorios($data[$i]['id_recordatorio']));
                if ($data[$i][id_prioridad]==clConstantesModelo::prioridad_alta)
                {
                    $html.="<a>
                                    <img src='../comunes/images/flag_red.png' height='17px' onmouseover=\"Tip('Prioridad Alta')\" onmouseout='UnTip()'\">
                                </a>";
                }elseif ($data[$i][id_prioridad]==clConstantesModelo::prioridad_media) {
                    $html.="<a>
                                    <img src='../comunes/images/flag_green.png' height='17px' onmouseover=\"Tip('Prioridad Media')\" onmouseout='UnTip()'\">
                                </a>";                
                }else{
                    $html.="<a>
                                    <img src='../comunes/images/flag_yellow.png' height='17px' onmouseover=\"Tip('Prioridad Baja')\" onmouseout='UnTip()'\">
                                </a>";                
                }                      
                if ($data[$i][id_refiere]==clConstantesModelo::buscar_refiere)
                {
                    $html.="<a>
                                    <img src='../comunes/images/UserGroup.png' height='17px' onmouseover=\"Tip('Refiere Departamento')\" onmouseout='UnTip()'\">
                                </a>";
                }                      
                if ($data[$i][id_refiere]==clConstantesModelo::buscar_persona)
                {
                    if ($data[$i][id_seguimiento]!='')
                    {
                        if (clTblDocumento::getEstadoDocumentoSeguimiento($data[$i][id_seguimiento])==1)
                        {
                            $image='group_error.png';
                            $msg='Mensaje no Leido';
                        }
                        else
                        { 
                            $image='group.png';         
                            $msg='Mensaje Leido';                            
                        }
                    }
                    else
                        $image='group.png';                     
                          
                    $html.="<a>
                                    <img src='../comunes/images/".$image."' height='17px' onmouseover=\"Tip('".$msg."')\" onmouseout='UnTip()'\">
                                </a>";
                }                      
                if ($color=='R')
                {
                    $html.="<a>
                                    <img src='../comunes/images/rojo.gif' height='17px' onmouseover=\"Tip('Documento Pendiente Vencidas')\" onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."'\";\">
                                </a>";
                }
                elseif ($color=='A')
                {        
                    $html.="<a>
                                    <img src='../comunes/images/amarillo.gif' height='17px'  onmouseover=\"Tip('Documento Pendiente por Vencer')\" onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."'\";\">
                                </a>";                
                }
                elseif ($color=='V')
                {
                    $html.="<a>
                                    <img src='../comunes/images/verde.gif' height='17px'  onmouseover=\"Tip('Documento Pendiente')\" onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."'\";\">
                                </a>";                   
                }                            
                $html.="        <a>
                                    <img src='../comunes/images/page_edit.png' onmouseover='Tip(\"Editar Item Documento ".$data[$i]['id_documento']."\")' onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."'\";\">
                                </a>";   
                if ($data[$i][visto]!=1)
                 $html.="       <a>
                                    <img src='../comunes/images/Undo.png' onmouseover='Tip(\"Marcar como no Leido Item Documento ".$data[$i]['id_documento']."\")' onmouseout='UnTip()' onclick=\"xajax_ActualizarItemDocumento('".$data[$i]['id_documento']."','1','visto');\">
                                </a>
                                <a>
                                    <img src='../comunes/images/table_multiple.png' onmouseover='Tip(\"Clonar Item Documento ".$data[$i]['id_documento']."\")' onmouseout='UnTip()' onclick=\"location.href='vista_insertTblDocumento.php?id=".$data[$i]['id_documento']."&clon=1'\">
                                </a>
                                <a>
                                    <img src='../comunes/images/vcard_delete.png' onmouseover='Tip(\"Eliminar Item Documento ".$data[$i]['id_documento']."\")' onmouseout='UnTip()' onclick=\"if(confirm('¿Desea Eliminar el Item de Documento?')){xajax_ActualizarItemDocumentoEnviados('".$data[$i]['id_documento']."','1','bolborrado')};\">
                                </a>";                                 
                 $html.="</td></tr></table>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Items Registrados</div>";
        }
        $respuesta->assign("contenedorDocumento","innerHTML",$html);
        return $respuesta;
    }    
    
    
    
?>
