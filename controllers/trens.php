<?php
require_once __DIR__ . '/../infra/conexao.php';

function listarTrens($conexao) {
    $sql = "SELECT trem.id_trem, trem.nome, trem.modelo,
            trem.status, trem.id_operador, usuario.nome_usuario
        FROM trem
        LEFT JOIN usuario 
            ON trem.id_operador = usuario.id_usuario
        ORDER BY trem.nome ASC";

    return $conexao->query($sql);
}


function buscarTremPorId($conexao, $idTrem) {
    $sql = "SELECT id_trem, nome, modelo, status, id_operador
        FROM trem
        WHERE id_trem = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idTrem);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
    $trem = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($stmt);

    return $trem;
}

function contarTrens($conexao){
    $sql = "SELECT COUNT(*) AS total FROM trem";
    $resultado = $conexao->query($sql);

    if (!$resultado) {
        return 0;
    }

    $dados = $resultado->fetch_assoc();
    return (int) ($dados['total'] ?? 0);
}

function temTrensCadastrados($conexao) {
    return listarTrens($conexao)->num_rows > 0;
}

function cadastrarTrem($conexao, $nome, $modelo, $idOperador) {
    $sql = "INSERT INTO trem (nome, modelo, id_operador)
        VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $nome, $modelo, $idOperador);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


function atualizarTrem($conexao, $idTrem, $nome, $modelo, $idOperador) {
    $sql = "UPDATE trem
        SET nome = ?, modelo = ?, id_operador = ?
        WHERE id_trem = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssii", $nome, $modelo, $idOperador, $idTrem);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function tremTemSensores($conexao, $idTrem) {
    $sql = "SELECT id_sensor 
        FROM sensor 
        WHERE id_trem = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idTrem);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
    $temSensores = $resultado->num_rows > 0;
    mysqli_stmt_close($stmt);

    return $temSensores;
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
        $idOperador = $_POST['id_operador'] ?? $_POST['id_colaborador'] ?? $_POST['id_usuario'] ?? null;

        if ($nome !== '' && $modelo !== '') {
            cadastrarTrem($conexao, $nome, $modelo, $idOperador);
        }
    }
 
    if ($acao === 'editar') {
        $idTrem = ($_POST['id_trem'] ?? 0);
        $nome = trim($_POST['nome'] ?? '');
        $modelo = trim($_POST['modelo'] ?? '');
        $idOperador = $_POST['id_operador'] ?? $_POST['id_colaborador'] ?? $_POST['id_usuario'] ?? null;

        if ($idTrem > 0 && $nome !== '' && $modelo !== '') {
            atualizarTrem($conexao, $idTrem, $nome, $modelo, $idOperador);
        }
    }

    if ($acao === 'excluir') {
        $idTrem = ($_POST['id_trem'] ?? 0);
        session_start();

        if ($idTrem > 0) {
            if (tremTemSensores($conexao, $idTrem)) {
                $_SESSION['erro_trem'] = 'Não é possível excluir este trem, pois existem sensores vinculados a ele.';
            } else {
                excluirTrem($conexao, $idTrem);
            }
        }
    }

    $conexao->close();
    header('Location: ../public/trens.php');
    exit;
}