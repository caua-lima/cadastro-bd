<?php
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome']; // Corrigido para 'nome'
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Corrigido para 'senha'
    
    // Salva os dados no banco de dados
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    if ($stmt->execute([$nome, $email, $senha])) {
        echo "Usuário registrado com sucesso.";
    } else {
        echo "Erro ao registrar o usuário: " . implode(", ", $stmt->errorInfo()); // Exibe erro detalhado
    }
}