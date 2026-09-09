<?php
session_start();
require_once __DIR__ . '/../infra/conexao.php';

if (isset($_SESSION['usuario_id'])) {
    header('Location: tela-home.html');
    exit();
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($email === '' || $senha === '') {
        $erro = 'Preencha o e-mail e a senha.';
    } else {
        $sql = 'SELECT id_usuario, nome_usuario, email, senha FROM usuario WHERE email = ? LIMIT 1';
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado && $resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();

            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['usuario_nome'] = $usuario['nome_usuario'];
                $_SESSION['usuario_email'] = $usuario['email'];

                header('Location: tela-home.html');
                exit();
            }
        }

        $erro = 'E-mail ou senha inválidos.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
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

                <?php
                    if (!empty($erro)) {
                        echo '<div class="alerta-erro">' . $erro . '</div>';
                    }
                ?>

                <div class="mensagem-login">
                    <h1><strong>Bem-Vindo!</strong></h1>
                    <p>Faça login para continuar.</p>
                </div>
                <hr>

                <form method="POST" class="login-formulario">
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