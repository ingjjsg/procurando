<?php
    //session_start();
    require_once '../modelo/clMaestroModelo.php';
    require_once '../modelo/clDictamenesModelo.php';
    require_once '../comunes/php/utilidades.php';
    require_once '../modelo/clConstantesModelo.php';
    require_once '../modelo/clFunciones.php';    
    require_once '../herramientas/herramientas.class.php';    


    

    function selectAllDictamenes($id_materia="", $id_tipo_materia="", $id_tipo_organismo="", $id_organismo="", $id_estado="", $strtitulo="", $stranrodictamen="", $strpersonas=""){
        $respuesta= new xajaxResponse();
        $dictamenes= new clTbldictamenes();
        $data= "";
        $html= "";

	if (($id_materia>0) or ($id_tipo_materia>0) or ($id_tipo_organismo>0) or ($id_organismo>0) or ($id_estado>0) or ($strtitulo!='') or ($stranrodictamen!='') or ($strpersonas!=''))  {

            $data= $dictamenes->selectFiltrarDictamen($id_materia, $id_tipo_materia, $id_tipo_organismo, $id_organismo, $id_estado, $strtitulo, $stranrodictamen, $strpersonas);             
        }
//        else
//            $data= $dictamenes->selectAllDictamen();        
        if($data){
//            print_r($data);
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='10%'>
                                    <a href='#' onclick=\"xajax_orden('id_dictamen')\">Id</a>
                                </th>                            
                                <th width='27%'>
                                    <a href='#' onclick=\"xajax_orden('id_materia')\">Materia</a>
                                </th>
                                <th width='27%'>
                                    <a href='#' onclick=\"xajax_orden('id_tipo_materia')\">Tema</a>
                                </th>
                                <th width='6%'>
                                    <a href='#' onclick=\"xajax_orden('stranrodictamen')\">Numero</a>
                                </th>                                
                                <th width='20%'>
                                    <a href='#' onclick=\"xajax_orden('strtitulo')\">Titulo</a>
                                </th>    
                                <th width='10%'>Bajar PDF</th>
                            </tr></table>";
            for ($i= 0; $i < count($data); $i++){
                $html.= "<table border='0' class='tablaTitulo' width='100%'><tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\" >
                            <td width='10%' align='center' onmouseover='Tip(\"Imprimir Dictamen ".$data[$i]['strtitulo']."\")' onmouseout='UnTip()'>".$data[$i]['id_dictamen']."</td>
                            <td width='27%' align='center' onmouseover='Tip(\"Imprimir Dictamen ".$data[$i]['strtitulo']."\")' onmouseout='UnTip()'>".$data[$i]['id_materia_text']."</td>
                            <td width='27%' align='center' onmouseover='Tip(\"Imprimir Dictamen ".$data[$i]['strtitulo']."\")' onmouseout='UnTip()'>".$data[$i]['id_tipo_materia_text']."</td>
                            <td width='6%' align='center' onmouseover='Tip(\"Imprimir Dictamen ".$data[$i]['strtitulo']."\")' onmouseout='UnTip()'>".$data[$i]['stranrodictamen']."</td>  
                            <td width='20%' align='center' onmouseover='Tip(\"Imprimir Dictamen ".$data[$i]['strtitulo']."\")' onmouseout='UnTip()'>".$data[$i]['strtitulo']."</td>                                
                            <td width='10%' align='center'>
                                <a>
                                    <img src='../comunes/images/page_white_acrobat.png' onmouseover='Tip(\"Imprimir Dictamen ".$data[$i]['strtitulo']."\")' onmouseout='UnTip()' onclick=\"javascript:location.href='../reportes/reporte_dictamen_individual.php?id=".$data[$i]['id_dictamen']."'\";\">
                                </a>
                            </td>
                        </tr></table>";
            }
            $html.= "</div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Dictamenes Registrados</div>";
        }
        $respuesta->assign("contenedorDictamenes","innerHTML",$html);
        return $respuesta;
    }




    
     function llenarSelectOrganismo($valor, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";;
        $data= $maestro->selectAllMaestroHijos($valor, 'stritema');
        $html= "<select id='id_organismo' name='id_organismo' style='width:".$ancho."' >";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdOrganismo","innerHTML",$html);
        return $respuesta;
    }    
    
     function llenarSelectTipoOrganismo($select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_organismo'], 'stritema');
        $html= "<select id='id_tipo_organismo' name='id_tipo_organismo' style='width:".$ancho."' onchange=\"xajax_llenarSelectOrganismo(document.frmDictamen.id_tipo_organismo.value)\">";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdTipoOrganismo","innerHTML",$html);
        return $respuesta;
    }    

    
    
   function llenarSelectTipoEstadoDictamen($select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_estado_dictamenes'], 'stritema');
//        exit(print_r($data));        
        $html= "<select id='id_estado' name='id_estado' style='width:".$ancho."'>";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdTipoEstado","innerHTML",$html);
        return $respuesta;
    }     

    
    
     function llenarTipoMateria($valor, $select= "", $ancho= "60%") {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $data= $maestro->selectAllMaestroHijos($valor, 'stritema');
        $html= "<select id='id_tipo_materia' name='id_tipo_materia' style='width:".$ancho."' >";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdTipoMateria","innerHTML",$html);
        return $respuesta;
    }        

    
   function llenarSelectTipo($select= "", $ancho= "60%", $ajax=0) {
        $respuesta= new xajaxResponse();
        $maestro= new clMaestroModelo();
        $data= "";
        $html= "";
        $estados= clConstantesModelo::combos();
        $data= $maestro->selectAllMaestroHijos($estados['tipo_materia_dictamenes'], 'stritema');
        if ($ajax>0)
            $html= "<select id='id_materia' name='id_materia' style='width:".$ancho."'>";
        else
            $html= "<select id='id_materia' name='id_materia' style='width:".$ancho."' onchange=\"xajax_llenarTipoMateria(document.frmDictamen.id_materia.value)\">";
        $html.= "<option value='0'>Seleccione</option>";
        if($data){
            for ($i= 0; $i < count($data); $i++){
               $seleccionar= "";
                if($select == $data[$i]['id_maestro']){
                    $seleccionar= "SELECTED";
                }
                $html.= "<option value='".$data[$i]['id_maestro']."' ".$seleccionar.">".$data[$i]['stritema']."</option>";
            }
            $html.= "</select>";
        }
        $respuesta->assign("capaIdTipo","innerHTML",$html);
        return $respuesta;
    }     


    
    
?>
