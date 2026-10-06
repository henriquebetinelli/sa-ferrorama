<?php
require_once __DIR__ . '/../infra/conexao.php';

<<<<<<< HEAD
function listarRotas($conexao) {
    $sql = 'SELECT id_rota, nome_rota, codigo_rota, descricao_rota
        FROM rota
        ORDER BY nome_rota ASC';
=======
function listarRotas($conexao)
{
    $sql = "SELECT id_rota, nome, descricao, criada_em
            FROM rota
            ORDER BY nome ASC";
>>>>>>> b0328834feb61a72140cf8a64413758127e4190c

    return $conexao->query($sql);
}

<<<<<<< HEAD
function temRotasCadastradas($conexao) {
    return listarRotas($conexao)->num_rows > 0;
}

function cadastrarRota($conexao, $nome, $codigo, $descricao) {
    $sql = "INSERT INTO rota (nome_rota, codigo_rota, descricao_rota)
        VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $nome, $codigo, $descricao);
=======
function cadastrarRota($conexao, $nome, $descricao)
{
    $sql = "INSERT INTO rota (nome, descricao)
            VALUES (?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $nome, $descricao);
>>>>>>> b0328834feb61a72140cf8a64413758127e4190c
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

<<<<<<< HEAD
function atualizarRota($conexao, $idRota, $nome, $codigo, $descricao) {
    $sql = "UPDATE rota
        SET nome_rota = ?, codigo_rota = ?, descricao_rota = ?
        WHERE id_rota = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $nome, $codigo, $descricao, $idRota);
=======
function atualizarRota($conexao, $idRota, $nome, $descricao)
{
    $sql = "UPDATE rota
            SET nome = ?, descricao = ?
            WHERE id_rota = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $nome, $descricao, $idRota);
>>>>>>> b0328834feb61a72140cf8a64413758127e4190c
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

<<<<<<< HEAD
function excluirRota($conexao, $idRota) {
    $sql = "DELETE FROM rota
        WHERE id_rota = ?";
=======
function excluirRota($conexao, $idRota)
{
    $sql = "DELETE FROM rota
            WHERE id_rota = ?";
>>>>>>> b0328834feb61a72140cf8a64413758127e4190c

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idRota);
    mysqli_stmt_execute($stmt);
<<<<<<< HEAD
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
=======

    $sucesso = mysqli_stmt_affected_rows($stmt) > 0;

    mysqli_stmt_close($stmt);

    return $sucesso;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $acao = $_POST['acao'] ?? '';

    if ($acao === 'cadastrar') {

        $nome = trim($_POST['nome'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');

        if ($nome !== '') {
            cadastrarRota($conexao, $nome, $descricao);
>>>>>>> b0328834feb61a72140cf8a64413758127e4190c
        }
    }

    if ($acao === 'editar') {
<<<<<<< HEAD
        $idRota = $_POST['id_rota'] ?? 0;
        $nome = trim($_POST['nome'] ?? '');
        $codigo = trim($_POST['codigo'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');

        if ($idRota > 0 && $nome !== '' && $codigo !== '' && $descricao !== '') {
            atualizarRota($conexao, $idRota, $nome, $codigo, $descricao);
=======

        $idRota = (int) ($_POST['id_rota'] ?? 0);
        $nome = trim($_POST['nome'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');

        if ($idRota > 0 && $nome !== '') {
            atualizarRota($conexao, $idRota, $nome, $descricao);
>>>>>>> b0328834feb61a72140cf8a64413758127e4190c
        }
    }

    if ($acao === 'excluir') {
<<<<<<< HEAD
        $idRota = $_POST['id_rota'] ?? 0;

        if ($idRota > 0) {
            excluirRota($conexao, $idRota);
=======

        $idRota = (int) ($_POST['id_rota'] ?? 0);

        if ($idRota > 0) {

            $sql = "SELECT COUNT(*) AS total
                    FROM operacao
                    WHERE id_rota = ?";

            $stmt = mysqli_prepare($conexao, $sql);
            mysqli_stmt_bind_param($stmt, "i", $idRota);
            mysqli_stmt_execute($stmt);

            $resultado = mysqli_stmt_get_result($stmt);
            $dados = mysqli_fetch_assoc($resultado);

            mysqli_stmt_close($stmt);

            if ($dados['total'] > 0) {

                session_start();

                $_SESSION['erro_rota'] =
                    'Não é possível excluir esta rota porque ela está vinculada a uma operação.';

            } else {
                excluirRota($conexao, $idRota);
            }
>>>>>>> b0328834feb61a72140cf8a64413758127e4190c
        }
    }

    $conexao->close();

    header('Location: ../public/rotas.php');
    exit;
}