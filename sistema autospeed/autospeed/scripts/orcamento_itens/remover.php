<?php
include '../config/db.php';

if (isset($_GET['id']) && isset($_GET['orcamento_id'])) {
    $id = $_GET['id'];
    $orcamento_id = $_GET['orcamento_id'];

    $sql = "DELETE FROM orcamento_itens WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: novo.php?id=$orcamento_id");
        exit;
    } else {
        echo "Erro ao remover item: " . mysqli_error($conn);
    }
} else {
    echo "ID do item ou orçamento não informado.";
}
