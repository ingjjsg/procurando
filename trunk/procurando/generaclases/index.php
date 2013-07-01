<?php 
session_start();
if ($_POST['esquema']!='')
{
	$_SESSION['host'] = $_POST['host'];
	$_SESSION['port'] = $_POST['port'];
	$_SESSION['user'] = $_POST['user'];
	$_SESSION['password'] = $_POST['password'];
	$_SESSION['dbname'] = $_POST['dbname'];
}
?>
<HTML>

<BODY>

<FORM METHOD="post" ACTION="index.php">
<p>Esquema a Analizar</p> 
<p>Host <input type="text" name="host" size="30" value="<?php echo $_POST['host']; ?>"></p> 
<p>Port <input type="text" name="port" size="30" value="<?php echo $_POST['port']; ?>"></p> 
<p>User <input type="text" name="user" size="30" value="<?php echo $_POST['user']; ?>"></p> 
<p>Password <input type="text" name="password" size="30" value="<?php echo $_POST['password']; ?>"></p> 
<p>Dbname <input type="text" name="dbname" size="30" value="<?php echo $_POST['dbname']; ?>"></p> 
<p>Esquema <input type="text" name="esquema" size="30" value="<?php echo $_POST['esquema']; ?>"></p> 
<p><input type="submit" value="Buscar Tablas" name="enviar"> </p> 
</FORM>
<?php 
if ($_POST['esquema']!='')
{
?>
	<FORM METHOD="post" ACTION="estructura.php">
	<select size="1" name="tabla">

	   <?php

	   /* ********************* */
	   /* Conexion a PostgreSQL */
	   /* ********************* */

	   /* Conexion a la base de datos */
	   $conexion = pg_pconnect("host=".$_SESSION['host']." port=".$_SESSION['port']." user=".$_SESSION['user']." password=".$_SESSION['password']." dbname=".$_SESSION['dbname']);

	   if (!$conexion) {
		echo "<CENTER>
		      Problemas de conexion con la base de datos.
		      </CENTER>";
		exit;
	   }

	   $sql="select tablename, tableowner from pg_tables where schemaname = '".$_POST['esquema']."'";


	   /* Ejecuta y almacena el resultado de la orden 
	      SQL en $resultado_set */
	   $resultado_set = pg_Exec ($conexion, $sql);
	   $filas = pg_NumRows($resultado_set);

	   /* Presenta la informacion almacenada en $resultado_set */


	   for ($i=0; $i < $filas; $i++) {

	      echo '<option value="'.pg_result($resultado_set, $i, 0).'">'.pg_result($resultado_set, $i, 0).'</option>';
	   }

	   /* Cierra la conexion con la base de datos */
	   pg_close($conexion);

	   ?>
	</select></p>


	<p><input type="submit" value="Ver Estructura" name="enviar"> 

	</FORM>
<?php } ?>
</BODY>

<HTML> 
