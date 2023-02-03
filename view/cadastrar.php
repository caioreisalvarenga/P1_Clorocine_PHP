<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include "cabecalho.php" ?>
</head>

<body>
    <div>
        <nav class="nav-extended grey darken-4">
            <div class="nav-wrapper">
                <ul id="nav-mobile" class="right">
                    <li><a href="/">Galeria</a></li>
                    <li class="active"><a href="/novo">Cadastrar</a></li>
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
        <div class="row">
            <form method="POST" enctype="multipart/form-data">
                <div class="col s6 offset-s3">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Cadastrar Filme</span>

                            <!-- INPUT TÍTULO -->
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="titulo" type="text" name="titulo" class="validate" required>
                                    <label for="titulo">Titulo do Filme</label>
                                </div>
                            </div>

                            <!-- INPUT SINOPSE -->
                            <div class="row">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea name="sinopse" id="sinopse" class="materialize-textarea"></textarea>
                                        <label for="sinopse">Sinopse</label>
                                    </div>
                                </div>
                            </div>

                            <!-- INPUT NOTA -->
                            <div class="row">
                                <div class="input-field col s4">
                                    <input name="nota" id="nota" type="number" step=".1" min="0" max="10" class="validate" required>
                                    <label for="nota">Nota</label>
                                </div>

                                <div class="col s8">
                                    <form action="#">
                                        <div class="file-field input-field">
                                            <div class="btn red accent-1 black-text">
                                                <span>Capa</span>
                                                <input type="file" name="poster_file">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input name="poster" class="file-path validate" type="text">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <a href="/" class="waves-effect waves-light grey btn">Cancelar</a>
                            <button type="submit" class="waves-effect waves-light btn red accent-3">Salvar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>