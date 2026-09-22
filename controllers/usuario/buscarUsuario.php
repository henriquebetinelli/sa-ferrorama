<?php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../infra/conexao.php';

$idUsuario = (int) ($_GET['id'] ?? 0);

$consulta = $conexao->prepare(
    'SELECT id_usuario, nome_usuario, cpf, data_nascimento, genero, telefone, email, cargo, cep
     FROM usuario
     WHERE id_usuario = ?'
);
$consulta->bind_param('i', $idUsuario);
$consulta->execute();

$resultado = $consulta->get_result();
$colaborador = $resultado->fetch_assoc();

$consulta->close();
$conexao->close();

echo json_encode($colaborador ?: [], JSON_UNESCAPED_UNICODE);
