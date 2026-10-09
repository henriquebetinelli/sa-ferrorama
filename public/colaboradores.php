<?php
session_start();
require_once __DIR__ . '/../infra/conexao.php';
require_once __DIR__ . '/../controllers/colaboradores.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_cargo'] !== 'Administrador') {
    header("Location: login.php");
    exit();
}

$erroColaborador = $_SESSION['erro_colaborador'] ?? '';
unset($_SESSION['erro_colaborador']);

$consultaColaboradores = listarColaboradores($conexao);

if ($consultaColaboradores === false) {
    http_response_code(500);
    die('Não foi possível carregar os colaboradores.');
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
    <link rel="stylesheet" href="../assets/style/paginas/colaboradores.css">
    <title>Colaboradores - Click Rails</title>
</head>

<body>
    <header>
        <?php include '../components/navbar.php'; ?>
    </header>

    <main class="layout-app">

        <?php 
        $paginaAtual = 'colaboradores';
        include '../components/sidbar.php';
        ?>

        <section class="conteudo-app">

            <div class="cabecalho-app">
                <h1>Central de Colaboradores</h1>
                <p>Gerencie todos os colaboradores cadastrados no sistema.</p>
                <?php if ($erroColaborador): ?>
                    <div class="alerta-erro" role="alert">
                        <?= htmlspecialchars($erroColaborador) ?>
                    </div>
                <?php endif; ?>
                <button type="button" class="btn botao-azul-escuro mt-3 mb-4 px-3" id="botaoCadastrar">
                    <i class="bi bi-plus-lg"></i>
                    Adicionar colaborador
                </button>
            </div>

            <div class="mb-4">
                <label class="mb-2">Pesquisar colaborador</label>

                <div class="pagina-barra d-flex gap-2">
                    <input type="text" id="inputPesquisa" class="pagina-input flex-grow-1" placeholder="ex. João Pedro">

                    <button type="button" class="btn botao-azul-escuro px-3">
                        <i class="bi bi-search"></i>
                        Buscar
                    </button>
                </div>
            </div>

            <div class="card-secao">
                <h3 class="titulo-secao mb-4">Colaboradores</h3>

                <div id="listaColaboradores">

                <table class="table">
                    <thead class="cabecario-tabela">
                        <tr>
                            <th>ID</th>
                            <th>Colaborador</th>
                            <th>Cargo</th>
                            <th>Contato</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($colaborador = $consultaColaboradores->fetch_assoc()): ?>
                            <tr>
                                <th><?= htmlspecialchars((string) $colaborador['id_usuario'], ENT_QUOTES, 'UTF-8') ?></th>
                                <td><?= htmlspecialchars((string) $colaborador['nome_usuario'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars((string) $colaborador['cargo'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars((string) $colaborador['email'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="acoes-tabela">
                                    <button
                                        type="button"
                                        class="btn-acao-tabela"
                                        onclick='abrirEdicao(<?= json_encode([
                                            "id" => $colaborador["id_usuario"],
                                            "nome" => $colaborador["nome_usuario"],
                                            "cpf" => $colaborador["cpf"],
                                            "dataNascimento" => $colaborador["data_nascimento"],
                                            "genero" => $colaborador["genero"],
                                            "telefone" => $colaborador["telefone"],
                                            "email" => $colaborador["email"],
                                            "cargo" => $colaborador["cargo"],
                                            "cep" => $colaborador["cep"]
                                        ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>)'
                                        data-bs-toggle="tooltip"
                                        data-bs-title="Editar">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>

                                    <button
                                        type="button"
                                        onclick='abrirExclusao(<?= json_encode((string) $colaborador['id_usuario'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>, <?= json_encode((string) $colaborador['nome_usuario'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>)'
                                        class="btn-acao-tabela"
                                        data-bs-toggle="tooltip"
                                        data-bs-title="Excluir">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                
                <p id="mensagemVazia" class="mensagem-vazia" style="display: none;">
                    Nenhum colaborador cadastrado no momento!
                </p>

            </div>

        </section>

    </main>

    <?php require_once __DIR__ . '/../components/modals/modalUsuario.php'; ?>
    <?php require_once __DIR__ . '/../components/modals/modalExcluirColaborador.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="../script/main.js"></script>
<script src="../script/colaborador.js"></script>

</body>

</html>