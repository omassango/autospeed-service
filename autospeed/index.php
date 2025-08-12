<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ./login.php");
    exit;
}

include 'includes/header.php';
include 'includes/menu.php';
include 'config/db.php';
?>

<!DOCTYPE html>
<html lang="pt-PT">

<body>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/favic-autospeed.ico" type="image/x-icon">
    <title>Autospeed Service Maxixe</title>
</head>

<div class="container mt-4">
    <div class="text-center mb-4">
        <h2>Sistema de Controlo de Serviços da Autospeed Service</h2>
        <img src="assets/img/logo-autospeed.png" width="120" alt="Logo Autospeed">
        <hr>
    </div>
    
    <div class="row g-3 justify-content-center">
        <div class="col-md-3">
            <a href="clientes/index.php" class="btn btn-primary w-100 p-3">
                <i class="bi bi-person-plus-fill"></i> Cadastrar de Cliente
            </a>
        </div>

        <div class="col-md-3">
            <a href="viaturas/index.php" class="btn btn-danger w-100 p-3">
                <i class="bi bi-car-front"></i> Cadastrar de Viaturas
            </a>
        </div>
        <div class="col-md-3">
            <a href="mecanicos/index.php" class="btn btn-success w-100 p-3">
                <i class="bi bi-person-badge"></i> Cadastrar de Mecânicos
            </a>
        </div>
        <div class="col-md-3">
            <a href="orcamentos/index.php" class="btn btn-info w-100 p-3">
                <i class="bi bi-file-earmark-text"></i>Cadastrar de Orçamentos
            </a>
        </div>
        <div class="col-md-3">
            <a href="agendamentos/index.php" class="btn btn-success w-100 p-3">
                <i class="bi bi-calendar-check"></i> Agendar Serviços
            </a>
        </div>
      
        <div class="col-md-3">
            <a href="usuarios/index.php" class="btn btn-warning w-100 p-3">
                <i class="bi bi-person-circle"></i> Cadastrar de Usuários
            </a>
    </div>
</div>
    <div class="row g-3 justify-content-center mt-4">
        <div class="text-center mt-4">
            <p class="text-muted">Autospeed Service Maxixe &copy; <?= date('Y') ?></p>
            <p class="text-muted">Desenvolvido por: <a href="https://www.facebook.com/share/196F79reow/" target="_blank">Osvaldo Massango</a></p>
            <p class="text-muted">Estudante da <a href="https://www.umum.education" target="_blank">Universidade Metodista Unida de Moçambique - UMUM</a></p>
        </div>
    </div>
</body>

</html>
<?php include 'includes/footer.php'; ?>
