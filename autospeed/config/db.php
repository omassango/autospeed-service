<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "autospeed";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}
?>
