<div class="modal fade" id="modalCadastro" tabindex="-1" aria-labelledby="modalCadastroLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-cadastro">
        <div class="modal-content conteudo-modal">

            <div class="modal-header">
                <h2 id="modalCadastroLabel" class="modal-title fs-4 fw-bold">Cadastrar Colaborador</h2>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body">
                <form id="formularioCadastro" method="POST" action="../controllers/usuario/salvarUsuario.php">
                    <input type="hidden" id="idUsuario" name="id_usuario">

                    <div class="mb-3">
                        <div id="alertaCamposColaborador" class="alerta-campos-trem" role="alert" aria-live="polite" hidden>
                            Preencha todos os campos.
                        </div>
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="dataNascimento"
                                name="data_nascimento">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="genero" class="form-label">Gênero</label>
                            <input type="text" class="form-control" id="genero" name="genero">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="telefone" name="telefone">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cargo" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="cargo" name="cargo">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cep" name="cep">
                        </div>
                    </div>

                    <button type="submit" class="btn botao-cadastrar w-100" id="botaoSalvarColaborador">
                        Cadastrar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>