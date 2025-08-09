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
    $id = $_POST['id'];
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']); // Senha simples, sem hash
    $senha = empty($senha) ? $_POST['senha_atual'] : $senha; // Mantém a senha atual se não for alterada
    $tipo = $_POST['tipo'];

    $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', senha ='$senha', tipo = '$tipo' WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?msg=ok');
    } else {
        echo "<div class='alert alert-danger'>Erro ao editar usuário!</div>";
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE id = $id";
$result = mysqli_query($conn, $sql);
$usuario = mysqli_fetch_assoc($result);
?>

<div class="container mt-4">
    <h4>Editar Dados do Usuário</h4>

    <form action="editar.php" method="POST">
        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= $usuario['nome'] ?>" required>
            </div>

            <div class="mb-3 col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $usuario['email'] ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" value="<?= $usuario['senha'] ?>" placeholder="Deixe em branco para manter a senha atual">
            </div>

            <div class="mb-3 col-md-6">
                <label for="tipo" class="form-label">Tipo de Usuário</label>
                <select class="form-control" id="tipo" name="tipo">
                    <option value="administrador" <?= $usuario['tipo'] == 'administrador' ? 'selected' : '' ?>>Administrador</option>
                    <option value="mecanico" <?= $usuario['tipo'] == 'mecanico' ? 'selected' : '' ?>>Mecânico</option>
                    <option value="recepcionista" <?= $usuario['tipo'] == 'recepcionista' ? 'selected' : '' ?>>Recepcionista</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Gravar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>


<?php include '../includes/footer.php'; ?>
