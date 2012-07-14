<?php
    session_start();
    require_once '../modelo/clRutaCorrespondenciaModelo.php';
    require_once '../comunes/php/utilidades.php';

    verificarSession();

    function selectRutaCorrespondenciaByIdCorresp($id_corresp){
        $respuesta= new xajaxResponse();
        $rutaCorrespondencia= new clRutaCorrespondenciaModelo();
        $data= $rutaCorrespondencia->selectRutaCorrespondenciaByIdCorresp($id_corresp);
        if($data){
            $html= "<div id='div_s".$id_corresp."' style='background:#dfdfdf;height:250px;overflow-y:auto'>";
            $html.= "<table class='tablaTitulo' width='100%'><tr><th width='25%'>Fecha y Hora</th><th width='75%'>Acci&oacute;n</th></tr>";
            for($i= 0; $i < count($data); $i++){
                $html.= "<tr>";
                $html.= "<td valign='top' bgcolor='#F8F8F8' width='25%'>";
                $html.= $data[$i]['fecha_ruta']." | ".$data[$i]['hora_ruta'];
                $html.= "</td>";
                $html.= "<td valign='top' bgcolor='#F8F8F8' width='75%'>";
                $html.= $data[$i]['nombre_contacto']." <b>".$data[$i]['nombre_estatus_maestro']."</b>";
                if($data[$i]['id_estatus_maestro'] == 234 || $data[$i]['id_estatus_maestro'] == 235 || $data[$i]['id_estatus_maestro'] == 236 || $data[$i]['id_estatus_maestro'] == 237 || $data[$i]['id_estatus_maestro'] == 255){
                    $html.= " el documento: ";
                }else if($data[$i]['id_estatus_maestro'] == 256 || $data[$i]['id_estatus_maestro'] == 257 || $data[$i]['id_estatus_maestro'] == 258 || $data[$i]['id_estatus_maestro'] == 259 || $data[$i]['id_estatus_maestro'] == 260 || $data[$i]['id_estatus_maestro'] == 261 || $data[$i]['id_estatus_maestro'] == 262){
                    $html.= " la actividad: ";
                }
                if($data[$i]['id_estatus_maestro'] == 234 || $data[$i]['id_estatus_maestro'] == 235 || $data[$i]['id_estatus_maestro'] == 236 || $data[$i]['id_estatus_maestro'] == 237 || $data[$i]['id_estatus_maestro'] == 255){
                    if($data[$i]['strcorrelativo'] != ""){
                        $html.= $data[$i]['strcorrelativo'];
                    }
                    $html.= "(Id: ".$data[$i]['id_corresp'].") <br>";
                }
                $html.= $data[$i]['memrutacorresp'];
                $html.= "</td>";
                $html.= "</tr>";
            }
            $html.="</table>
                    </div>
                    <table class='tablaTitulo' width='100%'>
                        <tr>
                            <td align='right' width='49%'>
                                <img src='../comunes/images/page_white_acrobat.png' onmouseover=\"Tip('Exportar a PDF')\" onmouseout='UnTip()' onclick=\"window.open('imprimirVista.php?tipo=SP&id=".$id_corresp."','_blank','')\">
                            </td>
                            <td align='right' width='2%'>&nbsp;</td>
                            <td align='left' width='49%'>
                                <img src='../comunes/images/page_excel.png' onmouseover=\"Tip('Exportar a OpenOffice')\" onmouseout='UnTip()' onclick=\"location.href='imprimirVista.php?tipo=SO&id=".$id_corresp."'\">
                            </td>
                        </tr>
                    </table>";
        }else{
            $html = "<div id='div_s".$id_corresp."' style='background:#dfdfdf;padding:5px'><center>¡Este documento no tiene seguimiento!</center></div>";
        }
        $respuesta->assign("div_".$id_corresp,"style.border","#339933 2px solid");
        $respuesta->assign("div_".$id_corresp,"innerHTML",$html);
        return $respuesta;

	}
    
?>
