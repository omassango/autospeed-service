<?php
include '../config/db.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$especialidade = $_POST['especialidade'];
$status = $_POST['status'];

if (empty($id)) {
    $sql = "INSERT INTO mecanicos (nome, telefone, especialidade, status)
            VALUES ('$nome', '$telefone', '$especialidade', '$status')";
} else {
    $sql = "UPDATE mecanicos SET 
                nome='$nome',
                telefone='$telefone',
                especialidade='$especialidade',
                status='$status'
            WHERE id = $id";
}

mysqli_query($conn, $sql);
header("Location: index.php");
