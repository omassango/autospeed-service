<?php
include '../includes/header.php';
include '../includes/menu.php';
include '../config/db.php';

// Buscar orçamentos aprovados
$orcamentos = mysqli_query($conn, "
    SELECT o.id, c.nome 
    FROM orcamentos o 
    JOIN clientes c ON o.cliente_id = c.id 
    WHERE o.status = 'aprovado'
");
?>

<div class="container mt-4">
    <h4>Inserir Novo Serviço</h4>
    <form action="salvar.php" method="POST" class="mt-3">
        <div class="mb-3 col-md-6">
            <label>Seleciona o Cliente</label>
            <select name="orcamento_id" class="form-control" required>
                <option value="">...Selecione...</option>
                <?php while ($o = mysqli_fetch_assoc($orcamentos)): ?>
                    <option value="<?= $o['id'] ?>">Código <?= $o['id'] ?> - <?= $o['nome'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Data Agendada</label>
                <input type="date" name="data_agendada" class="form-control" required>
            </div>

            <div class="mb-3 col-md-6">
                <label>Hora</label>
                <input type="time" name="hora" class="form-control" required>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Gravar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>


<?php include '../includes/footer.php'; ?>
