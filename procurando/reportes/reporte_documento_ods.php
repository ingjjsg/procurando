<?php
require_once '../modelo/ctbldocumentoModelo.php';
require_once '../modelo/clFunciones.php'; 
require_once '../herramientas/herramientas.class.php';    
    header("Pragma: ");
    header('Cache-control: ');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
    header("Content-disposition: attachment; filename=reporte_documento".date("d-M-Y-H:i:s").".ods");
    $prodocumento= new clTblDocumento();
    $data= "";
    $data= $prodocumento->selectDocumentoReporte($_GET['id_tipo'], $_GET['id_evento'], $_GET['id_prioridad'],$_GET['id_estado'],$_GET['id_recordatorio'],$_GET['id_unidad'],$_GET['id_refiere'],$_GET['id_tipo_organismo'],$_GET['id_organismo']);
    if($data){    
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
                            <td colspan="8" align="center" bgcolor="#D8D8D8"><b>Reporte de Documentos </b></td>
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
            <th align="center" bgcolor="#D8D8D8">N°</th>
            <th align="center" bgcolor="#D8D8D8">Documento</th>
            <th align="center" bgcolor="#D8D8D8">Departamento</th>
            <th align="center" bgcolor="#D8D8D8">Evento</th>
            <th align="center" bgcolor="#D8D8D8">Titulo</th>
            <th align="center" bgcolor="#D8D8D8">Prioridad</th>
            <th align="center" bgcolor="#D8D8D8">Estado</th>
            <th align="center" bgcolor="#D8D8D8">Días</th>
         </tr>';
$count=0;
foreach ($data as $key => $value) {
    
        $html.='<tr>';
            $html.='<td align="center" class="nro">'.++$count.'</td>';
            $html.='<td align="center">'.$data[$key][id_tipo_documento].'</td>';
            $html.='<td align="center" class="departamento">'.$data[$key][id_unidad_documento].'</td>';
            $html.='<td align="center">'.$data[$key][id_evento_documento].'</td>';
            $html.='<td align="center">'.functions::decrypt($data[$key][strtitulo]).'</td>';
            $html.='<td align="center" class="prioridad centrado">'.$data[$key][id_prioridad_documento].'</td>';
            $html.='<td align="center">'.$data[$key][id_estado_documento].'</td>';
            $html.='<td align="center">0</td>';
        $html.="</tr>";
    
}
$html.='</table></body></html>';
echo $html;
}
else echo "No se Encontraron Registros";
?>
