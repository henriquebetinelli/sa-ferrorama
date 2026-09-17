<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/style/global.css">
    <title>Trens - Click Rails</title>
</head>

<body>
    <header>
        <nav class="nav d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="../assets/img/logo/logo_clara.png" alt="Logo Click Rails" class="logo-navbar">

                <p>
                    <strong>Click Rails</strong>
                </p>
            </div>

            <button class="btn botao-cinza" onclick="window.location.href='public/tela-login.html'">
                Sair
            </button>
        </nav>
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
                    <input type="text" id="inputPesquisa" class="pagina-input flex-grow-1" placeholder="ex. Expresso Litoral">

                    <button type="button" class="btn botao-azul-escuro" id="botaoCadastrar">
                        Adicionar trem
                    </button>
                </div>
            </div>

            <div class="card-secao">
                <h3 class="titulo-secao mb-4">Trens</h3>

                <div id="listaColaboradores">

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
                        <tr>
                            <th>1</th>
                            <td>Expresso Litoral</td>
                            <td>Trens de Carga</td>
                            <td>Parado</td>
                            <td class="acoes-tabela">
                                <button 
                                    onclick="iniciarRota('expresso litoral')" 
                                    class="btn-acao-tabela"
                                    data-bs-toggle="tooltip"
                                    data-bs-title="Iniciar Rota">
                                    <i class="bi bi-truck-front-fill"></i>
                                </button>

                                <button 
                                    onclick="abrirEdicao(1, 'Expresso Litoral', 'Trens de Carga')" 
                                    class="btn-acao-tabela"
                                    data-bs-toggle="tooltip"
                                    data-bs-title="Editar">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>

                                <button 
                                    onclick="abrirExclusao('Expresso Litoral')" 
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

    <?php require_once __DIR__ . '/../components/modals/modalTrem.php'; ?>
    <?php require_once __DIR__ . '/../components/modals/modalExcluirTrem.php'; ?>
    <?php require_once __DIR__ . '/../components/modals/modalIniciarRota.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script/main.js"></script>
    <script src="../script/trens.js"></script>
</body>
</html>