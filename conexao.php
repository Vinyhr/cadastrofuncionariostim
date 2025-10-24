<?php
$servidor = "localhost"; // Host MySQL
$usuario = "root"; // Nome de usuário do MySQL
$senha = "root"; // Senha do MySQL
$banco = "if0_40230921_cadastro_tim"; // Nome do banco de dados

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>