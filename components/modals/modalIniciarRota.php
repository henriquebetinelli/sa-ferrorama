<?php
require_once __DIR__ . '/../../controllers/trens.php';
require_once __DIR__ . '/../../controllers/rotas.php';

if (!isset($conexao)) {
    require_once __DIR__ . '/../../infra/conexao.php';
}

$trensDisponiveis = listarTrens($conexao);
$rotasDisponiveis = listarRotas($conexao);
?>

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
                            Selecione um trem e uma rota antes de iniciar.
                        </div>

                        <label for="tremRota" class="form-label">Trem</label>
                        <select class="form-control" id="tremRota" name="trem" required>
                            <option value=""></option>
                            <?php if ($trensDisponiveis && $trensDisponiveis->num_rows > 0): ?>
                                <?php while ($trem = $trensDisponiveis->fetch_assoc()): ?>
                                    <option value="<?= htmlspecialchars((string) $trem['id_trem'], ENT_QUOTES, 'UTF-8') ?>">
                                        <?= htmlspecialchars((string) $trem['nome'], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <option value="" disabled>Nenhum trem cadastrado</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="rotaTrem" class="form-label">Rota</label>
                        <select class="form-control" id="rotaTrem" name="rota" required>
                            <option value=""></option>
                            <?php if ($rotasDisponiveis && $rotasDisponiveis->num_rows > 0): ?>
                                <?php while ($rota = $rotasDisponiveis->fetch_assoc()): ?>
                                    <option value="<?= htmlspecialchars((string) $rota['id_rota'], ENT_QUOTES, 'UTF-8') ?>">
                                        <?= htmlspecialchars((string) $rota['nome'], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <option value="" disabled>Nenhuma rota cadastrada</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <hr>

                    <div class="container-inicio-previsto-rota">
                        <span class="label-inicio-previsto-rota">Inicio previsto</span>
                        <span id="inicioPrevistoRota" class="valor-inicio-previsto-rota"></span>
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
