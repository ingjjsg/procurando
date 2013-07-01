<?php
    session_start();
    require_once '../modelo/clContactoExternoModelo.php';
    require_once '../comunes/php/utilidades.php';

    verificarSession();

    function selectAllContactoExterno(){
        $respuesta= new xajaxResponse();
        $contactoExterno= new clContactoExternoModelo();
        $data= "";
        $html= "";
        $data= $contactoExterno->selectAllContactoExterno();
        if($data){
            $html= "<div style='border:solid 1px #CCCCCC;background:#f8f8f8'>
                        <table border='0' class='tablaTitulo' width='100%'>
                            <tr>
                                <th width='5%'>
                                    <a href='#' onclick=''>Id</a>
                                </th>
                                <th width='8%'>
                                    <a href='#' onclick=''>Trato</a>
                                </th>
                                <th width='20%'>
                                    <a href='#' onclick=''>Nombre Completo</a>
                                </th>
                                <th width='15%'>
                                    <a href='#' onclick=''>Instituci&oacute;n</a>
                                </th>
                                <th width='10%'>
                                    <a href='#' onclick=''>Cargo</a>
                                </th>
                                <th width='12%'>
                                    <a href='#' onclick=''>Telefono</a>
                                </th>
                                <th width='10%'>Acci&oacute;n</th>
                            </tr></table>";
            for ($i= 0; $i < count($data); $i++){
                $strUrl= "";
                $strUrl= "acc=ACT&id=".urlencode($data[$i]['id_contacto_externo']);
                $strUrl.= "&trato=".urlencode($data[$i]['strtrato']);
                $strUrl.= "&nombres=".urlencode($data[$i]['strcontactoext']);
                $strUrl.= "&institucion=".urlencode($data[$i]['strinstitucion']);
                $strUrl.= "&cargo=".urlencode($data[$i]['strcargo']);
                $strUrl.= "&tlfn=".urlencode($data[$i]['strtelefono']);
                $strUrl.= "&email=".urlencode($data[$i]['stremail']);
                $strUrl.= "&direccion=".urlencode($data[$i]['strdireccion']);
                $html.= "<table border='0' class='tablaTitulo' width='100%'>
                            <tr bgcolor='#f8f8f8'onmouseover=\"this.style.background='#f0f0f0';this.style.color='blue'\" onmouseout=\"this.style.background='#f8f8f8';this.style.color='black'\">
                                <td align='center'  width='5%'>".$data[$i]['id_contacto_externo']."</td>
                                <td width='8%'>".$data[$i]['strtrato']."</td>
                                <td width='20%'>".$data[$i]['strcontactoext']."</td>
                                <td width='15%'>".$data[$i]['strinstitucion']."</td>
                                <td width='10%'>".$data[$i]['strcargo']."</td>
                                <td width='12%'>".$data[$i]['strtelefono']."</td>
                                <td align='center' width='10%'>
                                    <a>
                                        <img src='../comunes/images/user_suit_edit.png' onmouseover=\"Tip('Editar Contacto Externo')\" onmouseout='UnTip()' onclick=\"location.href='./contactoExternoVistaIngreso.php?".$strUrl."'\">
                                    </a>
                                    <a>
                                        <img src='../comunes/images/user_suit_delete.png' onmouseover=\"Tip('Eliminar Contacto Externo')\" onmouseout='UnTip()' onclick=\"eliminarContactoExterno('".$data[$i]['id_contacto_externo']."')\">
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <div id='div_".$data[$i]['id_contacto_externo']."' style='display:none;background:#dfdfdf'></div>";
            }
            $html.= "</table></div>";
        }else{
            $html="<div class='celda_etiqueta'>No Hay Contactos Externos Registrados</div>";
        }
        $respuesta->assign("contenedor","innerHTML",$html);
        return $respuesta;
    }

    function insertContactoExterno($formulario) {
        $respuesta= new xajaxResponse();
        $contactoExterno= new clContactoExternoModelo();
        $contactoExterno->llenar($formulario);
        $contactoExterno->insertContactoExterno();
        $respuesta->script("alert('El contacto externo fue guardado con exito');");
        $respuesta->script("location.href='contactoExternoVista.php'");
		return $respuesta;
    }

    function updateContactoExterno($formulario) {
        $respuesta= new xajaxResponse();
        $contactoExterno= new clContactoExternoModelo();
        $contactoExterno->llenar($formulario);
        $contactoExterno->updateContactoExterno();
        $respuesta->script("alert('El contacto externo fue actualizado con exito');");
        $respuesta->script("location.href='contactoExternoVista.php'");
		return $respuesta;
    }

    function deleteContactoExterno($id_contacto_externo) {
        $respuesta= new xajaxResponse();
        $contactoExterno= new clContactoExternoModelo();
        $numero= uniqid();
        $html= "<div id='div_".$numero."'></div><input type='hidden' name='capa' id='capa' value='div_".$numero."'>";
        $respuesta->assign("formulario","innerHTML",$html);
        $contactoExterno->deleteContactoExterno($id_contacto_externo);
        $respuesta->script("ocultar('div_".$numero."', '¡El contacto externo se ha eliminado exitosamente!')");
        $respuesta->script("xajax_selectAllContactoExterno()");
		return $respuesta;
    }
?>
