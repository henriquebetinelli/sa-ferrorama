<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/style/global.css">
    <link rel="stylesheet" href="assets/style/paginas/index.css">
    <title>Click Rails</title>
</head>

<body>
    <header>
        <nav class="nav d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="assets/img/logo/logo_clara.png" alt="Logo Click Rails" class="logo-navbar">
                <p class="mt-3 ms-2"><strong>Click Rails</strong></p>
            </div>
            <a href="public/login.php" class="btn botao-navbar fw-bold">Entrar</a>
        </nav>

        <section class="section-contexto">
            <img src="assets/img/reutilizaveis/trem_estacao.png" alt="Estação ferroviária" class="contexto-img" />
            <div class="contexto-text">
                <h1><strong>Monitoramento ferroviário em tempo real</strong></h1>
                <p>Acompanhe velocidade, localização e consumo de energia dos trens de forma simples e precisa.</p>
            </div>
        </section>
    </header>
    <main class="landing-white">
        <section class="landing-info">
            <div class="landing-copy">
                <div class="linha-preta"></div>
                <h2>Tecnologia a serviço da <strong>operação ferroviária.</strong></h2>
                <p>
                    Uma plataforma completa para monitorar, analisar<br>
                    e acompanhar o desempenho dos trens.
                </p>
                <button class="btn botao-azul-escuro mt-4" onclick="window.location.href='public/login.php'">
                    Acessar o sistema →
                </button>
            </div>
        </section>

        <section>
            <div class="cards-grid">
                <article class="feature-card">
                    <i class="bi bi-bar-chart-fill"></i>
                    <h3>Monitoramento</h3>
                    <p>Acompanhamento<br>em tempo real.</p>
                </article>

                <article class="feature-card">
                    <i class="bi bi-broadcast icone-home"></i>
                    <h3>Sensores</h3>
                    <p>Coleta de dados<br>operacionais.</p>
                </article>

                <article class="feature-card">
                    <i class="bi bi-clipboard2"></i>
                    <h3>Dados</h3>
                    <p>Visualização<br>organizada.</p>
                </article>
            </div>
        </section>

        <div class="tags-row">
            <span>EFICIÊNCIA</span>
            <span>SEGURANÇA</span>
            <span>CONTROLE</span>
        </div>
    </main>
    
</body>
</html>