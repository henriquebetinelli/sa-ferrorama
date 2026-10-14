<section class="sidebar-app">
    <div class="d-flex align-items-center ms-3">
        <img src="../assets/img/logo/logo_clara.png" alt="Logo Click Rails" class="logo-navbar">
        <div>
            <p class="fw-bold fs-4 m-0">Click Rails</p>
            <p class="m-0">SA Ferrorama</p>
        </div>
    </div>

    <div class="nav-sidebar">
        <a href="home.php" class="link-sidebar <?= $paginaAtual == 'home' ? 'ativo' : '' ?>">
            <i class="bi bi-house-door-fill"></i>
            <span>Início</span>
        </a>

        <a href="monitoramento.php" class="link-sidebar <?= $paginaAtual == 'monitoramento' ? 'ativo' : '' ?>">
            <i class="bi bi-bar-chart-fill"></i>
            <span>Monitoramento</span>
        </a>

        <?php if ($_SESSION['usuario_cargo'] === 'Administrador'): ?>
            <a href="colaboradores.php" class="link-sidebar <?= $paginaAtual == 'colaboradores' ? 'ativo' : '' ?>">
                <i class="bi bi-person-fill"></i>
                <span>Colaboradores</span>
            </a>
        <?php endif; ?>

        <a href="sensores.php" class="link-sidebar <?= $paginaAtual == 'sensores' ? 'ativo' : '' ?>">
            <i class="bi bi-broadcast"></i>
            <span>Sensores</span>
        </a>

        <a href="trens.php" class="link-sidebar <?= $paginaAtual == 'trens' ? 'ativo' : '' ?>">
            <i class="bi bi-truck-front-fill"></i>
            <span>Trens</span>
        </a>

        <a href="rotas.php" class="link-sidebar <?= $paginaAtual == 'rotas' ? 'ativo' : '' ?>">
            <i class="bi bi-map-fill"></i>
            <span>Rotas</span>
        </a>

        <a href="relatorios.php" class="link-sidebar <?= $paginaAtual == 'relatorios' ? 'ativo' : '' ?>">
            <i class="bi bi-archive-fill"></i>
            <span>Relatórios</span>
        </a>
    </div>

    <div class="dropdown navbar-perfil">
        <button class="botao-perfil dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="icone-usuario" aria-hidden="true">
                <i class="bi bi-person-fill"></i>
            </span>

            <div class="navbar-dados-usuario">
                <p class="fw-bold"><?= htmlspecialchars($_SESSION['usuario_nome']) ?></p>
                <p class="small"><?= htmlspecialchars($_SESSION['usuario_cargo']) ?></p>
            </div>
        </button>
        
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalSair">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Sair
                </button>
            </li>
        </ul>
    </div>
</section>

<?php require_once __DIR__ . '/modals/modalSair.php'; ?>