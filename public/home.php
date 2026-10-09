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
    <link rel="stylesheet" href="../assets/style/paginas/home.css">
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
            <div class="card-secao mb-4">
                <h1 class="fw-bold">Bem Vindo <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</h1>
                <p>Gerencie, monitore e mantenha tudo funcionando de forma simples e eficiente.</p>
                <button class="btn botao-azul-escuro mt-5" onclick="window.location.href='monitoramento.php'">
                    Acessar monitoramento
                    <i class="bi bi-arrow-right-short"></i>
                </button>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-2">
                    <div class="card-secao-home d-flex flex-column align-items-center justify-content-center">
                        <i class="bi bi-people-fill icone-home"></i>
                        <h1><?= htmlspecialchars((string) $totalColaboradores) ?></h1>
                        <p>Colaboradores</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card-secao-home d-flex flex-column align-items-center justify-content-center">
                        <i class="bi bi-broadcast icone-home"></i>
                        <h1>0</h1>
                        <p>Sensores</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-secao-home">
                        <h3 class="titulo-secao"></h3>
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

                        <div 
                            class="d-flex align-items-center gap-3 my-4">
                            <i class="bi bi-truck-front-fill icone-home-borda"></i>
                            <div class="flex-grow-1">
                                <p>Operação Inicial</p>
                                <div 
                                    class="progress" role="progressbar" 
                                    aria-label="Example 10px high" 
                                    aria-valuenow="25" aria-valuemin="0" 
                                    aria-valuemax="100" 
                                    style="height: 10px"
                                    data-bs-toggle="tooltip"
                                    data-bs-title="Em andamento">
                                    <div class="progress-bar progresso-da-barra" style="width: 25%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- <p class="mensagem-vazia">Nenhuma operação cadastrada no momento!</p> -->
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script/main.js"></script>
</body>

</html>