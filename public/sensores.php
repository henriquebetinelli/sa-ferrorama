<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../assets/style/global.css">
    <link rel="stylesheet" href="../assets/style/paginas/sensores.css">

    <title>Sensores - Click Rails</title>
</head>

<body>

    <header>
        <nav class="nav d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

                <img src="../assets/img/logo/logo_clara.png"
                    alt="Logo Click Rails"
                    class="logo-navbar">

                <p>
                    <strong>Click Rails</strong>
                </p>

            </div>

            <button class="btn botao-cinza"
                onclick="window.location.href='public/tela-login.html'">
                Sair
            </button>
        </nav>
    </header>

    <main class="layout-app">

       <?php 
        $paginaAtual = 'sensores';
        include '../components/sidbar.php';
        ?>

        <section class="conteudo-app">

            <div class="cabecalho-app">
                <h1>Central de Sensores</h1>

                <p>
                    Gerencie todos os sensores cadastrados no sistema.
                </p>
            </div>

            <div class="mb-4">

                <label class="mb-2">
                    Pesquisar sensor
                </label>

                <div class="sensores-barra d-flex gap-2">

                    <input type="text"
                        id="inputPesquisa"
                        class="sensores-input flex-grow-1"
                        placeholder="ex. Acelerômetro">

                    <button type="button"
                        class="btn botao-azul-escuro"
                        id="botaoCadastrar">

                        Adicionar sensor

                    </button>

                </div>

            </div>

            <div class="card-secao">
                <h3 class="titulo-secao mb-4">Sensores</h3>

                <div id="listaSensores">

                    <table class="table">
                        <thead class="cabecario-tabela">
                            <tr>
                                <th>Sensor</th>
                                <th>Código</th>
                                <th>Tipo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    Acelerômetro
                                </td>
                                <td>ACC-001</td>
                                <td>Movimento</td>
                                <td class="acoes-tabela">
                                    <button
                                        onclick="abrirEdicao(1, 'Acelerômetro', 'ACC-001', 'Movimento')"
                                        class="btn-acao-tabela"
                                        data-bs-toggle="tooltip"
                                        data-bs-title="Editar">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>

                                    <button
                                        onclick="abrirExclusao('Acelerômetro')"
                                        class="btn-acao-tabela"
                                        data-bs-toggle="tooltip"
                                        data-bs-title="Excluir">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Sensor de Temperatura
                                </td>
                                <td>TMP-002</td>
                                <td>Temperatura</td>
                                <td class="acoes-tabela">
                                    <button
                                        onclick="abrirEdicao(2, 'Sensor de Temperatura', 'TMP-002', 'Temperatura')"
                                        class="btn-acao-tabela"
                                        data-bs-toggle="tooltip"
                                        data-bs-title="Editar">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>

                                    <button
                                        onclick="abrirExclusao('Sensor de Temperatura')"
                                        class="btn-acao-tabela"
                                        data-bs-toggle="tooltip"
                                        data-bs-title="Excluir">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Sensor de Vibração
                                </td>
                                <td>VIB-003</td>
                                <td>Vibração</td>
                                <td class="acoes-tabela">
                                    <button
                                        onclick="abrirEdicao(3, 'Sensor de Vibração', 'VIB-003', 'Vibração')"
                                        class="btn-acao-tabela"
                                        data-bs-toggle="tooltip"
                                        data-bs-title="Editar">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>

                                    <button
                                        onclick="abrirExclusao('Sensor de Vibração')"
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
                        Nenhum sensor cadastrado no momento!
                    </p>
                </div>
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