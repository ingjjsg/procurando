<?php
    session_start();
/*
**----------------------------No Borrar esta seccin -------------------------
**	Paginator 
**	Paginacin de resultados de consultas a MySql con PHP
**
**	Versin 1.6.3
**
**	Nombre de archivo	:
**		paginator.inc.php
**
**	Autor	:
**		Jorge Pinedo Rosas (jpinedo)	<jorpinedo@yahoo.es>
**		Con la colaboracin de los usuarios del foro de PHP de www.forosdelweb.com
**		Especialmente de dooky que poste el cdigo en el que se basa este script.	
**
**	Descripcin :
**		Devuelve el resultado de una consulta sql por pginas, as como los enlaces de navegacin respectivos.
**		Este script ha sido pensado con fines didcticos, por eso la gran cantidad de comentarios.	
**
**	Licencia : 
**		GPL con las siguientes extensiones:
** 			*Uselo con el fin que quiera (personal o lucrativo).
**			*Si encuentra el cdigo de utilidad y lo usa, mandeme un mail si lo desea o deje un comentario en la pgina 
**			 de documentacin.
**			*Si mejora el cdigo o encuentra errores, hagamelo saber al mail indicado o deje un comentario en la pgina 
**			 de documentacin.
**
**	Documentacin y ejemplo de uso:
**		http://jpinedo.webcindario.com
**----------------------------------------------------------------------*/

/*----------------------------------------------------------------------
**	Historial:
**
**	Versin 1.0.0	(30/11/2003):	-Versin inicial.
**	Versin 1.1.0	(12/01/2004):	-Se agreg la propagacin de las variables que llegan al script va url ($_GET)
**					 				 en los enlaces de navegacin por las pginas.
**									-Se optimiz el conteo del total de registros utilizando el COUNT(*) de MySql.
**	Versin 1.3.0	(10/08/2004):	-Se agreg la opcin de limitar el nmero enlaces que se mostrarn en la barra 
**									 de navegacin. Gracias a la recomendacin de Jorge Camargo (andinistas)
**									-Se agreg la opcin de elegir si se quiere mostrar los mensajes de error de mysql.
**									-Se agreg la generacin de informacin de la pgina actual en una cadena que contiene
**									 el total de registros de la consulta y el primer y ltimo registro de la pgina actual.
** 	Versin 1.4.0	(12/08/2004):	-Se agreg la opcin de elegir qu variables se quiere propagar por url. Se ha utilizado
**									 la misma forma de hacerlo que utiliza la Clase Paginado de webstudio.
**					 				 (http://www.forosdelweb.com/showthread.php?t=65528). Gracias a la acalmacin popular :)
** 	Versin 1.4.1 	(06/09/2004): 	-Corregido el bug en la propagacin de variables por GET al renombrar la variable
** 									 "pg" por "_pagi_pg". Esto slo ocurre en la versin 1.4. Gracias a jean pierre m. por
**									 reportar el bug.
**	Versin 1.5.0 	(03/11/2004): 	-Se agreg la opcin de elegir si se hace el conteo desde mySQL (COUNT(*)) o desde PHP (mysql_num_rows()).
**									 Esta es una de las modificaciones ms importantes porque gracias a esto, ahora el script funciona para 
**									 cualquier tipo de consulta, corrigiendo una de sus principales limitaciones. Gracias a Csar (CDs) por 
**									 sus ganas de colaborar y su paciencia.
**	Versin 1.5.1	(16/11/2004): 	-Se cambi el nombre de las variables $desde y $hasta por $_pagi_desde y $_pagi_hasta para mantener 
**									 uniformidad y evitar conflictos.
**	Versin 1.5.2	(15/02/2005):	-Se cambi preventivamente el uso del array $GLOBALS por el array $_REQUEST con la intencin de que
**									 funcione con la directiva register globals en Off. Gracias a Lorena Casas por su colaboracin en la deteccin de
**									 este bug y en las pruebas.
**	Versin 1.6.0	(08/03/2005):	-Se reestructur toda la parte de propagacin reincluyendo el array $GLOBALS para poder propagar variables
**									 generadas en el mbito del script.
**									-Se incluy la opcin de elegir un estilo CSS para los enlaces de la barra de navegacin.
**									-Se incluy la opcin de personalizar los enlaces a la pgina anterior y a la siguiente. (Inspirado en la clase Paginador de WebStudio)
**	Versin 1.6.1	(07/05/2005):	-Corregido el bug que multiplicaba la variable _pagi_pg en el URL cuando se propaga automticamente 
**									 el array $_GET.
**	Versin 1.6.2	(21/10/2005):	-Se incluyeron los enlaces a la pgina primera y a la ltima.
**									-Se incluy la opcin de personalizar los enlaces a la pgina primera y a la ltima.
**	Versin 1.6.3	(22/02/2006):	-Corregida la expresin regular para que reconozca los saltos de lnea y tabulaciones como espacio en blanco.
**									 Gracias a El_Condor en forosdelweb por reportar el comportamiento indeseado.
**
**-----------------------------------------------------------------------------------------------------------*/


/**
 * Variables que se pueden definir antes de incluir el script va include():
 * ------------------------------------------------------------------------
 * $_pagi_sql 					OBLIGATORIA.	Cadena. Debe contener una sentencia sql vlida (y sin la clusula "limit").
 
 * $_pagi_cuantos				OPCIONAL.		Entero. Cantidad de registros que contendr como mximo cada pgina.
								Por defecto est en 20.
											
 * $_pagi_nav_num_enlaces		OPCIONAL		Entero. Cantidad de enlaces a los nmeros de pgina que se mostrarn como 
								mximo en la barra de navegacin.
								Por defecto se muestran todos.
											
 * $_pagi_mostrar_errores		OPCIONAL		Booleano. Define si se muestran o no los errores de MySQL que se puedan producir.
 								Por defecto est en "true";
											
 * $_pagi_propagar				OPCIONAL		Array de cadenas. Contiene los nombres de las variables que se quiere propagar
								por el url. Por defecto se propagarn todas las que ya vengan por el url (GET).
 * $_pagi_conteo_alternativo	OPCIONAL		Booleano. Define si se utiliza mysql_num_rows() (true) o COUNT(*) (false).
								Por defecto est en false.
 * $_pagi_separador				OPCIONAL		Cadena. Cadena que separa los enlaces numricos en la barra de navegacin entre pginas.
 								Por defecto se utiliza la cadena " | ".
 * $_pagi_nav_estilo			OPCIONAL		Cadena. Contiene el nombre del estilo CSS para los enlaces de paginacin.
 								Por defecto no se especifica estilo.
 * $_pagi_nav_anterior			OPCIONAL		Cadena. Contiene lo que debe ir en el enlace a la pgina anterior. Puede ser un tag <img>.
 								Por defecto se utiliza la cadena "&laquo; Anterior".
 * $_pagi_nav_siguiente			OPCIONAL		Cadena. Contiene lo que debe ir en el enlace a la pgina siguiente. Puede ser un tag <img>.
 								Por defecto se utiliza la cadena "Siguiente &raquo;"
 * $_pagi_nav_primera			OPCIONAL		Cadena. Contiene lo que debe ir en el enlace a la primera pgina. Puede ser un tag <img>.
 								Por defecto se utiliza la cadena "&laquo;&laquo; Primera".
 * $_pagi_nav_ultima			OPCIONAL		Cadena. Contiene lo que debe ir en el enlace a la pgina siguiente. Puede ser un tag <img>.
 								Por defecto se utiliza la cadena "&Uacute;ltima &raquo;&raquo;"
--------------------------------------------------------------------------
*/


/*
 * Verificacin de los parmetros obligatorios y opcionales.
 *------------------------------------------------------------------------
 */
 if(empty($_pagi_sql)){
	// Si no se defini $_pagi_sql... grave error!
	// Este error se muestra s o s (ya que no es un error de mysql)
	die("<b>Error Paginator : </b>No se ha definido la variable \$_pagi_sql");
 }
 
 if(empty($_pagi_cuantos)){
	// Si no se ha especificado la cantidad de registros por pgina
	// $_pagi_cuantos ser por defecto 20
	$_pagi_cuantos = 20;
 }
 
 if(!isset($_pagi_mostrar_errores)){
	// Si no se ha elegido si se mostrar o no errores
	// $_pagi_errores ser por defecto true. (se muestran los errores)
	$_pagi_mostrar_errores = true;
 }

 if(!isset($_pagi_conteo_alternativo)){
	// Si no se ha elegido el tipo de conteo
	// Se realiza el conteo dese mySQL con COUNT(*)
	$_pagi_conteo_alternativo = true;
 }
 
 if(!isset($_pagi_separador)){
	// Si no se ha elegido un separador
	// Se toma el separador por defecto.
	$_pagi_separador = "  ";
 }
 
  if(isset($_pagi_nav_estilo)){
	// Si se ha definido un estilo para los enlaces, se genera el atributo "class" para el enlace
	$_pagi_nav_estilo_mod = "class=\"$_pagi_nav_estilo\"";
 }else{
 	// Si no, se utiliza una cadena vaca.
 	$_pagi_nav_estilo_mod = "";
 }
 
 if(!isset($_pagi_nav_anterior)){
	// Si no se ha elegido una cadena para el enlace "siguiente"
	// Se toma la cadena por defecto.
	$_pagi_nav_anterior = "&laquo;";
 } 
 
 if(!isset($_pagi_nav_siguiente)){
	// Si no se ha elegido una cadena para el enlace "siguiente"
	// Se toma la cadena por defecto.
	$_pagi_nav_siguiente = "&raquo;";
 } 

 if(!isset($_pagi_nav_primera)){
	// Si no se ha elegido una cadena para el enlace "primera"
	// Se toma la cadena por defecto.
	$_pagi_nav_primera = "&laquo;&laquo;";
 } 
 
 if(!isset($_pagi_nav_ultima)){
	// Si no se ha elegido una cadena para el enlace "siguiente"
	// Se toma la cadena por defecto.
	$_pagi_nav_ultima = "&raquo;&raquo;";
 } 
 
//------------------------------------------------------------------------


/*
 * Establecimiento de la pgina actual.
 *------------------------------------------------------------------------
 
 if (empty($_GET['_pagi_pg'])){
	// Si no se ha hecho click a ninguna pgina especfica
	// O sea si es la primera vez que se ejecuta el script
    	// $_pagi_actual es la pagina actual-->ser por defecto la primera.
	$_pagi_actual = 1;
 }else{
	// Si se "pidi" una pgina especfica:
	// La pgina actual ser la que se pidi.
    	$_pagi_actual = $_GET['_pagi_pg'];
 }
//------------------------------------------------------------------------


/*
 * Establecimiento del nmero de pginas y del total de registros.
 *------------------------------------------------------------------------
 */
 // Contamos el total de registros en la BD (para saber cuntas pginas sern)
 // La forma de hacer ese conteo depender de la variable $_pagi_conteo_alternativo
 if($_pagi_conteo_alternativo == false){
 	$_pagi_sqlConta = eregi_replace("select[[:space:]](.*)[[:space:]]from", "SELECT COUNT(*) FROM", $_pagi_sql);
 	$_pagi_result2 = pg_query($_pagi_sqlConta);
	// Si ocurri error y mostrar errores est activado
 	if($_pagi_result2 == false && $_pagi_mostrar_errores == true){
		die (" Error en la consulta de conteo de registros: $_pagi_sqlConta. Mysql dijo: <b>"."</b>");
 	}
 	//$_pagi_totalReg = mysql_result($_pagi_result2,0,0);//total de registros
 }else{
	$_pagi_result3 = pg_query($_pagi_sql);
	// Si ocurri error y mostrar errores est activado
 	if($_pagi_result3 == false && $_pagi_mostrar_errores == true){
		die (" Error en la consulta de conteo alternativo de registros: $_pagi_sql. Mysql dijo: <b></b>");
 	}
	$_pagi_totalReg = pg_num_rows($_pagi_result3);
 }
 // Calculamos el nmero de pginas (saldr un decimal)
 // con ceil() redondeamos y $_pagi_totalPags ser el nmero total (entero) de pginas que tendremos
 $_pagi_totalPags = ceil($_pagi_totalReg / $_pagi_cuantos);

//------------------------------------------------------------------------


/*
 * Propagacin de variables por el URL.
 *------------------------------------------------------------------------
 */
 // La idea es pasar tambin en los enlaces las variables hayan llegado por url.
 $_pagi_enlace = $_SERVER['PHP_SELF'];
 $_pagi_query_string = "?";
 
 if(!isset($_pagi_propagar)){
 	//Si no se defini qu variables propagar, se propagar todo el $_GET (por compatibilidad con versiones anteriores)
	//Perdn... no todo el $_GET. Todo menos la variable _pagi_pg
	if (isset($_GET['_pagi_pg'])) unset($_GET['_pagi_pg']); // Eliminamos esa variable del $_GET
	$_pagi_propagar = array_keys($_GET);
 }elseif(!is_array($_pagi_propagar)){
	// si $_pagi_propagar no es un array... grave error!
	die("<b>Error Paginator : </b>La variable \$_pagi_propagar debe ser un array");
 }
 // Este foreach est tomado de la Clase Paginado de webstudio
 // (http://www.forosdelweb.com/showthread.php?t=65528)
 foreach($_pagi_propagar as $var){
 	if(isset($GLOBALS[$var])){
		// Si la variable es global al script
		$_pagi_query_string.= $var."=".$GLOBALS[$var]."&";
	}elseif(isset($_REQUEST[$var])){
		// Si no es global (o register globals est en OFF)
		$_pagi_query_string.= $var."=".$_REQUEST[$var]."&";
	}
 }

 // Aadimos el query string a la url.
 $_pagi_enlace .= $_pagi_query_string;
 
//------------------------------------------------------------------------


/*
 * Generacin de los enlaces de paginacin.
 *------------------------------------------------------------------------
 */
 // La variable $_pagi_navegacion contendr los enlaces a las pginas.
 $_pagi_navegacion_temporal = array();
 if ($_pagi_actual != 1){
	// Si no estamos en la pgina 1. Ponemos el enlace "primera"
	$_pagi_url = 1; //ser el nmero de pgina al que enlazamos
	$_pagi_navegacion_temporal[] = "<a href='#' onclick=\"xajax_selectAllCorrespondenciaEntranteFiltros(".$_pagi_url.", '".$_SESSION['filtros']['fechaHasta']."', '".$_SESSION['filtros']['fechaDesde']."', '".$_SESSION['filtros']['id_estatus_maestro']."', '".$_SESSION['filtros']['strasunto']."', '".$_SESSION['filtros']['id_tipo_maestro']."', '".$_SESSION['filtros']['id_tipocorresp_maestro']."', '".$_SESSION['filtros']['id_unidad_maestro']."')\">$_pagi_nav_primera</a>";

	// Si no estamos en la pgina 1. Ponemos el enlace "anterior"
	$_pagi_url = $_pagi_actual - 1; //ser el nmero de pgina al que enlazamos
	$_pagi_navegacion_temporal[] = "<a href='#' onclick=\"xajax_selectAllCorrespondenciaEntranteFiltros(".$_pagi_url.", '".$_SESSION['filtros']['fechaHasta']."', '".$_SESSION['filtros']['fechaDesde']."', '".$_SESSION['filtros']['id_estatus_maestro']."', '".$_SESSION['filtros']['strasunto']."', '".$_SESSION['filtros']['id_tipo_maestro']."', '".$_SESSION['filtros']['id_tipocorresp_maestro']."', '".$_SESSION['filtros']['id_unidad_maestro']."')\">$_pagi_nav_anterior</a>";
 }
 
 // La variable $_pagi_nav_num_enlaces sirve para definir cuntos enlaces con 
 // nmeros de pgina se mostrarn como mximo.
 // Ojo: siempre se mostrar un nmero impar de enlaces. Ms info en la documentacin.
 
 if(!isset($_pagi_nav_num_enlaces)){
	// Si no se defini la variable $_pagi_nav_num_enlaces
	// Se asume que se mostrarn todos los nmeros de pgina en los enlaces.
	$_pagi_nav_desde = 1;//Desde la primera
	$_pagi_nav_hasta = $_pagi_totalPags;//hasta la ltima
 }else{
	// Si se defini la variable $_pagi_nav_num_enlaces
	// Calculamos el intervalo para restar y sumar a partir de la pgina actual
	$_pagi_nav_intervalo = ceil($_pagi_nav_num_enlaces/2) - 1;
	
	// Calculamos desde qu nmero de pgina se mostrar
	$_pagi_nav_desde = $_pagi_actual - $_pagi_nav_intervalo;
	// Calculamos hasta qu nmero de pgina se mostrar
	$_pagi_nav_hasta = $_pagi_actual + $_pagi_nav_intervalo;
	
	// Ajustamos los valores anteriores en caso sean resultados no vlidos
	
	// Si $_pagi_nav_desde es un nmero negativo
	if($_pagi_nav_desde < 1){
		// Le sumamos la cantidad sobrante al final para mantener el nmero de enlaces que se quiere mostrar. 
		$_pagi_nav_hasta -= ($_pagi_nav_desde - 1);
		// Establecemos $_pagi_nav_desde como 1.
		$_pagi_nav_desde = 1;
	}
	// Si $_pagi_nav_hasta es un nmero mayor que el total de pginas
	if($_pagi_nav_hasta > $_pagi_totalPags){
		// Le restamos la cantidad excedida al comienzo para mantener el nmero de enlaces que se quiere mostrar.
		$_pagi_nav_desde -= ($_pagi_nav_hasta - $_pagi_totalPags);
		// Establecemos $_pagi_nav_hasta como el total de pginas.
		$_pagi_nav_hasta = $_pagi_totalPags;
		// Hacemos el ltimo ajuste verificando que al cambiar $_pagi_nav_desde no haya quedado con un valor no vlido.
		if($_pagi_nav_desde < 1){
			$_pagi_nav_desde = 1;
		}
	}
 }

 for ($_pagi_i = $_pagi_nav_desde; $_pagi_i<=$_pagi_nav_hasta; $_pagi_i++){//Desde pgina 1 hasta ltima pgina ($_pagi_totalPags)
	if ($_pagi_i == $_pagi_actual) {
		// Si el nmero de pgina es la actual ($_pagi_actual). Se escribe el nmero, pero sin enlace y en negrita.
		$_pagi_navegacion_temporal[] = "<span class='current'>$_pagi_i</span>";
	}else{
		// Si es cualquier otro. Se escibe el enlace a dicho nmero de pgina.
	   $_pagi_navegacion_temporal[] = "<a  href='#' onclick=\"xajax_selectAllCorrespondenciaEntranteFiltros(".$_pagi_i.", '".$_SESSION['filtros']['fechaHasta']."', '".$_SESSION['filtros']['fechaDesde']."', '".$_SESSION['filtros']['id_estatus_maestro']."', '".$_SESSION['filtros']['strasunto']."', '".$_SESSION['filtros']['id_tipo_maestro']."', '".$_SESSION['filtros']['id_tipocorresp_maestro']."', '".$_SESSION['filtros']['id_unidad_maestro']."')\">".$_pagi_i."</a>";
		//href='".$_pagi_enlace."_pagi_pg=".$_pagi_i."'
	}
 }

 if ($_pagi_actual < $_pagi_totalPags){
	// Si no estamos en la ltima pgina. Ponemos el enlace "Siguiente"
	$_pagi_url = $_pagi_actual + 1; //ser el nmero de pgina al que enlazamos
	$_pagi_navegacion_temporal[] = "<a  href='#' onclick=\"xajax_selectAllCorrespondenciaEntranteFiltros(".$_pagi_url.", '".$_SESSION['filtros']['fechaHasta']."', '".$_SESSION['filtros']['fechaDesde']."', '".$_SESSION['filtros']['id_estatus_maestro']."', '".$_SESSION['filtros']['strasunto']."', '".$_SESSION['filtros']['id_tipo_maestro']."', '".$_SESSION['filtros']['id_tipocorresp_maestro']."', '".$_SESSION['filtros']['id_unidad_maestro']."')\">$_pagi_nav_siguiente</a>";

	// Si no estamos en la ltima pgina. Ponemos el enlace "ltima"
	$_pagi_url = $_pagi_totalPags; //ser el nmero de pgina al que enlazamos
	$_pagi_navegacion_temporal[] = "<a  href='#' onclick=\"xajax_selectAllCorrespondenciaEntranteFiltros(".$_pagi_url.", '".$_SESSION['filtros']['fechaHasta']."', '".$_SESSION['filtros']['fechaDesde']."', '".$_SESSION['filtros']['id_estatus_maestro']."', '".$_SESSION['filtros']['strasunto']."', '".$_SESSION['filtros']['id_tipo_maestro']."', '".$_SESSION['filtros']['id_tipocorresp_maestro']."', '".$_SESSION['filtros']['id_unidad_maestro']."')\">$_pagi_nav_ultima</a>";
 }
 $_pagi_navegacion = implode($_pagi_separador, $_pagi_navegacion_temporal);

//------------------------------------------------------------------------


/*
 * Obtencin de los registros que se mostrarn en la pgina actual.
 *------------------------------------------------------------------------
 */
 // Calculamos desde qu registro se mostrar en esta pgina
 // Recordemos que el conteo empieza desde CERO.
 $_pagi_inicial = ($_pagi_actual-1) * $_pagi_cuantos;
 
 // Consulta SQL. Devuelve $cantidad registros empezando desde $_pagi_inicial
 $_pagi_sqlLim = $_pagi_sql." LIMIT $_pagi_cuantos OFFSET $_pagi_inicial";
 $_pagi_result = pg_query($_pagi_sqlLim);
 // Si ocurri error y mostrar errores est activado
 if($_pagi_result == false && $_pagi_mostrar_errores == true){
 	die ("Error en la consulta limitada: $_pagi_sqlLim. pg dijo: <b></b>");
 }

//------------------------------------------------------------------------


/*
 * Generacin de la informacin sobre los registros mostrados.
 *------------------------------------------------------------------------
 */
 // Nmero del primer registro de la pgina actual
 $_pagi_desde = $_pagi_inicial + 1;
 
 // Nmero del ltimo registro de la pgina actual
 $_pagi_hasta = $_pagi_inicial + $_pagi_cuantos;
 if($_pagi_hasta > $_pagi_totalReg){
 	// Si estamos en la ltima pgina
	// El ultimo registro de la pgina actual ser igual al nmero de registros.
 	$_pagi_hasta = $_pagi_totalReg;
 }
 
 $_pagi_info = "desde el $_pagi_desde hasta el $_pagi_hasta de un total de $_pagi_totalReg";

//------------------------------------------------------------------------


/**
 * Variables que quedan disponibles despus de incluir el script va include():
 * ------------------------------------------------------------------------
 
 * $_pagi_result		Identificador del resultado de la consulta a la BD para los registros de la pgina actual. 
 				Listo para ser "pasado" por una funcin como mysql_fetch_row(), mysql_fetch_array(), 
				mysql_fetch_assoc(), etc.
							
 * $_pagi_navegacion		Cadena que contiene la barra de navegacin con los enlaces a las diferentes pginas.
 				Ejemplo: "<<primera | <anterior | 1 | 2 | 3 | 4 | siguiente> | ltima>>".
							
 * $_pagi_info			Cadena que contiene informacin sobre los registros de la pgina actual.
 				Ejemplo: "desde el 16 hasta el 30 de un total de 123";				

*/
?>