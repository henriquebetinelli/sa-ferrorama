<?php
session_start();

function informarErro(string $mensagem): void
{
    $_SESSION['erro_relatorio'] = $mensagem;
    header('Location: ../../public/relatorios.php');
    exit;
}

if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../public/relatorios.php');
    exit;
}

$tipo = trim($_POST['relatorio'] ?? '');
$trem = trim($_POST['trem'] ?? '');
$usuarioResponsavel = trim($_POST['usuario'] ?? '');
$operacao = trim($_POST['operacao'] ?? '');

if ($tipo === '' || $trem === '' || $usuarioResponsavel === '' || $operacao === '') {
    informarErro('Preencha todos os campos do relatório.');
}

require_once __DIR__ . '/../../infra/conexao.php';

$insercao = $conexao->prepare(
    'INSERT INTO relatorio (titulo, tipo, periodo_inicio, periodo_fim, conteudo_json, id_usuario, id_trem)
     VALUES (?, ?, NULL, NULL, ?, ?, ?)'
);

if ($insercao === false) {
    informarErro('Não foi possível preparar a geração do relatório.');
}

$titulo = $tipo . ' - ' . $operacao;
$conteudo = json_encode(['trem' => $trem, 'operacao' => $operacao], JSON_UNESCAPED_UNICODE);
$idUsuario = (int) $usuarioResponsavel;
$idTrem = (int) $trem;

$insercao->bind_param('sssii', $titulo, $tipo, $conteudo, $idUsuario, $idTrem);

try {
    $insercao->execute();
} catch (mysqli_sql_exception $e) {
    $insercao->close();
    $conexao->close();
    informarErro('Não foi possível gerar o relatório.');
}

$insercao->close();
$conexao->close();
header('Location: ../../public/relatorios.php');
exit;
