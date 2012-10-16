<?php

function selectOasReporte($request,$tipoReporte){
        $respuesta= new xajaxResponse();
       //serialize($request);
        if($tipoReporte == 'pdf'){
            $respuesta->script("location.href='../reportes/reporte_oas_pdf.php?data=".serialize($request)."'");
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
