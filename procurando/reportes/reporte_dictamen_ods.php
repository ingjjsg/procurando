<?php
require_once '../modelo/clDictamenesModelo.php';
require_once '../modelo/clFunciones.php'; 
require_once '../herramientas/herramientas.class.php';    
    header("Pragma: ");
    header('Cache-control: ');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
    header("Content-disposition: attachment; filename=reporte_dictamen".date("d-M-Y-H:i:s").".ods");
    $prodictamen= new clTbldictamenes();
    $data= "";
    $data= $prodictamen->selectFiltrarDictamen($_GET['id_materia'], $_GET['id_tipo_materia'], $_GET['id_tipo_organismo'],$_GET['id_organismo'],$_GET['id_estado'],$_GET['stranrodictamen']);
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
                            <td colspan="8" align="center" bgcolor="#D8D8D8"><b>Reporte de Dictamenes </b></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
         </table>';
$html='
       <table>
        <tr>
            <th align="center" bgcolor="#D8D8D8">N°</th>
            <th align="center" bgcolor="#D8D8D8">TIPO MATERIA</th>          
            <th align="center" bgcolor="#D8D8D8">TEMA</th>
            <th align="center" bgcolor="#D8D8D8">TIPO DE ORGANISMO</th>
            <th align="center" bgcolor="#D8D8D8">ORGANISMO</th>            
            <th align="center" bgcolor="#D8D8D8">TITULO</th>
            <th align="center" bgcolor="#D8D8D8">NUMERO</th>
         </tr>
        <table>';


$count=0;
foreach ($data as $key => $value) {
    
        $html.='<tr>';
                    $html.='<td align="center>'.$data[$key]['id_materia_text'].'</td>';
                    $html.='<td align="center>'.$data[$key][id_tipo_materia_text].'</td>';
                    $html.='<td align="center>'.$data[$key][id_tipo_organismo_text].'</td>';
                    $html.='<td align="center>'.$data[$key][id_organismo_text].'</td>';
                    $html.='<td align="center>'.$data[$key][strtitulo].'</td>';
                    $html.='<td align="center>'.$data[$key][stranrodictamen].'</td>';
        $html.="</tr>";
    
}
$html.='</table></body></html>';
echo $html;
}
else echo "No se Encontraron Registros";
?>
