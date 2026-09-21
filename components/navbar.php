<nav class="nav d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
        <img src="../assets/img/logo/logo_clara.png" alt="Logo Click Rails" class="logo-navbar">
        <p><strong>Click Rails</strong></p>
    </div>
    <div class="navbar-acoes d-flex align-items-center">
        <div class="navbar-perfil d-flex align-items-center">
            <div class="navbar-dados-usuario">
                <p class="mb-1 fw-bold"><?= htmlspecialchars($_SESSION['usuario_nome']) ?></p>
                <p class="small mb-0"><?= htmlspecialchars($_SESSION['usuario_cargo']) ?></p>
            </div>
            <span class="icone-usuario" aria-hidden="true">
                <i class="bi bi-person-fill"></i>
            </span>
        </div>
        <span class="navbar-divisor" aria-hidden="true"></span>
        <button type="button" class="btn botao-navbar fw-bold" data-bs-toggle="modal" data-bs-target="#modalSair">Sair</button>
    </div>
</nav>

<?php require_once __DIR__ . '/modals/modalSair.php'; ?>