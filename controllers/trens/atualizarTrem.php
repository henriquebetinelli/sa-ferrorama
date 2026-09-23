<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../public/trens.php');
    exit;
}

require_once __DIR__ . '/../../infra/conexao.php';

$idTrem = (int) ($_POST['id_trem'] ?? 0);
$nome = trim($_POST['nome'] ?? '');
$modelo = trim($_POST['modelo'] ?? '');

if ($idTrem <= 0 || $nome === '' || $modelo === '') {
    header('Location: ../../public/trens.php');
    exit;
}

$sql = "UPDATE trem
    SET nome = ?,
        modelo = ?
    WHERE id_trem = ?";

$stmt = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ssi",
    $nome,
    $modelo,
    $idTrem
);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
$conexao->close();
header('Location: ../../public/trens.php');
exit;