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
$nome = trim($_POST['nome'] ?? '');
$cpf = trim($_POST['cpf'] ?? '');
$dataNascimento = trim($_POST['data_nascimento'] ?? '');
$genero = trim($_POST['genero'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';
$cargo = trim($_POST['cargo'] ?? '');
$cep = trim($_POST['cep'] ?? '');

require_once __DIR__ . '/../../infra/conexao.php';

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

if ($senha === '') {
    $atualizacao = $conexao->prepare(
        'UPDATE usuario
         SET nome_usuario = ?, cpf = ?, data_nascimento = ?, genero = ?, telefone = ?,
             email = ?, cargo = ?, cep = ?
         WHERE id_usuario = ?'
    );
    $atualizacao->bind_param(
        'ssssssssi',
        $nome,
        $cpf,
        $dataNascimento,
        $genero,
        $telefone,
        $email,
        $cargo,
        $cep,
        $idUsuario
    );
} else {
    $atualizacao = $conexao->prepare(
        'UPDATE usuario
         SET nome_usuario = ?, cpf = ?, data_nascimento = ?, genero = ?, telefone = ?,
             email = ?, senha = ?, cargo = ?, cep = ?
         WHERE id_usuario = ?'
    );
    $atualizacao->bind_param(
        'sssssssssi',
        $nome,
        $cpf,
        $dataNascimento,
        $genero,
        $telefone,
        $email,
        $senhaHash,
        $cargo,
        $cep,
        $idUsuario
    );
}
$atualizacao->execute();

$atualizacao->close();
$conexao->close();
voltarParaColaboradores();
