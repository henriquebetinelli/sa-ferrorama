<?php

require_once __DIR__ . '/../infra/conexao.php';


function listarSensores($conexao) {
    $sql = "SELECT id_sensor, nome, tipo_dado, localizacao
        FROM sensor
        ORDER BY nome ASC";

    return $conexao->query($sql);
}

function temSensoresCadastrados($conexao) {
    return listarSensores($conexao)->num_rows > 0;
}

function cadastrarSensor($conexao, $nome, $localizacao, $tipoDado, $descricao, $idTrem) {
    $sql = "INSERT INTO sensor
        (nome, localizacao, tipo_dado, descricao, id_trem)
        VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $nome, $localizacao, $tipoDado, $descricao, $idTrem);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function atualizarSensor($conexao, $idSensor, $nome, $localizacao, $tipoDado, $descricao, $idTrem) {
    $sql = "UPDATE sensor
        SET nome = ?,
            localizacao = ?,
            tipo_dado = ?,
            descricao = ?,
            id_trem = ?
        WHERE id_sensor = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssssii", $nome, $localizacao, $tipoDado, $descricao, $idTrem, $idSensor);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function excluirSensor($conexao, $idSensor) {
    $sql = "DELETE FROM sensor
        WHERE id_sensor = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idSensor);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    if ($acao === 'cadastrar') {
        $nome = trim($_POST['nome'] ?? '');
        $localizacao = trim($_POST['localizacao'] ?? '');
        $tipoDado = trim($_POST['tipo_dado'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');
        $idTrem = (int) ($_POST['id_trem'] ?? 0);

        if ($nome !== '' && $localizacao !== '' && $tipoDado !== '') {
            cadastrarSensor($conexao, $nome, $localizacao, $tipoDado, $descricao, $idTrem);
        }
    }

    if ($acao === 'editar') {
        $idSensor = ($_POST['id_sensor'] ?? 0);
        $nome = trim($_POST['nome'] ?? '');
        $localizacao = trim($_POST['localizacao'] ?? '');
        $tipoDado = trim($_POST['tipo_dado'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');
        $idTrem = ($_POST['id_trem'] ?? 0);

        if ($idSensor > 0 && $nome !== '' && $localizacao !== '' && $tipoDado !== '') {
            atualizarSensor($conexao, $idSensor, $nome, $localizacao, $tipoDado, $descricao, $idTrem);
        }
    }

    if ($acao === 'excluir') {
        $idSensor = ($_POST['id_sensor'] ?? 0);

        if ($idSensor > 0) {
            excluirSensor($conexao, $idSensor);
        }
    }

    $conexao->close();
    header('Location: ../public/sensores.php');
    exit;
}