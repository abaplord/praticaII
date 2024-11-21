<?php
$servername = "localhost";
$username = "root"; // usuário do banco de dados
$password = "root"; // senha do banco de dados
$dbname = "solicitacoes_db"; // nome do banco de dados

// Criação da conexão
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>