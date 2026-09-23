<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../public/colaboradores.php');
    exit;
}

require_once __DIR__ . '/../../infra/conexao.php';

$idUsuario = $_POST['id_usuario'];

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$dataNascimento = $_POST['data_nascimento'];
$genero = $_POST['genero'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$cargo = $_POST['cargo'];
$cep = $_POST['cep'];

if ($senha === '') {

    $sql = "UPDATE usuario
        SET nome_usuario = ?,
            cpf = ?,
            data_nascimento = ?,
            genero = ?,
            telefone = ?,
            email = ?,
            cargo = ?,
            cep = ?
        WHERE id_usuario = ?";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssssi",
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
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "UPDATE usuario
        SET nome_usuario = ?,
            cpf = ?,
            data_nascimento = ?,
            genero = ?,
            telefone = ?,
            email = ?,
            senha = ?,
            cargo = ?,
            cep = ?
        WHERE id_usuario = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param(
        $stmt,
        "sssssssssi",
        $nome,
        $cpf,
        $dataNascimento,
        $genero,
        $telefone,
        $email,
        $senha,
        $cargo,
        $cep,
        $idUsuario
    );
}

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
$conexao->close();

header('Location: ../../public/colaboradores.php');
exit;