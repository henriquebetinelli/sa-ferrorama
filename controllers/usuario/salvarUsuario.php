<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../public/colaboradores.php');
    exit;
}

require_once __DIR__ . '/../../infra/conexao.php';

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$dataNascimento = $_POST['data_nascimento'];
$genero = $_POST['genero'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$cargo = $_POST['cargo'];
$cep = $_POST['cep'];

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