
<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

require_once __DIR__ . '/../infra/conexao.php';
require_once __DIR__ . '/../controllers/operacoes.php';
require_once __DIR__ . '/../controllers/trens.php';
require_once __DIR__ . '/../controllers/rotas.php';

$paginaAtual = 'monitoramento';

// Iniciar uma nova operação
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['acao'] ?? '') === 'iniciar_operacao') {
    $idTrem = (int) ($_POST['trem'] ?? 0);
    $idRota = (int) ($_POST['rota'] ?? 0);

    if ($idTrem > 0 && $idRota > 0) {
        $idNovaOperacao = iniciarOperacao($conexao, $idTrem, $idRota);

        if ($idNovaOperacao) {
            header("Location: monitoramento.php?id_operacao=" . $idNovaOperacao);
            exit();
        }
    }

    header("Location: monitoramento.php");
    exit();
}

$listaOperacoes = listarOperacoes($conexao);

$idOperacaoSelecionada = (int) ($_GET['id_operacao'] ?? 0);

$operacaoSelecionada = $idOperacaoSelecionada > 0
    ? buscarOperacaoPorId($conexao, $idOperacaoSelecionada)
    : null;
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
    <main class="layout-app">

        <?php include '../components/sidbar.php'; ?>

        <section class="conteudo-app">
            <div class="cabecalho-app">
                <h1>Central de Monitoramento</h1>
                <p>Acompanhe o desempenho do ferrorama.</p>
            </div>

            <button type="button" class="btn botao-azul-escuro" data-bs-toggle="modal" data-bs-target="#modalSelecionarOperacao">
                <i class="bi bi-folder me-1"></i>
                Selecionar operação
            </button>

            <button type="button" class="btn botao-branco ms-2"
                data-bs-toggle="modal" data-bs-target="#modalIniciarOperacao">
                <i class="bi bi-plus-lg"></i>
                Iniciar operação
            </button>

            <div class="row g-4 mb-4 mt-5">
                <div class="col-md-4">
                    <div class="card-compacto">
                        <h3 class="titulo-secao mb-4">Status</h3>

                        <?php if ($operacaoSelecionada): ?>
                            <p class="fs-5 mb-1"><?= htmlspecialchars($operacaoSelecionada['status']) ?></p>
                            <p>Início: <?= date('d/m/Y H:i', strtotime($operacaoSelecionada['inicio_em'])) ?></p>
                        <?php else: ?>
                            <div class="mensagem-vazia">
                                Selecione uma operação para puxar os dados.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-compacto">
                        <h3 class="titulo-secao">Dados da Operação</h3>

                        <?php if ($operacaoSelecionada): ?>
                            <p><strong>Trem:</strong> <?= htmlspecialchars($operacaoSelecionada['nome_trem']) ?></p>
                            <p><strong>Rota:</strong> <?= htmlspecialchars($operacaoSelecionada['nome_rota']) ?></p>
                            <p><strong>Operação:</strong> <?= $operacaoSelecionada['id_operacao'] ?></p>
                        <?php else: ?>
                            <div class="mensagem-vazia">
                                Selecione uma operação para puxar os dados.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-compacto">
                        <h3 class="titulo-secao">Velocidade</h3>

                        <div class="mensagem-vazia">
                            Selecione uma operação para puxar os dados.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-8">
                    <div class="card-compacto">
                        <h3 class="titulo-secao mb-4">Localização</h3>

                        <div class="mensagem-vazia">
                            Selecione uma operação para puxar os dados.
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-compacto">
                        <h3 class="titulo-secao">Alertas</h3>

                        <div class="mensagem-vazia">
                            Selecione uma operação para puxar os dados.
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-secao">
                <h3 class="titulo-secao mb-4">Últimos registros</h3>

                <div class="mensagem-vazia">
                    Selecione uma operação para puxar os dados.
                </div>
            </div>
        </section>
    </main>

    <?php require_once __DIR__ . '/../components/modals/modalSelecionarOperacao.php'; ?>
    <?php require_once __DIR__ . '/../components/modals/modalIniciarOperacao.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script/main.js"></script>
</body>
</html>
