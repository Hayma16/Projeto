<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root"; // Substitua pelo seu usuário do MySQL
$password = ""; // Substitua pela sua senha do MySQL
$dbname = "login_system";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtém os dados do formulário
$placa = $_POST['Placa'];
$cpf = $_POST['CPF'];

// Prepara a consulta SQL
$sql = "SELECT * FROM users WHERE Placa = ? AND CPF = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $placa, $cpf);

// Executa a consulta
$stmt->execute();
$result = $stmt->get_result();

// Verifica se encontrou algum registro
if ($result->num_rows > 0) {
    echo "Login bem-sucedido!";
} else {
    echo "Placa ou CPF incorretos!";
}

// Fecha a conexão
$stmt->close();
$conn->close();
?>

