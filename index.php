<?php

//Configuração de rotas do meu sistema
$rota = $_SERVER["REQUEST_URI"];
$metodo = $_SERVER["REQUEST_METHOD"];

require "./controllers/FilmesController.php";

//Rota da galeria
if ($rota == "/") {
    require "./view/galeria.php";
    exit();
}

//Rota de cadastrar um filme
if ($rota == "/novo") {
    if ($metodo == "GET") require "./view/cadastrar.php";
    if ($metodo == "POST") {
        $controller = new FilmesController();
        $controller->save($_REQUEST);
    }
    exit();
}

//Rota de favoritar
if (substr($rota, 0, strlen("/favoritar")) === "/favoritar") {
    $controller = new FilmesController();
    $controller->favorite(basename($rota));
    exit();
}

//Rota da favoritos
if ($rota == "/favoritos") {
    require "./view/favoritos.php";
    exit();
}

//Rota da editar
if ($rota == "/editar") {
    if ($metodo == "GET") require "./view/editar.php";
    
    if ($metodo == "POST") {
        $controller = new FilmesController();
        $controller->edite($_REQUEST);
    }
    exit();
}

//Rota de deletar
if (substr($rota, 0, strlen("/filmes")) === "/filmes") {
    if ($metodo == "GET") require "./view/cadastrar.php";

    if ($metodo == "DELETE") {
        $controller = new FilmesController();
        $controller->delete(basename($rota));
    }

    exit();
}

//Rota de erro
require "404.php";
