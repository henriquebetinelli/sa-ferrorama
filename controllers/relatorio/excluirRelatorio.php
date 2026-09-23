<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../public/relatorios.php');
    exit;
}

$cargo = $_SESSION['usuario_cargo'] ?? '';
if (mb_strtolower(trim($cargo)) !== mb_strtolower('Administrador')) {
    header('Location: ../../public/relatorios.php');
    exit;
}

$idRelatorio = (int) ($_POST['id_relatorio'] ?? 0);

require_once __DIR__ . '/../../infra/conexao.php';

$exclusao = $conexao->prepare('DELETE FROM relatorio WHERE id_relatorio = ?');
$exclusao->bind_param('i', $idRelatorio);
$exclusao->execute();

$exclusao->close();
$conexao->close();
header('Location: ../../public/relatorios.php');
exit;
