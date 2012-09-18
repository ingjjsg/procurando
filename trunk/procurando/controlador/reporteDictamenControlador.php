<?php

require_once '../modelo/clDictamenesModelo.php';

function selectDictamenReporte($request,$tipoReporte){
        $respuesta= new xajaxResponse();
        if ($request['id_estado']!=0)
        {
            $url.="id_materia=".$request['id_materia'];
            $url.="&id_tipo_materia=".$request['id_tipo_materia'];
            $url.="&id_tipo_organismo=". $request['id_tipo_organismo'];
            $url.="&id_organismo=".$request['id_organismo'];
            $url.="&id_estado=".$request['id_estado'];
            $url.="&strtitulo=".$request['strtitulo'];
            $url.="&stranrodictamen=".$request['stranrodictamen'];
            $url.="&strpersonas=".$request['strpersonas'];
            if($tipoReporte == 'pdf'){
                $respuesta->script("location.href='../reportes/reporte_dictamen_pdf.php?".$url."'");
            }else if($tipoReporte == 'ods'){
                $respuesta->script("location.href='../reportes/reporte_dictamen_ods.php?".$url."'");
            }
        }
        else
                $respuesta->alert("Seleccione un Tipo de Estado del Dictamen");            
       return $respuesta;
            
        
    }
?>
