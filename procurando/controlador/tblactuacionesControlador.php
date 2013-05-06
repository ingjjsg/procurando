<?php
    session_start();
    require_once '../modelo/clTblexpediente_historial_usuario.php';
    require_once '../modelo/clProAbogadosRepresentantes.php';
    require_once '../modelo/clproexpedientes_personas_demandadas.php';    
    require_once '../modelo/clproexpedientes_abogados_ejecutores.php';    
    require_once '../modelo/clproexpedientes_abogados_representantes.php';    
    require_once '../modelo/clproexpedientes_abogados_demandantes.php';    
    require_once '../modelo/clProactuacionesLitigio.php';    
    require_once '../modelo/clProActuaciones.php';
    require_once '../modelo/clProAbogadosContrarios.php';
    require_once '../modelo/clProAsociaciones.php';    
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clActuacionFases.php';    
    require_once '../modelo/clActuacionesModelo.php';//psdre
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
    verificarSessionModuloLitigio();
    
    function SumarMontos($sentenciado,$tranzado){
        $respuesta=new xajaxResponse(); 
        $functions= new functions();    
        $sentenciado=$functions->toFloat($sentenciado);        
        $tranzado=$functions->toFloat($tranzado);      
        if ((is_numeric($sentenciado))&&(is_numeric($tranzado)))
        {
            if (($sentenciado>0)&&($tranzado>0))
            {  if ($tranzado>$sentenciado)
                {
                    $respuesta->assign('inttranzado', 'value', clFunciones::FormatoMonto(0));   
                    $respuesta->alert('El Monto Tranzado No puede ser Mayor al Sentenciado');
                }
               else
                  $total=$sentenciado-$tranzado;
            }
            $respuesta->assign('intahorrado', 'value', clFunciones::FormatoMonto($total));          
            $respuesta->assign('intsentenciado', 'value', clFunciones::FormatoMonto($sentenciado));           
            $respuesta->assign('inttranzado', 'value', clFunciones::FormatoMonto($tranzado));  
        }
        else
           $respuesta->alert('Los Montos solo pueden ser Numericos');
        return $respuesta;
    }         
    
    
    function llenarSelectCenDesReporte($select="") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_cen_des'],'stritema', 2);
        $html= "<select id='id_tipo_organismo_centralizado' name='id_tipo_organismo_centralizado' style='width:50%' onchange=\"xajax_llenarSelectTipoOrganismo(document.frmOas.id_tipo_organismo_centralizado.value);\">";
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
        $respuesta->assign("capaIdTipoOrganismoCentralizado","innerHTML",$html);
        return $respuesta;
    }        
        
    
    function llenarSelectFormularioAbogadosReporte() {
        $respuesta= new xajaxResponse();
        $abogados= new clTblexpediente_historial_usuario();
        $data= "";
        $html= "";
//        $estados= clConstantesModelo::combos();
        $data= $abogados->selectAbogadosDepartamento();
        $html= "<select id='id_reasignacion_abogado' name='id_reasignacion_abogado' style='width:50%'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
//                if($_SESSION['id_contacto'] == $data[$i]['id_contacto']){
//                    continue;
//                }
                $html.= "<option value='".$data[$i]['id_contacto']."' ".$seleccionar.">".strtoupper($data[$i]['strapellido'].", ".$data[$i]['strnombre'])."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdAbogadoReasignado","innerHTML",$html);
        return $respuesta;
    }        
    
    function llenarSelectFormularioAbogadosMotivoReasignar($select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
//        exit('paso');
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_motivo_reasignacion'], 'stritema'); 
        $html= "<select id='id_motivo_reasignacion' name='id_motivo_reasignacion' style='width:".$ancho."'>";
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
        $respuesta->assign("capaIdMotivoReasignacion","innerHTML",$html);
        return $respuesta;
    }      
    
    
    function llenarSelectFormularioAbogadosReasignar() {
        $respuesta= new xajaxResponse();
        $abogados= new clTblexpediente_historial_usuario();
        $data= "";
        $html= "";
//        $estados= clConstantesModelo::combos();
        $data= $abogados->selectAbogadosDepartamento();
        $html= "<select id='id_reasignacion_abogado' name='id_reasignacion_abogado' style='width:50%'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($_SESSION['id_contacto'] == $data[$i]['id_contacto']){
                    continue;
                }
                $html.= "<option value='".$data[$i]['id_contacto']."' ".$seleccionar.">".strtoupper($data[$i]['strapellido'].", ".$data[$i]['strnombre'])."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdAbogadoReasignado","innerHTML",$html);
        return $respuesta;
    }         
    
    
    function validar_reasignacion($request){
        $respuesta = new xajaxResponse();
        $id_abogado_responsable=clActuaciones::getBuscarIdAbogadoResponsableExpediente($request['id_proactuacion']);
        if ($_SESSION['id_contacto']==$id_abogado_responsable)
        {
            if( $request['id_proactuacion'] !=""){
                $campos_validar= array(
                'Tipo de Motivo para la Reasignación'    => 'id_motivo_reasignacion',
                'Abogado a Reasignar'    => 'id_reasignacion_abogado',
                );
                $validacion=  functions::validarFormulario('frminscribir',$request,$campos_validar);
                if($validacion){
                    $respuesta->alert($validacion['msg']);
                    $respuesta->script($validacion['focus']);
                }else{
    //                exit('paso');
                    $respuesta->script("xajax_guardar_reasignacion(xajax.getFormValues('frminscribir'))");
                }
            }
        }
        else $respuesta->alert('No es el Abogado responsable del Expediente para Reasignarlo');

        
        return $respuesta;
    }        
    
    
    
    
    function guardar_reasignacion($request){
//        exit('paso');
        $respuesta= new xajaxResponse();
        $expediente= new clTblexpediente_historial_usuario();
        $expediente->llenar($request);
        $cedula=  clTblexpediente_historial_usuario::getNroCedula($request[id_reasignacion_abogado]);
        $id_nuevo_abogado=  clTblexpediente_historial_usuario::getBuscarIdAbogadoResponsable($cedula);
        $data= $expediente->updateLitigio($id_nuevo_abogado);
        if($data){
            $data= $expediente->insertar();
            $respuesta->alert("El Expediente se Reasigno Exitosamente, Imprima las Planillas antes de volver al listado, de lo contrario perdera la sesión de este expediente");            
            $respuesta->script("xajax_buscarDatosExpedientes()");   
            
        }else{
            $respuesta->alert("El Expediente no se Reasigno");
        }
        return $respuesta;
    }    
        
    
    
    
    function selectVista_abogados_casos_litigio_cargados_total() {
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
    
    function selectVista_abogados_casos_litigio_cargados() {
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
    
    function verOtrosMotivo($id){
        $respuesta=new xajaxResponse(); 
        if ($id)
        {
            $cod=clConstantesModelo::otras_motivos_litigio;
            if($id==$cod){
                $respuesta->script("$('motivo_input').show();");
            }
            else {
                     $respuesta->script("$('motivo_input').hide();");
                 }
        }
        return $respuesta;
    }     
    
    function BuscarUsuarioAbogadoResponsable(){
        $respuesta= new xajaxResponse();
        $cedula_buscada='';
        $cedula_buscada=clActuaciones::getBuscarAbogado($_SESSION['strdocumento']);
        if ($cedula_buscada!='')
        {           
            $respuesta->assign('cedula_abogado_responsable', 'value', $cedula_buscada);          
            $respuesta->assign('strnombre_abogado_responsable', 'value', clActuaciones::getBuscarAbogadoResponsable($cedula_buscada));          
            $respuesta->assign('id_abogado_resp', 'value', clActuaciones::getBuscarIdAbogadoResponsable($cedula_buscada));                      
            
       }
        else 
        {
            $respuesta->script("$('save').hide();");                
            $respuesta->alert("El Usuario no Esta Registrado como Abogado, No puede Abrir un Expedientes");  
        }
        return $respuesta;
    }     
    
    function verOtrasFases($id){
        $respuesta=new xajaxResponse(); 
        $html='';
        if ($id)
        {
            $arreglo_cod=clConstantesModelo::ComboModulosLitigioFases();
            if (array_key_exists($id, $arreglo_cod)) 
            {
                $texto=$arreglo_cod[$id];
                $html.='<td id="texto_fase" width="20%">'.$texto.':</td>';
                $respuesta->script("$('fase_input').show();");
                $respuesta->assign("texto_fase","innerHTML",$html);                
            }
            else 
            {
                $respuesta->script("$('fase_input').hide();");
            }
        }
        return $respuesta;
    }    
    
    function buscarExpedienteAuxiliar($str="",$id=""){
        $respuesta=new xajaxResponse();
//        $respuesta->alert($cedula);
        if ($id=='')
        {
            if ($str)
            {
                if (clActuaciones::getExpedienteAuxiliar($str))
                {
                  $respuesta->assign("strnroexpedienteauxiliar", "value", '');               
                  $respuesta->alert("El N° Expediente Auxiliar ya Existe");   
                }

            }            
        }
        else
        {
            if ($str)
            {
                if (clActuaciones::getExpedienteAuxiliar2($str)!=$id)
                {
                  $respuesta->assign("strnroexpedienteauxiliar", "value", '');               
                  $respuesta->alert("El N° Expediente Auxiliar ya Existe");   
                }

            }             
        }

        return $respuesta;            
    }     
    
    function llenarSelectAnexaAgenda($select="") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_anexa_agenda'],'stritema', 4);
        $html= "<select id='id_anexa_actuacion' name='id_anexa_actuacion' style='width:50%'>";
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
        $respuesta->assign("capaIdItemAnexaActuacion","innerHTML",$html);
        return $respuesta;
    }   
    
    
    function buscarRepresentante($id){
        $respuesta=new xajaxResponse();
//        $respuesta->alert($cedula);
        $representantes= new clProAbogadosRepresentantes();        
        $data=$representantes->buscarAbogRepresentantes($id);
        if(is_array($data)){
            $respuesta->assign("strnombre_abogado_organismo", "value", $data[0][strnombre]. " " . $data[0][strapellido]);
            $respuesta->assign("cedula_abogado_organismo", "value", $data[0][strcedula]);            
//            $respuesta->assign("id_contrarios", "value", $data[0][id_contrarios]);                
            $respuesta->script("$('contenedorAbogadosRepresentantesOrganismos').hide();");                     
        }
        else  $respuesta->alert("El Conyugue no Existe");   
        return $respuesta;
    }    
    
    function buscarAbogadosRepresentantesOrganismosPopup($nombre,$apellido,$cedula){
        $respuesta= new xajaxResponse();
        $representantes=new clProAbogadosRepresentantes();
        $data= "";
        $html= "";         
        $data=$representantes->SelectAllAbogadosFiltro($nombre,$apellido,$cedula);
        if($data){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE ABOGADOS REPRESENTANTES</strong>
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
                                            <img src='../comunes/images/s_success.png' onmouseover='Tip(\"Elegir Abogado\")' onmouseout='UnTip()' onclick=\"xajax_buscarRepresentante('".$data[$i]['id_abogado']."','representante')\">
                                        </a>                                   
                                </td>
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="";
            }
//        $respuesta->script("$('contenedorAbogados').show();");            
        $respuesta->assign("contenedorAbogadosRepresentantesOrganismos","innerHTML",$html);
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
    

     function llenarSelectTipoOrganismo($valor, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos($valor, 'stritema');
        $html= "<select id='id_tipo_organismo' name='id_tipo_organismo' style='width:".$ancho."' onchange=\"xajax_llenarSelectOrganismo(document.frminscribir.id_tipo_organismo.value)\">";
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


    function llenarSelectCenDes($select="") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_cen_des'],'stritema', 2);
        $html= "<select id='id_tipo_organismo_centralizado' name='id_tipo_organismo_centralizado' style='width:50%' onchange=\"xajax_llenarSelectTipoOrganismo(document.frminscribir.id_tipo_organismo_centralizado.value);\">";
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
        $respuesta->assign("capaIdTipoOrganismoCentralizado","innerHTML",$html);
        return $respuesta;
    }        
    

    function buscarContrario($id){
        $respuesta=new xajaxResponse();
//        $respuesta->alert($cedula);
        $contrarios= new clProContrarios();        
        $data=$contrarios->buscarContrario($id);
        if(is_array($data)){
            $respuesta->assign("strnombre_persona_demandada", "value", $data[0][strnombre]. " " . $data[0][strapellido]);
            $respuesta->assign("cedula_persona_demandada", "value", $data[0][strcedula]);            
            $respuesta->script("$('contenedorPersonasDemandadas').hide();");                     
        }
        else  $respuesta->alert("El Contrario no Existe");   
        return $respuesta;
    }    
    
    function buscarPersonasDemandadasPopup($nombre,$apellido,$cedula){
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
                                            <img src='../comunes/images/s_success.png' onmouseover='Tip(\"Elegir Abogado\")' onmouseout='UnTip()' onclick=\"xajax_buscarContrario('".$data[$i]['id_contrarios']."','ejecutor')\">
                                        </a>                                   
                                </td>
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="";
            }
//        $respuesta->script("$('contenedorConyugue').show();");            
        $respuesta->assign("contenedorPersonasDemandadas","innerHTML",$html);
        return $respuesta;
    }    
    function ListaPersonasDemandadas($id_expediente){
        $respuesta= new xajaxResponse();
        $expediente_contrarios= new clTblproexpediente_personas_demandadas();
        $data= "";
        $html= "";         
        $data=$expediente_contrarios->SelectListaPersonasDemandadas($id_expediente);
        if($data){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                      
                                <tr>
                                    <th width='5%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">(+)</a>
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
                                    <th width='20%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Acción</a>
                                    </th>                                         
                                </tr>";
                for ($i= 0; $i < count($data); $i++){
                    $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                <td align='center'>
                                    <img id='".$i."_mas' src='../comunes/images/b_plus.png' onmouseover='Tip(\"Elegir Abogado\")' onmouseout='UnTip()' onclick=\"$('".$i."_datos_descripcion').toggle();$('".$i."_mas').toggle();$('".$i."_menos').toggle();\">
                                    <img id='".$i."_menos' style='display:none;' src='../comunes/images/navup.png' onmouseover='Tip(\"Elegir Abogado\")' onmouseout='UnTip()' onclick=\"$('".$i."_datos_descripcion').toggle();$('".$i."_mas').toggle();$('".$i."_menos').toggle();\">
                                        
                                </td>
                                <td align='center'>".$data[$i]['strcedula']."</td>
                                <td align='center'>".$data[$i]['strnombre']."</td>
                                <td align='center'>".$data[$i]['strapellido']."</td>                                    
                                <td align='center'>
                                        <a>
                                            <input type='images' value='Eliminar' id='boton' name='boton' style='background-color:#B9D5E3;border:1px outset #B9D5E3;color:#004E7D;cursor:pointer;margin:1px;padding:1px; width:55px; font-size:11px;' onmouseover='Tip(\"Elegir Abogado\")' onmouseout='UnTip()' onclick=\"xajax_Eliminar_Abogados_Expediente('".$data[$i]['id_proexpediente_personas_demandadas']."','".$data[$i]['id_proexpediente']."','P')\">
                                       </a>                                   
                                </td>
                            </tr>";
                    $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                <td id='".$i."_datos_descripcion'  style='display:none;' colspan=\"5\" align='center'>";
                                    $scr = "../vista/vista_ingresoReferido.php?id=".$data[$i]['id_contrarios']."&id_expediente=".$data[$i]['id_proexpediente'];
                                    $html.='<iframe  width="100%" scrolling="auto" height="250" frameborder="0" src="'.$scr.'" scrolling="auto" frameborder="0" width="100%" height="600"></iframe>
                                </td>
                            </tr>';                    
                }
                $html.= "</table></div>";
            }else{
                $html="";
            }
//        $respuesta->script("$('contenedorAbogados').show();");            
        $respuesta->assign("contenedorPersonasDemandadasExpediente","innerHTML",$html);
        return $respuesta;
    }    
    
    function IngresarPersonasDemandadasExpediente($cedula,$id_expediente,$tipo){
        $respuesta= new xajaxResponse();
        if (clTblproexpediente_personas_demandadas::getBuscarNroPersonasDemandadas($id_expediente)<=clConstantesModelo::numero_maximo_contrarios)
        {
        $id_contrario=  clTblproexpediente_personas_demandadas::getBuscarPersonasDemandadas($cedula);   
        if (clTblproexpediente_personas_demandadas::getBuscarPersonaDemandadasExpediente($id_contrario,$id_expediente)=='')
        {
            if (($cedula!='') and ($id_expediente!=''))
            {
                $expediente_contrarios= new clTblproexpediente_personas_demandadas();
                if($expediente_contrarios->insertar($id_contrario,$id_expediente)){
                    $respuesta->script("xajax_ListaPersonasDemandadas('".$id_expediente."')");
                    $respuesta->script("$('contenedorPersonasDemandadasExpediente').show();"); 
                    $respuesta->script("$('id_tr_personas_demandadas').hide();");  
                    $respuesta->assign('cedula_persona_demandada', 'value', '');
                    $respuesta->assign('strnombre_persona_demandada', 'value', '');                       
                }else{
                    $respuesta->alert("El Contrario ".$tipo." no se ha guardado");
                }            
            }
            else
            $respuesta->alert("El Contrario no se ha guardado");        
            }
        else {
            $respuesta->alert("El Contrario ya Existe en el Expediente");        
            
            }
    }
    else  
        $respuesta->alert("Ya alcanzo la Cantidad Maxima de Contrarios");    
        return $respuesta;
    }        
    
    
    function Eliminar_Abogados_Expediente($id, $id_expediente, $tipo){
        $respuesta = new xajaxResponse();
        if ($tipo=='E')
        {
            $index = new clTblproexpediente_abogados_ejecutores();
            $index->delete($id, $id_expediente);       
            $respuesta->script("xajax_ListaAbogadosEjecutores('".$id_expediente."')");
            $respuesta->alert("El Abogado Ejecutor se ha Eleminado del Expediente con Exito");            
        }
        else if ($tipo=='D')
        {
            $index = new clTblproexpediente_abogados_demandantes();
            $index->delete($id, $id_expediente);
            $respuesta->script("xajax_ListaAbogadosDemandantes('".$id_expediente."')");            
            $respuesta->alert("El Abogado Demandantes se ha Eleminado del Expediente con Exito");            
        } 
        else if ($tipo=='R')
        {
            $index = new clTblproexpediente_abogados_representantes();
            $index->delete($id, $id_expediente);
            $respuesta->script("xajax_ListaAbogadosRepresentantes('".$id_expediente."')");            
            $respuesta->alert("El Abogado Responsable se ha Eleminado del Expediente con Exito");            
        }
        else if ($tipo=='P')
        {
            $index = new clTblproexpediente_personas_demandadas();
            $index->delete($id, $id_expediente);
            $respuesta->script("xajax_ListaPersonasDemandadas('".$id_expediente."')");            
            $respuesta->alert("La persona se ha Eleminado del Expediente con Exito");            
        }        
        return $respuesta;
    }       
    
    
    function ListaAbogadosRepresentantes($id_expediente){
        $respuesta= new xajaxResponse();
        $expediente_abogados= new clTblproexpediente_abogados_representantes();
        $data= "";
        $html= "";         
        $data=$expediente_abogados->SelectListaAbogadosRepresentantes($id_expediente);
        if($data){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <!--<tr>
                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE ABOGADOS EJECUTORES</strong>
                                    </div>                                
                                </td>
                            </tr>-->                               
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
                                            <input type='images' value='Eliminar' id='boton' name='boton' style='background-color:#B9D5E3;border:1px outset #B9D5E3;color:#004E7D;cursor:pointer;margin:1px;padding:1px; width:55px; font-size:11px;' onmouseover='Tip(\"Elegir Abogado\")' onmouseout='UnTip()' onclick=\"xajax_Eliminar_Abogados_Expediente('".$data[$i]['id_proexpediente_abogados_representantes']."','".$data[$i]['id_proexpediente']."','R')\">
                                        </a>                                   
                                </td>
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="";
            }
//        $respuesta->script("$('contenedorAbogados').show();");            
        $respuesta->assign("contenedorAbogadosOrganismosExpediente","innerHTML",$html);
        return $respuesta;
    }    
    
    function IngresarAbogadoRepresentantesExpediente($cedula,$id_expediente,$tipo){
        $respuesta= new xajaxResponse();
//        exit($id_expediente);
        $id_abogado=  clTblproexpediente_abogados_representantes::getBuscarAbogado($cedula);        
        if (clTblproexpediente_abogados_representantes::getBuscarAbogadoExpediente($id_abogado,$id_expediente)=='')
        {
            if (($cedula!='') and ($id_expediente!=''))
            {
                $expediente_abogados= new clTblproexpediente_abogados_representantes();
                if($expediente_abogados->insertar($id_abogado,$id_expediente)){
                    $respuesta->script("xajax_ListaAbogadosRepresentantes('".$id_expediente."')");
                    $respuesta->script("$('contenedorAbogadosOrganismosExpediente').show();"); 
                    $respuesta->script("$('id_tr_abogados_organismo').hide();");       
                    $respuesta->assign('cedula_abogado_organismo', 'value', '');
                    $respuesta->assign('strnombre_abogado_organismo', 'value', '');                            
                }else{
                    $respuesta->alert("El Abogado ".$tipo." no se ha guardado");
                }            
            }
            else
            $respuesta->alert("El Abogado ".$tipo." no se ha guardado");        
            }
        else {
            $respuesta->alert("El Abogado ".$tipo." del Organismo ya Existe en el Expediente");        
            
        }
        return $respuesta;
    }        
    
    
    function buscarAbogadosOrganismosPopup($nombre,$apellido,$cedula){
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
                                        <strong>LISTADO DE ABOGADOS </strong>
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
                                            <img src='../comunes/images/s_success.png' onmouseover='Tip(\"Elegir Abogado\")' onmouseout='UnTip()' onclick=\"xajax_buscarAbogado('".$data[$i]['id_abogado']."','representante')\">
                                        </a>                                   
                                </td>
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="";
            }
//        $respuesta->script("$('contenedorAbogados').show();");            
        $respuesta->assign("contenedorAbogadosOrganismos","innerHTML",$html);
        return $respuesta;
    }    
    
    function ListaAbogadosDemandantes($id_expediente){
//        exit($id_expediente);
        $respuesta= new xajaxResponse();
        $expediente_abogados= new clTblproexpediente_abogados_Demandantes();
        $data= "";
        $html= "";         
        $data=$expediente_abogados->SelectListaAbogadosDemandantes($id_expediente);
        if($data){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <!--<tr>
                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE ABOGADOS CONTRARIOS</strong>
                                    </div>                                
                                </td>
                            </tr>-->                               
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
                                            <input type='images' value='Eliminar' id='boton' name='boton' style='background-color:#B9D5E3;border:1px outset #B9D5E3;color:#004E7D;cursor:pointer;margin:1px;padding:1px; width:55px; font-size:11px;' onmouseover='Tip(\"Elegir Abogado\")' onmouseout='UnTip()' onclick=\"xajax_Eliminar_Abogados_Expediente('".$data[$i]['id_proexpediente_abogados_demandantes']."','".$data[$i]['id_proexpediente']."','D')\">
                                        </a> 
                                        
                                </td>
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="";
            }
//        $respuesta->script("$('contenedorAbogados').show();");            
        $respuesta->assign("contenedorAbogadosDemandantesExpediente","innerHTML",$html);
        return $respuesta;
    }     
    
    function IngresarAbogadoExpedienteDemandantes($cedula,$id_expediente,$tipo){
        $respuesta= new xajaxResponse();
        $id_abogado=  clTblproexpediente_abogados_demandantes::getBuscarAbogado($cedula);    
        if (clTblproexpediente_abogados_demandantes::getBuscarAbogadoExpediente($id_abogado,$id_expediente)=='')
        {
            if (($cedula!='') and ($id_expediente!=''))
            {
                $expediente_abogados= new clTblproexpediente_abogados_demandantes();
                if($expediente_abogados->insertar($id_abogado,$id_expediente)){
                    $respuesta->script("xajax_ListaAbogadosDemandantes('".$id_expediente."')");
                    $respuesta->script("$('contenedorAbogadosDemandantesExpediente').show();");                
                    $respuesta->script("$('id_tr_abogados_demandantes').hide();");    
                    $respuesta->assign('cedula_abogado_demandante', 'value', '');
                    $respuesta->assign('strnombre_abogado_demandante', 'value', '');                       
                }else{
                    $respuesta->alert("El Abogado ".$tipo." no se ha guardado");
                }            
            }
            else
            $respuesta->alert("El Abogado ".$tipo." no se ha guardado");        
            }
        else {
            $respuesta->alert("El Abogado ".$tipo." Ya Existe en el Expediente");        
            
        }
        return $respuesta;
    }    
        
    
    function ListaAbogadosEjecutores($id_expediente){
        $respuesta= new xajaxResponse();
        $expediente_abogados= new clTblproexpediente_abogados_ejecutores();
        $data= "";
        $html= "";         
        $data=$expediente_abogados->SelectListaAbogadosEjecutores($id_expediente);
//        print_r($data);
        if($data){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <!--<tr>
                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE ABOGADOS EJECUTORES</strong>
                                    </div>                                
                                </td>
                            </tr>-->                               
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
                                            <input type='images' value='Eliminar' id='boton' name='boton' style='background-color:#B9D5E3;border:1px outset #B9D5E3;color:#004E7D;cursor:pointer;margin:1px;padding:1px; width:55px; font-size:11px;' onmouseover='Tip(\"Elegir Abogado\")' onmouseout='UnTip()' onclick=\"xajax_Eliminar_Abogados_Expediente('".$data[$i]['id_proexpediente_abogados_ejecutores']."','".$data[$i]['id_proexpediente']."','E')\">
                                        </a>                                   
                                </td>
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="";
            }
//        $respuesta->script("$('contenedorAbogados').show();");            
        $respuesta->assign("contenedorAbogadosEjecutorExpediente","innerHTML",$html);
        return $respuesta;
    }    
    
    function IngresarAbogadoEjecutorExpediente($cedula,$id_expediente,$tipo){
        $respuesta= new xajaxResponse();
        $id_abogado=  clTblproexpediente_abogados_ejecutores::getBuscarAbogado($cedula);        
        if (clTblproexpediente_abogados_ejecutores::getBuscarAbogadoExpediente($id_abogado,$id_expediente)=='')
        {
            if (($cedula!='') and ($id_expediente!=''))
            {
                $expediente_abogados= new clTblproexpediente_abogados_ejecutores();
                if($expediente_abogados->insertar($id_abogado,$id_expediente)){
                    $respuesta->script("xajax_ListaAbogadosEjecutores('".$id_expediente."')");
                    $respuesta->script("$('contenedorAbogadosEjecutorExpediente').show();"); 
                    $respuesta->script("$('id_tr_abogados_ejecutores').hide();");  
                    $respuesta->assign('cedula_abogado_ejecutor', 'value', '');
                    $respuesta->assign('strnombre_abogado_ejecutor', 'value', '');                       
                }else{
                    $respuesta->alert("El Abogado ".$tipo." no se ha guardado");
                }            
            }
            else
            $respuesta->alert("El Abogado ".$tipo." no se ha guardado");        
            }
        else {
            $respuesta->alert("El Abogado ".$tipo." Ya Existe en el Expediente");        
            
        }
        return $respuesta;
    }    
    
    function llenarSelectTipoPestanaActuacion($select="") {
//        exit($select);
        $respuesta= new xajaxResponse();
        if ($select==clConstantesModelo::demandados){
//            $respuesta->script("$('demandados').show()");
//            $respuesta->script("$('demandantes').hide()"); 
            $respuesta->assign("div_personas_demandados_demandantes","innerHTML",'<strong>PERSONAS DEMANDANDADAS</strong>');              
            $respuesta->assign("titulo_organismo_vista","innerHTML",'<strong>INFORMACIÓN ORGANISMO DEMANDADO</strong>');  
            $respuesta->assign("sub_titulo_organismo_vista","innerHTML",'<strong>ORGANISMO DEMANDADO</strong>');              
            $respuesta->assign("div_demandados_demandantes","innerHTML",'<strong>ABOGADOS DEL DEMANDANTE </strong><img src="../comunes/images/user_suit_add.png" onmouseover="Tip(\'Nuevo Abogado\')" onmouseout="UnTip()" border="0" onclick="javascript:$(\'id_tr_abogados_demandantes\').toggle();$(\'contenedorAbogadosDemandantesExpediente\').toggle();"/>');            
            $respuesta->assign("id_actuacion_pestana", "value", clConstantesModelo::demandados);
        }
        else if ($select==clConstantesModelo::demandantes){
//            $respuesta->script("$('demandantes').show()"); 
//            $respuesta->script("$('demandados').hide()");
            $respuesta->assign("div_personas_demandados_demandantes","innerHTML",'<strong>PERSONAS DEMANDANTES</strong>');              
            $respuesta->assign("titulo_organismo_vista","innerHTML",'<strong>INFORMACIÓN ORGANISMO DEMANDANTE</strong>');            
            $respuesta->assign("sub_titulo_organismo_vista","innerHTML",'<strong>ORGANISMO DEMANDANTE</strong>');              
            $respuesta->assign("div_demandados_demandantes","innerHTML",'<strong>ABOGADOS DEL LOS DEMANDADOS </strong><img src="../comunes/images/user_suit_add.png" onmouseover="Tip(\'Nuevo Abogado\')" onmouseout="UnTip()" border="0" onclick="javascript:$(\'id_tr_abogados_demandantes\').toggle();$(\'contenedorAbogadosDemandantesExpediente\').toggle();"/>');                        
            $respuesta->assign("id_actuacion_pestana", "value", clConstantesModelo::demandantes);
        }            
//        else {
//            $respuesta->script("$('demandados').hide()");            
//            $respuesta->script("$('demandantes').hide()");   
//            $respuesta->assign("id_actuacion_pestana", "value", '');
//        }
        return $respuesta;
    }         
    
    function llenarSelectFormularioTipoEstadoMinuta($select="") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['estados_minuta'],'stritema', 2);
        $html= "<select id='id_estado_minuta' name='id_estado_minuta' style='width:50%' >";
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
    
    function selectSituacionDetalle($id_expediente_actuacion,$id_expediente){

        if (($id_expediente!=='') and ($id_expediente_actuacion!=''))
        {
            $respuesta= new xajaxResponse();
            $actuacion= new cltblproactuaciones_litigio();
            $data= "";
            $data= $actuacion->selectDetalleActuacionExpedienteLitigio($id_expediente_actuacion,$id_expediente);
            if($data){
            $respuesta->script('xajax_llenarSelectAnexaAgenda("'.$data[0]['anexa_agenda'].'")');
            $respuesta->assign("stronombreactuacion", "value", $data[0]['stronombreactuacion']);            
            $respuesta->assign("strexpedientetribunal", "value", $data[0]['strexpedientetribunal']);           
            $respuesta->assign("fecactuacion", "value", $data[0]['fecactuacion']);           
            $respuesta->assign("id_proexpediente_actuaciones", "value", $data[0]['id_litigio_actuaciones']);
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
        $data= $maestro->selectAllMaestroHijos($estados['gaveta_archivador'],'stritema', 2);
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
        $data= $maestro->selectAllMaestroHijos($estados['piso_archivador'],'stritema', 2);
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
        $data= $maestro->selectAllMaestroHijos($estados['tipo_archivador'],'stritema', 2);
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
        $data= $maestro->selectAllMaestroHijos($estados['estado_fisico_expediente'],'stritema', 2);
        $html= "<select id='id_estado_fisico_expediente' name='id_estado_fisico_expediente' style='width:50%'>";
        $html.= "<option value='0'>Seleccione</option>";
        //exit(print_r($data));
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
        $data= $maestro->selectAllMaestroHijos($estados['espacios'],'stritema', 2);
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
    $actuaciones= new cltblproactuaciones_litigio();
    $datos= "";
    $html= ""; 
    $datos= $actuaciones->selectAllActuacionesExpedienteLitigio($id_expediente);
    if($datos){
    $html.= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <!--<tr>
                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE ACTUACIONES DEL EXPEDIENTE</strong>
                                    </div>                                
                                </td>
                            </tr>   
                            -->
                            <tr>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('strrif')\">N°</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('strnombre_asociacion')\">Anexa Agenda</a>
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
                $a=$i+1;
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                    <td align='center'>".$a."</td>
                                    <td align='center' >".$datos[$i][anexa_agenda_text]."</td>
                                    <td align='center'>".$datos[$i][stronombreactuacion]."</td>                                        
                                    <td align='center' >".$datos[$i][fecactuacion]."</td>
                                    <td align='center'>
                                        <a>
                                            <img src='../comunes/images/script_go.png' onmouseover=\"Tip('Ver Texto de la Actuación')\" onmouseout='UnTip()' onclick=\"location.href='./reporteAsociacionVista.php?id=".$datos[$i][id_litigio_actuaciones]."'\">
                                        </a>";
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('actuaciones'),'editar', clConstantesModelo::acciones_actuaciones())){
                                $html.="<a>
                                           <img src='../comunes/images/script_attach.png' onmouseover=\"Tip('Editar Actuación')\" onmouseout='UnTip()' onclick=\"xajax_selectSituacionDetalle('".$datos[$i][id_litigio_actuaciones]."','".$datos[$i][id_proactuacion]."');\">
                                        </a>";
                            }
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('actuaciones'),'eliminar', clConstantesModelo::acciones_actuaciones())){
                                $html.="<a>
                                            <img src='../comunes/images/script_delete.png' onmouseover='Tip(\"Eliminar Asociacion\")' onmouseout='UnTip()'  onclick=\"if(confirm('¿Desea Eliminar Esta Actuación?')){ xajax_eliminar_actuacion('".$datos[$i][id_litigio_actuaciones]."','".$datos[$i][id_proactuacion]."');}\">
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
    $respuesta->assign("contenedorActuaciones","innerHTML",$html);
    return $respuesta;
}
    
    function editar_actuacion($request){
        $respuesta= new xajaxResponse();
        $actuacion= new cltblproactuaciones_litigio();
        $actuacion->llenar($request);
        $data= $actuacion->Update();
        if($data){
            $respuesta->alert("La Actuación del Expediente se actualizo exitosamente");
            $respuesta->script("xajax_selectAllActuaciones('".$request['id_proactuacion']."')");
            $respuesta->script("xajax_selectSituacionDetalle('".$request['id_proexpediente_actuaciones']."','".$request['id_proactuacion']."')");
            
        }else{
            $respuesta->alert("La Actuación del Expediente no se ha actualizado");
        }
        return $respuesta;
    }
    
    function eliminar_actuacion($id_litigio_actuaciones,$id_proactuacion){
        $respuesta = new xajaxResponse();
        $actuacion= new cltblproactuaciones_litigio();
        $data = $actuacion->Delete($id_litigio_actuaciones);
             if($data){
                $respuesta->alert("La Actuación se ha Eliminado con Exito");
                $respuesta->script("xajax_selectAllActuaciones('".$id_proactuacion."')");
            }else{
                $respuesta->alert("El Actuación no se ha Eliminado");
            }
        
        
        return $respuesta;
    }    

    function validar_actuacion($request){
        $respuesta = new xajaxResponse();
        if( $request['id_proexpediente_actuaciones'] !=""){
            $respuesta->script("xajax_editar_actuacion(xajax.getFormValues('frminscribir'),'".$request['id_proexpediente_actuaciones']."')");
        }else{
            $campos_validar= array(
            'Nombre de la Actuación'    => 'stronombreactuacion',
            '¿Anexa Agenda?'  => 'id_anexa_actuacion',
            'Fecha de la Actuación'    => 'fecactuacion',
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
	$actuaciones= new cltblproactuaciones_litigio();
        $actuaciones->llenar($request);
        if ($actuaciones->insertar($request['id_proactuacion'],$request['id_tipo_organismo_centralizado'],$request['id_tipo_organismo']))
        {
            $respuesta->alert("La Actuación del Expediente se inserto exitosamente");
            $respuesta->assign("id_proexpediente_actuaciones", "value", "");
            $respuesta->script('xajax_llenarSelectAnexaAgenda()');
            $respuesta->assign("id_actuacion", "value", "0");
            $respuesta->assign("stronombreactuacion", "value", "");            
            $respuesta->assign("strexpedientetribunal", "value", "");
            $respuesta->assign("fecactuacion", "value", "");            
            $respuesta->assign("strdescripcionactuacion", "value", "");            
            $respuesta->script("FCKeditorAPI.__Instances['descripcionact'].SetHTML('')"); 
            $scr = "../vista/vista_tblagenda_Litigio.php?id=" . $request['id_proactuacion'];            
            $html='<iframe  width="100%" scrolling="auto" height="800" frameborder="0" src="'.$scr.'" scrolling="auto" frameborder="0" width="100%" height="600"></iframe>';
            $respuesta->assign("capaIdTipoAgendaExpediente","innerHTML",$html);            
            $respuesta->script("xajax_selectAllActuaciones('".$request['id_proactuacion']."')"); 


            
            
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
        $data= $maestro->selectAllMaestroHijos($id_maestro,'stritema', 2);
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
        $data= $maestro->selectAllMaestroHijos($estados['actuaciones'],'stritema', 2);
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
    
    function buscarDemandantePopup($nombre="",$apellido="",$cedula="",$div=""){
        $respuesta= new xajaxResponse();
        $clientes=new clProContrarios();
        $data= "";
        $html= "";         
        $data=$clientes->SelectAllContrariosFiltro($nombre,$apellido,$cedula);
        if($data){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE DEMANDANTES</strong>
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
                                            <img src='../comunes/images/s_success.png' onmouseover='Tip(\"Elegir Abogado\")' onmouseout='UnTip()' onclick=\"xajax_buscarDemandante('".$data[$i]['id_contrarios']."','','".$div."')\">
                                        </a>                                   
                                </td>
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="";
            }
            if($div != ""){
                $respuesta->assign($div,"innerHTML",$html);
            }else{
               $respuesta->assign("contenedorAsistidos","innerHTML",$html); 
            }
//        $respuesta->script("$('contenedorAsistidos').show();");            
        
        return $respuesta;
    }
    
    function buscarAbogadoDemandantePopup($nombre,$apellido,$cedula){
        $respuesta= new xajaxResponse();
        $clientes=new clProAbogadosContrarios();
        $data= "";
        $html= "";         
        $data=$clientes->SelectAllAbogadosContrariosFiltro($nombre,$apellido,$cedula);
        if($data){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE ABOGADOS DEMANDANTES</strong>
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
                                            <img src='../comunes/images/s_success.png' onmouseover='Tip(\"Elegir Abogado\")' onmouseout='UnTip()' onclick=\"xajax_buscarAbogadoDemandante('".$data[$i]['id_abogadoscon']."','ejecutor')\">
                                        </a>                                   
                                </td>
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="";
            }
//        $respuesta->script("$('contenedorAsistidos').show();");            
        $respuesta->assign("contenedorAbogadosDemandantes","innerHTML",$html);
        return $respuesta;
    }
    
    
//    function buscarAsistidoPopup($nombre,$apellido,$cedula){
//        $respuesta= new xajaxResponse();
//        $clientes=new clProClientes();
//        $data= "";
//        $html= "";         
//        $data=$clientes->SelectAllClientesFiltro($nombre,$apellido,$cedula);
//        if($data){
//                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
//                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
//                            <tr>
//                                <td colspan=\"5\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
//                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
//                                        <strong>LISTADO DE ASISTIDOS</strong>
//                                    </div>                                
//                                </td>
//                            </tr>                               
//                                <tr>
//                                    <th width='10%'>
//                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Id</a>
//                                    </th>                                
//                                    <th width='21%'>
//                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Cédula</a>
//                                    </th>
//                                    <th width='22%'>
//                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Nombre</a>
//                                    </th>
//                                    <th width='22%'>
//                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Apellido</a>
//                                    </th>                                    
//                                    <th width='5%'>
//                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Acción</a>
//                                    </th>                                         
//                                </tr>";
//                for ($i= 0; $i < count($data); $i++){
//
//                    $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
//                                <td align='center'>".$i."</td>
//                                <td align='center'>".$data[$i]['strcedula']."</td>
//                                <td align='center'>".$data[$i]['strnombre']."</td>
//                                <td align='center'>".$data[$i]['strapellido']."</td>                                    
//                                <td align='center'>
//                                        <a>
//                                            <img src='../comunes/images/s_success.png' onmouseover='Tip(\"Elegir Abogado\")' onmouseout='UnTip()' onclick=\"xajax_buscarAsistido('".$data[$i]['id_cliente']."','ejecutor')\">
//                                        </a>                                   
//                                </td>
//                            </tr>";
//                }
//                $html.= "</table></div>";
//            }else{
//                $html="";
//            }
////        $respuesta->script("$('contenedorAsistidos').show();");            
//        $respuesta->assign("contenedorAsistidos","innerHTML",$html);
//        return $respuesta;
//    }
        
    
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
            $asistido=new clProContrarios();
            $abogado=new clProAbogados();
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_maestro')\">Expediente</a>
                                </th>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Motivo</a>
                                </th>                                
                                <th width='20'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Fase</a>
                                </th>
                                <th width='15%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">N° Tribunal</a>
                                </th>
                                <th width='15%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Responsable</a>
                                </th>
                                <th width='15%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Legitimación</a>
                                </th>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Acción</a>
                                </th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $data_asistido=$asistido->buscarContrario($data[$i]['id_solicitante']);
                if($data_asistido){
                    $nombre_asistido=$data_asistido[0]['strnombre']." ".$data_asistido[0]['strapellido'];
                }
                $data_abogado_responsable= $abogado->buscarAbogadoResponsable($data[$i][id_abogado_resp]);
                if($data_abogado_responsable){
                    $nombre_abogado_responsable=$data_abogado_responsable[0]['strnombre']." ".$data_abogado_responsable[0]['strapellido'];
                }
//             $data_abogado_ejecutor= $abogado->buscarAbogado($data[$i][id_abogado_ejecutor],"ejecutor");
//             
//             if($data_abogado_ejecutor){
//                    $nombre_abogado_ejecutor=$data_abogado_ejecutor[0]['strnombre']." ".$data_abogado_ejecutor[0]['strapellido'];
//                }
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td align='left'>".$data[$i]['strnroexpediente']."</td>
                            <td align='center' >".$data[$i]['motivo']."</td>                                    
                            <td align='center' >".$data[$i]['fase']."</td>
                            <td align='center' >".$data[$i]['strnroexpedienteauxiliar']."</td>
                            <td align='center' >".$data[$i]['nombre']."</td>                                
                            <td align='center' >".$data[$i]['actuacion']."</td>
                            <td align='right'>
                                <!--<a>
                                    <img src='../comunes/images/b_pdfdoc.png' onmouseover=\"Tip('Detalles Expediente')\" onmouseout='UnTip()' onclick=\"location.href='reporte_litigio.php?id=".$data[$i]['id_proactuacion']."'\">
                                </a>-->";
                                if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('expedientes'),'editar', clConstantesModelo::acciones_expedientes())){
                                $html.="<a>
                                    <img src='../comunes/images/Open.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"location.href='vista_Ingresolitigio.php?id=".$data[$i]['id_proactuacion']."'\">
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
    
    function selectAllExpedientesFiltro($pagina,$nro_tribunal="",$cedula_abogado_ejecutor="",$strexpediente="", $id_responsable='',$id_origen='',$id_motivo='') {
        $respuesta= new xajaxResponse();
        $clientes= new clActuaciones();
        $data= "";
        $html= ""; 
         if ($nro_tribunal!='')
            $_SESSION['nro_tribunal_reporte']=$nro_tribunal;
         if ($cedula_abogado_ejecutor!='')         
            $_SESSION['cedula_abogado_ejecutor_reporte']=$cedula_abogado_ejecutor;
         if ($strexpediente!='')         
            $_SESSION['strexpediente_reporte']=$strexpediente;
         if ($id_responsable!='')
             $_SESSION['id_responsable_reporte']=$id_responsable;
         if ($id_origen!='')
             $_SESSION['id_origen_reporte']=$id_origen;
         if ($id_motivo!='')
             $_SESSION['id_motivo_reporte']=$id_motivo;          
        $dataC= $clientes->SelectAllExpedientesFiltro($pagina);
//            exit(print_r($dataC));        
        $data= $dataC[0];        
        if($data){
            $asistido=new clProContrarios();
            $abogado=new clProAbogados();
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_maestro')\">Expediente</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Motivo</a>
                                </th>                                
                                <th width='20'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Fase</a>
                                </th>
                                <th width='15%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">N° Tribunal</a>
                                </th>
                                <th width='15%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Responsable</a>
                                </th>
                                <th width='15%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Legitimación</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Acción</a>
                                </th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                if ($data[$i][id_solicitante]!='')
                {
                    $data_asistido=$asistido->buscarContrario($data[$i][id_solicitante]);
                    if($data_asistido){
                        $nombre_asistido=$data_asistido[0]['strnombre']." ".$data_asistido[0]['strapellido'];
                    }
                }
                if ($data[$i][id_abogado_resp]!='')
                {                
                    $data_abogado_responsable= $abogado->buscarAbogResponsable($data[$i][id_abogado_resp]);
                    if($data_abogado_responsable){
                        $nombre_abogado_responsable=$data_abogado_responsable[0]['strnombre']." ".$data_abogado_responsable[0]['strapellido'];
                    }
                }
                if ($data[$i][id_abogado_ejecutor]!='')
                {                 
                    $data_abogado_ejecutor= $abogado->buscarAbogado($data[$i][id_abogado_ejecutor],"ejecutor");
                    if($data_abogado_ejecutor){
                            $nombre_abogado_ejecutor=$data_abogado_ejecutor[0]['strnombre']." ".$data_abogado_ejecutor[0]['strapellido'];
                        }
                }
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td align='left'>".$data[$i]['strnroexpediente']."</td>
                            <td align='center' >".$data[$i]['motivo']."</td>                                    
                            <td align='center' >".$data[$i]['fase']."</td>
                            <td align='center' >".$data[$i]['strnroexpedienteauxiliar']."</td>
                            <td align='center' >".$data[$i]['nombre']."</td>                                     
                            <td align='center' >".$data[$i]['actuacion']."</td>
                            <td align='right'>";
                                if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('expedientes'),'editar', clConstantesModelo::acciones_expedientes())){
                                $html.="<a>
                                    <img src='../comunes/images/Open.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"location.href='vista_Ingresolitigio.php?id=".$data[$i]['id_proactuacion']."'\">
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
   
    
   /*function llenarSelectTipoTramite($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $honorarios= new cltblprohonorariosModelo();
        $data= "";
        $html= "";
        $data= $honorarios->selectAllHonorariosCargados();
        $html= "<select id='id_motivo' name='id_motivo' style='width:".$ancho."' onchange=\"xajax_llenarSelectTipoAtencion('frminscribir','',document.".$formInput.".id_motivo.value,'');xajax_mostrarPestanaDivorcio(document.".$formInput.".id_motivo.value);xajax_verDocumentos(document.".$formInput.".id_motivo.value,0);\">";
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
    } */
    function llenarSelectTipoOrigen($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();        
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_origen'], 'stritema');      
        //$html= "<select id='id_motivo' name='id_motivo' style='width:".$ancho."' onchange=\"xajax_llenarSelectTipoAtencion('frminscribir','',document.".$formInput.".id_motivo.value,'');xajax_verDocumentos(document.".$formInput.".id_motivo.value,0);\">";
        $html= "<select id='id_origen' name='id_origen' style='width:".$ancho."' onchange=\"xajax_llenarSelectTipoMotivo('frminscribir','',document.".$formInput.".id_origen.value,'');xajax_verOtrosMotivo(document.frminscribir.id_origen.value);\">";        
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
       
        $respuesta->assign("capaIdTipoOrigen","innerHTML",$html);
        return $respuesta;
    }

    function llenarSelectTipoMotivo($formInput, $select= "", $padre="", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";;
        $data= $maestro->selectAllMaestroHijos($padre,'stritema', 4, 1);        
        $html= "<select id='id_motivo' name='id_motivo' style='width:".$ancho."'>";
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
        $respuesta->assign("capaIdTipoMotivo","innerHTML",$html);
        return $respuesta;
    }
    
    function llenarSelectTipoFaseLitigio($forminput, $select= "", $padre='', $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";;
//        $data= $maestro->selectAllMaestroHijos($padre,'stritema', 4, 2);       
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_fase'], 'stritema',4);            
        $html= "<select id='id_fase' name='id_fase' style='width:".$ancho."'  onchange=\"xajax_verOtrasFases(document.frminscribir.id_fase.value);\">";        
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
        $respuesta->assign("capaIdFaseLitigio","innerHTML",$html);
        return $respuesta;
    }    
//            $respuesta->script('xajax_llenarSelectTipoAtencion("frminscribir",' . $data[0]['id_origen'] . ')');
       /*function llenarSelectTipoAtencion($formInput, $select= "", $padre="", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $honorarios= new cltblprohonorariosModelo();
        $data= "";
        $html= "";
        $data= $honorarios->selectAllTramitesCargados($padre);
//        print_r($data);
        $html= "<select id='id_origen' name='id_origen' style='width:".$ancho."' onchange=\"xajax_verCosto(document.".$formInput.".id_origen.value)\">";
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
    }*/
    
    function llenarSelectActuacion($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['actuacion'], 'stritema');
        $html= "<select id='id_actuacion_persona' name='id_actuacion_persona' style='width:".$ancho."' onchange=\"xajax_llenarSelectTipoPestanaActuacion(document.".$formInput.".id_actuacion_persona.value)\">";
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
        $respuesta= new xajaxResponse();
        $expediente= new clActuaciones();
        $expediente->llenar($request);
//        exit("Voy");          
            $nexval = (int) $expediente->nextValExpediente();
            $data= $expediente->insertar($nexval);
            if($data){
                $id=$nexval+1;
                $respuesta->alert("El Expediente se guardo exitosamente");
                $respuesta->script('xajax_selectExpediente('.$id.')');              

            }else{
                $respuesta->alert("El Expediente no se ha guardado");
            }            
        return $respuesta;
    }
    
    function llenarNroExpediente(){
        $respuesta= new xajaxResponse();
         $respuesta->assign('strnroexpediente', 'value', 'LTG-' . date('dmY') . '-##');
         return $respuesta;
    }
    
    function validar_expediente($request){
        $respuesta = new xajaxResponse();
        if( $request['id_proactuacion'] !=""){
            $respuesta->script("xajax_editar_expediente(xajax.getFormValues('frminscribir'))");
        }else{        
        $campos_validar= array(
            'Tipo de Origen'    => 'id_motivo',
            'Tipo de Motivo'  => 'id_origen',
            'Tipo de Fase'  => 'id_fase',            
            'Monto de la Demanda'    => 'intcuantias',
            'Tipo de Legitimación'  => 'id_actuacion_persona',
            'Descripción del Expediente'  => 'strdescripcion',               
        );
        $validacion=  functions::validarFormulario('frminscribir',$request,$campos_validar);
        if($validacion){
            $respuesta->alert($validacion['msg']);
            $respuesta->script($validacion['focus']);
        }else{
            $respuesta->script("xajax_guardar_expediente(xajax.getFormValues('frminscribir'))");
        }
        }
        
        return $respuesta;
    }
    
    function buscarDemandante($id="",$tipo="",$div=""){
        $respuesta=new xajaxResponse();
        $asistido=new clProContrarios();
        if ($id!='')
        {
            $data=$asistido->buscarContrario($id);
            if(is_array($data)){
                if($div != ""){
                    $respuesta->assign("strnombre_cliente_refiere", "value", $data[0]['strnombre']. " " . $data[0]['strapellido']);         
                    $respuesta->assign("cedula_cliente_refiere", "value", $data[0]['strcedula']); 
                    $respuesta->assign("id_demandante_referido", "value", $data[0]['id_contrarios']);
                    $respuesta->script("$('contenedorAsistidosRefiere').hide();");       
                }else{
                    $respuesta->assign("strnombre_cliente", "value", $data[0]['strnombre']. " " . $data[0]['strapellido']);
                    $respuesta->assign("id_solicitante", "value", $data[0]['id_contrarios']);            
                    $respuesta->assign("cedula_cliente", "value", $data[0]['strcedula']);                    
                    $raz_social=clTblasociaciones::getNombreAsociacion_vista_cliente($data[0]['id_contrarios']);
                    if ($raz_social!='')   $respuesta->assign('raz_social', 'value', $raz_social);
                    $respuesta->script("$('contenedorAsistidos').hide();");      

                }

            }
            else  $respuesta->alert("El Demandante no Existe");  
        }
        return $respuesta;
    }
    
    function buscarAbogadoDemandante($id){
        $respuesta=new xajaxResponse();
        $asistido=new clProAbogadosContrarios();
        $data=$asistido->SelectAll($id);
        if(is_array($data)){
            $respuesta->assign("strnombre_abogado_demandante", "value", $data[0]['strnombre']. " " . $data[0]['strapellido']);
            $respuesta->assign("id_abogado_demandante", "value", $data[0]['id_abogadoscon']);            
            $respuesta->assign("cedula_abogado_demandante", "value", $data[0]['strcedula']);                    
//            $raz_social=clTblasociaciones::getNombreAsociacion_vista_cliente($data[0]['id_contrarios']);
//            if ($raz_social!='')   $respuesta->assign('raz_social', 'value', $raz_social);
//            $respuesta->script("$('contenedorAsistidos').hide();");            
        }
        
        else  $respuesta->alert("El Abogado no Existe");   
        $respuesta->script("$('contenedorAbogadosDemandantes').hide();");
        return $respuesta;
    }
    
//    function buscarAsistido($id){
//        $respuesta=new xajaxResponse();
//        $asistido=new clProClientes();
//        $data=$asistido->buscarAsistido($id);
//        if(is_array($data)){
//            $respuesta->assign("strnombre_cliente", "value", $data[0]['strnombre']. " " . $data[0]['strapellido']);
//            $respuesta->assign("id_solicitante", "value", $data[0]['id_cliente']);            
//            $respuesta->assign("cedula_cliente", "value", $data[0]['strcedula']);                    
//            $raz_social=clTblasociaciones::getNombreAsociacion_vista_cliente($data[0]['id_cliente']);
//            if ($raz_social!='')   $respuesta->assign('raz_social', 'value', $raz_social);
//            $respuesta->script("$('contenedorAsistidos').hide();");            
//        }
//        else  $respuesta->alert("El Asistido no Existe");   
//        return $respuesta;
//    }
    
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
                $respuesta->script("$('contenedorAbogados').hide();");                
            }
            else if ($abogado=="representante"){
                $respuesta->assign("strnombre_abogado_organismo", "value", $data[0]['strnombre']. " " . $data[0]['strapellido']);
                $respuesta->assign("cedula_abogado_organismo", "value", $data[0]['strcedula']);         
                $respuesta->assign("id_abogado_representante", "value", $data[0]['id_abogado']);      
                $respuesta->script("$('contenedorAbogadosOrganismos').hide();");                  
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
        if($data[0]['id_demandante'] != ''){
            $data_demandante=$expediente->selectDemandante($data[0]['id_demandante']);
            $respuesta->assign('id_demandante','value',$data_demandante[0]['lngcodigo']);
//            $respuesta->assign('cedula_demandante','value',$data_demandante[0]['cedula']);
//            $respuesta->assign('strnombre_demandante','value',$data_demandante[0]['nombres']);
//            $respuesta->assign('telefono_demandante','value',$data_demandante[0]['telefono']);
//            $respuesta->assign('direccion_demandante','value',$data_demandante[0]['direccion']);
//            $respuesta->assign('tiempo_servicio_demandante','value',$data_demandante[0]['tiempo_servicio']);
//            $respuesta->assign('fecingreso_demandante','value',$data_demandante[0]['fecingreso']);
//            $respuesta->assign('fecegreso_demandante','value',$data_demandante[0]['fecegreso']);
//            $respuesta->assign('motivo_culminacion_demandante','value',$data_demandante[0]['motivo_culminacion_laboral']);
//            if($data_demandante[0]['cancelo_adelanto_prestaciones']){
//                $respuesta->assign('cancelo_prestaciones_demandante','checked',TRUE);
//                $respuesta->script('jQuery("#campos_prestaciones_demandante").animate({opacity: "toggle"})');
//                $respuesta->assign('concepto_prestaciones_demandante','value',$data_demandante[0]['concepto']);
//                $respuesta->assign('monto_prestaciones_demandante','value',$data_demandante[0]['monto']);
//            }
            
        }
        $respuesta->script("$('saveReasignar').show();");                
        $respuesta->script('xajax_llenarSelectFormularioAbogadosMotivoReasignar()');    
        $respuesta->script('xajax_llenarSelectFormularioAbogadosReasignar()');
        $respuesta->assign('id_proactuacion', 'value', $data[0]['id_proactuacion']);
            $scr = "../vista/vista_uploadDocumento.php?id=" . $data[0]['id_proactuacion'];            
            $html='<iframe  width="100%" scrolling="auto" height="800" frameborder="0" src="'.$scr.'" scrolling="auto" frameborder="0" width="100%" height="600"></iframe>';
            $respuesta->assign("capaIdTipoDocumentoExpediente","innerHTML",$html);              
        $respuesta->assign('strnroexpediente', 'value', $data[0]['strnroexpediente']);
        $respuesta->assign('id_abogado_resp', 'value', $data[0]['id_abogado_resp']);
        $respuesta->assign('id_cliente', 'value', $data[0]['id_cliente']);
        $respuesta->assign("capaIdActuacion","innerHTML",'<select id="id_actuacion_persona" name="id_actuacion_persona" style=\'width:50%\'><option value="'.$data[0]['id_actuacion'].'">'.$data[0]['actuacion'].'</option></select>');  
        
        if ($data[0][strnroexpediente]!='')
        {
            $campos_desactivar= array('id_motivo','strrefer','fecexpediente','fecapertura','strnroexpediente','feccierre','cedula_cliente','strnombre_cliente');
            $js=  functions::desactivarCampos('frminscribir',$campos_desactivar);
            if($js!=""){
                $respuesta->script($js);
            }
        }
        if ($data[0][id_actuacion]==clConstantesModelo::demandados){
//            $respuesta->script("$('demandados').show()");
//            $respuesta->script("$('demandantes').hide()");
            $respuesta->assign("div_personas_demandados_demandantes","innerHTML",'<strong>PERSONAS DEMANDANTES</strong><img src="../comunes/images/user_suit_add.png" onmouseover="Tip(\'Nuevo Persona\')" onmouseout="UnTip()" border="0" onclick="javascript:$(\'contenedorPersonasDemandadas\').hide();$(\'id_tr_personas_demandadas\').toggle();$(\'contenedorPersonasDemandadasExpediente\').toggle();"/>');                           
            $respuesta->assign("titulo_organismo_vista","innerHTML",'<strong>INFORMACIÓN ORGANISMO DEMANDADO</strong>');  
            $respuesta->assign("sub_titulo_organismo_vista","innerHTML",'<strong>ORGANISMO DEMANDADO</strong>');              
            $respuesta->assign("div_demandados_demandantes","innerHTML",'<strong>ABOGADOS DEL DEMANDANTE </strong><img src="../comunes/images/user_suit_add.png" onmouseover="Tip(\'Nuevo Abogado\')" onmouseout="UnTip()" border="0" onclick="javascript:$(\'contenedorAbogadosDemandantes\').hide();$(\'id_tr_abogados_demandantes\').toggle();$(\'contenedorAbogadosDemandantesExpediente\').toggle();"/>');            
            $respuesta->assign("id_actuacion_pestana", "value", clConstantesModelo::demandados);
        }
        else if ($data[0][id_actuacion]==clConstantesModelo::demandantes){
//            $respuesta->script("$('demandantes').show()"); 
//            $respuesta->script("$('demandados').hide()");
            $respuesta->assign("div_personas_demandados_demandantes","innerHTML",'<strong>PERSONAS DEMANDANDAS</strong><img src="../comunes/images/user_suit_add.png" onmouseover="Tip(\'Nuevo Persona\')" onmouseout="UnTip()" border="0" onclick="javascript:$(\'contenedorPersonasDemandadas\').hide();$(\'id_tr_personas_demandadas\').toggle();$(\'contenedorPersonasDemandadasExpediente\').toggle();"/>');              
            $respuesta->assign("titulo_organismo_vista","innerHTML",'<strong>INFORMACIÓN ORGANISMO DEMANDANTE</strong>');            
            $respuesta->assign("sub_titulo_organismo_vista","innerHTML",'<strong>ORGANISMO DEMANDANTE</strong>');              
            $respuesta->assign("div_demandados_demandantes","innerHTML",'<strong>ABOGADOS DEL LOS DEMANDADOS </strong><img src="../comunes/images/user_suit_add.png" onmouseover="Tip(\'Nuevo Abogado\')" onmouseout="UnTip()" border="0" onclick="javascript:$(\'contenedorAbogadosDemandantes\').hide();$(\'id_tr_abogados_demandantes\').toggle();$(\'contenedorAbogadosDemandantesExpediente\').toggle();"/>');                        
            $respuesta->assign("id_actuacion_pestana", "value", clConstantesModelo::demandantes);
        }      
        
        $respuesta->script('xajax_ListaPersonasDemandadas(' . $data[0][id_proactuacion] . ')');         
        $respuesta->script('xajax_ListaAbogadosDemandantes(' . $data[0][id_proactuacion] . ')'); 
        $respuesta->script('xajax_ListaAbogadosEjecutores(' . $data[0][id_proactuacion] . ')');   
        $respuesta->script('xajax_ListaAbogadosRepresentantes(' . $data[0][id_proactuacion] . ')');
        
        $respuesta->script("$('contenedorPersonasDemandadasExpediente').show();");            
        $respuesta->script("$('contenedorAbogadosEjecutorExpediente').show();");                
        $respuesta->script("$('contenedorAbogadosDemandantesExpediente').show();");                 
        $respuesta->script("$('contenedorAbogadosOrganismosExpediente').show();");        
        
        $respuesta->script('xajax_buscarDatosReferidos(' . $data[0][id_proactuacion] . ')');
        $respuesta->script('xajax_llenarSelectTipoOrigen("frminscribir",' . $data[0][id_origen] . ')');
        $respuesta->script('xajax_llenarSelectTipoMotivo("frminscribir",' . $data[0][id_motivo] . ',' . $data[0][id_origen] . ')');
        $respuesta->script('xajax_llenarSelectTipoFaseLitigio("frminscribir",' . $data[0][id_fase] . ',' . $data[0][id_origen] . ')');        
//        $respuesta->script('xajax_llenarSelectActuacion("frminscribir",' . $data[0][id_actuacion] . ')'); 
        $respuesta->script("xajax_verDocumentos('".$data[0][id_motivo]."','".$data[0][strdocumentos]."')");
        $respuesta->assign('cedula_cliente', 'value', $data[0][cedula_cliente]);
        $respuesta->assign('intcuantias', 'value', clFunciones::FormatoMonto($data[0][intcuantias]));
        $respuesta->assign('intsentenciado', 'value', clFunciones::FormatoMonto($data[0][intsentenciado]));
        $respuesta->assign('inttranzado', 'value', clFunciones::FormatoMonto($data[0][inttranzado]));
        $respuesta->assign('intahorrado', 'value', clFunciones::FormatoMonto($data[0][intahorrado]));        
        $respuesta->assign('strdescripcion', 'value', $data[0][strdescripcion]);  
        $respuesta->assign('strobservacion_cerrar', 'value', $data[0][strobservacion_cerrar]);      
        $respuesta->assign('strnroexpedienteauxiliar', 'value', $data[0][strnroexpedienteauxiliar]); 
        if($data[0][strrepresentante] == 1){
            $respuesta->assign('strrepresentante', 'checked',true);
        }      

        $arreglo_cod=clConstantesModelo::ComboModulosLitigioFases();
        if (array_key_exists($data[0][id_fase], $arreglo_cod)) 
        {
            $texto=$arreglo_cod[$data[0][id_fase]];
            $html_texto='<td id="texto_fase" width="20%">'.$texto.':</td>';
            $respuesta->script("$('fase_input').show();");
            $respuesta->assign("texto_fase","innerHTML",$html_texto); 
            $respuesta->assign('otrafase', 'value', $data[0][otrafase]);                 
        }

//        if($data[0][id_fase] == clConstantesModelo::otras_fases_litigio){
//            $respuesta->assign('otrafase', 'value', $data[0][otrafase]); 
//            $respuesta->script("$('fase_input').show();");        
//        } 
        if($data[0][id_origen] == clConstantesModelo::otras_motivos_litigio){
            $respuesta->assign('otromotivo', 'value', $data[0][otromotivo]); 
            $respuesta->script("$('motivo_input').show();");        
        }         
        $respuesta->script('xajax_llenarSelectFormularioTipoEspacio(' . $data[0][id_tipo_espacio] . ')'); 
        $respuesta->script('xajax_llenarSelectFormularioTipoEstadoFisicoExp(' . $data[0][id_estado_fisico_expediente] . ')');   
        $respuesta->script('xajax_llenarSelectFormularioTipoArchivadorExp(' . $data[0][id_tipo_archivador] . ')');     
        $respuesta->script('xajax_llenarSelectFormularioPisoArchivadorExp(' . $data[0][id_tipo_piso_archivador] . ')');         
        $respuesta->script('xajax_llenarSelectFormularioGavetaArchivadorExp(' . $data[0][id_tipo_archivador_gaveta] . ')');                 
//        $respuesta->script('xajax_buscarFases('. $data[0][id_proactuacion] .')');
//        $respuesta->script('xajax_llenarSelectTipoDivorcio("frminscribir",' . $data[0][id_refer] . ')');        
        $respuesta->script('xajax_llenarSelectCenDes(' . $data[0][id_tipo_organismo_centralizado] . ')');
        $respuesta->script('xajax_llenarSelectTipoOrganismo('.$data[0][id_tipo_organismo_centralizado].',' . $data[0][id_tipo_organismo] . ')');
        $respuesta->script('xajax_llenarSelectOrganismo('.$data[0][id_tipo_organismo].',' . $data[0][id_organismo] . ')');
//        $respuesta->script('xajax_llenarSelectTipoMinuta("frminscribir")');
//        $respuesta->script('xajax_llenarSelectFormularioTipoEstadoMinuta()');        
        $respuesta->script('xajax_llenarSelectFormularioTipoActuacion()');
//        $respuesta->script('xajax_llenarSelectTipoFase("frminscribir")');        
//        $respuesta->script('xajax_buscarAbogadoResponsable(' . $data[0][id_abogado_resp] . ')');
//        $respuesta->script('xajax_verCountExpediente(' . $data[0][cedula_cliente] . ')');     
        $respuesta->script('xajax_buscarDemandante(' . $data[0][id_contrario] . ')');
//        $respuesta->script('xajax_buscarConyugue(' . $data[0][id_contrarios] . ')');    
//        $respuesta->script('xajax_buscarAbogado(' . $data[0][id_abogado_ejecutor] . ',"ejecutor")');
//         $respuesta->script('xajax_buscarAbogadoDemandante(' . $data[0][id_abogado_demandante] . ')');

        
        $respuesta->script('xajax_llenarSelectAnexaAgenda()');
        $respuesta->script("$('contenedorActuaciones').show();");    
        $respuesta->script('xajax_selectAllActuaciones(' . $data[0][id_proactuacion] . ')');
        
        
        
        
        
//        $respuesta->script('xajax_buscarDatosSituaciones(' . $data[0][id_proactuacion] . ')');
        //exit("ssssssssssss");
//        $respuesta->script("xajax_mostrarPestanaDivorcio(".$data[0][id_motivo].")");
//        $respuesta->assign('fecapertura', 'value', $data[0][fecapertura]);
//        $respuesta->assign('feccierre', 'value', $data[0][feccierre]);
//        $respuesta->assign('strrefer', 'value', $data[0][strrefer]);
//        $respuesta->assign('fecexpediente', 'value', $data[0][fecexpediente]);
//        $respuesta->assign('strletrado', 'value', $data[0][strletrado]);        
        $respuesta->assign('cedula_abogado_responsable', 'value', clActuaciones::getBuscarCedulaAbogadoResponsable($data[0]['id_abogado_resp']));
        $respuesta->assign('strnombre_abogado_responsable', 'value', clActuaciones::getBuscarNombreAbogadoResponsable($data[0]['id_abogado_resp']));        
//        $respuesta->assign('cedula_abogado_ejecutor', 'value', $data[0][cedula_abogado_ejecutor]);
//        $respuesta->assign('fecadmdem', 'value', $data[0][fecadmdem]);
//        $respuesta->assign('fecnotdem', 'value', $data[0][fecnotdem]);
//        $respuesta->assign('fecultnotordtri', 'value', $data[0][fecultnotordtri]);
//        $respuesta->assign('fecinsaudpre', 'value', $data[0][fecinsaudpre]);
//        $respuesta->assign('fecculfaspre', 'value', $data[0][fecculfaspre]);
//        $respuesta->assign('feccondem', 'value', $data[0][feccondem]);
//        $respuesta->assign('fecadmpru', 'value', $data[0][fecadmpru]);
//        $respuesta->assign('fecjuiorapub', 'value', $data[0][fecjuiorapub]);
//        $respuesta->assign('fecpubsen', 'value', $data[0][fecpubsen]);
//        $respuesta->assign('fecapelacion', 'value', $data[0][fecapelacion]);
     
//        if ($data[0][strobservacion_cerrar]!='') 
//        {
//            $respuesta->script("$('id_cerrar').show();");
//            $respuesta->script("$('id_observacion_cerrar').show();");
////            $respuesta->script("$('id_observacion_cerrar_button').show();");
//        }
//             
        $respuesta->script("FCKeditorAPI.__Instances['descripcion'].SetHTML('".$data[0][strdescripcion]."')");
//        $respuesta->script("FCKeditorAPI.__Instances['letrado'].SetHTML('".$data[0][strletrado]."')");        
        $respuesta->script("$('saveSituacion').show();");        
        $respuesta->script("$('saveFase').show();");                
        $respuesta->script("$('saveActuacion').show();");              
        $respuesta->script("$('cerrar').show();");        
        $respuesta->script("$('link1').show();");       
        $respuesta->script("$('link2').show();");       
        $respuesta->script("$('tr_intsentenciado').show();");        
        $respuesta->script("$('tr_inttranzado').show();");       
        $respuesta->script("$('tr_intahorrado').show();");              
//        $respuesta->script("$('link3').show();");       
//        $respuesta->script("$('link4').show();");       
        $respuesta->script("$('link5').show();");       
        $respuesta->script("$('link6').show();");               
//        $respuesta->script("$('link7').show();");       
        $respuesta->script("$('link8').show();");       
        $respuesta->script("$('link10').show();");     
        if($_SESSION['id_contacto'] !=$data[0][id_usuario]) {
            $respuesta->script("xajax_desactivarCampos()");
            $respuesta->script("$('save').hide();");
            $respuesta->script("$('saveSituacion').hide();"); 
            $respuesta->script("$('saveFase').hide();");          
            $respuesta->script("$('saveActuacion').hide();");            
            $respuesta->script("$('cerrar').hide();");            
        }             
//        $respuesta->script("$('link9').show();");        
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
//            exit('paso');            
//            $data_demandante= $cliente->actualizarDemandante();
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
            'id_motivo',
            'id_origen',
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
        //exit($id_expediente);
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
        //exit($html);
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

    function validar_referido($request){
        $respuesta = new xajaxResponse();
        if( $request['id_demandante_referido'] !=""){
            $respuesta->script("xajax_editar_referido(xajax.getFormValues('frminscribir'),'".$request['id_demandante_referido']."')");
        }else{
            $campos_validar= array(
            'Cedula Demandante Refiere'    => 'cedula_cliente_refiere',
            'Nombre Demandante Refiere'    => 'strnombre_cliente_refiere',
            'Tiempo de Servicio Demandante Refiere'  => 'tiempo_servicio_demandante_refiere',
            'Fecha de Ingreso Demandante Refiere'    => 'fecingreso_demandante_refiere',
            'Fecha de Egreso Demandante Refiere' => 'fecegreso_demandante_refiere',
            'Motivo de Culminacion Laboral' => 'motivo_culminacion_demandante_refiere',                
            );
            $validacion=  functions::validarFormulario('frminscribir',$request,$campos_validar);
            if($validacion){
                $respuesta->alert($validacion['msg']);
                $respuesta->script($validacion['focus']);
            }else{
                $respuesta->script("xajax_guardar_referido(xajax.getFormValues('frminscribir'))");
            }
        }
        return $respuesta;
    }
    
    function guardar_referido($request){
        $respuesta= new xajaxResponse();
        $expediente= new clActuaciones();
        $expediente->llenar($request);
        if (!clActuaciones::getCedulaRefiere($this->get_strdocumentos(),$request['id_proexpediente']))
        {    
            $data= $expediente->insertarDemandanteReferido();
            if($data){
                $respuesta->alert("El Referido se ha guardado");
                $respuesta->script("xajax_buscarDatosReferidos('".$request['id_proexpediente']."')");
            }else{
                $respuesta->alert("El Referido no se ha guardado");
            }
        }
        else $respuesta->alert("El Referido ya Existe en el Expediente");
        return $respuesta;
    }

    function buscarDatosReferidos($id_expediente=""){
        //exit($id_expediente);
        $respuesta= new xajaxResponse();
            //$clientes= new clProActuacionSituaciones();
            $expediente= new clActuaciones();
            //$fecie=$expediente->getExpedFecie($id_expediente);
            $data= "";
            $html= ""; 
            $data= $expediente->selectDemandanteReferido($id_expediente);
            if($data){
                $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                            <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <td colspan=\"6\" align=\"right\" style=\"color:white; border:#CCCCCC solid 0px;\" bgcolor=\"#273785\" >
                                    <div align=\"center\" style=\"background-image: url('../comunes/images/barra.png')\">
                                        <strong>LISTADO DE REFERIDOS DEL EXPEDIENTE</strong>
                                    </div>                                
                                </td>
                            </tr>                                  
                                <tr>
                                    <th width='10%'>
                                        <a href='#' onclick=\"xajax_orden('id_maestro')\">Id</a>
                                    </th>
                                    <th width='20%'>
                                        <a href='#' onclick=\"xajax_orden('id_origen')\">Cedula</a>
                                    </th>
                                    <th width='35%'>
                                        <a href='#' onclick=\"xajax_orden('stritema')\">Nombres</a>
                                    </th>
                                    <th width='15%'>
                                        <a href='#' onclick=\"xajax_orden('stritema')\">Fecha Ingreso</a>
                                    </th>                                    
                                    <th width='10%'>
                                        <a href='#' onclick=\"xajax_orden('stritema')\">Fecha Egreso</a>
                                    </th>                                
                                    <th width='10%'>
                                        <a href='#' onclick=\"xajax_orden('stritemb')\">Accion</a>
                                    </th>
                                </tr>";
                for ($i= 0; $i < count($data); $i++){

                    $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                                <td align='center'>".  $data[$i]['lngcodigo']."</td>
                                <td align='center'>".  $data[$i]['cedula']."</td>
                                <td align='left' >".$data[$i]['nombres']."</td>
                                <td align='left' >".  $data[$i]['fecingreso']."</td>                                    
                                <td align='center' >".$data[$i]['fecegreso']."</td>                                
                                <td>                                        <a><img src='../comunes/images/table_edit.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"xajax_selectDemandanteReferido('".$data[$i]['id_expediente']."','".$data[$i]['lngcodigo']."')\"></a>
                                        <a><img src='../comunes/images/table_delete.png' onmouseover='Tip(\"Eliminar\")' onmouseout='UnTip()' onclick=\"eliminar_referido('".$data[$i]['lngcodigo']."','".$data[$i]['id_expediente']."')\"></a>
                                
                                
                                </td>
                            </tr>";
                }
                $html.= "</table></div>";
            }else{
                $html="<div class='celda_etiqueta'>No Hay Referidos Registrados</div>";
            }
       
        //exit($html);
        $respuesta->assign("contenedorReferidos","innerHTML",$html);
        $respuesta->script("$('#contenedorReferidos').fadeIn()");
        return $respuesta;
    }
    
    function selectDemandanteReferido($id_expediente,$id_demandante){
        $respuesta= new xajaxResponse();
        $expediente= new clActuaciones();
        $data= $expediente->selectDemandanteReferido($id_expediente,$id_demandante);
        if($data){
            $respuesta->assign("cedula_cliente_refiere","value",$data[0]['cedula']);
            $respuesta->assign("strnombre_cliente_refiere","value",$data[0]['nombres']);
            $respuesta->assign("tiempo_servicio_demandante_refiere","value",$data[0]['tiempo_servicio']);
            $respuesta->assign("fecingreso_demandante_refiere","value",$data[0]['fecingreso']);
            $respuesta->assign("fecegreso_demandante_refiere","value",$data[0]['fecegreso']);
            $respuesta->assign('motivo_culminacion_demandante_refiere','value',$data[0]['motivo_culminacion_laboral']);
            $respuesta->assign('id_demandante_referido','value',$data[0]['lngcodigo']);
            if($data[0]['cancelo_adelanto_prestaciones']){
                $respuesta->assign('cancelo_prestaciones_demandante_refiere','checked',TRUE);
                $respuesta->script('jQuery("#campos_prestaciones_demandante_refiere").animate({opacity: "toggle"})');
                $respuesta->assign('concepto_prestaciones_demandante_refiere','value',$data[0]['concepto']);
                $respuesta->assign('monto_prestaciones_demandante_refiere','value',$data[0]['monto']);
            }
            $respuesta->assign('monto_demanda_demandante_refiere','value',$data[0]['monto_demanda']);
        }
        return $respuesta;
    }
    
    function eliminar_referido($id_demandante,$id_expediente){
        $respuesta= new xajaxResponse();
        $expediente= new clActuaciones();
        $data= $expediente->eliminarDemandanteReferido($id_demandante);
        if($data){
             $respuesta->alert('El Referido se Ha Eliminado exitosamente');
             $respuesta->script("xajax_buscarDatosReferidos('".$id_expediente."')");
        }else{
            $respuesta->alert('El Referido no se Ha Eliminado');
        }
        return $respuesta;
    }
    
    function editar_referido($request,$id_demandante){
        $respuesta= new xajaxResponse();
        $cliente= new clActuaciones();
        $cliente->llenar($request);
        $data= $cliente->actualizarDemandanteReferido($id_demandante);
        if($data){
            $respuesta->alert("El Referido se actualizo exitosamente");
            $respuesta->script("xajax_buscarDatosReferidos('".$request['id_proexpediente']."')");
        }else{
            $respuesta->alert("El Referido no se ha actualizado");
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
            $respuesta->script("xajax_buscarDatosSituaciones('".$request['id_proexpediente']."')");
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
           $respuesta->assign("id_proactuacion_situacion", "value", $data[0][id_proactuacion_situacion]);
           
        }
        return $respuesta;
    }
    
    function buscarAbogadoResponsable($id){
        $respuesta=new xajaxResponse();
        $asistido=new clProAbogados();
        $data=$asistido->buscarAbogResponsable($id);
        if(is_array($data)){
            $respuesta->assign("strnombre_abogado_responsable", "value", $data[0]['strnombre']. " " . $data[0]['strapellido']);
            $respuesta->assign("id_abogado_resp", "value", $data[0]['id_contacto']);            
            $respuesta->assign("cedula_abogado_responsable", "value", $data[0]['strcedula']);                    
//            $raz_social=clTblasociaciones::getNombreAsociacion_vista_cliente($data[0]['id_contrarios']);
//            if ($raz_social!='')   $respuesta->assign('raz_social', 'value', $raz_social);
//            $respuesta->script("$('contenedorAsistidos').hide();");            
        }
        
        else  $respuesta->alert("El Abogado no Existe");
        return $respuesta;
    }
    
?>
