<?php

function selectOasReporte($request,$tipoReporte){
        $respuesta= new xajaxResponse();
        $id_agenda=$request['id_agenda'];
        $id_tipo_tramite=$request['id_tipo_tramite'];
        $id_tipo_atencion=$request['id_tipo_atencion'];
        $id_actuacion_persona=$request['id_actuacion_persona'];
        $id_tipo_organismo=$request['id_tipo_organismo'];
        $id_organismo=$request['id_organismo'];
        $id_tipo_fase=$request['id_tipo_fase'];
        $id_fase_situacion=$request['id_fase_situacion'];
        $strnroexpediente=$request['strnroexpediente'];
        $strnroexpedienteauxiliar=$request['strnroexpedienteauxiliar'];

        if ($id_agenda>0) $url.="&id_agenda=".$id_agenda;
        if ($id_tipo_tramite>0) $url.="&id_tipo_tramite=".$id_tipo_tramite;
        if ($id_tipo_atencion>0) $url.="&id_tipo_atencion=".$id_tipo_atencion;
        if ($id_actuacion_persona>0) $url.="&id_actuacion_persona=".$id_actuacion_persona;
        if ($id_tipo_organismo>0) $url.="&id_tipo_organismo=".$id_tipo_organismo;
        if ($id_organismo>0) $url.="&id_organismo=".$id_organismo;
        if ($id_tipo_fase>0) $url.="&id_tipo_fase=".$id_tipo_fase;
        if ($id_fase_situacion>0) $url.="&id_fase_situacion=".$id_fase_situacion;
        if ($strnroexpediente!='') $url.="&strnroexpediente=".$strnroexpediente;
        if ($strnroexpedienteauxiliar!='') $url.="&strnroexpedienteauxiliar=".$strnroexpedienteauxiliar;
        
        
       //serialize($request);
        if($tipoReporte == 'pdf'){
            $respuesta->script("location.href='../reportes/reporte_oas_pdf.php?id_agenda=".$id_agenda."&id_tipo_tramite=".$id_tipo_tramite."&id_tipo_atencion=".$id_tipo_atencion."&id_actuacion_persona=".$id_actuacion_persona."&id_tipo_organismo=".$id_tipo_organismo."&id_organismo=".$id_organismo."&id_tipo_fase=".$id_tipo_fase."&id_fase_situacion=".$id_fase_situacion."&strnroexpediente=".$strnroexpediente."&strnroexpedienteauxiliar=".$strnroexpedienteauxiliar."'");
        }else if($tipoReporte == 'ods'){
            $respuesta->script("location.href='../reportes/reporte_oas_ods.php?data=".serialize($request)."'");
        }else{
            $respuesta->alert("No Hay Datos");
        }     
        return $respuesta;
            
        
    }
    
function selectLitigioReporte($request,$tipoReporte){
        $respuesta= new xajaxResponse();
       //serialize($request);
        if($tipoReporte == 'pdf'){
            $respuesta->script("location.href='../reportes/reporte_litigio_pdf.php?data=".serialize($request)."'");
        }else if($tipoReporte == 'ods'){
            $respuesta->script("location.href='../reportes/reporte_litigio_ods.php?data=".serialize($request)."'");
        }else{
            $respuesta->alert("No Hay Datos");
        }     
        return $respuesta;
            
        
    }
?>
