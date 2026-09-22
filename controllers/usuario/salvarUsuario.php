<?php
session_start();

function voltarParaColaboradores(): void
{
    header('Location: ../../public/colaboradores.php');
    exit;
}

function informarErro(string $mensagem): void
{
    $_SESSION['erro_colaborador'] = $mensagem;
    voltarParaColaboradores();
}

if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    voltarParaColaboradores();
}

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
$consulta = $conexao->prepare(
    'INSERT INTO usuario
        (nome_usuario, cpf, data_nascimento, genero, telefone, email, senha, cargo, cep)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)'
);

if ($consulta === false) {
    informarErro('Não foi possível preparar o cadastro.');
}

$consulta->bind_param(
    'sssssssss',
    $nome,
    $cpf,
    $dataNascimento,
    $genero,
    $telefone,
    $email,
    $senhaHash,
    $cargo,
    $cep
);

if (!$consulta->execute()) {
    if ($consulta->errno === 1062) {
        informarErro('O CPF ou e-mail informado já está cadastrado.');
    }

    $consulta->close();
    $conexao->close();
    informarErro('Não foi possível cadastrar o colaborador.');
}

$consulta->close();
$conexao->close();
voltarParaColaboradores();
