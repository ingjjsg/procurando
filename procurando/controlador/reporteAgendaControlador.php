<?php

require_once '../modelo/ctblagendaModelo.php';

function selectAgendaReporte($request,$tipoReporte){
        $respuesta= new xajaxResponse();
        $proagenda= new clTblagenda();
        $data= "";
        $data= $proagenda->selectAgendaReporte($request['id_tipo'], $request['id_evento'], $request['id_prioridad'],$request['id_estado'],$request['id_recordatorio'],$request['id_unidad'],$request['id_refiere'],$request['id_tipo_organismo'],$request['id_organismo']);
        
        if($data){
            $compactada=urlencode(serialize($data));
            if($tipoReporte == 'pdf'){
                $respuesta->script("location.href='../reportes/reporte_agenda_pdf.php?data=".$compactada."'");
            }else if($tipoReporte == 'ods'){
                $respuesta->script("location.href='../reportes/reporte_agenda_ods.php?data=".$compactada."'");
            }
        }else{
            $respuesta->alert("No Hay Datos");
        }     
        return $respuesta;
            
        
    }
?>
