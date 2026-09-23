<?php
session_start();
function informarErro(string $mensagem): void
{
    $_SESSION['erro_colaborador'] = $mensagem;
    header('Location: ../../public/colaboradores.php');
    exit;
}

if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../public/colaboradores.php');
    exit;
}

$idUsuario = (int) ($_POST['id_usuario'] ?? 0);
if ($idUsuario === (int) $_SESSION['usuario_id']) {
    informarErro('Você não pode excluir a sua própria conta.');
}

require_once __DIR__ . '/../../infra/conexao.php';

$sql = "DELETE FROM usuario WHERE id_usuario = ?";

$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $idUsuario );
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
$conexao->close();

header('Location: ../../public/colaboradores.php');
exit;