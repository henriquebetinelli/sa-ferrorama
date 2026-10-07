<?php
require_once __DIR__ . '/../../controllers/trens.php';
$trens = listarTrens($conexao);
?>

<div class="modal fade" id="modalCadastroSensor" tabindex="-1" aria-labelledby="modalCadastroSensorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-cadastro">
        <div class="modal-content conteudo-modal">

            <div class="modal-header">
                <h2 id="modalCadastroSensorLabel" class="modal-title fs-4 fw-bold">Cadastrar Sensor</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body">
                <form id="formularioCadastroSensor" method="POST" action="../controllers/sensores.php">
                    <input type="hidden" name="acao" id="acaoSensor" value="cadastrar">
                    <input type="hidden" name="id_sensor" id="idSensor">

                    <div id="alertaCamposSensor" class="alerta-campos-trem mb-3" role="alert" aria-live="polite" hidden>
                        Preencha todos os campos.
                    </div>

                    <div class="mb-3">
                        <label for="nomeSensor" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nomeSensor" name="nome">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tipoSensor" class="form-label">Tipo</label>
                            <select class="form-control"  id="tipoSensor" name="tipoSensor">
                                <option value=""></option>
                                <option value="velocidade">Velocidade</option>
                                <option value="temperatura">Temperatura</option>
                                <option value="localização">Localização</option>
                                <option value="vibração">Vibração</option>
                                <option value="proximidade">Proximidade</option>
                                <option value="freio">Freio</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label  id="tituloLimite" for="limiteSensor" class="form-label">Limite máximo</label>
                            <input type="number" id="limiteSensor" name="limiteSensor" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="localizacaoSensor" class="form-label">Anexado</label>
                            <select class="form-control" id="localizacaoSensor" name="localizacao">
                                <option value=""></option>
                                <option value="cabinas">Trem</option>
                                <option value="vagao">Rota</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tremSensor" class="form-label">Trem</label>
                            <select class="form-control" id="tremSensor" name="id_trem">
                                <option value=""></option>
                                <?php if ($trens): while ($trem = $trens->fetch_assoc()): ?>
                                    <option value="<?php echo htmlspecialchars((string)$trem['id_trem'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars((string)$trem['nome'], ENT_QUOTES, 'UTF-8'); ?></option>
                                <?php endwhile; endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="descricaoSensor" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricaoSensor" name="descricao"></textarea>
                    </div>

                    <button type="submit" class="btn botao-cadastrar w-100" id="botaoSalvarSensor">Cadastrar</button>
                </form>
            </div>

        </div>
    </div>
</div>