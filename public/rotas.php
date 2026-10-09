<?php
session_start();

require_once __DIR__ . '/../infra/conexao.php';
require_once __DIR__ . '/../controllers/rotas.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$ehAdministrador =
    mb_strtolower(trim($_SESSION['usuario_cargo'] ?? '')) ===
    mb_strtolower('Administrador');

$erroRota = $_SESSION['erro_rota'] ?? '';
unset($_SESSION['erro_rota']);

$consultaRotas = listarRotas($conexao);

if ($consultaRotas === false) {
    http_response_code(500);
    die('Não foi possível carregar as rotas.');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link
        rel="stylesheet"
        href="../assets/style/global.css">

    <link
        rel="stylesheet"
        href="../assets/style/paginas/rotas.css">

    <title>Rotas - Click Rails</title>

</head>

<body>

    <header>

        <?php include '../components/navbar.php'; ?>

    </header>


    <main class="layout-app">

        <?php

        $paginaAtual = 'rotas';

        include '../components/sidbar.php';

        ?>


        <section class="conteudo-app">


            <div class="cabecalho-app">

                <h1>Central de Rotas</h1>

                <p>
                    Gerencie todas as rotas cadastradas no sistema.
                </p>

                <?php if ($ehAdministrador): ?>

                    <button
                        type="button"
                        class="btn botao-azul-escuro mt-3 mb-4 px-3"
                        id="botaoCadastrar">

                        <i class="bi bi-plus-lg"></i>
                        Adicionar Rota

                    </button>

                <?php endif; ?>

            </div>


            <?php if ($erroRota !== ''): ?>

                <div class="alert alert-danger">
                    <?= htmlspecialchars($erroRota) ?>
                </div>

            <?php endif; ?>


            <div class="mb-4">

                <label class="mb-2">
                    Pesquisar rota
                </label>

                <div class="rotas-barra d-flex gap-2">

                    <input
                        type="text"
                        id="inputPesquisa"
                        class="pagina-input flex-grow-1"
                        placeholder="ex. Rota Principal">

                    <button type="button" class="btn botao-azul-escuro px-3">
                        <i class="bi bi-search"></i>
                        Buscar
                    </button>

                </div>

            </div>


            <div class="card-secao">

                <h3 class="titulo-secao mb-4">
                    Rotas
                </h3>


                <div id="listaRotas">

                    <?php if (!temRotasCadastradas($conexao)): ?>
                        <p class="mensagem-vazia" >Nenhuma rota cadastrada no momento!</p>
                    <?php else: ?>
                        
                        <table class="table">

                            <thead class="cabecario-tabela">

                                <tr>

                                    <th>ID</th>

                                    <th>Rota</th>

                                    <th>Descrição</th>

                                    <?php if ($ehAdministrador): ?>

                                        <th>Ações</th>

                                    <?php endif; ?>
                                </tr>

                            </thead>


                            <tbody>

                                    <?php while ($rota = $consultaRotas->fetch_assoc()): ?>

                                        <tr>

                                            <td>
                                                <?= htmlspecialchars(
                                                    $rota['id_rota']
                                                ) ?>
                                            </td>


                                            <td>
                                                <?= htmlspecialchars(
                                                    $rota['nome']
                                                ) ?>
                                            </td>


                                            <td>
                                                <?= htmlspecialchars(
                                                    $rota['descricao'] ?? ''
                                                ) ?>
                                            </td>


                                            <?php if ($ehAdministrador): ?>

                                                <td class="acoes-tabela">

                                                    <button
                                                        type="button"
                                                        class="btn-acao-tabela"
                                                        onclick='abrirEdicaoRota(
                                                            <?= json_encode($rota['id_rota']) ?>,
                                                            <?= json_encode($rota['nome']) ?>,
                                                            <?= json_encode($rota['descricao'] ?? '') ?>
                                                        )'
                                                        data-bs-toggle="tooltip"
                                                        data-bs-title="Editar">

                                                        <i class="bi bi-pencil-fill"></i>

                                                    </button>


                                                    <button
                                                        type="button"
                                                        class="btn-acao-tabela"
                                                        onclick='abrirExclusaoRota(
                                                            <?= json_encode($rota['id_rota']) ?>,
                                                            <?= json_encode($rota['nome']) ?>
                                                        )'
                                                        data-bs-toggle="tooltip"
                                                        data-bs-title="Excluir">

                                                        <i class="bi bi-trash-fill"></i>

                                                    </button>

                                                </td>

                                            <?php endif; ?>

                                        </tr>

                                    <?php endwhile; ?>

                            </tbody>

                        </table>

                    <?php endif; ?>

                </div>

            </div>

        </section>

    </main>


    <?php require_once __DIR__ . '/../components/modals/modalRota.php'; ?>

    <?php require_once __DIR__ . '/../components/modals/modalExcluirRota.php'; ?>


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

    <script src="../script/main.js"></script>

    <script src="../script/rotas.js"></script>

</body>

</html>