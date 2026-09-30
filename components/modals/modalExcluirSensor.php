<div class="modal fade" id="modalExcluirSensor" tabindex="-1" aria-labelledby="modalExcluirSensorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="modalExcluirSensorLabel">Excluir sensor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar" ></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir o sensor <strong id="nomeExcluirSensor"></strong>?</p>

                <form method="POST" action="../controllers/sensores.php">
                    <input type="hidden" name="acao" value="excluir" >
                    <input type="hidden" name="id_sensor" id="idSensorExclusao">

                    <div class="d-flex gap-2">
                        <button type="button" class="btn botao-branco w-50" data-bs-dismiss="modal">Cancelar</button>

                        <button type="submit" class="btn botao-cadastrar w-50">Excluir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>