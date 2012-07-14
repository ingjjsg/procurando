<?php
/*
 * Creado el 01/02/2010
 *
 * Ing. Jaime Suarez
 * jsuarez@inder.gob.ve
 * Instituto Nacional de Desarrollo Rural
 * http://www.inder.gob.ve
 */

require_once 'Connection.php';
require_once '../exception/recordNoFoundException.php';
require_once '../modelo/clConstantesModelo.php';

 class clPermisoModelo {
	private $formulario;
	private $accion;

	private function setAllProperties($formulario, $accion) {
		$this->formulario = $formulario;
		$this->accion = $accion;
	}

        public function setFormulario($formulario) {
		$this->formulario = $formulario;
	}
	public function getFormulario() {
		return $this->formulario;
	}
        
	public function setAccion($accion) {
		$this->accion = $accion;
	}
	public function getAccion() {
		return $this->accion;
	}

        static public function getFormulario_Accion()
        {
            $resultado=array();
            $sql= "SELECT * FROM ".clConstantesModelo::seguridad_table."tblaccesoforma WHERE id_profile_maestro='".$_SESSION['id_profile']."'";
            $connection = Connection::getInstance();
            $connection->query($sql);
            $data = $connection->fetch_all(Connection::DB_ASSOC);
            if ($data)
            {
                foreach ($data as $datos)
                {
                   $resultado += array($datos["id_menu_maestro"] => array_diff(array_unique(explode(",",$datos['stracciones'])),array_values(array(''))));
                }
            }
            else
		throw new RecordNoFoundException('El Perfil Consultado no esta Registrado','');
            return $resultado;
        }

        static public function getVerificar_Accion($formulario, $accion, $acciones_definidas)
        {
            $accion=strtoupper($accion);
            $variable=false;
            if (array_key_exists($accion, $acciones_definidas))
            {
               if (in_array(intval($formulario),array_keys($_SESSION['permisos_asignados'])))
                    if (in_array(intval($acciones_definidas[$accion]), $_SESSION['permisos_asignados'][intval($formulario)]))
                        $variable=true;
            }
            return $variable;
        }

  }
?>
