<?php
session_start();

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login - Autospeed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
       
        .card {
            margin-top: 100px;
            border-radius: 15px;
        }
        .card-header {
            background-color: orangered;
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

    </style>
</head>
<body">

<div class="container mt-5">
    <div class="col-md-4 offset-md-4">
        <div class="card shadow rounded-3">
            <div class="card-header text-center">
                <div align="center" class="mb-2">
                    <img src="assets/img/logo-autospeed.png" width="150">
                </div>
            </div>
            <div class="card-body">
                <?php if (isset($_GET['erro'])): ?>
                    <div class="alert alert-danger">Usuário ou senha inválidos!</div>
                <?php endif; ?>
                <form action="validar_login.php" method="POST">
                    <div class="mb-3">
                        
                        <input type="text" name="usuario" placeholder="Email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        
                        <input type="password" name="senha" placeholder="Senha" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
