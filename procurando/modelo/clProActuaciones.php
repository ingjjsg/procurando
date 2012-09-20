<?php
require_once '../controlador/Conexion.php';
 /**
 * Description of clTblasociaciones
 * @author jsuarez
 */
class clTblproactuaciones {

//=========================== VAR ===================




  private   $id_proactuaciones;

  private   $id_tipo_actuacion;

  private   $id_actuacion;

  private   $strdescripcionactuacion;

  private   $fecactuacion;

  private   $bolborrado;

  private   $strnombreactuacion;

//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     if($request['id_proactuaciones'] != ""){
        $this->id_proactuaciones= $request['id_proactuaciones'];
     }


     if($request['id_tipo_actuacion'] != ""){
        $this->id_tipo_actuacion= $request['id_tipo_actuacion'];
     }


     if($request['id_actuacion'] != ""){
        $this->id_actuacion= $request['id_actuacion'];
     }


     if($request['strdescripcionactuacion'] != ""){
        $this->strdescripcionactuacion= $request['strdescripcionactuacion'];
     }


     if($request['fecactuacion'] != ""){
        $this->fecactuacion= $request['fecactuacion'];
     }


     if($request['bolborrado'] != ""){
        $this->bolborrado= $request['bolborrado'];
     }

     if($request['strnombreactuacion'] != ""){
        $this->strnombreactuacion= $request['strnombreactuacion'];
     }

}
//=========================== GET ===================




    public function getId_proactuaciones(){
        return $this->id_proactuaciones;
    }



    public function getId_tipo_actuacion(){
        return $this->id_tipo_actuacion;
    }



    public function getId_actuacion(){
        return $this->id_actuacion;
    }



    public function getStrdescripcionactuacion(){
        return $this->strdescripcionactuacion;
    }



    public function getFecactuacion(){
        return $this->fecactuacion;
    }



    public function getBolborrado(){
        return $this->bolborrado;
    }


    public function getStrnombreactuacion(){
        return $this->strnombreactuacion;
    }



//=========================== SET ===================




    public function setId_proactuaciones($id_proactuaciones){
        return $this->id_proactuaciones=$id_proactuaciones;
    }



    public function setId_tipo_actuacion($id_tipo_actuacion){
        return $this->id_tipo_actuacion=$id_tipo_actuacion;
    }



    public function setId_actuacion($id_actuacion){
        return $this->id_actuacion=$id_actuacion;
    }



    public function setStrdescripcionactuacion($strdescripcionactuacion){
        return $this->strdescripcionactuacion=$strdescripcionactuacion;
    }



    public function setFecactuacion($fecactuacion){
        return $this->fecactuacion=$fecactuacion;
    }



    public function setBolborrado($bolborrado){
        return $this->bolborrado=$bolborrado;
    }


    public function setStrnombreactuacion($strnombreactuacion){
        return $this->strnombreactuacion=$strnombreactuacion;
    }

    
     public function selectDetalleActuacionExpediente($id_proactuaciones,$id_expediente_actuacion) {
               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql = "SELECT
			id_proexpediente_actuaciones, id_proexpediente, id_tipo_actuacion, id_actuacion, id_escrito, strdescripcionactuacion, to_char(fecactuacion,'DD/MM/YYYY') as fecactuacion, strobservacion, strexpedientetribunal
                    from
                    " . clConstantesModelo::scsd_table . "tblproexpediente_actuaciones"; 
                   $sql.=" where id_proexpediente_actuaciones=".$id_proactuaciones." and id_proexpediente=".$id_expediente_actuacion;
//                   exit($sql);
               $conn->sql = $sql;
               $data = $conn->ejecutarSentencia (2);
               $conn->cerrarConexion ();
               return $data;
     }    
    
     public function selectAllActuacionesExpediente($id_expediente) {
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql = "";
         $sql = "SELECT
                b.id_proexpediente_actuaciones, b.id_proexpediente, b.id_tipo_actuacion, b.id_actuacion, b.strdescripcionactuacion, c.strnombreactuacion,
                to_char(b.fecactuacion,'DD/MM/YYYY') as fecactuacion,
                (SELECT stritema FROM " . clConstantesModelo::scsd_table . "tblmaestros a1 WHERE a1.id_maestro=b.id_tipo_actuacion) AS              tipo,
                (SELECT stritema FROM " . clConstantesModelo::scsd_table . "tblmaestros a1 WHERE a1.id_maestro=b.id_actuacion) AS               actuacion
            from
            " . clConstantesModelo::scsd_table . "tblproexpediente_actuaciones b, tblproactuaciones c  where b.id_escrito=c.id_proactuaciones and b.id_proexpediente=".$id_expediente;
//         exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;  
     }    
    
    
    public function selectAllActuacionesHijos($id_padre,$id_hijo) {
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql = "";
         $sql = "SELECT
                id_proactuaciones, id_tipo_actuacion, id_actuacion, strdescripcionactuacion,strnombreactuacion, 
                (SELECT stritema
                    FROM " . clConstantesModelo::scsd_table . "tblmaestros a1 WHERE a1.id_maestro=id_tipo_actuacion) AS              tipo,
                (SELECT stritema
                    FROM " . clConstantesModelo::scsd_table . "tblmaestros a1 WHERE a1.id_maestro=id_actuacion) AS               actuacion
            from
            " . clConstantesModelo::scsd_table . "tblproactuaciones where id_tipo_actuacion=".$id_padre." and id_actuacion=".$id_hijo;
//         exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;  
     }


     public function selectDetalleActuacion($id_proactuaciones) {
               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql = "SELECT
			id_proactuaciones, id_tipo_actuacion, id_actuacion, strdescripcionactuacion,to_char(fecactuacion,'DD/MM/YYYY') as fecactuacion, strnombreactuacion
                    from
                    " . clConstantesModelo::scsd_table . "tblproactuaciones"; 
                   $sql.=" where id_proactuaciones=".$id_proactuaciones;
               $conn->sql = $sql;
               $data = $conn->ejecutarSentencia (2);
               $conn->cerrarConexion ();
               return $data;
     }
     
     public function selectDetalleActuacionReporte($id_proactuaciones) {
               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql = "SELECT id_proactuaciones, 
                       tipo_actuacion.stritema tipo_actuacion, 
                       actuacion.stritema as actuacion, 
                       strdescripcionactuacion, 
                       to_char(fecactuacion,'DD/MM/YYYY') as fecactuacion, 
                       strnombreactuacion
                    from
                    " . clConstantesModelo::scsd_table . "tblproactuaciones 
                        inner join " . clConstantesModelo::scsd_table ."tblmaestros tipo_actuacion on tipo_actuacion.id_maestro=id_proactuaciones 
                        inner join " . clConstantesModelo::scsd_table ."tblmaestros actuacion on actuacion.id_maestro=id_actuacion"; 
                   $sql.=" where id_proactuaciones=".$id_proactuaciones;
               $conn->sql = $sql;
               $data = $conn->ejecutarSentencia (2);
               $conn->cerrarConexion ();
               return $data;
     }

     public function selectAllActuaciones() {
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql = "";
         $sql = "SELECT
                id_proactuaciones, id_tipo_actuacion, id_actuacion, strdescripcionactuacion, 
         to_char(fecactuacion,'DD/MM/YYYY') as fecactuacion, strnombreactuacion, 
                (SELECT stritema
                    FROM " . clConstantesModelo::scsd_table . "tblmaestros a1 WHERE a1.id_maestro=id_tipo_actuacion) AS              tipo,
                (SELECT stritema
                    FROM " . clConstantesModelo::scsd_table . "tblmaestros a1 WHERE a1.id_maestro=id_actuacion) AS               actuacion
            from
            " . clConstantesModelo::scsd_table . "tblproactuaciones";
//         exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;  
     }

     public function Actualizar() {
              $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "update " . clConstantesModelo::scsd_table . "tblproactuaciones
                      set
                      id_tipo_actuacion=".$this->getId_tipo_actuacion().",
                      id_actuacion=".$this->getId_actuacion().",
		      strnombreactuacion='".$this->getStrnombreactuacion()."', 			
                      fecactuacion=to_date('".$this->getFecactuacion()."','dd/mm/yyyy') ,
                      strdescripcionactuacion='".$this->getStrdescripcionactuacion()."' where 			 	           id_proactuaciones=".$this->getId_proactuaciones();
               $conn->sql = $sql;
               $conn->ejecutarSentencia ();
               $conn->cerrarConexion ();
               return true;
      }

     public function insertar() {
              $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "insert into " . clConstantesModelo::scsd_table . "tblproactuaciones (
               id_tipo_actuacion,id_actuacion,fecactuacion,strnombreactuacion,strdescripcionactuacion) values(";
               $sql.= $this->getId_tipo_actuacion().",";
               $sql.= $this->getId_actuacion().",";
               $sql.= "to_date('".$this->getFecactuacion()."','dd/mm/yyyy') ,'";
               $sql.= $this->getStrnombreactuacion()."','";
               $sql.= $this->getStrdescripcionactuacion()."')";
               $conn->sql = $sql;
               $conn->ejecutarSentencia ();
               $conn->cerrarConexion ();
               return true;
     }


/*
	static public function getNombreAsociacion_vista_cliente($id_cliente) {
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql = "select strrif, strnombre_asociacion from ".clConstantesModelo::correspondencia_table . "tblasociaciones  where id_cliente=".$id_cliente;        
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data[0][strrif]." - ".$data[0][strnombre_asociacion];
    }                
    
    public function nextValAsociacion() {
               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql="SELECT last_value as maximo FROM " . clConstantesModelo::correspondencia_table . "tblasociaciones_lngcodigo_asociacion_seq";
               $conn->sql = $sql;
               $data = $conn->ejecutarSentencia (2);
               if ($data)
               {
                    $maximo=$data[0]['maximo'];
               }
               $conn->cerrarConexion ();
               return $maximo;
     }
	static public function getNombreAsociacion_vista($lngcodigo) {
	    $sql = "select strnombre_asociacion from ".clConstantesModelo::scsd_table . "tblasociaciones  where lngcodigo_asociacion=".$lngcodigo;
	    $connection = Connection::getInstance ();
		$connection->query ( $sql );
		$dataArray = $connection->fetch_all ( Connection::DB_ASSOC );
		if (empty ( $dataArray ))
			$strnombre_asociacion = "";
		else
			$strnombre_asociacion = trim($dataArray [0] [strnombre_asociacion]);
		return $strnombre_asociacion;
	}

     public function Actualizar() {
              $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "update " . clConstantesModelo::scsd_table . "tblasociaciones
                              set
                              strnombre_asociacion='".$this->getStrnombre_asociacion()."',
                              strweb='".$this->getStrweb()."',
                              dtmfechafun=to_date('".$this->getDtmfechafun()."','dd/mm/yyyy') ,
                              strtelefono_asociacion='".$this->getStrtelefono_asociacion()."',
                              strdireccion_asociacion='".$this->getStrdireccion_asociacion()."',
                              strrif='".$this->getStrrif()."',
                              id_municipio_asociacion=".$this->getId_municipio_asociacion().",
                              id_parroquia_asociacion=".$this->getId_parroquia_asociacion().",
                              id_cliente=".$this->getId_cliente().",                                  
                              id_ramo=".$this->getId_ramo()." where lngcodigo_asociacion=".$this->getLngcodigo_asociacion();
               $conn->sql = $sql;
               $conn->ejecutarSentencia ();
               $conn->cerrarConexion ();
               return $this->getStrrif();
      }

      


	static public function getRifBuscado($rif) {
	    $sql = "select lngcodigo_asociacion from " . clConstantesModelo::scsd_table . "tblasociaciones where upper(strrif)='".strtoupper($rif)."'";
	    $connection = Connection::getInstance ();
		$connection->query ( $sql );
		$dataArray = $connection->fetch_all ( Connection::DB_ASSOC );
		if (empty ( $dataArray ))
			$lngcodigo_asociacion = "";
		else
			$lngcodigo_asociacion = $dataArray [0] [lngcodigo_asociacion];
		return $lngcodigo_asociacion;
	}


	static public function getNombreAsociacion($rif) {
	    $sql = "select strnombre_asociacion from " . clConstantesModelo::scsd_table . "tblasociaciones where strrif='".$rif."'";
	    $connection = Connection::getInstance ();
		$connection->query ( $sql );
		$dataArray = $connection->fetch_all ( Connection::DB_ASSOC );
		if (empty ( $dataArray ))
			$strnombre_asociacion = "";
		else
			$strnombre_asociacion = $dataArray [0] [strnombre_asociacion];
		return $strnombre_asociacion;
	}





     public function selectAllPersonasAsociadas($lngcodigo_asociacion) {
               $sql = "";
               $sql = "SELECT *
                    from
                    " . clConstantesModelo::scsd_table . "v_personasasociadas where ";
                    $sql.=" lngcodigo_asociacion='".$lngcodigo_asociacion."'";
               return $sql;
     }

     public function AsociarPersona($lngcodigo_asociacion,$lngcodigo) {
              $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "insert into
							  " . clConstantesModelo::scsd_table . "tblasociaciones_personas (
							  lngcodigo,
							  lngcodigo_asociacion)
                               values(".$lngcodigo.",".
                              $lngcodigo_asociacion.")";
               $conn->sql = $sql;
               $conn->ejecutarSentencia ();
               $conn->cerrarConexion ();
               return $lngcodigo_asociacion;
     }

	static public function getLngcodigoBuscado($lngcodigo_asociacion,$lngcodigo) {
	    $sql = "select lngcodigo from ".clConstantesModelo::scsd_table . "tblasociaciones_personas  where lngcodigo=".$lngcodigo." and lngcodigo_asociacion=".$lngcodigo_asociacion;;
	    $connection = Connection::getInstance ();
		$connection->query ( $sql );
		$dataArray = $connection->fetch_all ( Connection::DB_ASSOC );
		if (empty ( $dataArray ))
			$lngcodigo = "";
		else
			$lngcodigo = trim($dataArray [0] [lngcodigo]);
		return $lngcodigo;
	}

    public function selectAllAsociacionesAyudas($id_instituto,$strrif="") {
               $sql = "SELECT
                        a.lngcodigo_asociacion,
                        a.strnombre_asociacion,
                        a.id_municipio_asociacion,
                        a.id_parroquia_asociacion,
                        a.strrif,
                        b.id_organismo,
                        b.id_ayuda,
                        b.dtmfecha,
                        b.strcontenido,
                        b.intperafect,
                        b.strexpediente,
                        b.act,
                        b.bolborrado,
                        b.lngcodigo,
                        b.lngcodigo_ayuda,
                        b.id_estatus,
                        b.monto,
                        (select stritema from " . clConstantesModelo::scsd_table . "tblmaestros m where m.id_maestro=b.id_organismo limit 1) as instituto
                    from
                    " . clConstantesModelo::scsd_table . "tblasociaciones a, " . clConstantesModelo::scsd_table . "tblayuda b where a.lngcodigo_asociacion=b.lngcodigo and a.bolborrado=0 and b.bolborrado=0 ";
                    if($strrif!='') $sql.=" and a.strrif='".$strrif."'";
                    if(intval($id_instituto)>0) $sql.=" and b.id_organismo=".$id_instituto." order by a.strrif";
                    return $sql;
     }

     public function selectAllAsociacionesMunicipioOrganismo($id_instituto=0,$id_municipio=0) {
               $sql = "SELECT
                        a.lngcodigo_asociacion,
                        a.strnombre_asociacion,
                        a.id_municipio_asociacion,
                        a.id_parroquia_asociacion,
                        a.strrif,
                        b.id_organismo,
                        b.id_ayuda,
                        b.dtmfecha,
                        b.strcontenido,
                        b.intperafect,
                        b.strexpediente,
                        b.act,
                        b.bolborrado,
                        b.lngcodigo,
                        b.lngcodigo_ayuda,
                        b.id_estatus,
                        b.monto,
                        (select stritema from " . clConstantesModelo::scsd_table . "tblmaestros m where m.id_maestro=b.id_organismo limit 1) as instituto
                    from
                    " . clConstantesModelo::scsd_table . "tblasociaciones a, " . clConstantesModelo::scsd_table . "tblayuda b where a.lngcodigo_asociacion=b.lngcodigo and a.bolborrado=0 and b.bolborrado=0 ";
                    if(intval($id_instituto)>0) $sql.=" and b.id_organismo=".$id_instituto;
                    if(intval($id_municipio)>0) $sql.=" and a.id_municipio_asociacion=".$id_municipio." order by a.strrif";
                    return $sql;
     }

     public function eliminarAsociacion($lngcodigo_asociacion){
        $conn = new Conexion ();
        $conn->abrirConexion ();
        $sql = "delete from ". clConstantesModelo::scsd_table . "tblasociaciones where lngcodigo_asociacion=".$lngcodigo_asociacion;
        $conn->sql = $sql;
        $conn->ejecutarSentencia ();
        $conn->cerrarConexion ();
        return $lngcodigo_asociacion;

     }

     public function eliminarAyuda($lngcodigo){
         $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "update " . clConstantesModelo::scsd_table . "tblayuda
							  set
							  bolborrado=1
                              where lngcodigo=".$lngcodigo;
               $conn->sql = $sql;
               $conn->ejecutarSentencia ();
               $conn->cerrarConexion ();
               return $lngcodigo;
     }

     public function eliminarPersonaAsociacion($lngcodigo_asociacion,$lngcodigo){
         $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "delete from " . clConstantesModelo::scsd_table . "tblasociaciones_personas
                      where lngcodigo_asociacion=".$lngcodigo_asociacion." and lngcodigo=".$lngcodigo;
               $conn->sql = $sql;
               $conn->ejecutarSentencia ();
               $conn->cerrarConexion ();
               return $lngcodigo_asociacion;

     }
*/

 }
