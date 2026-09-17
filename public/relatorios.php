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
                    <input type="text" id="inputPesquisa" class="pagina-input flex-grow-1" placeholder="ex. Operação 1">

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
                        <tr>
                            <th>1</th>
                            <td>Operação 1</td>
                            <td>João Pedro</td>
                            <td>17/09/26</td>
                            <td>Operacional</td>
                            <td class="acoes-tabela">
                                <button 
                                    onclick="iniciarRota('expresso litoral')" 
                                    class="btn-acao-tabela"
                                    data-bs-toggle="tooltip"
                                    data-bs-title="Visualizar Relatórios">
                                    <i class="bi bi-eye-fill"></i>
                                </button>

                                <button 
                                    onclick="abrirExclusaoRelatorio(1, 'Operação 1')" 
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