<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../public/colaboradores.php');
    exit;
}

require_once __DIR__ . '/../../infra/conexao.php';

$nome = trim($_POST['nome'] ?? '');
$cpf = trim($_POST['cpf'] ?? '');
$dataNascimento = trim($_POST['data_nascimento'] ?? '');
$genero = trim($_POST['genero'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';
$cargo = trim($_POST['cargo'] ?? '');
$cep = trim($_POST['cep'] ?? '');

$senha = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuario
    (nome_usuario, cpf, data_nascimento, genero, telefone, email, senha, cargo, cep)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "sssssssss",
    $nome,
    $cpf,
    $dataNascimento,
    $genero,
    $telefone,
    $email,
    $senha,
    $cargo,
    $cep
);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
$conexao->close();

header('Location: ../../public/colaboradores.php');
exit;