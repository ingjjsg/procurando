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
        <table border="0" width="720px" >
            <thead>
                <tr>
                    <th></th>
                    <th>
                        <img src='../comunes/images/cab_reportes.jpg' width='700' />
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td></td>
                    <td>
                        <img  src='../comunes/images/foot_reportes.jpg' width='700'>
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
                                    <td colspan="3" bgcolor="#f8f8f8" align="center">
                                        <strong>
                                            <em><?= $dataCorrespondencia[0]['nombre_tipocorresp_maestro']; ?></em>
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="left" nowrap="true" style="font-size:12px;padding-top:5px">
                                        <table border="1" width="100%">
                                            <tr>
                                                <td>
                                                    <b>Nro.</b>
                                                </td>
                                                <td>
                                                    <?= $dataCorrespondencia[0]['strcorrelativo']; ?>
                                                </td>
                                                <td>
                                                    <b>Fecha de Elaboraci&oacute;n:</b>
                                                </td>
                                                <td align="center">
                                                    <?= $dataCorrespondencia[0]['fecha']; ?>
                                                </td>
                                                <td>
                                                    <b>Fecha de Env&iacute;o:</b>
                                                </td>
                                                <td align="center">
                                                    <?= $dataCorrespondencia[0]['fecha_envio']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b>De:</b>
                                                </td>
                                                <td colspan="5">
                                                    <?= $dataGerente[0]['nombre_dpto']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b>Para:</b>
                                                </td>
                                                <td colspan="5">
                                                    <?= $strPR; ?>
                                                </td>
                                            </tr>
                                            <?php if($strCC){ ?>
                                            <tr>
                                                <td>
                                                    <b>CC:</b>
                                                </td>
                                                <td colspan="5">
                                                    <?= $strCC; ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td>
                                                    <b>Asunto:</b>
                                                </td>
                                                <td colspan="5">
                                                    <?= $dataCorrespondencia[0]['strasunto']; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" colspan="3" style="padding:10px 10px 60px 10px;" >
                                        <?= $dataCorrespondencia[0]['strcuerpo']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" colspan="3">
                                        <div style="padding: 10px auto 10px auto; widows:0;orphans:0;text-align:center">
                                            <strong>
                                                <em>Atentamente</em>
                                            </strong>
                                            <br /><br /><br />
                                            <?if ($dataGerente[0]['strfirmadigital']== ""){?>
                                            <span>
                                                ____________________________
                                            </span>
                                            <br /><br />
                                            <?= $dataGerente[0]['strfirma']; ?>
                                            <?} else {?>
                                            	<span>
                                                <img  src='<? echo $dataGerente[0]['strfirmadigital']?>;' width="300" >
                                            </span>
                                            <br /><br />
                                            <?}?>
                                        <div align = "left">
                                            <?= $dataCreador[0]['strmediafirma']; ?>
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
