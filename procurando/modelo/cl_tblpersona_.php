<?php
 require_once '../controlador/Conexion.php';
 /**
 * Description of clTblpersona
 * @author jsuarez
 */
 class clTblpersona {

//=========================== VAR ===================




  private   $lngcodigo;

  private   $strnombre;

  private   $strapellido;

  private   $stremail;

  private   $stremailhide;

  private   $id_sexo;

  private   $dtmfechapnac;

  private   $strtelefono;

  private   $strdireccion;

  private   $strstatus;

  private   $id_estado_civil;

  private   $id_profesion;

  private   $srtrabaja;

  private   $srtrepresentante;

  private   $id_tipo_persona;

  private   $strrif;

  private   $id_municipio;

  private   $id_parroquia;

  private   $strnacionalidad;

  private   $cedula;

  private   $lngcodigo_asociacion;

  private   $strclave;

  private   $strreclave;


//=========================== FUNCION LLENAR ===================




public function llenar($request)
{
     if($request['lngcodigo'] != ""){
        $this->lngcodigo= $request['lngcodigo'];
     }


     if($request['strnombre'] != ""){
        $this->strnombre= $request['strnombre'];
     }


     if($request['strapellido'] != ""){
        $this->strapellido= $request['strapellido'];
     }


     if($request['stremail'] != ""){
        $this->stremail= $request['stremail'];
     }


     if($request['stremailhide'] != ""){
        $this->stremailhide= $request['stremailhide'];
     }

     if($request['id_sexo'] != ""){
        $this->id_sexo= $request['id_sexo'];
     }


     if($request['dtmfechapnac'] != ""){
        $this->dtmfechapnac= $request['dtmfechapnac'];
     }


     if($request['strtelefono'] != ""){
        $this->strtelefono= $request['strtelefono'];
     }


     if($request['strdireccion'] != ""){
        $this->strdireccion= $request['strdireccion'];
     }


     if($request['strstatus'] != ""){
        $this->strstatus= $request['strstatus'];
     }


     if($request['id_estado_civil'] != ""){
        $this->id_estado_civil= $request['id_estado_civil'];
     }


     if($request['id_profesion'] != ""){
        $this->id_profesion= $request['id_profesion'];
     }


     if($request['srtrabaja'] != ""){
        $this->srtrabaja= $request['srtrabaja'];
     }
     else $this->srtrabaja=0;


     if($request['srtrepresentante'] != ""){
        $this->srtrepresentante= $request['srtrepresentante'];
     }
     else $this->srtrepresentante=0;


     if($request['id_tipo_persona'] != ""){
        $this->id_tipo_persona= $request['id_tipo_persona'];
     }


     if($request['strrif'] != ""){
        $this->strrif= $request['strrif'];
     }


     if($request['id_municipio'] != ""){
        $this->id_municipio= $request['id_municipio'];
     }


     if($request['id_parroquia'] != ""){
        $this->id_parroquia= $request['id_parroquia'];
     }


     if($request['strnacionalidad'] != ""){
        $this->strnacionalidad= $request['strnacionalidad'];
     }


     if($request['cedula'] != ""){
        $this->cedula= $request['cedula'];
     }

     if($request['strclave'] != ""){
        $this->strclave= $request['strclave'];
     }

     if($request['strreclave'] != ""){
        $this->strreclave= $request['strreclave'];
     }


     if($request['lngcodigo_asociacion'] != ""){
        $this->lngcodigo_asociacion= $request['lngcodigo_asociacion'];
     }
     else
     	$this->lngcodigo_asociacion=0;

}
//=========================== GET ===================




    public function getLngcodigo(){
        return $this->lngcodigo;
    }



    public function getStrnombre(){
        return $this->strnombre;
    }



    public function getStrapellido(){
        return $this->strapellido;
    }



    public function getStremail(){
        return $this->stremail;
    }


    public function getStremailhide(){
        return $this->stremailhide;
    }


    public function getId_sexo(){
        return $this->id_sexo;
    }



    public function getDtmfechapnac(){
        return $this->dtmfechapnac;
    }



    public function getStrtelefono(){
        return $this->strtelefono;
    }



    public function getStrdireccion(){
        return $this->strdireccion;
    }



    public function getStrstatus(){
        return $this->strstatus;
    }



    public function getId_estado_civil(){
        return $this->id_estado_civil;
    }



    public function getId_profesion(){
        return $this->id_profesion;
    }



    public function getSrtrabaja(){
        return $this->srtrabaja;
    }



    public function getSrtrepresentante(){
        return $this->srtrepresentante;
    }



    public function getId_tipo_persona(){
        return $this->id_tipo_persona;
    }



    public function getStrrif(){
        return $this->strrif;
    }



    public function getId_municipio(){
        return $this->id_municipio;
    }



    public function getId_parroquia(){
        return $this->id_parroquia;
    }



    public function getStrnacionalidad(){
        return $this->strnacionalidad;
    }



    public function getCedula(){
        return $this->cedula;
    }


    public function getLngcodigo_asociacion(){
        return $this->lngcodigo_asociacion;
    }


    public function getStrclave(){
        return $this->strclave;
    }

    public function getStrreclave(){
        return $this->strreclave;
    }


//=========================== SET ===================




    public function setLngcodigo($lngcodigo){
        return $this->lngcodigo=$lngcodigo;
    }



    public function setStrnombre($strnombre){
        return $this->strnombre=$strnombre;
    }



    public function setStrapellido($strapellido){
        return $this->strapellido=$strapellido;
    }



    public function setStremail($stremail){
        return $this->stremail=$stremail;
    }


    public function setStremailhide($stremailhide){
        return $this->stremailhide=$stremailhide;
    }


    public function setId_sexo($id_sexo){
        return $this->id_sexo=$id_sexo;
    }



    public function setDtmfechapnac($dtmfechapnac){
        return $this->dtmfechapnac=$dtmfechapnac;
    }



    public function setStrtelefono($strtelefono){
        return $this->strtelefono=$strtelefono;
    }



    public function setStrdireccion($strdireccion){
        return $this->strdireccion=$strdireccion;
    }



    public function setStrstatus($strstatus){
        return $this->strstatus=$strstatus;
    }



    public function setId_estado_civil($id_estado_civil){
        return $this->id_estado_civil=$id_estado_civil;
    }



    public function setId_profesion($id_profesion){
        return $this->id_profesion=$id_profesion;
    }



    public function setSrtrabaja($srtrabaja){
        return $this->srtrabaja=$srtrabaja;
    }



    public function setSrtrepresentante($srtrepresentante){
        return $this->srtrepresentante=$srtrepresentante;
    }



    public function setId_tipo_persona($id_tipo_persona){
        return $this->id_tipo_persona=$id_tipo_persona;
    }



    public function setStrrif($strrif){
        return $this->strrif=$strrif;
    }



    public function setId_municipio($id_municipio){
        return $this->id_municipio=$id_municipio;
    }



    public function setId_parroquia($id_parroquia){
        return $this->id_parroquia=$id_parroquia;
    }



    public function setStrnacionalidad($strnacionalidad){
        return $this->strnacionalidad=$strnacionalidad;
    }



    public function setCedula($cedula){
        return $this->cedula=$cedula;
    }

    public function setLngcodigo_asociacion($lngcodigo_asociacion){
        return $this->lngcodigo_asociacion=$lngcodigo_asociacion;
    }



	static public function getNombre($lngcodigo) {
	    $sql = "select strapellido, strnombre from ".clConstantesModelo::scsd_table . "tblpersona  where lngcodigo=".$lngcodigo;
	    $connection = Connection::getInstance ();
		$connection->query ( $sql );
		$dataArray = $connection->fetch_all ( Connection::DB_ASSOC );
		if (empty ( $dataArray ))
			$nombres = "";
		else
			$nombres = trim($dataArray [0] [strapellido]).",  ".($dataArray [0] [strnombre]);
		return $nombres;
	}






        static public function getCedulaNumerica($nacionalidad,$id_persona) {
	    $sql = "select lngcodigo from ".clConstantesModelo::scsd_table . "tblpersona  where strnacionalidad='".$nacionalidad."' and cedula='".$id_persona."'";
	    $connection = Connection::getInstance ();
		$connection->query ( $sql );
		$dataArray = $connection->fetch_all ( Connection::DB_ASSOC );
		if (empty ( $dataArray ))
			$lngcodigo = "";
		else
			$lngcodigo = $dataArray [0] [lngcodigo];
		return $lngcodigo;
	}

        static public function check_email_address($email)
                        {   if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email))
                        {
                                return false;
                        }

                              $email_array = explode("@", $email);
                              $local_array = explode(".", $email_array[0]);
                        for ($i = 0; $i < sizeof($local_array); $i++)
                        {
                             if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i]))
                                {
                      return false;
                        }
                     }

                        if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1]))
                        {
                     $domain_array = explode(".", $email_array[1]);
                     if (sizeof($domain_array) < 2)
                                 {
                        return false;
                     }
                     for ($i = 0; $i < sizeof($domain_array); $i++)
                                 {
                        if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i]))
                                                {
                           return false;
                        }
                     }
                  }
                  return true;
            }

     public function selectDetalleUsuario($lngcodigo) {
               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql = "SELECT strpassword,strdocumento,strnombre,strapellido,strtlfhab,stremail,memdireccion from
                    " . clConstantesModelo::seguridad_table . " tblcontacto where id_contacto=".$lngcodigo;
               $conn->sql = $sql;
               $data = $conn->ejecutarSentencia (2);
               $conn->cerrarConexion ();
               return $data;
     }



         static public function buscaCorreo($stremail) {
	    $sql = "select * from ".clConstantesModelo::seguridad_table . "tblcontacto  where stremail='".$stremail."'";
	    $connection = Connection::getInstance ();
		$connection->query ( $sql );
		$dataArray = $connection->fetch_all ( Connection::DB_ASSOC );

                if (empty ( $dataArray ))
			$id_contacto = "";
		else
                        $id_contacto = $dataArray [0] [id_contacto];
		return $id_contacto;
	}

        static public function actualizarDatos(){

               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql = "update
                            " . clConstantesModelo::seguridad_table . "tblcontacto
                            set
                            stremail='".$stremail."' where id_contacto=".$_SESSION['id_contacto'];
               $conn->sql = $sql;
               $conn->ejecutarSentencia ();
               $conn->cerrarConexion ();

        }



        static public function actualizarPassword($strclave){

               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql = "update
                            " . clConstantesModelo::seguridad_table . "tblcontacto
                            set
                            strpassword='".md5($strclave). "' where id_contacto=".$_SESSION['id_contacto'];
               $conn->sql = $sql;
               $conn->ejecutarSentencia ();
               $conn->cerrarConexion ();

        }

        static public function actualizarNombre($strnombre){

               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql = "update
                            " . clConstantesModelo::seguridad_table . "tblcontacto
                            set
                            strnombre='".$strnombre. "' where id_contacto=".$_SESSION['id_contacto'];
               $conn->sql = $sql;
               $conn->ejecutarSentencia ();
               $conn->cerrarConexion ();

        }

        static public function actualizarApellido($strapellido){

               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql = "update
                            " . clConstantesModelo::seguridad_table . "tblcontacto
                            set
                            strapellido='".$strapellido. "' where id_contacto=".$_SESSION['id_contacto'];
               $conn->sql = $sql;
               $conn->ejecutarSentencia ();
               $conn->cerrarConexion ();

        }

        static public function actualizarTelefono($strtelefono){

               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql = "update
                            " . clConstantesModelo::seguridad_table . "tblcontacto
                            set
                            strtlfhab='".$strtelefono. "' where id_contacto=".$_SESSION['id_contacto'];
               $conn->sql = $sql;
               $conn->ejecutarSentencia ();
               $conn->cerrarConexion ();

        }







     public function GuardarAsociacion($lngcodigo,$lngcodigo_asociacion) {
              $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql = "SELECT *
                    from
                    " . clConstantesModelo::scsd_table . " tblasociaciones_personas where bolborrado=0 and lngcodigo=".$lngcodigo;
               $conn->sql = $sql;
               $data = $conn->ejecutarSentencia (2);
               if ($data)
               {
                   $sql = "update
                                  " . clConstantesModelo::scsd_table . "tblasociaciones_personas
                                  set
                                  lngcodigo_asociacion=".trim($lngcodigo_asociacion)." where lngcodigo=".$lngcodigo;
                   $conn->sql = $sql;
                   $conn->ejecutarSentencia ();
               }
               else
               {
                   $sql = "insert into
                                  " . clConstantesModelo::scsd_table . "tblasociaciones_personas
                                  (lngcodigo_asociacion,lngcodigo) values (".trim($lngcodigo_asociacion).",".$lngcodigo.")";
                   $conn->sql = $sql;
                   $conn->ejecutarSentencia ();
               }
               $conn->cerrarConexion ();
               return $this->getLngcodigo();
     }


     public function ActualizarUsuario($lngcodigo) {
              $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "update
							  " . clConstantesModelo::seguridad_table . "tblcontacto
							  set
							  strnombre='".trim($this->getStrnombre())."',
							  strapellido='".trim($this->getStrapellido())."',
							  stremail='".trim($this->getStremail())."',
							  strtlfhab='".trim($this->getStrtelefono())."',
							  strpassword='".md5(trim($this->getStrclave()))."' where id_contacto=".$lngcodigo;
//               exit($sql);
               $conn->sql = $sql;
               $conn->ejecutarSentencia ();
               $conn->cerrarConexion ();
               return $lngcodigo;
     }

	static public function verificarClave($pass) {
            $conn = new Conexion ();
            $conn->abrirConexion ();
            $sql = "SELECT strlogin FROM ".clConstantesModelo::seguridad_table."tblcontacto WHERE id_contacto=".$_SESSION['id_contacto']." AND strpassword='".md5($pass)."' and bolborrado= 0";
	    
//            $connection = Connection::getInstance ();
//            exit ('aqui voy-. '.$sql);
             $conn->sql = $sql;
             $dataArray = $conn->ejecutarSentencia (2);
//		$connection->query ( $sql );
//		$dataArray = $connection->fetch_all ( Connection::DB_ASSOC );
		if (empty ( $dataArray ))
			return false;
		else
			return true;
	}


     public function GuardarPersona() {
              $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "insert into
							  " . clConstantesModelo::scsd_table . "tblpersona (
							  strnombre,
							  strapellido,
							  stremail,
							  id_sexo,
							  dtmfechapnac,
							  strtelefono,
							  strdireccion,
							  id_estado_civil,
							  id_profesion,
							  srtrabaja,
							  srtrepresentante,
							  id_tipo_persona,
							  id_municipio,
							  id_parroquia,
							  strnacionalidad,
							  cedula)
                               values('".
                              $this->getStrnombre()."','".
                              $this->getStrapellido()."','".
                              $this->getStremail()."',".
                              $this->getId_sexo().",".
                              "to_date('".$this->getDtmfechapnac()."','dd/mm/yyyy') ,'".
                              $this->getStrtelefono()."','".
                              $this->getStrdireccion()."',".
                              $this->getId_estado_civil().",".
                              $this->getId_profesion().",".
                              $this->getSrtrabaja().",".
                              $this->getSrtrepresentante().",".
                              "65,".
                              $this->getId_municipio().",".
                              $this->getId_parroquia().",'".
                              $this->getStrnacionalidad()."',".
							  $this->getCedula().")";
               $conn->sql = $sql;
               $conn->ejecutarSentencia ();
               $conn->cerrarConexion ();
               return $this->getCedula();
     }


     public function selectLlenarParroquia($id_municipio) {
               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql = "SELECT *
                    from
                    " . clConstantesModelo::scsd_table . " tblmaestros where bolborrado=0 and id_origen=".$id_municipio;
               $conn->sql = $sql;
               $data = $conn->ejecutarSentencia (2);
               $conn->cerrarConexion ();
               return $data;
     }

     public function selectAllPersonas($nacionalidad,$cedula) {
               $sql = "SELECT
                        lngcodigo,
                        strnombre,
                        strapellido,
                        stremail,
                        id_sexo,
                        to_char(dtmfechapnac,'DD/MM/YYYY') as dtmfechapnac,
                        strtelefono,
                        strdireccion,
                        strstatus,
                        id_estado_civil,
                        id_profesion,
                        srtrabaja,
                        srtrepresentante,
                        id_tipo_persona,
                        id_municipio,
                        id_parroquia,
                        strnacionalidad,
                        cedula
                    from
                    " . clConstantesModelo::scsd_table . " tblpersona where bolborrado=0 ";
                    if($nacionalidad!='') $sql.=" and strnacionalidad='".$nacionalidad."'";
                    if($cedula!='') $sql.=" and cedula='".$cedula."'";
                    return $sql;
     }


     public function selectDetalleAsociacion($lngcodigo) {
               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql = "SELECT
                        lngcodigo_asociacion,
                        strnombre_asociacion,
                        strrif,
                        lngcodigo
                    from
                    " . clConstantesModelo::scsd_table . " v_nombreasociaciones where lngcodigo=".$lngcodigo;
               $conn->sql = $sql;
               $data = $conn->ejecutarSentencia (2);
               $conn->cerrarConexion ();
               return $data;
     }




     public function selectDetallePersonas($id_persona) {
               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql = "SELECT
                        lngcodigo,
                        strnombre,
                        strapellido,
                        stremail,
                        id_sexo,
                        to_char(dtmfechapnac,'DD/MM/YYYY') as dtmfechapnac,
                        strtelefono,
                        strdireccion,
                        strstatus,
                        id_estado_civil,
                        id_profesion,
                        srtrabaja,
                        srtrepresentante,
                        id_tipo_persona,
                        id_municipio,
                        id_parroquia,
                        strnacionalidad,
                        cedula
                    from
                    " . clConstantesModelo::scsd_table . " tblpersona where bolborrado=0  and lngcodigo=".$id_persona."";
               $conn->sql = $sql;
               $data = $conn->ejecutarSentencia (2);
               $conn->cerrarConexion ();
               return $data;
     }

     public function buscaPersonas($nacionalidad,$id_persona) {
               $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "";
               $sql = "SELECT
                      nacionalidad,
                      cedula,
                      nombre,
                      fecha_nac,
                      centro,
                      mesa,
                      centro_viejo,
                      cod_estado,
                      estado,
                      cod_municipio,
                      municipio,
                      cod_parroquia,
                      parroquia,
                      centro_nuevo,
                      nombre_centro,
                      telefono,
                      circunscripcion,
                      telefono2,
                      direccion_vive
                    from
                    " . clConstantesModelo::cne_table . "yaracuy_registro where cedula_numerica=".$id_persona." and nacionalidad='".$nacionalidad."'";
               $conn->sql = $sql;
               $data = $conn->ejecutarSentencia (2);
               $conn->cerrarConexion ();
               return $data;
     }


     public function selectAllPersonasAyudas($id_instituto,$nacionalidad="",$cedula="") {
               $sql = "SELECT
                        a.lngcodigo,
                        a.strnombre,
                        a.strapellido,
                        a.id_municipio,
                        a.id_parroquia,
                        a.strnacionalidad,
                        a.cedula,
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
                    " . clConstantesModelo::scsd_table . "tblpersona a, " . clConstantesModelo::scsd_table . "tblayuda b where a.lngcodigo=b.lngcodigo and a.bolborrado=0 and b.bolborrado=0 ";
                    if($nacionalidad!='') $sql.=" and a.strnacionalidad='".$nacionalidad."'";
                    if($cedula!='') $sql.=" and a.cedula='".$cedula."'";
                    if(intval($id_instituto)>0) $sql.=" and b.id_organismo=".$id_instituto." order by a.cedula";
                    return $sql;
     }

     public function eliminarPersona($lngcodigo){
         $this->eliminarAyuda($lngcodigo);
         $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "update
							  " . clConstantesModelo::scsd_table . "tblpersona
							  set
							  bolborrado=1
                              where lngcodigo=".$lngcodigo;
               $conn->sql = $sql;
               $conn->ejecutarSentencia ();
               $conn->cerrarConexion ();
               return $lngcodigo;

     }

     public function eliminarAyuda($lngcodigo){
         $conn = new Conexion ();
               $conn->abrirConexion ();
               $sql = "update
							  " . clConstantesModelo::scsd_table . "tblayuda
							  set
							  bolborrado=1
                              where lngcodigo=".$lngcodigo;
               $conn->sql = $sql;
               $conn->ejecutarSentencia ();
               $conn->cerrarConexion ();
               return $lngcodigo;
     }


 }
?>