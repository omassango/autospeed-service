<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit;
}
include '../includes/header.php';
include '../includes/menu.php';
include '../config/db.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Lista de Clientes</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNovo">Cadastrar Novo Cliente</button>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>N/O</th>
                <th>Nome do Cliente</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM clientes";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nome']}</td>
                        <td>{$row['telefone']}</td>
                        <td>{$row['email']}</td>
                        <td>
                            <button 
                                class='btn btn-sm btn-warning btn-editar'
                                data-id='{$row['id']}'
                                data-nome='{$row['nome']}'
                                data-telefone='{$row['telefone']}'
                                data-email='{$row['email']}'
                                data-endereco='" . htmlspecialchars($row['endereco']) . "'
                                data-bs-toggle='modal' 
                                data-bs-target='#modalEditar'
                            >Editar</button>
                            <a href='deletar.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Tem certeza?')\">Apagar</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal Novo Cliente -->
<div class="modal fade" id="modalNovo" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form action="salvar.php" method="POST" class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Inserir Novo Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" value="">
        <div class="row mb-3">
          <div class="col">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" required>
          </div>
          <div class="col">
            <label>Telefone</label>
            <input type="text" name="telefone" class="form-control">
          </div>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
          <label>Endereço</label>
          <textarea name="endereco" class="form-control"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Gravar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Editar Cliente -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="salvar.php" method="POST" class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="modalEditarLabel">Editar Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="edit-id">
        <div class="row mb-3">
          <div class="col">
            <label>Nome</label>
            <input type="text" name="nome" id="edit-nome" class="form-control" required>
          </div>
          <div class="col">
            <label>Telefone</label>
            <input type="text" name="telefone" id="edit-telefone" class="form-control">
          </div>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" id="edit-email" class="form-control">
        </div>
        <div class="mb-3">
          <label>Endereço</label>
          <textarea name="endereco" id="edit-endereco" class="form-control"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning">Gravar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<script>
document.querySelectorAll('.btn-editar').forEach(button => {
    button.addEventListener('click', function () {
        document.getElementById('edit-id').value = this.dataset.id;
        document.getElementById('edit-nome').value = this.dataset.nome;
        document.getElementById('edit-telefone').value = this.dataset.telefone;
        document.getElementById('edit-email').value = this.dataset.email;
        document.getElementById('edit-endereco').value = this.dataset.endereco;
    });
});
</script>

<?php include '../includes/footer.php'; ?>
