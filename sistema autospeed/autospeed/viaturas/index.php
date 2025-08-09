<?php
session_start();
include '../includes/header.php';
include '../includes/menu.php';
include '../config/db.php';
?>

<!-- Botão para abrir modal de cadastro -->
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="m-0">Lista de Viaturas</h4>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCadastrar">Cadastrar Nova Viatura</button>
</div>


<!-- Modal de cadastro -->
<div class="modal fade" id="modalCadastrar" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="salvar.php" class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Inserir Nova Viatura</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body row g-3">
        <div class="col-md-6">
          <label>Seleciona o Cliente</label>
          <select name="cliente_id" class="form-select" required>
            <option value="">Selecione</option>
            <?php
              $clientes = mysqli_query($conn, "SELECT id, nome FROM clientes");
              while ($c = mysqli_fetch_assoc($clientes)) {
                echo "<option value='{$c['id']}'>{$c['nome']}</option>";
              }
            ?>
          </select>
        </div>
        <div class="col-md-6">
          <label>Marca</label>
          <input type="text" name="marca" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label>Modelo</label>
          <input type="text" name="modelo" class="form-control" required>
        </div>
        <div class="col-md-3">
          <label>Ano</label>
          <input type="text" name="ano" class="form-control">
        </div>
        <div class="col-md-3">
          <label>Chapa de Matrícula</label>
          <input type="text" name="matricula" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label>Cor</label>
          <input type="text" name="cor" class="form-control">
        </div>
        <div class="col-md-12">
          <label>Observações</label>
          <textarea name="observacoes" class="form-control"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="salvar" class="btn btn-success">Gravar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<!-- Tabela de viaturas -->
<table class="table table-bordered">
  <thead class="table-dark">
    <tr>
      <th>Cliente</th>
      <th>Marca</th>
      <th>Modelo</th>
      <th>Chapa de Matrícula</th>
      <th>Ano</th>
      <th>Cor</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $query = "SELECT v.*, c.nome AS cliente_nome FROM viaturas v JOIN clientes c ON v.cliente_id = c.id ORDER BY v.id DESC";
      $result = mysqli_query($conn, $query);
      $modais = ''; // Acumula os modais fora da tabela

      while ($v = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
      <td><?= $v['cliente_nome'] ?></td>
      <td><?= $v['marca'] ?></td>
      <td><?= $v['modelo'] ?></td>
      <td><?= $v['matricula'] ?></td>
      <td><?= $v['ano'] ?></td>
      <td><?= $v['cor'] ?></td>
      <td>
        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $v['id'] ?>">Editar</button>
        <a href="deletar.php?id=<?= $v['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja mesmo excluir?')">Apagar</a>
      </td>
    </tr>
    <?php
      //Modal para edição fora da tabela
      ob_start();
    ?>
    <div class="modal fade" id="modalEditar<?= $v['id'] ?>" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <form method="POST" action="salvar.php" class="modal-content">
          <input type="hidden" name="id" value="<?= $v['id'] ?>">
          <div class="modal-header">
            <h5 class="modal-title">Editar Dados</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body row g-3">
            <div class="col-md-6">
              <label>Cliente</label>
              <select name="cliente_id" class="form-select" required>
                <?php
                  $clientes2 = mysqli_query($conn, "SELECT id, nome FROM clientes");
                  while ($c = mysqli_fetch_assoc($clientes2)) {
                    $selected = $c['id'] == $v['cliente_id'] ? 'selected' : '';
                    echo "<option value='{$c['id']}' $selected>{$c['nome']}</option>";
                  }
                ?>
              </select>
            </div>
            <div class="col-md-6">
              <label>Marca</label>
              <input type="text" name="marca" value="<?= $v['marca'] ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Modelo</label>
              <input type="text" name="modelo" value="<?= $v['modelo'] ?>" class="form-control" required>
            </div>
            <div class="col-md-3">
              <label>Ano</label>
              <input type="text" name="ano" value="<?= $v['ano'] ?>" class="form-control">
            </div>
            <div class="col-md-3">
              <label>Matrícula</label>
              <input type="text" name="matricula" value="<?= $v['matricula'] ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Cor</label>
              <input type="text" name="cor" value="<?= $v['cor'] ?>" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Observações</label>
              <textarea name="observacoes" class="form-control"><?= $v['observacoes'] ?></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="editar" class="btn btn-success">Gravar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
    <?php
      $modais .= ob_get_clean();
      }
    ?>
  </tbody>
</table>

<!-- Exibe todos os modais fora da tabela -->
<?= $modais ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include '../includes/footer.php'; ?>
