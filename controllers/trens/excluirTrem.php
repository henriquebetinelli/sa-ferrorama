<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../public/trens.php');
    exit;
}

require_once __DIR__ . '/../../infra/conexao.php';

$idTrem = (int) ($_POST['id_trem'] ?? 0);

if ($idTrem <= 0) {
    header('Location: ../../public/trens.php');
    exit;
}

$exclusao = $conexao->prepare('DELETE FROM trem WHERE id_trem = ?');
$exclusao->bind_param('i', $idTrem);
$exclusao->execute();

$exclusao->close();
$conexao->close();

header('Location: ../../public/trens.php');
exit;