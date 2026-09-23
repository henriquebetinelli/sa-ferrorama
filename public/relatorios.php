<?php
session_start();
require_once __DIR__ . '/../infra/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$q = trim((string) ($_GET['q'] ?? ''));

$sql = 'SELECT r.id_relatorio, r.titulo, u.nome_usuario AS responsavel,
               DATE_FORMAT(r.gerado_em, "%d/%m/%y") AS gerado_em, r.tipo
        FROM relatorio r
        JOIN usuario u ON r.id_usuario = u.id_usuario
        LEFT JOIN trem t ON r.id_trem = t.id_trem';

if ($q !== '') {
    $sql .= ' WHERE r.titulo LIKE ?';

    $stmt = $conexao->prepare($sql . ' ORDER BY r.gerado_em DESC');

    if ($stmt === false) {
        http_response_code(500);
        die('Erro ao preparar consulta.');
    }

    $like = '%' . $q . '%';
    $stmt->bind_param('s', $like);
    $stmt->execute();

    $consultaRelatorios = $stmt->get_result();
    $stmt->close();
} else {
    $consultaRelatorios = $conexao->query($sql . ' ORDER BY r.gerado_em DESC');
}

if ($consultaRelatorios === false) {
    http_response_code(500);
    die('Não foi possível carregar os relatórios.');
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
    <title>Relatórios - Click Rails</title>
</head>

<body>
    <header>
        <?php include '../components/navbar.php'; ?>
    </header>

    <main class="layout-app">
        <?php 
        $paginaAtual = 'relatorios';
        include '../components/sidbar.php';
        ?>

        <section class="conteudo-app">
            <div class="cabecalho-app">
                <h1>Central de Relatórios</h1>
                <p>Gerencie e gere relatórios sobre as operações do Ferrorama.</p>
            </div>

            <div class="mb-4">
                <label class="mb-2">Pesquisar relatório</label>

                <div class="pagina-barra d-flex gap-2">
                    <input type="text" id="inputPesquisa" name="q" value="<?= htmlspecialchars($q ?? '', ENT_QUOTES, 'UTF-8') ?>" class="pagina-input flex-grow-1" placeholder="ex. Operação 1">

                    <button type="button" class="btn botao-azul-escuro" id="botaoCadastrar">
                        Adicionar Relatórios
                    </button>
                </div>
            </div>

            <div class="card-secao">
                <h3 class="titulo-secao mb-4">Relatórios</h3>

                <div id="listaColaboradores">

                <table class="table">
                    <thead class="cabecario-tabela">
                        <tr>
                            <th>ID</th>
                            <th>Relatório</th>
                            <th>Responsável</th>
                            <th>Período</th>
                            <th>Tipo</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($consultaRelatorios->num_rows === 0): ?>
                            <tr>
                                <td colspan="6">Nenhum relatório cadastrado no momento.</td>
                            </tr>
                        <?php else: ?>
                            <?php while ($rel = $consultaRelatorios->fetch_assoc()): ?>
                                <?php $tituloEsc = htmlspecialchars((string) $rel['titulo'], ENT_QUOTES, 'UTF-8'); ?>
                                <tr>
                                    <th><?= htmlspecialchars((string) $rel['id_relatorio'], ENT_QUOTES, 'UTF-8') ?></th>
                                    <td><?= $tituloEsc ?></td>
                                    <td><?= htmlspecialchars((string) $rel['responsavel'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars((string) $rel['gerado_em'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars((string) $rel['tipo'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td class="acoes-tabela">
                                        <button
                                            onclick="iniciarRota('expresso litoral')"
                                            class="btn-acao-tabela"
                                            data-bs-toggle="tooltip"
                                            data-bs-title="Visualizar Relatórios">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>

                                        <?php if (mb_strtolower(trim($_SESSION['usuario_cargo'] ?? '')) === mb_strtolower('Administrador')): ?>
                                            <button
                                                onclick="abrirExclusaoRelatorio(<?= (int) $rel['id_relatorio'] ?>, '<?= addslashes($tituloEsc) ?>')"
                                                class="btn-acao-tabela"
                                                data-bs-toggle="tooltip"
                                                data-bs-title="Excluir">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                
                <p id="mensagemVazia" class="mensagem-vazia" style="display: none;">
                    Nenhum trem cadastrado no momento!
                </p>

            </div>

        </section>

    </main>

    <footer>
    </footer>

    <?php require_once __DIR__ . '/../components/modals/modalRelatorios.php'; ?>
    <?php require_once __DIR__ . '/../components/modals/modalExcluirRelatorio.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script/main.js"></script>
    <script src="../script/relatorios.js"></script>
</body>
</html>