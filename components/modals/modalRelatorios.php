<div class="modal fade" id="modalRelatorios" tabindex="-1" aria-labelledby="modalRelatoriosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-cadastro">
        <div class="modal-content conteudo-modal">

            <div class="modal-header">
                <h2 id="modalRelatoriosLabel" class="modal-title fs-4 fw-bold">Gerar Novo Relatório</h2>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body">
                <form id="formularioCadastro">

                    <div class="mb-3">
                        <label for="relatorio" class="form-label">Tipo de Relatório</label>
                        <input type="select" class="form-control" id="relatorio" name="relatorio" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="trem" class="form-label">Trem</label>
                             <input type="select" class="form-control" id="trem" name="trem" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="usuario" class="form-label">Usuário responsável </label>
                            <input type="select" class="form-control" id="usuario" name="usuario" required>
                        </div>
                    </div>

                     <div class="mb-3">
                        <label for="operacao" class="form-label">Operação</label>
                        <input type="select" class="form-control" id="operacao" name="operacao" required>
                    </div>
                    
                    <button type="submit" class="btn botao-cadastrar w-100" id="botaoSalvarColaborador">
                        Gerar Relatório
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>