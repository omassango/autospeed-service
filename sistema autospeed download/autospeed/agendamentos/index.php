<?php
include '../includes/header.php';
include '../includes/menu.php';
include '../config/db.php';

$sql = "
    SELECT a.*, c.nome AS cliente
    FROM agendamentos a
    JOIN orcamentos o ON a.orcamento_id = o.id
    JOIN clientes c ON o.cliente_id = c.id
    ORDER BY a.data_agendada DESC, a.hora DESC
";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Lista de Agendamentos</h4>
        <a href="novo.php" class="btn btn-success">Agendar Serviço</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Acções</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($ag = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $ag['id'] ?></td>
                    <td><?= $ag['cliente'] ?></td>
                    <td><?= date('d/m/Y', strtotime($ag['data_agendada'])) ?></td>
                    <td><?= $ag['hora'] ?></td>
                    <td><span class="badge bg-info"><?= ucfirst($ag['status']) ?></span></td>
                    <td>
                        <a href="editar.php?id=<?= $ag['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="deletar.php?id=<?= $ag['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja mesmo apagar?')">Apagar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
