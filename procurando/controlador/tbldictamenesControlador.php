<?php
    session_start();
    
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clDictamenesModelo.php';
    require_once '../comunes/php/utilidades.php';
    require_once '../modelo/clConstantesModelo.php';
    require_once '../modelo/clFunciones.php';    
    require_once '../herramientas/herramientas.class.php';    

    verificarSession();
    
   
    function selectDictamen($id) {
    $respuesta = new xajaxResponse();
    $dictamenes= new clTbldictamenes();
    $data = "";
    $data = $dictamenes->selectDictamen($id);
    if ($data) {
        $respuesta->script('xajax_llenarSelectTipo(' . $data[0][id_materia] . ')');
        $respuesta->script('xajax_llenarTipoMateria(' . $data[0][id_materia] . ',' . $data[0][id_tipo_materia] . ')');        
        $respuesta->script('xajax_llenarSelectTipoEstadoDictamen(' . $data[0][id_estado] . ')');
        $respuesta->script('xajax_llenarSelectTipoOrganismo(' . $data[0][id_tipo_organismo] . ')'); 
        $respuesta->script('xajax_llenarSelectOrganismo(' . $data[0][id_tipo_organismo] . ',' . $data[0][id_organismo] . ')');  
        $respuesta->assign('fecdictamen', 'value', $data[0][fecdictamen]);
        $respuesta->assign('strtitulo', 'value', $data[0][strtitulo]);        
        $respuesta->assign('id_dictamen', 'value', $data[0][id_dictamen]);               
        $respuesta->assign('stranrodictamen', 'value', $data[0][stranrodictamen]);        
        $respuesta->assign('strpersonas', 'value', $data[0][strpersonas]);
        $respuesta->assign('id_agenda', 'value', $data[0][id_agenda]);        
        $respuesta->script("FCKeditorAPI.__Instances['descripcion'].SetHTML('".$data[0][strasunto]."')");
    }
    return $respuesta;
}
    
    
    

    
    function selectAllDictamenes($id_materia=0, $id_tipo_materia=0, $id_tipo_organismo=0, $id_organismo=0, $id_estado=0, $strtitulo="", $stranrodictamen="", $strpersonas=""){
        $respuesta= new xajaxResponse();
        $dictamenes= new clTbldictamenes();
        $data= "";
        $html= "";
	if (($id_materia>0) or ($id_tipo_materia>0) or ($id_tipo_organismo>0) or ($id_organismo>0) or ($id_estado>0) or ($strtitulo!='') or ($stranrodictamen!='') or ($strpersonas!=''))  {
//            exit("paso");
            $data= $dictamenes->selectFiltrarDictamen($id_materia, $id_tipo_materia, $id_tipo_organismo, $id_organismo, $id_estado, $strtitulo, $stranrodictamen, $strpersonas);            
        }
        else
            $data= $dictamenes->selectAllDictamen();        
        if($data){
//            print_r($data);
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('stranrodictamen')\">N°</a>
                                </th>                            
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('id_materia')\">Materia</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('id_tipo_materia')\">Tema</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('strtitulo')\">Titulo</a>
                                </th>                                
                                <th width='10%'>Acci&oacute;n</th>
                            </tr></table>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<table border='0' class='tablaTitulo' width='100%'><tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='10%' align='center'>".$data[$i][stranrodictamen]."</td>
                            <td width='30%' align='center'>".$data[$i][id_materia_text]."</td>
                            <td width='30%'>".$data[$i][id_tipo_materia_text]."</td>
                            <td width='20%' align='center'>".$data[$i][strtitulo]."</td>                                
                            <td width='10%' align='center'>
                                <a>
                                    <img src='../comunes/images/table_edit.png' onmouseover='Tip(\"Editar Dictamen ".$data[$i][strtitulo]."\")' onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblDictamenes.php?id=".$data[$i][id_dictamen]."'\";\">
                                </a>
                                <a>
                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Detalle del Documento')\" onmouseout='UnTip()' onclick=\"location.href='../reportes/reporte_dictamen_individual.php?id=".$data[$i][id_dictamen]."'\">
                                </a>
                            </td>
                        </tr></table>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Items Registrados</div>";
        }
        $respuesta->assign("contenedorDictamenes","innerHTML",$html);
        return $respuesta;
    }


    
    
    
    function guardarDictamen($request){
        $respuesta= new xajaxResponse();
        $dictamen= new clTbldictamenes();
        $dictamen->llenar($request);
            if( $request['id_dictamen'] =="") 
            {
                $data= $dictamen->insertDictamen();
                $respuesta->alert("El Dictamen se Creo exitosamente");
                $respuesta->script("location.href='vista_tbldictamen.php'");            
            }
            else 
            {
                $data= $dictamen->updateDictamen();
                $respuesta->alert("El Dictamen se Actualizo exitosamente");
                $respuesta->script("location.href='vista_tbldictamen.php'");    
            }
            if(!$data){
                $respuesta->alert("El Dictamen no se ha guardado");
            }
        return $respuesta;
    }   
//    
    function validar_Dictamen($request){
        $respuesta = new xajaxResponse();
            $campos_validar= array(
            'Tipo de Materia'    => 'id_materia',
            'Tipo de Tema'    => 'id_tipo_materia',
            'Tipo de Organismo'    => 'id_tipo_organismo',                
            'Organismo'    => 'id_organismo',
            'Titulo del Dictamen'  => 'strtitulo',
            'Numero del Dictamen'  => 'stranrodictamen',                
            'Fecha del Dictamen'    => 'fecdictamen',
            'Descripcion de la Agenda' => 'strasunto',
            );
            $validacion=  functions::validarFormulario('frmDictamen',$request,$campos_validar);
            if($validacion){
                $respuesta->alert($validacion['msg']);
                $respuesta->script($validacion['focus']);
            }else{
                $respuesta->script("xajax_guardarDictamen(xajax.getFormValues('frmDictamen'))");
            }
        return $respuesta;
    }    
//    

    
    
    
    
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
//        $estados= clConstantesModelo::combos();
//        $data= $maestro->selectAllMaestroHijos($estados['tipo_organismo'], 'stritema');
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_cen_des'],'stritema', 2);        
        $html= "<select id='id_tipo_organismo' name='id_tipo_organismo' style='width:".$ancho."' onchange=\"xajax_llenarSelectOrganismo(document.frmDictamen.id_tipo_organismo.value)\">";
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
    
    
//    
//     function llenarSelectOrganismo($valor, $select= "", $ancho= "60%") {
//        $respuesta= new xajaxResponse();
//        $maestro= new clMaestroModelo();
//        $data= "";
//        $html= "";;
//        $data= $maestro->selectAllMaestroHijos($valor, 'stritema');
//        $html= "<select id='id_organismo' name='id_organismo' style='width:".$ancho."' >";
//        $html.= "<option value='0'>Seleccione</option>";
//        if($data){
//            for ($i= 0; $i < count($data); $i++){
//               $seleccionar= "";
//                if($select == $data[$i]['id_maestro']){
//                    $seleccionar= "SELECTED";
//                }
//                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
//            }
//            $html.= "</select>";
//        }
//        $respuesta->assign("capaIdOrganismo","innerHTML",$html);
//        return $respuesta;
//    }    
//    
//     function llenarSelectTipoOrganismo($select= "", $ancho= "60%") {
//        $respuesta= new xajaxResponse();
//        $maestro= new clMaestroModelo();
//        $data= "";
//        $html= "";
//        $estados= clConstantesModelo::combos();
//        $data= $maestro->selectAllMaestroHijos($estados['tipo_organismo'], 'stritema');
//        $html= "<select id='id_tipo_organismo' name='id_tipo_organismo' style='width:".$ancho."' onchange=\"xajax_llenarSelectOrganismo(document.frmDictamen.id_tipo_organismo.value)\">";
//        $html.= "<option value='0'>Seleccione</option>";
//        if($data){
//            for ($i= 0; $i < count($data); $i++){
//               $seleccionar= "";
//                if($select == $data[$i]['id_maestro']){
//                    $seleccionar= "SELECTED";
//                }
//                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
//            }
//            $html.= "</select>";
//        }
//        $respuesta->assign("capaIdTipoOrganismo","innerHTML",$html);
//        return $respuesta;
//    }    
////
//  function selectAllDpto($select= "", $ancho= "60%") 
//  {
//        $respuesta= new xajaxResponse();
//        $maestro= new clMaestroModelo();
//        $data= "";
//        $html= "";        
//        $estados= clConstantesModelo::combos();
//        $data= $maestro->selectAllMaestroHijos($estados['tipo_departamento_agenda'], "stritema");
//        $html= "";
//        $html= "<select id='id_unidad' name='id_unidad' style='width:".$ancho."' onchange=\"xajax_buscarPersonaPopup(document.frmDictamen.id_unidad.value)\">";            
//        $html.= "<option value='0'>Seleccione</option>";        
//        for($i= 0; $i < count($data); $i++){
//               $seleccionar= "";
//                if($select == $data[$i]['id_maestro']){
//                    $seleccionar= "SELECTED";
//                }            
//                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
//        }
//        $html.= "</select>";
//        $respuesta->assign("capaIdTipoUnidad","innerHTML",$html);
//        return $respuesta;
//    }
//    
//    
//   function llenarSelectTipoRecordatorio($select= "", $ancho= "60%") {
//        $respuesta= new xajaxResponse();
//        $maestro= new clMaestroModelo();
//        $data= "";
//        $html= "";
//        $estados= clConstantesModelo::combos();
//        $data= $maestro->selectAllMaestroHijos($estados['tipo_recordatorio_agenda'], 'stritema');
////        exit(print_r($data));        
//        $html= "<select id='id_recordatorio' name='id_recordatorio' style='width:".$ancho."'>";
//        $html.= "<option value='0'>Seleccione</option>";
//        if($data){
//            for ($i= 0; $i < count($data); $i++){
//               $seleccionar= "";
//                if($select == $data[$i]['id_maestro']){
//                    $seleccionar= "SELECTED";
//                }
//                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
//            }
//            $html.= "</select>";
//        }
//        $respuesta->assign("capaIdTipoRecordatorio","innerHTML",$html);
//        return $respuesta;
//    }       
//    
   function llenarSelectTipoEstadoDictamen($select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_estado_dictamenes'], 'stritema');
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
//    
//   function llenarSelectTipoEvento($select= "", $ancho= "60%") {
//        $respuesta= new xajaxResponse();
//        $maestro= new clMaestroModelo();
//        $data= "";
//        $html= "";
//        $estados= clConstantesModelo::combos();
//        $data= $maestro->selectAllMaestroHijos($estados['tipo_evento_agenda'], 'stritema');
////        exit(print_r($data));        
//        $html= "<select id='id_evento' name='id_evento' style='width:".$ancho."'>";
//        $html.= "<option value='0'>Seleccione</option>";
//        if($data){
//            for ($i= 0; $i < count($data); $i++){
//               $seleccionar= "";
//                if($select == $data[$i]['id_maestro']){
//                    $seleccionar= "SELECTED";
//                }
//                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
//            }
//            $html.= "</select>";
//        }
//        $respuesta->assign("capaIdTipoEvento","innerHTML",$html);
//        return $respuesta;
//    }         
//
     function llenarTipoMateria($valor, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos($valor, 'stritema');
        $html= "<select id='id_tipo_materia' name='id_tipo_materia' style='width:".$ancho."' >";
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
        $respuesta->assign("capaIdTipoMateria","innerHTML",$html);
        return $respuesta;
    }        
//
//  
//        
//    
//
//    
   function llenarSelectTipo($select= "", $ancho= "60%", $ajax=0) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_materia_dictamenes'], 'stritema');
        if ($ajax>0)
            $html= "<select id='id_materia' name='id_materia' style='width:".$ancho."'>";
        else
            $html= "<select id='id_materia' name='id_materia' style='width:".$ancho."' onchange=\"xajax_llenarTipoMateria(document.frmDictamen.id_materia.value)\">";
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
//
//    function selectAllAgenda($fil_id_tipo=0, $fil_id_evento=0, $fil_id_unidad=0, $fil_id_prioridad=0){
//        $respuesta= new xajaxResponse();
//        $proagenda= new clTblagenda();
//        $data= "";
//        $html= "";
//	if (($fil_id_tipo>0) or ($fil_id_evento>0) or ($fil_id_unidad>0) or ($fil_id_prioridad>0))  {
//            $data= $proagenda->selectFiltrarAgenda($fil_id_tipo, $fil_id_evento, $fil_id_unidad, $fil_id_prioridad);
//        }
//        else
//        {
//            $data= $proagenda->selectAllAgenda();
//        }
//        if($data){
//            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
//                        <table border='0' class='tablaTitulo' width='100%'>
//                            <tr>
//                                <th width='5%'>
//                                    <a href='#' onclick=\"xajax_orden('id_honorarios')\"></a>
//                                </th>                               
//                                <th width='10%'>
//                                    <a href='#' onclick=\"xajax_orden('id_honorarios')\">Agenda</a>
//                                </th>  
//                                <th width='15%'>
//                                    <a href='#' onclick=\"xajax_orden('id_tipo')\">Departamentto</a>
//                                </th>                                
//                                <th width='7%'>
//                                    <a href='#' onclick=\"xajax_orden('id_tipo')\">Evento</a>
//                                </th>
//                                <th width='15%'>
//                                    <a href='#' onclick=\"xajax_orden('id_tipo')\">Titulo</a>
//                                </th>                                
//                                <th width='10%'>
//                                    <a href='#' onclick=\"xajax_orden('Tramite')\">Prioridad</a>
//                                </th>
//                                <th width='10%'>
//                                    <a href='#' onclick=\"xajax_orden('Unidad')\">Estado</a>
//                                </th>                    
//                                <th width='5%'>
//                                    <a href='#' onclick=\"xajax_orden('Unidad')\">Días</a>
//                                </th>                                   
//                                <th width='30%'>Acci&oacute;n</th>
//                            </tr></table>";
//            for ($i= 0; $i < count($data); $i++){
//                if ($data[$i][visto]==1)
//                    $html.= "<table border='0' class='tablaTitulo' width='100%'><tr bgcolor='#fbffd7'onmouseover=\"this.style.background='#ffc05c';this.style.color='blue'\" onmouseout=\"this.style.background='#fbffd7';this.style.color='black'\" >";
//                else
//                    $html.= "<table border='0' class='tablaTitulo' width='100%'><tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >";                    
//                $html.= "<td width='5%' align='center'><img src='../comunes/images/".$data[$i][origen].".png' height='20px' onmouseover=\"Tip('Prioridad Alta', TITLE, 'Origen')\" onmouseout='UnTip()'\"></td>
//                            <td width='10%'  align='center' onmouseover=\"Tip('".$data[$i][strtitulo]."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i][id_tipo_agenda]."</td>
//                            <td width='15%'  align='center' onmouseover=\"Tip('".$data[$i][strtitulo]."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".clTblagenda::getMaestro($data[$i][id_unidad])."</td>                    
//                            <td width='7%'  align='center' onmouseover=\"Tip('".$data[$i][strtitulo]."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i][id_evento_agenda]."</td>
//                            <td width='15%'  align='center' onmouseover=\"Tip('".$data[$i][strtitulo]."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i][strtitulo]."</td>                                
//                            <td width='10%'  align='center' onmouseover=\"Tip('".$data[$i][strtitulo]."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i][id_prioridad_agenda]."</td>
//                            <td width='10%'  align='center' onmouseover=\"Tip('".$data[$i][strtitulo]."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".$data[$i][id_estado_agenda]."</td>                               
//                            <td width='5%'  align='center' onmouseover=\"Tip('".$data[$i][strtitulo]."', TITLE, 'Asunto')\" onmouseout='UnTip()'>".functions::diterenciaFechasDiasAgenda($data[$i][fecagenda])."</td>
//                            <td width='30%'  align='center'>";
//                $color=functions::diterenciaFechasSemaforoAgenda($data[$i]['fecagenda'],clTblagenda::getDiasRecordatorios($data[$i]['id_recordatorio']));
//                if ($data[$i][id_prioridad]==clConstantesModelo::prioridad_alta)
//                {
//                    $html.="<a>
//                                    <img src='../comunes/images/flag_red.png' height='17px' onmouseover=\"Tip('Prioridad Alta')\" onmouseout='UnTip()'\">
//                                </a>";
//                }elseif ($data[$i][id_prioridad]==clConstantesModelo::prioridad_media) {
//                    $html.="<a>
//                                    <img src='../comunes/images/flag_green.png' height='17px' onmouseover=\"Tip('Prioridad Media')\" onmouseout='UnTip()'\">
//                                </a>";                
//                }else{
//                    $html.="<a>
//                                    <img src='../comunes/images/flag_yellow.png' height='17px' onmouseover=\"Tip('Prioridad Baja')\" onmouseout='UnTip()'\">
//                                </a>";                
//                }                      
//                if ($data[$i][id_refiere]==clConstantesModelo::buscar_refiere)
//                {
//                    $html.="<a>
//                                    <img src='../comunes/images/UserGroup.png' height='17px' onmouseover=\"Tip('Refiere Departamento')\" onmouseout='UnTip()'\">
//                                </a>";
//                }                      
//                if ($data[$i][id_refiere]==clConstantesModelo::buscar_persona)
//                {
//                    if ($data[$i][id_seguimiento]!='')
//                    {
//                        if (clTblagenda::getEstadoAgendaSeguimiento($data[$i][id_seguimiento])==1)
//                        {
//                            $image='group_error.png';
//                            $msg='Mensaje no Leido';
//                        }
//                        else
//                        { 
//                            $image='group.png';         
//                            $msg='Mensaje Leido';                            
//                        }
//                    }
//                    else
//                        $image='group.png';                     
//                          
//                    $html.="<a>
//                                    <img src='../comunes/images/".$image."' height='17px' onmouseover=\"Tip('".$msg."')\" onmouseout='UnTip()'\">
//                                </a>";
//                }                      
//                if ($color=='R')
//                {
//                    $html.="<a>
//                                    <img src='../comunes/images/rojo.gif' height='17px' onmouseover=\"Tip('Agenda Pendiente Vencidas')\" onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblAgenda.php?id=".$data[$i]['id_agenda']."'\";\">
//                                </a>";
//                }
//                elseif ($color=='A')
//                {        
//                    $html.="<a>
//                                    <img src='../comunes/images/amarillo.gif' height='17px'  onmouseover=\"Tip('Agenda Pendiente por Vencer')\" onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblAgenda.php?id=".$data[$i]['id_agenda']."'\";\">
//                                </a>";                
//                }
//                elseif ($color=='V')
//                {
//                    $html.="<a>
//                                    <img src='../comunes/images/verde.gif' height='17px'  onmouseover=\"Tip('Agenda Pendiente')\" onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblAgenda.php?id=".$data[$i]['id_agenda']."'\";\">
//                                </a>";                   
//                }                            
//                $html.="        <a>
//                                    <img src='../comunes/images/page_edit.png' onmouseover='Tip(\"Editar Item Agenda ".$data[$i]['id_agenda']."\")' onmouseout='UnTip()' onclick=\"javascript:location.href='vista_insertTblAgenda.php?id=".$data[$i]['id_agenda']."'\";\">
//                                </a>";  
//                $html.="<a>
//                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Detalle de la Agenda')\" onmouseout='UnTip()' onclick=\"location.href='../reportes/reporte_agenda_individual.php?id=".$data[$i]['id_agenda']."'\">
//                                </a>";
//                if ($data[$i][visto]!=1)
//                 $html.="       <a>
//                                    <img src='../comunes/images/Undo.png' onmouseover='Tip(\"Marcar como no Leido Item Agenda ".$data[$i]['id_agenda']."\")' onmouseout='UnTip()' onclick=\"xajax_ActualizarItemAgenda('".$data[$i]['id_agenda']."','1','visto');\">
//                                </a>
//                                <a>
//                                    <img src='../comunes/images/table_multiple.png' onmouseover='Tip(\"Clonar Item Agenda ".$data[$i]['id_agenda']."\")' onmouseout='UnTip()' onclick=\"location.href='vista_insertTblAgenda.php?id=".$data[$i]['id_agenda']."&clon=1'\">
//                                </a>
//                                <a>
//                                    <img src='../comunes/images/vcard_delete.png' onmouseover='Tip(\"Eliminar Item Agenda ".$data[$i]['id_agenda']."\")' onmouseout='UnTip()' onclick=\"if(confirm('¿Desea Eliminar el Item de Agenda?')){xajax_ActualizarItemAgenda('".$data[$i]['id_agenda']."','1','bolborrado')};\">
//                                </a>";
//                
//                
//                 $html.="</td></tr></table>";
//            }
//            $html.= "</div>";
//        }else{
//            $html="<div class='celda_etiqueta'>No Hay Items Registrados</div>";
//        }
//        $respuesta->assign("contenedorAgenda","innerHTML",$html);
//        return $respuesta;
//    }    

    
    
?>
