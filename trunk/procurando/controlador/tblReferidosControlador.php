<?php
    session_start();
    
    require_once '../modelo/clReferidosExpedientes.php';
    require_once '../comunes/php/utilidades.php';
    require_once '../modelo/clConstantesModelo.php';
    require_once '../herramientas/herramientas.class.php';
    require_once '../modelo/clMaestroModelo.php';    
    require_once '../modelo/clFunciones.php';
    
    verificarSession();

    function diferenciaFechas($dateTimeBegin,$dateTimeEnd){
        $respuesta = new xajaxResponse();
        $tiempo=  functions::restaFechas('yyyy', $dateTimeBegin, $dateTimeEnd);
        if($tiempo){
            $respuesta->assign("tiempo_servicio","value",$tiempo);  
        }
        
        return $respuesta;
    }        
    
    function validar($request){
        $respuesta = new xajaxResponse();
        $campos_validar= array(
            'Motivo de la Culminacion de la Relacion Labora'    => 'motivo_culminacion_laboral',
            'Monto de la Demanda'  => 'monto_demanda',
            'Fecha Ingreso'    => 'fecingreso',
            'Fecha Egreso' => 'fecegreso',
        );
        $validacion=  functions::validarFormulario('frminscribir',$request,$campos_validar);
        if($validacion){
            $respuesta->alert($validacion['msg']);
            $respuesta->script($validacion['focus']);
        }else{
            $respuesta->script("xajax_insert(xajax.getFormValues('frmReferidos'))");
        }
        
        return $respuesta;
    }    
 
    function insert($formulario) {
        $respuesta= new xajaxResponse();
        $referidos= new clTbl_expediente_referidos();
        $referidos->llenar($formulario); 
        if ($referidos->getLngcodigo()=='')
        {
            $data= $referidos->insertar();     
            if($data){
                $respuesta->script('xajax_select('.$referidos->getId_demandante().','.$referidos->getId_expediente().')');
                $respuesta->alert("¡Registro guardado exitosamente!'");               

            }else{
                $respuesta->alert("El Expediente no se ha guardado");
            }  
        }
        else{
            $referidos->update();        
            $respuesta->script('xajax_select('.$referidos->getId_demandante().','.$referidos->getId_expediente().')');
            $respuesta->alert("¡Registro Actualizado exitosamente!");            
        }
	return $respuesta;
    }    
    
    function select($id_demandante,$id_expediente) {
        $respuesta= new xajaxResponse();
        $referidos= new clTbl_expediente_referidos();
        $data= "";
        if ($id_demandante!='')
            $data= $referidos->Select($id_demandante,$id_expediente);
        else {
             $respuesta->alert("¡Error Consulte con el Administrador de Sistema ó al correo ingjjsg@gmail.com!"); 
             $respuesta->script("location.href='vista_ingresoReferido.php'");                     
             return $respuesta;
        }
        if (is_array($data))
        {
            $respuesta->assign("fecingreso","value",$data[0][fecingreso]);    
            $respuesta->assign("fecegreso","value",$data[0][fecegreso]);  
            $respuesta->assign("motivo_culminacion_laboral","value",$data[0][motivo_culminacion_laboral]);  
            $respuesta->assign("concepto","value",$data[0][concepto]);  
            $respuesta->assign('monto', 'value', clFunciones::FormatoMonto($data[0][monto]));
            $respuesta->assign('monto_demanda', 'value', clFunciones::FormatoMonto($data[0][monto_demanda]));            
            $respuesta->assign("id_demandante","value",$data[0][id_demandante]);    
            $respuesta->assign("id_expediente","value",$data[0][id_expediente]);  
            $respuesta->assign("tiempo_servicio","value",$data[0][tiempo_servicio]);    
            $respuesta->assign("lngcodigo","value",$data[0][lngcodigo]);  
            if($data[0]['cancelo_adelanto_prestaciones'] == 1){
                $respuesta->assign('cancelo_adelanto_prestaciones', 'checked',true);
                $respuesta->script("$('campos_prestaciones_demandante').show()");   
            }
            else
            {
                $respuesta->script("$('campos_prestaciones_demandante').hide()");  
                $respuesta->assign('cancelo_adelanto_prestaciones', 'checked',false);
            }   
        }
        return $respuesta;
    }    
    function eliminar($formulario) {
        $respuesta= new xajaxResponse();
        $proJuzgados= new cltblprojuzgadosModelo();
        $proJuzgados->llenar($formulario);           
        if ($proJuzgados->getId_juzgados()!='')
            /*validacion de uso en otras tablas*/
            $proJuzgados->deleteJuzgado();
        else {
             $respuesta->script("location.href='vista_tblprojuzgados.php'");             
             return $respuesta;
        }
        $respuesta->script("location.href='vista_tblprojuzgados.php'");        
        $respuesta->alert("¡Registro Eliminado Exitosamente!");  
        return $respuesta;
    }        
?>
