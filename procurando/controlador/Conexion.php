<?php
    session_start();

    class Conexion{
       public $conex;
       private $host= "127.0.0.1"; //ambiente de desarrollo
       private $port= "5432";
       private $dbname= "procurando";
       private $user= "postgres";
//       private $password= 'dbadmin$yara$2010';
       private $password= 'postgres';

        public $sql;

        /**
         *  Funcion para conectar con la base de datos PostgreSQL
         */
        function abrirConexion(){
            //$cadconex = "host=10.1.0.11 port=5432 dbname=corresp_p  user=administrador password=0000";
            $cadconex = "host=".$this->host." port=".$this->port." dbname=".$this->dbname."  user=".$this->user." password=".$this->password;
            $result= pg_connect($cadconex);
            if ($result){
                $this->conex = $result;
            }else{
                echo "Error Conexion";
                return false;
            }
        }

        /**
         *  Funcion para ejecutar las consultas a la base de datos
         * @param String $sql
         * @param Integer $modo 1:Insert, Update, Delete - 2:Select
         * @return array
         */
        function ejecutarSentencia($modo=1){
            $result= "";
            $rows= "";
            $result = pg_query($this->conex,$this->sql);
            //exit("RESULTADO: ".$result);
            if($modo == 1){
                return $result;
            }else if($modo == 2){
                 if(!$result){
                 		//pg_errormessage();
                    echo "Error consulta de ejecutarSentencia Pro";
                    $rows = false;
                }else{
                    $rows = pg_fetch_all($result);
                }
                //exit("ROWS: ".$rows);
                return $rows;

            }
        }
        /**
         *  Funcion para cerrar la conexion con la base de datos
         */
        function cerrarConexion(){
            pg_close($this->conex);
        }

    }
?>
