<?php

function selectLitigioReporte($request,$tipoReporte){
        $respuesta= new xajaxResponse();
        $id_origen=$request['id_origen'];
        $id_motivo=$request['id_motivo'];
        $id_fase=$request['id_fase'];
        $id_actuacion_persona=$request['id_actuacion_persona'];
        $id_tipo_organismo_centralizado=$request['id_tipo_organismo_centralizado'];
        $id_tipo_organismo=$request['id_tipo_organismo'];
        $strnroexpediente=$request['strnroexpediente'];
        $strnroexpedienteauxiliar=$request['strnroexpedienteauxiliar'];


        if ($id_origen>0) $url.="&id_origen=".$id_origen;
        if ($id_motivo>0) $url.="&id_motivo=".$id_motivo;
        if ($id_fase>0) $url.="&id_fase=".$id_fase;
        if ($id_actuacion_persona>0) $url.="&id_actuacion_persona=".$id_actuacion_persona;
        if ($id_tipo_organismo_centralizado>0) $url.="&id_tipo_organismo_centralizado=".$id_tipo_organismo_centralizado;
        if ($id_tipo_organismo>0) $url.="&id_tipo_organismo=".$id_tipo_organismo;
        if ($strnroexpediente!='') $url.="&strnroexpediente=".$strnroexpediente;
        if ($strnroexpedienteauxiliar!='') $url.="&strnroexpedienteauxiliar=".$strnroexpedienteauxiliar;
        
        
       //serialize($request);
        if($tipoReporte == 'pdf'){
            $respuesta->script("location.href='../reportes/reporte_constancia_portada_litigio_semanal.php?id_origen=".$id_origen."&id_motivo=".$id_motivo."&id_fase=".$id_fase."&id_actuacion_persona=".$id_actuacion_persona."&id_tipo_organismo_centralizado=".$id_tipo_organismo_centralizado."&id_tipo_organismo=".$id_tipo_organismo."&strnroexpediente=".$strnroexpediente."&strnroexpedienteauxiliar=".$strnroexpedienteauxiliar."'");
        }else if($tipoReporte == 'ods'){
            $respuesta->script("location.href='../reportes/reporte_litigio_ods.php?data=".serialize($request)."'");
        }else{
            $respuesta->alert("No Hay Datos");
        }     
        return $respuesta;
            
        
    }
    
?>
