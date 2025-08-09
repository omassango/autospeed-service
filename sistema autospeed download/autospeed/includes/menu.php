<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container-fluid">
        <a class="navbar-brand" href="/autospeed/index.php">Página Inicial</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="/autospeed/clientes/index.php">Clientes</a></li>
                <li class="nav-item"><a class="nav-link" href="/autospeed/viaturas/index.php">Viaturas</a></li>
                <li class="nav-item"><a class="nav-link" href="/autospeed/mecanicos/index.php">Mecânicos</a></li>
                <li class="nav-item"><a class="nav-link" href="/autospeed/orcamentos/index.php">Orçamentos</a></li>
                <li class="nav-item"><a class="nav-link" href="/autospeed/agendamentos/index.php">Agendar Serviço</a></li>
                <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'administrador'): ?>
                    <li class="nav-item"><a class="nav-link" href="/autospeed/usuarios/index.php">Usuários</a></li>
                <?php endif; ?>
            </ul>

            <span class="navbar-text text-white me-3">
                <?php
                if (isset($_SESSION['usuario'], $_SESSION['tipo'])) {
                    echo ucfirst($_SESSION['tipo']) . " - " . $_SESSION['usuario'];
                } else {
                    echo "Usuário";
                }
                ?>
            </span>
            <a href="/autospeed/logout.php" class="btn btn-dark btn-sm">Sair</a>
        </div>
    </div>
</nav>
