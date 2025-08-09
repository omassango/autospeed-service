<?php
include '../includes/header.php';
include '../includes/menu.php';
include '../config/db.php';

$id = $_GET['id'];

// Buscar agendamento
$agendamento = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM agendamentos WHERE id = $id
"));

// Buscar orçamentos aprovados
$orcamentos = mysqli_query($conn, "
    SELECT o.id, c.nome 
    FROM orcamentos o 
    JOIN clientes c ON o.cliente_id = c.id 
    WHERE o.status = 'aprovado'
");
?>

<div class="container mt-4">
    <h4>Editar Agendamento</h4>
    <form action="salvar.php" method="POST" class="mt-3">
        <input type="hidden" name="id" value="<?= $agendamento['id'] ?>">

        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Orçamento (Cliente)</label>
                <select name="orcamento_id" class="form-control" required>
                    <?php while ($o = mysqli_fetch_assoc($orcamentos)): ?>
                        <option value="<?= $o['id'] ?>" <?= ($o['id'] == $agendamento['orcamento_id']) ? 'selected' : '' ?>>
                            <?= $o['id'] ?> - <?= $o['nome'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3 col-md-6">
                <label>Estado do Serviço</label>
                <select name="status" class="form-control" required>
                    <option value="agendado" <?= $agendamento['status'] == 'agendado' ? 'selected' : '' ?>>Agendado</option>
                    <option value="realizado" <?= $agendamento['status'] == 'realizado' ? 'selected' : '' ?>>Realizado</option>
                    <option value="cancelado" <?= $agendamento['status'] == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Data Agendada</label>
                <input type="date" name="data_agendada" value="<?= $agendamento['data_agendada'] ?>" class="form-control" required>
            </div>

            <div class="mb-3 col-md-6">
                <label>Hora</label>
                <input type="time" name="hora" value="<?= $agendamento['hora'] ?>" class="form-control" required>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Gravar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
