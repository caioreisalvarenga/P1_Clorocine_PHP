<?php

require "Conexao.php";

class FilmesRepositoryPDO
{

    private $conexao;

    //Conexão com banco de dados
    public function __construct()
    {
        $this->conexao =  Conexao::criar();
    }

    //Lista todos os filmes
    public function listarTodos()
    {
        $filmesLista = array();

        $sql = "SELECT * FROM filmes ORDER BY id DESC";
        $filmes = $this->conexao->query($sql);
        if (!$filmes) return false;

        while ($filme = $filmes->fetchObject()) {
            array_push($filmesLista, $filme);
        }

        return $filmesLista;
    }

    //Lista todos os filmes favoritados
    public function listarFavoritos()
    {
        $filmesLista = array();

        $sql = "SELECT * FROM filmes WHERE favorito";
        $filmes = $this->conexao->query($sql);
        if (!$filmes) return false;

        while ($filme = $filmes->fetchObject()) {
            array_push($filmesLista, $filme);
        }

        return $filmesLista;
    }

    //Salva os filmes
    public function salvar($filme): bool
    {
        $sql = "INSERT INTO filmes (titulo, poster, sinopse, nota) 
        VALUES (:titulo, :poster, :sinopse, :nota)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':titulo', $filme->titulo, PDO::PARAM_STR);
        $stmt->bindValue(':sinopse', $filme->sinopse, PDO::PARAM_STR);
        $stmt->bindValue(':nota', $filme->nota, PDO::PARAM_STR);
        $stmt->bindValue(':poster', $filme->poster, PDO::PARAM_STR);

        return $stmt->execute();
    }

    //Favorita os filmes
    public function favoritar(int $id)
    {
        $sql = "UPDATE filmes SET favorito = NOT favorito WHERE id=:id";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "erro";
        }
    }

     //Edita os filmes
     public function editar(int $id)
     {
         $sql = "UPDATE filmes SET titulo = ?, sinopse = ?, nota = ?, poster = ? WHERE id = $id";
         $stmt = $this->conexao->prepare($sql);

         if ($stmt->execute()) {
             return "ok";
         } else {
             return "erro";
         }
     }

    //Deleta o filme
    public function delete(int $id)
    {
        $sql = "DELETE FROM filmes WHERE id=:id";
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "erro";
        }
    }
}
