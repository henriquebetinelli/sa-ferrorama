<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/style/global.css">
    <title>Início - Click Rails</title>
</head>

<body>
    <header>
        <?php include '../components/navbar.php'; ?>
    </header>

    <main class="layout-app">
        <?php 
        $paginaAtual = 'home';
        include '../components/sidbar.php';
        ?>

        <section class="conteudo-app">
            <div class="cabecalho-app">
                <h1>Bem Vindo <span id="nomeUsuario">{{Nome}}</span>!</h1>
                <p>Gerencie e acompanhe tudo sobre o Ferrorama.</p>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="card-secao">

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-secao">

                    </div>
                </div>
            </div>

            <div class="card-secao">
                <h3 class="titulo-secao">Sensores</h3>
                <p class="mensagem-vazia">Nenhum sensor cadastrado no momento!</p>
            </div>
        </section>
    </main>
    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script/main.js"></script>
</body>

</html>