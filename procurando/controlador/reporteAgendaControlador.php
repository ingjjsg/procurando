<?php

function selectAgendaReporte($request,$tipoReporte){
        $respuesta= new xajaxResponse();

        if($tipoReporte == 'pdf'){
            $respuesta->script("location.href='../reportes/reporte_agenda_pdf.php?data=".$request."'");
        }else if($tipoReporte == 'ods'){
            $respuesta->script("location.href='../reportes/reporte_agenda_ods.php?data=".$request."'");
        }else{
            $respuesta->alert("No Hay Datos");
        }     
        return $respuesta;
            
        
    }
?>
