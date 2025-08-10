<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit;
}

// Permitir apenas administradores
if ($_SESSION['tipo'] !== 'administrador') {
    echo "<div class='alert alert-danger text-center mt-5'>Acesso negado! Apenas administradores podem acessar esta página.</div>";
    exit;
}
include '../config/db.php';

$id = $_GET['id'];

$sql = "DELETE FROM usuarios WHERE id = $id";
if (mysqli_query($conn, $sql)) {
    header('Location: index.php?msg=excluido');
} else {
    echo "<div class='alert alert-danger'>Erro ao excluir usuário!</div>";
}
