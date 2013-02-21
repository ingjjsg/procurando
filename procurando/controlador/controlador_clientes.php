<?php
require_once '../modelo/clProClientes.php';
require_once '../comunes/php/utilidades.php';
require_once '../modelo/clConstantesModelo.php';
require_once '../modelo/clMaestroModelo.php';
require_once '../modelo/clPermisoModelo.php';

    function BuscarCedulaRepetida($str=""){
        $respuesta=new xajaxResponse();
        if ($str)
        {
            if (is_numeric($str))
            {
                if (clProClientes::getBuscarAbogadoCedulaRepetido($str))
                {
                $respuesta->assign("strcedula", "value", '');               
                $respuesta->alert("El N° de Cedula Ya existe");   
                }
            }
            else {
                $respuesta->alert("El N° de Cedula Tiene que ser Numerico");   
                $respuesta->assign("strcedula", "value", '');               
                
            }
        }
        return $respuesta;            
    }  

    function buscar_cedula_cliente($cedula,$id)
    {
	if ($id=='')
	{
		$respuesta= new xajaxResponse();
		$data= clProClientes::getCedulaCliente($cedula);
		if($data) $respuesta->alert("Cedula ya Existe");
		return $respuesta;
	}
    }

function buscarDatosClientes(){
        $respuesta= new xajaxResponse();
        $clientes= new clProClientes();
        $data= "";
        $html= ""; 
        $data= $clientes->SelectAll();
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_maestro')\">Id</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Cedula</a>
                                </th>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Apellido</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Accion</a>
                                </th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td align='center'>".$data[$i]['id_cliente']."</td>
                            <td align='center' >".$data[$i]['strcedula']."</td>
                            <td>".$data[$i]['strnombre']."</td>
                            <td>".$data[$i]['strapellido']."</td>
                            <td>
                                <a>
                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Detalles Clientes')\" onmouseout='UnTip()' onclick=\"location.href='reporte_clientes.php?id=".$data[$i]['id_cliente']."'\">
                                </a>";
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('clientes'),'editar', clConstantesModelo::acciones_clientes())){
                                $html.="<a>
                                    <img src='../comunes/images/table_edit.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"location.href='vista_nuevo_cliente.php?id=".$data[$i]['id_cliente']."'\">
                                </a>";
                            }
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('clientes'),'eliminar', clConstantesModelo::acciones_clientes())){
                              $html.="<a>
                                    <img src='../comunes/images/table_delete.png' onmouseover='Tip(\"Eliminar\")' onmouseout='UnTip()' onclick=\"eliminar_cliente('".$data[$i]['id_cliente']."')\">
                                </a>";
                            }
                            $html.="</td>
                        </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Clientes Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        return $respuesta;
    }
    
    function selectAllClientesFiltro($nombre="",$apellido="",$cedula="") {
        $respuesta= new xajaxResponse();
        $clientes= new clProClientes();
        $data= "";
        $html= ""; 
        $data= $clientes->selectAllClientesFiltro($nombre,$apellido,$cedula);
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table style='text-align:center' border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_maestro')\">Id</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Cedula</a>
                                </th>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Apellido</a>
                                </th>
                                <th width='30%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Accion</a>
                                </th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td align='center'>".$data[$i]['id_cliente']."</td>
                            <td align='center' >".$data[$i]['strcedula']."</td>
                            <td>".$data[$i]['strnombre']."</td>
                            <td>".$data[$i]['strapellido']."</td>
                            <td>
                                <a>
                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Detalles Clientes')\" onmouseout='UnTip()' onclick=\"xajax_selectAllMaestroHijos('".$data[$i]['id_maestro']."', '".$data[$i]['stritema']."')\">
                                </a>";
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('clientes'),'editar', clConstantesModelo::acciones_clientes())){
                                $html.="<a>
                                    <img src='../comunes/images/table_edit.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"location.href='vista_nuevo_cliente.php?id=".$data[$i]['id_cliente']."'\">
                                </a>";
                            }
                            if(clPermisoModelo::getVerificar_Accion(clConstantesModelo::getFormulario('clientes'),'eliminar', clConstantesModelo::acciones_clientes())){
                              $html.="<a>
                                    <img src='../comunes/images/table_delete.png' onmouseover='Tip(\"Eliminar\")' onmouseout='UnTip()' onclick=\"eliminar_cliente('".$data[$i]['id_cliente']."')\">
                                </a>";
                            }
                            $html.="</td>
                        </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Clientes Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        return $respuesta;
    
    }
    
    
    
    function llenarSelectEstados($formInput, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['estados'], 'stritema');
        $html= "<select id='id_estado' name='id_estado' style='width:".$ancho."' onchange=\"xajax_llenarSelectMunicipio(document.".$formInput.".id_estado.value)\">";
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
        $respuesta->assign("capaEstado","innerHTML",$html);
        return $respuesta;
    }
    
    function llenarSelectMunicipio($valor, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";;
        $data= $maestro->selectAllMaestroHijos($valor, 'stritema');
        $html= "<select id='id_municipio' name='id_municipio' style='width:".$ancho."' onchange=\"xajax_llenarSelectMunicipio(document.".$formInput.".id_estado.value)\">";
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
        $respuesta->assign("capaMunicipio","innerHTML",$html);
        return $respuesta;
    }
    
    function llenarSelectEstadoCivil($select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $combo= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($combo['estado_civil'], 'stritema');
        $html= "<select id='id_estado_civil' name='id_estado_civil' style='width:".$ancho."' \">";
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
        $respuesta->assign("capaEstadoCivil","innerHTML",$html);
        return $respuesta;
    }
    
    function llenarSelectSexo($select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $combo= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($combo['sexo'], 'stritema');
        $html= "<select id='id_sexo' name='id_sexo' style='width:".$ancho."' \">";
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
        $respuesta->assign("capaSexo","innerHTML",$html);
        return $respuesta;
    }
    
    function guardar_cliente($request){
        $respuesta= new xajaxResponse();
        $cliente= new clProClientes();
        $cliente->llenar($request);
        if ($cliente->get_id_cliente()=='')
        {
            $data= $cliente->insertar();
            $id=$cliente->nextValCliente();
            if($data){
                $respuesta->script('xajax_selectCliente('.$id.')');
                $respuesta->alert("El Solicitante se inserto exitosamente");
            }else{
                $respuesta->alert("El Solicitante no se ha guardado");
            }            
        }
        else {
            $data= $cliente->Update();
            if($data){
                $respuesta->script('xajax_selectCliente('.$cliente->get_id_cliente().')');
                $respuesta->alert("El Solicitante se Actualizo exitosamente");
            }else{
                $respuesta->alert("El Solicitante no se ha guardado");
            }    
        }
        return $respuesta;
    }
    
    function selectCliente($lngcodigo){
        $respuesta= new xajaxResponse();
        $clientes= new clProClientes();
        $data= "";
        $html= ""; 
        $data= $clientes->SelectAll($lngcodigo);
        if($data){
            $respuesta->assign('id_cliente', 'value', $data[0]['id_cliente']);
            $respuesta->assign('strnombre', 'value', $data[0]['strnombre']);
            $respuesta->assign('strapellido', 'value', $data[0]['strapellido']);
            $respuesta->assign('strcedula', 'value', $data[0]['strcedula']);
            $respuesta->script('xajax_llenarSelectEstados("frmcliente_nuevo",'.$data[0]['id_estado'].')');
            $respuesta->script('xajax_llenarSelectMunicipio('.$data[0]['id_estado'].','.$data[0]['id_municipio'].')');
            $respuesta->assign('strdireccion', 'value', $data[0]['strdireccion']);
            $respuesta->assign('strtelefono', 'value', $data[0]['strtelefono']);
            $respuesta->assign('stremail', 'value', $data[0]['stremail']);
            $respuesta->script('xajax_llenarSelectEstadoCivil('.$data[0]['id_estado_civil'].')');
            $respuesta->script('xajax_llenarSelectSexo('.$data[0]['id_sexo'].')');
            $respuesta->assign('inthijos', 'value', $data[0]['inthijos']);
            $respuesta->assign('strcodigopostal', 'value', $data[0]['strcodigopostal']);
            $respuesta->assign('datefecnac', 'value', $data[0]['datefecnac']);
            $respuesta->assign('strobservacion', 'value', $data[0]['strobservacion']);
            /*if($data[0]['id_representante'] == 1){
                $respuesta->assign('id_representante', 'checked',true);
            }
            
            $respuesta->assign('id_organizacion', 'value', $data[0]['id_organizacion']);
            $respuesta->assign('strdocumentoconst', 'value', $data[0]['strdocumentoconst']);
            $respuesta->assign('strrif', 'value', $data[0]['strrif']);
            $respuesta->assign('strmovil', 'value', $data[0]['strmovil']);*/
            
        }
        return $respuesta;
    }
    
    function editar_cliente($request){
        $respuesta= new xajaxResponse();
        $cliente= new clProClientes();
        $cliente->llenar($request);
        $data= $cliente->Update();
        if($data){
            $respuesta->alert("El Solicitante se actualizo exitosamente");
        }else{
            $respuesta->alert("El Solicitante no se ha actualizado");
        }
        return $respuesta;
    }
    
    function eliminar_cliente($id_cliente){
        $respuesta = new xajaxResponse();
        $cliente = new clProClientes();
        if(clProClientes::getCedulaClienteExpediente($id_cliente)=='')
        {
            $data = $cliente->Delete($id_cliente);
             if($data){
                $respuesta->alert("El Solicitante se ha Eliminado");
                $respuesta->script("xajax_buscarDatosClientes()");
            }else{
                $respuesta->alert("El Solicitante no se ha Eliminado");
            }
        }
        else {
                $respuesta->alert("El Solicitante posee Expediente no se puede Eliminar");
        }
        
        
        return $respuesta;
    }
    
    function validar_cliente($request){
        $respuesta = new xajaxResponse();
        if($request['strnombre'] == ""){
            $respuesta->alert("Ingrese un Nombre");
            $respuesta->script("document.frmcliente_nuevo.strnombre.focus()");
        }else if($request['strapellido'] == ""){
            $respuesta->alert("Ingrese un Apellido");
            $respuesta->script("document.frmcliente_nuevo.strapellido.focus()");
        }else if($request['strcedula'] == ""){
             $respuesta->alert("Ingrese una Cedula");
             $respuesta->script("document.frmcliente_nuevo.strcedula.focus()");
        }else if($request['strdireccion'] == ""){
             $respuesta->alert("Ingrese una Direccion");
             $respuesta->script("document.frmcliente_nuevo.strdireccion.focus()");
        }else{
           
            $respuesta->script("xajax_guardar_cliente(xajax.getFormValues('frmcliente_nuevo'))");
        }
        
        return $respuesta;
    }
?>
