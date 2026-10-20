<?php

require_once __DIR__ . '/../infra/conexao.php';


function listarSensores($conexao) {
    $sql = "SELECT id_sensor, nome, tipo_dado, localizacao, descricao, limite, id_trem, id_rota
        FROM sensor
        ORDER BY nome ASC";

    return $conexao->query($sql);
}

function temSensoresCadastrados($conexao) {
    return listarSensores($conexao)->num_rows > 0;
}

function cadastrarSensor($conexao, $nome, $localizacao, $tipoDado, $descricao, $limite, $idTrem, $idRota = null) {
    if ($localizacao === 'vagao' || $localizacao === 'rota') {
        $sql = "INSERT INTO sensor
            (nome, localizacao, tipo_dado, descricao, limite, id_trem, id_rota)
            VALUES (?, ?, ?, ?, ?, NULL, ?)";

        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "ssssdi", $nome, $localizacao, $tipoDado, $descricao, $limite, $idRota);
    } else {
        $sql = "INSERT INTO sensor
            (nome, localizacao, tipo_dado, descricao, limite, id_trem, id_rota)
            VALUES (?, ?, ?, ?, ?, ?, NULL)";

        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "ssssdi", $nome, $localizacao, $tipoDado, $descricao, $limite, $idTrem);
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function atualizarSensor($conexao, $idSensor, $nome, $localizacao, $tipoDado, $descricao, $limite, $idTrem, $idRota = null) {
    if ($localizacao === 'vagao' || $localizacao === 'rota') {
        $sql = "UPDATE sensor
            SET nome = ?,
                localizacao = ?,
                tipo_dado = ?,
                descricao = ?,
                limite = ?,
                id_trem = NULL,
                id_rota = ?
            WHERE id_sensor = ?";

        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "ssssdii", $nome, $localizacao, $tipoDado, $descricao, $limite, $idRota, $idSensor);
    } else {
        $sql = "UPDATE sensor
            SET nome = ?,
                localizacao = ?,
                tipo_dado = ?,
                descricao = ?,
                limite = ?,
                id_trem = ?,
                id_rota = NULL
            WHERE id_sensor = ?";

        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "ssssdii", $nome, $localizacao, $tipoDado, $descricao, $limite, $idTrem, $idSensor);
    }

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
        $limite = isset($_POST['limiteSensor']) && $_POST['limiteSensor'] !== '' ? (float) $_POST['limiteSensor'] : null;
        $idTrem = (int) ($_POST['id_trem'] ?? 0);
        $idRota = (int) ($_POST['id_rota'] ?? 0);

        if ($nome !== '' && $localizacao !== '' && $tipoDado !== '') {
            $ehRota = in_array($localizacao, ['vagao', 'rota'], true);
            $idAnexoValido = $ehRota ? $idRota > 0 : $idTrem > 0;

            if ($idAnexoValido) {
                cadastrarSensor($conexao, $nome, $localizacao, $tipoDado, $descricao, $limite, $idTrem, $idRota);
            }
        }
    }

    if ($acao === 'editar') {
        $idSensor = ($_POST['id_sensor'] ?? 0);
        $nome = trim($_POST['nome'] ?? '');
        $localizacao = trim($_POST['localizacao'] ?? '');
        $tipoDado = trim($_POST['tipo_dado'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');
        $limite = isset($_POST['limiteSensor']) && $_POST['limiteSensor'] !== '' ? (float) $_POST['limiteSensor'] : null;
        $idTrem = (int) ($_POST['id_trem'] ?? 0);
        $idRota = (int) ($_POST['id_rota'] ?? 0);

        if ($idSensor > 0 && $nome !== '' && $localizacao !== '' && $tipoDado !== '') {
            $ehRota = in_array($localizacao, ['vagao', 'rota'], true);
            $idAnexoValido = $ehRota ? $idRota > 0 : $idTrem > 0;

            if ($idAnexoValido) {
                atualizarSensor($conexao, $idSensor, $nome, $localizacao, $tipoDado, $descricao, $limite, $idTrem, $idRota);
            }
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