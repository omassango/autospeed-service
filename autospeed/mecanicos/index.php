<?php
session_start();
include '../includes/header.php';
include '../includes/menu.php';
include '../config/db.php';

$result = mysqli_query($conn, "SELECT * FROM mecanicos");
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Lista de Mecânicos</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNovo">Cadastrar Novo Mecânico</button>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>N/O</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Especialidade</th>
                <th>Estado</th>
                <th>Acções</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($mec = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $mec['id'] ?></td>
                    <td><?= $mec['nome'] ?></td>
                    <td><?= $mec['telefone'] ?></td>
                    <td><?= $mec['especialidade'] ?></td>
                    <td><?= $mec['status'] ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $mec['id'] ?>">Editar</button>
                        <a href="deletar.php?id=<?= $mec['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirmar exclusão?')">Apagar</a>
                    </td>
                </tr>

                <!-- Modal Editar -->
                <div class="modal fade" id="modalEditar<?= $mec['id'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form action="salvar.php" method="POST">
                                <input type="hidden" name="id" value="<?= $mec['id'] ?>">
                                <div class="modal-header bg-warning text-white">
                                    <h5 class="modal-title">Editar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label>Nome</label>
                                            <input type="text" name="nome" value="<?= $mec['nome'] ?>" class="form-control" required>
                                        </div>
                                        <div class="col">
                                            <label>Telefone</label>
                                            <input type="text" name="telefone" value="<?= $mec['telefone'] ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label>Especialidade</label>
                                            <input type="text" name="especialidade" value="<?= $mec['especialidade'] ?>" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label>Estado Actual</label>
                                            <select name="status" class="form-control">
                                                <option <?= $mec['status'] == 'Ativo' ? 'selected' : '' ?>>Activo</option>
                                                <option <?= $mec['status'] == 'Inativo' ? 'selected' : '' ?>>Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-warning">Gravar</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Modal Novo Mecânico-->
<div class="modal fade" id="modalNovo" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="salvar.php" method="POST">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Novo Mecânico</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
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
                    <div class="row mb-3">
                        <div class="col">
                            <label>Especialidade</label>
                            <input type="text" name="especialidade" class="form-control">
                        </div>
                        <div class="col">
                            <label>Estado Actual</label>
                            <select name="status" class="form-control">
                                <option value="Ativo">Activo</option>
                                <option value="Inativo">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Gravar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
