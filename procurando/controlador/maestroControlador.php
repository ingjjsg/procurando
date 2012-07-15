<?php
    session_start();
    require_once '../modelo/clMaestroModelo.php';
    require_once '../comunes/php/utilidades.php';

    verificarSession();
    
    function selectAllMaestroPadresLike($input, $campo= 'id_maestro', $id_sistemas=0){
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= ""; 
        if($input!='')
            $data= $maestro->selectAllMaestroPadresLike($input,$campo,$id_sistemas);
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_maestro')\">Id</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Padre</a>
                                </th>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Descripci&oacute;n A</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('lngnumero')\">Sistema</a>
                                </th>                                
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('lngnumero')\">N&uacute;mero</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('sngcant')\">Monto/Cant</a>
                                </th>
                                <th width='10%'>Acci&oacute;n</th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td align='center'>".$data[$i]['id_maestro']."</td>
                            <td align='center' >".$data[$i]['id_origen']."</td>
                            <td>".$data[$i]['stritema']."</td>
                            <td>".$data[$i]['stritemb']."</td>                                  
                            <td>".$data[$i][sistema]."</td>
                            <td align='right'>".$data[$i]['lngnumero']."</td>
                            <td align='right'>".$data[$i]['sngcant']."</td>
                            <td align='center'>";
                            if ($data[$i][hijo]>0)
                            $html.="<a>
                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Ver Hijos')\" onmouseout='UnTip()' onclick=\"xajax_selectAllMaestroHijos('".$data[$i]['id_maestro']."', '".$data[$i]['stritema']."')\">
                                </a>";
                            $html.="<a>
                                    <img src='../comunes/images/table_edit.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"xajax_formMaestro('UPD','".$data[$i]['id_maestro']."-".$data[$i]['stritema']."-".$data[$i]['stritemb']."-".$data[$i]['stritemc']."-".$data[$i]['lngnumero']."-".$data[$i]['sngcant']."')\">
                                </a>
                                <a>
                                    <img src='../comunes/images/table_delete.png' onmouseover='Tip(\"Eliminar\")' onmouseout='UnTip()' onclick=\"eliminarMaestro('".$data[$i]['id_maestro']."')\">
                                </a>
                            </td>
                        </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Maestros Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        return $respuesta;
    }
    

    function insertMaestroCombos($request) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        if ($request[accion]=='I')
        {
            $maestro->insertMaestroCombos($request[stritema_nuevo],$request[id_origen],$request[id_sistema_origen]);
            $respuesta->alert('Item Nuevo Incluido con Exito');        
            $respuesta->script("llenarSelectComboMaestroPadresIdProcurando(".$request[id_origen].",".$request[id_sistema_origen].",2)");
        }
        elseif ($request[accion]=='M')
        {
            $maestro->updateMaestroCombo($request[id_maestro_origen],$request[stritema]);
            $respuesta->alert('Item Modificado Incluido con Exito');        
            $respuesta->script("llenarSelectComboMaestroPadresIdProcurando(".$request[id_origen].",".$request[id_sistema_origen].",2)");
        }
        elseif ($request[accion]=='E')
        {
            $maestro->deleteMaestro($request[id_maestro_origen]);
            $respuesta->alert('Item Eliminado con Exito');        
            $respuesta->script("llenarSelectComboMaestroPadresIdProcurando(".$request[id_origen].",".$request[id_sistema_origen].",2)");
        }        
        else $respuesta->alert('Item No Incluido');    
	return $respuesta;
    }   
    
    function VerHijos($id_maestro,$id_sistema) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data="";
        $data =$maestro->selectMaestroOrigenByIdProcurando($id_maestro,$id_sistema);
        if ($data){
            $respuesta->assign("stritema", "value", '');                
            $respuesta->assign("id_maestro_origen", "value", '');                    
            $respuesta->assign("id_origen", "value", '');       
            $respuesta->assign("id_sistema_origen", "value", '');                   
            $respuesta->script("$('accion_id_hijo').hide();");                             
            $respuesta->script("xajax_llenarSelectComboMaestroPadresIdProcurando(".$id_maestro.",".$id_sistema.",2)"); 
        }
        else
        {
            $respuesta->script("$('stritema').show();");  
            $datos= "";
            $datos =$maestro->selectMaestroPadreById($id_maestro);
            if ($datos)
            {
                $respuesta->assign("stritema", "value",$datos[0][stritema]);
                $respuesta->assign("id_maestro_origen", "value",$datos[0][id_maestro]);       
                $respuesta->assign("id_origen", "value",$datos[0][id_origen]);         
                $respuesta->assign("id_sistema_origen", "value",$datos[0][id_sistema]);                         
                $respuesta->script("$('stritema').show();"); 
                $respuesta->script("$('accion_id_hijo_nuevo').show();");                  
                $respuesta->script("$('accion_id_hijo_modificar').show();");   
                $respuesta->script("$('accion_id_hijo_eliminar').show();");                   
            }             
        }
        return $respuesta;
    }     
 
    
    
    function llenarSelectComboMaestroPadresIdProcurando($id_maestro,$id_sistema,$item=0) {
//        exit($id_maestro."---".$id_sistema);
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data =$maestro->selectMaestroOrigenByIdProcurando($id_maestro,$id_sistema);
        if ($item==0)       
            $caja_texto='id_hijos';
        else
            $caja_texto='id_hijos2';            
        $html= "<select id='".$caja_texto."' name='".$caja_texto."' style='width:50%' onchange=\"xajax_VerHijos(document.frmMaestro.".$caja_texto.".value,".$id_sistema.");\">";   
        $html.= "<option value='0'>Seleccione</option>";
        if (is_array($data)){
            for ($i= 0; $i < count($data); $i++){
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        if ($item==0){        
            $respuesta->assign("capaHijosMaestroCombo","innerHTML",$html);
            $respuesta->script("$('titulo').hide();");            
            $respuesta->script("$('capaHijosMaestroCombo2').hide();");
            $respuesta->assign("stritema", "value", '');                
            $respuesta->assign("id_maestro_origen", "value", '');                    
            $respuesta->assign("id_origen", "value", '');       
            $respuesta->assign("id_sistema_origen", "value", '');               
        }
        else{
            $respuesta->assign("capaHijosMaestroCombo2","innerHTML",$html);    
            $respuesta->script("$('titulo').show();");            
            $respuesta->script("$('capaHijosMaestroCombo2').show();");  
            $respuesta->script("$('stritema').show();");  
            } 
        return $respuesta;
    }    
    
    
    function llenarSelectComboMaestroProcurando($id_maestro) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data =$maestro->selectMaestroPadreByIdProcurandoLike(clConstantesModelo::maestro_combos,$id_maestro);
        $html= "<select id='id_maestro' name='id_maestro' style='width:50%' onchange=\"xajax_llenarSelectComboMaestroPadresIdProcurando(document.frmMaestro.id_maestro.value,".$id_maestro.");\">";
        $html.= "<option value='0'>Seleccione</option>";
        if (is_array($data)){
            for ($i= 0; $i < count($data); $i++){
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
            $respuesta->assign("stritema", "value", '');                
            $respuesta->assign("id_maestro_origen", "value", '');                    
            $respuesta->assign("id_origen", "value", '');       
            $respuesta->assign("id_sistema_origen", "value", '');                   
//        $respuesta->script("xajax_llenarSelectComboMaestroPadresIdProcurando('','','')");         
        $respuesta->assign("capaMaestroCombos","innerHTML",$html);
        return $respuesta;
    }    

    function llenarSelectFormularioSistemasCombos() {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data =$maestro->selectAllSistemas('id_maestro');
//        print_r($data);
        $html= "<select id='id_sistema' name='id_sistema' style='width:50%' onchange=\"xajax_llenarSelectComboMaestroProcurando(document.frmMaestro.id_sistema.value);\">";
        $html.= "<option value='0'>Seleccione</option>";
        if (is_array($data)){
            for ($i= 0; $i < count($data); $i++){
                $html.= "<option value='".$data[$i]['id_sistema']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
            $respuesta->assign("stritema", "value", '');                
            $respuesta->assign("id_maestro_origen", "value", '');                    
            $respuesta->assign("id_origen", "value", '');       
            $respuesta->assign("id_sistema_origen", "value", '');                
//        $respuesta->script("xajax_llenarSelectComboMaestroProcurando('')");  
//        $respuesta->script("xajax_llenarSelectComboMaestroPadresIdProcurando('','','')");                 
        $respuesta->assign("capaFormulario2","innerHTML",$html);
        return $respuesta;
    }     
    
    function llenarSelectFormularioSistemas() {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data =$maestro->selectAllSistemas('id_maestro');
//        print_r($data);
        $html= "<select id='id_sistema' name='id_sistemas' style='width:50%' onchange=\"xajax_selectAllMaestroPadres('id_maestro',document.frmcontacto.id_sistemas.value);\">";
        $html.= "<option value='0'>Seleccione</option>";
        if (is_array($data)){
            for ($i= 0; $i < count($data); $i++){
                $html.= "<option value='".$data[$i]['id_sistema']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaFormulario2","innerHTML",$html);
        return $respuesta;
    }    

    function selectAllMaestroPadres($campo= 'id_maestro', $id_sistemas=""){
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= ""; 
        $data= $maestro->selectAllMaestroPadres($campo,$id_sistemas);
        if($data&&$id_sistemas){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_maestro')\">Id</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen')\">Padre</a>
                                </th>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('stritema')\">Nombre</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb')\">Descripci&oacute;n A</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('lngnumero')\">Sistema</a>
                                </th>                                  
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('lngnumero')\">N&uacute;mero</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('sngcant')\">Monto/Cant</a>
                                </th>
                                <th width='10%'>Acci&oacute;n</th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td align='center'>".$data[$i]['id_maestro']."</td>
                            <td align='center' >".$data[$i]['id_origen']."</td>
                            <td>".$data[$i]['stritema']."</td>
                            <td>".$data[$i]['stritemb']."</td>
                            <td>".$data[$i][sistema]."</td>                                
                            <td align='right'>".$data[$i]['lngnumero']."</td>
                            <td align='right'>".$data[$i]['sngcant']."</td>
                            <td align='center'>";
                            if ($data[$i][hijo]>0)
                            $html.="<a>
                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Ver Hijos')\" onmouseout='UnTip()' onclick=\"xajax_selectAllMaestroHijos('".$data[$i]['id_maestro']."', '".$data[$i]['stritema']."')\">
                                </a>";
                            $html.="<a>
                                    <img src='../comunes/images/table_edit.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"xajax_formMaestro('UPD','".$data[$i]['id_maestro']."-".$data[$i]['stritema']."-".$data[$i]['stritemb']."-".$data[$i]['stritemc']."-".$data[$i]['lngnumero']."-".$data[$i]['sngcant']."')\">
                                </a>
                                <a>
                                    <img src='../comunes/images/table_delete.png' onmouseover='Tip(\"Eliminar\")' onmouseout='UnTip()' onclick=\"eliminarMaestro('".$data[$i]['id_maestro']."')\">
                                </a>
                            </td>
                        </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Maestros Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        return $respuesta;
    }
    function selectAllMaestroHijos($padre, $nombrePadre, $campo= 'id_maestro', $acc=''){
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos($padre, $campo);
        $respuesta->script("document.frmcontacto.id_origen.value='".$padre."'");
        $respuesta->script("cap = document.getElementById('capaVolver');cap.style.visibility='visible';cap.style.display='inline';");
        if($acc != 'INS' && $acc != 'ACT'){
            $respuesta->assign("capaMaestro","innerHTML",$nombrePadre."(Cod: ".$padre.")");
        }
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=\"xajax_orden('id_maestro', ".$padre.", '".$nombrePadre."')\">Id</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_origen', ".$padre.", '".$nombrePadre."')\">Padre</a>
                                </th>
                                <th width='25%'>
                                    <a href='#' onclick=\"xajax_orden('stritema', ".$padre.", '".$nombrePadre."')\">Nombre</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('stritemb', ".$padre.", '".$nombrePadre."')\">Descripci&oacute;n A</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('lngnumero')\">Sistema</a>
                                </th>                                  

                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('lngnumero', ".$padre.", '".$nombrePadre."')\">N&uacute;mero</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('sngcant', ".$padre.", '".$nombrePadre."')\">Monto/Cant</a>
                                </th>
                                <th width='10%'>Acci&oacute;n</th>
                            </tr>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\">
                            <td align='center'>".$data[$i]['id_maestro']."</td>
                            <td align='center' >".$data[$i]['id_origen']."</td>
                            <td>".$data[$i]['stritema']."</td>
                            <td>".$data[$i]['stritemb']."</td>
                            <td>".$data[$i][sistema]."</td>                                
                            <td align='right'>".$data[$i]['lngnumero']."</td>
                            <td align='right'>".$data[$i]['sngcant']."</td>
                            <td align='center'>";
                            if ($data[$i][hijo]>0)
                            $html.="<a>
                                    <img src='../comunes/images/ver.gif' onmouseover=\"Tip('Ver Hijos')\" onmouseout='UnTip()' onclick=\"xajax_selectAllMaestroHijos('".$data[$i]['id_maestro']."', '".$data[$i]['stritema']."')\">
                                </a>";
                            $html.="<a>
                                    <img src='../comunes/images/table_edit.png' onmouseover='Tip(\"Editar\")' onmouseout='UnTip()' onclick=\"xajax_formMaestro('UPD','".$data[$i]['id_maestro']."-".$data[$i]['stritema']."-".$data[$i]['stritemb']."-".$data[$i]['stritemc']."-".$data[$i]['lngnumero']."-".$data[$i]['sngcant']."')\">
                                </a>
                                <a>
                                    <img src='../comunes/images/table_delete.png' onmouseover='Tip(\"Eliminar\")' onmouseout='UnTip()' onclick=\"eliminarMaestro('".$data[$i]['id_maestro']."')\">
                                </a>
                            </td>
                        </tr>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Maestros Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        return $respuesta;
    }
    function formMaestro($acc, $data=""){        
        $respuesta= new xajaxResponse();
        $numero= uniqid();
        $data= split("-", $data);
		$html = "<div id='div_".$numero."'>
                    <input type='hidden' name='capa' id='capa' value='div_".$numero."'>
                    <table class='tablaTitulo' bgcolor='#f8f8f8' width='100%'>
                        <tr>
                            <th width='20%'><label id='lnombre'>Nombre</label></th>
                            <th width='20%'><label id='ldescA'>Descripci&oacute;n A</label></th>
                            <th width='20%'><label id='ldescB'>Descripci&oacute;n B</label></th>
                            <th width='12%'><label id='lnumero'>Numero</label></th>
                            <th width='12%'><label id='lmonto'>Monto/Cant</label></th>
                            <th width='7%'></th>
                        </tr>
                        <tr>
                            <td width='20%' align='center'>
                                <input type='text' value='' name='stritema' id='stritema' size='19' class='inputbox82' maxlength='100' style='width:100%'>
                            </td>
                            <td width='20%' align='center'>
                                <input type='text' value='' name='stritemb' id='stritemb' class='inputbox82' maxlength='100' style='width:100%'>
                            </td>
                            <td width='20%' align='center'>
                                <input type='text' value='' name='stritemc' id='stritemc' class='inputbox82' maxlength='50' style='width:100%'>
                            </td>
                            <td width='12%' align='center'>
                                <input type='text' value='' name='lngnumero' id='lngnumero' size='8' class='inputbox82' onKeyPress='return acceptNum(event)' style='width:100%'>
                            </td>
                            <td width='12%' align='center'>
                                <input type='text' value='' name='sngcant' id='sngcant' size='8' class='inputbox82' onkeypress='return NumCheck(event, this)' onblur='formatearDecimal(4, this)' style='width:100%'>
                            </td>
                            <td width='7%' align='center'>
                                <a>
                                    <img src='../comunes/images/16_save.gif' onmouseover='Tip(\"Guardar\")' onmouseout='UnTip()' onclick=\"validar('".$acc."');\" >
                                </a>
                                <a>
                                    <img src='../comunes/images/arrow_undo.png' onmouseover='Tip(\"Ocultar\")' onmouseout='UnTip()' onclick=\"ocultar2('div_".$numero."')\" >
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>";
        
        $respuesta->assign("formulario","innerHTML",$html);
        $respuesta->script("document.frmcontacto.id_maestro.value='".$data[0]."'");
        $respuesta->script("document.frmcontacto.stritema.value='".$data[1]."'");
        $respuesta->script("document.frmcontacto.stritemb.value='".$data[2]."'");
        $respuesta->script("document.frmcontacto.stritemc.value='".$data[3]."'");
        $respuesta->script("document.frmcontacto.lngnumero.value=".$data[4]."");
        $respuesta->script("document.frmcontacto.sngcant.value=".$data[5]."");
        return $respuesta;
	}
    function insertMaestro($formulario) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $maestro->llenar($formulario);
        $maestro->insertMaestro();
        $respuesta->script("ocultar('".$formulario['capa']."', '¡El maestro se ha guardado exitosamente!')");
        if($formulario['id_origen'] == 0){
            $respuesta->script("xajax_selectAllMaestroPadres()");
        }else{
            $respuesta->script("xajax_selectAllMaestroHijos('".$formulario['id_origen']."', '".$formulario['stritema']."', 'id_maestro', 'INS')");
        }
		return $respuesta;
    }
    function deleteMaestro($id_maestro, $formulario) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $maestro->deleteMaestro($id_maestro);
        $respuesta->script("ocultar('".$formulario['capa']."', '¡El maestro se ha eliminado exitosamente!')");
        if($formulario['id_origen'] == 0){
            $respuesta->script("xajax_selectAllMaestroPadres()");
        }else{
            $respuesta->script("xajax_selectAllMaestroHijos('".$formulario['id_origen']."', '".$formulario['stritema']."', 'id_maestro', 'ACT')");
        }
		return $respuesta;
    }
    function updateMaestro($formulario) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $maestro->llenar($formulario);
        $maestro->updateMaestro();
        $respuesta->script("ocultar('".$formulario['capa']."', '¡El maestro se ha actualizado exitosamente!')");
        if($formulario['id_origen'] == 0){
            $respuesta->script("xajax_selectAllMaestroPadres('".$formulario['stritema']."')");
        }else{
            $respuesta->script("xajax_selectAllMaestroHijos('".$formulario['id_origen']."', '".$formulario['stritema']."', 'id_maestro', 'ACT')");
        }
		return $respuesta;
    }
    function orden($campo, $padre= 0, $nombrePadre= "") {
        $respuesta= new xajaxResponse();
        if($_SESSION["AD"] == 'ASC'){
            $_SESSION["AD"]= 'DESC';
        }else{
            $_SESSION["AD"]= 'ASC';
        }
         if($padre == 0){
            $respuesta->script("xajax_selectAllMaestroPadres('".$campo."')");
        }else{
           $respuesta->script("xajax_selectAllMaestroHijos('".$padre."', '".$nombrePadre."', '".$campo."')");
        }
        
        return $respuesta;
    }
?>
