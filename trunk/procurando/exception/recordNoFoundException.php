<?php

/*
 * Creado el 04/02/2010
 *
 * Ing. Rafael Torrealba
 * rtorrealba@inder.gob.ve
 * Instituto Nacional de Desarrollo Rural
 * http://www.inder.gob.ve
 */

class RecordNoFoundException extends Exception {
	function SqlException($message,$code=0) {
		parent :: __construct($message,$code);
	}
}
?>
