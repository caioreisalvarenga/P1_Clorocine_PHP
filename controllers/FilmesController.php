<?php

session_start();

require "./repository/FilmesRepositoryPDO.php";
require "./model/Filme.php";

class FilmesController
{

    //Método que lista todos os filmes
    public function index()
    {
        $filmesRepository = new FilmesRepositoryPDO();
        return $filmesRepository->listarTodos();
    }

    //Método que lista todos os filmes favoritados
    public function favoritos()
    {
        $filmesRepository = new FilmesRepositoryPDO();
        return $filmesRepository->listarFavoritos();
    }

    //Método que salva o filme
    public function save($request)
    {
        $filmesRepository = new FilmesRepositoryPDO();

        //POST de filmes como objeto
        $filme = (object) $request;

        //Salvando poster
        $upload = $this->savePoster($_FILES);

        //Validando e setando poster
        if (gettype($upload) == "string") {
            $filme->poster = $upload;
        }

        //Executando
        if ($filmesRepository->salvar($filme)) :
            $_SESSION["msg"] = "Filme cadastrado com sucesso";
        else:
            $_SESSION["msg"] = "Erro ao cadastrar filme";
        endif;

        header("Location: /");
    }

    //Método que salva o pôster do filme
    private function savePoster($file)
    {
        //Diretório em que o pôster vai ser salvo
        $posterDir = "imagens/posters/";

        //Nome que vai ser salvo o pôster
        $posterPath = $posterDir . basename($file["poster_file"]["name"]);

        $posterTmp = $file["poster_file"]["tmp_name"];

        //Movendo o arquivo
        if (move_uploaded_file($posterTmp, $posterPath)) {
            return $posterPath;
        } else {
            return false;
        }
    }

    //Método que favorita o filme
    public function favorite(int $id)
    {
        $filmesRepository = new FilmesRepositoryPDO();
        $result = ['success' => $filmesRepository->favoritar($id)];

        //Devolvendo e enviando informações
        header('Content-type: application/json');
        echo json_encode($result);
    }

    //Método que edita o filme
    public function edite(int $id)
    {
        $filmesRepository = new FilmesRepositoryPDO();
        $result = ['success' => $filmesRepository->editar($id)];

        //Devolvendo e enviando informações
        header('Content-type: application/json');
        echo json_encode($result);
    }

    //Método que deleta o filme
    public function delete(int $id)
    {
        $filmesRepository = new FilmesRepositoryPDO();
        $result = ['success' => $filmesRepository->delete($id)];

        //Devolvendo e enviando informações
        header('Content-type: application/json');
        echo json_encode($result);
    }
}
