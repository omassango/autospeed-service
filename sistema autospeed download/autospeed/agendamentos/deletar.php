<?php
include '../config/db.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM agendamentos WHERE id = $id");
header("Location: index.php?msg=excluido");
