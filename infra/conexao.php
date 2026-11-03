<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "sa_ferrorama";

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro ao conectar com o banco de dados.");
}

$conexao->set_charset("utf8");