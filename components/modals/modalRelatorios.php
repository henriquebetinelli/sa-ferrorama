<?php
require_once __DIR__ . '/../../infra/conexao.php';

$trens = $conexao->query('SELECT id_trem, nome FROM trem ORDER BY nome ASC');
$usuarios = $conexao->query('SELECT id_usuario, nome_usuario FROM usuario ORDER BY nome_usuario ASC');
$operacoes = $conexao->query("SELECT DISTINCT JSON_UNQUOTE(JSON_EXTRACT(conteudo_json, '$.operacao')) AS operacao FROM relatorio WHERE conteudo_json IS NOT NULL");
?>
                
<div class="modal fade" id="modalRelatorios" tabindex="-1" aria-labelledby="modalRelatoriosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-cadastro">
        <div class="modal-content conteudo-modal">

            <div class="modal-header">
                <h2 id="modalRelatoriosLabel" class="modal-title fs-4 fw-bold">Gerar Novo Relatório</h2>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body">
                <form id="formularioCadastro" method="POST" action="../controllers/relatorio/salvarRelatorio.php">

                    <div class="mb-3">
                        <label for="relatorio" class="form-label">Tipo de Relatório</label>
                        <select class="form-control" id="relatorio" name="relatorio" required>
                            <option value="">Selecione um tipo</option>
                            <option value="Operacional">Operacional</option>
                            <option value="Sensores">Sensores</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="trem" class="form-label">Trem</label>
                            <select class="form-control" id="trem" name="trem" required>
                                <option value="">Selecione um trem</option>
                                <?php if ($trens && $trens->num_rows > 0): ?>
                                    <?php while ($tr = $trens->fetch_assoc()): ?>
                                        <option value="<?= (int) $tr['id_trem'] ?>"><?= htmlspecialchars((string) $tr['nome'], ENT_QUOTES, 'UTF-8') ?></option>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="usuario" class="form-label">Usuário responsável </label>
                            <select class="form-control" id="usuario" name="usuario" required>
                                <option value="">Selecione um usuário</option>
                                <?php if ($usuarios && $usuarios->num_rows > 0): ?>
                                    <?php while ($u = $usuarios->fetch_assoc()): ?>
                                        <option value="<?= (int) $u['id_usuario'] ?>"><?= htmlspecialchars((string) $u['nome_usuario'], ENT_QUOTES, 'UTF-8') ?></option>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                     <div class="mb-3">
                        <label for="operacao" class="form-label">Operação</label>
                        <select class="form-control" id="operacao" name="operacao" required>
                            <option value="">Selecione uma operação</option>
                            <?php if ($operacoes && $operacoes->num_rows > 0): ?>
                                <?php while ($op = $operacoes->fetch_assoc()): ?>
                                    <?php if ($op['operacao'] !== null): ?>
                                        <option value="<?= htmlspecialchars((string) $op['operacao'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars((string) $op['operacao'], ENT_QUOTES, 'UTF-8') ?></option>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn botao-cadastrar w-100" id="botaoSalvarColaborador">
                        Gerar Relatório
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>