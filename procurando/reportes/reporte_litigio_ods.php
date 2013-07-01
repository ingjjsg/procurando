<?php
    header("Pragma: ");
    header('Cache-control: ');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
    header("Content-disposition: attachment; filename=reporte_litigio.ods");

require_once 'plantilla_reporte.php';
require_once '../modelo/clActuacionesModelo.php';
require_once '../modelo/clFunciones.php';

$proexpediente= new clActuaciones();
$data= "";
$request= unserialize($_GET['data']);
$data= $proexpediente->selectAllExpedienteReporte($request['id_tipo_tramite'], $request['id_tipo_atencion'], $request['id_actuacion_persona'],$request['id_tipo_organismo'],$request['id_organismo'],$request['id_tipo_fase'],$request['id_fase'],$request['strnroexpediente'],$request['strnroexpedienteauxiliar']);
        
    $html='
        <html>
        <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
            <table>

                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#D8D8D8"><b>Reporte de Expedientes Litigio </b></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
         </table>
    <table>
    <tr>
            <th align="center" bgcolor="#D8D8D8"class="nro">N°</th>
            <th align="center" bgcolor="#D8D8D8">Expediente</th>
            <th align="center" bgcolor="#D8D8D8">Expediente Auxiliar</th>
            <th align="center" bgcolor="#D8D8D8">Tipo Organismo</th>
            <th align="center" bgcolor="#D8D8D8">Organismo</th>
            <th align="center" bgcolor="#D8D8D8">Titulo</th>
         </tr>';
$count=0;
if($data){
 foreach ($data as $key => $value) {
    
        $html.='<tr>';
            $html.='<td align="center" class="nro">'.++$count.'</td>';
            $html.='<td align="center">'.$data[$key]['strnroexpediente'].'</td>';
            $html.='<td align="center">'.$data[$key]['strnroexpedienteauxiliar'].'</td>';
            $html.='<td align="center">'.clFunciones::mostrarStritema($data[$key]['id_tipo_organismo']).'</td>';
            $html.='<td align="center">'.clFunciones::mostrarStritema($data[$key]['id_organismo']).'</td>';
            $html.='<td align="center">'.$data[$key]['strtitulo'].'</td>';
        $html.="</tr>";
    
}   
}

$html.='</table></body></html>';
echo $html;

?>
