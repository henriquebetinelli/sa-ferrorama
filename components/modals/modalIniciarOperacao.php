
<?php
require_once __DIR__ . '/../../controllers/trens.php';
require_once __DIR__ . '/../../controllers/rotas.php';

if (!isset($conexao)) {
    require_once __DIR__ . '/../../infra/conexao.php';
}

$trensDisponiveis = listarTrens($conexao);
$rotasDisponiveis = listarRotas($conexao);

$sqlSensores = "SELECT id_sensor, nome, tipo_dado, id_trem, id_rota
                FROM sensor
                ORDER BY nome ASC";

$resultadoSensores = mysqli_query($conexao, $sqlSensores);
?>

<div class="modal fade" id="modalIniciarOperacao" tabindex="-1" aria-labelledby="modalIniciarOperacaoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-cadastro">
        <div class="modal-content conteudo-modal">

            <div class="modal-header">
                <h2 id="modalIniciarOperacaoLabel" class="modal-title fs-4 fw-bold">
                    Iniciar operação
                </h2>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body">
                <form id="formularioIniciarOperacao" method="POST" action="monitoramento.php">

                    <input type="hidden" name="acao" value="iniciar_operacao">

                    <div class="mb-3">
                        <div id="alertaCamposOperacao" class="alerta-campos-trem" role="alert" aria-live="polite" hidden>
                            Selecione um trem e uma rota antes de iniciar.
                        </div>

                        <label for="tremOperacao" class="form-label">Trem</label>

                        <select class="form-control" id="tremOperacao" name="trem" required>
                            <option value=""></option>

                            <?php if ($trensDisponiveis && $trensDisponiveis->num_rows > 0): ?>
                                <?php while ($trem = $trensDisponiveis->fetch_assoc()): ?>
                                    <option value="<?= (int) $trem['id_trem'] ?>">
                                        <?= htmlspecialchars($trem['nome'], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <option value="" disabled>Nenhum trem cadastrado</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="rotaOperacao" class="form-label">Rota</label>

                        <select class="form-control" id="rotaOperacao" name="rota" required>
                            <option value=""></option>

                            <?php if ($rotasDisponiveis && $rotasDisponiveis->num_rows > 0): ?>
                                <?php while ($rota = $rotasDisponiveis->fetch_assoc()): ?>
                                    <option value="<?= (int) $rota['id_rota'] ?>">
                                        <?= htmlspecialchars($rota['nome'], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <option value="" disabled>Nenhuma rota cadastrada</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <hr>

                    <div class="container-inicio-previsto-rota">
                        <span class="label-inicio-previsto-rota">Início previsto</span>
                        <span id="inicioPrevistoOperacao" class="valor-inicio-previsto-rota"></span>
                    </div>

                    <div class="mt-3 mb-4">
                        <p><strong>Sensores vinculados</strong></p>


                            <?php if ($resultadoSensores): ?>
                                <?php while ($sensor = mysqli_fetch_assoc($resultadoSensores)): ?>
                                    <p
                                        class="sensor-operacao-item mb-1"
                                        data-trem="<?= (int) ($sensor['id_trem'] ?? 0) ?>"
                                        data-rota="<?= (int) ($sensor['id_rota'] ?? 0) ?>"
                                        hidden
                                    >
                                        <?= htmlspecialchars($sensor['nome'], ENT_QUOTES, 'UTF-8') ?>
                                        - <?= htmlspecialchars($sensor['tipo_dado'], ENT_QUOTES, 'UTF-8') ?>
                                    </p>
                                <?php endwhile; ?>
                            <?php endif; ?>

                            <p id="mensagemSensoresOperacao" class="text-muted mb-0" hidden>
                                Nenhum sensor vinculado ao trem ou à rota selecionados.
                            </p>
                        </div>
                    </div>

                    <button type="submit" class="btn botao-cadastrar w-100" id="botaoIniciarOperacaoModal">
                        Iniciar Operação
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modalIniciarOperacao');
    const formulario = document.getElementById('formularioIniciarOperacao');
    const trem = document.getElementById('tremOperacao');
    const rota = document.getElementById('rotaOperacao');
    const alerta = document.getElementById('alertaCamposOperacao');
    const inicioPrevisto = document.getElementById('inicioPrevistoOperacao');
    const sensores = document.querySelectorAll('.sensor-operacao-item');
    const mensagemSensores = document.getElementById('mensagemSensoresOperacao');

    function atualizarInicioPrevisto() {
        const agora = new Date();

        inicioPrevisto.textContent = agora.toLocaleDateString('pt-BR') +
            ' às ' +
            agora.toLocaleTimeString('pt-BR', {
                hour: '2-digit',
                minute: '2-digit'
            });
    }

    function atualizarSensores() {
        const idTrem = trem.value;
        const idRota = rota.value;
        let encontrouSensor = false;

        sensores.forEach(function (sensor) {
            const vinculadoAoTrem = sensor.dataset.trem === idTrem && idTrem !== '';
            const vinculadoARota = sensor.dataset.rota === idRota && idRota !== '';

            if (idTrem && idRota && (vinculadoAoTrem || vinculadoARota)) {
                sensor.hidden = false;
                encontrouSensor = true;
            } else {
                sensor.hidden = true;
            }
        });

        if (!idTrem || !idRota) {
            mensagemSensores.textContent = 'Selecione um trem e uma rota para visualizar os sensores vinculados.';
            mensagemSensores.hidden = false;
        } else {
            mensagemSensores.textContent = 'Nenhum sensor vinculado ao trem ou à rota selecionados.';
            mensagemSensores.hidden = encontrouSensor;
        }
    }

    modal.addEventListener('show.bs.modal', atualizarInicioPrevisto);

    formulario.addEventListener('submit', function (evento) {
        if (!trem.value || !rota.value) {
            evento.preventDefault();
            alerta.hidden = false;
        } else {
            alerta.hidden = true;
        }
    });

    trem.addEventListener('change', function () {
        alerta.hidden = true;
        atualizarSensores();
    });

    rota.addEventListener('change', function () {
        alerta.hidden = true;
        atualizarSensores();
    });
});
</script>
