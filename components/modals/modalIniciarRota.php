<div class="modal fade" id="modalIniciarRota" tabindex="-1" aria-labelledby="modalIniciarRotaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-cadastro">
        <div class="modal-content conteudo-modal">

            <div class="modal-header">
                <h2 id="modalIniciarRotaLabel" class="modal-title fs-4 fw-bold">Iniciar rota</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            
            <div class="modal-body">
                <form id="formularioIniciarRota">
                    <div class="mb-3">
                        <div id="alertaCamposRota" class="alerta-campos-trem" role="alert" aria-live="polite" hidden>
                            Preencha todos os campos.
                        </div>
                        <label for="tremRota" class="form-label">Trem</label>
                        <select class="form-control" id="tremRota" name="trem">
                            <option value="">Selecione um trem</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="rotaTrem" class="form-label">Rota</label>
                        <select class="form-control" id="rotaTrem" name="rota">
                            <option value="">Selecione uma rota</option>
                        </select>
                    </div>

                    <hr>

                    <div>
                        <p><strong>Inicio previsto</strong></p>
                        <p></p>
                    </div>

                    <div>
                        <p><strong>Sensores vinculados</strong></p>
                        <p></p>
                    </div>

                    <button type="submit" class="btn botao-cadastrar w-100" id="botaoIniciarRota">
                        Iniciar Operação
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>