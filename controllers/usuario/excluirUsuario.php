<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../public/colaboradores.php');
    exit;
}

$idUsuario = (int) ($_POST['id_usuario'] ?? 0);

require_once __DIR__ . '/../../infra/conexao.php';

$exclusao = $conexao->prepare('DELETE FROM usuario WHERE id_usuario = ?');
$exclusao->bind_param('i', $idUsuario);
$exclusao->execute();

$exclusao->close();
$conexao->close();

header('Location: ../../public/colaboradores.php');
exit;
