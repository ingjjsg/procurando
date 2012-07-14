<?php 
session_start();
if ($_POST['tabla'])
{
?>  
<HTML>
   <HEAD>
      <TITLE>Pagina index de prueba</TITLE>
   </HEAD>
   <BODY>

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

   $sql="SELECT * FROM information_schema.columns WHERE table_name ='".$_POST['tabla']."'";


   /* Ejecuta y almacena el resultado de la orden 
      SQL en $resultado_set */
   $resultado_set = pg_Exec ($conexion, $sql);
   $filas = pg_NumRows($resultado_set);

   /* Presenta la informacion almacenada en $resultado_set */


   for ($i=0; $i < $filas; $i++) {

     if ($i==0)
{
      echo '<?php<br>&nbsp;require_once \'../controlador/Conexion.php\';<br>';
      echo '&nbsp;require_once \'../modelo/clConstantesModelo.php\';<br>';      
      echo '&nbsp;/**<br>';
      echo '&nbsp;* Description of cl'.ucwords(pg_result($resultado_set, $i, 2)).'<br>';
      echo '&nbsp;* @author jsuarez<br>';
      echo '&nbsp;*/<br>';
      echo '&nbsp;class cl'.ucwords(pg_result($resultado_set, $i, 2)).' { <br><br>';
}
   }


   echo '//=========================== VAR ===================<br> <br> <br> <br> <br> ';


   for ($i=0; $i < $filas; $i++) {

      echo '
            &nbsp; private &nbsp; $'.pg_result($resultado_set, $i, 3).';<br><br>';
   }

   echo '//=========================== FUNCION LLENAR ===================<br> <br> <br> <br> <br> ';
   for ($j=0; $j < $filas; $j++) {

     if ($j==0)
      echo '
      public function llenar($request) <br>
      {';
      echo '<br>       
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if($request[\''.pg_result($resultado_set, $j, 3).'\'] != ""){<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this->'.pg_result($resultado_set, $j, 3).'= $request[\''.pg_result($resultado_set, $j, 3).'\'];<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
     
      <br>';
     if ($j==($filas-1)) echo '}';

   }

   echo '//=========================== GET ===================<br> <br> <br> <br> <br> ';

   for ($i=0; $i < $filas; $i++) {

      echo '
            &nbsp;&nbsp;&nbsp;&nbsp;public function get'.ucwords(pg_result($resultado_set, $i, 3)).'(){<br> 
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return $this->'.pg_result($resultado_set, $i, 3).';<br> 
            &nbsp;&nbsp;&nbsp;&nbsp;}<br> <br> <br> <br>';
   }


   echo '//=========================== SET ===================<br> <br> <br> <br> <br> ';

   for ($i=0; $i < $filas; $i++) {

      echo '
            &nbsp;&nbsp;&nbsp;&nbsp;public function set'.ucwords(pg_result($resultado_set, $i, 3)).'($'.pg_result($resultado_set, $i, 3).'){<br> 
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return $this->'.pg_result($resultado_set, $i, 3).'=$'.pg_result($resultado_set, $i, 3).';<br> 
            &nbsp;&nbsp;&nbsp;&nbsp;}<br> <br> <br> <br>';



      }
      
   echo '//=========================== Insert ===================<br> <br> <br> <br> <br> ';
   $sql_insert.=' public function insertar()<br>{<br>
         $conn= new Conexion();<br>
         $conn->abrirConexion();<br>';
   $sql='$sql=';   
   $sql_insert.=$sql."\"Insert into public.".$_POST['tabla']." (";         
   for ($i=1; $i < $filas; $i++) {
   if ($i==2) $coma=','; 
   if (substr(pg_result($resultado_set, $i, 3),0,3)=='bol') continue;      
   $sql_insert.="".$coma.pg_result($resultado_set, $i, 3)."";
   if (substr(pg_result($resultado_set, $i, 3),0,3)=='str') $comillas="'"; else $comillas='';
   if (substr(pg_result($resultado_set, $i, 3),0,3)=='fec') {$inc="TO_DATE('"; $fin="', 'DD/MM/YYYY')";} else {$inc=''; $fin='';}
   $values.="".$coma.$comillas.$inc."get".ucwords(pg_result($resultado_set, $i, 3))."()".$fin.$comillas."<br>";
   }
   $html= $sql_insert.") values (".$values.")\";<br>";
   $html.='//exit($sql);<br>';
   $html.='$conn->sql=$sql;<br>';
   $html.='$data = $conn->ejecutarSentencia();<br>';
   $html.='return $data;<br>}<br><br><br>';   
   echo $html;
   
   
   
   
   echo '//=========================== Update ===================<br> <br> <br> <br> <br> ';   
   $values='';
   $values.=' public function update()<br>{<br>
         $conn= new Conexion();<br>
         $conn->abrirConexion();<br>';
   $sql='$sql';
   $values.=$sql."=\"UPDATE public.".$_POST['tabla']." SET <br>";         
   for ($i=1; $i < $filas; $i++) {
   if ($i==2) $coma=','; 
   if ($i+1==$filas) $coma='';
   if (substr(pg_result($resultado_set, $i, 3),0,3)=='bol') continue;      
   if (substr(pg_result($resultado_set, $i, 3),0,3)=='str') $comillas="'"; else $comillas='';
   if (substr(pg_result($resultado_set, $i, 3),0,3)=='fec') {$inc="TO_DATE('"; $fin="', 'DD/MM/YYYY')";} else {$inc=''; $fin='';}
   $values.="".pg_result($resultado_set, $i, 3)."=".$comillas.$inc."get".ucwords(pg_result($resultado_set, $i, 3))."()".$fin.$comillas.$coma."<br>";
   }
   $html= $values. "where ". pg_result($resultado_set, 0, 3)."="."get".ucwords(pg_result($resultado_set, 0, 3))."()\";<br>"; 
   $html.='//exit($sql);<br>';   
   $html.='$conn->sql=$sql;<br>';
   $html.='$data = $conn->ejecutarSentencia();<br>';
   $html.='return $data;<br>}<br><br><br>';   
   echo $html;
   
   
   echo '//=========================== Delete ===================<br> <br> <br> <br> <br> ';   
   $values='';
   $values.=' public function Delete()<br>{<br>
         $conn= new Conexion();<br>
         $conn->abrirConexion();<br>';
   $sql='$sql';
   $values.=$sql."=\"UPDATE public.".$_POST['tabla']." SET <br>";         
   for ($i=1; $i < $filas; $i++) {
   if ($i==2) $coma=','; 
   if ($i+1==$filas) $coma='';
   if (substr(pg_result($resultado_set, $i, 3),0,3)<>'bol') continue;      
   if (substr(pg_result($resultado_set, $i, 3),0,3)=='str') $comillas="'"; else $comillas='';
   if (substr(pg_result($resultado_set, $i, 3),0,3)=='fec') {$inc="TO_DATE('"; $fin="', 'DD/MM/YYYY')";} else {$inc=''; $fin='';}
   $values.="".pg_result($resultado_set, $i, 3)."=1<br>";
   }
   $html= $values. "where ". pg_result($resultado_set, 0, 3)."="."get".ucwords(pg_result($resultado_set, 0, 3))."()\";<br>";   
   $html.='//exit($sql);<br>';   
   $html.='$conn->sql=$sql;<br>';
   $html.='$data = $conn->ejecutarSentencia();<br>';
   $html.='return $data;<br>}<br><br><br>';   
   echo $html;      
   
   /* Cierra la conexion con la base de datos */
   pg_close($conexion);

   ?>

   </BODY>
  </HTML>

<?php }
else {
?>
<HTML>
   <HEAD>
      <TITLE>Pagina index de prueba</TITLE>
   </HEAD>
   <BODY>
	Tabla esta Vacia
   </BODY>
</HTML>
<?php }
?>
