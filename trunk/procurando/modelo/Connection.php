<?php

/*
 * Creado el 04/02/2010
 *
 * Ing. Rafael Torrealba
 * rtorrealba@inder.gob.ve
 * Instituto Nacional de Desarrollo Rural
 * http://www.inder.gob.ve
 */

//require_once '../exception/sqlException.php';

class Connection {

	const PATH_FILE = '../conf/configuration.xml';
	const DB_ASSOC = PGSQL_ASSOC;
	const DB_BOTH = PGSQL_BOTH;
	const DB_NUM = PGSQL_NUM;
	private $id_connection;
	private $last_result_query;
	private $last_query;
	private $last_error;

	private static $connection = null;

	//Realiza una conexión directa al motor de base de datos
	public static function getInstance() {
		if (isset ( self::$connection ))
			return self::$connection;
		self::$connection = new Connection ();
		self::$connection->query ( 'SET search_path TO siembraweb;' );
		return self::$connection;
	}

	private function __construct() {
		$this->connect ();
	}

	function __destruct() {
		$this->close ();
	}

	//Hace una conexion a la base de datos
	private function connect() {
		if (! extension_loaded ( 'pgsql' ))
			throw new SqlException ( 'Debe cargar la extensión de PHP llamada php_pgsql' );
		$conecto = $this->id_connection = pg_connect ( $this->getStringConnection () );
		if ($conecto)
			return true;
		else
			throw new SqlException ( $this->error ( 'No se puede conectar a la base de datos' ) );
	}

	private function getStringConnection() {
		if (! file_exists ( self::PATH_FILE ))
			throw new RuntimeException ( 'Archivo: ' . self::PATH_FILE . ' No existe' );
		$xml = simplexml_load_string ( file_get_contents ( self::PATH_FILE ) );
		if (! $xml)
			throw new RuntimeException ( 'Archivo: ' . self::PATH_FILE . ' Mal formado' );
		$host = ( string ) $xml->host;
		$port = ( string ) $xml->port;
		$user = ( string ) $xml->user;
		$password = ( string ) $xml->password;
		$database = ( string ) $xml->database;
		return "host=$host port=$port dbname=$database user=$user password=$password";
	}

	//Cierra la Conexión al Motor de Base de datos
	private function close() {
		if ($this->id_connection) {
			return pg_close ( $this->id_connection );
		} else {
			return false;
		}
	}

	//Efectua operaciones SQL sobre la base de datos
	public function query($sqlQuery) {
		if (! $this->id_connection) {
			$this->connect ();
			if (! $this->id_connection)
				return false;
		}
		$this->last_query = $sqlQuery;
		$resultQuery = @ pg_query ( $this->id_connection, $sqlQuery );
		if ($resultQuery) {
			$this->last_result_query = $resultQuery;
			return $resultQuery;
		} else {
			throw new SqlException ( $this->error ( " al ejecutar <em>'$sqlQuery'</em>" ) );
		}
	}

	//Devuelve fila por fila el contenido de un select
	public function fetch_array($opt = self :: DB_NUM, $fetch_all = false) {
		if (! $this->id_connection)
			return false;
		$resultQuery = $this->last_result_query;
		if (! $resultQuery)
			return false;
		if (! $fetch_all)
			return pg_fetch_array ( $resultQuery, NULL, $opt );
		else
			return pg_fetch_all ( $resultQuery );
	}

	public function fetch_all() {
		$datos = $this->fetch_array ( self::DB_ASSOC, true );
		if (!$datos)
			$datos =  array();
		return $datos;
	}

	//Devuelve el numero de filas de un select
	public function num_rows() {
		if (! $this->id_connection)
			return false;
		$resultQuery = $this->last_result_query;
		if (! $resultQuery)
			return false;
		if (($numberRows = pg_num_rows ( $resultQuery )) !== false)
			return $numberRows;
		else
			throw new SqlException ( $this->error () );
		return false;
	}

	//Numero de Filas afectadas en un insert, update o delete
	public function affected_rows() {
		if (! $this->id_connection)
			return false;
		$resultQuery = $this->last_result_query;
		if (! $resultQuery)
			return false;
		if (($numberRows = pg_affected_rows ( $resultQuery )) !== false)
			return $numberRows;
		else
			throw new SqlException ( $this->error () );
		return false;
	}

	//Devuelve el ultimo id autonumerico generado en la BD
	public function last_insert_id($table, $primary_key) {
		if (! $this->id_connection)
			return false;
		$this->query ( "SELECT CURRVAL('{$table}_{$primary_key}_seq') as lastid" );
		$last_id = $this->fetch_array ( self::DB_ASSOC );
		return $last_id ['lastid'];
	}

	//Devuelve el error de la BD
	public function error($err = '') {
		if (! $this->id_connection) {
			$this->last_error = @ pg_last_error () ? @ pg_last_error () . $err : "[Error Desconocido en PostgreSQL \"$err\"]";
			return $this->last_error;
		}
		$this->last_error = @ pg_last_error () ? @ pg_last_error () . $err : "[Error Desconocido en PostgreSQL: $err]";
		$this->last_error .= $err;
		return pg_last_error ( $this->id_connection ) . $err;
	}

	public function begin() {
		return $this->query ( 'BEGIN' );
	}

	public function rollback() {
		return $this->query ( 'ROLLBACK' );
	}

	public function commit() {
		return $this->query ( 'COMMIT' );
	}
}
?>
