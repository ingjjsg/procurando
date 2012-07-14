<?php
    header("Pragma: ");
    header('Cache-control: ');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
    header("Content-disposition: attachment; filename=reporte_agenda.ods");
    
    $data=  unserialize(stripslashes($_GET['data']));
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
                            <td colspan="8" align="center" bgcolor="#D8D8D8"><b>Reporte de Agenda </b></td>
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
            <th align="center" bgcolor="#D8D8D8" class="nro">N°</th>
            <th align="center" bgcolor="#D8D8D8" >Agenda</th>
            <th align="center" bgcolor="#D8D8D8" class="departamento">Departamento</th>
            <th align="center" bgcolor="#D8D8D8">Evento</th>
            <th align="center" bgcolor="#D8D8D8">Titulo</th>
            <th align="center" bgcolor="#D8D8D8" class="prioridad">Prioridad</th>
            <th align="center" bgcolor="#D8D8D8">Estado</th>
            <th align="center" bgcolor="#D8D8D8">Días</th>
         </tr>';
$count=0;
foreach ($data as $key => $value) {
    
        $html.='<tr>';
            $html.='<td align="center" >'.++$count.'</td>';
            $html.='<td align="center">'.$data[$key]['id_tipo_agenda'].'</td>';
            $html.='<td align="center" >'.$data[$key]['id_unidad_agenda'].'</td>';
            $html.='<td align="center">'.$data[$key]['id_evento_agenda'].'</td>';
            $html.='<td align="center">'.$data[$key]['strtitulo'].'</td>';
            $html.='<td align="center" >'.$data[$key]['id_prioridad_agenda'].'</td>';
            $html.='<td align="center" >'.$data[$key]['id_estado_agenda'].'</td>';
            $html.='<td align="center" >0</td>';
        $html.="</tr>";
    
}
$html.='</table></body></html>';
echo $html;

?>
