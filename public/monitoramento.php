<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/style/global.css">
    <link rel="stylesheet" href="../assets/style/paginas/monitoramento.css">
    <title>Monitoramento - Click Rails</title>
</head>
<body>
    <header>
        <?php include '../components/navbar.php'; ?>
    </header>

    <main class="layout-app">

        <?php
        $paginaAtual = 'monitoramento';
        include '../components/sidbar.php';
        ?>

        <section class="conteudo-app">
            <div class="cabecalho-app">
                <h1>Central de Monitoramento</h1>
                <p>Acompanhe o desempenho do ferrorama.</p>
            </div>

            <div class="row g-4 mb-4 mt-5">
                <div class="col-md-4">
                    <div class="card-compacto">
                        <h3 class="titulo-secao mb-4">Status</h3>

                        <p class="fs-5 mb-1">Em andamento</p>
                        <div class="progress mb-4" role="progressbar" aria-label="Example 10px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 15px">
                            <div class="progress-bar progresso-da-barra" style="width: 50%"></div>
                        </div>

                        <p>Início:</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-compacto">
                        <h3 class="titulo-secao">Dados da Operação</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-compacto">
                        <h3 class="titulo-secao">Velocidade</h3>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-8">
                    <div class="card-compacto">
                        <h3 class="titulo-secao mb-5">Localização</h3>

                        <div class="card-localizacao d-flex align-items-center gap-3 my-4">
                            <i class="bi bi-geo-alt-fill icone-com-borda"></i>
                            <div class="flex-grow-1">
                                <p class="fw-bold mb-0">Localização atual</p>
                                <p class="mb-0">Trecho - Sensor </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-compacto">
                        <h3 class="titulo-secao">Alertas</h3>

                        <div class="d-flex align-items-center gap-3 my-4">
                            <i class="bi bi-exclamation-triangle-fill icone-com-borda"></i>
                            <div class="flex-grow-1">
                                <p class="fw-bold mb-0">Excesso de velocidade!</p>
                                <p class="mb-0">Trem a</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-secao">
                <h3 class="titulo-secao mb-4">Ultimos registros</h3>

                <table class="table">
                    <thead class="cabecario-tabela">
                        <tr>
                            <th>ID</th>
                            <th>Sensor</th>
                            <th>Hora</th>
                            <th>Tipo</th>
                            <th>Valor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script/main.js"></script>
</body>
</html>