<?php

require_once '../modelo/ctbldocumentoModelo.php';

function selectDocumentoReporte($request,$tipoReporte){
        $respuesta= new xajaxResponse();
            $url.="id_tipo=".$request['id_tipo'];
            $url.="&id_evento=".$request['id_evento'];
            $url.="&id_prioridad=". $request['id_prioridad'];
            $url.="&id_estado=".$request['id_estado'];
            $url.="&id_recordatorio=".$request['id_recordatorio'];
            $url.="&id_unidad=".$request['id_unidad'];
            $url.="&id_refiere=".$request['id_refiere'];
            $url.="&id_tipo_organismo=".$request['id_tipo_organismo'];
            $url.="&id_organismo=".$request['id_organismo'];
            if($tipoReporte == 'pdf'){
                $respuesta->script("location.href='../reportes/reporte_documento_pdf.php?".$url."'");
            }else if($tipoReporte == 'ods'){
                $respuesta->script("location.href='../reportes/reporte_documento_ods.php?".$url."'");
            }
       return $respuesta;
            
        
    }
?>
