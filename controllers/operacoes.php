
<?php
require_once __DIR__ . '/../infra/conexao.php';

function listarOperacoes($conexao) {
    $sql = "SELECT
                o.id_operacao,
                o.id_trem,
                o.id_rota,
                o.inicio_em,
                o.fim_em,
                o.status,
                t.nome AS nome_trem,
                r.nome AS nome_rota
            FROM operacao o
            INNER JOIN trem t ON o.id_trem = t.id_trem
            INNER JOIN rota r ON o.id_rota = r.id_rota
            ORDER BY o.inicio_em DESC";

    return mysqli_query($conexao, $sql);
}


function iniciarOperacao($conexao, $idTrem, $idRota) {
    $sql = "INSERT INTO operacao (id_trem, id_rota, inicio_em, status)
            VALUES (?, ?, NOW(), 'em_operacao')";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "ii", $idTrem, $idRota);

    if (mysqli_stmt_execute($stmt)) {
        $idOperacao = mysqli_insert_id($conexao);
        mysqli_stmt_close($stmt);

        return $idOperacao;
    }

    mysqli_stmt_close($stmt);

    return false;
}


function buscarOperacaoPorId($conexao, $idOperacao) {
    $sql = "SELECT
                o.id_operacao,
                o.id_trem,
                o.id_rota,
                o.inicio_em,
                o.fim_em,
                o.status,
                t.nome AS nome_trem,
                r.nome AS nome_rota
            FROM operacao o
            INNER JOIN trem t ON o.id_trem = t.id_trem
            INNER JOIN rota r ON o.id_rota = r.id_rota
            WHERE o.id_operacao = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idOperacao);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
    $operacao = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($stmt);

    return $operacao;
}
