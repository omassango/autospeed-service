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

include '../includes/header.php';
include '../includes/menu.php';
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']); // Senha simples, sem hash
    $tipo = $_POST['tipo'];

    $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES ('$nome', '$email', '$senha', '$tipo')";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?msg=ok');
    } else {
        echo "<div class='alert alert-danger'>Erro ao cadastrar usuário! Verifique se o e-mail já está em uso.</div>";
    }
}
?>

<div class="container mt-4">
    <h4>Novo Usuário</h4>

    <form action="cadastrar.php" method="POST">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" value="1234" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="tipo" class="form-label">Tipo de Usuário</label>
                <select class="form-control" id="tipo" name="tipo">
                    <option value="administrador">Administrador</option>
                    <option value="mecanico">Mecânico</option>
                    <option value="financeiro">Recepcionista</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Gravar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
