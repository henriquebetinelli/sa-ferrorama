<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/style/global.css">
    <link rel="stylesheet" href="../assets/style/paginas/rotas.css">
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
                <p>Gerencie todas as rotas cadastradas no sistema.</p>
            </div>

            <div class="mb-4">
                <label class="mb-2">Pesquisar Rota</label>
                <div class="rotas-barra d-flex gap-2">
                    <input type="text" id="inputPesquisa" class="rotas-input flex-grow-1" placeholder="ex. Rota Principal">
                    <button type="button" class="btn botao-azul-escuro" id="botaoCadastrar">Adicionar Rota</button>
                </div>
            </div>

            <div class="card-secao">
                <h3 class="titulo-secao mb-4">Rotas</h3>
                <div id="listaRotas">
                    <table class="table">
                        <thead class="cabecario-tabela">
                            <tr>
                                <th>ID</th>
                                <th>Rota</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Litoral</td>
                                <td>Começa em Joinville e segue pelas praias e cidades da região norte e central do estado.</td>
                                <td class="acoes-tabela">
                                    <button
                                        onclick="abrirEdicao(1, 'Litoral', 'ROT-001', 'começa em Joinville e segue pelas praias e cidades da região norte e central do estado')"
                                        class="btn-acao-tabela"
                                        data-bs-toggle="tooltip"
                                        data-bs-title="Editar">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>

                                    <button
                                        onclick="abrirExclusao('Litoral')"
                                        class="btn-acao-tabela"
                                        data-bs-toggle="tooltip"
                                        data-bs-title="Excluir">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <p id="mensagemVazia" class="mensagem-vazia" style="display: none;">
                        Nenhuma rota cadastrada no momento!
                    </p>
                </div>
            </div>
        </section>
    </main>

    <footer>
    </footer>

    <?php require_once __DIR__ . '/../components/modals/modalRota.php'; ?>
    <?php require_once __DIR__ . '/../components/modals/modalExcluirRota.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script/main.js"></script>
    <script src="../script/rotas.js"></script>

</body>

</html>