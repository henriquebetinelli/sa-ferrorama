<section class="sidebar-app">
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
</section>