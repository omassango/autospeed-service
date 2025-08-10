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

// Buscar usuários
$sql = "SELECT * FROM usuarios ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-4">
<div class="d-flex justify-content-between mb-3">
    <h4>Lista de Usuários</h4>
    <a href="cadastrar.php" class="btn btn-success">Cadastrar Novo Usuário</a>
</div>
<?php if (isset($_GET['msg']) && $_GET['msg'] == 'ok'): ?>
    <div class="alert alert-success">Usuário criado com sucesso!</div>
    
    <?php endif; ?>

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($usuario = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= $usuario['nome'] ?></td>
                    <td><?= $usuario['email'] ?></td>
                    <td><?= ucfirst($usuario['tipo']) ?></td>
                    <td>
                        <a href="editar.php?id=<?= $usuario['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="deletar.php?id=<?= $usuario['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Apagar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
