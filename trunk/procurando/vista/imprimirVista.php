<?php
    session_start();
    $id= $_REQUEST['id'];
    $tipo= $_REQUEST['tipo'];
    
    $strUrl= "";
    $strUrl.= "?por=".$_REQUEST['por'];
    $strUrl.= "&dependencia=".$_REQUEST['dependencia'];
    $strUrl.= "&orden=".$_REQUEST['orden'];

    switch ($tipo) {
        case 86:
            header("Location: ../reportes/imprimirCircularVista.php?id=".$_REQUEST["id"]);
            break;
        case 87:
            header("Location: ../reportes/imprimirPuntoInformacionVista.php?id=".$_REQUEST["id"]);
            break;
        case 88:
            header("Location: ../reportes/imprimirMemorandoVista.php?id=".$_REQUEST["id"]);
            break;
        case 89:
            header("Location: ../reportes/imprimirRemisionVista.php?id=".$_REQUEST["id"]);
            break;
        case 90:
            header("Location: ../reportes/imprimirMemorandoVista.php?id=".$_REQUEST["id"]);
            break;
        case 91:
            header("Location: ../reportes/imprimirActaVista.php?id=".$_REQUEST["id"]);
            break;
        case 92:
            header("Location: ../reportes/imprimirSalidaVista.php?id=".$_REQUEST["id"]);
            break;
        case 93:
            header("Location: ../reportes/imprimirNotaVista.php?id=".$_REQUEST["id"]);
            break;
        case 98:
            header("Location: ../reportes/imprimirOficioVista.php?id=".$_REQUEST["id"]);
            break;
        case 'SP':
            header("Location: reporteSeguimientoPdfVista.php?id=".$_REQUEST["id"]);
            break;
        case 'SO':
            header("Location: reporteSeguimientoOoVista.php?id=".$_REQUEST["id"]);
            break;
        case 'RP':
            header("Location: reportePdfVista.php".$strUrl);
            break;
        case 'RO':
            header("Location: reporteOoVista.php".$strUrl);
            break;
    }
?>
