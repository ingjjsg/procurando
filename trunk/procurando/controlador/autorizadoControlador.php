<?php
    session_start();
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clEstadoModelo.php';
    require_once '../modelo/clAutorizadoModelo.php';
    require_once '../comunes/php/utilidades.php';

    verificarSession();

    function llenarSelectModelos($campo= 'id_maestro') {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos(207, $campo);
        $html= "<select id='id_meestados_maestros' name='id_meestados_maestros' style='width:90%' onchange=\"xajax_verEstados(document.frmautorizar.id_meestados_maestros.value, document.frmautorizar.id_perfil_maestro.value)\">";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaMeestados","innerHTML",$html);
        return $respuesta;
    }
    function verEstados($id_meestados_maestros, $id_perfil_maestro) {
        $respuesta= new xajaxResponse();
        $estados= new clEstadoModelo();
        $autorizado= new clAutorizadoModelo();
        $data= "";
        $html= "";
        if($id_meestados_maestros != 0){
            $data= $estados->selectAllEstadosByMeestados($id_meestados_maestros);
            $dataEstado= $autorizado->selectAllAutorizadoById_perfil($id_perfil_maestro);
            $respuesta->script("document.frmautorizar.accion.value= 'INS'");
            $html= "<table class='tablaTitulo' bgcolor='#f8f8f8' width='100%'>";
            $html.= "<tr><th width='85%'><label id='laccion'>Estados</label></th>";
            $html.= "<th width='15%'>Agregar</th></tr>";
            if($data){
                for ($i= 0; $i < count($data); $i++){
                    $html.= "<tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\">";
                    $html.= "<td width='85%'>".$data[$i]['nombre_estinicial_maestro']." - ".$data[$i]['nombre_estfinal_maestro']."</td>";
                    $checked= "";
                    for ($x= 0; $x < count($dataEstado); $x++){
                        if($dataEstado[$x]['id_estados'] == $data[$i]['id_estados']){
                            $checked= "checked";
                        }
                    }
                    $html.= "<td width='15%' align='center'><input type='checkbox' name='acc".$data[$i]['id_estados']."' id='acc".$data[$i]['id_estados']."' value='".$data[$i]['id_estados']."' ".$checked."></td><tr>";
                }
                $html.= "</table>";
            }
        }
        $respuesta->assign("capaestados","innerHTML",$html);
        return $respuesta;
    }
    function insertAutorizado($formulario) {
        $respuesta= new xajaxResponse();
        $autorizado= new clAutorizadoModelo();
        $estados= new clEstadoModelo();
        
        $autorizado->llenar($formulario);
        $idestados= split(",", $formulario['strestados']);
        $dataEstados= $estados->selectAllEstadosByIdEstados($idestados[0]);
        $autorizado->deleteAutorizado($dataEstados[0]['id_meestados_maestros']);

        for($i= 0; $i < count($idestados)-1; $i++){
            $autorizado->setId_estados($idestados[$i]);
            $autorizado->insertAutorizado();
        }
        $respuesta->script("alert('Los estados fueron asignados al perfil con exito');");
        $respuesta->script("location.href='perfilesVista.php'");
		return $respuesta;
    }
?>
