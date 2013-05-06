<?php
    require_once '../controlador/Conexion.php';
    require_once '../modelo/clConstantesModelo.php';
/**
 * Description of clRedactarModelo
 *
 * @author jhuidobro
 */
class clCorrespondenciaModelo {
    private $id_corresp;
    private $id_tipo_maestro;
    private $id_tipocorresp_maestro;
    private $id_unidad_maestro;
    private $dtmfecha;
    private $strasunto;
    private $strcuerpo;
    private $lngenviada;
    private $strcorrelativo;
    private $id_contacto;
    private $id_estatus_maestro;
    private $bolborrado;

    public function __construct() {

    }

    public function llenar($request) {
        
        if($request['id_corresp'] != ""){
            $this->id_corresp= $request['id_corresp'];
        }else{
            $this->id_corresp= 0;
        }
        if($request['id_tipo_maestro'] != ""){
            $this->id_tipo_maestro= $request['id_tipo_maestro'];
        }else{
            $this->id_tipo_maestro= 0;
        }
        if($request['id_tipocorresp_maestro'] != ""){
            $this->id_tipocorresp_maestro= $request['id_tipocorresp_maestro'];
        }else{
            $this->id_tipocorresp_maestro= 0;
        }
        if($request['id_unidad_maestro'] != ""){
            $this->id_unidad_maestro= $request['id_unidad_maestro'];
        }
        if($request['dtmfecha'] != ""){
            $this->dtmfecha= $request['dtmfecha'];
        }
        if($request['strasunto'] != ""){
            $this->strasunto= $request['strasunto'];
        }else{
            $this->strasunto= "";
        }
        if($request['strcuerpo'] != ""){
            $this->strcuerpo= $request['strcuerpo'];
        }else{
            $this->strcuerpo= "";
        }
        if($request['lngenviada'] != ""){
            $this->lngenviada= $request['lngenviada'];
        }
        if($request['strcorrelativo'] != ""){
            $this->strcorrelativo= $request['strcorrelativo'];
        }
        if($request['id_contacto'] != ""){
            $this->id_contacto= $request['id_contacto'];
        }
        if($request['id_estatus_maestro'] != ""){
            $this->id_estatus_maestro= $request['id_estatus_maestro'];           
        }
        if($request['bolborrado'] != ""){
            $this->bolborrado= $request['bolborrado'];
        }
    }

    public function getId_corresp(){
        return $this->id_corresp;
    }
    public function setId_corresp($id_corresp){
        $this->id_corresp= $id_corresp;
    }
    public function getId_tipo_maestro(){
        return $this->id_tipo_maestro;
    }
    public function setId_tipo_maestro($id_tipo_maestro){
        $this->id_tipo_maestro= $id_tipo_maestro;
    }
    public function getId_tipocorresp_maestro(){
        return $this->id_tipocorresp_maestro;
    }
    public function setId_tipocorresp_maestro($id_tipocorresp_maestro){
        $this->id_tipocorresp_maestro= $id_tipocorresp_maestro;
    }
    public function getId_unidad_maestro(){
        return $this->id_unidad_maestro;
    }
    public function setId_unidad_maestro($id_unidad_maestro){
        $this->id_unidad_maestro= $id_unidad_maestro;
    }
    public function getDtmfecha(){
        return $this->dtmfecha;
    }
    public function setDtmfecha($dtmfecha){
        $this->dtmfecha= $dtmfecha;
    }
    public function getStrasunto(){
        return $this->strasunto;
    }
    public function setStrasunto($strasunto){
        $this->strasunto= $strasunto;
    }
    public function getStrcuerpo(){
        return $this->strcuerpo;
    }
    public function setStrcuerpo($strcuerpo){
        $this->strcuerpo= $strcuerpo;
    }
    public function getLngenviada(){
        return $this->lngenviada;
    }
    public function setLngenviada($lngenviada){
        $this->lngenviada= $lngenviada;
    }
    public function getStrcorrelativo(){
        return $this->strcorrelativo;
    }
    public function setStrcorrelativo($strcorrelativo){
        $this->strcorrelativo= $strcorrelativo;
    }
    public function getId_contacto(){
        return $this->id_contacto;
    }
    public function setId_contacto($id_contacto){
        $this->id_contacto= $id_contacto;
    }
    public function getId_estatus_maestro(){
        return $this->id_estatus_maestro;
    }
    public function setId_estatus_maestro($id_estatus_maestro){
        $this->id_estatus_maestro= $id_estatus_maestro;
    }
    public function getBolborrado(){
        return $this->bolborrado;
    }
    public function setBolborrado($bolborrado){
        $this->bolborrado= $bolborrado;
    }

    public function insertCorrespondencia(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tblcorrespondencias (id_tipo_maestro, id_tipocorresp_maestro, id_unidad_maestro, dtmfecha, strasunto, ";
        $sql.= "strcuerpo, lngenviada, strcorrelativo, id_contacto, id_estatus_maestro) VALUES ";
        $sql.= "(".$this->getId_tipo_maestro().", ".$this->getId_tipocorresp_maestro().", ".$this->getId_unidad_maestro().", now(), ";
        $sql.= "'".$this->getStrasunto()."', '".$this->getStrcuerpo()."', 0, '', ".$this->getId_contacto().", ".$this->getId_estatus_maestro().")";
        //exit("SQL: ".$sql);
        $conn->sql=$sql;
        $conn->ejecutarSentencia();
        $retorno= $this->verIdCorrespondencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function insertCorrespondenciaExterna(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "INSERT INTO ".clConstantesModelo::correspondencia_table."tblcorrespondencias (id_tipo_maestro, id_tipocorresp_maestro, id_unidad_maestro, dtmfecha, strasunto, ";
        $conn->sql.= "strcuerpo, lngenviada, strcorrelativo, id_contacto, id_estatus_maestro, dtmfechaenvio) VALUES ";
        $conn->sql.= "(".$this->getId_tipo_maestro().", ".$this->getId_tipocorresp_maestro().", ".$this->getId_unidad_maestro().", ";
        $conn->sql.= "TO_DATE('".$this->getDtmfecha()."', 'DD/MM/YYYY'), '".$this->getStrasunto()."', '".$this->getStrcuerpo()."', 1, ";
        $conn->sql.= "'".$this->getStrcorrelativo()."', ".$this->getId_contacto().", ".$this->getId_estatus_maestro().", now())";
        $conn->ejecutarSentencia();
        $retorno= $this->verIdCorrespondencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function verIdCorrespondencia(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT CURRVAL('tblcorrespondencias_id_corresp_seq') as id_corresp";
        $data= $conn->ejecutarSentencia(2);
        //exit(print_r($data));
        return $data;
    }

    public function selectAllCorrespondencia($id_estatus_maestro, $id_contacto, $pagina, $id_unidad_maestro= ""){
        $conn= new Conexion();
        $conn->abrirConexion();
        
        $sql= "SELECT id_corresp, id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo_maestro, ";
        $sql.= "id_tipocorresp_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipocorresp_maestro) AS nombre_tipocorresp_maestro, ";
        $sql.= "id_unidad_maestro,	(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad_maestro) AS nombre_unidad_maestro, ";
        $sql.= "to_char(dtmfecha, 'DD/MM/YYYY') as fecha, to_char(dtmfecha, 'HH:MI:SS') as hora, strasunto, strcuerpo, lngenviada, strcorrelativo, ";
        $sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tblcorrespondencias.id_contacto) AS nombre_contacto, ";
        $sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
        $sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias WHERE bolborrado= 0 AND id_contacto= ".$id_contacto." ";
        if($id_unidad_maestro != ""){
            $sql.= "AND id_unidad_maestro= ".$id_unidad_maestro." ";
        }
        if($id_estatus_maestro != 194 && $id_estatus_maestro != 197){
        //$conn->sql.= "ORDER BY id_corresp DESC";
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $sql.= "UNION SELECT id_corresp, id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo_maestro, ";
            $sql.= "id_tipocorresp_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipocorresp_maestro) AS nombre_tipocorresp_maestro, ";
            $sql.= "id_unidad_maestro,	(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad_maestro) AS nombre_unidad_maestro, ";
            $sql.= "to_char(dtmfecha, 'DD/MM/YYYY') as fecha, to_char(dtmfecha, 'HH:MI:SS') as hora, strasunto, strcuerpo, lngenviada, strcorrelativo, ";
            $sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tblcorrespondencias.id_contacto) AS nombre_contacto, ";
            $sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
            $sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias WHERE bolborrado= 0";
            if($id_estatus_maestro == 195){
                $sql.= "AND id_contacto IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_coord_maestro= ".$id_unidad_maestro.") ";
            }else if($id_estatus_maestro == 196 || $id_estatus_maestro == 198 || $id_estatus_maestro == 199){
                $sql.= "AND id_contacto IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_dpto_maestro= ".$id_unidad_maestro.") ";
            }
            $sql.= "AND id_unidad_maestro IN (select id_maestro from ".clConstantesModelo::correspondencia_table."tblmaestros where id_origen= ".$id_unidad_maestro." OR id_maestro= ".$id_unidad_maestro.") ";
            $sql.= "ORDER BY id_corresp DESC";
           //exit($conn->sql);

        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $_pagi_sql= $sql;
        $_pagi_cuantos = 10;
        $_pagi_nav_num_enlaces = 5;
        $_pagi_actual = $pagina;
        include_once '../comunes/php/paginacion/paginator1.inc.php';
        $data = pg_fetch_all($_pagi_result);
        $data2[0]= $data;
        $data2[1]=  "<p>".$_pagi_navegacion."</p>";
        //echo $conn->sql;
        //echo $_pagi_navegacion;
        return $data2;
    }    
    
    
//    public function selectAllCorrespondencia($id_estatus_maestro, $id_contacto, $pagina, $id_unidad_maestro= ""){
//        $conn= new Conexion();
//        $conn->abrirConexion();
//        
//        $sql= "SELECT id_corresp, id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo_maestro, ";
//        $sql.= "id_tipocorresp_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipocorresp_maestro) AS nombre_tipocorresp_maestro, ";
//        $sql.= "id_unidad_maestro,	(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad_maestro) AS nombre_unidad_maestro, ";
//        $sql.= "to_char(dtmfecha, 'DD/MM/YYYY') as fecha, to_char(dtmfecha, 'HH:MI:SS') as hora, strasunto, strcuerpo, lngenviada, strcorrelativo, ";
//        $sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tblcorrespondencias.id_contacto) AS nombre_contacto, ";
//        $sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
//        $sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias WHERE id_estatus_maestro= ".$id_estatus_maestro." AND bolborrado= 0 AND id_contacto= ".$id_contacto." ";
//        if($id_unidad_maestro != ""){
//            $sql.= "AND id_unidad_maestro= ".$id_unidad_maestro." ";
//        }
//        if($id_estatus_maestro != 194 && $id_estatus_maestro != 197){
//        //$conn->sql.= "ORDER BY id_corresp DESC";
//        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//            $sql.= "UNION SELECT id_corresp, id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo_maestro, ";
//            $sql.= "id_tipocorresp_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipocorresp_maestro) AS nombre_tipocorresp_maestro, ";
//            $sql.= "id_unidad_maestro,	(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad_maestro) AS nombre_unidad_maestro, ";
//            $sql.= "to_char(dtmfecha, 'DD/MM/YYYY') as fecha, to_char(dtmfecha, 'HH:MI:SS') as hora, strasunto, strcuerpo, lngenviada, strcorrelativo, ";
//            $sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tblcorrespondencias.id_contacto) AS nombre_contacto, ";
//            $sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
//            $sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias WHERE bolborrado= 0 AND id_estatus_maestro= ".$id_estatus_maestro." ";
//            if($id_estatus_maestro == 195){
//                $sql.= "AND id_contacto IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_coord_maestro= ".$id_unidad_maestro.") ";
//            }else if($id_estatus_maestro == 196 || $id_estatus_maestro == 198 || $id_estatus_maestro == 199){
//                $sql.= "AND id_contacto IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_dpto_maestro= ".$id_unidad_maestro.") ";
//            }
//            $sql.= "AND id_unidad_maestro IN (select id_maestro from ".clConstantesModelo::correspondencia_table."tblmaestros where id_origen= ".$id_unidad_maestro." OR id_maestro= ".$id_unidad_maestro.") ";
//            $sql.= "ORDER BY id_corresp DESC";
//           //exit($conn->sql);
//
//        }
//        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//        $_pagi_sql= $sql;
//        $_pagi_cuantos = 10;
//        $_pagi_nav_num_enlaces = 5;
//        $_pagi_actual = $pagina;
//        include_once '../comunes/php/paginacion/paginator1.inc.php';
//        $data = pg_fetch_all($_pagi_result);
//        $data2[0]= $data;
//        $data2[1]=  "<p>".$_pagi_navegacion."</p>";
//        //echo $conn->sql;
//        //echo $_pagi_navegacion;
//        return $data2;
//    }

    public function selectAllCorrespondenciaById($id_corresp){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_corresp, id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo_maestro, ";
        $conn->sql.= "id_tipocorresp_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipocorresp_maestro) AS nombre_tipocorresp_maestro, ";
        $conn->sql.= "id_unidad_maestro,	(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad_maestro) AS nombre_unidad_maestro, ";
        $conn->sql.= "(SELECT id_origen FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad_maestro) AS id_origen_unidad_maestro, ";
        $conn->sql.= "(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= (SELECT id_origen FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad_maestro)) AS nombre_origen_unidad_maestro, ";
        $conn->sql.= "to_char(dtmfecha, 'DD/MM/YYYY') as fecha, to_char(dtmfecha, 'HH:MI:SS') as hora, strasunto, strcuerpo, lngenviada, strcorrelativo, ";
        $conn->sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tblcorrespondencias.id_contacto) AS nombre_contacto, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
        $conn->sql.= "to_char(dtmfechaenvio, 'DD/MM/YYYY') as fecha_envio, to_char(dtmfechaenvio, 'HH:MI:SS') as hora_envio, ";
        $conn->sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias WHERE id_corresp= ".$id_corresp." AND bolborrado= 0";

        //ECHO "CONSULTA: ".$conn->sql;
        $data= $conn->ejecutarSentencia(2);
        return $data;
    }

    public function updateCorrespondencia(){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tblcorrespondencias SET id_tipo_maestro= ".$this->getId_tipo_maestro().", ";
        $conn->sql.= "id_tipocorresp_maestro= ".$this->getId_tipocorresp_maestro().", ";
        $conn->sql.= "strasunto= '".$this->getStrasunto()."', strcuerpo= '".$this->getStrcuerpo()."', id_estatus_maestro= ".$this->getId_estatus_maestro()." ";
        $conn->sql.= "WHERE id_corresp= ".$this->getId_corresp();
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function deleteCorrespondencia($id_corresp){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tblcorrespondencias SET bolborrado= 1 WHERE id_corresp= ".$id_corresp;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function enviarCorrespondencia($id_corresp, $id_estatus_maestro, $strcorrelativo= ""){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tblcorrespondencias SET id_estatus_maestro= ".$id_estatus_maestro." ";
        if($id_estatus_maestro == 199){
            $conn->sql.= ", strcorrelativo= '".$strcorrelativo."', lngenviada= 1, dtmfechaenvio= now() ";
        }
        $conn->sql.= "WHERE id_corresp= ".$id_corresp;
        $retorno= $conn->ejecutarSentencia();
        $conn->cerrarConexion();
        return $retorno;
    }

    public function selectAllFiltrosRedactados($id_contacto, $pagina, $id_unidad_maestro, $dtmfechaD= "", $dtmfechaH= "", $id_estatus_maestro= "", $strasunto= "", $id_tipo_maestro= "", $id_tipocorresp_maestro= "", $id_destino_maestro= ""){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_corresp, id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo_maestro, ";
        $conn->sql.= "id_tipocorresp_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipocorresp_maestro) AS nombre_tipocorresp_maestro, ";
        $conn->sql.= "id_unidad_maestro,	(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad_maestro) AS nombre_unidad_maestro, ";
        $conn->sql.= "to_char(dtmfecha, 'DD/MM/YYYY') as fecha, to_char(dtmfecha, 'HH:MI:SS') as hora, strasunto, strcuerpo, lngenviada, strcorrelativo, ";
        $conn->sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tblcorrespondencias.id_contacto) AS nombre_contacto, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
        $conn->sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias WHERE id_contacto= ".$id_contacto." AND bolborrado= 0";
        if($dtmfechaD != "" || $dtmfechaH != ""){
            $conn->sql.= " AND dtmfecha BETWEEN to_date('".$dtmfechaD."', 'DD/MM/YYYY') AND to_date('".$dtmfechaH."', 'DD/MM/YYYY')";
        }
        if($id_estatus_maestro != ""){
            $conn->sql.= " AND id_estatus_maestro= ".$id_estatus_maestro;
        }
        if(($id_unidad_maestro != "") && ($id_unidad_maestro != 0)){ //de aqui
            $conn->sql.= " AND id_unidad_maestro= ".$id_unidad_maestro;
        }//hasta aqui

        if($strasunto != ""){
            $conn->sql.= " AND UPPER(strasunto) LIKE UPPER('%".$strasunto."%')";
        }
        if($id_tipo_maestro != ""){
            $conn->sql.= " AND id_tipo_maestro= ".$id_tipo_maestro;
        }
        if($id_tipocorresp_maestro != ""){
            $conn->sql.= " AND id_tipocorresp_maestro= ".$id_tipocorresp_maestro;
        }
        if($id_destino_maestro != ""){
            $conn->sql.= " AND id_corresp IN (SELECT id_corresp FROM ".clConstantesModelo::correspondencia_table."tbldestinatarios WHERE id_destino_maestro= ".$id_destino_maestro.")";
        }
        //$conn->sql.= "ORDER BY id_corresp DESC";
        /*$data= $conn->ejecutarSentencia(2);
        return $data;*/
        if($id_estatus_maestro != 194 && $id_estatus_maestro != ""){
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $conn->sql.= "UNION SELECT id_corresp, id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo_maestro, ";
        $conn->sql.= "id_tipocorresp_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipocorresp_maestro) AS nombre_tipocorresp_maestro, ";
        $conn->sql.= "id_unidad_maestro,	(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad_maestro) AS nombre_unidad_maestro, ";
        $conn->sql.= "to_char(dtmfecha, 'DD/MM/YYYY') as fecha, to_char(dtmfecha, 'HH:MI:SS') as hora, strasunto, strcuerpo, lngenviada, strcorrelativo, ";
        $conn->sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tblcorrespondencias.id_contacto) AS nombre_contacto, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
        $conn->sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias WHERE bolborrado= 0 AND id_estatus_maestro= ".$id_estatus_maestro." ";
        if($id_estatus_maestro == 195){
            $conn->sql.= "AND id_contacto IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_coord_maestro= ".$id_unidad_maestro.") ";
        }else if($id_estatus_maestro == 196 || $id_estatus_maestro == 198 || $id_estatus_maestro == 199){
            $conn->sql.= "AND id_contacto IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_dpto_maestro= ".$id_unidad_maestro.") ";
        }
        $conn->sql.= "AND id_unidad_maestro IN (select id_maestro from ".clConstantesModelo::correspondencia_table."tblmaestros where id_origen= ".$id_unidad_maestro." OR id_maestro= ".$id_unidad_maestro.") ";
        if($dtmfechaD != "" || $dtmfechaH != ""){
            $conn->sql.= " AND dtmfecha BETWEEN to_date('".$dtmfechaD."', 'DD/MM/YYYY') AND to_date('".$dtmfechaH."', 'DD/MM/YYYY')";
        }
        if($id_estatus_maestro != ""){
            $conn->sql.= " AND id_estatus_maestro= ".$id_estatus_maestro;
        }
        if($strasunto != ""){
            $conn->sql.= " AND UPPER(strasunto) LIKE UPPER('%".$strasunto."%')";
        }
        if($id_tipo_maestro != ""){
            $conn->sql.= " AND id_tipo_maestro= ".$id_tipo_maestro;
        }
        if($id_tipocorresp_maestro != ""){
            $conn->sql.= " AND id_tipocorresp_maestro= ".$id_tipocorresp_maestro;
        }
        if($id_destino_maestro != ""){
            $conn->sql.= " AND id_corresp IN (SELECT id_corresp FROM ".clConstantesModelo::correspondencia_table."tbldestinatarios WHERE id_destino_maestro= ".$id_destino_maestro.")";
        }
        $conn->sql.= "ORDER BY id_corresp DESC";
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //exit ($conn->sql);
        $_pagi_sql= $conn->sql;
        $_pagi_cuantos = 10;
        $_pagi_nav_num_enlaces = 5;
        $_pagi_actual = $pagina;
        $_SESSION['filtros']= array('pagina'=>$pagina, 'dtmfechaD'=>$dtmfechaD, 'dtmfechaH'=>$dtmfechaH, 'id_estatus_maestro'=>$id_estatus_maestro, 'strasunto'=>$strasunto, 'id_tipo_maestro'=>$id_tipo_maestro, 'id_tipocorresp_maestro'=>$id_tipocorresp_maestro, 'id_destino_maestro'=>$id_destino_maestro);
        include_once '../comunes/php/paginacion/paginator2.inc.php';
        $data = pg_fetch_all($_pagi_result);
        $data2[0]= $data;
        $data2[1]=  "<p>".$_pagi_navegacion."</p>";
        //echo $_pagi_navegacion;
       //echo ($conn->sql);
        return $data2;
    }

    public function selectCorrespondenciaRevision($id_estatus_maestro, $id_departamento= ""){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_corresp, id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo_maestro, ";
        $conn->sql.= "id_tipocorresp_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipocorresp_maestro) AS nombre_tipocorresp_maestro, ";
        $conn->sql.= "id_unidad_maestro,	(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad_maestro) AS nombre_unidad_maestro, ";
        $conn->sql.= "to_char(dtmfecha, 'DD/MM/YYYY') as fecha, to_char(dtmfecha, 'HH:MI:SS') as hora, strasunto, strcuerpo, lngenviada, strcorrelativo, ";
        $conn->sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tblcorrespondencias.id_contacto) AS nombre_contacto, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
        $conn->sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias WHERE bolborrado= 0 AND id_estatus_maestro= ".$id_estatus_maestro." ";
        if($id_estatus_maestro == 195){
            $conn->sql.= "AND id_contacto IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_coord_maestro= ".$id_departamento.") ";
        }else if($id_estatus_maestro == 196 || $id_estatus_maestro == 198 || $id_estatus_maestro == 199){
            $conn->sql.= "AND id_contacto IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_dpto_maestro= ".$id_departamento.") ";
        }
        $conn->sql.= "AND id_unidad_maestro IN (select id_maestro from ".clConstantesModelo::correspondencia_table."tblmaestros where id_origen= ".$id_departamento." OR id_maestro= ".$id_departamento.") ";
        $conn->sql.= "ORDER BY id_corresp DESC";
        $data= $conn->ejecutarSentencia(2);
        //echo ($conn->sql);
        return $data;
    }

    function selectAllCorrespondenciasEntrantesFiltros($id_destino_maestro, $pagina, $fechaHasta= "", $fechaDesde= "", $id_estatus_maestro= "", $strasunto= "", $id_tipo_maestro= "", $id_tipocorresp_maestro= "", $id_unidad_maestro= ""){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_corresp, id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo_maestro, ";
        $conn->sql.= "id_tipocorresp_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipocorresp_maestro) AS nombre_tipocorresp_maestro, ";
        $conn->sql.= "id_unidad_maestro,	(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad_maestro) AS nombre_unidad_maestro, ";
        $conn->sql.= "(SELECT id_origen FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad_maestro) AS id_origen_unidad_maestro, ";
        $conn->sql.= "(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= (SELECT id_origen FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad_maestro)) AS nombre_origen_unidad_maestro, ";
        $conn->sql.= "to_char(dtmfecha, 'DD/MM/YYYY') as fecha, to_char(dtmfecha, 'HH:MI:SS') as hora, strasunto, strcuerpo, lngenviada, strcorrelativo, ";
        $conn->sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tblcorrespondencias.id_contacto) AS nombre_contacto, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
        $conn->sql.= "to_char(dtmfechaenvio, 'DD/MM/YYYY') as fecha_envio, to_char(dtmfechaenvio, 'HH:MI:SS') as hora_envio, ";
        $conn->sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias WHERE id_corresp IN ";
        $conn->sql.= "(SELECT id_corresp FROM ".clConstantesModelo::correspondencia_table."tbldestinatarios WHERE id_destino_maestro= ".$id_destino_maestro." ";
        if($id_estatus_maestro != ""){
            $conn->sql.= "AND id_estatus_maestro= ".$id_estatus_maestro.") ";
        }else{
            $conn->sql.= "AND id_estatus_maestro IS NOT NULL) ";
        }
        $conn->sql.= "AND bolborrado= 0 ";
        if($fechaHasta != "" && $fechaDesde != ""){
            $conn->sql.= "AND dtmfechaenvio BETWEEN to_date('".$fechaHasta."', 'DD/MM/YYYY') AND to_date('".$fechaDesde."', 'DD/MM/YYYY') ";
        }

        if($strasunto != ""){
            $conn->sql.= "AND UPPER(strasunto) LIKE UPPER('%".$strasunto."%') ";
        }
        if($id_tipo_maestro != ""){
            $conn->sql.= "AND id_tipo_maestro=".$id_tipo_maestro." ";
        }
        if($id_tipocorresp_maestro != ""){
            $conn->sql.= "AND id_tipocorresp_maestro=".$id_tipocorresp_maestro." ";
        }
        if($id_unidad_maestro != ""){
            $conn->sql.= "AND id_unidad_maestro=".$id_unidad_maestro." ";
        }
        $conn->sql.= "ORDER BY id_corresp DESC";
       
        if($pagina == 0){
            $data= $conn->ejecutarSentencia(2);
            return $data;
        }else{
            $_pagi_sql= $conn->sql;
            //exit ("SQL: ".$conn->sql);
            $_pagi_cuantos = 10;
            $_pagi_nav_num_enlaces = 5;
            $_pagi_actual = $pagina;
            $_SESSION['filtros']= array('pagina'=>$pagina, 'fechaHasta'=>$fechaHasta, 'fechaDesde'=>$fechaDesde, 'id_estatus_maestro'=>$id_estatus_maestro, 'strasunto'=>$strasunto, 'id_tipo_maestro'=>$id_tipo_maestro, 'id_tipocorresp_maestro'=>$id_tipocorresp_maestro, 'id_unidad_maestro'=>$id_unidad_maestro);
            include_once '../comunes/php/paginacion/paginator4.inc.php';
            $data = pg_fetch_all($_pagi_result);
            $data2[0]= $data;
            $data2[1]=  "<p>".$_pagi_navegacion."</p>";
            //echo $_pagi_navegacion;
            return $data2;
        }
    }


    public function selectAllCorrespondenciaReporte($tipo, $id_unidad_maestro= null, $id_tipo_maestro= null, $id_tipocorresp_maestro= null, $condicionCreador= null, $creador= null, $condicionAsunto= null, $asunto= null, $condicionCorrelativo= null, $correlativo= null, $id_estatus_maestro= null, $condicionFecha= null, $fechaDesde=null, $fechaHasta=null){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_corresp, id_tipo_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipo_maestro) AS nombre_tipo_maestro, ";
        $conn->sql.= "id_tipocorresp_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipocorresp_maestro) AS nombre_tipocorresp_maestro, ";
        $conn->sql.= "id_unidad_maestro,	(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad_maestro) AS nombre_unidad_maestro, ";
        $conn->sql.= "(SELECT id_origen FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad_maestro) AS id_origen_unidad_maestro, ";
        $conn->sql.= "(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= (SELECT id_origen FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_unidad_maestro)) AS nombre_origen_unidad_maestro, ";
        $conn->sql.= "to_char(dtmfecha, 'DD/MM/YYYY') as fecha, to_char(dtmfecha, 'HH:MI:SS') as hora, strasunto, strcuerpo, lngenviada, strcorrelativo, ";
        $conn->sql.= "id_contacto, (SELECT strnombre||' '||strapellido FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto= tblcorrespondencias.id_contacto) AS nombre_contacto, ";
        $conn->sql.= "id_estatus_maestro, (SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_estatus_maestro) AS nombre_estatus_maestro, ";
        $conn->sql.= "to_char(dtmfechaenvio, 'DD/MM/YYYY') as fecha_envio, to_char(dtmfechaenvio, 'HH:MI:SS') as hora_envio, ";
        $conn->sql.= "bolborrado FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias WHERE bolborrado= 0 ";

        if($id_unidad_maestro != null && $tipo == 1){
            $conn->sql.= "AND id_unidad_maestro IN (".$id_unidad_maestro.") ";
        }else if($id_unidad_maestro != null && $tipo == 2){
            $conn->sql.= "AND id_corresp IN (SELECT id_corresp FROM ".clConstantesModelo::correspondencia_table."tbldestinatarios WHERE id_destino_maestro IN (".$id_unidad_maestro.") ";
            if($id_estatus_maestro != ""){
                $conn->sql.= "AND id_estatus_maestro= ".$id_estatus_maestro.") ";
            }else{
                $conn->sql.= "AND id_estatus_maestro IS NOT NULL) ";
            }
        }

        if($id_tipo_maestro != null){
            $conn->sql.= "AND id_tipo_maestro= ".$id_tipo_maestro." ";
        }

        if($id_tipocorresp_maestro != null){
            $conn->sql.= "AND id_tipocorresp_maestro= ".$id_tipocorresp_maestro." ";
        }

        if($condicionCreador != null){
            $conn->sql.= "AND id_contacto";
            if($condicionCreador == 1){
                $conn->sql.= " IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE UPPER(strnombre) LIKE UPPER('".$creador."%') or UPPER(strapellido) LIKE UPPER('".$creador."%')) ";
            }else if($condicionCreador == 2){
                $conn->sql.= " IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE UPPER(strnombre)= UPPER('".$creador."') or UPPER(strapellido)= UPPER('".$creador."')) ";
            }else if($condicionCreador == 3){
                $conn->sql.= " NOT IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE UPPER(strnombre) LIKE UPPER('%".$creador."%') or UPPER(strapellido) LIKE UPPER('%".$creador."%')) ";
            }else if($condicionCreador == 4){
                $conn->sql.= " IN (SELECT id_contacto FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE UPPER(strnombre) LIKE UPPER('%".$creador."%') or UPPER(strapellido) LIKE UPPER('%".$creador."%')) ";
            }
        }
        if($condicionAsunto != null){
            $conn->sql.= "AND UPPER(strasunto)";
            if($condicionAsunto == 1){
                $conn->sql.= " LIKE UPPER('".$asunto."%') ";
            }else if($condicionAsunto == 2){
                $conn->sql.= " = UPPER('".$asunto."') ";
            }else if($condicionAsunto == 3){
                $conn->sql.= " != UPPER('".$asunto."') ";
            }else if($condicionAsunto == 4){
                $conn->sql.= " LIKE UPPER('%".$asunto."%') ";
            }
        }
        if($condicionCorrelativo != null){
            $conn->sql.= "AND UPPER(strcorrelativo)";
            if($condicionCorrelativo == 1){
                $conn->sql.= " LIKE UPPER('".$correlativo."%') ";
            }else if($condicionCorrelativo == 2){
                $conn->sql.= " = UPPER('".$correlativo."') ";
            }else if($condicionCorrelativo == 3){
                $conn->sql.= " != UPPER('".$correlativo."') ";
            }else if($condicionCorrelativo == 4){
                $conn->sql.= " LIKE UPPER('%".$correlativo."%') ";
            }
        }
        if($id_estatus_maestro != null && $tipo == 1){
            $conn->sql.= "AND id_estatus_maestro= ".$id_estatus_maestro." ";
        }
        if($condicionFecha != null && $tipo == 1){
            if($condicionFecha == 1){
                $conn->sql.= "AND dtmfecha BETWEEN to_date('".$fechaDesde."', 'DD/MM/YYYY') AND to_date('".$fechaHasta."', 'DD/MM/YYYY') ";
            }else if($condicionFecha == 2){
                $conn->sql.= "AND dtmfechaenvio BETWEEN to_date('".$fechaDesde."', 'DD/MM/YYYY') AND to_date('".$fechaHasta."', 'DD/MM/YYYY') ";
            }
        }else if($condicionFecha != null && $tipo == 2){
            $conn->sql.= "AND dtmfechaenvio BETWEEN to_date('".$fechaDesde."', 'DD/MM/YYYY') AND to_date('".$fechaHasta."', 'DD/MM/YYYY') ";
        }
        //echo $conn->sql."--------------------------<br>";
        $data= $conn->ejecutarSentencia(2);
        return $data;
    }

    public function selectAllCorrespondenciaGestion($departamentos= null, $id_tipocorresp_maestro= null){
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "SELECT id_tipocorresp_maestro, ";
        $conn->sql.= "(SELECT stritema FROM ".clConstantesModelo::correspondencia_table."tblmaestros WHERE id_maestro= id_tipocorresp_maestro) AS nombre_tipocorresp_maestro, ";
        $conn->sql.= "(SELECT COUNT(*) FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias tc WHERE tc.id_estatus_maestro= 194 ";
        $conn->sql.= "AND tc.id_tipocorresp_maestro= c.id_tipocorresp_maestro AND bolborrado= 0 ";
        if($departamentos != null){
            $conn->sql.= "AND tc.id_unidad_maestro in (".$departamentos.") ";
        }
        $conn->sql.= ") AS borrador, ";
        $conn->sql.= "(SELECT COUNT(*) FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias tc WHERE tc.id_estatus_maestro= 195 ";
        $conn->sql.= "AND tc.id_tipocorresp_maestro= c.id_tipocorresp_maestro AND bolborrado= 0 ";
        if($departamentos != null){
            $conn->sql.= "AND tc.id_unidad_maestro in (".$departamentos.") ";
        }
        $conn->sql.= ") AS enviado_coord, ";
        $conn->sql.= "(SELECT COUNT(*) FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias tc WHERE tc.id_estatus_maestro= 196 ";
        $conn->sql.= "AND tc.id_tipocorresp_maestro= c.id_tipocorresp_maestro AND bolborrado= 0 ";
        if($departamentos != null){
            $conn->sql.= "AND tc.id_unidad_maestro in (".$departamentos.") ";
        }
        $conn->sql.= ") AS enviado_gerente, ";
        $conn->sql.= "(SELECT COUNT(*) FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias tc WHERE tc.id_estatus_maestro= 197 ";
        $conn->sql.= "AND tc.id_tipocorresp_maestro= c.id_tipocorresp_maestro AND bolborrado= 0 ";
        if($departamentos != null){
            $conn->sql.= "AND tc.id_unidad_maestro in (".$departamentos.") ";
        }
        $conn->sql.= ") AS devuelto_analista, ";
        $conn->sql.= "(SELECT COUNT(*) FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias tc WHERE tc.id_estatus_maestro= 199 ";
        $conn->sql.= "AND tc.id_tipocorresp_maestro= c.id_tipocorresp_maestro AND bolborrado= 0 ";
        if($departamentos != null){
            $conn->sql.= "AND tc.id_unidad_maestro in (".$departamentos.")";
        }
        $conn->sql.= ") AS enviadas ";
        $conn->sql.= "FROM ".clConstantesModelo::correspondencia_table."tblcorrespondencias c WHERE bolborrado= 0 ";
        if($departamentos != null){
            $conn->sql.= "AND id_unidad_maestro IN (".$departamentos.") ";
        }
        if($id_tipocorresp_maestro != null){
            $conn->sql.= "AND id_tipocorresp_maestro= ".$id_tipocorresp_maestro." ";
        }
        $conn->sql.= "GROUP BY id_tipocorresp_maestro ORDER BY nombre_tipocorresp_maestro";
        $data= $conn->ejecutarSentencia(2);
        //echo $conn->sql."--------------------------<br>";
        return $data;
    }

    public function updateFechaEnvio($id_corresp) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "UPDATE ".clConstantesModelo::correspondencia_table."tblcorrespondencias SET dtmfechaenvio= dtmfecha WHERE id_corresp= ".$id_corresp;
        $data= $conn->ejecutarSentencia();
        return $data;
    }

    public function buscarCiudad($idoficina)
    {
    	$conn= new Conexion();
        $conn->abrirConexion();
        $conn->sql= "select stritemc as ciudad from ".clConstantesModelo::correspondencia_table."tblmaestros where id_maestro = ".$idoficina;
        $data= $conn->ejecutarSentencia(2);
        return $data;
    }
}
?>
