<?php
session_start();
include_once __DIR__ . '/../infra/conexao.php';
require_once __DIR__ . '/../controllers/sensores.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$ehAdministrador = $_SESSION['usuario_cargo'] === 'Administrador';

$listaSensores = listarSensores($conexao);
$temSensoresCadastrados = temSensoresCadastrados($conexao);

if ($listaSensores === false) {
    http_response_code(500);
    die('Não foi possível carregar os sensores.');
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
    <link rel="stylesheet" href="../assets/style/paginas/sensores.css">
    <title>Sensores - Click Rails</title>
</head>
<body>
    <header>
        <?php include '../components/navbar.php'; ?>
    </header>
    <main class="layout-app">
       <?php 
        $paginaAtual = 'sensores';
        include '../components/sidbar.php';
        ?>

        <section class="conteudo-app">
            <div class="cabecalho-app">
                <h1>Central de Sensores</h1>
                <p>Gerencie todos os sensores cadastrados no sistema.</p>
            </div>

            <div class="mb-4">
                <label class="mb-2">Pesquisar sensor</label>
                <div class="sensores-barra d-flex gap-2">
                    <input type="text" id="inputPesquisa" class="sensores-input flex-grow-1" placeholder="ex. Acelerômetro">

                    <?php if ($ehAdministrador): ?>
                        <button type="button" class="btn botao-azul-escuro" id="botaoCadastrar">
                            Adicionar sensor
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card-secao">
                <h3 class="titulo-secao mb-4">Sensores</h3>
                <div id="listaSensores" style="display: <?php echo $temSensoresCadastrados ? 'block' : 'none'; ?>;">
                    <table class="table">
                        <thead class="cabecario-tabela">
                            <tr>
                                <th>ID</th>
                                <th>Sensor</th>
                                <th>Tipo</th>
                                <th>Localização</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($sensor = $listaSensores->fetch_assoc()): ?>
                                <tr>
                                    <th><?= htmlspecialchars( (string) $sensor['id_sensor'], ENT_QUOTES, 'UTF-8') ?></th>
                                    <td><?= htmlspecialchars( (string) $sensor['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars( (string) $sensor['tipo_dado'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars( (string) $sensor['localizacao'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td class="acoes-tabela">
                                        <?php if ($ehAdministrador): ?>
                                            <button
                                                type="button"
                                                class="btn-acao-tabela"
                                                onclick='abrirEdicao(
                                                    <?= json_encode([
                                                        "id" => $sensor["id_sensor"],
                                                        "nome" => $sensor["nome"],
                                                        "localizacao" => $sensor["localizacao"],
                                                        "tipo_dado" => $sensor["tipo_dado"],
                                                        "descricao" => $sensor["descricao"],
                                                        "id_trem" => $sensor["id_trem"]
                                                    ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>
                                                )'
                                                data-bs-toggle="tooltip"
                                                data-bs-title="Editar">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>

                                            <button
                                                type="button"
                                                class="btn-acao-tabela"
                                                onclick='abrirExclusao(
                                                    <?= htmlspecialchars((string) $sensor["id_sensor"], ENT_QUOTES, "UTF-8") ?>,
                                                    <?= json_encode($sensor["nome"], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>
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
                </div>
                <p class="mensagem-vazia" style="display: <?php echo !$temSensoresCadastrados ? 'block' : 'none'; ?>;">Nenhum sensor cadastrado no momento!</p>
            </div>
        </section>
    </main>
    <footer>
    </footer>

    <?php require_once __DIR__ . '/../components/modals/modalSensor.php'; ?>
    <?php require_once __DIR__ . '/../components/modals/modalExcluirSensor.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script/main.js"></script>
    <script src="../script/sensores.js"></script>
</body>
</html>