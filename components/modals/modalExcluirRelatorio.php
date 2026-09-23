<div class="modal fade" id="modalExcluirRelatorio" tabindex="-1" aria-labelledby="modalExcluirRelatorioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="modalExcluirRelatorioLabel">Excluir relatório</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="idRelatorioExcluir">
                <p>Tem certeza que deseja excluir o relatório <strong id="tituloExcluirRelatorio"></strong>?</p>

                <div class="d-flex gap-2">
                    <button type="button" class="btn botao-branco w-50" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="button" class="btn botao-cadastrar w-50" id="botaoExcluirRelatorio">
                        Excluir
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
