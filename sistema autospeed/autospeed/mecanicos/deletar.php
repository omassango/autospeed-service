<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit;
}

include '../config/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "DELETE FROM mecanicos WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php?msg=deletado");
    } else {
        echo "Erro ao deletar: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
}
?>
