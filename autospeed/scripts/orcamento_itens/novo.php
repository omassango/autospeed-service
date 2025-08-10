<?php
include '../includes/header.php';
include '../includes/menu.php';
include '../config/db.php';

if (!isset($_GET['id'])) {
    echo "ID do orçamento não informado.";
    exit;
}

$orcamento_id = $_GET['id'];

// Buscar produtos e serviços
$produtos = mysqli_query($conn, "SELECT id, nome, preco FROM produtos ORDER BY nome");
$servicos = mysqli_query($conn, "SELECT id, nome, preco FROM servicos ORDER BY nome");
?>

<div class="container mt-4">
    <h4>Adicionar Produto ao Orçamento #<?= $orcamento_id ?></h4>

    <form action="salvar_item.php" method="POST">
        <input type="hidden" name="orcamento_id" value="<?= $orcamento_id ?>">

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Produto</label>
                <select name="produto_id" class="form-select">
                    <option value="">-- Nenhum --</option>
                    <?php while ($p = mysqli_fetch_assoc($produtos)): ?>
                        <option value="<?= $p['id'] ?>"><?= $p['nome'] ?> - <?= number_format($p['preco'], 2, ',', '.') ?> MZN</option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="col-md-6">
                <label>Serviço</label>
                <select name="servico_id" class="form-select">
                    <option value="">-- Nenhum --</option>
                    <?php while ($s = mysqli_fetch_assoc($servicos)): ?>
                        <option value="<?= $s['id'] ?>"><?= $s['nome'] ?> - <?= number_format($s['preco'], 2, ',', '.') ?> MZN</option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label>Quantidade</label>
                <input type="number" name="quantidade" class="form-control" value="1" min="1" required>
            </div>
            <div class="col-md-4">
                <label>Preço Unitário (MZN)</label>
                <input type="number" name="preco_unitario" class="form-control" step="0.01" required>
            </div>
        </div>

        <div class="d-grid">
            <button class="btn btn-success">Salvar</button>
        </div>
    </form>

<hr class="my-4">
<h5>Produto ou peça já adicionados:</h5>

<table class="table table-bordered table-sm">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Produto</th>
            <th>Serviço</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
            <th>Subtotal</th>
            <th>Acções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $itens = mysqli_query($conn, "
            SELECT oi.*, 
                   p.nome AS produto_nome, 
                   s.nome AS servico_nome 
            FROM orcamento_itens oi
            LEFT JOIN produtos p ON oi.produto_id = p.id
            LEFT JOIN servicos s ON oi.servico_id = s.id
            WHERE oi.orcamento_id = $orcamento_id
        ");

        $total = 0;
        while ($item = mysqli_fetch_assoc($itens)):
            $subtotal = $item['quantidade'] * $item['preco_unitario'];
            $total += $subtotal;
        ?>
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= $item['produto_nome'] ?? '-' ?></td>
            <td><?= $item['servico_nome'] ?? '-' ?></td>
            <td><?= $item['quantidade'] ?></td>
            <td><?= number_format($item['preco_unitario'], 2, ',', '.') ?> MZN</td>
            <td><?= number_format($subtotal, 2, ',', '.') ?> MZN</td>
            <td>
                <a href="remover_item.php?id=<?= $item['id'] ?>&orcamento_id=<?= $orcamento_id ?>" 
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Deseja remover este item?')">Remover</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="5" class="text-end">Total</th>
            <th colspan="2"><?= number_format($total, 2, ',', '.') ?> MZN</th>
        </tr>
    </tfoot>
</table>


</div>

<?php include '../includes/footer.php'; ?>
