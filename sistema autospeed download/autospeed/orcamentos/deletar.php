<?php
include '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM orcamentos WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?msg=excluido");
        exit;
    } else {
        echo "Erro ao excluir orçamento: " . mysqli_error($conn);
    }
} else {
    echo "ID do orçamento não especificado.";
}
