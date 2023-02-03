<?php

$bd = new SQLite3("./db/filmes.db");

$sql = "ALTER TABLE filmes ADD COLUMN favorito INT DEFAULT 0";

if ($bd->exec($sql)) 
    echo "\n Tabela filmes alterada com sucesso\n"; 
else
    echo "\n Erro ao alterar tabela filmes\n";
