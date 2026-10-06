<?php
require_once __DIR__ . '/../infra/conexao.php';

function listarRotas($conexao) {
    $sql = 'SELECT id_rota, nome_rota, codigo_rota, descricao_rota
        FROM rota
        ORDER BY nome_rota ASC';

    return $conexao->query($sql);
}

function temRotasCadastradas($conexao) {
    return listarRotas($conexao)->num_rows > 0;
}

function cadastrarRota($conexao, $nome, $codigo, $descricao) {
    $sql = "INSERT INTO rota (nome_rota, codigo_rota, descricao_rota)
        VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $nome, $codigo, $descricao);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function atualizarRota($conexao, $idRota, $nome, $codigo, $descricao) {
    $sql = "UPDATE rota
        SET nome_rota = ?, codigo_rota = ?, descricao_rota = ?
        WHERE id_rota = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $nome, $codigo, $descricao, $idRota);
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
        $codigo = trim($_POST['codigo'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');

        if ($nome !== '' && $codigo !== '' && $descricao !== '') {
            cadastrarRota($conexao, $nome, $codigo, $descricao);
        }
    }

    if ($acao === 'editar') {
        $idRota = $_POST['id_rota'] ?? 0;
        $nome = trim($_POST['nome'] ?? '');
        $codigo = trim($_POST['codigo'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');

        if ($idRota > 0 && $nome !== '' && $codigo !== '' && $descricao !== '') {
            atualizarRota($conexao, $idRota, $nome, $codigo, $descricao);
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