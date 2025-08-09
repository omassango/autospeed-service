<?php
include '../config/db.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];

if (empty($id)) {
    // Novo
    $sql = "INSERT INTO clientes (nome, telefone, email, endereco) 
            VALUES ('$nome', '$telefone', '$email', '$endereco')";
} else {
    // Atualização
    $sql = "UPDATE clientes SET 
                nome='$nome', 
                telefone='$telefone', 
                email='$email', 
                endereco='$endereco' 
            WHERE id=$id";
}

mysqli_query($conn, $sql);
header("Location: index.php");
