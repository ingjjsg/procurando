<?php
require_once '../controlador/Conexion.php';
 /**
 * Description of clTblasociaciones
 * @author jsuarez
 */
 class clTblasociaciones {

//=========================== VAR ===================




  private   $lngcodigo_asociacion;

  private   $strnombre_asociacion;

  private   $strweb;

  private   $id_sexo;

  private   $dtmfechafun;

  private   $strdireccion_asociacion;

  private   $strrif;

  private   $strtelefono_asociacion;

  private   $id_municipio_asociacion;

  private   $id_parroquia_asociacion;

  private   $bolborrado;

  private   $id_ramo;
  
  private   $id_cliente;  

//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     if($request['lngcodigo_asociacion'] != ""){
        $this->lngcodigo_asociacion= $request['lngcodigo_asociacion'];
     }


     if($request['strnombre_asociacion'] != ""){
        $this->strnombre_asociacion= $request['strnombre_asociacion'];
     }


     if($request['strweb'] != ""){
        $this->strweb= $request['strweb'];
     }


     if($request['id_sexo'] != ""){
        $this->id_sexo= $request['id_sexo'];
     }


     if($request['dtmfechafun'] != ""){
        $this->dtmfechafun= $request['dtmfechafun'];
     }


     if($request['strdireccion_asociacion'] != ""){
        $this->strdireccion_asociacion= $request['strdireccion_asociacion'];
     }


     if($request['strrif'] != ""){
        $this->strrif= $request['strrif'];
     }


     if($request['strtelefono_asociacion'] != ""){
        $this->strtelefono_asociacion= $request['strtelefono_asociacion'];
     }

     if($request['id_municipio_asociacion'] != ""){
        $this->id_municipio_asociacion= $request['id_municipio_asociacion'];
     }


     if($request['id_parroquia_asociacion'] != ""){
        $this->id_parroquia_asociacion= $request['id_parroquia_asociacion'];
     }


     if($request['bolborrado'] != ""){
        $this->bolborrado= $request['bolborrado'];
     }

     if($request['id_ramo'] != ""){
        $this->id_ramo= $request['id_ramo'];
     }
     
     if($request['id_cliente'] != ""){
        $this->id_cliente= $request['id_cliente'];
     }     

}
//=========================== GET ===================




    public function getLngcodigo_asociacion(){
        return $this->lngcodigo_asociacion;
    }



    public function getStrnombre_asociacion(){
        return $this->strnombre_asociacion;
    }



    public function getStrweb(){
        return $this->strweb;
    }



    public function getDtmfechafun(){
        return $this->dtmfechafun;
    }



    public function getStrtelefono_asociacion(){
        return $this->strtelefono_asociacion;
    }



    public function getStrdireccion_asociacion(){
        return $this->strdireccion_asociacion;
    }



    public function getStrrif(){
        return $this->strrif;
    }



    public function getId_municipio_asociacion(){
        return $this->id_municipio_asociacion;
    }


    public function getId_parroquia_asociacion(){
        return $this->id_parroquia_asociacion;
    }


    public function getId_ramo(){
        return $this->id_ramo;
    }
    
    public function getId_cliente(){
        return $this->id_cliente;
    }    

//=========================== SET ===================




    public function setLngcodigo_asociacion($lngcodigo_asociacion){
        return $this->lngcodigo_asociacion=$lngcodigo_asociacion;
    }



    public function setStrnombre_asociacion($strnombre_asociacion){
        return $this->strnombre_asociacion=$strnombre_asociacion_asociacion;
    }



    public function setStrweb($strweb){
        return $this->strweb=$strweb;
    }




    public function setDtmfechafun($dtmfechafun){
        exit($dtmfechafun);
        return $this->dtmfechafun=$dtmfechafun;
    }



    public function setStrtelefono_asociacion($strtelefono_asociacion){
        return $this->strtelefono_asociacion=$strtelefono_asociacion;
    }



    public function setStrdireccion_asociacion($strdireccion_asociacion){
        return $this->strdireccion_asociacion=$strdireccion_asociacion;
    }


    public function setStrrif($strrif){
        return $this->strrif=$strrif;
    }



    public function setId_municipio_asociacion($id_municipio_asociacion){
        return $this->id_municipio_asociacion=$id_municipio_asociacion;
    }


    public function setId_parroquia_asociacion($id_parroquia_asociacion){
        return $this->id_parroquia_asociacion=$id_parroquia_asociacion;
    }

    public function setId_ramo($id_ramo){
        return $this->id_ramo=$id_ramo;
    }
    
    public function setId_cliente($id_cliente){
        return $this->id_cliente=$id_cliente;
    }    

    public static function getrifAsociasion($rif){
        $conn= new Conexion();
        $conn->abrirConexion();
        $sql="SELECT strrif FROM ".clConstantesModelo::correspondencia_table."tblasociaciones WHERE strrif='".$rif."'";        
        //exit($sql);
        $conn->sql= $sql;
        $data= $conn->ejecutarSentencia(2);
        $conn->cerrarConexion();
        return $data[0][strrif];
    }     

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

      
     public function insertar() {
              $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "insert into
                      " . clConstantesModelo::scsd_table . "tblasociaciones (
                              strnombre_asociacion,
                              strweb,
                              dtmfechafun,
                              strtelefono_asociacion,
                              strdireccion_asociacion,
                              strrif,
                              id_municipio_asociacion,
                              id_parroquia_asociacion,
                              id_ramo, id_cliente)
                               values('".
                              $this->getStrnombre_asociacion()."','".
                              $this->getStrweb()."',".
                              "to_date('".$this->getDtmfechafun()."','dd/mm/yyyy') ,'".
                              $this->getStrtelefono_asociacion()."','".
                              $this->getStrdireccion_asociacion()."','".
                              $this->getStrrif()."',".
                              $this->getId_municipio_asociacion().",".
                              $this->getId_parroquia_asociacion().",".
                              $this->getId_ramo().",".$this->getId_cliente().")";
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

     public function selectDetalleAsociacion($lngcodigo_asociacion='',$rif='') {
               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql = "SELECT
                        lngcodigo_asociacion,
                        strnombre_asociacion,
                        strweb,
                        to_char(dtmfechafun,'DD/MM/YYYY') as dtmfechafun,
                        strtelefono_asociacion,
                        strdireccion_asociacion,
                        strrif,
                        id_municipio_asociacion,
                        id_parroquia_asociacion,
                        id_ramo,
                        id_cliente
                    from
                    " . clConstantesModelo::scsd_table . "tblasociaciones"; 
               if ($lngcodigo_asociacion!='')
                   $sql.=" where lngcodigo_asociacion=".$lngcodigo_asociacion;
               if ($rif!='')
                   $sql.=" where strrif='".$rif."'"; 
//               exit($sql);
               $conn->sql = $sql;
               $data = $conn->ejecutarSentencia (2);
               $conn->cerrarConexion ();
               return $data;
     }
     

     public function selectDetalleAsociacionReporte($lngcodigo_asociacion) {
               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql="SELECT 
                   b.lngcodigo_asociacion, 
                   b.strnombre_asociacion, 
                   b.strweb, 
                   to_char(b.dtmfechafun,'DD/MM/YYYY') as dtmfechafun, 
                   b.strtelefono_asociacion, 
                   b.strdireccion_asociacion, 
                   b.strrif, 
                   b.id_municipio_asociacion, 
                   b.id_parroquia_asociacion, 
                   b.id_ramo, 
                   b.id_cliente, 
                   (SELECT a2.strcedula||'  '||a2.strapellido||', '||a2.strnombre FROM " . clConstantesModelo::scsd_table . "tbl_clientes a2 WHERE a2.id_cliente=b.id_cliente) AS cliente, 
                   (SELECT stritema FROM " . clConstantesModelo::scsd_table . "tblmaestros a1 WHERE a1.id_maestro=b.id_municipio_asociacion) AS id_municipio_asociacion_text, 
                   (SELECT stritema FROM " . clConstantesModelo::scsd_table . "tblmaestros a1 WHERE a1.id_maestro=b.id_parroquia_asociacion) AS id_parroquia_asociacion_text, 
                   (SELECT stritema FROM " . clConstantesModelo::scsd_table . "tblmaestros a1 WHERE a1.id_maestro=b.id_ramo) AS id_ramo_text 
                   from 
                   " . clConstantesModelo::scsd_table . "tblasociaciones b where lngcodigo_asociacion=".$lngcodigo_asociacion;
               $conn->sql = $sql;
               $data = $conn->ejecutarSentencia (2);
               $conn->cerrarConexion ();
               return $data;
     }     

     public function selectAllAsociacion() {
         $conn= new Conexion();
         $conn->abrirConexion();
         $sql = "";
         $sql = "SELECT
                lngcodigo_asociacion,
                strnombre_asociacion,
                strweb,
                to_char(dtmfechafun,'DD/MM/YYYY') as dtmfechafun,
                strtelefono_asociacion,
                strdireccion_asociacion,
                strrif,
                (SELECT stritema
                    FROM " . clConstantesModelo::scsd_table . "tblmaestros a1 WHERE a1.id_maestro=id_municipio_asociacion) AS municipio,
                id_municipio_asociacion,
                (SELECT stritema
                    FROM " . clConstantesModelo::scsd_table . "tblmaestros a1 WHERE a1.id_maestro=id_parroquia_asociacion) AS parroquia,
                id_parroquia_asociacion,
                id_ramo
            from
            " . clConstantesModelo::scsd_table . "tblasociaciones";
//         exit($sql);
         $conn->sql=$sql;
         $data = $conn->ejecutarSentencia(2);
         return $data;  
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

 }
