<?php
include '../config/db.php';

if (isset($_POST['salvar'])) {
    // Inserção
    $cliente_id = $_POST['cliente_id'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $matricula = $_POST['matricula'];
    $cor = $_POST['cor'];
    $observacoes = $_POST['observacoes'];

    $sql = "INSERT INTO viaturas (cliente_id, marca, modelo, ano, matricula, cor, observacoes)
            VALUES ('$cliente_id', '$marca', '$modelo', '$ano', '$matricula', '$cor', '$observacoes')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        echo "Erro ao salvar: " . mysqli_error($conn);
    }

} elseif (isset($_POST['editar'])) {
    // Edição
    $id = $_POST['id'];
    $cliente_id = $_POST['cliente_id'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $matricula = $_POST['matricula'];
    $cor = $_POST['cor'];
    $observacoes = $_POST['observacoes'];

    $sql = "UPDATE viaturas SET 
                cliente_id = '$cliente_id',
                marca = '$marca',
                modelo = '$modelo',
                ano = '$ano',
                matricula = '$matricula',
                cor = '$cor',
                observacoes = '$observacoes'
            WHERE id = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        echo "Erro ao editar: " . mysqli_error($conn);
    }
}
?>
