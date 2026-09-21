<div class="modal fade modal-top" id="modalSair" tabindex="-1" aria-labelledby="modalSairLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="modalSairLabel">Sair do ferrorama</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body">
                <p>Tem certeza que deseja sair da sua conta?</p>

                <form action="../controllers/logout.php" method="POST" class="d-flex gap-2">
                    <button type="button" class="btn botao-branco w-50" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn botao-cadastrar w-50">
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
