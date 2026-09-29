<?php
require_once __DIR__ . '/../infra/conexao.php';

function listarTrens($conexao) {
    $sql = 'SELECT id_trem, nome, modelo, status
        FROM trem
        ORDER BY nome ASC';
    return $conexao->query($sql);
}

function temTrensCadastrados($conexao) {
    return listarTrens($conexao)->num_rows > 0;
}

function cadastrarTrem($conexao, $nome, $modelo){
    $sql = "INSERT INTO trem (nome, modelo)
        VALUES (?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param( $stmt, "ss", $nome, $modelo );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


function atualizarTrem($conexao, $idTrem, $nome, $modelo) {
    $sql = "UPDATE trem
        SET nome = ?, modelo = ?
        WHERE id_trem = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $nome, $modelo, $idTrem);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function excluirTrem($conexao, $idTrem) {
    $sql = "DELETE FROM trem
        WHERE id_trem = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idTrem);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    if ($acao === 'cadastrar') {
        $nome = trim($_POST['nome'] ?? '');
        $modelo = trim($_POST['modelo'] ?? '');

        if ($nome !== '' && $modelo !== '') {
            cadastrarTrem($conexao, $nome, $modelo);
        }
    }

    if ($acao === 'editar') {
        $idTrem = ($_POST['id_trem'] ?? 0);
        $nome = trim($_POST['nome'] ?? '');
        $modelo = trim($_POST['modelo'] ?? '');

        if ($idTrem > 0 && $nome !== '' && $modelo !== '') {
            atualizarTrem($conexao, $idTrem, $nome, $modelo);
        }
    }

    if ($acao === 'excluir') {
        $idTrem = ($_POST['id_trem'] ?? 0);

        if ($idTrem > 0) {
            excluirTrem($conexao, $idTrem);
        }
    }

    $conexao->close();
    header('Location: ../public/trens.php');
    exit;
}