<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php include "cabecalho.php"; ?>
</head>

<?php
if (!isset($_SESSION)) {
  session_start();
}

require "./util/Mensagem.php";

$controller = new FilmesController();
$filmes = $controller->index();

?>

<body>
  <div>
    <nav class="nav-extended grey darken-4">
      <div class="nav-wrapper">
        <ul id="nav-mobile" class="right">
          <li class="active"><a href="/">Galeria</a></li>
          <li><a href="/novo">Cadastrar</a></li>
        </ul>
      </div>
      <div class="nav-header center">
        <h1>CLOROCINE</h1>
      </div>
      <div class="nav-content">
        <ul class="tabs tabs-transparent red accent-3">
          <li class="tab"><a class="active" href="/">Todos</a></li>
          <li class="tab"><a href="/favoritos">Favoritos</a></li>
        </ul>
      </div>
    </nav>
  </div>

  <div class="container">
    <!-- GERAÇÃO DOS CARDS DE FILMES -->
    <div class="row">

      <?php
      //Verificando se tem algum filme cadastrado
      if (!$filmes) {
        echo "<p class='card-panel red lighten-4'>Nenhum filme foi cadastrado</p>";
      }
      ?>

      <?php
      foreach ($filmes as $filme) : ?>
        <div class="col s7 m4 l4 xl3" style="cursor: pointer;">
          <div class="card hoverable card-serie">
            <div class="card-image">
              <img src="<?= $filme->poster ?>" class="activator" />
              <button class="btn-fav btn-floating halfway-fab waves-effect waves-light red" data-id="<?= $filme->id ?>">
                <i class="material-icons"><?= ($filme->favorito) ? "favorite" : "favorite_border" ?></i>
              </button>
            </div>
            <div class="card-content">
              <p class="valign-wrapper">
                <i class="material-icons amber-text">star</i> <?= $filme->nota ?>
              </p>
              <span class="card-title activator truncate">
                <?= $filme->titulo ?>
              </span>
            </div>
            <div class="card-reveal">
              <span class="card-title grey-text text-darken-4"><?= $filme->titulo ?><i class="material-icons right">close</i></span>

              <!-- Limitando os caracteres da sinopse -->
              <p><?= substr($filme->sinopse, 0, 500) . "..." ?></p>

              <button class="waves-effect waves-light btn-small right red accent-2 btn-delete" data-id="<?= $filme->id ?>"><i class="material-icons">delete</i></button>
              <a href="/editar" class="waves-effect waves-light btn-small orange accent-2 btn-edit" data-id="<?= $filme->id ?>"><i class="material-icons">edit</i></a>

            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
</body>

<!-- Mostrando mensagem, caso o filme for cadastrado com sucesso -->
<?= Mensagem::mostrar(); ?>

<script>
  //Favortitar um filme
  document.querySelectorAll(".btn-fav").forEach(btn => {
    btn.addEventListener("click", e => {
      const id = btn.getAttribute("data-id")
      fetch(`/favoritar/${id}`)
        .then(response => response.json())
        .then(response => {
          if (response.success === "ok") {
            if (btn.querySelector("i").innerHTML === "favorite") {
              //Desfavoritando
              btn.querySelector("i").innerHTML = "favorite_border"

              M.toast({
                html: 'Desfavoritado com sucesso'
              })
            } else {
              //Favoritando
              btn.querySelector("i").innerHTML = "favorite"

              M.toast({
                html: 'Favoritado com sucesso'
              })
            }
          }
        })
        .catch(error => {
          M.toast({
            html: 'Erro ao favoritar'
          })
        })
    });
  });

  //Deletar um filme
  document.querySelectorAll(".btn-delete").forEach(btn => {
    btn.addEventListener("click", e => {
      const id = btn.getAttribute("data-id")
      const requestConfig = {
        method: "DELETE",
        headers: new Headers()
      }
      fetch(`/filmes/${id}`, requestConfig)
        .then(response => response.json())
        .then(response => {
          if (response.success === "ok") {
            const card = btn.closest(".col")
            card.classList.add("fadeOut")
            setTimeout(() => card.remove(), 1000)
            M.toast({
              html: 'Deletado com sucesso'
            })
          }
        })
        .catch(error => {
          M.toast({
            html: 'Erro ao deletar'
          })
        })
    });
  });
</script>

</html>