<div class="modal fade" id="modalCadastro" tabindex="-1" aria-labelledby="modalCadastroLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-cadastro">
        <div class="modal-content conteudo-modal">

            <div class="modal-header">
                <h2 id="modalCadastroLabel" class="modal-title fs-4 fw-bold">Cadastrar Rota</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body">
                <form id="formularioCadastro">

                    <div class="mb-3">
                        <div id="alertaCamposRota" class="alerta-campos-trem" role="alert" aria-live="polite" hidden>
                            Preencha todos os campos.
                        </div>

                        <label for="nomeRota" class="form-label">Nome da rota</label>
                        <input type="text" class="form-control" id="nomeRota" name="nome_rota" required>
                    </div>

                    <div class="mb-3">
                        <label for="codigoRota" class="form-label">Código</label>
                        <input type="text" class="form-control" id="codigoRota" name="codigo_rota" placeholder="ex. ROT-001" required>
                    </div>

                    <div class="mb-3">
                        <label for="descricaoRota" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricaoRota" name="descricao_rota" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn botao-cadastrar w-100" id="botaoSalvarRota">
                        Cadastrar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
