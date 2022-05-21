<?php

    define("HOST","localhost");
    define("DB","chat_online");
    define("USER","root");
    define("PASS","");

    class Mysql {

        private static $pdo;

        public static function conectar(){
            if(self::$pdo == null){
                try {
                    self::$pdo = new PDO('mysql:host='.HOST.';dbname='.DB,USER,PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                    self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                } catch (Exception $th) {
                    echo "[ERRO] Não foi possivel fazer a conexão com o banco de dados";
                }
            }
            
            return self::$pdo;
        }

    }

?>