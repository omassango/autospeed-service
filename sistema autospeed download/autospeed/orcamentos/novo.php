<?php
include '../includes/header.php';
include '../includes/menu.php';
include '../config/db.php';

// Buscar clientes e mecânicos para popular os <select>
$clientes = mysqli_query($conn, "SELECT id, nome FROM clientes ORDER BY nome");
$mecanicos = mysqli_query($conn, "SELECT id, nome FROM mecanicos ORDER BY nome");
?>

<div class="container mt-4">
    <h4>Inserir Dados do Orçamento</h4>
    <form action="salvar.php" method="POST">
        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Seleccione o Cliente</label>
                <select name="cliente_id" class="form-select" required>
                    <option value="">...Selecione...</option>
                    <?php while ($c = mysqli_fetch_assoc($clientes)): ?>
                        <option value="<?= $c['id'] ?>"><?= $c['nome'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3 col-md-6">
                <label>Seleccione o Mecânico</label>
                <select name="mecanico_id" class="form-select" required>
                    <option value="">Selecione...</option>
                    <?php while ($m = mysqli_fetch_assoc($mecanicos)): ?>
                        <option value="<?= $m['id'] ?>"><?= $m['nome'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Descrição do Serviço a Realizar</label>
            <textarea name="descricao_problema" class="form-control" rows="3"></textarea>
        </div>

<div class="row">
    <div class="mb-3 col-md-6">
        <label>Parecer Técnico do Serviço</label>
        <textarea name="laudo_tecnico" class="form-control" rows="3"></textarea>
    </div>

    <div class="mb-3 col-md-6">
        <label>Informações Adicionais</label>
        <textarea name="observacoes" class="form-control" rows="3"></textarea>
    </div>
</div>


        <div class="mb-3 col-md-6">
            <label>Valor a Pagar (MZN)</label>
            <input type="number" name="valor_total" step="0.01" class="form-control">
        </div>

        <div>
            <button type="submit" class="btn btn-success">Gravar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
            
        </div>
    </form>
</div>


<?php include '../includes/footer.php'; ?>
