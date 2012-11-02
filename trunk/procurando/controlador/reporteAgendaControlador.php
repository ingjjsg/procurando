<?php

function selectAgendaReporte($request,$tipoReporte){
        $url=$request['id_tipo'].'&id_evento='.$request['id_evento'].'&id_prioridad='.$request['id_prioridad'].'&id_estado='.$request['id_estado'].'&id_recordatorio='.$request['id_recordatorio'].'&id_unidad='.$request['id_unidad'].'&id_refiere='.$request['id_refiere'].'&id_tipo_organismo='.$request['id_tipo_organismo'].'&id_organismo='.$request['id_organismo'].'&id_integrantes_unidad='.$request['id_integrantes_unidad'];
        $respuesta= new xajaxResponse();
        if($tipoReporte == 'pdf'){
            $respuesta->script("location.href='../reportes/reporte_agenda_pdf.php?id_tipo=".$url."'");
        }else if($tipoReporte == 'ods'){
            $respuesta->script("location.href='../reportes/reporte_agenda_ods.php?id_tipo=".$url."'");
        }else{
            $respuesta->alert("No Hay Datos");
        }     
        return $respuesta;
    }
?>
