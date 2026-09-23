<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../public/trens.php');
    exit;
}

require_once __DIR__ . '/../../infra/conexao.php';

$nome = trim($_POST['nome'] ?? '');
$modelo = trim($_POST['modelo'] ?? '');

if ($nome === '' || $modelo === '') {
    header('Location: ../../public/trens.php');
    exit;
}

$sql = "INSERT INTO trem (nome, modelo)
    VALUES (?, ?)";

$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param(
    $stmt,
    "ss",
    $nome,
    $modelo
);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
$conexao->close();

header('Location: ../../public/trens.php');
exit;