<?php
session_start();
require_once __DIR__ . '/../infra/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../public/login.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

if ($email === '' || $senha === '') {
    $_SESSION['erro_login'] = 'Preencha o e-mail e a senha.';

    header('Location: ../public/login.php');
    exit;
}

$sql = "SELECT id_usuario, nome_usuario, email, senha, cargo
    FROM usuario
    WHERE email = ?
    LIMIT 1";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

if ($usuario && password_verify($senha, $usuario['senha'])) {

    session_regenerate_id(true);

    $_SESSION['usuario_id'] = $usuario['id_usuario'];
    $_SESSION['usuario_nome'] = $usuario['nome_usuario'];
    $_SESSION['usuario_cargo'] = $usuario['cargo'];

    header('Location: ../public/home.php');
    exit;
}

$_SESSION['erro_login'] = 'E-mail ou senha incorretos.';

header('Location: ../public/login.php');
exit;