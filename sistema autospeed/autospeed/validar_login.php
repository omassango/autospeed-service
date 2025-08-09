<?php
session_start();
include 'config/db.php';

$email = $_POST['usuario']; // campo do form que recebe o "usuário", aqui é o email
$senha = $_POST['senha'];   // senha padrão: 1234

// Prepara a SQL de forma segura
$query = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ss", $email, $senha);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) === 1) {
    $dados = mysqli_fetch_assoc($result);
    $_SESSION['usuario'] = $dados['nome'];
    $_SESSION['id_usuario'] = $dados['id'];
    $_SESSION['tipo'] = $dados['tipo'];
    header("Location: index.php");
    exit;
} else {
    header("Location: login.php?erro=1");
    exit;
}
