<?php
require_once __DIR__ . '/../infra/conexao.php';

function listarColaboradores($conexao){
    $sql = "SELECT id_usuario, nome_usuario, cpf, data_nascimento,
            genero, telefone, email, cargo, cep
        FROM usuario
        ORDER BY nome_usuario ASC";

    return $conexao->query($sql);
}

function contarColaboradores($conexao){
    $sql = "SELECT COUNT(*) AS total FROM usuario";
    $resultado = $conexao->query($sql);

    if (!$resultado) {
        return 0;
    }

    $dados = $resultado->fetch_assoc();
    return (int) ($dados['total'] ?? 0);
}

function cadastrarColaborador($conexao, $nome, $cpf, $dataNascimento, $genero, $telefone, $email, $senha, $cargo, $cep) {
    $senha = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuario
        (nome_usuario, cpf, data_nascimento, genero, telefone, email, senha, cargo, cep)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssss", $nome, $cpf, $dataNascimento, $genero, $telefone, $email, $senha, $cargo, $cep);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


function atualizarColaborador($conexao, $idUsuario, $nome, $cpf, $dataNascimento, $genero, $telefone, $email, $senha, $cargo, $cep) {
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
        mysqli_stmt_bind_param($stmt, "ssssssssi", $nome, $cpf, $dataNascimento, $genero, $telefone, $email, $cargo, $cep, $idUsuario);
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
        mysqli_stmt_bind_param($stmt, "sssssssssi", $nome, $cpf, $dataNascimento, $genero, $telefone, $email, $senha, $cargo, $cep, $idUsuario);
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


function excluirColaborador($conexao, $idUsuario)
{
    $sql = "DELETE FROM usuario
        WHERE id_usuario = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idUsuario);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    if ($acao === 'cadastrar') {
        $nome = trim($_POST['nome'] ?? '');
        $cpf = trim($_POST['cpf'] ?? '');
        $dataNascimento = trim($_POST['data_nascimento'] ?? '');
        $genero = trim($_POST['genero'] ?? '');
        $telefone = trim($_POST['telefone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';
        $cargo = trim($_POST['cargo'] ?? '');
        $cep = trim($_POST['cep'] ?? '');

        if ($nome !== '' && $cpf !== '' && $dataNascimento !== '' && $genero !== '' && $telefone !== '' && $email !== '' && $senha !== '' && $cargo !== '' && $cep !== '') {
            cadastrarColaborador($conexao, $nome, $cpf, $dataNascimento, $genero, $telefone, $email, $senha, $cargo, $cep);
        }
    }


    if ($acao === 'editar') {
        $idUsuario = ($_POST['id_usuario'] ?? 0);
        $nome = trim($_POST['nome'] ?? '');
        $cpf = trim($_POST['cpf'] ?? '');
        $dataNascimento = trim($_POST['data_nascimento'] ?? '');
        $genero = trim($_POST['genero'] ?? '');
        $telefone = trim($_POST['telefone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';
        $cargo = trim($_POST['cargo'] ?? '');
        $cep = trim($_POST['cep'] ?? '');

        if ($idUsuario > 0 && $nome !== '' && $cpf !== '' && $dataNascimento !== '' && $genero !== '' && $telefone !== '' && $email !== '' && $cargo !== '' && $cep !== '') {
            atualizarColaborador($conexao, $idUsuario, $nome, $cpf, $dataNascimento, $genero, $telefone, $email, $senha, $cargo, $cep);
        }
    }

    if ($acao === 'excluir') {
        $idUsuario = ($_POST['id_usuario'] ?? 0);

        session_start();
        if ($idUsuario == $_SESSION['usuario_id']) {
            $_SESSION['erro_colaborador'] = 'Você não pode excluir a sua própria conta.';
        } elseif ($idUsuario > 0) {
            excluirColaborador($conexao, $idUsuario);
        }
    }

    $conexao->close();
    header('Location: ../public/colaboradores.php');
    exit;
}