<?php
//Banco de dados

$bd = new SQLite3("filmes.db");

//Limpando tudo que tem antes
$sql = "DROP TABLE IF EXISTS filmes";

//Executando
if ($bd->exec($sql)) :
    echo "\n Tabela filmes apagada \n";
endif;

//Criando uma tabela para armazenar os filmes
$sql = "CREATE TABLE filmes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titulo VARCHAR(200) NOT NULL,
    poster VARCHAR(200),
    sinopse TEXT,
    nota DECIMAL(2,1)
)";

//Executando
if ($bd->exec($sql)) :
    echo "\n Tabela filmes criada \n";
else :
    echo "\n Erro ao criar tabela filmes \n";
endif;

//convertendo p/ sql
$sql = "INSERT INTO filmes (id, titulo, poster, sinopse, nota) VALUES (
    0,
    'Homem Aranha Sem Volta Pra Casa',
    'https://www.themoviedb.org/t/p/w300/fVzXp3NwovUlLe7fvoRynCmBPNc.jpg',
    'I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.',
    9.5
)";

//Executando
if ($bd->exec($sql)) :
    echo "\n Filmes inseridos com sucesso \n";
else :
    echo "\n Erro ao inserir filmes \n";
endif;

$sql = "INSERT INTO filmes (id, titulo, poster, sinopse, nota) VALUES (
    1,
    'Thor - Amor e Trovão',
    'https://www.themoviedb.org/t/p/w300/6OEBp0Gqv6DsOgi8diPUslT2kbA.jpg',
    'I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.',
    9.5
)";

//Executando
if ($bd->exec($sql)) :
    echo "\n Filmes inseridos com sucesso \n";
else :
    echo "\n Erro ao inserir filmes \n";
endif;
