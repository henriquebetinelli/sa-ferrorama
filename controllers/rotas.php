<?php
require_once __DIR__ . '/../infra/conexao.php';

function listarRotas($conexao) {
    $sql = 'SELECT id_rota, nome, descricao
        FROM rota
        ORDER BY nome ASC';

    return $conexao->query($sql);
}

function temRotasCadastradas($conexao) {
    return listarRotas($conexao)->num_rows > 0;
}

function cadastrarRota($conexao, $nome, $descricao) {
    $sql = "INSERT INTO rota (nome, descricao)
        VALUES (?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $nome, $descricao);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function atualizarRota($conexao, $idRota, $nome, $descricao) {
    $sql = "UPDATE rota
        SET nome = ?, descricao = ?
        WHERE id_rota = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $nome, $descricao, $idRota);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function excluirRota($conexao, $idRota) {
    $sql = "DELETE FROM rota
        WHERE id_rota = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idRota);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    if ($acao === 'cadastrar') {
        $nome = trim($_POST['nome'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');
        if ($nome !== '' && $descricao !== '') {
            cadastrarRota($conexao, $nome, $descricao);
        }
    }

    if ($acao === 'editar') {
        $idRota = $_POST['id_rota'] ?? 0;
        $nome = trim($_POST['nome'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');

        if ($idRota > 0 && $nome !== '' && $descricao !== '') {
            atualizarRota($conexao, $idRota, $nome, $descricao);
        }
    }

    if ($acao === 'excluir') {
        $idRota = $_POST['id_rota'] ?? 0;

        if ($idRota > 0) {
            excluirRota($conexao, $idRota);
        }
    }

    $conexao->close();

    header('Location: ../public/rotas.php');
    exit;
}