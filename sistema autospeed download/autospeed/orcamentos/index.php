<?php
include '../includes/header.php';
include '../includes/menu.php';
include '../config/db.php';

// Buscar orçamentos com nome do cliente e mecânico
$sql = "
    SELECT o.*, c.nome AS nome_cliente, m.nome AS nome_mecanico 
    FROM orcamentos o
    JOIN clientes c ON o.cliente_id = c.id
    JOIN mecanicos m ON o.mecanico_id = m.id
    ORDER BY o.data_criacao DESC
";

$result = mysqli_query($conn, $sql);
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Lista de Orçamentos</h4>
        <a href="novo.php" class="btn btn-success">Criar Novo Orçamento</a>
    </div>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'ok'): ?>
        <div class="alert alert-success">Orçamento salvo com sucesso!</div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'excluido'): ?>
        <div class="alert alert-danger">Orçamento apagado com sucesso.</div>
    <?php endif; ?>


    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Mecânico</th>
                <th>Valor (MT)</th>
                <th>Estado</th>
                <th>Data</th>
                <th>Acções</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($orc = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $orc['id'] ?></td>
                    <td><?= $orc['nome_cliente'] ?></td>
                    <td><?= $orc['nome_mecanico'] ?></td>
                    <td><?= number_format($orc['valor_total'], 2, ',', '.') ?></td>
                    <td><span class="badge bg-secondary"><?= ucfirst($orc['status']) ?></span></td>
                    <td><?= date('d/m/Y H:i', strtotime($orc['data_criacao'])) ?></td>
                    <td>
                        <a href="editar.php?id=<?= $orc['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="deletar.php?id=<?= $orc['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja apagar?')">Apagar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
