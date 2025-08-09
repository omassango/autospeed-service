<?php
include '../config/db.php';

$orcamento_id = $_POST['orcamento_id'];
$produto_id = !empty($_POST['produto_id']) ? $_POST['produto_id'] : 'NULL';
$servico_id = !empty($_POST['servico_id']) ? $_POST['servico_id'] : 'NULL';
$quantidade = $_POST['quantidade'];
$preco_unitario = $_POST['preco_unitario'];

// Validação mínima
if ($produto_id == 'NULL' && $servico_id == 'NULL') {
    echo "Selecione pelo menos um produto ou serviço.";
    exit;
}

$sql = "
    INSERT INTO orcamento_itens (orcamento_id, produto_id, servico_id, quantidade, preco_unitario)
    VALUES ($orcamento_id, $produto_id, $servico_id, $quantidade, $preco_unitario)
";

if (mysqli_query($conn, $sql)) {
    header("Location: novo.php?id=$orcamento_id&msg=ok");
    exit;
} else {
    echo "Erro ao salvar item: " . mysqli_error($conn);
}
