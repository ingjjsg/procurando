<?php
    session_start();
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clAsignarModelo.php';
    function llenarSelectFormularioSistemas() {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data =$maestro->selectAllSistemas('id_maestro');
//        print_r($data);
        $html= "<select id='id_sistemas' name='id_sistemas' style='width:90%' onchange=\"xajax_llenarSelectFormulario(document.frmAsignar.id_sistemas.value);xajax_verAcciones(0,0)\">";
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
    
    
    
    function llenarSelectFormulario($id_sistemas="") {
            $respuesta= new xajaxResponse();
            $maestro= new clMaestroModelo();
            $data= "";
            $html= "";
            $data= $maestro->selectAllMaestroHijos(291, 'id_maestro', $id_sistemas);
            $html= "<select id='id_menu_maestro' name='id_menu_maestro' style='width:90%' onchange=\"xajax_verAcciones(document.frmAsignar.id_menu_maestro.value, document.frmAsignar.id_profile_maestro.value)\">";
            $html.= "<option value='0'>Seleccione</option>";
            if($data){
                for ($i= 0; $i < count($data); $i++){
                    $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
                }
                $html.= "</select>";
            }
            $respuesta->assign("capaFormulario","innerHTML",$html);
            return $respuesta;
    }    
    

    function verAcciones($id_menu_maestro, $id_profile_maestro) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $asignar= new clAsignarModelo();
        $data= "";
        $html= "";
        if($id_menu_maestro != 0){
            $data= $maestro->selectAllMaestroHijos($id_menu_maestro, 'id_maestro');
            $dataAcc= $asignar->selectAsignar($id_profile_maestro, $id_menu_maestro);
            if($dataAcc){
                $respuesta->script("document.frmAsignar.id_accesoforma.value= ".$dataAcc[0]['id_accesoforma']);
                $respuesta->script("document.frmAsignar.accion.value= 'ACT'");
                $straccion= split(",", $dataAcc[0]['stracciones']);
            }else{
                $respuesta->script("document.frmAsignar.accion.value= 'INS'");
            }
            $html= "<table class='tablaTitulo' bgcolor='#f8f8f8' width='90%'>";
            $html.= "<tr><th width='85%'><label id='laccion'>Permisos</label></th>";
            $html.= "<th width='15%'>Agregar</th></tr>";
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
                    $html.= "<td width='15%' align='center'><input type='checkbox' name='acc".$data[$i]['id_maestro']."' id='acc".$data[$i]['id_maestro']."' value='".$data[$i]['id_maestro']."' ".$checked."></td><tr>";
                }
                $html.= "</table>";
            }
        }
        $respuesta->assign("capaAcciones","innerHTML",$html);
        return $respuesta;
    }
    function insertAsignar($formulario) {
        $respuesta= new xajaxResponse();
        $asignar= new clAsignarModelo();
        $asignar->llenar($formulario);
        $asignar->insertAsignar();
        $respuesta->script("alert('Los permisos fueron asignados al perfil con exito');");
        $respuesta->script("location.href='perfilesVista.php'");
		return $respuesta;
    }
    function updateAsignar($formulario) {
        $respuesta= new xajaxResponse();
        $asignar= new clAsignarModelo();
        $asignar->llenar($formulario);
        $asignar->updateAsignar();
        $respuesta->script("alert('Los permisos fueron actualizado al perfil con exito');");
        $respuesta->script("location.href='perfilesVista.php'");
		return $respuesta;
    }
    function deleteAsignar($id_accesoforma) {
        $respuesta= new xajaxResponse();
        $asignar= new clAsignarModelo();
        $asignar->deleteAsignar($id_accesoforma);
        $respuesta->script("alert('Los permisos fueron eliminados al perfil con exito');");
        $respuesta->script("location.href='perfilesVista.php'");
		return $respuesta;
    }
    
?>
