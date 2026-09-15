<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/style/global.css">
    <link rel="stylesheet" href="../assets/style/paginas/colaboradores.css">
    <title>Colaboradores - Click Rails</title>
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

        <section class="sidebar-app">
            <div class="nav-sidebar">

                <a href="tela-home.html" class="link-sidebar">
                    <i class="bi bi-house-door"></i>
                    <span>Início</span>
                </a>

                <a href="#" class="link-sidebar">
                    <i class="bi bi-grid"></i>
                    <span>Dashboards</span>
                </a>

                <a href="tela-colaboradores.html" class="link-sidebar ativo">
                    <i class="bi bi-person"></i>
                    <span>Colaboradores</span>
                </a>

                <a href="tela-sensores.html" class="link-sidebar">
                    <i class="bi bi-bar-chart-line"></i>
                    <span>Sensores</span>
                </a>

                <a href="#" class="link-sidebar">
                    <i class="bi bi-inbox"></i>
                    <span>Registros</span>
                </a>

            </div>
        </section>

        <section class="conteudo-app">

            <div class="cabecalho-app">
                <h1>Central de Colaboradores</h1>
                <p>Gerencie todos os colaboradores cadastrados no sistema.</p>
            </div>

            <div class="mb-4">
                <label class="mb-2">Pesquisar colaborador</label>

                <div class="colaboradores-barra d-flex gap-2">
                    <input type="text" id="inputPesquisa" class="colaboradores-input flex-grow-1"
                        placeholder="ex. João Pedro">

                    <button type="button" class="btn botao-azul-escuro" id="botaoCadastrar">
                        Adicionar colaborador
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
                        <tr>
                            <th>1</th>
                            <td>João Pedro</td>
                            <td>Administrador</td>
                            <td>joaopedro@gmail.com</td>
                            <td class="acoes-tabela">
                                <button 
                                    onclick="abrirEdicao(1, 'João Pedro', '456.789.123-00', '20/10/1998', 'Feminino', '(47) 77777-7777', 'maria@email.com', 'Técnico', '89200-000')" 
                                    class="btn-acao-tabela"
                                    data-bs-toggle="tooltip"
                                    data-bs-title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <button 
                                    onclick="abrirExclusao('João Pedro')" 
                                    class="btn-acao-tabela"
                                    data-bs-toggle="tooltip"
                                    data-bs-title="Excluir">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <p id="mensagemVazia" class="mensagem-vazia" style="display: none;">
                    Nenhum colaborador cadastrado no momento!
                </p>

            </div>

        </section>

    </main>

    <footer>
    </footer>

    <?php require_once __DIR__ . '/../../components/modals/modalUsuario.php'; ?>
    
<!-- modal exclusão -->
<div class="modal fade" id="modalExcluir" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h1 class="modal-title fs-5">
                    Excluir Colaborador
                </h1>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <p>
                    Tem certeza que deseja excluir o colaborador
                    <strong id="nomeExcluir"></strong>?
                </p>

                <div class="d-flex gap-2">

                    <button type="button" class="btn botao-branco w-50" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="button" class="btn botao-cadastrar w-50" id="botaoExcluir">
                        Excluir
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../script/main.js"></script>
<script src="../../script/colaborador.js"></script>

</body>

</html>