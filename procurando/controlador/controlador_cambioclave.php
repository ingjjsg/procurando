<?php
    session_start();
    require_once '../modelo/cl_tblpersona_.php';
    require_once '../modelo/clFunciones.php';

function GuardarSeguridad($request) {
        $respuesta= new xajaxResponse();
        $persona= new clTblpersona();
        $persona->llenar($request);
       
        $strclave=$request ['strclave'];
        $strreclave=$request ['strreclave'];
        if (clTblpersona::verificarClave($request ['strclaveanterior']))
        {
//             exit('Hola aqui voy');
            // Verificación de clave
            if ($strclave == $strreclave){
                $lngcodigo= $persona->ActualizarUsuario($_SESSION['id_contacto']);
            }
            $respuesta->alert("¡Sus requerimeintos se han Procesado con Exito!");
            $respuesta->assign("strreclave","value","");
            $respuesta->assign("strclave","value","");
            $respuesta->assign("strclaveanterior","value","");
            $respuesta->script("location.href='vista_cambioclave.php?id='".$lngcodigo."&accion=4874");
        }
        else
            $respuesta->alert("Clave Equivocada, intentelo de nuevo");
        return $respuesta;
}

  function DetalleBuscaDatos(){
        $respuesta= new xajaxResponse();
        if ($_SESSION['id_contacto']!='')
        {
            $persona= new clTblpersona();
            $data=$persona->selectDetalleUsuario($_SESSION['id_contacto']);
            $respuesta->assign("strnombre","value",$data[0]['strnombre']);
            $respuesta->assign("strapellido","value",$data[0]['strapellido']);
            $respuesta->assign("strtelefono","value",$data[0]['strtelefono']);
            $respuesta->assign("strtelefono","value",$data[0]['strtlfhab']);
            $respuesta->assign("stremail","value",$data[0]['stremail']);
        }
        return $respuesta;
  }





function DetalleBuscaCorreo($correo_nuevo){
        $respuesta= new xajaxResponse();
        $persona= new clTblpersona();
        $correo_id_contacto=$persona->buscaCorreo($correo_nuevo);
        if ($correo_id_contacto!="")
        {
            if ($correo_id_contacto!=$_SESSION['id_contacto'])
            {
                $respuesta->alert('Correo ya fue Asignado a otro Usuario');
                $respuesta->assign("stremail","value","");
            }
        }
        return $respuesta;

    }



    ?>