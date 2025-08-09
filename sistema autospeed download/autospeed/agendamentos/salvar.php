<?php
include '../config/db.php';

$orcamento_id = $_POST['orcamento_id'];
$data_agendada = $_POST['data_agendada'];
$hora = $_POST['hora'];
$status = $_POST['status'];

// Verifica se é edição (se veio o ID)
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "UPDATE agendamentos SET 
                orcamento_id = '$orcamento_id', 
                data_agendada = '$data_agendada', 
                hora = '$hora',
                status = '$status' 
            WHERE id = $id";
} else {
    $sql = "INSERT INTO agendamentos (orcamento_id, data_agendada, hora, status) 
            VALUES ('$orcamento_id', '$data_agendada', '$hora', '$status')";
}

// Executa a query
if (mysqli_query($conn, $sql)) {
    header("Location: index.php?msg=ok");
} else {
    echo "Erro ao salvar: " . mysqli_error($conn);
}
