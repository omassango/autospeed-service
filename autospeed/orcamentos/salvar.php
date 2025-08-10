<?php
include '../config/db.php';

if (isset($_POST['id'])) {
    // Atualizar
    $id = $_POST['id'];
    $sql = "UPDATE orcamentos SET 
                cliente_id = '$cliente_id',
                mecanico_id = '$mecanico_id',
                descricao_problema = '$descricao_problema',
                laudo_tecnico = '$laudo_tecnico',
                observacoes = '$observacoes',
                valor_total = '$valor_total',
                status = '{$_POST['status']}'
            WHERE id = $id";
} else {
    // Inserir novo (já está feito como antes)
    $sql = "INSERT INTO orcamentos (
                cliente_id, mecanico_id, descricao_problema, laudo_tecnico, observacoes, valor_total
            ) VALUES (
                '$cliente_id', '$mecanico_id', '$descricao_problema', '$laudo_tecnico', '$observacoes', '$valor_total'
            )";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente_id = $_POST['cliente_id'];
    $mecanico_id = $_POST['mecanico_id'];
    $descricao_problema = mysqli_real_escape_string($conn, $_POST['descricao_problema']);
    $laudo_tecnico = mysqli_real_escape_string($conn, $_POST['laudo_tecnico']);
    $observacoes = mysqli_real_escape_string($conn, $_POST['observacoes']);
    $valor_total = $_POST['valor_total'];

    $sql = "INSERT INTO orcamentos (
                cliente_id, mecanico_id, descricao_problema, laudo_tecnico, observacoes, valor_total
            ) VALUES (
                '$cliente_id', '$mecanico_id', '$descricao_problema', '$laudo_tecnico', '$observacoes', '$valor_total'
            )";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?msg=ok");
        exit;
    } else {
        echo "Erro ao salvar: " . mysqli_error($conn);
    }
} else {
    echo "Acesso inválido.";
}
