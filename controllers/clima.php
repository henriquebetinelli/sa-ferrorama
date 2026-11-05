<?php

function listarCidadesClima() {
    return [
        'Joinville' => 'Joinville',
        'Florianópolis' => 'Florianópolis',
        'Blumenau' => 'Blumenau',
        'São José' => 'São José',
        'Chapecó' => 'Chapecó',
        'Itajaí' => 'Itajaí',
        'Criciúma' => 'Criciúma',
        'Jaraguá do Sul' => 'Jaraguá do Sul',
        'Lages' => 'Lages',
        'Balneário Camboriú' => 'Balneário Camboriú',
        'Palhoça' => 'Palhoça',
        'Brusque' => 'Brusque',
        'Tubarão' => 'Tubarão',
        'São Bento do Sul' => 'São Bento do Sul',
        'Rio do Sul' => 'Rio do Sul',
    ];
}

function consultarApiClima(string $url) {
    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);

    $resposta = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    if ($resposta === false || $status !== 200) {
        throw new Exception('Falha na consulta da API.');
    }

    $dados = json_decode($resposta, true);

    if (!is_array($dados)) {
        throw new Exception('Resposta inválida da API.');
    }

    return $dados;
}

function descreverClima(int $codigo) {
    $descricoes = [
        0 => 'Céu limpo',
        1 => 'Predominantemente limpo',
        2 => 'Parcialmente nublado',
        3 => 'Nublado',
        45 => 'Neblina',
        48 => 'Nevoeiro',
        51 => 'Garoa fraca',
        53 => 'Garoa moderada',
        55 => 'Garoa intensa',
        56 => 'Garoa congelante',
        57 => 'Garoa congelante intensa',
        61 => 'Chuva fraca',
        63 => 'Chuva moderada',
        65 => 'Chuva intensa',
        66 => 'Chuva congelante',
        67 => 'Chuva congelante intensa',
        71 => 'Neve fraca',
        73 => 'Neve moderada',
        75 => 'Neve intensa',
        77 => 'Granizo',
        80 => 'Pancadas de chuva fracas',
        81 => 'Pancadas de chuva moderadas',
        82 => 'Pancadas de chuva intensas',
        85 => 'Pancadas de neve',
        86 => 'Pancadas de neve intensas',
        95 => 'Tempestade',
        96 => 'Tempestade com granizo',
        99 => 'Tempestade intensa com granizo'
    ];

    return $descricoes[$codigo] ?? 'Condição climática indisponível';
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

    try {
        $urlLocalizacao = 'https://geocoding-api.open-meteo.com/v1/search?'
            . http_build_query([
                'name' => $cidade,
                'count' => 1,
                'language' => 'pt',
                'format' => 'json',
                'countryCode' => 'BR'
            ]);

        $localizacao = consultarApiClima($urlLocalizacao);

        if (empty($localizacao['results'][0])) {
            throw new Exception('Cidade não encontrada.');
        }

        $latitude = $localizacao['results'][0]['latitude'];
        $longitude = $localizacao['results'][0]['longitude'];

        $urlClima = 'https://api.open-meteo.com/v1/forecast?'
            . http_build_query([
                'latitude' => $latitude,
                'longitude' => $longitude,
                'current' => 'temperature_2m,weather_code',
                'timezone' => 'auto'
            ]);

        $dadosClima = consultarApiClima($urlClima);

        if (!isset(
            $dadosClima['current']['temperature_2m'],
            $dadosClima['current']['weather_code']
        )) {
            throw new Exception('Dados do clima indisponíveis.');
        }

        $codigo = (int) $dadosClima['current']['weather_code'];

        echo json_encode([
            'cidade' => $cidade,
            'temperatura' => round($dadosClima['current']['temperature_2m']),
            'clima' => descreverClima($codigo)
        ], JSON_UNESCAPED_UNICODE);

    } catch (Exception $erro) {
        http_response_code(502);
        echo json_encode([
            'erro' => $erro->getMessage()
        ], JSON_UNESCAPED_UNICODE);
    }
    exit;
}