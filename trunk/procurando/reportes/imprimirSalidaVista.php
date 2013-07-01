<?php
    include_once ('../comunes/php/fpdf/html2fpdf.php');
    include_once ('../comunes/php/utilidades.php');
    require_once '../modelo/clCorrespondenciaModelo.php';
    require_once '../modelo/clContactoModelo.php';
    require_once '../modelo/clDestinatariosModelo.php';
    require_once '../modelo/clValidacionModelo.php';
    require_once '../modelo/clFirmaAutorizada.php';

    $correspondencia= new clCorrespondenciaModelo();
    $contacto= new clContactoModelo();
    $destinatarios= new clDestinatariosModelo();
    $validacion= new clValidacionModelo();
    $firma= new clFirmaAutorizada();
    $dataCorrespondencia= $correspondencia->selectAllCorrespondenciaById($_REQUEST['id']);
    $dataCreador= $contacto->selectContactoById($dataCorrespondencia[0]['id_contacto']);
    $dataFirma= $firma->selectFirmaAutorizaByIdCorresp($_REQUEST['id']);
    if($dataFirma){
        $dataGerente= $contacto->selectContactoById($dataFirma[0]['id_contacto']);
    }
    $dataDestinatario= $destinatarios->selectAllDestinatariosByIdCorresp($_REQUEST['id']);
    $dataValidacion= $validacion->selectValidacionById($_REQUEST['id']);
    $strPR= "";
    $strCC= "";
    $strCCO= "";
    for($i= 0; $i < count($dataDestinatario); $i++){
        if($dataDestinatario[$i]['nombre_tipoenvio_maestro'] == 'PR'){
            $strPR.= $dataDestinatario[$i]['destinatario'].";<br>";
        }else if($dataDestinatario[$i]['nombre_tipoenvio_maestro'] == 'CC'){
            $strCC.= $dataDestinatario[$i]['destinatario'].";<br>";
        }else if($dataDestinatario[$i]['nombre_tipoenvio_maestro'] == 'CCO'){
            $strCCO.= $dataDestinatario[$i]['destinatario'].";<br>";
        }
    }

    $fechaEnvio= ($dataCorrespondencia[0]['fecha_envio'] != "") ? fechaCompleta($dataCorrespondencia[0]['fecha_envio'], "/") : "";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>GOBERNACION | CORRESPONDENCIA</title>
        <style>
            @media print
            {
                tfoot{
                    position:fixed;
                    bottom:0;
                    left:10px;
                }
            }
            body{
                font-family:arial;
                font-style:italic;
            }
            table table table{
                border:1px solid black;
                border-collapse:collapse;
            }
            .texto{
                font-family:arial;
                font-style:italic;
                font-size:7pt;
                text-align:center;
                font-weight: bold;
            }
            .fondoImagen{
                background-image:url(../Publico/Imagenes/hojatrans2.png);
                background-position:center;
                background-repeat:no-repeat
            }
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body class="fondoImagen">
        <table border="0" width="820px" >
            <thead>
                <tr>
                    <th></th>
                    <th>
                        <img src='../comunes/images/cab_reportes.jpg' width='800' />
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td></td>
                    <td>
                        <img  src='../comunes/images/foot_reportes.jpg' width='800'>
                    </td>
                    <td></td>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td></td>
                    <td>
                        <table width="100%" border="0" style="font-size:14px;font-family:arial" >
                            <span></span>
                            <tbody>
                                <tr>
                                    <td colspan="3" style="padding-top:5px;"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right">
                                        <?= $fechaEnvio; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" bgcolor="#f8f8f8" align="center">
                                        <strong>
                                            <em><?= $dataCorrespondencia[0]['nombre_tipocorresp_maestro']; ?></em>
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="left" nowrap="true" style="font-size:12px;padding-top:5px">
                                        <strong><?= $dataCorrespondencia[0]['strcorrelativo']; ?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="center">
                                        <hr />
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" colspan="3" style="padding:10px 10px 60px 10px;" >
                                        <?= $dataCorrespondencia[0]['strcuerpo']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding-top:5px;"></td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <strong>Destino:</strong>
                                    </td>
                                    <td><?= $strPR ?></td>
                                    <td></td>
                                </tr>
                               <tr>
                                    <td valign="top" colspan="3">
                                        <div style="padding: 10px auto 10px auto; widows:0;orphans:0;text-align:center">
                                            <table border="1" width="100%" align="center">
                                                <tr>
                                                    <td width="33%" valign="top">
                                                        <div align="left">
                                                            <strong>Entregado Por:</strong>
                                                        </div>
                                                        <br/>
                                                        <br/>
                                                        <div align="center">
                                                            <strong>
                                                                <?= $dataGerente[0]['strnombre']." ".$dataGerente[0]['strapellido']; ?>
                                                            </strong>
                                                            <br/>
                                                            <?= $dataGerente[0]['nombre_cargo']; ?>
                                                            <br/>
                                                            <?= $dataGerente[0]['nombre_dpto'] ?>
                                                        </div>
                                                    </td>
                                                    <td width="33%" valign="top">
                                                        <div align="left">
                                                            <strong>Salida Verificada Por:</strong>
                                                        </div>
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                    </td>
                                                    <td width="33%" valign="top">
                                                        <div align="left">
                                                            <strong>Entrega Verificada Por:</strong>
                                                        </div>
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="texto">
                                            <p>
                                                La presente correspondencia ha sido enviada por
                                                <strong><?= $dataValidacion[0]['nombre_contacto'] ?></strong>
                                                a trav&eacute;s del sistema de correspondencia en fecha
                                                <b><?= $dataValidacion[0]['fecha'] ?></b>
                                                bajo el n&uacute;mero
                                                <b><?= $dataValidacion[0]['codigo_validacion'] ?></b>
                                                , para confirmar la emisi&oacute;n de este documento comun&iacute;quese a la Oficina de
                                                Tecnolog&iacute;as de la Informaci&oacute;n a los telf: (0212)576.11.50/(0212)578.27.34
                                                ext. 1017, 1018, 1011, 1035.
                                            </p>
                                        </div>
                                        <br>
                                        <div class="texto">
                                            <br>
                                            "150 A&ntilde;os de la Revoluci&oacute;n Federal y Campesina, Liderizada por el General del
                                            Pueblo Soberano Ezequiel Zamora"
                                            <br>
                                        </div>
                                    </td>
                               </tr>
                            </tbody>
                        </table>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>