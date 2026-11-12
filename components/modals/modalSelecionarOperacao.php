
<div class="modal fade" id="modalSelecionarOperacao" tabindex="-1" aria-labelledby="modalSelecionarOperacaoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="modalSelecionarOperacaoLabel">
                    Selecionar operação
                </h1>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body">

                <form method="GET" action="monitoramento.php">

                    <?php if ($listaOperacoes && $listaOperacoes->num_rows > 0): ?>

                        <p>Escolha uma das operações disponíveis:</p>

                        <?php while ($operacao = $listaOperacoes->fetch_assoc()): ?>

                            <div class="form-check mb-3">
                                <input
                                    type="radio"
                                    class="form-check-input"
                                    name="id_operacao"
                                    id="operacao<?= (int) $operacao['id_operacao'] ?>"
                                    value="<?= (int) $operacao['id_operacao'] ?>"
                                    <?= isset($operacaoSelecionada['id_operacao']) && $operacaoSelecionada['id_operacao'] == $operacao['id_operacao'] ? 'checked' : '' ?>
                                    required
                                >

                                <label class="form-check-label" for="operacao<?= (int) $operacao['id_operacao'] ?>">
                                    <strong>Operação #<?= (int) $operacao['id_operacao'] ?></strong><br>
                                    Trem: <?= htmlspecialchars($operacao['nome_trem'], ENT_QUOTES, 'UTF-8') ?><br>
                                    Rota: <?= htmlspecialchars($operacao['nome_rota'], ENT_QUOTES, 'UTF-8') ?><br>
                                    <small class="text-muted">
                                        Status: <?= htmlspecialchars($operacao['status'], ENT_QUOTES, 'UTF-8') ?>
                                    </small>
                                </label>
                            </div>

                        <?php endwhile; ?>

                        <div class="d-flex gap-2 mt-4">
                            <button type="button" class="btn botao-branco w-50" data-bs-dismiss="modal">
                                Cancelar
                            </button>

                            <button type="submit" class="btn w-50" style="background-color: #173B65; color: white; border: none;">
                                Selecionar
                            </button>
                        </div>

                    <?php else: ?>

                        <p class="text-center my-3">
                            Nenhuma operação disponível no momento.
                        </p>

                    <?php endif; ?>

                </form>

            </div>
        </div>
    </div>
</div>

