<?php

class Conexao{
    public static function criar():PDO{

        //PREPARANDO CONEXÃO MYSQL

        // $env = parse_ini_file('.env');
        // $databaseType = $env["databasetype"];
        // $database = $env["database"];
        // $server = $env["server"];
        // $pass = $env["pass"];
        // $user = $env["user"];

        // if($databaseType === "mysql"){
        //     $database = "host=$serrver; dbname=$database";
        // }

        // return new PDO("$databaseType:$database", $user, $pass);

        //CONEXÃO SQLITE
        return new PDO("sqlite:db/filmes.db");
    }
}
