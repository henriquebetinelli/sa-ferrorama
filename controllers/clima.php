<?php

function listarCidadesClima(): array
{
    return [
        'Joinville' => '455873',
        'Florianópolis' => '90200648',
        'Blumenau' => '455846',
        'São José' => '450398',
        'Chapecó' => '455854',
        'Itajaí' => '455870',
        'Criciúma' => '455856',
        'Jaraguá do Sul' => '456283',
        'Lages' => '455877',
        'Balneário Camboriú' => '12581617',
        'Palhoça' => '460341',
        'Brusque' => '456095',
        'Tubarão' => '456001',
        'São Bento do Sul' => '458028',
        'Rio do Sul' => '457944',
    ];
}

if (basename($_SERVER['SCRIPT_FILENAME'] ?? '') === 'clima.php') {

    header('Content-Type: application/json; charset=utf-8');

    $cidades = listarCidadesClima();
    $cidade = $_GET['cidade'] ?? 'Joinville';

    if (!isset($cidades[$cidade])) {
        http_response_code(400);
        echo json_encode(['erro' => 'Cidade inválida.']);
        exit;
    }

    $woeid = $cidades[$cidade];

    $url = "https://api.hgbrasil.com/weather?woeid=$woeid";

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);

    $resposta = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    if ($resposta === false || $status !== 200) {
        http_response_code(502);
        echo json_encode(['erro' => 'Não foi possível consultar o clima.']);
        exit;
    }

    $dados = json_decode($resposta, true);

    if (!isset($dados['results']['temp'], $dados['results']['description'])) {
        http_response_code(502);
        echo json_encode(['erro' => 'Dados do clima indisponíveis.']);
        exit;
    }

    echo json_encode([
        'cidade' => $dados['results']['city'],
        'temperatura' => $dados['results']['temp'],
        'clima' => $dados['results']['description']
    ], JSON_UNESCAPED_UNICODE);

    exit;
}