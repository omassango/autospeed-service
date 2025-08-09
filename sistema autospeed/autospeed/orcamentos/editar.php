<?php
include '../includes/header.php';
include '../includes/menu.php';
include '../config/db.php';

$id = $_GET['id'];

// Buscar dados do orçamento
$sql = "SELECT * FROM orcamentos WHERE id = $id";
$result = mysqli_query($conn, $sql);
$orcamento = mysqli_fetch_assoc($result);

// Buscar clientes
$clientes = mysqli_query($conn, "SELECT id, nome FROM clientes");

// Buscar mecânicos
$mecanicos = mysqli_query($conn, "SELECT id, nome FROM mecanicos");
?>

<div class="container mt-4">
    <h4>Editar Orçamento</h4>

    <form action="atualizar.php" method="POST">
        <input type="hidden" name="id" value="<?= $orcamento['id'] ?>">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Cliente</label>
                <select name="cliente_id" class="form-select" required>
                    <?php while ($cli = mysqli_fetch_assoc($clientes)): ?>
                        <option value="<?= $cli['id'] ?>" <?= $cli['id'] == $orcamento['cliente_id'] ? 'selected' : '' ?>>
                            <?= $cli['nome'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Mecânico</label>
                <select name="mecanico_id" class="form-select" required>
                    <?php while ($mec = mysqli_fetch_assoc($mecanicos)): ?>
                        <option value="<?= $mec['id'] ?>" <?= $mec['id'] == $orcamento['mecanico_id'] ? 'selected' : '' ?>>
                            <?= $mec['nome'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Descrição do Problema</label>
                <textarea name="descricao_problema" class="form-control" rows="4"><?= $orcamento['descricao_problema'] ?></textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label>Parecer Técnico</label>
                <textarea name="laudo_tecnico" class="form-control" rows="4"><?= $orcamento['laudo_tecnico'] ?></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Observações</label>
                <textarea name="observacoes" class="form-control" rows="4"><?= $orcamento['observacoes'] ?></textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label>Estado</label>
                <select name="status" class="form-select" required>
                    <option value="pendente" <?= $orcamento['status'] == 'pendente' ? 'selected' : '' ?>>Pendente</option>
                    <option value="aprovado" <?= $orcamento['status'] == 'aprovado' ? 'selected' : '' ?>>Aprovado</option>
                    <option value="recusado" <?= $orcamento['status'] == 'recusado' ? 'selected' : '' ?>>Recusado</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Gravar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
