<?php
session_start();
require_once __DIR__ . '/../infra/conexao.php';
require_once __DIR__ . '/../controllers/colaboradores.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$totalColaboradores = contarColaboradores($conexao);
?>

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
                <h1>Bem Vindo <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</h1>
                <p>Gerencie e acompanhe tudo sobre o Ferrorama.</p>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <div class="card-secao-home">
                        <h3 class="titulo-secao">Sensores</h3>
                        <a href="sensores.php" class="ver-tudo">
                            Ver tudo
                            <i class="bi bi-arrow-right-short"></i>
                        </a>
                        <p class="mensagem-vazia">Nenhum sensor cadastrado no momento!</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-secao-home">
                        <h3 class="titulo-secao">Colaboradores</h3>
                        <a href="colaboradores.php" class="ver-tudo">
                            Ver tudo
                            <i class="bi bi-arrow-right-short"></i>
                        </a>
                        <div class="mt-4">
                            <h1 class="fw-bold"><?= htmlspecialchars((string) $totalColaboradores) ?></h1>
                            <p>Colaboradores cadastrados</p>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-secao-home">
                        <h3 class="titulo-secao">Alertas</h3>
                        <a href="monitoramento.php" class="ver-tudo">
                            Ver tudo
                            <i class="bi bi-arrow-right-short"></i>
                        </a>
                        <p class="mensagem-vazia">Nenhum alerta registrado no momento!</p>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-8">
                    <div class="card-secao-home">
                        <h3 class="titulo-secao">Relatórios</h3>
                        <a href="relatorios.php" class="ver-tudo">
                            Ver tudo
                            <i class="bi bi-arrow-right-short"></i>
                        </a>
                        <p class="mensagem-vazia">Nenhum relatório disponível no momento!</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-secao-home">
                        <h3 class="titulo-secao">Operações</h3>
                        <a href="monitoramento.php" class="ver-tudo">
                            Ver tudo
                            <i class="bi bi-arrow-right-short"></i>
                        </a>
                        <p class="mensagem-vazia">Nenhuma operação cadastrada no momento!</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script/main.js"></script>
</body>

</html>