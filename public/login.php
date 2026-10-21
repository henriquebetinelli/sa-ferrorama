<?php
session_start();
require_once __DIR__ . '/../infra/conexao.php';

if (isset($_SESSION['usuario_id'])) {
    header('Location: home.php');
    exit();
}

$erroLogin = $_SESSION['erro_login'] ?? '';
unset($_SESSION['erro_login']);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style/global.css">
    <link rel="stylesheet" href="../assets/style/paginas/login.css">
    <title>Login - Click Rails</title>
</head>
<body>
    <main class="login-wrapper">
        <div class="login-apresentacao">
            <h1><strong>Sua jornada começa aqui.</strong></h1>
            <p>Acompanhe velocidade, localização e consumo de energia dos trens de forma simples e precisa.</p>
        </div>

        <section class="login-card">
            <div class="login-area">
                <div class="login-logo-area">
                    <img src="../assets/img/logo/logo_clara.png" class="login-logo" alt="Logo Click Rails">
                    <h2>Click Rails</h2>
                </div>

                <?php if ($erroLogin): ?>
                    <div class="alerta-erro w-100" role="alert">
                        <?= htmlspecialchars($erroLogin) ?>
                    </div>
                <?php endif; ?>

                <div class="mensagem-login">
                    <h1><strong>Bem-Vindo!</strong></h1>
                    <p>Faça login para continuar.</p>
                </div>
                <hr>

                <form action="../controllers/login.php" method="POST" class="login-formulario">
                    <div class="login-campo">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email">
                    </div>

                    <div class="login-campo">
                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha">
                    </div>

                    <button type="submit" class="btn botao-azul-escuro w-100">Entrar</button>
                </form>

                <a href="../index.php" class="login-voltar">Voltar</a>
            </div>
        </section>
    </main>
</body>
</html>