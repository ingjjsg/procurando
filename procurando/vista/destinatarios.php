<?php
    session_start();
    require_once '../controlador/redactarControlador.php';

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="StyleSheet" href="../comunes/js/dtree.css" type="text/css" />
        <script type="text/javascript" src="../comunes/js/dtree.js"></script>
        <script src="../comunes/js/funciones.js" type="text/javascript"></script>
        <script language="javascript">
            function asignar(campo, dest){
                var formInput= campo;
                var cadena= formInput.value;
                var myRegExp = eval('/'+dest+'/');
                var matchPos1 = cadena.search(myRegExp);
                if(matchPos1 == -1){
                    setInputText(formInput, cadena+dest+";");
                }else{
                    var destinatarios= cadena.split(';');
                    var cadenaNueva= "";
                    for(i= 0; i < destinatarios.length-1; i++){
                        if(destinatarios[i] != dest){
                            cadenaNueva+= destinatarios[i]+";";
                        }
                    }
                    setInputText(formInput, cadenaNueva);
                }
            }
        </script>
    </head>
<body>
    <div class="dtree">
        <script type="text/javascript">
            <?php
                echo verDestinatarios($_REQUEST['input']);
            ?>
        </script>
    </div>
</body>
</html>