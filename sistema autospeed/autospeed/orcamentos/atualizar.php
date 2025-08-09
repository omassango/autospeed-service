<?php
include '../config/db.php';

// Verifica se os dados vieram por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $cliente_id = $_POST['cliente_id'];
    $mecanico_id = $_POST['mecanico_id'];
    $descricao_problema = mysqli_real_escape_string($conn, $_POST['descricao_problema']);
    $laudo_tecnico = mysqli_real_escape_string($conn, $_POST['laudo_tecnico']);
    $observacoes = mysqli_real_escape_string($conn, $_POST['observacoes']);
    $status = $_POST['status'];

    $sql = "UPDATE orcamentos SET 
                cliente_id = $cliente_id,
                mecanico_id = $mecanico_id,
                descricao_problema = '$descricao_problema',
                laudo_tecnico = '$laudo_tecnico',
                observacoes = '$observacoes',
                status = '$status'
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?msg=atualizado");
        exit;
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conn);
    }
} else {
    echo "Requisição inválida.";
}
