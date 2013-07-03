<?php             $_SESSION['id_contacto']=$_SESSION['id_contacto']; ?>
<div class="contenedor950"><!--<img src="imagenes/cintillo_gobierno.png" alt="Gobierno Bolivariano de Venezuela" width="950" height="61">--></div>
<div class="fondo_blanco">
  <div class="contenedor950"><img src="imagenes/banner.jpg" alt="Intranet INDER" width="950" height="119" border="0" usemap="#Map" />
<map name="Map" id="Map">
  <area shape="rect" coords="68,92,127,113" href="index.php" alt="Ir a la p&aacute;gina principal" title="Ir a la p&aacute;gina principal" />
<area shape="rect" coords="134,91,232,113" href="http://www.yaracuy.gob.ve" target="_blank" alt="P&agrave;gina del Gobierno Bolivariano del Estado Yaracuy" title="P&agrave;gina del Gobierno Bolivariano del Estado Yaracuy" />
</map></div>
<div class="contenedor950" id="menu_principal">
<!--    <p><a href="correspondencia.php" title="Ver todos los sistemas disponibles">CORREO</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="oas.php" title="Descargue documentos de Recursos Humanos, Recursos Humanos, Leyes y muchos m&aacute;s">OAS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="litigio.php" title="Ver Bolet&iacute;nes electr&oacute;nicos, por mes y por edici&oacute;n">LITIGIO</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="agenda.php" title="Ver Agenda Telef&oacute;nica">AGENDA</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="documentos.php" title="Cumplea&ntilde;eros, etc">DOCUMENTOS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="seguridad.php" title="Cumplea&ntilde;eros, etc">SEGURIDAD</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" title="Todos los Eventos de la instituci&oacute;n, tanto p&uacute;blicos como internos">EVENTOS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" title="Escr&iacute;banos en caso que tuviese alg&uacute;n comentario o reclamo con el sistema">AYUDA</a></p>-->
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="intro.php" title="Ver tus ṔROCURANDO">INICIO</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<a href="correspondencia.php" title="Ver todos los sistemas disponibles">CORREO</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="agenda.php" title="Ver Agenda de Eventos">AGENDA</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="documentos.php" title="Ver Documentos">DOCUMENTOS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="dictamenes.php" title="DICTAMENES">DICTAMENES</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="oas.php" title="OFICINA DE ATENCIÓN AL SOBERANO">OAS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="litigio.php" title="OFICINA DE LITIGIO">LITIGIO</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="seguridad.php" title="SEGURIDAD DEL SISTEMA">SEGURIDAD</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" title="AYUDA DEL SISTEMA PROCURANDO">?</a></p>    
</div>
<div class="contenedor950" id="submenu">
    <div class="fecha"><strong>Yaracuy,</strong> <?php echo fechaActualCompleta();?></div>
      <div class="submenu_botones">
        <?php echo "<div class=\"boton_salir\"><a href=\"".$_SESSION['logout']."logout.php\"><img src=\"imagenes/boton_salir01.png\" border=\"0\" /></a></div>";?>
        <div class="boton_micuenta"><img src="imagenes/boton_micuenta01.png" onclick="ircuenta();" border="0" /></div>
        <!--<div class="boton_misclasificados"><a href="../../inder-intranet/mis_clasificados.php"><img src="imagenes/boton_misclasificados01.png" border="0" /></a></div>-->
  </div><div class="submenu_usuario"><strong>Hola,</strong> <?php echo $_SESSION['strapellido'].", ".$_SESSION['strnombre'];?></div>
  </div>
<div class="contenedor950" id="mensaje">
    buzon de entrada
</div>    
