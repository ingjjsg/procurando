<?php
    session_start();
    require_once '../controlador/contactoControlador.php';
    require_once '../controlador/menuControlador.php';
    $_SESSION["AD"]="ASC";


?>
<?php include('header.php');?>
<script language="javascript">
            function mostrar(id){
                var cap= document.getElementById(id);
                if(cap.style.visibility == "hidden"){
                    cap.style.visibility = "visible";
                    cap.style.display = "inline";
                }else{
                    cap.style.visibility = "hidden";
                    cap.style.display = "none";
                }

            }
            function cerrarVentana(){
                var eSombra= document.getElementById('ventana-modal-sombra');
                var eFondo= document.getElementById('ventana-modal-fondo');
                var eVentana= document.getElementById('ventana-modal-ventana');
                eSombra.style.display= 'none';
                eFondo.style.display= 'none';
                eVentana.style.display= 'none';
            }
        </script>

        <script type="text/javascript" src="../comunes/js/ventana-modal-1.1.1.js"></script>
        <script type="text/javascript" src="../comunes/js/abrir-ventana-variable.js"></script>
        <script type="text/javascript" src="../comunes/js/abrir-ventana-fija.js"></script>
        <link href="../comunes/css/ventana-modal.css" rel="stylesheet" type="text/css">
        <link href="../comunes/css/style.css" rel="stylesheet" type="text/css">
<link href="css/general.css" rel="stylesheet" type="text/css">
<link href="css/botones.css" rel="stylesheet" type="text/css" />
</head>


<body>
<div align="center">
<div class="contenedor_general">
  <?php
  include('cabecero.php');
 // include('../comunes/php/utilidades.php');

  verificarSession();
  ?>
  <div class="menu_enlaces">
        <div class="menu_enlaces_texto">
          <?php echo crearMenu($_SESSION['id_profile'],clConstantesModelo::ModulosSeguridad()); ?>
      </div>
  </div>
  <div class="desarrollo" id="largo">
    <div class="desarrollo_contenido"><iframe  id="contenido" name="contenido" src="../vista/blank.php" scrolling="auto" frameborder="0" width="100%" height="600"></iframe></div>
  </div>
  <!-- derecha -->
</div>
<div class="pie"><?php include('pie.php');?></div>
</div>
</div>
</body>
</html>
<?php if($_SESSION['passwd'] == 1){ ?>
    <script language="javascript">
        abrirVentanaFija('claveVista.php', 480, 260, 'ventana', 'Cambio de Contraseña', false);
    </script>
<?php } ?>