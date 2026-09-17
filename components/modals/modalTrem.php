<div class="modal fade" id="modalCadastroTrem" tabindex="-1" aria-labelledby="modalCadastroTremLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-cadastro">
        <div class="modal-content conteudo-modal">

            <div class="modal-header">
                <h2 id="modalCadastroTremLabel" class="modal-title fs-4 fw-bold">Cadastrar trem</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            
            <div class="modal-body">
                <form id="formularioCadastroTrem">
                    <div class="mb-3">
                        <div id="alertaCamposTrem" class="alerta-campos-trem" role="alert" aria-live="polite" hidden>
                            Preencha todos os campos.
                        </div>
                        <label for="nomeTrem" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nomeTrem" name="nome">
                    </div>

                    <div class="mb-3">
                        <label for="modeloTrem" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="modeloTrem" name="modelo">
                    </div>

                    <button type="submit" class="btn botao-cadastrar w-100" id="botaoSalvarTrem">
                        Cadastrar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>