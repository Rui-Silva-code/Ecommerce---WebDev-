<?php
// Conexão com o banco de dados
    $servername = "localhost:8889";
    $username = "root";
    $password = "root";
    $dbname = "lojaonline";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>