<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "sa_ferrorama";

$mysqli_report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;
mysqli_report($mysqli_report_mode);

try {
    $conexao = new mysqli($host, $usuario, $senha, $banco);
    $conexao->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    $mensagem = "Não foi possível conectar ao banco de dados. Verifique se o MySQL (XAMPP) está em execução e se as credenciais em infra/conexao.php estão corretas.\nMensagem técnica: " . $e->getMessage();
    die($mensagem);
}