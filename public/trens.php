<?php
session_start();
require_once __DIR__ . '/../infra/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$ehAdministrador = $_SESSION['usuario_cargo'] === 'Administrador';

$consultaTrens = $conexao->query(
    'SELECT id_trem, nome, modelo, status
     FROM trem
     ORDER BY nome ASC'
);

if ($consultaTrens === false) {
    http_response_code(500);
    die('Não foi possível carregar os trens.');
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
    <title>Trens - Click Rails</title>
</head>

<body>
    <header>
        <?php include '../components/navbar.php'; ?>
    </header>

    <main class="layout-app">

        <?php
        $paginaAtual = 'trens';
        include '../components/sidbar.php';
        ?>

        <section class="conteudo-app">

            <div class="cabecalho-app">
                <h1>Central de Trens</h1>
                <p>Gerencie todos os trens cadastrados no sistema.</p>
            </div>

            <div class="mb-4">
                <label class="mb-2">Pesquisar trem</label>

                <div class="pagina-barra d-flex gap-2">
                    <input
                        type="text"
                        id="inputPesquisa"
                        class="pagina-input flex-grow-1"
                        placeholder="ex. Expresso Litoral">

                    <?php if ($ehAdministrador): ?>
                        <button
                            type="button"
                            class="btn botao-azul-escuro"
                            id="botaoCadastrar">
                            Adicionar trem
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card-secao">
                <h3 class="titulo-secao mb-4">Trens</h3>

                <div id="listaTrens">
                    <table class="table">
                        <thead class="cabecario-tabela">
                            <tr>
                                <th>ID</th>
                                <th>Trem</th>
                                <th>Modelo</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php while ($trem = $consultaTrens->fetch_assoc()): ?>
                                <tr>
                                    <th><?= htmlspecialchars((string) $trem['id_trem'], ENT_QUOTES, 'UTF-8') ?></th>
                                    <td><?= htmlspecialchars((string) $trem['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars((string) $trem['modelo'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars((string) $trem['status'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td class="acoes-tabela">
                                        <button
                                            type="button"
                                            class="btn-acao-tabela"
                                            onclick="iniciarRota(<?= htmlspecialchars(json_encode($trem['id_trem']), ENT_QUOTES, 'UTF-8') ?>)"
                                            data-bs-toggle="tooltip"
                                            data-bs-title="Iniciar Rota">
                                            <i class="bi bi-truck-front-fill"></i>
                                        </button>

                                        <?php if ($ehAdministrador): ?>
                                            <button
                                                type="button"
                                                class="btn-acao-tabela"
                                                onclick='abrirEdicao(<?= json_encode([
                                                    "id" => $trem["id_trem"],
                                                    "nome" => $trem["nome"],
                                                    "modelo" => $trem["modelo"],
                                                    "status" => $trem["status"]
                                                ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>)'
                                                data-bs-toggle="tooltip"
                                                data-bs-title="Editar">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>

                                            <button
                                                type="button"
                                                class="btn-acao-tabela"
                                                onclick='abrirExclusao(
                                                    <?= htmlspecialchars((string) $trem["id_trem"], ENT_QUOTES, "UTF-8") ?>,
                                                    <?= json_encode($trem["nome"], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>
                                                )'
                                                data-bs-toggle="tooltip"
                                                data-bs-title="Excluir">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <p
                        id="mensagemVazia"
                        class="mensagem-vazia"
                        style="display: none;">
                        Nenhum trem cadastrado no momento!
                    </p>
                </div>
            </div>
        </section>
    </main>

    <footer>
    </footer>

    <?php if ($ehAdministrador): ?>
        <?php require_once __DIR__ . '/../components/modals/modalTrem.php'; ?>
        <?php require_once __DIR__ . '/../components/modals/modalExcluirTrem.php'; ?>
    <?php endif; ?>

    <?php require_once __DIR__ . '/../components/modals/modalIniciarRota.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script/main.js"></script>
    <script src="../script/trens.js"></script>

</body>

</html>