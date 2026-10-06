<div class="modal fade" id="modalCadastroRota" tabindex="-1" aria-labelledby="modalCadastroRotaLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog-cadastro">

        <div class="modal-content conteudo-modal">

            <div class="modal-header">

                <h2 id="modalCadastroRotaLabel" class="modal-title fs-4 fw-bold">
                    Cadastrar Rota
                </h2>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fechar">
                </button>

            </div>

            <div class="modal-body">

                <div
                    id="alertaCamposRota"
                    class="alerta-campos-trem"
                    role="alert"
                    aria-live="polite"
                    hidden>
                    Preencha o nome da rota.
                </div>

                <form
                    id="formularioRota"
                    method="POST"
                    action="../controllers/rotas.php">

                    <input
                        type="hidden"
                        id="acaoRota"
                        name="acao"
                        value="cadastrar">

                    <input
                        type="hidden"
                        id="idRota"
                        name="id_rota">

                    <div class="mb-3">

                        <label
                            for="nomeRota"
                            class="form-label">
                            Nome
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="nomeRota"
                            name="nome">

                    </div>

                    <div class="mb-3">

                        <label
                            for="descricaoRota"
                            class="form-label">
                            Descrição
                        </label>

                        <textarea
                            class="form-control"
                            id="descricaoRota"
                            name="descricao"
                            rows="4"></textarea>

                    </div>

                    <button
                        type="submit"
                        class="btn botao-cadastrar w-100"
                        id="botaoSalvarRota">
                        Cadastrar
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>