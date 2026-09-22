<?php
session_start();

function voltarParaColaboradores(): void
{
    header('Location: ../../public/colaboradores.php');
    exit;
}

if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    voltarParaColaboradores();
}

$idUsuario = (int) ($_POST['id_usuario'] ?? 0);

require_once __DIR__ . '/../../infra/conexao.php';

$exclusao = $conexao->prepare('DELETE FROM usuario WHERE id_usuario = ?');
$exclusao->bind_param('i', $idUsuario);
$exclusao->execute();

$exclusao->close();
$conexao->close();
voltarParaColaboradores();
