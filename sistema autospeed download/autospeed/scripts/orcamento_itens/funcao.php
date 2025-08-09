<?php
include '../config/db.php';
include 'funcoes.php';

atualizarTotalOrcamento($conn, $orcamento_id);


function atualizarTotalOrcamento($conn, $orcamento_id) {
    $sql = "
        SELECT SUM(quantidade * preco_unitario) AS total 
        FROM orcamento_itens 
        WHERE orcamento_id = $orcamento_id
    ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $total = $row['total'] ?? 0;

    $update = "UPDATE orcamentos SET valor_total = $total WHERE id = $orcamento_id";
    mysqli_query($conn, $update);
}
